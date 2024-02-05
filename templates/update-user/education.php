<div id="education" class="card mb-3 inner-card"> 
    <div class="card-header inner-card">
        <div class="form-row">
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2 button-right">
                <input type="hidden" value="<?php echo $user_data->id; ?>"/>
                <button type="button" class="btn btn-primary pm-blue btn-lg" data-toggle="modal" data-target="#educationAddNew"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Add New</button>
            </div>
        </div>
    </div>
    <div class="card-body inner-card">
        <!-- Table -->
        <section>
            <table id = "ed-info" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Degree</th>
                        <th class="th-sm">Name of University</th>
                        <th class="th-sm">Major</th>
                        <th class="th-sm">Ranking</th>
                        <th class="th-sm">Issue Date</th>
                        <th class="th-sm">Remark</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Information Technology</td>
                        <td>Harvard University</td>
                        <td>Network Technology</td>
                        <td>Cum Laude</td>
                        <td>2022/03/31</td>
                        <td>Remarkable</td>
                    </tr>
                    <tr>
                        <td>Information Technology</td>
                        <td>Harvard University</td>
                        <td>Network Technology</td>
                        <td>Cum Laude</td>
                        <td>2022/03/31</td>
                        <td>Remarkable</td>
                    </tr>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </section>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        $('#ed-info').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
</script>