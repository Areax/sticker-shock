<?php require 'application/views/layouts/header.php'; ?>
<div class="container">
    <div class="h1">Edit Information<hr></div>
    <form action="/account/submit_edit" method="POST">
        <div class="form-group row">
            <div class="col-md-6">
                <input required class="form-control" type="text" name="firstname" placeholder="First Name" value="<?php echo $user->first_name;?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input required class="form-control" type="text" name="lastname" placeholder="Last Name" value="<?php echo $user->last_name;?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input required class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $user->email;?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input required class="form-control" type="email" name="paypal_email" placeholder="Paypal Email" value="<?php echo $user->paypal_email;?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input required type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $user->username;?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" value="" onkeyup='check();'>
            </div>
        </div>
        <div class="form-group row" id="confirm_pwd_row">
            <div class="col-md-6">
                <input type="password" class="form-control" name="confirm_password" id="confirm_password"  value="" placeholder="Confirm Password" onkeyup='check();'>
            </div>
            <div class="form-control-feedback" id="message"></div>
        </div>
        <p id="passwordHelpBlock" class="form-text text-muted">
            Password not required to update other account information.
        </p>
            <?php
            if(isset($_SESSION['username_taken_err']) &&  $_SESSION['username_taken_err'] != ''){
                echo '<p id="error">';
                echo $_SESSION['username_taken_err'];
                echo '</p>';
                $_SESSION['username_taken_err'] = '';
            }
            if(isset($_SESSION['email_taken_err']) &&  $_SESSION['email_taken_err'] != ''){
                echo '<p id="error">';
                echo $_SESSION['email_taken_err'];
                echo '</p>';
                $_SESSION['email_taken_err'] = '';
            }
            if(isset($_SESSION['pwd_match_err']) &&  $_SESSION['pwd_match_err'] != ''){
                echo '<p id="error">';
                echo $_SESSION['pwd_match_err'];
                echo '</p>';
                $_SESSION['pwd_match_err'] = '';
            }?>
        <div class="form-group">
                    <button type="submit" class="btn-ss btn-bw" name="submit">Save</button>
                    <button type="reset" class="btn-ss btn-bw" name="reset">Reset</button>
                    <a href="/account/index" class="btn-ss btn-bw" name="cancel">Cancel</a>
        </div>
    </form>
</div>
<?php require 'application/views/layouts/footer.php'; ?>