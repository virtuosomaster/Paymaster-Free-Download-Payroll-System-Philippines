<?php 

$page_basename 	= pathinfo( $_SERVER['PHP_SELF'] );
$page_file 		= $page_basename['basename'];
?>
<div>
  <div class="tabs-main">
    <!-- Main Menu List -->
    <ul>
      <li class="<?php echo ($page_file == "personal-info.php" || $page_file == "update-user.php") ? "active" : ""; ?>"><a id = "personal-info" href="<?php echo $siteHostAdmin; ?>personal-info.php?uid=<?php echo $_GET['uid']; ?>" class="header tabs-ui">Personal Info</a></li>
      <li class="<?php echo $page_file == "qualifications.php" ? "active" : ""; ?>"><a id = "qualifications" href="<?php echo $siteHostAdmin; ?>qualifications.php?uid=<?php echo $_GET['uid']; ?>" class="header tabs-ui">Qualifications</a></li>
      <li class="<?php echo $page_file == "employee-history.php" ? "active" : ""; ?>"><a id = "emp-history" href="<?php echo $siteHostAdmin; ?>employee-history.php?uid=<?php echo $_GET['uid']; ?>" class="header tabs-ui">Employment History</a></li>
      <li class="<?php echo $page_file == "contract-terms.php" ? "active" : ""; ?>"><a id = "contract-terms" href="<?php echo $siteHostAdmin; ?>contract-terms.php?uid=<?php echo $_GET['uid']; ?>" class="header tabs-ui">Employment Contract</a></li>
      <li class="<?php echo $page_file == "salary-benefits.php" ? "active" : ""; ?>"><a id = "salary" href="<?php echo $siteHostAdmin; ?>salary-benefits.php?uid=<?php echo $_GET['uid']; ?>" class="header tabs-ui">Salary/Benefits Information</a></li>
      <li class="<?php echo $page_file == "loans-leave.php" ? "active" : ""; ?>"><a id = "loans-leaves" href="<?php echo $siteHostAdmin; ?>loans-leave.php?uid=<?php echo $_GET['uid']; ?>" class="header tabs-ui">Loans, Leave & Schedule</a></li>
    </ul>
  </div>
</div>

<style>
  .tabs-main ul {
    display: inline-flex !important;
    list-style: none !important;
    width: 100% !important;
    padding: 0 !important;
    flex-wrap: wrap !important;
  }

  .tabs-main ul li {
      padding: 5px 10px !important;
      border: 1px solid #f0f0f0 !important;
      text-align: center !important;
  }

  .tabs-main ul li a {
      font-size: 12px !important;
      text-align: center !important;
      line-height: 14px !important;
  }
  .tabs-main ul li a:hover {
    text-decoration: none;
  }
  .tabs-main ul li:hover, .tabs-main ul li:active, .tabs-main ul li.active {
      background-color: #254a87 !important;
  }
  .tabs-main ul li:hover a, .tabs-main ul li:active a, .tabs-main ul li.active a {
    color: #ffffff;
  }
  /* .breadcrumb.bg-info.text-white {
    background-color: #254a87 !important;
  } */
</style>
    