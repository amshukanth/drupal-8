/* CKEDITOR.plugins.add( 'colorbutton', {
  init: function( editor )
  {
   editor.addCommand( 'form_builder', {
    exec : function( editor ) {
     //here is where we tell CKEditor what to do.
     editor.insertHtml( 'This text is inserted when clicking on our new button from the CKEditor toolbar' );
    }
   });
   editor.addCommand( 'form_builder', {
    exec : function( editor ) {
     //here is where we tell CKEditor what to do.
     editor.insertHtml( 'This text is inserted when clicking on our new button from the CKEditor toolbar' );
    }
   });
   
   editor.ui.addButton( 'FormBuilder', {
    label: 'Form Builder', //this is the tooltip text for the button
    command: 'form_builder',
    icon: this.path + 'icons/googleforms.png'
   });
      editor.ui.addButton( 'Landingpage', {
    label: 'Landing Pagea', //this is the tooltip text for the button
    command: 'anding Page',
    icon: this.path + 'icons/browser.png'
   });
  }
 });*/


/**
 * @file
 * Image popup plugin.
 *
 * Use a Drupal-native dialog (that is in fact just an alterable Drupal form
 * like any other) instead of CKEditor's own dialogs.
 *
 * @see \Drupal\editor\Form\EditorImageDialog
 *
 * @ignore
 */

(function ($, Drupal, CKEDITOR) {

  'use strict';

  var insertContent;

  var imagePopupSaveCallback = function(data) {
    var content = data.image_render;
    insertContent(content);
  };

  CKEDITOR.plugins.add('colorbutton', {
      icons: 'googleforms','browser',
      hidpi: true,

      beforeInit: function (editor) {
        editor.addCommand( 'editFormbuilderpopup', {
          canUndo: true,
          exec: function (editor, data) {
            var existingValues = {
              'data-align': ''
            };
            var edit_content = editor.getSelection().getSelectedElement();
            if (edit_content && edit_content.getAttribute('class') == 'display_image') {
              var imageData = edit_content.data('img-popup');
              imageData = imageData.split(':');
              existingValues = {
                'data-entity-uuid': imageData[0],
              };
            }
            Drupal.ckeditor.openDialog(editor, Drupal.url('agilecrm_module/dialog/image/' + editor.config.drupal.format), existingValues, imagePopupSaveCallback, {});
          }
        });
        editor.addCommand( 'editLandingpage', {
          canUndo: true,
          exec: function (editor, data) {
            var existingValues = {
              'data-align': ''
            };
            var edit_content = editor.getSelection().getSelectedElement();
            if (edit_content && edit_content.getAttribute('class') == 'display_image') {
              var imageData = edit_content.data('img-popup');
              imageData = imageData.split(':');
              existingValues = {
                'data-entity-uuid': imageData[0],
              };
            }
            Drupal.ckeditor.openDialog(editor, Drupal.url('agilecrm_module/dialog/landingpage/' + editor.config.drupal.format), existingValues, imagePopupSaveCallback, {});
          }
        });

        editor.ui.addButton('FormBuilder', {
          label: Drupal.t('Agile Form Builder'),
          // Note that we use the original image2 command!
          command: 'editFormbuilderpopup',
          icon: this.path + 'icons/googleforms.png'
        });
        editor.ui.addButton('Landingpage', {
          label: Drupal.t('Agile Landing Page'),
          // Note that we use the original image2 command!
          command: 'editLandingpage',
          icon: this.path + 'icons/browser.png'
        });

        insertContent = function(html) {
          editor.insertHtml(html);
        }
      }
  });

})(jQuery, Drupal, CKEDITOR);
