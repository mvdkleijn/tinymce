<?php
//
// Please do not touch the PHP codes!!
//
// The php in this file is to prevent you from having to manually include/change paths
//

$pluginDir = dirname($_SERVER['PHP_SELF']);

?>

tinyMCE.init({
    mode : "none",
	theme : "advanced",
	plugins : "table,fullscreen,preview,contextmenu,advimage,codeprotect",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink,|,image,styleselect,formatselect,|,fullscreen,code",
	theme_advanced_buttons2 : "tablecontrols,|,hr,removeformat,|,outdent,indent,blockquote,|,preview",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resize_horizontal : false,
	theme_advanced_resizing : true,

	// Some performance enhancements according to TinyMCE website
	button_tile_map : true,

    // Fix for images showing up correctly in editor, but not in final page
    relative_urls : false,
    //document_base_url : "/",

    file_browser_callback : "tinyBrowser",

    //Example of how to add your stylesheet styles to the styles dropdown box in TinyMCE
    //theme_advanced_styles : "Normal text=normaltext, Align left=align-left, Align right=align-right",

    // Preview content in system\'s style
    content_css : "<?php echo $pluginDir; ?>/config.php?g=css",

	// Dropdown lists for link/image/media/template dialogs
	//external_image_list_url : "<?php echo $pluginDir; ?>/lists/image_list.php",
	external_link_list_url : "<?php echo $pluginDir; ?>/lists/pages_list.php",

	extended_valid_elements : "a[name|href|target|title|onclick|style],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style],hr[class|width|size|noshade|style],font[face|size|color|style],span[class|align|style]"
});

<?php
include dirname(__FILE__).'/tinymce/jscripts/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php';
?>