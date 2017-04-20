<?php

class Account extends Controller {
    public function index() {
        $this->title = 'Account';

        $user = null;
        # Graham L.:
        # If user is logged in, fetch their page.
        # If they aren't redirect to login page.
        if (isset($_SESSION['username'])) {
            require 'application/models/Item.php';
            require 'application/models/Order.php';
            $order_helper = new Order($this->db);
            $user = $this->model->readUser($_SESSION['id']);
            $orders = $this->model->getOrderFromUser($_SESSION['id']);
            $listings = $this->model->getSaleList($_SESSION['id']);
            $items = new Item($this->db);
            require 'application/models/Review.php';
            require 'application/views/account/index.php';
        } else {
            header('location: /account/login');
        }
    } 

    public function login() {
        if (isset($_GET['page'])) {
            $url = trim($_GET['page'], ',');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode(',',$url); 
        }
        if(isset($_SERVER['HTTP_REFERER']))
            $_SESSION['http_ref'] = $_SERVER['HTTP_REFERER'];
        $this->title = 'Log In';
        require 'application/views/account/login.php';
    }

    public function submit_login(){
        $_SESSION['login_error'] = '';
        if(!isset($_POST['username'])) {
            $this->login();
            return;
        }
        $username=filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password=filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $error = $this->model->authenticate($username, $password);
        if(isset($_SESSION['username'])){
            if (isset($_POST['url'])) {
                header('location: ' . $_POST['url']);
            } else {
                header('location: /account');
            }
        }
        else{
            $_SESSION['login_error'] = $error;
            $this->login();
        }

    }

    public function signup() {
        $this->title = 'Sign Up';
        require 'application/views/account/signup.php';
    }

    public function edit(){
        $this->title = 'Edit Account Information';
        $user = $this->model->readUser($_SESSION['id']);
        require 'application/views/account/edit.php';

    }
    public function submit_edit(){
        $fname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $paypal_email = filter_input(INPUT_POST, 'paypal_email', FILTER_SANITIZE_EMAIL);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
        $hashpass = password_hash($password, PASSWORD_DEFAULT);
        $this->model->validateEdit($_SESSION['id'], $username, $email, $password, $confirm_password);
        if((isset($_SESSION['username_taken_err']) && $_SESSION['username_taken_err'] != '') || (isset($_SESSION['email_taken_err']) && $_SESSION['email_taken_err'] != '') || (isset($_SESSION['pwd_match_err']) && $_SESSION['pwd_match_err'] != '')) {
            $this->edit();
        }
        else {
            $this->model->updateUser($_SESSION['id'], $fname, $lname, $username, $email, $password, $hashpass, $paypal_email);
            $this->index();
        }
    }

    public function submit_signup() {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $fname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $paypal_email = filter_input(INPUT_POST, 'paypal_email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
        $hashpass = password_hash($password, PASSWORD_DEFAULT);
        $this->model->validateRegistration($username, $email, $password, $confirm_password);
        if((isset($_SESSION['username_taken_err']) && $_SESSION['username_taken_err'] != '') || (isset($_SESSION['email_taken_err']) && $_SESSION['email_taken_err'] != '') || (isset($_SESSION['pwd_match_err']) && $_SESSION['pwd_match_err'] != '')) {
            $_SESSION['POST'] = $_POST;
            $this->signup();
        }
        else {
            $this->model->createUser($username, $fname, $lname, $email, $hashpass, $paypal_email);
            $this->login();
        }
    }

    public function logout(){
        session_destroy();
        header('location: /');
    }

    public function sell(){
        $arr = Category::getConstants();
        $arr2 = Subcategory::getConstants();
        if(isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $this->title = "Sell";
            require 'application/views/account/sell.php';
        } else{
            $_SESSION['login_error'] = 'You must be logged in to complete this action';
            header('location: /account/login?page=account,sell');
        }
    }

    public function profile($user_id) {
        require 'application/models/Review.php';
        require 'application/models/Order.php';
        $users = $this->model;
        $user = $this->model->readUser($user_id);
        $listings = $this->model->getItemsByUser($user_id);
        $review = new Review($this->db);
        $reviews = $review->getReviewsByUser($user->user_id);
        $this->title = $user->username . '\'s Account History';
        require 'application/views/account/profile.php';

    }


    public function writeReview($orderId){


    }
    public function deleteReview($reviewId){
        require 'application/models/Review.php';
        $review = new Review($this->db);
        $review->deleteReview($reviewId);
        header('location: /account/');

    }

    public function invoice($orderId){
        if(!$orderId)
            require 'application/views/pages/error.php';
        else {
            require 'application/models/Order.php';
            require 'application/models/Item.php';
            $this->title = 'Invoice';
            $invoice = $this->model->getPurchase($orderId);
            $order_helper = new Order($this->db);
            $details = $order_helper->getItemIdFromOrderId($orderId);
            $item_helper = new Item($this->db);
            $item = $item_helper->getItemById($details->item_id);
            $seller_account = $this->model->readUser($item->account_id);
            $buyer_account = $this->model->readUser($order_helper->getAccountByOrderId($orderId)->account_id);
            require 'application/views/account/invoice.php';

        }
    }

    public function loadModel() {
        require 'application/models/User.php';
        $this->model = new User($this->db);
        return;
    }
}