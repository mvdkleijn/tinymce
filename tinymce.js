/**
 * @author Martijn van der Kleijn <martijn.niji@gmail.com>
 * @copyright 2008, 2009 Martijn van der Kleijn
 * @version 3.0.0
 */

/***********************************************
 *** DO NOT CHANGE ANYTHING BELOW THIS LINE! ***
 ***********************************************/

$(document).ready(function() {
    $('.filter-selector').bind('wolfSwitchFilterOut', function(event, filtername, elem) {
        if (filtername == 'tinymce') {
            tinyMCE.execCommand('mceRemoveControl', true, elem.attr('id'));
        }
    });
    
    $('.filter-selector').bind('wolfSwitchFilterIn', function(event, filtername, elem) {
        if (filtername == 'tinymce') {
            tinyMCE.execCommand('mceAddControl', true, elem.attr('id'));
        }
    });
});