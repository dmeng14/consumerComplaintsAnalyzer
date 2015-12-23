<?php	
// *******************************************************
// creditReportingPDFexport.php
// Version 1.0 
// Date: 2015-12-03
// *******************************************************
  
	require_once('config.php');
	require_once('exportData.php');

	$product = P_T_CREDIT_REPORTING;
	$strsql=SQL_CREDIT_REPORTING;
	exportPDF($strsql, $product);

?>