<?php

    // variables
    $username = "";
    $email = "";
    $errors = array();

    // register user
    if(isset($_POST['reg_user'])){
        $username = stringEscape($_POST['username']);
        $email = stringEscape($_POST['email']);
        $password = stringEscape($_POST['password']);
        $password_verify = stringEscape($_POST['password_verify']);

        // form validation
		if (empty($username)) {  array_push($errors, "Uhmm... Parece que falta el usuario"); }
		if (empty($email)) { array_push($errors, "Oops.. No se ha encontrado el correo"); }
		if (empty($password)) { array_push($errors, "Se te olvido la contraseña"); }
		if ($password != $password_verify) { array_push($errors, "Las contraseñas no coinciden");}

        // check if user exists
        $sql_user_check = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $query_user_check = mysqli_query($connection, $sql_user_check);
        $user = mysqli_fetch_assoc($query_user_check);

        if($user){
            if($user['username'] === $username){
                array_push($errors, "El usuario ya existe");
            }
            if($user['email'] === $email){
                array_push($errors, "Ya existe una cuenta con este correo");
            }
        }

        //if no error create user
        if(count($errors) == 0){
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql_register = "INSERT INTO users (username, email, password, created_at, updated_at) 
                            VALUES('$username', '$email', $password_hash', now(), now())";
            mysqli_query($connection, $sql_register);

            $register_user_id = mysqli_insert_id($connection);
            // id of new user on session array
            $_SESSION['user'] = getUserById($register_user_id);

            //if admin user redirect to admin dashboard
            if(in_array($_SESSION['user']['role'], ['Admin', 'Author'])){
                $_SESSION['message'] = "Sesion iniciada correctamente";

                // redirect to dashboard
                header('location: ' . BASE_URL . 'admin/dashboard.php');
                exit(0);
            }else{
                $_SESSION['message'] = "Sesion iniciada correctamente";
                header('location: index.php');
                exit(0);
            }
        }
    }

    //login user
    if(isset($_POST['login_btn'])){
        $username = stringEscape($_POST['username']);
        $password = stringEscape($_POST['password']);
    
        if(empty($username)){array_push($errors, "Se requiere un usuario");}
        if(empty($password)){array_push($errors, "Se requiere una contraseña");}
        if(empty($errors)){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql_login = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";

            $query_login = mysqli_query($connection, $sql_login);

            if(mysqli_num_rows($query_login) > 0){
                //get id
                $register_user_id = mysqli_fetch_assoc($query_login)['id'];

                // put in session array
                $_SESSION['user'] = getUserById($register_user_id);

                // redirect to dashboard admin
                if(in_array($_SESSION['user']['role'], ['Admin', 'Author'])){
                    $_SESSION['message'] = "Se ha iniciado correctamente";
                    header('location: ' . BASE_URL . '/admin/dashboard.php');
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