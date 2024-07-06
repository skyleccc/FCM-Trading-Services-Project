<?php
    require 'accessDatabase.php';

    session_start();

    if(!empty($_POST['username']) && !empty($_POST['password'])){
        if ($query = $conn->prepare('SELECT userID, password FROM admin WHERE username = ?')) {
            $query->bind_param('s', $_POST['username']);
            $query->execute();
            $query->store_result();

            if ($query->num_rows > 0) {
                $query->bind_result($id, $password);
                $query->fetch();
                if ($_POST['password'] === $password) {
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $_POST['username'];
                    $_SESSION['id'] = $id;
                    header('Location: ../Pages/Admin/main/main.php');
                } else {
                    // Incorrect password
                    header('Location: ../Pages/loginfail.php');
                }
            } else {
                // Incorrect username
                header('Location: ../Pages/loginfail.php');
            }

            $query->close();
        }
    
    }else{
        header("Location: ../Pages/login.php");
    }

    $conn->close();
?>