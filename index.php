<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
    <link rel="stylesheet" href="main.css">
    <title>Unlocked Phones | BUY </title>
</head>

<body>
    <div class="logo"><a href="index.html"><img src="Unloco.png" alt=""></a>
        <div class="navbar">
            <nav>
                 <div class="search-container">
                    <form method="post">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                 <ul>
                    <li><a href="contact.html">Contact</a></li>
                 
                    <li><a href="login.php">Login</a></li>
                    <li><a href="google.php">Google</a></li>
                    <li><a href="apple.php">Apple</a></li>
                    <li><a href="samsung.php">Samsung</a></li>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="account.php">Account</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="pic" style= "text-align: center;">
        <img src="samsung.jpg" alt="">
    </div>
    <div class="salespitch">
        <h1>Why Buy From Us</h1>
        <p>
            Nam liber tempor cum soluta nobis eleifend option 
            congue nihil imperdiet doming id quod mazim placerat 
            facer possim assum. Lorem ipsum dolor sit amet, 
            consectetuer adipiscing elit, sed diam nonummy 
            nibh euismod tincidunt ut laoreet dolore magna aliquam 
            erat volutpat. Ut wisi enim ad minim veniam, quis nostrud 
            exerci tation ullamcorper suscipit lobortis nisl ut 
            aliquip ex ea commodo consequat.
            
        </p>
        <br>
        <div class="features">
            <div class="row">
                <div class="col">
                    <div class="col-left">
                    <i class="far fa-check-circle"></i>
                    </div>
                    <div class="col-right">
                    <h2>Feature One</h2>
                    <p>Lorem ipsum dolor sit amet, 
                        consectetuer adipiscing elit, sed diam nonummy 
                        nibh euismod tincidunt ut laoreet dolore magna aliquam 
                        erat volutpat.
                    </p>
                    </div>
                </div>
                <div class="col">
                    <div class="col-left">
                    <i class="far fa-check-circle"></i>
                    </div>
                    <div class="col-right">
                    <h2>Feature Two</h2>
                    <p>Lorem ipsum dolor sit amet, 
                        consectetuer adipiscing elit, sed diam nonummy 
                        nibh euismod tincidunt ut laoreet dolore magna aliquam 
                        erat volutpat.
                    </p>
                    </div>
                </div>
                <div class="col">
                    <div class="col-left">
                    <i class="far fa-check-circle"></i>
                    </div>
                    <div class="col-right">
                    <h2>Feature Three</h2>
                    <p>Lorem ipsum dolor sit amet, 
                        consectetuer adipiscing elit, sed diam nonummy 
                        nibh euismod tincidunt ut laoreet dolore magna aliquam 
                        erat volutpat.
                    </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="testimonals">
        <hr>
        <div class="inner">
            <h1>Testimonials</h1>
            <div class="border"></div>
            <div class="row">
                <div class="col">
                    <div class="testimonial">
                        <img src="p1.jpg" alt="">
                        <div class="stars">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p>
                            In vacuo aut inflectere praesto vas implere recusat expandit eas item ne restagnatio. Maxime
                            vero parte, agnosticismum flexbox layout est contra iuge Home
                        </p>
                        <hr style="width: 50%;">
                        <div class="name">Full name</div>
                    </div>
                </div>
                <div class="col">
                    <div class="testimonial">
                        <img src="p2.jpg" alt="">
                        
                        <div class="stars">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p>
                            In vacuo aut inflectere praesto vas implere recusat expandit eas item ne restagnatio. Maxime
                            vero parte, agnosticismum flexbox layout est contra iuge Home
                        </p>
                        <hr style="width: 50%;">
                        <div class="name">Full name</div> <br>
                    </div>
                </div>
                <div class="col">
                    <div class="testimonial">
                        <img src="p3.png" alt="">
                        <div class="stars">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p>
                            In vacuo aut inflectere praesto vas implere recusat expandit eas item ne restagnatio. Maxime
                            vero parte, agnosticismum flexbox layout est contra iuge Home
                        </p>
                        <hr style="width: 50%;">
                        <div class="name">Full name</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <footer>
                <p>Creaters: Abdullai Jorian Mahad</p>
                <p>UNlOCO Incorporation ©</p>
                <a href="Unloco@gmail.com">Unloc@hmail.com</a>
            </footer>
        </div>

</body>
</html>
     <?php 
    $mysqli = new mysqli('localhost:3306', 'root', '', 'mydb');
    if($mysqli->connect_errno) {
        //error if connection fails
        echo '<script>console.log("Failed to connect to database")</script>';
    }  
    if (isset($_POST['submit'])){
        $str=$_POST["search"];
        $sth = $mysqli->prepare("SELECT * FROM 'products' WHERE name = $str'");
    }
    $sth -> setFetchMode(mysqli:: FETCH_OBJ);
    $sth -> execute();

    if ($row = $sth->fetch())
    {
        ?>
    <br><br><br>
    <table>
        <tr>
            <th>Item Name</th>
            <th>Item Price</th>
        </tr>
        <tr>
            
            <td><?php echo $row->name; ?></td>
				<td><?php echo $row->year_made;?></td>
            

</tr>



</tr>




        </table>
  <?php
    }
    <
    else{
        echo"Item is not in inventory";
    }
}
?>



