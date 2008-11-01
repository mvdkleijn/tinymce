<?php

Plugin::setInfos(array(
    'id'          => 'tinymce',
    'title'       => 'TinyMCE Editor',
    'description' => 'Allows you to use the TinyMCE text editor.',
    'version'     => '2.0.0',
    'license'     => 'GPLv3',
    'author'      => 'Martijn van der Kleijn',
    'website'     => 'http://www.vanderkleijn.net/frog-cms.html',
    'update_url'  => 'http://www.vanderkleijn.net/public/downloads/plugins/tinymce/update.xml',
    'require_frog_version' => '0.9.4'
));

Filter::add('tinymce', 'tinymce/filter_tinymce.php');
Plugin::addController('tinymce', 'Tinymce', 'administrator,developer', false);
Plugin::addJavascript('tinymce', 'tinymce/jscripts/tiny_mce/tiny_mce.js');
Plugin::addJavascript('tinymce', 'tiny_init.js');

