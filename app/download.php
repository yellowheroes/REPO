<?php

if (isset($_GET['download'])) {
    $fileName = urldecode($_GET['download']);
    $filePath = __DIR__ . "\\repo\\uploads\\" . $fileName;
    if (file_exists($filePath)) {
        $mime = mime_content_type($filePath);
        if ($mime) {
            viewFile($filePath, $fileName, $mime);
        }
    }
}

function viewFile($filePath = '', $fileName = '', $mime = ''): bool
{
    $size = filesize($filePath);
    header('Content-Description: File Transfer');
    //header('Content-Disposition: attachment; filename="' . $fileName . '"'); // use attachment for force download file
    header('Content-Disposition: inline; filename="' . $fileName . '"'); // use inline for inline in-browser viewing
    header('Content-Type: ' . $mime);
    header('Connection: Keep-Alive');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . $size);

    ob_clean();
    flush();
    if (readfile($filePath)) {
        return true;
    } else {
        return false;
    }
}