<div class="card mb-3">
    <div class="card-header">
    Deduction/Contribution Information
    </div>
    <div class="card-body">
    <h6>Employee Contributions / Deductions</h6>
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="sss">SSS Contribution</label>
        <input type="text" class="form-control number" id="sss" placeholder="0.00" name="sss" required="required">
        </div>
        <div class="form-group col-md-6">
        <label for="philhealth">PhilHealth Contribution</label>
        <input type="text" class="form-control number" id="philhealth" placeholder="0.00" name="philhealth" required="required">
        </div>
        <div class="form-group col-md-6">
        <label for="hmdf">HMDF Contribution</label>
        <input type="text" class="form-control number" id="hmdf" placeholder="0.00" name="hmdf" required="required">
        </div>
        <div class="form-group col-md-6">
        <label for="gsis">Insurance</label>
        <input type="text" class="form-control number" id="gsis" placeholder="0.00" name="gsis" required="required">
        </div>
        <div class="form-group col-md-4">
        <label for="deduction">Other Deductions</label>
        <input type="text" class="form-control number" id="deduction" placeholder="0.00" name="deduction" required="required">
        </div>
    </div> <!-- Deductions wrapper -->
    <h6>Company Contribution for Employee Benefits</h6>
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="sss_comcont">SSS Contribution</label>
        <input type="text" class="form-control number" id="sss_comcont" placeholder="0.00" name="sss_comcont" required="required">
        </div>
        <div class="form-group col-md-6">
        <label for="philhealth_comcont">PhilHealth Contribution</label>
        <input type="text" class="form-control number" id="philhealth_comcont" placeholder="0.00" name="philhealth_comcont" required="required">
        </div>
        <div class="form-group col-md-6">
        <label for="hmdf_comcont">HMDF Contribution</label>
        <input type="text" class="form-control number" id="hmdf_comcont" placeholder="0.00" name="hmdf_comcont" required="required">
        </div>
        <div class="form-group col-md-6 d-none">
        <label for="contri_gsis">GSIS Contribution</label>
        <input type="text" class="form-control number" id="contri_gsis" placeholder="0.00" name="contri_gsis" required="required" value="0">
        </div>
    </div> <!-- Contributions wrapper -->
    <h6>Adjustment</h6>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="adjustment">Other Adjustment</label>
            <input type="text" class="form-control number" id="adjustment" placeholder="0.00" name="adjustment" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="late">Late amount per minute</label>
            <input type="text" class="form-control number" id="late" placeholder="0.00" name="late" required="required">
        </div>
        <div class="form-group col-md-6">
          <label for="overtime_amount">Overtime Amount</label>
          <input type="text" class="form-control number" id="overtime_amount" placeholder="0.00" name="overtime_amount" />
        </div>
        <div class="form-group col-md-6">
          <label for="holiday_amount">Holiday Amount</label>
          <input type="text" class="form-control number" id="holiday_amount" placeholder="0.00" name="holiday_amount" />
        </div>
    </div> <!-- Adjustment wrapper -->
    <h6>Tax Information</h6>
    <div class="form-row assignments">
        <div class="form-group col-md-6">
        <div class="form-group row">
            <div class="col-sm-6">TAX exempted?</div>
            <div class="col-sm-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="tax-exemption" value="1" name="tax_exemption">
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
            <option selected>Choose...</option>
            <option value="Z">Z</option>
            <option value="S/ME">S/ME</option>
            <option value="ME1/S1">ME1/S1</option>
            <option value="ME2/S2">ME2/S2</option>
            <option value="ME3/S3">ME3/S3</option>
            <option value="ME4/S4">ME4/S4</option>
        </select>
        </div>
    </div>
    </div> <!-- Card -->
</div>    
</div> <!-- Additional Information Wrapper -->