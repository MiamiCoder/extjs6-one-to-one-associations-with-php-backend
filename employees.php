<?php
ini_set("display_errors", true);
ini_set("html_errors", true);

include "db.php";

$out = "";
$filterJson = "";
$filter = "";
$start = 0;
$limit = 0;

if (isset($_REQUEST["start"]) && $_REQUEST["start"] != "") {
	$start = $_REQUEST["start"];
}
if (isset($_REQUEST["limit"])) {
	$limit = $_REQUEST["limit"];
}

if (isset($_REQUEST["filter"])) {
	$filterJson = $_REQUEST["filter"];
    $filter = json_decode($filterJson);
}

$out = GetEmployees($filter, $start, $limit);

echo utf8_encode($out);

function GetEmployees($filter, $start, $limit) {
    
	  $retVal = "[]";
	  
	  $sql ="SELECT COUNT(employeeNumber) FROM `classicmodels`.`employees`";
      
      if ($filter != "") {  
        $property = $filter[0]->property;
        $sql .= " WHERE $property = " . $filter[0]->value;
      }
      
      if ($limit != 0) {  
        $sql .= " LIMIT " . $start . ", " . $limit;
      }
      
      $conn = OpenDbConnection();

	  $result = mysqli_query($conn, $sql); 

	  $row = mysqli_fetch_row($result);
	  
	  $num = $row[0];

	  $sql ="SELECT employeeNumber, lastName, firstName, reportsTo as managerNumber FROM `classicmodels`.`employees`";
	
	 if ($filter != "") {  
        $property = $filter[0]->property;
        $sql .= " WHERE $property = " . $filter[0]->value;
      }
      
      if ($limit != 0) {  
        $sql .= " LIMIT " . $start . ", " . $limit;
      }
    
    $result = mysqli_query($conn, $sql);
	
	$i = 0;   
	
	$employeesData = array("count" => $num, "employees" => array());
	
	while ($row = mysqli_fetch_assoc($result)) {    
		$employeesData["employees"][$i] = $row;    
		$i++;  
	}   
	
	CloseDbConnection($conn); 
	
	return json_encode($employeesData); 
}
?>