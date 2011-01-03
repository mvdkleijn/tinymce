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
 * @copyright Martijn van der Kleijn, 2008,2009,2010
 */

Plugin::setInfos(array(
    'id'          => 'tinymce',
    'title'       => 'TinyMCE Editor',
    'description' => 'Allows you to use the TinyMCE text editor.',
    'version'     => '3.5.0',
    'license'     => 'GPLv3',
    'author'      => 'Martijn van der Kleijn',
    'website'     => 'http://www.vanderkleijn.net/wolf-cms.html',
    'update_url'  => 'http://www.vanderkleijn.net/plugins.xml',
    'require_wolf_version' => '0.7.3'
));

Filter::add('tinymce', 'tinymce/filter_tinymce.php');
Plugin::addController('tinymce', 'Tinymce', 'administrator,developer', false);
Plugin::addJavascript('tinymce', 'tinymce/jscripts/tiny_mce/tiny_mce.js');
Plugin::addJavascript('tinymce', 'tiny_init.php');

