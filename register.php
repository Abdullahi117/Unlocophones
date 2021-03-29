<!DOCTYPE html>
<html lang="en">
<?php 
$firstName = $lastName = $username = $email = $password1 = $password2 = "";
$firstNameErr = $lastNameErr = $usernameErr = $emailErr = $password1Err = $password2Err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //First Name checker 
    if (empty($_POST["firstName"])) {
        $firstNameErr = "Name is required";
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

    //Password2 confirm checker 
    if ($password1 != $password2) {
        $password2Err = "Passwords dont match";

    }
          

    //Username checker 
    if (empty($_POST["username"])) {
        $usernameErr = "Userame is required";
    } 
    else {
        $username = test_input($_POST["username"]);
        if (!preg_match("/^[a-zA-Z0-9]/",$username)) {
            $usernameErr = "Only letters and numbers allowed";
        }
    }
    
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