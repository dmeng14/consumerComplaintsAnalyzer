 <?php
    echo "Project 4</br>"; 
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
		echo 'Connected successfully';
                        
     // sql command
    $strsql="call countIssues('Debt collection')";
    // run sql command
    $result=mysql_db_query($mysql_database, $strsql, $conn);
    // fetch sql result
    $row=mysql_fetch_row($result);
    
     
    echo '<font face="verdana">';
    echo '<table border="1" cellpadding="1" cellspacing="2">';

    // ��ʾ�ֶ�����
    echo "</b><tr></b>";
    for ($i=0; $i<mysql_num_fields($result); $i++)
    {
      echo '<td bgcolor="#00FF00"><b>'.
      mysql_field_name($result, $i);
      echo "</b></td></b>";
    }
    echo "</tr></b>";
    // ��λ����һ����¼
    mysql_data_seek($result, 0);
    // ѭ��ȡ����¼
    while ($row=mysql_fetch_row($result))
    {
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
    // �ͷ���Դ
    mysql_free_result($result);
    // �ر�����
    mysql_close($conn);  
?>
