<?php
if (!defined('ABSPATH')) {
	header('Location: ' . $siteHostAdmin . '404.php');
	exit; //Exit if accessed directly
}
$date = pcm_current_date();
$dateFrom = pcm_date_first_day($date);
$dateTo = pcm_date_last_day($date);
$current_month = date('F d, Y', strtotime($date));
$current_date  = date('Y-m-d');
$log_details = array();
$userID = $sessionUserId;
$biometricID = $employee->get_user_data_by_id($userID, 'idd');
$record = new Records($biometricID, $date, $dateTo);
$logs = $record->all_datelogs();
# get User Leave
$leaves = $employee->get_user_leave_daterange($userID, $dateFrom, $dateTo);
# get Ovetime 
$overtime_records = $employee->get_overtime($userID, $dateFrom, $dateTo);

# get clock in/out settings
$is_clock_in_out_enabled = $settings->get_settings_by_name('clock-in-out', true, 'value') ? true : false;
$current_time = date('h:i:s A');

# get user schedule for today's date
$user_sched = $employee->get_requested_schedule($userID, $current_date);
$user_sched = ($user_sched > -1) ? $user_sched : '';

# get all schedules
$schedules = $settings->get_settings_by_name('schedules');

# checktypes
$checktypes = array();
$am_time_in = '';
$pm_time_in = '';

# determine if user schedule is cut or not
$is_standard = false;
if($user_sched != ''){
	if($user_sched == 0){
		$checktypes = array(1 => 'ftimeIn', 4 => 'stimeOut');
	} else {
		if(!empty($schedules)){
			foreach($schedules as $schedule){
				if($schedule->id == $user_sched){
					$value = unserialize($schedule->value);
					if(isset($value['ftimein']) && !empty($value['ftimein'])){
						$checktypes[1] = 'ftimeIn';
						$am_time_in = date('g:i A', strtotime($value['ftimein']));
					}
					if(isset($value['ftimeout']) && !empty($value['ftimeout'])){
						$checktypes[2] = 'ftimeOut';
					}
					if(isset($value['stimein']) && !empty($value['stimein'])){
						$checktypes[3] = 'stimeIn';
						$pm_time_in = date('g:i A', strtotime($value['stimein']));
					}
					if(isset($value['stimeout']) && !empty($value['stimeout'])){
						$checktypes[4] = 'stimeOut';
					}
					if(isset($value['ftimein']) && !empty($value['ftimein']) && 
					isset($value['ftimeout']) && !empty($value['ftimeout']) && 
					isset($value['stimein']) && !empty($value['stimein']) && 
					isset($value['stimeout']) && !empty($value['stimeout'])){
						$is_standard = true;
					}
					break;
				}
			}
		}
	}
}

# get AM or PM
list($time, $am_pm) = explode(' ', $current_time);

# unset checktypes depending on AM/PM
if($am_pm == 'AM'){
	if($is_standard){
		unset($checktypes[3], $checktypes[4]);
	}
} else {
	if($is_standard){
		unset($checktypes[1], $checktypes[2]);
	}
}

$checktypes_vals = array_values($checktypes);

# get current date details
$current_date_records = new Records($biometricID, $current_date, $current_date);
$current_logs = $record->all_datelogs();
$current_date_logs = $current_logs[$current_date];
$btn_label = 'Clock In';
$btn_color = 'success';

