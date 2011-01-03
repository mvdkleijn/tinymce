<h1><?php echo __('Documentation');?></h1>
<p>
    Apart from the normal TinyMCE usage, a few special features have been implemented which are described here in more detail.
    Please read carefully on how to use these features.
</p>
<p>
    Note: this plugin requires Wolf CMS 0.7.3 starting from release 3.5.0.
</p>
<h3><?php echo __('Codeprotect and Pagebreak');?></h3>
<p>
    In release 3.0.0 two new features were added/turned on that should simplify things.
    The first is the "codeprotect" TinyMCE plugin. This will allow you to add PHP code to your pages without
    TinyMCE destroying the code. It will also display a red block "[PHP]" in the editor to show there is a piece of PHP
    code there.
</p>
<p>
    The second feature is the "pagebreak" function. This added button on the toolbar will allow you to add a "pagebreak" in your text.
    You can then use this pagebreak in your PHP code or in the code for the Article/Archive pages to determine up to where the text
    should be used for the introduction.
</p>
<h3><?php echo __('Internal pages listing');?></h3>
<p>
    This feature allows you to easily link to pages in Wolf CMS from within the TinyMCE editor.
</p>
<ul style="list-style: square inside none; font-size: 0.8em;">
    <li>Edit a page using the TinyMCE editor.</li>
    <li>Select a piece of text.</li>
    <li>Click on the "insert/edit link" button in the TinyMCE toolbar which looks like a chain link.</li>
</ul>
<p><?php echo __('In the popup that appears: '); ?></p>
<ul style="list-style: square inside none; font-size: 0.8em;">
    <li>Below the "Link URL" box where you would normally type in the URL, you will find a "Link list" dropdown box.</li>
    <li>Click on the dropdown box and select an internal Wolf CMS page where you want to link to.</li>
    <li>Click "insert" and you are done.</li>
</ul>
<h3><?php echo __('Images listing example');?></h3>
<p><strong><?php echo __('Note'); ?>:</strong> The images listing dropdown box only appears when there are images in the directory you specified.</p>
<ul style="list-style: square inside none; font-size: 0.8em;">
    <li>Edit a page using the TinyMCE editor.</li>
    <li>Click on the "insert/edit image" button in the TinyMCE toolbar which looks like a small tree.</li>
</ul>
<p>In the popup that appears:</p>
<ul style="list-style: square inside none; font-size: 0.8em;">
    <li>Below the "Image URL" box where you would normally type in the URL to the image, you will find a "Image list" dropdown box.</li>
    <li>Click on the dropdown box and select the image you want to insert. A preview of the image will appear in the preview box at the bottom of the popup.</li>
    <li>Click "insert" and you are done.</li>
</ul>
<h3><?php echo __('Preview function example');?></h3>
<ul style="list-style: square inside none; font-size: 0.8em;">
    <li>Edit a page using the TinyMCE editor.</li>
    <li>Notice that your custom styles are being applied within TinyMCE\'s edit window.</li>
    <li>Click on the "preview" button in the TinyMCE toolbar which looks like a page with a magnifying glass over it.</li>
    <li>Notice that your custom styles are being applied within TinyMCE\'s preview window.</li>
</ul>
<h2><?php echo __('Optional');?></h2>
<p>
    If the default setup of TinyMCE which this plugin provides does not suit your need, you can change it by editing the tinymce_init.php file. You can find this file in the root of the TinyMCE plugin\'s directory.
</p>
