<?php 

$active_checker = $user_data->emp_status == 'active' ? 'checked' : '';
$inactive_checker = $user_data->emp_status == 'inactive' ? 'checked' : '';
?>
<form id="personal_info_2">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Employment Details
                        </div>
                        <div class="card-body">
                            <div class="form-row" style="flex-direction: column;">
                                <div class="form-group col-md-12">
                                    <label for="position">Designation</label>
                                    <input type="text" class="form-control" id="position" name="position" value="<?php echo $user_data->position; ?>" required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="service_start_date">Service Start Date</label>
                                    <input type="date" class="form-control" id="service_start_date" name="service_start_date" value="<?php echo $user_data->service_start_date; ?>" required/>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="service_end_date">Service End Date</label>
                                    <input type="date" class="form-control" id="service_end_date" name="service_end_date" value="<?php echo $user_data->service_end_date; ?>" />
                                </div>
                                <div class="form-group col-md-12">
                                    Status
                                    <div class="col-md-6" style="flex-direction: row; align-items:center">
                                        <div class="form-check">
                                            <input type="radio" id="active" class="form-check-input" value="active" name="emp_status" <?php echo $active_checker; ?> />
                                            <label for="active" class="form-check-label">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="inactive" class="form-check-input" value="inactive" name="emp_status" <?php echo $inactive_checker; ?> />
                                            <label for="inactive" class="form-check-label">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Transition Record
                        </div>
                        <div class="card-body">
                            <div class="form-row" style="flex-direction: column;">
                                <div class="form-group col-md-12">
                                    <!-- <label for="scope1">Scope 1</label> -->
                                    <input type="text" class="transrec-labels" id="position1" name="position1" placeholder="Scope 1" value="<?php echo $user_data->position1; ?>" />
                                    <input type="date" class="form-control" id="scope1" name="scope1" value="<?php echo $user_data->scope1; ?>" />
                                </div>
                                <div class="form-group col-md-12">
                                    <!-- <label for="scope2">Scope 2</label> -->
                                    <input type="text" class="transrec-labels" id="position2" name="position2" placeholder="Scope 2" value="<?php echo $user_data->position2; ?>" />
                                    <input type="date" class="form-control" id="scope2" name="scope2" value="<?php echo $user_data->scope2; ?>" />
                                </div>
                                <div class="form-group col-md-12">
                                    <!-- <label for="scope3">Scope 3</label> -->
                                    <input type="text" class="transrec-labels" id="position3" name="position3" placeholder="Scope 3" value="<?php echo $user_data->position3; ?>" />
                                    <input type="date" class="form-control" id="scope3" name="scope3" value="<?php echo $user_data->scope3; ?>" />
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <!-- <label for="scope4">Scope 4</label> -->
                                            <input type="text" class="transrec-labels" id="position4" name="position4" placeholder="Scope 4" value="<?php echo $user_data->position4; ?>" />
                                            <input type="date" class="form-control" id="scope4" name="scope4" value="<?php echo $user_data->scope4; ?>" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <!-- <label for="scope5">Scope 5</label> -->
                                            <input type="text" class="transrec-labels" id="position5" name="position5" placeholder="Scope 5" value="<?php echo $user_data->position5; ?>" />
                                            <input type="date" class="form-control" id="scope5" name="scope5" value="<?php echo $user_data->scope5; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="card">
                        <div class="card-header">
                            PC Set Information
                        </div>
                        <div class="card-body">
                            <div class="form-row" style="flex-direction: column;">
                                <div class="form-group col-md-12">
                                    <label for="monitor">Monitor Serial Number</label>
                                    <input type="text" class="form-control" id="monitor" name="monitor" value="<?php echo $user_data->monitor; ?>" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="mouse">Mouse Serial Number</label>
                                    <input type="text" class="form-control" id="mouse" name="mouse" value="<?php echo $user_data->mouse; ?>" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="keyboard">Keyboard Serial Number</label>
                                    <input type="text" class="form-control" id="keyboard" name="keyboard" value="<?php echo $user_data->keyboard; ?>" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="headset">Headset Serial Number</label>
                                    <input type="text" class="form-control" id="headset" name="headset" value="<?php echo $user_data->headset; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Bank Details
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            Main Account
                                        </div>
                                        <div class="card-body">
                                            <div class="form-row" style="flex-direction: column;">
                                                <div class="form-group col-md-12">
                                                    <label for="acc_name">Account Name</label>
                                                    <input type="text" class="form-control" id="acc_name" name="acc_name" value="<?php echo $user_data->acc_name; ?>" required="required">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="acc_no">Account Number</label>
                                                    <input type="text" class="form-control" id="acc_no" name="acc_no" value="<?php echo $user_data->acc_no; ?>" required="required">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="bank_branch">Bank Branch</label>
                                                    <input type="text" class="form-control" id="bank_branch" name="bank_branch" value="<?php echo $user_data->bank_branch; ?>" required="required">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="bank_name">Bank Name</label>
                                                    <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php echo $user_data->bank_name; ?>" required="required">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="swift_code">Swift Code</label>
                                                    <input type="text" class="form-control" id="swift_code" name="swift_code" value="<?php echo $user_data->swift_code; ?>" required="required">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            Secondary Account
                                        </div>
                                        <div class="card-body">
                                            <div class="form-row" style="flex-direction: column;">
                                                <div class="form-group col-md-12">
                                                    <label for="acc_name1">Account Name</label>
                                                    <input type="text" class="form-control" id="acc_name1" name="acc_name1" value="<?php echo $user_data->acc_name1; ?>" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="acc_no1">Account Number</label>
                                                    <input type="text" class="form-control" id="acc_no1" name="acc_no1" value="<?php echo $user_data->acc_no1; ?>" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="bank_branch1">Bank Branch</label>
                                                    <input type="text" class="form-control" id="bank_branch1" name="bank_branch1" value="<?php echo $user_data->bank_branch1; ?>" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="bank_name1">Bank Name</label>
                                                    <input type="text" class="form-control" id="bank_name1" name="bank_name1" value="<?php echo $user_data->bank_name1; ?>" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="swift_code1">Swift Code</label>
                                                    <input type="text" class="form-control" id="swift_code1" name="swift_code1" value="<?php echo $user_data->swift_code1; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header inner-card">
                <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2 button-right">
                        <button type="submit" class="btn btn-primary pm-blue btn-lg">Update Records</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="uid" value="<?php echo $user_data->id; ?>" />
