<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_sjc_masterinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tr_sjc_itemgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_sjc_master_add = NULL; // Initialize page object first

class ctr_sjc_master_add extends ctr_sjc_master {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_sjc_master';

	// Page object name
	var $PageObjName = 'tr_sjc_master_add';

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

		// Table object (tr_sjc_master)
		if (!isset($GLOBALS["tr_sjc_master"]) || get_class($GLOBALS["tr_sjc_master"]) == "ctr_sjc_master") {
			$GLOBALS["tr_sjc_master"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_sjc_master"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_sjc_master', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tr_sjc_masterlist.php"));
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
				if (in_array("tr_sjc_item", $DetailTblVar)) {

					// Process auto fill for detail table 'tr_sjc_item'
					if (preg_match('/^ftr_sjc_item(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["tr_sjc_item_grid"])) $GLOBALS["tr_sjc_item_grid"] = new ctr_sjc_item_grid;
						$GLOBALS["tr_sjc_item_grid"]->Page_Init();
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
		global $EW_EXPORT, $tr_sjc_master;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
			if (is_array(@$_SESSION[EW_SESSION_TEMP_IMAGES])) // Restore temp images
				$gTmpImages = @$_SESSION[EW_SESSION_TEMP_IMAGES];
			if (@$_POST["data"] <> "")
				$sContent = $_POST["data"];
			$gsExportFile = @$_POST["filename"];
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_sjc_master);
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
					if ($pageName == "tr_sjc_masterview.php")
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
			if (@$_GET["sjc_id"] != "") {
				$this->sjc_id->setQueryStringValue($_GET["sjc_id"]);
				$this->setKey("sjc_id", $this->sjc_id->CurrentValue); // Set up key
			} else {
				$this->setKey("sjc_id", ""); // Clear key
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
					$this->Page_Terminate("tr_sjc_masterlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = "tr_sjc_masterlist.php";
					if (ew_GetPageName($sReturnUrl) == "tr_sjc_masterlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "tr_sjc_masterview.php")
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
		$this->sjc_id->CurrentValue = NULL;
		$this->sjc_id->OldValue = $this->sjc_id->CurrentValue;
		$this->sjc_number->CurrentValue = NULL;
		$this->sjc_number->OldValue = $this->sjc_number->CurrentValue;
		$this->sjc_date->CurrentValue = ew_CurrentDate();
		$this->sales_id->CurrentValue = NULL;
		$this->sales_id->OldValue = $this->sales_id->CurrentValue;
		$this->sjc_notes->CurrentValue = NULL;
		$this->sjc_notes->OldValue = $this->sjc_notes->CurrentValue;
		$this->lastupdate->CurrentValue = NULL;
		$this->lastupdate->OldValue = $this->lastupdate->CurrentValue;
		$this->user_id->CurrentValue = NULL;
		$this->user_id->OldValue = $this->user_id->CurrentValue;
		$this->kode_depo->CurrentValue = NULL;
		$this->kode_depo->OldValue = $this->kode_depo->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->sjc_number->FldIsDetailKey) {
			$this->sjc_number->setFormValue($objForm->GetValue("x_sjc_number"));
		}
		if (!$this->sjc_date->FldIsDetailKey) {
			$this->sjc_date->setFormValue($objForm->GetValue("x_sjc_date"));
			$this->sjc_date->CurrentValue = ew_UnFormatDateTime($this->sjc_date->CurrentValue, 0);
		}
		if (!$this->sales_id->FldIsDetailKey) {
			$this->sales_id->setFormValue($objForm->GetValue("x_sales_id"));
		}
		if (!$this->sjc_notes->FldIsDetailKey) {
			$this->sjc_notes->setFormValue($objForm->GetValue("x_sjc_notes"));
		}
		if (!$this->lastupdate->FldIsDetailKey) {
			$this->lastupdate->setFormValue($objForm->GetValue("x_lastupdate"));
			$this->lastupdate->CurrentValue = ew_UnFormatDateTime($this->lastupdate->CurrentValue, 0);
		}
		if (!$this->user_id->FldIsDetailKey) {
			$this->user_id->setFormValue($objForm->GetValue("x_user_id"));
		}
		if (!$this->kode_depo->FldIsDetailKey) {
			$this->kode_depo->setFormValue($objForm->GetValue("x_kode_depo"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->sjc_number->CurrentValue = $this->sjc_number->FormValue;
		$this->sjc_date->CurrentValue = $this->sjc_date->FormValue;
		$this->sjc_date->CurrentValue = ew_UnFormatDateTime($this->sjc_date->CurrentValue, 0);
		$this->sales_id->CurrentValue = $this->sales_id->FormValue;
		$this->sjc_notes->CurrentValue = $this->sjc_notes->FormValue;
		$this->lastupdate->CurrentValue = $this->lastupdate->FormValue;
		$this->lastupdate->CurrentValue = ew_UnFormatDateTime($this->lastupdate->CurrentValue, 0);
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->kode_depo->CurrentValue = $this->kode_depo->FormValue;
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
		$this->sjc_id->setDbValue($row['sjc_id']);
		$this->sjc_number->setDbValue($row['sjc_number']);
		$this->sjc_date->setDbValue($row['sjc_date']);
		$this->sales_id->setDbValue($row['sales_id']);
		$this->sjc_notes->setDbValue($row['sjc_notes']);
		$this->lastupdate->setDbValue($row['lastupdate']);
		$this->user_id->setDbValue($row['user_id']);
		$this->kode_depo->setDbValue($row['kode_depo']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['sjc_id'] = $this->sjc_id->CurrentValue;
		$row['sjc_number'] = $this->sjc_number->CurrentValue;
		$row['sjc_date'] = $this->sjc_date->CurrentValue;
		$row['sales_id'] = $this->sales_id->CurrentValue;
		$row['sjc_notes'] = $this->sjc_notes->CurrentValue;
		$row['lastupdate'] = $this->lastupdate->CurrentValue;
		$row['user_id'] = $this->user_id->CurrentValue;
		$row['kode_depo'] = $this->kode_depo->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->sjc_id->DbValue = $row['sjc_id'];
		$this->sjc_number->DbValue = $row['sjc_number'];
		$this->sjc_date->DbValue = $row['sjc_date'];
		$this->sales_id->DbValue = $row['sales_id'];
		$this->sjc_notes->DbValue = $row['sjc_notes'];
		$this->lastupdate->DbValue = $row['lastupdate'];
		$this->user_id->DbValue = $row['user_id'];
		$this->kode_depo->DbValue = $row['kode_depo'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("sjc_id")) <> "")
			$this->sjc_id->CurrentValue = $this->getKey("sjc_id"); // sjc_id
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
		// sjc_id
		// sjc_number
		// sjc_date
		// sales_id
		// sjc_notes
		// lastupdate
		// user_id
		// kode_depo

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// sjc_id
		$this->sjc_id->ViewValue = $this->sjc_id->CurrentValue;
		$this->sjc_id->ViewCustomAttributes = "";

		// sjc_number
		$this->sjc_number->ViewValue = $this->sjc_number->CurrentValue;
		$this->sjc_number->ViewCustomAttributes = "";

		// sjc_date
		$this->sjc_date->ViewValue = $this->sjc_date->CurrentValue;
		$this->sjc_date->ViewValue = ew_FormatDateTime($this->sjc_date->ViewValue, 0);
		$this->sjc_date->ViewCustomAttributes = "";

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

		// sjc_notes
		$this->sjc_notes->ViewValue = $this->sjc_notes->CurrentValue;
		$this->sjc_notes->ViewCustomAttributes = "";

		// lastupdate
		$this->lastupdate->ViewValue = $this->lastupdate->CurrentValue;
		$this->lastupdate->ViewValue = ew_FormatDateTime($this->lastupdate->ViewValue, 0);
		$this->lastupdate->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

			// sjc_number
			$this->sjc_number->LinkCustomAttributes = "";
			$this->sjc_number->HrefValue = "";
			$this->sjc_number->TooltipValue = "";

			// sjc_date
			$this->sjc_date->LinkCustomAttributes = "";
			$this->sjc_date->HrefValue = "";
			$this->sjc_date->TooltipValue = "";

			// sales_id
			$this->sales_id->LinkCustomAttributes = "";
			$this->sales_id->HrefValue = "";
			$this->sales_id->TooltipValue = "";

			// sjc_notes
			$this->sjc_notes->LinkCustomAttributes = "";
			$this->sjc_notes->HrefValue = "";
			$this->sjc_notes->TooltipValue = "";

			// lastupdate
			$this->lastupdate->LinkCustomAttributes = "";
			$this->lastupdate->HrefValue = "";
			$this->lastupdate->TooltipValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// kode_depo
			$this->kode_depo->LinkCustomAttributes = "";
			$this->kode_depo->HrefValue = "";
			$this->kode_depo->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// sjc_number
			$this->sjc_number->EditAttrs["class"] = "form-control";
			$this->sjc_number->EditCustomAttributes = "";
			$this->sjc_number->EditValue = ew_HtmlEncode($this->sjc_number->CurrentValue);
			$this->sjc_number->PlaceHolder = ew_RemoveHtml($this->sjc_number->FldCaption());

			// sjc_date
			$this->sjc_date->EditAttrs["class"] = "form-control";
			$this->sjc_date->EditCustomAttributes = "";
			$this->sjc_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->sjc_date->CurrentValue, 8));
			$this->sjc_date->PlaceHolder = ew_RemoveHtml($this->sjc_date->FldCaption());

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

			// sjc_notes
			$this->sjc_notes->EditAttrs["class"] = "form-control";
			$this->sjc_notes->EditCustomAttributes = "";
			$this->sjc_notes->EditValue = ew_HtmlEncode($this->sjc_notes->CurrentValue);
			$this->sjc_notes->PlaceHolder = ew_RemoveHtml($this->sjc_notes->FldCaption());

			// lastupdate
			// user_id
			// kode_depo

			$this->kode_depo->EditAttrs["class"] = "form-control";
			$this->kode_depo->EditCustomAttributes = "";
			$this->kode_depo->EditValue = ew_HtmlEncode($this->kode_depo->CurrentValue);
			$this->kode_depo->PlaceHolder = ew_RemoveHtml($this->kode_depo->FldCaption());

			// Add refer script
			// sjc_number

			$this->sjc_number->LinkCustomAttributes = "";
			$this->sjc_number->HrefValue = "";

			// sjc_date
			$this->sjc_date->LinkCustomAttributes = "";
			$this->sjc_date->HrefValue = "";

			// sales_id
			$this->sales_id->LinkCustomAttributes = "";
			$this->sales_id->HrefValue = "";

			// sjc_notes
			$this->sjc_notes->LinkCustomAttributes = "";
			$this->sjc_notes->HrefValue = "";

			// lastupdate
			$this->lastupdate->LinkCustomAttributes = "";
			$this->lastupdate->HrefValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// kode_depo
			$this->kode_depo->LinkCustomAttributes = "";
			$this->kode_depo->HrefValue = "";
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
		if (!ew_CheckDateDef($this->sjc_date->FormValue)) {
			ew_AddMessage($gsFormError, $this->sjc_date->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("tr_sjc_item", $DetailTblVar) && $GLOBALS["tr_sjc_item"]->DetailAdd) {
			if (!isset($GLOBALS["tr_sjc_item_grid"])) $GLOBALS["tr_sjc_item_grid"] = new ctr_sjc_item_grid(); // get detail page object
			$GLOBALS["tr_sjc_item_grid"]->ValidateGridForm();
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

		// sjc_number
		$this->sjc_number->SetDbValueDef($rsnew, $this->sjc_number->CurrentValue, NULL, FALSE);

		// sjc_date
		$this->sjc_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->sjc_date->CurrentValue, 0), NULL, FALSE);

		// sales_id
		$this->sales_id->SetDbValueDef($rsnew, $this->sales_id->CurrentValue, NULL, FALSE);

		// sjc_notes
		$this->sjc_notes->SetDbValueDef($rsnew, $this->sjc_notes->CurrentValue, NULL, FALSE);

		// lastupdate
		$this->lastupdate->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
		$rsnew['lastupdate'] = &$this->lastupdate->DbValue;

		// user_id
		$this->user_id->SetDbValueDef($rsnew, CurrentUserID(), NULL);
		$rsnew['user_id'] = &$this->user_id->DbValue;

		// kode_depo
		$this->kode_depo->SetDbValueDef($rsnew, $this->kode_depo->CurrentValue, NULL, FALSE);

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
			if (in_array("tr_sjc_item", $DetailTblVar) && $GLOBALS["tr_sjc_item"]->DetailAdd) {
				$GLOBALS["tr_sjc_item"]->master_id->setSessionValue($this->sjc_id->CurrentValue); // Set master key
				if (!isset($GLOBALS["tr_sjc_item_grid"])) $GLOBALS["tr_sjc_item_grid"] = new ctr_sjc_item_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "tr_sjc_item"); // Load user level of detail table
				$AddRow = $GLOBALS["tr_sjc_item_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["tr_sjc_item"]->master_id->setSessionValue(""); // Clear master key if insert failed
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
			if (in_array("tr_sjc_item", $DetailTblVar)) {
				if (!isset($GLOBALS["tr_sjc_item_grid"]))
					$GLOBALS["tr_sjc_item_grid"] = new ctr_sjc_item_grid;
				if ($GLOBALS["tr_sjc_item_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["tr_sjc_item_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["tr_sjc_item_grid"]->CurrentMode = "add";
					$GLOBALS["tr_sjc_item_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["tr_sjc_item_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["tr_sjc_item_grid"]->setStartRecordNumber(1);
					$GLOBALS["tr_sjc_item_grid"]->master_id->FldIsDetailKey = TRUE;
					$GLOBALS["tr_sjc_item_grid"]->master_id->CurrentValue = $this->sjc_id->CurrentValue;
					$GLOBALS["tr_sjc_item_grid"]->master_id->setSessionValue($GLOBALS["tr_sjc_item_grid"]->master_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_sjc_masterlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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
if (!isset($tr_sjc_master_add)) $tr_sjc_master_add = new ctr_sjc_master_add();

// Page init
$tr_sjc_master_add->Page_Init();

// Page main
$tr_sjc_master_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_sjc_master_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ftr_sjc_masteradd = new ew_Form("ftr_sjc_masteradd", "add");

// Validate form
ftr_sjc_masteradd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_sjc_date");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_sjc_master->sjc_date->FldErrMsg()) ?>");

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
ftr_sjc_masteradd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_sjc_masteradd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_sjc_masteradd.Lists["x_sales_id"] = {"LinkField":"x_sales_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_sales_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_salesman"};
ftr_sjc_masteradd.Lists["x_sales_id"].Data = "<?php echo $tr_sjc_master_add->sales_id->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tr_sjc_master_add->ShowPageHeader(); ?>
<?php
$tr_sjc_master_add->ShowMessage();
?>
<form name="ftr_sjc_masteradd" id="ftr_sjc_masteradd" class="<?php echo $tr_sjc_master_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_sjc_master_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_sjc_master_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_sjc_master">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($tr_sjc_master_add->IsModal) ?>">
<div id="tpd_tr_sjc_masteradd" class="ewCustomTemplate"></div>
<script id="tpm_tr_sjc_masteradd" type="text/html">
<div id="ct_tr_sjc_master_add"><div class="col-sm-12 panel-custom" style="">
	<div class="col-sm-5">
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_sjc_master->sjc_number->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_sjc_master_sjc_number"/}}</div>
		</div>
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_sjc_master->sales_id->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_sjc_master_sales_id"/}}</div>
		</div>
	</div>
	<div class="col-sm-7">
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_sjc_master->sjc_date->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_sjc_master_sjc_date"/}}</div>
		</div>
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_sjc_master->sjc_notes->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_sjc_master_sjc_notes"/}}</div>
		</div>
	</div>
</div>
</div>
</script>
<?php if (!$tr_sjc_master_add->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tr_sjc_master_add->IsMobileOrModal) { ?>
<div class="ewAddDiv hidden"><!-- page* -->
<?php } else { ?>
<table id="tbl_tr_sjc_masteradd" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable hidden"><!-- table* -->
<?php } ?>
<?php if ($tr_sjc_master->sjc_number->Visible) { // sjc_number ?>
<?php if ($tr_sjc_master_add->IsMobileOrModal) { ?>
	<div id="r_sjc_number" class="form-group">
		<label id="elh_tr_sjc_master_sjc_number" for="x_sjc_number" class="<?php echo $tr_sjc_master_add->LeftColumnClass ?>"><script id="tpc_tr_sjc_master_sjc_number" class="tr_sjc_masteradd" type="text/html"><span><?php echo $tr_sjc_master->sjc_number->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_sjc_master_add->RightColumnClass ?>"><div<?php echo $tr_sjc_master->sjc_number->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_sjc_number" class="tr_sjc_masteradd" type="text/html">
<span id="el_tr_sjc_master_sjc_number">
<input type="text" data-table="tr_sjc_master" data-field="x_sjc_number" name="x_sjc_number" id="x_sjc_number" size="15" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tr_sjc_master->sjc_number->getPlaceHolder()) ?>" value="<?php echo $tr_sjc_master->sjc_number->EditValue ?>"<?php echo $tr_sjc_master->sjc_number->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_sjc_master->sjc_number->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sjc_number">
		<td class="col-sm-2"><span id="elh_tr_sjc_master_sjc_number"><script id="tpc_tr_sjc_master_sjc_number" class="tr_sjc_masteradd" type="text/html"><span><?php echo $tr_sjc_master->sjc_number->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_sjc_master->sjc_number->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_sjc_number" class="tr_sjc_masteradd" type="text/html">
<span id="el_tr_sjc_master_sjc_number">
<input type="text" data-table="tr_sjc_master" data-field="x_sjc_number" name="x_sjc_number" id="x_sjc_number" size="15" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tr_sjc_master->sjc_number->getPlaceHolder()) ?>" value="<?php echo $tr_sjc_master->sjc_number->EditValue ?>"<?php echo $tr_sjc_master->sjc_number->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_sjc_master->sjc_number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjc_master->sjc_date->Visible) { // sjc_date ?>
<?php if ($tr_sjc_master_add->IsMobileOrModal) { ?>
	<div id="r_sjc_date" class="form-group">
		<label id="elh_tr_sjc_master_sjc_date" for="x_sjc_date" class="<?php echo $tr_sjc_master_add->LeftColumnClass ?>"><script id="tpc_tr_sjc_master_sjc_date" class="tr_sjc_masteradd" type="text/html"><span><?php echo $tr_sjc_master->sjc_date->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_sjc_master_add->RightColumnClass ?>"><div<?php echo $tr_sjc_master->sjc_date->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_sjc_date" class="tr_sjc_masteradd" type="text/html">
<span id="el_tr_sjc_master_sjc_date">
<input type="text" data-table="tr_sjc_master" data-field="x_sjc_date" name="x_sjc_date" id="x_sjc_date" size="10" placeholder="<?php echo ew_HtmlEncode($tr_sjc_master->sjc_date->getPlaceHolder()) ?>" value="<?php echo $tr_sjc_master->sjc_date->EditValue ?>"<?php echo $tr_sjc_master->sjc_date->EditAttributes() ?>>
<?php if (!$tr_sjc_master->sjc_date->ReadOnly && !$tr_sjc_master->sjc_date->Disabled && !isset($tr_sjc_master->sjc_date->EditAttrs["readonly"]) && !isset($tr_sjc_master->sjc_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_sjc_masteradd_js">
ew_CreateDateTimePicker("ftr_sjc_masteradd", "x_sjc_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_sjc_master->sjc_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sjc_date">
		<td class="col-sm-2"><span id="elh_tr_sjc_master_sjc_date"><script id="tpc_tr_sjc_master_sjc_date" class="tr_sjc_masteradd" type="text/html"><span><?php echo $tr_sjc_master->sjc_date->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_sjc_master->sjc_date->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_sjc_date" class="tr_sjc_masteradd" type="text/html">
<span id="el_tr_sjc_master_sjc_date">
<input type="text" data-table="tr_sjc_master" data-field="x_sjc_date" name="x_sjc_date" id="x_sjc_date" size="10" placeholder="<?php echo ew_HtmlEncode($tr_sjc_master->sjc_date->getPlaceHolder()) ?>" value="<?php echo $tr_sjc_master->sjc_date->EditValue ?>"<?php echo $tr_sjc_master->sjc_date->EditAttributes() ?>>
<?php if (!$tr_sjc_master->sjc_date->ReadOnly && !$tr_sjc_master->sjc_date->Disabled && !isset($tr_sjc_master->sjc_date->EditAttrs["readonly"]) && !isset($tr_sjc_master->sjc_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_sjc_masteradd_js">
ew_CreateDateTimePicker("ftr_sjc_masteradd", "x_sjc_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_sjc_master->sjc_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjc_master->sales_id->Visible) { // sales_id ?>
<?php if ($tr_sjc_master_add->IsMobileOrModal) { ?>
	<div id="r_sales_id" class="form-group">
		<label id="elh_tr_sjc_master_sales_id" for="x_sales_id" class="<?php echo $tr_sjc_master_add->LeftColumnClass ?>"><script id="tpc_tr_sjc_master_sales_id" class="tr_sjc_masteradd" type="text/html"><span><?php echo $tr_sjc_master->sales_id->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_sjc_master_add->RightColumnClass ?>"><div<?php echo $tr_sjc_master->sales_id->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_sales_id" class="tr_sjc_masteradd" type="text/html">
<span id="el_tr_sjc_master_sales_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_sjc_master->sales_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_sjc_master->sales_id->ViewValue ?>
	</span>
	<?php if (!$tr_sjc_master->sales_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_sales_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_sjc_master->sales_id->RadioButtonListHtml(TRUE, "x_sales_id") ?>
		</div>
	</div>
	<div id="tp_x_sales_id" class="ewTemplate"><input type="radio" data-table="tr_sjc_master" data-field="x_sales_id" data-value-separator="<?php echo $tr_sjc_master->sales_id->DisplayValueSeparatorAttribute() ?>" name="x_sales_id" id="x_sales_id" value="{value}"<?php echo $tr_sjc_master->sales_id->EditAttributes() ?>></div>
</div>
</span>
</script>
<?php echo $tr_sjc_master->sales_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sales_id">
		<td class="col-sm-2"><span id="elh_tr_sjc_master_sales_id"><script id="tpc_tr_sjc_master_sales_id" class="tr_sjc_masteradd" type="text/html"><span><?php echo $tr_sjc_master->sales_id->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_sjc_master->sales_id->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_sales_id" class="tr_sjc_masteradd" type="text/html">
<span id="el_tr_sjc_master_sales_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_sjc_master->sales_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_sjc_master->sales_id->ViewValue ?>
	</span>
	<?php if (!$tr_sjc_master->sales_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_sales_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_sjc_master->sales_id->RadioButtonListHtml(TRUE, "x_sales_id") ?>
		</div>
	</div>
	<div id="tp_x_sales_id" class="ewTemplate"><input type="radio" data-table="tr_sjc_master" data-field="x_sales_id" data-value-separator="<?php echo $tr_sjc_master->sales_id->DisplayValueSeparatorAttribute() ?>" name="x_sales_id" id="x_sales_id" value="{value}"<?php echo $tr_sjc_master->sales_id->EditAttributes() ?>></div>
</div>
</span>
</script>
<?php echo $tr_sjc_master->sales_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjc_master->sjc_notes->Visible) { // sjc_notes ?>
<?php if ($tr_sjc_master_add->IsMobileOrModal) { ?>
	<div id="r_sjc_notes" class="form-group">
		<label id="elh_tr_sjc_master_sjc_notes" for="x_sjc_notes" class="<?php echo $tr_sjc_master_add->LeftColumnClass ?>"><script id="tpc_tr_sjc_master_sjc_notes" class="tr_sjc_masteradd" type="text/html"><span><?php echo $tr_sjc_master->sjc_notes->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_sjc_master_add->RightColumnClass ?>"><div<?php echo $tr_sjc_master->sjc_notes->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_sjc_notes" class="tr_sjc_masteradd" type="text/html">
<span id="el_tr_sjc_master_sjc_notes">
<input type="text" data-table="tr_sjc_master" data-field="x_sjc_notes" name="x_sjc_notes" id="x_sjc_notes" size="65" maxlength="255" placeholder="<?php echo ew_HtmlEncode($tr_sjc_master->sjc_notes->getPlaceHolder()) ?>" value="<?php echo $tr_sjc_master->sjc_notes->EditValue ?>"<?php echo $tr_sjc_master->sjc_notes->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_sjc_master->sjc_notes->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sjc_notes">
		<td class="col-sm-2"><span id="elh_tr_sjc_master_sjc_notes"><script id="tpc_tr_sjc_master_sjc_notes" class="tr_sjc_masteradd" type="text/html"><span><?php echo $tr_sjc_master->sjc_notes->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_sjc_master->sjc_notes->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_sjc_notes" class="tr_sjc_masteradd" type="text/html">
<span id="el_tr_sjc_master_sjc_notes">
<input type="text" data-table="tr_sjc_master" data-field="x_sjc_notes" name="x_sjc_notes" id="x_sjc_notes" size="65" maxlength="255" placeholder="<?php echo ew_HtmlEncode($tr_sjc_master->sjc_notes->getPlaceHolder()) ?>" value="<?php echo $tr_sjc_master->sjc_notes->EditValue ?>"<?php echo $tr_sjc_master->sjc_notes->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_sjc_master->sjc_notes->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjc_master->kode_depo->Visible) { // kode_depo ?>
<?php if ($tr_sjc_master_add->IsMobileOrModal) { ?>
	<div id="r_kode_depo" class="form-group">
		<label id="elh_tr_sjc_master_kode_depo" for="x_kode_depo" class="<?php echo $tr_sjc_master_add->LeftColumnClass ?>"><script id="tpc_tr_sjc_master_kode_depo" class="tr_sjc_masteradd" type="text/html"><span><?php echo $tr_sjc_master->kode_depo->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_sjc_master_add->RightColumnClass ?>"><div<?php echo $tr_sjc_master->kode_depo->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_kode_depo" class="tr_sjc_masteradd" type="text/html">
<span id="el_tr_sjc_master_kode_depo">
<input type="text" data-table="tr_sjc_master" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" size="30" maxlength="3" placeholder="<?php echo ew_HtmlEncode($tr_sjc_master->kode_depo->getPlaceHolder()) ?>" value="<?php echo $tr_sjc_master->kode_depo->EditValue ?>"<?php echo $tr_sjc_master->kode_depo->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_sjc_master->kode_depo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_kode_depo">
		<td class="col-sm-2"><span id="elh_tr_sjc_master_kode_depo"><script id="tpc_tr_sjc_master_kode_depo" class="tr_sjc_masteradd" type="text/html"><span><?php echo $tr_sjc_master->kode_depo->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_sjc_master->kode_depo->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_kode_depo" class="tr_sjc_masteradd" type="text/html">
<span id="el_tr_sjc_master_kode_depo">
<input type="text" data-table="tr_sjc_master" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" size="30" maxlength="3" placeholder="<?php echo ew_HtmlEncode($tr_sjc_master->kode_depo->getPlaceHolder()) ?>" value="<?php echo $tr_sjc_master->kode_depo->EditValue ?>"<?php echo $tr_sjc_master->kode_depo->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_sjc_master->kode_depo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjc_master_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php
	if (in_array("tr_sjc_item", explode(",", $tr_sjc_master->getCurrentDetailTable())) && $tr_sjc_item->DetailAdd) {
?>
<?php if ($tr_sjc_master->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("tr_sjc_item", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tr_sjc_itemgrid.php" ?>
<?php } ?>
<?php if (!$tr_sjc_master_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tr_sjc_master_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tr_sjc_master_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tr_sjc_master_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($tr_sjc_master->Rows) ?> };
ew_ApplyTemplate("tpd_tr_sjc_masteradd", "tpm_tr_sjc_masteradd", "tr_sjc_masteradd", "<?php echo $tr_sjc_master->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.tr_sjc_masteradd_js").each(function(){ew_AddScript(this.text);});
</script>
<script type="text/javascript">
ftr_sjc_masteradd.Init();
</script>
<?php
$tr_sjc_master_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_sjc_master_add->Page_Terminate();
?>