# set checktypes
$checktype = false;
$am_pm_in = 'am_in';
if($is_standard){ # this block is for standard schedule ( FTIMEIN, FTIMEOUT, STIMEN, STIMEOUT )
	if($am_pm == 'AM'){
		if(in_array('ftimeIn', $checktypes_vals) && !isset($current_date_logs['ftimeIn']) && !isset($current_date_logs['ftimeOut'])){
			$checktype = 'ftimeIn';
		}
		if(in_array('ftimeOut', $checktypes_vals) && isset($current_date_logs['ftimeIn']) && !isset($current_date_logs['ftimeOut'])){
			$checktype = 'ftimeOut';
			$btn_label = 'Clock Out';
			$btn_color = 'danger';
		}
		if(in_array('ftimeOut', $checktypes_vals) && isset($current_date_logs['ftimeIn']) && isset($current_date_logs['ftimeOut'])){
			$am_pm = 'PM';
			$am_pm_in = 'pm_in';
		}
	} else {
		if(in_array('stimeIn', $checktypes_vals) && !isset($current_date_logs['stimeIn']) && !isset($current_date_logs['stimeOut'])){
			$checktype = 'stimeIn';
		}
		if(in_array('stimeOut', $checktypes_vals) && isset($current_date_logs['stimeIn']) && !isset($current_date_logs['stimeOut'])){
			$checktype = 'stimeOut';
			$btn_label = 'Clock Out';
			$btn_color = 'danger';
		}
		if(in_array('stimeOut', $checktypes_vals) && isset($current_date_logs['stimeIn']) && isset($current_date_logs['stimeOut'])){
			$am_pm = 'AM';
		}
	}
} else { # this block is for uncut schedule ( OPEN SCHEDULE OR FTIMEIN AND STIMEOUT ONLY )
	if($am_pm == 'AM'){
		if(in_array('ftimeIn', $checktypes_vals) && !isset($current_date_logs['ftimeIn']) && !isset($current_date_logs['stimeOut'])){
			$checktype = 'ftimeIn';
		}
		if(in_array('stimeOut', $checktypes_vals) && isset($current_date_logs['ftimeIn']) && !isset($current_date_logs['stimeOut'])){
			$btn_label = 'Clock Out';
			$btn_color = 'danger';
			$am_pm = 'PM';
			$am_time_in = '';
		}
	} else {
		if(in_array('stimeOut', $checktypes_vals) && isset($current_date_logs['ftimeIn']) && !isset($current_date_logs['stimeOut'])){
			$checktype = 'stimeOut';
			$btn_label = 'Clock Out';
			$btn_color = 'danger';
		}
		if(in_array('stimeOut', $checktypes_vals) && isset($current_date_logs['ftimeIn']) && isset($current_date_logs['stimeOut'])){
			$am_pm = 'AM';
		}
	}
}
$btn_label .= ' ('.$am_pm.')';
?>
<?php if($is_clock_in_out_enabled && $user_sched != ''): ?>
	<div class="mb-3 d-flex align-items-center">
		<button type="button" class="btn-<?php echo $btn_color; ?> btn-lg clock-btn" data-pm_time_in="<?php echo $pm_time_in; ?>" data-am_time_in="<?php echo $am_time_in; ?>" data-am_pm_in="<?php echo $am_pm_in; ?>" data-checktype="<?php echo $checktype; ?>" data-user_id="<?php echo $biometricID; ?>"><?php echo $btn_label; ?></button>
		<strong class="m-0 pl-3">Time: <span id="real-time"><?php echo $current_time; ?></span></strong>
	</div>
