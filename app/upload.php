<?php
set_time_limit(0);

if(isset($_POST['submit'])) {
    $path = __DIR__ . '/repo/uploads'; // path to the uploads folder
    // create uploads directory if does not exist
    if (!file_exists($path)) {
        mkdir($path, 0777);
    }

        $tempFile = $_FILES['userUpload']['tmp_name']; // the temp location on server storing the file the user selected using a multipart/form-data enctype
        $origFileSize = filesize($tempFile); // get the filesize
        $targetFile = $_FILES['userUpload']['name']; // use the original 'name' of the file
        $path = __DIR__ . '/repo/uploads'; // path to the uploads folder
        $targetFile = $path . "/" . $targetFile; // the full target file path to store the file

        $chunk_size = 256; // chunk in bytes
        $bytesUploaded = 0; // initialize

        $temp = fopen($tempFile, "rb");
        $target = fopen($targetFile, 'w');

        while ($bytesUploaded < $origFileSize) {
            $contents = fread($temp, $chunk_size); // read chunk temp file
            fwrite($target, $contents); // write chunk to target file

            // strlen() returns the number of bytes rather than the number of characters in a string.
            $bytesUploaded += strlen($contents); // keep track of bytes uploaded
            fseek($temp, $bytesUploaded); // forward the filepointer on temp file to next chunk
        }

        fclose($temp);
        fclose($target);
        unlink($_FILES['file']['tmp_name']);
        //echo "File uploaded successfully (" . $bytesUploaded . " bytes ).";
}