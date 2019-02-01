<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_sjd_iteminfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tr_sjd_masterinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_sjd_item_delete = NULL; // Initialize page object first

class ctr_sjd_item_delete extends ctr_sjd_item {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_sjd_item';

	// Page object name
	var $PageObjName = 'tr_sjd_item_delete';

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

		// Table object (tr_sjd_item)
		if (!isset($GLOBALS["tr_sjd_item"]) || get_class($GLOBALS["tr_sjd_item"]) == "ctr_sjd_item") {
			$GLOBALS["tr_sjd_item"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_sjd_item"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Table object (tr_sjd_master)
		if (!isset($GLOBALS['tr_sjd_master'])) $GLOBALS['tr_sjd_master'] = new ctr_sjd_master();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_sjd_item', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tr_sjd_itemlist.php"));
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
		$this->item_id->SetVisibility();
		$this->item_code->SetVisibility();
		$this->unit_id->SetVisibility();
		$this->item_price->SetVisibility();
		$this->item_qty->SetVisibility();
		$this->qty_rcv->SetVisibility();
		$this->cek_sjd->SetVisibility();

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
		global $EW_EXPORT, $tr_sjd_item;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_sjd_item);
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

		// Set up master/detail parameters
		$this->SetupMasterParms();

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("tr_sjd_itemlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tr_sjd_item class, tr_sjd_iteminfo.php

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
				$this->Page_Terminate("tr_sjd_itemlist.php"); // Return to list
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
		$this->master_id->setDbValue($row['master_id']);
		$this->item_id->setDbValue($row['item_id']);
		$this->item_code->setDbValue($row['item_code']);
		$this->unit_id->setDbValue($row['unit_id']);
		$this->item_price->setDbValue($row['item_price']);
		$this->item_qty->setDbValue($row['item_qty']);
		$this->qty_rcv->setDbValue($row['qty_rcv']);
		$this->item_name->setDbValue($row['item_name']);
		$this->udet_id->setDbValue($row['udet_id']);
		$this->cek_sjd->setDbValue($row['cek_sjd']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['row_id'] = NULL;
		$row['master_id'] = NULL;
		$row['item_id'] = NULL;
		$row['item_code'] = NULL;
		$row['unit_id'] = NULL;
		$row['item_price'] = NULL;
		$row['item_qty'] = NULL;
		$row['qty_rcv'] = NULL;
		$row['item_name'] = NULL;
		$row['udet_id'] = NULL;
		$row['cek_sjd'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->row_id->DbValue = $row['row_id'];
		$this->master_id->DbValue = $row['master_id'];
		$this->item_id->DbValue = $row['item_id'];
		$this->item_code->DbValue = $row['item_code'];
		$this->unit_id->DbValue = $row['unit_id'];
		$this->item_price->DbValue = $row['item_price'];
		$this->item_qty->DbValue = $row['item_qty'];
		$this->qty_rcv->DbValue = $row['qty_rcv'];
		$this->item_name->DbValue = $row['item_name'];
		$this->udet_id->DbValue = $row['udet_id'];
		$this->cek_sjd->DbValue = $row['cek_sjd'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->item_price->FormValue == $this->item_price->CurrentValue && is_numeric(ew_StrToFloat($this->item_price->CurrentValue)))
			$this->item_price->CurrentValue = ew_StrToFloat($this->item_price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->item_qty->FormValue == $this->item_qty->CurrentValue && is_numeric(ew_StrToFloat($this->item_qty->CurrentValue)))
			$this->item_qty->CurrentValue = ew_StrToFloat($this->item_qty->CurrentValue);

		// Convert decimal values if posted back
		if ($this->qty_rcv->FormValue == $this->qty_rcv->CurrentValue && is_numeric(ew_StrToFloat($this->qty_rcv->CurrentValue)))
			$this->qty_rcv->CurrentValue = ew_StrToFloat($this->qty_rcv->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// row_id
		// master_id
		// item_id
		// item_code
		// unit_id
		// item_price
		// item_qty
		// qty_rcv
		// item_name
		// udet_id
		// cek_sjd

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// row_id
		$this->row_id->ViewValue = $this->row_id->CurrentValue;
		$this->row_id->ViewCustomAttributes = "";

		// master_id
		$this->master_id->ViewValue = $this->master_id->CurrentValue;
		$this->master_id->ViewCustomAttributes = "";

		// item_id
		$this->item_id->ViewValue = $this->item_id->CurrentValue;
		if (strval($this->item_id->CurrentValue) <> "") {
			$sFilterWrk = "`product_id`" . ew_SearchString("=", $this->item_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `product_id`, `product_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_products`";
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

		// unit_id
		if (strval($this->unit_id->CurrentValue) <> "") {
			$sFilterWrk = "`unit_id`" . ew_SearchString("=", $this->unit_id->CurrentValue, EW_DATATYPE_STRING, "db_inventory_pusat");
		$sSqlWrk = "SELECT `unit_id`, `unit_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_unit_detail`";
		$sWhereWrk = "";
		$this->unit_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->unit_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->unit_id->ViewValue = $this->unit_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->unit_id->ViewValue = $this->unit_id->CurrentValue;
			}
		} else {
			$this->unit_id->ViewValue = NULL;
		}
		$this->unit_id->ViewCustomAttributes = "";

		// item_price
		$this->item_price->ViewValue = $this->item_price->CurrentValue;
		$this->item_price->ViewValue = ew_FormatNumber($this->item_price->ViewValue, 2, -2, -2, -2);
		$this->item_price->CellCssStyle .= "text-align: right;";
		$this->item_price->ViewCustomAttributes = "";

		// item_qty
		$this->item_qty->ViewValue = $this->item_qty->CurrentValue;
		$this->item_qty->ViewValue = ew_FormatNumber($this->item_qty->ViewValue, 2, -2, -2, -2);
		$this->item_qty->CellCssStyle .= "text-align: right;";
		$this->item_qty->ViewCustomAttributes = "";

		// qty_rcv
		$this->qty_rcv->ViewValue = $this->qty_rcv->CurrentValue;
		$this->qty_rcv->ViewValue = ew_FormatNumber($this->qty_rcv->ViewValue, 2, -2, -2, -2);
		$this->qty_rcv->CellCssStyle .= "text-align: right;";
		$this->qty_rcv->ViewCustomAttributes = "";

		// item_name
		$this->item_name->ViewValue = $this->item_name->CurrentValue;
		$this->item_name->ViewCustomAttributes = "";

		// udet_id
		$this->udet_id->ViewValue = $this->udet_id->CurrentValue;
		$this->udet_id->ViewCustomAttributes = "";

		// cek_sjd
		$this->cek_sjd->ViewCustomAttributes = "";

			// item_id
			$this->item_id->LinkCustomAttributes = "";
			$this->item_id->HrefValue = "";
			$this->item_id->TooltipValue = "";

			// item_code
			$this->item_code->LinkCustomAttributes = "";
			$this->item_code->HrefValue = "";
			$this->item_code->TooltipValue = "";

			// unit_id
			$this->unit_id->LinkCustomAttributes = "";
			$this->unit_id->HrefValue = "";
			$this->unit_id->TooltipValue = "";

			// item_price
			$this->item_price->LinkCustomAttributes = "";
			$this->item_price->HrefValue = "";
			$this->item_price->TooltipValue = "";

			// item_qty
			$this->item_qty->LinkCustomAttributes = "";
			$this->item_qty->HrefValue = "";
			$this->item_qty->TooltipValue = "";

			// qty_rcv
			$this->qty_rcv->LinkCustomAttributes = "";
			$this->qty_rcv->HrefValue = "";
			$this->qty_rcv->TooltipValue = "";

			// cek_sjd
			$this->cek_sjd->LinkCustomAttributes = "";
			$this->cek_sjd->HrefValue = "";
			$this->cek_sjd->TooltipValue = "";
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
			if ($sMasterTblVar == "tr_sjd_master") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_sjd_id"] <> "") {
					$GLOBALS["tr_sjd_master"]->sjd_id->setQueryStringValue($_GET["fk_sjd_id"]);
					$this->master_id->setQueryStringValue($GLOBALS["tr_sjd_master"]->sjd_id->QueryStringValue);
					$this->master_id->setSessionValue($this->master_id->QueryStringValue);
					if (!is_numeric($GLOBALS["tr_sjd_master"]->sjd_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "tr_sjd_master") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_sjd_id"] <> "") {
					$GLOBALS["tr_sjd_master"]->sjd_id->setFormValue($_POST["fk_sjd_id"]);
					$this->master_id->setFormValue($GLOBALS["tr_sjd_master"]->sjd_id->FormValue);
					$this->master_id->setSessionValue($this->master_id->FormValue);
					if (!is_numeric($GLOBALS["tr_sjd_master"]->sjd_id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "tr_sjd_master") {
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_sjd_itemlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($tr_sjd_item_delete)) $tr_sjd_item_delete = new ctr_sjd_item_delete();

// Page init
$tr_sjd_item_delete->Page_Init();

// Page main
$tr_sjd_item_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_sjd_item_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ftr_sjd_itemdelete = new ew_Form("ftr_sjd_itemdelete", "delete");

// Form_CustomValidate event
ftr_sjd_itemdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_sjd_itemdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_sjd_itemdelete.Lists["x_item_id"] = {"LinkField":"x_product_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_product_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_products"};
ftr_sjd_itemdelete.Lists["x_item_id"].Data = "<?php echo $tr_sjd_item_delete->item_id->LookupFilterQuery(FALSE, "delete") ?>";
ftr_sjd_itemdelete.AutoSuggests["x_item_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $tr_sjd_item_delete->item_id->LookupFilterQuery(TRUE, "delete"))) ?>;
ftr_sjd_itemdelete.Lists["x_unit_id"] = {"LinkField":"x_unit_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_unit_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_unit_detail"};
ftr_sjd_itemdelete.Lists["x_unit_id"].Data = "<?php echo $tr_sjd_item_delete->unit_id->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tr_sjd_item_delete->ShowPageHeader(); ?>
<?php
$tr_sjd_item_delete->ShowMessage();
?>
<form name="ftr_sjd_itemdelete" id="ftr_sjd_itemdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_sjd_item_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_sjd_item_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_sjd_item">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tr_sjd_item_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($tr_sjd_item->item_id->Visible) { // item_id ?>
		<th class="<?php echo $tr_sjd_item->item_id->HeaderCellClass() ?>"><span id="elh_tr_sjd_item_item_id" class="tr_sjd_item_item_id"><?php echo $tr_sjd_item->item_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_sjd_item->item_code->Visible) { // item_code ?>
		<th class="<?php echo $tr_sjd_item->item_code->HeaderCellClass() ?>"><span id="elh_tr_sjd_item_item_code" class="tr_sjd_item_item_code"><?php echo $tr_sjd_item->item_code->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_sjd_item->unit_id->Visible) { // unit_id ?>
		<th class="<?php echo $tr_sjd_item->unit_id->HeaderCellClass() ?>"><span id="elh_tr_sjd_item_unit_id" class="tr_sjd_item_unit_id"><?php echo $tr_sjd_item->unit_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_sjd_item->item_price->Visible) { // item_price ?>
		<th class="<?php echo $tr_sjd_item->item_price->HeaderCellClass() ?>"><span id="elh_tr_sjd_item_item_price" class="tr_sjd_item_item_price"><?php echo $tr_sjd_item->item_price->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_sjd_item->item_qty->Visible) { // item_qty ?>
		<th class="<?php echo $tr_sjd_item->item_qty->HeaderCellClass() ?>"><span id="elh_tr_sjd_item_item_qty" class="tr_sjd_item_item_qty"><?php echo $tr_sjd_item->item_qty->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_sjd_item->qty_rcv->Visible) { // qty_rcv ?>
		<th class="<?php echo $tr_sjd_item->qty_rcv->HeaderCellClass() ?>"><span id="elh_tr_sjd_item_qty_rcv" class="tr_sjd_item_qty_rcv"><?php echo $tr_sjd_item->qty_rcv->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_sjd_item->cek_sjd->Visible) { // cek_sjd ?>
		<th class="<?php echo $tr_sjd_item->cek_sjd->HeaderCellClass() ?>"><span id="elh_tr_sjd_item_cek_sjd" class="tr_sjd_item_cek_sjd"><?php echo $tr_sjd_item->cek_sjd->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tr_sjd_item_delete->RecCnt = 0;
$i = 0;
while (!$tr_sjd_item_delete->Recordset->EOF) {
	$tr_sjd_item_delete->RecCnt++;
	$tr_sjd_item_delete->RowCnt++;

	// Set row properties
	$tr_sjd_item->ResetAttrs();
	$tr_sjd_item->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tr_sjd_item_delete->LoadRowValues($tr_sjd_item_delete->Recordset);

	// Render row
	$tr_sjd_item_delete->RenderRow();
?>
	<tr<?php echo $tr_sjd_item->RowAttributes() ?>>
<?php if ($tr_sjd_item->item_id->Visible) { // item_id ?>
		<td<?php echo $tr_sjd_item->item_id->CellAttributes() ?>>
<span id="el<?php echo $tr_sjd_item_delete->RowCnt ?>_tr_sjd_item_item_id" class="tr_sjd_item_item_id">
<span<?php echo $tr_sjd_item->item_id->ViewAttributes() ?>>
<?php echo $tr_sjd_item->item_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_sjd_item->item_code->Visible) { // item_code ?>
		<td<?php echo $tr_sjd_item->item_code->CellAttributes() ?>>
<span id="el<?php echo $tr_sjd_item_delete->RowCnt ?>_tr_sjd_item_item_code" class="tr_sjd_item_item_code">
<span<?php echo $tr_sjd_item->item_code->ViewAttributes() ?>>
<?php echo $tr_sjd_item->item_code->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_sjd_item->unit_id->Visible) { // unit_id ?>
		<td<?php echo $tr_sjd_item->unit_id->CellAttributes() ?>>
<span id="el<?php echo $tr_sjd_item_delete->RowCnt ?>_tr_sjd_item_unit_id" class="tr_sjd_item_unit_id">
<span<?php echo $tr_sjd_item->unit_id->ViewAttributes() ?>>
<?php echo $tr_sjd_item->unit_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_sjd_item->item_price->Visible) { // item_price ?>
		<td<?php echo $tr_sjd_item->item_price->CellAttributes() ?>>
<span id="el<?php echo $tr_sjd_item_delete->RowCnt ?>_tr_sjd_item_item_price" class="tr_sjd_item_item_price">
<span<?php echo $tr_sjd_item->item_price->ViewAttributes() ?>>
<?php echo $tr_sjd_item->item_price->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_sjd_item->item_qty->Visible) { // item_qty ?>
		<td<?php echo $tr_sjd_item->item_qty->CellAttributes() ?>>
<span id="el<?php echo $tr_sjd_item_delete->RowCnt ?>_tr_sjd_item_item_qty" class="tr_sjd_item_item_qty">
<span<?php echo $tr_sjd_item->item_qty->ViewAttributes() ?>>
<?php echo $tr_sjd_item->item_qty->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_sjd_item->qty_rcv->Visible) { // qty_rcv ?>
		<td<?php echo $tr_sjd_item->qty_rcv->CellAttributes() ?>>
<span id="el<?php echo $tr_sjd_item_delete->RowCnt ?>_tr_sjd_item_qty_rcv" class="tr_sjd_item_qty_rcv">
<span<?php echo $tr_sjd_item->qty_rcv->ViewAttributes() ?>>
<?php echo $tr_sjd_item->qty_rcv->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_sjd_item->cek_sjd->Visible) { // cek_sjd ?>
		<td<?php echo $tr_sjd_item->cek_sjd->CellAttributes() ?>>
<span id="el<?php echo $tr_sjd_item_delete->RowCnt ?>_tr_sjd_item_cek_sjd" class="tr_sjd_item_cek_sjd">
<span<?php echo $tr_sjd_item->cek_sjd->ViewAttributes() ?>>
<?php echo $tr_sjd_item->cek_sjd->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tr_sjd_item_delete->Recordset->MoveNext();
}
$tr_sjd_item_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tr_sjd_item_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ftr_sjd_itemdelete.Init();
</script>
<?php
$tr_sjd_item_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_sjd_item_delete->Page_Terminate();
?>
