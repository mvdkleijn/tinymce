<?php
//
// Please do not touch the PHP codes!!
//
// The php in this file is to prevent you from having to manually include/change paths
//

$pluginDir = dirname($_SERVER['PHP_SELF']);

?>

tinyMCE.init({
    // Generic
    theme : "advanced",
    mode : "none",

    // Performance enhancements according to TinyMCE website
    button_tile_map : true,
        
    // Plugins used
    plugins : "table,fullscreen,preview,contextmenu,advimage,media,pagebreak,codeprotect",

    // Fix for images showing up correctly in editor, but not in final page
    relative_urls : false,
    
    // Toolbar positioning
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resize_horizontal : false,
    theme_advanced_resizing : true,
    
    // Toolbar layout
    theme_advanced_buttons1 : "styleselect,formatselect,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,|,undo,redo,link,unlink,|,image,media",
    theme_advanced_buttons2 : "tablecontrols,|,outdent,indent,blockquote,|,hr,pagebreak,|,removeformat,preview,fullscreen,code",
    theme_advanced_buttons3 : "",
    
    // Preview content in systems style
    content_css : "<?php echo $pluginDir; ?>/config.php?g=css",

    // Dropdown lists for link/image/media/template dialogs
    external_image_list_url : "<?php echo $pluginDir; ?>/lists/image_list.php",
    external_link_list_url : "<?php echo $pluginDir; ?>/lists/pages_list.php",
    extended_valid_elements : "a[name|href|target|title|onclick|style],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style],hr[class|width|size|noshade|style],font[face|size|color|style],span[class|align|style]"
    
    //Example of how to add your stylesheet styles to the styles dropdown box in TinyMCE
    //theme_advanced_styles : "Normal text=normaltext, Align left=align-left, Align right=align-right",
    
    // External file browser
    // file_browser_callback : "tinyBrowser"
});