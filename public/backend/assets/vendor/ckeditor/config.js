/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = '../../'+window.location.hostname +'/../../backend/bower_components/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
   	config.filebrowserImageBrowseUrl = '../../'+window.location.hostname +'/../../backend/bower_components/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
   	config.filebrowserFlashBrowseUrl = '../../'+window.location.hostname +'/../../backend/bower_components/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
   	config.filebrowserUploadUrl = '../../'+window.location.hostname +'/../../backend/bower_components/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
   	config.filebrowserImageUploadUrl = '../../'+window.location.hostname +'/../../backend/bower_components/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
   	config.filebrowserFlashUploadUrl = '../../'+window.location.hostname +'/../../backend/bower_components/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';
};
