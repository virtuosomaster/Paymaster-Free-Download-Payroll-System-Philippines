<div class="card mb-3">
  <div class="card-header" style="position: relative;">
    Permanent Address
    <div class="autofill-wrapper">
      <input type="checkbox" name="autofill" id="autofill" style="margin-right: 5px;" <?php echo $autofill_checker; ?> />
      <label for="autofill" style="line-height: 30px;">Same with present address</label>
    </div>
  </div>
  <div class="card-body">
    <div class="form-row" style="flex-direction: column;">
      <div class="form-group col-md-12">
        <label for="bldg1">Building Number/Name</label>
        <input type="text" class="form-control" id="bldg1" placeholder="Building" name="bldg1" required="required">
      </div>
      <div class="form-group col-md-12">
        <label for="street1">Street</label>
        <input type="text" class="form-control" id="street1" placeholder="Street" name="street1" required="required">
      </div>
      <div class="form-group col-md-12">
        <label for="barangay1">Barangay</label>
        <input type="text" class="form-control" id="barangay1" placeholder="Barangay" name="barangay1" required />
      </div>
      <div class="row col-12">
        <div class="form-group col-md-6">
          <label for="city1">City</label>
          <input type="text" class="form-control" id="city1" placeholder="City" name="city1" required />
        </div>
        <div class="form-group col-md-3">
          <label for="zipcode1">Zip Code</label>
          <input type="text" class="form-control" id="zipcode1" placeholder="Zip code" name="zipcode1" required />
        </div>
      </div>
      <div class="form-group col-md-12">
        <label for="province1">Province</label>
        <input type="text" class="form-control" id="province1" placeholder="Province" name="province1" required />
      </div>
      <div class="form-group col-md-12">
        <label for="region1">Region</label>
        <input type="text" class="form-control" id="region1" placeholder="Region" name="region1" required />
      </div>
      <div class="form-group col-md-12">
        <label for="country1">Country</label>
        <input type="text" class="form-control" id="country1" placeholder="Country" name="country1" required="required">
      </div>
    </div>
  </div>
</div>