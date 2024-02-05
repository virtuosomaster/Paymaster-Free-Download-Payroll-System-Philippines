<?php include_once('header.php'); ?>
<?php
  $employees  = new Employee;
  $settings     =  new Settings;
  $designations = $settings->get_settings_by_name('designation');
  $groups       = $settings->get_settings_by_name('group');
  $teams        = $settings->get_settings_by_name('team');
  $schedules    = $settings->get_settings_by_name('schedules');
  $has_filter   = false;
  if( !empty( $designations ) || !empty( $groups ) || !empty( $teams ) ){
    $has_filter = true;
  }
  $_designation  = isset($_GET['ds']) ? (int)$_GET['ds'] : 0 ;
  $_team         = isset($_GET['tm']) ? (int)$_GET['tm'] : 0 ;
  $_group        = isset($_GET['gp']) ? (int)$_GET['gp'] : 0 ;
  $_search       = isset($_GET['s']) ? $_GET['s'] : '' ;

  $all_employees  = $employee->get_all_employees( array( 'id', 'fname', 'lname', 'idd', 'access_level' ) );
  $get_current_user_access_level = $employee->get_user_data( $sessionUserId, array('access_level') );
  $current_user_access_level = $get_current_user_access_level[0]->access_level ?: 0;
  $dayoffs = array( 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday' );
?>
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Employees</li>
  </ol>
  <!-- Icon Cards-->
  <div class="row">
    <div class="col-12 mb-3">
      <div class="row">
        <div class="col-md-12 wptf-section">
          <div class="card mb-3">
            <div class="card-header">
              Employee List
            </div> <!-- card Header -->
            <div class="card-body">
              <div class="container-fluid p-0 mb-4">
                <div class="row">
                  <div class="col-sm-8">
                    <a href="<?php echo $siteHostAdmin; ?>add-user.php">
                      <button type="button" class="btn btn-primary pm-blue btn-lg">Add Employee</button>
                    </a>
                  </div>
                  <div class="col-sm-4"><form><input id="search-employee" type="text" class="form-control" name="s" placeholder="Search" value="<?php echo $_search; ?>" /></form></div>
                  <?php if($has_filter): ?>
                    <div class="col-sm-12 mt-4">
                      <form>
                        <div class="form-row align-items-center">
                          <?php if(!empty($designations)): ?>
                          <div class="col-auto">
                            <label class="sr-only" for="designation">Designation</label>
                            <select id="designation" name="ds" class="form-control">
                              <option value="0">Choose Designation</option>
                              <?php foreach( $designations as $designation ): ?>
                              <option value="<?php echo $designation->id; ?>" <?php echo ( $_designation == $designation->id ) ? 'selected' : '' ; ?> ><?php echo $designation->value; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <?php endif; ?>
                          <?php if(!empty($groups)): ?>
                          <div class="col-auto">
                            <label class="sr-only" for="team">Team</label>
                            <select id="team" name="tm" class="form-control">
                              <option value="0">Choose Team</option>
                              <?php foreach( $teams as $team ): ?>
                              <option value="<?php echo $team->id; ?>" <?php echo ( $_team == $team->id ) ? 'selected' : '' ; ?>><?php echo $team->value; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <?php endif; ?>
                          <?php if(!empty($teams)): ?>
                          <div class="col-auto">
                            <label class="sr-only" for="group">Group</label>
                            <select id="group" name="gp" class="form-control">
                              <option value="0">Choose Group</option>
                              <?php foreach( $groups as $group ): ?>
                              <option value="<?php echo $group->id; ?>" <?php echo ( $_group == $group->id ) ? 'selected' : '' ; ?>><?php echo $group->value; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <?php endif; ?>
                          <div class="col-auto">
                            <button type="submit" class="btn btn-primary pm-blue btn-lg">Filter</button>
                          </div>
                          <div class="col-auto">
                            <button type="button" class="btn btn-primary btn-lg bulk-update-btn pm-blue">Bulk Update</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <table class="table table-bordered filter-table" id="employeeListTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="text-center no-arrow">
                        <input class="check_all" type="checkbox" />
                      </th>
                      <th>ID</th>
                      <th>Last Name</th>
                      <th>First Name</th>
                      <th class="text-center">Avatar</th>
                      <?php if( ACCOUNT_TYPE < 3 ): ?>
                        <!-- <th class="text-center">Resume</th>
                        <th class="text-center">Files</th> -->
                      <?php endif; ?>
                      <th>Biometric ID</th>
                      <th>Designation</th>
                      <th>Group</th>
                      <th>Team</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th class="text-center no-arrow">
                        <input class="check_all" type="checkbox" />
                      </th>
                      <th>ID</th>
                      <th>Last Name</th>
                      <th>First Name</th>
                      <th class="text-center">Avatar</th>
                      <?php if( ACCOUNT_TYPE < 3 ): ?>
                        <!-- <th class="text-center">Resume</th>
                        <th class="text-center">Files</th> -->
                      <?php endif; ?>
                      <th>Biometric ID</th>
                      <th>Designation</th>
                      <th>Group</th>
                      <th>Team</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </tfoot>
                  <tbody class="users-list-tbody">
                    <?php
                    $search_message = 'No record found';
                    if( isset($_GET['s']) && !empty($_GET['s']) ){
                      $all_employees = $employees->search_employee( $_GET['s'] );
                      $search_message = 'No record found for "'.strip_tags( $_GET['s'] ).'"';
                    }elseif( isset($_GET['ds']) || isset($_GET['tm']) || isset($_GET['gp'])){
                      $all_employees = $employees->search_by_assignment( (int)$_GET['ds'], (int)$_GET['gp'], (int)$_GET['tm'] );
                    }else{
                      $all_employees = $employees->get_all_employees();
                    }
                    
                    if( !empty( $all_employees ) ){
                      foreach ($all_employees as $employee ) {
                        $designation  = $settings->get_settings_data( $employee->work_designation, true );
                        $group        = $settings->get_settings_data( $employee->work_group, true );
                        $team         = $settings->get_settings_data( $employee->work_team, true );
                        if( $current_user_access_level == 2 && $employee->access_level == 1 ) { continue; }
                        # hide super admin from admins
                        if($current_user_access_level == 1 && $employee->access_level == 1 && $employee->id == SUPER_ADMIN_ID && $sessionUserId != SUPER_ADMIN_ID){ continue; }
                        ?>
                        <tr id="data-<?php echo $employee->id; ?>">
                          <td class="text-center">
                            <input name="bulk_user_ids" class="bulk_user_ids" type="checkbox" value="<?php echo $employee->id; ?>" />
                          </td>
                          <td><?php echo $employee->id; ?></td>
                          <td><a class="name" href="<?php echo $siteHostAdmin; ?>update-user.php?uid=<?php echo $employee->id; ?>"><span><?php echo $employee->lname; ?></span></a></td>
                          <td><a class="name" href="<?php echo $siteHostAdmin; ?>update-user.php?uid=<?php echo $employee->id; ?>"><span><?php echo $employee->fname; ?></span></a></td>
                          <td class="text-center"><img id="avatar" src="<?php echo pcm_get_avatar( $employee->id ); ?>" class="mx-auto img-fluid img-circle d-block" alt="avatar" width="26"></td>             
                          <?php if( ACCOUNT_TYPE < 3 ): ?>       
                          <!-- <td class="text-center"><a href="#" data-id="<?php // echo $employee->id; ?>" class="download-user-resume btn btn-info btn-sm"><i class="fa fa-fw fa-address-card text-white"></i></a></td> 
                          <td class="text-center"><a href="#" data-id="<?php // echo $employee->id; ?>" data-username="<?php // echo clean_username($employee->username); ?>" class="file-manager btn btn-info btn-sm" data-toggle="modal" data-target="#fileManagerModal"><i class="fa fa-fw fa-folder-open text-white"></i></a></td>     -->
                          <?php endif; ?>                
                          <td><a href="<?php echo $siteHostAdmin; ?>report-timecard.php?uid=<?php echo $employee->idd; ?>"><?php echo $employee->idd; ?></a></td>
                          <td><?php echo $designation; ?></td>
                          <td><?php echo $group; ?></td>
                          <td><?php echo $team; ?></td> 
                          <td style="text-align:center;">
                            <a class="timelog" href="<?php echo $siteHostAdmin; ?>report-timecard.php?uid=<?php echo $employee->idd; ?>"><span class="fa fa-fw fa-clock-o"></span></a>&nbsp;
                            <a class="update" href="<?php echo $siteHostAdmin; ?>update-user.php?uid=<?php echo $employee->id; ?>"><span class="fa fa-fw fa-edit"></span></a>&nbsp;
                            <a class="delete" data-id="<?php echo $employee->id; ?>" data-toggle="modal" data-target="#deleteUserModal"><span style="color:red;" class="fa fa-fw fa-user-times"></span></a>
                          </td>  
                        </tr>  
                        <?php
                      }
                    }else{
                      ?><td colspan="7"><?php echo $search_message; ?></td> <?php
                    }
                    ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div> <!-- Content wrapper -->
      </div> <!-- Row Wrapper -->
    </div>  
  </div>
</div><!-- /.container-fluid-->
<!-- POP UP MOdal for Delete schedule -->
<!-- Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUser" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert-danger">
        <h5 class="modal-title text-white" id="deleteUser">Alert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this user?</p>
        <p>This will remove user information and cannot revert back.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="deleteUserButton" data-id="">Confirm</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal File Manager-->
<div id="fileManagerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fileManagerModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-white" id="fileManagerModalLabel"><i class="fa fa-fw fa-folder-open"></i> File Manager</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <section class="row">
            <div class="col-md-6">
                <form action="<?php echo $siteHostAdmin; ?>includes/common/ajax-handler.php" class="dropzone needsclick dz-clickable" id="filemanagerdropzoneform">
                    <div class="dz-message needsclick">
                        Drop files here or click to upload.<br/>
                        <span style="font-size:12px;">Accepted file type : <?php echo implode(', ', upload_accepted_filetype() ); ?><br/>
                        Max Filesize: 4MB.</span>
                    </div>
                    <input type='hidden' name='action' value='submit_dropzonejs'>
                    <input type='hidden' name='dirname' value=''>
                </form>
            </div>
            <div class="col-md-6">
            <form id="filemanager-form">
              <div class="form-group">
                <label class="sr-only" for="filename">Filename</label>
                <input type="text" class="form-control" id="filename" aria-describedby="emailHelp" placeholder="Filename" required>
              </div>
              <div class="form-group">
                <label class="sr-only" for="description">File Description</label>
                <textarea class="form-control" id="description" rows="3" placeholder="File Description"></textarea>
              </div>
              <input type='hidden' name='file_id' value="">
              <button type="submit" class="btn btn-primary pm-blue">Save File</button>
            </form>
            </div>
        </section>
      </div>
    </div>
  </div>
</div>

<!-- 4.0.3 changes bulk update schedule - start -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none show-bulk-update-modal" data-toggle="modal" data-target="#bulk-update-modal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="bulk-update-modal" tabindex="-1" role="dialog" aria-labelledby="bulk-update-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-white" id="bulk-update-modal-label">Bulk Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="#" id="bulk-update-form">
          <div class="modal-body">
            <div class="row">
              <div id="bulk-schedule-update-wrapper" class="col-md-12 border-bottom mb-3">
                <h5 class="text-primary">Schedules</h5>
                <div class="col-md-12 mb-3">
                  <p class="text-danger">NOTE:</p>
                  <p class="text-danger">- To establish a schedule for one day, it is recommended to maintain consistency between the "Start Date" and "End Date" fields.</p>
                  <p class="text-danger">- Schedules that do not currently exist within a designated time frame will be included.</p>
                  <p class="text-danger">- Schedules that fall within a designated time frame will undergo updates.</p>
                </div>
                <div class="col-md-12 mb-3">
                  <label class="sr-only" for="schedule">Start Date</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Start Date</div>
                    </div>
                    <input type="date" class="form-control" name="date_from" />
                  </div>
                </div>
                <div class="col-md-12 mb-3">
                  <label class="sr-only" for="schedule">End Date</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">End Date</div>
                    </div>
                    <input type="date" class="form-control" name="date_to" />
                  </div>
                </div>
                <div class="col-md-12 mb-3">
                  <label class="sr-only" for="schedule">Schedule</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Schedule</div>
                    </div>
                    <select id="schedule" class="form-control" name="schedule">
                      <option value="">Select Schedule</option>
                      <option value="0">Open Schedule</option>
                      <?php
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
                </div>
              </div>
              <div id="bulk-dayoff-update-wrapper" class="col-md-12 border-bottom mb-3">
                <h5 class="text-primary">Dayoffs</h5>
                <div class="col-md-12 mb-3">
                  <p class="text-danger">Select Dayoff for selected users.</p>
                </div>
                <div class="col-md-12 mb-3">
                  <?php foreach( $dayoffs as $dayoff ): ?>
                    <div class="form-check">
                      <input class="form-check-input" name="user_dayoffs[]" type="checkbox" value="<?php echo $dayoff; ?>" id="<?php echo $dayoff; ?>-dayoff" />
                      <label class="form-check-label" for="<?php echo $dayoff; ?>-dayoff">
                        <?php echo ucfirst( $dayoff ); ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <div id="bulk-team-update-wrapper" class="col-md-12 border-bottom mb-3">
                <h5 class="text-primary">Teams</h5>
                <?php if(!empty($teams)): ?>
                <div class="col-md-12 mb-3">
                  <select id="bulk_teams" name="bulk_teams" class="form-control">
                    <option value="0">Choose Designation</option>
                    <?php foreach( $teams as $team ): ?>
                    <option value="<?php echo $team->id; ?>"><?php echo $team->value; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <?php endif; ?>
              </div>
              <div id="bulk-group-update-wrapper" class="col-md-12 border-bottom mb-3">
                <h5 class="text-primary">Groups</h5>
                <?php if(!empty($groups)): ?>
                <div class="col-md-12 mb-3">
                  <select id="bulk_groups" name="bulk_groups" class="form-control">
                    <option value="0">Choose Group</option>
                    <?php foreach( $groups as $group ): ?>
                    <option value="<?php echo $group->id; ?>"><?php echo $group->value; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <?php endif; ?>
              </div>
              <div id="bulk-designation-update-wrapper" class="col-md-12 border-bottom mb-3">
                <h5 class="text-primary">Designations</h5>
                <?php if(!empty($designations)): ?>
                <div class="col-md-12 mb-3">
                  <select id="bulk_designations" name="bulk_designations" class="form-control">
                    <option value="0">Choose Designation</option>
                    <?php foreach( $designations as $designation ): ?>
                    <option value="<?php echo $designation->id; ?>"><?php echo $designation->value; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>

<?php include_once('footer.php'); ?>