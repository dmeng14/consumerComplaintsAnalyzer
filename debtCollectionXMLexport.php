 <?php
 
$strsql="call countIssues('Debt collection')";

$product = "Debt collection";

exportTable($strsql, $product);

function exportTable($strsql, $product) {
	$mysql_server_name="localhost"; 
	$mysql_username="root"; 
	$mysql_password=""; 
	$mysql_database="company"; 
	$savename = date("YmjHis"); 
	$conn = mysql_connect($mysql_server_name, $mysql_username,
											$mysql_password);
											
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$file_type = "vnd.ms-excel"; 
	$file_ending = "xls"; 
	header("Content-Type: application/$file_type;charset=big5"); 
	header("Content-Disposition: attachment; filename=".$savename.".$file_ending"); 
	//header("Pragma: no-cache"); 
	$now_date = date("Y-m-j H:i:s"); 
	$title = "Database Name:$mysql_server_name,Product Type:$product,Date:$now_date"; 
	$result=mysql_db_query($mysql_database, $strsql, $conn);
	
	echo("$title\n"); 
	$sep = "\t"; 
	for ($i = 0; $i < mysql_num_fields($result); $i++) { 
	echo mysql_field_name($result,$i) . "\t"; 
	} 
	print("\n"); 
	$i = 0; 
	while($row = mysql_fetch_row($result)) { 
	$schema_insert = ""; 
	for($j=0; $j<mysql_num_fields($result);$j++) { 
	if(!isset($row[$j])) 
	$schema_insert .= "NULL".$sep; 
	elseif ($row[$j] != "") 
	$schema_insert .= "$row[$j]".$sep; 
	else 
	$schema_insert .= "".$sep; 
	} 
	$schema_insert = str_replace($sep."$", "", $schema_insert); 
	$schema_insert .= "\t"; 
	print(trim($schema_insert)); 
	print "\n"; 
	$i++; 
	} 
	return (true); 
}
?>