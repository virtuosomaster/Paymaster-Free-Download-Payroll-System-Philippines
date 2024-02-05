jQuery(document).ready(function($) {
	$('.timepicker').timepicker();
	// Add administrative Email
	$('#administrative-emails').on('click','#save-hr-email, #save-admin-email',function(){
		var id = $(this).attr('id');
		var emailType;
		if( id == 'save-hr-email' ){
			emailType = 'hr';
		}else{
			emailType = 'admin';
		}
		var email = $('#'+emailType+'-email').val();
		if( !IsEmail(email) ){
			alert('Value is not in email format');
			return false;
		}
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'save-email',
				emailType	: emailType,
				email	: email,
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data.length != 0 ){
					data = JSON.parse(data);
					$('body').prepend('<div class="notification-message alert alert-success">Administrative email has been saved.</div>');
			        setTimeout(function(){
			        	$('body .notification-message').remove();
			        }, 1500);
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}

				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);


				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});

	// uncut schedule script - adding schedule

	$('#schedule-form').on('change', '#uncut_sched', function() {
		let _this 		= $(this);
		let _ftimeOut = _this.closest('form').find('input#ftime_out');
		let _stimeIn 	= _this.closest('form').find('input#stime_in');
		let _isChecked = _this.is(':checked');

		// disable/enable on check/uncheck

		_ftimeOut.attr('readonly', _isChecked);
		_stimeIn.attr('readonly', _isChecked);
		
	});

	// uncut schedule script - updating schedule

	$('#update-schedule-form').on('change', '#_uncut_sched', function() {
		let _this 		= $(this);
		let _ftimeOut = _this.closest('form').find('input#_ftime_out');
		let _stimeIn 	= _this.closest('form').find('input#_stime_in');
		let _isChecked = _this.is(':checked');

		// disable/enable on check/uncheck

		_ftimeOut.attr('readonly', _isChecked);
		_stimeIn.attr('readonly', _isChecked);
		
	});
	
	//** Add new schedule
	$('#schedule-form').submit(function(e){
		e.preventDefault();
		var specChar  = /[`'!&]/;
		var schedName	= $('#schedule-form #schedule_name').val();
		var schedFIn	= $('#schedule-form #ftime_in').val();
		var schedFOut	= $('#schedule-form #ftime_out').val();
		var schedSIn	= $('#schedule-form #stime_in').val();
		var schedSOut	= $('#schedule-form #stime_out').val();
		var breakTime	= $('#schedule-form #breakTime').val();
		var schedColor	= $('#schedule-form #schedColor').val();
		var uncutSched	= $('#schedule-form #uncut_sched');
		let isUncut = uncutSched.is(':checked') ? '1' : '0';
		if( specChar.test( schedName ) ) {
			alert( "These special characters are not allowed for schedule names: [ ` ' ! & ]" );
			return;
		}
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'submit-schedule',
				schedName	: schedName,
				schedFIn	: schedFIn,
				schedFOut	: schedFOut,
				schedSIn 	: schedSIn,
				schedSOut 	: schedSOut,
				breakTime 	: breakTime,
				schedColor 	: schedColor,
				isUncut : isUncut
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data.length != 0 ){
				    
					data = JSON.parse(data);
					$('body').prepend('<div class="notification-message alert alert-success">New Schedule has been added.</div>');
			        setTimeout(function(){
			        	$('body .notification-message').remove();
			        }, 1500);
					$('table#scheduleListTable tbody').append( '<tr id="sched-'+data.id+'">'+
						'<td class="name">'+data.schedule.name+'</td>'+
						'<td class="ftimein">'+data.schedule.ftimein+'</td>'+
						'<td class="ftimeout">'+data.schedule.ftimeout+'</td>'+
						'<td class="stimein">'+data.schedule.stimein+'</td>'+
						'<td class="stimeout">'+data.schedule.stimeout+'</td>'+
						'<td class="breakTime">'+data.schedule.break+'</td>'+
						'<td class="schedColor"><div style="margin:auto;width:20px;height:20px;border:1px solid #eee;border-radius:50%;background-color:'+data.schedule.schedColor+'"></div></td>'+
						'<td style="text-align:center;"><a class="update" data-id="'+data.id+'" data-toggle="modal" data-target="#updatedScheduleModal"><span class="fa fa-fw fa-edit"></span></a></td>'+
						'<td style="text-align:center;"><a class="delete" data-id="'+data.id+'" data-toggle="modal" data-target="#deleteScheduleModal"><span style="color:red;" class="fa fa-fw fa-trash"></span></a></td>'+
						'</tr>' 
					);
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				$('#addScheduleModal').modal('toggle');
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);


				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	//** Delete Schedule
	$('#scheduleListTable tbody').on('click', '.delete', function(e){
		e.preventDefault();
		var schedID		= $(this).attr('data-id');
		$('#deleteScheduleModal #deleteScheduleButton').val(schedID);
	});
	$('#deleteScheduleModal').on('click', '#deleteScheduleButton', function(e){
		e.preventDefault();
		var schedID		= $(this).val();
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'delete-schedule',
				schedID	: schedID
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data == 1 ){
					$('body').prepend('<div class="notification-message alert alert-success">Schedule has been deleted!.</div>');
					$('#scheduleListTable tbody tr#sched-'+schedID).remove();
					$('#deleteScheduleModal').modal('toggle');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
					$('#deleteScheduleModal').modal('toggle');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	/* Update Schedule
	*  Open Update Schedule Form Modal
	*/
	$('#scheduleListTable').on('click', '.update', function(e){
		var schedID = $(this).attr('data-id');
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'get-schedule',
				schedID	: schedID
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data.length != 0 ){
					data = JSON.parse(data);
					let _isUncut = data.isUncut == 1 ? true : false;
					$( '#update-schedule-form #_schedule_name' ).val( data.name );
					$( '#update-schedule-form #_ftime_in' ).val( data.ftimein );
					$( '#update-schedule-form #_ftime_out' ).val( data.ftimeout );
					$( '#update-schedule-form #_ftime_out' ).attr( 'readonly', _isUncut );
					$( '#update-schedule-form #_stime_in' ).val( data.stimein );
					$( '#update-schedule-form #_stime_in' ).attr( 'readonly', _isUncut );
					$( '#update-schedule-form #_stime_out' ).val( data.stimeout  );
					$( '#update-schedule-form #breakTime' ).val( data.break  );
					$( '#update-schedule-form #_schedColor' ).val( data.schedColor  );
					$( '#update-schedule-form #_uncut_sched' ).attr( 'checked', _isUncut );
					$( '#update-schedule-form #scheduleID' ).val( schedID );
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	//** Update schedule form
	$('#update-schedule-form').submit(function(e){
		e.preventDefault();
		var schedID		= $('#update-schedule-form input#scheduleID').val();
		var schedName	= $('#update-schedule-form input#_schedule_name').val();
		var schedFIn	= $('#update-schedule-form input#_ftime_in').val();
		var schedFOut	= $('#update-schedule-form input#_ftime_out').val();
		var schedSIn	= $('#update-schedule-form input#_stime_in').val();
		var breakTime	= $('#update-schedule-form input#breakTime').val();
		var schedSOut	= $('#update-schedule-form input#_stime_out').val();
		var _schedColor	= $('#update-schedule-form input#_schedColor').val();
		var _unCut	= $('#update-schedule-form input#_uncut_sched');
		var _isUncut	= _unCut.is(':checked') ? '1' : '0';
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'update-schedule',
				schedID		: schedID,
				schedName	: schedName,
				schedFIn	: schedFIn,
				schedFOut	: schedFOut,
				schedSIn	: schedSIn,
				schedSOut	: schedSOut,
				breakTime : breakTime,
				_schedColor : _schedColor,
				_isUncut : _isUncut
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data == 1 ){
				    
					$('body').prepend('<div class="notification-message alert alert-success">Schedule updated successfully.</div>');
					$('#scheduleListTable tbody tr#sched-'+schedID+' td.name').text( schedName );
					$('#scheduleListTable tbody tr#sched-'+schedID+' td.ftimein').text( schedFIn );
					$('#scheduleListTable tbody tr#sched-'+schedID+' td.ftimeout').text( schedFOut );
					$('#scheduleListTable tbody tr#sched-'+schedID+' td.stimein').text( schedSIn );
					$('#scheduleListTable tbody tr#sched-'+schedID+' td.stimeout').text( schedSOut );
					$('#scheduleListTable tbody tr#sched-'+schedID+' td.breakTime').text( breakTime );
					$('#scheduleListTable tbody tr#sched-'+schedID+' td.schedColor div').css( 'background-color', _schedColor );
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				$('#updatedScheduleModal').modal('toggle');
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	//** Set late allowance
	$('#late-allowance-form').submit(function(e){
		e.preventDefault();
		var lateAllowed	= $('#late-allowance-form input#late_allowance').val();
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'set-late-allowance',
				lateAllowed	: lateAllowed,
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data ){
					$('body').prepend('<div class="notification-message alert alert-success">Late Allowance has been successfully set.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	//** Set late amount
	$('#late-amount-form').submit(function(e){
		e.preventDefault();
		var lateAmount	= $('#late-amount-form input#late_amount').val();
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'set-late-amount',
				lateAmount	: lateAmount,
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data ){
					$('body').prepend('<div class="notification-message alert alert-success">Late Amount has been successfully set.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	// Holiday amount setting
	$('#holiday-amount-form').submit(function(e){
		e.preventDefault();
		var holidayAmount	= $('#holiday-amount-form input#holiday_amount').val();
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'set-holiday-amount',
				holidayAmount	: holidayAmount,
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data ){
					$('body').prepend('<div class="notification-message alert alert-success">Holiday Amount has been successfully set.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	// Night diff amount setting
	$('#nightdiff-amount-form').submit(function(e){
		e.preventDefault();
		var nightdiffamount	= $('#nightdiff-amount-form input#nightdiff_amount').val();
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'set-nightdiff-amount',
				nightdiffamount	: nightdiffamount,
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data ){
					$('body').prepend('<div class="notification-message alert alert-success">Night Diff Amount has been successfully set.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	// Overtime amount setting
	$('#overtime-amount-form').submit(function(e){
		e.preventDefault();
		var overtimeamount	= $('#overtime-amount-form input#overtime_amount').val();
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'set-overtime-amount',
				overtimeamount	: overtimeamount,
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data ){
					$('body').prepend('<div class="notification-message alert alert-success">Overtime Amount has been successfully set.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	/**
	 * 4.0.3 changes - start
	 * 
	 * @use actual rate for holiday amount
	 * 
	 * @user actual rate for leave amount
	 * 
	 * @user actual rate for night diff amount
	 * 
	 * @user actual rate for overtime amount
	 */

	$( '#holiday_amt_rate' ).on('change', function() {

		let $this  = $(this);
		let action = $this.is(':checked') ? 'set-holiday-actual-rate' : 'unset-holiday-actual-rate';
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: { action:action },
			beforeSend : function(){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function( data ) {
				if( data ) {

					const { type, message } = JSON.parse( data );
					$('body').prepend(`<div class="notification-message alert alert-${type}">${message}</div>`);
					setTimeout(function(){
						$('body .notification-message').remove();
					}, 1000);
					$('body .lds-ellipsis').remove();

				}
			}
		});

	});

	$( '#leave_amt_rate' ).on('change', function() {

		let $this  = $(this);
		let action = $this.is(':checked') ? 'set-leave-actual-rate' : 'unset-leave-actual-rate';
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: { action:action },
			beforeSend : function(){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function( data ) {
				if( data ) {

					const { type, message } = JSON.parse( data );
					$('body').prepend(`<div class="notification-message alert alert-${type}">${message}</div>`);
					setTimeout(function(){
						$('body .notification-message').remove();
					}, 1000);
					$('body .lds-ellipsis').remove();

				}
			}
		});

	});

	$( '#nightdiff_amt_rate' ).on('change', function() {

		let $this  = $(this);
		let action = $this.is(':checked') ? 'set-nightdiff-actual-rate' : 'unset-nightdiff-actual-rate';
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: { action:action },
			beforeSend : function(){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function( data ) {
				if( data ) {

					const { type, message } = JSON.parse( data );
					$('body').prepend(`<div class="notification-message alert alert-${type}">${message}</div>`);
					setTimeout(function(){
						$('body .notification-message').remove();
					}, 1000);
					$('body .lds-ellipsis').remove();

				}
			}
		});

	});

	$( '#overtime_amt_rate' ).on('change', function() {

		let $this  = $(this);
		let action = $this.is(':checked') ? 'set-overtime-actual-rate' : 'unset-overtime-actual-rate';
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: { action:action },
			beforeSend : function(){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function( data ) {
				if( data ) {

					const { type, message } = JSON.parse( data );
					$('body').prepend(`<div class="notification-message alert alert-${type}">${message}</div>`);
					setTimeout(function(){
						$('body .notification-message').remove();
					}, 1000);
					$('body .lds-ellipsis').remove();

				}
			}
		});

	});

	/**
	 * 4.0.3 changes - end
	 */
	// Training amount setting
	$('#training-amount-form').submit(function(e){
		e.preventDefault();
		var trainingAmount	= $('#training-amount-form input#training_amount').val();
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'set-training-amount',
				trainingAmount	: trainingAmount,
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data ){
					$('body').prepend('<div class="notification-message alert alert-success">Training Amount has been successfully set.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	// Leave amount setting
	$('#leave-amount-form').submit(function(e){
		e.preventDefault();
		var leaveAmount	= $('#leave-amount-form input#leave_amount').val();
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'set-leave-amount',
				leaveAmount	: leaveAmount,
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data ){
					$('body').prepend('<div class="notification-message alert alert-success">Leave Amount has been successfully set.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	//** 13th Month pay setting
	$('#thirteenth_month').on('change', function(){
		var thn_month = ( $(this).is(':checked') ) ? 1 : 0 ;
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'set-thirteenth-month',
				thn_month	: thn_month,
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				$('body .loading').remove();
				if( data ){
					$('body').prepend('<div class="notification-message alert alert-success">Enable 13th month pay every cut-off has been successfully set.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
    });
    //** Regular Holiday Sunday with pay
	$('#holiday_pay').on('change', function(){
		var sundayHoliday = ( $(this).is(':checked') ) ? 1 : 0 ;
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	 	: 'sunday-holiday',
				sundayHoliday	: sundayHoliday,
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				$('body .loading').remove();
				if( data ){
					$('body').prepend('<div class="notification-message alert alert-success">Regular Holiday (Sunday) no work with pay has been successfully set.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
    });
    //** Regular Holiday Sunday with pay
	$('#tax_salary_period').on('change', function(){
	 	var salaryPeriod = $(this).val();			
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	 	: 'tax-salary-period',
				salaryPeriod	: salaryPeriod,
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				$('body .loading').remove();
				if( data ){
					$('body').prepend('<div class="notification-message alert alert-success">Withholding Tax Salary Deduction has been successfully set.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});			
  	});
    $('#update-code').on('click', function(e){
      e.preventDefault();
      $.ajax({  
          url: './ajax-files/general-settings-ajax.php',
          type: 'POST',
          data: {
            action    : 'update-code',
          },
          beforeSend : function( ){
            $('body').append('<div class="loading"></div>');
          },
          success: function(data) {
            $('body .loading').remove();
            $('#permission-setting-container #permission-code').html(data);
          },
          error: function(log) {
            console.log(log.message);
          }
        }); 
    });
    // Options Scripts
    $('.option-form').submit(function(e){
		e.preventDefault();
		var parentID 		= $(this).attr( 'id' );
		var optionName 		= $('#'+parentID+' input[type="text"]').attr('id');
		var optionValue 	= $('#'+parentID+' input[type="text"]').val();
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'submit-option',
				optionName	: optionName,
				optionValue : optionValue
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data.length != 0 ){
					data = JSON.parse(data);
					$('body').prepend('<div class="notification-message alert alert-success">Option has been added.</div>');
					$('table#'+optionName+'ListTable tbody').append( '<tr id="sched-'+data.id+'">'+
						'<td class="name">'+data.value+'</td>'+
						'<td style="text-align:center;"><a class="update" data-id="'+data.id+'" data-toggle="modal" data-target="#updatedOptionModal"><span class="fa fa-fw fa-edit"></span></a></td>'+
						'<td style="text-align:center;"><a class="delete" data-id="'+data.id+'" data-toggle="modal" data-target="#deleteOptionModal"><span style="color:red;" class="fa fa-fw fa-trash"></span></a></td>'+
						'</tr>' 
					);
					$('#'+parentID+' input[type="text"]').val('');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);

				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	//** Delete Schedule
	$('.optionListTable tbody').on('click', '.delete', function(e){
		e.preventDefault();
		var optionID		= $(this).attr('data-id');
		$('#deleteOptionModal #deleteOptionButton').val(optionID);
	});
	$('#deleteOptionModal').on('click', '#deleteOptionButton', function(e){
		e.preventDefault();
		var optionID		= $(this).val();
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'delete-option',
				optionID	: optionID
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data == 1 ){
					$('#deleteOptionModal').modal('toggle');
					$('body').prepend('<div class="notification-message alert alert-success">Option has been deleted!.</div>');
					$('.optionListTable tbody tr#sched-'+optionID).remove();
					
				}else{
					$('#deleteOptionModal').modal('toggle');
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');					
				}
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	//** Update Option form
	$('.optionListTable').on('click', '.update', function(e){
		var optionID = $(this).attr('data-id');
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'get-option',
				optionID	: optionID
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data.length != 0 ){
					data = JSON.parse(data);
					$( '#update-option-form #_option_name' ).val( data.value );
					$( '#update-option-form #optionID' ).val( data.id );
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	$('#update-option-form').submit(function(e){
		e.preventDefault();
		var optionID		= $('#update-option-form input#optionID').val();
		var optionName		= $('#update-option-form input#_option_name').val();
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'update-option',
				optionID	: optionID,
				optionName	: optionName
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data == 1 ){
					$('body').prepend('<div class="notification-message alert alert-success">Option has been successfully set.</div>');
					$('.optionListTable tbody tr#sched-'+optionID+' td.name').text( optionName );
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				$('#updatedOptionModal').modal('toggle');
				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	//** Add new schedule
	$('#company-information').submit(function(e){
		e.preventDefault();
		var name	= $('#company-name').val();
		var address	= $('#company-address').val();
		var email	= $('#company-email').val();
		var phone	= $('#company-phone').val();
		var website	= $('#company-website').val();
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'save-company-info',
				name 	: name,
				address	: address,
				email	: email,
				phone 	: phone,
				website : website
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data == 1 ){
					data = JSON.parse(data);
					$('body').prepend('<div class="notification-message alert alert-success">Company Information has been Saved.</div>');
			        setTimeout(function(){
			        	$('body .notification-message').remove();
			        }, 1500);
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}

				setTimeout(function(){
					$('body .notification-message').remove();
		        }, 1500);

				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	function IsEmail(email) {
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!regex.test(email)) {
		  return false;
		}else{
		  return true;
		}
	}
	$('#clock_in_out').on('change', function(){
		let enableClockInOut = ( $(this).is(':checked') ) ? 1 : 0;
		let enabledText = (enableClockInOut == 1) ? 'enabled' : 'disabled';
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action: 'clock-in-out',
				enableClockInOut: enableClockInOut,
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				$('body .lds-ellipsis').remove();
				if( data ){
					$('body').prepend(`<div class="notification-message alert alert-success">Clock in/out ${enabledText}.</div>`);
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
				}, 1500);
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
});
