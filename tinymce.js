/**
 * @author Martijn van der Kleijn <martijn@vanderkleijn.net>
 * @copyright 2008 Martijn van der Kleijn
 * @version 1.0.0
 */

/**
 ** Change this to point to the root url where Frog lives
 ** NO SLASH AT THE END!
 **/
 urlToFrog='';

/*******************************************
 *** Don't change anything below this line!
 *******************************************/

// Function to allow one JavaScript file to be included by another.
function includeJavascript(jsFile) {
    document.write('<script type="text/javascript" src="'
    + jsFile + '"></script>'); 
}

// function to toggle tinymce editor based on the onchange event
function toggleEditor(id, filter) {
    if (tinyMCE.getInstanceById(id) == null && filter == 'tinymce') {
        tinyMCE.execCommand('mceAddControl', true, id);
    }
    else {
        tinyMCE.execCommand('mceRemoveControl', true, id);
    }
}

function setTextAreaToolbar(textarea, filter) {
// START tinymce stuff
var filt = filter;
// END tinymce stuff

  filter = ('-'+filter.dasherize()).camelize();

  var toolbar_name = textarea + '_toolbar';
  
  // make sure the textarea is display 
  //(maybe some filter will choose to use a iframe like tinycme)
  $(textarea).style.display = 'block';
  
  var ul_toolbar = document.getElementById(toolbar_name);
  if (ul_toolbar != null)
    ul_toolbar.parentNode.removeChild(ul_toolbar);
  
  if (Control.TextArea.ToolBar[filter] != null)
  {
    var tb = new Control.TextArea.ToolBar[filter](textarea);
    tb.toolbar.container.id = toolbar_name;
  }

// START tinymce stuff
  toggleEditor(textarea, filt);
// END tinymce stuff
}


includeJavascript(urlToFrog+'/frog/plugins/tinymce/tinymce/jscripts/tiny_mce/tiny_mce.js');
includeJavascript(urlToFrog+'/frog/plugins/tinymce/tiny_init.js');
