<?php 
$qualification   = new Qualification;
$user_id         = $user_data->id;
$tech_skill_data = $qualification->get_tech_skill_data($user_id);
$levels          = array("Junior", "Mid Level", "Senior");

?>
<div id="technical-skills" class="card mb-3 inner-card"> 
    <div class="card-header inner-card">
        <div class="form-row">
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2 button-right">
                <input type="hidden" id="employeeID" value="<?php echo $user_id; ?>"/>
                <button type="submit" class="btn btn-primary pm-blue btn-lg d-none" id="tsuModalBtn" data-toggle="modal" data-target="#technicalSkillUpdate">Update</button>
                <button type="submit" class="btn btn-primary pm-blue btn-lg" data-toggle="modal" data-target="#technicalSkillAddNew"><i class="fa-solid fa-gears"></i> Add New</button>
            </div>
        </div>
    </div>
    <div class="card-body inner-card">
        <!-- Table -->
        <section>
            <table id = "technical" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm dark-blue">Description</th>
                        <th class="th-sm dark-blue">Level</th>
                        <th class="th-sm dark-blue">Remark</th>
                        <th class="th-sm dark-blue">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tech_skill_data as $key => $value) : ?>
                        <tr>
                            <td><?php echo $value->description; ?></td>
                            <td><?php echo $value->level; ?></td>
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

<!-- Add new technical skill modal starts here... -->

<div class="modal fade" id="technicalSkillAddNew" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white">Add New Technical Skill</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="technicalSkillAddForm">
                    <div class="form-row">
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="description">Description</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="" required="required">
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
                <button type="button" id="close_ts_modal" class="btn btn-primary pm-blue" data-dismiss="modal">Close</button>
                <button type="submit" id="add_ts" class="btn btn-primary pm-blue">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="technicalSkillUpdate" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white">Update Technical Skill</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="technicalSkillUpdateForm">
                    
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="close_uts_modal" class="btn btn-primary pm-blue" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary pm-blue">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        $('#technical').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
</script>