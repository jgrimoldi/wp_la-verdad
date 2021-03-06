<?php

include ROOT_PATH . '/admin/vendor/autoload.php';

use WebPConvert\WebPConvert;

$options = [];

// Post variables
$post_id = 0;
$isEditingPost = false;
$published = 0;
$title = "";
$subtitle = "";
$post_slug = "";
$body = "";
$featured_image = "";
$video = "";
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

// if user clicks the pinned post button
if (isset($_GET['pin']) || isset($_GET['unpin'])) {
    $message = "";
    if (isset($_GET['pin'])) {
        $message = "La noticia ha sido fijada en el Banner.";
        $post_id = $_GET['pin'];
    } else if (isset($_GET['unpublish'])) {
        $message = "La noticia ya no se vera fijada en el portal.";
        $post_id = $_GET['unpin'];
    }
    togglePinnedPost($post_id, $message);
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
    global $connection, $errors, $title, $subtitle, $featured_image, $video, $topic_id, $body, $published, $options;

    $title = stringEscape($request_values['title']);
    $subtitle = stringEscape($request_values['subtitle']);
    $video = stringEscape($request_values['video_frame']);
    $body = htmlentities(stringEscape($request_values['body']));

    if (isset($request_values['topic_id'])) {
        $topic_id = stringEscape($request_values['topic_id']);
    }

    if (isset($request_values['publish'])) {
        $published = stringEscape($request_values['publish']);
    }

    if (!empty($request_values['phone']) || !empty($request_values['email'])) {
        $body = $body . htmlentities(stringEscape("<i class='job__icon fas fa-phone'></i>" . $request_values['phone'] . "<br><i class='job__icon fas fa-envelope'></i>" . $request_values['email']));
    }

    // create slug: if title is "The Storm Is Over", return "the-storm-is-over" as slug
    $post_slug = makeSlug($title);
    // validate form
    if (empty($title)) {
        array_push($errors, "Se requiere un t??tulo para la noticia.");
    }
    if (empty($body)) {
        array_push($errors, "No ha escrito nada en el cuerpo de la noticia.");
    }
    if (empty($topic_id)) {
        array_push($errors, "Elija un Tema para la noticia.");
    }

    // Get image name
    $folder = ROOT_PATH . "/static/img/uploads/";
    $allowedTypes = array('jpg', 'png', 'jpeg', 'gif', 'mp4', 'mkv');
    $featured_image = $_FILES['featured_image']['name'];

    if (!empty($featured_image)) {

        $featured_image = basename($_FILES['featured_image']['name']);
        $target = $folder . $featured_image;

        $fileType = pathinfo($target, PATHINFO_EXTENSION);

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
                $basename = pathinfo($target);
                $destination = $folder . $basename['filename'] . '.webp';
                WebPConvert::convert($target, $destination, $options);

                $featured_image = renameImage($destination, $title);
                unlink($target);
            } else {
                array_push($errors, "No se pudo subir el archivo.");
            }
        } else {
            array_push($errors, "No se pudo subir. El archivo debe tener extensi??n jpg/png/jpeg");
        }
    }

    if (!empty($video)) {
        $video = makeVideoSlug($video);
        $featured_image = $video[1];
        $video = $video[0];

        if (!empty($featured_image)) {
            $target = $folder . $featured_image;

            $basename = pathinfo($target);
            $destination = $folder . $basename['filename'] . '.webp';
            WebPConvert::convert($target, $destination, $options);

            $featured_image = renameImage($destination, $title);
            unlink($target);
        }
    }

    // Ensure that no post is saved twice. 
    $post_check_query = "SELECT * FROM posts WHERE slug='$post_slug' LIMIT 1";
    $result = mysqli_query($connection, $post_check_query);

    if (mysqli_num_rows($result) > 0) { // if post exists
        array_push($errors, "Ya existe un post con este t??tulo. Verifique que sea correcto.");
    }

    // create post if there are no errors in the form
    if (count($errors) == 0) {
        if (!empty($featured_image) || !empty($video)) {
            $query = "INSERT INTO posts (user_id, title, subtitle, slug, image, video, body, published) VALUES(1, '$title', '$subtitle', '$post_slug', '$featured_image', '$video', '$body', $published)";
            if (mysqli_query($connection, $query)) { // if post created successfully
                $inserted_post_id = mysqli_insert_id($connection);
                // create relationship between post and topic
                $sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($inserted_post_id, $topic_id)";
                mysqli_query($connection, $sql);

                $_SESSION['message'] = "La noticia fue creada correctamente.";
                header('location: postmanager.php');
                exit(0);
            } else {
                array_push($errors, "Ocurri?? un error al crear la noticia." . $query);
            }
        } else {
            array_push($errors, "No se pudo subir el archivo.");
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
    global $connection, $title, $subtitle, $views, $post_slug, $body, $published, $featured_image, $video, $isEditingPost, $post_id;
    $sql = "SELECT * FROM posts WHERE id=$role_id LIMIT 1";
    $result = mysqli_query($connection, $sql);
    $post = mysqli_fetch_assoc($result);
    // set form values on the form to be updated
    $title = $post['title'];
    $subtitle = $post['subtitle'];
    $body = $post['body'];
    $published = $post['published'];
    $featured_image = $post['image'];
    $video = $post['video'];
}

function updatePost($request_values)
{
    global $connection, $errors, $post_id, $title, $subtitle, $views, $featured_image, $video, $topic_id, $body, $published, $options;

    $title = stringEscape($request_values['title']);
    $subtitle = stringEscape($request_values['subtitle']);
    $body = stringEscape($request_values['body']);
    $post_id = stringEscape($request_values['post_id']);

    if (isset($request_values['f_image'])) {
        $featured_image = stringEscape($request_values['f_image']);
    }

    if (isset($request_values['video_frame'])) {
        $new = makeVideoSlug($request_values['video_frame']);
        $newVideo = $new[0];
        $newImage =  $new[1];
    }

    if (isset($request_values['publish'])) {
        $published = stringEscape($request_values['publish']);
    }

    if (isset($request_values['topic_id'])) {
        $topic_id = stringEscape($request_values['topic_id']);
    }
    // create slug: if title is "The Storm Is Over", return "the-storm-is-over" as slug
    $post_slug = makeSlug($title);

    if (empty($title)) {
        array_push($errors, "La noticia no tiene t??tulo?");
    }
    if (empty($body)) {
        array_push($errors, "Se requiere un cuerpo en la noticia");
    }
    // if new featured image has been provided
    if (!empty($_FILES['featured_image']['name'])) {
        // Get image name
        $folder = ROOT_PATH . "/static/img/uploads/";
        $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
        $featured_image = $_FILES['featured_image']['name'];
        if (!empty($featured_image)) {
            $featured_image = basename($_FILES['featured_image']['name']);
            $target = $folder . $featured_image;

            $fileType = pathinfo($target, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
                    $basename = pathinfo($target);
                    $destination = $folder . $basename['filename'] . '.webp';
                    WebPConvert::convert($target, $destination, $options);

                    $featured_image = renameImage($destination, $title);
                    unlink($target);
                } else {
                    array_push($errors, "No se pudo subir el archivo.");
                }
            } else {
                array_push($errors, "No se pudo subir. El archivo debe tener extensi??n jpg/png/jpeg");
            }
        }
    }

    if (!empty($newVideo)) {
        $sql = "SELECT video FROM posts WHERE id=$post_id LIMIT 1";
        $result = mysqli_query($connection, $sql);
        $post = mysqli_fetch_assoc($result);
        $video = $post['video'];

        if ($video != $newVideo) {

            $folder = ROOT_PATH . "/static/img/uploads/";
            $featured_image = $new[1];
            $video = $new[0];

            if (!empty($featured_image)) {
                $target = $folder . $featured_image;

                $basename = pathinfo($target);
                $destination = $folder . $basename['filename'] . '.webp';
                WebPConvert::convert($target, $destination, $options);

                $featured_image = renameImage($destination, $title);
                unlink($target);
            }
        }
    }

    // register topic if there are no errors in the form
    if (count($errors) == 0) {
        $query = "UPDATE posts SET title='$title', subtitle='$subtitle', slug='$post_slug', image='$featured_image', video = '$newVideo', body='$body', published=$published, updated_at=now() WHERE id=$post_id";
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
        } else {
            array_push($errors, mysqli_error($connection));
        }
    }
}


