<?php

ignore_user_abort(true);
set_time_limit(0); // disable the time limit for this script

$fullPath = sprintf("/home/testuser/public_html/dictionary/download/result_%s.%s", urldecode($time), $type);

if (file_exists($fullPath))
{
    if ($fd = fopen ($fullPath, "r")) {
        $fsize = filesize($fullPath);
        $path_parts = pathinfo($fullPath);
        $ext = strtolower($path_parts["extension"]);
        switch ($ext) {
            case "txt":
            header("Content-type: application/txt");
            header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a file download
            break;
            // add more headers for other content types here
            default;
            header("Content-type: application/octet-stream");
            header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
            break;
        }
        header("Content-length: $fsize");
        header("Cache-control: private"); //use this to open files directly
        while(!feof($fd)) {
            $buffer = fread($fd, 2048);
            echo $buffer;
        }
    }
    fclose ($fd);
}
else
{
    echo "不好意思，系統發生問題，請重新查詢";
}