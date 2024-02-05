<?php
$emp_history      = new EmpHistory;
$user_id          = $user_data->id;
$emp_history_data = $emp_history->get_emp_history_data($user_id);
$positions        = array("Programmer", "Designer", "Developer");
?>
<div id="employee-history-template" class="card mb-3 inner-card"> 
  <div class="breadcrumb bg-info text-white">
    Employment History
  </div>
  <div class="card-header inner-card">
    <div class="form-row">
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2 button-right">
        <input type="hidden" id="employeeID" value="<?php $user_id; ?>" />
        <button type="submit" class="btn btn-primary pm-blue btn-lg d-none" id="openEmpHistoryModalBtn" data-toggle="modal" data-target="#employeeHistoryUpdate">Update</button>
        <button type="submit" class="btn btn-primary pm-blue btn-lg" data-toggle="modal" data-target="#employeeHistoryAddNew"><i class="fa-solid fa-clock-rotate-left"></i> Add New</button>
      </div>
    </div>
  </div>
  <div class="card-body inner-card">
    <!-- Table -->
    <section>
      <table id="employee-history-table" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm dark-blue">From</th>
            <th class="th-sm dark-blue">To</th>
            <th class="th-sm dark-blue">Company's Name</th>
            <th class="th-sm dark-blue">Position</th>
            <th class="th-sm dark-blue">Latest Salary</th>
            <th class="th-sm dark-blue">Remarks</th>
            <th class="th-sm dark-blue">Actions</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($emp_history_data as $key => $value) : ?>
              <tr>
                <td><?php echo $value->emp_history_from; ?></td>
                <td><?php echo $value->emp_history_to; ?></td>
                <td><?php echo $value->company_name; ?></td>
                <td><?php echo $value->position; ?></td>
                <td><?php echo number_format($value->latest_salary, 2 ); ?></td>
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

<!-- Add new employee history modal starts here... -->

<div class="modal fade" id="employeeHistoryAddNew" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white">Add New Employee History</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="employeeHistoryAddForm">
                    <div class="form-row">
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="emp_history_from">From</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="date" class="form-control" id="emp_history_from" name="emp_history_from" value="" required="required">
                                </div>    
                            </div>                    
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="emp_history_to">To</label>
                                </div>
                                <div class="form-group col-md-8">
                                  <input type="date" class="form-control" id="emp_history_to" name="emp_history_to" value="" required="required">
                                </div> 
                            </div>                       
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="company_name">Company's Name</label>
                                </div>
                                <div class="form-group col-md-8">
                                  <input type="text" class="form-control" id="company_name" placeholder="Company Name" name="company_name" value="" required="required">
                                </div>
                            </div>                      
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="position">Position</label>
                                </div>
                                <div class="form-group col-md-8">
                                  <input type="text" class="form-control" id="position" placeholder="Position" name="position" value="" required="required">
                                </div>
                            </div>                      
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                  <label for="latest_salary">Latest Salary</label>
                                </div>
                                <div class="form-group col-md-8">
                                  <input type="text" class="form-control" id="latest_salary" placeholder="0.00" name="latest_salary" value="" />
                                </div>
                            </div>                      
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                  <label for="remark">Remarks</label>
                                </div>
                                <div class="form-group col-md-8">
                                  <input type="text" class="form-control" id="remark" placeholder="Remark" name="remark" value="" />
                                </div>
                            </div>                      
                        </div>
                    </div>
                  <input type="hidden" id="employeeID" name="uid" value="<?php echo $user_id; ?>"/>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="close_emp_his_modal" class="btn btn-primary pm-blue" data-dismiss="modal">Close</button>
                <button type="submit" id="save_emp_his_data" class="btn btn-primary pm-blue">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Update employee history modal starts here... -->

<div class="modal fade" id="employeeHistoryUpdate" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white">Update Employee History</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="employeeHistoryUpdateForm">
                    
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="closeEmpHistoryModalBtn" class="btn btn-primary pm-blue" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary pm-blue">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
  jQuery(document).ready(function ($) {
    $('#employee-history-table').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });
</script>