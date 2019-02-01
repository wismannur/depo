<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_unit_detailinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tbl_productsinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_unit_detail_preview = NULL; // Initialize page object first

class ctbl_unit_detail_preview extends ctbl_unit_detail {

	// Page ID
	var $PageID = 'preview';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tbl_unit_detail';

	// Page object name
	var $PageObjName = 'tbl_unit_detail_preview';

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

		// Table object (tbl_unit_detail)
		if (!isset($GLOBALS["tbl_unit_detail"]) || get_class($GLOBALS["tbl_unit_detail"]) == "ctbl_unit_detail") {
			$GLOBALS["tbl_unit_detail"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_unit_detail"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Table object (tbl_products)
		if (!isset($GLOBALS['tbl_products'])) $GLOBALS['tbl_products'] = new ctbl_products();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'preview', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_unit_detail', TRUE);

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

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
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
		if (is_null($Security)) $Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel(CurrentProjectID() . 'tbl_unit_detail');
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanList()) {
			echo ew_DeniedMsg();
			exit();
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

		// Set up list options
		$this->SetupListOptions();
		$this->unit_name->SetVisibility();
		$this->qty_in_unit->SetVisibility();
		$this->unit_cost->SetVisibility();
		$this->unit_price->SetVisibility();
		$this->product_code->SetVisibility();

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

		// Setup other options
		$this->SetupOtherOptions();
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
		global $EW_EXPORT, $tbl_unit_detail;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_unit_detail);
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
	var $Recordset;
	var $TotalRecs;
	var $RowCnt;
	var $RecCount;
	var $ListOptions; // List options
	var $OtherOptions; // Other options
	var $Pager;
	var $StartRec = 1;
	var $DisplayRecs = 0;
	var $SortField = "";
	var $SortOrder = "";

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Load filter
		$filter = @$_GET["f"];
		$filter = ew_Decrypt($filter);
		if ($filter == "") $filter = "0=1";
		$this->StartRec = intval(@$_GET["start"]) ?: 1;
		$this->SortField = @$_GET["sort"];
		$this->SortOrder = @$_GET["sortorder"];

		// Set up foreign keys from filter
		$this->SetupForeignKeysFromFilter($filter);

		// Call Recordset Selecting event
		$this->Recordset_Selecting($filter);

		// Load recordset
		$filter = $this->ApplyUserIDFilters($filter);
		$this->TotalRecs = $this->LoadRecordCount($filter);
		$sSql = $this->PreviewSQL($filter);
		if ($this->DisplayRecs > 0)
			$this->Recordset = $this->Connection()->SelectLimit($sSql, $this->DisplayRecs, $this->StartRec - 1);
		if (!$this->Recordset)
			$this->Recordset = $this->Connection()->Execute($sSql);
		if ($this->Recordset && !$this->Recordset->EOF) {

			// Call Recordset Selected event
			$this->Recordset_Selected($this->Recordset);
			$this->LoadListRowValues($this->Recordset);
		}
		$this->RenderOtherOptions();
	}

	// Get preview SQL
	function PreviewSQL($filter) {
		$sortField = $this->SortField;
		$sortOrder = $this->SortOrder;
		$sort = "";
		if (array_key_exists($sortField, $this->fields)) {
			$fld = $this->fields[$sortField];
			$sort = $fld->FldExpression;
			if ($sortOrder == "ASC" || $sortOrder == "DESC")
				$sort .= " " . $sortOrder;
		}
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = TRUE;
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();
		$masterkeyurl = $this->MasterKeyUrl();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
	}

	// Get master foreign key url
	function MasterKeyUrl() {
		$mastertblvar = @$_GET["t"];
		$url = "";
		if ($mastertblvar == "tbl_products") {
			$url = "" . EW_TABLE_SHOW_MASTER . "=tbl_products&fk_product_id=" . urlencode(strval($this->product_id->QueryStringValue)) . "";
		}
		return $url;
	}

