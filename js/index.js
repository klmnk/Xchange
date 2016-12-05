$('.form').find('input, textarea').on('keyup blur focus', function (e) {

  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight');
			} else {
		    label.removeClass('highlight');
			}
    } else if (e.type === 'focus') {

      if( $this.val() === '' ) {
    		label.removeClass('highlight');
			}
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

$('.tab a').on('click', function (e) {

  e.preventDefault();

  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');

  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();

  $(target).fadeIn(600);

});

// A $( document ).ready() block.
$( document ).ready(function() {
  // Get the form.
var login_form = $('#login_form');


// Set up an event listener for the contact form.
$(login_form).submit(function(e) {
  // Stop the browser from submitting the form.
  e.preventDefault();

  // Serialize the form data.
  var loginFormData = $(login_form).serialize();

	console.log("In login submit");	

  // Submit the form using AJAX.
  $.ajax({
      type: 'POST',
      dataType: 'json',	
      url: $(login_form).attr('action'),
      data: loginFormData
  })
  .done(function(data) {
      // Make sure that the formMessages div has the 'success' class.
	if(data.result == 'success')
	{
	      	console.log(data.cookie_name);
	       	console.log(data.cookie_value);
		
	   //   window.location.href = 'main.html'
		$("#cookie_name").val(data.cookie_name);
		$("#cookie_value").val(data.cookie_value);
		$("#submitUserForm").submit();
		
	}
	else if(data.result == 'user was not found')
	{
		$('#userNotFound').show();
	}
	else if(data.result == 'password does not match')
	{
		$('#wrongPassword').show();
	}
 
  })
  .fail(function(data) {

      console.log("fail");
      // Set the message text.
	/*
      if (data.responseText !== '') {
          $(formMessages).text(data.responseText);
      } else {
          $(formMessages).text('Oops! An error occured and your message could not be sent.');
      }
	*/
  });

});


var signup_form = $('#signup_form');

// Set up an event listener for the contact form.
$(signup_form).submit(function(e) {
  // Stop the browser from submitting the form.
  e.preventDefault();

  // Serialize the form data.
  var signupFormData = $(signup_form).serialize();

  var valid = validate_form();


 if(valid){

 console.log("form is valid continue");

  // Submit the form using AJAX.
  $.ajax({
      type: 'POST',
      dataType: 'json',
      url: $(signup_form).attr('action'),
      data: signupFormData
  })
  .done(function(data) {

	if(data.result == 'success')
	{
		$('#userWasCreated').show();

	}
	else if(data.result == 'User already exist')
	{
		$('#userAlreadyexists').show();
		

	}
      // Make sure that the formMessages div has the 'success' class.
      
     
  })
  .fail(function(data) {

      console.log("fail");
      // Set the message text.
      /*
      if (data.responseText !== '') {
          $(formMessages).text(data.responseText);
      } else {
          $(formMessages).text('Oops! An error occured and your message could not be sent.');
      }
	*/
  });

}//valid

});

});

function validate_form()
{
	//Get form elements
	var first_name = $("#signup_form input[name=first_name]").val();
	var last_name = $("#signup_form input[name=last_name]").val();
	var email = $("#signup_form input[name=email]").val();
	var password = $("#signup_form input[name=password]").val();

	//Regex
	var emailRegex = new RegExp("@umbc.edu");
	var valid_umbc_email = emailRegex.test(email);
	
	var passwordRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})");
	var password_valid = passwordRegex.test(password);


	if(!valid_umbc_email)
	{
		alert("Email address does not belong to UMBC");
		return false;
		
	}

	if(!password_valid )
	{
		alert("Password is not valid!\nIt should contain\n1 lowercase alphabetical character \n1 uppercase alphabetical character \n1 numeric character \n And must be six characters or longer");
		return false;
		
	}

	
	return true;
	

}

