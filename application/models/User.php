<?php
class User extends Model {
    public $error;

    public function createUser($username, $fname, $lname, $email, $password, $paypal_email){
        $stmt = $this->db->prepare("INSERT INTO Accounts (username, first_name, last_name, email, password, paypal_email) 
          VALUES (:username, :firstname, :lastname, :email, :password, :paypal_email)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':firstname', $fname);
        $stmt->bindParam(':lastname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':paypal_email', $paypal_email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }

    public function readUser($id){
        $statement = $this->db->prepare("SELECT * from Accounts where user_id = :userId");
        $statement->bindParam(':userId',$id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }
    public function getPurchase($order_id){
        $statement = $this->db->prepare("SELECT * FROM ItemOrders INNER JOIN Items ON ItemOrders.item_id=Items.item_id INNER JOIN Orders ON Orders.order_id = ItemOrders.order_id where Orders.order_id = :orderid");
        $statement->bindParam(':orderid',$order_id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }

    public function updateUser($id,$fname,$lname,$email,$hashpass, $paypal_email){
        $sql = "UPDATE Accounts SET first_name = :firstname,last_name = :lastname,email = :email,";
        if($hashpass != "")
            $sql .= "password = :password";
        $sql .= ", paypal_email = :paypal_email WHERE user_id = :user_id";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':user_id',$id);
        $stmt->bindParam(':firstname', $fname);
        $stmt->bindParam(':lastname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':paypal_email', $paypal_email);
        if($hashpass != "")
            $stmt->bindparam(':password', $hashpass);
        $stmt->execute();
    }

    public function deleteUser(){

    }

    public function authenticate($username, $password){
        $error = '';
        $statement = $this->db->prepare("SELECT * from Accounts WHERE username = :username");
        $statement->bindParam(':username', $username);
        $statement->execute();
        $result = $statement->fetch();
        if(count($result) > 0 && password_verify($password, $result->password)){
            $_SESSION['username'] = $result->username;
            $_SESSION['id'] = $result->user_id;
        }
        else{
            $error = 'Username and password combination are invalid<br>';
        }
        return $error;
    }

    public function validateRegistration($username, $email, $password, $confirm_password) {
        $username_stmt = $this->db->prepare("SELECT * from Accounts WHERE username = :username");
        $username_stmt->bindParam(':username', $username);
        $username_stmt->execute();
        $username_result = $username_stmt->fetchAll();
        if(count($username_result) > 0){
            $_SESSION['username_taken_err'] = 'Username is taken';
        }
        if($password != $confirm_password)
            $_SESSION['pwd_match_err'] = 'Passwords do not match';
        $statement = $this->db->prepare("SELECT * from Accounts WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        $result = $statement->fetchAll();
        if(count($result) > 0){
            $_SESSION['email_taken_err'] = 'An account already exists with this email address';
        }
    }

    public function validateEdit($id, $username, $email, $password, $confirm_password) {
        $username_stmt = $this->db->prepare("SELECT * from Accounts WHERE username = :username");
        $username_stmt->bindParam(':username', $username);
        $username_stmt->execute();
        $username_result = $username_stmt->fetch();
        if(count($username_result) > 0 && $username_result->user_id != $id){
            $_SESSION['username_taken_err'] = 'Username is taken';
        }
        if($password != $confirm_password)
            $_SESSION['pwd_match_err'] = 'Passwords do not match';
        $statement = $this->db->prepare("SELECT * from Accounts WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        $result = $statement->fetch();
        if(count($result) > 0 && $result->user_id != $id){
            $_SESSION['email_taken_err'] = 'An account already exists with this email address';
        }
    }

    //get all order and item infomation from userid
    public function getOrderFromUser($id){
        $statement = $this->db->prepare("SELECT * FROM ItemOrders INNER JOIN Items ON ItemOrders.item_id=Items.item_id INNER JOIN Orders ON Orders.order_id = ItemOrders.order_id where Orders.account_id = :id");
        
        $statement->bindParam(':id',$id);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    //get sale list
    public function getSaleList($userid){
        $statement = $this->db->prepare("SELECT * FROM Items WHERE account_id = :id");
        $statement->bindParam(':id',$userid);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    //get all item that user is selling and sold
    public function getItemsByUser($user_id) {
        $sql = "SELECT * FROM Items WHERE account_id='$user_id'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}

