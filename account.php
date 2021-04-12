<!DOCTYPE html>
<html lang="en">

<?php
include "header.php";
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
                   //Udpate Querey 
$sql =UPDATE customers
SET first_name = $fistName, last_name=$lastName
WHERE customer_id =3;

 
       

                ?>

    
    
<body>
    <section class= "editbox">
        <header class="accountdetails">
            <h1>Edit Account Details</h1>
        </header>
        <form class="editform" action="account.php" method="POST">
            <label for="firstname">First Name: </label>
            <input type="text" name="firstname" id="firstname" placeholder="First Name...">
            <label for="lastname">Last Name: </label>
            <input type="text" name="lastname" id="lastname" placeholder="Last Name...">
            <label for="email">Email Address: </label>
            <input type="text" name="email" id="email" placeholder="Email...">
            <label for="password">Password: </label>
            <input type="text" name="password" id="password" placeholder="Password...">
            <label for="confirmpass">Confirm Password: </label>
            <input type="text" name="confirmpass" id="confirmpass" placeholder="Confirm Password...">
            <input type="submit" value="Edit">
        </form>
        
    </section>


    <button><a href="orderhistory.php">Order History</a></button>
   

    <?php include "footer.php"; ?>

</body>
</html>
