<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include ("auth_session.php");

$firstName = $lastName = $address = $phoneNumber = $username = $email = $password1 = $password2 = "";
$firstNameErr = $lastNameErr = $addressErr = $phoneNumberErr= $usernameErr = $emailErr = $password1Err = $password2Err = "";

//establish connection with database
$mysqli = new mysqli('localhost', 'ics325sp2132', '6735', 'ics325sp2132'); //Jorian's Metrostate database login details.
if($mysqli->connect_errno) {
    //error if connection fails
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $test = true;
    $firstName = $mysqli->real_escape_string($_POST['firstName']);
    $lastName = $mysqli->real_escape_string($_POST['lastName']);
    $phoneNumber = $mysqli->real_escape_string($_POST['phoneNumber']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password1 = $mysqli->real_escape_string($_POST['password1']);

    //First Name checker 
    if (empty($_POST["firstName"])) {
        $firstNameErr = "Name is required";
        $test = false;
    } 
    else {
        $firstName = test_input($_POST["firstName"]);
        if (!preg_match("/^[a-zA-Z]*$/",$firstName)) {
            $firstNameErr = "Only letters are allowed";
        }
    }
    //Last Name checker 
    if (empty($_POST["lastName"])) {
        $lastNameErr = "Name is required";
    } 
    else {
        $lastName = test_input($_POST["lastName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$lastName)) {
            $lastNameErr = "Only letters and white space allowed";
        }
    }
    // //Address Checker
    // if (empty($_POST["address"])) {
    //     $addressErr = "Address Required";

    // }
    // else {
    //     $address = test_input($_POST["address"]);
    //     //address validation
    //     if (!preg_match("/^[a-zA-Z0-9-\/] ?([a-zA-Z0-9-\/]|[a-zA-Z0-9-\/] )*[a-zA-Z0-9-\/]$/", $address)) {
    //         $addressErr = "Must Be A Proper Address";
    //     }
    // }
    //check phonenumber
    if (empty($_POST["phoneNumber"])) {
        $phoneNumberErr = "Phone Number Required";

    }
    else {
        $phoneNumber = test_input($_POST["phoneNumber"]);
        //phone number validation
        if (!preg_match("/^\d{10}$/", $phoneNumber)) {
            $phoneNumberErr = "Please Input 10-digit Phone Number";

        }
    }
    //Password1 checker 
    if (empty($_POST["password1"])) {
        $password1Err = "Password is required";
    } 
    else {
        $password1 = test_input($_POST["password1"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/[0-9A-Za-z!@#$%]/",$password1)) {
            $password1Err = "Only letters, numbers and special characters allowed";
        }
    }    

    // //Password2 confirm checker 
    // if ($password1 != $password2) {
    //     $password2Err = "Passwords dont match";
    // }
          

    // //Username checker 
    // if (empty($_POST["username"])) {
    //     $usernameErr = "Userame is required";
    // } 
    // else {
    //     $username = test_input($_POST["username"]);
    //     if (!preg_match("/^[a-zA-Z0-9]/",$username)) {
    //         $usernameErr = "Only letters and numbers allowed";
    //     }
    // }
    
    //Email checker 
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } 
    else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    //insert sql query
    $sql = "INSERT INTO customer (first_name, last_name, phone, email, password) VALUES "
                . " ('$firstName', '$lastName', '$phoneNumber', '$email', '$password1')";

    //check if query is successful
    if ($mysqli->query($sql) === true) {
        $_SESSION['message'] = "Registration complete, '$email' added to the database!";
        header("location: index.html");
    } else {
        $_SESSION['message'] = "User could not be added to the database";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<?php include "header.php"; ?>

    <div class="LoginTitle">Register</div>
    <div class="form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <!-- <form action="register.php" method="post"> -->
            <fieldset class="LoginBox">
                <p>Please fill out the information below to create an account.</p>
                    <div>
                        <label>First Name</label>
                        <input type="text" name="firstName" placeholder="First Name" required>
                        <br>
                        <span class ="error"><?php echo $firstNameErr;?></span>
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text" name="lastName" placeholder="Last Name" required>
                        <br>
                        <span class = "error"><?php echo $lastNameErr;?></span>
                    </div>
                    <div>
                        <label>Phone Number</label>
                        <input type="text" name="phoneNumber" placeholder="Phone Number" required>
                        <br>
                        <span class = "error"><?php echo $phoneNumberErr;?></span>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="text" name="email" placeholder="Email" required>
                        <br>
                        <span class = "error"><?php echo $emailErr;?></span>
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password1" placeholder="Password" required>
                        <br>
                        <span class = "error"><?php echo $password1Err;?></span>
                    </div>
                    <div>
                        <label>Confirm password</label>
                        <input type="password" name="password2" placeholder="Confirm Password" required>
                        <br>
                        <span class = "error"><?php echo $password2Err;?></span>
                    </div>
                    <div>
                        <input type="submit" name="submit" class="FormButton" value="Register">
                    </div>
                    <p>Already have an account? <a href="login.php">Log in here!</a></p>
            </fieldset>
        </form>
    </div>
</body>
</html>
<?php include "footer.php"; ?>
