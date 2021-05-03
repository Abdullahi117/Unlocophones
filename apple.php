<!DOCTYPE html>
<html lang="en">
<?php
if(isset($_POST['email']) && isset($_POST['city']) && isset($_POST['address']) && isset($_POST['product'])) {
    session_start();
    $productID = $colors = $address = $username = $email = "";
    $city = $credit = $customerID = $paymentID = $shipmentID = "";
    $total = $orderID = $product = $quantity = "";


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
        $product = $mysqli->real_escape_string($_POST['product']);
        $credit = ($_POST['payment']); 
        $number = ($_POST['cart-quantity-input']);
        echo "<script>console.log('$number')</script>";
        // Being sure the string is actually a number
        if (is_numeric($number)) {
            $quantity = $number + 0;
        }else {
            $quantity = 0;
        }
        $price = 500;
        $total = ($quantity * $price);
    }
    //fetch the product from the product table
    $sql = "SELECT * FROM products WHERE name = '$product'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $productID = $row['product_id'];
    $colors = $row['colors'];


    //Fetch user data if exists
    $customersql = "SELECT * FROM customer WHERE email = '$email';";
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
    // grab the payment id
    $sql = "SELECT * FROM payment WHERE payment_type = $credit";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $paymentID = $row['payment_id'];
    $currentdate = date("Y/m/d");
    $shipmentDate = Date('Y/m/d', strtotime('+3 days'));
    echo "<script>console.log($customerID, $paymentID)</script>";

    //create the order into the order table
    $ordersql = "INSERT INTO orders (customer_id, payment_id, order_date, shipment_id, shipment_date, `status`) 
                    VALUES ($customerID, $paymentID, '$currentdate', $shipmentID, '$shipmentDate', 1)";
    if ($mysqli->query($ordersql) === TRUE) {
        echo '<script>console.log("Order Placed Successfully")</script>';
    } else {
        echo '<script>console.log("Failed")</script>';
    }
    // grab the order id just created
    $sql = "SELECT * FROM orders WHERE customer_id = $customerID AND payment_id = $paymentID AND shipment_id = '$shipmentID'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $orderID = $row['order_id'];

    //create the order details entry

    $sql = "INSERT INTO orderdetails (order_id, product_id, quantity, discount, color, total) 
            VALUES ($orderID, $productID, $quantity, 0, '$colors', $total)";
    if ($mysqli->query($sql) === TRUE) {
        echo '<script>console.log("Order detail created")</script>';
    } else {
        echo '<script>console.log("Failed to create order detail")</script>';
        echo "<script>console.log('$total, $quantity, $colors, $product')</script>";
    }
    header("Location: index.html");
}
    
?>
<?php include "header.php"; ?>
<main>
        <section class="products">
            <div class="phonebox">
                <img src="iphone12mini.jpg" alt="p1" class="phoneimg"><br>
                <span class="phonename"> iPhone 12 Mini </span> <br>
                <span class="phoneprice"> $500.00 </span> 

            </div>
            <div class="phonebox">
                <img src="iphone11.jpg" alt="p1" class="phoneimg"><br>
                <span class="phonename">iPhone 11 Grey</span> <br>
                <span class="phoneprice"> $500.00 </span> 

            </div>
            <div class="phonebox">
                <img src="iphone12silverpromax.jpg" alt="p1" class="phoneimg"><br>
                <span class="phonename"> iPhone 12 Pro Max </span> <br>
                <span class="phoneprice"> $500.00 </span> 
            </div>
        </section>
        <section class="products">
            <div class="phonebox">
                <img src="iphone11ref.jpg" alt="p1" class="phoneimg"><br>
                <span class="phonename"> iPhone 11 </span> <br>
                <span class="phoneprice"> $500.00 </span> 
            </div>
            <div class="phonebox">
                <img src="iphonexr.jpg" alt="p1" class="phoneimg"><br>
                <span class="phonename">iPhone XR</span> <br>
                <span class="phoneprice"> $500.00 </span>

            </div>
            <div class="phonebox">
                <img src="iPhoneX.jpg" alt="p1" class="phoneimg"><br>
                <span class="phonename"> iPhone X</span> <br>
                <span class="phoneprice"> $500.00 </span> 
            </div>
        </section>
        <br><br>
        
        <section class="checkoutbox">
            <h1>Checkout Form</h1>
            <form class = "checkoutform" method="POST" target="_self">
                <label for="email"> Email: </label>
                <input type="text" name="email" id="email" required>
                <label for="address"> Address: </label>
                <input type="text" name="address" id="address" required>
                <label for="city"> City: </label>
                <input type="text" name="city" id="city" required>
                <label for="product"> Select Your Product </label>
                <select name="product" id="product" required>
                    <option value="iPhone 12 Mini">iPhone 12 Mini</option>
                    <option value="iPhone 11 Grey">iPhone 11 Grey</option>
                    <option value="iPhone 12 Pro Max">iPhone 12 Pro Max</option>
                    <option value="iPhone 11">iPhone 11</option>
                    <option value="iPhone XR">iPhone XR</option>
                    <option value="iPhone X">iPhone X</option>
                  </select>
                <label for="cart-quantity-input">Quantity: </label>
                <input name="cart-quantity-input" id="cart-quantity-input" type="text" required>
                <label for="payment"> Credit Card #: </label>
                <input type="text" name="payment" id="payment" required>
                <button class="btn btn-primary btn-purchase" type="submit">PURCHASE</button>
            </form>
        </section>
    </main>
    </body>
</html>
<?php include "footer.php"; ?>

