<?php
$qualification     = new Qualification;
$user_id           = $user_data->id;
$course_list       = array("Agriculture, General", "Agribusiness Operations", "Agricultural Business & Management", "Agricultural Economics", "Agricultural Mechanization", "Agricultural Production", "Agronomy & Crop Science", "Animal Sciences", "Food Sciences & Technology", "Horticulture Operations & Management", "Horticulture Science", "Natural Resources Conservation, General", "Environmental Science", "Forestry", "Natural Resources Management", "Wildlife & Wildlands Management", "Architecture, General", "Architectural Environmental Design", "City/Urban/Regional Planning", "Interior Architecture", "Landscape Architecture", "Area Studies, General (e.g., African, Middle Eastern)", "Asian Area Studies", "European Area Studies", "Latin American Area Studies", "North American Area Studies", "Ethnic & Minority Studies, General", "African American Studies", "American Indian/Native American Studies", "Latino/Chicano Studies", "Women's Studies", "Liberal Arts & General Studies", "Library Science", "Multi/Interdisciplinary Studies", "Art, General", "Art History, Criticism & Conservation", "Fine/Studio Arts", "Cinema/Film", "Cinematography/Film/Vide Production", "Dance", "Design & Visual Communications, General", "Fashion/Apparel Design", "Graphic Design", "Industrial Design", "Interior Design", "Music, General", "Music, Performance", "Music, Theory & Composition", "Photography", "Theatre Arts/Drama", "Accounting", "Accounting Technician", "Business Administration & Management, General", "Hotel/Motel Management", "Human Resources Development/Training", "Human Resources Management", "International Business Management", "Labor/Industrial Relations", "Logistics & Materials Management", "Marketing Management & Research", "Office Supervision & Management", "Operations Management & Supervision", "Organizational Behavior", "Purchasing/Procurement/Contracts Management", "Restaurant/Food Services Management", "Small Business Management/Operations", "Travel/Tourism Management", "Business/Management Quantitative Methods, General", "Actuarial Science", "Business/Managerial Economics", "Finance, General", "Banking & Financial Support Services", "Financial Planning & Services", "Insurance & Risk Management", "Investments & Securities", "Management Information Systems", "Real Estate", "Sales, Merchandising, & Marketing, General", "Fashion Merchandising", "Tourism & Travel Marketing", "Secretarial Studies & Office Administration", "Communications, General", "Advertising", "Digital Communications/Media", "Journalism, Broadcast", "Journalism, Print", "Mass Communications", "Public Relations & Organizational Communication", "Radio & Television Broadcasting", "Communications Technology, General", "Graphic & Printing Equipment Operation", "Multimedia/Animation/Special Effects", "Radio & Television Broadcasting Technology", "Family & Consumer Sciences, General", "Adult Development & Aging/Gerontology", "Child Care Services Management", "Child Development", "Consumer & Family Economics", "Food & Nutrition", "Textile & Apparel", "Parks, Recreation, & Leisure, General", "Exercise Science/Physiology/Kinesiology", "Health & Physical Education/Fitness", "Parks/Rec/Leisure Facilities Management", "Sport & Fitness Administration/Management", "Personal Services, General", "Cosmetology/Hairstyling", "Culinary Arts/Chef Training", "Funeral Services & Mortuary Science", "Protective Services, General", "Corrections", "Criminal Justice", "Fire Protection & Safety Technology", "Law Enforcement", "Military Technologies", "Public Administration & Services, General", "Community Organization & Advocacy", "Public Administration", "Public Affairs & Public Policy Analysis", "Social Work", "Computer & Information Sciences, General", "Computer Networking/Telecommunications", "Computer Science & Programming", "Computer Software & Media Applications", "Computer System Administration", "Data Management Technology", "Information Science", "Webpage Design", "Mathematics, General", "Applied Mathematics", "Statistics", "Counseling & Student Services", "Educational Administration", "Special Education", "Teacher Education, General", "Curriculum & Instruction", "Early Childhood Education", "Elementary Education", "Junior High/Middle School Education", "Postsecondary Education", "Secondary Education", "Teacher Assisting/Aide Education", "Teacher Education, Subject-Specific", "Agricultural Education", "Art Education", "Business Education", "Career & Technical Education", "English-as-a-Second-Language Education", "English/Language Arts Education", "Foreign Languages Education", "Health Education", "Mathematics Education", "Music Education", "Physical Education & Coaching", "Science Education", "Social Studies/Sciences Education", "Engineering (Pre-Engineering), General", "Aerospace/Aeronautical Engineering", "Agricultural/Bioengineering", "Architectural Engineering", "Biomedical Engineering", "Chemical Engineering", "Civil Engineering", "Computer Engineering", "Construction Engineering/Management", "Electrical, Electronics & Communications Engineering", "Environmental Health Engineering", "Industrial Engineering", "Mechanical Engineering", "Nuclear Engineering", "Drafting/CAD Technology, General", "Architectural Drafting/CAD Technology", "Mechanical Drafting/CAD Technology", "Engineering Technology, General", "Aeronautical/Aerospace Engineering Technologies", "Architectural Engineering Technology", "Automotive Engineering Technology", "Civil Engineering Technology", "Computer Engineering Technology", "Construction/Building Technology", "Electrical, Electronics Engineering Technologies", "Electromechanical/Biomedical Engineering Technologies", "Environmental Control Technologies", "Industrial Production Technologies", "Mechanical Engineering Technology", "Quality Control & Safety Technologies", "Surveying Technology", "English Language & Literature, General", "American/English Literature", "Creative Writing", "Public Speaking", "Foreign Languages/Literatures, General", "Asian Languages & Literatures", "Classical/Ancient Languages & Literatures", "Comparative Literature", "French Language & Literature", "German Language & Literature", "Linguistics", "Middle Eastern Languages & Literatures", "Spanish Language & Literature", "Health Services Administration,General", "Hospital/Facilities Administration", "Medical Office/Secretarial", "Medical Records", "Medical/Clinical Assisting, General", "Dental Assisting", "Medical Assisting", "Occupational Therapy Assisting", "Physical Therapy Assisting", "Veterinarian Assisting/Technology", "Chiropractic (Pre-Chiropractic)", "Dental Hygiene", "Dentistry (Pre-Dentistry)", "Emergency Medical Technology", "Health-Related Professions & Services, General", "Athletic Training", "Communication Disorder Services (e.g., Speech Pathology)", "Public Health", "Health/Medical Technology, General", "Medical Laboratory Technology", "Medical Radiologic Technology", "Nuclear Medicine Technology", "Respiratory Therapy Technology", "Surgical Technology", "Medicine (Pre-Medicine)", "Nursing, Practical/Vocational (LPN)", "Nursing, Registered (BS/RN)", "Optometry (Pre-Optometry)", "Osteopathic Medicine", "Pharmacy (Pre-Pharmacy)", "Physician Assisting", "Therapy & Rehabilitation, General", "Alcohol/Drug Abuse Counseling", "Massage Therapy", "Mental Health Counseling", "Occupational Therapy", "Physical Therapy (Pre-Physical Therapy)", "Psychiatric/Mental Health Technician", "Rehabilitation Therapy", "Vocational Rehabilitation Counseling", "Veterinary Medicine (Pre-Veterinarian)", "Philosophy", "Religion", "Theology, General", "Bible/Biblical Studies", "Divinity/Ministry", "Religious Education", "Aviation & Airway Science, General", "Aircraft Piloting & Navigation", "Aviation Management & Operations", "Construction Trades (e.g., carpentry, plumbing, electrical)", "Mechanics & Repairers, General", "Aircraft Mechanics/Technology", "Autobody Repair/Technology", "Automotive Mechanics/Technology", "Avionics Technology", "Diesel Mechanics/Technology", "Electrical/Electronics Equip Installation & Repair", "Heating/Air Cond/Refrig Install/Repair", "Precision Production Trades, General", "Machine Tool Technology", "Welding Technology", "Transportation & Materials Moving (e.g., air, ground, & marine)", "Biology, General", "Biochemistry & Biophysics", "Cell/Cellular Biology", "Ecology", "Genetics", "Marine/Aquatic Biology", "Microbiology & Immunology", "Zoology", "Physical Sciences, General", "Astronomy", "Atmospheric Sciences & Meteorology", "Chemistry", "Geological & Earth Sciences", "Physics", "Legal Studies, General", "Court Reporting", "Law (Pre-Law)", "Legal Administrative Assisting/Secretarial", "Paralegal/Legal Assistant", "Social Sciences, General", "Anthropology", "Criminology", "Economics", "Geography", "History", "International Relations & Affairs", "Political Science & Government", "Psychology, Clinical & Counseling", "Psychology, General", "Sociology", "Urban Studies/Urban Affairs");
$profeciency_level = array("NA - Not Applicable", "1 - Fundamental Awareness (basic knowledge)", "2 - Novice (limited experience)", "3 - Intermediate (practical application)", "4 - Advanced (applied theory)", "5 - Expert (recognized authority)");
$education_data    = $qualification->get_education_data($user_id);
$degrees           = array("Undergraduate", "Associate's", "Bachelor's", "Master's", "Doctorate", "Non-Degree Courses", "Certificate/Diploma", "Graduate Certificates", "Bootcamps");
?>
<div id="education" class="card mb-3 inner-card">
    <div class="card-header inner-card">
        <div class="form-row">
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2 button-right">
                <input type="hidden" id="employeeID" value="<?php echo $user_id; ?>"/>
                <button type="button" class="btn btn-primary pm-blue btn-lg d-none" id="euModalBtn" data-toggle="modal" data-target="#educationUpdate">Update</button>
                <button type="button" class="btn btn-primary pm-blue btn-lg" data-toggle="modal" data-target="#educationAddNew"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Add New</button>
            </div>
        </div>
    </div>
    <div class="card-body inner-card">
        <!-- Table -->
        <section>
            <table id="ed-info" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm dark-blue">Degree</th>
                        <th class="th-sm dark-blue">Name of University</th>
                        <th class="th-sm dark-blue">Major</th>
                        <th class="th-sm dark-blue">Ranking</th>
                        <th class="th-sm dark-blue">Issue Date</th>
                        <th class="th-sm dark-blue">Remark</th>
                        <th class="th-sm dark-blue">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($education_data as $key => $value) : ?>
                        <tr>
                            <td><?php echo $value->degree; ?></td>
                            <td><?php echo $value->uni_name; ?></td>
                            <td><?php echo $value->major; ?></td>
                            <td><?php echo $value->rank; ?></td>
                            <td><?php echo $value->issue_date; ?></td>
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

