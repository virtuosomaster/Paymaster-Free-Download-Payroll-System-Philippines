<?php 
$contacts      = new PersonalInfo;
$user_id       = $user_data->id;
$contacts_data = $contacts->get_emergency_contact_data($user_id);
?>
<div id="assignment-schedule" class="card mb-3 inner-card"> 
    <div class="card-header inner-card">
        <div class="form-row">
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2 button-right">
                <input type="hidden" value="<?php echo $user_id; ?>"/>
                <button type="button" class="btn btn-primary pm-blue btn-lg d-none" id="updateModalBtn" data-toggle="modal" data-target="#updateContact">Update</button>
                <button type="button" class="btn btn-primary pm-blue btn-lg" data-toggle="modal" data-target="#uploadContact"> <i class="fa fa-address-book" aria-hidden="true"></i> Add New</button>
            </div>
        </div>
    </div>
    <div class="card-body inner-card">
        <!-- Table -->
        <section>
            <table id = "contacts-list" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm dark-blue">Contact Name</th>
                        <th class="th-sm dark-blue">Contact Phone</th>
                        <th class="th-sm dark-blue">Email</th>
                        <th class="th-sm dark-blue">Permanent Address</th>
                        <th class="th-sm dark-blue">Contact Relationship</th>
                        <th class="th-sm dark-blue">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $contacts_data as $key => $value ): ?>
                        <tr>
                            <td><?php echo $value->name; ?></td>
                            <td><?php echo $value->phone; ?></td>
                            <td><?php echo $value->email; ?></td>
                            <td><?php echo $value->address; ?></td>
                            <td><?php echo $value->relationship; ?></td>
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


<!-- Add new contacts modal starts here... -->
<div class="modal fade" id="uploadContact" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class = "inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white">Add New Employee Contact</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="add-contact-form">
                    <div class="form-row">
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cname">Contact Name</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="cname" placeholder="Contact Name" name="cname" value="" required="required">
                                </div>    
                            </div>                    
                        </div>

                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cphone">Contact Phone</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="cphone" placeholder="Contact Phone" name="cphone" value="" required="required">
                                </div> 
                            </div>                       
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="caddress">Email</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="address" class="form-control" id="email" placeholder="Email" name="email" value="" required="required">
                                </div> 
                            </div>                       
                        </div>
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="caddress">Permanent Address</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="address" class="form-control" id="caddress" placeholder="Permanent Address" name="caddress" value="" required="required">
                                </div> 
                            </div>                       
                        </div>

                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="crelationship">Contact Relationship</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="crelationship" placeholder="Contact Relationship" name="crelationship" value="" required="required">
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <input type="hidden" name="uid" value="<?php echo $user_id; ?>"/>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="close_emergency_contact_modal" class="btn btn-primary pm-blue" data-dismiss="modal">Close</button>
                <button type="submit" id="save_emergency_contact_modal" class="btn btn-primary pm-blue">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- update contact modal starts here -->

<div class="modal fade" id="updateContact" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class = "inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white">Update Contact</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="update-contact-form">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="close_uc_modal" class="btn btn-primary pm-blue" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary pm-blue">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        $('#contacts-list').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
</script>