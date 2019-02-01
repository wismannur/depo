<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_inv_masterinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tr_inv_itemgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_inv_master_list = NULL; // Initialize page object first

class ctr_inv_master_list extends ctr_inv_master {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_inv_master';

	// Page object name
	var $PageObjName = 'tr_inv_master_list';

	// Grid form hidden field names
	var $FormName = 'ftr_inv_masterlist';
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

		// Table object (tr_inv_master)
		if (!isset($GLOBALS["tr_inv_master"]) || get_class($GLOBALS["tr_inv_master"]) == "ctr_inv_master") {
			$GLOBALS["tr_inv_master"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_inv_master"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "tr_inv_masteradd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tr_inv_masterdelete.php";
		$this->MultiUpdateUrl = "tr_inv_masterupdate.php";

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_inv_master', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption ftr_inv_masterlistsrch";

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
		$this->inv_number->SetVisibility();
		$this->inv_date->SetVisibility();
		$this->due_date->SetVisibility();
		$this->customer_id->SetVisibility();
		$this->area_id->SetVisibility();
		$this->inv_total->SetVisibility();
		$this->sales_id->SetVisibility();
		$this->paid->SetVisibility();

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

			// Get the keys for master table
			$sDetailTblVar = $this->getCurrentDetailTable();
			if ($sDetailTblVar <> "") {
				$DetailTblVar = explode(",", $sDetailTblVar);
				if (in_array("tr_inv_item", $DetailTblVar)) {

					// Process auto fill for detail table 'tr_inv_item'
					if (preg_match('/^ftr_inv_item(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["tr_inv_item_grid"])) $GLOBALS["tr_inv_item_grid"] = new ctr_inv_item_grid;
						$GLOBALS["tr_inv_item_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
			}
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
		global $EW_EXPORT, $tr_inv_master;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_inv_master);
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
	var $tr_inv_item_Count;
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

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Process filter list
			$this->ProcessFilterList();

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetupSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
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

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

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
			$this->inv_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->inv_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Initialize
		$sFilterList = "";
		$sSavedFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->inv_id->AdvancedSearch->ToJson(), ","); // Field inv_id
		$sFilterList = ew_Concat($sFilterList, $this->inv_number->AdvancedSearch->ToJson(), ","); // Field inv_number
		$sFilterList = ew_Concat($sFilterList, $this->inv_date->AdvancedSearch->ToJson(), ","); // Field inv_date
		$sFilterList = ew_Concat($sFilterList, $this->tax_type->AdvancedSearch->ToJson(), ","); // Field tax_type
		$sFilterList = ew_Concat($sFilterList, $this->due_date->AdvancedSearch->ToJson(), ","); // Field due_date
		$sFilterList = ew_Concat($sFilterList, $this->customer_id->AdvancedSearch->ToJson(), ","); // Field customer_id
		$sFilterList = ew_Concat($sFilterList, $this->customer_name->AdvancedSearch->ToJson(), ","); // Field customer_name
		$sFilterList = ew_Concat($sFilterList, $this->address1->AdvancedSearch->ToJson(), ","); // Field address1
		$sFilterList = ew_Concat($sFilterList, $this->address2->AdvancedSearch->ToJson(), ","); // Field address2
		$sFilterList = ew_Concat($sFilterList, $this->address3->AdvancedSearch->ToJson(), ","); // Field address3
		$sFilterList = ew_Concat($sFilterList, $this->wilayah_id->AdvancedSearch->ToJson(), ","); // Field wilayah_id
		$sFilterList = ew_Concat($sFilterList, $this->subwil_id->AdvancedSearch->ToJson(), ","); // Field subwil_id
		$sFilterList = ew_Concat($sFilterList, $this->area_id->AdvancedSearch->ToJson(), ","); // Field area_id
		$sFilterList = ew_Concat($sFilterList, $this->tax_number->AdvancedSearch->ToJson(), ","); // Field tax_number
		$sFilterList = ew_Concat($sFilterList, $this->tc_number->AdvancedSearch->ToJson(), ","); // Field tc_number
		$sFilterList = ew_Concat($sFilterList, $this->inv_amt->AdvancedSearch->ToJson(), ","); // Field inv_amt
		$sFilterList = ew_Concat($sFilterList, $this->discount->AdvancedSearch->ToJson(), ","); // Field discount
		$sFilterList = ew_Concat($sFilterList, $this->total_discount->AdvancedSearch->ToJson(), ","); // Field total_discount
		$sFilterList = ew_Concat($sFilterList, $this->tax_total->AdvancedSearch->ToJson(), ","); // Field tax_total
		$sFilterList = ew_Concat($sFilterList, $this->inv_total->AdvancedSearch->ToJson(), ","); // Field inv_total
		$sFilterList = ew_Concat($sFilterList, $this->paid_amt->AdvancedSearch->ToJson(), ","); // Field paid_amt
		$sFilterList = ew_Concat($sFilterList, $this->user_id->AdvancedSearch->ToJson(), ","); // Field user_id
		$sFilterList = ew_Concat($sFilterList, $this->lastupdate->AdvancedSearch->ToJson(), ","); // Field lastupdate
		$sFilterList = ew_Concat($sFilterList, $this->koreksi->AdvancedSearch->ToJson(), ","); // Field koreksi
		$sFilterList = ew_Concat($sFilterList, $this->tanggal_koreksi->AdvancedSearch->ToJson(), ","); // Field tanggal_koreksi
		$sFilterList = ew_Concat($sFilterList, $this->sales_id->AdvancedSearch->ToJson(), ","); // Field sales_id
		$sFilterList = ew_Concat($sFilterList, $this->sopir->AdvancedSearch->ToJson(), ","); // Field sopir
		$sFilterList = ew_Concat($sFilterList, $this->no_mobil->AdvancedSearch->ToJson(), ","); // Field no_mobil
		$sFilterList = ew_Concat($sFilterList, $this->kode_depo->AdvancedSearch->ToJson(), ","); // Field kode_depo
		if ($this->BasicSearch->Keyword <> "") {
			$sWrk = "\"" . EW_TABLE_BASIC_SEARCH . "\":\"" . ew_JsEncode2($this->BasicSearch->Keyword) . "\",\"" . EW_TABLE_BASIC_SEARCH_TYPE . "\":\"" . ew_JsEncode2($this->BasicSearch->Type) . "\"";
			$sFilterList = ew_Concat($sFilterList, $sWrk, ",");
		}
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = @$_POST["filters"];
			$UserProfile->SetSearchFilters(CurrentUserName(), "ftr_inv_masterlistsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(@$_POST["filter"], TRUE);
		$this->Command = "search";

		// Field inv_id
		$this->inv_id->AdvancedSearch->SearchValue = @$filter["x_inv_id"];
		$this->inv_id->AdvancedSearch->SearchOperator = @$filter["z_inv_id"];
		$this->inv_id->AdvancedSearch->SearchCondition = @$filter["v_inv_id"];
		$this->inv_id->AdvancedSearch->SearchValue2 = @$filter["y_inv_id"];
		$this->inv_id->AdvancedSearch->SearchOperator2 = @$filter["w_inv_id"];
		$this->inv_id->AdvancedSearch->Save();

		// Field inv_number
		$this->inv_number->AdvancedSearch->SearchValue = @$filter["x_inv_number"];
		$this->inv_number->AdvancedSearch->SearchOperator = @$filter["z_inv_number"];
		$this->inv_number->AdvancedSearch->SearchCondition = @$filter["v_inv_number"];
		$this->inv_number->AdvancedSearch->SearchValue2 = @$filter["y_inv_number"];
		$this->inv_number->AdvancedSearch->SearchOperator2 = @$filter["w_inv_number"];
		$this->inv_number->AdvancedSearch->Save();

		// Field inv_date
		$this->inv_date->AdvancedSearch->SearchValue = @$filter["x_inv_date"];
		$this->inv_date->AdvancedSearch->SearchOperator = @$filter["z_inv_date"];
		$this->inv_date->AdvancedSearch->SearchCondition = @$filter["v_inv_date"];
		$this->inv_date->AdvancedSearch->SearchValue2 = @$filter["y_inv_date"];
		$this->inv_date->AdvancedSearch->SearchOperator2 = @$filter["w_inv_date"];
		$this->inv_date->AdvancedSearch->Save();

		// Field tax_type
		$this->tax_type->AdvancedSearch->SearchValue = @$filter["x_tax_type"];
		$this->tax_type->AdvancedSearch->SearchOperator = @$filter["z_tax_type"];
		$this->tax_type->AdvancedSearch->SearchCondition = @$filter["v_tax_type"];
		$this->tax_type->AdvancedSearch->SearchValue2 = @$filter["y_tax_type"];
		$this->tax_type->AdvancedSearch->SearchOperator2 = @$filter["w_tax_type"];
		$this->tax_type->AdvancedSearch->Save();

		// Field due_date
		$this->due_date->AdvancedSearch->SearchValue = @$filter["x_due_date"];
		$this->due_date->AdvancedSearch->SearchOperator = @$filter["z_due_date"];
		$this->due_date->AdvancedSearch->SearchCondition = @$filter["v_due_date"];
		$this->due_date->AdvancedSearch->SearchValue2 = @$filter["y_due_date"];
		$this->due_date->AdvancedSearch->SearchOperator2 = @$filter["w_due_date"];
		$this->due_date->AdvancedSearch->Save();

		// Field customer_id
		$this->customer_id->AdvancedSearch->SearchValue = @$filter["x_customer_id"];
		$this->customer_id->AdvancedSearch->SearchOperator = @$filter["z_customer_id"];
		$this->customer_id->AdvancedSearch->SearchCondition = @$filter["v_customer_id"];
		$this->customer_id->AdvancedSearch->SearchValue2 = @$filter["y_customer_id"];
		$this->customer_id->AdvancedSearch->SearchOperator2 = @$filter["w_customer_id"];
		$this->customer_id->AdvancedSearch->Save();

		// Field customer_name
		$this->customer_name->AdvancedSearch->SearchValue = @$filter["x_customer_name"];
		$this->customer_name->AdvancedSearch->SearchOperator = @$filter["z_customer_name"];
		$this->customer_name->AdvancedSearch->SearchCondition = @$filter["v_customer_name"];
		$this->customer_name->AdvancedSearch->SearchValue2 = @$filter["y_customer_name"];
		$this->customer_name->AdvancedSearch->SearchOperator2 = @$filter["w_customer_name"];
		$this->customer_name->AdvancedSearch->Save();

		// Field address1
		$this->address1->AdvancedSearch->SearchValue = @$filter["x_address1"];
		$this->address1->AdvancedSearch->SearchOperator = @$filter["z_address1"];
		$this->address1->AdvancedSearch->SearchCondition = @$filter["v_address1"];
		$this->address1->AdvancedSearch->SearchValue2 = @$filter["y_address1"];
		$this->address1->AdvancedSearch->SearchOperator2 = @$filter["w_address1"];
		$this->address1->AdvancedSearch->Save();

		// Field address2
		$this->address2->AdvancedSearch->SearchValue = @$filter["x_address2"];
		$this->address2->AdvancedSearch->SearchOperator = @$filter["z_address2"];
		$this->address2->AdvancedSearch->SearchCondition = @$filter["v_address2"];
		$this->address2->AdvancedSearch->SearchValue2 = @$filter["y_address2"];
		$this->address2->AdvancedSearch->SearchOperator2 = @$filter["w_address2"];
		$this->address2->AdvancedSearch->Save();

		// Field address3
		$this->address3->AdvancedSearch->SearchValue = @$filter["x_address3"];
		$this->address3->AdvancedSearch->SearchOperator = @$filter["z_address3"];
		$this->address3->AdvancedSearch->SearchCondition = @$filter["v_address3"];
		$this->address3->AdvancedSearch->SearchValue2 = @$filter["y_address3"];
		$this->address3->AdvancedSearch->SearchOperator2 = @$filter["w_address3"];
		$this->address3->AdvancedSearch->Save();

		// Field wilayah_id
		$this->wilayah_id->AdvancedSearch->SearchValue = @$filter["x_wilayah_id"];
		$this->wilayah_id->AdvancedSearch->SearchOperator = @$filter["z_wilayah_id"];
		$this->wilayah_id->AdvancedSearch->SearchCondition = @$filter["v_wilayah_id"];
		$this->wilayah_id->AdvancedSearch->SearchValue2 = @$filter["y_wilayah_id"];
		$this->wilayah_id->AdvancedSearch->SearchOperator2 = @$filter["w_wilayah_id"];
		$this->wilayah_id->AdvancedSearch->Save();

		// Field subwil_id
		$this->subwil_id->AdvancedSearch->SearchValue = @$filter["x_subwil_id"];
		$this->subwil_id->AdvancedSearch->SearchOperator = @$filter["z_subwil_id"];
		$this->subwil_id->AdvancedSearch->SearchCondition = @$filter["v_subwil_id"];
		$this->subwil_id->AdvancedSearch->SearchValue2 = @$filter["y_subwil_id"];
		$this->subwil_id->AdvancedSearch->SearchOperator2 = @$filter["w_subwil_id"];
		$this->subwil_id->AdvancedSearch->Save();

		// Field area_id
		$this->area_id->AdvancedSearch->SearchValue = @$filter["x_area_id"];
		$this->area_id->AdvancedSearch->SearchOperator = @$filter["z_area_id"];
		$this->area_id->AdvancedSearch->SearchCondition = @$filter["v_area_id"];
		$this->area_id->AdvancedSearch->SearchValue2 = @$filter["y_area_id"];
		$this->area_id->AdvancedSearch->SearchOperator2 = @$filter["w_area_id"];
		$this->area_id->AdvancedSearch->Save();

		// Field tax_number
		$this->tax_number->AdvancedSearch->SearchValue = @$filter["x_tax_number"];
		$this->tax_number->AdvancedSearch->SearchOperator = @$filter["z_tax_number"];
		$this->tax_number->AdvancedSearch->SearchCondition = @$filter["v_tax_number"];
		$this->tax_number->AdvancedSearch->SearchValue2 = @$filter["y_tax_number"];
		$this->tax_number->AdvancedSearch->SearchOperator2 = @$filter["w_tax_number"];
		$this->tax_number->AdvancedSearch->Save();

		// Field tc_number
		$this->tc_number->AdvancedSearch->SearchValue = @$filter["x_tc_number"];
		$this->tc_number->AdvancedSearch->SearchOperator = @$filter["z_tc_number"];
		$this->tc_number->AdvancedSearch->SearchCondition = @$filter["v_tc_number"];
		$this->tc_number->AdvancedSearch->SearchValue2 = @$filter["y_tc_number"];
		$this->tc_number->AdvancedSearch->SearchOperator2 = @$filter["w_tc_number"];
		$this->tc_number->AdvancedSearch->Save();

		// Field inv_amt
		$this->inv_amt->AdvancedSearch->SearchValue = @$filter["x_inv_amt"];
		$this->inv_amt->AdvancedSearch->SearchOperator = @$filter["z_inv_amt"];
		$this->inv_amt->AdvancedSearch->SearchCondition = @$filter["v_inv_amt"];
		$this->inv_amt->AdvancedSearch->SearchValue2 = @$filter["y_inv_amt"];
		$this->inv_amt->AdvancedSearch->SearchOperator2 = @$filter["w_inv_amt"];
		$this->inv_amt->AdvancedSearch->Save();

		// Field discount
		$this->discount->AdvancedSearch->SearchValue = @$filter["x_discount"];
		$this->discount->AdvancedSearch->SearchOperator = @$filter["z_discount"];
		$this->discount->AdvancedSearch->SearchCondition = @$filter["v_discount"];
		$this->discount->AdvancedSearch->SearchValue2 = @$filter["y_discount"];
		$this->discount->AdvancedSearch->SearchOperator2 = @$filter["w_discount"];
		$this->discount->AdvancedSearch->Save();

		// Field total_discount
		$this->total_discount->AdvancedSearch->SearchValue = @$filter["x_total_discount"];
		$this->total_discount->AdvancedSearch->SearchOperator = @$filter["z_total_discount"];
		$this->total_discount->AdvancedSearch->SearchCondition = @$filter["v_total_discount"];
		$this->total_discount->AdvancedSearch->SearchValue2 = @$filter["y_total_discount"];
		$this->total_discount->AdvancedSearch->SearchOperator2 = @$filter["w_total_discount"];
		$this->total_discount->AdvancedSearch->Save();

		// Field tax_total
		$this->tax_total->AdvancedSearch->SearchValue = @$filter["x_tax_total"];
		$this->tax_total->AdvancedSearch->SearchOperator = @$filter["z_tax_total"];
		$this->tax_total->AdvancedSearch->SearchCondition = @$filter["v_tax_total"];
		$this->tax_total->AdvancedSearch->SearchValue2 = @$filter["y_tax_total"];
		$this->tax_total->AdvancedSearch->SearchOperator2 = @$filter["w_tax_total"];
		$this->tax_total->AdvancedSearch->Save();

		// Field inv_total
		$this->inv_total->AdvancedSearch->SearchValue = @$filter["x_inv_total"];
		$this->inv_total->AdvancedSearch->SearchOperator = @$filter["z_inv_total"];
		$this->inv_total->AdvancedSearch->SearchCondition = @$filter["v_inv_total"];
		$this->inv_total->AdvancedSearch->SearchValue2 = @$filter["y_inv_total"];
		$this->inv_total->AdvancedSearch->SearchOperator2 = @$filter["w_inv_total"];
		$this->inv_total->AdvancedSearch->Save();

		// Field paid_amt
		$this->paid_amt->AdvancedSearch->SearchValue = @$filter["x_paid_amt"];
		$this->paid_amt->AdvancedSearch->SearchOperator = @$filter["z_paid_amt"];
		$this->paid_amt->AdvancedSearch->SearchCondition = @$filter["v_paid_amt"];
		$this->paid_amt->AdvancedSearch->SearchValue2 = @$filter["y_paid_amt"];
		$this->paid_amt->AdvancedSearch->SearchOperator2 = @$filter["w_paid_amt"];
		$this->paid_amt->AdvancedSearch->Save();

		// Field user_id
		$this->user_id->AdvancedSearch->SearchValue = @$filter["x_user_id"];
		$this->user_id->AdvancedSearch->SearchOperator = @$filter["z_user_id"];
		$this->user_id->AdvancedSearch->SearchCondition = @$filter["v_user_id"];
		$this->user_id->AdvancedSearch->SearchValue2 = @$filter["y_user_id"];
		$this->user_id->AdvancedSearch->SearchOperator2 = @$filter["w_user_id"];
		$this->user_id->AdvancedSearch->Save();

		// Field lastupdate
		$this->lastupdate->AdvancedSearch->SearchValue = @$filter["x_lastupdate"];
		$this->lastupdate->AdvancedSearch->SearchOperator = @$filter["z_lastupdate"];
		$this->lastupdate->AdvancedSearch->SearchCondition = @$filter["v_lastupdate"];
		$this->lastupdate->AdvancedSearch->SearchValue2 = @$filter["y_lastupdate"];
		$this->lastupdate->AdvancedSearch->SearchOperator2 = @$filter["w_lastupdate"];
		$this->lastupdate->AdvancedSearch->Save();

		// Field koreksi
		$this->koreksi->AdvancedSearch->SearchValue = @$filter["x_koreksi"];
		$this->koreksi->AdvancedSearch->SearchOperator = @$filter["z_koreksi"];
		$this->koreksi->AdvancedSearch->SearchCondition = @$filter["v_koreksi"];
		$this->koreksi->AdvancedSearch->SearchValue2 = @$filter["y_koreksi"];
		$this->koreksi->AdvancedSearch->SearchOperator2 = @$filter["w_koreksi"];
		$this->koreksi->AdvancedSearch->Save();

		// Field tanggal_koreksi
		$this->tanggal_koreksi->AdvancedSearch->SearchValue = @$filter["x_tanggal_koreksi"];
		$this->tanggal_koreksi->AdvancedSearch->SearchOperator = @$filter["z_tanggal_koreksi"];
		$this->tanggal_koreksi->AdvancedSearch->SearchCondition = @$filter["v_tanggal_koreksi"];
		$this->tanggal_koreksi->AdvancedSearch->SearchValue2 = @$filter["y_tanggal_koreksi"];
		$this->tanggal_koreksi->AdvancedSearch->SearchOperator2 = @$filter["w_tanggal_koreksi"];
		$this->tanggal_koreksi->AdvancedSearch->Save();

		// Field sales_id
		$this->sales_id->AdvancedSearch->SearchValue = @$filter["x_sales_id"];
		$this->sales_id->AdvancedSearch->SearchOperator = @$filter["z_sales_id"];
		$this->sales_id->AdvancedSearch->SearchCondition = @$filter["v_sales_id"];
		$this->sales_id->AdvancedSearch->SearchValue2 = @$filter["y_sales_id"];
		$this->sales_id->AdvancedSearch->SearchOperator2 = @$filter["w_sales_id"];
		$this->sales_id->AdvancedSearch->Save();

		// Field sopir
		$this->sopir->AdvancedSearch->SearchValue = @$filter["x_sopir"];
		$this->sopir->AdvancedSearch->SearchOperator = @$filter["z_sopir"];
		$this->sopir->AdvancedSearch->SearchCondition = @$filter["v_sopir"];
		$this->sopir->AdvancedSearch->SearchValue2 = @$filter["y_sopir"];
		$this->sopir->AdvancedSearch->SearchOperator2 = @$filter["w_sopir"];
		$this->sopir->AdvancedSearch->Save();

		// Field no_mobil
		$this->no_mobil->AdvancedSearch->SearchValue = @$filter["x_no_mobil"];
		$this->no_mobil->AdvancedSearch->SearchOperator = @$filter["z_no_mobil"];
		$this->no_mobil->AdvancedSearch->SearchCondition = @$filter["v_no_mobil"];
		$this->no_mobil->AdvancedSearch->SearchValue2 = @$filter["y_no_mobil"];
		$this->no_mobil->AdvancedSearch->SearchOperator2 = @$filter["w_no_mobil"];
		$this->no_mobil->AdvancedSearch->Save();

		// Field kode_depo
		$this->kode_depo->AdvancedSearch->SearchValue = @$filter["x_kode_depo"];
		$this->kode_depo->AdvancedSearch->SearchOperator = @$filter["z_kode_depo"];
		$this->kode_depo->AdvancedSearch->SearchCondition = @$filter["v_kode_depo"];
		$this->kode_depo->AdvancedSearch->SearchValue2 = @$filter["y_kode_depo"];
		$this->kode_depo->AdvancedSearch->SearchOperator2 = @$filter["w_kode_depo"];
		$this->kode_depo->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->inv_number, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->customer_name, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->address1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->address2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->address3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->sopir, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->no_mobil, $arKeywords, $type);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSQL(&$Where, &$Fld, $arKeywords, $type) {
		global $EW_BASIC_SEARCH_IGNORE_PATTERN;
		$sDefCond = ($type == "OR") ? "OR" : "AND";
		$arSQL = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$Keyword = $arKeywords[$i];
			$Keyword = trim($Keyword);
			if ($EW_BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$Keyword = preg_replace($EW_BASIC_SEARCH_IGNORE_PATTERN, "\\", $Keyword);
				$ar = explode("\\", $Keyword);
			} else {
				$ar = array($Keyword);
			}
			foreach ($ar as $Keyword) {
				if ($Keyword <> "") {
					$sWrk = "";
					if ($Keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j-1] = "OR";
					} elseif ($Keyword == EW_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NULL";
					} elseif ($Keyword == EW_NOT_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NOT NULL";
					} elseif ($Fld->FldIsVirtual) {
						$sWrk = $Fld->FldVirtualExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					} elseif ($Fld->FldDataType != EW_DATATYPE_NUMBER || is_numeric($Keyword)) {
						$sWrk = $Fld->FldBasicSearchExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					}
					if ($sWrk <> "") {
						$arSQL[$j] = $sWrk;
						$arCond[$j] = $sDefCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSQL);
		$bQuoted = FALSE;
		$sSql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt-1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$bQuoted) $sSql .= "(";
					$bQuoted = TRUE;
				}
				$sSql .= $arSQL[$i];
				if ($bQuoted && $arCond[$i] <> "OR") {
					$sSql .= ")";
					$bQuoted = FALSE;
				}
				$sSql .= " " . $arCond[$i] . " ";
			}
			$sSql .= $arSQL[$cnt-1];
			if ($bQuoted)
				$sSql .= ")";
		}
		if ($sSql <> "") {
			if ($Where <> "") $Where .= " OR ";
			$Where .= "(" . $sSql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere($Default = FALSE) {
		global $Security;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = ($Default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$sSearchType = ($Default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($sSearchKeyword <> "") {
			$ar = $this->BasicSearch->KeywordList($Default);

			// Search keyword in any fields
			if (($sSearchType == "OR" || $sSearchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $sKeyword) {
					if ($sKeyword <> "") {
						if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
						$sSearchStr .= "(" . $this->BasicSearchSQL(array($sKeyword), $sSearchType) . ")";
					}
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($ar, $sSearchType);
			}
			if (!$Default && in_array($this->Command, array("", "reset", "resetall"))) $this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();
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
				$this->inv_number->setSort("DESC");
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

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

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

		// "detail_tr_inv_item"
		$item = &$this->ListOptions->Add("detail_tr_inv_item");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'tr_inv_item') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["tr_inv_item_grid"])) $GLOBALS["tr_inv_item_grid"] = new ctr_inv_item_grid;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->Add("details");
			$item->CssClass = "text-nowrap";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = TRUE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new cSubPages();
		$pages->Add("tr_inv_item");
		$this->DetailPages = $pages;

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
			$oListOpt->Body = "<a class=\"ewRowLink ewDelete\"" . " onclick=\"return ew_ConfirmDelete(this);\"" . " title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("DeleteLink") . "</a>";
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
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_tr_inv_item"
		$oListOpt = &$this->ListOptions->Items["detail_tr_inv_item"];
		if ($Security->AllowList(CurrentProjectID() . 'tr_inv_item')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("tr_inv_item", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->tr_inv_item_Count, $Language->Phrase("DetailCount"));
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("tr_inv_itemlist.php?" . EW_TABLE_SHOW_MASTER . "=tr_inv_master&fk_inv_id=" . urlencode(strval($this->inv_id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["tr_inv_item_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 'tr_inv_item')) {
				$caption = $Language->Phrase("MasterDetailEditLink");
				$url = $this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=tr_inv_item");
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . ew_HtmlImageAndText($caption) . "</a></li>";
				if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
				$DetailEditTblVar .= "tr_inv_item";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group\">" . $body . "</div>";
			$oListOpt->Body = $body;
			if ($this->ShowMultipleDetails) $oListOpt->Visible = FALSE;
		}
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
			$oListOpt = &$this->ListOptions->Items["details"];
			$oListOpt->Body = $body;
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->inv_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
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
		$option = $options["detail"];
		$DetailTableLink = "";
		$item = &$option->Add("detailadd_tr_inv_item");
		$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=tr_inv_item");
		$caption = $Language->Phrase("Add") . "&nbsp;" . $this->TableCaption() . "/" . $GLOBALS["tr_inv_item"]->TableCaption();
		$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["tr_inv_item"]->DetailAdd && $Security->AllowAdd(CurrentProjectID() . 'tr_inv_item') && $Security->CanAdd());
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "tr_inv_item";
		}

		// Add multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$option->Add("detailsadd");
			$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailTableLink);
			$caption = $Language->Phrase("AddMasterDetailLink");
			$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
			$item->Visible = ($DetailTableLink <> "" && $Security->CanAdd());

			// Hide single master/detail items
			$ar = explode(",", $DetailTableLink);
			$cnt = count($ar);
			for ($i = 0; $i < $cnt; $i++) {
				if ($item = &$option->GetItem("detailadd_" . $ar[$i]))
					$item->Visible = FALSE;
			}
		}
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ftr_inv_masterlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ftr_inv_masterlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
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
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ftr_inv_masterlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : "";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ftr_inv_masterlistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

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
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
		$links = "";
		$btngrps = "";
		$sSqlWrk = "`master_id`=" . ew_AdjustSql($this->inv_id->CurrentValue, $this->DBID) . "";

		// Column "detail_tr_inv_item"
		if ($this->DetailPages->Items["tr_inv_item"]->Visible) {
			$link = "";
			$option = &$this->ListOptions->Items["detail_tr_inv_item"];
			$url = "tr_inv_itempreview.php?t=tr_inv_master&f=" . ew_Encrypt($sSqlWrk);
			$btngrp = "<div data-table=\"tr_inv_item\" data-url=\"" . $url . "\" class=\"btn-group\">";
			if ($Security->AllowList(CurrentProjectID() . 'tr_inv_item')) {
				$label = $Language->TablePhrase("tr_inv_item", "TblCaption");
				$label .= "&nbsp;" . ew_JsEncode2(str_replace("%c", $this->tr_inv_item_Count, $Language->Phrase("DetailCount")));
				$link = "<li><a href=\"#\" data-toggle=\"tab\" data-table=\"tr_inv_item\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = ew_JsEncode3("tr_inv_itemlist.php?" . EW_TABLE_SHOW_MASTER . "=tr_inv_master&fk_inv_id=" . urlencode(strval($this->inv_id->CurrentValue)) . "");
				$btngrp .= "<button type=\"button\" class=\"btn btn-default btn-sm\" title=\"" . $Language->TablePhrase("tr_inv_item", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "'\">" . $Language->Phrase("MasterDetailListLink") . "</button>";
			}
			if ($GLOBALS["tr_inv_item_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 'tr_inv_item')) {
				$caption = $Language->Phrase("MasterDetailViewLink");
				$url = $this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=tr_inv_item");
				$btngrp .= "<button type=\"button\" class=\"btn btn-default btn-sm\" title=\"" . ew_HtmlTitle($caption) . "\" onclick=\"window.location='" . ew_HtmlEncode($url) . "'\">" . $caption . "</button>";
			}
			if ($GLOBALS["tr_inv_item_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 'tr_inv_item')) {
				$caption = $Language->Phrase("MasterDetailEditLink");
				$url = $this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=tr_inv_item");
				$btngrp .= "<button type=\"button\" class=\"btn btn-default btn-sm\" title=\"" . ew_HtmlTitle($caption) . "\" onclick=\"window.location='" . ew_HtmlEncode($url) . "'\">" . $caption . "</button>";
			}
			$btngrp .= "</div>";
			if ($link <> "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"hide ewPreview\">" . $link . $btngrp . "</div>";
			}
		}

		// Column "details" (Multiple details)
		$option = &$this->ListOptions->GetItem("details");
		if ($option) {
			$option->Body .= "<div class=\"hide ewPreview\">" . $links . $btngrps . "</div>";
			if ($option->Visible) $option->Visible = $links <> "";
		}
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

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
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
		$this->inv_id->setDbValue($row['inv_id']);
		$this->inv_number->setDbValue($row['inv_number']);
		$this->inv_date->setDbValue($row['inv_date']);
		$this->tax_type->setDbValue($row['tax_type']);
		$this->due_date->setDbValue($row['due_date']);
		$this->customer_id->setDbValue($row['customer_id']);
		$this->customer_name->setDbValue($row['customer_name']);
		$this->address1->setDbValue($row['address1']);
		$this->address2->setDbValue($row['address2']);
		$this->address3->setDbValue($row['address3']);
		$this->wilayah_id->setDbValue($row['wilayah_id']);
		$this->subwil_id->setDbValue($row['subwil_id']);
		$this->area_id->setDbValue($row['area_id']);
		$this->tax_number->setDbValue($row['tax_number']);
		$this->tc_number->setDbValue($row['tc_number']);
		$this->inv_amt->setDbValue($row['inv_amt']);
		$this->discount->setDbValue($row['discount']);
		$this->total_discount->setDbValue($row['total_discount']);
		$this->is_tax->setDbValue($row['is_tax']);
		$this->tax_total->setDbValue($row['tax_total']);
		$this->inv_total->setDbValue($row['inv_total']);
		$this->paid_amt->setDbValue($row['paid_amt']);
		$this->user_id->setDbValue($row['user_id']);
		$this->lastupdate->setDbValue($row['lastupdate']);
		$this->koreksi->setDbValue($row['koreksi']);
		$this->tanggal_koreksi->setDbValue($row['tanggal_koreksi']);
		$this->sales_id->setDbValue($row['sales_id']);
		$this->sopir->setDbValue($row['sopir']);
		$this->no_mobil->setDbValue($row['no_mobil']);
		$this->kode_depo->setDbValue($row['kode_depo']);
		$this->paid->setDbValue($row['paid']);
		if (!isset($GLOBALS["tr_inv_item_grid"])) $GLOBALS["tr_inv_item_grid"] = new ctr_inv_item_grid;
		$sDetailFilter = $GLOBALS["tr_inv_item"]->SqlDetailFilter_tr_inv_master();
		$sDetailFilter = str_replace("@master_id@", ew_AdjustSql($this->inv_id->DbValue, "DB"), $sDetailFilter);
		$GLOBALS["tr_inv_item"]->setCurrentMasterTable("tr_inv_master");
		$sDetailFilter = $GLOBALS["tr_inv_item"]->ApplyUserIDFilters($sDetailFilter);
		$this->tr_inv_item_Count = $GLOBALS["tr_inv_item"]->LoadRecordCount($sDetailFilter);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['inv_id'] = NULL;
		$row['inv_number'] = NULL;
		$row['inv_date'] = NULL;
		$row['tax_type'] = NULL;
		$row['due_date'] = NULL;
		$row['customer_id'] = NULL;
		$row['customer_name'] = NULL;
		$row['address1'] = NULL;
		$row['address2'] = NULL;
		$row['address3'] = NULL;
		$row['wilayah_id'] = NULL;
		$row['subwil_id'] = NULL;
		$row['area_id'] = NULL;
		$row['tax_number'] = NULL;
		$row['tc_number'] = NULL;
		$row['inv_amt'] = NULL;
		$row['discount'] = NULL;
		$row['total_discount'] = NULL;
		$row['is_tax'] = NULL;
		$row['tax_total'] = NULL;
		$row['inv_total'] = NULL;
		$row['paid_amt'] = NULL;
		$row['user_id'] = NULL;
		$row['lastupdate'] = NULL;
		$row['koreksi'] = NULL;
		$row['tanggal_koreksi'] = NULL;
		$row['sales_id'] = NULL;
		$row['sopir'] = NULL;
		$row['no_mobil'] = NULL;
		$row['kode_depo'] = NULL;
		$row['paid'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->inv_id->DbValue = $row['inv_id'];
		$this->inv_number->DbValue = $row['inv_number'];
		$this->inv_date->DbValue = $row['inv_date'];
		$this->tax_type->DbValue = $row['tax_type'];
		$this->due_date->DbValue = $row['due_date'];
		$this->customer_id->DbValue = $row['customer_id'];
		$this->customer_name->DbValue = $row['customer_name'];
		$this->address1->DbValue = $row['address1'];
		$this->address2->DbValue = $row['address2'];
		$this->address3->DbValue = $row['address3'];
		$this->wilayah_id->DbValue = $row['wilayah_id'];
		$this->subwil_id->DbValue = $row['subwil_id'];
		$this->area_id->DbValue = $row['area_id'];
		$this->tax_number->DbValue = $row['tax_number'];
		$this->tc_number->DbValue = $row['tc_number'];
		$this->inv_amt->DbValue = $row['inv_amt'];
		$this->discount->DbValue = $row['discount'];
		$this->total_discount->DbValue = $row['total_discount'];
		$this->is_tax->DbValue = $row['is_tax'];
		$this->tax_total->DbValue = $row['tax_total'];
		$this->inv_total->DbValue = $row['inv_total'];
		$this->paid_amt->DbValue = $row['paid_amt'];
		$this->user_id->DbValue = $row['user_id'];
		$this->lastupdate->DbValue = $row['lastupdate'];
		$this->koreksi->DbValue = $row['koreksi'];
		$this->tanggal_koreksi->DbValue = $row['tanggal_koreksi'];
		$this->sales_id->DbValue = $row['sales_id'];
		$this->sopir->DbValue = $row['sopir'];
		$this->no_mobil->DbValue = $row['no_mobil'];
		$this->kode_depo->DbValue = $row['kode_depo'];
		$this->paid->DbValue = $row['paid'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("inv_id")) <> "")
			$this->inv_id->CurrentValue = $this->getKey("inv_id"); // inv_id
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
		if ($this->inv_total->FormValue == $this->inv_total->CurrentValue && is_numeric(ew_StrToFloat($this->inv_total->CurrentValue)))
			$this->inv_total->CurrentValue = ew_StrToFloat($this->inv_total->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// inv_id
		// inv_number
		// inv_date
		// tax_type
		// due_date
		// customer_id
		// customer_name
		// address1
		// address2
		// address3
		// wilayah_id
		// subwil_id
		// area_id
		// tax_number
		// tc_number
		// inv_amt
		// discount
		// total_discount
		// is_tax
		// tax_total
		// inv_total
		// paid_amt
		// user_id
		// lastupdate
		// koreksi
		// tanggal_koreksi
		// sales_id
		// sopir
		// no_mobil
		// kode_depo
		// paid

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// inv_id
		$this->inv_id->ViewValue = $this->inv_id->CurrentValue;
		$this->inv_id->ViewCustomAttributes = "";

		// inv_number
		$this->inv_number->ViewValue = $this->inv_number->CurrentValue;
		$this->inv_number->CellCssStyle .= "text-align: center;";
		$this->inv_number->ViewCustomAttributes = "";

		// inv_date
		$this->inv_date->ViewValue = $this->inv_date->CurrentValue;
		$this->inv_date->ViewValue = ew_FormatDateTime($this->inv_date->ViewValue, 7);
		$this->inv_date->CellCssStyle .= "text-align: center;";
		$this->inv_date->ViewCustomAttributes = "";

		// tax_type
		if (strval($this->tax_type->CurrentValue) <> "") {
			$this->tax_type->ViewValue = $this->tax_type->OptionCaption($this->tax_type->CurrentValue);
		} else {
			$this->tax_type->ViewValue = NULL;
		}
		$this->tax_type->ViewCustomAttributes = "";

		// due_date
		$this->due_date->ViewValue = $this->due_date->CurrentValue;
		$this->due_date->ViewValue = ew_FormatDateTime($this->due_date->ViewValue, 0);
		$this->due_date->ViewCustomAttributes = "";

		// customer_id
		$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
		if (strval($this->customer_id->CurrentValue) <> "") {
			$sFilterWrk = "`customer_id`" . ew_SearchString("=", $this->customer_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `customer_id`, `customer_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_customer`";
		$sWhereWrk = "";
		$this->customer_id->LookupFilters = array();
		$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->customer_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `customer_name`";
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

		// address1
		$this->address1->ViewValue = $this->address1->CurrentValue;
		$this->address1->ViewCustomAttributes = "";

		// address2
		$this->address2->ViewValue = $this->address2->CurrentValue;
		$this->address2->ViewCustomAttributes = "";

		// address3
		$this->address3->ViewValue = $this->address3->CurrentValue;
		$this->address3->ViewCustomAttributes = "";

		// wilayah_id
		if (strval($this->wilayah_id->CurrentValue) <> "") {
			$sFilterWrk = "`wilayah_id`" . ew_SearchString("=", $this->wilayah_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `wilayah_id`, `nama_wilayah` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_wilayah`";
		$sWhereWrk = "";
		$this->wilayah_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->wilayah_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `nama_wilayah`";
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->wilayah_id->ViewValue = $this->wilayah_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->wilayah_id->ViewValue = $this->wilayah_id->CurrentValue;
			}
		} else {
			$this->wilayah_id->ViewValue = NULL;
		}
		$this->wilayah_id->CellCssStyle .= "text-align: left;";
		$this->wilayah_id->ViewCustomAttributes = "";

		// subwil_id
		if (strval($this->subwil_id->CurrentValue) <> "") {
			$sFilterWrk = "`sub_id`" . ew_SearchString("=", $this->subwil_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `sub_id`, `nama_sub_wilayah` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_subwilayah`";
		$sWhereWrk = "";
		$this->subwil_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->subwil_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `nama_sub_wilayah`";
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->subwil_id->ViewValue = $this->subwil_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->subwil_id->ViewValue = $this->subwil_id->CurrentValue;
			}
		} else {
			$this->subwil_id->ViewValue = NULL;
		}
		$this->subwil_id->CellCssStyle .= "text-align: left;";
		$this->subwil_id->ViewCustomAttributes = "";

		// area_id
		if (strval($this->area_id->CurrentValue) <> "") {
			$sFilterWrk = "`area_id`" . ew_SearchString("=", $this->area_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `area_id`, `area_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_callarea`";
		$sWhereWrk = "";
		$this->area_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->area_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->area_id->ViewValue = $this->area_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->area_id->ViewValue = $this->area_id->CurrentValue;
			}
		} else {
			$this->area_id->ViewValue = NULL;
		}
		$this->area_id->CellCssStyle .= "text-align: left;";
		$this->area_id->ViewCustomAttributes = "";

		// tax_number
		$this->tax_number->ViewValue = $this->tax_number->CurrentValue;
		$this->tax_number->CellCssStyle .= "text-align: center;";
		$this->tax_number->ViewCustomAttributes = "";

		// tc_number
		$this->tc_number->ViewValue = $this->tc_number->CurrentValue;
		$this->tc_number->CellCssStyle .= "text-align: center;";
		$this->tc_number->ViewCustomAttributes = "";

		// inv_amt
		$this->inv_amt->ViewValue = $this->inv_amt->CurrentValue;
		$this->inv_amt->ViewValue = ew_FormatNumber($this->inv_amt->ViewValue, 2, -2, -2, -2);
		$this->inv_amt->CellCssStyle .= "text-align: right;";
		$this->inv_amt->ViewCustomAttributes = "";

		// discount
		$this->discount->ViewValue = $this->discount->CurrentValue;
		$this->discount->ViewValue = ew_FormatPercent($this->discount->ViewValue, 0, -2, -2, -2);
		$this->discount->CellCssStyle .= "text-align: right;";
		$this->discount->ViewCustomAttributes = "";

		// total_discount
		$this->total_discount->ViewValue = $this->total_discount->CurrentValue;
		$this->total_discount->ViewValue = ew_FormatNumber($this->total_discount->ViewValue, 2, -2, -2, -2);
		$this->total_discount->CellCssStyle .= "text-align: right;";
		$this->total_discount->ViewCustomAttributes = "";

		// tax_total
		$this->tax_total->ViewValue = $this->tax_total->CurrentValue;
		$this->tax_total->ViewValue = ew_FormatNumber($this->tax_total->ViewValue, 2, -2, -2, -2);
		$this->tax_total->CellCssStyle .= "text-align: right;";
		$this->tax_total->ViewCustomAttributes = "";

		// inv_total
		$this->inv_total->ViewValue = $this->inv_total->CurrentValue;
		$this->inv_total->ViewValue = ew_FormatNumber($this->inv_total->ViewValue, 2, -2, -2, -2);
		$this->inv_total->CellCssStyle .= "text-align: right;";
		$this->inv_total->ViewCustomAttributes = "";

		// paid_amt
		$this->paid_amt->ViewValue = $this->paid_amt->CurrentValue;
		$this->paid_amt->ViewValue = ew_FormatNumber($this->paid_amt->ViewValue, 0, -2, -2, -2);
		$this->paid_amt->CellCssStyle .= "text-align: justify;";
		$this->paid_amt->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// lastupdate
		$this->lastupdate->ViewValue = $this->lastupdate->CurrentValue;
		$this->lastupdate->ViewValue = ew_FormatDateTime($this->lastupdate->ViewValue, 0);
		$this->lastupdate->ViewCustomAttributes = "";

		// koreksi
		$this->koreksi->ViewValue = $this->koreksi->CurrentValue;
		$this->koreksi->ViewCustomAttributes = "";

		// tanggal_koreksi
		$this->tanggal_koreksi->ViewValue = $this->tanggal_koreksi->CurrentValue;
		$this->tanggal_koreksi->ViewValue = ew_FormatDateTime($this->tanggal_koreksi->ViewValue, 0);
		$this->tanggal_koreksi->ViewCustomAttributes = "";

		// sales_id
		if (strval($this->sales_id->CurrentValue) <> "") {
			$sFilterWrk = "`sales_id`" . ew_SearchString("=", $this->sales_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `sales_id`, `sales_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_salesman`";
		$sWhereWrk = "";
		$this->sales_id->LookupFilters = array();
		$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->sales_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `sales_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->sales_id->ViewValue = $this->sales_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->sales_id->ViewValue = $this->sales_id->CurrentValue;
			}
		} else {
			$this->sales_id->ViewValue = NULL;
		}
		$this->sales_id->ViewCustomAttributes = "";

		// sopir
		$this->sopir->ViewValue = $this->sopir->CurrentValue;
		$this->sopir->ViewCustomAttributes = "";

		// no_mobil
		$this->no_mobil->ViewValue = $this->no_mobil->CurrentValue;
		$this->no_mobil->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// paid
		if (ew_ConvertToBool($this->paid->CurrentValue)) {
			$this->paid->ViewValue = $this->paid->FldTagCaption(1) <> "" ? $this->paid->FldTagCaption(1) : "1";
		} else {
			$this->paid->ViewValue = $this->paid->FldTagCaption(2) <> "" ? $this->paid->FldTagCaption(2) : "0";
		}
		$this->paid->CellCssStyle .= "text-align: center;";
		$this->paid->ViewCustomAttributes = "";

			// inv_number
			$this->inv_number->LinkCustomAttributes = "";
			$this->inv_number->HrefValue = "";
			$this->inv_number->TooltipValue = "";

			// inv_date
			$this->inv_date->LinkCustomAttributes = "";
			$this->inv_date->HrefValue = "";
			$this->inv_date->TooltipValue = "";

			// due_date
			$this->due_date->LinkCustomAttributes = "";
			$this->due_date->HrefValue = "";
			$this->due_date->TooltipValue = "";

			// customer_id
			$this->customer_id->LinkCustomAttributes = "";
			$this->customer_id->HrefValue = "";
			$this->customer_id->TooltipValue = "";

			// area_id
			$this->area_id->LinkCustomAttributes = "";
			$this->area_id->HrefValue = "";
			$this->area_id->TooltipValue = "";

			// inv_total
			$this->inv_total->LinkCustomAttributes = "";
			$this->inv_total->HrefValue = "";
			$this->inv_total->TooltipValue = "";

			// sales_id
			$this->sales_id->LinkCustomAttributes = "";
			$this->sales_id->HrefValue = "";
			$this->sales_id->TooltipValue = "";

			// paid
			$this->paid->LinkCustomAttributes = "";
			$this->paid->HrefValue = "";
			$this->paid->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
		$item->Body = "<button id=\"emf_tr_inv_master\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_tr_inv_master',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.ftr_inv_masterlist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		Language()->setFieldPhrase(CurrentTable()->TableName, "inv_number", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Faktur#</div>");	
		Language()->setFieldPhrase(CurrentTable()->TableName, "inv_date", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Tanggal</div>");
		Language()->setFieldPhrase(CurrentTable()->TableName, "due_date", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Jt. Tempo</div>");
		Language()->setFieldPhrase(CurrentTable()->TableName, "customer_id", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Nama Outlet</div>");
		Language()->setFieldPhrase(CurrentTable()->TableName, "area_id", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Call Area</div>");
		Language()->setFieldPhrase(CurrentTable()->TableName, "inv_total", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Total Faktur</div>");
		Language()->setFieldPhrase(CurrentTable()->TableName, "sales_id", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Salesman</div>");	
		Language()->setFieldPhrase(CurrentTable()->TableName, "paid", "fldcaption", "<div class='ewTableHeaderCaptio' style='text-align: center'>Paid</div>");
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

		//echo "Mematikan tombol Add New Record";
		$this->OtherOptions["addedit"]->Items["add"]->Visible = FALSE;
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
		$GLOBALS["tr_inv_item_grid"]->DetailAdd = FALSE; // Set to TRUE or FALSE conditionally
		$GLOBALS["tr_inv_item_grid"]->DetailEdit = FALSE; // Set to TRUE or FALSE conditionally
		$GLOBALS["tr_inv_item_grid"]->DetailView = FALSE; // Set to TRUE or FALSE conditionally
	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

		$this->ListOptions->Items["edit"]->Body = "<a href=tr_inv_masteredit.php?showdetail=tr_inv_item&inv_id=". $this->inv_id->CurrentValue . "><img src='phpimages/btn_edit.jpg' border='0'></a>";
		$this->ListOptions->Items["delete"]->Body = "<a href=tr_inv_masterdelete.php?showdetail=tr_inv_item&inv_id=". $this->inv_id->CurrentValue . "><img src='phpimages/btn_deletes.jpg' border='0'></a>";
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
if (!isset($tr_inv_master_list)) $tr_inv_master_list = new ctr_inv_master_list();

// Page init
$tr_inv_master_list->Page_Init();

// Page main
$tr_inv_master_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_inv_master_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($tr_inv_master->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ftr_inv_masterlist = new ew_Form("ftr_inv_masterlist", "list");
ftr_inv_masterlist.FormKeyCountName = '<?php echo $tr_inv_master_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftr_inv_masterlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_inv_masterlist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_inv_masterlist.Lists["x_customer_id"] = {"LinkField":"x_customer_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_customer_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_customer"};
ftr_inv_masterlist.Lists["x_customer_id"].Data = "<?php echo $tr_inv_master_list->customer_id->LookupFilterQuery(FALSE, "list") ?>";
ftr_inv_masterlist.AutoSuggests["x_customer_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $tr_inv_master_list->customer_id->LookupFilterQuery(TRUE, "list"))) ?>;
ftr_inv_masterlist.Lists["x_area_id"] = {"LinkField":"x_area_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_area_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_callarea"};
ftr_inv_masterlist.Lists["x_area_id"].Data = "<?php echo $tr_inv_master_list->area_id->LookupFilterQuery(FALSE, "list") ?>";
ftr_inv_masterlist.Lists["x_sales_id"] = {"LinkField":"x_sales_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_sales_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_salesman"};
ftr_inv_masterlist.Lists["x_sales_id"].Data = "<?php echo $tr_inv_master_list->sales_id->LookupFilterQuery(FALSE, "list") ?>";
ftr_inv_masterlist.Lists["x_paid[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftr_inv_masterlist.Lists["x_paid[]"].Options = <?php echo json_encode($tr_inv_master_list->paid->Options()) ?>;

// Form object for search
var CurrentSearchForm = ftr_inv_masterlistsrch = new ew_Form("ftr_inv_masterlistsrch");

// Init search panel as collapsed
if (ftr_inv_masterlistsrch) ftr_inv_masterlistsrch.InitSearchPanel = true;
</script>
<style type="text/css">
.ewTablePreviewRow { /* main table preview row color */
	background-color: #808080; /* preview row color */
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
var EW_PREVIEW_OVERLAY = true;
</script>
<script type="text/javascript" src="phpjs/ewscrolltable.js"></script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($tr_inv_master->Export == "") { ?>
<div class="ewToolbar">
<?php if ($tr_inv_master_list->TotalRecs > 0 && $tr_inv_master_list->ExportOptions->Visible()) { ?>
<?php $tr_inv_master_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($tr_inv_master_list->SearchOptions->Visible()) { ?>
<?php $tr_inv_master_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($tr_inv_master_list->FilterOptions->Visible()) { ?>
<?php $tr_inv_master_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $tr_inv_master_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($tr_inv_master_list->TotalRecs <= 0)
			$tr_inv_master_list->TotalRecs = $tr_inv_master->ListRecordCount();
	} else {
		if (!$tr_inv_master_list->Recordset && ($tr_inv_master_list->Recordset = $tr_inv_master_list->LoadRecordset()))
			$tr_inv_master_list->TotalRecs = $tr_inv_master_list->Recordset->RecordCount();
	}
	$tr_inv_master_list->StartRec = 1;
	if ($tr_inv_master_list->DisplayRecs <= 0 || ($tr_inv_master->Export <> "" && $tr_inv_master->ExportAll)) // Display all records
		$tr_inv_master_list->DisplayRecs = $tr_inv_master_list->TotalRecs;
	if (!($tr_inv_master->Export <> "" && $tr_inv_master->ExportAll))
		$tr_inv_master_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$tr_inv_master_list->Recordset = $tr_inv_master_list->LoadRecordset($tr_inv_master_list->StartRec-1, $tr_inv_master_list->DisplayRecs);

	// Set no record found message
	if ($tr_inv_master->CurrentAction == "" && $tr_inv_master_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$tr_inv_master_list->setWarningMessage(ew_DeniedMsg());
		if ($tr_inv_master_list->SearchWhere == "0=101")
			$tr_inv_master_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$tr_inv_master_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$tr_inv_master_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($tr_inv_master->Export == "" && $tr_inv_master->CurrentAction == "") { ?>
<form name="ftr_inv_masterlistsrch" id="ftr_inv_masterlistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($tr_inv_master_list->SearchWhere <> "") ? " in" : ""; ?>
<div id="ftr_inv_masterlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tr_inv_master">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($tr_inv_master_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($tr_inv_master_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $tr_inv_master_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($tr_inv_master_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($tr_inv_master_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($tr_inv_master_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($tr_inv_master_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tr_inv_master_list->ShowPageHeader(); ?>
<?php
$tr_inv_master_list->ShowMessage();
?>
<?php if ($tr_inv_master_list->TotalRecs > 0 || $tr_inv_master->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($tr_inv_master_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> tr_inv_master">
<?php if ($tr_inv_master->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($tr_inv_master->CurrentAction <> "gridadd" && $tr_inv_master->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($tr_inv_master_list->Pager)) $tr_inv_master_list->Pager = new cPrevNextPager($tr_inv_master_list->StartRec, $tr_inv_master_list->DisplayRecs, $tr_inv_master_list->TotalRecs, $tr_inv_master_list->AutoHidePager) ?>
<?php if ($tr_inv_master_list->Pager->RecordCount > 0 && $tr_inv_master_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($tr_inv_master_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $tr_inv_master_list->PageUrl() ?>start=<?php echo $tr_inv_master_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tr_inv_master_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $tr_inv_master_list->PageUrl() ?>start=<?php echo $tr_inv_master_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tr_inv_master_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($tr_inv_master_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $tr_inv_master_list->PageUrl() ?>start=<?php echo $tr_inv_master_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tr_inv_master_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $tr_inv_master_list->PageUrl() ?>start=<?php echo $tr_inv_master_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tr_inv_master_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($tr_inv_master_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tr_inv_master_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tr_inv_master_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tr_inv_master_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tr_inv_master_list->TotalRecs > 0 && (!$tr_inv_master_list->AutoHidePageSizeSelector || $tr_inv_master_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="tr_inv_master">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($tr_inv_master_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($tr_inv_master_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tr_inv_master_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tr_inv_master_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="ALL"<?php if ($tr_inv_master->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($tr_inv_master_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftr_inv_masterlist" id="ftr_inv_masterlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_inv_master_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_inv_master_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_inv_master">
<div id="gmp_tr_inv_master" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($tr_inv_master_list->TotalRecs > 0 || $tr_inv_master->CurrentAction == "gridedit") { ?>
<table id="tbl_tr_inv_masterlist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$tr_inv_master_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$tr_inv_master_list->RenderListOptions();

// Render list options (header, left)
$tr_inv_master_list->ListOptions->Render("header", "left");
?>
<?php if ($tr_inv_master->inv_number->Visible) { // inv_number ?>
	<?php if ($tr_inv_master->SortUrl($tr_inv_master->inv_number) == "") { ?>
		<th data-name="inv_number" class="<?php echo $tr_inv_master->inv_number->HeaderCellClass() ?>"><div id="elh_tr_inv_master_inv_number" class="tr_inv_master_inv_number"><div class="ewTableHeaderCaption"><?php echo $tr_inv_master->inv_number->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inv_number" class="<?php echo $tr_inv_master->inv_number->HeaderCellClass() ?>"><div><div id="elh_tr_inv_master_inv_number" class="tr_inv_master_inv_number">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_master->inv_number->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_master->inv_number->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_master->inv_number->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_master->inv_date->Visible) { // inv_date ?>
	<?php if ($tr_inv_master->SortUrl($tr_inv_master->inv_date) == "") { ?>
		<th data-name="inv_date" class="<?php echo $tr_inv_master->inv_date->HeaderCellClass() ?>"><div id="elh_tr_inv_master_inv_date" class="tr_inv_master_inv_date"><div class="ewTableHeaderCaption"><?php echo $tr_inv_master->inv_date->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inv_date" class="<?php echo $tr_inv_master->inv_date->HeaderCellClass() ?>"><div><div id="elh_tr_inv_master_inv_date" class="tr_inv_master_inv_date">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_master->inv_date->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_master->inv_date->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_master->inv_date->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_master->due_date->Visible) { // due_date ?>
	<?php if ($tr_inv_master->SortUrl($tr_inv_master->due_date) == "") { ?>
		<th data-name="due_date" class="<?php echo $tr_inv_master->due_date->HeaderCellClass() ?>"><div id="elh_tr_inv_master_due_date" class="tr_inv_master_due_date"><div class="ewTableHeaderCaption"><?php echo $tr_inv_master->due_date->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="due_date" class="<?php echo $tr_inv_master->due_date->HeaderCellClass() ?>"><div><div id="elh_tr_inv_master_due_date" class="tr_inv_master_due_date">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_master->due_date->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_master->due_date->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_master->due_date->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_master->customer_id->Visible) { // customer_id ?>
	<?php if ($tr_inv_master->SortUrl($tr_inv_master->customer_id) == "") { ?>
		<th data-name="customer_id" class="<?php echo $tr_inv_master->customer_id->HeaderCellClass() ?>"><div id="elh_tr_inv_master_customer_id" class="tr_inv_master_customer_id"><div class="ewTableHeaderCaption"><?php echo $tr_inv_master->customer_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_id" class="<?php echo $tr_inv_master->customer_id->HeaderCellClass() ?>"><div><div id="elh_tr_inv_master_customer_id" class="tr_inv_master_customer_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_master->customer_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_master->customer_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_master->customer_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_master->area_id->Visible) { // area_id ?>
	<?php if ($tr_inv_master->SortUrl($tr_inv_master->area_id) == "") { ?>
		<th data-name="area_id" class="<?php echo $tr_inv_master->area_id->HeaderCellClass() ?>"><div id="elh_tr_inv_master_area_id" class="tr_inv_master_area_id"><div class="ewTableHeaderCaption"><?php echo $tr_inv_master->area_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="area_id" class="<?php echo $tr_inv_master->area_id->HeaderCellClass() ?>"><div><div id="elh_tr_inv_master_area_id" class="tr_inv_master_area_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_master->area_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_master->area_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_master->area_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_master->inv_total->Visible) { // inv_total ?>
	<?php if ($tr_inv_master->SortUrl($tr_inv_master->inv_total) == "") { ?>
		<th data-name="inv_total" class="<?php echo $tr_inv_master->inv_total->HeaderCellClass() ?>"><div id="elh_tr_inv_master_inv_total" class="tr_inv_master_inv_total"><div class="ewTableHeaderCaption"><?php echo $tr_inv_master->inv_total->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inv_total" class="<?php echo $tr_inv_master->inv_total->HeaderCellClass() ?>"><div><div id="elh_tr_inv_master_inv_total" class="tr_inv_master_inv_total">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_master->inv_total->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_master->inv_total->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_master->inv_total->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_master->sales_id->Visible) { // sales_id ?>
	<?php if ($tr_inv_master->SortUrl($tr_inv_master->sales_id) == "") { ?>
		<th data-name="sales_id" class="<?php echo $tr_inv_master->sales_id->HeaderCellClass() ?>"><div id="elh_tr_inv_master_sales_id" class="tr_inv_master_sales_id"><div class="ewTableHeaderCaption"><?php echo $tr_inv_master->sales_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sales_id" class="<?php echo $tr_inv_master->sales_id->HeaderCellClass() ?>"><div><div id="elh_tr_inv_master_sales_id" class="tr_inv_master_sales_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_master->sales_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_master->sales_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_master->sales_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_master->paid->Visible) { // paid ?>
	<?php if ($tr_inv_master->SortUrl($tr_inv_master->paid) == "") { ?>
		<th data-name="paid" class="<?php echo $tr_inv_master->paid->HeaderCellClass() ?>"><div id="elh_tr_inv_master_paid" class="tr_inv_master_paid"><div class="ewTableHeaderCaption"><?php echo $tr_inv_master->paid->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="paid" class="<?php echo $tr_inv_master->paid->HeaderCellClass() ?>"><div><div id="elh_tr_inv_master_paid" class="tr_inv_master_paid">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_master->paid->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_master->paid->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_master->paid->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tr_inv_master_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tr_inv_master->ExportAll && $tr_inv_master->Export <> "") {
	$tr_inv_master_list->StopRec = $tr_inv_master_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tr_inv_master_list->TotalRecs > $tr_inv_master_list->StartRec + $tr_inv_master_list->DisplayRecs - 1)
		$tr_inv_master_list->StopRec = $tr_inv_master_list->StartRec + $tr_inv_master_list->DisplayRecs - 1;
	else
		$tr_inv_master_list->StopRec = $tr_inv_master_list->TotalRecs;
}
$tr_inv_master_list->RecCnt = $tr_inv_master_list->StartRec - 1;
if ($tr_inv_master_list->Recordset && !$tr_inv_master_list->Recordset->EOF) {
	$tr_inv_master_list->Recordset->MoveFirst();
	$bSelectLimit = $tr_inv_master_list->UseSelectLimit;
	if (!$bSelectLimit && $tr_inv_master_list->StartRec > 1)
		$tr_inv_master_list->Recordset->Move($tr_inv_master_list->StartRec - 1);
} elseif (!$tr_inv_master->AllowAddDeleteRow && $tr_inv_master_list->StopRec == 0) {
	$tr_inv_master_list->StopRec = $tr_inv_master->GridAddRowCount;
}

// Initialize aggregate
$tr_inv_master->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tr_inv_master->ResetAttrs();
$tr_inv_master_list->RenderRow();
while ($tr_inv_master_list->RecCnt < $tr_inv_master_list->StopRec) {
	$tr_inv_master_list->RecCnt++;
	if (intval($tr_inv_master_list->RecCnt) >= intval($tr_inv_master_list->StartRec)) {
		$tr_inv_master_list->RowCnt++;

		// Set up key count
		$tr_inv_master_list->KeyCount = $tr_inv_master_list->RowIndex;

		// Init row class and style
		$tr_inv_master->ResetAttrs();
		$tr_inv_master->CssClass = "";
		if ($tr_inv_master->CurrentAction == "gridadd") {
		} else {
			$tr_inv_master_list->LoadRowValues($tr_inv_master_list->Recordset); // Load row values
		}
		$tr_inv_master->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tr_inv_master->RowAttrs = array_merge($tr_inv_master->RowAttrs, array('data-rowindex'=>$tr_inv_master_list->RowCnt, 'id'=>'r' . $tr_inv_master_list->RowCnt . '_tr_inv_master', 'data-rowtype'=>$tr_inv_master->RowType));

		// Render row
		$tr_inv_master_list->RenderRow();

		// Render list options
		$tr_inv_master_list->RenderListOptions();
?>
	<tr<?php echo $tr_inv_master->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tr_inv_master_list->ListOptions->Render("body", "left", $tr_inv_master_list->RowCnt);
?>
	<?php if ($tr_inv_master->inv_number->Visible) { // inv_number ?>
		<td data-name="inv_number"<?php echo $tr_inv_master->inv_number->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_master_list->RowCnt ?>_tr_inv_master_inv_number" class="tr_inv_master_inv_number">
<span<?php echo $tr_inv_master->inv_number->ViewAttributes() ?>>
<?php echo $tr_inv_master->inv_number->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tr_inv_master->inv_date->Visible) { // inv_date ?>
		<td data-name="inv_date"<?php echo $tr_inv_master->inv_date->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_master_list->RowCnt ?>_tr_inv_master_inv_date" class="tr_inv_master_inv_date">
<span<?php echo $tr_inv_master->inv_date->ViewAttributes() ?>>
<?php echo $tr_inv_master->inv_date->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tr_inv_master->due_date->Visible) { // due_date ?>
		<td data-name="due_date"<?php echo $tr_inv_master->due_date->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_master_list->RowCnt ?>_tr_inv_master_due_date" class="tr_inv_master_due_date">
<span<?php echo $tr_inv_master->due_date->ViewAttributes() ?>>
<?php echo $tr_inv_master->due_date->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tr_inv_master->customer_id->Visible) { // customer_id ?>
		<td data-name="customer_id"<?php echo $tr_inv_master->customer_id->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_master_list->RowCnt ?>_tr_inv_master_customer_id" class="tr_inv_master_customer_id">
<span<?php echo $tr_inv_master->customer_id->ViewAttributes() ?>>
<?php echo $tr_inv_master->customer_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tr_inv_master->area_id->Visible) { // area_id ?>
		<td data-name="area_id"<?php echo $tr_inv_master->area_id->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_master_list->RowCnt ?>_tr_inv_master_area_id" class="tr_inv_master_area_id">
<span<?php echo $tr_inv_master->area_id->ViewAttributes() ?>>
<?php echo $tr_inv_master->area_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tr_inv_master->inv_total->Visible) { // inv_total ?>
		<td data-name="inv_total"<?php echo $tr_inv_master->inv_total->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_master_list->RowCnt ?>_tr_inv_master_inv_total" class="tr_inv_master_inv_total">
<span<?php echo $tr_inv_master->inv_total->ViewAttributes() ?>>
<?php echo $tr_inv_master->inv_total->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tr_inv_master->sales_id->Visible) { // sales_id ?>
		<td data-name="sales_id"<?php echo $tr_inv_master->sales_id->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_master_list->RowCnt ?>_tr_inv_master_sales_id" class="tr_inv_master_sales_id">
<span<?php echo $tr_inv_master->sales_id->ViewAttributes() ?>>
<?php echo $tr_inv_master->sales_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tr_inv_master->paid->Visible) { // paid ?>
		<td data-name="paid"<?php echo $tr_inv_master->paid->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_master_list->RowCnt ?>_tr_inv_master_paid" class="tr_inv_master_paid">
<span<?php echo $tr_inv_master->paid->ViewAttributes() ?>>
<?php if (ew_ConvertToBool($tr_inv_master->paid->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $tr_inv_master->paid->ListViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $tr_inv_master->paid->ListViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tr_inv_master_list->ListOptions->Render("body", "right", $tr_inv_master_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($tr_inv_master->CurrentAction <> "gridadd")
		$tr_inv_master_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($tr_inv_master->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($tr_inv_master_list->Recordset)
	$tr_inv_master_list->Recordset->Close();
?>
</div>
<?php } ?>
<?php if ($tr_inv_master_list->TotalRecs == 0 && $tr_inv_master->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($tr_inv_master_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($tr_inv_master->Export == "") { ?>
<script type="text/javascript">
ftr_inv_masterlistsrch.FilterList = <?php echo $tr_inv_master_list->GetFilterList() ?>;
ftr_inv_masterlistsrch.Init();
ftr_inv_masterlist.Init();
</script>
<?php } ?>
<?php
$tr_inv_master_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($tr_inv_master->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php if ($tr_inv_master->Export == "") { ?>
<script type="text/javascript">
ew_ScrollableTable("gmp_tr_inv_master", "100%", "355px");
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tr_inv_master_list->Page_Terminate();
?>
