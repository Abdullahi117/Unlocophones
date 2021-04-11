<!DOCTYPE html>
<html lang="en">
<?php 
$firstName = $lastName = $username = $email = $password1 = $password2 = "";
$firstNameErr = $lastNameErr = $usernameErr = $emailErr = $password1Err = $password2Err = "";

//establish connection with database
$mysqli = new mysqli('localhost', 'root', '', 'unloco');
if($mysqli->connect_errno) {
    //error if connection fails
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $mysqli->real_escape_string($_POST['firstName']);
    $lastName = $mysqli->real_escape_string($_POST['lastName']);
    $username = $mysqli->real_escape_string($_POST['username']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = ($_POST['username']);
    //First Name checker 
    if (empty($_POST["firstName"])) {
        $firstNameErr = "Name is required";
        exit;
    } 
    else {
        $firstName = test_input($_POST["firstName"]);
        if (!preg_match("/^[a-zA-Z]*$/",$firstName)) {
            $firstNameErr = "Only letters are allowed";
            exit;
        }
    }
    //Last Name checker 
    if (empty($_POST["lastName"])) {
        $lastNameErr = "Name is required";
        exit;
    } 
    else {
        $lastName = test_input($_POST["lastName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$lastName)) {
            $lastNameErr = "Only letters and white space allowed";
            exit;
            }
    }

    //Password1 checker 
    if (empty($_POST["password1"])) {
        $password1Err = "Password is required";
        exit;
    } 
    else {
        $password1 = test_input($_POST["password1"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/[0-9A-Za-z!@#$%]/",$password1)) {
            $password1Err = "Only letters, numbers and special characters allowed";
            exit;
        }
    }    

    //Password2 confirm checker 
    if ($password1 != $password2) {
        $password2Err = "Passwords dont match";
        exit;

    }
          

    //Username checker 
    if (empty($_POST["username"])) {
        $usernameErr = "Userame is required";
        exit;
    } 
    else {
        $username = test_input($_POST["username"]);
        if (!preg_match("/^[a-zA-Z0-9]/",$username)) {
            $usernameErr = "Only letters and numbers allowed";
            exit;
        }
    }
    
    //Email checker 
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        exit;
    } 
    else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            exit;
        }
    }

    //insert sql query
    $sql = "INSERT INTO customer (first_name, last_name, email) VALUES "
                . " ('$firstName', '$lastName', '$email')";

    //check if query is successful
    if ($mysqli->query($sql) === true) {
        $_SESSION['message'] = "Registration complete, '$username' added to the database!";
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
                        <input type="text" name="firstName" placeholder="First Name">
                        <br>
                        <span class ="error"><?php echo $firstNameErr;?></span>
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text" name="lastName" placeholder="Last Name" >
                        <br>
                        <span class = "error"><?php echo $lastNameErr;?></span>
                    </div>
                    <div>
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Username" >
                        <br>
                        <span class = "error"><?php echo $usernameErr;?></span>
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password1" placeholder="Password" >
                        <br>
                        <span class = "error"><?php echo $password1Err;?></span>
                    </div>
                    <div>
                        <label>Confirm password</label>
                        <input type="password" name="password2" placeholder="Confirm Password" >
                        <br>
                        <span class = "error"><?php echo $password2Err;?></span>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="text" name="email" placeholder="Email" >
                        <br>
                        <span class = "error"><?php echo $emailErr;?></span>
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