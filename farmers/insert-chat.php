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
    } else {
        //get the inputs in the page
        $message = mysqli_real_escape_string($database, $_POST['message']);
        $sender = mysqli_real_escape_string($database, $_POST['outgoing_id']);
        $recipient = mysqli_real_escape_string($database, $_POST['incoming_id']);

        //set the database time to that of the user
        $datetime = new DateTime();
        $timezone = new DateTimeZone('Africa/Lagos');
        $datetime->setTimezone($timezone);
        $created_at = $datetime->format('Y-m-d h:i:s');
        
        if(!empty($message)) {
            //insert into messages table
            $sql = "INSERT INTO messages(`sender`, `receiver`, `message`, `created_at`, `modified_at`)
                VALUES('{$sender}', '{$recipient}', '{$message}', '{$created_at}', '{$created_at}')";
            $insert = $database->query($sql);
        }
    }

    

?>