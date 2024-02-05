jQuery(document).ready(function() {

  // fire ajax when 13th month form is submitted

  $('#generate-thirteenth-form').on('submit', function(e) {
    e.preventDefault();
    let form = $(this);
    $.ajax({
      type: 'post',
      url: './includes/common/ajax-handler.php',
      data: {
        formData : form.serialize(),
        action: 'add-new-thirteenth',
      },
      beforeSend: function() {
        $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
      },
      success: function (response) {
				$('body .lds-ellipsis').remove();
				var errors = JSON.parse(response);
				if( errors.length > 0 ){
					$('body').prepend('<div class="payroll notification-message alert alert-danger" style="width: 100%; height: 100%; background-color: #f8d7dad9;"><div id="error-wrapper" style="padding:18px;background-color:#fff;"><h3>Errors List</h3></div></div>');
					if( errors.length > 1 ){
						$( 'body .notification-message #error-wrapper' ).append('<p>13th Month successfully saved, but the following Employee is not save to report.</p>');
					}
					$.each( errors, function( index, $value ){
						$( 'body .notification-message #error-wrapper' ).append('<p><strong>'+$value+'</strong></p>');
					});
					if( errors.length > 1 ){
						$( 'body .notification-message #error-wrapper' ).append('<p>Please create a new 13th month for all the listed Employee.</p>');
					}
					$( 'body .notification-message #error-wrapper' ).append('<button class="btn btn-primary" id="agree">Continue</button>');
				}else{
					$('body').prepend('<div class="payroll notification-message alert alert-success"><h3>13th Month report successfully saved!</h3></div>');
					setTimeout(function(){
						$('body .notification-message').remove();
					}, 3000);
				}

			},
			error: function(jqXHR, textStatus, errorThrown) {
			   alert('error');
			}
    });
  });
	
});