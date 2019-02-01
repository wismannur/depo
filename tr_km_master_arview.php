<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_km_master_arinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tr_km_item_argridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_km_master_ar_view = NULL; // Initialize page object first

class ctr_km_master_ar_view extends ctr_km_master_ar {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_km_master_ar';

	// Page object name
	var $PageObjName = 'tr_km_master_ar_view';

	// Page headings
	var $Heading = '';
	var $Subheading = '';

	// Page heading
	function PageHeading() {
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "TableCaption"))
			return $this->TableCaption();
		return "";
	}

	// Page subheading
	function PageSubheading() {
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->Phrase($this->PageID);
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (tr_km_master_ar)
		if (!isset($GLOBALS["tr_km_master_ar"]) || get_class($GLOBALS["tr_km_master_ar"]) == "ctr_km_master_ar") {
			$GLOBALS["tr_km_master_ar"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_km_master_ar"];
		}
		$KeyUrl = "";
		if (@$_GET["row_id"] <> "") {
			$this->RecKey["row_id"] = $_GET["row_id"];
			$KeyUrl .= "&amp;row_id=" . urlencode($this->RecKey["row_id"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_km_master_ar', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect($this->DBID);

		// User table object (employees)
		if (!isset($UserTable)) {
			$UserTable = new cemployees();
			$UserTableConn = Conn($UserTable->DBID);
		}

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Is modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("tr_km_master_arlist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->row_id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->row_id->Visible = FALSE;
		$this->km_nomor->SetVisibility();
		$this->km_tanggal->SetVisibility();
		$this->customer_id->SetVisibility();
		$this->customer_name->SetVisibility();
		$this->km_type->SetVisibility();
		$this->km_acc->SetVisibility();
		$this->cek_no->SetVisibility();
		$this->tgl_jt->SetVisibility();
		$this->cek_amt->SetVisibility();
		$this->ret_number1->SetVisibility();
		$this->ret_date1->SetVisibility();
		$this->retur_amt1->SetVisibility();
		$this->ret_number2->SetVisibility();
		$this->ret_date2->SetVisibility();
		$this->retur_amt2->SetVisibility();
		$this->ret_number3->SetVisibility();
		$this->ret_date3->SetVisibility();
		$this->retur_amt3->SetVisibility();
		$this->tunai_amt->SetVisibility();
		$this->dp_amt->SetVisibility();
		$this->km_amt->SetVisibility();
		$this->km_notes->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $tr_km_master_ar;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_km_master_ar);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		// Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "tr_km_master_arview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				header("Content-Type: application/json; charset=utf-8");
				echo ew_ConvertToUtf8(ew_ArrayToJson(array($row)));
			} else {
				ew_SaveDebugMsg();
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $ExportOptions; // Export options
	var $OtherOptions = array(); // Other options
	var $DisplayRecs = 1;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $IsModal = FALSE;
	var $tr_km_item_ar_Count;
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $gbSkipHeaderFooter, $EW_EXPORT;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["row_id"] <> "") {
				$this->row_id->setQueryStringValue($_GET["row_id"]);
				$this->RecKey["row_id"] = $this->row_id->QueryStringValue;
			} elseif (@$_POST["row_id"] <> "") {
				$this->row_id->setFormValue($_POST["row_id"]);
				$this->RecKey["row_id"] = $this->row_id->FormValue;
			} else {
				$sReturnUrl = "tr_km_master_arlist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "tr_km_master_arlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "tr_km_master_arlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();

		// Render row
		$this->RowType = EW_ROWTYPE_VIEW;
		$this->ResetAttrs();
		$this->RenderRow();

		// Set up detail parameters
		$this->SetupDetailParms();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = &$options["action"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->AddUrl) . "'});\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());

		// Edit
		$item = &$option->Add("edit");
		$editcaption = ew_HtmlTitle($Language->Phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewEdit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->EditUrl) . "'});\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewEdit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl <> "" && $Security->CanEdit());

		// Delete
		$item = &$option->Add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew_ConfirmDelete(this);\" class=\"ewAction ewDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" href=\"" . ew_HtmlEncode(ew_UrlAddQuery($this->DeleteUrl, "a_delete=1")) . "\">" . $Language->Phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl <> "" && $Security->CanDelete());
		$option = &$options["detail"];
		$DetailTableLink = "";
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_tr_km_item_ar"
		$item = &$option->Add("detail_tr_km_item_ar");
		$body = $Language->Phrase("ViewPageDetailLink") . $Language->TablePhrase("tr_km_item_ar", "TblCaption");
		$body .= str_replace("%c", $this->tr_km_item_ar_Count, $Language->Phrase("DetailCount"));
		$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("tr_km_item_arlist.php?" . EW_TABLE_SHOW_MASTER . "=tr_km_master_ar&fk_row_id=" . urlencode(strval($this->row_id->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if ($GLOBALS["tr_km_item_ar_grid"] && $GLOBALS["tr_km_item_ar_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 'tr_km_item_ar')) {
			$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=tr_km_item_ar")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
			$DetailViewTblVar .= "tr_km_item_ar";
		}
		if ($GLOBALS["tr_km_item_ar_grid"] && $GLOBALS["tr_km_item_ar_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 'tr_km_item_ar')) {
			$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=tr_km_item_ar")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
			if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
			$DetailEditTblVar .= "tr_km_item_ar";
		}
		if ($links <> "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'tr_km_item_ar');
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "tr_km_item_ar";
		}
		if ($this->ShowMultipleDetails) $item->Visible = FALSE;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$body = $Language->Phrase("MultipleMasterDetails");
			$body = "<div class=\"btn-group\">";
			$links = "";
			if ($DetailViewTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailViewTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($DetailEditTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailEditTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($DetailCopyTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailCopy\" data-action=\"add\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->GetCopyUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailCopyTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewMasterDetail\" title=\"" . ew_HtmlTitle($Language->Phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("MultipleMasterDetails") . "<b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu ewMenu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$oListOpt = &$option->Add("details");
			$oListOpt->Body = $body;
		}

		// Set up detail default
		$option = &$options["detail"];
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$option->UseImageAndText = TRUE;
		$ar = explode(",", $DetailTableLink);
		$cnt = count($ar);
		$option->UseDropDownButton = ($cnt > 1);
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up action default
		$option = &$options["action"];
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonActions");
		$option->UseImageAndText = TRUE;
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Set up starting record parameters
	function SetupStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues($rs = NULL) {
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->NewRow(); 

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->row_id->setDbValue($row['row_id']);
		$this->km_nomor->setDbValue($row['km_nomor']);
		$this->km_tanggal->setDbValue($row['km_tanggal']);
		$this->customer_id->setDbValue($row['customer_id']);
		$this->customer_name->setDbValue($row['customer_name']);
		$this->km_type->setDbValue($row['km_type']);
		$this->km_acc->setDbValue($row['km_acc']);
		$this->cek_no->setDbValue($row['cek_no']);
		$this->tgl_jt->setDbValue($row['tgl_jt']);
		$this->cek_amt->setDbValue($row['cek_amt']);
		$this->ret_number1->setDbValue($row['ret_number1']);
		$this->ret_date1->setDbValue($row['ret_date1']);
		$this->retur_amt1->setDbValue($row['retur_amt1']);
		$this->ret_number2->setDbValue($row['ret_number2']);
		$this->ret_date2->setDbValue($row['ret_date2']);
		$this->retur_amt2->setDbValue($row['retur_amt2']);
		$this->ret_number3->setDbValue($row['ret_number3']);
		$this->ret_date3->setDbValue($row['ret_date3']);
		$this->retur_amt3->setDbValue($row['retur_amt3']);
		$this->tunai_amt->setDbValue($row['tunai_amt']);
		$this->dp_amt->setDbValue($row['dp_amt']);
		$this->km_amt->setDbValue($row['km_amt']);
		$this->km_notes->setDbValue($row['km_notes']);
		if (!isset($GLOBALS["tr_km_item_ar_grid"])) $GLOBALS["tr_km_item_ar_grid"] = new ctr_km_item_ar_grid;
		$sDetailFilter = $GLOBALS["tr_km_item_ar"]->SqlDetailFilter_tr_km_master_ar();
		$sDetailFilter = str_replace("@master_id@", ew_AdjustSql($this->row_id->DbValue, "DB"), $sDetailFilter);
		$GLOBALS["tr_km_item_ar"]->setCurrentMasterTable("tr_km_master_ar");
		$sDetailFilter = $GLOBALS["tr_km_item_ar"]->ApplyUserIDFilters($sDetailFilter);
		$this->tr_km_item_ar_Count = $GLOBALS["tr_km_item_ar"]->LoadRecordCount($sDetailFilter);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['row_id'] = NULL;
		$row['km_nomor'] = NULL;
		$row['km_tanggal'] = NULL;
		$row['customer_id'] = NULL;
		$row['customer_name'] = NULL;
		$row['km_type'] = NULL;
		$row['km_acc'] = NULL;
		$row['cek_no'] = NULL;
		$row['tgl_jt'] = NULL;
		$row['cek_amt'] = NULL;
		$row['ret_number1'] = NULL;
		$row['ret_date1'] = NULL;
		$row['retur_amt1'] = NULL;
		$row['ret_number2'] = NULL;
		$row['ret_date2'] = NULL;
		$row['retur_amt2'] = NULL;
		$row['ret_number3'] = NULL;
		$row['ret_date3'] = NULL;
		$row['retur_amt3'] = NULL;
		$row['tunai_amt'] = NULL;
		$row['dp_amt'] = NULL;
		$row['km_amt'] = NULL;
		$row['km_notes'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->row_id->DbValue = $row['row_id'];
		$this->km_nomor->DbValue = $row['km_nomor'];
		$this->km_tanggal->DbValue = $row['km_tanggal'];
		$this->customer_id->DbValue = $row['customer_id'];
		$this->customer_name->DbValue = $row['customer_name'];
		$this->km_type->DbValue = $row['km_type'];
		$this->km_acc->DbValue = $row['km_acc'];
		$this->cek_no->DbValue = $row['cek_no'];
		$this->tgl_jt->DbValue = $row['tgl_jt'];
		$this->cek_amt->DbValue = $row['cek_amt'];
		$this->ret_number1->DbValue = $row['ret_number1'];
		$this->ret_date1->DbValue = $row['ret_date1'];
		$this->retur_amt1->DbValue = $row['retur_amt1'];
		$this->ret_number2->DbValue = $row['ret_number2'];
		$this->ret_date2->DbValue = $row['ret_date2'];
		$this->retur_amt2->DbValue = $row['retur_amt2'];
		$this->ret_number3->DbValue = $row['ret_number3'];
		$this->ret_date3->DbValue = $row['ret_date3'];
		$this->retur_amt3->DbValue = $row['retur_amt3'];
		$this->tunai_amt->DbValue = $row['tunai_amt'];
		$this->dp_amt->DbValue = $row['dp_amt'];
		$this->km_amt->DbValue = $row['km_amt'];
		$this->km_notes->DbValue = $row['km_notes'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		$this->AddUrl = $this->GetAddUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();
		$this->ListUrl = $this->GetListUrl();
		$this->SetupOtherOptions();

		// Convert decimal values if posted back
		if ($this->cek_amt->FormValue == $this->cek_amt->CurrentValue && is_numeric(ew_StrToFloat($this->cek_amt->CurrentValue)))
			$this->cek_amt->CurrentValue = ew_StrToFloat($this->cek_amt->CurrentValue);

		// Convert decimal values if posted back
		if ($this->retur_amt1->FormValue == $this->retur_amt1->CurrentValue && is_numeric(ew_StrToFloat($this->retur_amt1->CurrentValue)))
			$this->retur_amt1->CurrentValue = ew_StrToFloat($this->retur_amt1->CurrentValue);

		// Convert decimal values if posted back
		if ($this->retur_amt2->FormValue == $this->retur_amt2->CurrentValue && is_numeric(ew_StrToFloat($this->retur_amt2->CurrentValue)))
			$this->retur_amt2->CurrentValue = ew_StrToFloat($this->retur_amt2->CurrentValue);

		// Convert decimal values if posted back
		if ($this->retur_amt3->FormValue == $this->retur_amt3->CurrentValue && is_numeric(ew_StrToFloat($this->retur_amt3->CurrentValue)))
			$this->retur_amt3->CurrentValue = ew_StrToFloat($this->retur_amt3->CurrentValue);

		// Convert decimal values if posted back
		if ($this->tunai_amt->FormValue == $this->tunai_amt->CurrentValue && is_numeric(ew_StrToFloat($this->tunai_amt->CurrentValue)))
			$this->tunai_amt->CurrentValue = ew_StrToFloat($this->tunai_amt->CurrentValue);

		// Convert decimal values if posted back
		if ($this->dp_amt->FormValue == $this->dp_amt->CurrentValue && is_numeric(ew_StrToFloat($this->dp_amt->CurrentValue)))
			$this->dp_amt->CurrentValue = ew_StrToFloat($this->dp_amt->CurrentValue);

		// Convert decimal values if posted back
		if ($this->km_amt->FormValue == $this->km_amt->CurrentValue && is_numeric(ew_StrToFloat($this->km_amt->CurrentValue)))
			$this->km_amt->CurrentValue = ew_StrToFloat($this->km_amt->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// row_id
		// km_nomor
		// km_tanggal
		// customer_id
		// customer_name
		// km_type
		// km_acc
		// cek_no
		// tgl_jt
		// cek_amt
		// ret_number1
		// ret_date1
		// retur_amt1
		// ret_number2
		// ret_date2
		// retur_amt2
		// ret_number3
		// ret_date3
		// retur_amt3
		// tunai_amt
		// dp_amt
		// km_amt
		// km_notes

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// row_id
		$this->row_id->ViewValue = $this->row_id->CurrentValue;
		$this->row_id->ViewCustomAttributes = "";

		// km_nomor
		$this->km_nomor->ViewValue = $this->km_nomor->CurrentValue;
		$this->km_nomor->ViewCustomAttributes = "";

		// km_tanggal
		$this->km_tanggal->ViewValue = $this->km_tanggal->CurrentValue;
		$this->km_tanggal->ViewValue = ew_FormatDateTime($this->km_tanggal->ViewValue, 0);
		$this->km_tanggal->ViewCustomAttributes = "";

		// customer_id
		$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
		if (strval($this->customer_id->CurrentValue) <> "") {
			$sFilterWrk = "`customer_id`" . ew_SearchString("=", $this->customer_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `customer_id`, `customer_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_customer`";
		$sWhereWrk = "";
		$this->customer_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->customer_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->customer_id->ViewValue = $this->customer_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
			}
		} else {
			$this->customer_id->ViewValue = NULL;
		}
		$this->customer_id->ViewCustomAttributes = "";

		// customer_name
		$this->customer_name->ViewValue = $this->customer_name->CurrentValue;
		$this->customer_name->ViewCustomAttributes = "";

		// km_type
		if (strval($this->km_type->CurrentValue) <> "") {
			$this->km_type->ViewValue = $this->km_type->OptionCaption($this->km_type->CurrentValue);
		} else {
			$this->km_type->ViewValue = NULL;
		}
		$this->km_type->ViewCustomAttributes = "";

		// km_acc
		$this->km_acc->ViewValue = $this->km_acc->CurrentValue;
		$this->km_acc->ViewCustomAttributes = "";

		// cek_no
		$this->cek_no->ViewValue = $this->cek_no->CurrentValue;
		$this->cek_no->ViewCustomAttributes = "";

		// tgl_jt
		$this->tgl_jt->ViewValue = $this->tgl_jt->CurrentValue;
		$this->tgl_jt->ViewValue = ew_FormatDateTime($this->tgl_jt->ViewValue, 0);
		$this->tgl_jt->ViewCustomAttributes = "";

		// cek_amt
		$this->cek_amt->ViewValue = $this->cek_amt->CurrentValue;
		$this->cek_amt->ViewCustomAttributes = "";

		// ret_number1
		$this->ret_number1->ViewValue = $this->ret_number1->CurrentValue;
		$this->ret_number1->ViewCustomAttributes = "";

		// ret_date1
		$this->ret_date1->ViewValue = $this->ret_date1->CurrentValue;
		$this->ret_date1->ViewValue = ew_FormatDateTime($this->ret_date1->ViewValue, 0);
		$this->ret_date1->ViewCustomAttributes = "";

		// retur_amt1
		$this->retur_amt1->ViewValue = $this->retur_amt1->CurrentValue;
		$this->retur_amt1->ViewCustomAttributes = "";

		// ret_number2
		$this->ret_number2->ViewValue = $this->ret_number2->CurrentValue;
		$this->ret_number2->ViewCustomAttributes = "";

		// ret_date2
		$this->ret_date2->ViewValue = $this->ret_date2->CurrentValue;
		$this->ret_date2->ViewValue = ew_FormatDateTime($this->ret_date2->ViewValue, 0);
		$this->ret_date2->ViewCustomAttributes = "";

		// retur_amt2
		$this->retur_amt2->ViewValue = $this->retur_amt2->CurrentValue;
		$this->retur_amt2->ViewCustomAttributes = "";

		// ret_number3
		$this->ret_number3->ViewValue = $this->ret_number3->CurrentValue;
		$this->ret_number3->ViewCustomAttributes = "";

		// ret_date3
		$this->ret_date3->ViewValue = $this->ret_date3->CurrentValue;
		$this->ret_date3->ViewValue = ew_FormatDateTime($this->ret_date3->ViewValue, 0);
		$this->ret_date3->ViewCustomAttributes = "";

		// retur_amt3
		$this->retur_amt3->ViewValue = $this->retur_amt3->CurrentValue;
		$this->retur_amt3->ViewCustomAttributes = "";

		// tunai_amt
		$this->tunai_amt->ViewValue = $this->tunai_amt->CurrentValue;
		$this->tunai_amt->ViewCustomAttributes = "";

		// dp_amt
		$this->dp_amt->ViewValue = $this->dp_amt->CurrentValue;
		$this->dp_amt->ViewCustomAttributes = "";

		// km_amt
		$this->km_amt->ViewValue = $this->km_amt->CurrentValue;
		$this->km_amt->ViewCustomAttributes = "";

		// km_notes
		$this->km_notes->ViewValue = $this->km_notes->CurrentValue;
		$this->km_notes->ViewCustomAttributes = "";

			// row_id
			$this->row_id->LinkCustomAttributes = "";
			$this->row_id->HrefValue = "";
			$this->row_id->TooltipValue = "";

			// km_nomor
			$this->km_nomor->LinkCustomAttributes = "";
			$this->km_nomor->HrefValue = "";
			$this->km_nomor->TooltipValue = "";

			// km_tanggal
			$this->km_tanggal->LinkCustomAttributes = "";
			$this->km_tanggal->HrefValue = "";
			$this->km_tanggal->TooltipValue = "";

			// customer_id
			$this->customer_id->LinkCustomAttributes = "";
			$this->customer_id->HrefValue = "";
			$this->customer_id->TooltipValue = "";

			// customer_name
			$this->customer_name->LinkCustomAttributes = "";
			$this->customer_name->HrefValue = "";
			$this->customer_name->TooltipValue = "";

			// km_type
			$this->km_type->LinkCustomAttributes = "";
			$this->km_type->HrefValue = "";
			$this->km_type->TooltipValue = "";

			// km_acc
			$this->km_acc->LinkCustomAttributes = "";
			$this->km_acc->HrefValue = "";
			$this->km_acc->TooltipValue = "";

			// cek_no
			$this->cek_no->LinkCustomAttributes = "";
			$this->cek_no->HrefValue = "";
			$this->cek_no->TooltipValue = "";

			// tgl_jt
			$this->tgl_jt->LinkCustomAttributes = "";
			$this->tgl_jt->HrefValue = "";
			$this->tgl_jt->TooltipValue = "";

			// cek_amt
			$this->cek_amt->LinkCustomAttributes = "";
			$this->cek_amt->HrefValue = "";
			$this->cek_amt->TooltipValue = "";

			// ret_number1
			$this->ret_number1->LinkCustomAttributes = "";
			$this->ret_number1->HrefValue = "";
			$this->ret_number1->TooltipValue = "";

			// ret_date1
			$this->ret_date1->LinkCustomAttributes = "";
			$this->ret_date1->HrefValue = "";
			$this->ret_date1->TooltipValue = "";

			// retur_amt1
			$this->retur_amt1->LinkCustomAttributes = "";
			$this->retur_amt1->HrefValue = "";
			$this->retur_amt1->TooltipValue = "";

			// ret_number2
			$this->ret_number2->LinkCustomAttributes = "";
			$this->ret_number2->HrefValue = "";
			$this->ret_number2->TooltipValue = "";

			// ret_date2
			$this->ret_date2->LinkCustomAttributes = "";
			$this->ret_date2->HrefValue = "";
			$this->ret_date2->TooltipValue = "";

			// retur_amt2
			$this->retur_amt2->LinkCustomAttributes = "";
			$this->retur_amt2->HrefValue = "";
			$this->retur_amt2->TooltipValue = "";

			// ret_number3
			$this->ret_number3->LinkCustomAttributes = "";
			$this->ret_number3->HrefValue = "";
			$this->ret_number3->TooltipValue = "";

			// ret_date3
			$this->ret_date3->LinkCustomAttributes = "";
			$this->ret_date3->HrefValue = "";
			$this->ret_date3->TooltipValue = "";

			// retur_amt3
			$this->retur_amt3->LinkCustomAttributes = "";
			$this->retur_amt3->HrefValue = "";
			$this->retur_amt3->TooltipValue = "";

			// tunai_amt
			$this->tunai_amt->LinkCustomAttributes = "";
			$this->tunai_amt->HrefValue = "";
			$this->tunai_amt->TooltipValue = "";

			// dp_amt
			$this->dp_amt->LinkCustomAttributes = "";
			$this->dp_amt->HrefValue = "";
			$this->dp_amt->TooltipValue = "";

			// km_amt
			$this->km_amt->LinkCustomAttributes = "";
			$this->km_amt->HrefValue = "";
			$this->km_amt->TooltipValue = "";

			// km_notes
			$this->km_notes->LinkCustomAttributes = "";
			$this->km_notes->HrefValue = "";
			$this->km_notes->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up detail parms based on QueryString
	function SetupDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("tr_km_item_ar", $DetailTblVar)) {
				if (!isset($GLOBALS["tr_km_item_ar_grid"]))
					$GLOBALS["tr_km_item_ar_grid"] = new ctr_km_item_ar_grid;
				if ($GLOBALS["tr_km_item_ar_grid"]->DetailView) {
					$GLOBALS["tr_km_item_ar_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["tr_km_item_ar_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["tr_km_item_ar_grid"]->setStartRecordNumber(1);
					$GLOBALS["tr_km_item_ar_grid"]->master_id->FldIsDetailKey = TRUE;
					$GLOBALS["tr_km_item_ar_grid"]->master_id->CurrentValue = $this->row_id->CurrentValue;
					$GLOBALS["tr_km_item_ar_grid"]->master_id->setSessionValue($GLOBALS["tr_km_item_ar_grid"]->master_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_km_master_arlist.php"), "", $this->TableVar, TRUE);
		$PageId = "view";
		$Breadcrumb->Add("view", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($tr_km_master_ar_view)) $tr_km_master_ar_view = new ctr_km_master_ar_view();

// Page init
$tr_km_master_ar_view->Page_Init();

// Page main
$tr_km_master_ar_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_km_master_ar_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = ftr_km_master_arview = new ew_Form("ftr_km_master_arview", "view");

// Form_CustomValidate event
ftr_km_master_arview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_km_master_arview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_km_master_arview.Lists["x_customer_id"] = {"LinkField":"x_customer_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_customer_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_customer"};
ftr_km_master_arview.Lists["x_customer_id"].Data = "<?php echo $tr_km_master_ar_view->customer_id->LookupFilterQuery(FALSE, "view") ?>";
ftr_km_master_arview.AutoSuggests["x_customer_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $tr_km_master_ar_view->customer_id->LookupFilterQuery(TRUE, "view"))) ?>;
ftr_km_master_arview.Lists["x_km_type"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftr_km_master_arview.Lists["x_km_type"].Options = <?php echo json_encode($tr_km_master_ar_view->km_type->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $tr_km_master_ar_view->ExportOptions->Render("body") ?>
<?php
	foreach ($tr_km_master_ar_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php $tr_km_master_ar_view->ShowPageHeader(); ?>
<?php
$tr_km_master_ar_view->ShowMessage();
?>
<form name="ftr_km_master_arview" id="ftr_km_master_arview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_km_master_ar_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_km_master_ar_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_km_master_ar">
<input type="hidden" name="modal" value="<?php echo intval($tr_km_master_ar_view->IsModal) ?>">
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($tr_km_master_ar->row_id->Visible) { // row_id ?>
	<tr id="r_row_id">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_row_id"><?php echo $tr_km_master_ar->row_id->FldCaption() ?></span></td>
		<td data-name="row_id"<?php echo $tr_km_master_ar->row_id->CellAttributes() ?>>
<span id="el_tr_km_master_ar_row_id">
<span<?php echo $tr_km_master_ar->row_id->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->row_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->km_nomor->Visible) { // km_nomor ?>
	<tr id="r_km_nomor">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_km_nomor"><?php echo $tr_km_master_ar->km_nomor->FldCaption() ?></span></td>
		<td data-name="km_nomor"<?php echo $tr_km_master_ar->km_nomor->CellAttributes() ?>>
<span id="el_tr_km_master_ar_km_nomor">
<span<?php echo $tr_km_master_ar->km_nomor->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->km_nomor->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->km_tanggal->Visible) { // km_tanggal ?>
	<tr id="r_km_tanggal">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_km_tanggal"><?php echo $tr_km_master_ar->km_tanggal->FldCaption() ?></span></td>
		<td data-name="km_tanggal"<?php echo $tr_km_master_ar->km_tanggal->CellAttributes() ?>>
<span id="el_tr_km_master_ar_km_tanggal">
<span<?php echo $tr_km_master_ar->km_tanggal->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->km_tanggal->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->customer_id->Visible) { // customer_id ?>
	<tr id="r_customer_id">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_customer_id"><?php echo $tr_km_master_ar->customer_id->FldCaption() ?></span></td>
		<td data-name="customer_id"<?php echo $tr_km_master_ar->customer_id->CellAttributes() ?>>
<span id="el_tr_km_master_ar_customer_id">
<span<?php echo $tr_km_master_ar->customer_id->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->customer_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->customer_name->Visible) { // customer_name ?>
	<tr id="r_customer_name">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_customer_name"><?php echo $tr_km_master_ar->customer_name->FldCaption() ?></span></td>
		<td data-name="customer_name"<?php echo $tr_km_master_ar->customer_name->CellAttributes() ?>>
<span id="el_tr_km_master_ar_customer_name">
<span<?php echo $tr_km_master_ar->customer_name->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->customer_name->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->km_type->Visible) { // km_type ?>
	<tr id="r_km_type">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_km_type"><?php echo $tr_km_master_ar->km_type->FldCaption() ?></span></td>
		<td data-name="km_type"<?php echo $tr_km_master_ar->km_type->CellAttributes() ?>>
<span id="el_tr_km_master_ar_km_type">
<span<?php echo $tr_km_master_ar->km_type->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->km_type->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->km_acc->Visible) { // km_acc ?>
	<tr id="r_km_acc">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_km_acc"><?php echo $tr_km_master_ar->km_acc->FldCaption() ?></span></td>
		<td data-name="km_acc"<?php echo $tr_km_master_ar->km_acc->CellAttributes() ?>>
<span id="el_tr_km_master_ar_km_acc">
<span<?php echo $tr_km_master_ar->km_acc->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->km_acc->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->cek_no->Visible) { // cek_no ?>
	<tr id="r_cek_no">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_cek_no"><?php echo $tr_km_master_ar->cek_no->FldCaption() ?></span></td>
		<td data-name="cek_no"<?php echo $tr_km_master_ar->cek_no->CellAttributes() ?>>
<span id="el_tr_km_master_ar_cek_no">
<span<?php echo $tr_km_master_ar->cek_no->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->cek_no->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->tgl_jt->Visible) { // tgl_jt ?>
	<tr id="r_tgl_jt">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_tgl_jt"><?php echo $tr_km_master_ar->tgl_jt->FldCaption() ?></span></td>
		<td data-name="tgl_jt"<?php echo $tr_km_master_ar->tgl_jt->CellAttributes() ?>>
<span id="el_tr_km_master_ar_tgl_jt">
<span<?php echo $tr_km_master_ar->tgl_jt->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->tgl_jt->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->cek_amt->Visible) { // cek_amt ?>
	<tr id="r_cek_amt">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_cek_amt"><?php echo $tr_km_master_ar->cek_amt->FldCaption() ?></span></td>
		<td data-name="cek_amt"<?php echo $tr_km_master_ar->cek_amt->CellAttributes() ?>>
<span id="el_tr_km_master_ar_cek_amt">
<span<?php echo $tr_km_master_ar->cek_amt->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->cek_amt->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->ret_number1->Visible) { // ret_number1 ?>
	<tr id="r_ret_number1">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_ret_number1"><?php echo $tr_km_master_ar->ret_number1->FldCaption() ?></span></td>
		<td data-name="ret_number1"<?php echo $tr_km_master_ar->ret_number1->CellAttributes() ?>>
<span id="el_tr_km_master_ar_ret_number1">
<span<?php echo $tr_km_master_ar->ret_number1->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->ret_number1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->ret_date1->Visible) { // ret_date1 ?>
	<tr id="r_ret_date1">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_ret_date1"><?php echo $tr_km_master_ar->ret_date1->FldCaption() ?></span></td>
		<td data-name="ret_date1"<?php echo $tr_km_master_ar->ret_date1->CellAttributes() ?>>
<span id="el_tr_km_master_ar_ret_date1">
<span<?php echo $tr_km_master_ar->ret_date1->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->ret_date1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->retur_amt1->Visible) { // retur_amt1 ?>
	<tr id="r_retur_amt1">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_retur_amt1"><?php echo $tr_km_master_ar->retur_amt1->FldCaption() ?></span></td>
		<td data-name="retur_amt1"<?php echo $tr_km_master_ar->retur_amt1->CellAttributes() ?>>
<span id="el_tr_km_master_ar_retur_amt1">
<span<?php echo $tr_km_master_ar->retur_amt1->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->retur_amt1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->ret_number2->Visible) { // ret_number2 ?>
	<tr id="r_ret_number2">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_ret_number2"><?php echo $tr_km_master_ar->ret_number2->FldCaption() ?></span></td>
		<td data-name="ret_number2"<?php echo $tr_km_master_ar->ret_number2->CellAttributes() ?>>
<span id="el_tr_km_master_ar_ret_number2">
<span<?php echo $tr_km_master_ar->ret_number2->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->ret_number2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->ret_date2->Visible) { // ret_date2 ?>
	<tr id="r_ret_date2">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_ret_date2"><?php echo $tr_km_master_ar->ret_date2->FldCaption() ?></span></td>
		<td data-name="ret_date2"<?php echo $tr_km_master_ar->ret_date2->CellAttributes() ?>>
<span id="el_tr_km_master_ar_ret_date2">
<span<?php echo $tr_km_master_ar->ret_date2->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->ret_date2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->retur_amt2->Visible) { // retur_amt2 ?>
	<tr id="r_retur_amt2">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_retur_amt2"><?php echo $tr_km_master_ar->retur_amt2->FldCaption() ?></span></td>
		<td data-name="retur_amt2"<?php echo $tr_km_master_ar->retur_amt2->CellAttributes() ?>>
<span id="el_tr_km_master_ar_retur_amt2">
<span<?php echo $tr_km_master_ar->retur_amt2->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->retur_amt2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->ret_number3->Visible) { // ret_number3 ?>
	<tr id="r_ret_number3">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_ret_number3"><?php echo $tr_km_master_ar->ret_number3->FldCaption() ?></span></td>
		<td data-name="ret_number3"<?php echo $tr_km_master_ar->ret_number3->CellAttributes() ?>>
<span id="el_tr_km_master_ar_ret_number3">
<span<?php echo $tr_km_master_ar->ret_number3->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->ret_number3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->ret_date3->Visible) { // ret_date3 ?>
	<tr id="r_ret_date3">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_ret_date3"><?php echo $tr_km_master_ar->ret_date3->FldCaption() ?></span></td>
		<td data-name="ret_date3"<?php echo $tr_km_master_ar->ret_date3->CellAttributes() ?>>
<span id="el_tr_km_master_ar_ret_date3">
<span<?php echo $tr_km_master_ar->ret_date3->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->ret_date3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->retur_amt3->Visible) { // retur_amt3 ?>
	<tr id="r_retur_amt3">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_retur_amt3"><?php echo $tr_km_master_ar->retur_amt3->FldCaption() ?></span></td>
		<td data-name="retur_amt3"<?php echo $tr_km_master_ar->retur_amt3->CellAttributes() ?>>
<span id="el_tr_km_master_ar_retur_amt3">
<span<?php echo $tr_km_master_ar->retur_amt3->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->retur_amt3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->tunai_amt->Visible) { // tunai_amt ?>
	<tr id="r_tunai_amt">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_tunai_amt"><?php echo $tr_km_master_ar->tunai_amt->FldCaption() ?></span></td>
		<td data-name="tunai_amt"<?php echo $tr_km_master_ar->tunai_amt->CellAttributes() ?>>
<span id="el_tr_km_master_ar_tunai_amt">
<span<?php echo $tr_km_master_ar->tunai_amt->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->tunai_amt->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->dp_amt->Visible) { // dp_amt ?>
	<tr id="r_dp_amt">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_dp_amt"><?php echo $tr_km_master_ar->dp_amt->FldCaption() ?></span></td>
		<td data-name="dp_amt"<?php echo $tr_km_master_ar->dp_amt->CellAttributes() ?>>
<span id="el_tr_km_master_ar_dp_amt">
<span<?php echo $tr_km_master_ar->dp_amt->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->dp_amt->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->km_amt->Visible) { // km_amt ?>
	<tr id="r_km_amt">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_km_amt"><?php echo $tr_km_master_ar->km_amt->FldCaption() ?></span></td>
		<td data-name="km_amt"<?php echo $tr_km_master_ar->km_amt->CellAttributes() ?>>
<span id="el_tr_km_master_ar_km_amt">
<span<?php echo $tr_km_master_ar->km_amt->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->km_amt->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tr_km_master_ar->km_notes->Visible) { // km_notes ?>
	<tr id="r_km_notes">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_km_notes"><?php echo $tr_km_master_ar->km_notes->FldCaption() ?></span></td>
		<td data-name="km_notes"<?php echo $tr_km_master_ar->km_notes->CellAttributes() ?>>
<span id="el_tr_km_master_ar_km_notes">
<span<?php echo $tr_km_master_ar->km_notes->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->km_notes->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("tr_km_item_ar", explode(",", $tr_km_master_ar->getCurrentDetailTable())) && $tr_km_item_ar->DetailView) {
?>
<?php if ($tr_km_master_ar->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("tr_km_item_ar", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tr_km_item_argrid.php" ?>
<?php } ?>
</form>
<script type="text/javascript">
ftr_km_master_arview.Init();
</script>
<?php
$tr_km_master_ar_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_km_master_ar_view->Page_Terminate();
?>
