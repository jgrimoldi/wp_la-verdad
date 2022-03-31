<?php


function totalPublishedPosts()
{
    global $connection;
    // $sql_posts = "SELECT * FROM posts WHERE published = true ORDER BY created_at DESC, pinned ASC";
    $sql_posts = "SELECT * FROM posts WHERE published = '1' AND id IN (SELECT `post_id` FROM post_topic WHERE topic_id IN (SELECT id FROM topics WHERE name <> 'Empleos' AND name <> 'Búsquedas'))";
    $query_posts = mysqli_query($connection, $sql_posts);
    $total_posts = mysqli_num_rows($query_posts);

    return $total_posts;
}

/***************************
 * Returns authorized posts *
 ****************************/
function getPublishedPosts($limit, $offset)
{
    global $connection;
    // $sql_posts = "SELECT * FROM posts WHERE published = true ORDER BY created_at DESC, pinned ASC";
    $sql_posts = "SELECT * FROM posts WHERE published = '1' AND id IN (SELECT `post_id` FROM post_topic WHERE topic_id IN (SELECT id FROM topics WHERE name <> 'Empleos' AND name <> 'Búsquedas')) ORDER BY `posts`.`pinned` DESC, `posts`.`created_at` DESC LIMIT " . $offset . "," . $limit;
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
 * Returns authorized jobs *
 ****************************/
function getPublishedPostBy($topic)
{
    global $connection;
    $sql_posts = "SELECT * FROM posts WHERE published = '1' AND id IN (SELECT `post_id` FROM post_topic WHERE topic_id = (SELECT id FROM topics WHERE name = '" . $topic . "')) ORDER BY `posts`.`pinned` DESC, `posts`.`created_at` DESC";

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
    $sql_topic = "SELECT * FROM topics WHERE id = (SELECT topic_id FROM post_topic WHERE post_id=$post_id)";
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
 * Returns if the visitor   *
 * not seen the page    * 
 ****************************/

function is_unique_view($visitor_ip, $post_id)
{
    global $connection;

    $query = "SELECT * FROM visitors WHERE post_id = " . $post_id .  " AND visitor_ip ='" . $visitor_ip . "'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        return false;
    } else {
        return true;
    }
}


/***************************
 * Add View           * 
 ****************************/

function addView($post_id, $visitor_ip)
{
    global $connection;

    if (is_unique_view($visitor_ip, $post_id)) {
        // insert unique visitor record for checking whether the visit is unique or not in future.
        $query_insert = "INSERT INTO visitors (visitor_ip, post_id) VALUES ('" . $visitor_ip . "' , " . $post_id . ")";

        if (mysqli_query($connection, $query_insert)) {
            // At this point unique visitor record is created successfully. Now update total_views of specific page.
            $query_update = "UPDATE posts SET views = views + 1 WHERE id = " . $post_id;
            if (!mysqli_query($connection, $query_update)) {
                echo mysqli_error($connection);
            }
        } else {
            echo mysqli_error($connection);
        }
    }
}