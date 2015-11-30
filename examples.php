 <?php
 	$html =<<< EOF
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>anatine - a free css template</title>
	<link rel="stylesheet" href="styles.css" type="text/css" />

	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	</head>
	<body>
		<section id="body" class="width">
			<aside id="sidebar" class="column-left">

			<header>
				<h1><a href="#">anatine</a></h1>

				<h2>Welcome to my website!</h2>
				
			</header>

			<nav id="mainnav">
					<ul>
                            		<li><a href="index.php">Home</a></li>
                           		 <li><a href="examples.php">Examples</a></li>

                            		<li><a href="#">Solutions</a></li>
                            		<li><a href="#">Contact</a></li>
													</ul>
			</nav>

			
			
			</aside>
			<section id="content" class="column-right">
										
			<article>
				
					
				<h3>Code and blockquote</h3>

				<blockquote><p>Mauris sit amet tortor in urna tincidunt aliquam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas</p></blockquote>
				
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