
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Generate Payroll Report</li>
  </ol>
  <!-- Icon Cards-->
  <div id="payroll-report-wrapper" class="row">
    <div class="col-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          Payroll Report Form
        </div> <!-- card Header -->
        <div class="card-body">
          <form id="payroll-report-form" method="POST">
            <div class="form-row align-items-center">
              <div class="col-md-4 mb-3">
                <label class="sr-only" for="designation">Designation</label>
                <select class="designation-option form-control employee-option" id="designation">
                  <option value="0">All Designation</option>
                  <?php
                  $designations = $settings->get_settings_by_name('designation');
                  if (!empty($designations)) {
                    foreach ($designations as $designation) {
                      $designationID   = $designation->id;
                      $designationName = $designation->value;
                  ?><option value="<?php echo $designationID; ?>"><?php echo $designationName; ?></option><?php
                                                                                                        }
                                                                                                      }
                                                                                                          ?>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label class="sr-only" for="group">Group</label>
                <select class="group-option form-control employee-option" id="group">
                  <option value="0">All Group</option>
                  <?php
                  $groups = $settings->get_settings_by_name('group');
                  if (!empty($groups)) {
                    foreach ($groups as $group) {
                      $groupID   = $group->id;
                      $groupName = $group->value;
                  ?><option value="<?php echo $groupID; ?>"><?php echo $groupName; ?></option><?php
                                                                                            }
                                                                                          }
                                                                                              ?>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label class="sr-only" for="team">Team</label>
                <select class="team-option form-control employee-option" id="team">
                  <option value="0">All Team</option>
                  <?php
                  $teams = $settings->get_settings_by_name('team');
                  if (!empty($teams)) {
                    foreach ($teams as $team) {
                      $teamID   = $team->id;
                      $teamName = $team->value;
                  ?><option value="<?php echo $teamID; ?>"><?php echo $teamName; ?></option><?php
                                                                                          }
                                                                                        }
                                                                                            ?>
                </select>
              </div>
              <div class="form-group col-md-12">
                <label for="employeeList">Employee List ( To generate a salary report, please select an employee )</label>
                <select class="form-control" id="employeeList" name="employees[]" multiple="multiple" size="12" required="required" style="height: auto;">
                  <?php
                  $get_all_employees = $employee->get_all_employees(array('fname', 'lname', 'idd', 'access_level'));
                  if (!empty($get_all_employees)) {
                    foreach ($get_all_employees as $employee) {
                      if ($employee->access_level == 1) {
                        continue;
                      }
                  ?><option value="<?php echo $employee->idd; ?>" <?php echo in_array($employee->idd, $selected_user) ? 'selected' : ''; ?>><?php echo $employee->lname; ?>, <?php echo $employee->fname; ?></option><?php
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                  } else {
                                                                                                                                                                                                                      ?><option>NO Registered Employee Found</option><?php
                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                      ?>
                </select>
              </div>
              <div class="col-md-5 mb-3">
                <label class="sr-only" for="dateFrom">From</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">From</div>
                  </div>
                  <input type="text" class="form-control datepicker" id="dateFrom" name="dateFrom" placeholder="yyyy-mm-dd" value="<?php echo $dateFrom; ?>" required="required" autocomplete="off">
                </div>
              </div>
              <div class="col-md-5 mb-3">
                <label class="sr-only" for="dateTo">To</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">To</div>
                  </div>
                  <input type="text" class="form-control datepicker" id="dateTo" name="dateTo" placeholder="yyyy-mm-dd" value="<?php echo $dateTo; ?>" required="required" autocomplete="off">
                </div>
              </div>
              <div class="col-auto mb-3">
                <button type="submit" name="generate-payroll" class="btn btn-primary btn-lg pm-blue">Submit</button>
              </div>
            </div>
            <div class="form-row align-items-center">
              <div class="form-group col-md-12">
                <?php
                // $check_all_check_toggler   = ( isset($_POST['gsis-contri']) && isset($_POST['policy-loan']) && isset($_POST['gsis-loan']) && isset($_POST['ela-loan']) && isset($_POST['uniform']) && isset($_POST['neg_salary']) && isset($_POST['tax']) && isset($_POST['absences_col']) && isset($_POST['apply_sss_deduct']) && isset($_POST['apply_ph_deduct']) && isset($_POST['apply_hmdf_deduct']) ) ? 'checked' : '';
                $check_all_check_toggler   = (isset($_POST['gsis-contri']) && isset($_POST['uniform']) && isset($_POST['neg_salary']) && isset($_POST['tax']) && isset($_POST['absences_col']) && isset($_POST['apply_sss_deduct']) && isset($_POST['apply_ph_deduct']) && isset($_POST['apply_hmdf_deduct']) && $_POST['apply_thirteenth_pay']) ? 'checked' : '';
                $gsis_check_toggler        = isset($_POST['gsis-contri']) ? 'checked' : '';
                $policy_loan_check_toggler = isset($_POST['policy-loan']) ? 'checked' : '';
                $gsis_loan_check_toggler   = isset($_POST['gsis-loan']) ? 'checked' : '';
                $ela_loan_check_toggler    = isset($_POST['ela-loan']) ? 'checked' : '';
                $uniform_check_toggler     = isset($_POST['uniform']) ? 'checked' : '';
                $neg_salary_check_toggler  = isset($_POST['neg_salary']) ? 'checked' : '';
                $hourly_rate_check_toggler = isset($_POST['hourly_rate']) ? 'checked' : '';
                $premium_check_toggler     = isset($_POST['premium']) ? 'checked' : '';
                $tax_check_toggler         = isset($_POST['tax']) ? 'checked' : '';
                $abs_check_toggler         = isset($_POST['absences_col']) ? 'checked' : '';

                // 4.0.3 changes - DEDUCTION OPTIONS start

                $apply_sss_deduct  = isset($_POST['apply_sss_deduct']) ? 'checked' : '';
                $apply_ph_deduct   = isset($_POST['apply_ph_deduct']) ? 'checked' : '';
                $apply_hmdf_deduct = isset($_POST['apply_hmdf_deduct']) ? 'checked' : '';

                // 4.0.3 changes - end

                $apply_thirteenth_pay = isset($_POST['apply_thirteenth_pay']) ? 'checked' : '';

                ?>
                <div class="card">
                  <div class="card-header">
                    <div class="form-group">
                      <input type="checkbox" id="check-all" name="check-all" <?php echo $check_all_check_toggler; ?> />
                      <label for="check-all"> Check All</label>
                    </div>
                  </div>
                  <div class="card-body">
                    <p class="font-weight-bold">To display the information, please check the box(es).</p>
                    <div class="form-row align-items-center">
                      <div class="col-md-3 mb-3">
                        <input type="checkbox" id="gsis-contri" name="gsis-contri" <?php echo $gsis_check_toggler; ?> />
                        <label for="gsis-contri"> Insurance</label>
                      </div>
                      <div class="col-md-3 mb-3 d-none">
                        <input type="checkbox" id="policy-loan" name="policy-loan" <?php echo $policy_loan_check_toggler; ?> />
                        <label for="policy-loan"> GSIS Policy Loan</label>
                      </div>
                      <div class="col-md-3 mb-3 d-none">
                        <input type="checkbox" id="gsis-loan" name="gsis-loan" <?php echo $gsis_loan_check_toggler; ?> />
                        <label for="gsis-loan"> GSIS Emergency Loan</label>
                      </div>
                      <div class="col-md-3 mb-3 d-none">
                        <input type="checkbox" id="ela-loan" name="ela-loan" <?php echo $ela_loan_check_toggler; ?> />
                        <label for="ela-loan"> GSIS Consolidated Loan</label>
                      </div>
                      <div class="col-md-3 mb-3">
                        <input type="checkbox" id="uniform" name="uniform" <?php echo $uniform_check_toggler; ?> />
                        <label for="uniform"> Uniform</label>
                      </div>
                      <div class="col-md-3 mb-3 d-none">
                        <input type="checkbox" id="hourly_rate" name="hourly_rate" <?php echo $hourly_rate_check_toggler; ?> />
                        <label for="hourly_rate"> Rate/Hour</label>
                      </div>
                      <div class="col-md-3 mb-3">
                        <input type="checkbox" id="premium" name="premium" <?php echo $premium_check_toggler; ?> />
                        <label for="premium"> Rest Day Premium</label>
                      </div>
                      <div class="col-md-3 mb-3">
                        <input type="checkbox" id="neg_salary" name="neg_salary" <?php echo $neg_salary_check_toggler; ?> />
                        <label for="neg_salary"> Other Deductions</label>
                      </div>
                      <div class="col-md-3 mb-3">
                        <input type="checkbox" id="tax" name="tax" <?php echo $tax_check_toggler; ?> />
                        <label for="tax"> Withholding Tax</label>
                      </div>
                      <div class="col-md-3 mb-3">
                        <input type="checkbox" id="absences_col" name="absences_col" <?php echo $abs_check_toggler; ?> />
                        <label for="absences_col"> Absences</label>
                      </div>
                    </div>

                    <!-- 4.0.3 - changes - DEDUCTION OPTIONS - start -->

                    <div class="deductions-options-wrapper">
                      <p class="font-weight-bold">To apply the deduction value, please check the desired box(es).</p>
                      <div class="form-row">
                        <div class="col-md-3 mb-3">
                          <input type="checkbox" id="apply_sss_deduct" name="apply_sss_deduct" <?php echo $apply_sss_deduct; ?> />
                          <label for="apply_sss_deduct"> SSS</label>
                        </div>
                        <div class="col-md-3 mb-3">
                          <input type="checkbox" id="apply_ph_deduct" name="apply_ph_deduct" <?php echo $apply_ph_deduct; ?> />
                          <label for="apply_ph_deduct"> PhilHealth</label>
                        </div>
                        <div class="col-md-3 mb-3">
                          <input type="checkbox" id="apply_hmdf_deduct" name="apply_hmdf_deduct" <?php echo $apply_hmdf_deduct; ?> />
                          <label for="apply_hmdf_deduct"> HMDF</label>
                        </div>
                      </div>
                    </div>

                    <!-- 4.0.3 - changes - end -->

                    <div class="thirteenth-wrapper">
                      <p class="font-weight-bold">To manually enter the 13th month pay, please check the box.</p>
                      <div class="form-row">
                        <div class="col-md-3 mb-3">
                          <input type="checkbox" id="apply_thirteenth_pay" name="apply_thirteenth_pay" <?php echo $apply_thirteenth_pay; ?> />
                          <label for="apply_thirteenth_pay"> 13th Month Pay</label>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </form>
        </div> <!--  card-body -->
      </div> <!-- Card wrapper -->
    </div> <!-- Content Wrapper -->
    <div class="col-12 mb-3 <?php echo isset($_POST['generate-payroll']) ? '' : 'd-none'; ?>">
      <div class="card mb-3">
        <div class="card-header">
          Generated Report <?php echo $searched_date; ?>
        </div> <!-- card Header -->
        <div class="card-body">
          <?php
          if (isset($_POST['generate-payroll'])) {
            $dateFrom                  = $_POST['dateFrom'];
            $dateTo                    = $_POST['dateTo'];
            $users                     = $_POST['employees'];
            $gsis_class_toggler        = isset($_POST['gsis-contri']) ? '' : 'd-none';
            $policy_loan_class_toggler = isset($_POST['policy-loan']) ? '' : 'd-none';
            $gsis_loan_class_toggler   = isset($_POST['gsis-loan']) ? '' : 'd-none';
            $ela_loan_class_toggler    = isset($_POST['ela-loan']) ? '' : 'd-none';
            $uniform_class_toggler     = isset($_POST['uniform']) ? '' : 'd-none';
            $neg_salary_class_toggler  = isset($_POST['neg_salary']) ? '' : 'd-none';
            $hourly_rate_class_toggler = isset($_POST['hourly_rate']) ? 'd-none' : 'd-none';
            $premium_class_toggler     = isset($_POST['premium']) ? '' : 'd-none';
            $tax_class_toggler         = isset($_POST['tax']) ? '' : 'd-none';
            $abs_class_toggler         = isset($_POST['absences_col']) ? '' : 'd-none';
            // $deductions_col_span       = 12;
            $deductions_col_span       = 9;
            if (!isset($_POST['gsis-contri'])) {
              $deductions_col_span--;
            }
            if (!isset($_POST['uniform'])) {
              $deductions_col_span--;
            }
            if (!isset($_POST['neg_salary'])) {
              $deductions_col_span--;
            }
            $thirteenth_pay_class_toggler = isset($_POST['apply_thirteenth_pay']) ? '' : 'd-none';
          ?>
            <form id="generate-payroll-form" method="POST" action="<?php echo $siteHostAdmin; ?>payroll-list.php">
              <div id="payrollReportTable-wrapper">
                <table class="table table-bordered" id="payrollReportTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="table-header">
                      <td rowspan="3">#</td>
                      <td rowspan="3" class="fullname">Full Name</td>
                      <td rowspan="3">No. of Days</td>
                      <td rowspan="3">No. of Hours</td>
                      <td rowspan="3" class="<?php echo $hourly_rate_class_toggler ?>">Rate/Hr.</td>
                      <td rowspan="3">Daily Rate</td>
                      <td rowspan="3">Initial Salary</td>
                      <td colspan="2">Leave</td>
                      <td rowspan="3">Regular Holiday</td>
                      <td rowspan="3">Special Holiday</td>
                      <td rowspan="3" class="<?php echo $premium_class_toggler; ?>">Rest Day Prem.</td>
                      <td rowspan="3">Overtime</td>
                      <td rowspan="3">Night Diff.</td>
                      <td rowspan="3">Adjustment</td>
                      <td rowspan="3">Allowance</td>
                      <td rowspan="3">Gross Salary</td>
                      <td colspan="<?php echo $deductions_col_span; ?>">Deductions</td>
                      <td colspan="2" rowspan="2" class="<?php echo $abs_class_toggler ?>">Absences</td>
                      <td colspan="2" rowspan="2">Late</td>
                      <td rowspan="3">Total Deductions</td>
                      <td rowspan="3">Taxable Income</td>
                      <td rowspan="3" class="<?php echo $tax_class_toggler; ?>">Withholding Tax</td>
                      <td rowspan="3" class="<?php echo $thirteenth_pay_class_toggler; ?>">13th Month Pay</td>
                      <td rowspan="3">Net Income</td>
                    </tr>
                    <tr class="table-header">
                      <td rowspan="2"># leave</td> <!-- Leave -->
                      <td rowspan="2">Amount</td> <!-- Leave -->
                      <td colspan="<?php echo isset($_POST['gsis-contri']) ? 4 : 3; ?>">Contributions</td>
                      <td rowspan="2">SSS LOAN</td>
                      <td rowspan="2">HDMF LOAN</td>
                      <td rowspan="2" class="d-none <?php // echo $policy_loan_class_toggler; 
                                                    ?>">GSIS</br>P.L.</td>
                      <td rowspan="2" class="d-none <?php // echo $gsis_loan_class_toggler; 
                                                    ?>">GSIS</br>E.L.</td>
                      <td rowspan="2" class="d-none <?php // echo $ela_loan_class_toggler; 
                                                    ?>">GSIS</br>C.L.</td>
                      <td rowspan="2" class="<?php echo $uniform_class_toggler; ?>">Uniform</td>
                      <td rowspan="2" class="<?php echo $neg_salary_class_toggler; ?>">Other Deductions</td>
                      <td rowspan="2">Cash Advance</td>
                    </tr>
                    <tr class="table-header">
                      <td>SSS</td>
                      <td>HDMF</td>
                      <td>PhilHealth</td>
                      <td class="<?php echo $gsis_class_toggler; ?>">Insurance</td>
                      <td class="<?php echo $abs_class_toggler ?>">Day(s)</td> <!-- Absences -->
                      <td class="<?php echo $abs_class_toggler ?>">Amount</td> <!-- Absences -->
                      <td>Minute(s)</td> <!-- Late -->
                      <td>Amount</td> <!-- Late -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($users) {
                      $counter = 0;
                      $emp_count = 0;
                      // Total Net Income
                      $grand_total_net_income = 0;
                      $total_init_salary      = 0;
                      $total_leave_amt        = 0;
                      $total_reg_amt          = 0;
                      $total_sp_amt           = 0;
                      $total_prem_amt         = 0;
                      $total_ot_amt           = 0;
                      $total_nd_amt           = 0;
                      $total_adj_amt          = 0;
                      $total_gross_amt        = 0;
                      $total_sss_amt          = 0;
                      $total_hdmf_amt         = 0;
                      $total_ph_amt           = 0;
                      $total_ins_amt          = 0;
                      $total_sss_loan_amt     = 0;
                      $total_hdmf_loan_amt    = 0;
                      $total_ca_amt           = 0;
                      $total_abs_amt          = 0;
                      $total_late_amt         = 0;
                      $total_deductions_amt   = 0;
                      $total_tax_income_amt   = 0;
                      $total_cola_amt   = 0;

                      $declared_holidays = $holiday->get_holiday_by_range($dateFrom, $dateTo);
                      foreach ($users as $user) {
                        $emp_count += 1;
                        $record        = new Records($user, $dateFrom, $dateTo);
                        $_employee     = new Employee;

                        $logs          = $record->get_user_logs();
                        
                        $date_logs     = $record->all_datelogs();

                        // get date diff

                        $_start_date = new DateTime($dateFrom);
                        $_end_date   = new DateTime($dateTo);

                        $_date_difference = $_start_date->diff($_end_date);

                        $_days = ($_date_difference->m >= 1) ? (($_date_difference->m * 30) + $_date_difference->d) : $_date_difference->d;

                        $userID        = $record->get_user_data_by_biometric($user, 'id');
                        $fname         = $record->get_user_data_by_biometric($user, 'fname');
                        $lname         = $record->get_user_data_by_biometric($user, 'lname');
                        // $basic_pay     = $record->get_user_data_by_biometric( $user, 'basic_pay');
                        $temp_basic_pay = $record->get_user_data_by_biometric($user, 'basic_pay');

                        $pay_type      = $record->get_user_data_by_biometric($user, 'pay_type');
                        $tax_exemption = $record->get_user_data_by_biometric($user, 'tax_exemption');
                        $tax_status    = $record->get_user_data_by_biometric($user, 'tax_status');
                        // Day Off
                        $day_off       = unserialize($record->get_user_data_by_biometric($user, 'day_off'));

                        // Contribution / Deductions
                        $contri_sss         = $record->get_user_data_by_biometric($user, 'contri_sss');
                        $contri_philhealth  = $record->get_user_data_by_biometric($user, 'contri_philhealth');
                        $contri_hmdf        = $record->get_user_data_by_biometric($user, 'contri_hmdf');
                        $contri_gsis        = $record->get_user_data_by_biometric($user, 'contri_gsis');
                        $deduction          = $record->get_user_data_by_biometric($user, 'deduction');

                        // get user nightdiff enabled
                        $is_nightdiff_enabled = $record->get_user_data_by_biometric($user, 'is_nightdiff_enabled');

                        // 4.0.3 - changes - DEDUCTION OPTIONS - start

                        $contri_sss        = isset($_POST['apply_sss_deduct']) ? $contri_sss : 0;
                        $contri_philhealth = isset($_POST['apply_ph_deduct']) ? $contri_philhealth : 0;
                        $contri_hmdf       = isset($_POST['apply_hmdf_deduct']) ? $contri_hmdf : 0;

                        // 4.0.3 - changes - end

                        // Adjustment
                        $pera_allowance    = $record->get_user_data_by_biometric($user, 'allow_pera');
                        $rice_allowance    = $record->get_user_data_by_biometric($user, 'allow_rice');
                        $adjustment        = $record->get_user_data_by_biometric($user, 'adjustment');
                        $sss_amortization  = $record->get_user_data_by_biometric($user, 'loan_sss');
                        $hdmf_amortization = $record->get_user_data_by_biometric($user, 'loan_hdmf');
                        // $policy_amortization  = $record->get_user_data_by_biometric( $user, 'loan_policy');
                        $policy_amortization  = 0;
                        // $gsis_amortization    = $record->get_user_data_by_biometric( $user, 'loan_gsis');
                        $gsis_amortization    = 0;
                        // $elasos_amortization  = $record->get_user_data_by_biometric( $user, 'ela_sos');
                        $elasos_amortization  = 0;
                        $emp_late_amount      = $record->get_user_data_by_biometric($user, 'late_amount');
                        $emp_holiday_amount   = $record->get_user_data_by_biometric($user, 'holiday_amount');
                        $work_group   = $record->get_user_data_by_biometric($user, 'work_group');
                        $disabled_input = '';
                        $emp_group = pcm_get_group_by_id($work_group);

                        $user_deductions      = $contri_sss + $contri_philhealth + $contri_hmdf + $deduction + $contri_gsis;

                        $company_contri_sss         = $record->get_user_data_by_biometric($user, 'company_contri_sss');
                        $company_contri_philhealth  = $record->get_user_data_by_biometric($user, 'company_contri_philhealth');
                        $company_contri_hmdf        = $record->get_user_data_by_biometric($user, 'company_contri_hmdf');
                        $company_contri_gsis        = $record->get_user_data_by_biometric($user, 'company_contri_gsis');

                        // divide basic pay by 2 if pay type is semi monthly and generation is monthly

                        $basic_pay = ($pay_type == 2 && ($_days <= 15)) ? ($temp_basic_pay / 2) : $temp_basic_pay;

                        // reset basic pay for monthly fix gross pay if date range is less than a month
                        if ($pay_type == 3) {
                          if ($_days >= 27 && $_days <= 32) {
                            $basic_pay = $temp_basic_pay;
                          } else {
                            $basic_pay = 0;
                          }
                        }


                        // Declared variable for calculation
                        $work_hours   = 0;
                        $work_lates   = 0;
                        $ot_hours     = 0;
                        $init_salary  = 0;
                        $gross_salary = 0;
                        $salary_deductions = 0;
                        $net_salary   = 0;
                        $ot_amount    = 0;
                        $premium      = 0;
                        $premium_amt  = 0;

                        // Calculate Employee daily rate

                        $daily_rate = pcm_calculate_daily_rate($pay_type, $day_off, $basic_pay);

                        // Holiday Calculation
                        $sp_holiday         = 0;
                        $sp_holiday_amount  = 0;
                        $reg_holiday        = 0;
                        $reg_holiday_amount = 0;
                        $cola               = 0;
                        $cola_perHOur       = 0;
                        $cola_amount        = 0;
                        $withholding_tax    = 0;
                        $taxable_income_amount = 0;
                        $night_diff         = 0;
                        $night_diff_amt     = 0;
                        $rate_hour   = $pay_type == 1 ? format_value(($daily_rate / 8), 5) : format_value(($daily_rate / 8), 3);
                        // Reset Daily and Per Hour rate 
                        // Pay type is semi monthly or monthly fixed Salary
                        if ($pay_type == 2 || $pay_type == 3) {
                          $daily_rate = 0;
                          $rate_hour  = 0;
                        }

                        if (!empty($logs)) {
                          // $work_hours  = unix_to_num_hour( $logs['time_consume'] + $logs['late'] );
                          $work_hours  = number_format(unix_to_num_hour($logs['time_consume'] + ($logs['premium'] * 3600) + $logs['late']), 2);
                          $work_lates  = unix_to_num_minute($logs['late']);
                          $ot_hours    = unix_to_num_hour($logs['ot_consume']);
                          $ot_amount   = format_value($logs['ot_amount']);

                          $_logs_w_raises = get_logs_with_raises($userID, $date_logs, $basic_pay, $pay_type);

                          $init_salary = format_value($rate_hour * $work_hours);
                          // $init_salary = get_init_salary_by_pay_type($pay_type, $_logs_w_raises);

                          $init_salary = ($pay_type == 2) ? $basic_pay : $init_salary;

                          // let init salary = basic pay if pay type is 3
                          if ($pay_type == 3) {
                            $init_salary = $basic_pay;
                          }

                          // Night Difference
                          $night_diff       = format_value($logs['night_diff']);

                          if ($is_nightdiff_enabled == 1) {
                            $night_diff_amt   = format_value($logs['night_diff_amt']);
                          }

                          // payable leaves
                          $payable_leaves   = $logs['payable_leaves'];

                          // Holidays
                          $reg_holiday        = unix_to_num_hour($logs['holiday_reg']);
                          $reg_holiday_amount = format_value($logs['holiday_reg_amt']);
                          $sp_holiday         = unix_to_num_hour($logs['holiday_sp']);
                          $sp_holiday_amount  = format_value($logs['holiday_sp_amt']);

                          // 4.0.3 changes - set holiday amount to actual rate if set - start

                          if ($is_holiday_actual_rate_set) {

                            $reg_holiday_amount = format_value(($logs['holiday_reg'] / 28800) * $daily_rate);
                            $sp_holiday_amount  = format_value(($logs['holiday_sp'] / 28800) * $daily_rate * .30);
                          }

                          if ($emp_holiday_amount > 0) {

                            $reg_holiday_amount = format_value(($logs['holiday_reg'] / 28800) * $emp_holiday_amount);
                            $sp_holiday_amount  = format_value(($logs['holiday_sp'] / 28800) * $emp_holiday_amount * .30);
                          }

                          // 4.0.3 changes - set holiday amount to actual rate if set - end

                          // Premium
                          $premium      = $logs['premium'];
                          $premium_amt  = format_value($logs['premium_amt']);

                          // Leave
                          $leave_count  = $logs['leave_count'];
                          $leave_amount = format_value($logs['leave_amount']);

                          // Leave functionality

                          $available_sil = $leave_info->get_user_sil($userID) ?: 0;
                          $user_leaves   = array();
                          $_user_leaves  = $_employee->get_user_leaves($userID);
                          $dates_between = getDatesBetweenRange($dateFrom, $dateTo);
                          foreach ($_user_leaves as $leave) {
                            if (in_array($leave->date, $dates_between)) {
                              $user_leaves[] = $leave;
                            }
                          }
                          $used_sil      = $leave_info->get_user_payable_leaves($user_leaves) ?: 0;

                          if ($used_sil >= $available_sil || $available_sil == 0) {
                            $leave_count = $available_sil;
                          } else {
                            $leave_count = $used_sil;
                          }

                          // Leave functionality

                          // Customization
                          //  ******************************************************************************************
                          if ($_leave_amount) {
                            $leave_amount = format_value($_leave_amount * $leave_count);

                            // 4.0.3 changes - set leave amount to actual rate if set - start

                            $leave_amount = $is_leave_actual_rate_set ? format_value($leave_count * $daily_rate) : $leave_amount;

                            // 4.0.3 changes - end

                          }

                          // Cola
                          $cola           = $logs['cola'];
                          $cola_perHOur   = $logs['cola_perHOur'];
                          $cola_amount    = format_value($logs['cola_amount']);
                        }

                        // Calculate Late Amount
                        // $amount_perMinute = $rate_hour / 60;
                        $late_amount_perMinute = ($emp_late_amount > 0) ? $emp_late_amount : $gen_late_amount;
                        $late_amount           = $late_amount_perMinute * $work_lates;

                        $thn_amt               = 0;

                        // Salary Gross / Deductions / NET

                        // Pay type is semi monthly Salary - All holidays will no pay
                        if ($pay_type == 2) {
                          // Amount of holiday

                          $_reg_holiday       = $logs['holiday_reg'];
                          $_sp_holiday        = $logs['holiday_sp'];

                          $leave_amount       = 0;
                          $reg_holiday_amount = number_format(((($init_salary * 2) / 21.75) * ($_reg_holiday / 28800)), 2);
                          $sp_holiday_amount  = number_format((((($init_salary * 2) / 21.75) * .30) * ($_sp_holiday / 28800)), 2);
                          $premium_amt        = 0;

                          // Number of holiday
                          $leave_count        = $payable_leaves['leave_count'];
                          $reg_holiday        = 0;
                          $sp_holiday         = 0;
                          $premium            = 0;
                        }

                        if ($work_group == 7) {

                          $reg_holiday_amount = 0;
                          $sp_holiday_amount  = 0;
                        }
                        // original basic salary

                        // $basic_salary       = $cola_amount + $init_salary + $leave_amount + $reg_holiday_amount + $sp_holiday_amount + $premium_amt + $thn_amt + $ot_amount + $night_diff_amt + $pera_allowance + $rice_allowance;

                        // new basic salary ( where cola, pera, rice allowance and 13th month pay were removed from the computation )

                        $basic_salary       = $cola_amount + $init_salary + $leave_amount + $reg_holiday_amount + $sp_holiday_amount + $premium_amt + $ot_amount + $night_diff_amt;

                        $gross_salary       = format_value($adjustment + $basic_salary);

                        $salary_deductions  = format_value($late_amount + $user_deductions + $sss_amortization + $hdmf_amortization + $policy_amortization + $gsis_amortization + $elasos_amortization);
                        $net_salary         = $gross_salary - $salary_deductions;

                        // calculate TAX
                        //** Withholding tax computation
                        $taxable_income_amount    = $basic_salary;
                        $taxable_income_deduction = format_value($contri_sss + $contri_philhealth + $contri_hmdf + $late_amount);
                        $taxable_income           = $taxable_income_amount - $taxable_income_deduction;
                        $withholding_tax          = calculate_withholding_tax($taxable_income, $tax_period);
                        $net_salary               = $net_salary;
                        // $net_salary               = $net_salary - $withholding_tax;
                        $num_days = number_format(($work_hours / 8), 1);

                        # do not include trainees on the payroll computation and disable input fields
                        if($emp_group === 'trainee'){
                          $disabled_input = 'disabled';
                          $num_days = 0;
                          $work_hours = 0;
                          $rate_hour = 0;
                          $daily_rate = 0;
                          $init_salary = 0;
                          $leave_count = 0;
                          $leave_amount = 0;
                          $reg_holiday_amount = 0;
                          $sp_holiday_amount = 0;
                          $premium_amt = 0;
                          $ot_amount = 0;
                          $night_diff_amt = 0;
                          $gross_salary = 0;
                          $contri_sss = 0;
                          $contri_hmdf = 0;
                          $contri_philhealth = 0;
                          $contri_gsis = 0;
                          $sss_amortization = 0;
                          $hdmf_amortization = 0;
                          $gsis_amortization = 0;
                          $policy_amortization = 0;
                          $elasos_amortization = 0;
                          $deduction = 0;
                          $work_lates = 0;
                          $late_amount = 0;
                          $salary_deductions = 0;
                          $taxable_income = 0;
                          $net_salary = 0;
                          $cola_amount = 0;
                        }

                    ?>
                        <tr id="data-<?php echo $counter; ?>">
                          <td><?php echo $emp_count; ?></td>
                          <td class="fullname">
                            <?php echo $lname . ', ' . $fname; ?>
                            <input type="hidden" class="employee" name="payroll[<?php echo $counter; ?>][employee]" value="<?php echo $lname . ', ' . $fname; ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Number Of days">
                            <?php // echo $logs['num_days']; 
                            ?>
                            <?php echo number_format(($work_hours / 8), 1); ?>
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Number of workhours">
                            <?php echo $work_hours; ?>
                            <input type="hidden" name="payroll[<?php echo $counter; ?>][consume_hour]" value="<?php echo $work_hours; ?>">
                          </td>
                          <td data-toggle="tooltip" class="<?php echo $hourly_rate_class_toggler; ?>" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Rate per Hour">
                            <?php echo $rate_hour; ?>
                            <input type="hidden" name="payroll[<?php echo $counter; ?>][rate_hour]" value="<?php echo $rate_hour; ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Daily rate">
                            <?php echo $daily_rate; ?>
                            <input type="hidden" name="payroll[<?php echo $counter; ?>][daily_rate]" value="<?php echo $daily_rate; ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Initial Salary">
                            <?php echo $init_salary; ?>
                            <input class="receivable init_salary" type="hidden" name="payroll[<?php echo $counter; ?>][init_salary]" value="<?php echo $init_salary; ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Number of Leave">
                            <?php echo $leave_count; ?>
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Leave Amount">
                            <?php echo $leave_amount; ?>
                            <!-- <input style="width:100%;" type="text" class="leave_amount receivable" name="payroll[<?php // echo $counter; 
                                                                                                                      ?>][leave_amount]" value="<?php // echo $leave_amount; 
                                                                                                                                                ?>"> -->
                            <input class="receivable" type="hidden" name="payroll[<?php echo $counter; ?>][leave_amount]" value="<?php echo $leave_amount; ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Reg. Holiday Amount">
                            <?php echo $reg_holiday_amount; ?>
                            <input class="receivable" type="hidden" name="payroll[<?php echo $counter; ?>][reg_holiday]" value="<?php echo $reg_holiday_amount; ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Sp. Holiday Amount">
                            <?php echo $sp_holiday_amount; ?>
                            <input class="receivable" type="hidden" name="payroll[<?php echo $counter; ?>][sp_holiday]" value="<?php echo $sp_holiday_amount; ?>">
                          </td>
                          <td data-toggle="tooltip" class="<?php echo $premium_class_toggler ?>" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Premium Amount">
                            <?php echo $premium_amt; ?>
                            <input class="receivable" type="hidden" name="payroll[<?php echo $counter; ?>][prm_holiday]" value="<?php echo $premium_amt; ?>">
                          </td>
                          <td class="td_ot_hour" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> OT Amount">
                            <?php echo $ot_amount; ?>
                            <input class="receivable" type="hidden" name="payroll[<?php echo $counter; ?>][ot_amount]" value="<?php echo $ot_amount; ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Night Diff. Amount">
                            <?php echo $night_diff_amt ?>
                            <input class="receivable" type="hidden" name="payroll[<?php echo $counter; ?>][night_diff]" value="<?php echo $night_diff_amt; ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Adjustment">
                            <input style="width:100%;" type="text" class="adjustment receivable" name="payroll[<?php echo $counter; ?>][adjustment]" value="<?php echo $adjustment; ?>" <?php echo $disabled_input; ?>>
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Allowance Amount">
                            <?php echo $cola_amount ?>
                            <input class="receivable" type="hidden" name="payroll[<?php echo $counter; ?>][amt_cola]" value="<?php echo $cola_amount; ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Gross Salary">
                            <span class="label_gross_salary"><?php echo $gross_salary; ?></span>
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> SSS Contribution">
                            <span class="label_sss_cont"><?php echo $contri_sss; ?></span>
                            <input class="sss_cont deductions" type="hidden" name="payroll[<?php echo $counter; ?>][sss_cont]" value="<?php echo $contri_sss; ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> HMDF Contribution">
                            <span class="label_hdmf_cont"><?php echo $contri_hmdf; ?></span>
                            <input class="hdmf_cont deductions" type="hidden" name="payroll[<?php echo $counter; ?>][hdmf_cont]" value="<?php echo $contri_hmdf; ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> PhilHealth Contribution">
                            <span class="label_phil_cont"><?php echo $contri_philhealth; ?></span>
                            <input class="phil_cont deductions" type="hidden" name="payroll[<?php echo $counter; ?>][phil_cont]" value="<?php echo $contri_philhealth; ?>">
                          </td>
                          <td data-toggle="tooltip" class="<?php echo $gsis_class_toggler; ?>" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> GSIS Contribution">
                            <span class="label_phil_cont"><?php echo $contri_gsis; ?></span>
                            <input class="gsis_cont deductions" type="hidden" name="payroll[<?php echo $counter; ?>][gsis_cont]" value="<?php echo $contri_gsis; ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> SSS Loan">
                            <input style="width:60px;" class="loan_sss deductions" type="text" name="payroll[<?php echo $counter; ?>][loan_sss]" value="<?php echo $sss_amortization; ?>" autocomplete="off" <?php echo $disabled_input; ?>>
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> HDMF Loan">
                            <input style="width:60px;" class="loan_hdmf deductions" type="text" name="payroll[<?php echo $counter; ?>][loan_hdmf]" value="<?php echo $hdmf_amortization; ?>" autocomplete="off" <?php echo $disabled_input; ?>>
                          </td>
                          <td data-toggle="tooltip" class="d-none <?php // echo $policy_loan_class_toggler; 
                                                                  ?>" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Loan Policy">
                            <input style="width:60px;" class="loan_policy deductions" type="text" name="payroll[<?php echo $counter; ?>][loan_policy]" value="<?php echo $policy_amortization; ?>" autocomplete="off">
                          </td>
                          <td data-toggle="tooltip" class="d-none <?php // echo $gsis_loan_class_toggler; 
                                                                  ?>" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> GSIS Loan">
                            <input style="width:60px;" class="loan_gsis deductions" type="text" name="payroll[<?php echo $counter; ?>][loan_gsis]" value="<?php echo $gsis_amortization; ?>" autocomplete="off">
                          </td>
                          <td data-toggle="tooltip" class="d-none <?php // echo $ela_loan_class_toggler; 
                                                                  ?>" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> ELA/SOS / EL/CA LOAN Loan">
                            <input style="width:60px;" class="ela_sos deductions" type="text" name="payroll[<?php echo $counter; ?>][ela_sos]" value="<?php echo $elasos_amortization; ?>" autocomplete="off">
                          </td>
                          <td data-toggle="tooltip" class="<?php echo $uniform_class_toggler; ?>" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Uniform">
                            <input style="width:60px;" class="uniform deductions" type="text" name="payroll[<?php echo $counter; ?>][uniform]" value="0" autocomplete="off" <?php echo $disabled_input; ?>>
                          </td>
                          <td data-toggle="tooltip" class="<?php echo $neg_salary_class_toggler; ?>" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Other Deductions">
                            <input style="width:100%;" class="other_deduction deductions" type="text" name="payroll[<?php echo $counter; ?>][other_deduction]" value="<?php echo $deduction; ?>" autocomplete="off" <?php echo $disabled_input; ?>>
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Cash Advance">
                            <input style="width:60px;" class="cash_advance deductions" type="text" name="payroll[<?php echo $counter; ?>][cash_advance]" value="0" autocomplete="off" <?php echo $disabled_input; ?>>
                          </td>
                          <!-- absences start -->
                          <td data-toggle="tooltip" class="<?php echo $abs_class_toggler; ?>" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Absences in days">
                            <?php if ($pay_type == 2) : ?>
                              <input style="width:80px;" class="abs_days" type="text" name="payroll[<?php echo $counter; ?>][abs_days]" value="0" autocomplete="off">
                            <?php endif; ?>
                          </td>
                          <td data-toggle="tooltip" class="<?php echo $abs_class_toggler; ?>" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Absent Amount">
                            <input type="text" class="absent_amount deductions" style="width:80px;border:none; text-align:right;" name="payroll[<?php echo $counter; ?>][absent_amount]" value="0" readonly <?php echo $disabled_input; ?>/>
                          </td>
                          <!-- absences end -->
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Lates in Minutes">
                            <?php echo $work_lates; ?>
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Late Amount">
                            <span class="label_late_amount"><?php echo format_value($late_amount); ?></span>
                            <input type="hidden" name="payroll[<?php echo $counter; ?>][late_amount]" value="<?php echo format_value($late_amount); ?>">
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Salary Deductions">
                            <span class="total_deductions"><?php echo $salary_deductions; ?></span>
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> TAXable Income">
                            <span class="label_taxable_income"><?php echo format_value($taxable_income); ?></span>
                          </td>
                          <td data-toggle="tooltip" class="<?php echo $tax_class_toggler; ?>" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Withholding TAX">
                            <!-- <span class="label_withholdng_tax deductions"><?php // echo $withholding_tax; 
                                                                                ?></span>
                            <input class="withholdng_tax deductions" type="hidden" name="payroll[<?php // echo $counter; 
                                                                                                  ?>][withholding_tax]" value="<?php // echo $withholding_tax; 
                                                                                                                                ?>"> -->
                            <span class="label_withholdng_tax deductions"><?php echo format_value(0); ?></span>
                            <input class="withholdng_tax deductions" type="hidden" name="payroll[<?php echo $counter; ?>][withholding_tax]" value="<?php echo format_value(0); ?>">
                          </td>
                          <td class="<?php echo $thirteenth_pay_class_toggler; ?>" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> 13th Month Pay">
                            <input style="width:100%;" type="text" class="thirteenth_pay" name="payroll[<?php echo $counter; ?>][thirteenth_pay]" value="0" <?php echo $disabled_input; ?>>
                          </td>
                          <td data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?php echo $lname . ', ' . $fname; ?> <br/> Net Income">
                            <span class="label_net_salary"><?php echo format_value($net_salary); ?></span>
                            <input type="hidden" name="payroll[<?php echo $counter; ?>][pay_type]" value="<?php echo $pay_type; ?>">
                            <input type="hidden" name="payroll[<?php echo $counter; ?>][com_sss_cont]" value="<?php echo $company_contri_sss; ?>">
                            <input type="hidden" name="payroll[<?php echo $counter; ?>][com_phil_cont]" value="<?php echo $company_contri_philhealth; ?>">
                            <input type="hidden" name="payroll[<?php echo $counter; ?>][com_hdmf_cont]" value="<?php echo $company_contri_hmdf; ?>">
                            <input type="hidden" name="payroll[<?php echo $counter; ?>][com_gsis_cont]" value="<?php echo $company_contri_gsis; ?>">
                            <input type="hidden" name="payroll[<?php echo $counter; ?>][employee_id]" value="<?php echo $userID; ?>">
                            <input type="hidden" class="date_from" name="payroll[<?php echo $counter; ?>][date_from]" value="<?php echo $dateFrom; ?>">
                            <input type="hidden" class="date_to" name="payroll[<?php echo $counter; ?>][date_to]" value="<?php echo $dateTo; ?>">
                          </td>
                        </tr>
                    <?php
                        $grand_total_net_income += $net_salary;
                        $total_init_salary += $init_salary;
                        $total_leave_amt += $leave_amount;
                        $total_reg_amt += $reg_holiday_amount;
                        $total_sp_amt += $sp_holiday_amount;
                        $total_prem_amt += $premium_amt;
                        $total_ot_amt += $ot_amount;
                        $total_nd_amt += $night_diff_amt;
                        $total_adj_amt += $adjustment;
                        $total_gross_amt += $gross_salary;
                        $total_sss_amt += $contri_sss;
                        $total_hdmf_amt += $contri_hmdf;
                        $total_ph_amt += $contri_philhealth;
                        $total_ins_amt += $contri_gsis;
                        $total_sss_loan_amt += $sss_amortization;
                        $total_hdmf_loan_amt += $hdmf_amortization;
                        $total_late_amt += $late_amount;
                        $total_deductions_amt += $salary_deductions;
                        $total_tax_income_amt += format_value($taxable_income);
                        $total_cola_amt += $cola_amount;
                        $counter++;
                      } // End foreach
                    } // End If
                    ?>
                    <tr class="totals-row" style="background-color: #eee;">
                      <!-- <td id="total_net_income" style="text-align: right">Total Net Income</td> -->
                      <td></td>
                      <td></td> <!-- fullname -->
                      <td></td> <!-- num of days -->
                      <td></td> <!-- num of hours -->
                      <td></td> <!-- daily rate -->
                      <td><?php echo format_value($total_init_salary); ?></td> <!-- init salary -->
                      <td></td> <!-- leave count -->
                      <td><?php echo format_value($total_leave_amt); ?></td> <!-- leave amount -->
                      <td><?php echo format_value($total_reg_amt); ?></td> <!-- reg holiday -->
                      <td><?php echo format_value($total_sp_amt); ?></td> <!-- sp holiday -->
                      <td class="<?php echo $premium_class_toggler ?>"><?php echo format_value($total_prem_amt); ?></td> <!-- rest day premium -->
                      <td><?php echo format_value($total_ot_amt); ?></td> <!-- overtime -->
                      <td><?php echo format_value($total_nd_amt); ?></td> <!-- night diff -->
                      <td class="total_adjustment_amount"><?php echo format_value($total_adj_amt); ?></td> <!-- adjustments -->
                      <td class="total_cola_amount"><?php echo format_value($total_cola_amt); ?></td> <!-- cola -->
                      <td class="total_gross_amount"><?php echo format_value($total_gross_amt); ?></td> <!-- gross salary -->
                      <td><?php echo format_value($total_sss_amt); ?></td> <!-- sss -->
                      <td><?php echo format_value($total_hdmf_amt); ?></td> <!-- hdmf -->
                      <td><?php echo format_value($total_ph_amt); ?></td> <!-- philhealth -->
                      <td class="<?php echo $gsis_class_toggler ?>"><?php echo format_value($total_ins_amt); ?></td> <!-- insurance -->
                      <td class="total_sss_loan_amount"><?php echo format_value($total_sss_loan_amt); ?></td> <!-- sss loan -->
                      <td class="total_hmdf_loan_amount"><?php echo format_value($total_hdmf_loan_amt); ?></td> <!-- hmdf loan -->
                      <td class="d-none <?php // echo $policy_loan_class_toggler 
                                        ?>"></td> <!-- gsis pl -->
                      <td class="d-none <?php // echo $gsis_loan_class_toggler 
                                        ?>"></td> <!-- gsis el -->
                      <td class="d-none <?php // echo $ela_loan_class_toggler 
                                        ?>"></td> <!-- gsis cl -->
                      <td class="<?php echo $uniform_class_toggler ?>"></td> <!-- uniform -->
                      <td class="<?php echo $neg_salary_class_toggler ?>"></td> <!-- other deductions -->
                      <td class="total_cash_advance_amount"><?php echo format_value($total_ca_amt); ?></td> <!-- cash advance -->
                      <td class="<?php echo $abs_class_toggler ?>"></td> <!-- absent days -->
                      <td class="<?php echo $abs_class_toggler ?> total_absent_amount"><?php echo format_value($total_abs_amt); ?></td> <!-- absent amount -->
                      <td></td> <!-- late mins -->
                      <td><?php echo format_value($total_late_amt); ?></td> <!-- late amount -->
                      <td class="total_deductions_amount"><?php echo format_value($total_deductions_amt); ?></td> <!-- total deductions -->
                      <td class="total_tax_income_amount"><?php echo format_value($total_tax_income_amt); ?></td> <!-- taxable income -->
                      <td class="<?php echo $tax_class_toggler ?>"></td> <!-- withholding tax -->
                      <td class="total_thirteenth_amount <?php echo $thirteenth_pay_class_toggler; ?>"><?php echo format_value(0); ?></td> <!-- thirteenth pay -->
                      <td id="grand_total_net"><?php echo format_value($grand_total_net_income); ?></td> <!-- total net -->
                    </tr>
                  </tbody>
                  </tbody>
                </table>
                <div class="col-md-6 mb-3">
                  <label class="sr-only" for="payrollName">Payroll Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Payroll Name</div>
                    </div>
                    <input type="text" id="payrollName" class="form-control" name="name" placeholder="Payroll Name" required="required" autocomplete="off">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg pm-blue" name="submit-payroll">Generate Payroll</button>
              </div>
            </form>
          <?php
          }
          ?>
        </div> <!-- card body -->
      </div> <!-- .card -->
    </div> <!-- Card Wrapper -->
  </div> <!-- payroll-report-wrapper -->
