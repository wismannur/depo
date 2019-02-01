<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_retc_masterinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tr_retc_itemgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_retc_master_edit = NULL; // Initialize page object first

class ctr_retc_master_edit extends ctr_retc_master {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_retc_master';

	// Page object name
	var $PageObjName = 'tr_retc_master_edit';

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

		// Table object (tr_retc_master)
		if (!isset($GLOBALS["tr_retc_master"]) || get_class($GLOBALS["tr_retc_master"]) == "ctr_retc_master") {
			$GLOBALS["tr_retc_master"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_retc_master"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_retc_master', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("tr_retc_masterlist.php"));
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
				if (in_array("tr_retc_item", $DetailTblVar)) {

					// Process auto fill for detail table 'tr_retc_item'
					if (preg_match('/^ftr_retc_item(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["tr_retc_item_grid"])) $GLOBALS["tr_retc_item_grid"] = new ctr_retc_item_grid;
						$GLOBALS["tr_retc_item_grid"]->Page_Init();
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
		if (@$_POST["customexport"] == "") {

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		}

		// Export
		global $EW_EXPORT, $tr_retc_master;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
			if (is_array(@$_SESSION[EW_SESSION_TEMP_IMAGES])) // Restore temp images
				$gTmpImages = @$_SESSION[EW_SESSION_TEMP_IMAGES];
			if (@$_POST["data"] <> "")
				$sContent = $_POST["data"];
			$gsExportFile = @$_POST["filename"];
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_retc_master);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
	if ($this->CustomExport <> "") { // Save temp images array for custom export
		if (is_array($gTmpImages))
			$_SESSION[EW_SESSION_TEMP_IMAGES] = $gTmpImages;
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
					if ($pageName == "tr_retc_masterview.php")
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
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewEditForm form-horizontal";
		$sReturnUrl = "";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			if ($this->CurrentAction <> "I") // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($objForm->HasValue("x_retc_id")) {
				$this->retc_id->setFormValue($objForm->GetValue("x_retc_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["retc_id"])) {
				$this->retc_id->setQueryStringValue($_GET["retc_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->retc_id->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->LoadRow();

		// Process form if post back
		if ($postBack) {
			$this->LoadFormValues(); // Get form values

			// Set up detail parameters
			$this->SetupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tr_retc_masterlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			Case "U": // Update
				$sReturnUrl = "tr_retc_masterlist.php";
				if (ew_GetPageName($sReturnUrl) == "tr_retc_masterlist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->SetupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
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

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->retc_number->FldIsDetailKey) {
			$this->retc_number->setFormValue($objForm->GetValue("x_retc_number"));
		}
		if (!$this->retc_date->FldIsDetailKey) {
			$this->retc_date->setFormValue($objForm->GetValue("x_retc_date"));
			$this->retc_date->CurrentValue = ew_UnFormatDateTime($this->retc_date->CurrentValue, 0);
		}
		if (!$this->sjc_number->FldIsDetailKey) {
			$this->sjc_number->setFormValue($objForm->GetValue("x_sjc_number"));
		}
		if (!$this->kode_depo->FldIsDetailKey) {
			$this->kode_depo->setFormValue($objForm->GetValue("x_kode_depo"));
		}
		if (!$this->retc_notes->FldIsDetailKey) {
			$this->retc_notes->setFormValue($objForm->GetValue("x_retc_notes"));
		}
		if (!$this->sales_id->FldIsDetailKey) {
			$this->sales_id->setFormValue($objForm->GetValue("x_sales_id"));
		}
		if (!$this->user_id->FldIsDetailKey) {
			$this->user_id->setFormValue($objForm->GetValue("x_user_id"));
		}
		if (!$this->lastupdate->FldIsDetailKey) {
			$this->lastupdate->setFormValue($objForm->GetValue("x_lastupdate"));
			$this->lastupdate->CurrentValue = ew_UnFormatDateTime($this->lastupdate->CurrentValue, 0);
		}
		if (!$this->retc_id->FldIsDetailKey)
			$this->retc_id->setFormValue($objForm->GetValue("x_retc_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->retc_id->CurrentValue = $this->retc_id->FormValue;
		$this->retc_number->CurrentValue = $this->retc_number->FormValue;
		$this->retc_date->CurrentValue = $this->retc_date->FormValue;
		$this->retc_date->CurrentValue = ew_UnFormatDateTime($this->retc_date->CurrentValue, 0);
		$this->sjc_number->CurrentValue = $this->sjc_number->FormValue;
		$this->kode_depo->CurrentValue = $this->kode_depo->FormValue;
		$this->retc_notes->CurrentValue = $this->retc_notes->FormValue;
		$this->sales_id->CurrentValue = $this->sales_id->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->lastupdate->CurrentValue = $this->lastupdate->FormValue;
		$this->lastupdate->CurrentValue = ew_UnFormatDateTime($this->lastupdate->CurrentValue, 0);
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
		$this->retc_id->setDbValue($row['retc_id']);
		$this->retc_number->setDbValue($row['retc_number']);
		$this->retc_date->setDbValue($row['retc_date']);
		$this->sjc_number->setDbValue($row['sjc_number']);
		$this->kode_depo->setDbValue($row['kode_depo']);
		$this->retc_notes->setDbValue($row['retc_notes']);
		$this->sales_id->setDbValue($row['sales_id']);
		$this->user_id->setDbValue($row['user_id']);
		$this->lastupdate->setDbValue($row['lastupdate']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['retc_id'] = NULL;
		$row['retc_number'] = NULL;
		$row['retc_date'] = NULL;
		$row['sjc_number'] = NULL;
		$row['kode_depo'] = NULL;
		$row['retc_notes'] = NULL;
		$row['sales_id'] = NULL;
		$row['user_id'] = NULL;
		$row['lastupdate'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->retc_id->DbValue = $row['retc_id'];
		$this->retc_number->DbValue = $row['retc_number'];
		$this->retc_date->DbValue = $row['retc_date'];
		$this->sjc_number->DbValue = $row['sjc_number'];
		$this->kode_depo->DbValue = $row['kode_depo'];
		$this->retc_notes->DbValue = $row['retc_notes'];
		$this->sales_id->DbValue = $row['sales_id'];
		$this->user_id->DbValue = $row['user_id'];
		$this->lastupdate->DbValue = $row['lastupdate'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("retc_id")) <> "")
			$this->retc_id->CurrentValue = $this->getKey("retc_id"); // retc_id
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
		// retc_id
		// retc_number
		// retc_date
		// sjc_number
		// kode_depo
		// retc_notes
		// sales_id
		// user_id
		// lastupdate

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// retc_id
		$this->retc_id->ViewValue = $this->retc_id->CurrentValue;
		$this->retc_id->ViewCustomAttributes = "";

		// retc_number
		$this->retc_number->ViewValue = $this->retc_number->CurrentValue;
		$this->retc_number->ViewCustomAttributes = "";

		// retc_date
		$this->retc_date->ViewValue = $this->retc_date->CurrentValue;
		$this->retc_date->ViewValue = ew_FormatDateTime($this->retc_date->ViewValue, 0);
		$this->retc_date->ViewCustomAttributes = "";

		// sjc_number
		if (strval($this->sjc_number->CurrentValue) <> "") {
			$sFilterWrk = "`sjc_number`" . ew_SearchString("=", $this->sjc_number->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `sjc_number`, `sjc_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_sjc_master`";
		$sWhereWrk = "";
		$this->sjc_number->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->sjc_number, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->sjc_number->ViewValue = $this->sjc_number->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->sjc_number->ViewValue = $this->sjc_number->CurrentValue;
			}
		} else {
			$this->sjc_number->ViewValue = NULL;
		}
		$this->sjc_number->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// retc_notes
		$this->retc_notes->ViewValue = $this->retc_notes->CurrentValue;
		$this->retc_notes->ViewCustomAttributes = "";

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

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// lastupdate
		$this->lastupdate->ViewValue = $this->lastupdate->CurrentValue;
		$this->lastupdate->ViewValue = ew_FormatDateTime($this->lastupdate->ViewValue, 0);
		$this->lastupdate->ViewCustomAttributes = "";

			// retc_number
			$this->retc_number->LinkCustomAttributes = "";
			$this->retc_number->HrefValue = "";
			$this->retc_number->TooltipValue = "";

			// retc_date
			$this->retc_date->LinkCustomAttributes = "";
			$this->retc_date->HrefValue = "";
			$this->retc_date->TooltipValue = "";

			// sjc_number
			$this->sjc_number->LinkCustomAttributes = "";
			$this->sjc_number->HrefValue = "";
			$this->sjc_number->TooltipValue = "";

			// kode_depo
			$this->kode_depo->LinkCustomAttributes = "";
			$this->kode_depo->HrefValue = "";
			$this->kode_depo->TooltipValue = "";

			// retc_notes
			$this->retc_notes->LinkCustomAttributes = "";
			$this->retc_notes->HrefValue = "";
			$this->retc_notes->TooltipValue = "";

			// sales_id
			$this->sales_id->LinkCustomAttributes = "";
			$this->sales_id->HrefValue = "";
			$this->sales_id->TooltipValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// lastupdate
			$this->lastupdate->LinkCustomAttributes = "";
			$this->lastupdate->HrefValue = "";
			$this->lastupdate->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// retc_number
			$this->retc_number->EditAttrs["class"] = "form-control";
			$this->retc_number->EditCustomAttributes = "";
			$this->retc_number->EditValue = ew_HtmlEncode($this->retc_number->CurrentValue);
			$this->retc_number->PlaceHolder = ew_RemoveHtml($this->retc_number->FldCaption());

			// retc_date
			$this->retc_date->EditAttrs["class"] = "form-control";
			$this->retc_date->EditCustomAttributes = "";
			$this->retc_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->retc_date->CurrentValue, 8));
			$this->retc_date->PlaceHolder = ew_RemoveHtml($this->retc_date->FldCaption());

			// sjc_number
			$this->sjc_number->EditCustomAttributes = "";
			if (trim(strval($this->sjc_number->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`sjc_number`" . ew_SearchString("=", $this->sjc_number->CurrentValue, EW_DATATYPE_STRING, "");
			}
			$sSqlWrk = "SELECT `sjc_number`, `sjc_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `sales_id` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tr_sjc_master`";
			$sWhereWrk = "";
			$this->sjc_number->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->sjc_number, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->sjc_number->ViewValue = $this->sjc_number->DisplayValue($arwrk);
			} else {
				$this->sjc_number->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->sjc_number->EditValue = $arwrk;

			// kode_depo
			$this->kode_depo->EditAttrs["class"] = "form-control";
			$this->kode_depo->EditCustomAttributes = "";
			$this->kode_depo->EditValue = ew_HtmlEncode($this->kode_depo->CurrentValue);
			$this->kode_depo->PlaceHolder = ew_RemoveHtml($this->kode_depo->FldCaption());

			// retc_notes
			$this->retc_notes->EditAttrs["class"] = "form-control";
			$this->retc_notes->EditCustomAttributes = "";
			$this->retc_notes->EditValue = ew_HtmlEncode($this->retc_notes->CurrentValue);
			$this->retc_notes->PlaceHolder = ew_RemoveHtml($this->retc_notes->FldCaption());

			// sales_id
			$this->sales_id->EditCustomAttributes = "";
			if (trim(strval($this->sales_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`sales_id`" . ew_SearchString("=", $this->sales_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `sales_id`, `sales_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tbl_salesman`";
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
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->sales_id->ViewValue = $this->sales_id->DisplayValue($arwrk);
			} else {
				$this->sales_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->sales_id->EditValue = $arwrk;

			// user_id
			// lastupdate
			// Edit refer script
			// retc_number

			$this->retc_number->LinkCustomAttributes = "";
			$this->retc_number->HrefValue = "";

			// retc_date
			$this->retc_date->LinkCustomAttributes = "";
			$this->retc_date->HrefValue = "";

			// sjc_number
			$this->sjc_number->LinkCustomAttributes = "";
			$this->sjc_number->HrefValue = "";

			// kode_depo
			$this->kode_depo->LinkCustomAttributes = "";
			$this->kode_depo->HrefValue = "";

			// retc_notes
			$this->retc_notes->LinkCustomAttributes = "";
			$this->retc_notes->HrefValue = "";

			// sales_id
			$this->sales_id->LinkCustomAttributes = "";
			$this->sales_id->HrefValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// lastupdate
			$this->lastupdate->LinkCustomAttributes = "";
			$this->lastupdate->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();

		// Save data for Custom Template
		if ($this->RowType == EW_ROWTYPE_VIEW || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_ADD)
			$this->Rows[] = $this->CustomTemplateFieldValues();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckDateDef($this->retc_date->FormValue)) {
			ew_AddMessage($gsFormError, $this->retc_date->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("tr_retc_item", $DetailTblVar) && $GLOBALS["tr_retc_item"]->DetailEdit) {
			if (!isset($GLOBALS["tr_retc_item_grid"])) $GLOBALS["tr_retc_item_grid"] = new ctr_retc_item_grid(); // get detail page object
			$GLOBALS["tr_retc_item_grid"]->ValidateGridForm();
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

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($this->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// retc_number
			$this->retc_number->SetDbValueDef($rsnew, $this->retc_number->CurrentValue, NULL, $this->retc_number->ReadOnly);

			// retc_date
			$this->retc_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->retc_date->CurrentValue, 0), NULL, $this->retc_date->ReadOnly);

			// sjc_number
			$this->sjc_number->SetDbValueDef($rsnew, $this->sjc_number->CurrentValue, NULL, $this->sjc_number->ReadOnly);

			// kode_depo
			$this->kode_depo->SetDbValueDef($rsnew, $this->kode_depo->CurrentValue, NULL, $this->kode_depo->ReadOnly);

			// retc_notes
			$this->retc_notes->SetDbValueDef($rsnew, $this->retc_notes->CurrentValue, NULL, $this->retc_notes->ReadOnly);

			// sales_id
			$this->sales_id->SetDbValueDef($rsnew, $this->sales_id->CurrentValue, NULL, $this->sales_id->ReadOnly);

			// user_id
			$this->user_id->SetDbValueDef($rsnew, CurrentUserID(), NULL);
			$rsnew['user_id'] = &$this->user_id->DbValue;

			// lastupdate
			$this->lastupdate->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['lastupdate'] = &$this->lastupdate->DbValue;

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}

				// Update detail records
				$DetailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($EditRow) {
					if (in_array("tr_retc_item", $DetailTblVar) && $GLOBALS["tr_retc_item"]->DetailEdit) {
						if (!isset($GLOBALS["tr_retc_item_grid"])) $GLOBALS["tr_retc_item_grid"] = new ctr_retc_item_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "tr_retc_item"); // Load user level of detail table
						$EditRow = $GLOBALS["tr_retc_item_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
			if (in_array("tr_retc_item", $DetailTblVar)) {
				if (!isset($GLOBALS["tr_retc_item_grid"]))
					$GLOBALS["tr_retc_item_grid"] = new ctr_retc_item_grid;
				if ($GLOBALS["tr_retc_item_grid"]->DetailEdit) {
					$GLOBALS["tr_retc_item_grid"]->CurrentMode = "edit";
					$GLOBALS["tr_retc_item_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["tr_retc_item_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["tr_retc_item_grid"]->setStartRecordNumber(1);
					$GLOBALS["tr_retc_item_grid"]->master_id->FldIsDetailKey = TRUE;
					$GLOBALS["tr_retc_item_grid"]->master_id->CurrentValue = $this->retc_id->CurrentValue;
					$GLOBALS["tr_retc_item_grid"]->master_id->setSessionValue($GLOBALS["tr_retc_item_grid"]->master_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_retc_masterlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_sjc_number":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `sjc_number` AS `LinkFld`, `sjc_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_sjc_master`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`sjc_number` IN ({filter_value})', "t0" => "200", "fn0" => "", "f1" => '`sales_id` IN ({filter_value})', "t1" => "3", "fn1" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->sjc_number, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_sales_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `sales_id` AS `LinkFld`, `sales_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_salesman`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`sales_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->sales_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `sales_name`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($tr_retc_master_edit)) $tr_retc_master_edit = new ctr_retc_master_edit();

// Page init
$tr_retc_master_edit->Page_Init();

// Page main
$tr_retc_master_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_retc_master_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ftr_retc_masteredit = new ew_Form("ftr_retc_masteredit", "edit");

// Validate form
ftr_retc_masteredit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_retc_date");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_retc_master->retc_date->FldErrMsg()) ?>");

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
ftr_retc_masteredit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_retc_masteredit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_retc_masteredit.Lists["x_sjc_number"] = {"LinkField":"x_sjc_number","Ajax":true,"AutoFill":false,"DisplayFields":["x_sjc_number","","",""],"ParentFields":["x_sales_id"],"ChildFields":[],"FilterFields":["x_sales_id"],"Options":[],"Template":"","LinkTable":"tr_sjc_master"};
ftr_retc_masteredit.Lists["x_sjc_number"].Data = "<?php echo $tr_retc_master_edit->sjc_number->LookupFilterQuery(FALSE, "edit") ?>";
ftr_retc_masteredit.Lists["x_sales_id"] = {"LinkField":"x_sales_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_sales_name","","",""],"ParentFields":[],"ChildFields":["x_sjc_number"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_salesman"};
ftr_retc_masteredit.Lists["x_sales_id"].Data = "<?php echo $tr_retc_master_edit->sales_id->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tr_retc_master_edit->ShowPageHeader(); ?>
<?php
$tr_retc_master_edit->ShowMessage();
?>
<form name="ftr_retc_masteredit" id="ftr_retc_masteredit" class="<?php echo $tr_retc_master_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_retc_master_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_retc_master_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_retc_master">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($tr_retc_master_edit->IsModal) ?>">
<div id="tpd_tr_retc_masteredit" class="ewCustomTemplate"></div>
<script id="tpm_tr_retc_masteredit" type="text/html">
<div id="ct_tr_retc_master_edit"><div class="col-sm-12 panel-custom" style="">
	<div class="col-sm-5">
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_retc_master->retc_number->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_retc_master_retc_number"/}}</div>
		</div>
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_retc_master->retc_date->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_retc_master_retc_date"/}}</div>
		</div>
	</div>
	<div class="col-sm-7">
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_retc_master->sales_id->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_retc_master_sales_id"/}}</div>
		</div>
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_retc_master->sjc_number->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_retc_master_sjc_number"/}}</div>
		</div>
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_retc_master->retc_notes->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_retc_master_retc_notes"/}}</div>
		</div>
	</div>
</div>
</div>
</script>
<?php if (!$tr_retc_master_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tr_retc_master_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv hidden"><!-- page* -->
<?php } else { ?>
<table id="tbl_tr_retc_masteredit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable hidden"><!-- table* -->
<?php } ?>
<?php if ($tr_retc_master->retc_number->Visible) { // retc_number ?>
<?php if ($tr_retc_master_edit->IsMobileOrModal) { ?>
	<div id="r_retc_number" class="form-group">
		<label id="elh_tr_retc_master_retc_number" for="x_retc_number" class="<?php echo $tr_retc_master_edit->LeftColumnClass ?>"><script id="tpc_tr_retc_master_retc_number" class="tr_retc_masteredit" type="text/html"><span><?php echo $tr_retc_master->retc_number->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_retc_master_edit->RightColumnClass ?>"><div<?php echo $tr_retc_master->retc_number->CellAttributes() ?>>
<script id="tpx_tr_retc_master_retc_number" class="tr_retc_masteredit" type="text/html">
<span id="el_tr_retc_master_retc_number">
<input type="text" data-table="tr_retc_master" data-field="x_retc_number" name="x_retc_number" id="x_retc_number" size="15" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_retc_master->retc_number->getPlaceHolder()) ?>" value="<?php echo $tr_retc_master->retc_number->EditValue ?>"<?php echo $tr_retc_master->retc_number->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_retc_master->retc_number->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_retc_number">
		<td class="col-sm-2"><span id="elh_tr_retc_master_retc_number"><script id="tpc_tr_retc_master_retc_number" class="tr_retc_masteredit" type="text/html"><span><?php echo $tr_retc_master->retc_number->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_retc_master->retc_number->CellAttributes() ?>>
<script id="tpx_tr_retc_master_retc_number" class="tr_retc_masteredit" type="text/html">
<span id="el_tr_retc_master_retc_number">
<input type="text" data-table="tr_retc_master" data-field="x_retc_number" name="x_retc_number" id="x_retc_number" size="15" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_retc_master->retc_number->getPlaceHolder()) ?>" value="<?php echo $tr_retc_master->retc_number->EditValue ?>"<?php echo $tr_retc_master->retc_number->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_retc_master->retc_number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_retc_master->retc_date->Visible) { // retc_date ?>
<?php if ($tr_retc_master_edit->IsMobileOrModal) { ?>
	<div id="r_retc_date" class="form-group">
		<label id="elh_tr_retc_master_retc_date" for="x_retc_date" class="<?php echo $tr_retc_master_edit->LeftColumnClass ?>"><script id="tpc_tr_retc_master_retc_date" class="tr_retc_masteredit" type="text/html"><span><?php echo $tr_retc_master->retc_date->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_retc_master_edit->RightColumnClass ?>"><div<?php echo $tr_retc_master->retc_date->CellAttributes() ?>>
<script id="tpx_tr_retc_master_retc_date" class="tr_retc_masteredit" type="text/html">
<span id="el_tr_retc_master_retc_date">
<input type="text" data-table="tr_retc_master" data-field="x_retc_date" name="x_retc_date" id="x_retc_date" size="10" placeholder="<?php echo ew_HtmlEncode($tr_retc_master->retc_date->getPlaceHolder()) ?>" value="<?php echo $tr_retc_master->retc_date->EditValue ?>"<?php echo $tr_retc_master->retc_date->EditAttributes() ?>>
<?php if (!$tr_retc_master->retc_date->ReadOnly && !$tr_retc_master->retc_date->Disabled && !isset($tr_retc_master->retc_date->EditAttrs["readonly"]) && !isset($tr_retc_master->retc_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_retc_masteredit_js">
ew_CreateDateTimePicker("ftr_retc_masteredit", "x_retc_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_retc_master->retc_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_retc_date">
		<td class="col-sm-2"><span id="elh_tr_retc_master_retc_date"><script id="tpc_tr_retc_master_retc_date" class="tr_retc_masteredit" type="text/html"><span><?php echo $tr_retc_master->retc_date->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_retc_master->retc_date->CellAttributes() ?>>
<script id="tpx_tr_retc_master_retc_date" class="tr_retc_masteredit" type="text/html">
<span id="el_tr_retc_master_retc_date">
<input type="text" data-table="tr_retc_master" data-field="x_retc_date" name="x_retc_date" id="x_retc_date" size="10" placeholder="<?php echo ew_HtmlEncode($tr_retc_master->retc_date->getPlaceHolder()) ?>" value="<?php echo $tr_retc_master->retc_date->EditValue ?>"<?php echo $tr_retc_master->retc_date->EditAttributes() ?>>
<?php if (!$tr_retc_master->retc_date->ReadOnly && !$tr_retc_master->retc_date->Disabled && !isset($tr_retc_master->retc_date->EditAttrs["readonly"]) && !isset($tr_retc_master->retc_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_retc_masteredit_js">
ew_CreateDateTimePicker("ftr_retc_masteredit", "x_retc_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_retc_master->retc_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_retc_master->sjc_number->Visible) { // sjc_number ?>
<?php if ($tr_retc_master_edit->IsMobileOrModal) { ?>
	<div id="r_sjc_number" class="form-group">
		<label id="elh_tr_retc_master_sjc_number" for="x_sjc_number" class="<?php echo $tr_retc_master_edit->LeftColumnClass ?>"><script id="tpc_tr_retc_master_sjc_number" class="tr_retc_masteredit" type="text/html"><span><?php echo $tr_retc_master->sjc_number->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_retc_master_edit->RightColumnClass ?>"><div<?php echo $tr_retc_master->sjc_number->CellAttributes() ?>>
<script id="tpx_tr_retc_master_sjc_number" class="tr_retc_masteredit" type="text/html">
<span id="el_tr_retc_master_sjc_number">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_retc_master->sjc_number->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_retc_master->sjc_number->ViewValue ?>
	</span>
	<?php if (!$tr_retc_master->sjc_number->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_sjc_number" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_retc_master->sjc_number->RadioButtonListHtml(TRUE, "x_sjc_number") ?>
		</div>
	</div>
	<div id="tp_x_sjc_number" class="ewTemplate"><input type="radio" data-table="tr_retc_master" data-field="x_sjc_number" data-value-separator="<?php echo $tr_retc_master->sjc_number->DisplayValueSeparatorAttribute() ?>" name="x_sjc_number" id="x_sjc_number" value="{value}"<?php echo $tr_retc_master->sjc_number->EditAttributes() ?>></div>
</div>
</span>
</script>
<?php echo $tr_retc_master->sjc_number->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sjc_number">
		<td class="col-sm-2"><span id="elh_tr_retc_master_sjc_number"><script id="tpc_tr_retc_master_sjc_number" class="tr_retc_masteredit" type="text/html"><span><?php echo $tr_retc_master->sjc_number->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_retc_master->sjc_number->CellAttributes() ?>>
<script id="tpx_tr_retc_master_sjc_number" class="tr_retc_masteredit" type="text/html">
<span id="el_tr_retc_master_sjc_number">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_retc_master->sjc_number->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_retc_master->sjc_number->ViewValue ?>
	</span>
	<?php if (!$tr_retc_master->sjc_number->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_sjc_number" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_retc_master->sjc_number->RadioButtonListHtml(TRUE, "x_sjc_number") ?>
		</div>
	</div>
	<div id="tp_x_sjc_number" class="ewTemplate"><input type="radio" data-table="tr_retc_master" data-field="x_sjc_number" data-value-separator="<?php echo $tr_retc_master->sjc_number->DisplayValueSeparatorAttribute() ?>" name="x_sjc_number" id="x_sjc_number" value="{value}"<?php echo $tr_retc_master->sjc_number->EditAttributes() ?>></div>
</div>
</span>
</script>
<?php echo $tr_retc_master->sjc_number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_retc_master->kode_depo->Visible) { // kode_depo ?>
<?php if ($tr_retc_master_edit->IsMobileOrModal) { ?>
	<div id="r_kode_depo" class="form-group">
		<label id="elh_tr_retc_master_kode_depo" for="x_kode_depo" class="<?php echo $tr_retc_master_edit->LeftColumnClass ?>"><script id="tpc_tr_retc_master_kode_depo" class="tr_retc_masteredit" type="text/html"><span><?php echo $tr_retc_master->kode_depo->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_retc_master_edit->RightColumnClass ?>"><div<?php echo $tr_retc_master->kode_depo->CellAttributes() ?>>
<script id="tpx_tr_retc_master_kode_depo" class="tr_retc_masteredit" type="text/html">
<span id="el_tr_retc_master_kode_depo">
<input type="text" data-table="tr_retc_master" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" size="30" maxlength="3" placeholder="<?php echo ew_HtmlEncode($tr_retc_master->kode_depo->getPlaceHolder()) ?>" value="<?php echo $tr_retc_master->kode_depo->EditValue ?>"<?php echo $tr_retc_master->kode_depo->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_retc_master->kode_depo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_kode_depo">
		<td class="col-sm-2"><span id="elh_tr_retc_master_kode_depo"><script id="tpc_tr_retc_master_kode_depo" class="tr_retc_masteredit" type="text/html"><span><?php echo $tr_retc_master->kode_depo->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_retc_master->kode_depo->CellAttributes() ?>>
<script id="tpx_tr_retc_master_kode_depo" class="tr_retc_masteredit" type="text/html">
<span id="el_tr_retc_master_kode_depo">
<input type="text" data-table="tr_retc_master" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" size="30" maxlength="3" placeholder="<?php echo ew_HtmlEncode($tr_retc_master->kode_depo->getPlaceHolder()) ?>" value="<?php echo $tr_retc_master->kode_depo->EditValue ?>"<?php echo $tr_retc_master->kode_depo->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_retc_master->kode_depo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_retc_master->retc_notes->Visible) { // retc_notes ?>
<?php if ($tr_retc_master_edit->IsMobileOrModal) { ?>
	<div id="r_retc_notes" class="form-group">
		<label id="elh_tr_retc_master_retc_notes" for="x_retc_notes" class="<?php echo $tr_retc_master_edit->LeftColumnClass ?>"><script id="tpc_tr_retc_master_retc_notes" class="tr_retc_masteredit" type="text/html"><span><?php echo $tr_retc_master->retc_notes->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_retc_master_edit->RightColumnClass ?>"><div<?php echo $tr_retc_master->retc_notes->CellAttributes() ?>>
<script id="tpx_tr_retc_master_retc_notes" class="tr_retc_masteredit" type="text/html">
<span id="el_tr_retc_master_retc_notes">
<input type="text" data-table="tr_retc_master" data-field="x_retc_notes" name="x_retc_notes" id="x_retc_notes" size="65" maxlength="255" placeholder="<?php echo ew_HtmlEncode($tr_retc_master->retc_notes->getPlaceHolder()) ?>" value="<?php echo $tr_retc_master->retc_notes->EditValue ?>"<?php echo $tr_retc_master->retc_notes->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_retc_master->retc_notes->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_retc_notes">
		<td class="col-sm-2"><span id="elh_tr_retc_master_retc_notes"><script id="tpc_tr_retc_master_retc_notes" class="tr_retc_masteredit" type="text/html"><span><?php echo $tr_retc_master->retc_notes->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_retc_master->retc_notes->CellAttributes() ?>>
<script id="tpx_tr_retc_master_retc_notes" class="tr_retc_masteredit" type="text/html">
<span id="el_tr_retc_master_retc_notes">
<input type="text" data-table="tr_retc_master" data-field="x_retc_notes" name="x_retc_notes" id="x_retc_notes" size="65" maxlength="255" placeholder="<?php echo ew_HtmlEncode($tr_retc_master->retc_notes->getPlaceHolder()) ?>" value="<?php echo $tr_retc_master->retc_notes->EditValue ?>"<?php echo $tr_retc_master->retc_notes->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_retc_master->retc_notes->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_retc_master->sales_id->Visible) { // sales_id ?>
<?php if ($tr_retc_master_edit->IsMobileOrModal) { ?>
	<div id="r_sales_id" class="form-group">
		<label id="elh_tr_retc_master_sales_id" for="x_sales_id" class="<?php echo $tr_retc_master_edit->LeftColumnClass ?>"><script id="tpc_tr_retc_master_sales_id" class="tr_retc_masteredit" type="text/html"><span><?php echo $tr_retc_master->sales_id->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_retc_master_edit->RightColumnClass ?>"><div<?php echo $tr_retc_master->sales_id->CellAttributes() ?>>
<script id="tpx_tr_retc_master_sales_id" class="tr_retc_masteredit" type="text/html">
<span id="el_tr_retc_master_sales_id">
<?php $tr_retc_master->sales_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tr_retc_master->sales_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_retc_master->sales_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_retc_master->sales_id->ViewValue ?>
	</span>
	<?php if (!$tr_retc_master->sales_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_sales_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_retc_master->sales_id->RadioButtonListHtml(TRUE, "x_sales_id") ?>
		</div>
	</div>
	<div id="tp_x_sales_id" class="ewTemplate"><input type="radio" data-table="tr_retc_master" data-field="x_sales_id" data-value-separator="<?php echo $tr_retc_master->sales_id->DisplayValueSeparatorAttribute() ?>" name="x_sales_id" id="x_sales_id" value="{value}"<?php echo $tr_retc_master->sales_id->EditAttributes() ?>></div>
</div>
</span>
</script>
<?php echo $tr_retc_master->sales_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sales_id">
		<td class="col-sm-2"><span id="elh_tr_retc_master_sales_id"><script id="tpc_tr_retc_master_sales_id" class="tr_retc_masteredit" type="text/html"><span><?php echo $tr_retc_master->sales_id->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_retc_master->sales_id->CellAttributes() ?>>
<script id="tpx_tr_retc_master_sales_id" class="tr_retc_masteredit" type="text/html">
<span id="el_tr_retc_master_sales_id">
<?php $tr_retc_master->sales_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tr_retc_master->sales_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_retc_master->sales_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_retc_master->sales_id->ViewValue ?>
	</span>
	<?php if (!$tr_retc_master->sales_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_sales_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_retc_master->sales_id->RadioButtonListHtml(TRUE, "x_sales_id") ?>
		</div>
	</div>
	<div id="tp_x_sales_id" class="ewTemplate"><input type="radio" data-table="tr_retc_master" data-field="x_sales_id" data-value-separator="<?php echo $tr_retc_master->sales_id->DisplayValueSeparatorAttribute() ?>" name="x_sales_id" id="x_sales_id" value="{value}"<?php echo $tr_retc_master->sales_id->EditAttributes() ?>></div>
</div>
</span>
</script>
<?php echo $tr_retc_master->sales_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_retc_master_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<input type="hidden" data-table="tr_retc_master" data-field="x_retc_id" name="x_retc_id" id="x_retc_id" value="<?php echo ew_HtmlEncode($tr_retc_master->retc_id->CurrentValue) ?>">
<?php
	if (in_array("tr_retc_item", explode(",", $tr_retc_master->getCurrentDetailTable())) && $tr_retc_item->DetailEdit) {
?>
<?php if ($tr_retc_master->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("tr_retc_item", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tr_retc_itemgrid.php" ?>
<?php } ?>
<?php if (!$tr_retc_master_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tr_retc_master_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tr_retc_master_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tr_retc_master_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($tr_retc_master->Rows) ?> };
ew_ApplyTemplate("tpd_tr_retc_masteredit", "tpm_tr_retc_masteredit", "tr_retc_masteredit", "<?php echo $tr_retc_master->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.tr_retc_masteredit_js").each(function(){ew_AddScript(this.text);});
</script>
<script type="text/javascript">
ftr_retc_masteredit.Init();
</script>
<?php
$tr_retc_master_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_retc_master_edit->Page_Terminate();
?>
