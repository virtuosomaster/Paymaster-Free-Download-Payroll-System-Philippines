<div class = "sub-header">
  <div class="tabs">
  <ul id="tabs-nav">
    <li><a href="#quali1">Family Relationship</a></li>
    <!-- <li><a href="#quali2">PIT Dependant Document</a></li> -->
  </ul>
  <div id="tabs-content">
    <div id="quali1" class="tab-content">
      <?php include_once(ABSPATH.'/templates/update-user/family/family-relationship.php'); ?>
    </div>
    <div id="quali2" class="tab-content">
      <?php include_once(ABSPATH.'/templates/update-user/family/pit-dependant-doc.php'); ?>
    </div>
  </div> 
</div> 

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