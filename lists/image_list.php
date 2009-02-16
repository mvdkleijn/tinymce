<?php
require_once('../config.php');

$dir_handle = @opendir($image_list_dir) or die("Unable to open $image_public_path");

print 'var tinyMCEImageList = new Array(';
list_dir($dir_handle,$image_list_dir,$image_public_path,true);
print ');';

function list_dir($dir_handle,$path,$webpath,$first=false) {
    while (false !== ($file = readdir($dir_handle))) {
        $dir =$path.'/'.$file;
        if(is_dir($dir) && $file != '.' && $file !='..' ) {
            $handle = @opendir($dir) or die("unable to open file $file");
            list_dir($handle, $dir, $webpath.'/'.$file);
        }
        elseif ($file != '.' && $file !='..') {
            if (!$first)
                print ',';
            print '["'.$webpath.'/'.$file.'", "'.$webpath.'/'.$file.'"]';
        }
    }
    closedir($dir_handle);
}
?>