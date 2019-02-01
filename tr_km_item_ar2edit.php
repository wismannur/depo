<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_km_item_ar2info.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tr_km_master_ar2info.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_km_item_ar2_edit = NULL; // Initialize page object first

class ctr_km_item_ar2_edit extends ctr_km_item_ar2 {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_km_item_ar2';

	// Page object name
	var $PageObjName = 'tr_km_item_ar2_edit';

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

		// Table object (tr_km_item_ar2)
		if (!isset($GLOBALS["tr_km_item_ar2"]) || get_class($GLOBALS["tr_km_item_ar2"]) == "ctr_km_item_ar2") {
			$GLOBALS["tr_km_item_ar2"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_km_item_ar2"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Table object (tr_km_master_ar2)
		if (!isset($GLOBALS['tr_km_master_ar2'])) $GLOBALS['tr_km_master_ar2'] = new ctr_km_master_ar2();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_km_item_ar2', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tr_km_item_ar2list.php"));
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
		$this->row_id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->row_id->Visible = FALSE;
		$this->master_id->SetVisibility();
		$this->customer_id->SetVisibility();
		$this->inv_number->SetVisibility();
		$this->inv_date->SetVisibility();
		$this->inv_amt->SetVisibility();
		$this->paid_amt->SetVisibility();
		$this->acc_no->SetVisibility();

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
		global $EW_EXPORT, $tr_km_item_ar2;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_km_item_ar2);
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
					if ($pageName == "tr_km_item_ar2view.php")
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
			if ($objForm->HasValue("x_row_id")) {
				$this->row_id->setFormValue($objForm->GetValue("x_row_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["row_id"])) {
				$this->row_id->setQueryStringValue($_GET["row_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->row_id->CurrentValue = NULL;
			}
		}

		// Set up master detail parameters
		$this->SetupMasterParms();

		// Load current record
		$loaded = $this->LoadRow();

		// Process form if post back
		if ($postBack) {
			$this->LoadFormValues(); // Get form values
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
					$this->Page_Terminate("tr_km_item_ar2list.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = "tr_km_item_ar2list.php";
				if (ew_GetPageName($sReturnUrl) == "tr_km_item_ar2list.php")
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
		if (!$this->row_id->FldIsDetailKey)
			$this->row_id->setFormValue($objForm->GetValue("x_row_id"));
		if (!$this->master_id->FldIsDetailKey) {
			$this->master_id->setFormValue($objForm->GetValue("x_master_id"));
		}
		if (!$this->customer_id->FldIsDetailKey) {
			$this->customer_id->setFormValue($objForm->GetValue("x_customer_id"));
		}
		if (!$this->inv_number->FldIsDetailKey) {
			$this->inv_number->setFormValue($objForm->GetValue("x_inv_number"));
		}
		if (!$this->inv_date->FldIsDetailKey) {
			$this->inv_date->setFormValue($objForm->GetValue("x_inv_date"));
			$this->inv_date->CurrentValue = ew_UnFormatDateTime($this->inv_date->CurrentValue, 0);
		}
		if (!$this->inv_amt->FldIsDetailKey) {
			$this->inv_amt->setFormValue($objForm->GetValue("x_inv_amt"));
		}
		if (!$this->paid_amt->FldIsDetailKey) {
			$this->paid_amt->setFormValue($objForm->GetValue("x_paid_amt"));
		}
		if (!$this->acc_no->FldIsDetailKey) {
			$this->acc_no->setFormValue($objForm->GetValue("x_acc_no"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->row_id->CurrentValue = $this->row_id->FormValue;
		$this->master_id->CurrentValue = $this->master_id->FormValue;
		$this->customer_id->CurrentValue = $this->customer_id->FormValue;
		$this->inv_number->CurrentValue = $this->inv_number->FormValue;
		$this->inv_date->CurrentValue = $this->inv_date->FormValue;
		$this->inv_date->CurrentValue = ew_UnFormatDateTime($this->inv_date->CurrentValue, 0);
		$this->inv_amt->CurrentValue = $this->inv_amt->FormValue;
		$this->paid_amt->CurrentValue = $this->paid_amt->FormValue;
		$this->acc_no->CurrentValue = $this->acc_no->FormValue;
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
		$this->customer_id->setDbValue($row['customer_id']);
		$this->inv_number->setDbValue($row['inv_number']);
		$this->inv_date->setDbValue($row['inv_date']);
		$this->inv_amt->setDbValue($row['inv_amt']);
		$this->paid_amt->setDbValue($row['paid_amt']);
		$this->acc_no->setDbValue($row['acc_no']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['row_id'] = NULL;
		$row['master_id'] = NULL;
		$row['customer_id'] = NULL;
		$row['inv_number'] = NULL;
		$row['inv_date'] = NULL;
		$row['inv_amt'] = NULL;
		$row['paid_amt'] = NULL;
		$row['acc_no'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->row_id->DbValue = $row['row_id'];
		$this->master_id->DbValue = $row['master_id'];
		$this->customer_id->DbValue = $row['customer_id'];
		$this->inv_number->DbValue = $row['inv_number'];
		$this->inv_date->DbValue = $row['inv_date'];
		$this->inv_amt->DbValue = $row['inv_amt'];
		$this->paid_amt->DbValue = $row['paid_amt'];
		$this->acc_no->DbValue = $row['acc_no'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("row_id")) <> "")
			$this->row_id->CurrentValue = $this->getKey("row_id"); // row_id
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
		// Convert decimal values if posted back

		if ($this->inv_amt->FormValue == $this->inv_amt->CurrentValue && is_numeric(ew_StrToFloat($this->inv_amt->CurrentValue)))
			$this->inv_amt->CurrentValue = ew_StrToFloat($this->inv_amt->CurrentValue);

		// Convert decimal values if posted back
		if ($this->paid_amt->FormValue == $this->paid_amt->CurrentValue && is_numeric(ew_StrToFloat($this->paid_amt->CurrentValue)))
			$this->paid_amt->CurrentValue = ew_StrToFloat($this->paid_amt->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// row_id
		// master_id
		// customer_id
		// inv_number
		// inv_date
		// inv_amt
		// paid_amt
		// acc_no

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// row_id
		$this->row_id->ViewValue = $this->row_id->CurrentValue;
		$this->row_id->ViewCustomAttributes = "";

		// master_id
		$this->master_id->ViewValue = $this->master_id->CurrentValue;
		$this->master_id->ViewCustomAttributes = "";

		// customer_id
		if (strval($this->customer_id->CurrentValue) <> "") {
			$sFilterWrk = "`customer_id`" . ew_SearchString("=", $this->customer_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `customer_id`, `customer_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_customer`";
		$sWhereWrk = "";
		$this->customer_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->customer_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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

		// inv_number
		if (strval($this->inv_number->CurrentValue) <> "") {
			$sFilterWrk = "`inv_number`" . ew_SearchString("=", $this->inv_number->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `inv_number`, `inv_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_inv_canvas_master`";
		$sWhereWrk = "";
		$this->inv_number->LookupFilters = array();
		$lookuptblfilter = (isset($_GET["customer_id"]))? "`customer_id` = '".@$_GET["customer_id"]."' AND `kode_depo` = '".@$_SESSION["KodeDepo"]."'" : "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->inv_number, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `inv_number` DESC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->inv_number->ViewValue = $this->inv_number->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->inv_number->ViewValue = $this->inv_number->CurrentValue;
			}
		} else {
			$this->inv_number->ViewValue = NULL;
		}
		$this->inv_number->ViewCustomAttributes = "";

		// inv_date
		$this->inv_date->ViewValue = $this->inv_date->CurrentValue;
		$this->inv_date->ViewValue = ew_FormatDateTime($this->inv_date->ViewValue, 0);
		$this->inv_date->ViewCustomAttributes = "";

		// inv_amt
		$this->inv_amt->ViewValue = $this->inv_amt->CurrentValue;
		$this->inv_amt->ViewValue = ew_FormatNumber($this->inv_amt->ViewValue, 0, -2, -2, -2);
		$this->inv_amt->CellCssStyle .= "text-align: right;";
		$this->inv_amt->ViewCustomAttributes = "";

		// paid_amt
		$this->paid_amt->ViewValue = $this->paid_amt->CurrentValue;
		$this->paid_amt->ViewValue = ew_FormatNumber($this->paid_amt->ViewValue, 0, -2, -2, -2);
		$this->paid_amt->CellCssStyle .= "text-align: right;";
		$this->paid_amt->ViewCustomAttributes = "";

		// acc_no
		$this->acc_no->ViewValue = $this->acc_no->CurrentValue;
		$this->acc_no->ViewCustomAttributes = "";

			// row_id
			$this->row_id->LinkCustomAttributes = "";
			$this->row_id->HrefValue = "";
			$this->row_id->TooltipValue = "";

			// master_id
			$this->master_id->LinkCustomAttributes = "";
			$this->master_id->HrefValue = "";
			$this->master_id->TooltipValue = "";

			// customer_id
			$this->customer_id->LinkCustomAttributes = "";
			$this->customer_id->HrefValue = "";
			$this->customer_id->TooltipValue = "";

			// inv_number
			$this->inv_number->LinkCustomAttributes = "";
			$this->inv_number->HrefValue = "";
			$this->inv_number->TooltipValue = "";

			// inv_date
			$this->inv_date->LinkCustomAttributes = "";
			$this->inv_date->HrefValue = "";
			$this->inv_date->TooltipValue = "";

			// inv_amt
			$this->inv_amt->LinkCustomAttributes = "";
			$this->inv_amt->HrefValue = "";
			$this->inv_amt->TooltipValue = "";

			// paid_amt
			$this->paid_amt->LinkCustomAttributes = "";
			$this->paid_amt->HrefValue = "";
			$this->paid_amt->TooltipValue = "";

			// acc_no
			$this->acc_no->LinkCustomAttributes = "";
			$this->acc_no->HrefValue = "";
			$this->acc_no->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// row_id
			$this->row_id->EditAttrs["class"] = "form-control";
			$this->row_id->EditCustomAttributes = "";
			$this->row_id->EditValue = $this->row_id->CurrentValue;
			$this->row_id->ViewCustomAttributes = "";

			// master_id
			$this->master_id->EditAttrs["class"] = "form-control";
			$this->master_id->EditCustomAttributes = "";
			if ($this->master_id->getSessionValue() <> "") {
				$this->master_id->CurrentValue = $this->master_id->getSessionValue();
			$this->master_id->ViewValue = $this->master_id->CurrentValue;
			$this->master_id->ViewCustomAttributes = "";
			} else {
			$this->master_id->EditValue = ew_HtmlEncode($this->master_id->CurrentValue);
			$this->master_id->PlaceHolder = ew_RemoveHtml($this->master_id->FldCaption());
			}

			// customer_id
			$this->customer_id->EditCustomAttributes = "";
			if (trim(strval($this->customer_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`customer_id`" . ew_SearchString("=", $this->customer_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `customer_id`, `customer_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `customer_id` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tbl_customer`";
			$sWhereWrk = "";
			$this->customer_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->customer_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->customer_id->ViewValue = $this->customer_id->DisplayValue($arwrk);
			} else {
				$this->customer_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->customer_id->EditValue = $arwrk;

			// inv_number
			$this->inv_number->EditCustomAttributes = "";
			if (trim(strval($this->inv_number->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`inv_number`" . ew_SearchString("=", $this->inv_number->CurrentValue, EW_DATATYPE_STRING, "");
			}
			$sSqlWrk = "SELECT `inv_number`, `inv_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `customer_id` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tr_inv_canvas_master`";
			$sWhereWrk = "";
			$this->inv_number->LookupFilters = array();
			$lookuptblfilter = (isset($_GET["customer_id"]))? "`customer_id` = '".@$_GET["customer_id"]."' AND `kode_depo` = '".@$_SESSION["KodeDepo"]."'" : "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->inv_number, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `inv_number` DESC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->inv_number->ViewValue = $this->inv_number->DisplayValue($arwrk);
			} else {
				$this->inv_number->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->inv_number->EditValue = $arwrk;

			// inv_date
			$this->inv_date->EditAttrs["class"] = "form-control";
			$this->inv_date->EditCustomAttributes = "";
			$this->inv_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->inv_date->CurrentValue, 8));
			$this->inv_date->PlaceHolder = ew_RemoveHtml($this->inv_date->FldCaption());

			// inv_amt
			$this->inv_amt->EditAttrs["class"] = "form-control";
			$this->inv_amt->EditCustomAttributes = "";
			$this->inv_amt->EditValue = ew_HtmlEncode($this->inv_amt->CurrentValue);
			$this->inv_amt->PlaceHolder = ew_RemoveHtml($this->inv_amt->FldCaption());
			if (strval($this->inv_amt->EditValue) <> "" && is_numeric($this->inv_amt->EditValue)) $this->inv_amt->EditValue = ew_FormatNumber($this->inv_amt->EditValue, -2, -2, -2, -2);

			// paid_amt
			$this->paid_amt->EditAttrs["class"] = "form-control";
			$this->paid_amt->EditCustomAttributes = "";
			$this->paid_amt->EditValue = ew_HtmlEncode($this->paid_amt->CurrentValue);
			$this->paid_amt->PlaceHolder = ew_RemoveHtml($this->paid_amt->FldCaption());
			if (strval($this->paid_amt->EditValue) <> "" && is_numeric($this->paid_amt->EditValue)) $this->paid_amt->EditValue = ew_FormatNumber($this->paid_amt->EditValue, -2, -2, -2, -2);

			// acc_no
			$this->acc_no->EditAttrs["class"] = "form-control";
			$this->acc_no->EditCustomAttributes = "";
			$this->acc_no->EditValue = ew_HtmlEncode($this->acc_no->CurrentValue);
			$this->acc_no->PlaceHolder = ew_RemoveHtml($this->acc_no->FldCaption());

			// Edit refer script
			// row_id

			$this->row_id->LinkCustomAttributes = "";
			$this->row_id->HrefValue = "";

			// master_id
			$this->master_id->LinkCustomAttributes = "";
			$this->master_id->HrefValue = "";

			// customer_id
			$this->customer_id->LinkCustomAttributes = "";
			$this->customer_id->HrefValue = "";

			// inv_number
			$this->inv_number->LinkCustomAttributes = "";
			$this->inv_number->HrefValue = "";

			// inv_date
			$this->inv_date->LinkCustomAttributes = "";
			$this->inv_date->HrefValue = "";

			// inv_amt
			$this->inv_amt->LinkCustomAttributes = "";
			$this->inv_amt->HrefValue = "";

			// paid_amt
			$this->paid_amt->LinkCustomAttributes = "";
			$this->paid_amt->HrefValue = "";

			// acc_no
			$this->acc_no->LinkCustomAttributes = "";
			$this->acc_no->HrefValue = "";
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
		if (!ew_CheckInteger($this->master_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->master_id->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->inv_date->FormValue)) {
			ew_AddMessage($gsFormError, $this->inv_date->FldErrMsg());
		}
		if (!ew_CheckNumber($this->inv_amt->FormValue)) {
			ew_AddMessage($gsFormError, $this->inv_amt->FldErrMsg());
		}
		if (!ew_CheckNumber($this->paid_amt->FormValue)) {
			ew_AddMessage($gsFormError, $this->paid_amt->FldErrMsg());
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

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// master_id
			$this->master_id->SetDbValueDef($rsnew, $this->master_id->CurrentValue, NULL, $this->master_id->ReadOnly);

			// customer_id
			$this->customer_id->SetDbValueDef($rsnew, $this->customer_id->CurrentValue, NULL, $this->customer_id->ReadOnly);

			// inv_number
			$this->inv_number->SetDbValueDef($rsnew, $this->inv_number->CurrentValue, NULL, $this->inv_number->ReadOnly);

			// inv_date
			$this->inv_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->inv_date->CurrentValue, 0), NULL, $this->inv_date->ReadOnly);

			// inv_amt
			$this->inv_amt->SetDbValueDef($rsnew, $this->inv_amt->CurrentValue, NULL, $this->inv_amt->ReadOnly);

			// paid_amt
			$this->paid_amt->SetDbValueDef($rsnew, $this->paid_amt->CurrentValue, NULL, $this->paid_amt->ReadOnly);

			// acc_no
			$this->acc_no->SetDbValueDef($rsnew, $this->acc_no->CurrentValue, NULL, $this->acc_no->ReadOnly);

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
			if ($sMasterTblVar == "tr_km_master_ar2") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_row_id"] <> "") {
					$GLOBALS["tr_km_master_ar2"]->row_id->setQueryStringValue($_GET["fk_row_id"]);
					$this->master_id->setQueryStringValue($GLOBALS["tr_km_master_ar2"]->row_id->QueryStringValue);
					$this->master_id->setSessionValue($this->master_id->QueryStringValue);
					if (!is_numeric($GLOBALS["tr_km_master_ar2"]->row_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "tr_km_master_ar2") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_row_id"] <> "") {
					$GLOBALS["tr_km_master_ar2"]->row_id->setFormValue($_POST["fk_row_id"]);
					$this->master_id->setFormValue($GLOBALS["tr_km_master_ar2"]->row_id->FormValue);
					$this->master_id->setSessionValue($this->master_id->FormValue);
					if (!is_numeric($GLOBALS["tr_km_master_ar2"]->row_id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);
			$this->setSessionWhere($this->GetDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "tr_km_master_ar2") {
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_km_item_ar2list.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_customer_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `customer_id` AS `LinkFld`, `customer_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_customer`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`customer_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->customer_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_inv_number":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `inv_number` AS `LinkFld`, `inv_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_inv_canvas_master`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$lookuptblfilter = (isset($_GET["customer_id"]))? "`customer_id` = '".@$_GET["customer_id"]."' AND `kode_depo` = '".@$_SESSION["KodeDepo"]."'" : "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`inv_number` IN ({filter_value})', "t0" => "200", "fn0" => "", "f1" => '`customer_id` IN ({filter_value})', "t1" => "3", "fn1" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->inv_number, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `inv_number` DESC";
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
if (!isset($tr_km_item_ar2_edit)) $tr_km_item_ar2_edit = new ctr_km_item_ar2_edit();

// Page init
$tr_km_item_ar2_edit->Page_Init();

// Page main
$tr_km_item_ar2_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_km_item_ar2_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ftr_km_item_ar2edit = new ew_Form("ftr_km_item_ar2edit", "edit");

// Validate form
ftr_km_item_ar2edit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_master_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_item_ar2->master_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_inv_date");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_item_ar2->inv_date->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_inv_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_item_ar2->inv_amt->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_paid_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_item_ar2->paid_amt->FldErrMsg()) ?>");

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
ftr_km_item_ar2edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_km_item_ar2edit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_km_item_ar2edit.Lists["x_customer_id"] = {"LinkField":"x_customer_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_customer_name","","",""],"ParentFields":[],"ChildFields":["x_inv_number"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_customer"};
ftr_km_item_ar2edit.Lists["x_customer_id"].Data = "<?php echo $tr_km_item_ar2_edit->customer_id->LookupFilterQuery(FALSE, "edit") ?>";
ftr_km_item_ar2edit.Lists["x_inv_number"] = {"LinkField":"x_inv_number","Ajax":true,"AutoFill":true,"DisplayFields":["x_inv_number","","",""],"ParentFields":["x_customer_id"],"ChildFields":[],"FilterFields":["x_customer_id"],"Options":[],"Template":"","LinkTable":"tr_inv_canvas_master"};
ftr_km_item_ar2edit.Lists["x_inv_number"].Data = "<?php echo $tr_km_item_ar2_edit->inv_number->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tr_km_item_ar2_edit->ShowPageHeader(); ?>
<?php
$tr_km_item_ar2_edit->ShowMessage();
?>
<form name="ftr_km_item_ar2edit" id="ftr_km_item_ar2edit" class="<?php echo $tr_km_item_ar2_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_km_item_ar2_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_km_item_ar2_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_km_item_ar2">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($tr_km_item_ar2_edit->IsModal) ?>">
<?php if ($tr_km_item_ar2->getCurrentMasterTable() == "tr_km_master_ar2") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="tr_km_master_ar2">
<input type="hidden" name="fk_row_id" value="<?php echo $tr_km_item_ar2->master_id->getSessionValue() ?>">
<?php } ?>
<?php if (!$tr_km_item_ar2_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tr_km_item_ar2_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_tr_km_item_ar2edit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($tr_km_item_ar2->row_id->Visible) { // row_id ?>
<?php if ($tr_km_item_ar2_edit->IsMobileOrModal) { ?>
	<div id="r_row_id" class="form-group">
		<label id="elh_tr_km_item_ar2_row_id" class="<?php echo $tr_km_item_ar2_edit->LeftColumnClass ?>"><?php echo $tr_km_item_ar2->row_id->FldCaption() ?></label>
		<div class="<?php echo $tr_km_item_ar2_edit->RightColumnClass ?>"><div<?php echo $tr_km_item_ar2->row_id->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_row_id">
<span<?php echo $tr_km_item_ar2->row_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_km_item_ar2->row_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="tr_km_item_ar2" data-field="x_row_id" name="x_row_id" id="x_row_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar2->row_id->CurrentValue) ?>">
<?php echo $tr_km_item_ar2->row_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_row_id">
		<td class="col-sm-2"><span id="elh_tr_km_item_ar2_row_id"><?php echo $tr_km_item_ar2->row_id->FldCaption() ?></span></td>
		<td<?php echo $tr_km_item_ar2->row_id->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_row_id">
<span<?php echo $tr_km_item_ar2->row_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_km_item_ar2->row_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="tr_km_item_ar2" data-field="x_row_id" name="x_row_id" id="x_row_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar2->row_id->CurrentValue) ?>">
<?php echo $tr_km_item_ar2->row_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_item_ar2->master_id->Visible) { // master_id ?>
<?php if ($tr_km_item_ar2_edit->IsMobileOrModal) { ?>
	<div id="r_master_id" class="form-group">
		<label id="elh_tr_km_item_ar2_master_id" for="x_master_id" class="<?php echo $tr_km_item_ar2_edit->LeftColumnClass ?>"><?php echo $tr_km_item_ar2->master_id->FldCaption() ?></label>
		<div class="<?php echo $tr_km_item_ar2_edit->RightColumnClass ?>"><div<?php echo $tr_km_item_ar2->master_id->CellAttributes() ?>>
<?php if ($tr_km_item_ar2->master_id->getSessionValue() <> "") { ?>
<span id="el_tr_km_item_ar2_master_id">
<span<?php echo $tr_km_item_ar2->master_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_km_item_ar2->master_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_master_id" name="x_master_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar2->master_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_tr_km_item_ar2_master_id">
<input type="text" data-table="tr_km_item_ar2" data-field="x_master_id" name="x_master_id" id="x_master_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar2->master_id->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar2->master_id->EditValue ?>"<?php echo $tr_km_item_ar2->master_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php echo $tr_km_item_ar2->master_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_master_id">
		<td class="col-sm-2"><span id="elh_tr_km_item_ar2_master_id"><?php echo $tr_km_item_ar2->master_id->FldCaption() ?></span></td>
		<td<?php echo $tr_km_item_ar2->master_id->CellAttributes() ?>>
<?php if ($tr_km_item_ar2->master_id->getSessionValue() <> "") { ?>
<span id="el_tr_km_item_ar2_master_id">
<span<?php echo $tr_km_item_ar2->master_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_km_item_ar2->master_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_master_id" name="x_master_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar2->master_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_tr_km_item_ar2_master_id">
<input type="text" data-table="tr_km_item_ar2" data-field="x_master_id" name="x_master_id" id="x_master_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar2->master_id->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar2->master_id->EditValue ?>"<?php echo $tr_km_item_ar2->master_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php echo $tr_km_item_ar2->master_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_item_ar2->customer_id->Visible) { // customer_id ?>
<?php if ($tr_km_item_ar2_edit->IsMobileOrModal) { ?>
	<div id="r_customer_id" class="form-group">
		<label id="elh_tr_km_item_ar2_customer_id" for="x_customer_id" class="<?php echo $tr_km_item_ar2_edit->LeftColumnClass ?>"><?php echo $tr_km_item_ar2->customer_id->FldCaption() ?></label>
		<div class="<?php echo $tr_km_item_ar2_edit->RightColumnClass ?>"><div<?php echo $tr_km_item_ar2->customer_id->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_customer_id">
<?php $tr_km_item_ar2->customer_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tr_km_item_ar2->customer_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_item_ar2->customer_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_item_ar2->customer_id->ViewValue ?>
	</span>
	<?php if (!$tr_km_item_ar2->customer_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_customer_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_item_ar2->customer_id->RadioButtonListHtml(TRUE, "x_customer_id") ?>
		</div>
	</div>
	<div id="tp_x_customer_id" class="ewTemplate"><input type="radio" data-table="tr_km_item_ar2" data-field="x_customer_id" data-value-separator="<?php echo $tr_km_item_ar2->customer_id->DisplayValueSeparatorAttribute() ?>" name="x_customer_id" id="x_customer_id" value="{value}"<?php echo $tr_km_item_ar2->customer_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tr_km_item_ar2->customer_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_customer_id">
		<td class="col-sm-2"><span id="elh_tr_km_item_ar2_customer_id"><?php echo $tr_km_item_ar2->customer_id->FldCaption() ?></span></td>
		<td<?php echo $tr_km_item_ar2->customer_id->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_customer_id">
<?php $tr_km_item_ar2->customer_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tr_km_item_ar2->customer_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_item_ar2->customer_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_item_ar2->customer_id->ViewValue ?>
	</span>
	<?php if (!$tr_km_item_ar2->customer_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_customer_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_item_ar2->customer_id->RadioButtonListHtml(TRUE, "x_customer_id") ?>
		</div>
	</div>
	<div id="tp_x_customer_id" class="ewTemplate"><input type="radio" data-table="tr_km_item_ar2" data-field="x_customer_id" data-value-separator="<?php echo $tr_km_item_ar2->customer_id->DisplayValueSeparatorAttribute() ?>" name="x_customer_id" id="x_customer_id" value="{value}"<?php echo $tr_km_item_ar2->customer_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tr_km_item_ar2->customer_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_item_ar2->inv_number->Visible) { // inv_number ?>
<?php if ($tr_km_item_ar2_edit->IsMobileOrModal) { ?>
	<div id="r_inv_number" class="form-group">
		<label id="elh_tr_km_item_ar2_inv_number" for="x_inv_number" class="<?php echo $tr_km_item_ar2_edit->LeftColumnClass ?>"><?php echo $tr_km_item_ar2->inv_number->FldCaption() ?></label>
		<div class="<?php echo $tr_km_item_ar2_edit->RightColumnClass ?>"><div<?php echo $tr_km_item_ar2->inv_number->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_inv_number">
<?php $tr_km_item_ar2->inv_number->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_km_item_ar2->inv_number->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_item_ar2->inv_number->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_item_ar2->inv_number->ViewValue ?>
	</span>
	<?php if (!$tr_km_item_ar2->inv_number->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_inv_number" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_item_ar2->inv_number->RadioButtonListHtml(TRUE, "x_inv_number") ?>
		</div>
	</div>
	<div id="tp_x_inv_number" class="ewTemplate"><input type="radio" data-table="tr_km_item_ar2" data-field="x_inv_number" data-value-separator="<?php echo $tr_km_item_ar2->inv_number->DisplayValueSeparatorAttribute() ?>" name="x_inv_number" id="x_inv_number" value="{value}"<?php echo $tr_km_item_ar2->inv_number->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x_inv_number" id="ln_x_inv_number" value="x_inv_date,x_inv_amt,x_paid_amt">
</span>
<?php echo $tr_km_item_ar2->inv_number->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_inv_number">
		<td class="col-sm-2"><span id="elh_tr_km_item_ar2_inv_number"><?php echo $tr_km_item_ar2->inv_number->FldCaption() ?></span></td>
		<td<?php echo $tr_km_item_ar2->inv_number->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_inv_number">
<?php $tr_km_item_ar2->inv_number->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_km_item_ar2->inv_number->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_item_ar2->inv_number->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_item_ar2->inv_number->ViewValue ?>
	</span>
	<?php if (!$tr_km_item_ar2->inv_number->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_inv_number" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_item_ar2->inv_number->RadioButtonListHtml(TRUE, "x_inv_number") ?>
		</div>
	</div>
	<div id="tp_x_inv_number" class="ewTemplate"><input type="radio" data-table="tr_km_item_ar2" data-field="x_inv_number" data-value-separator="<?php echo $tr_km_item_ar2->inv_number->DisplayValueSeparatorAttribute() ?>" name="x_inv_number" id="x_inv_number" value="{value}"<?php echo $tr_km_item_ar2->inv_number->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x_inv_number" id="ln_x_inv_number" value="x_inv_date,x_inv_amt,x_paid_amt">
</span>
<?php echo $tr_km_item_ar2->inv_number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_item_ar2->inv_date->Visible) { // inv_date ?>
<?php if ($tr_km_item_ar2_edit->IsMobileOrModal) { ?>
	<div id="r_inv_date" class="form-group">
		<label id="elh_tr_km_item_ar2_inv_date" for="x_inv_date" class="<?php echo $tr_km_item_ar2_edit->LeftColumnClass ?>"><?php echo $tr_km_item_ar2->inv_date->FldCaption() ?></label>
		<div class="<?php echo $tr_km_item_ar2_edit->RightColumnClass ?>"><div<?php echo $tr_km_item_ar2->inv_date->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_inv_date">
<input type="text" data-table="tr_km_item_ar2" data-field="x_inv_date" name="x_inv_date" id="x_inv_date" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar2->inv_date->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar2->inv_date->EditValue ?>"<?php echo $tr_km_item_ar2->inv_date->EditAttributes() ?>>
<?php if (!$tr_km_item_ar2->inv_date->ReadOnly && !$tr_km_item_ar2->inv_date->Disabled && !isset($tr_km_item_ar2->inv_date->EditAttrs["readonly"]) && !isset($tr_km_item_ar2->inv_date->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ftr_km_item_ar2edit", "x_inv_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $tr_km_item_ar2->inv_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_inv_date">
		<td class="col-sm-2"><span id="elh_tr_km_item_ar2_inv_date"><?php echo $tr_km_item_ar2->inv_date->FldCaption() ?></span></td>
		<td<?php echo $tr_km_item_ar2->inv_date->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_inv_date">
<input type="text" data-table="tr_km_item_ar2" data-field="x_inv_date" name="x_inv_date" id="x_inv_date" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar2->inv_date->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar2->inv_date->EditValue ?>"<?php echo $tr_km_item_ar2->inv_date->EditAttributes() ?>>
<?php if (!$tr_km_item_ar2->inv_date->ReadOnly && !$tr_km_item_ar2->inv_date->Disabled && !isset($tr_km_item_ar2->inv_date->EditAttrs["readonly"]) && !isset($tr_km_item_ar2->inv_date->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ftr_km_item_ar2edit", "x_inv_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $tr_km_item_ar2->inv_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_item_ar2->inv_amt->Visible) { // inv_amt ?>
<?php if ($tr_km_item_ar2_edit->IsMobileOrModal) { ?>
	<div id="r_inv_amt" class="form-group">
		<label id="elh_tr_km_item_ar2_inv_amt" for="x_inv_amt" class="<?php echo $tr_km_item_ar2_edit->LeftColumnClass ?>"><?php echo $tr_km_item_ar2->inv_amt->FldCaption() ?></label>
		<div class="<?php echo $tr_km_item_ar2_edit->RightColumnClass ?>"><div<?php echo $tr_km_item_ar2->inv_amt->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_inv_amt">
<input type="text" data-table="tr_km_item_ar2" data-field="x_inv_amt" name="x_inv_amt" id="x_inv_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar2->inv_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar2->inv_amt->EditValue ?>"<?php echo $tr_km_item_ar2->inv_amt->EditAttributes() ?>>
</span>
<?php echo $tr_km_item_ar2->inv_amt->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_inv_amt">
		<td class="col-sm-2"><span id="elh_tr_km_item_ar2_inv_amt"><?php echo $tr_km_item_ar2->inv_amt->FldCaption() ?></span></td>
		<td<?php echo $tr_km_item_ar2->inv_amt->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_inv_amt">
<input type="text" data-table="tr_km_item_ar2" data-field="x_inv_amt" name="x_inv_amt" id="x_inv_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar2->inv_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar2->inv_amt->EditValue ?>"<?php echo $tr_km_item_ar2->inv_amt->EditAttributes() ?>>
</span>
<?php echo $tr_km_item_ar2->inv_amt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_item_ar2->paid_amt->Visible) { // paid_amt ?>
<?php if ($tr_km_item_ar2_edit->IsMobileOrModal) { ?>
	<div id="r_paid_amt" class="form-group">
		<label id="elh_tr_km_item_ar2_paid_amt" for="x_paid_amt" class="<?php echo $tr_km_item_ar2_edit->LeftColumnClass ?>"><?php echo $tr_km_item_ar2->paid_amt->FldCaption() ?></label>
		<div class="<?php echo $tr_km_item_ar2_edit->RightColumnClass ?>"><div<?php echo $tr_km_item_ar2->paid_amt->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_paid_amt">
<input type="text" data-table="tr_km_item_ar2" data-field="x_paid_amt" name="x_paid_amt" id="x_paid_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar2->paid_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar2->paid_amt->EditValue ?>"<?php echo $tr_km_item_ar2->paid_amt->EditAttributes() ?>>
</span>
<?php echo $tr_km_item_ar2->paid_amt->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_paid_amt">
		<td class="col-sm-2"><span id="elh_tr_km_item_ar2_paid_amt"><?php echo $tr_km_item_ar2->paid_amt->FldCaption() ?></span></td>
		<td<?php echo $tr_km_item_ar2->paid_amt->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_paid_amt">
<input type="text" data-table="tr_km_item_ar2" data-field="x_paid_amt" name="x_paid_amt" id="x_paid_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar2->paid_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar2->paid_amt->EditValue ?>"<?php echo $tr_km_item_ar2->paid_amt->EditAttributes() ?>>
</span>
<?php echo $tr_km_item_ar2->paid_amt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_item_ar2->acc_no->Visible) { // acc_no ?>
<?php if ($tr_km_item_ar2_edit->IsMobileOrModal) { ?>
	<div id="r_acc_no" class="form-group">
		<label id="elh_tr_km_item_ar2_acc_no" for="x_acc_no" class="<?php echo $tr_km_item_ar2_edit->LeftColumnClass ?>"><?php echo $tr_km_item_ar2->acc_no->FldCaption() ?></label>
		<div class="<?php echo $tr_km_item_ar2_edit->RightColumnClass ?>"><div<?php echo $tr_km_item_ar2->acc_no->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_acc_no">
<input type="text" data-table="tr_km_item_ar2" data-field="x_acc_no" name="x_acc_no" id="x_acc_no" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar2->acc_no->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar2->acc_no->EditValue ?>"<?php echo $tr_km_item_ar2->acc_no->EditAttributes() ?>>
</span>
<?php echo $tr_km_item_ar2->acc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_acc_no">
		<td class="col-sm-2"><span id="elh_tr_km_item_ar2_acc_no"><?php echo $tr_km_item_ar2->acc_no->FldCaption() ?></span></td>
		<td<?php echo $tr_km_item_ar2->acc_no->CellAttributes() ?>>
<span id="el_tr_km_item_ar2_acc_no">
<input type="text" data-table="tr_km_item_ar2" data-field="x_acc_no" name="x_acc_no" id="x_acc_no" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar2->acc_no->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar2->acc_no->EditValue ?>"<?php echo $tr_km_item_ar2->acc_no->EditAttributes() ?>>
</span>
<?php echo $tr_km_item_ar2->acc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_item_ar2_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$tr_km_item_ar2_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tr_km_item_ar2_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tr_km_item_ar2_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tr_km_item_ar2_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ftr_km_item_ar2edit.Init();
</script>
<?php
$tr_km_item_ar2_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_km_item_ar2_edit->Page_Terminate();
?>
