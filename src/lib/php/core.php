<?php
error_reporting(0); // disable all error 
function ListSubtitle($path)
{
    $dirPath  = dir($path);
    $imgArray = array();
    while (($file = $dirPath->read()) !== false) {
        if ((substr($file, -3) == "srt")) {
            $imgArray[] = trim($file);
        }
    }
    $dirPath->close();
    sort($imgArray);
    $c = count($imgArray);
    for ($i = 0; $i < $c; $i++) {
        echo "<option value=\"" . xss_clean($imgArray[$i]) . "\">" . xss_clean($imgArray[$i]) . "\n";
    }
} // Function ListSubtitle

function delete_files($target)
{
    if (is_dir($target)) {
        $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned
        
        foreach ($files as $file) {
            delete_files($file);
        }
        
        rmdir($target);
    } elseif (is_file($target)) {
        unlink($target);
    }
} // Delete  Files Target Dictonary

function xss_clean($data)
{
    // Fix &entity\n;
    $data = str_replace(array(
        '&amp;',
        '&lt;',
        '&gt;'
    ), array(
        '&amp;amp;',
        '&amp;lt;',
        '&amp;gt;'
    ), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
    do {
        // Remove really unwanted tags
        $old_data = $data;
        $data     = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    } while ($old_data !== $data);
    // we are done...
    return $data;
} // xss clean

function Translate($filename)
{
    if (get_file_extension($filename) == "srt") // block another extentions
        {
        if (file_exists($filename)) {
           // $line = file_get_contents($filename);
           $file_lines = file($filename);
           foreach ($file_lines as $line) {
               $linex .= $line;
           }
            $linew = xss_clean($linex);
            return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $linew);
        } else {
            return "";
        }
        
    }
} // Function Translate

function get_file_extension($file_name)
{
    return substr(strrchr($file_name, '.'), 1);
} // Function get_file_extension

function UploadFile($path,$files)
{
    if ($files["file"]["name"]) {
        $filename       = $files["file"]["name"];
        $source         = $files["file"]["tmp_name"];
        $type           = $files["file"]["type"];
        $name           = explode(".", $filename);
        $accepted_types = array(
            'application/zip',
            'application/x-zip-compressed',
            'multipart/x-zip',
            'application/x-compressed'
        );
        foreach ($accepted_types as $mime_type) {
            if ($mime_type == $type) {
                $okay = true;
                break;
            }
        }
        $CheckZipExt = strtolower($name[1]) == 'zip' ? true : false;
        if (!$CheckZipExt) {
            echo "The file you are trying to upload is not a .zip file. Please try again.";
        }
        $checknullbyte = strpos($filename, ";") == false ? true : false;
        if (!$checknullbyte) {
            echo "The file you are trying to upload is not a .zip file. Please try again.";
        }
        if (move_uploaded_file($source, "tmp/" . $filename)) {
            
            Unzipper($path,$filename);
            $message = "Your .zip file was uploaded and unpacked.";
        } else {
            $message = "There was a problem with the upload. Please try again.";
        }
    }
} // Function UploadFile

function Unzipper($path,$filename)
{
    $ZipFileName = $path. "/tmp/" . $filename;
    $home_folder = $path. "/srt";
    $zip         = new ZipArchive;
    if ($zip->open($ZipFileName) === true) {
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $OnlyFileName = $zip->getNameIndex($i);
            $FullFileName = $zip->statIndex($i);
            if ($FullFileName['name'][strlen($FullFileName['name']) - 1] == "/") {
                @mkdir("srt/" . $FullFileName['name'], 0700, true);
            }
        }
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $OnlyFileName = $zip->getNameIndex($i);
            $FullFileName = $zip->statIndex($i);
            if (!($FullFileName['name'][strlen($FullFileName['name']) - 1] == "/")) {
                if (preg_match('#\.(srt)$#i', $OnlyFileName)) // Only Extract Srt file...
                    {
                    copy('zip://' . $ZipFileName . '#' . $OnlyFileName, $home_folder . "/" . $FullFileName['name']);
                }
            }
        }
        $zip->close();
    } else {
        echo "Error: Can't open zip file";
    }
} // Function Unzipper
?>