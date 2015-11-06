alter table issue modify product_id int;
alter table product modify id int;
/*select all the issue and sub-issues of certain product*/
select issue.issue
from issue, (select id 
			from product
			where name = 'Consumer loan') R2
where issue.product_id = R2.id;

/*select just the issue of certain product*/
select issue.issue_id, issue.issue, parent_id
from issue, (select id 
			from product
			where name = 'Debt collection') R2
where issue.product_id = R2.id and issue.parent_id is NULL;

/*count the number of issue/sub-issues each product has*/
select product.name, count(issue.issue) as Num_issues
from issue
inner join product
on issue.product_id = product.id
group by name;

/*count the number of complaints for each sub-issue*/
select issue.issue, count(complaints.issue) as NumOfComplaints
from complaints
inner join issue
on complaints.issue = issue.issue_id
group by issue.issue;

/*count the number of complaints of each issue for certain product */
select R1.issue, R5.NumOfCompl
from 
(select issue.issue_id, issue.issue
from issue, (select id 
			from product
			where name = 'Debt collection') R2
where issue.product_id = R2.id and issue.parent_id is NULL) R1
inner join
(select R4.parent_id, sum(R4.NumOfComplaints) as NumOfCompl
from
(select R3.issue, R3.parent_id, count(complaints.issue) as NumOfComplaints
from 
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
