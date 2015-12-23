<?php
// *******************************************************
// moneyTransferXMLexport.php
// Version 1.0 
// Date: 2015-12-15
// *******************************************************
  
	require_once('config.php');
	require_once('companyExportData.php');

	$product = 'Wells Fargo';
	$strsql = SQL_WF;	
	exportEXCEL($strsql, $product);

?>