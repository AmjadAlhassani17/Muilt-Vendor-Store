<div class="container">
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h6 class="mb-2 text-primary">Personal Details</h6>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="">First Name</label>
                <x-form.input name='first_name' :value='$user->profile->first_name' placeholder="Enter First Name"/>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="">Last Name</label>
                <x-form.input name='last_name' :value='$user->profile->last_name' placeholder="Enter Last Name"/>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="">Birthday</label>
                <x-form.input type="date" name='birthday' :value='$user->profile->birthday'/>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="">Gender</label>
                <x-form.radio name='gender' :options="['male' => 'Male' , 'female' => 'Female']" :checked='$user->profile->gender'/>
            </div>
        </div>
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h6 class="mt-3 mb-2 text-primary">Address</h6>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="">Street</label>
                <x-form.input name='street_address' :value='$user->profile->street_address' placeholder="Enter Street"/>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="">City</label>
                <x-form.input name='city' :value='$user->profile->city' placeholder="Enter City"/>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="">State</label>
                <x-form.input name='state' :value='$user->profile->state' placeholder="Enter State"/>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="">Postal Code</label>
                <x-form.input name='postal_code' :value='$user->profile->postal_code' placeholder="Enter Postal Code"/>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="">Country</label>
                <x-form.s-select name='country' :options='$countries' :selected='$user->profile->country' nothingOption="" />
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="">Locale</label>
                <x-form.s-select name='local' :options='$locales' :selected='$user->profile->local' nothingOption=""/>
            </div>
        </div>
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
            <div class="text-right">
                <a href="{{ route('dashboard') }}" class="mr-4">Cancel</a>
                <button name="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
