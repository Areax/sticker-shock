<?php require 'application/views/layouts/header.php'; ?>
    <div class="container">
        <div class="h1">Sign Up<hr></div>
            <form action="/account/submit_signup" method="POST">
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="text" class="form-control" name="firstname" placeholder="First Name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="text" class="form-control" name="lastname" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <select class="form-control" name="gender">
                            <option value="" disabled selected>Gender</option>
                            <option value="F">Female</option>
                            <option value="M">Male</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="address1" placeholder="Address 1">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="address2" placeholder="Address 2">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="city" placeholder="City">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="state" placeholder="State">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="zip" placeholder="Zip">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>