<?php
// *******************************************************
// consumerLoanCSVexport.php
// Version 1.0 
// Date: 2015-12-03
// *******************************************************
 	
	require_once('config.php');
	require_once('exportData.php');
 
	$product = P_T_CONSUMER_LOAN;
	$strsql = SQL_CONSUMER_LOAN;	
	exportCSV($strsql, $product);

 ?>