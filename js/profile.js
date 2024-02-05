jQuery(document).ready( function($){
    /* Helper function */
    // Profile image
	var $uploadCrop = $('#change-avatar').croppie({
	    viewport: {
	        width: 150,
	        height: 150
	    },
	    boundary: {
            width: 150,
            height: 150
        },
	});
	$uploadCrop.croppie('bind', {
	    url: '../demo/images/avatar.jpg',
	});

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#change-avatar').croppie('bind', {
                    url: e.target.result
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#uploadAvatar').on('change', '.actionUpload', function () { readFile(this); });
    $('#uploadAvatar').on('click', 'a.actionSave', function(e){
        e.preventDefault();
        var uploadValue 	= $('#uploadAvatar #upload.actionUpload').val();
        var employeeID 	= $(this).attr('data-id');
        if( !uploadValue ){
            alert('NO file to upload found!');
            return false;
        }
        $uploadCrop.croppie( 'result', {
            type: 'base64',
            size: {
                width: 128,
                height: 128
            }
        }).then(function ( response ) {
            $.ajax({
                type:"POST",
                data:{
                    action:'change_avatar',
                    imageData: response,
                    employeeID: employeeID
                },
                url: './includes/common/ajax-handler.php',
                beforeSend:function(){
                    //** Proccessing
                    $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
                },
                success:function( response ){
                    location.reload( true );
                    $('body .lds-ellipsis').remove();
                }
            });
        });
    });
});