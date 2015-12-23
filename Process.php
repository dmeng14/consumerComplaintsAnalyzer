<?php
// *******************************************************
// Process.php
// Version 1.0 
// Date: 2015-12-03
// *******************************************************
 
  //for fpdf library import
  define('FPDF_FONTPATH','fpdf152/font/');
  require('fpdf152/fpdf.php');
  
  //CONFIG FILE
  require_once('config.php');
  
  $mysql_server_name=SERVER_NAME; 			//数据库服务器名称
  $mysql_username=USER_NAME; 				// 连接数据库用户名
  $mysql_password=USER_PASSWORD; 			// 连接数据库密码
  $mysql_database=DB_NAME; 					// 数据库的名字
		
		
  $result = "";
  $cnt = 0;
  $selected = false;
  $model = "model not found";
  $product = "no product";
  $dbTable = "dbTable not found";
  
  if(isset($_POST['debtExport'])) {	//debt collection
	  $dbTable = $_POST['debtExport'];

	  //setup title
	  $product = P_T_DEBT_COLLECTION;
	  
	  //setup sql
	  $strsql=SQL_DEBT_COLLECTION;

	  $selected = true;	//true;
  }
  else if(isset($_POST['creditExport'])) {	//Credit reporting
	  $dbTable = $_POST['creditExport'];

	  //setup title
	  $product = P_T_CREDIT_REPORTING;
	  
	  //setup sql
	  $strsql=SQL_CREDIT_REPORTING;

	  $selected = true;	//true;
  }
  else if(isset($_POST['consumerExport'])) {	//Consumer Loan
	  $dbTable = $_POST['consumerExport'];

	  //setup title
	  $product = P_T_CONSUMER_LOAN;
	  
	  //setup sql
	  $strsql = SQL_CONSUMER_LOAN;	
	  $selected = true;	//true;
  }
  else if(isset($_POST['moneyExport'])) {	//Money Transfers
	  $dbTable = $_POST['moneyExport'];

	  //setup title
	  $product = P_T_MONEY_TRANSFERS;
	  
	  //setup sql
	  $strsql = SQL_MONEY_TRANSFERS;	
	  $selected = true;	//true;
  }
  //add other php	 
  else {
    echo "No table selected!";  
  }
  //echo $dbTable;	//for debug
  
  if($selected == true ) {		
		
	  //judge export model
	  if($dbTable == "t1") {
		$model = "mEXCEL";		
	  }
	  else if($dbTable == "t2") {
		$model = "mPDF";
	  }
	  else if($dbTable == "t3") {
		$model = "mCSV";
	  } 
		//get data for the name of export file
		$savename = date("Y-m-d H:i:s");
		
		if($model == "mHTML") { 	
			// 连接到数据库
			$conn=mysql_connect($mysql_server_name, $mysql_username,$mysql_password);
							
		 	// 从表中提取信息的sql语句
			//$strsql="SELECT $dbField FROM $dbTable";	
		
			// 执行sql查询
			$result=mysql_db_query($mysql_database, $strsql, $conn);
			// 获取查询结果
			$row=mysql_fetch_row($result);	
		 
			echo '<font face="verdana">';
			echo '<table border="1" cellpadding="1" cellspacing="2">';

			// 显示字段名称
			echo "</b><tr></b>";
			for ($i=0; $i<mysql_num_fields($result); $i++)	{
				echo '<td bgcolor="#00FF00"><b>'.
				mysql_field_name($result, $i);
				echo "</b></td></b>";
			}
			echo "</tr></b>";
			// 定位到第一条记录
			mysql_data_seek($result, 0);
			// 循环取出记录
			while ($row=mysql_fetch_row($result)) {
				echo "<tr></b>";
				for ($i=0; $i<mysql_num_fields($result); $i++ )
				{
					echo '<td bgcolor="#FFFFFF">';
					echo $row[$i];
					echo '</td>';
				}
				echo "</tr></b>";
			}
	   
			echo "</table></b>";
			echo "</font>";
		}
		else if($model == "mCSV") { 
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
			//$strsql="SELECT $dbField FROM $dbTable";			
		
			$ALT_Db = @mysql_select_db($mysql_database, $Connect) or die("Couldn't select database"); 
			$result = @mysql_query($strsql,$Connect) or die(mysql_error()); 

			echo("$title\n"); 
			$sep = ","; 
			for ($i = 0; $i < mysql_num_fields($result); $i++) { 
				echo '"' . mysql_field_name($result,$i) . '"' . $sep; 
			}
			print("\n"); 
			$i = 0; 
			while($row = mysql_fetch_row($result)) { 
				$schema_insert = ""; 
				for($j=0; $j<mysql_num_fields($result);$j++) { 
					if(!isset($row[$j])) 
						$schema_insert .= '"' . "" . '"' . $sep; 
					elseif ($row[$j] != "") 
						$schema_insert .= '"' . "$row[$j]" . '"' . $sep; 
					else
						$schema_insert .= '"' . "" . '"' . $sep; 
				}
				$schema_insert = str_replace($sep."$", "", $schema_insert); 
				//$schema_insert .= ","; 
				print(trim($schema_insert)); 
				print "\n"; 
				$i++; 
			}
		}
		else if($model == "mEXCEL") {					
			$Connect = @mysql_connect($mysql_server_name, $mysql_username, $mysql_password) or die("Couldn't connect."); 
			mysql_query("Set Names 'gbk'"); 
			$file_type = "vnd.ms-excel"; 
			$file_ending = "xls"; 
			//header("Content-Type: application/$file_type;charset=big5"); 
			header("Content-Disposition: attachment; filename=".$savename.".$file_ending"); 
			header("Pragma: no-cache"); 

			$now_date = date("Y-m-j H:i:s"); 
			$title = "Product:$product,backup date:$now_date";
			
			// 从表中提取信息的sql语句
			//$strsql="SELECT $dbField FROM $dbTable";			
		
			$ALT_Db = @mysql_select_db($mysql_database, $Connect) or die("Couldn't select database"); 
			$result = @mysql_query($strsql,$Connect) or die(mysql_error()); 

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
		}
		else if($model == "mPDF") {
			// 连接到数据库
			$conn=mysql_connect($mysql_server_name, $mysql_username,$mysql_password);
							
		 	// 从表中提取信息的sql语句
			//$strsql="SELECT $dbField FROM $dbTable";	
		
			// 执行sql查询
			$result=mysql_db_query($mysql_database, $strsql, $conn);
			// 获取查询结果
			$row=mysql_fetch_row($result);	
		 
		    $pdf=new FPDF();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',5);
			
			//display product type
			$pdf->SetFont('','B','5');
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(128);
			$pdf->SetDrawColor(92,92,92);
			$pdf->SetLineWidth(.3);
			$pdf->Write(10,$product);
			$pdf->Ln();
			
			//title
			$pdf->SetFont('','B','5');
			$pdf->SetFillColor(128,128,128);
			$pdf->SetTextColor(255);
			$pdf->SetDrawColor(92,92,92);
			$pdf->SetLineWidth(.3);
			
			// 显示字段名称
			//echo "</b><tr></b>";
			for ($i=0; $i<mysql_num_fields($result); $i++)
			{
				//$pdf->Cell(mysql_field_len($result, $i),7,mysql_field_name($result, $i),1,0,'C',true);	
				$pdf->Cell(30,3,mysql_field_name($result, $i),1,0,'L',true);	
			}
			$pdf->Ln();
			
			//contents
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(128);
			$pdf->SetDrawColor(92,92,92);
			
			//echo "</tr></b>";
			// 定位到第一条记录
			mysql_data_seek($result, 0);
			// 循环取出记录
			while ($row=mysql_fetch_row($result))
			{
				//echo "<tr></b>";
				for ($i=0; $i<mysql_num_fields($result); $i++ )
				{
					//$pdf->Cell(mysql_field_len($result, $i),7,$row[$i],1,0,'L',true);
					$pdf->Cell(30,3,$row[$i],1,0,'L',true);
				}
				//echo "</tr></b>";
				$pdf->Ln();
			}	
			$pdf->Output("$savename.pdf", 'D');
		}			
		
		// 释放资源
		mysql_free_result($result);
		// 关闭连接
		mysql_close($conn);		
  }

?> 