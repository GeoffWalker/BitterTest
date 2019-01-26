<?php

if (empty($_FILES['pic']['name'])){
    echo "error, please select an image to upload.";
}
else{ //by default, 1mb is max file size.
    if ($_FILES['pic']['size'] > 1024*1024){
        echo "error, file must be 1MB or smaller.";
        unlink($_FILES['pic']['temp_name']);
    }
    else{
        if(!move_uploaded_file($_FILES['pic']['tmp_name'], "Images/" . $_FILES['pic']['name'])){
            echo "ERROR: handling uploaded file";
            unlink($_FILES['pic']['temp_name']);
        }
        else{
            //file upload worked.
            // update the profile_pic field in the users table of the DB.
            echo "it worked";
        }
    }
}

?>