	// Set up foreign keys from filter
	function SetupForeignKeysFromFilter($f) {
		$mastertblvar = @$_GET["t"];
		if ($mastertblvar == "tbl_products") {
			$find = "`product_id`=";
			$x = strpos($f, $find);
			if ($x !== FALSE) {
				$x += strlen($find);
				$val = substr($f, $x);
				$val = $this->UnquoteValue($val, "db_inventory_pusat");
 				$this->product_id->setQueryStringValue($val);
			}
		}
	}

	// Unquote value
	function UnquoteValue($val, $dbid) {
		if (substr($val,0,1) == "'" && substr($val,strlen($val)-1) == "'") {
			if (ew_GetConnectionType($dbid) == "MYSQL")
				return stripslashes(substr($val, 1, strlen($val)-2));
			else
				return str_replace("''", "'", substr($val, 1, strlen($val)-2));
		} else {
			return $val;
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
}
?>
<?php ew_Header(FALSE, "utf-8") ?>
<?php

// Create page object
if (!isset($tbl_unit_detail_preview)) $tbl_unit_detail_preview = new ctbl_unit_detail_preview();

// Page init
$tbl_unit_detail_preview->Page_Init();

// Page main
$tbl_unit_detail_preview->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_unit_detail_preview->Page_Render();
?>
<?php $tbl_unit_detail_preview->ShowPageHeader(); ?>
<div class="box ewGrid tbl_unit_detail"><!-- .box -->
<?php if ($tbl_unit_detail_preview->TotalRecs > 0) { ?>
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel"><!-- .table-responsive -->
<table class="table ewTable ewPreviewTable"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ewTableHeader">
<?php

// Render list options
$tbl_unit_detail_preview->RenderListOptions();

// Render list options (header, left)
$tbl_unit_detail_preview->ListOptions->Render("header", "left");
?>
<?php if ($tbl_unit_detail->unit_name->Visible) { // unit_name ?>
	<?php if ($tbl_unit_detail->SortUrl($tbl_unit_detail->unit_name) == "") { ?>
		<th class="<?php echo $tbl_unit_detail->unit_name->HeaderCellClass() ?>"><?php echo $tbl_unit_detail->unit_name->FldCaption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unit_detail->unit_name->HeaderCellClass() ?>"><div class="ewPointer" data-sort="<?php echo $tbl_unit_detail->unit_name->FldName ?>" data-sort-order="<?php echo $tbl_unit_detail_preview->SortField == $tbl_unit_detail->unit_name->FldName && $tbl_unit_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ewTableHeaderBtn">
		<span class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->unit_name->FldCaption() ?></span>
		<span class="ewTableHeaderSort"><?php if ($tbl_unit_detail_preview->SortField == $tbl_unit_detail->unit_name->FldName) { ?><?php if ($tbl_unit_detail_preview->SortOrder == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_unit_detail_preview->SortOrder == "DESC") { ?><span class="caret"></span><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unit_detail->qty_in_unit->Visible) { // qty_in_unit ?>
	<?php if ($tbl_unit_detail->SortUrl($tbl_unit_detail->qty_in_unit) == "") { ?>
		<th class="<?php echo $tbl_unit_detail->qty_in_unit->HeaderCellClass() ?>"><?php echo $tbl_unit_detail->qty_in_unit->FldCaption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unit_detail->qty_in_unit->HeaderCellClass() ?>"><div class="ewPointer" data-sort="<?php echo $tbl_unit_detail->qty_in_unit->FldName ?>" data-sort-order="<?php echo $tbl_unit_detail_preview->SortField == $tbl_unit_detail->qty_in_unit->FldName && $tbl_unit_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ewTableHeaderBtn">
		<span class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->qty_in_unit->FldCaption() ?></span>
		<span class="ewTableHeaderSort"><?php if ($tbl_unit_detail_preview->SortField == $tbl_unit_detail->qty_in_unit->FldName) { ?><?php if ($tbl_unit_detail_preview->SortOrder == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_unit_detail_preview->SortOrder == "DESC") { ?><span class="caret"></span><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unit_detail->unit_cost->Visible) { // unit_cost ?>
	<?php if ($tbl_unit_detail->SortUrl($tbl_unit_detail->unit_cost) == "") { ?>
		<th class="<?php echo $tbl_unit_detail->unit_cost->HeaderCellClass() ?>"><?php echo $tbl_unit_detail->unit_cost->FldCaption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unit_detail->unit_cost->HeaderCellClass() ?>"><div class="ewPointer" data-sort="<?php echo $tbl_unit_detail->unit_cost->FldName ?>" data-sort-order="<?php echo $tbl_unit_detail_preview->SortField == $tbl_unit_detail->unit_cost->FldName && $tbl_unit_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ewTableHeaderBtn">
		<span class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->unit_cost->FldCaption() ?></span>
		<span class="ewTableHeaderSort"><?php if ($tbl_unit_detail_preview->SortField == $tbl_unit_detail->unit_cost->FldName) { ?><?php if ($tbl_unit_detail_preview->SortOrder == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_unit_detail_preview->SortOrder == "DESC") { ?><span class="caret"></span><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unit_detail->unit_price->Visible) { // unit_price ?>
	<?php if ($tbl_unit_detail->SortUrl($tbl_unit_detail->unit_price) == "") { ?>
		<th class="<?php echo $tbl_unit_detail->unit_price->HeaderCellClass() ?>"><?php echo $tbl_unit_detail->unit_price->FldCaption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unit_detail->unit_price->HeaderCellClass() ?>"><div class="ewPointer" data-sort="<?php echo $tbl_unit_detail->unit_price->FldName ?>" data-sort-order="<?php echo $tbl_unit_detail_preview->SortField == $tbl_unit_detail->unit_price->FldName && $tbl_unit_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ewTableHeaderBtn">
		<span class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->unit_price->FldCaption() ?></span>
		<span class="ewTableHeaderSort"><?php if ($tbl_unit_detail_preview->SortField == $tbl_unit_detail->unit_price->FldName) { ?><?php if ($tbl_unit_detail_preview->SortOrder == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_unit_detail_preview->SortOrder == "DESC") { ?><span class="caret"></span><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unit_detail->product_code->Visible) { // product_code ?>
	<?php if ($tbl_unit_detail->SortUrl($tbl_unit_detail->product_code) == "") { ?>
		<th class="<?php echo $tbl_unit_detail->product_code->HeaderCellClass() ?>"><?php echo $tbl_unit_detail->product_code->FldCaption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unit_detail->product_code->HeaderCellClass() ?>"><div class="ewPointer" data-sort="<?php echo $tbl_unit_detail->product_code->FldName ?>" data-sort-order="<?php echo $tbl_unit_detail_preview->SortField == $tbl_unit_detail->product_code->FldName && $tbl_unit_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ewTableHeaderBtn">
		<span class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->product_code->FldCaption() ?></span>
		<span class="ewTableHeaderSort"><?php if ($tbl_unit_detail_preview->SortField == $tbl_unit_detail->product_code->FldName) { ?><?php if ($tbl_unit_detail_preview->SortOrder == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_unit_detail_preview->SortOrder == "DESC") { ?><span class="caret"></span><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_unit_detail_preview->ListOptions->Render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$tbl_unit_detail_preview->RecCount = 0;
$tbl_unit_detail_preview->RowCnt = 0;
while ($tbl_unit_detail_preview->Recordset && !$tbl_unit_detail_preview->Recordset->EOF) {

	// Init row class and style
	$tbl_unit_detail_preview->RecCount++;
	$tbl_unit_detail_preview->RowCnt++;
	$tbl_unit_detail_preview->CssStyle = "";
	$tbl_unit_detail_preview->LoadListRowValues($tbl_unit_detail_preview->Recordset);

	// Render row
	$tbl_unit_detail_preview->RowType = EW_ROWTYPE_PREVIEW; // Preview record
	$tbl_unit_detail_preview->ResetAttrs();
	$tbl_unit_detail_preview->RenderListRow();

	// Render list options
	$tbl_unit_detail_preview->RenderListOptions();
?>
	<tr<?php echo $tbl_unit_detail_preview->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_unit_detail_preview->ListOptions->Render("body", "left", $tbl_unit_detail_preview->RowCnt);
?>
<?php if ($tbl_unit_detail->unit_name->Visible) { // unit_name ?>
		<!-- unit_name -->
		<td<?php echo $tbl_unit_detail->unit_name->CellAttributes() ?>>
<span<?php echo $tbl_unit_detail->unit_name->ViewAttributes() ?>>
<?php echo $tbl_unit_detail->unit_name->ListViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_unit_detail->qty_in_unit->Visible) { // qty_in_unit ?>
		<!-- qty_in_unit -->
		<td<?php echo $tbl_unit_detail->qty_in_unit->CellAttributes() ?>>
<span<?php echo $tbl_unit_detail->qty_in_unit->ViewAttributes() ?>>
<?php echo $tbl_unit_detail->qty_in_unit->ListViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_unit_detail->unit_cost->Visible) { // unit_cost ?>
		<!-- unit_cost -->
		<td<?php echo $tbl_unit_detail->unit_cost->CellAttributes() ?>>
<span<?php echo $tbl_unit_detail->unit_cost->ViewAttributes() ?>>
<?php echo $tbl_unit_detail->unit_cost->ListViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_unit_detail->unit_price->Visible) { // unit_price ?>
		<!-- unit_price -->
		<td<?php echo $tbl_unit_detail->unit_price->CellAttributes() ?>>
<span<?php echo $tbl_unit_detail->unit_price->ViewAttributes() ?>>
<?php echo $tbl_unit_detail->unit_price->ListViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_unit_detail->product_code->Visible) { // product_code ?>
		<!-- product_code -->
		<td<?php echo $tbl_unit_detail->product_code->CellAttributes() ?>>
<span<?php echo $tbl_unit_detail->product_code->ViewAttributes() ?>>
<?php echo $tbl_unit_detail->product_code->ListViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$tbl_unit_detail_preview->ListOptions->Render("body", "right", $tbl_unit_detail_preview->RowCnt);
?>
	</tr>
<?php
	$tbl_unit_detail_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="box-footer ewGridLowerPanel ewPreviewLowerPanel"><!-- .box-footer -->
<?php if ($tbl_unit_detail_preview->TotalRecs > 0) { ?>
<?php if (!isset($tbl_unit_detail_preview->Pager)) $tbl_unit_detail_preview->Pager = new cPrevNextPager($tbl_unit_detail_preview->StartRec, $tbl_unit_detail_preview->DisplayRecs, $tbl_unit_detail_preview->TotalRecs) ?>
<?php if ($tbl_unit_detail_preview->Pager->RecordCount > 0 && $tbl_unit_detail_preview->Pager->Visible) { ?>
<div class="ewPager"><div class="ewPrevNext"><div class="btn-group">
<!--first page button-->
	<?php if ($tbl_unit_detail_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $tbl_unit_detail_preview->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_unit_detail_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $tbl_unit_detail_preview->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
<!--next page button-->
	<?php if ($tbl_unit_detail_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $tbl_unit_detail_preview->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_unit_detail_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $tbl_unit_detail_preview->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div></div></div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_unit_detail_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_unit_detail_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_unit_detail_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ewDetailCount"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ewPreviewOtherOptions">
<?php
	foreach ($tbl_unit_detail_preview->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.box-footer -->
</div><!-- /.box -->
<?php
$tbl_unit_detail_preview->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
if ($tbl_unit_detail_preview->Recordset)
	$tbl_unit_detail_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ew_ConvertToUtf8($content);
?>
<?php
$tbl_unit_detail_preview->Page_Terminate();
?>
