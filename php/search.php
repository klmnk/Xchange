<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $search = $_POST['submit'];

}

//information for connecting to database
$servername = "104.236.58.254";
$username = "umbcxchange";
$password = "umbcxchange";
$DBname = "umbcxchange";


// Create connection to the database
$conn = new mysqli($servername, $username, $password, $DBname);

// Validate the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])){

  
  if(preg_match("/^[  a-zA-Z]+/", $search)){
    $name=$_POST['name'];

    //-query  the database table
    $search_query="SELECT  * FROM Products WHERE item_name LIKE '%" . $name .  "%' OR item_name LIKE '%" . $search ."%'";
    //-run  the query against the mysql query function
    $result=$conn->query($search_query);;

    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
          $item_id  =$row['id'];
          $seller=$row['seller'];
          $description=$row['description'];
          print '<p>' . $item_id . '</p><br>' . '<p> sold by' . $seller . '</p><br>';
        }
    }
  }
  else { echo  "<p>Please enter a search query</p>";  }
  }
?>