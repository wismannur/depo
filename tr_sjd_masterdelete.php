<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_sjd_masterinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_sjd_master_delete = NULL; // Initialize page object first

class ctr_sjd_master_delete extends ctr_sjd_master {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_sjd_master';

	// Page object name
	var $PageObjName = 'tr_sjd_master_delete';

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

		// Table object (tr_sjd_master)
		if (!isset($GLOBALS["tr_sjd_master"]) || get_class($GLOBALS["tr_sjd_master"]) == "ctr_sjd_master") {
			$GLOBALS["tr_sjd_master"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_sjd_master"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_sjd_master', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tr_sjd_masterlist.php"));
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
		$this->sjd_number->SetVisibility();
		$this->sjd_date->SetVisibility();
		$this->rcv_date->SetVisibility();
		$this->sjd_notes->SetVisibility();
		$this->pb_no->SetVisibility();

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
		global $EW_EXPORT, $tr_sjd_master;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_sjd_master);
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
			$this->Page_Terminate("tr_sjd_masterlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tr_sjd_master class, tr_sjd_masterinfo.php

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
				$this->Page_Terminate("tr_sjd_masterlist.php"); // Return to list
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
		$this->sjd_id->setDbValue($row['sjd_id']);
		$this->kode_depo->setDbValue($row['kode_depo']);
		$this->sjd_number->setDbValue($row['sjd_number']);
		$this->sjd_date->setDbValue($row['sjd_date']);
		$this->rcv_date->setDbValue($row['rcv_date']);
		$this->sjd_notes->setDbValue($row['sjd_notes']);
		$this->lastupdate->setDbValue($row['lastupdate']);
		$this->user_id->setDbValue($row['user_id']);
		$this->pb_no->setDbValue($row['pb_no']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['sjd_id'] = NULL;
		$row['kode_depo'] = NULL;
		$row['sjd_number'] = NULL;
		$row['sjd_date'] = NULL;
		$row['rcv_date'] = NULL;
		$row['sjd_notes'] = NULL;
		$row['lastupdate'] = NULL;
		$row['user_id'] = NULL;
		$row['pb_no'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->sjd_id->DbValue = $row['sjd_id'];
		$this->kode_depo->DbValue = $row['kode_depo'];
		$this->sjd_number->DbValue = $row['sjd_number'];
		$this->sjd_date->DbValue = $row['sjd_date'];
		$this->rcv_date->DbValue = $row['rcv_date'];
		$this->sjd_notes->DbValue = $row['sjd_notes'];
		$this->lastupdate->DbValue = $row['lastupdate'];
		$this->user_id->DbValue = $row['user_id'];
		$this->pb_no->DbValue = $row['pb_no'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// sjd_id
		// kode_depo
		// sjd_number
		// sjd_date
		// rcv_date
		// sjd_notes
		// lastupdate
		// user_id
		// pb_no

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// sjd_id
		$this->sjd_id->ViewValue = $this->sjd_id->CurrentValue;
		$this->sjd_id->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// sjd_number
		$this->sjd_number->ViewValue = $this->sjd_number->CurrentValue;
		$this->sjd_number->ViewCustomAttributes = "";

		// sjd_date
		$this->sjd_date->ViewValue = $this->sjd_date->CurrentValue;
		$this->sjd_date->ViewValue = ew_FormatDateTime($this->sjd_date->ViewValue, 7);
		$this->sjd_date->ViewCustomAttributes = "";

		// rcv_date
		$this->rcv_date->ViewValue = $this->rcv_date->CurrentValue;
		$this->rcv_date->ViewValue = ew_FormatDateTime($this->rcv_date->ViewValue, 7);
		$this->rcv_date->ViewCustomAttributes = "";

		// sjd_notes
		$this->sjd_notes->ViewValue = $this->sjd_notes->CurrentValue;
		$this->sjd_notes->ViewCustomAttributes = "";

		// lastupdate
		$this->lastupdate->ViewValue = $this->lastupdate->CurrentValue;
		$this->lastupdate->ViewValue = ew_FormatDateTime($this->lastupdate->ViewValue, 0);
		$this->lastupdate->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// pb_no
		$this->pb_no->ViewValue = $this->pb_no->CurrentValue;
		$this->pb_no->ViewCustomAttributes = "";

			// sjd_number
			$this->sjd_number->LinkCustomAttributes = "";
			$this->sjd_number->HrefValue = "";
			$this->sjd_number->TooltipValue = "";

			// sjd_date
			$this->sjd_date->LinkCustomAttributes = "";
			$this->sjd_date->HrefValue = "";
			$this->sjd_date->TooltipValue = "";

			// rcv_date
			$this->rcv_date->LinkCustomAttributes = "";
			$this->rcv_date->HrefValue = "";
			$this->rcv_date->TooltipValue = "";

			// sjd_notes
			$this->sjd_notes->LinkCustomAttributes = "";
			$this->sjd_notes->HrefValue = "";
			$this->sjd_notes->TooltipValue = "";

			// pb_no
			$this->pb_no->LinkCustomAttributes = "";
			$this->pb_no->HrefValue = "";
			$this->pb_no->TooltipValue = "";
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
				$sThisKey .= $row['sjd_id'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_sjd_masterlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($tr_sjd_master_delete)) $tr_sjd_master_delete = new ctr_sjd_master_delete();

// Page init
$tr_sjd_master_delete->Page_Init();

// Page main
$tr_sjd_master_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_sjd_master_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ftr_sjd_masterdelete = new ew_Form("ftr_sjd_masterdelete", "delete");

// Form_CustomValidate event
ftr_sjd_masterdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_sjd_masterdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tr_sjd_master_delete->ShowPageHeader(); ?>
<?php
$tr_sjd_master_delete->ShowMessage();
?>
<form name="ftr_sjd_masterdelete" id="ftr_sjd_masterdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_sjd_master_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_sjd_master_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_sjd_master">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tr_sjd_master_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($tr_sjd_master->sjd_number->Visible) { // sjd_number ?>
		<th class="<?php echo $tr_sjd_master->sjd_number->HeaderCellClass() ?>"><span id="elh_tr_sjd_master_sjd_number" class="tr_sjd_master_sjd_number"><?php echo $tr_sjd_master->sjd_number->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_sjd_master->sjd_date->Visible) { // sjd_date ?>
		<th class="<?php echo $tr_sjd_master->sjd_date->HeaderCellClass() ?>"><span id="elh_tr_sjd_master_sjd_date" class="tr_sjd_master_sjd_date"><?php echo $tr_sjd_master->sjd_date->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_sjd_master->rcv_date->Visible) { // rcv_date ?>
		<th class="<?php echo $tr_sjd_master->rcv_date->HeaderCellClass() ?>"><span id="elh_tr_sjd_master_rcv_date" class="tr_sjd_master_rcv_date"><?php echo $tr_sjd_master->rcv_date->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_sjd_master->sjd_notes->Visible) { // sjd_notes ?>
		<th class="<?php echo $tr_sjd_master->sjd_notes->HeaderCellClass() ?>"><span id="elh_tr_sjd_master_sjd_notes" class="tr_sjd_master_sjd_notes"><?php echo $tr_sjd_master->sjd_notes->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tr_sjd_master->pb_no->Visible) { // pb_no ?>
		<th class="<?php echo $tr_sjd_master->pb_no->HeaderCellClass() ?>"><span id="elh_tr_sjd_master_pb_no" class="tr_sjd_master_pb_no"><?php echo $tr_sjd_master->pb_no->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tr_sjd_master_delete->RecCnt = 0;
$i = 0;
while (!$tr_sjd_master_delete->Recordset->EOF) {
	$tr_sjd_master_delete->RecCnt++;
	$tr_sjd_master_delete->RowCnt++;

	// Set row properties
	$tr_sjd_master->ResetAttrs();
	$tr_sjd_master->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tr_sjd_master_delete->LoadRowValues($tr_sjd_master_delete->Recordset);

	// Render row
	$tr_sjd_master_delete->RenderRow();
?>
	<tr<?php echo $tr_sjd_master->RowAttributes() ?>>
<?php if ($tr_sjd_master->sjd_number->Visible) { // sjd_number ?>
		<td<?php echo $tr_sjd_master->sjd_number->CellAttributes() ?>>
<span id="el<?php echo $tr_sjd_master_delete->RowCnt ?>_tr_sjd_master_sjd_number" class="tr_sjd_master_sjd_number">
<span<?php echo $tr_sjd_master->sjd_number->ViewAttributes() ?>>
<?php echo $tr_sjd_master->sjd_number->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_sjd_master->sjd_date->Visible) { // sjd_date ?>
		<td<?php echo $tr_sjd_master->sjd_date->CellAttributes() ?>>
<span id="el<?php echo $tr_sjd_master_delete->RowCnt ?>_tr_sjd_master_sjd_date" class="tr_sjd_master_sjd_date">
<span<?php echo $tr_sjd_master->sjd_date->ViewAttributes() ?>>
<?php echo $tr_sjd_master->sjd_date->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_sjd_master->rcv_date->Visible) { // rcv_date ?>
		<td<?php echo $tr_sjd_master->rcv_date->CellAttributes() ?>>
<span id="el<?php echo $tr_sjd_master_delete->RowCnt ?>_tr_sjd_master_rcv_date" class="tr_sjd_master_rcv_date">
<span<?php echo $tr_sjd_master->rcv_date->ViewAttributes() ?>>
<?php echo $tr_sjd_master->rcv_date->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_sjd_master->sjd_notes->Visible) { // sjd_notes ?>
		<td<?php echo $tr_sjd_master->sjd_notes->CellAttributes() ?>>
<span id="el<?php echo $tr_sjd_master_delete->RowCnt ?>_tr_sjd_master_sjd_notes" class="tr_sjd_master_sjd_notes">
<span<?php echo $tr_sjd_master->sjd_notes->ViewAttributes() ?>>
<?php echo $tr_sjd_master->sjd_notes->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tr_sjd_master->pb_no->Visible) { // pb_no ?>
		<td<?php echo $tr_sjd_master->pb_no->CellAttributes() ?>>
<span id="el<?php echo $tr_sjd_master_delete->RowCnt ?>_tr_sjd_master_pb_no" class="tr_sjd_master_pb_no">
<span<?php echo $tr_sjd_master->pb_no->ViewAttributes() ?>>
<?php echo $tr_sjd_master->pb_no->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tr_sjd_master_delete->Recordset->MoveNext();
}
$tr_sjd_master_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tr_sjd_master_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ftr_sjd_masterdelete.Init();
</script>
<?php
$tr_sjd_master_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_sjd_master_delete->Page_Terminate();
?>
