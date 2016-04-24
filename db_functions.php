<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        include_once './db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $gcm_regid) {
        global $conn; // اسم الكونيكشن بتاعك ايه و حطي اسمه الل هو $conn = mysqli_connect($servername, $username, $password, $dbname);

        // insert user into database
        $result = "INSERT INTO users(name, email, gcm_regid, created_at) VALUES('$name', '$email', '$gcm_regid', NOW())";
        // check for successful store
       if ($conn->query($result) === TRUE) {
    echo "New record created successfully";
            // get user details
            $id = mysqli_insert_id($conn); // last inserted id
            $query = "SELECT * FROM users WHERE id = $id" or die(mysql_error());
            // return user details
			$result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                return mysqli_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Get user by email and password
     */
    public function getUserByEmail($email) {
        $result = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        return $result;
    }

    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysqli_query($result,"select * FROM users");
        return $result;
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = "SELECT email from users WHERE email = '$email'";
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }

    public function getGcmID($email) {
        $result = "SELECT * from users WHERE email = '$email'";
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {
            
            $user_details = ($result);

            return $user_details['gcm_regid'] ;
        } else {
            // user not existed
            return "";
        }
    }


}

?>