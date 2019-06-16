/**
 * MLV intranet v2.0 - Web oficial del intranet del MLV
 * 
 * @link https://github.com/carlosfingles/mlv-intranet
 * @license GNU GPL V3
 * @author Carlos Zambrano (carlosfingles)
 *         Facebook : http://facebook.com/carlosfingles
 *         Twitter : @carlosfingles
 *         Instagram : @carlosfingles
 */

$(document).ready(
    function(){
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
      $('[data-toggle="popover"]').popover();
    });
    }
);
function editorHtml(){
    $('.html-editor').trumbowyg({
        lang: 'es',
        hideButtonTexts: true,
        imageWidthModalEdit: true,
        btnsDef: {
            align: {
                dropdown: ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                title: 'Alinear',
                ico: 'justifyFull',
                hasIcon: true
            },
            list: {
                dropdown: ['unorderedList', 'orderedList'],
                title: 'Lista',
                ico: 'unorderedList',
                hasIcon: true
            },
            styleText: {
                dropdown: ['strong', 'em', 'del'],
                title: 'Estilo de texto',
                ico: 'strong',
                hasIcon: true
            },
            supSub: {
                dropdown: ['superscript', 'subscript'],
                title: 'Sobrescrito y subíndice',
                ico: 'superscript',
                hasIcon: true
            },
            media: {
                dropdown: ['insertImage', 'noembed'],
                title: 'Multimedia',
                ico: 'insertImage',
                hasIcon: true
            }
        },
        btns: [
            ['viewHTML'],
            ['historyUndo', 'historyRedo'],
            ['formatting'],
            ['styleText'],
            ['supSub'],
            ['link'],
            ['media'],
            ['align'],
            ['list'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ]
    });
}