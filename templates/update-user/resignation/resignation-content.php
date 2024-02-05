<?php 
$resignation = new Contract;
$categories = array("Category 1", "Category 2", "Category 3");
$user_data = $employee->get_user( intval( $_GET['uid'] ) );
$user_id = $user_data->id;
$resignation_data = $resignation->get_resignation_data($user_id);
$resignation_history_data = $resignation->get_resignation_history_data($user_id);

?>
<div id="resignation-template" class="card mb-3 inner-card d-none">
  <div class="card-header inner-card">
    <div class="form-row">
      <div class="form-group col-md-2">
					<h4 style="color: #007bff;">Resignation</h4>
			</div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-6 button-right">
        <input type="hidden" id="employeeID" value="<?php echo $user_data->id; ?>" />
        <button type="submit" class="btn btn-sm btn-primary d-none" id="openUpdatResignModalBtn" data-toggle="modal" data-target="#empResignUpdate"><i class="fa-solid fa-pen-to-square pr-2"></i>Update Contract</button>
        <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#empResignAddNew"><i class="fa-solid fa-circle-plus"></i> Add New</button>
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
          <?php foreach ( $resignation_data as $key => $value ): ?>
            <tr>
              <td><?php echo $value->emp_code; ?></td>
              <td><?php echo $value->fullname; ?></td>
              <td><?php echo $value->company; ?></td>
              <td><?php echo $value->department; ?></td>
							<td><?php echo $value->category; ?></td>
              <td><?php echo $value->notice_date; ?></td>
              <td><?php echo $value->last_working_date; ?></td>
              <td><?php echo $value->last_service_date; ?></td>
							<td><?php echo $value->annual_leave_bal; ?></td>
              <td><?php echo $value->blacklist; ?></td>
              <td><?php echo $value->remark; ?></td>
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
<div id="resignation-history-template" class="card mb-3 inner-card">
  <div class="card-header inner-card">
	<h4 style="color: #007bff;">Resignation History</h4>
    <div class="form-row">
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-6 button-right">
        <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#empResignAddNew"><i class="fa-solid fa-circle-plus"></i> Add New</button>
      </div>
    </div>
  </div>
  <div class="card-body inner-card">
    <!-- Table -->
    <section>
      <table id="resignation-history-table" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
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
          <?php foreach ( $resignation_history_data as $key => $value ): ?>
            <tr>
						<td><?php echo $value->emp_code; ?></td>
              <td><?php echo $value->fullname; ?></td>
              <td><?php echo $value->company; ?></td>
              <td><?php echo $value->department; ?></td>
							<td><?php echo $value->category; ?></td>
              <td><?php echo $value->notice_date; ?></td>
              <td><?php echo $value->last_working_date; ?></td>
              <td><?php echo $value->last_service_date; ?></td>
							<td><?php echo $value->annual_leave_bal; ?></td>
              <td><?php echo $value->blacklist; ?></td>
              <td><?php echo $value->remark; ?></td>
              <td class="text-center">
                <!-- <i class="fa-solid fa-pen-to-square" data-id="<?php // echo $value->id; ?>"></i> -->
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

<!-- Add new resignation modal starts here... -->
<div class="modal fade" id="empResignAddNew" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class = "inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white">Add Resignation History</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id = "empResignAddForm">
                    <div class="form-row">
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="emp_code">Employee Code</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="emp_code" placeholder="Employee Code" name="emp_code" value="" required />
                                </div>    
                            </div>                    
                        </div>

                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="fullname">Full Name</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="fullname" placeholder="Fullname" name="fullname" value="" required />
                                </div> 
                            </div>                       
                        </div>

												<div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="company">Company</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="company" placeholder="Company" name="company" value="" required />
                                </div> 
                            </div>                       
                        </div>

												<div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="department">Department</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="department" placeholder="Department" name="department" value="" required />
                                </div> 
                            </div>                       
                        </div>

                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="category">Category</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <select class = "form-control custom-select-2" name="category" id="category">
                                        <option value="">Select Category</option>
                                        <?php foreach($categories as $category): ?>
                                            <option><?php echo $category; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> 
                            </div>                       
                        </div>

                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="notice_date">Notice Date</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="date" class="form-control" id="notice_date" placeholder="Notice Date" name="notice_date" value="" required />
                                </div>
                            </div>                      
                        </div>

												<div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="last_working_date">Last Working Date</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="date" class="form-control" id="last_working_date" placeholder="Notice Date" name="last_working_date" value="" required />
                                </div>
                            </div>                      
                        </div>

												<div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="last_service_date">Last Service Date</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="date" class="form-control" id="last_service_date" placeholder="Notice Date" name="last_service_date" value="" required />
                                </div>
                            </div>                      
                        </div>

                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="annual_leave_bal">Annual Leave Balance</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="annual_leave_bal" placeholder="Annual Leave Balance" name="annual_leave_bal" value="" required />
                                </div>
                            </div>                      
                        </div>

												<div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="blacklist">Blacklist</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="blacklist" placeholder="Blacklist" name="blacklist" value="" required />
                                </div>
                            </div>                      
                        </div>

												<div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="remark">Remark</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="remark" placeholder="Remark" name="remark" value="" required />
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <input type="hidden" name="uid" value="<?php echo $user_id; ?>"/>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="close_add_resignation_modal" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="submit" id="add_resignation" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Add new resignation modal starts here... -->
<div class="modal fade" id="empResignUpdate" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class = "inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white">Edit Resignation</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="empResignUpdateForm">
                    
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="closeUpdatResignModalBtn" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
	jQuery(document).ready(function($) {
		$('#resignation-table, #resignation-history-table').DataTable();
    $('.dataTables_length').addClass('bs-select');
	});
</script>