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

  // Submit the form using AJAX.
  $.ajax({
      type: 'POST',
      url: $(login_form).attr('action'),
      data: loginFormData
  })
  .done(function(response) {
      // Make sure that the formMessages div has the 'success' class.
      console.log("success");
      window.location.href = 'main.html'
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

  // Submit the form using AJAX.
  $.ajax({
      type: 'POST',
      url: $(signup_form).attr('action'),
      data: signupFormData
  })
  .done(function(response) {
      // Make sure that the formMessages div has the 'success' class.
      alert("Welcome to UMBC Xchange! \n Please Log In.");
      console.log("success");
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

});
