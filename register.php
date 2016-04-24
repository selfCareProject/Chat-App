<?php

// response json
$json = array();

/**
 * Registering a user device
 * Store reg id in users table
 */
 
 $name = $_GET["name"];
    $email = $_GET["email"];
    $gcm_regid = $_GET["regId"]; 
	
	
if (isset($name) && isset($email) && isset($gcm_regid)) {
    // GCM Registration ID
    // Store user details in db
    include_once './db_functions.php';
    include_once './GCM.php';

    $db = new DB_Functions();
    $gcm = new GCM();

    $res = $db->storeUser($name, $email, $gcm_regid);

    if($res){

        echo "success";

    }else{

        echo "failure";
    }

    
} else {
    // user details missing
    echo "missing";
}
?>