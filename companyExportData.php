<?php
// *******************************************************
// exportData.php
// Version 1.0 
// Date: 2015-12-15
// *******************************************************

 	//import config.php
	require_once('config.php');
	
	//import fpdf library
	define('FPDF_FONTPATH','fpdf152/font/');
	require_once('fpdf152/fpdf.php');
	
function exportCSV($strsql, $product) {

	$mysql_server_name=SERVER_NAME; 		// mysql server name
	$mysql_username=USER_NAME; 				// mysql user name
	$mysql_password=USER_PASSWORD; 			// mysql user password
	$mysql_database=DB_NAME; 				// mysql database name
			
	$savename = date("Y-m-d H:i:s");
		
	$Connect = @mysql_connect($mysql_server_name, $mysql_username, $mysql_password) or die("Couldn't connect."); 
	mysql_query("Set Names 'gbk'"); 
	//$file_type = "vnd.ms-excel"; 
	$file_ending = "csv"; 
	//header("Content-Type: application/$file_type;charset=big5"); 
	header("Content-Disposition: attachment; filename=".$savename.".$file_ending"); 
	header("Pragma: no-cache"); 

	$now_date = date("Y-m-j H:i:s"); 
	$title = "Product:$product,backup date:$now_date"; 
	 
	// 从表中提取信息的sql语句	
	$ALT_Db = @mysql_select_db($mysql_database, $Connect) or die("Couldn't select database"); 
	$result = @mysql_query($strsql,$Connect) or die(mysql_error()); 

	echo("$title\n"); 
	echo("Product, Sub-product");
	$sep = ","; 
	/*
	for ($i = 0; $i < mysql_num_fields($result); $i++) { 
		echo '"' . mysql_field_name($result,$i) . '"' . $sep; 
	} */
	print("\n"); 
	$i = 0; 
	$tmp = 'tmp';
	while($row = mysql_fetch_row($result)) { 
		$schema_insert = ""; 

		for($j=0; $j<mysql_num_fields($result);$j++) { 
			if ($j ==0 && $row[$j] == $tmp)
				$schema_insert .= '"' . "" . '"' . $sep; 
			elseif(!isset($row[$j])) 
				$schema_insert .= '"' . "" . '"' . $sep; 
			elseif ($row[$j] != "" && $j != 0 ) 
				$schema_insert .= '"' . "$row[$j]" . '"' . $sep; 
			elseif ($row[$j] != "" && $j == 0 && $row[$j] != $tmp) {
				$schema_insert .= '"' . "$row[$j]" . '"' . $sep;
				$tmp = $row[$j];
			}
			else
				$schema_insert .= '"' . "" . '"' . $sep; 
		}
	
		$schema_insert = str_replace($sep."$", "", $schema_insert); 
		//$schema_insert .= ","; 
		print(trim($schema_insert)); 
		print "\n"; 
		$i++; 
	}
	
	// release
	mysql_free_result($result);
	// disconnection
	mysql_close($Connect);		
}
		
function exportPDF($strsql, $product) {			

	$mysql_server_name=SERVER_NAME; 		// mysql server name
	$mysql_username=USER_NAME; 				// mysql user name
	$mysql_password=USER_PASSWORD; 			// mysql user password
	$mysql_database=DB_NAME; 				// mysql database name
			
	$savename = date("Y-m-d H:i:s");
					
	$conn=mysql_connect($mysql_server_name, $mysql_username,$mysql_password);
				
	// 从表中提取信息的sql语句
	// 执行sql查询
	$result=mysql_db_query($mysql_database, $strsql, $conn);
	// 获取查询结果
	$row=mysql_fetch_row($result);	
 
	$pdf=new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',15);
	
	$pdf->SetFont('','B','15');
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(128);
	$pdf->SetDrawColor(92,92,92);
	$pdf->SetLineWidth(.3);
	$pdf->Write(40,$product);
	$pdf->Ln();
	
	//title
	$pdf->SetFont('','B','9');
	$pdf->SetFillColor(128,128,128);
	$pdf->SetTextColor(255);
	$pdf->SetDrawColor(92,92,92);
	$pdf->SetLineWidth(.3);
	
	// 显示字段名称
	//echo "</b><tr></b>";
	
		//$pdf->Cell(mysql_field_len($result, $i),7,mysql_field_name($result, $i),1,0,'C',true);	
	$pdf->Cell(80,8,'Product',1,0,'L',true);	
	$pdf->Cell(80,8,'Sub-product',1,0,'L',true);	
	$pdf->Ln();
	
	//contents
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(128);
	$pdf->SetDrawColor(92,92,92);
	
	//echo "</tr></b>";
	// 定位到第一条记录
	mysql_data_seek($result, 0);
	// 循环取出记录
	$tmp = 'tmp';
	while ($row=mysql_fetch_row($result)) {
		//echo "<tr></b>";
		for ($i=0; $i<mysql_num_fields($result); $i++ ) {
			if ($i == 0 && $tmp == $row[$i])
				$pdf->Cell(80,8,'',1,0,'L',true);
			elseif ($i == 0 && $tmp != $row[$i]) {
				$pdf->Cell(80,8,$row[$i],1,0,'L',true);
				$tmp = $row[$i];
			}
			else
				$pdf->Cell(80,8,$row[$i],1,0,'L',true);
		}
		//echo "</tr></b>";
		$pdf->Ln();
	}	
	$pdf->Output("$savename.pdf", 'D');
			
	// release
	mysql_free_result($result);
	// disconnection
	mysql_close($conn);		
  }

function exportEXCEL($strsql, $product) {

	$mysql_server_name=SERVER_NAME; 		// mysql server name
	$mysql_username=USER_NAME; 				// mysql user name
	$mysql_password=USER_PASSWORD; 			// mysql user password
	$mysql_database=DB_NAME; 				// mysql database name
	
	$savename = date("Y-m-d H:i:s");
	
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
	$title = "Product:$product,backup date:$now_date";
	$result=mysql_db_query($mysql_database, $strsql, $conn);
	
	echo("$title\n"); 
	$sep = "\t"; 
	echo("Product, Sub-product").$sep;
	/*
	for ($i = 0; $i < mysql_num_fields($result); $i++) { 
	echo mysql_field_name($result,$i) . "\t"; 
	} */
	print("\n"); 
	$i = 0; 
	$tmp = 'tmp';
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

	// release
	mysql_free_result($result);
	// disconnection
	mysql_close($conn);		
}	

?>