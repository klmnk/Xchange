$(document).ready(function() {
  // Hide the 'cover' div
    console.log("page was loaded");
});


   $( "#logoutBtn" ).click(function() {

       $("#logOutModal").modal('show');

   });


   /*show additional info in Item Details Modal */
   $('.btn-mais-info').on('click', function(event) {
       $( '.open_info' ).toggleClass( "hide" );
   })


   $(".img").on("load",function(){
             console.log("all images were loaded");
       });

   $(function() {

	
	$('#userLabel').html("Welcome, " + userFirstName);

     //Start loading items when first time redirected to main.html
             	$.get('./php/show_home.php', function(data) {
              		 $('#content_frame').html(data);
             	});



     // Handler for .ready() called.
   $("#content_frame").on("click", "#resetPswdBtn", function(){
       $("#password_modal").modal('show');
   });
   $("#content_frame").on("click", "#userImage", function(){
       $("#uploadUserPictureModal").modal('show');
   });
   $("#content_frame").on("click", "#itemImage", function(){
       $("#uploadItemPictureModal").modal('show');
   });
   $("#content_frame").on("click", "#uploadItemBtn", function(){
       $("#confirmUploadItemModal").modal('show');
   });


   });


        function showPage(id)
        {
        	//alert(id);
        	var url = "";
        	if (id == "homePage"){url = './php/show_home.php';}
        	else if(id == "profilePage"){url = './php/show_profile.php?userID='+userName;}
        	else if(id == "favoritesPage"){url = './php/show_favorites.php';}
        	else if(id == "uploadItemPage"){url = './php/show_uploadItem.php';}
          	else if(id == "favoritesPage"){url = './php/show_favorites.php';}
          	else if(id == "myItemsPage"){url = './php/show_myItems.php';}
          	else if(id == "messagesPage"){url = './php/show_messages.php';}


        	$.get(url, function(data) {
         		 $('#content_frame').html(data);
        	});

        }

	//uploadItemImage

        $("#search_button").click(function(){
            var search_string = $("#search_input").val();
            console.log(search_string);
            var url = "./php/search.php?search="+search_string;
             console.log(url);
          $.get(url, function(data) {
             $('#content_frame').html(data);
          });

        });


        function uploadItemImage()
        {
          console.log('in upload Item');

          var input = document.getElementById("uploadItemPictureInput");

          console.log(input.files);

          console.log(input.files[0].type);

          if (input.files && input.files[0]) {

          newItemImage = input.files[0];

          var reader = new FileReader();

          reader.onload = function (e) {
              $('#itemImage').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }

          $('#uploadItemPictureModal').modal('hide');
        }


        function uploadItem()
        {
          var form = document.getElementById('newItemForm');

          form.onsubmit = function(event)
            {
            event.preventDefault();
            }
           var newItemFormData =  new FormData(form);

           newItemFormData.append('image_file', newItemImage, newItemImage.name);

           newItemFormData.append('umbc_id', userName);


	    $.ajax({
		type: 'POST',
		dataType: 'json',
		url: './php/upload_item.php',
		data: newItemFormData,
		cache: false,
		processData: false, // Don't process the files
		contentType: false, // Set content type to false as jQuery will tell the server its a query string request
		success: function(data) {
		          
				     var opts = [];
				     opts.title = "Great!";
		    	   	     opts.text = "New Item was uploaded successfully!";
		                     opts.type = "success";	
				     showMessage(opts);

		}
	    });

        }


	//uploadUserImage
        function uploadUserImage()
        {
          console.log('in upload Item');

          var input = document.getElementById("uploadUserPictureInput");

          console.log(input.files);

          console.log(input.files[0].type);

          if (input.files && input.files[0]) {

          profileImage = input.files[0];

          var reader = new FileReader();

          reader.onload = function (e) {
              $('#userImage').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }

          $('#uploadUserPictureModal').modal('hide');
        }


        function showItemDetails(id)
        {

	  clickedItemID = id;

          $.ajax({
              type: 'POST',
          //  dataType: 'json',
              url: './php/get_item_details.php',
              data: {'item_id':id},
          })
          .done(function(data) {
              // Make sure that the formMessages div has the 'success' class.
   
            //Parse JSON object
          var objData = jQuery.parseJSON(data);

          if(objData.result == 'success')
          {

                  var modalLabel = '<i class="text-muted fa fa-shopping-cart"></i> <strong>' + objData.item_name + '</strong>';
                  $("#myModalLabel").html(modalLabel);
                  var itemDetailsImage = '<img src="'+objData.image_link+'" alt="teste" class="img-thumbnail">';
                  $("#itemDetailsImage").html(itemDetailsImage);
                  $("#itemSoldBy").html(objData.seller);
                  $("#itemCondition").html(objData.condition);
                  $("#itemDescription").html(objData.description);
                  $("#itemManufacturer").html(objData.manufacturer);

                  $("#itemDetailsModal").modal('show');

          }
          else if(objData.result == 'error')
          {
		 var opts = [];
		 opts.title = "Error!";
            	 opts.text = "Error occured when trying to retrieve information";
                 opts.type = "error";	
		 showMessage(opts);
          }


          })
          .fail(function(data) {

              console.log("fail");
              // Set the message text.
          });



        }

	$('#password_modal_save').click(function()
	{

	  var form = document.getElementById('changePasswordForm');

	  form.onsubmit = function(event)
	   {
		event.preventDefault();
	    }

	   var formData =  new FormData();
	  // var formData = $('#changePasswordForm').serialize();

	   var current_password = $('#current_password').val();
	   var new_password = $('#new_password').val();
	   var confirm_password = $('#confirm_password').val();

	   formData.append('current_password',current_password);
	   formData.append('new_password',new_password);
	   formData.append('confirm_password',confirm_password);

	   if(checkPassword(current_password) && checkPassword(new_password) && checkPassword(confirm_password))
	   {
		console.log("passwords are valid");
             if(new_password == confirm_password)
 	     {
		  // Submit the form using AJAX.
		  $.ajax({
		      type: 'POST',
		      dataType: 'json',
		      url: './php/change_password.php',
		      processData: false,
		      contentType: false, // Set content type to false as jQuery will tell the server its a query 
		      data: formData
		  })
		  .done(function(data) {

			if(data.result == 'success')
			{
				 var opts = [];
				 opts.title = "Success!";
				 opts.text = "New password was updated successfully.";
				 opts.type = "success";	
				 showMessage(opts);


			}
		      
		     
		  })
		  .fail(function(data) {

		      console.log("fail");

		  });
	      }
	      else
		{
			 var opts = [];
			 opts.title = "Confirm password is not valid!";
			 opts.text = "Please double check your new password";
		         opts.type = "error";	
			 showMessage(opts,5000);


		}
		
	   }
	   else
	   {
		 var opts = [];
		 opts.title = "Password is not valid!";
		 opts.text = "It should contain\n1 lowercase alphabetical character \n1 uppercase alphabetical character \n1 numeric character \n And must be six characters or longer";
                 opts.type = "error";	
		 showMessage(opts,5000);

	   }
		
		
	});

        function addToFavorites(){

		console.log(clickedItemID);
		var formData =  new FormData();
		formData.append('user_id',userName);
	   	formData.append('item_id',clickedItemID);

		$.ajax({
		      type: 'POST',
		      dataType: 'json',
		      url: './php/add_to_favorites.php',
		      processData: false,
		      contentType: false, // Set content type to false as jQuery will tell the server its a query 
		      data: formData
		  })
		  .done(function(data) {

			if(data.result == 'success')
			{
				 console.log(data.user_id);
				 console.log(data.item_id);

				 var opts = [];
				 opts.text = "Item was added to favorites!";
				 opts.type = "info";	
				 showMessage(opts);

			}
		      
		     
		  })
		  .fail(function(data) {

		      console.log("fail");

		  });

        }

        function contactUser(){
            $('#itemDetailsModal').modal('hide');
              $('#sendMessageModal').modal('show');

        }

	function showMessage(opts, delay = 3000)
	{
		    PNotify.prototype.options.styling = "bootstrap3";
		    PNotify.prototype.options.delay = delay;
		    new PNotify(opts);

	}

	function checkPassword(password)
	{
		var passwordRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})");
		var password_valid = passwordRegex.test(password);
		return password_valid;
	}

