/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {

	config.filebrowserBrowseUrl = '../../assets/ckeditor/kcfinder-2.51/browse.php?type=file';
	config.filebrowserImageBrowseUrl = '../../assets/ckeditor/kcfinder-2.51/browse.php?type=image';
	config.filebrowserFlashBrowseUrl = '../../assets/ckeditor/kcfinder-2.51/browse.php?type=flash';
	config.filebrowserUploadUrl = '../../assets/ckeditor/kcfinder-2.51/upload.php?type=file';
	config.filebrowserImageUploadUrl = '../../assets/ckeditor/kcfinder-2.51/upload.php?type=image';
	config.filebrowserFlashUploadUrl = '../../assets/ckeditor/kcfinder-2.51/upload.php?type=flash';

	config.toolbarGroups = [
		{ name: 'clipboard', groups: ['clipboard', 'undo'] },
		{ name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document', groups: ['mode', 'document', 'doctools'] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
		{ name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	config.removeButtons = 'Underline,Subscript,Superscript';

	config.format_tags = 'p;h1;h2;h3;pre';

	config.removeDialogTabs = 'image:advanced;link:advanced';

	config.extraPlugins = 'filebrowser';

	config.extraPlugins = 'filetools';
};
