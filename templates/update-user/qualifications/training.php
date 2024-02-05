<?php 
$qualification  = new Qualification;
$user_id        = $user_data->id;
$training_data  = $qualification->get_training_data($user_id);
$levels         = array("Beginner", "Intermediate", "Advanced");

?>
<div id="training-template" class="card mb-3 inner-card"> 
    <div class="card-header inner-card">
        <div class="form-row">
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2 button-right">
                <input type="hidden" id="employeeID" value="<?php echo $user_id; ?>"/>
                <button type="submit" class="btn btn-primary btn-sm d-none" id="openUpdateTrainingBtn" data-toggle="modal" data-target="#trainingUpdate">Update</button>
                <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#trainingAddNew"><i class="fa-solid fa-dumbbell"></i> Add New</button>
            </div>
        </div>
    </div>
    <div class="card-body inner-card">
        <!-- Table -->
        <section>
            <table id="training" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm dark-blue">Name</th>
                        <th class="th-sm dark-blue">Description</th>
                        <th class="th-sm dark-blue">Trainor</th>
                        <th class="th-sm dark-blue">Level</th>
                        <th class="th-sm dark-blue">Date</th>
                        <th class="th-sm dark-blue">Remark</th>
                        <th class="th-sm dark-blue">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($training_data as $key => $value) : ?>
                        <tr>
                            <td><?php echo $value->name; ?></td>
                            <td><?php echo $value->description; ?></td>
                            <td><?php echo $value->trainor; ?></td>
                            <td><?php echo $value->level; ?></td>
                            <td><?php echo $value->training_date; ?></td>
                            <td><?php echo $value->remark; ?></td>
                            <td class="text-center">
                                <i class="fa-solid fa-pen-to-square" data-id="<?php echo $value->id; ?>"></i>
                                <i class="fa-solid fa-trash" data-id="<?php echo $value->id; ?>"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </section>
    </div>
</div>

<!-- Add new other skill modal starts here... -->

<div class="modal fade" id="trainingAddNew" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white">Add New Training</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="trainingAddForm">
                    <div class="form-row">
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">Training Name</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="" required />
                                </div>    
                            </div>                    
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="description">Description</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="" required />
                                </div>    
                            </div>                    
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="trainor">Trainor</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="trainor" placeholder="Trainor's name" name="trainor" value="" required /> 
                                </div> 
                            </div>                       
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="level">Levels</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <select class="form-control custom-select-2" id="level" name="level">
                                        <option value="">Select Level</option>
                                        <?php foreach($levels as $level): ?>
                                            <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>                      
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="date">Date</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="date" class="form-control" id="date" name="date" required />
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
                    <input type="hidden" id="employeeID" name="uid" value="<?php echo $user_id; ?>" />
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="close_training_modal" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="submit" id="add_training" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Update other skill modal starts here... -->

<div class="modal fade" id="trainingUpdate" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white"> Update Training</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="trainingUpdateForm">
                    
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="closeUpdateTrainingBtn" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        $('#training').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
</script>