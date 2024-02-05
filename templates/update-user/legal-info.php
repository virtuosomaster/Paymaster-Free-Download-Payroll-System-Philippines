<?php
$documents                 = new PersonalInfo;
$user_id                   = $user_data->id;
$documents_data            = $documents->get_documents_data($user_id);
$additional_documents_data = $documents->get_additional_documents_data($user_id);
$document_types            = array('SSS', 'PhilHealth', 'HDMF', 'BIR TIN', 'NBI Clearance');
$relative_dir              = 'templates/update-user/uploads/';
$additional_docs_relative_dir = 'templates/update-user/additional-docs/';
?>
<style>
    #custom-dropzone,
    #custom-dropzone-2,
    #custom-dropzone-3,
    #custom-dropzone-4 {
        transition: all 0.3s ease;
    }
    #custom-dropzone.active,
    #custom-dropzone-2.active,
    #custom-dropzone-3.active,
    #custom-dropzone-4.active {
        transform: scale(1.2);
    }
</style>
<div id="assignment-schedule" class="card mb-3 inner-card">
    <div class="card-header inner-card">
        <div class="form-row">
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2 button-right">
                <input type="hidden" value="<?php echo $user_id; ?>" />
                <button type="button" class="btn btn-primary pm-blue btn-lg d-none" id="documentUpdateModalBtn" data-toggle="modal" data-target="#documentUpdateModal">Update Document</button>
                <button type="button" class="btn btn-primary pm-blue btn-lg" data-toggle="modal" data-target="#documentUploadModal"><i class="fa fa-file" aria-hidden="true"></i> Add New</button>
            </div>
        </div>
    </div>
    <div class="card-body inner-card">
        <!-- Table -->
        <section>
            <table id="legal-info" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm dark-blue">Document Type</th>
                        <th class="th-sm dark-blue">Date of Issue</th>
                        <th class="th-sm dark-blue">Expiration Date</th>
                        <th class="th-sm dark-blue">File</th>
                        <th class="th-sm dark-blue">Remarks</th>
                        <th class="th-sm dark-blue">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($documents_data as $key => $value) : ?>
                        <tr>
                            <td><?php echo $value->document_type; ?></td>
                            <td><?php echo $value->date_of_issue == '' ? 'N/A' : $value->date_of_issue; ?></td>
                            <td><?php echo $value->expiration_date == '' ? 'N/A' : $value->expiration_date; ?></td>
                            <td>
                                <?php $filenames = unserialize( $value->file_name ); ?>
                                <?php foreach( $filenames as $filename ): ?>
                                    <a href="<?php echo $relative_dir.$filename; ?>" target="_blank"><i class="fa-regular fa-folder-open"></i></a>
                                    <a href="<?php echo $relative_dir.$filename; ?>" download><i class="fa-solid fa-download"></i></a></br>
                                <?php endforeach; ?>
                            </td>
                            <td><?php echo !empty($value->remark) ? $value->remark : ''; ?></td>
                            <td class="text-center">
                                <i class="fa-solid fa-pen-to-square" data-id="<?php echo $value->id; ?>"></i></a>
                                <i class="fa-solid fa-trash" data-id="<?php echo $value->id; ?>"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </section>
    </div>

    <!-- Add new documents modal starts here... -->
    <div class="modal fade" id="documentUploadModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="inner-header">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                        <h5 class="modal-title text-white"> Add New Document</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>

                <div class="modal-body">
                    <form id="document_uploadModal" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-12 modal-inner-row">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="document_type">Document Type </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <select name="document_type" id="document_type" class="custom-select-2">
                                            <option value="">Select Document Type</option>
                                            <?php foreach ( $document_types as $document ): ?>
                                                <option value="<?php echo $document ?>"><?php echo $document; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12 modal-inner-row">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="date_of_issue">Date of Issue</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="date" class="form-control" id="date_of_issue" placeholder="Contact Phone" name="date_of_issue" value="<?php //echo $user_data->issue_date_doc_1; 
                                                                                                                                                            ?>" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12 modal-inner-row">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="expiration_date">Expiration Date</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="date" class="form-control" id="expiration_date" placeholder="Expiration Date" name="expiration_date" value="<?php //echo $user_data->exp_date_1; 
                                                                                                                                                                    ?>" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12 modal-inner-row">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="remark">Remarks</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" id="remark" placeholder="Remarks" name="remark" value="<?php echo $user_data->doc_remarks_1; ?>" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 file_upload">
                                <label for="inputTagdoc" id="custom-dropzone" class="d-block p-5">
                                    <p id="fileNameHolder">Drop or browse files.<p> <br />
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    <br />
                                    <span id="imageNamedoc"></span>
                                    <span style="font-size:11px;">Accepted file type: <?php echo implode(', ', upload_accepted_document_filetype()); ?><br />
                                        Max. Filesize: 4MB</span>
                                </label>
                                <input id="inputTagdoc" type="file" name="document_file[]" accept="image/*, application/pdf"  multiple />
                            </div>
                        </div>
                        <input type="hidden" name="uid" value="<?php echo $user_id; ?>" />
                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" id="close_document_modal" class="btn btn-primary pm-blue" data-dismiss="modal">Close</button>
                    <button type="submit" id="save_document_modal" class="btn btn-primary pm-blue">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update documents modal starts here... -->
    <div class="modal fade" id="documentUpdateModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="inner-header">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                        <h5 class="modal-title text-white"> Update Document</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>

                <div class="modal-body">
                    <form id="documentUpdateForm" enctype="multipart/form-data">
                        
                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" id="close_update_document_modal" class="btn btn-primary pm-blue" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pm-blue">Save</button>
                </div>
            </div>
        </div>
    </div>

    <hr />


    <!-- Additional Legal Document -->
    <div class="card-header inner-card">
        <div class="form-row">
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-1"></div>
            <div class="form-group col-md-3 button-right">
                <input type="hidden" value="<?php echo $user_id; ?>" />
                <button type="button" class="btn btn-primary pm-blue btn-lg d-none" id="additionalDocumentUpdateModalBtn" data-toggle="modal" data-target="#additionalDocumentUpdateModal">Update Additional Document</button>
                <button type="button" class="btn btn-primary pm-blue btn-lg" data-toggle="modal" data-target="#additional-document"><i class="fa fa-file" aria-hidden="true"></i> Add New</button>
            </div>
        </div>
    </div>
    <div class="card-body inner-card">
        <!-- Table -->
        <section>
            <table id="legal-info-add" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm dark-blue">Other Document Type</th>
                        <th class="th-sm dark-blue">Date of Issue</th>
                        <th class="th-sm dark-blue">Expiration Date</th>
                        <th class="th-sm dark-blue">File</th>
                        <th class="th-sm dark-blue">Remarks</th>
                        <th class="th-sm dark-blue">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($additional_documents_data as $key => $value) : ?>
                        <tr>
                            <td><?php echo $value->document_type; ?></td>
                            <td><?php echo $value->date_of_issue == '' ? 'N/A' : $value->date_of_issue; ?></td>
                            <td><?php echo  $value->expiration_date == '' ? 'N/A' : $value->expiration_date; ?></td>
                            <td class="text-center">
                                <?php $filenames = unserialize( $value->file_name ); ?>
                                <?php foreach( $filenames as $filename ): ?>
                                    <a href="<?php echo $additional_docs_relative_dir.$filename; ?>" target="_blank"><i class="fa-regular fa-folder-open"></i></a>
                                    <a href="<?php echo $additional_docs_relative_dir.$filename; ?>" download><i class="fa-solid fa-download"></i></a></br>
                                <?php endforeach; ?>
                            </td>
                            <td><?php echo !empty($value->remark) ? $value->remark : ''; ?></td>
                            <td class="text-center">
                                <i class="fa-solid fa-pen-to-square" data-id="<?php echo $value->id; ?>"></i></a>
                                <i class="fa-solid fa-trash" data-id="<?php echo $value->id; ?>"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </section>
    </div>

    <!-- Add new documents modal starts here... -->
    <div class="modal fade" id="additional-document" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="inner-header">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                        <h5 class="modal-title text-white"> Add New Other Document</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>

                <div class="modal-body">
                    <form id="add-additional-doc">
                        <div class="form-row">
                            <div class="form-group col-md-12 modal-inner-row">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="document_type1">Other Document Type </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" id="document_type1" placeholder="Document Type" name="document_type1" value="<?php //echo $user_data->other_doc_type; 
                                                                                                                                                                ?>" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12 modal-inner-row">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="date_of_issue1">Date of Issue</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="date" class="form-control" id="date_of_issue1" placeholder="Contact Phone" name="date_of_issue1" value="<?php //echo $user_data->issue_date_doc; 
                                                                                                                                                                ?>" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12 modal-inner-row">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="expiration_date1">Expiration Date</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="date" class="form-control" id="expiration_date1" placeholder="Expiration Date" name="expiration_date1" value="<?php //echo $user_data->exp_date; 
                                                                                                                                                                    ?>" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12 modal-inner-row">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="remark1">Remarks</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" id="remark1" placeholder="Remarks" name="remark1" value="<?php //echo $user_data->doc_remarks; 
                                                                                                                                            ?>" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 file_upload">
                                <label for="inputTag" id="custom-dropzone-3" class="d-block p-5">
                                     <p id="addFileNameHolder">Drop or browse files.</p> <br />
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    <input id="inputTag" type="file" name="document_file1[]" accept="image/*, application/pdf" multiple />
                                    <br />
                                    <span id="imageName"></span>
                                    <span style="font-size:11px;">Accepted file type: <?php echo implode(', ', upload_accepted_document_filetype()); ?><br />
                                        Max. Filesize: 4MB</span>
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="uid1" value="<?php echo $user_id; ?>" />
                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" id="close_additional_doc_modal" class="btn btn-primary pm-blue" data-dismiss="modal">Close</button>
                    <button type="submit" id="save_additional_doc_modal" class="btn btn-primary pm-blue">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update additional documents modal starts here... -->
    <div class="modal fade" id="additionalDocumentUpdateModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="inner-header">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                        <h5 class="modal-title text-white"> Update Additional Document</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>

                <div class="modal-body">
                    <form id="additionalDocumentUpdateForm" enctype="multipart/form-data">
                        
                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" id="close_update_additional_document_modal" class="btn btn-primary pm-blue" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pm-blue">Save</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#legal-info').DataTable();
        $('#legal-info-add').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>