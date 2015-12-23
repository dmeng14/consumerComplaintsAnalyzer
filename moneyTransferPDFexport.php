<?php
// *******************************************************
// moneyTransferPDFexport.php
// Version 1.0 
// Date: 2015-12-03
// *******************************************************
 			
	require_once('config.php');
	require_once('exportData.php');

	$product = P_T_MONEY_TRANSFERS;
	$strsql = SQL_MONEY_TRANSFERS;	
	exportPDF($strsql, $product);

?>