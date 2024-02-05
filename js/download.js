jQuery(document).ready(function($) {
    // Download Employee
    $('.navbar-nav').on('click', '#download-employee', function(e){
        e.preventDefault();
        $.ajax({
            url: './../includes/common/ajax-handler.php',
            type: "post",
            data: {
                action : 'download-employee',
            },
            beforeSend: function() {
                $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
            },  
            success: function (response) {  
                console.log('Response: '+response );
                window.location= response;
                setTimeout(() => {
                    $('body .lds-ellipsis').remove();
                }, 1000 );
            },
            error: function(jqXHR, textStatus, errorThrown) {
            alert('error');       
            }
        });
    });
    // Download RESUME
    $('#download-resume, .download-user-resume').click(function(){
        var attr = $(this).attr('data-id');
        var userID = 0;
        if (typeof attr !== typeof undefined && attr !== false) {
            userID = $(this).data('id');
        }
        $.ajax({
            url: './../includes/common/ajax-handler.php',
            type: "post",
            // dataType: 'JSON',
            data: {
                action : 'download-resume',
                userID : userID
            },
            beforeSend: function() {
                $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
            },
            success: function (response) {
                console.log( response );
                    $('body .lds-ellipsis').remove();
                    // let $data = JSON.parse(response);
                    // if( $.isEmptyObject($data) ) {
                    //     alert( 'Something went wrong!' );
                    //     return;
                    // } else {
                    //     download_file( $data.file_url, $data.file_name );
                    // }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('body .lds-ellipsis').remove();
                alert(textStatus);
            }
        });
    });

    // Download MEMO
    $('#user-memo-list').on( 'click', '.download-memo', function(){
        var memoID = $(this).attr('data-id');
        $.ajax({
            url: './../includes/common/ajax-handler.php',
            type: "post",
            typeData: 'JSON',
            data: {
                action : 'download-memo',
                memoID : memoID
            },
            beforeSend: function() {
                $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
            },
            success: function (response) {
                $('body .lds-ellipsis').remove();
                console.log( response );
                $data = JSON.parse(response);
                if( $.isEmptyObject($data) ) {
                    alert( 'Something went wrong!' );
                    return;
                } else {
                    download_file( $data.file_url, $data.file_name );
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('error');
            }
        });
    });
    $('#user-memo-list').on('click', '.delete-memo', function(e){
		e.preventDefault();
        var memoID		= $(this).attr('data-id');
        var confirmation = confirm('Are you sure you want to delete this memo?');
        if( confirmation ){
            $.ajax({  
                url: './includes/common/ajax-handler.php',
                type: 'POST',
                data: {
                    action	: 'delete-memo',
                    memoID	: memoID
                },
                beforeSend : function( ){
                    //** before Send
                    $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
                },
                success: function(data) {
                    if( data == 1 ){
                        $('body').prepend('<div class="notification-message alert alert-success">MEMO has been successfully deleted!.</div>');
                        $('#user-memo-list tbody tr#memo-'+memoID).remove();
                    }else{
                        alert( 'Something went while processing your request. Please reload and try again.' )
                    }
                    setTimeout(function(){
                        $('body .notification-message').remove();
                    }, 3000);
                    $('body .lds-ellipsis').remove();
                },
                error: function(log) {
                    console.log(log.message);
                }
            });
        }
	});
    function download_file(fileURL, fileName) {
        // for non-IE
        if (!window.ActiveXObject) {
            var save = document.createElement('a');
            save.href = fileURL;
            save.target = '_blank';
            var filename = fileURL.substring(fileURL.lastIndexOf('/')+1);
            save.download = fileName || filename;
            if ( navigator.userAgent.toLowerCase().match(/(ipad|iphone|safari)/) && navigator.userAgent.search("Chrome") < 0) {
                    document.location = save.href; 
                // window event not working here
                }else{
                    var evt = new MouseEvent('click', {
                        'view': window,
                        'bubbles': true,
                        'cancelable': false
                    });
                    save.dispatchEvent(evt);
                    (window.URL || window.webkitURL).revokeObjectURL(save.href);
                }	
        }
        // for IE < 11
        else if ( !! window.ActiveXObject && document.execCommand)     {
            var _window = window.open(fileURL, '_blank');
            _window.document.close();
            _window.document.execCommand('SaveAs', true, fileName || fileURL)
            _window.close();
        }
    }
});