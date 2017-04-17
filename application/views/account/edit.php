<?php require 'application/views/layouts/header.php'; ?>
<div class="container">
    <div class="h1">Edit Information<hr></div>
    <form action="/account/submit_edit" method="POST">
        <div class="form-group row">
            <div class="col-md-6">
                <input required class="form-control" type="text" name="firstname" placeholder="First Name" value="<?= $user->first_name;?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input required class="form-control" type="text" name="lastname" placeholder="Last Name" value="<?= $user->last_name;?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input required class="form-control" type="email" name="email" placeholder="Email" value="<?= $user->email;?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input required class="form-control" type="email" name="paypal_email" placeholder="Paypal Email" value="<?= $user->paypal_email;?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <select class="form-control" name="gender" >
                    <?php
                    if($user->gender === 'M'){
                    ?>
                    <option value="F">Female</option>
                    <option selected value="M">Male</option>
                    <?php
                    }
                    else{
                    ?>
                    <option selected value="F">Female</option>
                    <option value="M">Male</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input class="form-control" type="text" name="address1" placeholder="Address 1" value="<?= $user->address_1;?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input class="form-control" type="text" name="address2" placeholder="Address 2" value="<?= $user->address_2;?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <input class="form-control" type="text" name="city" placeholder="City" value="<?= $user->city;?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input class="form-control" type="text" name="state" placeholder="State" value="<?= $user->state;?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input class="form-control" type="text" name="zip" placeholder="Zip" value="<?= $user->zip;?>">
            </div>
        </div>
        <?php
        if(isset($_SESSION['email_taken_err']) &&  $_SESSION['email_taken_err'] != ''){
            echo '<p id="error">';
            echo $_SESSION['email_taken_err'];
            echo '</p>';
            $_SESSION['email_taken_err'] = '';
        }?>
        <div class="form-group">
                    <button type="submit" class="btn-ss btn-bw" name="submit">Save</button>
                    <button type="reset" class="btn-ss btn-bw" name="reset">Reset</button>
                    <a href="/account/index" class="btn-ss btn-bw" name="cancel">Cancel</a>
        </div>
    </form>
</div>
<?php require 'application/views/layouts/footer.php'; ?>