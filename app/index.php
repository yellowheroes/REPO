<?php
include('./header.php');
include('./helpers.php');

$heading = heading('Upload File');
$fileUploadForm = <<<HEREDOC
$heading
<form method="post" enctype="multipart/form-data" action="./upload.php">
<input type="file" name="userUpload" value="">
<input type="submit" name="submit" value="upload file">
</form>\r\n\r\n
HEREDOC;
echo $fileUploadForm;

echo "<br />\r\n";

$dir = __DIR__ . "/repo/uploads";
$files = scandir($dir); // directory contents of uploads folder to array
echo heading('Repository', 2, 'click a title to view/download');
echo '<table>';
foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        echo '<tr>';
        echo '<td class="newyork title">';
        echo "<a href='download.php?download=" . urlencode($file) . "' target='_blank'>$file</a>";
        echo '</td>';
        echo '<td class="newyork delete">';
        echo "<a href='unlink.php?unlink=" . urlencode($file) . "' title='delete file: " . $file . "'><button>delete</button></a>";
        echo '</td>';
        echo '</tr>';
    }
}
echo '</table>';

include('./footer.php');