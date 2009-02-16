<?php

/*
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
 * The TinyMCE plugin provides the TinyMCE editor to Frog users.
 *
 * @package frog
 * @subpackage plugin.tinymce
 *
 * @author Martijn van der Kleijn <martijn.niji@gmail.com>
 * @version 2.0.0
 * @since Frog version 0.9.4
 * @license http://www.gnu.org/licenses/gpl.html GPL License
 * @copyright Martijn van der Kleijn, 2008
 */

Plugin::setInfos(array(
    'id'          => 'tinymce',
    'title'       => 'TinyMCE Editor',
    'description' => 'Allows you to use the TinyMCE text editor.',
    'version'     => '2.0.0',
    'license'     => 'GPLv3',
    'author'      => 'Martijn van der Kleijn',
    'website'     => 'http://www.vanderkleijn.net/frog-cms.html',
    'update_url'  => 'http://www.vanderkleijn.net/plugins.xml',
    'require_frog_version' => '0.9.5'
));

Filter::add('tinymce', 'tinymce/filter_tinymce.php');
Plugin::addController('tinymce', 'Tinymce', 'administrator,developer', false);
Plugin::addJavascript('tinymce', 'tinymce/jscripts/tiny_mce/tiny_mce.js');
Plugin::addJavascript('tinymce', 'tiny_init.php');

