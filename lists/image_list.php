<?php
/*
 * TinyMCE plugin for Wolf CMS. <http://www.wolfcms.org>
 * Copyright (C) 2008,2009 Martijn van der Kleijn <martijn.niji@gmail.com>
 *
 * This file is part of the TinyMCE plugin for Wolf CMS.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
(include_once '../config.php') or die('TinyMCE plugin - unable to load config file.');

// Attempt to open the image directory
$dir_handle = @opendir($image_list_dir) or die('TinyMCE plugin - Unable to open '.$image_public_path);

// Start building the output
$output = 'var tinyMCEImageList = new Array(';

// Recursively build up the output
list_dir($dir_handle,$image_list_dir,$image_public_path,true);

// Close up the output
$output .= ');';

// Dump the output to the browser and quit.
echo $output;
exit();

// Recursive function to build up path for (sub)dirs and images
function list_dir($dir_handle, $path, $webpath, $first=false) {
    global $output;

    while (false !== ($file = readdir($dir_handle))) {
        $dir = $path.'/'.$file;

        if ( is_dir($dir) && $file != '.' && $file != '..' ) {
            $handle = @opendir($dir) or die('TinyMCE plugin - Unable to open file '.$file);
            list_dir($handle, $dir, $webpath.'/'.$file);
        }
        elseif ($file != '.' && $file !='..') {
            if (!$first) {
                $output .= ',';
            }
            else {
                $first = false;
            }

            $output .= '["'.$webpath.'/'.$file.'", "'.$webpath.'/'.$file.'"]';
        }
    }
    closedir($dir_handle);
}

?>