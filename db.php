 <?php 
function OpenDbConnection() {


  $dbhost = 'localhost:3306';
  $dbuser = 'root';
  $dbpass = 'root';
  $dbname = 'classicmodels';
  
  

  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  if (!$conn) {
    echo( "Unable to connect to the database server." );
    exit();
  }

  //mysql_select_db($dbname) or die( "Error selecting database.");

  return $conn;
}

function CloseDbConnection($conn) {
  mysqli_close($conn);
}
?>