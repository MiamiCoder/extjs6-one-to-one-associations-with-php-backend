<?php
ini_set("display_errors", true);
ini_set("html_errors", true);

include "db.php";

$out = "";
$employeeId = "";

if (isset($_REQUEST["id"])) {
	$employeeId = $_REQUEST["id"];
}

$out = GetEmployee($employeeId);

echo utf8_encode($out);

function GetEmployee($employeeId) {
    
	  $retVal = "[]";
	  
	  $sql ="SELECT COUNT(employeeNumber) FROM `classicmodels`.`employees` WHERE employeeNumber = " . $employeeId;
      
      $conn = OpenDbConnection();

	  $result = mysqli_query($conn, $sql); 

	  $row = mysqli_fetch_row($result);
	  
	  $num = $row[0];

	  $sql ="SELECT employeeNumber, lastName, firstName, reportsTo as managerNumber FROM `classicmodels`.`employees` WHERE employeeNumber = " . $employeeId;
	
	     
    $result = mysqli_query($conn, $sql);
	
	$i = 0;   
	
	$employeesData = array("count" => $num, "managers" => array());
	
	while ($row = mysqli_fetch_assoc($result)) {    
		$employeesData["managers"][$i] = $row;    
		$i++;  
	}   
	
	CloseDbConnection($conn); 
	
	return json_encode($employeesData); 
}
?>