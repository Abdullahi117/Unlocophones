<!DOCTYPE html>
<html lang="en">

<?php include "header.php"; ?>


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
