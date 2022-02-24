
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
        header("Location: ../index.php");
    }

    //the details of the logged in user
    $sql = "SELECT * FROM customers WHERE unique_id = {$_SESSION['unique_id']}";
    $customer = $database->query($sql)->fetch_assoc();

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title id="name">Chat with your best farmers</title>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <!--Links to the stylesheets-->
        <meta name="viewport" content="width=device-width, initial-scale = 1.0">
        <link href="/ieka/assets/css/chat.css" rel="stylesheet" type="text/css">
        <script src="/ieka/assets/plugins/jquery-3.3.1.min.js"></script>
    </head>
    <body>
        <section class="users-search">
            <!---This part contains the profile picture of the person and states if the person is online--->
            <div class="content">
                <img src="" alt="">
                <span><?= $customer['first_name']. ' '. $customer['last_name'];?></span>
                <p><?= $customer['status']?></p>
            </div>
            <div class="find-chat">
                <form action="chatList.php" class="search-list" method="POST">
                    <input type="text" name="search" placeholder="Enter farm id to search" id="find">
                    <button name="check" type="button" id="click"><img name="search" src="../assets/icons/ionicons-2.0.1/png/512/ios7-search.png" alt="search button" class="btn-search"></button>
                </form>
            </div>
        </section>
        <!--This part shows the list of chats that the farmer has had-->
        <section class="users-list" id="users">
            
        </section>
        <script>
            $("#find").keyup(function(event) {
                //get the value in the search box
                var search_keyword = event.target.value;
                if (search_keyword) {
                    var url = document.location.origin + '/ieka/customers/chatList.php'
                    //make an ajax call to the server with the above url
                    $.get(url, {keyword: search_keyword}, function(response, statusCode, xJR){
                        document.getElementById("users").innerHTML = response;
                        //display the options corresponding to the searchwords
                        document.getElementById('users').style.display = "block";
                });
                } else {
                    document.getElementById('users').style.display = "none";
                }
            });
        </script>
        <script src="../assets/javascript/customer-chatlist.js"></script>
    </body>
</html>
