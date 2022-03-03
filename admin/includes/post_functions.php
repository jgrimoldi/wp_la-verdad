<?php
// Post variables
$post_id = 0;
$isEditingPost = false;
$published = 0;
$title = "";
$post_slug = "";
$body = "";
$featured_image = "";
$post_topic = "";

/* - - - - - - - - - - 
-  Post actions
- - - - - - - - - - -*/
// if user clicks the create post button
if (isset($_POST['create_post'])) {
    createPost($_POST);
}
// if user clicks the Edit post button
if (isset($_GET['edit-post'])) {
    $isEditingPost = true;
    $post_id = $_GET['edit-post'];
    editPost($post_id);
}
// if user clicks the update post button
if (isset($_POST['update_post'])) {
    updatePost($_POST);
}
// if user clicks the Delete post button
if (isset($_GET['delete-post'])) {
    $post_id = $_GET['delete-post'];
    deletePost($post_id);
}

// if user clicks the publish post button
if (isset($_GET['publish']) || isset($_GET['unpublish'])) {
	$message = "";
	if (isset($_GET['publish'])) {
		$message = "La noticia ha sido publicada.";
		$post_id = $_GET['publish'];
	} else if (isset($_GET['unpublish'])) {
		$message = "La noticia ya no se vera en el portal.";
		$post_id = $_GET['unpublish'];
	}
	togglePublishPost($post_id, $message);
}

/* - - - - - - - - - - 
-  Post functions
- - - - - - - - - - -*/
// get all posts from DB
function getAllPosts()
{
    global $connection;

    // Admin can view all posts
    // Author can only view their posts
    if ($_SESSION['user']['role'] == "Admin") {
        $sql_posts = "SELECT * FROM posts";
    } elseif ($_SESSION['user']['role'] == "Author") {
        $user_id = $_SESSION['user']['id'];
        $sql_posts = "SELECT * FROM posts WHERE user_id=$user_id";
    }
    $query_posts = mysqli_query($connection, $sql_posts);
    $posts = mysqli_fetch_all($query_posts, MYSQLI_ASSOC);

    $final_posts = array();
    foreach ($posts as $post) {
        $post['author'] = getPostAuthorById($post['user_id']);
        array_push($final_posts, $post);
    }

    return $final_posts;
}

function getPostAuthorById($user_id)
{
    global $connection;
    $sql_user = "SELECT username FROM users WHERE id=$user_id";
    $query_user = mysqli_query($connection, $sql_user);
    if ($query_user) {
        // return username
        return mysqli_fetch_assoc($query_user)['username'];
    } else {
        return null;
    }
}

function createPost($request_values)
{
    global $connection, $errors, $title, $featured_image, $topic_id, $body, $published;
    $title = stringEscape($request_values['title']);
    $body = htmlentities(stringEscape($request_values['body']));

    if (isset($request_values['topic_id'])) {
        $topic_id = stringEscape($request_values['topic_id']);
    }

    if (isset($request_values['publish'])) {
        $published = stringEscape($request_values['publish']);
    }

    // create slug: if title is "The Storm Is Over", return "the-storm-is-over" as slug
    $post_slug = makeSlug($title);
    // validate form
    if (empty($title)) {
        array_push($errors, "Se requiere un título para la noticia.");
    }
    if (empty($body)) {
        array_push($errors, "No ha escrito nada en el cuerpo de la noticia.");
    }
    if (empty($topic_id)) {
        array_push($errors, "Elija un Tema para la noticia.");
    }

    // Get image name
    $featured_image = $_FILES['featured_image']['name'];
    if (empty($featured_image)) {
        array_push($errors, "Se requiere al menos una imagen.");
    }
    // image file directory
    $target = "../static/images/" . basename($featured_image);
    if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
        array_push($errors, "Ocurrio un error al subir la imagen. Contáctase con el servicio.");
    }

    // Ensure that no post is saved twice. 
    $post_check_query = "SELECT * FROM posts WHERE slug='$post_slug' LIMIT 1";
    $result = mysqli_query($connection, $post_check_query);

    if (mysqli_num_rows($result) > 0) { // if post exists
        array_push($errors, "Ya existe un post con este título. Verifique que sea correcto.");
    }

    // create post if there are no errors in the form
    if (count($errors) == 0) {
        $query = "INSERT INTO posts (user_id, title, slug, image, body, published, created_at, updated_at) VALUES(1, '$title', '$post_slug', '$featured_image', '$body', $published, now(), now())";
        if (mysqli_query($connection, $query)) { // if post created successfully
            $inserted_post_id = mysqli_insert_id($connection);
            // create relationship between post and topic
            $sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($inserted_post_id, $topic_id)";
            mysqli_query($connection, $sql);

            $_SESSION['message'] = "La noticia fue creada correctamente.";
            header('location: postmanager.php');
            exit(0);
        }
    }
}

