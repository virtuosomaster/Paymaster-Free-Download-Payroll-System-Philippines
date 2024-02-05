<?php 
$fam_rel       = new Family;
$user_id       = $user_data->id;
$famrel_data   = $fam_rel->get_famrel_data($user_id);
$relationships = array("Father", "Grandmother", "Grandfather", "Uncle", "Sister", "Wife", "Son", "Daughter", "Children", "Mother-in-law", "Mother", "Father-in-law", "Brother", "Husband", "Stepmother", "Sister-in-law", "Grandmother-in-law", "Other");
$employees     = array("Emp 1", "Emp 2", "Emp 3");
?>
<div id="family-rel-template" class="card mb-3 inner-card"> 
  <div class="card-header inner-card">
    <div class="form-row">
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2"></div>
      <div class="form-group col-md-2 button-right">
        <button type="submit" class="btn btn-primary btn-sm d-none" id="openFamrelModalBtn" data-toggle="modal" data-target="#familyRelUpdate">Update</button>
        <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#familyRelAddNew"><i class="fa-solid fa-heart"></i> Add New</button>
      </div>
    </div>
  </div>
  <div class="card-body inner-card">
    <!-- Table -->
    <section>
      <table id="family-rel-table" class="table table-striped table-bordered table-sm" cellspacing="0">
        <thead>
          <tr>
            <th class="th-sm dark-blue">Name</th>
            <th class="th-sm dark-blue">Relationship</th>
            <th class="th-sm dark-blue">D.O.B</th>
            <th class="th-sm dark-blue">Occupation</th>
            <th class="th-sm dark-blue">Remark</th>
            <th class="th-sm dark-blue">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $famrel_data as $key => $value ): ?>
            <tr>
              <td><?php echo $value->fullname; ?></td>
              <td><?php echo $value->relationship; ?></td>
              <td><?php echo $value->date_of_birth; ?></td>
              <td><?php echo $value->occupation; ?></td>
              <!-- <td><?php echo $value->id_no; ?></td>
              <td class="text-center">
                <?php $icon  = $value->is_pit_dependent == 1 ? 'check' : 'xmark'; ?>
                <?php $color = $value->is_pit_dependent == 1 ? 'green' : 'red'; ?>
                <i class="fa-solid fa-square-<?php echo $icon; ?>" style="color: <?php echo $color; ?>"></i>
              </td>
              <td><?php echo $value->pit_start_apply_date; ?></td>
              <td><?php echo $value->pit_end_apply_date; ?></td> -->
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

<!-- Add new family relationship modal starts here... -->

<div class="modal fade" id="familyRelAddNew" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white">Add New Family Relationship</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="familyRelAddForm">
                    <div class="form-row">
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="is_relative_in_company">Relative in Company</label>
                                </div>
                                <div class="form-group col-md-8 d-flex">
                                  <input type="checkbox" id="is_relative_in_company" name="is_relative_in_company" value="1" />
                                  <div class="col-md-12">
                                    <select class="custom-select-2" id="employee" name="employee" disabled>
                                      <option value="">-- Select Employee --</option>
                                      <?php foreach( $employees as $employee ) : ?>
                                        <option value="<?php echo $employee; ?>"><?php echo $employee; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                                </div>    
                            </div>                    
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="fullname">Full Name</label>
                                </div>
                                <div class="form-group col-md-8">
                                  <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" value="" required="required">
                                </div> 
                            </div>                       
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="date_of_birth">Date of Birth</label>
                            </div>
                            <div class="form-group col-md-8">
                              <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="" required="required">
                            </div>
                          </div>                      
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="relationship">Relationship</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <select class="form-control custom-select-2" id="relationship" name="relationship">
                                        <option value="">-- Select Relationship --</option>
                                        <?php foreach($relationships as $relationship): ?>
                                            <option value="<?php echo $relationship; ?>"><?php echo $relationship; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>                      
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                  <label for="occupation">Occupation</label>
                                </div>
                                <div class="form-group col-md-8">
                                  <input type="text" class="form-control" id="occupation" placeholder="Occupation" name="occupation" value="" required="required">
                                </div>
                            </div>                      
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                  <label for="remark">Remark</label>
                                </div>
                                <div class="form-group col-md-8">
                                  <input type="text" class="form-control" id="remark" placeholder="Remark" name="remark" value="" required="required">
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <input type="hidden" id="employeeID" name="uid" value="<?php echo $user_id; ?>"/>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="close_famrel_modal" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="submit" id="save_famrel_data" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Update family relationship modal starts here... -->

<div class="modal fade" id="familyRelUpdate" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white"> Update Family Relationship</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="familyRelUpdateForm">
                    
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="closeFamrelModalBtn" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
  jQuery(document).ready(function ($) {
    $('#family-rel-table').DataTable();
    $('.dataTables_length').addClass('bs-select');
    $('.dataTables_wrapper').addClass('table-responsive');

    // enable employee selection if related to company checkbox is checked

    $('#is_relative_in_company').change(function() {
      const empSelect = $('#employee');
      $(this).is(':checked') ? empSelect.removeAttr('disabled') : empSelect.attr('disabled', true);
    });

    // enable PIT appilcation start and end date fields if is_pit_dependent checkbox is checked

    $('#is_pit_dependent').change(function() {
      const startDate = $('#pit_start_apply_date'),
      endDate = $('#pit_end_apply_date');
      $(this).is(':checked') ? (startDate.removeAttr('disabled'), endDate.removeAttr('disabled')) : (startDate.attr('disabled', true), endDate.attr('disabled', true));
    });

    $('#familyRelUpdateForm').on('change', '#is_relative_in_company1', function() {
      let currElem = $(this);
      let employeeDropdown = $('#employee1');
      if (currElem.is(':checked')) {
        employeeDropdown.removeAttr('disabled');
      } else {
        employeeDropdown.prop('disabled', true);
      }
    });

    $('#familyRelUpdateForm').on('change', '#is_pit_dependent1', function() {
      let currElem = $(this);
      let pitStartApplyDate = $('#pit_start_apply_date1');
      let pitEndApplyDate = $('#pit_end_apply_date1');
      if (currElem.is(':checked')) {
        pitStartApplyDate.removeAttr('disabled');
        pitEndApplyDate.removeAttr('disabled');
      } else {
        pitStartApplyDate.prop('disabled', true);
        pitEndApplyDate.prop('disabled', true);
      }
    });

  });
</script>