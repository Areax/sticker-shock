<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>STICKERSHOCK - <?php echo $this->title; ?></title>

        <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700|Montserrat|Open+Sans:300,400,400i,700" rel="stylesheet">
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/shop-homepage.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="/images/logo.png">

        <script src="/js/jquery.js"></script>
        <script src="/js/tether.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script>
            var check = function() {
                if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
                    document.getElementById('message').innerHTML = '';
                    var d = document.getElementById('confirm_pwd_row');
                    d.className = "form-group row";
                } else {
                    var d = document.getElementById('confirm_pwd_row');
                    d.className = "form-group row has-danger";
                    document.getElementById('message').innerHTML = 'Passwords do not match';
                }
            }
        </script>
    </head>
    <body>
    <?php include "application/views/includes/navigation.php"?>