<?php endif; ?>
<div class="row">
	<div id="user-timecard" class="col-md-12">
		<div class="card mb-3 bg-light">
			<div class="card-header">
				<strong>Time Card Date: <?php echo $current_month; ?></strong>
			</div>
			<div class="card-body">
				<div class="card-body-icon"><i class="fa fa-fw fa-calendar"></i></div>
				<table class="table table-bordered filter-table" id="timecardTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Date</th>
							<th>Schedule</th>
							<th>Log In(AM)</th>
							<th>Log Out(AM)</th>
							<th>Log In(PM)</th>
							<th>Log Out(PM)</th>
							<th>OT In</th>
							<th>OT Out</th>
							<th>OT Hours</th>
							<th>Late Hours</th>
							<th>Work Hours</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (!empty($logs)) {
							$total_late = 0;
							$total_time = 0;
							$total_ot   = 0;
							foreach ($logs as $date_log => $log_value) {

								if ($date_log != $current_date) {
									continue;
								}

								$log_data       = $record->get_work_hours($log_value, $date_log);
								$ot_data        = $record->get_ot_hours($log_value, $date_log);
								$schedule_date  = $record->get_user_schedule_date($biometricID, $date_log);

								$log_late       = unix_to_hour($log_data['late']);
								$log_time_spent = unix_to_hour($log_data['time_consume']);
								$ot_time_spent  = unix_to_hour($ot_data);

								$total_late     = $total_late + $log_data['late'];
								$total_time     = $total_time + $log_data['time_consume'];
								$total_ot       = $total_ot + $ot_data;

								$schedule_name  = "Open Schedule";
								$mark_ftimeIn    = '';
								$mark_ftimeOut   = '';
								$mark_stimeIn    = '';
								$mark_stimeOut   = '';
								if (!empty($schedule_date)) {
									$schedule_name = $schedule_date['name'];
									$sched_ftimeIn    = pcm_time_to_unix($date . ' ' . $schedule_date['ftimein']);
									$sched_ftimeOut   = pcm_time_to_unix($date . ' ' . $schedule_date['ftimeout']);
									$sched_stimeIn    = pcm_time_to_unix($date . ' ' . $schedule_date['stimein']);
									$sched_stimeOut   = pcm_time_to_unix($date . ' ' . $schedule_date['stimeout']);
									// mark time log if late
									if (!empty($log_value['ftimeIn']['time'])) :
										$ftimeIn = $log_value['ftimeIn']['time'];
										if ($sched_ftimeIn < $ftimeIn) {
											$mark_ftimeIn = 'warning';
										}
									endif;
									if (!empty($log_value['ftimeOut']['time'])) :
										$ftimeOut = $log_value['ftimeOut']['time'];
										if ($sched_ftimeOut > $ftimeOut) {
											$mark_ftimeOut = 'warning';
										}
									endif;
									if (!empty($log_value['stimeIn']['time'])) :
										$stimeIn = $log_value['stimeIn']['time'];
										if ($sched_stimeIn < $stimeIn) {
											$mark_stimeIn = 'warning';
										}
									endif;
									if (!empty($log_value['stimeOut']['time'])) :
										$stimeOut = $log_value['stimeOut']['time'];
										if ($sched_stimeOut > $stimeOut) {
											$mark_stimeOut = 'warning';
										}
									endif;
								}

						?>
								<tr>
									<td class="logDate"><?php echo $date_log; ?></td>
									<td><?php echo $schedule_name; ?></td>
									<td id="<?php echo $log_value['ftimeIn']['id']; ?>" class="<?php echo $mark_ftimeIn; ?>">
										<?php if (!empty($log_value['ftimeIn']['time'])) : ?>
											<?php if ($log_value['ftimeIn']['absent'] == '1') : ?>
												<?php echo $log_value['ftimeIn']['comment']; ?>
											<?php else : ?>
												<?php echo pcm_unix_to_time($log_value['ftimeIn']['time']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>
									<td id="<?php echo $log_value['ftimeOut']['id']; ?>" class="<?php echo $mark_ftimeOut; ?>">
										<?php if (!empty($log_value['ftimeOut']['time'])) : ?>
											<?php if ($log_value['ftimeOut']['absent'] == '1') : ?>
												<?php echo $log_value['ftimeOut']['comment']; ?>
											<?php else : ?>
												<?php echo pcm_unix_to_time($log_value['ftimeOut']['time']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>
									<td id="<?php echo $log_value['stimeIn']['id']; ?>" class="<?php echo $mark_stimeIn; ?>">
										<?php if (!empty($log_value['stimeIn']['time'])) : ?>
											<?php if ($log_value['stimeIn']['absent'] == '1') : ?>
												<?php echo $log_value['stimeIn']['comment']; ?>
											<?php else : ?>
												<?php echo pcm_unix_to_time($log_value['stimeIn']['time']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>
									<td id="<?php echo $log_value['stimeOut']['id']; ?>" class="<?php echo $mark_stimeOut; ?>">
										<?php if (!empty($log_value['stimeOut']['time'])) : ?>
											<?php if ($log_value['stimeOut']['absent'] == '1') : ?>
												<?php echo $log_value['stimeOut']['comment']; ?>
											<?php else : ?>
												<?php echo pcm_unix_to_time($log_value['stimeOut']['time']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>
									<td id="<?php echo $log_value['OTin']['id']; ?>">
										<?php if (!empty($log_value['OTin']['time'])) : ?>
											<?php echo pcm_unix_to_time($log_value['OTin']['time']); ?>
										<?php endif; ?>
									</td>
									<td id="<?php echo $log_value['OTout']['id']; ?>">
										<?php if (!empty($log_value['OTout']['time'])) : ?>
											<?php echo pcm_unix_to_time($log_value['OTout']['time']); ?>
										<?php endif; ?>
									</td>
									<td>
										<?php echo $ot_time_spent; ?>
									</td>
									<td class="<?php echo ($log_data['late']) ? 'warning' : ''; ?>">
										<?php echo $log_late; ?>
									</td>
									<td>
										<?php echo $log_time_spent; ?>
									</td>
								</tr>
							<?php
							}
							?>
							<tr style="color: #28a745;">
								<th colspan="8" style="text-align: right;">Accumulated Records</th>
								<th><?php echo unix_to_hour($total_ot); ?></th>
								<th><?php echo unix_to_hour($total_late); ?></th>
								<th><?php echo unix_to_hour($total_time); ?> </th>
							</tr>
						<?php
						} else {
						?><tr>
								<td colspan="11">No record Found</td>
							</tr><?php
									}
										?>
					</tbody>
				</table>
			</div>
		</div>
	</div> <!-- User Leave -->
	<div id="user-leave" class="col-md-6">
		<div class="card mb-3 card text-white bg-primary">
			<div class="card-header pm-blue">
				<strong>Applied Leave</strong> <a href="<?php echo $siteHostAdmin; ?>profile.php#leave-calendar-wrapper" class="btn btn-light">Apply Leave</a>
			</div>
			<div class="card-body pm-blue">
				<div class="card-body-icon"><i class="fa fa-fw fa-plane"></i></div>
				<table class="table table-bordered" id="userLeaveTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Date</th>
							<th>Leave Type</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($leaves) {
							foreach ($leaves as $leave) {
								$status = $leave->status ? 'Approved' : 'Pending Approval';
						?>
								<tr>
									<td><?php echo $leave->date; ?></td>
									<td><?php echo work_status()[$leave->type]; ?></td>
									<td><?php echo $status; ?></td>
								</tr>
							<?php
							}
						} else {
							?><tr>
								<td colspan="3">No Leave applied</td>
							</tr><?php
									}
										?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div id="user-overtime" class="col-md-6">
		<div class="card mb-3 card text-white bg-success">
			<div class="card-header">
				<strong>Applied Overtime</strong> <a href="<?php echo $siteHostAdmin; ?>profile.php#leave-calendar-wrapper" class="btn btn-light">Apply Overtime</a>
			</div>
			<div class="card-body">
				<div class="card-body-icon"><i class="fa fa-fw fa-clock-o"></i></div>
				<table class="table table-bordered" id="userLeaveTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Date</th>
							<th>Time Range</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($overtime_records) {
							foreach ($overtime_records as $ovetime) {
								$status = $ovetime->status ? 'Approved' : 'Pending Approval';
						?>
								<tr>
									<td><?php echo $ovetime->date; ?></td>
									<td><?php echo $ovetime->time_range; ?></td>
									<td><?php echo $status; ?></td>
								</tr>
							<?php
							}
						} else {
							?><tr>
								<td colspan="3">No Overtime applied</td>
							</tr><?php
									}
										?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>