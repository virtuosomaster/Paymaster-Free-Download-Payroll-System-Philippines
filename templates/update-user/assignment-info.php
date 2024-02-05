<div id="assignment-schedule" class="card mb-3 inner-card">
    <form action="#" id="assignment-info-form" method="POST">
        <div class="card-header inner-card">
        </div>
        <div class="card-body inner-card">
        <h6>Other Information</h6>
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
        </div> <!-- assignments --> 
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
        </div> <!-- Adjustment wrapper -->
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
    </form>
</div><!-- #assignment-schedule -->