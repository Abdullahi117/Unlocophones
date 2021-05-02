<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>

<?php
//establish connection with database
$mysqli = new mysqli('localhost', 'ics325sp2132', '6735', 'ics325sp2132'); //Jorian's Metrostate database login details.
if($mysqli->connect_errno) {
    //error if connection fails
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$emailBlank = $passwordBlank = "";
$emailBlankErr = $passwordBlankErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Check if email is blank
    if (empty($_POST["email"])) {
        $emailBlankErr = "Email is required";
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



// session
session_start();

if (isset($_POST['email'])) {
    $email = stripslashes($_REQUEST['email']);    // removes backslashes
    $email = mysqli_real_escape_string($mysqli, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($mysqli, $password);
    // Check user is exist in the database
    $query    = "SELECT * FROM `customer` WHERE email='$email' AND password='$password'";
    $result = mysqli_query($mysqli, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $_SESSION['email'] = $email;
        // Redirect to user dashboard page
        header("Location: index.html");
    } else {
        echo "<div class='form'>
              <h3>Incorrect email/password.</h3><br/>
              <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
              </div>";
    }
} 
else {

?>

    <div class="LoginTitle">Login</div>
        <div class="form">
            <form action="login.php" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <fieldset class="LoginBox">
                    <p>Please fill in your credentials to login.</p>
                        <div >
                            <label>Email</label>
                            <input type="text" name="email" placeholder="Email">
                            <br>
                            <span class = "error"><?php echo $emailBlankErr;?></span>
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
                </fieldset>
            </form>
            <?php } ?>
    </div>
</body>
</html>
<?php include "footer.php"; ?>
