<?php
// *******************************************************
// debtCollectionXMLexport.php
// Version 1.0 
// Date: 2015-12-03
// *******************************************************

	require_once('exportData.php');
	require_once('config.php');

	$product = P_T_DEBT_COLLECTION;
	$strsql=SQL_DEBT_COLLECTION;
	exportEXCEL($strsql, $product);

?>