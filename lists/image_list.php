<?php

require_once('../config.php');

print 'var tinyMCEImageList = new Array(';

function get_dir_iterative($dir = '.', $public_dir = '/', $exclude = array( 'cgi-bin', '.', '..' )) {
    $exclude = array_flip($exclude);
    if(!is_dir($dir)) {
        return;
    }
    
    $dh = opendir($dir);
    
    if(!$dh) {
        return;
    }

    $stack = array($dh);
    $level = 0;
    $first = true;

    while(count($stack)) {
        if(false !== ( $file = readdir( $stack[0] ) ) ) {
            if(!isset($exclude[$file])) {
                print str_repeat('&nbsp;', $level * 4);
                if(is_dir($dir . '/' . $file)) {
                //    $dh = opendir($file . '/' . $dir);
                //    if($dh) {
                //        //print "<strong>$file</strong><br />\n";
                //        array_unshift($stack, $dh);
                //        ++$level;
                //    }
                }
                else {
                    $suffix = substr($file,(strlen($file)-4),4);
                    if ($suffix == ".jpg" || $suffix == ".gif" || $suffix == ".png" || $suffix == ".bmp") {
                        if ($first == false) {     // Check moved here to prevent extraneous commas, thanks sboots
                            print ',';
                        }
                        if ($first == true) {
                            $first = false;
                        }
                        print '["'.$file.'", "'.$public_dir.'/'.$file.'"]';
                    }
                }
            }
        }
        else {
            closedir(array_shift($stack));
            --$level;
        }
    }
}  

get_dir_iterative($image_list_dir, $image_public_path);

print ');';

?>
