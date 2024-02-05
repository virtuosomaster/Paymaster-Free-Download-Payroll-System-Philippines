<?php
global $sessionUserId;
$contracts        = new Contract;
$employee         = new Employee;
$contracts_data   = $contracts->get_employee_contract_data($user_data->id);
$emp_types        = array(
  "trainee" => "Trainee",
  "probationary" => "Probationary",
  "regular" => "Regular / Permanent", 
  "fixed" => "Term / Fixed", 
  "project" => "Project",
  "seasonal" => "Seasonal",
  "casual" =>  "Casual",
  "freelance" => "Freelance"
);
$current_user     = $employee->get_user( $sessionUserId);
?>
<style>
  .dashed {
    border-bottom: 1px dashed #d1cdcd;
  }
</style>
<div class="card mb-3">
  <div class="card-header">
    Employment Contract
  </div>
  <div class="card-body">
    <div class="form-row">
      <div class="form-group col-md-4">
        <label>Employment Type</label>
      </div>
      <div class="form-group col-md-4">
        <label>Effective Date</label>
      </div>
      <div class="form-group dol-md-4">
        <label>Salary Adjustment</label>
      </div>
    </div>
    <div id="contract-history-container" class="py-3">
      <?php if ( empty($contracts_data) ) : ?>
        <p class="text-center m-0">No records yet.</p>
      <?php else: ?>
        <?php foreach ($contracts_data as $key => $val): ?>
          <div class="form-row">
            <div class="form-group col-md-4">
              <input type="text" class="form-control" value="<?php echo ucfirst($val->emp_type); ?>" readonly />
            </div>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" value="<?php echo $val->effective_date; ?>" readonly />
            </div>
            <div class="form-group col-md-4">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <input type="text" class="form-control" value="<?php echo number_format($val->daily, 2, '.', ','); ?>" readonly />
                </div>
                <div class="form-group col-md-4">
                  <input type="text" class="form-control" value="<?php echo number_format($val->monthly, 2, '.', ','); ?>" readonly />
                </div>
                <div class="form-group col-md-4">
                  <?php if ($current_user->access_level == 1 && $key === 0): ?>
                    <button type="button" class="btn btn-danger delete-contract btn-md ml-1" data-id="<?php echo $val->id; ?>">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <form action="#" id="emp_contract_form" method="post" autocomplete="off">
      <div class="form-row">
        <div class="form-group col-md-4">
          <select name="emp_type" id="emp_type" class="custom-select-2">
            <option value="">Select Employment Type</option>
            <?php foreach ($emp_types as $key => $val): ?>
              <option value="<?php echo $key ?>"><?php echo $val; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group col-md-4">
          <input type="date" class="form-control" name="effective_date" id="effective_date" required />
        </div>
        <div class="form-group col-md-4">
          <div class="form-row">
            <div class="form-group col-md-4">
              <input type="text" class="form-control number" placeholder="Daily" name="daily" id="daily" required />
            </div>
            <div class="form-group col-md-4">
              <input type="text" class="form-control number" placeholder="Monthly" name="monthly" id="monthly" required />
            </div>
            <div class="form-group col-md-4">
              <button type="submit" class="btn btn-primary pm-blue btn-lg ml-1">Save</button>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="uid" value="<?php echo $user_data->id; ?>" />
    </form>
  </div>
</div>

<script>
  jQuery(document).ready(function($) {
    $('#employee-contract-table').DataTable();
    $('.dataTables_length').addClass('bs-select');
    $('.modal-body .custom-rows').addClass('dashed py-3');
    $('.modal-body .add-custom-rows').addClass('dashed py-3');
    $('.info-custom-rows').addClass('dashed py-3');

    // helper functions

    function enable(selector) {
      selector.children().each(function() {
        $(this).removeAttr('disabled');
      });
    }

    function disable(selector) {
      selector.children().each(function() {
        $(this).attr('disabled', true);
      });
    }

    function disableByDefault( selector ) {
      selector.each(function() {
        $(this).attr('disabled', true);
      });
    }

    // disable all input tag by default

    const inputs = $('.custom-rows table tbody tr td').children(),
    infoInputs   = $('.info-custom-rows table tbody tr td').children();
  
    disableByDefault(inputs);
    disableByDefault(infoInputs);

    // toggle disable property depending on radiobutton value 

    $('#empContractUpdateForm').on('change', '.custom-control-input',function() {
      let radioValue = $(this).val();
      if (radioValue === "position") {
        enable($('.position-section-row table tbody tr td'));
        enable($('.lm-section-row table tbody tr td'));
      } else {
        disable($('.position-section-row table tbody tr td'));
        disable($('.lm-section-row table tbody tr td'));
      }
      if (radioValue === "salary") {
        enable($('.salary-section-row table tbody tr td'));
      } else {
        disable($('.salary-section-row table tbody tr td'));
      }
      if (radioValue === "contract") {
        enable($('.contract-section-row table tbody tr td'));
      } else {
        disable($('.contract-section-row table tbody tr td'));
      }
      if (radioValue === "terminate") {
        enable($('.resignation-section-row table tbody tr td'));
        $('.resignation-section-row').removeClass('d-none');
      } else {
        disable($('.resignation-section-row table tbody tr td'));
        $('.resignation-section-row').addClass('d-none');
      }
    });
  });
</script>