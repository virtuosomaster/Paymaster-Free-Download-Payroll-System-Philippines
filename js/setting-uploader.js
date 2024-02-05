jQuery(document).ready( function($){

    // Company Logo
    var $uploadCropCompanyLogo = $('#change-companyLogo').croppie({
        viewport: {
            width: 210,
            height: 60
        },
        boundary: {
            width: 210,
            height: 60
        },
    });
    $uploadCropCompanyLogo.croppie('bind', {
        url: './images/company-logo-default.png',
        // points: [77,469,280,739]
    });

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#change-companyLogo').croppie('bind', {
                    url: e.target.result
                });
                // $('.actionUpload').toggle();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#uploadCompanyLogo').on('change', '.actionUpload', function () { readFile(this); });
    $('#uploadCompanyLogo').on('click', 'a.actionSave',function(e){
        e.preventDefault();
        var uploadValue     = $('#uploadCompanyLogo #upload.actionUpload').val();
        if( !uploadValue ){
            alert('NO file to upload found!');
            return false;
        }
        $uploadCropCompanyLogo.croppie( 'result', {
            type: 'base64',
            size: {
                width: 210,
                height: 60
            }
        }).then(function ( response ) {
            $.ajax({
                type:"POST",
                data:{
                    action:'change_company_logo',
                    imageData: response,
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