<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>

<?php
$usernameBlank = $passwordBlank = "";
$usernameBlankErr = $passwordBlankErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Check if username is blank
    if (empty($_POST["username"])) {
        $usernameBlankErr = "Username is required";
    } 
    else{}

    if (empty($_POST["password"])) {
        $passwordBlankErr = "Password is required";
    } 
    else{}
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

    <div class="LoginTitle">Login</div>
    <div class="form">
        <form action="login.php" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <fieldset class="LoginBox">
                <p>Please fill in your credentials to login.</p>
                    <div >
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Username">
                        <br>
                        <span class = "error"><?php echo $usernameBlankErr;?></span>
                    </div>
                    <div >
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password">
                        <br>
                        <span class = "error"><?php echo $passwordBlankErr;?></span>
                    </div>
                    <div>
                        <input type="submit" name="submit" class ="FormButton" value="Login">
                    </div>
                    <p>Don't have an account? <a href="register.php">Sign up now!</a></p>
                </form>
            </fieldset>
    </div>
</body>
</html>
<?php include "footer.php"; ?>