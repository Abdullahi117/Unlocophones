<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$firstName = $lastName = $address = $phoneNumber = $username = $email = $password1 = $password2 = "";
$firstNameErr = $lastNameErr = $addressErr = $phoneNumberErr= $usernameErr = $emailErr = $password1Err = $password2Err = "";

//establish connection with database
$mysqli = new mysqli('localhost', 'ics325sp2132', '6735', 'ics325sp2132');
if($mysqli->connect_errno) {
    //error if connection fails
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
    
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $test = true;
    $firstName = $mysqli->real_escape_string($_POST['firstName']);
    $lastName = $mysqli->real_escape_string($_POST['lastName']);
    $username = $mysqli->real_escape_string($_POST['username']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = ($_POST['username']);
   }

   //Udpate Query 
   $sql = "UPDATE customer " .
   "SET first_name = '$firstName', last_name = '$lastName', email = '$email'" . 
   " WHERE customer_id = 4";

   if ($mysqli->query($sql) === true) {
    $_SESSION['message'] = "Update Complete!";
    } else {
    $_SESSION['message'] = "Could not connect to the database";
}             
?>

<?php include "header.php"; ?>

<body>
    <div class="container9">

        <div class="accountinfos">
            <h1 class="accountinfo">Account Info</h1>
            <h2 class="fstname">First Name</h2>
            <input type="text" class="input" value="">
            <h2 class="lstname">Last Name</h2>
            <input type="text" class="input" value="">
            <h2 class="emala">Email </h2>
            <input type="text" class="input" value="">
            <h2 class="adressa">Address</h2>
            <input type="text" class="input" value="">
            <h2 class="ordera">Order ID</h2>
            <input type="text" class="input" value="">
            <button class="btn1">Update</button>

        </div>

    </div>
    
<button><a href="orderhistory.php">Order History</a></button>


     <?php include "footer.php"; ?>

   

</body>
