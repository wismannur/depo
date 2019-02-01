<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_supplierinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_supplier_delete = NULL; // Initialize page object first

class ctbl_supplier_delete extends ctbl_supplier {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tbl_supplier';

	// Page object name
	var $PageObjName = 'tbl_supplier_delete';

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

		// Table object (tbl_supplier)
		if (!isset($GLOBALS["tbl_supplier"]) || get_class($GLOBALS["tbl_supplier"]) == "ctbl_supplier") {
			$GLOBALS["tbl_supplier"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_supplier"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_supplier', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tbl_supplierlist.php"));
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
		$this->supplier_id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->supplier_id->Visible = FALSE;
		$this->supplier_code->SetVisibility();
		$this->supplier_name->SetVisibility();
		$this->contact_name->SetVisibility();
		$this->address1->SetVisibility();
		$this->address2->SetVisibility();
		$this->address3->SetVisibility();
		$this->phone->SetVisibility();
		$this->fax->SetVisibility();
		$this->discount->SetVisibility();
		$this->due_day->SetVisibility();
		$this->npwp->SetVisibility();
		$this->ap_acc->SetVisibility();

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
		global $EW_EXPORT, $tbl_supplier;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_supplier);
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
			$this->Page_Terminate("tbl_supplierlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_supplier class, tbl_supplierinfo.php

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
				$this->Page_Terminate("tbl_supplierlist.php"); // Return to list
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
		$this->supplier_id->setDbValue($row['supplier_id']);
		$this->supplier_code->setDbValue($row['supplier_code']);
		$this->supplier_name->setDbValue($row['supplier_name']);
		$this->contact_name->setDbValue($row['contact_name']);
		$this->address1->setDbValue($row['address1']);
		$this->address2->setDbValue($row['address2']);
		$this->address3->setDbValue($row['address3']);
		$this->phone->setDbValue($row['phone']);
		$this->fax->setDbValue($row['fax']);
		$this->discount->setDbValue($row['discount']);
		$this->due_day->setDbValue($row['due_day']);
		$this->npwp->setDbValue($row['npwp']);
		$this->ap_acc->setDbValue($row['ap_acc']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['supplier_id'] = NULL;
		$row['supplier_code'] = NULL;
		$row['supplier_name'] = NULL;
		$row['contact_name'] = NULL;
		$row['address1'] = NULL;
		$row['address2'] = NULL;
		$row['address3'] = NULL;
		$row['phone'] = NULL;
		$row['fax'] = NULL;
		$row['discount'] = NULL;
		$row['due_day'] = NULL;
		$row['npwp'] = NULL;
		$row['ap_acc'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->supplier_id->DbValue = $row['supplier_id'];
		$this->supplier_code->DbValue = $row['supplier_code'];
		$this->supplier_name->DbValue = $row['supplier_name'];
		$this->contact_name->DbValue = $row['contact_name'];
		$this->address1->DbValue = $row['address1'];
		$this->address2->DbValue = $row['address2'];
		$this->address3->DbValue = $row['address3'];
		$this->phone->DbValue = $row['phone'];
		$this->fax->DbValue = $row['fax'];
		$this->discount->DbValue = $row['discount'];
		$this->due_day->DbValue = $row['due_day'];
		$this->npwp->DbValue = $row['npwp'];
		$this->ap_acc->DbValue = $row['ap_acc'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->discount->FormValue == $this->discount->CurrentValue && is_numeric(ew_StrToFloat($this->discount->CurrentValue)))
			$this->discount->CurrentValue = ew_StrToFloat($this->discount->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// supplier_id
		// supplier_code
		// supplier_name
		// contact_name
		// address1
		// address2
		// address3
		// phone
		// fax
		// discount
		// due_day
		// npwp
		// ap_acc

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// supplier_id
		$this->supplier_id->ViewValue = $this->supplier_id->CurrentValue;
		$this->supplier_id->ViewCustomAttributes = "";

		// supplier_code
		$this->supplier_code->ViewValue = $this->supplier_code->CurrentValue;
		$this->supplier_code->ViewCustomAttributes = "";

		// supplier_name
		$this->supplier_name->ViewValue = $this->supplier_name->CurrentValue;
		$this->supplier_name->ViewCustomAttributes = "";

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

		// discount
		$this->discount->ViewValue = $this->discount->CurrentValue;
		$this->discount->ViewCustomAttributes = "";

		// due_day
		$this->due_day->ViewValue = $this->due_day->CurrentValue;
		$this->due_day->ViewCustomAttributes = "";

		// npwp
		$this->npwp->ViewValue = $this->npwp->CurrentValue;
		$this->npwp->ViewCustomAttributes = "";

		// ap_acc
		$this->ap_acc->ViewValue = $this->ap_acc->CurrentValue;
		$this->ap_acc->ViewCustomAttributes = "";

			// supplier_id
			$this->supplier_id->LinkCustomAttributes = "";
			$this->supplier_id->HrefValue = "";
			$this->supplier_id->TooltipValue = "";

			// supplier_code
			$this->supplier_code->LinkCustomAttributes = "";
			$this->supplier_code->HrefValue = "";
			$this->supplier_code->TooltipValue = "";

			// supplier_name
			$this->supplier_name->LinkCustomAttributes = "";
			$this->supplier_name->HrefValue = "";
			$this->supplier_name->TooltipValue = "";

			// contact_name
			$this->contact_name->LinkCustomAttributes = "";
			$this->contact_name->HrefValue = "";
			$this->contact_name->TooltipValue = "";

			// address1
			$this->address1->LinkCustomAttributes = "";
			$this->address1->HrefValue = "";
			$this->address1->TooltipValue = "";

			// address2
			$this->address2->LinkCustomAttributes = "";
			$this->address2->HrefValue = "";
			$this->address2->TooltipValue = "";

			// address3
			$this->address3->LinkCustomAttributes = "";
			$this->address3->HrefValue = "";
			$this->address3->TooltipValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";
			$this->phone->TooltipValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";
			$this->fax->TooltipValue = "";

			// discount
			$this->discount->LinkCustomAttributes = "";
			$this->discount->HrefValue = "";
			$this->discount->TooltipValue = "";

			// due_day
			$this->due_day->LinkCustomAttributes = "";
			$this->due_day->HrefValue = "";
			$this->due_day->TooltipValue = "";

			// npwp
			$this->npwp->LinkCustomAttributes = "";
			$this->npwp->HrefValue = "";
			$this->npwp->TooltipValue = "";

			// ap_acc
			$this->ap_acc->LinkCustomAttributes = "";
			$this->ap_acc->HrefValue = "";
			$this->ap_acc->TooltipValue = "";
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
				$sThisKey .= $row['supplier_id'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_supplierlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($tbl_supplier_delete)) $tbl_supplier_delete = new ctbl_supplier_delete();

// Page init
$tbl_supplier_delete->Page_Init();

// Page main
$tbl_supplier_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplier_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ftbl_supplierdelete = new ew_Form("ftbl_supplierdelete", "delete");

// Form_CustomValidate event
ftbl_supplierdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_supplierdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_supplier_delete->ShowPageHeader(); ?>
<?php
$tbl_supplier_delete->ShowMessage();
?>
<form name="ftbl_supplierdelete" id="ftbl_supplierdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_supplier_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_supplier_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplier">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_supplier_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($tbl_supplier->supplier_id->Visible) { // supplier_id ?>
		<th class="<?php echo $tbl_supplier->supplier_id->HeaderCellClass() ?>"><span id="elh_tbl_supplier_supplier_id" class="tbl_supplier_supplier_id"><?php echo $tbl_supplier->supplier_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier->supplier_code->Visible) { // supplier_code ?>
		<th class="<?php echo $tbl_supplier->supplier_code->HeaderCellClass() ?>"><span id="elh_tbl_supplier_supplier_code" class="tbl_supplier_supplier_code"><?php echo $tbl_supplier->supplier_code->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier->supplier_name->Visible) { // supplier_name ?>
		<th class="<?php echo $tbl_supplier->supplier_name->HeaderCellClass() ?>"><span id="elh_tbl_supplier_supplier_name" class="tbl_supplier_supplier_name"><?php echo $tbl_supplier->supplier_name->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier->contact_name->Visible) { // contact_name ?>
		<th class="<?php echo $tbl_supplier->contact_name->HeaderCellClass() ?>"><span id="elh_tbl_supplier_contact_name" class="tbl_supplier_contact_name"><?php echo $tbl_supplier->contact_name->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier->address1->Visible) { // address1 ?>
		<th class="<?php echo $tbl_supplier->address1->HeaderCellClass() ?>"><span id="elh_tbl_supplier_address1" class="tbl_supplier_address1"><?php echo $tbl_supplier->address1->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier->address2->Visible) { // address2 ?>
		<th class="<?php echo $tbl_supplier->address2->HeaderCellClass() ?>"><span id="elh_tbl_supplier_address2" class="tbl_supplier_address2"><?php echo $tbl_supplier->address2->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier->address3->Visible) { // address3 ?>
		<th class="<?php echo $tbl_supplier->address3->HeaderCellClass() ?>"><span id="elh_tbl_supplier_address3" class="tbl_supplier_address3"><?php echo $tbl_supplier->address3->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier->phone->Visible) { // phone ?>
		<th class="<?php echo $tbl_supplier->phone->HeaderCellClass() ?>"><span id="elh_tbl_supplier_phone" class="tbl_supplier_phone"><?php echo $tbl_supplier->phone->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier->fax->Visible) { // fax ?>
		<th class="<?php echo $tbl_supplier->fax->HeaderCellClass() ?>"><span id="elh_tbl_supplier_fax" class="tbl_supplier_fax"><?php echo $tbl_supplier->fax->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier->discount->Visible) { // discount ?>
		<th class="<?php echo $tbl_supplier->discount->HeaderCellClass() ?>"><span id="elh_tbl_supplier_discount" class="tbl_supplier_discount"><?php echo $tbl_supplier->discount->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier->due_day->Visible) { // due_day ?>
		<th class="<?php echo $tbl_supplier->due_day->HeaderCellClass() ?>"><span id="elh_tbl_supplier_due_day" class="tbl_supplier_due_day"><?php echo $tbl_supplier->due_day->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier->npwp->Visible) { // npwp ?>
		<th class="<?php echo $tbl_supplier->npwp->HeaderCellClass() ?>"><span id="elh_tbl_supplier_npwp" class="tbl_supplier_npwp"><?php echo $tbl_supplier->npwp->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier->ap_acc->Visible) { // ap_acc ?>
		<th class="<?php echo $tbl_supplier->ap_acc->HeaderCellClass() ?>"><span id="elh_tbl_supplier_ap_acc" class="tbl_supplier_ap_acc"><?php echo $tbl_supplier->ap_acc->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_supplier_delete->RecCnt = 0;
$i = 0;
while (!$tbl_supplier_delete->Recordset->EOF) {
	$tbl_supplier_delete->RecCnt++;
	$tbl_supplier_delete->RowCnt++;

	// Set row properties
	$tbl_supplier->ResetAttrs();
	$tbl_supplier->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_supplier_delete->LoadRowValues($tbl_supplier_delete->Recordset);

	// Render row
	$tbl_supplier_delete->RenderRow();
?>
	<tr<?php echo $tbl_supplier->RowAttributes() ?>>
<?php if ($tbl_supplier->supplier_id->Visible) { // supplier_id ?>
		<td<?php echo $tbl_supplier->supplier_id->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_supplier_id" class="tbl_supplier_supplier_id">
<span<?php echo $tbl_supplier->supplier_id->ViewAttributes() ?>>
<?php echo $tbl_supplier->supplier_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier->supplier_code->Visible) { // supplier_code ?>
		<td<?php echo $tbl_supplier->supplier_code->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_supplier_code" class="tbl_supplier_supplier_code">
<span<?php echo $tbl_supplier->supplier_code->ViewAttributes() ?>>
<?php echo $tbl_supplier->supplier_code->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier->supplier_name->Visible) { // supplier_name ?>
		<td<?php echo $tbl_supplier->supplier_name->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_supplier_name" class="tbl_supplier_supplier_name">
<span<?php echo $tbl_supplier->supplier_name->ViewAttributes() ?>>
<?php echo $tbl_supplier->supplier_name->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier->contact_name->Visible) { // contact_name ?>
		<td<?php echo $tbl_supplier->contact_name->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_contact_name" class="tbl_supplier_contact_name">
<span<?php echo $tbl_supplier->contact_name->ViewAttributes() ?>>
<?php echo $tbl_supplier->contact_name->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier->address1->Visible) { // address1 ?>
		<td<?php echo $tbl_supplier->address1->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_address1" class="tbl_supplier_address1">
<span<?php echo $tbl_supplier->address1->ViewAttributes() ?>>
<?php echo $tbl_supplier->address1->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier->address2->Visible) { // address2 ?>
		<td<?php echo $tbl_supplier->address2->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_address2" class="tbl_supplier_address2">
<span<?php echo $tbl_supplier->address2->ViewAttributes() ?>>
<?php echo $tbl_supplier->address2->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier->address3->Visible) { // address3 ?>
		<td<?php echo $tbl_supplier->address3->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_address3" class="tbl_supplier_address3">
<span<?php echo $tbl_supplier->address3->ViewAttributes() ?>>
<?php echo $tbl_supplier->address3->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier->phone->Visible) { // phone ?>
		<td<?php echo $tbl_supplier->phone->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_phone" class="tbl_supplier_phone">
<span<?php echo $tbl_supplier->phone->ViewAttributes() ?>>
<?php echo $tbl_supplier->phone->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier->fax->Visible) { // fax ?>
		<td<?php echo $tbl_supplier->fax->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_fax" class="tbl_supplier_fax">
<span<?php echo $tbl_supplier->fax->ViewAttributes() ?>>
<?php echo $tbl_supplier->fax->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier->discount->Visible) { // discount ?>
		<td<?php echo $tbl_supplier->discount->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_discount" class="tbl_supplier_discount">
<span<?php echo $tbl_supplier->discount->ViewAttributes() ?>>
<?php echo $tbl_supplier->discount->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier->due_day->Visible) { // due_day ?>
		<td<?php echo $tbl_supplier->due_day->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_due_day" class="tbl_supplier_due_day">
<span<?php echo $tbl_supplier->due_day->ViewAttributes() ?>>
<?php echo $tbl_supplier->due_day->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier->npwp->Visible) { // npwp ?>
		<td<?php echo $tbl_supplier->npwp->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_npwp" class="tbl_supplier_npwp">
<span<?php echo $tbl_supplier->npwp->ViewAttributes() ?>>
<?php echo $tbl_supplier->npwp->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier->ap_acc->Visible) { // ap_acc ?>
		<td<?php echo $tbl_supplier->ap_acc->CellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCnt ?>_tbl_supplier_ap_acc" class="tbl_supplier_ap_acc">
<span<?php echo $tbl_supplier->ap_acc->ViewAttributes() ?>>
<?php echo $tbl_supplier->ap_acc->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_supplier_delete->Recordset->MoveNext();
}
$tbl_supplier_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_supplier_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ftbl_supplierdelete.Init();
</script>
<?php
$tbl_supplier_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_supplier_delete->Page_Terminate();
?>
