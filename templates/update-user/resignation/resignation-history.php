<div id="resignation-template" class="card mb-3 inner-card">
  <div class="card-header inner-card">
    <div class="form-row">
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-6 button-right">
        <input type="hidden" id="employeeID" value="<?php echo $user_data->id; ?>" />
        <button type="submit" class="btn btn-sm btn-primary d-none" id="openUpdateContModalBtn" data-toggle="modal" data-target="#empContractUpdate"><i class="fa-solid fa-pen-to-square pr-2"></i>Update Contract</button>
        <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#empContractAddNew"><i class="fa-solid fa-circle-plus"></i> Add New</button>
        <!-- </div> -->
      </div>
    </div>
  </div>
  <div class="card-body inner-card">
    <!-- Table -->
    <section>
      <table id="resignation-table" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm dark-blue text-center">Empl. Code</th>
            <th class="th-sm dark-blue text-center">Full Name</th>
            <th class="th-sm dark-blue text-center">Company</th>
            <th class="th-sm dark-blue text-center">Department</th>
            <th class="th-sm dark-blue text-center">Category</th>
						<th class="th-sm dark-blue text-center">Notice Date</th>
            <th class="th-sm dark-blue text-center">Last Working Date</th>
            <th class="th-sm dark-blue text-center">Last Service Date</th>
            <th class="th-sm dark-blue text-center">Annual Leave Balance</th>
            <th class="th-sm dark-blue text-center">Blacklist</th>
						<th class="th-sm dark-blue text-center">Remark</th>
            <th class="th-sm dark-blue text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $contracts_data as $key => $value ): ?>
            <tr>
              <td><?php echo $value->contract_code; ?></td>
              <td><?php echo $value->contract_start_date; ?></td>
              <td><?php echo $value->contract_end_date; ?></td>
              <td><?php echo $value->effective_date; ?></td>
              <td class="text-center">
                <i class="fa-solid fa-pen-to-square" data-id="<?php echo $value->id; ?>"></i>
                <i class="fa-solid fa-trash" data-id="<?php echo $value->id; ?>"></i>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <!-- Table footer -->
        </tfoot>
      </table>
    </section>
  </div>
</div>