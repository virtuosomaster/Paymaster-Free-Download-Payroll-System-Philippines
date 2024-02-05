<div class = "sub-header">
  <!-- Tabs navs -->
  <div class="tabs">
  <ul id="tabs-nav">
    <li><a href="#quali1">Education</a></li>
    <li><a href="#quali2">Technical Skills</a></li>
    <li><a href="#quali3">Other Skills</a></li>
  </ul> <!-- END tabs-nav -->
  <div id="tabs-content">
    <div id="quali1" class="tab-content">
      <?php include_once(ABSPATH.'/templates/update-user/qualifications/education.php'); ?>
    </div>
    <div id="quali2" class="tab-content">
      <?php include_once(ABSPATH.'/templates/update-user/qualifications/technical-skills.php'); ?>
    </div>
    <div id="quali3" class="tab-content">
      <?php include_once(ABSPATH.'/templates/update-user/qualifications/other-skills.php'); ?>
    </div>
    <div id="quali4" class="tab-content">
      <?php include_once(ABSPATH.'/templates/update-user/qualifications/training.php'); ?>
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