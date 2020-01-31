<?php
if(isset($_POST['submit'])) {
    echo '<pre>';
    var_dump($_FILES);
    echo '</pre>';
}
$tmpName = $_FILES['userUpload']['tmp_name'];
$dstName = $_FILES['userUpload']['name'];
//echo __DIR__; // D:\Users\Robert\Documents\z_other\coding\php\z_other\scratchpad\upload-and-download-files\app
$path = __DIR__ . '\repo\uploads';
$destination = $path . "\\" . $dstName;
echo $destination;
if(move_uploaded_file($tmpName, $destination)) {
    header('Location: ./index.php');
}
