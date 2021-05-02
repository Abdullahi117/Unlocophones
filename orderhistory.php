<?php
include "header.php";
echo "<br><br><br><br><br><br>";

session_start();
//establish connection with database
$mysqli = new mysqli('localhost', 'ics325sp2132', '6735', 'ics325sp2132');
if($mysqli->connect_errno) {
    //error if connection fails
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

    //Retreive SQL query 1
    $sql = "SELECT * FROM orders";
    if($result = mysqli_query($mysqli, $sql))
    {
        if(mysqli_num_rows($result) > 0){
            echo '<table class="order">';
                echo "<tr><h3>ORDERS:</<h3></tr>";
                echo "<tr>";
                    echo "<th>Order ID</th>";
                    echo "<th>Customer ID</th>";
                    echo "<th>Payment ID</th>";
                    echo "<th>Order Date</th>";
                    echo "<th>Shipment ID</th>";
                    echo "<th>Shipment Date</th>";
                    echo "<th>Status</th>";
                echo "</tr>";
            while ($row = mysqli_fetch_array($result))
            {
                echo "<tr>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . $row['customer_id'] . "</td>";
                    echo "<td>" . $row['payment_id'] . "</td>";
                    echo "<td>" . $row['order_date'] . "</td>";
                    echo "<td>" . $row['shipment_id'] . "</td>";
                    echo "<td>" . $row['shipment_date'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                echo "</tr>";
            }

            mysqli_free_result($result);
        } else{
            echo "Nothing was found.";
        }
    } 

    echo "<br><br>";

       //Retreive SQL query 2
       $sql = "SELECT * FROM orderdetails";
       if($result = mysqli_query($mysqli, $sql))
       {
           if(mysqli_num_rows($result) > 0){
                   echo "<tr>";
                       echo "<th>Discount</th>";
                       echo "<th>Color</th>";
                       echo "<th>Total</th>";
                   echo "</tr>";
               while ($row = mysqli_fetch_array($result))
               {
                    echo "<tr>";
                        echo "<td>" . $row['discount'] . "</td>";
                        echo "<td>" . $row['color'] . "</td>";
                        echo "<td>$" . $row['total'] . "</td>";
                   echo "</tr>";
               }
               echo "</table>";
   
               mysqli_free_result($result);
           } else{
               echo "Nothing was found.";
           }
       } 
   
mysqli_close($mysqli);

echo "<br><br><br><br><br><br><br><br>";
include "footer.php";

?>
