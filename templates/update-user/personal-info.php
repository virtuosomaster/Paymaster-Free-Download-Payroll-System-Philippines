<?php
include_once '../../includes/common/functions.php';
$countries = array("Philippines");//array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas, The", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "British Virgin Islands", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Cayman Islands", "Central African Republic", "Chad", "Channel Islands", "Chile", "China", "Colombia", "Comoros", "Congo, Dem. Rep.", "Congo, Rep.", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Curacao", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt, Arab Rep.", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Faroe Islands", "Fiji", "Finland", "France", "French Polynesia", "Gabon", "Gambia, The", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong SAR, China", "Hungary", "Iceland", "India", "Indonesia", "Iran, Islamic Rep.", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Dem. People's Rep.", "Korea, Rep.", "Kosovo", "Kuwait", "Kyrgyz Republic", "Lao PDR", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao SAR, China", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia, Fed. Sts.", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Macedonia", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico", "Qatar", "Romania", "Russian Federation", "Rwanda", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Sint Maarten (Dutch part)", "Slovak Republic", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Sudan", "Spain", "Sri Lanka", "St. Kitts and Nevis", "St. Lucia", "St. Martin (French part)", "St. Vincent and the Grenadines", "Sudan", "Suriname", "Sweden", "Switzerland", "Syrian Arab Republic", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkiye", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela, RB", "Vietnam", "Virgin Islands (U.S.)", "West Bank and Gaza", "Yemen, Rep.", "Zambia", "Zimbabwe");
$titles    = array("Mr", "Mrs");
$genders   = array("Male", "Female");
$civil_status = array("Single", "Married", "Separated", "Widowed", "Divorced");
$autofill_checker = $user_data->autofill == 'on' ? 'checked' : '';
?>
<form id="personal_info_1" enctype="multipart/form-data" autocomplete="off">
        <section>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group col-md-12">
                                    <div id=img-wrapper style="border-radius: 50%;">
                                        <img src="<?php echo pcm_get_avatar($user_data->id); ?>" id="emp_profile_pic" style="object-fit: cover; width: 100%; height: 100%; border-radius: 50%;" />
                                    </div>
                                </div>
                                <label class="d-block">
                                    <button type="button" data-target="#uploadAvatar" data-toggle="modal" class="btn btn-primary pm-blue btn-lg d-block">Change Avatar</button>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="card">
                        <div class="card-header" style="color: #FF0000;">
                            Note: Please put N/A if the field does not apply to you.
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Personal Information
                        </div>
                        <div class="card-body">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="form-group col-md-12 d-none">
                                            <label for="fullname">Full Name</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user_data->fname.' '.$user_data->mname.' '.$user_data->lname; ?>" required="required">
                                        </div>
                                        <div class="form-group col-md-12 d-none">
                                            <label for="title">Title</label>
                                            <select name="title" id="title" class="form-select custom-select-2">
                                                <option value="">Select Title</option>
                                                <?php foreach ($titles as $title): ?>
                                                    <?php $selected = $title == $user_data->title ? 'selected' : ''; ?>
                                                    <option value=<?php echo $title; ?> <?php echo $selected; ?>><?php echo $title; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="fname">First Name</label>
                                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $user_data->fname; ?>" required="required">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mname">Middle Name</label>
                                            <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $user_data->mname; ?>" required="required">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="lname">Last Name</label>
                                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $user_data->lname; ?>" required="required">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="gender">Sex</label>
                                            <select name="gender" id="gender" class="form-select custom-select-2">
                                                <option value="">Select Sex</option>
                                                <?php foreach ($genders as $gender): ?>
                                                    <?php $selected = $gender == $user_data->gender ? 'selected' : ''; ?>
                                                    <option value=<?php echo $gender; ?> <?php echo $selected; ?>><?php echo $gender; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $user_data->email; ?>" required="required">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="birthdate">Birth Date</label>
                                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $user_data->birthdate; ?>" required="required">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="placeob">Place of Birth</label>
                                            <input type="text" class="form-control" id="placeob" name="placeob" value="<?php echo $user_data->placeob; ?>" required="required">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phone">Phone 1</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user_data->phone; ?>" required="required">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phone2">Phone 2</label>
                                            <input type="text" class="form-control" id="phone2" name="phone2" value="<?php echo $user_data->phone2; ?>" required="required">
                                        </div>    
                                        <div class="form-group col-md-6">
                                            <label for="nationality">Nationality</label>
                                            <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $user_data->nationality; ?>" required="required">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="status">Civil Status</label>
                                            <select name="status" id="status" class="form-select custom-select-2">
                                                <option value="">Select Status</option>
                                                <?php foreach ($civil_status as $status): ?>
                                                    <?php $selected = $status == $user_data->status ? 'selected' : ''; ?>
                                                    <option value=<?php echo $status; ?> <?php echo $selected; ?>><?php echo $status; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="religion">Religion</label>
                                            <input type="text" class="form-control" id="religion" name="religion" value="<?php echo $user_data->religion; ?>" required="required">
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Government Issued Numbers
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="sss">SSS No.</label>
                                        <input type="text" class="form-control" id="sss" name="sss" value="<?php echo $user_data->sss; ?>" required="required">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="phno">PhilHealth No.</label>
                                        <input type="text" class="form-control" id="phno" name="phno" value="<?php echo $user_data->phno; ?>" required="required">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="hdmf">HDMF No.</label>
                                        <input type="text" class="form-control" id="hdmf" name="hdmf" value="<?php echo $user_data->hdmf; ?>" required="required">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="bir_no">BIR TIN</label>
                                        <input type="text" class="form-control" id="bir_no" name="bir_no" value="<?php echo $user_data->bir_no; ?>" required="required">
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- The addresses section starts here..... -->
        <section>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Present Address
                        </div>
                        <div class="card-body">
                            <div class="form-row" style="flex-direction: column;">
                                <div class="form-group col-md-12">
                                    <label for="bldg">Building Number/Name</label>
                                    <input type="text" class="form-control" id="bldg" name="bldg" value="<?php echo $user_data->bldg; ?>" required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="street">Street</label>
                                    <input type="text" class="form-control" id="street" name="street" value="<?php echo $user_data->street; ?>" required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="barangay">Barangay</label>
                                    <input type="text" class="form-control" id="barangay" name="barangay"value="<?php echo $user_data->barangay; ?>" required />
                                </div>
                                <div class="row col-12">
                                    <div class="form-group col-md-6">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city"value="<?php echo $user_data->city; ?>" required />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="zipcode">Zip Code</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode"value="<?php echo $user_data->zipcode; ?>" required />
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="province">Province</label>
                                    <input type="text" class="form-control" id="province" name="province"value="<?php echo $user_data->province; ?>" required />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="region">Region</label>
                                    <input type="text" class="form-control" id="region" name="region" value="<?php echo $user_data->region; ?>" required />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" value="<?php echo $user_data->country; ?>" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="card">
                        <div class="card-header" style="position: relative;">
                            Permanent Address
                            <div class="autofill-wrapper">
                                <input type="checkbox" name="autofill" id="autofill" style="margin-right: 5px;" <?php echo $autofill_checker; ?> />
                                <label for="autofill" style="line-height: 30px;">Same with present address</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row" style="flex-direction: column;">
                                <div class="form-group col-md-12">
                                    <label for="bldg1">Building Number/Name</label>
                                    <input type="text" class="form-control" id="bldg1" name="bldg1" value="<?php echo $user_data->bldg1; ?>" required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="street1">Street</label>
                                    <input type="text" class="form-control" id="street1" name="street1" value="<?php echo $user_data->street1; ?>" required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="barangay1">Barangay</label>
                                    <input type="text" class="form-control" id="barangay1" name="barangay1" value="<?php echo $user_data->barangay1; ?>" required />
                                </div>
                                <div class="row col-12">
                                    <div class="form-group col-md-6">
                                        <label for="city1">City</label>
                                        <input type="text" class="form-control" id="city1" name="city1" value="<?php echo $user_data->city1; ?>" required />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="zipcode1">Zip Code</label>
                                        <input type="text" class="form-control" id="zipcode1" name="zipcode1" value="<?php echo $user_data->zipcode1; ?>" required />
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="province1">Province</label>
                                    <input type="text" class="form-control" id="province1" name="province1" value="<?php echo $user_data->province1; ?>" required />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="region1">Region</label>
                                    <input type="text" class="form-control" id="region1" name="region1" value="<?php echo $user_data->region1; ?>" required />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="country1">Country</label>
                                    <input type="text" class="form-control" id="country1" name="country1" value="<?php echo $user_data->country1; ?>" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- This is the section for login Information -->
        <section>
            <div class="form-row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Login and Account Information
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="username">Username</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-fw fa-user"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_data->username; ?>" required="required">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <div class="input-group eye-holder mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-fw fa-key"></i></div>
                                        </div>
                                        <i class="fa-solid eye fa-eye-slash"></i>
                                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $user_data->password; ?>"  required/>
                                    </div>
                                </div>
                            <div class="form-group col-md-6">
                                <label for="deviceID">Employee ID</label>
                                <input type="text" class="form-control number" id="deviceID" name="deviceID" value="<?php echo $user_data->idd; ?>" required="required">
                            </div>
                            </div>               
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="card-header inner-card">
            <div class="form-row">
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-2">
                </div>
                <div class="form-group col-md-2 mt-4 button-right">
                    <input type="hidden" id="employeeID" value="<?php echo $user_data->id; ?>"/>
                    <button type="submit" class="btn btn-primary pm-blue btn-lg">Update Records</button>
                </div>
            </div>
        </div>
    <input type="hidden" name="uid" value="<?php echo $user_data->id; ?>" />
