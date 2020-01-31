<?php
/**
 * Created by Yellow Heroes
 * Project: scratchpad
 * File: helpers.php
 * User: Robert
 * Date: 1/31/2020
 * Time: 11:09
 */

function heading($title = '', $size = 2, $subTitle = '', $hr = true)
{
    $hr = ($hr === true) ? '<hr>' : '';

    $heading = <<<HEREDOC
<div>
$hr
<h$size>$title</h1>
<p>$subTitle</p>
$hr
</div>
HEREDOC;

    return $heading;
}