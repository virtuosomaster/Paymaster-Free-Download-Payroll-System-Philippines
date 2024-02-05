<div class = "sub-header">
  <!-- Tabs navs -->
  <div class="tabs">
  <ul id="tabs-nav">
    <li><a href="#tab1">Personal Info 1</a></li>
    <li><a href="#tab2">Personal Info 2</a></li>
    <li><a href="#tab3">Legal Documents</a></li>
    <li><a href="#tab4">Emergency Contact</a></li>
  </ul> <!-- END tabs-nav -->
  <div id="tabs-content">
    <div id="tab1" class="tab-content">
      <?php include_once(ABSPATH.'/templates/update-user/personal-info.php'); ?>
    </div>
    <div id="tab2" class="tab-content">
      <?php include_once(ABSPATH.'/templates/update-user/personal-info-2.php'); ?>
    </div>
    <div id="tab3" class="tab-content">
      <?php include_once(ABSPATH.'/templates/update-user/legal-info.php'); ?>
    </div>
    <div id="tab4" class="tab-content">
      <?php include_once(ABSPATH.'/templates/update-user/contact-info.php'); ?>
    </div>
    <div id="tab5" class="tab-content">
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
      //return false;
    });
  });
</script>