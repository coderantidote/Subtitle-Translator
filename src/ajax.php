<?php
include "lib/php/core.php"; // Include Core
if (isset($_POST['method']))
    switch ($_POST['method'])
    {
        case 'clean':
            delete_files("srt/");
            mkdir("srt/");
            break;
        case 'select':
            
            if (!isset($_POST['subtitle']))
                {
                echo Translate("srt/001 Example.srt");
                }
            else
                {
                echo Translate("srt/" . $_POST['subtitle']);
                }
            
            break;
        case 'listsubtitle':
            
            ListSubtitle("./srt");
            
            break;    
        case 'uploadfile':
            UploadFile(dirname(__FILE__),$_FILES);
            break;
        default:
            echo "Thank you for looking here.";
            break;
    }
else
    {
    header("HTTP/1.0 404");
    exit;
    }

?>