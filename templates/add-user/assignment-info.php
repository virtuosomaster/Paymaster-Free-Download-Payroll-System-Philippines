<div id="assignment-schedule" class="card mb-3"> 
    <div class="card-header">
    Assignment/Schedule Information
    </div>
    <div class="card-body">
    <h6>Other Information</h6>
    <div class="form-row">
        <div class="form-group col-md-4">
        <label for="whours">Working Hours</label>
        <input type="text" class="form-control number" id="whours" placeholder="8" name="whours" required="required">
        </div>
        <div class="form-group col-md-4">
        <label for="empStatus">Employee Status</label>
        <select id="empStatus" name="empStatus" class="form-control" required="required">
            <option value="">Choose...</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
        </div>
        <div class="form-group col-md-4">
        <label for="empLevel">Employee Level</label>
        <select id="empLevel" name="empLevel" class="form-control" required="required">
            <option value="">Choose...</option>
            <option value="1">Administrator</option>                     
            <option value="2">Supervisor</option>
            <option value="3">Encoder</option>
            <option value="4">Rank and File</option>
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
                ?><option value="<?php echo $designationID; ?>"><?php echo $designationName; ?></option><?php
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
                ?><option value="<?php echo $groupID; ?>"><?php echo $groupName; ?></option><?php
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
                ?><option value="<?php echo $teamID; ?>"><?php echo $teamName; ?></option><?php
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
            <option value="">Choose...</option>
            <?php
            $schedules = $settings->get_settings_by_name('schedules');
            if( !empty( $schedules ) ){
            foreach ($schedules as $schedule ) {
                $scheduleID   = $schedule->id;
                $schedule     = unserialize( $schedule->value );
                ?><option value="<?php echo $scheduleID; ?>"><?php echo $schedule['name']; ?></option><?php
            }
            }
            ?>
        </select>
        </div>
        <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-6 pt-0">Day Off(s)</legend>
            <div class="col-sm-6">
            <div class="form-check">
                <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="sunday" value="sunday">
                <label class="form-check-label" for="sunday">Sunday</label>
            </div>
            <div class="form-check">
                <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="monday" value="monday">
                <label class="form-check-label" for="monday">Monday</label>
            </div>
            <div class="form-check">
                <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="tuesday" value="tuesday">
                <label class="form-check-label" for="tuesday">Tuesday</label>
            </div>
            <div class="form-check">
                <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="wednesday" value="wednesday">
                <label class="form-check-label" for="wednesday">Wednesday</label>
            </div>
            <div class="form-check">
                <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="thursday" value="thursday">
                <label class="form-check-label" for="thursday">Thursday</label>
            </div>
            <div class="form-check">
                <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="friday" value="friday">
                <label class="form-check-label" for="friday">Friday</label>
            </div>
            <div class="form-check">
                <input class="form-check-input day_off" type="checkbox" name="day_off[]" id="saturday" value="saturday">
                <label class="form-check-label" for="saturday">Saturday</label>
            </div>
            </div>
        </div>
        </fieldset>
    </div> <!-- Adjustment wrapper -->
    </div>
</div><!-- #assignment-schedule -->