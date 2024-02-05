<div>
  <div class="tabs">
    <!-- Main Menu List -->
    <ul>
      <li><a href="#tab-1" class="main-tab selected">Personal Info</a></li>
      <li><a href="#tab-2" class="main-tab">Qualifications</a></li>
      <li><a href="#tab-3" class="main-tab">Employee History</a></li>
      <li><a href="#tab-4" class="main-tab">Family</a></li>
      <li><a href="#tab-5" class="main-tab">Salary/Benefits Information</a></li>
      <li><a href="#tab-6" class="main-tab">Contract Terms</a></li>
      <li><a href="#tab-7" class="main-tab">Resignation</a></li>
      <li><a href="#tab-8" class="main-tab">Loans & Leave</a></li>
      <li><a href="#tab-9" class="main-tab">Files & Memo</a></li>
      <li><a href="#tab-10" class="main-tab">Organization</a></li>
    </ul>
    <!-- Submenu and content for personal information -->
    <div id="tab-1" class="inner-tab">
      <div>
        <div class="tabs">
          <ul>
            <li><a href="#bulktab-1" class="main-tab selected">Personal Info 1</a></li>
            <li><a href="#bulktab-2" class="main-tab">Personal Info 2</a></li>
            <li><a href="#bulktab-3" class="main-tab">Legal Document</a></li>
            <li><a href="#bulktab-4" class="main-tab">Emergency Contact</a></li>
          </ul>
          <div id="bulktab-1">
            <?php include_once(ABSPATH.'/templates/update-user/personal-info.php'); ?>
            <?php include_once(ABSPATH.'/templates/update-user/contact-info.php'); ?>
            <?php include_once(ABSPATH.'/templates/update-user/assignment-info.php'); ?>
          </div>
          <div id="bulktab-2">
            2 - Second level tab content
          </div>
          <div id="bulktab-3">
            3 - Second level tab content
          </div>
          <div id="bulktab-4">
            4 - Second level tab content
          </div>
        </div>
      </div>
    </div>
    <!-- This section is for the sebmenu and content of Qualifications -->
    <div id="tab-2" class="inner-tab">
      <div>
        <div class="tabs">
            <ul>
                <li><a href="#qualitab-1" class="main-tab selected">Education</a></li>
                <li><a href="#qualitab-2" class="main-tab">Technical Terms</a></li>
                <li><a href="#qualitab-3" class="main-tab">Other Skills</a></li>
                <li><a href="#qualitab-4" class="main-tab">Training</a></li>
            </ul>
            <div id="qualitab-1" class="inner-tab">
                2 - Second level tab content
            </div>
            <div id="qualitab-2">
                2 - Second level tab content
            </div>
            <div id="qualitab-3">
                3 - Second level tab content
            </div>
            <div id="qualitab-4">
                3 - Second level tab content
            </div>
            </div>
      </div>
    </div>
    <!-- This section is for the sebmenu and content of Employee -->
    <div id="tab-3">
      <div>
        Employee History
      </div>
    </div>
    <!-- This section is for the sebmenu and content of Family -->
    <div id="tab-4" class="inner-tab">
      <div>
        <div class="tabs">
            <ul>
                <li><a href="#famtab-1" class="main-tab selected">Family Relationship</a></li>
                <li><a href="#famtab-2" class="main-tab">PIT Dependent Document</a></li>
            </ul>
            <div id="famtab-1">
                2 - Second level tab content
            </div>
            <div id="famtab-2">
                2 - Second level tab content
            </div>
        </div>
      </div>
    </div>
    <!-- This section is for the sebmenu and content of Salary and Benefits -->
    <div id="tab-5" class="inner-tab">
      <div>
        <?php include_once(ABSPATH.'/templates/update-user/salary-info.php'); ?>
        <?php include_once(ABSPATH.'/templates/update-user/deductions-info.php'); ?>
      </div>
    </div>
    <!-- This section is for the sebmenu and content of Contract -->
    <div id="tab-6" class="inner-tab">
      <div>
        <div class="tabs">
            <ul>
                <li><a href="#contracttab-1" class="main-tab selected">Contracts</a></li>
                <li><a href="#contracttab-2" class="main-tab">Contract History</a></li>
            </ul>
            <div id="contracttab-1">
                2 - Second level tab content
            </div>
            <div id="contracttab-2">
                2 - Second level tab content
            </div>
        </div>
      </div>
    </div>
    <div id="tab-7" class="inner-tab">
      <div>
        <?php include_once(ABSPATH.'/templates/update-user/salary-info.php'); ?>
        <?php include_once(ABSPATH.'/templates/update-user/deductions-info.php'); ?>
      </div>
    </div>
  </div>
</div>

<script>
    $(".tabs").tabs({
        activate: function(event, ui) {
            window.location.hash = ui.newPanel.attr('id');
        }
    });
</script>

<style>
.inner-tab {padding: 0 !important;border: none !important;}
.main-tab {padding: 5px !important;}
</style>