<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_inv_canvas_masterinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_inv_canvas_master_delete = NULL; // Initialize page object first

class ctr_inv_canvas_master_delete extends ctr_inv_canvas_master {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_inv_canvas_master';

	// Page object name
	var $PageObjName = 'tr_inv_canvas_master_delete';

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

		// Table object (tr_inv_canvas_master)
		if (!isset($GLOBALS["tr_inv_canvas_master"]) || get_class($GLOBALS["tr_inv_canvas_master"]) == "ctr_inv_canvas_master") {
			$GLOBALS["tr_inv_canvas_master"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_inv_canvas_master"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_inv_canvas_master', TRUE);

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
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("tr_inv_canvas_masterlist.php"));
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
		global $EW_EXPORT, $tr_inv_canvas_master;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_inv_canvas_master);
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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("tr_inv_canvas_masterlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tr_inv_canvas_master class, tr_inv_canvas_masterinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "D"; // Delete record directly
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("tr_inv_canvas_masterlist.php"); // Return to list
			}
		}
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
		$this->address1->setDbValue($row['address1']);
		$this->address2->setDbValue($row['address2']);
		$this->address3->setDbValue($row['address3']);
		$this->wilayah_id->setDbValue($row['wilayah_id']);
		$this->subwil_id->setDbValue($row['subwil_id']);
		$this->area_id->setDbValue($row['area_id']);
		$this->customer_name->setDbValue($row['customer_name']);
		$this->tax_number->setDbValue($row['tax_number']);
		$this->tc_number->setDbValue($row['tc_number']);
		$this->inv_amt->setDbValue($row['inv_amt']);
		$this->discount->setDbValue($row['discount']);
		$this->total_discount->setDbValue($row['total_discount']);
		$this->is_tax->setDbValue($row['is_tax']);
		$this->tax_total->setDbValue($row['tax_total']);
		$this->inv_total->setDbValue($row['inv_total']);
		$this->paid_amt->setDbValue($row['paid_amt']);
		$this->sales_id->setDbValue($row['sales_id']);
		$this->paid->setDbValue($row['paid']);
		$this->user_id->setDbValue($row['user_id']);
		$this->lastupdate->setDbValue($row['lastupdate']);
		$this->kode_depo->setDbValue($row['kode_depo']);
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
		$row['address1'] = NULL;
		$row['address2'] = NULL;
		$row['address3'] = NULL;
		$row['wilayah_id'] = NULL;
		$row['subwil_id'] = NULL;
		$row['area_id'] = NULL;
		$row['customer_name'] = NULL;
		$row['tax_number'] = NULL;
		$row['tc_number'] = NULL;
		$row['inv_amt'] = NULL;
		$row['discount'] = NULL;
		$row['total_discount'] = NULL;
		$row['is_tax'] = NULL;
		$row['tax_total'] = NULL;
		$row['inv_total'] = NULL;
		$row['paid_amt'] = NULL;
		$row['sales_id'] = NULL;
		$row['paid'] = NULL;
		$row['user_id'] = NULL;
		$row['lastupdate'] = NULL;
		$row['kode_depo'] = NULL;
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
		$this->address1->DbValue = $row['address1'];
		$this->address2->DbValue = $row['address2'];
		$this->address3->DbValue = $row['address3'];
		$this->wilayah_id->DbValue = $row['wilayah_id'];
		$this->subwil_id->DbValue = $row['subwil_id'];
		$this->area_id->DbValue = $row['area_id'];
		$this->customer_name->DbValue = $row['customer_name'];
		$this->tax_number->DbValue = $row['tax_number'];
		$this->tc_number->DbValue = $row['tc_number'];
		$this->inv_amt->DbValue = $row['inv_amt'];
		$this->discount->DbValue = $row['discount'];
		$this->total_discount->DbValue = $row['total_discount'];
		$this->is_tax->DbValue = $row['is_tax'];
		$this->tax_total->DbValue = $row['tax_total'];
		$this->inv_total->DbValue = $row['inv_total'];
		$this->paid_amt->DbValue = $row['paid_amt'];
		$this->sales_id->DbValue = $row['sales_id'];
		$this->paid->DbValue = $row['paid'];
		$this->user_id->DbValue = $row['user_id'];
		$this->lastupdate->DbValue = $row['lastupdate'];
		$this->kode_depo->DbValue = $row['kode_depo'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
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
		// address1
		// address2
		// address3
		// wilayah_id
		// subwil_id
		// area_id
		// customer_name
		// tax_number
		// tc_number
		// inv_amt
		// discount
		// total_discount
		// is_tax
		// tax_total
		// inv_total
		// paid_amt
		// sales_id
		// paid
		// user_id
		// lastupdate
		// kode_depo

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// inv_id
		$this->inv_id->ViewValue = $this->inv_id->CurrentValue;
		$this->inv_id->ViewCustomAttributes = "";

		// inv_number
		$this->inv_number->ViewValue = $this->inv_number->CurrentValue;
		$this->inv_number->ViewCustomAttributes = "";

		// inv_date
		$this->inv_date->ViewValue = $this->inv_date->CurrentValue;
		$this->inv_date->ViewValue = ew_FormatDateTime($this->inv_date->ViewValue, 7);
		$this->inv_date->ViewCustomAttributes = "";

		// tax_type
		$this->tax_type->ViewValue = $this->tax_type->CurrentValue;
		$this->tax_type->ViewCustomAttributes = "";

		// due_date
		$this->due_date->ViewValue = $this->due_date->CurrentValue;
		$this->due_date->ViewValue = ew_FormatDateTime($this->due_date->ViewValue, 7);
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
		$this->wilayah_id->ViewValue = $this->wilayah_id->CurrentValue;
		$this->wilayah_id->ViewCustomAttributes = "";

		// subwil_id
		$this->subwil_id->ViewValue = $this->subwil_id->CurrentValue;
		$this->subwil_id->ViewCustomAttributes = "";

		// area_id
		$this->area_id->ViewValue = $this->area_id->CurrentValue;
		$this->area_id->ViewCustomAttributes = "";

		// customer_name
		$this->customer_name->ViewValue = $this->customer_name->CurrentValue;
		$this->customer_name->ViewCustomAttributes = "";

		// tax_number
		$this->tax_number->ViewValue = $this->tax_number->CurrentValue;
		$this->tax_number->ViewCustomAttributes = "";

		// tc_number
		$this->tc_number->ViewValue = $this->tc_number->CurrentValue;
		$this->tc_number->ViewCustomAttributes = "";

		// inv_amt
		$this->inv_amt->ViewValue = $this->inv_amt->CurrentValue;
		$this->inv_amt->ViewValue = ew_FormatNumber($this->inv_amt->ViewValue, 2, -2, -2, -2);
		$this->inv_amt->CellCssStyle .= "text-align: right;";
		$this->inv_amt->ViewCustomAttributes = "";

		// discount
		$this->discount->ViewValue = $this->discount->CurrentValue;
		$this->discount->ViewValue = ew_FormatNumber($this->discount->ViewValue, 2, -2, -2, -2);
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
		$this->paid_amt->ViewValue = ew_FormatNumber($this->paid_amt->ViewValue, 2, -2, -2, -2);
		$this->paid_amt->CellCssStyle .= "text-align: right;";
		$this->paid_amt->ViewCustomAttributes = "";

		// sales_id
		$this->sales_id->ViewValue = $this->sales_id->CurrentValue;
		$this->sales_id->ViewCustomAttributes = "";

		// paid
		if (ew_ConvertToBool($this->paid->CurrentValue)) {
			$this->paid->ViewValue = $this->paid->FldTagCaption(1) <> "" ? $this->paid->FldTagCaption(1) : "1";
		} else {
			$this->paid->ViewValue = $this->paid->FldTagCaption(2) <> "" ? $this->paid->FldTagCaption(2) : "0";
		}
		$this->paid->CellCssStyle .= "text-align: center;";
		$this->paid->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// lastupdate
		$this->lastupdate->ViewValue = $this->lastupdate->CurrentValue;
		$this->lastupdate->ViewValue = ew_FormatDateTime($this->lastupdate->ViewValue, 0);
		$this->lastupdate->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

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
		$conn->BeginTrans();

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
				$sThisKey .= $row['inv_id'];
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
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_inv_canvas_masterlist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($tr_inv_canvas_master_delete)) $tr_inv_canvas_master_delete = new ctr_inv_canvas_master_delete();

