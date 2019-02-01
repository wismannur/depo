<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_km_master_arinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_km_master_ar_delete = NULL; // Initialize page object first

class ctr_km_master_ar_delete extends ctr_km_master_ar {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_km_master_ar';

	// Page object name
	var $PageObjName = 'tr_km_master_ar_delete';

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

		// Table object (tr_km_master_ar)
		if (!isset($GLOBALS["tr_km_master_ar"]) || get_class($GLOBALS["tr_km_master_ar"]) == "ctr_km_master_ar") {
			$GLOBALS["tr_km_master_ar"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_km_master_ar"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		$this->km_nomor->SetVisibility();
		$this->km_tanggal->SetVisibility();
		$this->customer_id->SetVisibility();
		$this->cek_no->SetVisibility();
		$this->tgl_jt->SetVisibility();
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
			$this->Page_Terminate("tr_km_master_arlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tr_km_master_ar class, tr_km_master_arinfo.php

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
				$this->Page_Terminate("tr_km_master_arlist.php"); // Return to list
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
		$this->kas_amt->setDbValue($row['kas_amt']);
		$this->kode_depo->setDbValue($row['kode_depo']);
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
		$row['kas_amt'] = NULL;
		$row['kode_depo'] = NULL;
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
		$this->kas_amt->DbValue = $row['kas_amt'];
		$this->kode_depo->DbValue = $row['kode_depo'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
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
		// kas_amt
		// kode_depo

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
		$this->km_tanggal->CellCssStyle .= "text-align: center;";
		$this->km_tanggal->ViewCustomAttributes = "";

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
		$this->cek_amt->ViewValue = ew_FormatNumber($this->cek_amt->ViewValue, 0, -2, -2, -2);
		$this->cek_amt->CellCssStyle .= "text-align: right;";
		$this->cek_amt->ViewCustomAttributes = "";

		// ret_number1
		if (strval($this->ret_number1->CurrentValue) <> "") {
			$sFilterWrk = "`ret_number`" . ew_SearchString("=", $this->ret_number1->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `ret_number`, `ret_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_ret_master`";
		$sWhereWrk = "";
		$this->ret_number1->LookupFilters = array();
		$lookuptblfilter = (isset($_GET["customer_id"]))? "`customer_id` = '".@$_GET["customer_id"]."' AND `kode_depo` = '".@$_SESSION["KodeDepo"]."'" : "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ret_number1, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `ret_number` DESC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->ret_number1->ViewValue = $this->ret_number1->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ret_number1->ViewValue = $this->ret_number1->CurrentValue;
			}
		} else {
			$this->ret_number1->ViewValue = NULL;
		}
		$this->ret_number1->ViewCustomAttributes = "";

		// ret_date1
		$this->ret_date1->ViewValue = $this->ret_date1->CurrentValue;
		$this->ret_date1->ViewValue = ew_FormatDateTime($this->ret_date1->ViewValue, 0);
		$this->ret_date1->CellCssStyle .= "text-align: center;";
		$this->ret_date1->ViewCustomAttributes = "";

		// retur_amt1
		$this->retur_amt1->ViewValue = $this->retur_amt1->CurrentValue;
		$this->retur_amt1->ViewValue = ew_FormatNumber($this->retur_amt1->ViewValue, 0, -2, -2, -2);
		$this->retur_amt1->CellCssStyle .= "text-align: right;";
		$this->retur_amt1->ViewCustomAttributes = "";

		// ret_number2
		if (strval($this->ret_number2->CurrentValue) <> "") {
			$sFilterWrk = "`ret_number`" . ew_SearchString("=", $this->ret_number2->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `ret_number`, `ret_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_ret_master`";
		$sWhereWrk = "";
		$this->ret_number2->LookupFilters = array();
		$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ret_number2, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `ret_number` DESC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->ret_number2->ViewValue = $this->ret_number2->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ret_number2->ViewValue = $this->ret_number2->CurrentValue;
			}
		} else {
			$this->ret_number2->ViewValue = NULL;
		}
		$this->ret_number2->ViewCustomAttributes = "";

		// ret_date2
		$this->ret_date2->ViewValue = $this->ret_date2->CurrentValue;
		$this->ret_date2->ViewValue = ew_FormatDateTime($this->ret_date2->ViewValue, 0);
		$this->ret_date2->CellCssStyle .= "text-align: justify;";
		$this->ret_date2->ViewCustomAttributes = "";

		// retur_amt2
		$this->retur_amt2->ViewValue = $this->retur_amt2->CurrentValue;
		$this->retur_amt2->ViewValue = ew_FormatNumber($this->retur_amt2->ViewValue, 0, -2, -2, -2);
		$this->retur_amt2->CellCssStyle .= "text-align: right;";
		$this->retur_amt2->ViewCustomAttributes = "";

		// ret_number3
		if (strval($this->ret_number3->CurrentValue) <> "") {
			$sFilterWrk = "`ret_number`" . ew_SearchString("=", $this->ret_number3->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `ret_number`, `ret_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_ret_master`";
		$sWhereWrk = "";
		$this->ret_number3->LookupFilters = array();
		$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ret_number3, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `ret_number` DESC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->ret_number3->ViewValue = $this->ret_number3->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ret_number3->ViewValue = $this->ret_number3->CurrentValue;
			}
		} else {
			$this->ret_number3->ViewValue = NULL;
		}
		$this->ret_number3->ViewCustomAttributes = "";

		// ret_date3
		$this->ret_date3->ViewValue = $this->ret_date3->CurrentValue;
		$this->ret_date3->ViewValue = ew_FormatDateTime($this->ret_date3->ViewValue, 0);
		$this->ret_date3->CellCssStyle .= "text-align: center;";
		$this->ret_date3->ViewCustomAttributes = "";

		// retur_amt3
		$this->retur_amt3->ViewValue = $this->retur_amt3->CurrentValue;
		$this->retur_amt3->ViewValue = ew_FormatNumber($this->retur_amt3->ViewValue, 0, -2, -2, -2);
		$this->retur_amt3->CellCssStyle .= "text-align: center;";
		$this->retur_amt3->ViewCustomAttributes = "";

		// tunai_amt
		$this->tunai_amt->ViewValue = $this->tunai_amt->CurrentValue;
		$this->tunai_amt->ViewValue = ew_FormatNumber($this->tunai_amt->ViewValue, 0, -2, -2, -2);
		$this->tunai_amt->CellCssStyle .= "text-align: right;";
		$this->tunai_amt->ViewCustomAttributes = "";

		// dp_amt
		$this->dp_amt->ViewValue = $this->dp_amt->CurrentValue;
		$this->dp_amt->ViewValue = ew_FormatNumber($this->dp_amt->ViewValue, 0, -2, -2, -2);
		$this->dp_amt->CellCssStyle .= "text-align: right;";
		$this->dp_amt->ViewCustomAttributes = "";

		// km_amt
		$this->km_amt->ViewValue = $this->km_amt->CurrentValue;
		$this->km_amt->ViewValue = ew_FormatNumber($this->km_amt->ViewValue, 0, -2, -2, -2);
		$this->km_amt->CellCssStyle .= "text-align: right;";
		$this->km_amt->ViewCustomAttributes = "";

		// km_notes
		$this->km_notes->ViewValue = $this->km_notes->CurrentValue;
		$this->km_notes->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

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

			// cek_no
			$this->cek_no->LinkCustomAttributes = "";
			$this->cek_no->HrefValue = "";
			$this->cek_no->TooltipValue = "";

			// tgl_jt
			$this->tgl_jt->LinkCustomAttributes = "";
			$this->tgl_jt->HrefValue = "";
			$this->tgl_jt->TooltipValue = "";

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_km_master_arlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($tr_km_master_ar_delete)) $tr_km_master_ar_delete = new ctr_km_master_ar_delete();

// Page init
$tr_km_master_ar_delete->Page_Init();

// Page main
$tr_km_master_ar_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_km_master_ar_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ftr_km_master_ardelete = new ew_Form("ftr_km_master_ardelete", "delete");

// Form_CustomValidate event
ftr_km_master_ardelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_km_master_ardelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_km_master_ardelete.Lists["x_customer_id"] = {"LinkField":"x_customer_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_customer_name","","",""],"ParentFields":[],"ChildFields":["tr_km_item_ar x_customer_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_customer"};
ftr_km_master_ardelete.Lists["x_customer_id"].Data = "<?php echo $tr_km_master_ar_delete->customer_id->LookupFilterQuery(FALSE, "delete") ?>";
ftr_km_master_ardelete.AutoSuggests["x_customer_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $tr_km_master_ar_delete->customer_id->LookupFilterQuery(TRUE, "delete"))) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tr_km_master_ar_delete->ShowPageHeader(); ?>
<?php
$tr_km_master_ar_delete->ShowMessage();
?>
<form name="ftr_km_master_ardelete" id="ftr_km_master_ardelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_km_master_ar_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_km_master_ar_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_km_master_ar">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tr_km_master_ar_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($tr_km_master_ar->km_nomor->Visible) { // km_nomor ?>
		<th class="<?php echo $tr_km_master_ar->km_nomor->HeaderCellClass() ?>"><span id="elh_tr_km_master_ar_km_nomor" class="tr_km_master_ar_km_nomor"><?php echo $tr_km_master_ar->km_nomor->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_km_master_ar->km_tanggal->Visible) { // km_tanggal ?>
		<th class="<?php echo $tr_km_master_ar->km_tanggal->HeaderCellClass() ?>"><span id="elh_tr_km_master_ar_km_tanggal" class="tr_km_master_ar_km_tanggal"><?php echo $tr_km_master_ar->km_tanggal->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_km_master_ar->customer_id->Visible) { // customer_id ?>
		<th class="<?php echo $tr_km_master_ar->customer_id->HeaderCellClass() ?>"><span id="elh_tr_km_master_ar_customer_id" class="tr_km_master_ar_customer_id"><?php echo $tr_km_master_ar->customer_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_km_master_ar->cek_no->Visible) { // cek_no ?>
		<th class="<?php echo $tr_km_master_ar->cek_no->HeaderCellClass() ?>"><span id="elh_tr_km_master_ar_cek_no" class="tr_km_master_ar_cek_no"><?php echo $tr_km_master_ar->cek_no->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_km_master_ar->tgl_jt->Visible) { // tgl_jt ?>
		<th class="<?php echo $tr_km_master_ar->tgl_jt->HeaderCellClass() ?>"><span id="elh_tr_km_master_ar_tgl_jt" class="tr_km_master_ar_tgl_jt"><?php echo $tr_km_master_ar->tgl_jt->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_km_master_ar->km_amt->Visible) { // km_amt ?>
		<th class="<?php echo $tr_km_master_ar->km_amt->HeaderCellClass() ?>"><span id="elh_tr_km_master_ar_km_amt" class="tr_km_master_ar_km_amt"><?php echo $tr_km_master_ar->km_amt->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_km_master_ar->km_notes->Visible) { // km_notes ?>
		<th class="<?php echo $tr_km_master_ar->km_notes->HeaderCellClass() ?>"><span id="elh_tr_km_master_ar_km_notes" class="tr_km_master_ar_km_notes"><?php echo $tr_km_master_ar->km_notes->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tr_km_master_ar_delete->RecCnt = 0;
$i = 0;
while (!$tr_km_master_ar_delete->Recordset->EOF) {
	$tr_km_master_ar_delete->RecCnt++;
	$tr_km_master_ar_delete->RowCnt++;

	// Set row properties
	$tr_km_master_ar->ResetAttrs();
	$tr_km_master_ar->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tr_km_master_ar_delete->LoadRowValues($tr_km_master_ar_delete->Recordset);

	// Render row
	$tr_km_master_ar_delete->RenderRow();
?>
	<tr<?php echo $tr_km_master_ar->RowAttributes() ?>>
<?php if ($tr_km_master_ar->km_nomor->Visible) { // km_nomor ?>
		<td<?php echo $tr_km_master_ar->km_nomor->CellAttributes() ?>>
<span id="el<?php echo $tr_km_master_ar_delete->RowCnt ?>_tr_km_master_ar_km_nomor" class="tr_km_master_ar_km_nomor">
<span<?php echo $tr_km_master_ar->km_nomor->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->km_nomor->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_km_master_ar->km_tanggal->Visible) { // km_tanggal ?>
		<td<?php echo $tr_km_master_ar->km_tanggal->CellAttributes() ?>>
<span id="el<?php echo $tr_km_master_ar_delete->RowCnt ?>_tr_km_master_ar_km_tanggal" class="tr_km_master_ar_km_tanggal">
<span<?php echo $tr_km_master_ar->km_tanggal->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->km_tanggal->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_km_master_ar->customer_id->Visible) { // customer_id ?>
		<td<?php echo $tr_km_master_ar->customer_id->CellAttributes() ?>>
<span id="el<?php echo $tr_km_master_ar_delete->RowCnt ?>_tr_km_master_ar_customer_id" class="tr_km_master_ar_customer_id">
<span<?php echo $tr_km_master_ar->customer_id->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->customer_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_km_master_ar->cek_no->Visible) { // cek_no ?>
		<td<?php echo $tr_km_master_ar->cek_no->CellAttributes() ?>>
<span id="el<?php echo $tr_km_master_ar_delete->RowCnt ?>_tr_km_master_ar_cek_no" class="tr_km_master_ar_cek_no">
<span<?php echo $tr_km_master_ar->cek_no->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->cek_no->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_km_master_ar->tgl_jt->Visible) { // tgl_jt ?>
		<td<?php echo $tr_km_master_ar->tgl_jt->CellAttributes() ?>>
<span id="el<?php echo $tr_km_master_ar_delete->RowCnt ?>_tr_km_master_ar_tgl_jt" class="tr_km_master_ar_tgl_jt">
<span<?php echo $tr_km_master_ar->tgl_jt->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->tgl_jt->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_km_master_ar->km_amt->Visible) { // km_amt ?>
		<td<?php echo $tr_km_master_ar->km_amt->CellAttributes() ?>>
<span id="el<?php echo $tr_km_master_ar_delete->RowCnt ?>_tr_km_master_ar_km_amt" class="tr_km_master_ar_km_amt">
<span<?php echo $tr_km_master_ar->km_amt->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->km_amt->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_km_master_ar->km_notes->Visible) { // km_notes ?>
		<td<?php echo $tr_km_master_ar->km_notes->CellAttributes() ?>>
<span id="el<?php echo $tr_km_master_ar_delete->RowCnt ?>_tr_km_master_ar_km_notes" class="tr_km_master_ar_km_notes">
<span<?php echo $tr_km_master_ar->km_notes->ViewAttributes() ?>>
<?php echo $tr_km_master_ar->km_notes->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tr_km_master_ar_delete->Recordset->MoveNext();
}
$tr_km_master_ar_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tr_km_master_ar_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ftr_km_master_ardelete.Init();
</script>
<?php
$tr_km_master_ar_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_km_master_ar_delete->Page_Terminate();
?>
