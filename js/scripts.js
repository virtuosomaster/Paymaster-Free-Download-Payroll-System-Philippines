jQuery(document).ready(function($){
	$(".search-date").datepicker({
		dateFormat : "yy-mm-dd",
		maxDate: '0',
		onSelect: function(dateText, inst) {
			var date = $(this).val();
			window.location.href = window.location.href.replace( /[\?#].*|$/, "?date="+date );
		}
	});
	$("body").tooltip({ selector: '[data-toggle="tooltip]"' });
	// $('[data-toggle="tooltip"]').tooltip();

	$( ".datepicker" ).datepicker({
		dateFormat : "yy-mm-dd"
	});
	$('.select2').select2();
	$(".filter-table").fancyTable({
		perPage: 24,
		sortColumn:0,
		sortable: true,
		pagination: true, // default: false
		searchable: false,
		globalSearch: false,

	});
	$('.searchable-table').fancyTable({
		sortColumn:0,
		pagination: false,
		perPage:36,
		globalSearch:true
	  });
	$( ".tabs" ).tabs({
        activate: function(event, ui) {
            window.location.hash = ui.newPanel.attr('id');
        }
    });
	$("#attendance").on('click','.date-page.active', function(){
		var selDate = $(this).data('date');
		if(selDate){
			// window.location.href = window.location.href + "?date="+selDate;
			window.location.href = window.location.href.replace( /[\?#].*|$/, "?date="+selDate );
		}
	});
	// Time Range
	if( $( "#time-range" ).length ){
		$('#time-range .time').timepicker({
			'showDuration': true,
			'timeFormat': 'g:ia'
		});
		var timeRange = document.getElementById('time-range');
		var timeRangePair = new Datepair(timeRange);
	}	
	// Add New Payroll
	$('#generate-payroll-form').on('submit', function(e){
		e.preventDefault();
		var payroll 	= [];
		var payrollName = $('#generate-payroll-form #payrollName').val();
		// Loop all the fields that has a class of data
		// This will be the Indentifier how may group of fields to fetch
		$( "input.employee" ).each(function( index, value ){
			var employee = $('input[name="payroll['+index+'][employee]"]').val();
			var employee_id = $('input[name="payroll['+index+'][employee_id]"]').val();
			var consume_hour = $('input[name="payroll['+index+'][consume_hour]"]').val();
			var rate_hour = $('input[name="payroll['+index+'][rate_hour]"]').val();
			var daily_rate = $('input[name="payroll['+index+'][daily_rate]"]').val();
			var leave_amount = $('input[name="payroll['+index+'][leave_amount]"]').val();
			var thn_month = $('input[name="payroll['+index+'][thirteenth_pay]"]').val();
			var reg_holiday = $('input[name="payroll['+index+'][reg_holiday]"]').val();
			var sp_holiday = $('input[name="payroll['+index+'][sp_holiday]"]').val();
			var prm_holiday = $('input[name="payroll['+index+'][prm_holiday]"]').val();
			var ot_amount = $('input[name="payroll['+index+'][ot_amount]"]').val();
			var night_diff = $('input[name="payroll['+index+'][night_diff]"]').val();
			var amt_cola = $('input[name="payroll['+index+'][amt_cola]"]').val();
			var allow_pera = $('input[name="payroll['+index+'][allow_pera]"]').val();
			var allow_rice = $('input[name="payroll['+index+'][allow_rice]"]').val();
			var adjustment = $('input[name="payroll['+index+'][adjustment]"]').val();
			var sss_cont = $('input[name="payroll['+index+'][sss_cont]"]').val();
			var hdmf_cont = $('input[name="payroll['+index+'][hdmf_cont]"]').val();
			var phil_cont = $('input[name="payroll['+index+'][phil_cont]"]').val();
			var gsis_cont = $('input[name="payroll['+index+'][gsis_cont]"]').val();
			var loan_sss = $('input[name="payroll['+index+'][loan_sss]"]').val();
			var loan_hdmf = $('input[name="payroll['+index+'][loan_hdmf]"]').val();
			var loan_policy = $('input[name="payroll['+index+'][loan_policy]"]').val();
			var loan_gsis = $('input[name="payroll['+index+'][loan_gsis]"]').val();
			var ela_sos = $('input[name="payroll['+index+'][ela_sos]"]').val();
			var uniform = $('input[name="payroll['+index+'][uniform]"]').val();
			var other_deduction = $('input[name="payroll['+index+'][other_deduction]"]').val();
			var cash_advance = $('input[name="payroll['+index+'][cash_advance]"]').val();
			var absent_amount = $('input[name="payroll['+index+'][absent_amount]"]').val();
			var late_amount = $('input[name="payroll['+index+'][late_amount]"]').val();
			var withholding_tax = $('input[name="payroll['+index+'][withholding_tax]"]').val();
			var com_sss_cont = $('input[name="payroll['+index+'][com_sss_cont]"]').val();
			var com_phil_cont = $('input[name="payroll['+index+'][com_phil_cont]"]').val();
			var com_hdmf_cont = $('input[name="payroll['+index+'][com_hdmf_cont]"]').val();
			var com_gsis_cont = $('input[name="payroll['+index+'][com_gsis_cont]"]').val();
			var init_salary = $('input[name="payroll['+index+'][init_salary]"]').val();
			var pay_type = $('input[name="payroll['+index+'][pay_type]"]').val();
			var date_from = $('input[name="payroll['+index+'][date_from]"]').val();
			var date_to = $('input[name="payroll['+index+'][date_to]"]').val();
			payroll.push( {
				'employee' : employee,
				'employee_id' : employee_id,
				'consume_hour' : consume_hour,
				'rate_hour' : rate_hour,
				'daily_rate' : daily_rate,
				'leave_amount' : leave_amount,
				'thn_month' : thn_month,
				'reg_holiday' : reg_holiday,
				'sp_holiday' : sp_holiday,
				'prm_holiday' : prm_holiday,
				'ot_amount' : ot_amount,
				'night_diff' : night_diff,
				'amt_cola' : amt_cola,
				'allow_pera' : allow_pera,
				'allow_rice' : allow_rice,
				'adjustment' : adjustment,
				'sss_cont' : sss_cont,
				'hdmf_cont' : hdmf_cont,
				'phil_cont' : phil_cont,
				'loan_sss' : loan_sss,
				'loan_hdmf' : loan_hdmf,
				'gsis_cont' : gsis_cont,
				'loan_policy' : loan_policy,
				'loan_gsis' : loan_gsis,
				'ela_sos' : ela_sos,
				'uniform' : uniform,
				'other_deduction' : other_deduction,
				'cash_advance' : cash_advance,
				'absent_amount': absent_amount,
				'late_amount' : late_amount,
				'withholding_tax' : withholding_tax,
				'com_sss_cont' : com_sss_cont,
				'com_phil_cont' : com_phil_cont,
				'com_hdmf_cont' : com_hdmf_cont,
				'com_gsis_cont' : com_gsis_cont,
				'initial_salary' : init_salary,
				'pay_type' : pay_type,
				'date_from' : date_from,
				'date_to' : date_to
			} );
		});
		$.ajax({
			url: './includes/common/ajax-handler.php',
			type: "post",
			data: {
				action : 'add-payroll',
				payrollName : payrollName,
				payroll : payroll,
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
						$( 'body .notification-message #error-wrapper' ).append('<p>Payroll successfully save, but the following Employee is not save to Payroll.</p>');
					}
					$.each( errors, function( index, $value ){
						$( 'body .notification-message #error-wrapper' ).append('<p><strong>'+$value+'</strong></p>');
					});
					if( errors.length > 1 ){
						$( 'body .notification-message #error-wrapper' ).append('<p>Please create a new payroll for all the listed Employee.</p>');
					}
					$( 'body .notification-message #error-wrapper' ).append('<button class="btn btn-primary" id="agree">Continue</button>');
				}else{
					$('body').prepend('<div class="payroll notification-message alert alert-success"><h3>Payroll successfully saved!</h3></div>');
					setTimeout(function(){
						$('body .notification-message').remove();
					}, 1500);
				}

			},
			error: function(jqXHR, textStatus, errorThrown) {
			   alert('error');
			}
		});
	});
	$('body').on('click', '.payroll.alert-danger button#agree', function(){
		location.reload();
	});
	// Add new Employee
	// ***************************************************************************************************
	$('#add-employee').on('submit', function( e ){
		e.preventDefault();
		var dayOff = [];
		$('#add-employee input.day_off').each(function(i){
			if( $(this).prop('checked') ){
				dayOff.push( $(this).val() ) ;
				return;
			}
		});
		var fname = $('#add-employee #fname' ).val();
		var lname = $('#add-employee #lname' ).val();
		var phone = $('#add-employee #phone' ).val();
		var email = $('#add-employee #email' ).val();
		var address = $('#add-employee #address' ).val();
		var username = $('#add-employee #username' ).val();
		var password = $('#add-employee #password' ).val();
		var whours = $('#add-employee #whours' ).val();
		var basicPay = $('#add-employee #basic_pay' ).val();
		var cola = $('#add-employee #cola' ).val();
		var empStatus = $('#add-employee #empStatus' ).val();
		var empLevel = $('#add-employee #empLevel' ).val();
		var deviceID = $('#add-employee #deviceID' ).val();
		var bnkAcct = $('#add-employee #bnkAcct' ).val();
		var designation = $('#add-employee #designation' ).val();
		var group = $('#add-employee #group' ).val();
		var team = $('#add-employee #team' ).val();
		var cutoff = $('#add-employee .cutoff:checked').val();
		var colaType = $('#add-employee .cola_type' ).prop('checked') ? 0 : 1 ;
		var taxExemption = $('#add-employee #tax-exemption' ).is(":checked") ? 1 : 0 ;
		var taxStatus = $('#add-employee #tax_status' ).val();
		var sss = $('#add-employee #sss' ).val();
		var philHealth = $('#add-employee #philhealth' ).val();
		var hmdf = $('#add-employee #hmdf' ).val();
		var gsis = $('#add-employee #gsis' ).val();
		var late = $('#add-employee #late' ).val();
		var deduction = $('#add-employee #deduction' ).val();
		var sssComcont = $('#add-employee #sss_comcont' ).val();
		var philhealthComcont = $('#add-employee #philhealth_comcont' ).val();
		var hmdfComcont = $('#add-employee #hmdf_comcont' ).val();
		var deduction = $('#add-employee #deduction' ).val();
		var adjustment = $('#add-employee #adjustment' ).val();
		var schedule = $('#add-employee #schedule' ).val();
		var allowPera = $('#add-employee #allow_pera' ).val();
		var allowRice = $('#add-employee #allow_rice' ).val();
		var overtimeAmount = $('#add-employee #overtime_amount' ).val();
		var holidayAmount = $('#add-employee #holiday_amount' ).val();
		var contriGSIS = $('#add-employee #contri_gsis' ).val();
		var cname = $('#add-employee #cname' ).val();
		var cphone = $('#add-employee #cphone' ).val();
		var cemail = $('#add-employee #cemail' ).val();
		var caddress = $('#add-employee #caddress' ).val();
		var cola_limit = $('#add-employee #cola_limit' ).val();

		// additional fields

		var title = $('#add-employee #title' ).val();
		var mname = $('#add-employee #mname' ).val();
		var birthdate = $('#add-employee #birthdate' ).val();
		var placeob = $('#add-employee #placeob' ).val();
		var gender = $('#add-employee #gender' ).val();
		var religion = $('#add-employee #religion' ).val();
		var nationality = $('#add-employee #nationality' ).val();
		var status = $('#add-employee #status' ).val();
		var sss_no = $('#add-employee #sss_no' ).val();
		var ph_no = $('#add-employee #ph_no' ).val();
		var hdmf_no = $('#add-employee #hdmf_no' ).val();
		var bir_no = $('#add-employee #bir_no' ).val();
		var phone2 = $('#add-employee #phone2' ).val();
		var bldg = $('#add-employee #bldg' ).val();
		var street = $('#add-employee #street' ).val();
		var barangay = $('#add-employee #barangay' ).val();
		var city = $('#add-employee #city' ).val();
		var zipcode = $('#add-employee #zipcode' ).val();
		var province = $('#add-employee #province' ).val();
		var region = $('#add-employee #region' ).val();
		var country = $('#add-employee #country' ).val();
		var autofill = $('#add-employee #autofill' ).is(':checked') ? 'on' : 'off';
		var bldg1 = $('#add-employee #bldg1' ).val();
		var street1 = $('#add-employee #street1' ).val();
		var barangay1 = $('#add-employee #barangay1' ).val();
		var city1 = $('#add-employee #city1' ).val();
		var zipcode1 = $('#add-employee #zipcode1' ).val();
		var province1 = $('#add-employee #province1' ).val();
		var region1 = $('#add-employee #region1' ).val();
		var country1 = $('#add-employee #country1' ).val();

    $.ajax({
			url: './includes/common/ajax-handler.php',
			type: "post",
			datatype:'json',
			data: {
				action : 'add-employee',
				fname : fname,
				lname : lname,
				username : username,
				password : password,
				phone : phone,
				email : email,
				address : address,
				late : late,
				whours : whours,
				basicPay : basicPay,
				cola : cola,
				empStatus : empStatus,
				empLevel : empLevel,
				deviceID : deviceID,
				bnkAcct : bnkAcct,
				designation : designation,
				group : group,
				team : team,
				cutoff : cutoff,
				colaType : colaType,
				taxExemption : taxExemption,
				taxStatus : taxStatus,
				sss : sss,
				philHealth : philHealth,
				hmdf : hmdf,
				bir_no: bir_no,
				gsis : gsis,
				deduction : deduction,
				sssComcont : sssComcont,
				philhealthComcont : philhealthComcont,
				hmdfComcont : hmdfComcont,
				deduction : deduction,
				adjustment : adjustment,
				schedule : schedule,
				dayOff : dayOff,
				allowPera: allowPera,
				allowRice: allowRice,
				overtimeAmount: overtimeAmount,
				holidayAmount: holidayAmount,
				contriGSIS: contriGSIS,
				cname : cname,
				cphone : cphone,
				cemail : cemail,
				caddress : caddress,
				cola_limit : cola_limit,
				title : title,
				mname : mname,
				birthdate : birthdate,
				placeob : placeob,
				gender : gender,
				religion: religion,
				nationality : nationality,
				status : status,
				sss_no : sss_no,
				ph_no : ph_no,
				hdmf_no : hdmf_no,
				phone2 : phone2,
				bldg : bldg,
				street : street,
				barangay : barangay,
				city : city,
				zipcode : zipcode,
				province : province,
				region : region,
				country : country,
				autofill : autofill,
				bldg1 : bldg1,
				street1 : street1,
				barangay1 : barangay1,
				city1 : city1,
				zipcode1 : zipcode1,
				province1 : province1,
				region1 : region1,
				country1 : country1
			},
		beforeSend: function() {
			$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
		},
		success: function (response) {
			const data = JSON.parse(response);
			$('body .lds-ellipsis').remove();
			if( data.status == 'success' ){
				$('body .lds-ellipsis').remove();
				$('#add-employee input[type="text"], #add-employee input[type="phone"], #add-employee input[type="email"], #add-employee select' ).val('');
		        $('#add-employee .cutoff' ).prop( "checked", false );
		        $('#add-employee .cola_type' ).prop( "checked", false );
		        $('#add-employee #tax-exemption' ).prop( "checked", false );
		        $('#add-employee input.day_off').each(function(i){
		        	$(this).prop( "checked", false );
		        });
		        $('body').prepend(`
				<div class="notification-message alert alert-success">${data.message}</div>`
				);
			}else{
				$('body').prepend(`
				<div class="notification-message alert alert-danger">${data.message}</div>`
				);
			}
			setTimeout(function(){
				$('body .notification-message').remove();
			}, 5000);
		},
		error: function(jqXHR, textStatus, errorThrown) {
		   alert('error');
		}
		});
	});
	// Update employee
	// ***************************************************************************************************
	$('#update-employee').on('submit', function( e ){
		e.preventDefault();
		var dayOff = [];
        $('#update-employee input.day_off').each(function(i){
			if( $(this).prop('checked') ){
				dayOff.push( $(this).val() ) ;
				return;
			}
        });
        var employeeID = $('#update-employee #employeeID' ).val();
        var fname = $('#update-employee #fname' ).val();
		var lname = $('#update-employee #lname' ).val();
		var phone = $('#update-employee #phone' ).val();
        var email = $('#update-employee #email' ).val();
        var address = $('#update-employee #address' ).val();
        var username = $('#update-employee #username' ).val();
        var password = $('#update-employee #password' ).val();
        var whours = $('#update-employee #whours' ).val();
        var basicPay = $('#update-employee #basic_pay' ).val();
        var cola = $('#update-employee #cola' ).val();
        var empStatus = $('#update-employee #empStatus' ).val();
        var empLevel = $('#update-employee #empLevel' ).val();
        var deviceID = $('#update-employee #deviceID' ).val();
        var bnkAcct = $('#update-employee #bnkAcct' ).val();
        var designation = $('#update-employee #designation' ).val();
        var group = $('#update-employee #group' ).val();
        var team = $('#update-employee #team' ).val();
        var cutoff = $('#update-employee .cutoff:checked').val();
        var colaType = $('#update-employee .cola_type' ).prop('checked') ? 0 : 1 ;
        var taxExemption = $('#update-employee #tax-exemption' ).is(":checked") ? 1 : 0 ;
        var taxStatus = $('#update-employee #tax_status' ).val();
        var sss = $('#update-employee #sss' ).val();
        var philHealth = $('#update-employee #philhealth' ).val();
        var hmdf = $('#update-employee #hmdf' ).val();
		var gsis = $('#update-employee #gsis' ).val();
		var late = $('#update-employee #late' ).val();
        var deduction = $('#update-employee #deduction' ).val();
        var sssComcont = $('#update-employee #sss_comcont' ).val();
        var philhealthComcont = $('#update-employee #philhealth_comcont' ).val();
        var hmdfComcont = $('#update-employee #hmdf_comcont' ).val();
        var deduction = $('#update-employee #deduction' ).val();
        var adjustment = $('#update-employee #adjustment' ).val();
        var schedule = $('#update-employee #schedule' ).val();
		var allowPera = $('#update-employee #allow_pera' ).val();
        var allowRice = $('#update-employee #allow_rice' ).val();
		var contriGSIS = $('#update-employee #contri_gsis' ).val();
		var cname = $('#update-employee #cname' ).val();
		var cphone = $('#update-employee #cphone' ).val();
		var cemail = $('#update-employee #cemail' ).val();
		var caddress = $('#update-employee #caddress' ).val();
        $.ajax({
			url: './includes/common/ajax-handler.php',
			type: "post",
			data: {
				action : 'update-employee',
				employeeID : employeeID,
				fname : fname,
				lname : lname,
				phone : phone,
				email : email,
				address : address,
				username : username,
				password : password,
				work_hours : whours,
				basic_pay : basicPay,
				cola : cola,
				work_status : empStatus,
				access_level : empLevel,
				idd : deviceID,
				account_number : bnkAcct,
				work_designation : designation,
				work_group : group,
				work_team : team,
				pay_type : cutoff,
				cola_type : colaType,
				tax_exemption : taxExemption,
				tax_status : taxStatus,
				contri_sss : sss,
				contri_philhealth : philHealth,
				contri_hmdf : hmdf,
				contri_gsis: gsis,
				deduction : deduction,
				late_amount : late,
				company_contri_sss : sssComcont,
				company_contri_philhealth : philhealthComcont,
				company_contri_hmdf : hmdfComcont,
				adjustment : adjustment,
				schedule : schedule,
				day_off : dayOff,
				allow_pera: allowPera,
				allow_rice: allowRice,
				company_contri_gsis: contriGSIS,
				contact_name : cname,
				contact_phone : cphone,
				contact_email : cemail,
				contact_address : caddress
			},
		beforeSend: function() {
			$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
		},
		success: function (response) {
			const data = JSON.parse(response);
			$('body .lds-ellipsis').remove();
			if( data.status == 'success' ){
		        $('body').prepend(`
				<div class="notification-message alert alert-success">${data.message}</div>
				`);
			}else{
				$('body').prepend(`
				<div class="notification-message alert alert-danger">${data.message}</div>
				`);
			}
			setTimeout(function(){
		        	$('body .notification-message').remove();
		    }, 6000);
		},
		error: function(jqXHR, textStatus, errorThrown) {
		   alert('error');
		}
		});
	});
	// Update user password
	// ***************************************************************************************************
	$('body').on('click', '#change-password', function( e ){
		e.preventDefault();
		var password = $('#password').val();
		if( !password ){
			$('#password').focus();
			alert( 'Password must not empty!' );
			return;
		}
		$.ajax({
			url: './includes/common/ajax-handler.php',
			type: "post",
			data: {
				action : 'update-password',
				password : password,
			},
			beforeSend: function() {
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function (response) {
				$('body .lds-ellipsis').remove();
				if( response > 0 ){
					$('body').prepend('<div class="notification-message alert alert-success">Password has been updated.</div>');
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
	// Payroll Report Scripts
	// ***************************************************************************************************
	var dateFormat = "yy-mm-dd",
      from = $( "#dateFrom" )
        .datepicker({
        	dateFormat : "yy-mm-dd",
        	// defaultDate: "+1w",
					changeMonth: true,
					numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
		to = $( "#dateTo" ).datepicker({
			dateFormat : "yy-mm-dd",
			// defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1
		})
		.on( "change", function() {
			from.datepicker( "option", "maxDate", getDate( this ) );
		});

    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }

      return date;
    }
    $( '#payroll-report-form .employee-option').on('change', function(){
    	var designation = $('#payroll-report-form #designation').val();
    	var group 		= $('#payroll-report-form #group').val();
    	var team 		= $('#payroll-report-form #team').val();
    	$.ajax({
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'filter-employee',
				designation	: designation,
				group : group,
				team : team
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				$('#employeeList')
		        .find('option')
		        .remove()
		        .end()
		        .append(data);
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});
	// Add leave for employee
	$('#userLeaveApplicationModal').on('submit', '#addLeave-form', function(e){
		e.preventDefault();
		var employee  = $('#addLeave-form #employee').val();
		var dateleave = $('#addLeave-form #leaveDate').val();
		var leaveType =	$('#addLeave-form #leave_type').val();
		var am_pm =	$('#addLeave-form #am_pm').val();
		$.ajax({
            url: './includes/common/ajax-handler.php',
            type: "post",
            data: {
                action : 'add-leave',
                userID : employee,
                leave_type : leaveType, 
                leaveDate : dateleave,
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
                }, 1500);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           alert('error');       
        }
        });
	});
	// Leave Approval Script
    $('#leaveList .action').on('click', 'button.approval', function(e){
    	e.preventDefault();
    	var leaveId 		= $(this).attr('data-id');
    	var leaveStatus 	= $(this).attr('data-status');
    	$.ajax({
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'leave-action',
				leaveId	: leaveId,
				leaveStatus : leaveStatus,
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(response) {
				var newStatus = 1;
				if( leaveStatus == 1 ) {
					var newStatus = 0;
				}
				var statusLabel = 'Not Approved';
				var buttonLabel = 'Approved';
				if( newStatus == 1 ){
					statusLabel = 'Approved';
					buttonLabel = 'Not Approved';
				}
				if( response > 0 ){
					$( '#leaveList tr#leave-'+leaveId+' .action button.approval' ).html(buttonLabel).attr('data-status', newStatus );
					$( '#leaveList tr#leave-'+leaveId+' .status' ).html(statusLabel);
					$('body').prepend('<div class="notification-message alert alert-success">Leave has been updated.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				$('body .lds-ellipsis').remove();
				setTimeout(function(){
		        	$('body .notification-message').remove();
		        }, 1500);
			},
			error: function(log) {
				console.log(log.message);
			}
		});
    });
    $('#leaveList .action').on('click', 'button.delete', function(e){
    	e.preventDefault();
    	var confirmation = confirm('Are you sure you want to delete this Leave?');
    	if( confirmation ){
	    	var leaveId 		= $(this).attr('data-id');
	    	$.ajax({
				url: './includes/common/ajax-handler.php',
				type: 'POST',
				data: {
					action	: 'remove-leave',
					leaveId	: leaveId,
				},
				beforeSend : function( ){
					//** before Send
					$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
				},
				success: function(response) {
					if( response > 0 ){
						$( '#leaveList tr#leave-'+leaveId ).remove();
						$('body').prepend('<div class="notification-message alert alert-success">Leave has been updated.</div>');
					}else{
						$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
					}
					$('body .lds-ellipsis').remove();
					setTimeout(function(){
			        	$('body .notification-message').remove();
			        }, 1500);
				},
				error: function(log) {
					console.log(log.message);
				}
			});
	    }
    });
    // Overtime Approve
    $('#ovetimeList .action').on('click', 'button.approval', function(e){
    	e.preventDefault();
    	var otId 		= $(this).attr('data-id');
    	var otStatus 	= $(this).attr('data-status');
    	$.ajax({
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'overtime-action',
				otId	: otId,
				otStatus : otStatus,
			},
			beforeSend : function( ){
				//** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(response) {
				var newStatus = 1;
				if( otStatus == 1 ) {
					var newStatus = 0;
				}
				var statusLabel = 'Not approved';
				var buttonLabel = 'Approved';
				if( newStatus == 1 ){
					statusLabel = 'Approved';
					buttonLabel = 'Not approved';
				}
				if( response > 0 ){
					$( '#ovetimeList tr#ot-'+otId+' .action button.approval' ).html(buttonLabel).attr('data-status', newStatus );
					$( '#ovetimeList tr#ot-'+otId+' .status' ).html(statusLabel);
					$('body').prepend('<div class="notification-message alert alert-success">Overtime has been updated.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				$('body .lds-ellipsis').remove();
				setTimeout(function(){
		        	$('body .notification-message').remove();
		        }, 1500);
			},
			error: function(log) {
				console.log(log.message);
			}
		});
    });
    $('#ovetimeList .action').on('click', 'button.delete', function(e){
    	e.preventDefault();
    	var confirmation = confirm('Are you sure you want to delete this Ovetime?');
    	if( confirmation ){
	    	var otID 		= $(this).attr('data-id');
	    	$.ajax({
				url: './includes/common/ajax-handler.php',
				type: 'POST',
				data: {
					action	: 'remove-overtime',
					otID	: otID,
				},
				beforeSend : function( ){
					//** before Send
					$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
				},
				success: function(response) {
					if( response > 0 ){
						$( '#ovetimeList tr#ot-'+otID ).remove();
						$('body').prepend('<div class="notification-message alert alert-success">Overtime has been updated.</div>');
					}else{
						$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
					}
					$('body .lds-ellipsis').remove();
					setTimeout(function(){
			        	$('body .notification-message').remove();
			        }, 1500);
				},
				error: function(log) {
					console.log(log.message);
				}
			});
	    }
	});
	// Apply Overtime
    $('#addUserOvertime-form').on('submit', function( e ){
		e.preventDefault();
		var biometricID 	= $('#addUserOvertime-form #biometricID').val();
        var overtimeDate   	= $('#addUserOvertime-form #overtimeDate').val();
        var timeStart   	= $('#addUserOvertime-form #time-start').val();
        var timeEnd   		= $('#addUserOvertime-form #time-end').val();
		var notes   		= $('#addUserOvertime-form #notes').val();
        if( timeStart == '' && timeEnd == '' && notes == '' ){
            alert( 'Please fill all fields.' );
		}
        $.ajax({
            url: './includes/common/ajax-handler.php',
            type: "post",
            typeData: 'JSON',
            data: {
				action : 'add-overtime',
				biometricID : biometricID,
                overtimeDate : overtimeDate,
                timeStart : timeStart,
                timeEnd : timeEnd,
                notes : notes
            },
        beforeSend: function() {
            $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        },  
        success: function (response) {  
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
            }, 1500);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           alert('error');       
        }
        });
    });

	/* Helper function */
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
	// Download Time Log
	$('#download-log').on('click', function(e){
		e.preventDefault();
		var timeLog = $('#time-log').data('log');
		var fullName = $('#employee-name').text();
		var biomID = $('#biom-id').text();
		var dateFrom = $('#date-from').text();
		var dateTo = $('#date-to').text();
		$.ajax({
            // url: './includes/common/ajax-handler.php',
            url: './includes/common/ajax-handler.php',
            type: "post",
            // typeData: 'JSON',
            data: {
				action 		: 'logdownload',
				timeLog 	: timeLog,
                fullName 	: fullName,
                dateFrom 	: dateFrom,
                dateTo 		: dateTo,
                biomID 		: biomID
            },
			beforeSend: function() {
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},  
			success: function (response) {  
				$('body .lds-ellipsis').remove();
				$data = JSON.parse(response);
				if($.isEmptyObject($data)) {
					alert( 'Something went wrong!' );
					return;
				} else {
					download_file( $data.file_url, $data.file_name );
					return;
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('error');       
			}
        });
		// window.location.href = window.location.href + "?logdownload=1&timeLog="+timeLog+"&fullName="+fullName+"&dateFrom="+dateFrom+"&dateTo="+dateTo;
	});
	// Validation
	// ***************************************************************************************************
	//** Validation for currentcy and number
	$("input.price, input.number").keydown(function (e) {
		validateCurrency(e)
	});
	$("input.qty").keydown(function (e) {
		validateNumber(e);
	});
	function validateCurrency(e){
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
	}
	//** Script for number
	function validateNumber(e){
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105) ) {
            e.preventDefault();
        }
    }
    // Deduction auto complete
    $( '.deductions' ).bind('keyup change paste', function(e){
	    var parentID      = $(this).parent().parent().attr('id');
	    var net_salary    = 0;
	    var gSalary       = $('#'+parentID+' span.label_gross_salary').html();
	    var lateAmt       = $('#'+parentID+' span.label_late_amount').html();
	    var totalValue    = lateAmt;
	    $( '#'+parentID+' .deductions' ).each(function(e){
	      var curValue = $(this).val() ? $(this).val() : 0;
	      totalValue = parseFloat( curValue ) + parseFloat( totalValue );
	    });
	    net_salary = gSalary - totalValue;
	    $('#'+parentID+' .total_deductions').html( parseFloat( totalValue ).toFixed(3) );
	    $('#'+parentID+' .label_net_salary').html( parseFloat( net_salary ).toFixed(3) );
	    $('#'+parentID+' .label_taxable_income').html( parseFloat( net_salary ).toFixed(3) );

	    set_total_net();
	});
	// Adjustment auto complete
    $( '.adjustment' ).bind('keyup change paste', function(e){
	    var parentID      = $(this).parent().parent().attr('id');
	    var net_salary    = 0;

	    var receivable 	= get_receivable_salary( parentID );
	    var deductions  = get_deductions_salary( parentID );

	    net_salary = receivable - deductions;
	    
	    $('#'+parentID+' span.label_gross_salary').html( parseFloat( receivable ).toFixed(3) );
	    $('#'+parentID+' .total_deductions').html( parseFloat( deductions ).toFixed(3) );
	    $('#'+parentID+' .label_net_salary').html( parseFloat( net_salary ).toFixed(3) );
	    $('#'+parentID+' .label_taxable_income').html( parseFloat( net_salary ).toFixed(3) );

	    set_total_net();
	});
	// Leave Amount auto complete
	// $( '.leave_amount' ).bind('keyup change paste', function(e){
	// 	var parentID      = $(this).parent().parent().attr('id');
	// 	var net_salary    = 0;

	// 	var receivable 	= get_receivable_salary( parentID );
	// 	var deductions  = get_deductions_salary( parentID );

	// 	net_salary = receivable - deductions;
		
	// 	$('#'+parentID+' span.label_gross_salary').html( parseFloat( receivable ).toFixed(3) );
	// 	$('#'+parentID+' .total_deductions').html( parseFloat( deductions ).toFixed(3) );
	// 	$('#'+parentID+' .label_net_salary').html( parseFloat( net_salary ).toFixed(3) );
	// 	$('#'+parentID+' .label_taxable_income').html( parseFloat( net_salary ).toFixed(3) );

	// 	set_total_net();
	// });
	/**
	 * absent auto compute
	 */
	$('.abs_days').on('keyup change paste', function(){
		let $this = $(this);
		let init_salary = $this.closest('tr').find('.init_salary').val();
		let absent_amount = $this.closest('tr').find('.absent_amount');
		let total_abs_amt = parseFloat( ( init_salary * 2 ) / 21.75 ) * parseFloat( $this.val() ? $this.val() : 0 );
		absent_amount.val( total_abs_amt.toFixed(2) );
		absent_amount.trigger('change');
	});

	// holiday amount auto complete

	$( '.reg_holiday_amount, .sp_holiday_amount' ).bind('keyup change paste', function(e){
		var parentID      = $(this).parent().parent().attr('id');
		var net_salary    = 0;

		var receivable 	= get_receivable_salary( parentID );
		var deductions  = get_deductions_salary( parentID );

		net_salary = receivable - deductions;
		
		$('#'+parentID+' span.label_gross_salary').html( parseFloat( receivable ).toFixed(3) );
		$('#'+parentID+' .total_deductions').html( parseFloat( deductions ).toFixed(3) );
		$('#'+parentID+' .label_net_salary').html( parseFloat( net_salary ).toFixed(3) );
		$('#'+parentID+' .label_taxable_income').html( parseFloat( net_salary ).toFixed(3) );

		set_total_net();
	});

	// thirteenth amount auto complete

	$( '.thirteenth_pay' ).bind('keyup change paste', function(e){
		var _value     = $(this).val();
		var parentID   = $(this).parent().parent().attr('id');
		var net_salary = 0; 

		var receivable 	= get_receivable_salary( parentID );
		var deductions  = get_deductions_salary( parentID );

		let value = _value ? parseFloat( _value ) : parseFloat( 0 );

		net_salary = parseFloat( ( receivable - deductions ) + value );
		
		$('#'+parentID+' .label_net_salary').html( parseFloat( net_salary ).toFixed(3) );

		set_total_net();
	});

	function get_receivable_salary( rowID ){
		var receivableAmount = 0;
		$( '#'+rowID+' .receivable' ).each(function(e){
	      var curValue = $(this).val() ? $(this).val() : 0;
	      receivableAmount = parseFloat( curValue ) + parseFloat( receivableAmount );
	    });
	    return receivableAmount;
	}
	function get_deductions_salary( rowID ){
		var deductionAmount = ( $('#'+rowID+' span.label_late_amount').html() ) ? parseFloat( $('#'+rowID+' span.label_late_amount').html() ) : 0 ;
		$( '#'+rowID+' .deductions' ).each(function(e){
	      var curValue = $(this).val() ? $(this).val() : 0;
	      deductionAmount = parseFloat( curValue ) + parseFloat( deductionAmount );
	    });
	    return deductionAmount;
	}
	function set_total_net(){
		setTimeout(function(){
		var totalNetSalary = 0;
			$( '#payrollReportTable .label_net_salary' ).each(function(e){
				var netSalary = $(this).html();
				totalNetSalary = parseFloat( totalNetSalary ) + parseFloat(netSalary);
			});
			$('#payrollReportTable #grand_total_net').html( parseFloat( totalNetSalary ).toFixed(3) );
		}, 500);
	}
	// display current time
	function formatAMPM(date) {
		let hours = date.getHours();
		let minutes = date.getMinutes();
		let seconds = date.getSeconds();
		let ampm = hours >= 12 ? 'PM' : 'AM';
		hours = hours % 12;
		hours = hours ? hours : 12; // the hour '0' should be '12'
		hours = hours < 10 ? '0'+hours : hours;
		minutes = minutes < 10 ? '0'+minutes : minutes;
		seconds = seconds < 10 ? '0'+seconds : seconds;
		let strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
		return strTime;
	}
	let timeHolder = $('span#real-time');
	setInterval(() => {
		let currentTime = formatAMPM(new Date());
		timeHolder.html(currentTime);
	}, 1000);

	// clock in and out button
	$('button.clock-btn').on('click', function(){
		let $this = $(this);
		let userId = $this.attr('data-user_id');
		let checktype = $this.attr('data-checktype');
		let am_pm_in = $this.attr('data-am_pm_in');
		let am_time_in = $this.attr('data-am_time_in');
		let pm_time_in = $this.attr('data-pm_time_in');
		if(userId){
			$.ajax({
				url: './includes/common/ajax-handler.php',
				type: "post",
				data: {
					action: 'clock-in-out-attendance',
					userId: userId,
					checktype: checktype,
					am_pm_in: am_pm_in,
					am_time_in: am_time_in,
					pm_time_in: pm_time_in,
				},
				beforeSend: function() {
					$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
					$this.attr('disabled', true);
				},  
				success: function (response) {
					$('body .lds-ellipsis').remove();
					let {message, type} = JSON.parse(response);
					$('body').prepend(`<div class="notification-message alert alert-${type}">${message}</div>`);
					setTimeout(function(){
						$('body .notification-message').remove();
						window.location.reload();
					}, 3000);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$('body .lds-ellipsis').remove();
					alert('error');       
				}
			});
		}
	});
});