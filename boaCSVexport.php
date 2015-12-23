<?php
// *******************************************************
// consumerLoanCSVexport.php
// Version 1.0 
// Date: 2015-12-15
// *******************************************************
 	
	require_once('config.php');
	require_once('companyExportData.php');
 
	$product = 'Bank of America';
	$strsql = SQL_BOA;	
	exportCSV($strsql, $product);

 ?>