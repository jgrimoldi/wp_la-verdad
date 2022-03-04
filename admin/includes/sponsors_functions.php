<?php

if (isset($_POST['upload_sponsor'])) {
    uploadSponsor();
}


if (isset($_GET['delete-sponsor'])) {
    $post_id = $_GET['delete-sponsor'];
    deleteSponsor($post_id);
}


function getAllSponsors()
{
    global $connection;

    $sql_sponsors = "SELECT * FROM sponsors";
    $query_sponsors = mysqli_query($connection, $sql_sponsors);
    $sponsors = mysqli_fetch_all($query_sponsors, MYSQLI_ASSOC);

    $final_sponsors = array();

    foreach ($sponsors as $sponsor) {
        array_push($final_sponsors, $sponsor);
    }

    return $final_sponsors;
}


function uploadSponsor()
{

    global $connection, $errors;

    $folder = ROOT_PATH . "/static/img/sponsors/";
    $allowedTypes = array('jpg', 'png', 'jpeg');
    $sqlvalue_insert = '';

    $fileNames = array_filter($_FILES['files']['name']);
    if (!empty($fileNames)) {
        foreach ($fileNames as $key => $files) {
            $fileName = basename($_FILES['files']['name'][$key]);
            $folderPath = $folder . $fileName;

            $fileType = pathinfo($folderPath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $folderPath)) {
                    $sqlvalue_insert .= "('" . $fileName . "', NOW()),";
                } else {
                    array_push($errors, "No se pudo subir el archivo.");
                }
            } else {
                array_push($errors, "No se pudo subir. El archivo debe tener extensión jpg/png/jpeg");
            }
        }

        if (count($errors) == 0) {
            if (!empty($sqlvalue_insert)) {
                $sqlvalue_insert = trim($sqlvalue_insert, ',');
                $sql_insert_image = "INSERT INTO sponsors (filename, image_text) VALUES" . $sqlvalue_insert;
                mysqli_query($connection, $sql_insert_image);

                $_SESSION['message'] = "Sponsor subido correctamente.";
            } else {
                array_push($errors, "No se pudo subir el archivo.");
            }
        }
    }
}

function deleteSponsor($id_sponsor)
{
    global $connection;
    $folder = ROOT_PATH . "/static/img/sponsors/";

    $sql_select = "SELECT * FROM sponsors WHERE id=$id_sponsor";
    $query_select = mysqli_query($connection, $sql_select);
    $result = mysqli_fetch_assoc($query_select);

    $sponsor_delete = $result['filename'];

    if (unlink($folder . $sponsor_delete)) {
        $sql_delete = "DELETE FROM sponsors WHERE id=$id_sponsor";
        if (mysqli_query($connection, $sql_delete)) {
            $_SESSION['message'] = "Adios sponsor, no te vamos a extrañar.";
        }
    }
}
