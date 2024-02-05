<div class="card mb-3">
    <div class="card-header">
    Personal Information
    </div>
    <div class="card-body">
    <div class="form-row">
        <div class="form-group col-md-4">
        <label for="fname">First Name</label>
        <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" required="required">
        </div>
        <div class="form-group col-md-4">
        <label for="mname">Middle Name</label>
        <input type="text" class="form-control" id="mname" placeholder="Middle Name" name="mname" required="required">
        </div>
        <div class="form-group col-md-4">
        <label for="lname">Last Name</label>
        <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" required="required">
        </div>
        <div class="form-group col-md-6 d-none">
            <label for="title">Title</label>
            <select name="title" id="title" class="form-control custom-select-2">
                <option value="">Select Title</option>
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="gender">Sex</label>
            <select name="gender" id="gender" class="form-control custom-select-2">
                <option value="">Select Sex</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="birthdate">Birth Date</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="placeob">Place of Birth</label>
            <input type="text" class="form-control" id="placeob" name="placeob" placeholder="Place of birth" required="required">
        </div>
        <div class="form-group col-md-6">
        <label for="phone">Phone 1</label>
        <input type="phone" class="form-control" id="phone" placeholder="Phone 1" name="phone" required="required">
        </div>
        <div class="form-group col-md-6">
          <label for="phone2">Phone 2</label>
          <input type="text" class="form-control" id="phone2" name="phone2" placeholder="Phone 2" value="" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="nationality">Nationality</label>
            <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Nationality" value="<?php echo $user_data->nationality; ?>" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="status">Civil Status</label>
            <select name="status" id="status" class="form-control custom-select-2">
                <option value="">Select Status</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Separated">Separated</option>
                <option value="Widowed">Widowed</option>
                <option value="Divorced">Divorced</option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="religion">Religion</label>
            <input type="text" class="form-control" id="religion" placeholder="Religion" name="religion" required="required" />
        </div>
        <div class="form-group col-md-12">
        <label for="deviceID">Biometric ID</label>
        <input type="text" class="form-control number" id="deviceID" placeholder="000000" name="deviceID" required="required">
        </div>
        <div class="form-group col-md-12">
        <label for="bnkAcct">Bank Account Number</label>
        <input type="text" class="form-control" id="bnkAcct" placeholder="1111-2222-33" name="bnkAcct" required="required">
        </div>
    </div>
    <h6>Login Information</h6>
    <div class="form-row">
        <div class="col-md-12">
        <label class="sr-only" for="username">Username</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-fw fa-user"></i></div>
            </div>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="required">
        </div>
        </div>
        <div class="col-md-12">
        <label class="sr-only" for="password">Password</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-fw fa-key"></i></div>
            </div>
            <input type="password" class="form-control" id="password" name="password" placeholder="password" required="required">
        </div>
        </div>
    </div>
    </div> <!-- Tax Information Wrapper -->
</div>