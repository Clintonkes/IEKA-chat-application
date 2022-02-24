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
    $sql = "SELECT * FROM farmers WHERE unique_id = '{$sender}'";var_dump($sql);die;
    $deal = $database->query($sql)->fetch_assoc();
    $dealer = $deal['farm_id'];


    $sql = "SELECT * FROM messages INNER JOIN customers ON messages.sender = customers.id WHERE sender = '{$dealer}' OR receiver = '{$dealer}'";
    $query = $database->query($sql);
    while($chat = $query->fetch_assoc()) {
        $sql = "SELECT * FROM customers WHERE unique_id = '{$chat['unique_id']}'";
        $prospective_customer = $database->query($sql); 
        while($customer = $prospective_customer->fetch_assoc()) {
            $sql = "SELECT * FROM messages WHERE (sender = '{$customer['unique_id']}' OR receiver = '{$customer['unique_id']}') AND 
                (sender = '{$dealer}' OR receiver = '{$dealer}') ORDER BY id DESC LIMIT 1" ;
            $result = $database->query($sql);var_dump($result);die;
            if($result->num_rows > 0) {
                while($record = $result->fetch_assoc()) {
                    $list = '<div class="person">
                            <a href="chat.php?customer_id='.$customer['unique_id'].'">
                            <div class="chat-content">
                                <img src="../assets/images/" alt="">
                                <div class="chat-details">
                                    <span>'.$customer['first_name'].' '. $customer['last_name']. '</span>
                                    <p>'. $record['message'].' </p>
                                </div>
                            </div>
                            <div class="status-dot"><img src="" alt=""></div>
                            </a>
                        </div>';
                }
            }
        }
    }
    echo $list;

?>