<!-- Add new contacts modal starts here... -->
<div class="modal fade" id="educationAddNew" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class = "inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white">Add New Education</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id = "educationAddForm">
                    <div class="form-row">
                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="degree">Degree</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <select name="degree" id="degree" class="custom-select-2">
                                        <option value="">Select Degree</option>
                                        <?php foreach ( $degrees as $degree ): ?>
                                            <option value="<?php echo $degree ?>"><?php echo $degree ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>    
                            </div>                    
                        </div>

                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="uni_name">Name of University</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="uni_name" placeholder="Name of University" name="uni_name" value="" required />
                                </div> 
                            </div>                       
                        </div>

                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="major">Major</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <select class = "form-control custom-select-2" name="major" id = "major">
                                        <option>Select Major</option>
                                        <?php foreach($course_list as $course): ?>
                                            <option><?php echo $course; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> 
                            </div>                       
                        </div>

                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="rank">Ranking</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <select class = "form-control custom-select-2" name="rank" id = "rank">
                                        <option>Select Levels</option>
                                        <?php foreach($profeciency_level as $levels): ?>
                                            <option><?php echo $levels; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>                      
                        </div>

                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="educ_issue_date">Issue Date</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="date" class="form-control" id="educ_issue_date" placeholder="Issue Date" name="issue_date" value="" required />
                                </div>
                            </div>                      
                        </div>

                        <div class="form-group col-md-12 modal-inner-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="educ_remarks">Remark</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="educ_remarks" placeholder="Remark" name="remark" value="" />
                                </div>
                            </div>                      
                        </div>
                        <input type="hidden" id="employeeID" name="uid" value="<?php echo $user_id; ?>"/>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="close_education_modal" class="btn btn-primary pm-blue" data-dismiss="modal">Close</button>
                <button type="submit" id="add_education" class="btn btn-primary pm-blue">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Add new contacts modal starts here... -->
<div class="modal fade" id="educationUpdate" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class = "inner-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                    <h5 class="modal-title text-white">Update Education</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="educationUpdateForm">
                    
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="close_ue_modal" class="btn btn-primary pm-blue" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary pm-blue">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        let educationTable = $('#ed-info').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>