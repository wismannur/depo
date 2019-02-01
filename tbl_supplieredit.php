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

$tbl_supplier_edit = NULL; // Initialize page object first

class ctbl_supplier_edit extends ctbl_supplier {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tbl_supplier';

	// Page object name
	var $PageObjName = 'tbl_supplier_edit';

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
			define("EW_PAGE_ID", 'edit', TRUE);

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
		// Create form object

		$objForm = new cFormObj();
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "tbl_supplierview.php")
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
			if ($objForm->HasValue("x_supplier_id")) {
				$this->supplier_id->setFormValue($objForm->GetValue("x_supplier_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["supplier_id"])) {
				$this->supplier_id->setQueryStringValue($_GET["supplier_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->supplier_id->CurrentValue = NULL;
			}
		}

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
					$this->Page_Terminate("tbl_supplierlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "tbl_supplierlist.php")
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
		if (!$this->supplier_id->FldIsDetailKey)
			$this->supplier_id->setFormValue($objForm->GetValue("x_supplier_id"));
		if (!$this->supplier_code->FldIsDetailKey) {
			$this->supplier_code->setFormValue($objForm->GetValue("x_supplier_code"));
		}
		if (!$this->supplier_name->FldIsDetailKey) {
			$this->supplier_name->setFormValue($objForm->GetValue("x_supplier_name"));
		}
		if (!$this->contact_name->FldIsDetailKey) {
			$this->contact_name->setFormValue($objForm->GetValue("x_contact_name"));
		}
		if (!$this->address1->FldIsDetailKey) {
			$this->address1->setFormValue($objForm->GetValue("x_address1"));
		}
		if (!$this->address2->FldIsDetailKey) {
			$this->address2->setFormValue($objForm->GetValue("x_address2"));
		}
		if (!$this->address3->FldIsDetailKey) {
			$this->address3->setFormValue($objForm->GetValue("x_address3"));
		}
		if (!$this->phone->FldIsDetailKey) {
			$this->phone->setFormValue($objForm->GetValue("x_phone"));
		}
		if (!$this->fax->FldIsDetailKey) {
			$this->fax->setFormValue($objForm->GetValue("x_fax"));
		}
		if (!$this->discount->FldIsDetailKey) {
			$this->discount->setFormValue($objForm->GetValue("x_discount"));
		}
		if (!$this->due_day->FldIsDetailKey) {
			$this->due_day->setFormValue($objForm->GetValue("x_due_day"));
		}
		if (!$this->npwp->FldIsDetailKey) {
			$this->npwp->setFormValue($objForm->GetValue("x_npwp"));
		}
		if (!$this->ap_acc->FldIsDetailKey) {
			$this->ap_acc->setFormValue($objForm->GetValue("x_ap_acc"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->supplier_id->CurrentValue = $this->supplier_id->FormValue;
		$this->supplier_code->CurrentValue = $this->supplier_code->FormValue;
		$this->supplier_name->CurrentValue = $this->supplier_name->FormValue;
		$this->contact_name->CurrentValue = $this->contact_name->FormValue;
		$this->address1->CurrentValue = $this->address1->FormValue;
		$this->address2->CurrentValue = $this->address2->FormValue;
		$this->address3->CurrentValue = $this->address3->FormValue;
		$this->phone->CurrentValue = $this->phone->FormValue;
		$this->fax->CurrentValue = $this->fax->FormValue;
		$this->discount->CurrentValue = $this->discount->FormValue;
		$this->due_day->CurrentValue = $this->due_day->FormValue;
		$this->npwp->CurrentValue = $this->npwp->FormValue;
		$this->ap_acc->CurrentValue = $this->ap_acc->FormValue;
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("supplier_id")) <> "")
			$this->supplier_id->CurrentValue = $this->getKey("supplier_id"); // supplier_id
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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// supplier_id
			$this->supplier_id->EditAttrs["class"] = "form-control";
			$this->supplier_id->EditCustomAttributes = "";
			$this->supplier_id->EditValue = $this->supplier_id->CurrentValue;
			$this->supplier_id->ViewCustomAttributes = "";

			// supplier_code
			$this->supplier_code->EditAttrs["class"] = "form-control";
			$this->supplier_code->EditCustomAttributes = "";
			$this->supplier_code->EditValue = ew_HtmlEncode($this->supplier_code->CurrentValue);
			$this->supplier_code->PlaceHolder = ew_RemoveHtml($this->supplier_code->FldCaption());

			// supplier_name
			$this->supplier_name->EditAttrs["class"] = "form-control";
			$this->supplier_name->EditCustomAttributes = "";
			$this->supplier_name->EditValue = ew_HtmlEncode($this->supplier_name->CurrentValue);
			$this->supplier_name->PlaceHolder = ew_RemoveHtml($this->supplier_name->FldCaption());

			// contact_name
			$this->contact_name->EditAttrs["class"] = "form-control";
			$this->contact_name->EditCustomAttributes = "";
			$this->contact_name->EditValue = ew_HtmlEncode($this->contact_name->CurrentValue);
			$this->contact_name->PlaceHolder = ew_RemoveHtml($this->contact_name->FldCaption());

			// address1
			$this->address1->EditAttrs["class"] = "form-control";
			$this->address1->EditCustomAttributes = "";
			$this->address1->EditValue = ew_HtmlEncode($this->address1->CurrentValue);
			$this->address1->PlaceHolder = ew_RemoveHtml($this->address1->FldCaption());

			// address2
			$this->address2->EditAttrs["class"] = "form-control";
			$this->address2->EditCustomAttributes = "";
			$this->address2->EditValue = ew_HtmlEncode($this->address2->CurrentValue);
			$this->address2->PlaceHolder = ew_RemoveHtml($this->address2->FldCaption());

			// address3
			$this->address3->EditAttrs["class"] = "form-control";
			$this->address3->EditCustomAttributes = "";
			$this->address3->EditValue = ew_HtmlEncode($this->address3->CurrentValue);
			$this->address3->PlaceHolder = ew_RemoveHtml($this->address3->FldCaption());

			// phone
			$this->phone->EditAttrs["class"] = "form-control";
			$this->phone->EditCustomAttributes = "";
			$this->phone->EditValue = ew_HtmlEncode($this->phone->CurrentValue);
			$this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldCaption());

			// fax
			$this->fax->EditAttrs["class"] = "form-control";
			$this->fax->EditCustomAttributes = "";
			$this->fax->EditValue = ew_HtmlEncode($this->fax->CurrentValue);
			$this->fax->PlaceHolder = ew_RemoveHtml($this->fax->FldCaption());

			// discount
			$this->discount->EditAttrs["class"] = "form-control";
			$this->discount->EditCustomAttributes = "";
			$this->discount->EditValue = ew_HtmlEncode($this->discount->CurrentValue);
			$this->discount->PlaceHolder = ew_RemoveHtml($this->discount->FldCaption());
			if (strval($this->discount->EditValue) <> "" && is_numeric($this->discount->EditValue)) $this->discount->EditValue = ew_FormatNumber($this->discount->EditValue, -2, -1, -2, 0);

			// due_day
			$this->due_day->EditAttrs["class"] = "form-control";
			$this->due_day->EditCustomAttributes = "";
			$this->due_day->EditValue = ew_HtmlEncode($this->due_day->CurrentValue);
			$this->due_day->PlaceHolder = ew_RemoveHtml($this->due_day->FldCaption());

			// npwp
			$this->npwp->EditAttrs["class"] = "form-control";
			$this->npwp->EditCustomAttributes = "";
			$this->npwp->EditValue = ew_HtmlEncode($this->npwp->CurrentValue);
			$this->npwp->PlaceHolder = ew_RemoveHtml($this->npwp->FldCaption());

			// ap_acc
			$this->ap_acc->EditAttrs["class"] = "form-control";
			$this->ap_acc->EditCustomAttributes = "";
			$this->ap_acc->EditValue = ew_HtmlEncode($this->ap_acc->CurrentValue);
			$this->ap_acc->PlaceHolder = ew_RemoveHtml($this->ap_acc->FldCaption());

			// Edit refer script
			// supplier_id

			$this->supplier_id->LinkCustomAttributes = "";
			$this->supplier_id->HrefValue = "";

			// supplier_code
			$this->supplier_code->LinkCustomAttributes = "";
			$this->supplier_code->HrefValue = "";

			// supplier_name
			$this->supplier_name->LinkCustomAttributes = "";
			$this->supplier_name->HrefValue = "";

			// contact_name
			$this->contact_name->LinkCustomAttributes = "";
			$this->contact_name->HrefValue = "";

			// address1
			$this->address1->LinkCustomAttributes = "";
			$this->address1->HrefValue = "";

			// address2
			$this->address2->LinkCustomAttributes = "";
			$this->address2->HrefValue = "";

			// address3
			$this->address3->LinkCustomAttributes = "";
			$this->address3->HrefValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";

			// discount
			$this->discount->LinkCustomAttributes = "";
			$this->discount->HrefValue = "";

			// due_day
			$this->due_day->LinkCustomAttributes = "";
			$this->due_day->HrefValue = "";

			// npwp
			$this->npwp->LinkCustomAttributes = "";
			$this->npwp->HrefValue = "";

			// ap_acc
			$this->ap_acc->LinkCustomAttributes = "";
			$this->ap_acc->HrefValue = "";
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
		if (!ew_CheckNumber($this->discount->FormValue)) {
			ew_AddMessage($gsFormError, $this->discount->FldErrMsg());
		}
		if (!ew_CheckInteger($this->due_day->FormValue)) {
			ew_AddMessage($gsFormError, $this->due_day->FldErrMsg());
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

			// supplier_code
			$this->supplier_code->SetDbValueDef($rsnew, $this->supplier_code->CurrentValue, NULL, $this->supplier_code->ReadOnly);

			// supplier_name
			$this->supplier_name->SetDbValueDef($rsnew, $this->supplier_name->CurrentValue, NULL, $this->supplier_name->ReadOnly);

			// contact_name
			$this->contact_name->SetDbValueDef($rsnew, $this->contact_name->CurrentValue, NULL, $this->contact_name->ReadOnly);

			// address1
			$this->address1->SetDbValueDef($rsnew, $this->address1->CurrentValue, NULL, $this->address1->ReadOnly);

			// address2
			$this->address2->SetDbValueDef($rsnew, $this->address2->CurrentValue, NULL, $this->address2->ReadOnly);

			// address3
			$this->address3->SetDbValueDef($rsnew, $this->address3->CurrentValue, NULL, $this->address3->ReadOnly);

			// phone
			$this->phone->SetDbValueDef($rsnew, $this->phone->CurrentValue, NULL, $this->phone->ReadOnly);

			// fax
			$this->fax->SetDbValueDef($rsnew, $this->fax->CurrentValue, NULL, $this->fax->ReadOnly);

			// discount
			$this->discount->SetDbValueDef($rsnew, $this->discount->CurrentValue, NULL, $this->discount->ReadOnly);

			// due_day
			$this->due_day->SetDbValueDef($rsnew, $this->due_day->CurrentValue, NULL, $this->due_day->ReadOnly);

			// npwp
			$this->npwp->SetDbValueDef($rsnew, $this->npwp->CurrentValue, NULL, $this->npwp->ReadOnly);

			// ap_acc
			$this->ap_acc->SetDbValueDef($rsnew, $this->ap_acc->CurrentValue, NULL, $this->ap_acc->ReadOnly);

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

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_supplierlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
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
if (!isset($tbl_supplier_edit)) $tbl_supplier_edit = new ctbl_supplier_edit();

// Page init
$tbl_supplier_edit->Page_Init();

// Page main
$tbl_supplier_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplier_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ftbl_supplieredit = new ew_Form("ftbl_supplieredit", "edit");

// Validate form
ftbl_supplieredit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_discount");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_supplier->discount->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_due_day");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_supplier->due_day->FldErrMsg()) ?>");

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
ftbl_supplieredit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_supplieredit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_supplier_edit->ShowPageHeader(); ?>
<?php
$tbl_supplier_edit->ShowMessage();
?>
<form name="ftbl_supplieredit" id="ftbl_supplieredit" class="<?php echo $tbl_supplier_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_supplier_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_supplier_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplier">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($tbl_supplier_edit->IsModal) ?>">
<?php if (!$tbl_supplier_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_tbl_supplieredit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($tbl_supplier->supplier_id->Visible) { // supplier_id ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_supplier_id" class="form-group">
		<label id="elh_tbl_supplier_supplier_id" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->supplier_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->supplier_id->CellAttributes() ?>>
<span id="el_tbl_supplier_supplier_id">
<span<?php echo $tbl_supplier->supplier_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tbl_supplier->supplier_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="tbl_supplier" data-field="x_supplier_id" name="x_supplier_id" id="x_supplier_id" value="<?php echo ew_HtmlEncode($tbl_supplier->supplier_id->CurrentValue) ?>">
<?php echo $tbl_supplier->supplier_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_supplier_id">
		<td class="col-sm-2"><span id="elh_tbl_supplier_supplier_id"><?php echo $tbl_supplier->supplier_id->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->supplier_id->CellAttributes() ?>>
<span id="el_tbl_supplier_supplier_id">
<span<?php echo $tbl_supplier->supplier_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tbl_supplier->supplier_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="tbl_supplier" data-field="x_supplier_id" name="x_supplier_id" id="x_supplier_id" value="<?php echo ew_HtmlEncode($tbl_supplier->supplier_id->CurrentValue) ?>">
<?php echo $tbl_supplier->supplier_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier->supplier_code->Visible) { // supplier_code ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_supplier_code" class="form-group">
		<label id="elh_tbl_supplier_supplier_code" for="x_supplier_code" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->supplier_code->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->supplier_code->CellAttributes() ?>>
<span id="el_tbl_supplier_supplier_code">
<input type="text" data-table="tbl_supplier" data-field="x_supplier_code" name="x_supplier_code" id="x_supplier_code" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->supplier_code->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->supplier_code->EditValue ?>"<?php echo $tbl_supplier->supplier_code->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->supplier_code->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_supplier_code">
		<td class="col-sm-2"><span id="elh_tbl_supplier_supplier_code"><?php echo $tbl_supplier->supplier_code->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->supplier_code->CellAttributes() ?>>
<span id="el_tbl_supplier_supplier_code">
<input type="text" data-table="tbl_supplier" data-field="x_supplier_code" name="x_supplier_code" id="x_supplier_code" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->supplier_code->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->supplier_code->EditValue ?>"<?php echo $tbl_supplier->supplier_code->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->supplier_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier->supplier_name->Visible) { // supplier_name ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_supplier_name" class="form-group">
		<label id="elh_tbl_supplier_supplier_name" for="x_supplier_name" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->supplier_name->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->supplier_name->CellAttributes() ?>>
<span id="el_tbl_supplier_supplier_name">
<input type="text" data-table="tbl_supplier" data-field="x_supplier_name" name="x_supplier_name" id="x_supplier_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->supplier_name->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->supplier_name->EditValue ?>"<?php echo $tbl_supplier->supplier_name->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->supplier_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_supplier_name">
		<td class="col-sm-2"><span id="elh_tbl_supplier_supplier_name"><?php echo $tbl_supplier->supplier_name->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->supplier_name->CellAttributes() ?>>
<span id="el_tbl_supplier_supplier_name">
<input type="text" data-table="tbl_supplier" data-field="x_supplier_name" name="x_supplier_name" id="x_supplier_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->supplier_name->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->supplier_name->EditValue ?>"<?php echo $tbl_supplier->supplier_name->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->supplier_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier->contact_name->Visible) { // contact_name ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_contact_name" class="form-group">
		<label id="elh_tbl_supplier_contact_name" for="x_contact_name" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->contact_name->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->contact_name->CellAttributes() ?>>
<span id="el_tbl_supplier_contact_name">
<input type="text" data-table="tbl_supplier" data-field="x_contact_name" name="x_contact_name" id="x_contact_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->contact_name->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->contact_name->EditValue ?>"<?php echo $tbl_supplier->contact_name->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->contact_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_contact_name">
		<td class="col-sm-2"><span id="elh_tbl_supplier_contact_name"><?php echo $tbl_supplier->contact_name->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->contact_name->CellAttributes() ?>>
<span id="el_tbl_supplier_contact_name">
<input type="text" data-table="tbl_supplier" data-field="x_contact_name" name="x_contact_name" id="x_contact_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->contact_name->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->contact_name->EditValue ?>"<?php echo $tbl_supplier->contact_name->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->contact_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier->address1->Visible) { // address1 ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_address1" class="form-group">
		<label id="elh_tbl_supplier_address1" for="x_address1" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->address1->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->address1->CellAttributes() ?>>
<span id="el_tbl_supplier_address1">
<input type="text" data-table="tbl_supplier" data-field="x_address1" name="x_address1" id="x_address1" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->address1->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->address1->EditValue ?>"<?php echo $tbl_supplier->address1->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->address1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address1">
		<td class="col-sm-2"><span id="elh_tbl_supplier_address1"><?php echo $tbl_supplier->address1->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->address1->CellAttributes() ?>>
<span id="el_tbl_supplier_address1">
<input type="text" data-table="tbl_supplier" data-field="x_address1" name="x_address1" id="x_address1" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->address1->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->address1->EditValue ?>"<?php echo $tbl_supplier->address1->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->address1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier->address2->Visible) { // address2 ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_address2" class="form-group">
		<label id="elh_tbl_supplier_address2" for="x_address2" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->address2->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->address2->CellAttributes() ?>>
<span id="el_tbl_supplier_address2">
<input type="text" data-table="tbl_supplier" data-field="x_address2" name="x_address2" id="x_address2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->address2->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->address2->EditValue ?>"<?php echo $tbl_supplier->address2->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->address2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address2">
		<td class="col-sm-2"><span id="elh_tbl_supplier_address2"><?php echo $tbl_supplier->address2->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->address2->CellAttributes() ?>>
<span id="el_tbl_supplier_address2">
<input type="text" data-table="tbl_supplier" data-field="x_address2" name="x_address2" id="x_address2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->address2->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->address2->EditValue ?>"<?php echo $tbl_supplier->address2->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->address2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier->address3->Visible) { // address3 ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_address3" class="form-group">
		<label id="elh_tbl_supplier_address3" for="x_address3" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->address3->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->address3->CellAttributes() ?>>
<span id="el_tbl_supplier_address3">
<input type="text" data-table="tbl_supplier" data-field="x_address3" name="x_address3" id="x_address3" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->address3->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->address3->EditValue ?>"<?php echo $tbl_supplier->address3->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->address3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address3">
		<td class="col-sm-2"><span id="elh_tbl_supplier_address3"><?php echo $tbl_supplier->address3->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->address3->CellAttributes() ?>>
<span id="el_tbl_supplier_address3">
<input type="text" data-table="tbl_supplier" data-field="x_address3" name="x_address3" id="x_address3" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->address3->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->address3->EditValue ?>"<?php echo $tbl_supplier->address3->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->address3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier->phone->Visible) { // phone ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_phone" class="form-group">
		<label id="elh_tbl_supplier_phone" for="x_phone" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->phone->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->phone->CellAttributes() ?>>
<span id="el_tbl_supplier_phone">
<input type="text" data-table="tbl_supplier" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->phone->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->phone->EditValue ?>"<?php echo $tbl_supplier->phone->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->phone->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_phone">
		<td class="col-sm-2"><span id="elh_tbl_supplier_phone"><?php echo $tbl_supplier->phone->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->phone->CellAttributes() ?>>
<span id="el_tbl_supplier_phone">
<input type="text" data-table="tbl_supplier" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->phone->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->phone->EditValue ?>"<?php echo $tbl_supplier->phone->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier->fax->Visible) { // fax ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_fax" class="form-group">
		<label id="elh_tbl_supplier_fax" for="x_fax" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->fax->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->fax->CellAttributes() ?>>
<span id="el_tbl_supplier_fax">
<input type="text" data-table="tbl_supplier" data-field="x_fax" name="x_fax" id="x_fax" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->fax->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->fax->EditValue ?>"<?php echo $tbl_supplier->fax->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->fax->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_fax">
		<td class="col-sm-2"><span id="elh_tbl_supplier_fax"><?php echo $tbl_supplier->fax->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->fax->CellAttributes() ?>>
<span id="el_tbl_supplier_fax">
<input type="text" data-table="tbl_supplier" data-field="x_fax" name="x_fax" id="x_fax" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->fax->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->fax->EditValue ?>"<?php echo $tbl_supplier->fax->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->fax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier->discount->Visible) { // discount ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_discount" class="form-group">
		<label id="elh_tbl_supplier_discount" for="x_discount" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->discount->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->discount->CellAttributes() ?>>
<span id="el_tbl_supplier_discount">
<input type="text" data-table="tbl_supplier" data-field="x_discount" name="x_discount" id="x_discount" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->discount->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->discount->EditValue ?>"<?php echo $tbl_supplier->discount->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->discount->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_discount">
		<td class="col-sm-2"><span id="elh_tbl_supplier_discount"><?php echo $tbl_supplier->discount->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->discount->CellAttributes() ?>>
<span id="el_tbl_supplier_discount">
<input type="text" data-table="tbl_supplier" data-field="x_discount" name="x_discount" id="x_discount" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->discount->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->discount->EditValue ?>"<?php echo $tbl_supplier->discount->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->discount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier->due_day->Visible) { // due_day ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_due_day" class="form-group">
		<label id="elh_tbl_supplier_due_day" for="x_due_day" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->due_day->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->due_day->CellAttributes() ?>>
<span id="el_tbl_supplier_due_day">
<input type="text" data-table="tbl_supplier" data-field="x_due_day" name="x_due_day" id="x_due_day" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->due_day->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->due_day->EditValue ?>"<?php echo $tbl_supplier->due_day->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->due_day->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_due_day">
		<td class="col-sm-2"><span id="elh_tbl_supplier_due_day"><?php echo $tbl_supplier->due_day->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->due_day->CellAttributes() ?>>
<span id="el_tbl_supplier_due_day">
<input type="text" data-table="tbl_supplier" data-field="x_due_day" name="x_due_day" id="x_due_day" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->due_day->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->due_day->EditValue ?>"<?php echo $tbl_supplier->due_day->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->due_day->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier->npwp->Visible) { // npwp ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_npwp" class="form-group">
		<label id="elh_tbl_supplier_npwp" for="x_npwp" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->npwp->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->npwp->CellAttributes() ?>>
<span id="el_tbl_supplier_npwp">
<input type="text" data-table="tbl_supplier" data-field="x_npwp" name="x_npwp" id="x_npwp" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->npwp->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->npwp->EditValue ?>"<?php echo $tbl_supplier->npwp->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->npwp->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_npwp">
		<td class="col-sm-2"><span id="elh_tbl_supplier_npwp"><?php echo $tbl_supplier->npwp->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->npwp->CellAttributes() ?>>
<span id="el_tbl_supplier_npwp">
<input type="text" data-table="tbl_supplier" data-field="x_npwp" name="x_npwp" id="x_npwp" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->npwp->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->npwp->EditValue ?>"<?php echo $tbl_supplier->npwp->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->npwp->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier->ap_acc->Visible) { // ap_acc ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
	<div id="r_ap_acc" class="form-group">
		<label id="elh_tbl_supplier_ap_acc" for="x_ap_acc" class="<?php echo $tbl_supplier_edit->LeftColumnClass ?>"><?php echo $tbl_supplier->ap_acc->FldCaption() ?></label>
		<div class="<?php echo $tbl_supplier_edit->RightColumnClass ?>"><div<?php echo $tbl_supplier->ap_acc->CellAttributes() ?>>
<span id="el_tbl_supplier_ap_acc">
<input type="text" data-table="tbl_supplier" data-field="x_ap_acc" name="x_ap_acc" id="x_ap_acc" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->ap_acc->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->ap_acc->EditValue ?>"<?php echo $tbl_supplier->ap_acc->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->ap_acc->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ap_acc">
		<td class="col-sm-2"><span id="elh_tbl_supplier_ap_acc"><?php echo $tbl_supplier->ap_acc->FldCaption() ?></span></td>
		<td<?php echo $tbl_supplier->ap_acc->CellAttributes() ?>>
<span id="el_tbl_supplier_ap_acc">
<input type="text" data-table="tbl_supplier" data-field="x_ap_acc" name="x_ap_acc" id="x_ap_acc" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_supplier->ap_acc->getPlaceHolder()) ?>" value="<?php echo $tbl_supplier->ap_acc->EditValue ?>"<?php echo $tbl_supplier->ap_acc->EditAttributes() ?>>
</span>
<?php echo $tbl_supplier->ap_acc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_supplier_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$tbl_supplier_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_supplier_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_supplier_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tbl_supplier_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ftbl_supplieredit.Init();
</script>
<?php
$tbl_supplier_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_supplier_edit->Page_Terminate();
?>