</form>
<div id="assignment-schedule" class="card mb-3">
    <form action="#" id="assignment-info-form" method="POST">
        <div class="card-header">
            Assignment Information
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="whours">Working Hours</label>
                    <input type="text" class="form-control number" id="whours" placeholder="8" name="whours" value="<?php echo $user_data->work_hours; ?>" required="required">
                </div>
                <div class="form-group col-md-4">
                    <label for="empStatus">Employee Status</label>
                    <select id="empStatus" name="empStatus" class="form-control" required="required">
                        <option value="">Choose...</option>
                        <option value="1" <?php echo ( $user_data->work_status ) ? 'selected' : '' ; ?>>Active</option>
                        <option value="0" <?php echo ( !$user_data->work_status ) ? 'selected' : '' ; ?>>Inactive</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="empLevel">Employee Level</label>
                    <select id="empLevel" name="empLevel" class="form-control" required="required">
                        <option value="">Choose...</option>
                        <option value="1" <?php echo ( $user_data->access_level == 1 ) ? 'selected' : '' ; ?> >Administrator</option>                    
                        <option value="2" <?php echo ( $user_data->access_level == 2 ) ? 'selected' : '' ; ?> >Supervisor</option>
                        <option value="3" <?php echo ( $user_data->access_level == 3 ) ? 'selected' : '' ; ?> >Encoder</option>
                        <option value="4" <?php echo ( $user_data->access_level == 4 ) ? 'selected' : '' ; ?> >Rank and File</option>
                    </select>
                </div>
            </div>
            <h6>Assignment</h6>
            <div class="form-row assignments">
                <div class="form-group col-md-4">
                    <label for="designation">Designation</label>
                    <select id="designation" class="form-control" name="designation" required="required">
                        <option value="0">Choose...</option>
                        <?php
                        $designations = $settings->get_settings_by_name('designation');
                        if( !empty( $designations ) ){
                        foreach ($designations as $designation ) {
                            $designationID   = $designation->id;
                            $designationName = $designation->value;
                            ?><option value="<?php echo $designationID; ?>" <?php echo ( $user_data->work_designation == $designationID ) ? 'selected' : '' ; ?> ><?php echo $designationName; ?></option><?php
                        }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="group">Group</label>
                    <select id="group" class="form-control" name="group">
                        <option value="0">Choose...</option>
                        <?php
                        $groups = $settings->get_settings_by_name('group');
                        if( !empty( $groups ) ){
                        foreach ($groups as $group ) {
                            $groupID   = $group->id;
                            $groupName = $group->value;
                            ?><option value="<?php echo $groupID; ?>" <?php echo ( $user_data->work_group == $groupID ) ? 'selected' : '' ; ?>><?php echo $groupName; ?></option><?php
                        }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="team">Team</label>
                    <select id="team" class="form-control" name="team">
                        <option value="0">Choose...</option>
                        <?php
                        $teams = $settings->get_settings_by_name('team');
                        if( !empty( $teams ) ){
                        foreach ($teams as $team ) {
                            $teamID   = $team->id;
                            $teamName = $team->value;
                            ?><option value="<?php echo $teamID; ?>" <?php echo ( $user_data->work_team == $teamID ) ? 'selected' : '' ; ?>><?php echo $teamName; ?></option><?php
                        }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <h6>Schedule</h6>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="schedule">Work Schedule</label>
                    <select id="schedule" class="form-control" name="schedule" required="required">
                        <option value="0">Open Schedule</option>
                        <?php
                        $schedules = $settings->get_settings_by_name('schedules');
                        if( !empty( $schedules ) ){
                        foreach ($schedules as $schedule ) {
                            $scheduleID   = $schedule->id;
                            $schedule     = unserialize( $schedule->value );
                            ?><option value="<?php echo $scheduleID; ?>" <?php echo ( $user_data->schedule == $scheduleID ) ? 'selected' : '' ; ?>><?php echo $schedule['name']; ?></option><?php
                        }
                        }
                        ?>
                    </select>
                </div>
                <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-6 pt-0">Day Off(s)</legend>
                    <?php
                    $day_off = unserialize( $user_data->day_off );
                    if( empty( $day_off ) ){
                    $day_off = array();
                    }
                    ?>
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="sunday" value="sunday" <?php echo in_array( 'sunday', $day_off ) ? 'checked' : '' ; ?>>
                            <label class="form-check-label" for="sunday">Sunday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="monday" value="monday" <?php echo in_array( 'monday', $day_off ) ? 'checked' : '' ; ?>>
                            <label class="form-check-label" for="monday">Monday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="tuesday" value="tuesday" <?php echo in_array( 'tuesday', $day_off ) ? 'checked' : '' ; ?>>
                            <label class="form-check-label" for="tuesday">Tuesday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="wednesday" value="wednesday" <?php echo in_array( 'wednesday', $day_off ) ? 'checked' : '' ; ?>>
                            <label class="form-check-label" for="wednesday">Wednesday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="thursday" value="thursday" <?php echo in_array( 'thursday', $day_off ) ? 'checked' : '' ; ?>>
                            <label class="form-check-label" for="thursday">Thursday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="friday" value="friday" <?php echo in_array( 'friday', $day_off ) ? 'checked' : '' ; ?>>
                            <label class="form-check-label" for="friday">Friday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="saturday" value="saturday" <?php echo in_array( 'saturday', $day_off ) ? 'checked' : '' ; ?>>
                            <label class="form-check-label" for="saturday">Saturday</label>
                        </div>
                    </div>
                </div>
                </fieldset>
            </div>
            <div class="card-header inner-card">
                <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-2 button-right">
                        <button type="submit" class="btn btn-primary pm-blue btn-lg">Update Records</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $user_data->id; ?>" />
        </div>
    </form>
</div><!-- #assignment-schedule -->