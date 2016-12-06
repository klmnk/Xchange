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


$items_query = "SELECT * FROM `Wishlisted` WHERE `user_id`=1";

$items = $conn->query($items_query);


if (!$items)
{
    exit('<p> Error: ' . mysql_error() . '</p>');
}

if ($items->num_rows == 0){
    print '<p>Your Wishlist is empty</p>';
}

if ($items->num_rows > 0){

    print '<p><h2>Items in your wishlist</h2></p>';
    while($row = $items->fetch_assoc()) {

        $product_id = $row["product_id"];
        $products_query = "SELECT * FROM `Products` WHERE `id`='$product_id'";
        $wishlisted_products = $conn->query($products_query);

        if (!$wishlisted_products) { exit('<p> Error: ' . mysql_error() . '</p>'); }

        $counter = 1;
        $displayAllProducts = '';

        if ($wishlisted_products->num_rows > 0) 
        {
            while ($row = $wishlisted_products->fetch_assoc()) 
            {

                $displayAllProducts.='
                    <div class="col-md-12"> 
                        <div class="col-md-4">
                            <a onclick="javascript:showItemDetails(this)" >
                                <img src="'.$row["image_link"].'" alt="Moustiers Sainte Marie" style="width:100px">
                                <div class="caption">
                                    <p><h4>'.$row["item_name"].'</h4></p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="caption">
                                <p><h4>'.$row["description"].'</h4></p>
                                <p>Sold by '.$row["seller"].'</p>
                                <button type="button" type="submit" class="btn btn-success pull-left" onclick="contactUser()">Contact User</button>
                            </div>
                        </div>
                    </div>';
              }  // ends While loop

            print $displayAllProducts;
        }
    }
}


// close the connection
$conn->close();

?>
