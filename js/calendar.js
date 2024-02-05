jQuery(document).ready( function( $ ){
    $('#addUserLeave-form').on('submit', function( e ){
        e.preventDefault();
        var userID      = $('#addUserLeave-form #userID').val();
        var leave_type  = $('#addUserLeave-form #user_leave').val();
        var leaveDate   = $('#addUserLeave-form #leaveDate').val();
        $.ajax({
            url: './includes/common/ajax-handler.php',
            type: "post",
            data: {
                action : 'add-leave',
                userID : userID,
                leave_type : leave_type, 
                leaveDate : leaveDate,
            },
        beforeSend: function() {
            $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        },  
        success: function (response) {  
            $( "#userLeaveModal" ).modal('toggle');
            $('body .lds-ellipsis').remove();
            if( response >= 1 ){
                $('body').prepend('<div class="notification-message alert alert-success">Employee has been updated.</div>');    
                location.reload();              
            }else{
                $('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
            }   
            setTimeout(function(){
                    $('body .notification-message').remove();
                }, 3000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           alert('error');       
        }
        });
    });
    // Apply LEAVE
    $('#applyUserLeave-form').on('submit', function( e ){
        e.preventDefault();
        var leave_type  = $('#applyUserLeave-form #user_leave').val();
        var leaveDate   = $('#applyUserLeave-form #leaveDate').val();
        var am_pm   = $('#applyUserLeave-form #am_pm').val();
        $.ajax({
            url: './includes/common/ajax-handler.php',
            type: "post",
            data: {
                action : 'apply-leave',
                leave_type : leave_type, 
                leaveDate : leaveDate,
                am_pm : am_pm
            },
        beforeSend: function() {
            $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        },  
        success: function (response) {  
            $( "#userLeaveModal" ).modal('toggle');
            $('body .lds-ellipsis').remove();
            if( response >= 1 ){
                $('body').prepend('<div class="notification-message alert alert-success">Employee has been updated.</div>');    
                location.reload();              
            }else{
                $('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
            }   
            setTimeout(function(){
                    $('body .notification-message').remove();
                }, 3000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           alert('error');       
        }
        });
    });
    // Update Leave
    $('#updateUserLeave-form').on('submit', function( e ){
        e.preventDefault();
        var leave_type  = $('#updateUserLeave-form #user_leave').val();
        var leaveID     = $('#updateUserLeave-form #leaveID').val();
        var am_pm     = $('#updateUserLeave-form #am_pm').val();
        $.ajax({
            url: './includes/common/ajax-handler.php',
            type: "post",
            data: {
                action : 'update-leave',
                leaveType : leave_type, 
                leaveID: leaveID,
                am_pm: am_pm
            },
        beforeSend: function() {
            $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        },  
        success: function (response) {  
            $( "#updateLeaveModal" ).modal('toggle');
            if( response >= 1 ){
                $('body').prepend('<div class="notification-message alert alert-success">Employee has been updated.</div>'); 
                location.reload();             
            }else{
                $('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
            }   
            
        },
        error: function(jqXHR, textStatus, errorThrown) {
           alert('error');       
        }
        });
    });
    // Delete Leave
    $('#updateUserLeave-form').on('click', '#deleteLeave', function( e ){
        e.preventDefault();
        var leaveID      = $(this).attr('data-id');
        console.log( leaveID );
        var deleteConfirm   = confirm( 'Are you sure you want to delete Leave?' );
        if( deleteConfirm ){
            $.ajax({
                url: './includes/common/ajax-handler.php',
                type: "post",
                data: {
                    action : 'delete-leave',
                    leaveID : leaveID,
                },
            beforeSend: function() {
                $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
            },  
            success: function (response) { 
                console.log( response );
                $( "#updateLeaveModal" ).modal('toggle');
                $('body .lds-ellipsis').remove();
                if( response >= 1 ){
                    $('body').prepend('<div class="notification-message alert alert-success">Leave has been Deleted.</div>');
                    location.reload();                
                }else{
                    $('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
                }   
                setTimeout(function(){
                    $('body .notification-message').remove();
                }, 3000);
            },
            error: function(jqXHR, textStatus, errorThrown) {
               alert('error');       
            }
            });
        }
    });
    // Request Schedule Script
    $('#addUserSchedule-form').on('submit', function( e ){
        e.preventDefault();
        var userID      = $('#addUserSchedule-form #userID').val();
        var schedule  = $('#addUserSchedule-form #schedule').val();
        var scheduleDate   = $('#addUserSchedule-form #scheduleDate').val();

        $.ajax({
            url: './includes/common/ajax-handler.php',
            type: "post",
            data: {
                action : 'add-request-schedule',
                userID : userID,
                schedule : schedule, 
                scheduleDate : scheduleDate,
            },
        beforeSend: function() {
            $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        },  
        success: function (response) { 
            $( "#userLeaveModal" ).modal('toggle');
            $('body .lds-ellipsis').remove();
            if( response >= 1 ){
                $('body').prepend('<div class="notification-message alert alert-success">Requested schedule has been Added.</div>');
                location.reload();                
            }else{
                $('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
            }   
            setTimeout(function(){
                $('body .notification-message').remove();
            }, 3000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           alert('error');       
        }
        });
    });
    // Apply Overtime
    $('#applyUserOvertime-form').on('submit', function( e ){
        e.preventDefault();
        var overtimeDate   = $('#applyUserOvertime-form #overtimeDate').val();
        var timeStart   = $('#applyUserOvertime-form #time-start').val();
        var timeEnd   = $('#applyUserOvertime-form #time-end').val();
        var notes   = $('#applyUserOvertime-form #notes').val();
        if( timeStart == '' && timeEnd == '' && notes == '' ){
            alert( 'Please fill all fields.' );
        }
        $.ajax({
            url: './includes/common/ajax-handler.php',
            type: "post",
            typeData: 'JSON',
            data: {
                action : 'apply-overtime',
                overtimeDate : overtimeDate,
                timeStart : timeStart,
                timeEnd : timeEnd,
                notes : notes
            },
        beforeSend: function() {
            $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        },  
        success: function (response) { 
            console.log(response) 
            var obj = JSON.parse( response );
            $( "#userApplicationModal" ).modal('toggle');
            $('body .lds-ellipsis').remove();
            if( obj.result >= 1 ){
                $('body').prepend('<div class="notification-message alert alert-success">'+obj.message+'</div>');  
                setTimeout(function(){
                    location.reload(); 
                }, 2000);           
            }else{
                $('body').prepend('<div class="notification-message alert alert-danger">'+obj.message+'</div>');
            }   
            setTimeout(function(){
                $('body .notification-message').remove();
            }, 3000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           alert('error');       
        }
        });
    });
    // Update Schedule 
    $('#updateSchedule-form').on('submit', function( e ){
        e.preventDefault();
        var scheduleID      = $('#updateSchedule-form #scheduleID').val();
        var schedule  = $('#updateSchedule-form #schedule').val();

        $.ajax({
            url: './includes/common/ajax-handler.php',
            type: "post",
            data: {
                action : 'update-request-schedule',
                scheduleID : scheduleID,
                schedule : schedule, 
            },
        beforeSend: function() {
            $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        },  
        success: function (response) { 
            $( "#updateScheduleModal" ).modal('toggle');
            $('body .lds-ellipsis').remove();
            if( response >= 1 ){
                $('body').prepend('<div class="notification-message alert alert-success">Requested schedule has been updated.</div>');
                location.reload();                
            }else{
                $('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
            }   
            setTimeout(function(){
                $('body .notification-message').remove();
            }, 3000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           alert('error');       
        }
        });
    });
    $('#updateSchedule-form').on('click', '#deleteSchedule', function( e ){
        e.preventDefault();
        var scheduleID      = $(this).attr('data-id');
        var deleteConfirm   = confirm( 'Are you sure you want to delete schedule?' );
        if( deleteConfirm ){
            $.ajax({
                url: './includes/common/ajax-handler.php',
                type: "post",
                data: {
                    action : 'delete-request-schedule',
                    scheduleID : scheduleID,
                },
            beforeSend: function() {
                $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
            },  
            success: function (response) { 
                console.log( response );
                $( "#updateScheduleModal" ).modal('toggle');
                $('body .lds-ellipsis').remove();
                if( response >= 1 ){
                    $('body').prepend('<div class="notification-message alert alert-success">Requested schedule has been Deleted.</div>');
                    location.reload();                
                }else{
                    $('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
                }   
                setTimeout(function(){
                    $('body .notification-message').remove();
                }, 3000);
            },
            error: function(jqXHR, textStatus, errorThrown) {
               alert('error');       
            }
            });
        }
    });
});