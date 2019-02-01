<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_depoinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_depo_delete = NULL; // Initialize page object first

class ctbl_depo_delete extends ctbl_depo {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tbl_depo';

	// Page object name
	var $PageObjName = 'tbl_depo_delete';

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

		// Table object (tbl_depo)
		if (!isset($GLOBALS["tbl_depo"]) || get_class($GLOBALS["tbl_depo"]) == "ctbl_depo") {
			$GLOBALS["tbl_depo"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_depo"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_depo', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tbl_depolist.php"));
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
		$this->kode_depo->SetVisibility();
		$this->nama_depo->SetVisibility();
		$this->alamat1->SetVisibility();
		$this->alamat2->SetVisibility();
		$this->alamat3->SetVisibility();
		$this->telp->SetVisibility();
		$this->fax->SetVisibility();
		$this->penanggung_jawab->SetVisibility();
		$this->trx_kode->SetVisibility();

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
		global $EW_EXPORT, $tbl_depo;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_depo);
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
			$this->Page_Terminate("tbl_depolist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_depo class, tbl_depoinfo.php

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
				$this->Page_Terminate("tbl_depolist.php"); // Return to list
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
		$this->kode_depo->setDbValue($row['kode_depo']);
		$this->nama_depo->setDbValue($row['nama_depo']);
		$this->alamat1->setDbValue($row['alamat1']);
		$this->alamat2->setDbValue($row['alamat2']);
		$this->alamat3->setDbValue($row['alamat3']);
		$this->telp->setDbValue($row['telp']);
		$this->fax->setDbValue($row['fax']);
		$this->penanggung_jawab->setDbValue($row['penanggung_jawab']);
		$this->trx_kode->setDbValue($row['trx_kode']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['kode_depo'] = NULL;
		$row['nama_depo'] = NULL;
		$row['alamat1'] = NULL;
		$row['alamat2'] = NULL;
		$row['alamat3'] = NULL;
		$row['telp'] = NULL;
		$row['fax'] = NULL;
		$row['penanggung_jawab'] = NULL;
		$row['trx_kode'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->kode_depo->DbValue = $row['kode_depo'];
		$this->nama_depo->DbValue = $row['nama_depo'];
		$this->alamat1->DbValue = $row['alamat1'];
		$this->alamat2->DbValue = $row['alamat2'];
		$this->alamat3->DbValue = $row['alamat3'];
		$this->telp->DbValue = $row['telp'];
		$this->fax->DbValue = $row['fax'];
		$this->penanggung_jawab->DbValue = $row['penanggung_jawab'];
		$this->trx_kode->DbValue = $row['trx_kode'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// kode_depo
		// nama_depo
		// alamat1
		// alamat2
		// alamat3
		// telp
		// fax
		// penanggung_jawab
		// trx_kode

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// nama_depo
		$this->nama_depo->ViewValue = $this->nama_depo->CurrentValue;
		$this->nama_depo->ViewCustomAttributes = "";

		// alamat1
		$this->alamat1->ViewValue = $this->alamat1->CurrentValue;
		$this->alamat1->ViewCustomAttributes = "";

		// alamat2
		$this->alamat2->ViewValue = $this->alamat2->CurrentValue;
		$this->alamat2->ViewCustomAttributes = "";

		// alamat3
		$this->alamat3->ViewValue = $this->alamat3->CurrentValue;
		$this->alamat3->ViewCustomAttributes = "";

		// telp
		$this->telp->ViewValue = $this->telp->CurrentValue;
		$this->telp->ViewCustomAttributes = "";

		// fax
		$this->fax->ViewValue = $this->fax->CurrentValue;
		$this->fax->ViewCustomAttributes = "";

		// penanggung_jawab
		$this->penanggung_jawab->ViewValue = $this->penanggung_jawab->CurrentValue;
		$this->penanggung_jawab->ViewCustomAttributes = "";

		// trx_kode
		$this->trx_kode->ViewValue = $this->trx_kode->CurrentValue;
		$this->trx_kode->ViewCustomAttributes = "";

			// kode_depo
			$this->kode_depo->LinkCustomAttributes = "";
			$this->kode_depo->HrefValue = "";
			$this->kode_depo->TooltipValue = "";

			// nama_depo
			$this->nama_depo->LinkCustomAttributes = "";
			$this->nama_depo->HrefValue = "";
			$this->nama_depo->TooltipValue = "";

			// alamat1
			$this->alamat1->LinkCustomAttributes = "";
			$this->alamat1->HrefValue = "";
			$this->alamat1->TooltipValue = "";

			// alamat2
			$this->alamat2->LinkCustomAttributes = "";
			$this->alamat2->HrefValue = "";
			$this->alamat2->TooltipValue = "";

			// alamat3
			$this->alamat3->LinkCustomAttributes = "";
			$this->alamat3->HrefValue = "";
			$this->alamat3->TooltipValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";
			$this->telp->TooltipValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";
			$this->fax->TooltipValue = "";

			// penanggung_jawab
			$this->penanggung_jawab->LinkCustomAttributes = "";
			$this->penanggung_jawab->HrefValue = "";
			$this->penanggung_jawab->TooltipValue = "";

			// trx_kode
			$this->trx_kode->LinkCustomAttributes = "";
			$this->trx_kode->HrefValue = "";
			$this->trx_kode->TooltipValue = "";
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
				$sThisKey .= $row['kode_depo'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_depolist.php"), "", $this->TableVar, TRUE);
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
if (!isset($tbl_depo_delete)) $tbl_depo_delete = new ctbl_depo_delete();

// Page init
$tbl_depo_delete->Page_Init();

// Page main
$tbl_depo_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_depo_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ftbl_depodelete = new ew_Form("ftbl_depodelete", "delete");

// Form_CustomValidate event
ftbl_depodelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_depodelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_depo_delete->ShowPageHeader(); ?>
<?php
$tbl_depo_delete->ShowMessage();
?>
<form name="ftbl_depodelete" id="ftbl_depodelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_depo_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_depo_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_depo">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_depo_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($tbl_depo->kode_depo->Visible) { // kode_depo ?>
		<th class="<?php echo $tbl_depo->kode_depo->HeaderCellClass() ?>"><span id="elh_tbl_depo_kode_depo" class="tbl_depo_kode_depo"><?php echo $tbl_depo->kode_depo->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_depo->nama_depo->Visible) { // nama_depo ?>
		<th class="<?php echo $tbl_depo->nama_depo->HeaderCellClass() ?>"><span id="elh_tbl_depo_nama_depo" class="tbl_depo_nama_depo"><?php echo $tbl_depo->nama_depo->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_depo->alamat1->Visible) { // alamat1 ?>
		<th class="<?php echo $tbl_depo->alamat1->HeaderCellClass() ?>"><span id="elh_tbl_depo_alamat1" class="tbl_depo_alamat1"><?php echo $tbl_depo->alamat1->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_depo->alamat2->Visible) { // alamat2 ?>
		<th class="<?php echo $tbl_depo->alamat2->HeaderCellClass() ?>"><span id="elh_tbl_depo_alamat2" class="tbl_depo_alamat2"><?php echo $tbl_depo->alamat2->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_depo->alamat3->Visible) { // alamat3 ?>
		<th class="<?php echo $tbl_depo->alamat3->HeaderCellClass() ?>"><span id="elh_tbl_depo_alamat3" class="tbl_depo_alamat3"><?php echo $tbl_depo->alamat3->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_depo->telp->Visible) { // telp ?>
		<th class="<?php echo $tbl_depo->telp->HeaderCellClass() ?>"><span id="elh_tbl_depo_telp" class="tbl_depo_telp"><?php echo $tbl_depo->telp->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_depo->fax->Visible) { // fax ?>
		<th class="<?php echo $tbl_depo->fax->HeaderCellClass() ?>"><span id="elh_tbl_depo_fax" class="tbl_depo_fax"><?php echo $tbl_depo->fax->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_depo->penanggung_jawab->Visible) { // penanggung_jawab ?>
		<th class="<?php echo $tbl_depo->penanggung_jawab->HeaderCellClass() ?>"><span id="elh_tbl_depo_penanggung_jawab" class="tbl_depo_penanggung_jawab"><?php echo $tbl_depo->penanggung_jawab->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_depo->trx_kode->Visible) { // trx_kode ?>
		<th class="<?php echo $tbl_depo->trx_kode->HeaderCellClass() ?>"><span id="elh_tbl_depo_trx_kode" class="tbl_depo_trx_kode"><?php echo $tbl_depo->trx_kode->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_depo_delete->RecCnt = 0;
$i = 0;
while (!$tbl_depo_delete->Recordset->EOF) {
	$tbl_depo_delete->RecCnt++;
	$tbl_depo_delete->RowCnt++;

	// Set row properties
	$tbl_depo->ResetAttrs();
	$tbl_depo->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_depo_delete->LoadRowValues($tbl_depo_delete->Recordset);

	// Render row
	$tbl_depo_delete->RenderRow();
?>
	<tr<?php echo $tbl_depo->RowAttributes() ?>>
<?php if ($tbl_depo->kode_depo->Visible) { // kode_depo ?>
		<td<?php echo $tbl_depo->kode_depo->CellAttributes() ?>>
<span id="el<?php echo $tbl_depo_delete->RowCnt ?>_tbl_depo_kode_depo" class="tbl_depo_kode_depo">
<span<?php echo $tbl_depo->kode_depo->ViewAttributes() ?>>
<?php echo $tbl_depo->kode_depo->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_depo->nama_depo->Visible) { // nama_depo ?>
		<td<?php echo $tbl_depo->nama_depo->CellAttributes() ?>>
<span id="el<?php echo $tbl_depo_delete->RowCnt ?>_tbl_depo_nama_depo" class="tbl_depo_nama_depo">
<span<?php echo $tbl_depo->nama_depo->ViewAttributes() ?>>
<?php echo $tbl_depo->nama_depo->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_depo->alamat1->Visible) { // alamat1 ?>
		<td<?php echo $tbl_depo->alamat1->CellAttributes() ?>>
<span id="el<?php echo $tbl_depo_delete->RowCnt ?>_tbl_depo_alamat1" class="tbl_depo_alamat1">
<span<?php echo $tbl_depo->alamat1->ViewAttributes() ?>>
<?php echo $tbl_depo->alamat1->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_depo->alamat2->Visible) { // alamat2 ?>
		<td<?php echo $tbl_depo->alamat2->CellAttributes() ?>>
<span id="el<?php echo $tbl_depo_delete->RowCnt ?>_tbl_depo_alamat2" class="tbl_depo_alamat2">
<span<?php echo $tbl_depo->alamat2->ViewAttributes() ?>>
<?php echo $tbl_depo->alamat2->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_depo->alamat3->Visible) { // alamat3 ?>
		<td<?php echo $tbl_depo->alamat3->CellAttributes() ?>>
<span id="el<?php echo $tbl_depo_delete->RowCnt ?>_tbl_depo_alamat3" class="tbl_depo_alamat3">
<span<?php echo $tbl_depo->alamat3->ViewAttributes() ?>>
<?php echo $tbl_depo->alamat3->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_depo->telp->Visible) { // telp ?>
		<td<?php echo $tbl_depo->telp->CellAttributes() ?>>
<span id="el<?php echo $tbl_depo_delete->RowCnt ?>_tbl_depo_telp" class="tbl_depo_telp">
<span<?php echo $tbl_depo->telp->ViewAttributes() ?>>
<?php echo $tbl_depo->telp->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_depo->fax->Visible) { // fax ?>
		<td<?php echo $tbl_depo->fax->CellAttributes() ?>>
<span id="el<?php echo $tbl_depo_delete->RowCnt ?>_tbl_depo_fax" class="tbl_depo_fax">
<span<?php echo $tbl_depo->fax->ViewAttributes() ?>>
<?php echo $tbl_depo->fax->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_depo->penanggung_jawab->Visible) { // penanggung_jawab ?>
		<td<?php echo $tbl_depo->penanggung_jawab->CellAttributes() ?>>
<span id="el<?php echo $tbl_depo_delete->RowCnt ?>_tbl_depo_penanggung_jawab" class="tbl_depo_penanggung_jawab">
<span<?php echo $tbl_depo->penanggung_jawab->ViewAttributes() ?>>
<?php echo $tbl_depo->penanggung_jawab->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_depo->trx_kode->Visible) { // trx_kode ?>
		<td<?php echo $tbl_depo->trx_kode->CellAttributes() ?>>
<span id="el<?php echo $tbl_depo_delete->RowCnt ?>_tbl_depo_trx_kode" class="tbl_depo_trx_kode">
<span<?php echo $tbl_depo->trx_kode->ViewAttributes() ?>>
<?php echo $tbl_depo->trx_kode->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_depo_delete->Recordset->MoveNext();
}
$tbl_depo_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_depo_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ftbl_depodelete.Init();
</script>
<?php
$tbl_depo_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_depo_delete->Page_Terminate();
?>
