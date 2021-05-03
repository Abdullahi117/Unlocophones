<!DOCTYPE html>
<html lang="en">
<?php
if(isset($_POST['email'])) {
    session_start();
    $address = $username = $email = $city = $credit = $customerID = $paymentID = $shipmentID = "";


    //establish connection with database
    $mysqli = new mysqli('localhost:3306', 'root', '', 'mydb');
    if($mysqli->connect_errno) {
        //error if connection fails
        echo '<script>console.log("Failed to connect to database")</script>';
    }  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $city = $mysqli->real_escape_string($_POST['city']);
        $address = $mysqli->real_escape_string($_POST['address']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $credit = ($_POST['payment']); 
    }
    echo "<script>console.log('$email', '$address')</script>";
    //Fetch user data if exists
    $customersql = "SELECT * FROM customer WHERE email = '$email' AND address = '$address';";
    $result = $mysqli->query($customersql);
    if ($result->num_rows > 0) {
        // user exists in the database, grab the user ID
        $row = $result->fetch_assoc();
        $customerID = $row['customer_id'];
        //update the customer record with the given credit card number
        $updatecreditsql = "UPDATE customer SET credit_card = $credit WHERE customer_id = $customerID;";
        if ($mysqli->query($updatecreditsql) === TRUE) {
            echo '<script>console.log("Updated Record Successfully")</script>';
        } else {
            echo '<script>console.log("Failed to upload record")</script>';
        }
    } else {
        echo '<script>console.log("User Does not exist in the database")</script>';
        exit();
    }
    
    // check if payment data exists in the payment table
    $sql = "SELECT * FROM payment WHERE payment_type = $credit";
    $result = $mysqli->query($sql);
    // payment doesn't exist
    if ($result->num_rows == 0) {
        // create payment record in the database if not there
        $paymentsql = "INSERT INTO payment (payment_type, allowed) VALUES ($credit, 1)";
        if ($mysqli->query($paymentsql) === TRUE) {
            echo '<script>console.log("Payment Record Created")</script>';
        } else {
            echo '<script>console.log("Failed to create payment Record")</script>';
        }
    } else {
        echo '<script>console.log("Payment already exists")</script>';
    }
    //create new shipment ID
    $companyName = 'Fedex';
    $sql = "INSERT INTO shipment (company_name, company_phone) VALUES ('$companyName', 4633339)";
    if ($mysqli->query($sql) === TRUE) {
        echo '<script>console.log("Shipment ID created")</script>';
    } else {
        echo '<script>console.log("Failed to create shipment ID")</script>';
    }
    // grab the shipment ID just created
    $sql = "SELECT * FROM shipment WHERE shipment_id = (SELECT max(shipment_id) FROM shipment)";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $shipmentID = $row['shipment_id'];
    $sql = "SELECT * FROM payment WHERE payment_type = $credit";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $paymentID = $row['payment_id'];
    $currentdate = date("Y/m/d");
    $shipmentDate = Date('Y/m/d', strtotime('+3 days'));
    echo "<script>console.log($customerID, $paymentID)</script>";
    $ordersql = "INSERT INTO orders (customer_id, payment_id, order_date, shipment_id, shipment_date, `status`) 
                    VALUES ($customerID, $paymentID, '$currentdate', $shipmentID, '$shipmentDate', 1)";
    if ($mysqli->query($ordersql) === TRUE) {
        echo '<script>console.log("Order Placed Successfully")</script>';
    } else {
        echo '<script>console.log("Failed")</script>';;
    }
    }
?>

<?php include "header.php"; ?>
    <main>
        <section class="products">
            <div class="phonebox">
                <img src="iphone12mini.jpg" alt="p1" class="phoneimg"><br>
                <span class="phonename"> Iphone 12 Mini </span> 
                <span class="phoneprice"> $500.00 </span> <br>
                <button class="btn btn-primary shop-item-button" type="button"> ADD TO CART</button>

            </div>
            <div class="phonebox">
                <img src="iphone11.jpg" alt="p1" class="phoneimg"><br>
                <span class="phonename">Iphone 11 Grey</span> 
                <span class="phoneprice"> $500.00 </span> <br>
                <button class="btn btn-primary shop-item-button" type="button"> ADD TO CART</button>

            </div>
            <div class="phonebox">
                <img src="iphone12silverpromax.jpg" alt="p1" class="phoneimg"><br>
                <span class="phonename"> Iphone 12 Pro Max </span> 
                <span class="phoneprice"> $500.00 </span> <br>
                <button class="btn btn-primary shop-item-button" type="button"> ADD TO CART</button>
            </div>
        </section>
        <section class="products">
            <div class="phonebox">
                <img src="iphone11ref.jpg" alt="p1" class="phoneimg"><br>
                <span class="phonename"> Iphone 11 </span> 
                <span class="phoneprice"> $500.00 </span> <br>
                <button class="btn btn-primary shop-item-button" type="button"> ADD TO CART</button>

            </div>
            <div class="phonebox">
                <img src="iphonexr.jpg" alt="p1" class="phoneimg"><br>
                <span class="phonename">Iphone XR</span> 
                <span class="phoneprice"> $500.00 </span> <br>
                <button class="btn btn-primary shop-item-button" type="button"> ADD TO CART</button>

            </div>
            <div class="phonebox">
                <img src="iPhoneX.jpg" alt="p1" class="phoneimg"><br>
                <span class="phonename"> Iphonex</span> 
                <span class="phoneprice"> $500.00 </span> <br>
                <button class="btn btn-primary shop-item-button" type="button"> ADD TO CART</button>
            </div>
        </section>
        <br><br>
        <section class="container content-section">
            <h2 class="section-header">CART</h2>
            <div class="cart-row">
                <span class="cart-item cart-header cart-column">ITEM</span>
                <span class="cart-price cart-header cart-column">PRICE</span>
                <span class="cart-quantity cart-header cart-column">QUANTITY</span>
            </div>
            <div class="cart-items">
                
            </div>
            <div class="cart-total">
                <strong class="cart-total-title">Total</strong>
                <span class="cart-total-price">$0</span>
            </div>
        </section>
        <section class="checkoutbox">
            <h1>Checkout Form</h1>
            <form class = "checkoutform" method="post" target="_self">
                <label for="email"> Email: </label>
                <input type="text" name="email" id="email" required>
                <label for="address"> Address: </label>
                <input type="text" name="address" id="address" required>
                <label for="city"> City: </label>
                <input type="text" name="city" id="city" required>
                <label for="payment"> Credit Card #: </label>
                <input type="text" name="payment" id="payment" required>
                <button class="btn btn-primary btn-purchase" type="submit">PURCHASE</button>
            </form>
        </section>
    </main>
    <script src="site.js" async></script>
    </body>
</html>
<?php include "footer.php"; ?>

