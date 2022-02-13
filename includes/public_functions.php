<?php

/***************************
* Returns authorized posts *
****************************/
function getPublishedPosts(){
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

function getPostTopic($post_id){
    global $connection;
    $sql_topic = "SELECT * FROM topics WHERE id = (SELECT topic_id FROM post_topic WHERE post_id=$post_id) LIMIT 1";
    $query_topic = mysqli_query($connection, $sql_topic);
    $topic = mysqli_fetch_assoc($query_topic);
    return $topic;
}