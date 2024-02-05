jQuery(document).ready(function($) {

  let insertSuccessMsg = 'Data added successfully!';
  let updateSuccessMsg = 'Data updated successfully!';
  let deleteSuccessMsg = 'Data deleted successfully!';

  // preview image before uploading
  $('#personal_info_1 #image').on('change', function() {
    let currElem = $(this);
    let file = currElem.get(0).files[0];
    if (file){
      let reader = new FileReader();
      reader.onload = function(event){
        $('#personal_info_1 #emp_profile_pic').attr('src', event.target.result);
      }
      reader.readAsDataURL(file);
    }
  });

  // helper functions

  function successResponse(currElem = null, successMsg = null) {
    if (currElem !== undefined && currElem !== '') {
      currElem.closest('tr').remove();
    }
    $('body .lds-ellipsis').remove();
    $('body').prepend('<div class="notification-message alert alert-success"><h5>'+successMsg+'</h5></div>');
    setTimeout(function(){
      $('body .notification-message').remove();
    }, 2000);
  }

  function errorResponse(errorMsg) {
    $('body .lds-ellipsis').remove();
    $('body').prepend('<div class="notification-message alert alert-danger"><h5>'+errorMsg+'</h5></div>');
    setTimeout(function(){
      $('body .notification-message').remove();
    }, 2000);
  }

  function insertSuccessResponse(closeModalBtn, form, successMsg) {
    closeModalBtn.trigger('click');
    $('body .lds-ellipsis').remove();
    form.trigger('reset');
    $('body').prepend('<div class="notification-message alert alert-success"><h5>'+successMsg+'</h5></div>');
		setTimeout(function(){
			$('body .notification-message').remove();
			console.log(form);
      window.location.reload();
		}, 1000);
  }

  function insertErrorResponse(closeModalBtn, response) {
    closeModalBtn.trigger('click');
    $('body .lds-ellipsis').remove();
    $('body').prepend('<div class="notification-message alert alert-danger"><h5>'+response+'</h5></div>');
		setTimeout(function(){
			$('body .notification-message').remove();
      window.location.reload();
		}, 1000);
  }

  // ajax insert function

  function customInsert(action, formData) {
    let callback = $.ajax({
      type: 'post',
      url: './includes/common/ajax-handler.php',
      data: {
        action: action,
        formData: formData,
      },
      beforeSend: function() {
        $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
      },
    });
    return callback;
  }

  function customInsertWithFile(formData) {
    let callback = $.ajax({
      type: 'post',
      url: './includes/common/ajax-handler.php',
      cache: false, 
      contentType: false, 
      processData: false, 
      data: formData,
      beforeSend: function() {
        $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
      },
    });
    return callback;
  }

  // ajax delete function

  function customDelete(id, action) {
    let callback = $.ajax({
      type: 'post',
      url: './includes/common/ajax-handler.php',
      data: {
        action: action,
        doc_id: id,
      },
      beforeSend: function() {
        $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
      },
    });
    return callback;
  }

  // ajax update function

  function customUpdate(formData) {
    let callback = $.ajax({
      type: 'post',
      url: './includes/common/ajax-handler.php',
      cache: false, 
      contentType: false, 
      processData: false, 
      data: formData,
      beforeSend: function() {
        $('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
      },
    });
    return callback;
  }

  /* custom stringifier function */
  
  const stringifiedFileNames = (object) => {
    let _result = '';
    Array.from(object).forEach(obj => {
      _result += obj['name'] + ', ';
    });
    return _result.slice(0, -2);
  }

  /* ------------------------------------------- add legal document --------------------------------------- */

  // trigger add new document form submit if button is clicked

  $('#save_document_modal').click(function() {
    $('#document_uploadModal').trigger('submit');
  });

  // prevent add document form submit

  $('#document_uploadModal').submit(function(e) {
    e.preventDefault();
    let form            = $(this);
    let formData        = new FormData();
    let files           = form.find('input[type=file]').get(0).files;
    let formContent     = form.serialize();
    let action          = 'add_document';

    Array.from(files).forEach(file => { formData.append('file[]', file); });
    formData.append('action', action);
    formData.append('formContent', formContent);

    customInsertWithFile(formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse($('#close_document_modal'), form, insertSuccessMsg);
      } else {
        insertErrorResponse($('#close_document_modal'), data);
      }
    });
    
  });

  /* ------------------------------------------- add additional legal document --------------------------------------- */

  // trigger add new additional document form submit if button is clicked

  $('#save_additional_doc_modal').click(function() {
    $('#add-additional-doc').trigger('submit');
  });

  // prevent add additional document form submit

  $('#add-additional-doc').submit(function(e) {
    e.preventDefault();
    let form            = $(this);
    let formData        = new FormData();
    let files           = form.find('input[type=file]').get(0).files;
    let formContent     = form.serialize();
    let action          = 'add_additional_document';

    Array.from(files).forEach(file => {formData.append('file[]', file);});
    formData.append('action', action);
    formData.append('formContent', formContent);

    customInsertWithFile(formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse($('#close_additional_doc_modal'), form, insertSuccessMsg);
      } else {
        insertErrorResponse($('#close_additional_doc_modal'), data);
      }
    });
  });

  /* ------------------------------------------- add emergency contact --------------------------------------- */

  // trigger add new emergency contact form submit if button is clicked

  $('#save_emergency_contact_modal').click(function() {
    $('#add-contact-form').trigger('submit');
  });

  // prevent add emergency contact form submit

  $('#add-contact-form').submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let action = 'add_emergency_contact';
    let formData = form.serialize();
    let closeModalBtn = $('#close_emergency_contact_modal');
    customInsert(action, formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse(closeModalBtn, form, insertSuccessMsg);
      } else {
        insertErrorResponse(closeModalBtn, data);
      }
    });
  });

  /* ------------------------------------------- add education --------------------------------------- */

  // trigger add new education form submit if button is clicked

  $('#add_education').click(function() {
    $('#educationAddForm').trigger('submit');
  });

  // prevent add education form submit

  $('#educationAddForm').submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let action = 'add_education';
    let formData = form.serialize();
    let closeModalBtn = $('#close_education_modal');
    customInsert(action, formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse(closeModalBtn, form, insertSuccessMsg);
      } else {
        insertErrorResponse(closeModalBtn, data);
      }
    });
  });

  /* ------------------------------------------- add technical skill --------------------------------------- */

  // trigger add new technical skill form submit if button is clicked

  $('#add_ts').click(function() {
    $('#technicalSkillAddForm').trigger('submit');
  });

  // prevent add texchnical skill form submit

  $('#technicalSkillAddForm').submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let action = 'add_technical_skill';
    let formData = form.serialize();
    let closeModalBtn = $('#close_ts_modal');
    customInsert(action, formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse(closeModalBtn, form, insertSuccessMsg);
      } else {
        insertErrorResponse(closeModalBtn, data);
      }
    });
  });

  /* ------------------------------------------- add other skill --------------------------------------- */

  // trigger add new other skill form submit if button is clicked

  $('#add_os').click(function() {
    $('#otherSkillAddForm').trigger('submit');
  });

  // prevent add other skill form submit

  $('#otherSkillAddForm').submit(function(e) {
    let form = $(this);
    e.preventDefault();
    let action = 'add_other_skill';
    let formData = form.serialize();
    let closeModalBtn = $('#os_close_modal');
    customInsert(action, formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse(closeModalBtn, form, insertSuccessMsg);
      } else {
        insertErrorResponse(closeModalBtn, data);
      }
    });
  });

  /* ------------------------------------------- add training --------------------------------------- */

  // trigger add new training form submit if button is clicked

  $('#add_training').click(function() {
    $('#trainingAddForm').trigger('submit');
  });

  // prevent add training form submit

  $('#trainingAddForm').submit(function(e) {
    let form = $(this);
    e.preventDefault();
    let action = 'add_training';
    let formData = form.serialize();
    let closeModalBtn = $('#close_training_modal');
    customInsert(action, formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse(closeModalBtn, form, insertSuccessMsg);
      } else {
        insertErrorResponse(closeModalBtn, data);
      }
    });
  });

  /* ------------------------------------------- add employee history --------------------------------------- */

  // trigger add new employee history form submit if button is clicked

  $('#save_emp_his_data').click(function() {
    $('#employeeHistoryAddForm').trigger('submit');
  });

  // prevent add employee history form submit

  $('#employeeHistoryAddForm').submit(function(e) {
    let form = $(this);
    e.preventDefault();
    let action = 'add_emp_history';
    let formData = form.serialize();
    let closeModalBtn = $('#close_emp_his_modal');
    customInsert(action, formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse(closeModalBtn, form, insertSuccessMsg);
      } else {
        insertErrorResponse(closeModalBtn, data);
      }
    });
  });

  /* ------------------------------------------- add family relationship --------------------------------------- */

  // trigger add new family relationship form submit if button is clicked

  $('#save_famrel_data').click(function() {
    $('#familyRelAddForm').trigger('submit');
  });

  // prevent add family relationship form submit

  $('#familyRelAddForm').submit(function(e) {
    let form = $(this);
    e.preventDefault();
    let action = 'add_famrel';
    let formData = form.serialize();
    let closeModalBtn = $('#close_famrel_modal');
    customInsert(action, formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse(closeModalBtn, form, insertSuccessMsg);
      } else {
        insertErrorResponse(closeModalBtn, data);
      }
    });
  });

  /* ------------------------------------------- add dependant --------------------------------------- */

  // trigger add new dependant form submit if button is clicked

  $('#save_dependant_data').click(function() {
    $('#dependentAddForm').trigger('submit');
  });

  // prevent add dependant form submit

  $('#dependentAddForm').submit(function(e) {
    let form = $(this);
    e.preventDefault();
    let action = 'add_dependant';
    let formData = form.serialize();
    let closeModalBtn = $('#close_dependant_modal');
    customInsert(action, formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse(closeModalBtn, form, insertSuccessMsg);
      } else {
        insertErrorResponse(closeModalBtn, data);
      }
    });
  });

  /* ------------------------------------------- add contract --------------------------------------- */

  $('#emp_contract_form').submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let action = 'add_emp_contract';
    let formData = form.serialize();
    customInsert(action, formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse(form, form, insertSuccessMsg);
      } else {
        insertErrorResponse(form, data);
      }
    });
  });

  // trigger add new contract form submit if button is clicked

  $('#save_add_empcon_modal').click(function() {
    $('#empContractAddForm').trigger('submit');
  });

  // prevent add contract form submit

  $('#empContractAddForm').submit(function(e) {
    let form = $(this);
    e.preventDefault();
    let action = 'add_contract';
    let formData = form.serialize();
    let closeModalBtn = $('#close_add_empcon_modal');
    customInsert(action, formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse(closeModalBtn, form, insertSuccessMsg);
      } else {
        insertErrorResponse(closeModalBtn, data);
      }
    });
  });

  /* ------------------------------------------- add resignation --------------------------------------- */

  // trigger add new resignation form submit if button is clicked

  $('#add_resignation').click(function() {
    $('#empResignAddForm').trigger('submit');
  });

  // prevent add resignation form submit

  $('#empResignAddForm').submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let action = 'add_resignation';
    let formData = form.serialize();
    let closeModalBtn = $('#close_add_resignation_modal');
    customInsert(action, formData).done(function(data) {
      if (data === 'success') {
        insertSuccessResponse(closeModalBtn, form, insertSuccessMsg);
      } else {
        insertErrorResponse(closeModalBtn, data);
      }
    });
  });

  // =============================================== DELETE ====================================================

  // delete legal documents code
  
  $('#legal-info tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_legal_document';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  // delete additional documents

  $('#legal-info-add tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_add_document';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  // delete emergency contact

  $('#contacts-list tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_emergency_cont';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  // delete education

  $('#ed-info tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_education';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  // delete technical skill

  $('#technical tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_tech_skill';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  // delete other skill

  $('#other-skills tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_other_skill';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  // delete training

  $('#training tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_training';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  // delete employee history

  $('#employee-history-table tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_emp_his';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  // delete family relationship

  $('#family-rel-table tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_famrel';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  // delete pit dependant

  $('#pit-dependant-table tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_dependant';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  // delete contracts

  $('#employee-contract-table tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_contracts';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  $('#contract-history-container').on('click', '.delete-contract', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'delete_employee_contract';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
          window.location.reload();
        } else {
          errorResponse(data);
          window.location.reload();
        }
      });
    }
  });

  // delete contract history

  $('#contract-history-table tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_contract_history';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  // delete resignation

  $('#resignation-table tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_resignation';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });

  // delete resignation history

  $('#resignation-history-table tbody').on('click', '.fa-trash', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    const action = 'del_resignation_history';
    if (confirm('Are you sure you want to delete this?') == true) {
      customDelete(id, action).done(function(data,responseText,jqXHR) {
        if ( data === 'success' ) {
          successResponse(currElem, deleteSuccessMsg);
        } else {
          errorResponse(data);
        }
      });
    }
  });
  
  // =============================================== UPDATE ===================================================== 

  // update personal info 1

  $('#personal_info_1').on('submit', function(e) {
    e.preventDefault();
    let form = $(this);
    let formData = new FormData();
    let formContent = form.serialize();
    let action = 'update_personal_info1';
    formData.append('action', action);
    formData.append('formContent', formContent);
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        successResponse('', updateSuccessMsg);
      } else {
        errorResponse(data);
      }
    });
  });

  // update personal info 2

  $('#personal_info_2').on('submit', function(e) {
    e.preventDefault();
    let form = $(this);
    let formData = new FormData();
    let action = 'update_personal_info2';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        successResponse('', updateSuccessMsg);
      } else {
        errorResponse(data);
      }
    });
  });

  // update legal info 1  

  $('#legal-info tbody').on('click', '.fa-pen-to-square', function() {
    const currElem = $(this);
    let id = currElem.data('id');
    let formData = new FormData();
    let html = '';
    let modalForm = $('#documentUpdateForm');
    let documentTypes = ['SSS', 'PhilHealth', 'HDMF', 'BIR TIN', 'NBI Clearance'];
    formData.append('action', 'fetch_legal_info_row_data');
    formData.append('id', id);
    // fetch row data via ajax
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      let jsonParsed = JSON.parse(data)[0];
      const {id, document_type, date_of_issue, expiration_date, remark} = jsonParsed;
      html = `<div class="form-row">
                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="udocument_type">Document Type </label>
                        </div>
                        <div class="form-group col-md-8">
                          <select class = "custom-select-2" name="udocument_type" id = "udocument_type">
                            <option value="">Select Document Type</option>`;
                            documentTypes.forEach(document => {
                              let selected = document === document_type ? 'selected' : '';
                              html += `<option value="${document}" ${selected}>${document}</option>`;
                            });
               html += `</select>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="udate_of_issue">Date of Issue</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="date" class="form-control" id="udate_of_issue" placeholder="Contact Phone" name="udate_of_issue" value="${date_of_issue ? date_of_issue : ''}" required />
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="uexpiration_date">Expiration Date</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="date" class="form-control" id="uexpiration_date" placeholder="Expiration Date" name="uexpiration_date" value="${expiration_date ? expiration_date : ''}" />
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="uremark">Remarks</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="uremark" placeholder="Remarks" name="uremark" value="${remark ? remark : ''}" />
                        </div>
                    </div>
                </div>

                <div class="col-md-12 file_upload">
                  <label for="uinputTagdoc" id="custom-dropzone-2" class="d-block p-5">
                      <p id="ufileNameHolder">Drop or browse files.<p> <br />
                      <i class="fa fa-upload" aria-hidden="true"></i>
                      <br />
                      <span id="imageNamedoc"></span>
                      <span style="font-size:11px;">Accepted file type: .jpeg, pdf, .jpg, .png<br />
                          Max. Filesize: 4MB</span>
                  </label>
                  <input id="uinputTagdoc" type="file" class="d-none" name="document_file[]" accept="image/*, application/pdf" multiple />
                </div>
            </div>
            <input type="hidden" name="udid" value="${id}" />`;
        if (html !== '') {
          modalForm.html(html);
          setTimeout(() => {
            $('.custom-select-2').select2();
            $('body .lds-ellipsis').remove();
            $('#documentUpdateModalBtn').trigger('click');
          }, 500);
        }
    });
  });
  $('#documentUpdateModal').on('click', 'button[type=submit]', function() {
    $('#documentUpdateForm').trigger('submit');
  });
  $('#documentUpdateForm').on('submit', function(e){
    e.preventDefault();
    const form        = $(this);
    let formData      = new FormData();
    const files       = form.find('input[type=file]').get(0).files;
    const formContent = form.serialize();
    const action      = 'update_legal_info';
    Array.from(files).forEach(file => { formData.append('file[]', file); });
    formData.append('action', action);
    formData.append('formData', formContent);
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        $('#close_update_document_modal').trigger('click');
        successResponse('', updateSuccessMsg);
        window.location.reload();
      } else {
        errorResponse(data);
        window.location.reload();
      }
    });
  }); 

  // update legal info 2

  $('#legal-info-add tbody').on('click', '.fa-pen-to-square', function() {
    const currElem = $(this);
    let id = currElem.data('id');
    let formData = new FormData();
    let html = '';
    let modalForm = $('#additionalDocumentUpdateForm');
    formData.append('action', 'fetch_additional_legal_info_row_data');
    formData.append('id', id);
    // fetch row data via ajax
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      let jsonParsed = JSON.parse(data)[0];
      const {id, document_type, date_of_issue, expiration_date, remark} = jsonParsed;
      html = `<div class="form-row">
                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="adocument_type">Document Type </label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="adocument_type" placeholder="Document Type" name="adocument_type" value="${document_type}" required />
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="adate_of_issue">Date of Issue</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="date" class="form-control" id="adate_of_issue" placeholder="Contact Phone" name="adate_of_issue" value="${date_of_issue ? date_of_issue : ''}" required />
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="aexpiration_date">Expiration Date</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="date" class="form-control" id="aexpiration_date" placeholder="Expiration Date" name="aexpiration_date" value="${expiration_date ? expiration_date : ''}" required />
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="aremark">Remarks</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="aremark" placeholder="Remarks" name="aremark" value="${remark ? remark : ''}" />
                        </div>
                    </div>
                </div>

                <div class="col-md-12 file_upload">
                  <label for="ainputTagdoc" id="custom-dropzone-4" class="d-block p-5">
                      <p id="uAddFileNameHolder">Drop or browse files.</p> <br />
                      <i class="fa fa-upload" aria-hidden="true"></i>
                      <br />
                      <span id="imageNamedoc"></span>
                      <span style="font-size:11px;">Accepted file type: .jpeg, pdf, .jpg, .png<br />
                          Max. Filesize: 4MB</span>
                  </label>
                  <input id="ainputTagdoc" class="d-none" name="document_file" type="file" accept="image/*, application/pdf" multiple />
                </div>
            </div>
            <input type="hidden" name="adid" value="${id}" />`;
        if (html !== '') {
          modalForm.html(html);
          setTimeout(() => {
            $('.custom-select-2').select2();
            $('body .lds-ellipsis').remove();
            $('#additionalDocumentUpdateModalBtn').trigger('click');
          }, 500);
        }
    });
  });
  $('#additionalDocumentUpdateModal').on('click', 'button[type=submit]', function() {
    $('#additionalDocumentUpdateForm').trigger('submit');
  });
  $('#additionalDocumentUpdateForm').on('submit', function(e){
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    const files = form.find('input[type=file]').get(0).files;
    const formContent = form.serialize();
    const action = 'update_additional_legal_info';
    Array.from(files).forEach(file => {formData.append('file[]', file);});
    formData.append('action', action);
    formData.append('formData', formContent);
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        $('#close_update_additional_document_modal').trigger('click');
        successResponse('', updateSuccessMsg);
        window.location.reload();
      } else {
        errorResponse(data);
        window.location.reload();
      }
    });
  }); 

  // update emergency contact 

  $('#contacts-list tbody').on('click', '.fa-pen-to-square', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    let formData = new FormData();
    let html = '';
    let modalForm = $('#update-contact-form');
    formData.append('action', 'fetch_row_data');
    formData.append('id', id);
    // fetch row data via ajax
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      let jsonParsed = JSON.parse(data)[0];
      const {id, name, phone, email, address, relationship} = jsonParsed;
      html = `<div class="form-row">
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="ucname">Contact Name</label>
                          </div>
                          <div class="form-group col-md-8">
                              <input type="text" class="form-control" id="ucname" placeholder="Contact Name" name="ucname" value="${name}" required />
                          </div>    
                      </div>                    
                  </div>

                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="ucphone">Contact Phone</label>
                          </div>
                          <div class="form-group col-md-8">
                              <input type="text" class="form-control" id="ucphone" placeholder="Contact Phone" name="ucphone" value="${phone}" required />
                          </div> 
                      </div>                       
                  </div>
                                    <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="ucaddress">Email</label>
                          </div>
                          <div class="form-group col-md-8">
                              <input type="text" class="form-control" id="ucemail" placeholder="Email" name="email" value="${email}" required />
                          </div> 
                      </div>                       
                  </div>

                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="ucaddress">Permanent Address</label>
                          </div>
                          <div class="form-group col-md-8">
                              <input type="text" class="form-control" id="ucaddress" placeholder="Address" name="ucaddress" value="${address}" required />
                          </div> 
                      </div>                       
                  </div>

                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="ucrelationship">Contact Relationship</label>
                          </div>
                          <div class="form-group col-md-8">
                              <input type="text" class="form-control" id="ucrelationship" placeholder="Contact Relationship" name="ucrelationship" value="${relationship ? relationship : ''}" required />
                          </div>
                      </div>                      
                  </div>
              </div>
              <input type="hidden" name="ucid" value="${id}" />`;
        if (html !== '') {
          modalForm.html(html);
          setTimeout(() => {
            $('.custom-select-2').select2();
            $('body .lds-ellipsis').remove();
            $('#updateModalBtn').trigger('click');
          }, 500);
        }
    });
  });
  $('#updateContact').on('click', 'button[type=submit]', function() {
    $('#update-contact-form').trigger('submit');
  });
  $('#update-contact-form').on('submit', function(e){
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    const action = 'update_emergency_cont';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        $('#close_uc_modal').trigger('click');
        successResponse('', updateSuccessMsg);
        window.location.reload();
      } else {
        errorResponse(data);
        window.location.reload();
      }
    });
  }); 

  // update education

  $('#ed-info tbody').on('click', '.fa-pen-to-square', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    let formData = new FormData();
    let html = '';
    let degrees = ["Undergraduate", "Associate's", "Bachelor's", "Master's", "Doctorate", "Non-Degree Courses", "Certificate/Diploma", "Graduate Certificates", "Bootcamps"];
    let modalForm = $('#educationUpdateForm');
    const course_list1 = ["Agriculture, General", "Agribusiness Operations", "Agricultural Business & Management", "Agricultural Economics", "Agricultural Mechanization", "Agricultural Production", "Agronomy & Crop Science", "Animal Sciences", "Food Sciences & Technology", "Horticulture Operations & Management", "Horticulture Science", "Natural Resources Conservation, General", "Environmental Science", "Forestry", "Natural Resources Management", "Wildlife & Wildlands Management", "Architecture, General", "Architectural Environmental Design", "City/Urban/Regional Planning", "Interior Architecture", "Landscape Architecture", "Area Studies, General (e.g., African, Middle Eastern)", "Asian Area Studies", "European Area Studies", "Latin American Area Studies", "North American Area Studies","Ethnic & Minority Studies, General", "African American Studies", "American Indian/Native American Studies", "Latino/Chicano Studies", "Women's Studies", "Liberal Arts & General Studies", "Library Science", "Multi/Interdisciplinary Studies", "Art, General", "Art History, Criticism & Conservation", "Fine/Studio Arts", "Cinema/Film", "Cinematography/Film/Vide Production", "Dance", "Design & Visual Communications, General", "Fashion/Apparel Design", "Graphic Design", "Industrial Design", "Interior Design", "Music, General", "Music, Performance", "Music, Theory & Composition", "Photography", "Theatre Arts/Drama", "Accounting", "Accounting Technician", "Business Administration & Management, General", "Hotel/Motel Management", "Human Resources Development/Training", "Human Resources Management", "International Business Management", "Labor/Industrial Relations", "Logistics & Materials Management", "Marketing Management & Research", "Office Supervision & Management", "Operations Management & Supervision", "Organizational Behavior"];
    const course_list2 = ["Purchasing/Procurement/Contracts Management", "Restaurant/Food Services Management", "Small Business Management/Operations", "Travel/Tourism Management", "Business/Management Quantitative Methods, General", "Actuarial Science", "Business/Managerial Economics", "Finance, General", "Banking & Financial Support Services", "Financial Planning & Services", "Insurance & Risk Management", "Investments & Securities", "Management Information Systems", "Real Estate", "Sales, Merchandising, & Marketing, General", "Fashion Merchandising", "Tourism & Travel Marketing", "Secretarial Studies & Office Administration", "Communications, General", "Advertising", "Digital Communications/Media", "Journalism, Broadcast", "Journalism, Print", "Mass Communications", "Public Relations & Organizational Communication", "Radio & Television Broadcasting", "Communications Technology, General", "Graphic & Printing Equipment Operation", "Multimedia/Animation/Special Effects", "Radio & Television Broadcasting Technology", "Family & Consumer Sciences, General", "Adult Development & Aging/Gerontology", "Child Care Services Management", "Child Development", "Consumer & Family Economics", "Food & Nutrition", "Textile & Apparel", "Parks, Recreation, & Leisure, General", "Exercise Science/Physiology/Kinesiology", "Health & Physical Education/Fitness", "Parks/Rec/Leisure Facilities Management", "Sport & Fitness Administration/Management", "Personal Services, General", "Cosmetology/Hairstyling", "Culinary Arts/Chef Training", "Funeral Services & Mortuary Science", "Protective Services, General", "Corrections", "Criminal Justice", "Fire Protection & Safety Technology", "Law Enforcement", "Military Technologies", "Public Administration & Services, General", "Community Organization & Advocacy", "Public Administration", "Public Affairs & Public Policy Analysis", "Social Work", "Computer & Information Sciences, General", "Computer Networking/Telecommunications", "Computer Science & Programming", "Computer Software & Media Applications", "Computer System Administration", "Data Management Technology", "Information Science", "Webpage Design", "Mathematics, General"];
    const course_list3 = ["Applied Mathematics", "Statistics", "Counseling & Student Services", "Educational Administration", "Special Education", "Teacher Education, General", "Curriculum & Instruction", "Early Childhood Education", "Elementary Education", "Junior High/Middle School Education", "Postsecondary Education", "Secondary Education", "Teacher Assisting/Aide Education", "Teacher Education, Subject-Specific", "Agricultural Education", "Art Education", "Business Education", "Career & Technical Education", "English-as-a-Second-Language Education", "English/Language Arts Education", "Foreign Languages Education", "Health Education", "Mathematics Education", "Music Education", "Physical Education & Coaching", "Science Education", "Social Studies/Sciences Education", "Engineering (Pre-Engineering), General", "Aerospace/Aeronautical Engineering", "Agricultural/Bioengineering", "Architectural Engineering", "Biomedical Engineering", "Chemical Engineering", "Civil Engineering", "Computer Engineering", "Construction Engineering/Management", "Electrical, Electronics & Communications Engineering", "Environmental Health Engineering", "Industrial Engineering", "Mechanical Engineering", "Nuclear Engineering", "Drafting/CAD Technology, General", "Architectural Drafting/CAD Technology", "Mechanical Drafting/CAD Technology", "Engineering Technology, General", "Aeronautical/Aerospace Engineering Technologies", "Architectural Engineering Technology", "Automotive Engineering Technology", "Civil Engineering Technology", "Computer Engineering Technology", "Construction/Building Technology", "Electrical, Electronics Engineering Technologies", "Electromechanical/Biomedical Engineering Technologies", "Environmental Control Technologies", "Industrial Production Technologies", "Mechanical Engineering Technology", "Quality Control & Safety Technologies", "Surveying Technology", "English Language & Literature, General", "American/English Literature", "Creative Writing", "Public Speaking", "Foreign Languages/Literatures, General", "Asian Languages & Literatures", "Classical/Ancient Languages & Literatures", "Comparative Literature", "French Language & Literature"];
    const course_list4 = ["German Language & Literature", "Linguistics", "Middle Eastern Languages & Literatures", "Spanish Language & Literature", "Health Services Administration,General", "Hospital/Facilities Administration", "Medical Office/Secretarial", "Medical Records", "Medical/Clinical Assisting, General", "Dental Assisting", "Medical Assisting", "Occupational Therapy Assisting", "Physical Therapy Assisting", "Veterinarian Assisting/Technology", "Chiropractic (Pre-Chiropractic)", "Dental Hygiene", "Dentistry (Pre-Dentistry)", "Emergency Medical Technology", "Health-Related Professions & Services, General", "Athletic Training", "Communication Disorder Services (e.g., Speech Pathology)", "Public Health", "Health/Medical Technology, General", "Medical Laboratory Technology", "Medical Radiologic Technology", "Nuclear Medicine Technology", "Respiratory Therapy Technology", "Surgical Technology", "Medicine (Pre-Medicine)", "Nursing, Practical/Vocational (LPN)", "Nursing, Registered (BS/RN)", "Optometry (Pre-Optometry)", "Osteopathic Medicine", "Pharmacy (Pre-Pharmacy)", "Physician Assisting", "Therapy & Rehabilitation, General", "Alcohol/Drug Abuse Counseling", "Massage Therapy", "Mental Health Counseling", "Occupational Therapy", "Physical Therapy (Pre-Physical Therapy)", "Psychiatric/Mental Health Technician", "Rehabilitation Therapy", "Vocational Rehabilitation Counseling", "Veterinary Medicine (Pre-Veterinarian)", "Philosophy", "Religion", "Theology, General", "Bible/Biblical Studies", "Divinity/Ministry", "Religious Education", "Aviation & Airway Science, General", "Aircraft Piloting & Navigation", "Aviation Management & Operations", "Construction Trades (e.g., carpentry, plumbing, electrical)", "Mechanics & Repairers, General", "Aircraft Mechanics/Technology", "Autobody Repair/Technology", "Automotive Mechanics/Technology", "Avionics Technology", "Diesel Mechanics/Technology", "Electrical/Electronics Equip Installation & Repair", "Heating/Air Cond/Refrig Install/Repair", "Precision Production Trades, General", "Machine Tool Technology", "Welding Technology", "Transportation & Materials Moving (e.g., air, ground, & marine)"];
    const course_list5 = ["Biology, General", "Biochemistry & Biophysics", "Cell/Cellular Biology", "Ecology", "Genetics", "Marine/Aquatic Biology", "Microbiology & Immunology", "Zoology", "Physical Sciences, General", "Astronomy", "Atmospheric Sciences & Meteorology", "Chemistry", "Geological & Earth Sciences", "Physics", "Legal Studies, General", "Court Reporting", "Law (Pre-Law)", "Legal Administrative Assisting/Secretarial", "Paralegal/Legal Assistant", "Social Sciences, General", "Anthropology", "Criminology", "Economics", "Geography", "History", "International Relations & Affairs", "Political Science & Government", "Psychology, Clinical & Counseling", "Psychology, General", "Sociology", "Urban Studies/Urban Affairs"];
    const proficiency_level = ["NA - Not Applicable", "1 - Fundamental Awareness (basic knowledge)", "2 - Novice (limited experience)", "3 - Intermediate (practical application)", "4 - Advanced (applied theory)", "5 - Expert (recognized authority)"];
    formData.append('action', 'fetch_education_row_data');
    formData.append('id', id);
    // fetch row data via ajax
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      let jsonParsed = JSON.parse(data)[0];
      const {id, degree, uni_name, major, rank, issue_date, remark} = jsonParsed;
      html += `<div class="form-row">
                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="uedegree">Degree</label>
                        </div>
                        <div class="form-group col-md-8">
                            <select name="uedegree" class="custom-select-2">
                              <option value="">Select Degree</option>`;
                              degrees.forEach(deg => {
                                let selected = deg === degree ? 'selected' : '';
                                html += `<option value="${deg}" ${selected}>${deg}</option>`;
                              });
                   html += `</select>
                        </div>    
                    </div>                    
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="ueuni_name">Name of University</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="ueuni_name" placeholder="Name of University" name="ueuni_name" value="${uni_name}" required />
                        </div> 
                    </div>                       
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="uemajor">Major</label>
                        </div>
                        <div class="form-group col-md-8">
                            <select class = "form-control custom-select-2" name="uemajor" id = "uemajor">
                                <option value="">Select Major</option>`;
                                course_list1.forEach(course => {
                                  let selected = course === major ? 'selected' : '';
                       html += `<option value="${course}" ${selected}>${course}</option>`;
                                });
                                course_list2.forEach(course => {
                                  let selected = course === major ? 'selected' : '';
                       html += `<option value="${course}" ${selected}>${course}</option>`;
                                });
                                course_list3.forEach(course => {
                                  let selected = course === major ? 'selected' : '';
                       html += `<option value="${course}" ${selected}>${course}</option>`;
                                });
                                course_list4.forEach(course => {
                                  let selected = course === major ? 'selected' : '';
                       html += `<option value="${course}" ${selected}>${course}</option>`;
                                });
                                course_list5.forEach(course => {
                                  let selected = course === major ? 'selected' : '';
                       html += `<option value="${course}" ${selected}>${course}</option>`;
                                });
                   html += `</select>
                        </div> 
                    </div>                       
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="uerank">Ranking</label>
                        </div>
                        <div class="form-group col-md-8">
                            <select class = "form-control custom-select-2" name="uerank" id = "uerank">
                                <option value="">Select Levels</option>`;
                                proficiency_level.forEach(level => {
                                  let selected = level === rank ? 'selected' : '';
                       html += `<option value="${level}" ${selected}>${level}</option>`;
                                });
                   html += `</select>
                        </div>
                    </div>                      
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="ueeduc_issue_date">Issue Date</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="date" class="form-control" id="ueeduc_issue_date" placeholder="Issue Date" name="ueissue_date" value="${issue_date ? issue_date : ''}" required />
                        </div>
                    </div>                      
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="ueeduc_remarks">Remark</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="ueeduc_remarks" placeholder="Remark" name="ueremark" value="${remark}" required />
                        </div>
                    </div>                      
                </div>
                <input type="hidden" name="ueid" value="${id}"/>
            </div>`;
      if (html !== '') {
        modalForm.html(html);
        setTimeout(() => {
          $('.custom-select-2').select2();
          $('body .lds-ellipsis').remove();
          $('#euModalBtn').trigger('click');
        }, 500);
      }
    });
  });
  $('#educationUpdate').on('click', 'button[type=submit]', function() {
    $('#educationUpdateForm').trigger('submit');
  });
  $('#educationUpdateForm').on('submit', function(e){
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    const action = 'update_education';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        $('#close_ue_modal').trigger('click');
        successResponse('', updateSuccessMsg);
        window.location.reload();
      } else {
        errorResponse(data);
        window.location.reload();
      }
    });
  });

  // update technical skills

  
  $('#technical tbody').on('click', '.fa-pen-to-square', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    let formData = new FormData();
    let majors = ["Programmer", "Developer", "Designer"];
    let levels = ["Junior", "Mid Level", "Senior"];
    let html = '';
    let modalForm = $('#technicalSkillUpdateForm');
    formData.append('action', 'fetch_tech_skill_row_data');
    formData.append('id', id);
    // fetch row data via ajax
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      let jsonParsed = JSON.parse(data)[0];
      const {id, description, major, level, remark} = jsonParsed;
      html += `<div class="form-row">
                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="utdescription">Description</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="utdescription" placeholder="Description" name="utdescription" value="${description}" required />
                        </div>    
                    </div>                    
                </div>
                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="utlevel">Levels</label>
                        </div>
                        <div class="form-group col-md-8">
                            <select class="form-control custom-select-2" id="utlevel" name="utlevel">
                                <option value="">-- Select Level --</option>`;
                                levels.forEach(element => {
                                  let selected = element === level ? 'selected' : '';
                       html += `<option value="${element}" ${selected}>${element}</option>`;
                                });
                  html +=  `</select>
                        </div>
                    </div>                      
                </div>
                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="utremark">Remark</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="utremark" placeholder="Remark" name="utremark" value="${remark === null ? '' : remark}" required />
                        </div>
                    </div>                      
                </div>
            </div>
            <input type="hidden" name="utid" value="${id}" />`;
      if (html !== '') {
        modalForm.html(html);
        setTimeout(() => {
          $('.custom-select-2').select2();
          $('body .lds-ellipsis').remove();
          $('#tsuModalBtn').trigger('click');
        }, 500);
      }
    });
  });
  $('#technicalSkillUpdate').on('click', 'button[type=submit]', function() {
    $('#technicalSkillUpdateForm').trigger('submit');
  });
  $('#technicalSkillUpdateForm').on('submit', function(e){
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    const action = 'update_tech_skill';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        $('#close_uts_modal').trigger('click');
        successResponse('', updateSuccessMsg);
        window.location.reload();
      } else {
        errorResponse(data);
        window.location.reload();
      }
    });
  });

  // update other skills

  $('#other-skills tbody').on('click', '.fa-pen-to-square', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    let formData = new FormData();
    let majors = ["Programmer", "Developer", "Designer"];
    let levels = ["Junior", "Mid Level", "Senior"];
    let html = '';
    let modalForm = $('#otherSkillUpdateForm');
    formData.append('action', 'fetch_other_skill_row_data');
    formData.append('id', id);
    // fetch row data via ajax
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      let jsonParsed = JSON.parse(data)[0];
      const {id, description, major, level, remark} = jsonParsed;
      html += `<div class="form-row">
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="description">Description</label>
                          </div>
                          <div class="form-group col-md-8">
                              <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="${description}" required />
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
                                  <option value="">-- Select Level --</option>`;
                                  levels.forEach(element => {
                                    let selected = element === level ? 'selected' : '';
                         html += `<option value="${element}" ${selected}>${element}</option>`;
                                  });
                     html += `</select>
                          </div>
                      </div>                      
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="remark">Remark</label>
                          </div>
                          <div class="form-group col-md-8">
                              <input type="text" class="form-control" id="remark" placeholder="Remark" name="remark" value="${remark === null ? '' : remark}" required />
                          </div>
                      </div>                      
                  </div>
              </div>
              <input type="hidden" name="id" value="${id}"/>`;
      if (html !== '') {
        modalForm.html(html);
        setTimeout(() => {
          $('.custom-select-2').select2();
          $('body .lds-ellipsis').remove();
          $('#osuModalBtn').trigger('click');
        }, 500);
      }
    });
  });
  $('#otherSkillUpdate').on('click', 'button[type=submit]', function() {
    $('#otherSkillUpdateForm').trigger('submit');
  });
  $('#otherSkillUpdateForm').on('submit', function(e){
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    const action = 'update_other_skill';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        $('#uos_close_modal').trigger('click');
        successResponse('', updateSuccessMsg);
        window.location.reload();
      } else {
        errorResponse(data);
        window.location.reload();
      }
    });
  });

  // update training

  $('#training tbody').on('click', '.fa-pen-to-square', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    let formData = new FormData();
    let levels = ["Beginner", "Intermediate", "Advanced"];
    let trainors = ["Trainor 1", "Trainor 2", "Trainor 3"];
    let html = '';
    let modalForm = $('#trainingUpdateForm');
    formData.append('action', 'fetch_training_row_data');
    formData.append('id', id);
    // fetch row data via ajax
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      let jsonParsed = JSON.parse(data)[0];
      const {id, name, description, trainor, level, training_date, remark} = jsonParsed;
      html += `<div class="form-row">
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="name">Training Name</label>
                          </div>
                          <div class="form-group col-md-8">
                              <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="${name}" required />
                          </div>    
                      </div>                    
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="description">Description</label>
                          </div>
                          <div class="form-group col-md-8">
                              <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="${description}" required />
                          </div>    
                      </div>                    
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="trainor">Trainor</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="trainor" placeholder="Trainor" name="trainor" value="${trainor}" required />
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
                                  <option value="">-- Select Level --</option>`;
                                  levels.forEach(element => {
                                    let selected = element === level ? 'selected' : '';
                         html += `<option value="${element}" ${selected}>${element}</option>`;
                                  });
                    html +=  `</select>
                          </div>
                      </div>                      
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="date">Date</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="date" class="form-control" id="date" value="${training_date}" name="date" required />
                        </div>    
                    </div>
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="remark">Remark</label>
                          </div>
                          <div class="form-group col-md-8">
                              <input type="text" class="form-control" id="remark" placeholder="Remark" name="remark" value="${remark}" required />
                          </div>
                      </div>                      
                  </div>
              </div>
              <input type="hidden" name="id" value="${id}" />`;
      if (html !== '') {
        modalForm.html(html);
        setTimeout(() => {
          $('.custom-select-2').select2();
          $('body .lds-ellipsis').remove();
          $('#openUpdateTrainingBtn').trigger('click');
        }, 500);
      }
    });
  });
  $('#trainingUpdate').on('click', 'button[type=submit]', function() {
    $('#trainingUpdateForm').trigger('submit');
  });
  $('#trainingUpdateForm').on('submit', function(e){
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    const action = 'update_training';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        $('#closeUpdateTrainingBtn').trigger('click');
        successResponse('', updateSuccessMsg);
        window.location.reload();
      } else {
        errorResponse(data);
        window.location.reload();
      }
    });
  });

  // update employee history

  $('#employee-history-table tbody').on('click', '.fa-pen-to-square', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    let formData = new FormData();
    let positions = ["Programmer", "Designer", "Developer"];
    let html = '';
    let modalForm = $('#employeeHistoryUpdateForm');
    formData.append('action', 'fetch_emphis_row_data');
    formData.append('id', id);
    // fetch row data via ajax
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      let jsonParsed = JSON.parse(data)[0];
      const {id, emp_history_from, emp_history_to, company_name, position, latest_salary, remark} = jsonParsed;
      html += `<div class="form-row">
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="emp_history_from">From</label>
                          </div>
                          <div class="form-group col-md-8">
                              <input type="date" class="form-control" id="emp_history_from" name="emp_history_from" value="${emp_history_from}" required />
                          </div>    
                      </div>                    
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="emp_history_to">To</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="date" class="form-control" id="emp_history_to" name="emp_history_to" value="${emp_history_to}" required />
                          </div> 
                      </div>                       
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="company_name">Company's Name</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="company_name" placeholder="Company Name" name="company_name" value="${company_name}" required />
                          </div>
                      </div>                      
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="position">Position</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="position" placeholder="Position" name="position" value="${position}" required />
                          </div>
                      </div>                      
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="latest_salary">Latest Salary</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="latest_salary" placeholder="0.00" name="latest_salary" value="${latest_salary ? latest_salary : ''}" required />
                          </div>
                      </div>                      
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="remark">Remarks</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="remark" placeholder="Remark" name="remark" value="${remark ? remark : ''}" required />
                          </div>
                      </div>                      
                  </div>
              </div>
            <input type="hidden" name="id" value="${id}" />`;
      if (html !== '') {
        modalForm.html(html);
        setTimeout(() => {
          $('.custom-select-2').select2();
          $('body .lds-ellipsis').remove();
          $('#openEmpHistoryModalBtn').trigger('click');
        }, 500);
      }
    });
  });
  $('#employeeHistoryUpdate').on('click', 'button[type=submit]', function() {
    $('#employeeHistoryUpdateForm').trigger('submit');
  });
  $('#employeeHistoryUpdateForm').on('submit', function(e){
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    const action = 'update_emphis';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        $('#closeEmpHistoryModalBtn').trigger('click');
        successResponse('', updateSuccessMsg);
        window.location.reload();
      } else {
        errorResponse(data);
        window.location.reload();
      }
    });
  });

  // update family relationship

  $('#family-rel-table tbody').on('click', '.fa-pen-to-square', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    let formData = new FormData();
    let html = '';
    let modalForm = $('#familyRelUpdateForm');
    let relationships = ["Father", "Grandmother", "Grandfather", "Uncle", "Sister", "Wife", "Son", "Daughter", "Children", "Mother-in-law", "Mother", "Father-in-law", "Brother", "Husband", "Stepmother", "Sister-in-law", "Grandmother-in-law", "Other"];
    let employees = ["Emp 1", "Emp 2", "Emp 3"];
    formData.append('action', 'fetch_famrel_row_data');
    formData.append('id', id);
    // fetch row data via ajax
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      let jsonParsed = JSON.parse(data)[0];
      const {id, is_relative_in_company, employee, fullname, date_of_birth, relationship, occupation, remark} = jsonParsed;
      let is_relative_in_company_checker = is_relative_in_company === '1' ? 'checked' : '';
      let employee_selection_checker = is_relative_in_company === '1' ? '' : 'disabled';
      html += `<div class="form-row">
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="is_relative_in_company1">Relative in Company</label>
                          </div>
                          <div class="form-group col-md-8 d-flex">
                            <input type="checkbox" id="is_relative_in_company1" name="is_relative_in_company1" value="${is_relative_in_company}" ${is_relative_in_company_checker}/>
                            <div class="col-md-12">
                              <select class="custom-select-2" id="employee1" name="employee1" ${employee_selection_checker}>
                                <option value="">-- Select Employee --</option>`;
                                employees.forEach(element => {
                                  let selected = element === employee ? 'selected' : '';
                          html += `<option value="${element}" ${selected}>${element}</option>`;
                                });
                     html += `</select>
                            </div>
                          </div>    
                      </div>                    
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="fullname1">Full Name</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="fullname1" placeholder="Full Name" name="fullname1" value="${fullname}" required />
                          </div> 
                      </div>                       
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="date_of_birth1">Date of Birth</label>
                      </div>
                      <div class="form-group col-md-8">
                        <input type="date" class="form-control" id="date_of_birth1" name="date_of_birth1" value="${date_of_birth}" required />
                      </div>
                    </div>                      
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="relationship1">Relationship</label>
                          </div>
                          <div class="form-group col-md-8">
                              <select class="form-control custom-select-2" id="relationship1" name="relationship1">
                                  <option value="">-- Select Relationship --</option>`;
                                  relationships.forEach(element => {
                                    let selected = element === relationship ? 'selected' : '';
                                    html += `<option value="${element}" ${selected}>${element}</option>`;
                                  });
                     html += `</select>
                          </div>
                      </div>                      
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="occupation1">Occupation</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="occupation1" placeholder="Occupation" name="occupation1" value="${occupation}" required />
                          </div>
                      </div>                      
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="remark1">Remark</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="remark1" placeholder="Remark" name="remark1" value="${remark}" required />
                          </div>
                      </div>                      
                  </div>
              </div>
              <input type="hidden" name="id" value="${id}"/>`;
      if (html !== '') {
        modalForm.html(html);
        setTimeout(() => {
          $('.custom-select-2').select2();
          $('body .lds-ellipsis').remove();
          $('#openFamrelModalBtn').trigger('click');
        }, 500);
      }
    });
  });
  $('#familyRelUpdate').on('click', 'button[type=submit]', function() {
    $('#familyRelUpdateForm').trigger('submit');
  });
  $('#familyRelUpdateForm').on('submit', function(e){
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    const action = 'update_famrel';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        $('#closeFamrelModalBtn').trigger('click');
        successResponse('', updateSuccessMsg);
        window.location.reload();
      } else {
        errorResponse(data);
        window.location.reload();
      }
    });
  });

  // update pit dependent

  $('#pit-dependant-table tbody').on('click', '.fa-pen-to-square', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    let formData = new FormData();
    let html = '';
    let modalForm = $('#dependentUpdateForm');
    formData.append('action', 'fetch_dependent_row_data');
    formData.append('id', id);
    // fetch row data via ajax
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      let jsonParsed = JSON.parse(data)[0];
      const {id, name, doc_type, issue_date, issue_place, remark} = jsonParsed;
      html += `<div class="form-row">
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <label for="name">Dependant Name</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="name" placeholder="Full Name" name="name" value="${name}" required />
                          </div> 
                      </div>                       
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="doc_type">Document Type</label>
                      </div>
                      <div class="form-group col-md-8">
                        <input type="text" class="form-control" id="doc_type" name="doc_type" placeholder="Document Type" value="${doc_type}" required />
                      </div>
                    </div>                      
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="issue_date">Issue Date</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="date" class="form-control" id="issue_date" name="issue_date" value="${issue_date}" required />
                          </div>
                      </div>                      
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="issue_place">Issue Place</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="issue_place" placeholder="Issue Place" name="issue_place" value="${issue_place}" required />
                          </div>
                      </div>                      
                  </div>
                  <div class="form-group col-md-12 modal-inner-row">
                      <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="remark">Remark</label>
                          </div>
                          <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="remark" placeholder="Remark" name="remark" value="${remark}" required />
                          </div>
                      </div>                      
                  </div>
              </div>
              <input type="hidden" name="id" value="${id}" />`;
      if (html !== '') {
        modalForm.html(html);
        setTimeout(() => {
          $('body .lds-ellipsis').remove();
          $('#openDependentUpdateModalBtn').trigger('click');
        }, 500);
      }
    });
  });
  $('#dependentUpdate').on('click', 'button[type=submit]', function() {
    $('#dependentUpdateForm').trigger('submit');
  });
  $('#dependentUpdateForm').on('submit', function(e){
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    const action = 'update_dependant';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        $('#closeDependentUpdateModalBtn').trigger('click');
        successResponse('', updateSuccessMsg);
        window.location.reload();
      } else {
        errorResponse(data);
        window.location.reload();
      }
    });
  });

  // update salary/benefits info

  $('#salaryBenefitsForm').on('submit', function (e) {
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    let action = 'update_salary_info';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        successResponse('', updateSuccessMsg);
      } else {
        errorResponse(data);
      }
    });
  });

  // update deductions info

  $('#deductionsForm').on('submit', function (e) {
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    let action = 'update_deductions';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        successResponse('', updateSuccessMsg);
      } else {
        errorResponse(data);
      }
    });
  });

  // update assignment info

  $('#assignment-info-form').on('submit', function (e) {
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    let action = 'update_assign_info';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        successResponse('', updateSuccessMsg);
      } else {
        errorResponse(data);
      }
    });
  });

  // update resignation 

  $('#resignation-table tbody').on('click', '.fa-pen-to-square', function() {
    const currElem = $(this);
    const id = currElem.data('id');
    let formData = new FormData();
    let html = '';
    let categories = ["Category 1", "Category 2", "Category 3"];
    let modalForm = $('#empResignUpdateForm');
    formData.append('action', 'fetch_resignation_row_data');
    formData.append('id', id);
    // fetch row data via ajax
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      let jsonParsed = JSON.parse(data)[0];
      const {id, emp_code, fullname, company, department, category, notice_date, last_working_date, last_service_date, annual_leave_bal, blacklist, remark} = jsonParsed;
      html = `<div class="form-row">
                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="emp_code">Employee Code</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="emp_code" placeholder="Employee Code" name="emp_code" value="${emp_code}" required />
                        </div>    
                    </div>                    
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="fullname">Full Name</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="fullname" placeholder="Fullname" name="fullname" value="${fullname}" required />
                        </div> 
                    </div>                       
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="company">Company</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="company" placeholder="Company" name="company" value="${company}" required />
                        </div> 
                    </div>                       
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="department">Department</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="department" placeholder="Department" name="department" value="${department}" required />
                        </div> 
                    </div>                       
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="category">Category</label>
                        </div>
                        <div class="form-group col-md-8">
                            <select class = "form-control custom-select-2" name="category" id="category">
                                <option value="">Select Category</option>`;
                                categories.forEach(element => {
                                  let selected = element === category ? 'selected' : '';
                                  html += `<option value="${element}" ${selected}>${element}</option>`;
                                });
                   html += `</select>
                        </div> 
                    </div>                       
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="notice_date">Notice Date</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="date" class="form-control" id="notice_date" placeholder="Notice Date" name="notice_date" value="${notice_date}" required />
                        </div>
                    </div>                      
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="last_working_date">Last Working Date</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="date" class="form-control" id="last_working_date" placeholder="Notice Date" name="last_working_date" value="${last_working_date}" required />
                        </div>
                    </div>                      
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="last_service_date">Last Service Date</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="date" class="form-control" id="last_service_date" placeholder="Notice Date" name="last_service_date" value="${last_service_date}" required />
                        </div>
                    </div>                      
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="annual_leave_bal">Annual Leave Balance</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="annual_leave_bal" placeholder="Annual Leave Balance" name="annual_leave_bal" value="${annual_leave_bal}" required />
                        </div>
                    </div>                      
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="blacklist">Blacklist</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="blacklist" placeholder="Blacklist" name="blacklist" value="${blacklist}" required />
                        </div>
                    </div>                      
                </div>

                <div class="form-group col-md-12 modal-inner-row">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="remark">Remark</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="remark" placeholder="Remark" name="remark" value="${remark}" required />
                        </div>
                    </div>                      
                </div>
            </div>
            <input type="hidden" name="id" value="${id}" />`;
        if (html !== '') {
          modalForm.html(html);
          setTimeout(() => {
            $('.custom-select-2').select2();
            $('body .lds-ellipsis').remove();
            $('#openUpdatResignModalBtn').trigger('click');
          }, 500);
        }
    });
  });
  $('#empResignUpdate').on('click', 'button[type=submit]', function() {
    $('#empResignUpdateForm').trigger('submit');
  });
  $('#empResignUpdateForm').on('submit', function(e){
    e.preventDefault();
    const form = $(this);
    let formData = new FormData();
    const action = 'update_resignation';
    formData.append('action', action);
    formData.append('formData', form.serialize());
    customUpdate(formData).done(function(data,responseText,jqXHR) {
      if ( data === 'success' ) {
        $('#closeUpdatResignModalBtn').trigger('click');
        successResponse('', updateSuccessMsg);
        window.location.reload();
      } else {
        errorResponse(data);
        window.location.reload();
      }
    });
  });

  // validate input for available SIL

  $('#availSil').on('input', function() { 
    let value = $(this).val();
    if ( isNaN( value ) ) {
      $(this).val('');
    }
  });

  // save available SIL

  $('#availSil-form').submit(function(e){
		e.preventDefault();
		let silVal	= $('#availSil-form input#availSil').val();
    let userID  = $(this).data('id');
    let usedSil = $('input#usedSil').val();
    let remSil = $('input#remSil');
    let totalSil = parseFloat(silVal - usedSil).toFixed(1);
		$.ajax({  
			url: './includes/common/ajax-handler.php',
			type: 'POST',
			data: {
				action	: 'set-sil',
				silVal	: silVal,
        userID  : userID,
			},
			beforeSend : function( ){
				$('body').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
			},
			success: function(data) {
				if( data ){
					$('body').prepend('<div class="notification-message alert alert-success">Available SIL successfully set.</div>');
				}else{
					$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
				}
				setTimeout(function(){
					$('body .notification-message').remove();
          window.location.reload();
		    }, 1500);
        remSil.val( totalSil > 0 ? totalSil : 0 );
				$('body .lds-ellipsis').remove();
			},
			error: function(log) {
				console.log(log.message);
			}
		});
	});

  
  
  /* dropzone 1 */

  let dropzone  = $('#custom-dropzone');
  let legal_doc = $("#document_uploadModal input[type='file']");

  // prevent default browser behavior
  dropzone.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
      e.preventDefault();
      e.stopPropagation();
  });

  // add visual drag information  
  dropzone.on('dragover dragenter', function() {
      $('#custom-dropzone').addClass('active');
      })
  dropzone.on('dragleave dragend', function() {
      $('#custom-dropzone').removeClass('active');
      }) 

  // catch file drop and add it to input
  dropzone.on("drop", e => {
      e.preventDefault();
      let files = e.originalEvent.dataTransfer.files;

      if (files.length >= 1) {
        legal_doc.prop('files', files);
        let label = stringifiedFileNames(files);
        $('#fileNameHolder').css('font-size', '14px');
        $('#fileNameHolder').text(label);
      }
  });

  $('#document_uploadModal input[type="file"]').on('change', function() {
    let currElem = $(this);
    let files = currElem.get(0).files;
    let label = stringifiedFileNames(files);
    $('#fileNameHolder').css('font-size', '14px');
    $('#fileNameHolder').text(label);
  });

  /* dropzone 2 */

  let legal_doc_update_form = $('#documentUpdateForm');
  let additional_doc        = $("#documentUpdateForm input[type='file']");

  // prevent default browser behavior
  legal_doc_update_form.on('drag dragstart dragend dragover dragenter dragleave drop', '#custom-dropzone-2', function(e) {
    e.preventDefault();
    e.stopPropagation();
  });

  // add visual drag information  
  legal_doc_update_form.on('dragover dragenter', '#custom-dropzone-2', function() {
    $(this).addClass('active');
  })
  legal_doc_update_form.on('dragleave dragend', '#custom-dropzone-2', function() {
    $(this).removeClass('active');
  }) 

  // catch file drop and add it to input
  legal_doc_update_form.on("drop", '#custom-dropzone-2', e => {
      e.preventDefault();
      let files = e.originalEvent.dataTransfer.files;

      if (files.length >= 1) {
        additional_doc.prop('files', files);
        let label = stringifiedFileNames(files);
        $('#ufileNameHolder').css('font-size', '14px');
        $('#ufileNameHolder').text(label);
      }
  });

  legal_doc_update_form.on('change', 'input[type="file"]', function() {
    let currElem = $(this);
    let files = currElem.get(0).files;
    let label = stringifiedFileNames(files);
    $('#ufileNameHolder').css('font-size', '14px');
    $('#ufileNameHolder').text(label);
  });

  /* dropzone 3 */

  let dropzone3            = $('#custom-dropzone-3');
  let additional_legal_doc = $("#add-additional-doc input[type='file']");

  // prevent default browser behavior
  dropzone3.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
      e.preventDefault();
      e.stopPropagation();
  });

  // add visual drag information  
  dropzone3.on('dragover dragenter', function() {
      $(this).addClass('active');
      })
  dropzone3.on('dragleave dragend', function() {
      $(this).removeClass('active');
      }) 

  // catch file drop and add it to input
  dropzone3.on("drop", e => {
      e.preventDefault();
      let files = e.originalEvent.dataTransfer.files;

      if (files.length >= 1) {
        additional_legal_doc.prop('files', files);
        let label = stringifiedFileNames(files);
        $('#addFileNameHolder').css('font-size', '14px');
        $('#addFileNameHolder').text(label);
      }
  });

  additional_legal_doc.on('change', function() {
    let currElem = $(this);
    let files = currElem.get(0).files;
    let label = stringifiedFileNames(files);
    $('#addFileNameHolder').css('font-size', '14px');
    $('#addFileNameHolder').text(label);
  });

  /* dropzone 4 */

  let additional_legal_doc_update_form = $('#additionalDocumentUpdateForm');
  let additional_doc_input             = $("#additionalDocumentUpdateForm input[type='file']");

  // prevent default browser behavior
  additional_legal_doc_update_form.on('drag dragstart dragend dragover dragenter dragleave drop', '#custom-dropzone-4', function(e) {
    e.preventDefault();
    e.stopPropagation();
  });

  // add visual drag information  
  additional_legal_doc_update_form.on('dragover dragenter', '#custom-dropzone-4', function() {
    $(this).addClass('active');
  })
  additional_legal_doc_update_form.on('dragleave dragend', '#custom-dropzone-4', function() {
    $(this).removeClass('active');
  }) 

  // catch file drop and add it to input
  additional_legal_doc_update_form.on("drop", '#custom-dropzone-4', e => {
      e.preventDefault();
      let files = e.originalEvent.dataTransfer.files;

      if (files.length >= 1) {
        additional_doc_input.prop('files', files);
        let label = stringifiedFileNames(files);
        $('#uAddFileNameHolder').css('font-size', '14px');
        $('#uAddFileNameHolder').text(label);
      }
  });

  additional_legal_doc_update_form.on('change', 'input[type="file"]', function() {
    let currElem = $(this);
    let files = currElem.get(0).files;
    let label = stringifiedFileNames(files);
    $('#uAddFileNameHolder').css('font-size', '14px');
    $('#uAddFileNameHolder').text(label);
  });

  $('body').on('input', 'input[name="search_files"]', function() {
    let $this = $(this);
    let $val  = $this.val();
    let $table = $('table#user-file-list');
    $table.find('tbody tr').each(function(){
      let $td = $(this).find('td:first-child').text();
      if( !$td.includes( $val ) ) {
        $(this).addClass('d-none');
        if( $(this).hasClass('d-trow') ) {
          $(this).removeClass('d-trow').addClass('d-none');
        }
      } else {
        $(this).addClass('d-trow');
        if( $(this).hasClass('d-none') ) {
          $(this).removeClass('d-none').addClass('d-trow');
        }
      }
    });
  });

});
