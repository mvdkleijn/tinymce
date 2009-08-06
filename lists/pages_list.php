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
(include_once '../../../../config.php') or die('TinyMCE plugin - unable to load Wolf CMS config file.');

function startsWith($Haystack, $Needle){
    return strpos($Haystack, $Needle) === 0;
}

function dumpChildren($listhidden = 1, $parent_title = '', $root = 1, $slug = '') {
    $tablename = TABLE_PREFIX.'page';
    if ($slug != '')
        $slug = $slug.'/';

    if ($parent_title != '')
        $parent_title = $parent_title.'/';

    $sql = "SELECT title,slug FROM $tablename WHERE id='$root' AND ".
           ($listhidden ? "(status_id='100' OR (status_id='101' AND is_protected='0'))" : "status_id='100'").
           ' ORDER BY title ASC';

    $PDO = Record::getConnection();
    $PDO->exec("set names 'utf8'");

    $settings = array();

    $stmt = $PDO->prepare($sql);
    $stmt->execute();

    $base_url = URL_PUBLIC;

    // Make sure we support USE_MOD_REWRITE
    if (defined('USE_MOD_REWRITE') && !USE_MOD_REWRITE) {
        $base_url .= '?';
    }

    while ($result = $stmt->fetchObject()) {
        if ($root > 1) {
            echo ',';
        }
        echo '["'.($result->title == '' ? '' : $parent_title.$result->title).'", "'.$base_url.($result->slug == '' ? '' : $slug.$result->slug.URL_SUFFIX).'"]';
        $slug = $slug.$result->slug;
        $parent_title = $parent_title.$result->title;
    }

    $query = "SELECT id FROM $tablename WHERE parent_id='$root' AND ".
           ($listhidden ? "(status_id='100' OR (status_id='101' AND is_protected='0'))" : "status_id='100'").
           ' ORDER BY title ASC';

    $stmt = $PDO->prepare($query);
    $stmt->execute();

    while ($result = $stmt->fetchObject()) {
        dumpChildren($listhidden, $parent_title, $result->id, $slug);
    }
}

echo 'var tinyMCELinkList = new Array(';
dumpChildren($listhidden);
echo ');';

?>
