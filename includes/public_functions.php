<?php

/***************************
 * Returns authorized posts *
 ****************************/
function getPublishedPosts()
{
    global $connection;
    $sql_posts = "SELECT * FROM posts WHERE published = true ORDER BY created_at DESC";
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

function getPost($slug)
{
    global $connection;

    $post_slug = $_GET['post-slug'];
    $sql_slug = "SELECT * FROM posts WHERE slug='$post_slug' AND published=true";
    $query_slug = mysqli_query($connection, $sql_slug);

    $post = mysqli_fetch_assoc($query_slug);

    if ($post) {
        $post['topic'] = getPostTopic($post['id']);
    }

    return $post;
}

/***************************
 *  Returns all topics      * 
 ****************************/

function getAllTopics()
{
    global $connection;
    $sql_topics = "SELECT * FROM topics";
    $query_topics = mysqli_query($connection, $sql_topics);
    $topics = mysqli_fetch_all($query_topics, MYSQLI_ASSOC);

    return $topics;
}

/***************************
 *  Returns all sponsors      * 
 ****************************/

function getAllSponsors()
{
    global $connection;
    $sql_sponsors = "SELECT * FROM sponsors";
    $query_sponsors = mysqli_query($connection, $sql_sponsors);
    $sponsors = mysqli_fetch_all($query_sponsors, MYSQLI_ASSOC);

    return $sponsors;
}

/***************************
 *  Get Last Posts           * 
 ****************************/

function getLastPosts($post_id, $records)
{
    global $connection;

    $sql_posts = "SELECT * FROM posts WHERE published = true AND id <> " . $post_id . " ORDER BY created_at DESC LIMIT " . $records;
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
 * Add View           * 
 ****************************/

 function addView($post_id){
     global $connection;

    $query = "UPDATE `posts` SET `views`= views + 1 WHERE `id` = " . $post_id;
    mysqli_query($connection, $query);
 }