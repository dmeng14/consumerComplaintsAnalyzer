/*use SQL queries to extract complaints issues and the number of complaints
  of certain product */
  
/*select the parent issue of certain product*/
select issue.issue_id, issue.issue, parent_id
from issue, (select id 
			from product
			where name = 'Debt collection') R2
where issue.product_id = R2.id and issue.parent_id is NULL;

/*count the number of complaints of each parent issue for certain product */
select R1.issue, R5.NumOfCompl
from 
	/* get parent issues relating to the product : R1 */
	(select issue.issue_id, issue.issue 
	from issue, (select id 
			from product
			where name = 'Debt collection') R2
	where issue.product_id = R2.id and issue.parent_id is NULL) R1
inner join
	/* sum up number of sub-issues : R5*/
	(select R4.parent_id, sum(R4.NumOfComplaints) as NumOfCompl
	from
		/* get number of complaints of the sub-issues/issues of the product: R4 */
		(select R3.issue, R3.parent_id, count(complaints.issue) as NumOfComplaints
		from 
			/* get issues and sub-issues relating to the product: R3 */
			(select issue.issue_id, issue.issue, issue.parent_id
			from issue, (select id 
						from product
						where name = 'Debt collection') R2
			where issue.product_id = R2.id) R3
		inner join complaints
		on complaints.issue = R3.issue_id
		group by R3.issue) R4
	group by R4.parent_id) R5
on R1.issue_id = R5.parent_id
order by R1.issue;

/*use stored procedure as alternative to extract the same information */


delimiter //
/* stored procedure to get the product ID of given the product name*/
drop procedure if exists getID//
create procedure getID
(in product varchar(60), out outid int)
begin
select id into outid
from product where name = product;
end //
/*select the parent issues given certain product*/
drop procedure if exists productIssues//
create procedure productIssues
(in service varchar(60)) 
begin
declare prodid int;
call getID(service, prodid);
select issue.issue_id, issue.issue, parent_id
from issue
where issue.product_id = prodid and issue.parent_id is NULL;
end //
delimiter ;

/*count the number of complaints of each parent issue for certain product */
delimiter //
drop procedure if exists countIssues //
create procedure countIssues (in service varchar(60))
begin
declare prodid int;
call getID(service, prodid);
select R1.issue, R5.NumOfCompl
from 
	/* get parent issues relating to the product : R1 */
	(select issue.issue_id, issue.issue 
	from issue
	where issue.product_id = prodid and issue.parent_id is NULL) R1
inner join
	/* sum up number of sub-issues : R5*/
	(select R4.parent_id, sum(R4.NumOfComplaints) as NumOfCompl
	from
		/* get number of complaints of the sub-issues/issues of the product: R4 */
		(select R3.issue, R3.parent_id, count(complaints.issue) as NumOfComplaints
		from 
			/* get issues and sub-issues relating to the product: R3 */
			(select issue.issue_id, issue.issue, issue.parent_id
			from issue
			where issue.product_id = prodid) R3
		inner join complaints
		on complaints.issue = R3.issue_id
		group by R3.issue) R4
	group by R4.parent_id) R5
on R1.issue_id = R5.parent_id
order by R1.issue;
end //
delimiter ;
