<?php 

    function uploadFile($allowed_extensions, $upload_dir){
        $profile_photo = uniqid();
        $client_extension = end(explode('.', $_FILES['profile_photo']['name']));

        if(!in_array($client_extension, $allowed_extensions)){
            exit("Nedozovoljen format slike...");
        }
        $profile_photo = $profile_photo.".".$client_extension;

        $tmp_path = $_FILES['profile_photo']['tmp_name'];
        $new_photo_path = $upload_dir.$profile_photo;
        if(!copy($tmp_path, $new_photo_path)){
            exit("Greska pri upload-u slike...");
        }

        return $new_photo_path;
    }

    function deletePhotoForUser($contact_id){
        global $db_connection;
        $sql = "SELECT profile_photo FROM contacts WHERE id = $contact_id";
        $res = mysqli_query($db_connection, $sql);

        $profile_photo = mysqli_fetch_assoc($res)['profile_photo'];
        return unlink($profile_photo);
    }

?>