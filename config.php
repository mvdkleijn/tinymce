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

function substrtruncate($string, $needle) {
    return substr($string, 0, strrpos($string, $needle)+1);
}

    (include_once substrtruncate(dirname(__FILE__), '/plugins').'../config.php') or die('TinyMCE plugin - unable to load Wolf CMS config file.');
    (include_once substrtruncate(dirname(__FILE__), '/plugins').'/Framework.php') or die('TinyMCE plugin - unable to load Framework.');

    // Setup variables
    $tablename         = TABLE_PREFIX.'plugin_settings';        // Wolf CMS plugin settings tablename.
    $image_list_dir    = '';
    $image_public_path = 'undefined';
    $preview_css       = '';
    $listhidden        = 0;
    $settings          = array();

    // Setup DB connection
    try {
        $PDO = new PDO(DB_DSN, DB_USER, DB_PASS);
    }
    catch (PDOException $error) {
        die('TinyMCE plugin - DB connection failed: '.$error->getMessage());
    }

    if ($PDO->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql')
        $PDO->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

    // Get a DB connection
    Record::connection($PDO);
    $PDO = Record::getConnection();
    $PDO->exec("set names 'utf8'");

    // Query the DB for the plugin settings.
    $sql = "SELECT name,value FROM $tablename WHERE plugin_id='tinymce'";
    $stmt = $PDO->prepare($sql);
    $stmt->execute();

    // Build settings array with tinymce plugin settings
    while ($obj = $stmt->fetchObject()) {
        $settings[$obj->name] = $obj->value;
    }

    // Update settings
    if ($settings) {
        $image_list_dir = $settings['imagesdir'];
        $image_public_path = $settings['imagesuri'];
        $preview_css = $settings['cssuri'];
        $listhidden = $settings['listhidden'];
        AuthUser::load();
        $tb_language = (AuthUser::isLoggedIn()) ? AuthUser::getRecord()->language : Setting::get('language');
    }

// The 'g' argument is set, so we want to retrieve something.
if (isset($_GET['g'])) {
    $get = $_GET['g'];

    if ($get == 'css') {
        header("Location: $preview_css");
        exit;
    }
    else {
        exit;
    }
}