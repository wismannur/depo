<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_customerinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_customer_delete = NULL; // Initialize page object first

class ctbl_customer_delete extends ctbl_customer {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tbl_customer';

	// Page object name
	var $PageObjName = 'tbl_customer_delete';

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

		// Table object (tbl_customer)
		if (!isset($GLOBALS["tbl_customer"]) || get_class($GLOBALS["tbl_customer"]) == "ctbl_customer") {
			$GLOBALS["tbl_customer"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_customer"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_customer', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tbl_customerlist.php"));
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
		$this->customer_code->SetVisibility();
		$this->customer_group->SetVisibility();
		$this->customer_name->SetVisibility();
		$this->contact_name->SetVisibility();
		$this->address1->SetVisibility();
		$this->phone->SetVisibility();
		$this->subwil_id->SetVisibility();
		$this->area_id->SetVisibility();

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
		global $EW_EXPORT, $tbl_customer;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_customer);
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
			$this->Page_Terminate("tbl_customerlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_customer class, tbl_customerinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("tbl_customerlist.php"); // Return to list
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
		$this->customer_id->setDbValue($row['customer_id']);
		$this->customer_code->setDbValue($row['customer_code']);
		$this->customer_group->setDbValue($row['customer_group']);
		$this->customer_name->setDbValue($row['customer_name']);
		$this->contact_name->setDbValue($row['contact_name']);
		$this->address1->setDbValue($row['address1']);
		$this->address2->setDbValue($row['address2']);
		$this->address3->setDbValue($row['address3']);
		$this->phone->setDbValue($row['phone']);
		$this->fax->setDbValue($row['fax']);
		$this->wilayah_id->setDbValue($row['wilayah_id']);
		$this->subwil_id->setDbValue($row['subwil_id']);
		$this->area_id->setDbValue($row['area_id']);
		$this->sales_id->setDbValue($row['sales_id']);
		$this->due_day->setDbValue($row['due_day']);
		$this->ar_acc->setDbValue($row['ar_acc']);
		$this->npwp->setDbValue($row['npwp']);
		$this->discount->setDbValue($row['discount']);
		$this->freight->setDbValue($row['freight']);
		$this->credit_max->setDbValue($row['credit_max']);
		$this->invoice_max->setDbValue($row['invoice_max']);
		$this->saldo_awal->setDbValue($row['saldo_awal']);
		$this->curency->setDbValue($row['curency']);
		$this->kode_depo->setDbValue($row['kode_depo']);
		$this->tax->setDbValue($row['tax']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['customer_id'] = NULL;
		$row['customer_code'] = NULL;
		$row['customer_group'] = NULL;
		$row['customer_name'] = NULL;
		$row['contact_name'] = NULL;
		$row['address1'] = NULL;
		$row['address2'] = NULL;
		$row['address3'] = NULL;
		$row['phone'] = NULL;
		$row['fax'] = NULL;
		$row['wilayah_id'] = NULL;
		$row['subwil_id'] = NULL;
		$row['area_id'] = NULL;
		$row['sales_id'] = NULL;
		$row['due_day'] = NULL;
		$row['ar_acc'] = NULL;
		$row['npwp'] = NULL;
		$row['discount'] = NULL;
		$row['freight'] = NULL;
		$row['credit_max'] = NULL;
		$row['invoice_max'] = NULL;
		$row['saldo_awal'] = NULL;
		$row['curency'] = NULL;
		$row['kode_depo'] = NULL;
		$row['tax'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->customer_id->DbValue = $row['customer_id'];
		$this->customer_code->DbValue = $row['customer_code'];
		$this->customer_group->DbValue = $row['customer_group'];
		$this->customer_name->DbValue = $row['customer_name'];
		$this->contact_name->DbValue = $row['contact_name'];
		$this->address1->DbValue = $row['address1'];
		$this->address2->DbValue = $row['address2'];
		$this->address3->DbValue = $row['address3'];
		$this->phone->DbValue = $row['phone'];
		$this->fax->DbValue = $row['fax'];
		$this->wilayah_id->DbValue = $row['wilayah_id'];
		$this->subwil_id->DbValue = $row['subwil_id'];
		$this->area_id->DbValue = $row['area_id'];
		$this->sales_id->DbValue = $row['sales_id'];
		$this->due_day->DbValue = $row['due_day'];
		$this->ar_acc->DbValue = $row['ar_acc'];
		$this->npwp->DbValue = $row['npwp'];
		$this->discount->DbValue = $row['discount'];
		$this->freight->DbValue = $row['freight'];
		$this->credit_max->DbValue = $row['credit_max'];
		$this->invoice_max->DbValue = $row['invoice_max'];
		$this->saldo_awal->DbValue = $row['saldo_awal'];
		$this->curency->DbValue = $row['curency'];
		$this->kode_depo->DbValue = $row['kode_depo'];
		$this->tax->DbValue = $row['tax'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// customer_id
		// customer_code
		// customer_group
		// customer_name
		// contact_name
		// address1
		// address2
		// address3
		// phone
		// fax
		// wilayah_id
		// subwil_id
		// area_id
		// sales_id
		// due_day
		// ar_acc
		// npwp
		// discount
		// freight
		// credit_max
		// invoice_max
		// saldo_awal
		// curency
		// kode_depo
		// tax

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// customer_id
		$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
		$this->customer_id->ViewCustomAttributes = "";

		// customer_code
		$this->customer_code->ViewValue = $this->customer_code->CurrentValue;
		$this->customer_code->ViewCustomAttributes = "";

		// customer_group
		if (strval($this->customer_group->CurrentValue) <> "") {
			$this->customer_group->ViewValue = $this->customer_group->OptionCaption($this->customer_group->CurrentValue);
		} else {
			$this->customer_group->ViewValue = NULL;
		}
		$this->customer_group->ViewCustomAttributes = "";

		// customer_name
		$this->customer_name->ViewValue = $this->customer_name->CurrentValue;
		$this->customer_name->ViewCustomAttributes = "";

		// contact_name
		$this->contact_name->ViewValue = $this->contact_name->CurrentValue;
		$this->contact_name->ViewCustomAttributes = "";

		// address1
		$this->address1->ViewValue = $this->address1->CurrentValue;
		$this->address1->ViewCustomAttributes = "";

		// address2
		$this->address2->ViewValue = $this->address2->CurrentValue;
		$this->address2->ViewCustomAttributes = "";

		// address3
		$this->address3->ViewValue = $this->address3->CurrentValue;
		$this->address3->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// fax
		$this->fax->ViewValue = $this->fax->CurrentValue;
		$this->fax->ViewCustomAttributes = "";

		// wilayah_id
		if (strval($this->wilayah_id->CurrentValue) <> "") {
			$sFilterWrk = "`wilayah_id`" . ew_SearchString("=", $this->wilayah_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `wilayah_id`, `nama_wilayah` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_wilayah`";
		$sWhereWrk = "";
		$this->wilayah_id->LookupFilters = array();
		$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->wilayah_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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
		$sSqlWrk .= " ORDER BY `area_name`";
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
		$this->area_id->ViewCustomAttributes = "";

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

		// due_day
		$this->due_day->ViewValue = $this->due_day->CurrentValue;
		$this->due_day->ViewCustomAttributes = "";

		// ar_acc
		$this->ar_acc->ViewValue = $this->ar_acc->CurrentValue;
		$this->ar_acc->ViewCustomAttributes = "";

		// npwp
		$this->npwp->ViewValue = $this->npwp->CurrentValue;
		$this->npwp->ViewCustomAttributes = "";

		// discount
		$this->discount->ViewValue = $this->discount->CurrentValue;
		$this->discount->ViewCustomAttributes = "";

		// freight
		$this->freight->ViewValue = $this->freight->CurrentValue;
		$this->freight->ViewCustomAttributes = "";

		// credit_max
		$this->credit_max->ViewValue = $this->credit_max->CurrentValue;
		$this->credit_max->ViewCustomAttributes = "";

		// invoice_max
		$this->invoice_max->ViewValue = $this->invoice_max->CurrentValue;
		$this->invoice_max->ViewCustomAttributes = "";

		// saldo_awal
		$this->saldo_awal->ViewValue = $this->saldo_awal->CurrentValue;
		$this->saldo_awal->ViewCustomAttributes = "";

		// curency
		$this->curency->ViewValue = $this->curency->CurrentValue;
		$this->curency->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

			// customer_code
			$this->customer_code->LinkCustomAttributes = "";
			$this->customer_code->HrefValue = "";
			$this->customer_code->TooltipValue = "";

			// customer_group
			$this->customer_group->LinkCustomAttributes = "";
			$this->customer_group->HrefValue = "";
			$this->customer_group->TooltipValue = "";

			// customer_name
			$this->customer_name->LinkCustomAttributes = "";
			$this->customer_name->HrefValue = "";
			$this->customer_name->TooltipValue = "";

			// contact_name
			$this->contact_name->LinkCustomAttributes = "";
			$this->contact_name->HrefValue = "";
			$this->contact_name->TooltipValue = "";

			// address1
			$this->address1->LinkCustomAttributes = "";
			$this->address1->HrefValue = "";
			$this->address1->TooltipValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";
			$this->phone->TooltipValue = "";

			// subwil_id
			$this->subwil_id->LinkCustomAttributes = "";
			$this->subwil_id->HrefValue = "";
			$this->subwil_id->TooltipValue = "";

			// area_id
			$this->area_id->LinkCustomAttributes = "";
			$this->area_id->HrefValue = "";
			$this->area_id->TooltipValue = "";
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
				$sThisKey .= $row['customer_id'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_customerlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($tbl_customer_delete)) $tbl_customer_delete = new ctbl_customer_delete();

// Page init
$tbl_customer_delete->Page_Init();

// Page main
$tbl_customer_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_customer_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ftbl_customerdelete = new ew_Form("ftbl_customerdelete", "delete");

// Form_CustomValidate event
ftbl_customerdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_customerdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_customerdelete.Lists["x_customer_group"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftbl_customerdelete.Lists["x_customer_group"].Options = <?php echo json_encode($tbl_customer_delete->customer_group->Options()) ?>;
ftbl_customerdelete.Lists["x_subwil_id"] = {"LinkField":"x_sub_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nama_sub_wilayah","","",""],"ParentFields":[],"ChildFields":["x_area_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_subwilayah"};
ftbl_customerdelete.Lists["x_subwil_id"].Data = "<?php echo $tbl_customer_delete->subwil_id->LookupFilterQuery(FALSE, "delete") ?>";
ftbl_customerdelete.Lists["x_area_id"] = {"LinkField":"x_area_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_area_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_callarea"};
ftbl_customerdelete.Lists["x_area_id"].Data = "<?php echo $tbl_customer_delete->area_id->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_customer_delete->ShowPageHeader(); ?>
<?php
$tbl_customer_delete->ShowMessage();
?>
<form name="ftbl_customerdelete" id="ftbl_customerdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_customer_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_customer_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_customer">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_customer_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($tbl_customer->customer_code->Visible) { // customer_code ?>
		<th class="<?php echo $tbl_customer->customer_code->HeaderCellClass() ?>"><span id="elh_tbl_customer_customer_code" class="tbl_customer_customer_code"><?php echo $tbl_customer->customer_code->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->customer_group->Visible) { // customer_group ?>
		<th class="<?php echo $tbl_customer->customer_group->HeaderCellClass() ?>"><span id="elh_tbl_customer_customer_group" class="tbl_customer_customer_group"><?php echo $tbl_customer->customer_group->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->customer_name->Visible) { // customer_name ?>
		<th class="<?php echo $tbl_customer->customer_name->HeaderCellClass() ?>"><span id="elh_tbl_customer_customer_name" class="tbl_customer_customer_name"><?php echo $tbl_customer->customer_name->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->contact_name->Visible) { // contact_name ?>
		<th class="<?php echo $tbl_customer->contact_name->HeaderCellClass() ?>"><span id="elh_tbl_customer_contact_name" class="tbl_customer_contact_name"><?php echo $tbl_customer->contact_name->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->address1->Visible) { // address1 ?>
		<th class="<?php echo $tbl_customer->address1->HeaderCellClass() ?>"><span id="elh_tbl_customer_address1" class="tbl_customer_address1"><?php echo $tbl_customer->address1->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->phone->Visible) { // phone ?>
		<th class="<?php echo $tbl_customer->phone->HeaderCellClass() ?>"><span id="elh_tbl_customer_phone" class="tbl_customer_phone"><?php echo $tbl_customer->phone->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->subwil_id->Visible) { // subwil_id ?>
		<th class="<?php echo $tbl_customer->subwil_id->HeaderCellClass() ?>"><span id="elh_tbl_customer_subwil_id" class="tbl_customer_subwil_id"><?php echo $tbl_customer->subwil_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->area_id->Visible) { // area_id ?>
		<th class="<?php echo $tbl_customer->area_id->HeaderCellClass() ?>"><span id="elh_tbl_customer_area_id" class="tbl_customer_area_id"><?php echo $tbl_customer->area_id->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_customer_delete->RecCnt = 0;
$i = 0;
while (!$tbl_customer_delete->Recordset->EOF) {
	$tbl_customer_delete->RecCnt++;
	$tbl_customer_delete->RowCnt++;

	// Set row properties
	$tbl_customer->ResetAttrs();
	$tbl_customer->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_customer_delete->LoadRowValues($tbl_customer_delete->Recordset);

	// Render row
	$tbl_customer_delete->RenderRow();
?>
	<tr<?php echo $tbl_customer->RowAttributes() ?>>
<?php if ($tbl_customer->customer_code->Visible) { // customer_code ?>
		<td<?php echo $tbl_customer->customer_code->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_customer_code" class="tbl_customer_customer_code">
<span<?php echo $tbl_customer->customer_code->ViewAttributes() ?>>
<?php echo $tbl_customer->customer_code->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->customer_group->Visible) { // customer_group ?>
		<td<?php echo $tbl_customer->customer_group->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_customer_group" class="tbl_customer_customer_group">
<span<?php echo $tbl_customer->customer_group->ViewAttributes() ?>>
<?php echo $tbl_customer->customer_group->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->customer_name->Visible) { // customer_name ?>
		<td<?php echo $tbl_customer->customer_name->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_customer_name" class="tbl_customer_customer_name">
<span<?php echo $tbl_customer->customer_name->ViewAttributes() ?>>
<?php echo $tbl_customer->customer_name->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->contact_name->Visible) { // contact_name ?>
		<td<?php echo $tbl_customer->contact_name->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_contact_name" class="tbl_customer_contact_name">
<span<?php echo $tbl_customer->contact_name->ViewAttributes() ?>>
<?php echo $tbl_customer->contact_name->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->address1->Visible) { // address1 ?>
		<td<?php echo $tbl_customer->address1->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_address1" class="tbl_customer_address1">
<span<?php echo $tbl_customer->address1->ViewAttributes() ?>>
<?php echo $tbl_customer->address1->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->phone->Visible) { // phone ?>
		<td<?php echo $tbl_customer->phone->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_phone" class="tbl_customer_phone">
<span<?php echo $tbl_customer->phone->ViewAttributes() ?>>
<?php echo $tbl_customer->phone->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->subwil_id->Visible) { // subwil_id ?>
		<td<?php echo $tbl_customer->subwil_id->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_subwil_id" class="tbl_customer_subwil_id">
<span<?php echo $tbl_customer->subwil_id->ViewAttributes() ?>>
<?php echo $tbl_customer->subwil_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->area_id->Visible) { // area_id ?>
		<td<?php echo $tbl_customer->area_id->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_area_id" class="tbl_customer_area_id">
<span<?php echo $tbl_customer->area_id->ViewAttributes() ?>>
<?php echo $tbl_customer->area_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_customer_delete->Recordset->MoveNext();
}
$tbl_customer_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_customer_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ftbl_customerdelete.Init();
</script>
<?php
$tbl_customer_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_customer_delete->Page_Terminate();
?>
