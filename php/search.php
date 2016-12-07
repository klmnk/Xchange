<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {

  $search = $_GET['search'];
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

if(isset($_GET['search'])){

  
  if(preg_match("/^[  a-zA-Z]+/", $search)){

    //-query  the database table
    $search_query="SELECT  * FROM `Products` WHERE `item_name` LIKE '%$search%'" ;
    //-run  the query against the mysql query function
    $result=$conn->query($search_query);

    $counter = 1;
    $displayAllProducts = '<div class="container">
          <div class="row">
          <div class="col-md-8"><h2>View all items available for barter</h2></div><br>
          </div>';

    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
          $item_name  =$row['item_name'];
          $seller=$row['seller'];
          $description=$row['description'];
        
          if($counter%3 == 1) {  // If number is 1,4,7,etc start a new row
          
            // show category as its own row before each new row
            $displayAllProducts.= '<div class="row">';
          }

          $displayAllProducts.='<div class="col-md-3">
                  <div class="thumbnail">
                      <a id = "'. $row["id"].'"onclick="javascript:showItemDetails(this.id)" >
                        <img src="'.$row["image_link"].'" alt="Moustiers Sainte Marie" style="width:100%">
                    <div class="caption">
                      <p><h4>'.$row["item_name"].'</h4></p>
                      </div>
                  </a>
                  </div></div>';

          if($counter%3 == 0) { // If number is 3,6,9,etc close the row
          
            $displayAllProducts.= "</div>";
          }

          $counter++; // increase the counter to start again

            }  // ends While loop

          if($counter%3 != 0) {

            $displayAllProducts.= "</div>";
          }

          $displayAllProducts .=  '</div>'; //Close container
          print $displayAllProducts;
        }
    }
  }

  else { echo  "<p>Please enter a search query</p>";  }

?>