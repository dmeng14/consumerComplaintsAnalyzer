<?php
 // *******************************************************
// debtCollectionPDFexport.php
// Version 1.0 
// Date: 2015-12-03
// *******************************************************

	require_once('config.php');
	require_once('exportData.php');	

	$product = P_T_DEBT_COLLECTION;
	$strsql=SQL_DEBT_COLLECTION;
	exportPDF($strsql, $product);

?>