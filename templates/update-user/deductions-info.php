<div class="card mb-3">
    <div class="card-header">
    Deduction/Contribution Information
    </div>
    <div class="card-body">
    <h6>Employee Contributions / Deductions</h6>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="sss">SSS Contribution</label>
            <input type="text" class="form-control number" id="sss" placeholder="0.00" name="sss" value="<?php echo $user_data->contri_sss; ?>" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="philhealth">Phil Health Contribution</label>
            <input type="text" class="form-control number" id="philhealth" placeholder="0.00" value="<?php echo $user_data->contri_philhealth; ?>" name="philhealth" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="hmdf">HMDF Contribution</label>
            <input type="text" class="form-control number" id="hmdf" placeholder="0.00" value="<?php echo $user_data->contri_hmdf; ?>" name="hmdf" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="gsis">GSIS Contribution</label>
            <input type="text" class="form-control number" id="gsis" placeholder="0.00" name="gsis" required="required" value="<?php echo $user_data->contri_gsis; ?>">
        </div>
        <div class="form-group col-md-4">
            <label for="deduction">Other Deductions</label>
            <input type="text" class="form-control number" id="deduction" placeholder="0.00" name="deduction" value="<?php echo $user_data->deduction; ?>" required="required">
        </div>
    </div> <!-- Deductions wrapper -->
    <h6>Company Contribution for Employee Benefits</h6>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="sss_comcont">SSS Contribution</label>
            <input type="text" class="form-control number" id="sss_comcont" placeholder="0.00" name="sss_comcont" value="<?php echo $user_data->company_contri_sss; ?>" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="philhealth_comcont">Phil Health Contribution</label>
            <input type="text" class="form-control number" id="philhealth_comcont" placeholder="0.00" name="philhealth_comcont" value="<?php echo $user_data->company_contri_philhealth; ?>" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="hmdf_comcont">HMDF Contribution</label>
            <input type="text" class="form-control number" id="hmdf_comcont" placeholder="0.00" name="hmdf_comcont" value="<?php echo $user_data->company_contri_hmdf; ?>" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="contri_gsis">GSIS Contribution</label>
            <input type="text" class="form-control number" id="contri_gsis" placeholder="0.00" name="contri_gsis" required="required" value="<?php echo $user_data->company_contri_gsis; ?>">
        </div>
    </div> <!-- Contributions wrapper -->
    <h6>Adjustment</h6>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="adjustment">Other Adjustment</label>
            <input type="text" class="form-control number" id="adjustment" placeholder="0.00" name="adjustment" value="<?php echo $user_data->adjustment; ?>" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="late">Late amount per minute</label>
            <input type="text" class="form-control number" id="late" placeholder="0.00" name="late" value="<?php echo $user_data->late_amount; ?>" required="required">
        </div>
    </div> <!-- Adjustment wrapper -->
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
    </div> <!-- Card -->
</div>    
</div> <!-- Additional Information Wrapper -->