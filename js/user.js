jQuery(document).ready(function($){
	$('#employeeListTable tbody').on('click', '.delete', function(e){
		e.preventDefault();
        var userID = $(this).attr('data-id');
		$('#deleteUserModal #deleteUserButton').attr('data-id',userID);
	});
	$('#deleteUserModal').on('click', '#deleteUserButton', function(e){
		e.preventDefault();
        var userID		= $(this).attr('data-id');
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'delete-employee',
				userID	: userID
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data == 1 ){
					$('body').prepend('<div class="notification-message alert alert-success">User has been deactivated!.</div>');
					$('#employeeListTable tbody tr#data-'+userID).remove();
					$('#deleteUserModal').modal('toggle');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
					$('#deleteUserModal').modal('toggle');
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

	// 4.0.3 changes - bulk update schedule - start

	/**
	 * boolean script
	 */
	const canBulkUpdate = () => {
		let counter = 0;
		let _user_ids = $('input[name="bulk_user_ids"]');
		_user_ids.each(function(){
			if($(this).is(':checked')){
				counter++;
			}
		});
		return counter > 0 ? true : false;
	}
	/**
	 * get all user ids script
	 */
	const userIds = () => {
		let result = [];
		let _user_ids = $('input[name="bulk_user_ids"]');
		_user_ids.each(function(){
			let _val = $(this).val();
			let _is_checked = $(this).is(':checked');
			if(_is_checked && !result.includes(_val)){
				result.push(_val);
			}
		});
		return result;
	}
	/**
	 * check all script
	 */
	$('input.check_all').on('change', function(){
		let _this = $(this);
		let _user_ids = _this.closest('table').find('tbody input[name="bulk_user_ids"]');
		_user_ids.each(function(){
			$(this).attr('checked', _this.is(':checked'));
		});
	});
	/**
	 * bulk update modal script
	 */
	$('.bulk-update-btn').on('click', function(){
		if(!canBulkUpdate()) {
			alert('Please select at least one user to update.');
		} else {
			$('.show-bulk-update-modal').trigger('click');
		}
	});
	/**
	 * trigger form submit script
	 */
	$('.bulk-sched-save-btn').on('click', function(){
		$('form#bulk-update-form').trigger('submit');
	});
	/**
	 * bulk update form submit script
	 */
	$('form#bulk-update-form').on('submit', function(e){
		e.preventDefault();
		let _this = $(this);
		let formData = _this.serialize();

		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'bulk-update',
				formData: formData,
				userIds: userIds()
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				$('body .lds-ellipsis').remove();
				if( data ) {
					const {message} = JSON.parse(data);
					let messageResult = '';
					for(let messages of message){
						messageResult += `<li>${messages}</li>`;
					}

					$('body').prepend(`<div class="notification-message alert alert-success"><ul style="width: 270px; margin: auto;">${messageResult}</ul></div>`);
					setTimeout(function(){
						$('body .notification-message').remove();
					}, 3000);
				}
			}
		});
	});	

	// 4.0.3 changes - end

	// bulk update dayoff script start

	$('.bulk-update-dayoff-btn').on('click', function(){
		if(!canBulkUpdate()) {
			alert('Please select at least one user to update.');
		} else {
			$('#bulkUpdateDayoffModalTrigger').trigger('click');
		}
	});

	$('#bulkUpdateDayoffForm').on('submit', function(e){
		e.preventDefault();
		let _this = $(this);
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'bulk-update-dayoff',
				userDayoffs: _this.serialize(),
				userIds: userIds()
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data ) {
					$('body .lds-ellipsis').remove();
					const {type, message} = JSON.parse(data);
					$('body').prepend(`<div class="notification-message alert alert-${type}">${message}</div>`);
					setTimeout(function(){
						$('body .notification-message').remove();
					}, 1500);
				}
			}
		});
	});	

	// bulk update dayoff script end

	// 4.1.0 changes fancy table start

	$('#employeeListTable').fancyTable({
		pagination: true,
		paginationClass:"btn btn-primary",
		paginationClassActive:"active",
		pagClosest: 3,
		perPage: 10,
		searchable: false,
	});

	// 4.1.0 changes end

});