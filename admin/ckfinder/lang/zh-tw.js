/*
 * CKFinder
 * ========
 * http://cksource.com/ckfinder
 * Copyright (C) 2007-2014, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file, and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying, or distributing this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 *
 */

/**
 * @fileOverview Defines the {@link CKFinder.lang} object for the Chinese (Taiwan)
 *		language.
 */

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['zh-tw'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, 不可用</span>',
		confirmCancel	: '部分內容尚未保存，確定關閉對話框麼?',
		ok				: '確定',
		cancel			: '取消',
		confirmationTitle	: '確認',
		messageTitle	: '提示',
		inputTitle		: '詢問',
		undo			: '撤銷',
		redo : '重做',
		skip : '跳過',
		skipAll : '全部跳過',
		makeDecision : '應採取何樣措施?',
		rememberDecision: '下次不再詢問'
	},


	// Language direction, 'ltr' or 'rtl'.
	dir : 'ltr',
	HelpLang : 'zh-tw',
	LangCode : 'zh-tw',

	// Date Format
	//		d    : Day
	//		dd   : Day (padding zero)
	//		m    : Month
	//		mm   : Month (padding zero)
	//		yy   : Year (two digits)
	//		yyyy : Year (four digits)
	//		h    : Hour (12 hour clock)
	//		hh   : Hour (12 hour clock, padding zero)
	//		H    : Hour (24 hour clock)
	//		HH   : Hour (24 hour clock, padding zero)
	//		M    : Minute
	//		MM   : Minute (padding zero)
	//		a    : Firt char of AM/PM
	//		aa   : AM/PM
	DateTime : 'mm/dd/yyyy HH:MM',
	DateAmPm : ['上午', '下午'],

	// Folders
	FoldersTitle	: '目錄',
	FolderLoading	: '載入中...',
	FolderNew		: '請輸入新目錄名稱: ',
	FolderRename	: '請輸入新目錄名稱: ',
	FolderDelete	: '確定刪除 "%1" 這個目錄嗎?',
	FolderRenaming	: ' (修改目錄...)',
	FolderDeleting	: ' (刪除目錄...)',
	DestinationFolder	: '目標路徑',

	// Files
	FileRename		: '請輸入新檔案名稱: ',
	FileRenameExt	: '確定變更這個檔案的副檔名嗎? 變更後 , 此檔案可能會無法使用 !',
	FileRenaming	: '修改檔案名稱...',
	FileDelete		: '確定要刪除這個檔案 "%1"?',
	FilesDelete	: '你確定要刪除這個檔案 "%1"?',
	FilesLoading	: '載入中...',
	FilesEmpty		: '這個資料夾是空的',
	DestinationFile	: '目標文件',
	SkippedFiles	: '跳過的文件列表:',

	// Basket
	BasketFolder : '臨時文件夾',
	BasketClear : '清空臨時文件夾',
	BasketRemove : '從臨時文件夾移除',
	BasketOpenFolder : '打開臨時文件夾',
	BasketTruncateConfirm : '確認清空臨時文件夾?',
	BasketRemoveConfirm : '確認從臨時文件夾中移除文件"%1"？',
	BasketRemoveConfirmMultiple : '確認是否真的從臨時文件夾中移除文件"%1"？',
	BasketEmpty : '臨時文件夾為空, 可拖放文件至其中.',
	BasketCopyFilesHere	: '從臨時文件夾複製至此',
	BasketMoveFilesHere : '從臨時文件夾移動至此',

	// Global messages
	OperationCompletedSuccess	: '操作成功完成',
	OperationCompletedErrors		: '操作完成時出現錯誤',
	FileError				: '%s: %e',

	// Move and Copy files
	MovedFilesNumber		: '移動的檔案數量: %s.',
	CopiedFilesNumber	: '複製的檔案數: %s.',
	MoveFailedList		: '下面的檔案無法被移動:<br />%s',
	CopyFailedList		: '下面的檔案不能被複製:<br />%s',

	// Toolbar Buttons (some used elsewhere)
	Upload		: '上傳檔案',
	UploadTip	: '上傳一個新檔案',
	Refresh		: '重新整理',
	Settings	: '偏好設定',
	Help		: '說明',
	HelpTip		: '說明',

	// Context Menus
	Select			: '選擇',
	SelectThumbnail : '選擇縮圖',
	View			: '瀏覽',
	Download		: '下載',

	NewSubFolder	: '建立新子目錄',
	Rename			: '重新命名',
	Delete			: '刪除',
	DeleteFiles		: '刪除檔案',

	CopyDragDrop	: '複製到此處',
	MoveDragDrop	: '移動到此處',

	// Dialogs
	RenameDlgTitle : '重新命名',
	NewNameDlgTitle : '文件名',
	FileExistsDlgTitle : '文件已存在',
	SysErrorDlgTitle : '系統錯誤',

	FileOverwrite	: '覆蓋',
	FileAutorename	: '自動命名',
	ManuallyRename	: '手動命名',

	// Generic
	OkBtn		: '確定',
	CancelBtn	: '取消',
	CloseBtn	: '關閉',

	// Upload Panel
	UploadTitle			: '上傳新檔案',
	UploadSelectLbl		: '請選擇要上傳的檔案',
	UploadProgressLbl	: '(檔案上傳中 , 請稍候...)',
	UploadBtn			: '將檔案上傳到伺服器',
	UploadBtnCancel		: '取消',

	UploadNoFileMsg		: '請從你的電腦選擇一個檔案.',
	UploadNoFolder		: '請選擇一個文件夾，然後上傳',
	UploadNoPerms		: '不允許文件上傳',
	UploadUnknError		: '發送文件時出錯', 
	UploadExtIncorrect	: '不允許在此文件夾中的文件擴展名',

	// Flash Uploads
	UploadLabel : '上傳文件',
	UploadTotalFiles : '上傳總計:',
	UploadTotalSize : '上傳總大小:',
	UploadSend : '上傳',
	UploadAddFiles : '添加文件',
	UploadClearFiles : '清空文件',
	UploadCancel : '取消上傳',
	UploadRemove : '刪除',
	UploadRemoveTip : '已刪除!f',
	UploadUploaded : '已上傳!n%',
	UploadProcessing : '上傳中...',

	// Settings Panel
	SetTitle		: '設定',
	SetView			: '瀏覽方式:',
	SetViewThumb	: '縮圖預覽',
	SetViewList		: '清單列表',
	SetDisplay		: '顯示欄位:',
	SetDisplayName	: '檔案名稱',
	SetDisplayDate	: '檔案日期',
	SetDisplaySize	: '檔案大小',
	SetSort			: '排序方式:',
	SetSortName		: '依 檔案名稱',
	SetSortDate		: '依 檔案日期',
	SetSortSize		: '依 檔案大小',
	SetSortExtension		: '按 擴展名',

	// Status Bar
	FilesCountEmpty : '<此目錄沒有任何檔案>',
	FilesCountOne	: '1 個檔案',
	FilesCountMany	: '%1 個檔案',

	// Size and Speed
	Kb				: '%1 KB',
	Mb				: '%1 MB', // MISSING
	Gb				: '%1 GB', // MISSING
	SizePerSecond	: '%1/s', // MISSING

	// Connector Error Messages.
	ErrorUnknown	: '無法連接到伺服器 ! (錯誤代碼 %1)',
	Errors :
	{
	 10 : '不合法的指令.',
	 11 : '連接過程中 , 未指定資源形態 !',
	 12 : '連接過程中出現不合法的資源形態 !',
	102 : '不合法的檔案或目錄名稱 !',
	103 : '無法連接：可能是使用者權限設定錯誤 !',
	104 : '無法連接：可能是伺服器檔案權限設定錯誤 !',
	105 : '無法上傳：不合法的副檔名 !',
	109 : '不合法的請求 !',
	110 : '不明錯誤 !',
	111 : '由於生成的文件大小有問題，所以這是不可能完成的要求，',
	115 : '檔案或目錄名稱重複 !',
	116 : '找不到目錄 ! 請先重新整理 , 然後再試一次 !',
	117 : '找不到檔案 ! 請先重新整理 , 然後再試一次 !',
	118 : '目標路徑和當前路競相同',
	201 : '伺服器上已有相同的檔案名稱 ! 您上傳的檔案名稱將會自動更改為 "%1".',
	202 : '不合法的檔案 !',
	203 : '不合法的檔案 ! 檔案大小超過預設值 !',
	204 : '您上傳的檔案已經損毀 !',
	205 : '伺服器上沒有預設的暫存目錄 !',
	206 : '檔案上傳程序因為安全因素已被系統自動取消 ! 可能是上傳的檔案內容包含 HTML 碼 !',
	207 : '您上傳的檔案名稱將會自動更改為 "%1".',
	300 : '移動檔案失敗 !',
	301 : '拷貝檔案失敗 !',
	500 : '因為安全因素 , 檔案瀏覽器已被停用 ! 請聯絡您的系統管理者並檢查 CKFinder 的設定檔 config.php !',
	501 : '縮圖預覽功能已被停用 !'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: '檔案名稱不能空白 !',
		FileExists		: '檔案 %s 已存在',
		FolderEmpty		: '目錄名稱不能空白 !',
		FolderExists	: '資料夾 %s 已存在',
		FolderNameExists	: '資料夾已存在',

		FileInvChar		: '檔案名稱不能包含以下字元： \n\\ / : * ? " < > |',
		FolderInvChar	: '目錄名稱不能包含以下字元： \n\\ / : * ? " < > |',

		PopupBlockView	: '無法在新視窗開啟檔案 ! 請檢查瀏覽器的設定並且針對這個網站 關閉 <封鎖彈跳視窗> 這個功能 !',
		XmlError : '從服務器讀取XML數據出錯',
		XmlEmpty : '無法從服務器讀取數據，因XML響應返回結果為空',
		XmlRawResponse : '服務器返回原始結果: %s'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle : '改變尺寸%s',
		sizeTooBig : '無法大於原圖尺寸(%size).',
		resizeSuccess : '圖像尺寸已修改.',
		thumbnailNew : '創建縮略圖',
		thumbnailSmall : '小(%s)',
		thumbnailMedium : '中(%s)',
		thumbnailLarge : '大(%s)',
		newSize : '設置新尺寸',
		width : '寬度',
		height : '高度',
		invalidHeight : '無效高度.',
		invalidWidth : '無效寬度.',
		invalidName : '文件名無效.',
		newImage : '創建圖像',
		noExtensionChange : '無法改變文件後綴.',
		imageSmall : '原文件尺寸過小',
		contextMenuName : '改變尺寸',
		lockRatio : '鎖定比例',
		resetSize : '原始尺寸'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save : '保存',
		fileOpenError : '無法打開文件.',
		fileSaveSuccess : '成功保存文件.',
		contextMenuName : '編輯',
		loadingFile : '加載文件中...'
	},

	Maximize :
	{
		maximize : '最大化',
		minimize : '最小化'
	},

	Gallery :
	{
		current : '第 {current} 個圖像，共 {total} 個'
	},

	Zip :
	{
		extractHereLabel	: '解壓縮到這',
		extractToLabel		: '從何處解壓縮...',
		downloadZipLabel	: '下載成ZIP檔案格式',
		compressZipLabel	: '壓縮成ZIP檔案格式',
		removeAndExtract	: '刪除現有的和解壓縮的',
		extractAndOverwrite	: '解壓縮後並覆蓋現有的檔案',
		extractSuccess		: '檔案解壓縮成功'
	},

	Search :
	{
		searchPlaceholder : '搜尋'
	}
};
