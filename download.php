<?php

$file_path = isset($_GET['name']) ? $_GET['name'] : '';

echo $file_path; 
if (!empty($file_path) && file_exists('Files'. '/' . $file_path)) {
    $file_info = pathinfo($file_path);
    $file_name = basename($file_path);
    $file_extension = strtolower($file_info['extension']);

    if ($file_extension == 'pdf') {
        $content_type = 'application/pdf';
    } elseif ($file_extension == 'jpg' || $file_extension == 'jpeg') {
        $content_type = 'image/jpeg';
    } elseif ($file_extension == 'png') {
        $content_type = 'image/png';
    } else {
        $content_type = 'application/docx'; 
     }

    header('Content-Type: ' . $content_type); 
    header('Content-Disposition: attachment; filename="' . $file_name . '"'); 
    header('Content-Length: ' . filesize('Files' . '/' . $file_path));

    readfile('Files' . '/' . $file_path);
   
} else {
    echo "no file";
}
 //header("location: /assign.php?project_id=".$_GET['project_id']."");





?>
