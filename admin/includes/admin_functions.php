<?php
// Admin user variables
$admin_id = 0;
$isEditingUser = false;
$username = "";
$role = "";
$email = "";

// Topics variables
$topic_id = 0;
$isEditingTopic = false;
$topic_name = "";

// general variables
$errors = [];

/* - - - - - - - - - - 
-  Admin users actions
- - - - - - - - - - -*/
// if user clicks the create admin button
if (isset($_POST['create_admin'])) {
	createAdmin($_POST);
}
// if user clicks the Edit admin button
if (isset($_GET['edit-admin'])) {
	$isEditingUser = true;
	$admin_id = $_GET['edit-admin'];
	editAdmin($admin_id);
}
// if user clicks the update admin button
if (isset($_POST['update_admin'])) {
	updateAdmin($_POST);
}
// if user clicks the Delete admin button
if (isset($_GET['delete-admin'])) {
	$admin_id = $_GET['delete-admin'];
	deleteAdmin($admin_id);
}

/* - - - - - - - - - - 
-  Topic actions
- - - - - - - - - - -*/
// if user clicks the create topic button
if (isset($_POST['create_topic'])) {
	createTopic($_POST);
}
// if user clicks the Edit topic button
if (isset($_GET['edit-topic'])) {
	$isEditingTopic = true;
	$topic_id = $_GET['edit-topic'];
	editTopic($topic_id);
}
// if user clicks the update topic button
if (isset($_POST['update_topic'])) {
	updateTopic($_POST);
}
// if user clicks the Delete topic button
if (isset($_GET['delete-topic'])) {
	$topic_id = $_GET['delete-topic'];
	deleteTopic($topic_id);
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Returns all admin users and their corresponding roles
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function getAdminUsers()
{
	global $connection;
	$sql = "SELECT * FROM users WHERE role IS NOT NULL";
	$result = mysqli_query($connection, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $users;
}
/* * * * * * * * * * * * * * * * * * * * *
* - stringEscape form submitted value, hence, preventing SQL injection
* * * * * * * * * * * * * * * * * * * * * */
function stringEscape(String $value)
{
	// bring the global db connect object into function
	global $connection;
	// remove empty space sorrounding string
	$val = trim($value);
	$val = mysqli_real_escape_string($connection, $value);
	return $val;
}

// make url description for topics
function makeSlug(String $string)
{
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

/* - - - - - - - - - - - -
-  Admin users functions
- - - - - - - - - - - - -*/
/* * * * * * * * * * * * * * * * * * * * * * *
* - Receives new admin data from form
* - Create new admin user
* - Returns all admin users with their roles 
* * * * * * * * * * * * * * * * * * * * * * */
function createAdmin($request_values)
{
	global $connection, $errors, $role, $username, $email;

	$username = stringEscape($request_values['username']);
	$email = stringEscape($request_values['email']);
	$password = stringEscape($request_values['password']);
	$password_verify = stringEscape($request_values['password_verify']);

	if (isset($request_values['role'])) {
		$role = stringEscape($request_values['role']);
	}
	// form validation: ensure that the form is correctly filled
	if (empty($username)) {
		array_push($errors, "Hace falta un nombre de Usuario.");
	}
	if (empty($email)) {
		array_push($errors, "Oops.. El correo no es válido.");
	}
	if (empty($role)) {
		array_push($errors, "Se requiere un Rol para Usuarios.");
	}
	if (empty($password)) {
		array_push($errors, "Te olvidaste de escribir la contraseña.");
	}
	if ($password != $password_verify) {
		array_push($errors, "Las contraseñas son incorrectas o no concuerdan.");
	}

	// User check if exists
	$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
	$result = mysqli_query($connection, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	if ($user) { // if user exists
		if ($user['username'] === $username) {
			array_push($errors, "Este nombre de Usuario ya existe.");
		}

		if ($user['email'] === $email) {
			array_push($errors, "Este email ya esta registrado.");
		}
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = password_hash($password, PASSWORD_DEFAULT); //encrypt the password before saving in the database
		$query = "INSERT INTO users (username, email, role, password, created_at, updated_at) 
				  VALUES('$username', '$email', '$role', '$password', now(), now())";
		mysqli_query($connection, $query);

		$_SESSION['message'] = "Usuario generado correctamente.";
		header('location: usermanager.php');
		exit(0);
	}
}
/* * * * * * * * * * * * * * * * * * * * *
* - Takes admin id as parameter
* - Fetches the admin from database
* - sets admin fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editAdmin($admin_id)
{
	global $connection, $username, $admin_id, $email; //$role, $isEditingUser,

	$sql = "SELECT * FROM users WHERE id=$admin_id LIMIT 1";
	$result = mysqli_query($connection, $sql);
	$admin = mysqli_fetch_assoc($result);

	// set form values ($username and $email) on the form to be updated
	$username = $admin['username'];
	$email = $admin['email'];
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Receives admin request from form and updates in database
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function updateAdmin($request_values)
{
	global $connection, $errors, $role, $username, $isEditingUser, $admin_id, $email;
	// get id of the admin to be updated
	$admin_id = $request_values['admin_id'];
	// set edit state to false
	$isEditingUser = false;

	$username = stringEscape($request_values['username']);
	$email = stringEscape($request_values['email']);
	$password = stringEscape($request_values['password']);
	$password_verify = stringEscape($request_values['password_verify']);

	if (isset($request_values['role'])) {
		$role = $request_values['role'];
	}
	if ($password != $password_verify) {
		array_push($errors, "Las contraseñas son incorrectas o no concuerdan.");
	}
	// register user if there are no errors in the form
	if (count($errors) == 0) {
		//encrypt the password (security purposes)
		$password = password_hash($password, PASSWORD_DEFAULT);;

		$query = "UPDATE users SET username='$username', email='$email', role='$role', password='$password' WHERE id=$admin_id";
		mysqli_query($connection, $query);

		$_SESSION['message'] = "Usuario actualizado correctamente.";
		header('location: usermanager.php');
		exit(0);
	}
}

// delete admin user 
function deleteAdmin($admin_id)
{
	global $connection;
	$sql = "DELETE FROM users WHERE id=$admin_id";
	if (mysqli_query($connection, $sql)) {
		$_SESSION['message'] = "Usuario eliminado correctamente.";
		header("location: usermanager.php");
		exit(0);
	}
}


/* - - - - - - - - - - 
-  Topics functions
- - - - - - - - - - -*/
// get all topics from DB
function getAllTopics()
{
	global $connection;
	$sql = "SELECT * FROM topics";
	$result = mysqli_query($connection, $sql);
	$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $topics;
}

// create topic on DB
function createTopic($request_values)
{
	global $connection, $errors, $topic_name;
	$topic_name = stringEscape($request_values['topic_name']);
	// create slug: if topic is "Life Advice", return "life-advice" as slug
	$topic_slug = makeSlug($topic_name);
	// validate form
	if (empty($topic_name)) {
		array_push($errors, "Se requiere un nombre para el Tema.");
	}

	// check if topic exists 
	$topic_check_query = "SELECT * FROM topics WHERE slug='$topic_slug' LIMIT 1";
	$result = mysqli_query($connection, $topic_check_query);
	if (mysqli_num_rows($result) > 0) { // if topic exists
		array_push($errors, "Este Tema ya existe.");
	}

	// register topic if there are no errors in the form
	if (count($errors) == 0) {
		$query = "INSERT INTO topics (name, slug) VALUES('$topic_name', '$topic_slug')";
		mysqli_query($connection, $query);

		$_SESSION['message'] = "Tema creado correctamente.";
		header('location: topics.php');
		exit(0);
	}
}

/* * * * * * * * * * * * * * * * * * * * *
* - Takes topic id as parameter
* - Fetches the topic from database
* - sets topic fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editTopic($topic_id)
{
	global $connection, $topic_name, $topic_id;
	$sql = "SELECT * FROM topics WHERE id=$topic_id LIMIT 1";
	$result = mysqli_query($connection, $sql);
	$topic = mysqli_fetch_assoc($result);
	// set form values ($topic_name) on the form to be updated
	$topic_name = $topic['name'];
}

function updateTopic($request_values)
{
	global $connection, $errors, $topic_name, $topic_id;
	$topic_name = stringEscape($request_values['topic_name']);
	$topic_id = stringEscape($request_values['topic_id']);
	// create slug: if topic is "Life Advice", return "life-advice" as slug
	$topic_slug = makeSlug($topic_name);
	// validate form
	if (empty($topic_name)) {
		array_push($errors, "Se requiere un nombre para el Tema.");
	}
	// register topic if there are no errors in the form
	if (count($errors) == 0) {
		$query = "UPDATE topics SET name='$topic_name', slug='$topic_slug' WHERE id=$topic_id";
		mysqli_query($connection, $query);

		$_SESSION['message'] = "Tema actualizado correctamente.";
		header('location: topics.php');
		exit(0);
	}
}
// delete topic 
function deleteTopic($topic_id)
{
	global $connection;
	$sql = "DELETE FROM topics WHERE id=$topic_id";
	if (mysqli_query($connection, $sql)) {
		$_SESSION['message'] = "El Tema fue borrado.";
		header("location: topics.php");
		exit(0);
	}
}
