<?php 
$user_data = $employee->get_user( intval( $_GET['uid'] ) );
$settings = new Settings;
?>
<div class="card mb-3">
    <div class="card-header">
    Salary/Benefits Information
    </div>
    <div class="card-body">
        <form action="#" id="salaryBenefitsForm" method="POST">
            <h6>Salary</h6>
            <fieldset class="form-group">
                <div class="row">
                <div class="col-md-6">
                    <div class="row">
                    <legend class="col-form-label col-md-6 pt-0">Basic Salary</legend>
                    <div class="col-md-8">
                    <input type="text" class="form-control number" id="basic_pay" placeholder="0.00" name="basic_pay" value="<?php echo $user_data->basic_pay; ?>" required="required">
                    </div>
                    </div>
                </div> <!-- Basic Pay Wrapper -->
                <div class="col-md-6">
                    <div class="row">
                        <legend class="col-form-label col-md-4 pt-0">Salary Type</legend>
                        <div class="col-md-6">
                            <div class="form-check">
                            <input class="form-check-input cutoff" type="radio" name="cutoff" <?php echo ( $user_data->pay_type == 0 ) ? 'checked' : '' ; ?>  id="daily" value="0" >
                            <label class="form-check-label" for="daily">
                                Daily
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input cutoff" type="radio" name="cutoff" <?php echo ( $user_data->pay_type == 1 ) ? 'checked' : '' ; ?> id="monthly" value="1">
                            <label class="form-check-label" for="monthly">
                                Monthly
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input cutoff" type="radio" name="cutoff" <?php echo ( $user_data->pay_type == 2 ) ? 'checked' : '' ; ?> id="semi-monthly" value="2">
                            <label class="form-check-label" for="semi-monthly">
                                Semi Monthly
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input cutoff" type="radio" name="cutoff" <?php echo ( $user_data->pay_type == 3 ) ? 'checked' : '' ; ?> id="monthly-fixed" value="3">
                            <label class="form-check-label" for="monthly-fixed">
                                Monthly Fixed
                            </label>
                            </div>
                        </div>
                    </div>
                </div> <!-- Cutoff Type Wrapper-->
                </div>
            </fieldset>
            <h6>ALLOWANCE</h6>
            <fieldset class="form-group">
                <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <legend class="col-form-label col-md-6 pt-0">Allowance Amount</legend>
                        <div class="col-md-8">
                        <input type="text" class="form-control number" id="cola" placeholder="0.00" name="cola" value="<?php echo $user_data->cola; ?>"  required="required">
                        </div>
                    </div>
                </div> <!-- Cutoff Type Wrapper-->
                <div class="col-md-6">
                    <div class="row">
                        <legend class="col-form-label col-md-4 pt-0">Allowance Type</legend>
                        <div class="col-md-6">
                            <div class="form-check">
                            <input class="form-check-input cola_type" type="radio" name="cola_type" <?php echo ( !$user_data->cola_type ) ? 'checked' : '' ; ?> id="cola-daily" value="0">
                            <label class="form-check-label" for="cola-daily">
                                Per Day
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input cola_type" type="radio" name="cola_type" <?php echo ( $user_data->cola_type ) ? 'checked' : '' ; ?> id="cola-fixed" value="1">
                            <label class="form-check-label" for="cola-fixed">
                                Fixed
                            </label>
                            </div>
                        </div>
                    </div>
                    <div class="row d-none">
                        <legend class="col-form-label col-md-4 pt-0">Night Differential</legend>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_nightdiff_enabled" id="is_nightdiff_enabled" <?php echo ( $user_data->is_nightdiff_enabled == 1 ) ? 'checked' : '' ; ?> value="1" />
                                <label class="form-check-label" for="is_nightdiff_enabled">
                                   Enable
                                </label>
                            </div>
                        </div>
                    </div>
                </div> <!-- Cola Type Wrapper -->
                </div>
            </fieldset>
            <fieldset class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <legend class="col-form-label col-md-6 pt-0">Allowance Limit</legend>
                            <div class="col-md-8">
                                <input type="text" class="form-control number" id="cola_limit" placeholder="0.00" name="cola_limit" value="<?php echo $user_data->cola_limit ?: 0; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <h6 class="d-none">Allowances</h6>
            <fieldset class="form-group d-none">
                <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="allow_pera">PERA & ACA</label>
                    <input type="text" class="form-control number" id="allow_pera" placeholder="0.00" value="<?php echo $user_data->allow_pera; ?>" name="allow_pera" required="required">
                </div>
                <div class="form-group col-md-4">
                    <label for="allow_rice">RICE ALLOW.</label>
                    <input type="text" class="form-control number" id="allow_rice" placeholder="0.00" value="<?php echo $user_data->allow_rice; ?>" name="allow_rice" required="required">
                </div>
                </div>
            </fieldset>
            <div class="card-header inner-card">
                <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2 button-right">
                        <button type="submit" class="btn btn-primary btn-lg">Update Records</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $user_data->id; ?>" />
        </form>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
    Deduction/Contribution Information
    </div>
    <div class="card-body">
        <h6>Employee Contributions / Deductions</h6>
        <form action="#" id="deductionsForm">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="sss">SSS Contribution</label>
                    <input type="text" class="form-control number" id="sss" placeholder="0.00" name="sss" value="<?php echo $user_data->contri_sss; ?>" required="required">
                </div>
                <div class="form-group col-md-6">
                    <label for="philhealth">PhilHealth Contribution</label>
                    <input type="text" class="form-control number" id="philhealth" placeholder="0.00" value="<?php echo $user_data->contri_philhealth; ?>" name="philhealth" required="required">
                </div>
                <div class="form-group col-md-6">
                    <label for="hmdf">HMDF Contribution</label>
                    <input type="text" class="form-control number" id="hmdf" placeholder="0.00" value="<?php echo $user_data->contri_hmdf; ?>" name="hmdf" required="required">
                </div>
                <div class="form-group col-md-6">
                    <label for="gsis">Insurance</label>
                    <input type="text" class="form-control number" id="gsis" placeholder="0.00" name="gsis" required="required" value="<?php echo $user_data->contri_gsis; ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="deduction">Other Deductions</label>
                    <input type="text" class="form-control number" id="deduction" placeholder="0.00" name="deduction" value="<?php echo $user_data->deduction; ?>" required="required">
                </div>
            </div> <!-- Deductions wrapper -->
            <h6>Company Contribution for Employee Benefits</h6>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="sss_comcont">SSS Contribution</label>
                    <input type="text" class="form-control number" id="sss_comcont" placeholder="0.00" name="sss_comcont" value="<?php echo $user_data->company_contri_sss; ?>" required="required">
                </div>
                <div class="form-group col-md-4">
                    <label for="philhealth_comcont">PhilHealth Contribution</label>
                    <input type="text" class="form-control number" id="philhealth_comcont" placeholder="0.00" name="philhealth_comcont" value="<?php echo $user_data->company_contri_philhealth; ?>" required="required">
                </div>
                <div class="form-group col-md-4">
                    <label for="hmdf_comcont">HMDF Contribution</label>
                    <input type="text" class="form-control number" id="hmdf_comcont" placeholder="0.00" name="hmdf_comcont" value="<?php echo $user_data->company_contri_hmdf; ?>" required="required">
                </div>
                <div class="form-group col-md-6 d-none">
                    <label for="gsis_comcont">GSIS Contribution</label>
                    <input type="text" class="form-control number" id="gsis_comcont" placeholder="0.00" name="gsis_comcont" required="required" value="<?php echo $user_data->company_contri_gsis; ?>">
                </div>
            </div> <!-- Contributions wrapper -->
            <h6>Adjustment</h6>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="adjustment">Other Adjustment</label>
                    <input type="text" class="form-control number" id="adjustment" placeholder="0.00" name="adjustment" value="<?php echo $user_data->adjustment; ?>" required="required">
                </div>
            </div> <!-- Adjustment wrapper -->
            <h6>Individual Amounts</h6>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="late">Late amount per minute</label>
                    <input type="text" class="form-control number" id="late" placeholder="0.00" name="late" value="<?php echo $user_data->late_amount; ?>" />
                </div>
                <div class="form-group col-md-4">
                    <label for="overtime">Overtime Amount</label>
                    <input type="text" class="form-control number" id="overtime" placeholder="0.00" name="overtime" value="<?php echo $user_data->overtime_amount; ?>" />
                </div>
                <div class="form-group col-md-4">
                    <label for="holiday">Holiday Amount</label>
                    <input type="text" class="form-control number" id="holiday" placeholder="0.00" name="holiday" value="<?php echo $user_data->holiday_amount; ?>" />
                </div>
            </div>
            <h6>Tax Information</h6>
            <div class="form-row assignments">
                <div class="form-group col-md-6">
                <div class="form-group row">
                    <div class="col-sm-6">TAX exempted?</div>
                    <div class="col-sm-6">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="tax-exemption" value="1" <?php echo ( $user_data->tax_exemption ) ? 'checked' : '' ; ?> name="tax_exemption">
                        <label class="form-check-label" for="tax-exemption">
                            Yes
                        </label>
                        </div>
                    </div>
                </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="tax_status">TAX Status</label>
                    <select id="tax_status" class="form-control" name="tax_status" required="required">
                        <option >Choose...</option>
                        <option value="Z" <?php echo ( $user_data->tax_status == 'Z' ) ? 'selected' : '' ; ?>>Z</option>
                        <option value="S/ME" <?php echo ( $user_data->tax_status == 'S/ME' ) ? 'selected' : '' ; ?>>S/ME</option>
                        <option value="ME1/S1" <?php echo ( $user_data->tax_status == 'ME1/S1' ) ? 'selected' : '' ; ?>>ME1/S1</option>
                        <option value="ME2/S2" <?php echo ( $user_data->tax_status == 'ME2/S2' ) ? 'selected' : '' ; ?>>ME2/S2</option>
                        <option value="ME3/S3" <?php echo ( $user_data->tax_status == 'ME3/S3' ) ? 'selected' : '' ; ?>>ME3/S3</option>
                        <option value="ME4/S4" <?php echo ( $user_data->tax_status == 'ME4/S4' ) ? 'selected' : '' ; ?>>ME4/S4</option>
                    </select>
                </div>
            </div>
            <div class="card-header inner-card">
                <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2 button-right">
                        <button type="submit" class="btn btn-primary btn-lg">Update Records</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $user_data->id; ?>" />
        </form>
    </div> <!-- Card -->
</div>