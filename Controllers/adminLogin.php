<?php
    require 'accessDatabase.php';

    session_start();

    if(!empty($_POST['username']) && !empty($_POST['password'])){
        if ($query = $conn->prepare('SELECT userID, password FROM admin WHERE username = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            $query->bind_param('s', $_POST['username']);
            $query->execute();
            // Store the result so we can check if the account exists in the database.
            $query->store_result();

            if ($query->num_rows > 0) {
                $query->bind_result($id, $password);
                $query->fetch();
                // Account exists, now we verify the password.
                // Note: remember to use password_hash in your registration file to store the hashed passwords.
                if ($_POST['password'] === $password) {
                    // Verification success! User has logged-in!
                    // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $_POST['username'];
                    $_SESSION['id'] = $id;
                    echo 'Welcome back, ' . htmlspecialchars($_SESSION['name'], ENT_QUOTES) . '!';
                } else {
                    // Incorrect password
                    echo 'Incorrect username and/or password!';
                }
            } else {
                // Incorrect username
                echo 'Incorrect username and/or password!';
            }

            $query->close();
        }
    
    }else{
        header("Location: ../Pages/login.php");
    }

    $conn->close();
?>