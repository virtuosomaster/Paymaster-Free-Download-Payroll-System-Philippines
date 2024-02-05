<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    * {
      margin: 0px;
      padding: 0px;
      box-sizing: border-box;
      font-family: 'Helvetica';
    }
    body {
      padding: 15px;
    }
    table,
    table th,
    table td {
      border: 1px solid #000000;
    }
    table {
      width: 100%;
      border: 0.001em solid #000000;
      border-spacing: 0;
    }
    table thead {
      background-color: #f7f7f7;
    }
    table tr {
      padding: 25px;
      text-align: center;
    }
    table tr th,
    table tr td {
      padding: 15px 0px;
    }
    .flex {
      display: flex;
    }
    .header-left,
    .header-right {
      width: 50%;
    }
    #header {
      margin-bottom: 30px;
    }
    .bold {
      font-weight: 600;
      padding: 5px 0px;
    }
    .normal {
      font-weight: 400;
    }
  </style>
</head>
<body>
  <div id="header" class="flex">
    <div class="header-left">
      <img src="http://pm.virtuosomasterhosting.com/images/paycheckcloudlogo.png" alt="">
      <p class="bold">Address: <span class="normal">Dummy Address</span></p>
      <p class="bold">Phone: <span class="normal">Dummy Phone</span></p>
      <p class="bold">Email: <span class="normal">Dummy Email</span></p>
      <p class="bold">Website: <span class="normal">dummy.com</span></p>
    </div>
    <div class="header-right"></div>
  </div>
  <table>
    <thead>
      <tr>
        <th>Employee</th>
        <th>No. Of Days</th>
        <th>Daily Rate</th>
        <th>Initial Salary</th>
        <th>Gross Salary</th>
        <th>Late (time)</th>
        <th>Late (amount)</th>
        <th>Total Deductions</th>
        <th>Net Income</th>
      </tr>
    </thead>
    <tbody>
      <?php if (isset($_SESSION['nth_report']) && is_array($_SESSION['nth_report'])): ?>
        <?php foreach ($_SESSION['nth_report'] as $report): ?>
          <tr>
            <td><?php echo $report->employee; ?></td>
            <td><?php echo $report->num_days; ?></td>
            <td><?php echo $report->daily_rate; ?></td>
            <td><?php echo $report->init_salary; ?></td>
            <td><?php echo $report->gross_salary; ?></td>
            <td><?php echo $report->work_lates; ?></td>
            <td><?php echo $report->late_amount; ?></td>
            <td><?php echo $report->total_deductions; ?></td>
            <td><?php echo $report->thirteenth_amt; ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
    <tfoot></tfoot>
  </table>
</body>
</html>