</div><!-- /.container-fluid-->
<script>
  jQuery(document).ready(function() {
    $('#check-all').on('change', function() {

      // bulk check/uncheck functionality

      const This = $(this);
      const checkBoxes = This.closest('.card-header').next().find('input[type="checkbox"]');
      checkBoxes.prop('checked', This.is(':checked'));

    });

    // get colspan function

    function getColspan(element) {
      let colspanSum = 0;
      element.each(function(idx, element) {
        if (!element.classList.contains('d-none')) {
          colspanSum += $(this).prop('colSpan');
        }
      });
      return colspanSum - 1;
    }
    // $('#total_net_income').attr('colspan', getColspan($('#payrollReportTable thead tr:first-child td')));

    /**
     * auto compute bottom columns
     */

    const triggerChange = () => {
      $('#payrollReportTable span.total_deductions').each(function() {
        setTimeout(() => {
          $(this).trigger('change');
        }, 100);
      });
      $('#payrollReportTable span.label_taxable_income').each(function() {
        setTimeout(() => {
          $(this).trigger('change');
        }, 100);
      });
      $('#payrollReportTable span.label_gross_salary').each(function() {
        setTimeout(() => {
          $(this).trigger('change');
        }, 100);
      });
    }

    // adjustment

    $('#payrollReportTable .adjustment.receivable').on('keyup change paste', function() {
      let total = 0;
      triggerChange();
      $('#payrollReportTable .adjustment.receivable').each(function() {
        total += parseFloat($(this).val() ? $(this).val() : 0);
      });
      $('#payrollReportTable .total_adjustment_amount').text(total.toFixed(2));
    });

    // thirteenth_pay

    $('#payrollReportTable .thirteenth_pay').on('keyup change paste', function() {
      let total = 0;
      triggerChange();
      $('#payrollReportTable .thirteenth_pay').each(function() {
        total += parseFloat($(this).val() ? $(this).val() : 0);
      });
      $('#payrollReportTable .total_thirteenth_amount').text(total.toFixed(2));
    });

    // gross salary

    $('#payrollReportTable .label_gross_salary').on('change', function() {
      let total = 0;
      $('#payrollReportTable .label_gross_salary').each(function() {
        total += parseFloat($(this).text() ? $(this).text() : 0);
        $('#payrollReportTable .total_gross_amount').text(total.toFixed(2));
      });
    });

    // loan sss

    $('#payrollReportTable .loan_sss.deductions').on('keyup change paste', function() {
      let total = 0;
      triggerChange();
      $('#payrollReportTable .loan_sss.deductions').each(function() {
        total += parseFloat($(this).val() ? $(this).val() : 0);
      });
      $('#payrollReportTable .total_sss_loan_amount').text(total.toFixed(2));
    });

    // loan hmdf

    $('#payrollReportTable .loan_hdmf.deductions').on('keyup change paste', function() {
      let total = 0;
      triggerChange();
      $('#payrollReportTable .loan_hdmf.deductions').each(function() {
        total += parseFloat($(this).val() ? $(this).val() : 0);
      });
      $('#payrollReportTable .total_hmdf_loan_amount').text(total.toFixed(2));
    });

    // loan policy

    $('#payrollReportTable .loan_policy.deductions').on('keyup change paste', function() {
      let total = 0;
      triggerChange();
    });

    // loan gsis

    $('#payrollReportTable .loan_gsis.deductions').on('keyup change paste', function() {
      let total = 0;
      triggerChange();
    });

    // ela sos

    $('#payrollReportTable .ela_sos.deductions').on('keyup change paste', function() {
      let total = 0;
      triggerChange();
    });

    // uniform

    $('#payrollReportTable .uniform.deductions').on('keyup change paste', function() {
      let total = 0;
      triggerChange();
    });

    // other deductions

    $('#payrollReportTable .other_deduction.deductions').on('keyup change paste', function() {
      let total = 0;
      triggerChange();
    });

    // cash advance

    $('#payrollReportTable .cash_advance.deductions').on('keyup change paste', function() {
      let total = 0;
      triggerChange();
      $('#payrollReportTable .cash_advance.deductions').each(function() {
        total += parseFloat($(this).val() ? $(this).val() : 0);
      });
      $('#payrollReportTable .total_cash_advance_amount').text(total.toFixed(2));
    });

    // absent amount

    $('#payrollReportTable .absent_amount.deductions').on('keyup change paste', function() {
      let total = 0;
      triggerChange();
      $('#payrollReportTable .absent_amount.deductions').each(function() {
        total += parseFloat($(this).val() ? $(this).val() : 0);
      });
      $('#payrollReportTable .total_absent_amount').text(total.toFixed(2));
    });

    // total deductions

    $('#payrollReportTable span.total_deductions').on('change', function() {
      let total = 0;
      $('#payrollReportTable span.total_deductions').each(function() {
        total += parseFloat($(this).text());
      });
      $('#payrollReportTable .total_deductions_amount').text(total.toFixed(2));
    });

    // taxable income

    $('#payrollReportTable .label_taxable_income').on('keyup change paste', function() {
      let total = 0;
      $('#payrollReportTable .label_taxable_income').each(function() {
        total += parseFloat($(this).text());
      });
      $('#payrollReportTable .total_tax_income_amount').text(total.toFixed(2));
    });

  });
</script>