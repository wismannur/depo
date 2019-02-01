<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_inv_iteminfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tr_inv_masterinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_inv_item_list = NULL; // Initialize page object first

class ctr_inv_item_list extends ctr_inv_item {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_inv_item';

	// Page object name
	var $PageObjName = 'tr_inv_item_list';

	// Grid form hidden field names
	var $FormName = 'ftr_inv_itemlist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

		// Table object (tr_inv_item)
		if (!isset($GLOBALS["tr_inv_item"]) || get_class($GLOBALS["tr_inv_item"]) == "ctr_inv_item") {
			$GLOBALS["tr_inv_item"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_inv_item"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "tr_inv_itemadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tr_inv_itemdelete.php";
		$this->MultiUpdateUrl = "tr_inv_itemupdate.php";

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Table object (tr_inv_master)
		if (!isset($GLOBALS['tr_inv_master'])) $GLOBALS['tr_inv_master'] = new ctr_inv_master();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_inv_item', TRUE);

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

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption ftr_inv_itemlistsrch";

		// List actions
		$this->ListActions = new cListActions();
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ew_GetUrl("index.php"));
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
		// Create form object

		$objForm = new cFormObj();

		// Get export parameters
		$custom = "";
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
			$custom = @$_GET["custom"];
		} elseif (@$_POST["export"] <> "") {
			$this->Export = $_POST["export"];
			$custom = @$_POST["custom"];
		} elseif (ew_IsPost()) {
			if (@$_POST["exporttype"] <> "")
				$this->Export = $_POST["exporttype"];
			$custom = @$_POST["custom"];
		} elseif (@$_GET["cmd"] == "json") {
			$this->Export = $_GET["cmd"];
		} else {
			$this->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExportFile = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->Export <> "" && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$gsCustomExport = $this->CustomExport;
		$gsExport = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined("EW_USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined("EW_USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();
		$this->item_id->SetVisibility();
		$this->item_code->SetVisibility();
		$this->item_name->SetVisibility();
		$this->udet_id->SetVisibility();
		$this->item_qty->SetVisibility();
		$this->item_price->SetVisibility();
		$this->item_disc->SetVisibility();
		$this->item_amt->SetVisibility();
		$this->unit_id->SetVisibility();

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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();

		// Set up master detail parameters
		$this->SetupMasterParms();

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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
		global $EW_EXPORT, $tr_inv_item;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_inv_item);
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
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 10;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $AutoHidePageSizeSelector = EW_AUTO_HIDE_PAGE_SIZE_SELECTOR;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $EW_EXPORT;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Set up records per page
			$this->SetupDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$this->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($this->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($this->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to grid add mode
				if ($this->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$this->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($this->CurrentAction == "gridupdate" || $this->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit") {
						if ($this->ValidateGridForm()) {
							$bGridUpdate = $this->GridUpdate();
						} else {
							$bGridUpdate = FALSE;
							$this->setFailureMessage($gsFormError);
						}
						if (!$bGridUpdate) {
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridedit"; // Stay in Grid Edit mode
						}
					}

					// Grid Insert
					if ($this->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd") {
						if ($this->ValidateGridForm()) {
							$bGridInsert = $this->GridInsert();
						} else {
							$bGridInsert = FALSE;
							$this->setFailureMessage($gsFormError);
						}
						if (!$bGridInsert) {
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridadd"; // Stay in Grid Add mode
						}
					}
				}
			}

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetupSortOrder();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 10; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $this->GetMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "tr_inv_master") {
			global $tr_inv_master;
			$rsmaster = $tr_inv_master->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("tr_inv_masterlist.php"); // Return to master page
			} else {
				$tr_inv_master->LoadListRowValues($rsmaster);
				$tr_inv_master->RowType = EW_ROWTYPE_MASTER; // Master row
				$tr_inv_master->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSQL = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $sFilter;
		} else {
			$this->setSessionWhere($sFilter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->ListRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	// Set up number of records displayed per page
	function SetupDisplayRecs() {
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 10; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Exit inline mode
	function ClearInlineMode() {
		$this->item_qty->FormValue = ""; // Clear form value
		$this->item_price->FormValue = ""; // Clear form value
		$this->item_disc->FormValue = ""; // Clear form value
		$this->item_amt->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Perform update to grid
	function GridUpdate() {
		global $Language, $objForm, $gsFormError;
		$bGridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->BuildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->BeginTrans();
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			$rowaction = strval($objForm->GetValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->row_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->row_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $Language, $objForm, $gsFormError;
		$rowindex = 1;
		$bGridInsert = FALSE;
		$conn = &$this->Connection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("GridAddCancelled")); // Set grid add cancelled message
			}
			return FALSE;
		}

		// Begin transaction
		$conn->BeginTrans();

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
					$sKey .= $this->row_id->CurrentValue;

					// Add filter for this record
					$sFilter = $this->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->Phrase("NoAddRecord"));
			$bGridInsert = FALSE;
		}
		if ($bGridInsert) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $sWrkFilter;
			$sSql = $this->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("InsertSuccess")); // Set up insert success message
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $objForm;
		if ($objForm->HasValue("x_item_id") && $objForm->HasValue("o_item_id") && $this->item_id->CurrentValue <> $this->item_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_item_code") && $objForm->HasValue("o_item_code") && $this->item_code->CurrentValue <> $this->item_code->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_item_name") && $objForm->HasValue("o_item_name") && $this->item_name->CurrentValue <> $this->item_name->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_udet_id") && $objForm->HasValue("o_udet_id") && $this->udet_id->CurrentValue <> $this->udet_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_item_qty") && $objForm->HasValue("o_item_qty") && $this->item_qty->CurrentValue <> $this->item_qty->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_item_price") && $objForm->HasValue("o_item_price") && $this->item_price->CurrentValue <> $this->item_price->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_item_disc") && $objForm->HasValue("o_item_disc") && $this->item_disc->CurrentValue <> $this->item_disc->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_item_amt") && $objForm->HasValue("o_item_amt") && $this->item_amt->CurrentValue <> $this->item_amt->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_unit_id") && $objForm->HasValue("o_unit_id") && $this->unit_id->CurrentValue <> $this->unit_id->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	function GetGridFormValues() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->GetFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->master_id->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->Add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = TRUE;

		// "delete"
		$item = &$this->ListOptions->Add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = TRUE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->MoveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->Add("sequence");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = TRUE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$objForm->Index = $this->RowIndex;
			$ActionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$OldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$KeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$BlankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $ActionName . "\" id=\"" . $ActionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue($this->FormKeyName);
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $BlankRowName . "\" id=\"" . $BlankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$option = &$this->ListOptions;
				$option->UseButtonGroup = TRUE; // Use button group for grid delete button
				$option->UseImageAndText = TRUE; // Use image and text for grid delete button
				$oListOpt = &$option->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink ewGridDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" onclick=\"return ew_DeleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "sequence"
		$oListOpt = &$this->ListOptions->Items["sequence"];
		$oListOpt->Body = ew_FormatSeqNo($this->RecCnt);

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "delete"
		$oListOpt = &$this->ListOptions->Items["delete"];
		if ($Security->CanDelete())
			$oListOpt->Body = "<a class=\"ewRowLink ewDelete\"" . "" . " title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		else
			$oListOpt->Body = "";

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->row_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		if ($this->CurrentAction == "gridedit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->row_id->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());
		$item = &$option->Add("gridadd");
		$item->Body = "<a class=\"ewAddEdit ewGridAdd\" title=\"" . ew_HtmlTitle($Language->Phrase("GridAddLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridAddLink")) . "\" href=\"" . ew_HtmlEncode($this->GridAddUrl) . "\">" . $Language->Phrase("GridAddLink") . "</a>";
		$item->Visible = ($this->GridAddUrl <> "" && $Security->CanAdd());

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->Add("gridedit");
		$item->Body = "<a class=\"ewAddEdit ewGridEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("GridEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GridEditUrl) . "\">" . $Language->Phrase("GridEditLink") . "</a>";
		$item->Visible = ($this->GridEditUrl <> "" && $Security->CanEdit());
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = TRUE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ftr_inv_itemlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ftr_inv_itemlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = FALSE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "gridedit") { // Not grid add/edit mode
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ftr_inv_itemlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->HideAllOptions();
			if ($this->CurrentAction == "gridadd") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->CanAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;

				// Add grid insert
				$item = &$option->Add("gridinsert");
				$item->Body = "<a class=\"ewAction ewGridInsert\" title=\"" . ew_HtmlTitle($Language->Phrase("GridInsertLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridInsertLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->Add("gridcancel");
				$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
				$item->Body = "<a class=\"ewAction ewGridCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
			if ($this->CurrentAction == "gridedit") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->CanAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;
					$item = &$option->Add("gridsave");
					$item->Body = "<a class=\"ewAction ewGridSave\" title=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("GridSaveLink") . "</a>";
					$item = &$option->Add("gridcancel");
					$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
					$item->Body = "<a class=\"ewAction ewGridCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
		}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
		global $Security;
		if (!$Security->CanSearch()) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}
	}

	function SetupListOptionsExt() {
		global $Security, $Language;

		// Hide detail items for dropdown if necessary
		$this->ListOptions->HideDetailItemsForDropDown();
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load default values
	function LoadDefaultValues() {
		$this->master_id->CurrentValue = NULL;
		$this->master_id->OldValue = $this->master_id->CurrentValue;
		$this->row_id->CurrentValue = NULL;
		$this->row_id->OldValue = $this->row_id->CurrentValue;
		$this->item_id->CurrentValue = NULL;
		$this->item_id->OldValue = $this->item_id->CurrentValue;
		$this->item_code->CurrentValue = NULL;
		$this->item_code->OldValue = $this->item_code->CurrentValue;
		$this->item_name->CurrentValue = NULL;
		$this->item_name->OldValue = $this->item_name->CurrentValue;
		$this->udet_id->CurrentValue = NULL;
		$this->udet_id->OldValue = $this->udet_id->CurrentValue;
		$this->item_qty->CurrentValue = 0;
		$this->item_qty->OldValue = $this->item_qty->CurrentValue;
		$this->item_price->CurrentValue = 0;
		$this->item_price->OldValue = $this->item_price->CurrentValue;
		$this->item_disc->CurrentValue = 0;
		$this->item_disc->OldValue = $this->item_disc->CurrentValue;
		$this->item_amt->CurrentValue = NULL;
		$this->item_amt->OldValue = $this->item_amt->CurrentValue;
		$this->unit_id->CurrentValue = NULL;
		$this->unit_id->OldValue = $this->unit_id->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->item_id->FldIsDetailKey) {
			$this->item_id->setFormValue($objForm->GetValue("x_item_id"));
		}
		$this->item_id->setOldValue($objForm->GetValue("o_item_id"));
		if (!$this->item_code->FldIsDetailKey) {
			$this->item_code->setFormValue($objForm->GetValue("x_item_code"));
		}
		$this->item_code->setOldValue($objForm->GetValue("o_item_code"));
		if (!$this->item_name->FldIsDetailKey) {
			$this->item_name->setFormValue($objForm->GetValue("x_item_name"));
		}
		$this->item_name->setOldValue($objForm->GetValue("o_item_name"));
		if (!$this->udet_id->FldIsDetailKey) {
			$this->udet_id->setFormValue($objForm->GetValue("x_udet_id"));
		}
		$this->udet_id->setOldValue($objForm->GetValue("o_udet_id"));
		if (!$this->item_qty->FldIsDetailKey) {
			$this->item_qty->setFormValue($objForm->GetValue("x_item_qty"));
		}
		$this->item_qty->setOldValue($objForm->GetValue("o_item_qty"));
		if (!$this->item_price->FldIsDetailKey) {
			$this->item_price->setFormValue($objForm->GetValue("x_item_price"));
		}
		$this->item_price->setOldValue($objForm->GetValue("o_item_price"));
		if (!$this->item_disc->FldIsDetailKey) {
			$this->item_disc->setFormValue($objForm->GetValue("x_item_disc"));
		}
		$this->item_disc->setOldValue($objForm->GetValue("o_item_disc"));
		if (!$this->item_amt->FldIsDetailKey) {
			$this->item_amt->setFormValue($objForm->GetValue("x_item_amt"));
		}
		$this->item_amt->setOldValue($objForm->GetValue("o_item_amt"));
		if (!$this->unit_id->FldIsDetailKey) {
			$this->unit_id->setFormValue($objForm->GetValue("x_unit_id"));
		}
		$this->unit_id->setOldValue($objForm->GetValue("o_unit_id"));
		if (!$this->row_id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->row_id->setFormValue($objForm->GetValue("x_row_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->row_id->CurrentValue = $this->row_id->FormValue;
		$this->item_id->CurrentValue = $this->item_id->FormValue;
		$this->item_code->CurrentValue = $this->item_code->FormValue;
		$this->item_name->CurrentValue = $this->item_name->FormValue;
		$this->udet_id->CurrentValue = $this->udet_id->FormValue;
		$this->item_qty->CurrentValue = $this->item_qty->FormValue;
		$this->item_price->CurrentValue = $this->item_price->FormValue;
		$this->item_disc->CurrentValue = $this->item_disc->FormValue;
		$this->item_amt->CurrentValue = $this->item_amt->FormValue;
		$this->unit_id->CurrentValue = $this->unit_id->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->ListSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$this->master_id->setDbValue($row['master_id']);
		$this->row_id->setDbValue($row['row_id']);
		$this->item_id->setDbValue($row['item_id']);
		$this->item_code->setDbValue($row['item_code']);
		$this->item_name->setDbValue($row['item_name']);
		$this->udet_id->setDbValue($row['udet_id']);
		$this->item_qty->setDbValue($row['item_qty']);
		$this->item_price->setDbValue($row['item_price']);
		$this->item_disc->setDbValue($row['item_disc']);
		$this->item_amt->setDbValue($row['item_amt']);
		$this->unit_id->setDbValue($row['unit_id']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['master_id'] = $this->master_id->CurrentValue;
		$row['row_id'] = $this->row_id->CurrentValue;
		$row['item_id'] = $this->item_id->CurrentValue;
		$row['item_code'] = $this->item_code->CurrentValue;
		$row['item_name'] = $this->item_name->CurrentValue;
		$row['udet_id'] = $this->udet_id->CurrentValue;
		$row['item_qty'] = $this->item_qty->CurrentValue;
		$row['item_price'] = $this->item_price->CurrentValue;
		$row['item_disc'] = $this->item_disc->CurrentValue;
		$row['item_amt'] = $this->item_amt->CurrentValue;
		$row['unit_id'] = $this->unit_id->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->master_id->DbValue = $row['master_id'];
		$this->row_id->DbValue = $row['row_id'];
		$this->item_id->DbValue = $row['item_id'];
		$this->item_code->DbValue = $row['item_code'];
		$this->item_name->DbValue = $row['item_name'];
		$this->udet_id->DbValue = $row['udet_id'];
		$this->item_qty->DbValue = $row['item_qty'];
		$this->item_price->DbValue = $row['item_price'];
		$this->item_disc->DbValue = $row['item_disc'];
		$this->item_amt->DbValue = $row['item_amt'];
		$this->unit_id->DbValue = $row['unit_id'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("row_id")) <> "")
			$this->row_id->CurrentValue = $this->getKey("row_id"); // row_id
		else
			$bValidKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
		}
		$this->LoadRowValues($this->OldRecordset); // Load row values
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Convert decimal values if posted back
		if ($this->item_qty->FormValue == $this->item_qty->CurrentValue && is_numeric(ew_StrToFloat($this->item_qty->CurrentValue)))
			$this->item_qty->CurrentValue = ew_StrToFloat($this->item_qty->CurrentValue);

		// Convert decimal values if posted back
		if ($this->item_price->FormValue == $this->item_price->CurrentValue && is_numeric(ew_StrToFloat($this->item_price->CurrentValue)))
			$this->item_price->CurrentValue = ew_StrToFloat($this->item_price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->item_disc->FormValue == $this->item_disc->CurrentValue && is_numeric(ew_StrToFloat($this->item_disc->CurrentValue)))
			$this->item_disc->CurrentValue = ew_StrToFloat($this->item_disc->CurrentValue);

		// Convert decimal values if posted back
		if ($this->item_amt->FormValue == $this->item_amt->CurrentValue && is_numeric(ew_StrToFloat($this->item_amt->CurrentValue)))
			$this->item_amt->CurrentValue = ew_StrToFloat($this->item_amt->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// master_id
		// row_id
		// item_id
		// item_code
		// item_name
		// udet_id
		// item_qty
		// item_price
		// item_disc
		// item_amt
		// unit_id
		// Accumulate aggregate value

		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT && $this->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($this->item_amt->CurrentValue))
				$this->item_amt->Total += $this->item_amt->CurrentValue; // Accumulate total
		}
		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// master_id
		$this->master_id->ViewValue = $this->master_id->CurrentValue;
		$this->master_id->ViewCustomAttributes = "";

		// row_id
		$this->row_id->ViewValue = $this->row_id->CurrentValue;
		$this->row_id->ViewCustomAttributes = "";

		// item_id
		$this->item_id->ViewValue = $this->item_id->CurrentValue;
		if (strval($this->item_id->CurrentValue) <> "") {
			$sFilterWrk = "`product_id`" . ew_SearchString("=", $this->item_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT DISTINCT `product_id`, `product_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `view_products_unit_price`";
		$sWhereWrk = "";
		$this->item_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->item_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `product_name`";
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->item_id->ViewValue = $this->item_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->item_id->ViewValue = $this->item_id->CurrentValue;
			}
		} else {
			$this->item_id->ViewValue = NULL;
		}
		$this->item_id->ViewCustomAttributes = "";

		// item_code
		$this->item_code->ViewValue = $this->item_code->CurrentValue;
		$this->item_code->ViewCustomAttributes = "";

		// item_name
		$this->item_name->ViewValue = $this->item_name->CurrentValue;
		$this->item_name->ViewCustomAttributes = "";

		// udet_id
		if (strval($this->udet_id->CurrentValue) <> "") {
			$sFilterWrk = "`udet_id`" . ew_SearchString("=", $this->udet_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `udet_id`, `unit_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_unit_detail`";
		$sWhereWrk = "";
		$this->udet_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->udet_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->udet_id->ViewValue = $this->udet_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->udet_id->ViewValue = $this->udet_id->CurrentValue;
			}
		} else {
			$this->udet_id->ViewValue = NULL;
		}
		$this->udet_id->ViewCustomAttributes = "";

		// item_qty
		$this->item_qty->ViewValue = $this->item_qty->CurrentValue;
		$this->item_qty->ViewValue = ew_FormatNumber($this->item_qty->ViewValue, 2, -2, -2, -1);
		$this->item_qty->CellCssStyle .= "text-align: right;";
		$this->item_qty->ViewCustomAttributes = "";

		// item_price
		$this->item_price->ViewValue = $this->item_price->CurrentValue;
		$this->item_price->ViewValue = ew_FormatNumber($this->item_price->ViewValue, 2, -2, -2, -2);
		$this->item_price->ViewCustomAttributes = "";

		// item_disc
		$this->item_disc->ViewValue = $this->item_disc->CurrentValue;
		$this->item_disc->ViewValue = ew_FormatPercent($this->item_disc->ViewValue, 2, -2, -2, -1);
		$this->item_disc->ViewCustomAttributes = "";

		// item_amt
		$this->item_amt->ViewValue = $this->item_amt->CurrentValue;
		$this->item_amt->ViewValue = ew_FormatNumber($this->item_amt->ViewValue, 2, -2, -2, -1);
		$this->item_amt->ViewCustomAttributes = "";

		// unit_id
		$this->unit_id->ViewValue = $this->unit_id->CurrentValue;
		$this->unit_id->ViewCustomAttributes = "";

			// item_id
			$this->item_id->LinkCustomAttributes = "";
			$this->item_id->HrefValue = "";
			$this->item_id->TooltipValue = "";

			// item_code
			$this->item_code->LinkCustomAttributes = "";
			$this->item_code->HrefValue = "";
			$this->item_code->TooltipValue = "";

			// item_name
			$this->item_name->LinkCustomAttributes = "";
			$this->item_name->HrefValue = "";
			$this->item_name->TooltipValue = "";

			// udet_id
			$this->udet_id->LinkCustomAttributes = "";
			$this->udet_id->HrefValue = "";
			$this->udet_id->TooltipValue = "";

			// item_qty
			$this->item_qty->LinkCustomAttributes = "";
			$this->item_qty->HrefValue = "";
			$this->item_qty->TooltipValue = "";

			// item_price
			$this->item_price->LinkCustomAttributes = "";
			$this->item_price->HrefValue = "";
			$this->item_price->TooltipValue = "";

			// item_disc
			$this->item_disc->LinkCustomAttributes = "";
			$this->item_disc->HrefValue = "";
			$this->item_disc->TooltipValue = "";

			// item_amt
			$this->item_amt->LinkCustomAttributes = "";
			$this->item_amt->HrefValue = "";
			$this->item_amt->TooltipValue = "";

			// unit_id
			$this->unit_id->LinkCustomAttributes = "";
			$this->unit_id->HrefValue = "";
			$this->unit_id->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// item_id
			$this->item_id->EditAttrs["class"] = "form-control";
			$this->item_id->EditCustomAttributes = "";
			$this->item_id->EditValue = ew_HtmlEncode($this->item_id->CurrentValue);
			if (strval($this->item_id->CurrentValue) <> "") {
				$sFilterWrk = "`product_id`" . ew_SearchString("=", $this->item_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
			$sSqlWrk = "SELECT DISTINCT `product_id`, `product_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `view_products_unit_price`";
			$sWhereWrk = "";
			$this->item_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->item_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `product_name`";
				$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->item_id->EditValue = $this->item_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->item_id->EditValue = ew_HtmlEncode($this->item_id->CurrentValue);
				}
			} else {
				$this->item_id->EditValue = NULL;
			}
			$this->item_id->PlaceHolder = ew_RemoveHtml($this->item_id->FldCaption());

			// item_code
			$this->item_code->EditAttrs["class"] = "form-control";
			$this->item_code->EditCustomAttributes = "";
			$this->item_code->EditValue = ew_HtmlEncode($this->item_code->CurrentValue);
			$this->item_code->PlaceHolder = ew_RemoveHtml($this->item_code->FldCaption());

			// item_name
			$this->item_name->EditAttrs["class"] = "form-control";
			$this->item_name->EditCustomAttributes = "";
			$this->item_name->EditValue = ew_HtmlEncode($this->item_name->CurrentValue);
			$this->item_name->PlaceHolder = ew_RemoveHtml($this->item_name->FldCaption());

			// udet_id
			$this->udet_id->EditCustomAttributes = "";
			if (trim(strval($this->udet_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`udet_id`" . ew_SearchString("=", $this->udet_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
			}
			$sSqlWrk = "SELECT `udet_id`, `unit_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `product_id` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tbl_unit_detail`";
			$sWhereWrk = "";
			$this->udet_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->udet_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->udet_id->ViewValue = $this->udet_id->DisplayValue($arwrk);
			} else {
				$this->udet_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->udet_id->EditValue = $arwrk;

			// item_qty
			$this->item_qty->EditAttrs["class"] = "form-control";
			$this->item_qty->EditCustomAttributes = "";
			$this->item_qty->EditValue = ew_HtmlEncode($this->item_qty->CurrentValue);
			$this->item_qty->PlaceHolder = ew_RemoveHtml($this->item_qty->FldCaption());
			if (strval($this->item_qty->EditValue) <> "" && is_numeric($this->item_qty->EditValue)) {
			$this->item_qty->EditValue = ew_FormatNumber($this->item_qty->EditValue, -2, -2, -2, -1);
			$this->item_qty->OldValue = $this->item_qty->EditValue;
			}

			// item_price
			$this->item_price->EditAttrs["class"] = "form-control";
			$this->item_price->EditCustomAttributes = "";
			$this->item_price->EditValue = ew_HtmlEncode($this->item_price->CurrentValue);
			$this->item_price->PlaceHolder = ew_RemoveHtml($this->item_price->FldCaption());
			if (strval($this->item_price->EditValue) <> "" && is_numeric($this->item_price->EditValue)) {
			$this->item_price->EditValue = ew_FormatNumber($this->item_price->EditValue, -2, -2, -2, -2);
			$this->item_price->OldValue = $this->item_price->EditValue;
			}

			// item_disc
			$this->item_disc->EditAttrs["class"] = "form-control";
			$this->item_disc->EditCustomAttributes = "";
			$this->item_disc->EditValue = ew_HtmlEncode($this->item_disc->CurrentValue);
			$this->item_disc->PlaceHolder = ew_RemoveHtml($this->item_disc->FldCaption());
			if (strval($this->item_disc->EditValue) <> "" && is_numeric($this->item_disc->EditValue)) {
			$this->item_disc->EditValue = ew_FormatNumber($this->item_disc->EditValue, -2, -1, -2, 0);
			$this->item_disc->OldValue = $this->item_disc->EditValue;
			}

			// item_amt
			$this->item_amt->EditAttrs["class"] = "form-control";
			$this->item_amt->EditCustomAttributes = "";
			$this->item_amt->EditValue = ew_HtmlEncode($this->item_amt->CurrentValue);
			$this->item_amt->PlaceHolder = ew_RemoveHtml($this->item_amt->FldCaption());
			if (strval($this->item_amt->EditValue) <> "" && is_numeric($this->item_amt->EditValue)) {
			$this->item_amt->EditValue = ew_FormatNumber($this->item_amt->EditValue, -2, -2, -2, -1);
			$this->item_amt->OldValue = $this->item_amt->EditValue;
			}

			// unit_id
			$this->unit_id->EditAttrs["class"] = "form-control";
			$this->unit_id->EditCustomAttributes = "";
			$this->unit_id->EditValue = ew_HtmlEncode($this->unit_id->CurrentValue);
			$this->unit_id->PlaceHolder = ew_RemoveHtml($this->unit_id->FldCaption());

			// Add refer script
			// item_id

			$this->item_id->LinkCustomAttributes = "";
			$this->item_id->HrefValue = "";

			// item_code
			$this->item_code->LinkCustomAttributes = "";
			$this->item_code->HrefValue = "";

			// item_name
			$this->item_name->LinkCustomAttributes = "";
			$this->item_name->HrefValue = "";

			// udet_id
			$this->udet_id->LinkCustomAttributes = "";
			$this->udet_id->HrefValue = "";

			// item_qty
			$this->item_qty->LinkCustomAttributes = "";
			$this->item_qty->HrefValue = "";

			// item_price
			$this->item_price->LinkCustomAttributes = "";
			$this->item_price->HrefValue = "";

			// item_disc
			$this->item_disc->LinkCustomAttributes = "";
			$this->item_disc->HrefValue = "";

			// item_amt
			$this->item_amt->LinkCustomAttributes = "";
			$this->item_amt->HrefValue = "";

			// unit_id
			$this->unit_id->LinkCustomAttributes = "";
			$this->unit_id->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// item_id
			$this->item_id->EditAttrs["class"] = "form-control";
			$this->item_id->EditCustomAttributes = "";
			$this->item_id->EditValue = ew_HtmlEncode($this->item_id->CurrentValue);
			if (strval($this->item_id->CurrentValue) <> "") {
				$sFilterWrk = "`product_id`" . ew_SearchString("=", $this->item_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
			$sSqlWrk = "SELECT DISTINCT `product_id`, `product_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `view_products_unit_price`";
			$sWhereWrk = "";
			$this->item_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->item_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `product_name`";
				$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->item_id->EditValue = $this->item_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->item_id->EditValue = ew_HtmlEncode($this->item_id->CurrentValue);
				}
			} else {
				$this->item_id->EditValue = NULL;
			}
			$this->item_id->PlaceHolder = ew_RemoveHtml($this->item_id->FldCaption());

			// item_code
			$this->item_code->EditAttrs["class"] = "form-control";
			$this->item_code->EditCustomAttributes = "";
			$this->item_code->EditValue = ew_HtmlEncode($this->item_code->CurrentValue);
			$this->item_code->PlaceHolder = ew_RemoveHtml($this->item_code->FldCaption());

			// item_name
			$this->item_name->EditAttrs["class"] = "form-control";
			$this->item_name->EditCustomAttributes = "";

			// udet_id
			$this->udet_id->EditCustomAttributes = "";
			if (trim(strval($this->udet_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`udet_id`" . ew_SearchString("=", $this->udet_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
			}
			$sSqlWrk = "SELECT `udet_id`, `unit_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `product_id` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tbl_unit_detail`";
			$sWhereWrk = "";
			$this->udet_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->udet_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->udet_id->ViewValue = $this->udet_id->DisplayValue($arwrk);
			} else {
				$this->udet_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->udet_id->EditValue = $arwrk;

			// item_qty
			$this->item_qty->EditAttrs["class"] = "form-control";
			$this->item_qty->EditCustomAttributes = "";
			$this->item_qty->EditValue = ew_HtmlEncode($this->item_qty->CurrentValue);
			$this->item_qty->PlaceHolder = ew_RemoveHtml($this->item_qty->FldCaption());
			if (strval($this->item_qty->EditValue) <> "" && is_numeric($this->item_qty->EditValue)) {
			$this->item_qty->EditValue = ew_FormatNumber($this->item_qty->EditValue, -2, -2, -2, -1);
			$this->item_qty->OldValue = $this->item_qty->EditValue;
			}

			// item_price
			$this->item_price->EditAttrs["class"] = "form-control";
			$this->item_price->EditCustomAttributes = "";
			$this->item_price->EditValue = ew_HtmlEncode($this->item_price->CurrentValue);
			$this->item_price->PlaceHolder = ew_RemoveHtml($this->item_price->FldCaption());
			if (strval($this->item_price->EditValue) <> "" && is_numeric($this->item_price->EditValue)) {
			$this->item_price->EditValue = ew_FormatNumber($this->item_price->EditValue, -2, -2, -2, -2);
			$this->item_price->OldValue = $this->item_price->EditValue;
			}

			// item_disc
			$this->item_disc->EditAttrs["class"] = "form-control";
			$this->item_disc->EditCustomAttributes = "";
			$this->item_disc->EditValue = ew_HtmlEncode($this->item_disc->CurrentValue);
			$this->item_disc->PlaceHolder = ew_RemoveHtml($this->item_disc->FldCaption());
			if (strval($this->item_disc->EditValue) <> "" && is_numeric($this->item_disc->EditValue)) {
			$this->item_disc->EditValue = ew_FormatNumber($this->item_disc->EditValue, -2, -1, -2, 0);
			$this->item_disc->OldValue = $this->item_disc->EditValue;
			}

			// item_amt
			$this->item_amt->EditAttrs["class"] = "form-control";
			$this->item_amt->EditCustomAttributes = "";
			$this->item_amt->EditValue = ew_HtmlEncode($this->item_amt->CurrentValue);
			$this->item_amt->PlaceHolder = ew_RemoveHtml($this->item_amt->FldCaption());
			if (strval($this->item_amt->EditValue) <> "" && is_numeric($this->item_amt->EditValue)) {
			$this->item_amt->EditValue = ew_FormatNumber($this->item_amt->EditValue, -2, -2, -2, -1);
			$this->item_amt->OldValue = $this->item_amt->EditValue;
			}

			// unit_id
			$this->unit_id->EditAttrs["class"] = "form-control";
			$this->unit_id->EditCustomAttributes = "";

			// Edit refer script
			// item_id

			$this->item_id->LinkCustomAttributes = "";
			$this->item_id->HrefValue = "";

			// item_code
			$this->item_code->LinkCustomAttributes = "";
			$this->item_code->HrefValue = "";

			// item_name
			$this->item_name->LinkCustomAttributes = "";
			$this->item_name->HrefValue = "";

			// udet_id
			$this->udet_id->LinkCustomAttributes = "";
			$this->udet_id->HrefValue = "";

			// item_qty
			$this->item_qty->LinkCustomAttributes = "";
			$this->item_qty->HrefValue = "";

			// item_price
			$this->item_price->LinkCustomAttributes = "";
			$this->item_price->HrefValue = "";

			// item_disc
			$this->item_disc->LinkCustomAttributes = "";
			$this->item_disc->HrefValue = "";

			// item_amt
			$this->item_amt->LinkCustomAttributes = "";
			$this->item_amt->HrefValue = "";

			// unit_id
			$this->unit_id->LinkCustomAttributes = "";
			$this->unit_id->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$this->item_amt->Total = 0; // Initialize total
		} elseif ($this->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$this->item_amt->CurrentValue = $this->item_amt->Total;
			$this->item_amt->ViewValue = $this->item_amt->CurrentValue;
			$this->item_amt->ViewValue = ew_FormatNumber($this->item_amt->ViewValue, 2, -2, -2, -1);
			$this->item_amt->ViewCustomAttributes = "";
			$this->item_amt->HrefValue = ""; // Clear href value
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($this->item_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->item_id->FldErrMsg());
		}
		if (!ew_CheckNumber($this->item_qty->FormValue)) {
			ew_AddMessage($gsFormError, $this->item_qty->FldErrMsg());
		}
		if (!ew_CheckNumber($this->item_price->FormValue)) {
			ew_AddMessage($gsFormError, $this->item_price->FldErrMsg());
		}
		if (!ew_CheckNumber($this->item_disc->FormValue)) {
			ew_AddMessage($gsFormError, $this->item_disc->FldErrMsg());
		}
		if (!ew_CheckNumber($this->item_amt->FormValue)) {
			ew_AddMessage($gsFormError, $this->item_amt->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['row_id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// item_id
			$this->item_id->SetDbValueDef($rsnew, $this->item_id->CurrentValue, NULL, $this->item_id->ReadOnly);

			// item_code
			$this->item_code->SetDbValueDef($rsnew, $this->item_code->CurrentValue, NULL, $this->item_code->ReadOnly);

			// item_name
			$this->item_name->SetDbValueDef($rsnew, $this->item_name->CurrentValue, NULL, $this->item_name->ReadOnly);

			// udet_id
			$this->udet_id->SetDbValueDef($rsnew, $this->udet_id->CurrentValue, NULL, $this->udet_id->ReadOnly);

			// item_qty
			$this->item_qty->SetDbValueDef($rsnew, $this->item_qty->CurrentValue, NULL, $this->item_qty->ReadOnly);

			// item_price
			$this->item_price->SetDbValueDef($rsnew, $this->item_price->CurrentValue, NULL, $this->item_price->ReadOnly);

			// item_disc
			$this->item_disc->SetDbValueDef($rsnew, $this->item_disc->CurrentValue, NULL, $this->item_disc->ReadOnly);

			// item_amt
			$this->item_amt->SetDbValueDef($rsnew, $this->item_amt->CurrentValue, NULL, $this->item_amt->ReadOnly);

			// unit_id
			$this->unit_id->SetDbValueDef($rsnew, $this->unit_id->CurrentValue, NULL, $this->unit_id->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// item_id
		$this->item_id->SetDbValueDef($rsnew, $this->item_id->CurrentValue, NULL, FALSE);

		// item_code
		$this->item_code->SetDbValueDef($rsnew, $this->item_code->CurrentValue, NULL, FALSE);

		// item_name
		$this->item_name->SetDbValueDef($rsnew, $this->item_name->CurrentValue, NULL, FALSE);

		// udet_id
		$this->udet_id->SetDbValueDef($rsnew, $this->udet_id->CurrentValue, NULL, FALSE);

		// item_qty
		$this->item_qty->SetDbValueDef($rsnew, $this->item_qty->CurrentValue, NULL, FALSE);

		// item_price
		$this->item_price->SetDbValueDef($rsnew, $this->item_price->CurrentValue, NULL, FALSE);

		// item_disc
		$this->item_disc->SetDbValueDef($rsnew, $this->item_disc->CurrentValue, NULL, FALSE);

		// item_amt
		$this->item_amt->SetDbValueDef($rsnew, $this->item_amt->CurrentValue, NULL, FALSE);

		// unit_id
		$this->unit_id->SetDbValueDef($rsnew, $this->unit_id->CurrentValue, NULL, FALSE);

		// master_id
		if ($this->master_id->getSessionValue() <> "") {
			$rsnew['master_id'] = $this->master_id->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ewExportLink ewPrint\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ewExportLink ewExcel\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ewExportLink ewWord\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = FALSE;

		// Export to Html
		$item = &$this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ewExportLink ewHtml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ewExportLink ewXml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ewExportLink ewCsv\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = FALSE;

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ewExportLink ewPdf\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_tr_inv_item\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_tr_inv_item',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.ftr_inv_itemlist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = TRUE;
		$this->ExportOptions->UseDropDownButton = TRUE;
		if ($this->ExportOptions->UseButtonGroup && ew_IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $this->ListRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->LoadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EW_EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetupStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$this->ExportDoc = ew_ExportDocument($this, "h");
		$Doc = &$this->ExportDoc;
		if ($bSelectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		} else {

			//$this->StartRec = $this->StartRec;
			//$this->StopRec = $this->StopRec;

		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$ParentTable = "";

		// Export master record
		if (EW_EXPORT_MASTER_RECORD && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "tr_inv_master") {
			global $tr_inv_master;
			if (!isset($tr_inv_master)) $tr_inv_master = new ctr_inv_master;
			$rsmaster = $tr_inv_master->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$ExportStyle = $Doc->Style;
				$Doc->SetStyle("v"); // Change to vertical
				if ($this->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
					$Doc->Table = &$tr_inv_master;
					$tr_inv_master->ExportDocument($Doc, $rsmaster, 1, 1);
					$Doc->ExportEmptyRow();
					$Doc->Table = &$this;
				}
				$Doc->SetStyle($ExportStyle); // Restore
				$rsmaster->Close();
			}
		}
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		$Doc->Text .= $sHeader;
		$this->ExportDocument($Doc, $rs, $this->StartRec, $this->StopRec, "");
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		$Doc->Text .= $sFooter;

		// Close recordset
		$rs->Close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$Doc->ExportHeaderAndFooter();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED && $this->Export <> "pdf")
			echo ew_DebugMsg();

		// Output data
		$Doc->Export();
	}

	// Set up master/detail based on QueryString
	function SetupMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "tr_inv_master") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_inv_id"] <> "") {
					$GLOBALS["tr_inv_master"]->inv_id->setQueryStringValue($_GET["fk_inv_id"]);
					$this->master_id->setQueryStringValue($GLOBALS["tr_inv_master"]->inv_id->QueryStringValue);
					$this->master_id->setSessionValue($this->master_id->QueryStringValue);
					if (!is_numeric($GLOBALS["tr_inv_master"]->inv_id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "tr_inv_master") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_inv_id"] <> "") {
					$GLOBALS["tr_inv_master"]->inv_id->setFormValue($_POST["fk_inv_id"]);
					$this->master_id->setFormValue($GLOBALS["tr_inv_master"]->inv_id->FormValue);
					$this->master_id->setSessionValue($this->master_id->FormValue);
					if (!is_numeric($GLOBALS["tr_inv_master"]->inv_id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Update URL
			$this->AddUrl = $this->AddMasterUrl($this->AddUrl);
			$this->InlineAddUrl = $this->AddMasterUrl($this->InlineAddUrl);
			$this->GridAddUrl = $this->AddMasterUrl($this->GridAddUrl);
			$this->GridEditUrl = $this->AddMasterUrl($this->GridEditUrl);

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "tr_inv_master") {
				if ($this->master_id->CurrentValue == "") $this->master_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_item_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT DISTINCT `product_id` AS `LinkFld`, `product_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `view_products_unit_price`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "db_inventory_pusat", "f0" => '`product_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->item_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `product_name`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_udet_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `udet_id` AS `LinkFld`, `unit_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_unit_detail`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "db_inventory_pusat", "f0" => '`udet_id` IN ({filter_value})', "t0" => "3", "fn0" => "", "f1" => '`product_id` IN ({filter_value})', "t1" => "3", "fn1" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->udet_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_item_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT DISTINCT `product_id`, `product_name` AS `DispFld` FROM `view_products_unit_price`";
			$sWhereWrk = "`product_name` LIKE '{query_value}%'";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "db_inventory_pusat");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->item_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `product_name`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
		Language()->setFieldPhrase("tr_inv_item", "item_id", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Nama Produk</div>");	
		Language()->setFieldPhrase("tr_inv_item", "item_code", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Produk ID#</div>");
		Language()->setFieldPhrase("tr_inv_item", "unit_id", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Satuan</div>");
		Language()->setFieldPhrase("tr_inv_item", "item_qty", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Qty</div>");
		Language()->setFieldPhrase("tr_inv_item", "item_price", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Harga satuan</div>");
		Language()->setFieldPhrase("tr_inv_item", "item_disc", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Disc (%)</div>");	
		Language()->setFieldPhrase("tr_inv_item", "item_amt", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Jumlah</div>");				
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

		$GLOBALS["tr_inv_item"]->item_name->Visible = FALSE;
		$GLOBALS["tr_inv_item"]->unit_id->Visible = FALSE;	
	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
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
if (!isset($tr_inv_item_list)) $tr_inv_item_list = new ctr_inv_item_list();

// Page init
$tr_inv_item_list->Page_Init();

// Page main
$tr_inv_item_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_inv_item_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($tr_inv_item->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ftr_inv_itemlist = new ew_Form("ftr_inv_itemlist", "list");
ftr_inv_itemlist.FormKeyCountName = '<?php echo $tr_inv_item_list->FormKeyCountName ?>';

// Validate form
ftr_inv_itemlist.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_item_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_item->item_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_item_qty");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_item->item_qty->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_item_price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_item->item_price->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_item_disc");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_item->item_disc->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_item_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_item->item_amt->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	if (gridinsert && addcnt == 0) { // No row added
		ew_Alert(ewLanguage.Phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Check empty row
ftr_inv_itemlist.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "item_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_code", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_name", false)) return false;
	if (ew_ValueChanged(fobj, infix, "udet_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_qty", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_price", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_disc", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_amt", false)) return false;
	if (ew_ValueChanged(fobj, infix, "unit_id", false)) return false;
	return true;
}

// Form_CustomValidate event
ftr_inv_itemlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_inv_itemlist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_inv_itemlist.Lists["x_item_id"] = {"LinkField":"x_product_id","Ajax":true,"AutoFill":true,"DisplayFields":["x_product_name","","",""],"ParentFields":[],"ChildFields":["x_udet_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"view_products_unit_price"};
ftr_inv_itemlist.Lists["x_item_id"].Data = "<?php echo $tr_inv_item_list->item_id->LookupFilterQuery(FALSE, "list") ?>";
ftr_inv_itemlist.AutoSuggests["x_item_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $tr_inv_item_list->item_id->LookupFilterQuery(TRUE, "list"))) ?>;
ftr_inv_itemlist.Lists["x_udet_id"] = {"LinkField":"x_udet_id","Ajax":true,"AutoFill":true,"DisplayFields":["x_unit_name","","",""],"ParentFields":["x_item_id"],"ChildFields":[],"FilterFields":["x_product_id"],"Options":[],"Template":"","LinkTable":"tbl_unit_detail"};
ftr_inv_itemlist.Lists["x_udet_id"].Data = "<?php echo $tr_inv_item_list->udet_id->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
</script>
<style type="text/css">
.ewTablePreviewRow { /* main table preview row color */
	background-color: #FF0000; /* preview row color */
}
.ewTablePreviewRow .ewGrid {
	display: table;
}
</style>
<div id="ewPreview" class="hide"><!-- preview -->
	<div class="nav-tabs-custom"><!-- .nav-tabs-custom -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.nav-tabs-custom -->
</div><!-- /preview -->
<script type="text/javascript" src="phpjs/ewpreview.js"></script>
<script type="text/javascript">
var EW_PREVIEW_PLACEMENT = EW_CSS_FLIP ? "left" : "right";
var EW_PREVIEW_SINGLE_ROW = false;
var EW_PREVIEW_OVERLAY = false;
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($tr_inv_item->Export == "") { ?>
<div class="ewToolbar">
<?php if ($tr_inv_item_list->TotalRecs > 0 && $tr_inv_item_list->ExportOptions->Visible()) { ?>
<?php $tr_inv_item_list->ExportOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (($tr_inv_item->Export == "") || (EW_EXPORT_MASTER_RECORD && $tr_inv_item->Export == "print")) { ?>
<?php
if ($tr_inv_item_list->DbMasterFilter <> "" && $tr_inv_item->getCurrentMasterTable() == "tr_inv_master") {
	if ($tr_inv_item_list->MasterRecordExists) {
?>
<?php include_once "tr_inv_mastermaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
if ($tr_inv_item->CurrentAction == "gridadd") {
	$tr_inv_item->CurrentFilter = "0=1";
	$tr_inv_item_list->StartRec = 1;
	$tr_inv_item_list->DisplayRecs = $tr_inv_item->GridAddRowCount;
	$tr_inv_item_list->TotalRecs = $tr_inv_item_list->DisplayRecs;
	$tr_inv_item_list->StopRec = $tr_inv_item_list->DisplayRecs;
} else {
	$bSelectLimit = $tr_inv_item_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($tr_inv_item_list->TotalRecs <= 0)
			$tr_inv_item_list->TotalRecs = $tr_inv_item->ListRecordCount();
	} else {
		if (!$tr_inv_item_list->Recordset && ($tr_inv_item_list->Recordset = $tr_inv_item_list->LoadRecordset()))
			$tr_inv_item_list->TotalRecs = $tr_inv_item_list->Recordset->RecordCount();
	}
	$tr_inv_item_list->StartRec = 1;
	if ($tr_inv_item_list->DisplayRecs <= 0 || ($tr_inv_item->Export <> "" && $tr_inv_item->ExportAll)) // Display all records
		$tr_inv_item_list->DisplayRecs = $tr_inv_item_list->TotalRecs;
	if (!($tr_inv_item->Export <> "" && $tr_inv_item->ExportAll))
		$tr_inv_item_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$tr_inv_item_list->Recordset = $tr_inv_item_list->LoadRecordset($tr_inv_item_list->StartRec-1, $tr_inv_item_list->DisplayRecs);

	// Set no record found message
	if ($tr_inv_item->CurrentAction == "" && $tr_inv_item_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$tr_inv_item_list->setWarningMessage(ew_DeniedMsg());
		if ($tr_inv_item_list->SearchWhere == "0=101")
			$tr_inv_item_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$tr_inv_item_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$tr_inv_item_list->RenderOtherOptions();
?>
<?php $tr_inv_item_list->ShowPageHeader(); ?>
<?php
$tr_inv_item_list->ShowMessage();
?>
<?php if ($tr_inv_item_list->TotalRecs > 0 || $tr_inv_item->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($tr_inv_item_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> tr_inv_item">
<?php if ($tr_inv_item->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($tr_inv_item->CurrentAction <> "gridadd" && $tr_inv_item->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($tr_inv_item_list->Pager)) $tr_inv_item_list->Pager = new cPrevNextPager($tr_inv_item_list->StartRec, $tr_inv_item_list->DisplayRecs, $tr_inv_item_list->TotalRecs, $tr_inv_item_list->AutoHidePager) ?>
<?php if ($tr_inv_item_list->Pager->RecordCount > 0 && $tr_inv_item_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($tr_inv_item_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $tr_inv_item_list->PageUrl() ?>start=<?php echo $tr_inv_item_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tr_inv_item_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $tr_inv_item_list->PageUrl() ?>start=<?php echo $tr_inv_item_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tr_inv_item_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($tr_inv_item_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $tr_inv_item_list->PageUrl() ?>start=<?php echo $tr_inv_item_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tr_inv_item_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $tr_inv_item_list->PageUrl() ?>start=<?php echo $tr_inv_item_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tr_inv_item_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($tr_inv_item_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tr_inv_item_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tr_inv_item_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tr_inv_item_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tr_inv_item_list->TotalRecs > 0 && (!$tr_inv_item_list->AutoHidePageSizeSelector || $tr_inv_item_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="tr_inv_item">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($tr_inv_item_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($tr_inv_item_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tr_inv_item_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tr_inv_item_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="ALL"<?php if ($tr_inv_item->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($tr_inv_item_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftr_inv_itemlist" id="ftr_inv_itemlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_inv_item_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_inv_item_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_inv_item">
<?php if ($tr_inv_item->getCurrentMasterTable() == "tr_inv_master" && $tr_inv_item->CurrentAction <> "") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="tr_inv_master">
<input type="hidden" name="fk_inv_id" value="<?php echo $tr_inv_item->master_id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_tr_inv_item" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($tr_inv_item_list->TotalRecs > 0 || $tr_inv_item->CurrentAction == "gridedit") { ?>
<table id="tbl_tr_inv_itemlist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$tr_inv_item_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$tr_inv_item_list->RenderListOptions();

// Render list options (header, left)
$tr_inv_item_list->ListOptions->Render("header", "left");
?>
<?php if ($tr_inv_item->item_id->Visible) { // item_id ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_id) == "") { ?>
		<th data-name="item_id" class="<?php echo $tr_inv_item->item_id->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_id" class="tr_inv_item_item_id"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_id" class="<?php echo $tr_inv_item->item_id->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_id" class="tr_inv_item_item_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->item_code->Visible) { // item_code ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_code) == "") { ?>
		<th data-name="item_code" class="<?php echo $tr_inv_item->item_code->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_code" class="tr_inv_item_item_code"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_code->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_code" class="<?php echo $tr_inv_item->item_code->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_code" class="tr_inv_item_item_code">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_code->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_code->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_code->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->item_name->Visible) { // item_name ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_name) == "") { ?>
		<th data-name="item_name" class="<?php echo $tr_inv_item->item_name->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_name" class="tr_inv_item_item_name"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_name" class="<?php echo $tr_inv_item->item_name->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_name" class="tr_inv_item_item_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->udet_id->Visible) { // udet_id ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->udet_id) == "") { ?>
		<th data-name="udet_id" class="<?php echo $tr_inv_item->udet_id->HeaderCellClass() ?>"><div id="elh_tr_inv_item_udet_id" class="tr_inv_item_udet_id"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->udet_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="udet_id" class="<?php echo $tr_inv_item->udet_id->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_udet_id" class="tr_inv_item_udet_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->udet_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->udet_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->udet_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->item_qty->Visible) { // item_qty ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_qty) == "") { ?>
		<th data-name="item_qty" class="<?php echo $tr_inv_item->item_qty->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_qty" class="tr_inv_item_item_qty"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_qty->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_qty" class="<?php echo $tr_inv_item->item_qty->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_qty" class="tr_inv_item_item_qty">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_qty->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_qty->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_qty->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->item_price->Visible) { // item_price ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_price) == "") { ?>
		<th data-name="item_price" class="<?php echo $tr_inv_item->item_price->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_price" class="tr_inv_item_item_price"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_price->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_price" class="<?php echo $tr_inv_item->item_price->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_price" class="tr_inv_item_item_price">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_price->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_price->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_price->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->item_disc->Visible) { // item_disc ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_disc) == "") { ?>
		<th data-name="item_disc" class="<?php echo $tr_inv_item->item_disc->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_disc" class="tr_inv_item_item_disc"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_disc->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_disc" class="<?php echo $tr_inv_item->item_disc->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_disc" class="tr_inv_item_item_disc">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_disc->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_disc->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_disc->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->item_amt->Visible) { // item_amt ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_amt) == "") { ?>
		<th data-name="item_amt" class="<?php echo $tr_inv_item->item_amt->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_amt" class="tr_inv_item_item_amt"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_amt->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_amt" class="<?php echo $tr_inv_item->item_amt->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_amt" class="tr_inv_item_item_amt">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_amt->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_amt->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_amt->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->unit_id->Visible) { // unit_id ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->unit_id) == "") { ?>
		<th data-name="unit_id" class="<?php echo $tr_inv_item->unit_id->HeaderCellClass() ?>"><div id="elh_tr_inv_item_unit_id" class="tr_inv_item_unit_id"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->unit_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unit_id" class="<?php echo $tr_inv_item->unit_id->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_unit_id" class="tr_inv_item_unit_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->unit_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->unit_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->unit_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tr_inv_item_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tr_inv_item->ExportAll && $tr_inv_item->Export <> "") {
	$tr_inv_item_list->StopRec = $tr_inv_item_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tr_inv_item_list->TotalRecs > $tr_inv_item_list->StartRec + $tr_inv_item_list->DisplayRecs - 1)
		$tr_inv_item_list->StopRec = $tr_inv_item_list->StartRec + $tr_inv_item_list->DisplayRecs - 1;
	else
		$tr_inv_item_list->StopRec = $tr_inv_item_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($tr_inv_item_list->FormKeyCountName) && ($tr_inv_item->CurrentAction == "gridadd" || $tr_inv_item->CurrentAction == "gridedit" || $tr_inv_item->CurrentAction == "F")) {
		$tr_inv_item_list->KeyCount = $objForm->GetValue($tr_inv_item_list->FormKeyCountName);
		$tr_inv_item_list->StopRec = $tr_inv_item_list->StartRec + $tr_inv_item_list->KeyCount - 1;
	}
}
$tr_inv_item_list->RecCnt = $tr_inv_item_list->StartRec - 1;
if ($tr_inv_item_list->Recordset && !$tr_inv_item_list->Recordset->EOF) {
	$tr_inv_item_list->Recordset->MoveFirst();
	$bSelectLimit = $tr_inv_item_list->UseSelectLimit;
	if (!$bSelectLimit && $tr_inv_item_list->StartRec > 1)
		$tr_inv_item_list->Recordset->Move($tr_inv_item_list->StartRec - 1);
} elseif (!$tr_inv_item->AllowAddDeleteRow && $tr_inv_item_list->StopRec == 0) {
	$tr_inv_item_list->StopRec = $tr_inv_item->GridAddRowCount;
}

// Initialize aggregate
$tr_inv_item->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tr_inv_item->ResetAttrs();
$tr_inv_item_list->RenderRow();
if ($tr_inv_item->CurrentAction == "gridadd")
	$tr_inv_item_list->RowIndex = 0;
if ($tr_inv_item->CurrentAction == "gridedit")
	$tr_inv_item_list->RowIndex = 0;
while ($tr_inv_item_list->RecCnt < $tr_inv_item_list->StopRec) {
	$tr_inv_item_list->RecCnt++;
	if (intval($tr_inv_item_list->RecCnt) >= intval($tr_inv_item_list->StartRec)) {
		$tr_inv_item_list->RowCnt++;
		if ($tr_inv_item->CurrentAction == "gridadd" || $tr_inv_item->CurrentAction == "gridedit" || $tr_inv_item->CurrentAction == "F") {
			$tr_inv_item_list->RowIndex++;
			$objForm->Index = $tr_inv_item_list->RowIndex;
			if ($objForm->HasValue($tr_inv_item_list->FormActionName))
				$tr_inv_item_list->RowAction = strval($objForm->GetValue($tr_inv_item_list->FormActionName));
			elseif ($tr_inv_item->CurrentAction == "gridadd")
				$tr_inv_item_list->RowAction = "insert";
			else
				$tr_inv_item_list->RowAction = "";
		}

		// Set up key count
		$tr_inv_item_list->KeyCount = $tr_inv_item_list->RowIndex;

		// Init row class and style
		$tr_inv_item->ResetAttrs();
		$tr_inv_item->CssClass = "";
		if ($tr_inv_item->CurrentAction == "gridadd") {
			$tr_inv_item_list->LoadRowValues(); // Load default values
		} else {
			$tr_inv_item_list->LoadRowValues($tr_inv_item_list->Recordset); // Load row values
		}
		$tr_inv_item->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($tr_inv_item->CurrentAction == "gridadd") // Grid add
			$tr_inv_item->RowType = EW_ROWTYPE_ADD; // Render add
		if ($tr_inv_item->CurrentAction == "gridadd" && $tr_inv_item->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$tr_inv_item_list->RestoreCurrentRowFormValues($tr_inv_item_list->RowIndex); // Restore form values
		if ($tr_inv_item->CurrentAction == "gridedit") { // Grid edit
			if ($tr_inv_item->EventCancelled) {
				$tr_inv_item_list->RestoreCurrentRowFormValues($tr_inv_item_list->RowIndex); // Restore form values
			}
			if ($tr_inv_item_list->RowAction == "insert")
				$tr_inv_item->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$tr_inv_item->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($tr_inv_item->CurrentAction == "gridedit" && ($tr_inv_item->RowType == EW_ROWTYPE_EDIT || $tr_inv_item->RowType == EW_ROWTYPE_ADD) && $tr_inv_item->EventCancelled) // Update failed
			$tr_inv_item_list->RestoreCurrentRowFormValues($tr_inv_item_list->RowIndex); // Restore form values
		if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) // Edit row
			$tr_inv_item_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tr_inv_item->RowAttrs = array_merge($tr_inv_item->RowAttrs, array('data-rowindex'=>$tr_inv_item_list->RowCnt, 'id'=>'r' . $tr_inv_item_list->RowCnt . '_tr_inv_item', 'data-rowtype'=>$tr_inv_item->RowType));

		// Render row
		$tr_inv_item_list->RenderRow();

		// Render list options
		$tr_inv_item_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tr_inv_item_list->RowAction <> "delete" && $tr_inv_item_list->RowAction <> "insertdelete" && !($tr_inv_item_list->RowAction == "insert" && $tr_inv_item->CurrentAction == "F" && $tr_inv_item_list->EmptyRow())) {
?>
	<tr<?php echo $tr_inv_item->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tr_inv_item_list->ListOptions->Render("body", "left", $tr_inv_item_list->RowCnt);
?>
	<?php if ($tr_inv_item->item_id->Visible) { // item_id ?>
		<td data-name="item_id"<?php echo $tr_inv_item->item_id->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_id" class="form-group tr_inv_item_item_id">
<?php
$wrkonchange = trim("ew_UpdateOpt.call(this); " . @$tr_inv_item->item_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_inv_item->item_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" style="white-space: nowrap; z-index: <?php echo (9000 - $tr_inv_item_list->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" id="sv_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" value="<?php echo $tr_inv_item->item_id->EditValue ?>" size="40" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_id->getPlaceHolder()) ?>"<?php echo $tr_inv_item->item_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" data-value-separator="<?php echo $tr_inv_item->item_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ftr_inv_itemlist.CreateAutoSuggest({"id":"x<?php echo $tr_inv_item_list->RowIndex ?>_item_id","forceSelect":true});
</script>
<input type="hidden" name="ln_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" id="ln_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" value="x<?php echo $tr_inv_item_list->RowIndex ?>_item_code,x<?php echo $tr_inv_item_list->RowIndex ?>_item_name,x<?php echo $tr_inv_item_list->RowIndex ?>_unit_id,x<?php echo $tr_inv_item_list->RowIndex ?>_item_price,x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id">
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_id" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_id" class="form-group tr_inv_item_item_id">
<?php
$wrkonchange = trim("ew_UpdateOpt.call(this); " . @$tr_inv_item->item_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_inv_item->item_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" style="white-space: nowrap; z-index: <?php echo (9000 - $tr_inv_item_list->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" id="sv_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" value="<?php echo $tr_inv_item->item_id->EditValue ?>" size="40" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_id->getPlaceHolder()) ?>"<?php echo $tr_inv_item->item_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" data-value-separator="<?php echo $tr_inv_item->item_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ftr_inv_itemlist.CreateAutoSuggest({"id":"x<?php echo $tr_inv_item_list->RowIndex ?>_item_id","forceSelect":true});
</script>
<input type="hidden" name="ln_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" id="ln_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" value="x<?php echo $tr_inv_item_list->RowIndex ?>_item_code,x<?php echo $tr_inv_item_list->RowIndex ?>_item_name,x<?php echo $tr_inv_item_list->RowIndex ?>_unit_id,x<?php echo $tr_inv_item_list->RowIndex ?>_item_price,x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id">
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_id" class="tr_inv_item_item_id">
<span<?php echo $tr_inv_item->item_id->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_row_id" name="x<?php echo $tr_inv_item_list->RowIndex ?>_row_id" id="x<?php echo $tr_inv_item_list->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($tr_inv_item->row_id->CurrentValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_row_id" name="o<?php echo $tr_inv_item_list->RowIndex ?>_row_id" id="o<?php echo $tr_inv_item_list->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($tr_inv_item->row_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT || $tr_inv_item->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_row_id" name="x<?php echo $tr_inv_item_list->RowIndex ?>_row_id" id="x<?php echo $tr_inv_item_list->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($tr_inv_item->row_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($tr_inv_item->item_code->Visible) { // item_code ?>
		<td data-name="item_code"<?php echo $tr_inv_item->item_code->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_code" class="form-group tr_inv_item_item_code">
<input type="text" data-table="tr_inv_item" data-field="x_item_code" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_code" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_code" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_code->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_code->EditValue ?>"<?php echo $tr_inv_item->item_code->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_code" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_code" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_inv_item->item_code->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_code" class="form-group tr_inv_item_item_code">
<input type="text" data-table="tr_inv_item" data-field="x_item_code" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_code" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_code" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_code->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_code->EditValue ?>"<?php echo $tr_inv_item->item_code->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_code" class="tr_inv_item_item_code">
<span<?php echo $tr_inv_item->item_code->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_code->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_name->Visible) { // item_name ?>
		<td data-name="item_name"<?php echo $tr_inv_item->item_name->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_name" class="form-group tr_inv_item_item_name">
<input type="text" data-table="tr_inv_item" data-field="x_item_name" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_name" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_name->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_name->EditValue ?>"<?php echo $tr_inv_item->item_name->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_name" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_name" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_name" value="<?php echo ew_HtmlEncode($tr_inv_item->item_name->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_name" class="form-group tr_inv_item_item_name">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_name" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_name" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_name" value="<?php echo ew_HtmlEncode($tr_inv_item->item_name->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_name" class="tr_inv_item_item_name">
<span<?php echo $tr_inv_item->item_name->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_name->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->udet_id->Visible) { // udet_id ?>
		<td data-name="udet_id"<?php echo $tr_inv_item->udet_id->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_udet_id" class="form-group tr_inv_item_udet_id">
<?php $tr_inv_item->udet_id->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_inv_item->udet_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_inv_item->udet_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_inv_item->udet_id->ViewValue ?>
	</span>
	<?php if (!$tr_inv_item->udet_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_inv_item->udet_id->RadioButtonListHtml(TRUE, "x{$tr_inv_item_list->RowIndex}_udet_id") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" class="ewTemplate"><input type="radio" data-table="tr_inv_item" data-field="x_udet_id" data-value-separator="<?php echo $tr_inv_item->udet_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" id="x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" value="{value}"<?php echo $tr_inv_item->udet_id->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" id="ln_x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" value="x<?php echo $tr_inv_item_list->RowIndex ?>_unit_id,x<?php echo $tr_inv_item_list->RowIndex ?>_item_price">
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_udet_id" name="o<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" id="o<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" value="<?php echo ew_HtmlEncode($tr_inv_item->udet_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_udet_id" class="form-group tr_inv_item_udet_id">
<?php $tr_inv_item->udet_id->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_inv_item->udet_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_inv_item->udet_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_inv_item->udet_id->ViewValue ?>
	</span>
	<?php if (!$tr_inv_item->udet_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_inv_item->udet_id->RadioButtonListHtml(TRUE, "x{$tr_inv_item_list->RowIndex}_udet_id") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" class="ewTemplate"><input type="radio" data-table="tr_inv_item" data-field="x_udet_id" data-value-separator="<?php echo $tr_inv_item->udet_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" id="x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" value="{value}"<?php echo $tr_inv_item->udet_id->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" id="ln_x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" value="x<?php echo $tr_inv_item_list->RowIndex ?>_unit_id,x<?php echo $tr_inv_item_list->RowIndex ?>_item_price">
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_udet_id" class="tr_inv_item_udet_id">
<span<?php echo $tr_inv_item->udet_id->ViewAttributes() ?>>
<?php echo $tr_inv_item->udet_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_qty->Visible) { // item_qty ?>
		<td data-name="item_qty"<?php echo $tr_inv_item->item_qty->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_qty" class="form-group tr_inv_item_item_qty">
<input type="text" data-table="tr_inv_item" data-field="x_item_qty" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_qty" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_qty" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_qty->EditValue ?>"<?php echo $tr_inv_item->item_qty->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_qty" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_qty" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_qty" class="form-group tr_inv_item_item_qty">
<input type="text" data-table="tr_inv_item" data-field="x_item_qty" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_qty" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_qty" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_qty->EditValue ?>"<?php echo $tr_inv_item->item_qty->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_qty" class="tr_inv_item_item_qty">
<span<?php echo $tr_inv_item->item_qty->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_qty->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_price->Visible) { // item_price ?>
		<td data-name="item_price"<?php echo $tr_inv_item->item_price->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_price" class="form-group tr_inv_item_item_price">
<input type="text" data-table="tr_inv_item" data-field="x_item_price" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_price" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_price" size="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_price->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_price->EditValue ?>"<?php echo $tr_inv_item->item_price->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_price" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_price" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_inv_item->item_price->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_price" class="form-group tr_inv_item_item_price">
<input type="text" data-table="tr_inv_item" data-field="x_item_price" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_price" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_price" size="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_price->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_price->EditValue ?>"<?php echo $tr_inv_item->item_price->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_price" class="tr_inv_item_item_price">
<span<?php echo $tr_inv_item->item_price->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_price->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_disc->Visible) { // item_disc ?>
		<td data-name="item_disc"<?php echo $tr_inv_item->item_disc->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_disc" class="form-group tr_inv_item_item_disc">
<input type="text" data-table="tr_inv_item" data-field="x_item_disc" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_disc" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_disc" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_disc->EditValue ?>"<?php echo $tr_inv_item->item_disc->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_disc" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_disc" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_disc" value="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_disc" class="form-group tr_inv_item_item_disc">
<input type="text" data-table="tr_inv_item" data-field="x_item_disc" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_disc" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_disc" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_disc->EditValue ?>"<?php echo $tr_inv_item->item_disc->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_disc" class="tr_inv_item_item_disc">
<span<?php echo $tr_inv_item->item_disc->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_disc->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_amt->Visible) { // item_amt ?>
		<td data-name="item_amt"<?php echo $tr_inv_item->item_amt->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_amt" class="form-group tr_inv_item_item_amt">
<input type="text" data-table="tr_inv_item" data-field="x_item_amt" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_amt" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_amt" size="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_amt->EditValue ?>"<?php echo $tr_inv_item->item_amt->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_amt" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_amt" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_amt" value="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_amt" class="form-group tr_inv_item_item_amt">
<input type="text" data-table="tr_inv_item" data-field="x_item_amt" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_amt" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_amt" size="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_amt->EditValue ?>"<?php echo $tr_inv_item->item_amt->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_item_amt" class="tr_inv_item_item_amt">
<span<?php echo $tr_inv_item->item_amt->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_amt->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->unit_id->Visible) { // unit_id ?>
		<td data-name="unit_id"<?php echo $tr_inv_item->unit_id->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_unit_id" class="form-group tr_inv_item_unit_id">
<input type="text" data-table="tr_inv_item" data-field="x_unit_id" name="x<?php echo $tr_inv_item_list->RowIndex ?>_unit_id" id="x<?php echo $tr_inv_item_list->RowIndex ?>_unit_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->unit_id->EditValue ?>"<?php echo $tr_inv_item->unit_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_unit_id" name="o<?php echo $tr_inv_item_list->RowIndex ?>_unit_id" id="o<?php echo $tr_inv_item_list->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_unit_id" class="form-group tr_inv_item_unit_id">
<input type="hidden" data-table="tr_inv_item" data-field="x_unit_id" name="x<?php echo $tr_inv_item_list->RowIndex ?>_unit_id" id="x<?php echo $tr_inv_item_list->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_list->RowCnt ?>_tr_inv_item_unit_id" class="tr_inv_item_unit_id">
<span<?php echo $tr_inv_item->unit_id->ViewAttributes() ?>>
<?php echo $tr_inv_item->unit_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tr_inv_item_list->ListOptions->Render("body", "right", $tr_inv_item_list->RowCnt);
?>
	</tr>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD || $tr_inv_item->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ftr_inv_itemlist.UpdateOpts(<?php echo $tr_inv_item_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($tr_inv_item->CurrentAction <> "gridadd")
		if (!$tr_inv_item_list->Recordset->EOF) $tr_inv_item_list->Recordset->MoveNext();
}
?>
<?php
	if ($tr_inv_item->CurrentAction == "gridadd" || $tr_inv_item->CurrentAction == "gridedit") {
		$tr_inv_item_list->RowIndex = '$rowindex$';
		$tr_inv_item_list->LoadRowValues();

		// Set row properties
		$tr_inv_item->ResetAttrs();
		$tr_inv_item->RowAttrs = array_merge($tr_inv_item->RowAttrs, array('data-rowindex'=>$tr_inv_item_list->RowIndex, 'id'=>'r0_tr_inv_item', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($tr_inv_item->RowAttrs["class"], "ewTemplate");
		$tr_inv_item->RowType = EW_ROWTYPE_ADD;

		// Render row
		$tr_inv_item_list->RenderRow();

		// Render list options
		$tr_inv_item_list->RenderListOptions();
		$tr_inv_item_list->StartRowCnt = 0;
?>
	<tr<?php echo $tr_inv_item->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tr_inv_item_list->ListOptions->Render("body", "left", $tr_inv_item_list->RowIndex);
?>
	<?php if ($tr_inv_item->item_id->Visible) { // item_id ?>
		<td data-name="item_id">
<span id="el$rowindex$_tr_inv_item_item_id" class="form-group tr_inv_item_item_id">
<?php
$wrkonchange = trim("ew_UpdateOpt.call(this); " . @$tr_inv_item->item_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_inv_item->item_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" style="white-space: nowrap; z-index: <?php echo (9000 - $tr_inv_item_list->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" id="sv_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" value="<?php echo $tr_inv_item->item_id->EditValue ?>" size="40" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_id->getPlaceHolder()) ?>"<?php echo $tr_inv_item->item_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" data-value-separator="<?php echo $tr_inv_item->item_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ftr_inv_itemlist.CreateAutoSuggest({"id":"x<?php echo $tr_inv_item_list->RowIndex ?>_item_id","forceSelect":true});
</script>
<input type="hidden" name="ln_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" id="ln_x<?php echo $tr_inv_item_list->RowIndex ?>_item_id" value="x<?php echo $tr_inv_item_list->RowIndex ?>_item_code,x<?php echo $tr_inv_item_list->RowIndex ?>_item_name,x<?php echo $tr_inv_item_list->RowIndex ?>_unit_id,x<?php echo $tr_inv_item_list->RowIndex ?>_item_price,x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id">
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_id" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_code->Visible) { // item_code ?>
		<td data-name="item_code">
<span id="el$rowindex$_tr_inv_item_item_code" class="form-group tr_inv_item_item_code">
<input type="text" data-table="tr_inv_item" data-field="x_item_code" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_code" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_code" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_code->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_code->EditValue ?>"<?php echo $tr_inv_item->item_code->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_code" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_code" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_inv_item->item_code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_name->Visible) { // item_name ?>
		<td data-name="item_name">
<span id="el$rowindex$_tr_inv_item_item_name" class="form-group tr_inv_item_item_name">
<input type="text" data-table="tr_inv_item" data-field="x_item_name" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_name" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_name->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_name->EditValue ?>"<?php echo $tr_inv_item->item_name->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_name" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_name" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_name" value="<?php echo ew_HtmlEncode($tr_inv_item->item_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->udet_id->Visible) { // udet_id ?>
		<td data-name="udet_id">
<span id="el$rowindex$_tr_inv_item_udet_id" class="form-group tr_inv_item_udet_id">
<?php $tr_inv_item->udet_id->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_inv_item->udet_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_inv_item->udet_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_inv_item->udet_id->ViewValue ?>
	</span>
	<?php if (!$tr_inv_item->udet_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_inv_item->udet_id->RadioButtonListHtml(TRUE, "x{$tr_inv_item_list->RowIndex}_udet_id") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" class="ewTemplate"><input type="radio" data-table="tr_inv_item" data-field="x_udet_id" data-value-separator="<?php echo $tr_inv_item->udet_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" id="x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" value="{value}"<?php echo $tr_inv_item->udet_id->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" id="ln_x<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" value="x<?php echo $tr_inv_item_list->RowIndex ?>_unit_id,x<?php echo $tr_inv_item_list->RowIndex ?>_item_price">
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_udet_id" name="o<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" id="o<?php echo $tr_inv_item_list->RowIndex ?>_udet_id" value="<?php echo ew_HtmlEncode($tr_inv_item->udet_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_qty->Visible) { // item_qty ?>
		<td data-name="item_qty">
<span id="el$rowindex$_tr_inv_item_item_qty" class="form-group tr_inv_item_item_qty">
<input type="text" data-table="tr_inv_item" data-field="x_item_qty" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_qty" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_qty" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_qty->EditValue ?>"<?php echo $tr_inv_item->item_qty->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_qty" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_qty" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_price->Visible) { // item_price ?>
		<td data-name="item_price">
<span id="el$rowindex$_tr_inv_item_item_price" class="form-group tr_inv_item_item_price">
<input type="text" data-table="tr_inv_item" data-field="x_item_price" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_price" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_price" size="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_price->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_price->EditValue ?>"<?php echo $tr_inv_item->item_price->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_price" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_price" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_inv_item->item_price->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_disc->Visible) { // item_disc ?>
		<td data-name="item_disc">
<span id="el$rowindex$_tr_inv_item_item_disc" class="form-group tr_inv_item_item_disc">
<input type="text" data-table="tr_inv_item" data-field="x_item_disc" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_disc" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_disc" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_disc->EditValue ?>"<?php echo $tr_inv_item->item_disc->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_disc" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_disc" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_disc" value="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_amt->Visible) { // item_amt ?>
		<td data-name="item_amt">
<span id="el$rowindex$_tr_inv_item_item_amt" class="form-group tr_inv_item_item_amt">
<input type="text" data-table="tr_inv_item" data-field="x_item_amt" name="x<?php echo $tr_inv_item_list->RowIndex ?>_item_amt" id="x<?php echo $tr_inv_item_list->RowIndex ?>_item_amt" size="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_amt->EditValue ?>"<?php echo $tr_inv_item->item_amt->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_amt" name="o<?php echo $tr_inv_item_list->RowIndex ?>_item_amt" id="o<?php echo $tr_inv_item_list->RowIndex ?>_item_amt" value="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->unit_id->Visible) { // unit_id ?>
		<td data-name="unit_id">
<span id="el$rowindex$_tr_inv_item_unit_id" class="form-group tr_inv_item_unit_id">
<input type="text" data-table="tr_inv_item" data-field="x_unit_id" name="x<?php echo $tr_inv_item_list->RowIndex ?>_unit_id" id="x<?php echo $tr_inv_item_list->RowIndex ?>_unit_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->unit_id->EditValue ?>"<?php echo $tr_inv_item->unit_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_unit_id" name="o<?php echo $tr_inv_item_list->RowIndex ?>_unit_id" id="o<?php echo $tr_inv_item_list->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tr_inv_item_list->ListOptions->Render("body", "right", $tr_inv_item_list->RowIndex);
?>
<script type="text/javascript">
ftr_inv_itemlist.UpdateOpts(<?php echo $tr_inv_item_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
<?php

// Render aggregate row
$tr_inv_item->RowType = EW_ROWTYPE_AGGREGATE;
$tr_inv_item->ResetAttrs();
$tr_inv_item_list->RenderRow();
?>
<?php if ($tr_inv_item_list->TotalRecs > 0 && ($tr_inv_item->CurrentAction <> "gridadd" && $tr_inv_item->CurrentAction <> "gridedit")) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$tr_inv_item_list->RenderListOptions();

// Render list options (footer, left)
$tr_inv_item_list->ListOptions->Render("footer", "left");
?>
	<?php if ($tr_inv_item->item_id->Visible) { // item_id ?>
		<td data-name="item_id" class="<?php echo $tr_inv_item->item_id->FooterCellClass() ?>"><span id="elf_tr_inv_item_item_id" class="tr_inv_item_item_id">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tr_inv_item->item_code->Visible) { // item_code ?>
		<td data-name="item_code" class="<?php echo $tr_inv_item->item_code->FooterCellClass() ?>"><span id="elf_tr_inv_item_item_code" class="tr_inv_item_item_code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tr_inv_item->item_name->Visible) { // item_name ?>
		<td data-name="item_name" class="<?php echo $tr_inv_item->item_name->FooterCellClass() ?>"><span id="elf_tr_inv_item_item_name" class="tr_inv_item_item_name">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tr_inv_item->udet_id->Visible) { // udet_id ?>
		<td data-name="udet_id" class="<?php echo $tr_inv_item->udet_id->FooterCellClass() ?>"><span id="elf_tr_inv_item_udet_id" class="tr_inv_item_udet_id">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tr_inv_item->item_qty->Visible) { // item_qty ?>
		<td data-name="item_qty" class="<?php echo $tr_inv_item->item_qty->FooterCellClass() ?>"><span id="elf_tr_inv_item_item_qty" class="tr_inv_item_item_qty">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tr_inv_item->item_price->Visible) { // item_price ?>
		<td data-name="item_price" class="<?php echo $tr_inv_item->item_price->FooterCellClass() ?>"><span id="elf_tr_inv_item_item_price" class="tr_inv_item_item_price">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tr_inv_item->item_disc->Visible) { // item_disc ?>
		<td data-name="item_disc" class="<?php echo $tr_inv_item->item_disc->FooterCellClass() ?>"><span id="elf_tr_inv_item_item_disc" class="tr_inv_item_item_disc">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tr_inv_item->item_amt->Visible) { // item_amt ?>
		<td data-name="item_amt" class="<?php echo $tr_inv_item->item_amt->FooterCellClass() ?>"><span id="elf_tr_inv_item_item_amt" class="tr_inv_item_item_amt">
<span class="ewAggregate"><?php echo $Language->Phrase("TOTAL") ?></span><span class="ewAggregateValue">
<?php echo $tr_inv_item->item_amt->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tr_inv_item->unit_id->Visible) { // unit_id ?>
		<td data-name="unit_id" class="<?php echo $tr_inv_item->unit_id->FooterCellClass() ?>"><span id="elf_tr_inv_item_unit_id" class="tr_inv_item_unit_id">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tr_inv_item_list->ListOptions->Render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table>
<?php } ?>
<?php if ($tr_inv_item->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $tr_inv_item_list->FormKeyCountName ?>" id="<?php echo $tr_inv_item_list->FormKeyCountName ?>" value="<?php echo $tr_inv_item_list->KeyCount ?>">
<?php echo $tr_inv_item_list->MultiSelectKey ?>
<?php } ?>
<?php if ($tr_inv_item->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $tr_inv_item_list->FormKeyCountName ?>" id="<?php echo $tr_inv_item_list->FormKeyCountName ?>" value="<?php echo $tr_inv_item_list->KeyCount ?>">
<?php echo $tr_inv_item_list->MultiSelectKey ?>
<?php } ?>
<?php if ($tr_inv_item->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($tr_inv_item_list->Recordset)
	$tr_inv_item_list->Recordset->Close();
?>
<?php if ($tr_inv_item->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($tr_inv_item->CurrentAction <> "gridadd" && $tr_inv_item->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($tr_inv_item_list->Pager)) $tr_inv_item_list->Pager = new cPrevNextPager($tr_inv_item_list->StartRec, $tr_inv_item_list->DisplayRecs, $tr_inv_item_list->TotalRecs, $tr_inv_item_list->AutoHidePager) ?>
<?php if ($tr_inv_item_list->Pager->RecordCount > 0 && $tr_inv_item_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($tr_inv_item_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $tr_inv_item_list->PageUrl() ?>start=<?php echo $tr_inv_item_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tr_inv_item_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $tr_inv_item_list->PageUrl() ?>start=<?php echo $tr_inv_item_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tr_inv_item_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($tr_inv_item_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $tr_inv_item_list->PageUrl() ?>start=<?php echo $tr_inv_item_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tr_inv_item_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $tr_inv_item_list->PageUrl() ?>start=<?php echo $tr_inv_item_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tr_inv_item_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($tr_inv_item_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tr_inv_item_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tr_inv_item_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tr_inv_item_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tr_inv_item_list->TotalRecs > 0 && (!$tr_inv_item_list->AutoHidePageSizeSelector || $tr_inv_item_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="tr_inv_item">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($tr_inv_item_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($tr_inv_item_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tr_inv_item_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tr_inv_item_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="ALL"<?php if ($tr_inv_item->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($tr_inv_item_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($tr_inv_item_list->TotalRecs == 0 && $tr_inv_item->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($tr_inv_item_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($tr_inv_item->Export == "") { ?>
<script type="text/javascript">
ftr_inv_itemlist.Init();
</script>
<?php } ?>
<?php
$tr_inv_item_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($tr_inv_item->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tr_inv_item_list->Page_Terminate();
?>
