<?php
     //do the session check
    session_start();

    //connecting to the database
    $database = new mysqli("localhost", "root", "", "ieka");
    //check connection

    if($database->connect_error) {
        die("error in connection". $database->connect_error);
    } else {
      // echo "connection successful";
    }

    if(isset($_POST['enter'])) {
        //get all the parameters in the form
        $cell = mysqli_real_escape_string($database, $_POST['phone-number']);
        $code = mysqli_real_escape_string($database, $_POST['passcode']);

        //check if the fields are empty
        if(empty($cell) || empty($code)) {
            echo "All fields are required!";
            return;
        } else {
            //get the info from the farmers table
            $sql = "SELECT * FROM farmers WHERE phone = '{$cell}'";
            $result = $database->query($sql);
            if($result->num_rows > 0) {
                $farmer = $result->fetch_assoc();
                $_SESSION['unique_id'] = $farmer['unique_id']; ?>
                <script>
                    window.location = "./farmers/index.php";
                </script> <?php
            } else {
                //get the info from the admins table
                $sql = "SELECT * FROM admin WHERE phone = '{$cell}'";
                $record = $database->query($sql);
                if($record->num_rows > 0) {
                    $admin = $record->fetch_assoc();
                    $_SESSION['unique_id'] = $admin['unique_id']; ?>
                    <script>
                        window.location = "./admins/authentication/index.php";
                    </script> <?php
                } else {
                    //get the info from the customers table
                    $sql = "SELECT * FROM customers WHERE phone = '{$cell}'";
                    $details = $database->query($sql);
                    if($details->num_rows > 0) {
                        $customer = $details->fetch_assoc();
                        $_SESSION['unique_id'] = $customer['unique_id']; ?>
                        <script>
                            window.location = "./customers/index.php";
                        </script> <?php
                    }
                }
            }
        }
    }
?>