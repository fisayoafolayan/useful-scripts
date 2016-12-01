<?php

//database connection details
$connect = mysqli_connect("localhost","root","[PASSSWORD]");

if (!$connect) {
 die('Could not connect to MySQL: ' . mysql_error());
}

//your database name
$selectDB =mysqli_select_db($connect,"csv_upload");

// path where your CSV file is located
define('CSV_PATH','path/to/file');

// Name of your CSV file
$csv_file = CSV_PATH . "dummydata.csv"; 


if (($file_handler = fopen($csv_file, "r")) !== FALSE) {
   fgetcsv($file_handler);   
   while (($data = fgetcsv($file_handler, 1000, ",")) !== FALSE) {
        $num = count($data);
        for ($count=0; $count < $num; $count++) {
          $col[$count] = $data[$count];
        }

 $variableName1 		= $col[0];
 $variableName2 		= $col[1];
 $variableName3 		= $col[2];
 $variableName4 		= $col[3];
 $variableName5 		= $col[4];

 
   
// SQL Query to insert data into DataBase
$query = "INSERT INTO tableName(col1, col2, col3, col4, col5 ) VALUES('".$variableName1."','".$variableName2."','".$variableName3."','".$variableName4."','".$variableName5."')";
$s     = mysqli_query($connect, $query);

 }
    fclose($file_handler);
}

echo "File data successfully imported to database!!";
mysqli_close($connect);
?>
