<?php require 'application/views/layouts/header.php';
$post = null;
if(isset($_SESSION['POST'])){
    $post = $_SESSION['POST'];
    unset($_SESSION['POST']);
}
?>
    <div class="container">
        <div class="h1">Sign Up<hr></div>
            <form action="/account/submit_signup" method="POST">
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php if($post != null) echo $post['firstname']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?php if($post != null) echo $post['lastname']?>">
                    </div>
                </div>
                <div class="form-group row <?php if(isset($_SESSION['email_taken_err']) &&  $_SESSION['email_taken_err'] != ''){ echo 'has-danger';}?>">
                    <div class="col-md-6">
                        <input required type="email" class="form-control" name="email" placeholder="Email" value="<?php if($post != null) echo $post['email']?>">
                    </div>
                    <div class="form-control-feedback" id="email_err">
                        <?php
                        if(isset($_SESSION['email_taken_err']) &&  $_SESSION['email_taken_err'] != ''){
                            echo '<p id="error">';
                            echo $_SESSION['email_taken_err'];
                            echo '</p>';
                            $_SESSION['email_taken_err'] = '';
                        }?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="email" class="form-control" name="paypal_email" placeholder="PayPal Email" value="<?php if($post != null) echo $post['paypal_email']?>">
                    </div>
                </div>
                <div class="form-group row <?php if(isset($_SESSION['username_taken_err']) &&  $_SESSION['username_taken_err'] != ''){ echo 'has-danger';}?>">
                    <div class="col-md-6">
                        <input required type="text" class="form-control" name="username" placeholder="Username" value="<?php if($post != null) echo $post['username']?>">
                    </div>
                    <div class="form-control-feedback" id="username_err">
                        <?php
                        if(isset($_SESSION['username_taken_err']) &&  $_SESSION['username_taken_err'] != ''){
                            echo '<p id="error">';
                            echo $_SESSION['username_taken_err'];
                            echo '</p>';
                            $_SESSION['username_taken_err'] = '';
                        }?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="password" class="form-control" name="password" id="password" placeholder="Password" onkeyup='check();'>
                    </div>
                </div>
                <div class="form-group row" id="confirm_pwd_row">
                    <div class="col-md-6">
                        <input required type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" onkeyup='check();'>
                    </div>
                    <div class="form-control-feedback" id="message">
                        <?php
                            if(isset($_SESSION['pwd_match_err']) &&  $_SESSION['pwd_match_err'] != ''){
                                echo '<p id="error">';
                                echo $_SESSION['pwd_match_err'];
                                echo '</p>';
                                $_SESSION['pwd_match_err'] = '';}?>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-ss btn-bw"" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>