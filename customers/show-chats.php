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
    
    $sender = $_SESSION['unique_id'];

    $sql = "SELECT * FROM messages INNER JOIN farmers ON messages.receiver = farmers.farm_id WHERE sender = '{$sender}' OR receiver = '{$sender}'";
    $query = $database->query($sql);
    while($chat = $query->fetch_assoc()) {
        $sql = "SELECT * FROM farmers WHERE farm_id = '{$chat['farm_id']}'";
        $prospective_farmer = $database->query($sql); 
        while($farmer = $prospective_farmer->fetch_assoc()) {
            $id = $farmer['farm_id'];
            $sql = "SELECT * FROM messages WHERE (sender = '{$id}' OR receiver = '{$id}') AND 
                (sender = '{$sender}' OR receiver = '{$sender}') ORDER BY id DESC LIMIT 1" ;
            $result = $database->query($sql);//var_dump($result);die;
            if($result->num_rows > 0) {
                while($record = $result->fetch_assoc()) {
                    $list = '<div class="person">
                            <a href="chat.php?farmid='.$farmer['farm_id'].'">
                            <div class="chat-content">
                                <img src="../assets/images/" alt="">
                                <div class="chat-details">
                                    <span>'.$farmer['first_name'].' '. $farmer['last_name']. '</span>
                                    <p>'. $record['message'].' </p>
                                </div>
                            </div>
                            <div class="status-dot"><img src="" alt=""></div>
                            </a>
                        </div>';
                }
            }
        }
    } //echo $list;

    /**echo $_SESSION['id'];
    $list = '';
    $sql = "SELECT * FROM farmers";
    $query = $database->query($sql);
    while($farmer = $query->fetch_assoc()) {
        $sql = "SELECT * FROM messages WHERE (sender = '{$_SESSION['id']}' OR receiver = '{$_SESSION['id']}') AND (sender = '{$farmer['id']}' OR receiver = '{$farmer['id']}') ORDER BY id ASC";
        $result = $database->query($sql);
        while($record = $result->fetch_assoc()) {
            $list = '<div class="person">
                        <a href="chat.php?user='.$farmer['id'].'">
                        <div class="chat-content">
                            <img src="../assets/images/" alt="">
                            <div class="chat-details">
                                <span>'.$farmer['first_name'].' '. $farmer['last_name']. '</span>
                                <p>'.$record['message'] .'</p>
                            </div>
                        </div>
                        <div class="status-dot"><img src="" alt=""></div>
                        </a>
                    </div>';
        }
    }
    echo $list;
**/
    /*$sql = "SELECT * FROM farmers LEFT JOIN messages"
    
    //check if the query is true
    if($query->num_rows > 0) {
        while($chat = $query->fetch_assoc()) {
           //if the customer is the recipient of the message
            if($_SESSION['id'] === $chat['receiver']) {
                //get all the records of the farmer as a sender
                $sql = "SELECT * FROM farmers WHERE id = '{$chat['sender']}' ORDER BY id LIMIT 1";
                $farmer = $database->query($sql)->fetch_assoc();

                $list = '<div class="person">
                            <a href="chat.php?user='.$farmer['id'].'">
                            <div class="chat-content">
                                <img src="../assets/images/" alt="">
                                <div class="chat-details">
                                    <span>'.$farmer['first_name'].' '. $farmer['last_name']. '</span>
                                    <p>'.$chat['message'] .'</p>
                                </div>
                            </div>
                            <div class="status-dot"><img src="" alt=""></div>
                            </a>
                        </div>';
            } elseif($_SESSION['id'] === $chat['sender']) {
                $sql = "SELECT * FROM farmers WHERE id = '{$chat['receiver']}' ORDER BY id LIMIT 1";
                $farmer = $database->query($sql)->fetch_assoc();

                $list = '<div class="person">
                            <a href="chat.php?user='.$farmer['id'].'">
                            <div class="chat-content">
                                <img src="../assets/images/" alt="">
                                <div class="chat-details">
                                    <span>'.$farmer['first_name'].' '. $farmer['last_name']. '</span>
                                    <p>'.$chat['message'] .'</p>
                                </div>
                                </div>
                            <div class="status-dot"><img src="" alt=""></div>
                            </a>
                        </div>';    
            }
        } 
            echo $list;
    } else {
        echo "No record found";
    }
*/?>