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

/**
 * The TinyMCE plugin provides the TinyMCE editor to Wolf CMS users.
 *
 * @package wolf
 * @subpackage plugin.tinymce
 *
 * @author Martijn van der Kleijn <martijn.niji@gmail.com>
 * @version 3.0.0
 * @since Wolf version 0.5.5
 * @license http://www.gnu.org/licenses/gpl.html GPL License
 * @copyright Martijn van der Kleijn, 2008,2009
 */

$version = Plugin::getSetting('version', 'tinymce');

// Check if settings were found for tinymce
if (!$version || $version == null) {
    // Check if we're upgrading from a previous version.
    $upgrade = checkForOldInstall();

    // Upgrading from previous installation
    if ($upgrade) {
        // Retrieve the old settings.
        $PDO = Record::getConnection();
        $tablename = TABLE_PREFIX.'tinymce';

        $sql_check = "SELECT COUNT(*) FROM $tablename";
        $sql = "SELECT * FROM $tablename";

        $result = $PDO->query($sql_check);

        // Checking if old tinymce table is OK
        if ($result && $result->fetchColumn() != 1) {
            $result->closeCursor();
            Flash::set('error', __('TinyMCE - upgrade needed, but invalid upgrade scenario detected!'));
            return;
        }
        
        if (!$result) {
            Flash::set('error', __('TinyMCE - upgrade need detected earlier, but unable to retrieve table information!'));
            return;
        }

        // Fetch the old installation's records.
        $result = $PDO->query($sql);

        if ($result && $row = $result->fetchObject()) {
            $settings = array('version' => '3.5.0',
                              'listpublished' => $row->listpublished,
                              'listhidden' => $row->listhidden,
                              'imagesdir' => $row->imagesdir,
                              'imagesuri' => $row->imagesuri,
                              'cssuri'=> $row->cssuri,
                              'tb_obfuscate' => 'sukthvgnhgliuhgldutnvlru',
                              'tb_docroot' => '/var/www',
                              'tb_unixpermissions' => '0755',
                              'tb_imagepath' => '/wolfcms/public/images/',
                              'tb_mediapath' => '/wolfcms/public/media/',
                              'tb_filepath' => '/wolfcms/public/files/',
                              'tb_maximagesize' => '0',
                              'tb_maxmediasize' => '0',
                              'tb_maxfilesize' => '0',
                              'tb_autoresizewidth' => '0',
                              'tb_autoresizeheight' => '0',
                              'tb_thumbsize' => '80',
                              'tb_imagequality' => '80',
                              'tb_thumbquality' => '80',
                              'tb_allowedimagestypes' => '*.jpg, *.jpeg, *.gif, *.png',
                              'tb_allowedmediatypes' => '*.swf, *.dcr, *.mov, *.qt, *.mpg, *.mp3, *.mp4, *.mpeg, *.avi, *.wmv, *.wm, *.asf, *.asx, *.wmx, *.wvx, *.rm, *.ra, *.ram',
                              'tb_allowedfiletypes' => '*.*'
                             );
            $result->closeCursor();
        }
        else {
            Flash::set('error', __('TinyMCE - upgrade needed, but unable to retrieve old settings!'));
            return;
        }
    }
    // This is a clean install.
    else {
        $settings = array('version' => '3.5.0',
                          'listpublished' => 1,
                          'listhidden' => 0,
                          'imagesdir' => '/home/user/www/public/images',
                          'imagesuri' => '/public/images',
                          'cssuri'=> '/public/themes/mylayout/mystylesheet.css',
                          'tb_obfuscate' => 'sukthvgnhgliuhgldutnvlru',
                          'tb_docroot' => '/var/www',
                          'tb_unixpermissions' => 0755,
                          'tb_imagepath' => '/wolfcms/public/images/',
                          'tb_mediapath' => '/wolfcms/public/media/',
                          'tb_filepath' => '/wolfcms/public/files/',
                          'tb_maximagesize' => '0',
                          'tb_maxmediasize' => '0',
                          'tb_maxfilesize' => '0',
                          'tb_autoresizewidth' => '0',
                          'tb_autoresizeheight' => '0',
                          'tb_thumbsize' => '80',
                          'tb_imagequality' => '80',
                          'tb_thumbquality' => '80',
                          'tb_allowedimagestypes' => '*.jpg, *.jpeg, *.gif, *.png',
                          'tb_allowedmediatypes' => '*.swf, *.dcr, *.mov, *.qt, *.mpg, *.mp3, *.mp4, *.mpeg, *.avi, *.wmv, *.wm, *.asf, *.asx, *.wmx, *.wvx, *.rm, *.ra, *.ram',
                          'tb_allowedfiletypes' => '*.*'
                         );
    }

    // Store settings.
    if (Plugin::setAllSettings($settings, 'tinymce')) {
        if ($upgrade)
            Flash::set('success', __('TinyMCE - plugin settings copied from old installation.'));
        else
            Flash::set('success', __('TinyMCE - plugin settings initialized.'));
    }
    else
        Flash::set('error', __('TinyMCE - unable to store plugin settings!'));

}
else {  // Found an old post-2.0.0 RC1 install
    $settings = Plugin::getAllSettings('tinymce');
    $settings = array('version' => '3.5.0',
                      'tb_obfuscate' => 'sukthvgnhgliuhgldutnvlru',
                      'tb_docroot' => '/var/www',
                      'tb_unixpermissions' => '0755',
                      'tb_imagepath' => '/wolfcms/public/images/',
                      'tb_mediapath' => '/wolfcms/public/media/',
                      'tb_filepath' => '/wolfcms/public/files/',
                      'tb_maximagesize' => '0',
                      'tb_maxmediasize' => '0',
                      'tb_maxfilesize' => '0',
                      'tb_autoresizewidth' => '0',
                      'tb_autoresizeheight' => '0',
                      'tb_thumbsize' => '80',
                      'tb_imagequality' => '80',
                      'tb_thumbquality' => '80',
                      'tb_allowedimagestypes' => '*.jpg, *.jpeg, *.gif, *.png',
                      'tb_allowedmediatypes' => '*.swf, *.dcr, *.mov, *.qt, *.mpg, *.mp3, *.mp4, *.mpeg, *.avi, *.wmv, *.wm, *.asf, *.asx, *.wmx, *.wvx, *.rm, *.ra, *.ram',
                      'tb_allowedfiletypes' => '*.*'
                     );

    // Store settings.
    if (Plugin::setAllSettings($settings, 'tinymce'))
        Flash::set('success', __('TinyMCE - plugin settings updated.'));
    else
        Flash::set('error', __('TinyMCE - unable to store plugin settings!'));
}
        
/**
 * This function checks to see if there is a valid old installation with regards to the DB.
 * 
 * @return boolean
 */
function checkForOldInstall() {
    $tablename = TABLE_PREFIX.'tinymce';
    $PDO = Record::getConnection();

    $sql = "SELECT COUNT(*) FROM $tablename";

    $result = $PDO->query($sql);

    if ($result != null) {
        $result->closeCursor();
        return true;
    }
    else
        return false;
}

?>
