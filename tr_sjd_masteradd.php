<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_sjd_masterinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tr_sjd_itemgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_sjd_master_add = NULL; // Initialize page object first

class ctr_sjd_master_add extends ctr_sjd_master {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_sjd_master';

	// Page object name
	var $PageObjName = 'tr_sjd_master_add';

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
			define("EW_PAGE_ID", 'add', TRUE);

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

		// Is modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanAdd()) {
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
		// Create form object

		$objForm = new cFormObj();
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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {

			// Get the keys for master table
			$sDetailTblVar = $this->getCurrentDetailTable();
			if ($sDetailTblVar <> "") {
				$DetailTblVar = explode(",", $sDetailTblVar);
				if (in_array("tr_sjd_item", $DetailTblVar)) {

					// Process auto fill for detail table 'tr_sjd_item'
					if (preg_match('/^ftr_sjd_item(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["tr_sjd_item_grid"])) $GLOBALS["tr_sjd_item_grid"] = new ctr_sjd_item_grid;
						$GLOBALS["tr_sjd_item_grid"]->Page_Init();
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "tr_sjd_masterview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				header("Content-Type: application/json; charset=utf-8");
				echo ew_ConvertToUtf8(ew_ArrayToJson(array($row)));
			} else {
				ew_SaveDebugMsg();
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewAddForm form-horizontal";

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["sjd_id"] != "") {
				$this->sjd_id->setQueryStringValue($_GET["sjd_id"]);
				$this->setKey("sjd_id", $this->sjd_id->CurrentValue); // Set up key
			} else {
				$this->setKey("sjd_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->LoadOldRecord();

		// Load form values
		if (@$_POST["a_add"] <> "") {
			$this->LoadFormValues(); // Load form values
		}

		// Set up detail parameters
		$this->SetupDetailParms();

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Blank record
				break;
			case "C": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tr_sjd_masterlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $this->GetDetailUrl();
					else
						$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tr_sjd_masterlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "tr_sjd_masterview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->SetupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->sjd_id->CurrentValue = NULL;
		$this->sjd_id->OldValue = $this->sjd_id->CurrentValue;
		$this->kode_depo->CurrentValue = NULL;
		$this->kode_depo->OldValue = $this->kode_depo->CurrentValue;
		$this->sjd_number->CurrentValue = NULL;
		$this->sjd_number->OldValue = $this->sjd_number->CurrentValue;
		$this->sjd_date->CurrentValue = NULL;
		$this->sjd_date->OldValue = $this->sjd_date->CurrentValue;
		$this->rcv_date->CurrentValue = NULL;
		$this->rcv_date->OldValue = $this->rcv_date->CurrentValue;
		$this->sjd_notes->CurrentValue = NULL;
		$this->sjd_notes->OldValue = $this->sjd_notes->CurrentValue;
		$this->lastupdate->CurrentValue = NULL;
		$this->lastupdate->OldValue = $this->lastupdate->CurrentValue;
		$this->user_id->CurrentValue = NULL;
		$this->user_id->OldValue = $this->user_id->CurrentValue;
		$this->pb_no->CurrentValue = NULL;
		$this->pb_no->OldValue = $this->pb_no->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->sjd_number->FldIsDetailKey) {
			$this->sjd_number->setFormValue($objForm->GetValue("x_sjd_number"));
		}
		if (!$this->sjd_date->FldIsDetailKey) {
			$this->sjd_date->setFormValue($objForm->GetValue("x_sjd_date"));
			$this->sjd_date->CurrentValue = ew_UnFormatDateTime($this->sjd_date->CurrentValue, 7);
		}
		if (!$this->rcv_date->FldIsDetailKey) {
			$this->rcv_date->setFormValue($objForm->GetValue("x_rcv_date"));
			$this->rcv_date->CurrentValue = ew_UnFormatDateTime($this->rcv_date->CurrentValue, 7);
		}
		if (!$this->sjd_notes->FldIsDetailKey) {
			$this->sjd_notes->setFormValue($objForm->GetValue("x_sjd_notes"));
		}
		if (!$this->pb_no->FldIsDetailKey) {
			$this->pb_no->setFormValue($objForm->GetValue("x_pb_no"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->sjd_number->CurrentValue = $this->sjd_number->FormValue;
		$this->sjd_date->CurrentValue = $this->sjd_date->FormValue;
		$this->sjd_date->CurrentValue = ew_UnFormatDateTime($this->sjd_date->CurrentValue, 7);
		$this->rcv_date->CurrentValue = $this->rcv_date->FormValue;
		$this->rcv_date->CurrentValue = ew_UnFormatDateTime($this->rcv_date->CurrentValue, 7);
		$this->sjd_notes->CurrentValue = $this->sjd_notes->FormValue;
		$this->pb_no->CurrentValue = $this->pb_no->FormValue;
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
		$this->LoadDefaultValues();
		$row = array();
		$row['sjd_id'] = $this->sjd_id->CurrentValue;
		$row['kode_depo'] = $this->kode_depo->CurrentValue;
		$row['sjd_number'] = $this->sjd_number->CurrentValue;
		$row['sjd_date'] = $this->sjd_date->CurrentValue;
		$row['rcv_date'] = $this->rcv_date->CurrentValue;
		$row['sjd_notes'] = $this->sjd_notes->CurrentValue;
		$row['lastupdate'] = $this->lastupdate->CurrentValue;
		$row['user_id'] = $this->user_id->CurrentValue;
		$row['pb_no'] = $this->pb_no->CurrentValue;
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("sjd_id")) <> "")
			$this->sjd_id->CurrentValue = $this->getKey("sjd_id"); // sjd_id
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// sjd_number
			$this->sjd_number->EditAttrs["class"] = "form-control";
			$this->sjd_number->EditCustomAttributes = "";
			$this->sjd_number->EditValue = ew_HtmlEncode($this->sjd_number->CurrentValue);
			$this->sjd_number->PlaceHolder = ew_RemoveHtml($this->sjd_number->FldCaption());

			// sjd_date
			$this->sjd_date->EditAttrs["class"] = "form-control";
			$this->sjd_date->EditCustomAttributes = "";
			$this->sjd_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->sjd_date->CurrentValue, 7));
			$this->sjd_date->PlaceHolder = ew_RemoveHtml($this->sjd_date->FldCaption());

			// rcv_date
			$this->rcv_date->EditAttrs["class"] = "form-control";
			$this->rcv_date->EditCustomAttributes = "";
			$this->rcv_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->rcv_date->CurrentValue, 7));
			$this->rcv_date->PlaceHolder = ew_RemoveHtml($this->rcv_date->FldCaption());

			// sjd_notes
			$this->sjd_notes->EditAttrs["class"] = "form-control";
			$this->sjd_notes->EditCustomAttributes = "";
			$this->sjd_notes->EditValue = ew_HtmlEncode($this->sjd_notes->CurrentValue);
			$this->sjd_notes->PlaceHolder = ew_RemoveHtml($this->sjd_notes->FldCaption());

			// pb_no
			$this->pb_no->EditAttrs["class"] = "form-control";
			$this->pb_no->EditCustomAttributes = "";
			$this->pb_no->EditValue = ew_HtmlEncode($this->pb_no->CurrentValue);
			$this->pb_no->PlaceHolder = ew_RemoveHtml($this->pb_no->FldCaption());

			// Add refer script
			// sjd_number

			$this->sjd_number->LinkCustomAttributes = "";
			$this->sjd_number->HrefValue = "";

			// sjd_date
			$this->sjd_date->LinkCustomAttributes = "";
			$this->sjd_date->HrefValue = "";

			// rcv_date
			$this->rcv_date->LinkCustomAttributes = "";
			$this->rcv_date->HrefValue = "";

			// sjd_notes
			$this->sjd_notes->LinkCustomAttributes = "";
			$this->sjd_notes->HrefValue = "";

			// pb_no
			$this->pb_no->LinkCustomAttributes = "";
			$this->pb_no->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckEuroDate($this->sjd_date->FormValue)) {
			ew_AddMessage($gsFormError, $this->sjd_date->FldErrMsg());
		}
		if (!ew_CheckEuroDate($this->rcv_date->FormValue)) {
			ew_AddMessage($gsFormError, $this->rcv_date->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("tr_sjd_item", $DetailTblVar) && $GLOBALS["tr_sjd_item"]->DetailAdd) {
			if (!isset($GLOBALS["tr_sjd_item_grid"])) $GLOBALS["tr_sjd_item_grid"] = new ctr_sjd_item_grid(); // get detail page object
			$GLOBALS["tr_sjd_item_grid"]->ValidateGridForm();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->BeginTrans();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// sjd_number
		$this->sjd_number->SetDbValueDef($rsnew, $this->sjd_number->CurrentValue, NULL, FALSE);

		// sjd_date
		$this->sjd_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->sjd_date->CurrentValue, 7), NULL, FALSE);

		// rcv_date
		$this->rcv_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->rcv_date->CurrentValue, 7), NULL, FALSE);

		// sjd_notes
		$this->sjd_notes->SetDbValueDef($rsnew, $this->sjd_notes->CurrentValue, NULL, FALSE);

		// pb_no
		$this->pb_no->SetDbValueDef($rsnew, $this->pb_no->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Add detail records
		if ($AddRow) {
			$DetailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("tr_sjd_item", $DetailTblVar) && $GLOBALS["tr_sjd_item"]->DetailAdd) {
				$GLOBALS["tr_sjd_item"]->master_id->setSessionValue($this->sjd_id->CurrentValue); // Set master key
				if (!isset($GLOBALS["tr_sjd_item_grid"])) $GLOBALS["tr_sjd_item_grid"] = new ctr_sjd_item_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "tr_sjd_item"); // Load user level of detail table
				$AddRow = $GLOBALS["tr_sjd_item_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["tr_sjd_item"]->master_id->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up detail parms based on QueryString
	function SetupDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("tr_sjd_item", $DetailTblVar)) {
				if (!isset($GLOBALS["tr_sjd_item_grid"]))
					$GLOBALS["tr_sjd_item_grid"] = new ctr_sjd_item_grid;
				if ($GLOBALS["tr_sjd_item_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["tr_sjd_item_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["tr_sjd_item_grid"]->CurrentMode = "add";
					$GLOBALS["tr_sjd_item_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["tr_sjd_item_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["tr_sjd_item_grid"]->setStartRecordNumber(1);
					$GLOBALS["tr_sjd_item_grid"]->master_id->FldIsDetailKey = TRUE;
					$GLOBALS["tr_sjd_item_grid"]->master_id->CurrentValue = $this->sjd_id->CurrentValue;
					$GLOBALS["tr_sjd_item_grid"]->master_id->setSessionValue($GLOBALS["tr_sjd_item_grid"]->master_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_sjd_masterlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($tr_sjd_master_add)) $tr_sjd_master_add = new ctr_sjd_master_add();

// Page init
$tr_sjd_master_add->Page_Init();

// Page main
$tr_sjd_master_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_sjd_master_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ftr_sjd_masteradd = new ew_Form("ftr_sjd_masteradd", "add");

// Validate form
ftr_sjd_masteradd.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_sjd_date");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_sjd_master->sjd_date->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_rcv_date");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_sjd_master->rcv_date->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftr_sjd_masteradd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_sjd_masteradd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tr_sjd_master_add->ShowPageHeader(); ?>
<?php
$tr_sjd_master_add->ShowMessage();
?>
<form name="ftr_sjd_masteradd" id="ftr_sjd_masteradd" class="<?php echo $tr_sjd_master_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_sjd_master_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_sjd_master_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_sjd_master">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($tr_sjd_master_add->IsModal) ?>">
<?php if (!$tr_sjd_master_add->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tr_sjd_master_add->IsMobileOrModal) { ?>
<div class="ewAddDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_tr_sjd_masteradd" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($tr_sjd_master->sjd_number->Visible) { // sjd_number ?>
<?php if ($tr_sjd_master_add->IsMobileOrModal) { ?>
	<div id="r_sjd_number" class="form-group">
		<label id="elh_tr_sjd_master_sjd_number" for="x_sjd_number" class="<?php echo $tr_sjd_master_add->LeftColumnClass ?>"><?php echo $tr_sjd_master->sjd_number->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_master_add->RightColumnClass ?>"><div<?php echo $tr_sjd_master->sjd_number->CellAttributes() ?>>
<span id="el_tr_sjd_master_sjd_number">
<input type="text" data-table="tr_sjd_master" data-field="x_sjd_number" name="x_sjd_number" id="x_sjd_number" size="15" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_master->sjd_number->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_master->sjd_number->EditValue ?>"<?php echo $tr_sjd_master->sjd_number->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_master->sjd_number->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sjd_number">
		<td class="col-sm-2"><span id="elh_tr_sjd_master_sjd_number"><?php echo $tr_sjd_master->sjd_number->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_master->sjd_number->CellAttributes() ?>>
<span id="el_tr_sjd_master_sjd_number">
<input type="text" data-table="tr_sjd_master" data-field="x_sjd_number" name="x_sjd_number" id="x_sjd_number" size="15" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_master->sjd_number->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_master->sjd_number->EditValue ?>"<?php echo $tr_sjd_master->sjd_number->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_master->sjd_number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_master->sjd_date->Visible) { // sjd_date ?>
<?php if ($tr_sjd_master_add->IsMobileOrModal) { ?>
	<div id="r_sjd_date" class="form-group">
		<label id="elh_tr_sjd_master_sjd_date" for="x_sjd_date" class="<?php echo $tr_sjd_master_add->LeftColumnClass ?>"><?php echo $tr_sjd_master->sjd_date->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_master_add->RightColumnClass ?>"><div<?php echo $tr_sjd_master->sjd_date->CellAttributes() ?>>
<span id="el_tr_sjd_master_sjd_date">
<input type="text" data-table="tr_sjd_master" data-field="x_sjd_date" data-format="7" name="x_sjd_date" id="x_sjd_date" size="15" placeholder="<?php echo ew_HtmlEncode($tr_sjd_master->sjd_date->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_master->sjd_date->EditValue ?>"<?php echo $tr_sjd_master->sjd_date->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_master->sjd_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sjd_date">
		<td class="col-sm-2"><span id="elh_tr_sjd_master_sjd_date"><?php echo $tr_sjd_master->sjd_date->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_master->sjd_date->CellAttributes() ?>>
<span id="el_tr_sjd_master_sjd_date">
<input type="text" data-table="tr_sjd_master" data-field="x_sjd_date" data-format="7" name="x_sjd_date" id="x_sjd_date" size="15" placeholder="<?php echo ew_HtmlEncode($tr_sjd_master->sjd_date->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_master->sjd_date->EditValue ?>"<?php echo $tr_sjd_master->sjd_date->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_master->sjd_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_master->rcv_date->Visible) { // rcv_date ?>
<?php if ($tr_sjd_master_add->IsMobileOrModal) { ?>
	<div id="r_rcv_date" class="form-group">
		<label id="elh_tr_sjd_master_rcv_date" for="x_rcv_date" class="<?php echo $tr_sjd_master_add->LeftColumnClass ?>"><?php echo $tr_sjd_master->rcv_date->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_master_add->RightColumnClass ?>"><div<?php echo $tr_sjd_master->rcv_date->CellAttributes() ?>>
<span id="el_tr_sjd_master_rcv_date">
<input type="text" data-table="tr_sjd_master" data-field="x_rcv_date" data-format="7" name="x_rcv_date" id="x_rcv_date" size="15" placeholder="<?php echo ew_HtmlEncode($tr_sjd_master->rcv_date->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_master->rcv_date->EditValue ?>"<?php echo $tr_sjd_master->rcv_date->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_master->rcv_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_rcv_date">
		<td class="col-sm-2"><span id="elh_tr_sjd_master_rcv_date"><?php echo $tr_sjd_master->rcv_date->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_master->rcv_date->CellAttributes() ?>>
<span id="el_tr_sjd_master_rcv_date">
<input type="text" data-table="tr_sjd_master" data-field="x_rcv_date" data-format="7" name="x_rcv_date" id="x_rcv_date" size="15" placeholder="<?php echo ew_HtmlEncode($tr_sjd_master->rcv_date->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_master->rcv_date->EditValue ?>"<?php echo $tr_sjd_master->rcv_date->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_master->rcv_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_master->sjd_notes->Visible) { // sjd_notes ?>
<?php if ($tr_sjd_master_add->IsMobileOrModal) { ?>
	<div id="r_sjd_notes" class="form-group">
		<label id="elh_tr_sjd_master_sjd_notes" for="x_sjd_notes" class="<?php echo $tr_sjd_master_add->LeftColumnClass ?>"><?php echo $tr_sjd_master->sjd_notes->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_master_add->RightColumnClass ?>"><div<?php echo $tr_sjd_master->sjd_notes->CellAttributes() ?>>
<span id="el_tr_sjd_master_sjd_notes">
<input type="text" data-table="tr_sjd_master" data-field="x_sjd_notes" name="x_sjd_notes" id="x_sjd_notes" size="50" maxlength="255" placeholder="<?php echo ew_HtmlEncode($tr_sjd_master->sjd_notes->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_master->sjd_notes->EditValue ?>"<?php echo $tr_sjd_master->sjd_notes->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_master->sjd_notes->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sjd_notes">
		<td class="col-sm-2"><span id="elh_tr_sjd_master_sjd_notes"><?php echo $tr_sjd_master->sjd_notes->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_master->sjd_notes->CellAttributes() ?>>
<span id="el_tr_sjd_master_sjd_notes">
<input type="text" data-table="tr_sjd_master" data-field="x_sjd_notes" name="x_sjd_notes" id="x_sjd_notes" size="50" maxlength="255" placeholder="<?php echo ew_HtmlEncode($tr_sjd_master->sjd_notes->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_master->sjd_notes->EditValue ?>"<?php echo $tr_sjd_master->sjd_notes->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_master->sjd_notes->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_master->pb_no->Visible) { // pb_no ?>
<?php if ($tr_sjd_master_add->IsMobileOrModal) { ?>
	<div id="r_pb_no" class="form-group">
		<label id="elh_tr_sjd_master_pb_no" for="x_pb_no" class="<?php echo $tr_sjd_master_add->LeftColumnClass ?>"><?php echo $tr_sjd_master->pb_no->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_master_add->RightColumnClass ?>"><div<?php echo $tr_sjd_master->pb_no->CellAttributes() ?>>
<span id="el_tr_sjd_master_pb_no">
<input type="text" data-table="tr_sjd_master" data-field="x_pb_no" name="x_pb_no" id="x_pb_no" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_master->pb_no->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_master->pb_no->EditValue ?>"<?php echo $tr_sjd_master->pb_no->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_master->pb_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_pb_no">
		<td class="col-sm-2"><span id="elh_tr_sjd_master_pb_no"><?php echo $tr_sjd_master->pb_no->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_master->pb_no->CellAttributes() ?>>
<span id="el_tr_sjd_master_pb_no">
<input type="text" data-table="tr_sjd_master" data-field="x_pb_no" name="x_pb_no" id="x_pb_no" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_master->pb_no->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_master->pb_no->EditValue ?>"<?php echo $tr_sjd_master->pb_no->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_master->pb_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_master_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php
	if (in_array("tr_sjd_item", explode(",", $tr_sjd_master->getCurrentDetailTable())) && $tr_sjd_item->DetailAdd) {
?>
<?php if ($tr_sjd_master->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("tr_sjd_item", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tr_sjd_itemgrid.php" ?>
<?php } ?>
<?php if (!$tr_sjd_master_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tr_sjd_master_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tr_sjd_master_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tr_sjd_master_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ftr_sjd_masteradd.Init();
</script>
<?php
$tr_sjd_master_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_sjd_master_add->Page_Terminate();
?>
