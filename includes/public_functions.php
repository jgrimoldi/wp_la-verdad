<?php

/***************************
 * Returns authorized posts *
 ****************************/
function getPublishedPosts()
{
    global $connection;
    $sql_posts = "SELECT * FROM posts WHERE published = true";
    $query_posts = mysqli_query($connection, $sql_posts);

    $posts = mysqli_fetch_all($query_posts, MYSQLI_ASSOC);

    $final_posts = array();
    foreach ($posts as $post) {
        $post['topic'] = getPostTopic($post['id']);
        array_push($final_posts, $post);
    }

    return $final_posts;
}

/***************************
 * Returns the topic of the *
 * post according to the id *
 ****************************/

function getPostTopic($post_id)
{
    global $connection;
    $sql_topic = "SELECT * FROM topics WHERE id = (SELECT topic_id FROM post_topic WHERE post_id=$post_id) LIMIT 1";
    $query_topic = mysqli_query($connection, $sql_topic);
    $topic = mysqli_fetch_assoc($query_topic);
    return $topic;
}

/***************************
 * Returns all posts under a *
 *           topic           *
 ****************************/

function getPublishedPostsByTopic($topic_id)
{
    global $connection;
    $sql_posts = "SELECT * FROM posts ps WHERE ps.id IN 
        (SELECT pt.post_id FROM post_topic pt WHERE pt.topic_id=$topic_id GROUP BY pt.post_id HAVING COUNT(1) = 1)";
    $query_posts = mysqli_query($connection, $sql_posts);

    $posts = mysqli_fetch_all($query_posts, MYSQLI_ASSOC);

    $final_posts = array();
    foreach ($posts as $post) {
        $post['topic'] = getPostTopic($post['id']);
        array_push($final_posts, $post);
    }

    return $final_posts;
}

/***************************
 * Returns topic name by id *
 ****************************/

function getTopicNameById($id)
{
    global $connection;
    $sql_topic = "SELECT name FROM topics WHERE id=$id";
    $query_topic = mysqli_query($connection, $sql_topic);
    $topic = mysqli_fetch_assoc($query_topic);
    return $topic['name'];
}

/***************************
 *  Returns clicked post    * 
 ****************************/

function getPost($slug){
    global $connection;

    $post_slug = $_GET['post-slug'];
    $sql_slug = "SELECT * FROM posts WHERE slug='$post_slug' AND published=true";
    $query_slug = mysqli_query($connection, $sql_slug);

    $post = mysqli_fetch_assoc($query_slug);

    if($post){
        $post['topic'] = getPostTopic($post['id']);
    }

    return $post;
}

/***************************
 *  Returns all topics      * 
 ****************************/

 function getAllTopics(){
     global $connection;
     $sql_topics = "SELECT * FROM topics";
     $query_topics = mysqli_query($connection, $sql_topics);
     $topics = mysqli_fetch_all($query_topics, MYSQLI_ASSOC);

     return $topics;
 }