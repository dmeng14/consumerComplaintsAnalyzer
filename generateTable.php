<?php
// *******************************************************
// generateTable.php
// Version 1.0 
// Date: 2015-12-03
// *******************************************************

 	//import config.php
	require_once('config.php');
	
function generateTable($strsql) {
	
	$mysql_server_name=SERVER_NAME; 		// mysql server name
	$mysql_username=USER_NAME; 				// mysql user name
	$mysql_password=USER_PASSWORD; 			// mysql user password
	$mysql_database=DB_NAME; 				// mysql database name
	
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

	/* to print out the field name from sql result
	echo "</b><tr></b>";
	for ($i=0; $i<mysql_num_fields($result); $i++)
	{
		echo '<td><b>'.
		mysql_field_name($result, $i);
		echo "</b></td></b>";
	}
	echo "</tr></b>";
	*/
	mysql_data_seek($result, 0);
	// 
	while ($row=mysql_fetch_row($result))
	{
		echo "<tr><b>";
		for ($i=0; $i<mysql_num_fields($result); $i++ )
		{
			echo '<td>';
			echo $row[$i];
			echo '</td>';
		}
		echo "</tr></b>";
	}
 
	echo "</table></b>";
	
	// release
	mysql_free_result($result);
	// disconnection
	mysql_close($conn);		
}

?>