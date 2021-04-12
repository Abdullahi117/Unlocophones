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
   "SET first_name = '$firstName', last_name = '$lastName'" . 
   " WHERE customer_id = 4";

   if ($mysqli->query($sql) === true) {
    $_SESSION['message'] = "Update Complete!";
    } else {
    $_SESSION['message'] = "Could not connect to the database";
}             
?>

<?php include "header.php"; ?>

    
    
<body>
    <section class= "editbox">
        <header class="accountdetails">
            <h1>Edit Account Details</h1>
        </header>
        <form class="editform" action="account.php" method="POST">
            <label for="firstName">First Name: </label>
            <input type="text" name="firstName" id="firstName" placeholder="First Name...">
            <label for="lastName">Last Name: </label>
            <input type="text" name="lastName" id="lastName" placeholder="Last Name...">
            <label for="email">Email Address: </label>
            <input type="text" name="email" id="email" placeholder="Email...">
            <input type="submit" value="Edit">
        </form>
    </section>


    <button><a href="orderhistory.php">Order History</a></button>


     <?php include "footer.php"; ?>

</body>