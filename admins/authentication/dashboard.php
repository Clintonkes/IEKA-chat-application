<?php
    session_start();

    //set all PHP error reporting in order to see every error in our script
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    //connecting to the database
    $database = new mysqli("localhost", "root", "", "ieka");
    //check connection

    if($database->connect_error) {
        die("error in connection". $database->connect_error);
    } else {
      // echo "connection successful";
    }
    
    if(!isset($_SESSION['ID'])) {
       header("Location:index.php");
    }
    
    //get the name of the particular admin logged in
    $sql = "SELECT * FROM admin WHERE id = '{$_SESSION['ID']}'";
    $admin = $database->query($sql)->fetch_assoc();

    //get the data from other databases
    $sql = "SELECT * FROM admin";
    $admins = $database->query($sql);

    $sql = "SELECT * FROM farmers";
    $farmers = $database->query($sql); 

    $sql = "SELECT * FROM deliverers";
    $deliverers = $database->query($sql);

    $sql = "SELECT * FROM users";
    $users = $database->query($sql);

    $sql = "SELECT * FROM reports";
    $reports = $database->query($sql);

    $sql = "SELECT * FROM careers";
    $careers = $database->query($sql);
    
    $sql = "SELECT * FROM investors";
    $investors = $database->query($sql);

    $sql = "SELECT * FROM adverts";
    $adverts = $database->query($sql);
    
    $sql = "SELECT * FROM desk_offices";
    $desks = $database->query($sql);

    
    $sql = "SELECT * FROM policies";
    $policies = $database->query($sql);

    
    $sql = "SELECT * FROM markets";
    $markets = $database->query($sql);

    
    $sql = "SELECT * FROM deliveries";
    $deliveries = $database->query($sql);

    
    $sql = "SELECT * FROM account_issues";
    $account_issues = $database->query($sql);

    
    $sql = "SELECT * FROM reviews";
    $reviews = $database->query($sql);

    
    $sql = "SELECT * FROM announcements";
    $announcements = $database->query($sql);


?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Everything within Ieka</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale = 1.0">
        <link href="/ieka/assets/css/dash.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <div class="greeting">
                <h6>Hi! Welcome <?= $admin['first_name'];?></h6>
            </div>
            <nav class="head">
                <div class="logout">
                    <a href="logout.php">logout</a>
                </div>
            </nav>
        </header>
        <section>
            <div class="total">
                <div class="first">
                    <div>
                        <a href="#">administrator<br><?=$admins->num_rows;?></a>
                    </div>
                    <div>
                        <a href="./farmers/index.php">farmers<br><?=$farmers->num_rows;?></a>
                    </div>
                    <div>
                        <a href="./drivers/index.php">drivers<br><?=$deliverers->num_rows;?></a>
                    </div>
                    <div>
                        <a href="./users/index.php">users<br><?=$users->num_rows;?></a>
                    </div>
                </div>
                <div class="second">
                    <div>
                        <a href="./reports/index.php">reports<br><?=$reports->num_rows;?></a>
                    </div>
                    <div>
                        <a href="./careers/index.php">careers<br><?=$careers->num_rows;?></a>
                    </div>
                    <div>
                        <a href="./investors/index.php">investors<br><?=$investors->num_rows;?></a>
                    </div>
                    <div>
                        <a href="./adverts/index.php">adverts<br><?=$adverts->num_rows;?></a>
                    </div>
                </div>
                <div class="third">
                    <div>
                        <a href="./desks/index.php">desk offices<br><?=$desks->num_rows;?></a>
                    </div>
                    <div>
                        <a href="./policies/index.php">policies<br><?=$policies->num_rows;?></a>
                    </div>
                    <div>
                        <a href="./finances/index.php">finances<br></a>
                    </div>
                    <div>
                        <a href="./markets/index.php">markets<br><?=$markets->num_rows;?></a>
                    </div>
                </div>
                <div class="four">
                    <div>
                        <a href="./deliveries/index.php">deliveries<br><?=$deliveries->num_rows;?></a>
                    </div>
                    <div>
                        <a href="./account-issues/index.php">account issues<br><?=$account_issues->num_rows;?></a>
                    </div>
                    <div>
                        <a href="./reviews/index.php">reviews<br><?=$reviews->num_rows;?></a>
                    </div>
                    <div>
                        <a href="./announcements/index.php">announcements<br><?=$announcements->num_rows;?></a>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <div class="second part">
                <!--social media section-->
                <div class="social-media">
                    <div class="twitter media">
                        <a href="#"><img src="../../assets/icons/ionicons-2.0.1/png/512/social-twitter-outline.png" alt="twitter"></a>
                    </div>
                    <div class="instagram media">
                        <a href="#"><img src="../../assets/icons/ionicons-2.0.1/png/512/social-instagram-outline.png" alt="instagram"></a>
                    </div>
                    <div class="linkedIn media">
                        <a href="#"><img src="../../assets/icons/ionicons-2.0.1/png/512/social-linkedin-outline.png" alt="linkedIn"></a>
                    </div>
                    <div class="facebook media">
                        <a href="#"><img src="../../assets/icons/ionicons-2.0.1/png/512/social-facebook-outline.png" alt="facebook"></a>
                    </div>
                </div>

                <!--Company reserved rights-->
                <div class="reserved">
                    <p class="company">
                    &copy all rights reserved. ieka enterprises. or its affliates
                    </p>
                </div>
        </footer>
    </body>
</html>