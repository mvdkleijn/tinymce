<h1><?php echo __('Documentation');?></h1>
<p>
<?php echo __('If your Frog installation does not live at the root of your domain (i.e. www.example.com/), you will need to manually update one single parameter on the filesystem in this version of the plugin.');?>
</p>
<p>
<?php echo __('Edit the tinymce.js file and change the "urlToFrog" variable. This variable should be set to the server relative url in which Frog was installed.');?>
<br/>
<?php echo __('For example:');?>
</p>
<ul style="list-style: square inside none; font-size: 0.8em;">
<li><?php echo __('If you access Frog\'s frontpage with http://www.example.com/frog');?></li>
<li><?php echo __('The value for urlToFrog should be "/frog"');?></li>
<li><?php echo __('When you frog lives on your site\'s root, leave this value empty.');?></li>
<li><?php echo __('You will also need to update the paths that are used in the tiny_init.js file for the variables external_image_list_url, external_link_list_url and content_css. By default these paths assume Frog lives at the root of your site.');?></li>
</ul>
<h2><?php echo __('Usage');?></h2>
<h3><?php echo __('Internal pages listing example');?></h3>
<ul style="list-style: square inside none; font-size: 0.8em;">
<li><?php echo __('Edit a page using the TinyMCE editor.');?></li>
<li><?php echo __('Select a piece of text.');?></li>
<li><?php echo __('Click on the "insert/edit link" button in the TinyMCE toolbar which looks like a chain link.');?></li>
<li><?php echo __('In the popup that appears: Below the "Link URL" box where you would normally type in the URL, you will find a "Link list" dropdown box.');?></li>
<li><?php echo __('Click on the dropdown box and select an internal Frog page where you want to link to.');?></li>
<li><?php echo __('Click "insert" and you are done.');?></li>
</ul>
<h3><?php echo __('Images listing example');?></h3>
<ul style="list-style: square inside none; font-size: 0.8em;">
<li><?php echo __('Edit a page using the TinyMCE editor.');?></li>
<li><?php echo __('Click on the "insert/edit image" button in the TinyMCE toolbar which looks like a small tree.');?></li>
<li><?php echo __('In the popup that appears: Below the "Image URL" box where you would normally type in the URL to the image, you will find a "Image list" dropdown box.');?></li>
<li><?php echo __('Click on the dropdown box and select the image you want to insert. A preview of the image will appear in the preview box at the bottom of the popup.');?></li>
<li><?php echo __('Click "insert" and you are done.');?></li>
</ul>
<h3><?php echo __('Preview function example');?></h3>
<ul style="list-style: square inside none; font-size: 0.8em;">
<li><?php echo __('Edit a page using the TinyMCE editor.');?></li>
<li><?php echo __('Notice that your custom styles are being applied within TinyMCE\'s edit window.');?></li>
<li><?php echo __('Click on the "preview" button in the TinyMCE toolbar which looks like a page with a magnifying glass over it.');?></li>
<li><?php echo __('Notice that your custom styles are being applied within TinyMCE\'s preview window.');?></li>
</ul>
<h2><?php echo __('Optional');?></h2>
<p>
<?php echo __('If you do not want to use the default setup this plugin provides for TinyMCE, you can make any changes you want by editing the tinymce_init.js file which lives in the root of the plugin\'s directory.');?>
</p>