// delete blog post
function deletePost($post_id)
{
    global $connection, $errors;

    //Delete Image from post
    $sql = "SELECT image FROM posts WHERE id=$post_id LIMIT 1";
    $result = mysqli_query($connection, $sql);
    $post = mysqli_fetch_assoc($result);

    unlink(ROOT_PATH . '/static/img/uploads/' . $post['image']);
    $sql_delete = "DELETE FROM posts WHERE id=$post_id";
    if (mysqli_query($connection, $sql_delete)) {
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

// pin/unpin posts
function togglePinnedPost($post_id, $message)
{
    global $connection;

    $sql_select = "SELECT * FROM posts WHERE pinned = true LIMIT 1";
    $query_select = mysqli_query($connection, $sql_select);

    if (mysqli_num_rows($query_select) > 0) {
        $pinned = mysqli_fetch_assoc($query_select);
        $pinned_id = $pinned['id'];
        $sql_update = "UPDATE posts SET pinned = 0 WHERE id= $pinned_id";
        mysqli_query($connection, $sql_update);
    }

    $sql = "UPDATE posts SET pinned=!pinned WHERE id=$post_id";

    if (mysqli_query($connection, $sql)) {
        $_SESSION['message'] = $message;
        header("location: postmanager.php");
        exit(0);
    }
}

function renameImage($oldName, $title)
{

    $expr = '/(?<=\s|^)[a-z]/i';
    preg_match_all($expr, $title, $matches);
    $acronym = strtoupper(implode('', $matches[0]));
    $number = rand(0, 11111111111);
    $newName = $acronym . "_" . $number . ".webp";
    $newUbication = ROOT_PATH . '/static/img/uploads/' . $newName;
    rename($oldName, $newUbication);

    return $newName;
}

function makeVideoSlug($url)
{
    $thumb = "";

    $pattern = array();
    $pattern[0] = '/height=[0-9]{1,3}/';
    $pattern[1] = '/width=[0-9]{1,3}/';
    $pattern[2] = '/watch\?v=/';


    $replace = array();
    $replace[0] = 'height=315';
    $replace[1] = 'width=560';
    $replace[2] = 'embed/';

    $newUrl = preg_replace($pattern, $replace, $url);

    if (strlen($url) < 70) {
        $thumb = makeYoutubeThumb($newUrl);
    } else {
        // $thumb = 
    }

    $result = array($newUrl, $thumb);

    return $result;
}


function makeYoutubeThumb($url)
{

    $parsed = parse_url($url);
    $pattern = "/\/embed\//";
    $replace = "";
    $query = preg_replace($pattern, $replace, $parsed['path']);
    $file = "https://i2.ytimg.com/vi/" . $query . "/maxresdefault.jpg";
    $image = ROOT_PATH . '/static/img/uploads/' . $query . '.jpg';

    file_put_contents($image, file_get_contents($file));

    return $query . '.jpg';
}
