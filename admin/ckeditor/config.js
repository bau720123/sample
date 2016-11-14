/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
config.filebrowserBrowseUrl = 'ckfinder/ckfinder.html';
config.filebrowserImageBrowseUrl = 'ckfinder/ckfinder.html?Type=Images';
config.filebrowserFlashBrowseUrl = 'ckfinder/ckfinder.html?Type=Flash';
config.filebrowserUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
config.filebrowserImageUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
config.filebrowserFlashUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
//config.skin = 'moono';

/*config.toolbar = 'Basic';
config.toolbar_Basic =
[
['Bold','Italic','Underline','Strike','Subscript','Superscript','Table','Smiley','SpecialChar','TextColor','Maximize','Save']
];*/

/*config.toolbar = 'Full';
config.toolbar_Full =
[
{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },'/',
{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },'/',
{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
{ name: 'colors', items : [ 'TextColor','BGColor' ] },
{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
];*/

/*
�u��C�ѼƦC��G
'Source'�G��l�X
'Save'�G�x�s
'NewPage'�G�}�s�ɮ�
'Preview'�G�w��
'Templates'�G�˪�

'Cut'�G�ŤU
'Copy'�G�ƻs
'Paste'�G�K�W
'PasteText'�G�K����r�榡
'PasteFromWord'�G�qword�K�W
'Print'�G�C�L
'SpellChecker'�G���r�ˬd
'Scayt'�G�Y�ɫ��g�ˬd

'Undo'�G�W�@�B
'Redo'�G���@
'Find'�G�M��
'Replace'�G���N
'SelectAll'�G����
'RemoveFormat'�G�M���榡

'Form'�G���
'Checkbox'�G�֨����
'Radio'�G�����s
'TextField'�G��r���
'Textarea'�G��r�ϰ�
'Select'�G���
'Button'�G���s
'ImageButton'�G�v�����s
'HiddenField'�G�������

'Bold'�G����
'Italic'�G����
'Underline'�G���u
'Strike'�G�R���u
'Subscript'�G�U��
'Superscript'�G�W��
'NumberedList'�G�s���M��
'BulletedList'�G���زM��
'Outdent'�G����Y��
'Indent'�G�W�[�Y��
'Blockquote'�G�ޥΤ�r

'JustifyLeft'�G�a�����
'JustifyCenter'�G�m��
'JustifyRight'�G�a�k���
'JustifyBlock'�G���k���

'Link'�G�W�s��
'Unlink'�G�����W�s��
'Anchor'�G���I

'Image'�G�Ϥ��v��
'Flash'�GFlash
'Table'�G���
'HorizontalRule'�G�����u
'Smiley'�G���Ÿ�
'SpecialChar'�G�S��Ÿ�
'PageBreak'�G�����Ÿ�

'Styles'�G�˦�
'Format'�G�榡
'Font'�G�r��
'FontSize'�G�j�p

'TextColor'�G��r�C��
'BGColor'�G�I���C��

'Maximize'�G�̤j��
'ShowBlocks'�G��ܰ϶�
'About'�G����CKEditor
*/

config.enterMode = CKEDITOR.ENTER_BR;
//config.height = 30;
//config.resize_enabled = false;
};