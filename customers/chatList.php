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

    $list = '';
    
    $search = $_GET['keyword'];          //get the name of the input field
    $search = htmlspecialchars($search);         //change html characters to their equivalent meanings

    //get the name of the farmer who has the specific farm id
    $sql = "SELECT * FROM farmers WHERE farm_id = '{$search}'";
    $result = $database->query($sql);
    if($result->num_rows > 0) {
        while($farmer = $result->fetch_assoc()) {
           $list = '<div class="person">
                        <a href="chat.php?farmid='.$farmer['farm_id'].'">
                        <div class="chat-content">
                            <img src="../assets/images/" alt="">
                            <div class="chat-details">
                                <span>'.$farmer['first_name'].' '. $farmer['last_name']. '</span>
                            </div>
                        </div>
                        <div class="status-dot"><img src="" alt=""></div>
                        </a>
                    </div>'; 
        }
        echo $list;
    }

?>