/* * * * * * * * * * * * * * * * * * * * *
* - Takes post id as parameter
* - Fetches the post from database
* - sets post fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */

function editPost($role_id)
{
    global $connection, $title, $body, $published; // $post_slug, $isEditingPost, $post_id;
    $sql = "SELECT * FROM posts WHERE id=$role_id LIMIT 1";
    $result = mysqli_query($connection, $sql);
    $post = mysqli_fetch_assoc($result);
    // set form values on the form to be updated
    $title = $post['title'];
    $body = $post['body'];
    $published = $post['published'];
}

function updatePost($request_values)
{
    global $connection, $errors, $post_id, $title, $featured_image, $topic_id, $body, $published;

    $title = stringEscape($request_values['title']);
    $body = stringEscape($request_values['body']);
    $post_id = stringEscape($request_values['post_id']);

    if (isset($request_values['topic_id'])) {
        $topic_id = stringEscape($request_values['topic_id']);
    }
    // create slug: if title is "The Storm Is Over", return "the-storm-is-over" as slug
    $post_slug = makeSlug($title);

    if (empty($title)) {
        array_push($errors, "Vas a publicar una noticia sin título?");
    }
    if (empty($body)) {
        array_push($errors, "Falta el cuerpo de la noticia.");
    }
    // if new featured image has been provided
    if (isset($_POST['featured_image'])) {
        // Get image name
        $featured_image = $_FILES['featured_image']['name'];
        // image file directory
        $target = "../static/images/" . basename($featured_image);
        if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
            array_push($errors, "Hubo un fallo al subir la imagen.");
        }
    }

    // register topic if there are no errors in the form
    if (count($errors) == 0) {
        $query = "UPDATE posts SET title='$title', slug='$post_slug', views=0, image='$featured_image', body='$body', published=$published, updated_at=now() WHERE id=$post_id";
        // attach topic to post on post_topic table
        if (mysqli_query($connection, $query)) { // if post created successfully
            if (isset($topic_id)) {
                $inserted_post_id = mysqli_insert_id($connection);
                // create relationship between post and topic
                $sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($inserted_post_id, $topic_id)";
                mysqli_query($connection, $sql);
                $_SESSION['message'] = "La noticia fue creada correctamente.";
                header('location: postmanager.php');
                exit(0);
            }
        }
        $_SESSION['message'] = "La noticia fue actualizada :)";
        header('location: postmanager.php');
        exit(0);
    }
}

// delete blog post
function deletePost($post_id)
{
    global $connection;
    $sql = "DELETE FROM posts WHERE id=$post_id";
    if (mysqli_query($connection, $sql)) {
        $_SESSION['message'] = "Nos despedimos del post :(";
        header("location: postmanager.php");
        exit(0);
    }
}

// publish/unpublish posts
function togglePublishPost($post_id, $message)
{
	global $connection;
	$sql = "UPDATE posts SET published=!published WHERE id=$post_id";
	
	if (mysqli_query($connection, $sql)) {
		$_SESSION['message'] = $message;
		header("location: postmanager.php");
		exit(0);
	}
}