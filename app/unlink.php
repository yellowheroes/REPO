<?php
/**
 * Created by Yellow Heroes
 * Project: scratchpad
 * File: unlink.php
 * User: Robert
 * Date: 1/31/2020
 * Time: 12:15
 */
if (isset($_GET['unlink'])) {
    $fileName = urldecode($_GET['unlink']);
    $filePath = __DIR__ . "\\repo\\uploads\\" . $fileName;
    if (file_exists($filePath)) {
       unlink($filePath);
        header('Location: ./index.php');
    }
}