</form>

<!-- Upload Avatar Modal -->
<div class="modal fade" id="uploadAvatar" tabindex="-1" role="dialog" aria-labelledby="upload-avatar" aria-hidden="true">
  <div id="view-user-leave" class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-white" id="upload-avatar">Upload new Avatar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
              <div id="change-avatar"></div>
              <div id="croppie-actions">
                  <input type="file" id="upload" class="btn actionUpload btn-primary pm-blue btn-sm" value="Upload Avatar" accept="image/*" />
                  <a class="button actionSave btn btn-success btn-sm" data-id="<?php echo $user_data->id; ?>">Save Avatar</a>
              </div>
            </div>      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){

    console.log('Loading.......');

    // helper functions

    (function( $ ){
        $.fn.swapClass = function(oldClass, newClass) {
            let This = $(this);
            if (This.hasClass(oldClass)) {
                This.removeClass(oldClass).addClass(newClass);
            } else {
                This.removeClass(newClass).addClass(oldClass);
            }
        }; 
    })( $ );

    $('.eye').click(function() {
        let This = $(this);
        let Next = This.next();
        This.swapClass('fa-eye-slash', 'fa-eye');
        Next.attr('type') === 'password' ? Next.attr('type', 'text') : Next.attr('type', 'password');
    });

    $('#autofill').on('click', function() {
        let This = $(this);
        let bldg = $('#bldg');
        let bldg1 = $('#bldg1');
        let street = $('#street');
        let street1 = $('#street1');
        let barangay = $('#barangay');
        let barangay1 = $('#barangay1');
        let city = $('#city');
        let city1 = $('#city1');
        let zipcode = $('#zipcode');
        let zipcode1 = $('#zipcode1');
        let province = $('#province');
        let province1 = $('#province1');
        let region = $('#region');
        let region1 = $('#region1');
        let country = $('#country');
        let country1 = $('#country1');
        let address = $('#full_address');
        // let address1 = $('#full_address1');
        if (This.is(':checked')) {
            if (bldg.val() === '' || street.val() === '' || barangay.val() === '' || city.val() === '' || zipcode.val() === '' || province.val() === '' || region.val() === '' || country.val() === '' || address.val() === '') {
                alert('Please fill in the fields in Permanent Address section!');
                This.prop('checked', false);
            } else {
                bldg1.val(bldg.val());
                street1.val(street.val());
                barangay1.val(barangay.val());
                city1.val(city.val());
                zipcode1.val(zipcode.val());
                province1.val(province.val());
                region1.val(region.val());
                country1.val(country.val());
                // address1.val(address.val());
                This.prop('checked', true);
            }
        } else {
            bldg1.val('');
            street1.val('');
            barangay1.val('');
            city1.val('');
            zipcode1.val('');
            province1.val('');
            region1.val('');
            country1.val('');
            // address1.val('');
        }
    });

    // /* SPECIAL THANKS TO PH LOCATIONS JQUERY PLUGIN BY DARWIN BILER */

    // // initialize the plugin first, these dropdowns are for the current address section

    // $('#region').ph_locations({'location_type': 'regions'});
    // $('#province').ph_locations({'location_type': 'provinces'});
    // $('#city').ph_locations({'location_type': 'cities'});
    // $('#barangay').ph_locations({'location_type': 'barangays'});
    // $('#region1').ph_locations({'location_type': 'regions'});
    // $('#province1').ph_locations({'location_type': 'provinces'});
    // $('#city1').ph_locations({'location_type': 'cities'});
    // $('#barangay1').ph_locations({'location_type': 'barangays'});

    // // fill the dropdowns by passing the fetch_list parameter

    // $('#region').ph_locations('fetch_list');
    // $('#province').ph_locations('fetch_list');
    // $('#city').ph_locations('fetch_list');
    // $('#barangay').ph_locations('fetch_list');
    // $('#region1').ph_locations('fetch_list');
    // $('#province1').ph_locations('fetch_list');
    // $('#city1').ph_locations('fetch_list');
    // $('#barangay1').ph_locations('fetch_list');

    // // this is where the magic happens, the next dropdown value changes depending on the value of the previous dropdown

    // $('#region').on('change', function(){ 
    //     $('#province').ph_locations('fetch_list', [{"region_code": $(this).val()}]);
    //  });
    // $('#province').on('change', function(){
    //     $('#city').ph_locations('fetch_list', [{"province_code": $(this).val()}]);
    // });
    // $('#city').on('change', function(){ 
    //     $('#barangay').ph_locations('fetch_list', [{"city_code": $(this).val()}]);
    // });
    // $('#region1').on('change', function(){ 
    //     $('#province1').ph_locations('fetch_list', [{"region_code": $(this).val()}]);
    //  });
    // $('#province1').on('change', function(){
    //     $('#city1').ph_locations('fetch_list', [{"province_code": $(this).val()}]);
    // });
    // $('#city1').on('change', function(){ 
    //     $('#barangay1').ph_locations('fetch_list', [{"city_code": $(this).val()}]);
    // });
});
</script>