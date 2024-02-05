<script>
    Dropzone.autoDiscover = false;
    jQuery(document).ready(function( $ ){        
        var myDropzone = new Dropzone("#filemanagerdropzoneform",{
            acceptedFiles: "image/*, application/pdf, .doc, .docx, .csv, .xls, .xlsx",
            maxFiles: 1,
            uploadMultiple: false,
            maxFilesize: 4, // 5 MB
            addRemoveLinks: true,
            dictRemoveFile: 'Remove',
            init: function() {
                this.on("sending", function(file, xhr, formData) {
                    formData.append("name", "value"); // Append all the additional input data of your form here!
                });
                this.on("success", function(file, xhr, formData) {
                    var fileData = JSON.parse(xhr);
                    if( file.status !== 'error' && fileData.status !== 'error' ){
                        $('#filemanager-form input[name="file_id"]').val( fileData.file_id );
                    }else{
                        alert( file.message  );
                    }
                });
                this.on("complete", function(file) {
                    if( file.status !== 'error'){
                        // this.removeFile(file);
                    }
                });
                this.on("removedfile", function(file) {            
                    var fileID = $('#filemanager-form input[name="file_id"]').val();
                    if( fileID ){
                        $.ajax({
                            url: './includes/common/ajax-handler.php',
                            type: "post",
                            data: {
                                action : 'delete-fileupload',
                                fileID : fileID,
                            },
                            beforeSend: function() {
                                $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
                            },
                            success: function (response) {
                                $('body .lds-ellipsis').remove();
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert('Error Deleting fiels to server.');
                            }
                        });
                        $('#filemanager-form input[name="file_id"]').val( '' );  
                    }
                      
                });
            }
        });

        $('body').on('click', '.file-manager', function(){         
            $('#filemanagerdropzoneform input[name="dirname"]').val('');
            $('#filemanager-form input[name="file_id"]').val( '' );
            $('#filemanager-form #filename').val( '' );
            $('#filemanager-form #description').val( '' );
            var dirname = $(this).data('id');
            setTimeout(() => {
                $('#filemanagerdropzoneform input[name="dirname"]').val(dirname);
                myDropzone.removeAllFiles();
            }, 10 ); 
        });

        $('#filemanager-form').on('submit', function(e){
            e.preventDefault();
            var fileID      = $('#filemanager-form input[name="file_id"]').val();
            var fileName    = $('#filemanager-form #filename').val();
            var fileDesc    = $('#filemanager-form #description').val();
            var assignedTo  = 0;
            if( $('#filemanager-form #user_id').length ){
                assignedTo = $('#filemanager-form #user_id').val();
            }
            if( !fileID ){
                alert( 'No file found. Please upload file and try again.' );
                return
            }

            $.ajax({
                url: './includes/common/ajax-handler.php',
                type: "post",
                data: {
                    action : 'update-fileupload',
                    fileID : fileID,
                    fileName: fileName,
                    fileDesc: fileDesc,
                    assignedTo : assignedTo
                },
                beforeSend: function() {
                    $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
                },
                success: function (response) {
                    $('#fileManagerModal').modal('hide')
                    $('body .lds-ellipsis').remove();
                    var data = JSON.parse(response);
                    if( data.status == 'error' ){
                        $('body').prepend('<div class="payroll notification-message alert alert-danger"><p>'+data.message+'</p></div>');
                        setTimeout(function(){
                            $('body .notification-message').remove();
                        }, 3000);
                    }else{
                        $('body').prepend('<div class="payroll notification-message alert alert-success"><p>'+data.message+'</p></div>');
                        setTimeout(function(){
                            $('body .notification-message').remove();
                        }, 3000);
                        if ($('#user-file-list').length == 1) {
                            if( assignedTo > 0 ){
                                $('#user-file-list tbody').prepend( 
                                    '<tr id="file-'+data.file_info.id+'">'+
                                        '<td>'+data.file_info.name+' <i class="fa fa-info-circle text-info ml-3" data-toggle="tooltip" data-placement="top" title="'+data.file_info.description+'"></i></td>'+
                                        '<td>'+data.file_info.upload_date+'</td>'+
                                        '<td>'+data.file_info.uploaded_name+'</td>'+
                                        '<td>'+data.file_info.assigned_name+'</td>'+
                                        '<td>'+data.file_info.type+'</td>'+
                                        '<td>'+
                                            '<i class="download-file fa fa-download mr-3 text-primary" data-id="'+data.file_info.id+'" aria-hidden="true"></i> '+
                                            '<i class="delete-file fa fa-trash mr-3 text-danger" data-id="'+data.file_info.id+'" aria-hidden="true"></i>'+
                                        '</td>'+
                                    '</tr>'
                                );
                            }else{
                                $('#user-file-list tbody').prepend( 
                                    '<tr id="file-'+data.file_info.id+'">'+
                                        '<td>'+data.file_info.name+' <i class="fa fa-info-circle text-info ml-3" data-toggle="tooltip" data-placement="top" title="'+data.file_info.description+'"></i></td>'+
                                        '<td>'+data.file_info.upload_date+'</td>'+
                                        '<td>'+data.file_info.type+'</td>'+
                                        '<td>'+
                                            '<i class="download-file fa fa-download mr-3 text-primary" data-id="'+data.file_info.id+'" aria-hidden="true"></i> '+
                                            '<i class="delete-file fa fa-trash mr-3 text-danger" data-id="'+data.file_info.id+'" aria-hidden="true"></i>'+
                                        '</td>'+
                                    '</tr>'
                                );
                            }
                            
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error Deleting fiels to server.');
                }
            });
        });
        // Delete file
        $('body').on('click', '.delete-file', function(e){    
            e.preventDefault();
            var confirmation = confirm('Are you sure you want to delete this file?');
            var fileID = $(this).data('id');
            if( fileID && confirmation ){
                $.ajax({
                    url: './includes/common/ajax-handler.php',
                    type: "post",
                    data: {
                        action : 'delete-fileupload',
                        fileID : fileID,
                    },
                    beforeSend: function() {
                        $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
                    },
                    success: function (response) {
                        $('body .lds-ellipsis').remove();
                        if( response >= 1 ){
                            $('body').prepend('<div class="payroll notification-message alert alert-success"><p>File Successfully Deleted</p></div>');
                            
                            $('#user-file-list tr#file-'+fileID).remove();
                        }else{
                            $('body').prepend('<div class="payroll notification-message alert alert-danger"><p>Deleting file failed. Something went wrong during process.</p></div>');
                        }
                        setTimeout(function(){
                            $('body .notification-message').remove();
                        }, 3000);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Deleting file to server.');
                    }
                });
                $('#filemanager-form input[name="file_id"]').val( '' );  
            }
        });
        $('body').on('click', '.download-file', function(e){    
            e.preventDefault();
            var fileID = $(this).data('id');
            if( fileID ){
                $.ajax({
                    url: './includes/common/ajax-handler.php',
                    type: "post",
                    data: {
                        action : 'download-file',
                        fileID : fileID,
                    },
                    beforeSend: function() {
                        $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
                    },
                    success: function (response) {
                        var data = JSON.parse(response);
                        console.log(data);
                        $('body .lds-ellipsis').remove();
                        if( data.status == 'error'){
                            alert( data.message );
                        }else{
                            var file_type = data.file_type;
                            if( file_type.indexOf("image") || file_type.indexOf("pdf") ){
                                download_file( data.file_url, data.file_name );
                            }else{
                                window.location.href = data.file_url;
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Downloading file to server.');
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
</script>