// Page init
$tr_inv_canvas_master_delete->Page_Init();

// Page main
$tr_inv_canvas_master_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_inv_canvas_master_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ftr_inv_canvas_masterdelete = new ew_Form("ftr_inv_canvas_masterdelete", "delete");

// Form_CustomValidate event
ftr_inv_canvas_masterdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_inv_canvas_masterdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_inv_canvas_masterdelete.Lists["x_customer_id"] = {"LinkField":"x_customer_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_customer_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_customer"};
ftr_inv_canvas_masterdelete.Lists["x_customer_id"].Data = "<?php echo $tr_inv_canvas_master_delete->customer_id->LookupFilterQuery(FALSE, "delete") ?>";
ftr_inv_canvas_masterdelete.AutoSuggests["x_customer_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $tr_inv_canvas_master_delete->customer_id->LookupFilterQuery(TRUE, "delete"))) ?>;
ftr_inv_canvas_masterdelete.Lists["x_paid[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftr_inv_canvas_masterdelete.Lists["x_paid[]"].Options = <?php echo json_encode($tr_inv_canvas_master_delete->paid->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tr_inv_canvas_master_delete->ShowPageHeader(); ?>
<?php
$tr_inv_canvas_master_delete->ShowMessage();
?>
<form name="ftr_inv_canvas_masterdelete" id="ftr_inv_canvas_masterdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_inv_canvas_master_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_inv_canvas_master_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_inv_canvas_master">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tr_inv_canvas_master_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($tr_inv_canvas_master->inv_number->Visible) { // inv_number ?>
		<th class="<?php echo $tr_inv_canvas_master->inv_number->HeaderCellClass() ?>"><span id="elh_tr_inv_canvas_master_inv_number" class="tr_inv_canvas_master_inv_number"><?php echo $tr_inv_canvas_master->inv_number->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_inv_canvas_master->inv_date->Visible) { // inv_date ?>
		<th class="<?php echo $tr_inv_canvas_master->inv_date->HeaderCellClass() ?>"><span id="elh_tr_inv_canvas_master_inv_date" class="tr_inv_canvas_master_inv_date"><?php echo $tr_inv_canvas_master->inv_date->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_inv_canvas_master->due_date->Visible) { // due_date ?>
		<th class="<?php echo $tr_inv_canvas_master->due_date->HeaderCellClass() ?>"><span id="elh_tr_inv_canvas_master_due_date" class="tr_inv_canvas_master_due_date"><?php echo $tr_inv_canvas_master->due_date->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_inv_canvas_master->customer_id->Visible) { // customer_id ?>
		<th class="<?php echo $tr_inv_canvas_master->customer_id->HeaderCellClass() ?>"><span id="elh_tr_inv_canvas_master_customer_id" class="tr_inv_canvas_master_customer_id"><?php echo $tr_inv_canvas_master->customer_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_inv_canvas_master->area_id->Visible) { // area_id ?>
		<th class="<?php echo $tr_inv_canvas_master->area_id->HeaderCellClass() ?>"><span id="elh_tr_inv_canvas_master_area_id" class="tr_inv_canvas_master_area_id"><?php echo $tr_inv_canvas_master->area_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_inv_canvas_master->inv_total->Visible) { // inv_total ?>
		<th class="<?php echo $tr_inv_canvas_master->inv_total->HeaderCellClass() ?>"><span id="elh_tr_inv_canvas_master_inv_total" class="tr_inv_canvas_master_inv_total"><?php echo $tr_inv_canvas_master->inv_total->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_inv_canvas_master->sales_id->Visible) { // sales_id ?>
		<th class="<?php echo $tr_inv_canvas_master->sales_id->HeaderCellClass() ?>"><span id="elh_tr_inv_canvas_master_sales_id" class="tr_inv_canvas_master_sales_id"><?php echo $tr_inv_canvas_master->sales_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_inv_canvas_master->paid->Visible) { // paid ?>
		<th class="<?php echo $tr_inv_canvas_master->paid->HeaderCellClass() ?>"><span id="elh_tr_inv_canvas_master_paid" class="tr_inv_canvas_master_paid"><?php echo $tr_inv_canvas_master->paid->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tr_inv_canvas_master_delete->RecCnt = 0;
$i = 0;
while (!$tr_inv_canvas_master_delete->Recordset->EOF) {
	$tr_inv_canvas_master_delete->RecCnt++;
	$tr_inv_canvas_master_delete->RowCnt++;

	// Set row properties
	$tr_inv_canvas_master->ResetAttrs();
	$tr_inv_canvas_master->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tr_inv_canvas_master_delete->LoadRowValues($tr_inv_canvas_master_delete->Recordset);

	// Render row
	$tr_inv_canvas_master_delete->RenderRow();
?>
	<tr<?php echo $tr_inv_canvas_master->RowAttributes() ?>>
<?php if ($tr_inv_canvas_master->inv_number->Visible) { // inv_number ?>
		<td<?php echo $tr_inv_canvas_master->inv_number->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_canvas_master_delete->RowCnt ?>_tr_inv_canvas_master_inv_number" class="tr_inv_canvas_master_inv_number">
<span<?php echo $tr_inv_canvas_master->inv_number->ViewAttributes() ?>>
<?php echo $tr_inv_canvas_master->inv_number->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_inv_canvas_master->inv_date->Visible) { // inv_date ?>
		<td<?php echo $tr_inv_canvas_master->inv_date->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_canvas_master_delete->RowCnt ?>_tr_inv_canvas_master_inv_date" class="tr_inv_canvas_master_inv_date">
<span<?php echo $tr_inv_canvas_master->inv_date->ViewAttributes() ?>>
<?php echo $tr_inv_canvas_master->inv_date->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_inv_canvas_master->due_date->Visible) { // due_date ?>
		<td<?php echo $tr_inv_canvas_master->due_date->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_canvas_master_delete->RowCnt ?>_tr_inv_canvas_master_due_date" class="tr_inv_canvas_master_due_date">
<span<?php echo $tr_inv_canvas_master->due_date->ViewAttributes() ?>>
<?php echo $tr_inv_canvas_master->due_date->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_inv_canvas_master->customer_id->Visible) { // customer_id ?>
		<td<?php echo $tr_inv_canvas_master->customer_id->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_canvas_master_delete->RowCnt ?>_tr_inv_canvas_master_customer_id" class="tr_inv_canvas_master_customer_id">
<span<?php echo $tr_inv_canvas_master->customer_id->ViewAttributes() ?>>
<?php echo $tr_inv_canvas_master->customer_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_inv_canvas_master->area_id->Visible) { // area_id ?>
		<td<?php echo $tr_inv_canvas_master->area_id->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_canvas_master_delete->RowCnt ?>_tr_inv_canvas_master_area_id" class="tr_inv_canvas_master_area_id">
<span<?php echo $tr_inv_canvas_master->area_id->ViewAttributes() ?>>
<?php echo $tr_inv_canvas_master->area_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_inv_canvas_master->inv_total->Visible) { // inv_total ?>
		<td<?php echo $tr_inv_canvas_master->inv_total->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_canvas_master_delete->RowCnt ?>_tr_inv_canvas_master_inv_total" class="tr_inv_canvas_master_inv_total">
<span<?php echo $tr_inv_canvas_master->inv_total->ViewAttributes() ?>>
<?php echo $tr_inv_canvas_master->inv_total->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_inv_canvas_master->sales_id->Visible) { // sales_id ?>
		<td<?php echo $tr_inv_canvas_master->sales_id->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_canvas_master_delete->RowCnt ?>_tr_inv_canvas_master_sales_id" class="tr_inv_canvas_master_sales_id">
<span<?php echo $tr_inv_canvas_master->sales_id->ViewAttributes() ?>>
<?php echo $tr_inv_canvas_master->sales_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_inv_canvas_master->paid->Visible) { // paid ?>
		<td<?php echo $tr_inv_canvas_master->paid->CellAttributes() ?>>
<span id="el<?php echo $tr_inv_canvas_master_delete->RowCnt ?>_tr_inv_canvas_master_paid" class="tr_inv_canvas_master_paid">
<span<?php echo $tr_inv_canvas_master->paid->ViewAttributes() ?>>
<?php if (ew_ConvertToBool($tr_inv_canvas_master->paid->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $tr_inv_canvas_master->paid->ListViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $tr_inv_canvas_master->paid->ListViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tr_inv_canvas_master_delete->Recordset->MoveNext();
}
$tr_inv_canvas_master_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tr_inv_canvas_master_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ftr_inv_canvas_masterdelete.Init();
</script>
<?php
$tr_inv_canvas_master_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_inv_canvas_master_delete->Page_Terminate();
?>
