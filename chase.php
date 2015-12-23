<?php
// *******************************************************
// chase.php
// Version 1.0 
// Date: 2015-12-15
// *******************************************************
 
//import config.php
	require_once('config.php');
	require_once('getProductTable.php');
	
 	$html =<<< EOF
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Analyser</title>
	<link rel="stylesheet" href="styles.css" type="text/css" />

	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	</head>
	<body>
	<form action="Process.php" method="POST">
		<section id="body" class="width">
			<aside id="sidebar" class="column-left">

			<header>
				<h1><a href="index.php">Analyser</a></h1>

				<h2>for consumer complaints analysis!</h2>
				
			</header>

			<nav id="mainnav">
					<ul>
							<li><a href="index.php">Home</a></li>
							<li class="category-item"><a>Financial Products</a></li>
							<li><a href="debtCollection.php">Debt collection</a></li>
							<li><a href="creditReporting.php">Credit reporting</a></li>
							<li><a href="consumerLoan.php">Consumer loan</a></li>
							<li><a href="moneyTransfer.php">Money transfers</a></li>
							
							<li class="category-item"><a>Financial Companies</a></li>
							<li class="selected-item"><a href="chase.php">Chase</a></li>
							<li><a href="boa.php">Bank of America</a></li>
							<li><a href="wf.php">Wells Fargo</a></li>

					</ul>
			</nav>

			
			
			</aside>
			<section id="content" class="column-right">
										
			<article>
				
					
				<h3>Chase</h3>

				<blockquote><p>
				Chase provides its products and services through operating more than 5,100 branches and 
				16,100 ATMs nationwide. Check out the financial products and its sub-products
				provided by Chase below:
				</p></blockquote>
				<p>&nbsp;</p>
			


				<table>
					<tr>
						<th>Product</th>
						<th>Sub-product</th>
					</tr>

EOF;
echo $html;

$strsql = SQL_Chase;				
generateTable($strsql);

$html =<<< EOF
			<p>&nbsp;</p>
			<h5>Export Data</h5>
			
				<a href="chaseXMLexport.php" class="button">EXCEL</a>
				<a href="chasePDFexport.php" class="button button-reversed">PDF</a>
				<a href="chaseCSVexport.php" class="button">CSV</a>
				
			<p>&nbsp;</p>
EOF;
echo $html;		


 	$html =<<< EOF
			<p>&nbsp;</p>
			<footer class="clear">
				<p>&copy; CSCI1000 Database System Course Project by Dan Meng, Weijia Sun, Yao Jin, Rui Sun.
				<a href="http://zypopwebtemplates.com/">Free CSS Templates</a> by ZyPOP</p>
			</footer>

		</section>

		<div class="clear"></div>

	</section>
	</form>
	</body>
	</html>
EOF;
echo $html;

?>