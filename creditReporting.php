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
				<h1><a href="#">Analyser</a></h1>

				<h2>for consumer complaints analysis!</h2>
				
			</header>

			<nav id="mainnav">
					<ul>
							<li><a href="index.php">Home</a></li>
							<form action="debtCollection.php" method="post">
								<li><input id="submit" type="submit" name="product" value="Debt collection"/></li>
							</form>
							<form action="creditReporting.php" method="post">
								<li><input id="submit" type="submit" name="product" value="Credit reporting"/></li>
							</form>	
							<form>
								<li><input id="submit" type="submit" name="product" value="Consumer loan"/></li>
							</form>	
							<form>
							<li><input id="submit" type="submit" name="product" value="Money transfers"/></li>
							</form>	
							<form>
							<li><input id="submit" type="submit" name="product" value="Mortgage"/></li>
							</form>	
							<form>
							<li><input id="submit" type="submit" name="product" value="Bank account or service"/></li>
							</form>	
							<form>
							<li><input id="submit" type="submit" name="product" value="Credit card"/></li>
							</form>	
							<form>
							<li><input id="submit" type="submit" name="product" value="Student loan"/></li>
							</form>	
							<form>
							<li><input id="submit" type="submit" name="product" value="Payday loan"/></li>
							</form>	
							<form>
							<li><input id="submit" type="submit" name="product" value="Prepaid card"/></li>
							</form>
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
				



EOF;
echo $html;


				

$strsql="call countIssues('Credit reporting')";
generateTable($strsql);

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
	
	 
	echo '<table>';

	// ??????
	echo "</b><tr></b>";
	for ($i=0; $i<mysql_num_fields($result); $i++)
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
?>