
<?php
//information for connecting to database
$servername = "104.236.58.254";
$username = "umbcxchange";
$password = "umbcxchange";
$DBname = "umbcxchange";
$row = "";

$firstname = "";
$lastname = "";
$ID = "";
$user_since = "";
$rating = "";
$purchased = "";
// Create connection to the database
$conn = new mysqli($servername, $username, $password, $DBname);

// Validate the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// temporarily hard-coded
$user_query = "SELECT * FROM  `Users` WHERE  `id` = 0";
$user = $conn->query($user_query);

if (!$user)
{
    exit('<p> Error: ' . mysql_error() . '</p>');
}

if ($user->num_rows > 0)
{
    // print out items 3 in a row
    while($row = $user->fetch_assoc())
    {

		$firstname = $row["firstname"] ;
		$lastname = $row["lastname"] ;
		$ID =  $row["umbcid"];
		$user_since = $row["register_date"];
    $last_login = $row["last_login_date"];
		$rating = $row["rating"];
    $purchased = $row["products_bought"];
    $sold = $row["products_sold"];
	/*
		echo "<ul>" . "<pre>";
		echo "firstname:  "  . $row["firstname"] . "<br><br>";
		echo "lastname:   "  . $row["lastname"] . "<br><br>";
		echo "UMBC ID:    "  . $row["umbcid"] . "<br><br>";
		echo "user since: "  . $row["register_date"] . "<br><br>";
		echo "rating:     "  . $row["rating"] . "<br><br>";
		echo "purchased:  0 purchases on record" . "<br><br>";
		echo "sold:       0 items sold" . "<br><br>";
		echo "</ul>" . "</pre>";
	*/
    }

}
// close the connection
$conn->close();
?>

<!-- Container for user details -->
<div class="container">
<legend>User Details</legend>
<div class="row">

  <div class="col-md-3">
  <div class="card" >
    <img src="./images/img_avatar.png" id="userImage" alt="Avatar" style="width:100%">
    <div class="container">
      <h4><b><?php echo $firstname . ' ' . $lastname ;?></b></h4>
      <p>registred since <?php echo $user_since;?></p>
      <p>last online     <?php echo $user_since;?></p>
    </div>
  </div>
</div>

  <div class="col-md-8"> <!-- form column -->
  <form class="form-horizontal">
  <fieldset>
  <!-- Form Name -->

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="basicdetails_caption">First Name</label>
  <div class="col-md-4">
  <input id="basicdetails_caption" name="basicdetails_caption" type="text" placeholder="<?php echo $firstname;?>" class="form-control input-md" >

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="basicdetails_duration">Last Name</label>
  <div class="col-md-4">
  <input id="basicdetails_duration" name="basicdetails_duration" type="text" placeholder="<?php echo $lastname;?>" class="form-control input-md">

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="basicdetails_duration">UMBC ID</label>
  <div class="col-md-4">
  <input id="basicdetails_duration" name="basicdetails_duration" type="text" placeholder="<?php echo $ID;?>" class="form-control input-md">

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="basicdetails_duration">Rating</label>
  <div class="col-md-4">
  <input id="basicdetails_duration" name="basicdetails_duration" type="text" placeholder="<?php echo $rating;?>" class="form-control input-md">

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="basicdetails_duration">User since</label>
  <div class="col-md-4">
  <input id="basicdetails_duration" name="basicdetails_duration" type="text" placeholder="<?php echo $user_since;?>" class="form-control input-md">

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="basicdetails_duration">Purchased</label>
  <div class="col-md-4">
  <input id="basicdetails_duration" name="basicdetails_duration" type="text" placeholder="<?php echo $purchased;?>" class="form-control input-md">

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="basicdetails_duration">Sold</label>
  <div class="col-md-4">
  <input id="basicdetails_duration" name="basicdetails_duration" type="text" placeholder="<?php echo $sold;?>" class="form-control input-md">

  </div>
</div>
<!--
		echo "user since: "  . $row["register_date"] . "<br><br>";
		echo "rating:     "  . $row["rating"] . "<br><br>";
		echo "purchased:  0 purchases on record" . "<br><br>";
		echo "sold:       0 items sold" . "<br><br>";
-->



<!-- Select Basic
<div class="form-group">
  <label class="col-md-4 control-label" for="basicdetails_quality">UMBC ID</label>
  <div class="col-md-4">
    <select id="basicdetails_quality" name="basicdetails_quality" class="form-control">
      <option value="1">Option one</option>
      <option value="2">Option two</option>
    </select>
  </div>
</div>
 -->
  <div class="form-group">
    <div class="row">
      <div class="col-md-4 col-md-offset-5">
        <button type="button" id="resetPswdBtn" class="btn btn-default"><span class="glyphicon glyphicon-lock"></span> Reset Password</button>
      </div>
    </div>
  </div>
</div> <!-- end of user details div -->
</div> <!-- end of row -->

</fieldset>
</form>
</div>
