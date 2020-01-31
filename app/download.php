<?php

if (isset($_GET['download'])) {
    $fileName = urldecode($_GET['download']);
    $filePath = __DIR__ . "\\repo\\uploads\\" . $fileName;
    if (file_exists($filePath)) {
        $mime = mime_content_type($filePath);
        if ($mime) {
            forceDownload($filePath, $fileName, $mime);
        }
    }
}

//
// if you want a pop-up window to show 'open with / save file',
// then MUST use: header('Content-Disposition: attachment; filename=' . $fileName);
// Here, $fileName does not have to be the actual path to the file, it is just what is
// displayed in the pop-up window. We prefer to use the $fileName here, not the full $filePath.
//
// 2020/01/31: we turn-off file downloading, we only want to see the files in browser tab.

// 2020/01/31: we find xls files need the 'attachment' header to work correctly. PDF, txt we
// can view in browser sans probleme. We're going to build an exception code block to turn
// the 'Content-Disposition: attachment; filename=...' header on when needed. But not for all files, as
// we prefer them to be opened for viewing in browser directly, not downloaded.
function forceDownload($filePath = '', $fileName = '', $mime = ''): bool
{
    $size = filesize($filePath);
    header('Content-Description: File Transfer');
    //header('Content-Disposition: attachment; filename="' . $fileName . '"'); // $fileName is what you want displayed in the 'open with / save' dialog
    header('Content-Disposition: inline; filename="' . $fileName . '"'); // $fileName is what you want displayed in the 'open with / save' dialog
    header('Content-Type: ' . $mime);
    header('Connection: Keep-Alive');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . $size);

    ob_clean();
    flush();
    readfile($filePath);
}