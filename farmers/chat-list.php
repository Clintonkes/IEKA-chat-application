
<?php
    session_start();
    
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
        header("Location: ./index.php");
    }

    //the details of the logged in user
    $sql = "SELECT * FROM farmers WHERE unique_id = {$_SESSION['unique_id']}";
    $farmer = $database->query($sql)->fetch_assoc();

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title id="name">Chat with your customers</title>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <!--Links to the stylesheets-->
        <meta name="viewport" content="width=device-width, initial-scale = 1.0">
        <link href="/ieka/assets/css/chat.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <section class="users-search">
            <!---This part contains the profile picture of the person and states if the person is online--->
            <div class="content">
                <img src="" alt="">
                <span><?= $farmer['first_name']. ' '. $farmer['last_name'];?></span>
                <p><?= $farmer['status']?></p>
            </div>
            <div class="find-chat">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="search-list" method="GET">
                    <input type="search" placeholder="Enter farm id to search" name="find" id="find">
                    <button id="click"><img name="search" src="../assets/icons/ionicons-2.0.1/png/512/ios7-search.png" alt="search button" class="btn-search"></button>
                </form> 
            </div>
        </section>
        <!--This part shows the list of chats that the farmer has had-->
        <section class="users-list">

        </section>
        <script src="../assets/javascript/farmer-chatlist.js"></script>
    </body>
</html>