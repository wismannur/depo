<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "view_products_unit_priceinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$view_products_unit_price_list = NULL; // Initialize page object first

class cview_products_unit_price_list extends cview_products_unit_price {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'view_products_unit_price';

	// Page object name
	var $PageObjName = 'view_products_unit_price_list';

	// Grid form hidden field names
	var $FormName = 'fview_products_unit_pricelist';
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

		// Table object (view_products_unit_price)
		if (!isset($GLOBALS["view_products_unit_price"]) || get_class($GLOBALS["view_products_unit_price"]) == "cview_products_unit_price") {
			$GLOBALS["view_products_unit_price"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["view_products_unit_price"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "view_products_unit_priceadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "view_products_unit_pricedelete.php";
		$this->MultiUpdateUrl = "view_products_unit_priceupdate.php";

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'view_products_unit_price', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fview_products_unit_pricelistsrch";

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
		$this->product_id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->product_id->Visible = FALSE;
		$this->product_code->SetVisibility();
		$this->product_name->SetVisibility();
		$this->unit_id->SetVisibility();
		$this->unit_name->SetVisibility();
		$this->qty_in_unit->SetVisibility();
		$this->unit_cost->SetVisibility();
		$this->unit_price->SetVisibility();
		$this->udet_id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->udet_id->Visible = FALSE;
		$this->supplier_id->SetVisibility();

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
		global $EW_EXPORT, $view_products_unit_price;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($view_products_unit_price);
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
		if (count($arrKeyFlds) >= 2) {
			$this->product_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->product_id->FormValue))
				return FALSE;
			$this->udet_id->setFormValue($arrKeyFlds[1]);
			if (!is_numeric($this->udet_id->FormValue))
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
		$sFilterList = ew_Concat($sFilterList, $this->product_id->AdvancedSearch->ToJson(), ","); // Field product_id
		$sFilterList = ew_Concat($sFilterList, $this->product_code->AdvancedSearch->ToJson(), ","); // Field product_code
		$sFilterList = ew_Concat($sFilterList, $this->product_name->AdvancedSearch->ToJson(), ","); // Field product_name
		$sFilterList = ew_Concat($sFilterList, $this->unit_id->AdvancedSearch->ToJson(), ","); // Field unit_id
		$sFilterList = ew_Concat($sFilterList, $this->unit_name->AdvancedSearch->ToJson(), ","); // Field unit_name
		$sFilterList = ew_Concat($sFilterList, $this->qty_in_unit->AdvancedSearch->ToJson(), ","); // Field qty_in_unit
		$sFilterList = ew_Concat($sFilterList, $this->unit_cost->AdvancedSearch->ToJson(), ","); // Field unit_cost
		$sFilterList = ew_Concat($sFilterList, $this->unit_price->AdvancedSearch->ToJson(), ","); // Field unit_price
		$sFilterList = ew_Concat($sFilterList, $this->udet_id->AdvancedSearch->ToJson(), ","); // Field udet_id
		$sFilterList = ew_Concat($sFilterList, $this->supplier_id->AdvancedSearch->ToJson(), ","); // Field supplier_id
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fview_products_unit_pricelistsrch", $filters);

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

		// Field product_id
		$this->product_id->AdvancedSearch->SearchValue = @$filter["x_product_id"];
		$this->product_id->AdvancedSearch->SearchOperator = @$filter["z_product_id"];
		$this->product_id->AdvancedSearch->SearchCondition = @$filter["v_product_id"];
		$this->product_id->AdvancedSearch->SearchValue2 = @$filter["y_product_id"];
		$this->product_id->AdvancedSearch->SearchOperator2 = @$filter["w_product_id"];
		$this->product_id->AdvancedSearch->Save();

		// Field product_code
		$this->product_code->AdvancedSearch->SearchValue = @$filter["x_product_code"];
		$this->product_code->AdvancedSearch->SearchOperator = @$filter["z_product_code"];
		$this->product_code->AdvancedSearch->SearchCondition = @$filter["v_product_code"];
		$this->product_code->AdvancedSearch->SearchValue2 = @$filter["y_product_code"];
		$this->product_code->AdvancedSearch->SearchOperator2 = @$filter["w_product_code"];
		$this->product_code->AdvancedSearch->Save();

		// Field product_name
		$this->product_name->AdvancedSearch->SearchValue = @$filter["x_product_name"];
		$this->product_name->AdvancedSearch->SearchOperator = @$filter["z_product_name"];
		$this->product_name->AdvancedSearch->SearchCondition = @$filter["v_product_name"];
		$this->product_name->AdvancedSearch->SearchValue2 = @$filter["y_product_name"];
		$this->product_name->AdvancedSearch->SearchOperator2 = @$filter["w_product_name"];
		$this->product_name->AdvancedSearch->Save();

		// Field unit_id
		$this->unit_id->AdvancedSearch->SearchValue = @$filter["x_unit_id"];
		$this->unit_id->AdvancedSearch->SearchOperator = @$filter["z_unit_id"];
		$this->unit_id->AdvancedSearch->SearchCondition = @$filter["v_unit_id"];
		$this->unit_id->AdvancedSearch->SearchValue2 = @$filter["y_unit_id"];
		$this->unit_id->AdvancedSearch->SearchOperator2 = @$filter["w_unit_id"];
		$this->unit_id->AdvancedSearch->Save();

		// Field unit_name
		$this->unit_name->AdvancedSearch->SearchValue = @$filter["x_unit_name"];
		$this->unit_name->AdvancedSearch->SearchOperator = @$filter["z_unit_name"];
		$this->unit_name->AdvancedSearch->SearchCondition = @$filter["v_unit_name"];
		$this->unit_name->AdvancedSearch->SearchValue2 = @$filter["y_unit_name"];
		$this->unit_name->AdvancedSearch->SearchOperator2 = @$filter["w_unit_name"];
		$this->unit_name->AdvancedSearch->Save();

		// Field qty_in_unit
		$this->qty_in_unit->AdvancedSearch->SearchValue = @$filter["x_qty_in_unit"];
		$this->qty_in_unit->AdvancedSearch->SearchOperator = @$filter["z_qty_in_unit"];
		$this->qty_in_unit->AdvancedSearch->SearchCondition = @$filter["v_qty_in_unit"];
		$this->qty_in_unit->AdvancedSearch->SearchValue2 = @$filter["y_qty_in_unit"];
		$this->qty_in_unit->AdvancedSearch->SearchOperator2 = @$filter["w_qty_in_unit"];
		$this->qty_in_unit->AdvancedSearch->Save();

		// Field unit_cost
		$this->unit_cost->AdvancedSearch->SearchValue = @$filter["x_unit_cost"];
		$this->unit_cost->AdvancedSearch->SearchOperator = @$filter["z_unit_cost"];
		$this->unit_cost->AdvancedSearch->SearchCondition = @$filter["v_unit_cost"];
		$this->unit_cost->AdvancedSearch->SearchValue2 = @$filter["y_unit_cost"];
		$this->unit_cost->AdvancedSearch->SearchOperator2 = @$filter["w_unit_cost"];
		$this->unit_cost->AdvancedSearch->Save();

		// Field unit_price
		$this->unit_price->AdvancedSearch->SearchValue = @$filter["x_unit_price"];
		$this->unit_price->AdvancedSearch->SearchOperator = @$filter["z_unit_price"];
		$this->unit_price->AdvancedSearch->SearchCondition = @$filter["v_unit_price"];
		$this->unit_price->AdvancedSearch->SearchValue2 = @$filter["y_unit_price"];
		$this->unit_price->AdvancedSearch->SearchOperator2 = @$filter["w_unit_price"];
		$this->unit_price->AdvancedSearch->Save();

		// Field udet_id
		$this->udet_id->AdvancedSearch->SearchValue = @$filter["x_udet_id"];
		$this->udet_id->AdvancedSearch->SearchOperator = @$filter["z_udet_id"];
		$this->udet_id->AdvancedSearch->SearchCondition = @$filter["v_udet_id"];
		$this->udet_id->AdvancedSearch->SearchValue2 = @$filter["y_udet_id"];
		$this->udet_id->AdvancedSearch->SearchOperator2 = @$filter["w_udet_id"];
		$this->udet_id->AdvancedSearch->Save();

		// Field supplier_id
		$this->supplier_id->AdvancedSearch->SearchValue = @$filter["x_supplier_id"];
		$this->supplier_id->AdvancedSearch->SearchOperator = @$filter["z_supplier_id"];
		$this->supplier_id->AdvancedSearch->SearchCondition = @$filter["v_supplier_id"];
		$this->supplier_id->AdvancedSearch->SearchValue2 = @$filter["y_supplier_id"];
		$this->supplier_id->AdvancedSearch->SearchOperator2 = @$filter["w_supplier_id"];
		$this->supplier_id->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->product_code, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->product_name, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->unit_id, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->unit_name, $arKeywords, $type);
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->product_id->CurrentValue . $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"] . $this->udet_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fview_products_unit_pricelistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fview_products_unit_pricelistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fview_products_unit_pricelist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fview_products_unit_pricelistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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
		$this->product_id->setDbValue($row['product_id']);
		$this->product_code->setDbValue($row['product_code']);
		$this->product_name->setDbValue($row['product_name']);
		$this->unit_id->setDbValue($row['unit_id']);
		$this->unit_name->setDbValue($row['unit_name']);
		$this->qty_in_unit->setDbValue($row['qty_in_unit']);
		$this->unit_cost->setDbValue($row['unit_cost']);
		$this->unit_price->setDbValue($row['unit_price']);
		$this->udet_id->setDbValue($row['udet_id']);
		$this->supplier_id->setDbValue($row['supplier_id']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['product_id'] = NULL;
		$row['product_code'] = NULL;
		$row['product_name'] = NULL;
		$row['unit_id'] = NULL;
		$row['unit_name'] = NULL;
		$row['qty_in_unit'] = NULL;
		$row['unit_cost'] = NULL;
		$row['unit_price'] = NULL;
		$row['udet_id'] = NULL;
		$row['supplier_id'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->product_id->DbValue = $row['product_id'];
		$this->product_code->DbValue = $row['product_code'];
		$this->product_name->DbValue = $row['product_name'];
		$this->unit_id->DbValue = $row['unit_id'];
		$this->unit_name->DbValue = $row['unit_name'];
		$this->qty_in_unit->DbValue = $row['qty_in_unit'];
		$this->unit_cost->DbValue = $row['unit_cost'];
		$this->unit_price->DbValue = $row['unit_price'];
		$this->udet_id->DbValue = $row['udet_id'];
		$this->supplier_id->DbValue = $row['supplier_id'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("product_id")) <> "")
			$this->product_id->CurrentValue = $this->getKey("product_id"); // product_id
		else
			$bValidKey = FALSE;
		if (strval($this->getKey("udet_id")) <> "")
			$this->udet_id->CurrentValue = $this->getKey("udet_id"); // udet_id
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
		if ($this->unit_cost->FormValue == $this->unit_cost->CurrentValue && is_numeric(ew_StrToFloat($this->unit_cost->CurrentValue)))
			$this->unit_cost->CurrentValue = ew_StrToFloat($this->unit_cost->CurrentValue);

		// Convert decimal values if posted back
		if ($this->unit_price->FormValue == $this->unit_price->CurrentValue && is_numeric(ew_StrToFloat($this->unit_price->CurrentValue)))
			$this->unit_price->CurrentValue = ew_StrToFloat($this->unit_price->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// product_id
		// product_code
		// product_name
		// unit_id
		// unit_name
		// qty_in_unit
		// unit_cost
		// unit_price
		// udet_id
		// supplier_id

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// product_id
		$this->product_id->ViewValue = $this->product_id->CurrentValue;
		$this->product_id->ViewCustomAttributes = "";

		// product_code
		$this->product_code->ViewValue = $this->product_code->CurrentValue;
		$this->product_code->ViewCustomAttributes = "";

		// product_name
		$this->product_name->ViewValue = $this->product_name->CurrentValue;
		$this->product_name->ViewCustomAttributes = "";

		// unit_id
		$this->unit_id->ViewValue = $this->unit_id->CurrentValue;
		$this->unit_id->ViewCustomAttributes = "";

		// unit_name
		$this->unit_name->ViewValue = $this->unit_name->CurrentValue;
		$this->unit_name->ViewCustomAttributes = "";

		// qty_in_unit
		$this->qty_in_unit->ViewValue = $this->qty_in_unit->CurrentValue;
		$this->qty_in_unit->ViewCustomAttributes = "";

		// unit_cost
		$this->unit_cost->ViewValue = $this->unit_cost->CurrentValue;
		$this->unit_cost->ViewCustomAttributes = "";

		// unit_price
		$this->unit_price->ViewValue = $this->unit_price->CurrentValue;
		$this->unit_price->ViewCustomAttributes = "";

		// udet_id
		$this->udet_id->ViewValue = $this->udet_id->CurrentValue;
		$this->udet_id->ViewCustomAttributes = "";

		// supplier_id
		$this->supplier_id->ViewValue = $this->supplier_id->CurrentValue;
		$this->supplier_id->ViewCustomAttributes = "";

			// product_id
			$this->product_id->LinkCustomAttributes = "";
			$this->product_id->HrefValue = "";
			$this->product_id->TooltipValue = "";

			// product_code
			$this->product_code->LinkCustomAttributes = "";
			$this->product_code->HrefValue = "";
			$this->product_code->TooltipValue = "";

			// product_name
			$this->product_name->LinkCustomAttributes = "";
			$this->product_name->HrefValue = "";
			$this->product_name->TooltipValue = "";

			// unit_id
			$this->unit_id->LinkCustomAttributes = "";
			$this->unit_id->HrefValue = "";
			$this->unit_id->TooltipValue = "";

			// unit_name
			$this->unit_name->LinkCustomAttributes = "";
			$this->unit_name->HrefValue = "";
			$this->unit_name->TooltipValue = "";

			// qty_in_unit
			$this->qty_in_unit->LinkCustomAttributes = "";
			$this->qty_in_unit->HrefValue = "";
			$this->qty_in_unit->TooltipValue = "";

			// unit_cost
			$this->unit_cost->LinkCustomAttributes = "";
			$this->unit_cost->HrefValue = "";
			$this->unit_cost->TooltipValue = "";

			// unit_price
			$this->unit_price->LinkCustomAttributes = "";
			$this->unit_price->HrefValue = "";
			$this->unit_price->TooltipValue = "";

			// udet_id
			$this->udet_id->LinkCustomAttributes = "";
			$this->udet_id->HrefValue = "";
			$this->udet_id->TooltipValue = "";

			// supplier_id
			$this->supplier_id->LinkCustomAttributes = "";
			$this->supplier_id->HrefValue = "";
			$this->supplier_id->TooltipValue = "";
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
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_view_products_unit_price\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_view_products_unit_price',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fview_products_unit_pricelist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		//if (isset($_GET[EW_TABLE_SHOW_MASTER]) == "tr_pb_master") {
		//	$this->item_name->Visible = FALSE;
		//	$this->unit_id->Visible = FALSE;
		//}

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
if (!isset($view_products_unit_price_list)) $view_products_unit_price_list = new cview_products_unit_price_list();

// Page init
$view_products_unit_price_list->Page_Init();

// Page main
$view_products_unit_price_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$view_products_unit_price_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($view_products_unit_price->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fview_products_unit_pricelist = new ew_Form("fview_products_unit_pricelist", "list");
fview_products_unit_pricelist.FormKeyCountName = '<?php echo $view_products_unit_price_list->FormKeyCountName ?>';

// Form_CustomValidate event
fview_products_unit_pricelist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fview_products_unit_pricelist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var CurrentSearchForm = fview_products_unit_pricelistsrch = new ew_Form("fview_products_unit_pricelistsrch");

// Init search panel as collapsed
if (fview_products_unit_pricelistsrch) fview_products_unit_pricelistsrch.InitSearchPanel = true;
</script>
<style type="text/css">
.ewTablePreviewRow { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
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
<?php if ($view_products_unit_price->Export == "") { ?>
<div class="ewToolbar">
<?php if ($view_products_unit_price_list->TotalRecs > 0 && $view_products_unit_price_list->ExportOptions->Visible()) { ?>
<?php $view_products_unit_price_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($view_products_unit_price_list->SearchOptions->Visible()) { ?>
<?php $view_products_unit_price_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($view_products_unit_price_list->FilterOptions->Visible()) { ?>
<?php $view_products_unit_price_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $view_products_unit_price_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($view_products_unit_price_list->TotalRecs <= 0)
			$view_products_unit_price_list->TotalRecs = $view_products_unit_price->ListRecordCount();
	} else {
		if (!$view_products_unit_price_list->Recordset && ($view_products_unit_price_list->Recordset = $view_products_unit_price_list->LoadRecordset()))
			$view_products_unit_price_list->TotalRecs = $view_products_unit_price_list->Recordset->RecordCount();
	}
	$view_products_unit_price_list->StartRec = 1;
	if ($view_products_unit_price_list->DisplayRecs <= 0 || ($view_products_unit_price->Export <> "" && $view_products_unit_price->ExportAll)) // Display all records
		$view_products_unit_price_list->DisplayRecs = $view_products_unit_price_list->TotalRecs;
	if (!($view_products_unit_price->Export <> "" && $view_products_unit_price->ExportAll))
		$view_products_unit_price_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$view_products_unit_price_list->Recordset = $view_products_unit_price_list->LoadRecordset($view_products_unit_price_list->StartRec-1, $view_products_unit_price_list->DisplayRecs);

	// Set no record found message
	if ($view_products_unit_price->CurrentAction == "" && $view_products_unit_price_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$view_products_unit_price_list->setWarningMessage(ew_DeniedMsg());
		if ($view_products_unit_price_list->SearchWhere == "0=101")
			$view_products_unit_price_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$view_products_unit_price_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$view_products_unit_price_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($view_products_unit_price->Export == "" && $view_products_unit_price->CurrentAction == "") { ?>
<form name="fview_products_unit_pricelistsrch" id="fview_products_unit_pricelistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($view_products_unit_price_list->SearchWhere <> "") ? " in" : ""; ?>
<div id="fview_products_unit_pricelistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="view_products_unit_price">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($view_products_unit_price_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($view_products_unit_price_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $view_products_unit_price_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($view_products_unit_price_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($view_products_unit_price_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($view_products_unit_price_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($view_products_unit_price_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
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
<?php $view_products_unit_price_list->ShowPageHeader(); ?>
<?php
$view_products_unit_price_list->ShowMessage();
?>
<?php if ($view_products_unit_price_list->TotalRecs > 0 || $view_products_unit_price->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($view_products_unit_price_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> view_products_unit_price">
<?php if ($view_products_unit_price->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($view_products_unit_price->CurrentAction <> "gridadd" && $view_products_unit_price->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($view_products_unit_price_list->Pager)) $view_products_unit_price_list->Pager = new cPrevNextPager($view_products_unit_price_list->StartRec, $view_products_unit_price_list->DisplayRecs, $view_products_unit_price_list->TotalRecs, $view_products_unit_price_list->AutoHidePager) ?>
<?php if ($view_products_unit_price_list->Pager->RecordCount > 0 && $view_products_unit_price_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($view_products_unit_price_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $view_products_unit_price_list->PageUrl() ?>start=<?php echo $view_products_unit_price_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($view_products_unit_price_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $view_products_unit_price_list->PageUrl() ?>start=<?php echo $view_products_unit_price_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $view_products_unit_price_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($view_products_unit_price_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $view_products_unit_price_list->PageUrl() ?>start=<?php echo $view_products_unit_price_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($view_products_unit_price_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $view_products_unit_price_list->PageUrl() ?>start=<?php echo $view_products_unit_price_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $view_products_unit_price_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($view_products_unit_price_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $view_products_unit_price_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $view_products_unit_price_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $view_products_unit_price_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($view_products_unit_price_list->TotalRecs > 0 && (!$view_products_unit_price_list->AutoHidePageSizeSelector || $view_products_unit_price_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="view_products_unit_price">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($view_products_unit_price_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($view_products_unit_price_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($view_products_unit_price_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($view_products_unit_price_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="ALL"<?php if ($view_products_unit_price->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($view_products_unit_price_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fview_products_unit_pricelist" id="fview_products_unit_pricelist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($view_products_unit_price_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $view_products_unit_price_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="view_products_unit_price">
<div id="gmp_view_products_unit_price" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($view_products_unit_price_list->TotalRecs > 0 || $view_products_unit_price->CurrentAction == "gridedit") { ?>
<table id="tbl_view_products_unit_pricelist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$view_products_unit_price_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$view_products_unit_price_list->RenderListOptions();

// Render list options (header, left)
$view_products_unit_price_list->ListOptions->Render("header", "left");
?>
<?php if ($view_products_unit_price->product_id->Visible) { // product_id ?>
	<?php if ($view_products_unit_price->SortUrl($view_products_unit_price->product_id) == "") { ?>
		<th data-name="product_id" class="<?php echo $view_products_unit_price->product_id->HeaderCellClass() ?>"><div id="elh_view_products_unit_price_product_id" class="view_products_unit_price_product_id"><div class="ewTableHeaderCaption"><?php echo $view_products_unit_price->product_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_id" class="<?php echo $view_products_unit_price->product_id->HeaderCellClass() ?>"><div><div id="elh_view_products_unit_price_product_id" class="view_products_unit_price_product_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_products_unit_price->product_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_products_unit_price->product_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_products_unit_price->product_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_products_unit_price->product_code->Visible) { // product_code ?>
	<?php if ($view_products_unit_price->SortUrl($view_products_unit_price->product_code) == "") { ?>
		<th data-name="product_code" class="<?php echo $view_products_unit_price->product_code->HeaderCellClass() ?>"><div id="elh_view_products_unit_price_product_code" class="view_products_unit_price_product_code"><div class="ewTableHeaderCaption"><?php echo $view_products_unit_price->product_code->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_code" class="<?php echo $view_products_unit_price->product_code->HeaderCellClass() ?>"><div><div id="elh_view_products_unit_price_product_code" class="view_products_unit_price_product_code">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_products_unit_price->product_code->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_products_unit_price->product_code->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_products_unit_price->product_code->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_products_unit_price->product_name->Visible) { // product_name ?>
	<?php if ($view_products_unit_price->SortUrl($view_products_unit_price->product_name) == "") { ?>
		<th data-name="product_name" class="<?php echo $view_products_unit_price->product_name->HeaderCellClass() ?>"><div id="elh_view_products_unit_price_product_name" class="view_products_unit_price_product_name"><div class="ewTableHeaderCaption"><?php echo $view_products_unit_price->product_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_name" class="<?php echo $view_products_unit_price->product_name->HeaderCellClass() ?>"><div><div id="elh_view_products_unit_price_product_name" class="view_products_unit_price_product_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_products_unit_price->product_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_products_unit_price->product_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_products_unit_price->product_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_products_unit_price->unit_id->Visible) { // unit_id ?>
	<?php if ($view_products_unit_price->SortUrl($view_products_unit_price->unit_id) == "") { ?>
		<th data-name="unit_id" class="<?php echo $view_products_unit_price->unit_id->HeaderCellClass() ?>"><div id="elh_view_products_unit_price_unit_id" class="view_products_unit_price_unit_id"><div class="ewTableHeaderCaption"><?php echo $view_products_unit_price->unit_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unit_id" class="<?php echo $view_products_unit_price->unit_id->HeaderCellClass() ?>"><div><div id="elh_view_products_unit_price_unit_id" class="view_products_unit_price_unit_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_products_unit_price->unit_id->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_products_unit_price->unit_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_products_unit_price->unit_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_products_unit_price->unit_name->Visible) { // unit_name ?>
	<?php if ($view_products_unit_price->SortUrl($view_products_unit_price->unit_name) == "") { ?>
		<th data-name="unit_name" class="<?php echo $view_products_unit_price->unit_name->HeaderCellClass() ?>"><div id="elh_view_products_unit_price_unit_name" class="view_products_unit_price_unit_name"><div class="ewTableHeaderCaption"><?php echo $view_products_unit_price->unit_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unit_name" class="<?php echo $view_products_unit_price->unit_name->HeaderCellClass() ?>"><div><div id="elh_view_products_unit_price_unit_name" class="view_products_unit_price_unit_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_products_unit_price->unit_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_products_unit_price->unit_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_products_unit_price->unit_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_products_unit_price->qty_in_unit->Visible) { // qty_in_unit ?>
	<?php if ($view_products_unit_price->SortUrl($view_products_unit_price->qty_in_unit) == "") { ?>
		<th data-name="qty_in_unit" class="<?php echo $view_products_unit_price->qty_in_unit->HeaderCellClass() ?>"><div id="elh_view_products_unit_price_qty_in_unit" class="view_products_unit_price_qty_in_unit"><div class="ewTableHeaderCaption"><?php echo $view_products_unit_price->qty_in_unit->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty_in_unit" class="<?php echo $view_products_unit_price->qty_in_unit->HeaderCellClass() ?>"><div><div id="elh_view_products_unit_price_qty_in_unit" class="view_products_unit_price_qty_in_unit">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_products_unit_price->qty_in_unit->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_products_unit_price->qty_in_unit->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_products_unit_price->qty_in_unit->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_products_unit_price->unit_cost->Visible) { // unit_cost ?>
	<?php if ($view_products_unit_price->SortUrl($view_products_unit_price->unit_cost) == "") { ?>
		<th data-name="unit_cost" class="<?php echo $view_products_unit_price->unit_cost->HeaderCellClass() ?>"><div id="elh_view_products_unit_price_unit_cost" class="view_products_unit_price_unit_cost"><div class="ewTableHeaderCaption"><?php echo $view_products_unit_price->unit_cost->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unit_cost" class="<?php echo $view_products_unit_price->unit_cost->HeaderCellClass() ?>"><div><div id="elh_view_products_unit_price_unit_cost" class="view_products_unit_price_unit_cost">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_products_unit_price->unit_cost->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_products_unit_price->unit_cost->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_products_unit_price->unit_cost->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_products_unit_price->unit_price->Visible) { // unit_price ?>
	<?php if ($view_products_unit_price->SortUrl($view_products_unit_price->unit_price) == "") { ?>
		<th data-name="unit_price" class="<?php echo $view_products_unit_price->unit_price->HeaderCellClass() ?>"><div id="elh_view_products_unit_price_unit_price" class="view_products_unit_price_unit_price"><div class="ewTableHeaderCaption"><?php echo $view_products_unit_price->unit_price->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unit_price" class="<?php echo $view_products_unit_price->unit_price->HeaderCellClass() ?>"><div><div id="elh_view_products_unit_price_unit_price" class="view_products_unit_price_unit_price">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_products_unit_price->unit_price->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_products_unit_price->unit_price->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_products_unit_price->unit_price->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_products_unit_price->udet_id->Visible) { // udet_id ?>
	<?php if ($view_products_unit_price->SortUrl($view_products_unit_price->udet_id) == "") { ?>
		<th data-name="udet_id" class="<?php echo $view_products_unit_price->udet_id->HeaderCellClass() ?>"><div id="elh_view_products_unit_price_udet_id" class="view_products_unit_price_udet_id"><div class="ewTableHeaderCaption"><?php echo $view_products_unit_price->udet_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="udet_id" class="<?php echo $view_products_unit_price->udet_id->HeaderCellClass() ?>"><div><div id="elh_view_products_unit_price_udet_id" class="view_products_unit_price_udet_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_products_unit_price->udet_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_products_unit_price->udet_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_products_unit_price->udet_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_products_unit_price->supplier_id->Visible) { // supplier_id ?>
	<?php if ($view_products_unit_price->SortUrl($view_products_unit_price->supplier_id) == "") { ?>
		<th data-name="supplier_id" class="<?php echo $view_products_unit_price->supplier_id->HeaderCellClass() ?>"><div id="elh_view_products_unit_price_supplier_id" class="view_products_unit_price_supplier_id"><div class="ewTableHeaderCaption"><?php echo $view_products_unit_price->supplier_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="supplier_id" class="<?php echo $view_products_unit_price->supplier_id->HeaderCellClass() ?>"><div><div id="elh_view_products_unit_price_supplier_id" class="view_products_unit_price_supplier_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_products_unit_price->supplier_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_products_unit_price->supplier_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_products_unit_price->supplier_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$view_products_unit_price_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($view_products_unit_price->ExportAll && $view_products_unit_price->Export <> "") {
	$view_products_unit_price_list->StopRec = $view_products_unit_price_list->TotalRecs;
} else {

	// Set the last record to display
	if ($view_products_unit_price_list->TotalRecs > $view_products_unit_price_list->StartRec + $view_products_unit_price_list->DisplayRecs - 1)
		$view_products_unit_price_list->StopRec = $view_products_unit_price_list->StartRec + $view_products_unit_price_list->DisplayRecs - 1;
	else
		$view_products_unit_price_list->StopRec = $view_products_unit_price_list->TotalRecs;
}
$view_products_unit_price_list->RecCnt = $view_products_unit_price_list->StartRec - 1;
if ($view_products_unit_price_list->Recordset && !$view_products_unit_price_list->Recordset->EOF) {
	$view_products_unit_price_list->Recordset->MoveFirst();
	$bSelectLimit = $view_products_unit_price_list->UseSelectLimit;
	if (!$bSelectLimit && $view_products_unit_price_list->StartRec > 1)
		$view_products_unit_price_list->Recordset->Move($view_products_unit_price_list->StartRec - 1);
} elseif (!$view_products_unit_price->AllowAddDeleteRow && $view_products_unit_price_list->StopRec == 0) {
	$view_products_unit_price_list->StopRec = $view_products_unit_price->GridAddRowCount;
}

// Initialize aggregate
$view_products_unit_price->RowType = EW_ROWTYPE_AGGREGATEINIT;
$view_products_unit_price->ResetAttrs();
$view_products_unit_price_list->RenderRow();
while ($view_products_unit_price_list->RecCnt < $view_products_unit_price_list->StopRec) {
	$view_products_unit_price_list->RecCnt++;
	if (intval($view_products_unit_price_list->RecCnt) >= intval($view_products_unit_price_list->StartRec)) {
		$view_products_unit_price_list->RowCnt++;

		// Set up key count
		$view_products_unit_price_list->KeyCount = $view_products_unit_price_list->RowIndex;

		// Init row class and style
		$view_products_unit_price->ResetAttrs();
		$view_products_unit_price->CssClass = "";
		if ($view_products_unit_price->CurrentAction == "gridadd") {
		} else {
			$view_products_unit_price_list->LoadRowValues($view_products_unit_price_list->Recordset); // Load row values
		}
		$view_products_unit_price->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$view_products_unit_price->RowAttrs = array_merge($view_products_unit_price->RowAttrs, array('data-rowindex'=>$view_products_unit_price_list->RowCnt, 'id'=>'r' . $view_products_unit_price_list->RowCnt . '_view_products_unit_price', 'data-rowtype'=>$view_products_unit_price->RowType));

		// Render row
		$view_products_unit_price_list->RenderRow();

		// Render list options
		$view_products_unit_price_list->RenderListOptions();
?>
	<tr<?php echo $view_products_unit_price->RowAttributes() ?>>
<?php

// Render list options (body, left)
$view_products_unit_price_list->ListOptions->Render("body", "left", $view_products_unit_price_list->RowCnt);
?>
	<?php if ($view_products_unit_price->product_id->Visible) { // product_id ?>
		<td data-name="product_id"<?php echo $view_products_unit_price->product_id->CellAttributes() ?>>
<span id="el<?php echo $view_products_unit_price_list->RowCnt ?>_view_products_unit_price_product_id" class="view_products_unit_price_product_id">
<span<?php echo $view_products_unit_price->product_id->ViewAttributes() ?>>
<?php echo $view_products_unit_price->product_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_products_unit_price->product_code->Visible) { // product_code ?>
		<td data-name="product_code"<?php echo $view_products_unit_price->product_code->CellAttributes() ?>>
<span id="el<?php echo $view_products_unit_price_list->RowCnt ?>_view_products_unit_price_product_code" class="view_products_unit_price_product_code">
<span<?php echo $view_products_unit_price->product_code->ViewAttributes() ?>>
<?php echo $view_products_unit_price->product_code->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_products_unit_price->product_name->Visible) { // product_name ?>
		<td data-name="product_name"<?php echo $view_products_unit_price->product_name->CellAttributes() ?>>
<span id="el<?php echo $view_products_unit_price_list->RowCnt ?>_view_products_unit_price_product_name" class="view_products_unit_price_product_name">
<span<?php echo $view_products_unit_price->product_name->ViewAttributes() ?>>
<?php echo $view_products_unit_price->product_name->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_products_unit_price->unit_id->Visible) { // unit_id ?>
		<td data-name="unit_id"<?php echo $view_products_unit_price->unit_id->CellAttributes() ?>>
<span id="el<?php echo $view_products_unit_price_list->RowCnt ?>_view_products_unit_price_unit_id" class="view_products_unit_price_unit_id">
<span<?php echo $view_products_unit_price->unit_id->ViewAttributes() ?>>
<?php echo $view_products_unit_price->unit_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_products_unit_price->unit_name->Visible) { // unit_name ?>
		<td data-name="unit_name"<?php echo $view_products_unit_price->unit_name->CellAttributes() ?>>
<span id="el<?php echo $view_products_unit_price_list->RowCnt ?>_view_products_unit_price_unit_name" class="view_products_unit_price_unit_name">
<span<?php echo $view_products_unit_price->unit_name->ViewAttributes() ?>>
<?php echo $view_products_unit_price->unit_name->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_products_unit_price->qty_in_unit->Visible) { // qty_in_unit ?>
		<td data-name="qty_in_unit"<?php echo $view_products_unit_price->qty_in_unit->CellAttributes() ?>>
<span id="el<?php echo $view_products_unit_price_list->RowCnt ?>_view_products_unit_price_qty_in_unit" class="view_products_unit_price_qty_in_unit">
<span<?php echo $view_products_unit_price->qty_in_unit->ViewAttributes() ?>>
<?php echo $view_products_unit_price->qty_in_unit->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_products_unit_price->unit_cost->Visible) { // unit_cost ?>
		<td data-name="unit_cost"<?php echo $view_products_unit_price->unit_cost->CellAttributes() ?>>
<span id="el<?php echo $view_products_unit_price_list->RowCnt ?>_view_products_unit_price_unit_cost" class="view_products_unit_price_unit_cost">
<span<?php echo $view_products_unit_price->unit_cost->ViewAttributes() ?>>
<?php echo $view_products_unit_price->unit_cost->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_products_unit_price->unit_price->Visible) { // unit_price ?>
		<td data-name="unit_price"<?php echo $view_products_unit_price->unit_price->CellAttributes() ?>>
<span id="el<?php echo $view_products_unit_price_list->RowCnt ?>_view_products_unit_price_unit_price" class="view_products_unit_price_unit_price">
<span<?php echo $view_products_unit_price->unit_price->ViewAttributes() ?>>
<?php echo $view_products_unit_price->unit_price->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_products_unit_price->udet_id->Visible) { // udet_id ?>
		<td data-name="udet_id"<?php echo $view_products_unit_price->udet_id->CellAttributes() ?>>
<span id="el<?php echo $view_products_unit_price_list->RowCnt ?>_view_products_unit_price_udet_id" class="view_products_unit_price_udet_id">
<span<?php echo $view_products_unit_price->udet_id->ViewAttributes() ?>>
<?php echo $view_products_unit_price->udet_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_products_unit_price->supplier_id->Visible) { // supplier_id ?>
		<td data-name="supplier_id"<?php echo $view_products_unit_price->supplier_id->CellAttributes() ?>>
<span id="el<?php echo $view_products_unit_price_list->RowCnt ?>_view_products_unit_price_supplier_id" class="view_products_unit_price_supplier_id">
<span<?php echo $view_products_unit_price->supplier_id->ViewAttributes() ?>>
<?php echo $view_products_unit_price->supplier_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view_products_unit_price_list->ListOptions->Render("body", "right", $view_products_unit_price_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($view_products_unit_price->CurrentAction <> "gridadd")
		$view_products_unit_price_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($view_products_unit_price->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($view_products_unit_price_list->Recordset)
	$view_products_unit_price_list->Recordset->Close();
?>
</div>
<?php } ?>
<?php if ($view_products_unit_price_list->TotalRecs == 0 && $view_products_unit_price->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($view_products_unit_price_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($view_products_unit_price->Export == "") { ?>
<script type="text/javascript">
fview_products_unit_pricelistsrch.FilterList = <?php echo $view_products_unit_price_list->GetFilterList() ?>;
fview_products_unit_pricelistsrch.Init();
fview_products_unit_pricelist.Init();
</script>
<?php } ?>
<?php
$view_products_unit_price_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($view_products_unit_price->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$view_products_unit_price_list->Page_Terminate();
?>
