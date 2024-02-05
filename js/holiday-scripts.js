jQuery(document).ready(function($){
	$('#addHoliday-form').on('submit', function( e ){
        e.preventDefault();
        var holiday_type  = $('#addHoliday-form #holiday_type').val();
        var holidayDate   = $('#addHoliday-form #holidayDate').val();
        var holiday_title   = $('#addHoliday-form #holiday_title').val();
        $.ajax({
            url: './includes/common/ajax-handler.php',
            type: "post",
            data: {
                action : 'add-holiday',
                holidayType : holiday_type, 
                holidayDate : holidayDate,
                holiday_title : holiday_title,
            },
            beforeSend: function() {
                $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
            },
            success: function (response) {
                $('body .lds-ellipsis').remove();
                $( "#addHolidayModal" ).modal('toggle');
                if( response >= 1 ){
                    $('body').prepend('<div class="notification-message alert alert-success">New Holiday has been Added.</div>');
                    location. reload();
                }else{
                    $('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again. Note: It must have only one holiday in a day.</div>');
                }
                setTimeout(function(){
                    $('body .notification-message').remove();
                }, 1500);
            },
            error: function(jqXHR, textStatus, errorThrown) {
               alert('error');
            }
        });
    });

    $('#updateHoliday-form').on('submit', function( e ){
        e.preventDefault();
        var holiday_type  = $('#updateHoliday-form #holiday_type').val();
        var holidayID   = $('#updateHoliday-form #holidayID').val();
        var holiday_title   = $('#updateHoliday-form #holiday_title').val();
        $.ajax({
            url: './includes/common/ajax-handler.php',
            type: "post",
            data: {
                action : 'update-holiday',
                holidayType : holiday_type,
                holidayID : holidayID,
                holiday_title : holiday_title,
            },
            beforeSend: function() {
                $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
            },
            success: function (response) {
                $( "#updateHolidayModal" ).modal('toggle');
                $('body .lds-ellipsis').remove();
                if( response >= 1 ){
                    $('body').prepend('<div class="notification-message alert alert-success">Holiday has been Updated.</div>');
                    location. reload();
                }else{
                    $('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
                }
                setTimeout(function(){
                    $('body .notification-message').remove();
                }, 1500);
            },
            error: function(jqXHR, textStatus, errorThrown) {
               alert('error');
            }
        });
    });

    $('#updateHoliday-form').on('click', '#deleteHoliday', function(){
        var holidayID = $(this).attr('data-id');
        var confirmation = confirm('Are you sure you want to delete this Holiday?');
        if( confirmation ){
            $.ajax({
                url: './includes/common/ajax-handler.php',
                type: "post",
                data: {
                    action : 'delete-holiday',
                    holidayID : holidayID
                },
                beforeSend: function() {
                    $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
                },
                success: function (response) {
                    $( "#updateHolidayModal" ).modal('toggle');
                    $('body .lds-ellipsis').remove();
                    if( response >= 1 ){
                        $('body').prepend('<div class="notification-message alert alert-success">Holiday has been Deleted.</div>');
                        location. reload();
                    }else{
                        $('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again. Note: It must have only one holiday in a day.</div>');
                    }
                    setTimeout(function(){
                        $('body .notification-message').remove();
                    }, 1500);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   alert('error');
                }
            });
        }
    });
});