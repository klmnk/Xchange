
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {

  $userID = $_GET['userID'] . "@umbc.edu";

}
else{
  exit();
}

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
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

// temporarily hard-coded
$user_query = "SELECT * FROM  `Users` WHERE  `umbcid` = '$userID'";
$user = $conn->query($user_query);

if (!$user) {  exit('<p> Error: ' . mysql_error() . '</p>'); }

if ($user->num_rows > 0)
{
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
    }

}

$conn->close(); // close the connection
?>

<!-- Container for user details -->
<div class="container">
<legend>Account information</legend>
<div class="row">

  <div class="col-md-3">
  <div class="card" >
    <img src="./images/img_avatar.png" id="userImage" alt="Avatar" style="width:100%">
    <div class="container">
      <h4><b><?php echo $firstname . ' ' . $lastname ;?></b></h4>
<!--       <p>registred since <?php echo $user_since;?></p> -->
<!--       <p>last online     <?php echo $user_since;?></p> -->
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
  <label class="col-md-4 control-label" for="basicdetails_duration">Registered since</label>
  <div class="col-md-4">
    <input id="basicdetails_duration" name="basicdetails_duration" type="text" placeholder="<?php echo $user_since;?>" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="basicdetails_duration">Last online</label>
  <div class="col-md-4">
    <input id="basicdetails_duration" name="basicdetails_duration" type="text" placeholder="<?php echo $user_since;?>" class="form-control input-md">
  </div>
</div><br>

  <div class="form-group">
    <div class="row">
      <div class="col-md-5 col-md-offset-3">
        <button type="button" id="resetPswdBtn" class="btn btn-default"><span class="glyphicon glyphicon-lock"></span> Reset Password</button>
        <button type="button" id="uploadItemBtn" class="btn btn-success col-md-offset-1"> Apply Changes </button>
      </div>
    </div>
  </div>
</div> <!-- end of user details div -->
</div> <!-- end of row -->

</fieldset>
</form>
</div>
