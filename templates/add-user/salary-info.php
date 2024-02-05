<div class="card mb-3">
    <div class="card-header">
    Salary/Benefits Information
    </div>
    <div class="card-body">
    <h6>Salary</h6>
    <fieldset class="form-group">
        <div class="row">
        <div class="col-md-6">
            <div class="row">
            <legend class="col-form-label col-md-6 pt-0">Basic Salary</legend>
            <div class="col-md-8">
                <input type="text" class="form-control number" id="basic_pay" placeholder="0.00" name="basic_pay" required="required">
            </div>
            </div>
        </div> <!-- Basic Pay Wrapper -->
        <div class="col-md-6">
            <div class="row">
            <legend class="col-form-label col-md-6 pt-0">Salary Type</legend>
            <div class="col-md-6">
                <div class="form-check">
                <input class="form-check-input cutoff" type="radio" name="cutoff" id="daily" value="0" checked>
                <label class="form-check-label" for="daily">
                    Daily
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input cutoff" type="radio" name="cutoff" id="monthly" value="1">
                <label class="form-check-label" for="monthly">
                    Monthly
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input cutoff" type="radio" name="cutoff" id="semi-fixed" value="2">
                <label class="form-check-label" for="semi-fixed">
                    Semi Monthly
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input cutoff" type="radio" name="cutoff" id="monthly-fixed" value="3">
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
                <input type="text" class="form-control number" id="cola" placeholder="0.00" name="cola" required="required">
            </div>
            </div>
        </div> <!-- Cutoff Type Wrapper-->
        <div class="col-md-6">
            <div class="row">
            <legend class="col-form-label col-md-6 pt-0">Allowance Type</legend>
            <div class="col-md-6">
                <div class="form-check">
                <input class="form-check-input cola_type" type="radio" name="cola_type" id="cola-daily" value="0" checked>
                <label class="form-check-label" for="cola-daily">
                    Per Day
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input cola_type" type="radio" name="cola_type" id="cola-fixed" value="1">
                <label class="form-check-label" for="cola-fixed">
                    Fixed
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
                                <input type="text" class="form-control number" id="cola_limit" placeholder="0.00" name="cola_limit" value="" />
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
            <input type="text" class="form-control number" id="allow_pera" placeholder="0.00" name="allow_pera" value="0">
        </div>
        <div class="form-group col-md-4">
            <label for="allow_rice">RICE ALLOW.</label>
            <input type="text" class="form-control number" id="allow_rice" placeholder="0.00" name="allow_rice" value="0">
        </div>
        </div>
    </fieldset>
    </div>
</div>