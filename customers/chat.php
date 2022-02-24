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

     //check if the user is logged in
     if(!isset($_SESSION['unique_id'])) {
        header("Location: ../index.php");
    }
    
    //get the id of the farmer 
    $farm_id = $_GET['farmid']; echo $farm_id;
    $sql = "SELECT * FROM farmers WHERE farm_id = '{$farm_id}'";
    $result = $database->query($sql)->fetch_assoc(); var_dump($sql);


?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Chat on!</title>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <!--Links to the stylesheets-->
        <meta name="viewport" content="width=device-width, initial-scale = 1.0">
        <link href="/ieka/assets/css/chat.css" rel="stylesheet" type="text/css">
        <link href="/ieka/assets/css/all.min.css" rel="stylesheet" type="text/css">
        <script src="/ieka/assets/plugins/jquery-3.3.1.min.js"></script>
    </head>
    <body>
        <section class="chat-area">
            <!--the header part of the chat page-->
            <div class="header">
                <!--the icon placed here is back arrow icon-->
                <a href="chat-list.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="" alt="">
                <div class="chat-details">
                    <span><?=$result['first_name']. ' '. $result['last_name'];?></span>
                    <p><?=$result['status'];?></p>
                </div>
            </div>
            <!--the body of the chat area-->
            <div class="chat-box">
            </div>
            <div class="typing area">
                <form action="#" class="typing-area" method="POST">
                    <input type="hidden" name="incoming_id" value="<?=$result['farm_id']?>"><!--the recipient, in this case the farmer-->
                    <input type="hidden" name="outgoing_id" value="<?=$_SESSION['unique_id']?>"><!--the sender, in this case the customer-->
                    <input type="text" name="message" placeholder="Enter your message here.." class="input-field">
                    <button type="button" id="send"><i class="fab fa-telegram-plane"></i></button>
                </form>
            </div>
        </section>
        <script src="../assets/javascript/all.min.js"></script>
        <script src="../assets/javascript/customer-chat.js"></script>
    </body>
</html>