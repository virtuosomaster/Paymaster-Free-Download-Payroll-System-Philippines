<?php include_once('header.php'); ?>
<?php
  $timesheet_name   = "employee-import-template.csv";
  $csv_file         = fopen($timesheet_name, "w");
  fputcsv( $csv_file, 
    array_values(import_emprecord_template_header()) 
  );
  fclose($csv_file);
?>
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Import Employee</li>
  </ol>
  <div class="row">
    <div class="col-md-6">
      <h2>Download Template</h2>
      <div class="import-template-wrapper">
        <p class="text-danger mt-3">Please download the csv template <a href="#" class="text-primary download-import-employee-template">here.</a></p>
      </div>
      <h2>Import Employee</h2>
      <div class="import-form-wrapper">
        <form action="#" method="post" id="import-employee-form" enctype="multipart/form-data">
          <input type="file" name="emp-record" class="mt-3" id="emp-record" accept=".csv, application/vnd.ms-excel" required />
          <div class="button-left mt-3">
            <button type="submit" class="btn btn-success btn-sm pm-blue">Import CSV</button>
            <input type="hidden" name="action" value="import-employees" />
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-6">
      <h2>Results</h2>
      <button class="btn btn-success btn-sm mb-1 d-none clear-import-results pm-blue" type="button">Clear results</button>
      <div id="import-results-wrapper" style="height: 300px; overflow-y: scroll;">
      </div>
    </div>
  </div>
</div><!-- .container-fluid -->    
<?php include_once('footer.php'); ?>
<script>
  jQuery(document).ready(function($) {
    // download import employee template ajax code
    $('.download-import-employee-template').on('click', function() {
      $.ajax({
        url: './includes/common/ajax-handler.php',
        type: "post",
        data: {
          action: 'download-import-employee-template'
        },
        beforeSend: function() {
          $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        },
        success: function (response) {
          $('body .lds-ellipsis').remove();
          window.open(response, '_blank');
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Something went wrong!');
        }
      });
    });
    $('#import-employee-form').on('submit', function(e){
      e.preventDefault();
      let $data = new FormData(this);
      $.ajax({
        url: './includes/common/ajax-handler.php',
        type: "post",
        data: $data,  
        contentType: false,          // The content type used when sending data to the server.  
        cache: false,                // To unable request pages to be cached  
        processData: false,
        beforeSend: function() {
          $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        },
        success: function (response) {
          $('body .lds-ellipsis').remove();
          if( response ) {
            let parsedResponse = JSON.parse( response );
            let parsedResponseLength = parsedResponse.length;
            // append results on by one
            for( let i = 0; i < parsedResponseLength; i++ ) {
              const { status, message } = parsedResponse[i];
              $('#import-results-wrapper').append(`<p class="alert alert-${status} p-1 mb-1 import-results" role="alert">${message}</p>`);
            }
            $('.clear-import-results').removeClass('d-none');
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Something went wrong!');
        }
      });
    });
    $('.clear-import-results').on('click', function(){
      // clear results one by one
      let importResults = $('#import-results-wrapper p.import-results');
      importResults.each(function( index, element ){
        $(this).fadeOut();
      });
      $(this).addClass('d-none');
    });
  });
</script>