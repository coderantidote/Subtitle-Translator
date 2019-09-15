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
        echo "<option value=\"" . sanitize_xss($imgArray[$i]) . "\">" . sanitize_xss($imgArray[$i]) . "\n";
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

function sanitize_xss($value) {
	return htmlspecialchars(strip_tags($value));
}

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
            $linew = sanitize_xss($linex);
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
            echo "Your .zip file was uploaded and unpacked.";
        } else {
            echo "There was a problem with the upload. Please try again.";
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
