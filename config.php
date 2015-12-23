<?php
// *******************************************************
// config.php
// Version 1.0 
// Date: 2015-12-03
// update: 2015-12-15
// *******************************************************


// *******************************************************
// database configuration
define("SERVER_NAME", "localhost");
define("USER_NAME", "root");
define("USER_PASSWORD", "");
define("DB_NAME", "company");
/*
define("SERVER_NAME", "134.74.126.107");
define("USER_NAME", "meng8980");
define("USER_PASSWORD", "I1000_meng8980");
define("DB_NAME", "I1000_meng8980");
*/
// *******************************************************
// product type
define("P_T_DEBT_COLLECTION", "Debt collection");
define("P_T_CREDIT_REPORTING", "Credit reporting");
define("P_T_CONSUMER_LOAN", "Consumer Loan");
define("P_T_MONEY_TRANSFERS", "Money Transfers");


// *******************************************************
// SQL 
define ("SQL_Chase", 
			"select R1.name, product.name
				from
					(select id, name
					from product
					where companyName = 'Chase' and parentId is NULL) R1
				inner join
					product
				on R1.id = product.parentId
				order by R1.id, product.name;");

define ("SQL_BOA", 
			"select R1.name, product.name
				from
					(select id, name
					from product
					where companyName = 'BOA' and parentId is NULL) R1
				inner join
					product
				on R1.id = product.parentId
				order by R1.id, product.name;");
				
define ("SQL_WF", 
			"select R1.name, product.name
				from
					(select id, name
					from product
					where companyName = 'Wells Fargo' and parentId is NULL) R1
				inner join
					product
				on R1.id = product.parentId
				order by R1.id, product.name;");

define("SQL_DEBT_COLLECTION", 
			"/*count the number of complaints of each parent issue for certain product */
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
order by R1.issue;");
//define("SQL_DEBT_COLLECTION", "call countIssues('Debt collection')");


define("SQL_CREDIT_REPORTING", "
select R1.issue, R5.NumOfCompl
from 
	/* get parent issues relating to the product : R1 */
	(select issue.issue_id, issue.issue 
	from issue, (select id 
			from product
			where name = 'Credit reporting') R2
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
						where name = 'Credit reporting') R2
			where issue.product_id = R2.id) R3
		inner join complaints
		on complaints.issue = R3.issue_id
		group by R3.issue) R4
	group by R4.parent_id) R5
on R1.issue_id = R5.parent_id
order by R1.issue;
");
//define("SQL_CREDIT_REPORTING", "call countIssues('Credit reporting')");


define("SQL_CONSUMER_LOAN", 
		"select R3.issue, count(complaints.issue) as NumOfComplaints
		from 
			(select issue.issue_id, issue.issue, issue.parent_id
			from issue, (select id 
						from product
						where name = 'Consumer loan') R2
			where issue.product_id = R2.id) R3
		inner join complaints
		on complaints.issue = R3.issue_id
		group by R3.issue");


define("SQL_MONEY_TRANSFERS", 
		"select R3.issue, count(complaints.issue) as NumOfComplaints
		from 
			(select issue.issue_id, issue.issue, issue.parent_id
			from issue, (select id 
						from product
						where name = 'Money transfers') R2
			where issue.product_id = R2.id) R3
		inner join complaints
		on complaints.issue = R3.issue_id
		group by R3.issue");

	
?>