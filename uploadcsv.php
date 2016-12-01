<?php

//database connection details
$connect = mysqli_connect("localhost","root","fifi");

if (!$connect) {
 die('Could not connect to MySQL: ' . mysql_error());
}

//your database name
$selectDB =mysqli_select_db($connect,"csv_upload");

// path where your CSV file is located
define('CSV_PATH','/home/fifi/Downloads/');

// Name of your CSV file
$csv_file = CSV_PATH . "dummyCompanyData2.csv"; 


if (($file_handler = fopen($csv_file, "r")) !== FALSE) {
   fgetcsv($file_handler);   
   while (($data = fgetcsv($file_handler, 1000, ",")) !== FALSE) {
        $num = count($data);
        for ($count=0; $count < $num; $count++) {
          $col[$count] = $data[$count];
        }

 $name 			= $col[0];
 $legal_name 	= $col[1];
 $address 		= $col[2];
 $city 			= $col[3];
 $state 		= $col[4];
 $phone			= $col[5];
 $email 		= $col[6];
 
   
// SQL Query to insert data into DataBase
$query = "INSERT INTO companies2(name, legal_name, address, city, state, phone, email ) VALUES('".$name."','".$legal_name."','".$address."','".$city."','".$state."','".$phone."','".$email."')";
$s     = mysqli_query($connect, $query);

 }
    fclose($file_handler);
}

echo "File data successfully imported to database!!";
mysqli_close($connect);
?>
