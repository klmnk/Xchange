<?php
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

$items_query = "SELECT * FROM `Products` ORDER BY category";
$items = $conn->query($items_query);

if (!$items) 
{  
    exit('<p> Error: ' . mysql_error() . '</p>');  
}  

// due to time constraints hard-coded for the demo/testing purpose
$counter = 1;
$displayAllProducts = "";
//$displayAllProducts .= "<table>";
if ($items->num_rows > 0) 
{
    // print out items 3 in a row
    while($row = $items->fetch_assoc()) 
    {

	//print_r($row);	

	if($counter%3 == 1)  // If number is 1,4,7,etc start a new row
	{  
	// show category as its own row before each new row
	$displayAllProducts.= "<td><table><tr><td><h2>" . $row["category"] . "</h2></td></tr></table></td>";
	$displayAllProducts.= "<tr>";
	}
	
	$displayAllProducts.=
	    "
		<td>    
		<table>  
		<tr><td><center>" . "<b>" . $row['item_name'] . "</b>" . "</center></td></tr>" .
		"<tr><td colspan ='2'><div><img src=" . "'" . $row["image_link"] . "'" . " width = '200' height = '200'" . "id="."'".$row["id"]."'"."></div></td></tr>
		</table> 
		</td>  
	     ";
	
	// add spaces between items in a row     
	$displayAllProducts.= "<td><table><tr><td><h2>"."<pre>"."      "."</pre>"."</h2></td></tr></table></td>";
	
	if($counter%3 == 0) // If number is 3,6,9,etc close the row
	{   
		$displayAllProducts.= "<td><table><tr><td> <a href='#'>see more in this category</a></td></tr></table></td>";
		$displayAllProducts.= "</tr>";
	}

	$counter++; // increase the counter to start again
	
	}  // ends the loop

	if($counter%3 != 0)
	{
		$displayAllProducts.= "</tr>";	
	}
	

	echo "<table>";
	echo $displayAllProducts;
	echo "</table>";
    }


// close the connection
$conn->close();

?>
