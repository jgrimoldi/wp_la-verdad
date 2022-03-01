<?php

    // variables
    $username = "";
    $email = "";
    $errors = array();



    //login user
    if(isset($_POST['login_btn'])){
        $username = stringEscape($_POST['username']);
        $password = stringEscape($_POST['password']);

        if(empty($username)){array_push($errors, "Se requiere un usuario");}
        if(empty($password)){array_push($errors, "Se requiere una contraseña");}
        if(empty($errors)){
            // $password = password_hash($password, PASSWORD_DEFAULT);
            $sql_login = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";

            $query_login = mysqli_query($connection, $sql_login);


            echo $username . "<br>";
            echo $password;

            if(mysqli_num_rows($query_login) > 0){
                //get id
                $register_user_id = mysqli_fetch_assoc($query_login)['id'];

                // put in session array
                $_SESSION['user'] = getUserById($register_user_id);

                // redirect to dashboard admin
                if(in_array($_SESSION['user']['role'], ['Admin', 'Author'])){
                    $_SESSION['message'] = "Se ha iniciado correctamente";
                    header('location: ' . BASE_URL . 'admin/index.php');
                    exit(0);
                }else{
                    $_SESSION['message'] = "Se ha iniciado correctamente";
                    header('location: index.php');
                    exit(0);
                }
            }else{
                array_push($errors, "Las credenciales son incorrectas");
            }
        }
    }

    function stringEscape(String $string){
        global $connection;
        $escaped_value = trim($string);
        $escaped_value = mysqli_real_escape_string($connection, $escaped_value);

        return $escaped_value;
    }

    function getUserById($user_id){
        global $connection;
        $sql_id = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
        $query_id = mysqli_query($connection, $sql_id);

        $user = mysqli_fetch_assoc($query_id);

        return $user; // assoc array

    }