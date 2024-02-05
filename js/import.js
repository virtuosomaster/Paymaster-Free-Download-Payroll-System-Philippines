jQuery(document).ready( function($){
  $('#import-timecard').on('submit', function( e ){
    e.preventDefault();
    var fileData = new FormData(this);
    $.ajax({
      url: './includes/common/ajax-handler.php',
      type: "post",
      data:  new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function() {
        $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
      },
      success: function (response) {
        var data = JSON.parse(response);
        $('body .lds-ellipsis').remove();
        if( data.status == 'Success' ){
            $( '#import-form-wrapper' ).append( '<div id="tc-import-result" class="container mt-4 bg-info p-2 text-white "><p >File has been uploaded...</p></div>');
            setTimeout(function(){
              $( '#import-form-wrapper #tc-import-result' ).append('<p>Start to process records...</p>');
            },2000);
            var records     = data.records;
            var deviceID    = data.device_id;
            var fileName    = data.filename;
            var recordCount = records.length - 1;
            for( let i = 0; i < records.length; i++ ){
              setTimeout(function(){
                save_timecard( fileName, deviceID, records[i], recordCount, i );
              }, 2000);
            }          
        }else{
          $('body').prepend('<div class="payroll notification-message alert alert-danger" style="width: 100%; height: 100%; background-color: #f8d7dad9;"><div id="error-wrapper" style="padding:18px;background-color:#fff;"><p>'+data.message+'</p></div></div>');
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
         alert('error');
      }
    });
  });

  function save_timecard( fileName, deviceID, timeCard, recordCount, index ){
    var listNumber = index + 1;
    var lastRecord = 0;
    if( recordCount == index ){
      lastRecord = 1;
    }
    $.ajax({
      url: './includes/common/ajax-handler.php',
      type: "post",
      data: {
        action : 'process-timecard',
        timeCard : timeCard,
        deviceID : deviceID,
        lastRecord : lastRecord,
        fileName : fileName
      },
      beforeSend: function() {
        //** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
      },
      success: function (response) {
        console.log(response);
        $('body .lds-ellipsis').remove();
        $( '#import-form-wrapper #tc-import-result' ).append('<p>'+ listNumber +'. '+response+'</p>');
        setTimeout(function(){
          if( lastRecord == 1 ){
            $( '#import-form-wrapper #tc-import-result' ).append('<p>+++++++++++++++++++++++++++++ Process End +++++++++++++++++++++++++++++ </p>');
          }
        }, 2000);
      },
      error: function(jqXHR, textStatus, errorThrown) {
         alert('error');
      }
    });
  }

  // Import Employee
  $('#import-emprecord').on('submit', function( e ){
    e.preventDefault();
    var fileData = new FormData(this);
    console.log(fileData);
    $( '#import-form-wrapper #tc-import-result' ).remove();
    $.ajax({
      url: './includes/common/ajax-handler.php',
      type: "post",
      data:  new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function() {
        console.log('==========BEfore Send ======================');
        $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
      },
      success: function (response) {

        console.log( 'response++++++++++++++++++++++++++++++');
        console.log( response );

        var data = JSON.parse(response);

        console.log(data);
        $('#import-emprecord #uploadImage').val('');


        if( data.status == 'Success' ){
          $( '#import-form-wrapper' ).append( '<div id="tc-import-result" class="container mt-4 bg-secondary p-2 text-white "><p >File has been uploaded...</p></div>');
            setTimeout(function(){
              $( '#import-form-wrapper #tc-import-result' ).append('<p>Start to process records...</p>');
            },2000);
            var fileName    = data.filename;
            var records     = data.records;
            var recordCount = records.length - 1;
            for( let i = 0; i < records.length; i++ ){
              setTimeout(function(){
                save_emprecord( fileName, records[i], recordCount, i );
              }, 2000);
            }          
        }else{
          $('body').prepend('<div class="payroll notification-message alert alert-danger" style="width: 100%; height: 100%; background-color: #f8d7dad9;"><div id="error-wrapper" style="padding:18px;background-color:#fff;"><p>'+data.message+'</p></div></div>');
        }
        $('body .lds-ellipsis').remove();
      },
      error: function(jqXHR, textStatus, errorThrown) {
         alert('error');
      }
    });
  });
  function save_emprecord( fileName,empRecord, recordCount, index ){
    var listNumber = index + 1;
    var lastRecord = 0;
    if( recordCount == index ){
      lastRecord = 1;
    }
    $.ajax({
      url: './includes/common/ajax-handler.php',
      type: "post",
      data: {
        action : 'process-emprecord',
        lastRecord : lastRecord,
        empRecord : empRecord,
        fileName : fileName
      },
      beforeSend: function() {
        //** before Send
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
      },
      success: function (response) {
        $('body .lds-ellipsis').remove();
        $( '#import-form-wrapper #tc-import-result' ).append('<p>'+ listNumber +'. '+response+'</p>');
        setTimeout(function(){
          if( lastRecord == 1 ){
            $( '#import-form-wrapper #tc-import-result' ).append('<p>+++++++++++++++++++++++++++++ Process End +++++++++++++++++++++++++++++ </p>');
          }
        }, 2000);
      },
      error: function(jqXHR, textStatus, errorThrown) {
         alert('error');
      }
    });
  }
});