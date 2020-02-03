<?php
/**
 * Created by Yellow Heroes
 * Project: repo
 * File: xhr.php
 * User: Robert
 * Date: 2/3/2020
 * Time: 14:00
 */
function async($uri = '', $method = 'GET', $data = []): string
{
    $formDataScript = '';
    if (!empty($data)) {
        $formDataScript = <<<HEREDOC
// insert the formData script (javascript)
var formData = new FormData(); \r\n
HEREDOC;
        foreach ($data as $key => $value) {
            $formDataScript .= <<<HEREDOC
formData.append("$key", "$value"); \r\n
HEREDOC;
        }
    } else {
        $formDataScript = <<<HEREDOC
var formData = null; // set to null, we're not sending data
HEREDOC;
    }

    $async = <<<HEREDOC
<script>
  function responseListener() {
     console.log(this.responseText);
     document.getElementById('ajaxresponse').innerHTML = this.responseText;
 }

 let oReq = new XMLHttpRequest(); // instantiate xhr object
 oReq.addEventListener("load", responseListener); // invoke function 'responseListener' when response is received
 oReq.open("$method", "$uri"); // prepare the AJAX request (method, uri) \r\n
 $formDataScript
 /* formData == null in case not sending data */
 oReq.send(formData); // launch the AJAX request, possibly with POST data
</script>\r\n\r\n
HEREDOC;

    return $async; // return the AJAX script to caller
}