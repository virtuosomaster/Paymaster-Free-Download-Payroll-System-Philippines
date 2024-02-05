<div class = "sub-header">
  <!-- Tabs navs -->
  <div class="tabs">
  <ul id="tabs-nav">
  </ul> <!-- END tabs-nav -->
  <div id="tabs-content">
    <div id="quali1" class="tab-content">
      <?php include_once(ABSPATH.'/templates/update-user/contract-terms/contracts-tab.php'); ?>
    </div>
    <div id="quali2" class="tab-content">
      <?php include_once(ABSPATH.'/templates/update-user/contract-terms/contract-history-tab.php'); ?>
    </div>
  </div> <!-- END tabs-content -->
</div> <!-- END tabs -->

</div>

<script>
  jQuery(document).ready(function($){
    $('#tabs-nav li:first-child').addClass('active');
    $('.tab-content').hide();
    $('.tab-content:first').show();

    // Click function
    $('#tabs-nav li').click(function(){
      $('#tabs-nav li').removeClass('active');
      $(this).addClass('active');
      $('.tab-content').hide();
      
      var activeTab = $(this).find('a').attr('href');
      $(activeTab).fadeIn();
      return false;
    });
  });
</script>