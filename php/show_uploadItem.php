<?php
?>

<!-- Container for user details -->
<div class="container">
<legend>Upload New Item</legend>
<div class="row">

  <div class="col-md-3">
  <div class="card" >
    <img src="./images/add_item.png" id="itemImage" alt="Avatar" style="width:100%">
    <div class="container">
      <h4><b>Add Item Picture</b></h4>
    </div>
  </div>
</div>

  <div class="col-md-8"> <!-- form column -->
  <form class="form-horizontal" id="newItemForm" METHOD=post action="./php/upload_item.php">
  <fieldset>
  <!-- Form Name -->

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="itemName">Item Name</label>
  <div class="col-md-4">
    <input id="itemName" name="item_name" type="text" placeholder="Item Name" class="form-control input-md" >
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="itemManufacturer">Manufacturer</label>
  <div class="col-md-4">
    <input id="itemManufacturer" name="item_manufacturer" type="text" placeholder="Item Manufacturer" class="form-control input-md" >
  </div>
</div>

<!--
<div class="form-group">
<label class="col-md-4 control-label" for="selectCategory">Select Category</label>
<div class="col-md-4">
  <select class="form-control" id="selectCategory">
    <option>Books</option>
    <option>Electronics</option>
    <option>Food</option>
    <option>Serives</option>
    <option>Other</option>
  </select>
</div>
</div>
-->
<div class="form-group">
  <label for="description" class="col-sm-4 control-label">Description</label>
  <div class="col-md-6">
    <textarea class="form-control" rows=6" name="description"></textarea>
  </div>
</div>
</br>
  <div class="form-group">
    <div class="row">
      <div class="col-md-4 col-md-offset-8">
        <button type="button" id="uploadItemBtn" class="btn btn-success"> Upload Item</button>
      </div>
    </div>
  </div>
</div> <!-- end of user details div -->
</div> <!-- end of row -->

</fieldset>
</form>
</div>
