 <?php
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
		<section id="body" class="width">
			<aside id="sidebar" class="column-left">

			<header>
				<h1><a href="index.php">Analyser</a></h1>

				<h2>for consumer complaints analysis!</h2>
				
			</header>

			<nav id="mainnav">
					<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="debtCollection.php">Debt collection</a></li>
							<li class="selected-item"><a href="creditReporting.php">Credit reporting</a></li>
							<li><a href="consumerLoan.php">Consumer loan</a></li>
							<li><a href="moneyTransfer.php">Money transfers</a></li>

					</ul>
			</nav>

			
			
			</aside>
			<section id="content" class="column-right">
										
			<article>
				
					
				<h3>Credit Reporting</h3>

				<blockquote><p>
				The number of complaints relating to the issues of this financial product are
				summarized in the table below. Data representing the most recent 10,000 complaints
				submitted to CFPB.
				</p></blockquote>
				<p>&nbsp;</p>
				<table>
					<tr>
						<th>Issues</th>
						<th>Number of Complaints</th>
					</tr>

EOF;
echo $html;


				

$strsql="call countIssues('Credit reporting')";
generateTable($strsql);

$html =<<< EOF
			<p>&nbsp;</p>
			<h5>Export Data</h5>
			
				<a href="creditReportingXMLexport.php" class="button">EXCEL</a>
				<a href="#" class="button button-reversed">PDF</a>
				
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
	</body>
	</html>
EOF;
echo $html;

function generateTable($strsql) {
 $mysql_server_name="localhost"; 
	$mysql_username="root"; 
	$mysql_password=""; 
	$mysql_database="company"; 
	
	// connect to server
	$conn = mysql_connect($mysql_server_name, $mysql_username,
											$mysql_password);
											
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
											
	// run sql command
	$result=mysql_db_query($mysql_database, $strsql, $conn);
	// fetch sql result
	$row=mysql_fetch_row($result);
	

	// ??????
	echo "</b><tr></b>";
	for ($i=2; $i<mysql_num_fields($result); $i++)
	{
		echo '<td><b>'.
		mysql_field_name($result, $i);
		echo "</b></td></b>";
	}
	echo "</tr></b>";
	// ????????
	mysql_data_seek($result, 0);
	// ??????
	while ($row=mysql_fetch_row($result))
	{
		echo "<tr></b>";
		for ($i=0; $i<mysql_num_fields($result); $i++ )
		{
			echo '<td>';
			echo $row[$i];
			echo '</td>';
		}
		echo "</tr></b>";
	}
 
	echo "</table></b>";

	
	
	// ????
	mysql_free_result($result);
	// ????
	mysql_close($conn);  
}
?>