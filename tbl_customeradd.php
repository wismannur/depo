<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_customerinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_customer_add = NULL; // Initialize page object first

class ctbl_customer_add extends ctbl_customer {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tbl_customer';

	// Page object name
	var $PageObjName = 'tbl_customer_add';

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

		// Table object (tbl_customer)
		if (!isset($GLOBALS["tbl_customer"]) || get_class($GLOBALS["tbl_customer"]) == "ctbl_customer") {
			$GLOBALS["tbl_customer"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_customer"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_customer', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tbl_customerlist.php"));
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
		$this->customer_code->SetVisibility();
		$this->customer_group->SetVisibility();
		$this->customer_name->SetVisibility();
		$this->contact_name->SetVisibility();
		$this->address1->SetVisibility();
		$this->address2->SetVisibility();
		$this->address3->SetVisibility();
		$this->phone->SetVisibility();
		$this->fax->SetVisibility();
		$this->wilayah_id->SetVisibility();
		$this->subwil_id->SetVisibility();
		$this->area_id->SetVisibility();
		$this->sales_id->SetVisibility();
		$this->due_day->SetVisibility();
		$this->ar_acc->SetVisibility();
		$this->npwp->SetVisibility();
		$this->discount->SetVisibility();
		$this->credit_max->SetVisibility();
		$this->invoice_max->SetVisibility();

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
		global $EW_EXPORT, $tbl_customer;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_customer);
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
					if ($pageName == "tbl_customerview.php")
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
			if (@$_GET["customer_id"] != "") {
				$this->customer_id->setQueryStringValue($_GET["customer_id"]);
				$this->setKey("customer_id", $this->customer_id->CurrentValue); // Set up key
			} else {
				$this->setKey("customer_id", ""); // Clear key
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
					$this->Page_Terminate("tbl_customerlist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = "tbl_customerlist.php";
					if (ew_GetPageName($sReturnUrl) == "tbl_customerlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "tbl_customerview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
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
		$this->customer_id->CurrentValue = NULL;
		$this->customer_id->OldValue = $this->customer_id->CurrentValue;
		$this->customer_code->CurrentValue = NULL;
		$this->customer_code->OldValue = $this->customer_code->CurrentValue;
		$this->customer_group->CurrentValue = 'XX';
		$this->customer_name->CurrentValue = NULL;
		$this->customer_name->OldValue = $this->customer_name->CurrentValue;
		$this->contact_name->CurrentValue = NULL;
		$this->contact_name->OldValue = $this->contact_name->CurrentValue;
		$this->address1->CurrentValue = NULL;
		$this->address1->OldValue = $this->address1->CurrentValue;
		$this->address2->CurrentValue = NULL;
		$this->address2->OldValue = $this->address2->CurrentValue;
		$this->address3->CurrentValue = NULL;
		$this->address3->OldValue = $this->address3->CurrentValue;
		$this->phone->CurrentValue = NULL;
		$this->phone->OldValue = $this->phone->CurrentValue;
		$this->fax->CurrentValue = NULL;
		$this->fax->OldValue = $this->fax->CurrentValue;
		$this->wilayah_id->CurrentValue = NULL;
		$this->wilayah_id->OldValue = $this->wilayah_id->CurrentValue;
		$this->subwil_id->CurrentValue = NULL;
		$this->subwil_id->OldValue = $this->subwil_id->CurrentValue;
		$this->area_id->CurrentValue = NULL;
		$this->area_id->OldValue = $this->area_id->CurrentValue;
		$this->sales_id->CurrentValue = NULL;
		$this->sales_id->OldValue = $this->sales_id->CurrentValue;
		$this->due_day->CurrentValue = NULL;
		$this->due_day->OldValue = $this->due_day->CurrentValue;
		$this->ar_acc->CurrentValue = NULL;
		$this->ar_acc->OldValue = $this->ar_acc->CurrentValue;
		$this->npwp->CurrentValue = NULL;
		$this->npwp->OldValue = $this->npwp->CurrentValue;
		$this->discount->CurrentValue = NULL;
		$this->discount->OldValue = $this->discount->CurrentValue;
		$this->freight->CurrentValue = NULL;
		$this->freight->OldValue = $this->freight->CurrentValue;
		$this->credit_max->CurrentValue = NULL;
		$this->credit_max->OldValue = $this->credit_max->CurrentValue;
		$this->invoice_max->CurrentValue = 1;
		$this->saldo_awal->CurrentValue = NULL;
		$this->saldo_awal->OldValue = $this->saldo_awal->CurrentValue;
		$this->curency->CurrentValue = NULL;
		$this->curency->OldValue = $this->curency->CurrentValue;
		$this->kode_depo->CurrentValue = NULL;
		$this->kode_depo->OldValue = $this->kode_depo->CurrentValue;
		$this->tax->CurrentValue = NULL;
		$this->tax->OldValue = $this->tax->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->customer_code->FldIsDetailKey) {
			$this->customer_code->setFormValue($objForm->GetValue("x_customer_code"));
		}
		if (!$this->customer_group->FldIsDetailKey) {
			$this->customer_group->setFormValue($objForm->GetValue("x_customer_group"));
		}
		if (!$this->customer_name->FldIsDetailKey) {
			$this->customer_name->setFormValue($objForm->GetValue("x_customer_name"));
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
		if (!$this->wilayah_id->FldIsDetailKey) {
			$this->wilayah_id->setFormValue($objForm->GetValue("x_wilayah_id"));
		}
		if (!$this->subwil_id->FldIsDetailKey) {
			$this->subwil_id->setFormValue($objForm->GetValue("x_subwil_id"));
		}
		if (!$this->area_id->FldIsDetailKey) {
			$this->area_id->setFormValue($objForm->GetValue("x_area_id"));
		}
		if (!$this->sales_id->FldIsDetailKey) {
			$this->sales_id->setFormValue($objForm->GetValue("x_sales_id"));
		}
		if (!$this->due_day->FldIsDetailKey) {
			$this->due_day->setFormValue($objForm->GetValue("x_due_day"));
		}
		if (!$this->ar_acc->FldIsDetailKey) {
			$this->ar_acc->setFormValue($objForm->GetValue("x_ar_acc"));
		}
		if (!$this->npwp->FldIsDetailKey) {
			$this->npwp->setFormValue($objForm->GetValue("x_npwp"));
		}
		if (!$this->discount->FldIsDetailKey) {
			$this->discount->setFormValue($objForm->GetValue("x_discount"));
		}
		if (!$this->credit_max->FldIsDetailKey) {
			$this->credit_max->setFormValue($objForm->GetValue("x_credit_max"));
		}
		if (!$this->invoice_max->FldIsDetailKey) {
			$this->invoice_max->setFormValue($objForm->GetValue("x_invoice_max"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->customer_code->CurrentValue = $this->customer_code->FormValue;
		$this->customer_group->CurrentValue = $this->customer_group->FormValue;
		$this->customer_name->CurrentValue = $this->customer_name->FormValue;
		$this->contact_name->CurrentValue = $this->contact_name->FormValue;
		$this->address1->CurrentValue = $this->address1->FormValue;
		$this->address2->CurrentValue = $this->address2->FormValue;
		$this->address3->CurrentValue = $this->address3->FormValue;
		$this->phone->CurrentValue = $this->phone->FormValue;
		$this->fax->CurrentValue = $this->fax->FormValue;
		$this->wilayah_id->CurrentValue = $this->wilayah_id->FormValue;
		$this->subwil_id->CurrentValue = $this->subwil_id->FormValue;
		$this->area_id->CurrentValue = $this->area_id->FormValue;
		$this->sales_id->CurrentValue = $this->sales_id->FormValue;
		$this->due_day->CurrentValue = $this->due_day->FormValue;
		$this->ar_acc->CurrentValue = $this->ar_acc->FormValue;
		$this->npwp->CurrentValue = $this->npwp->FormValue;
		$this->discount->CurrentValue = $this->discount->FormValue;
		$this->credit_max->CurrentValue = $this->credit_max->FormValue;
		$this->invoice_max->CurrentValue = $this->invoice_max->FormValue;
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
		$this->customer_id->setDbValue($row['customer_id']);
		$this->customer_code->setDbValue($row['customer_code']);
		$this->customer_group->setDbValue($row['customer_group']);
		$this->customer_name->setDbValue($row['customer_name']);
		$this->contact_name->setDbValue($row['contact_name']);
		$this->address1->setDbValue($row['address1']);
		$this->address2->setDbValue($row['address2']);
		$this->address3->setDbValue($row['address3']);
		$this->phone->setDbValue($row['phone']);
		$this->fax->setDbValue($row['fax']);
		$this->wilayah_id->setDbValue($row['wilayah_id']);
		$this->subwil_id->setDbValue($row['subwil_id']);
		$this->area_id->setDbValue($row['area_id']);
		$this->sales_id->setDbValue($row['sales_id']);
		$this->due_day->setDbValue($row['due_day']);
		$this->ar_acc->setDbValue($row['ar_acc']);
		$this->npwp->setDbValue($row['npwp']);
		$this->discount->setDbValue($row['discount']);
		$this->freight->setDbValue($row['freight']);
		$this->credit_max->setDbValue($row['credit_max']);
		$this->invoice_max->setDbValue($row['invoice_max']);
		$this->saldo_awal->setDbValue($row['saldo_awal']);
		$this->curency->setDbValue($row['curency']);
		$this->kode_depo->setDbValue($row['kode_depo']);
		$this->tax->setDbValue($row['tax']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['customer_id'] = $this->customer_id->CurrentValue;
		$row['customer_code'] = $this->customer_code->CurrentValue;
		$row['customer_group'] = $this->customer_group->CurrentValue;
		$row['customer_name'] = $this->customer_name->CurrentValue;
		$row['contact_name'] = $this->contact_name->CurrentValue;
		$row['address1'] = $this->address1->CurrentValue;
		$row['address2'] = $this->address2->CurrentValue;
		$row['address3'] = $this->address3->CurrentValue;
		$row['phone'] = $this->phone->CurrentValue;
		$row['fax'] = $this->fax->CurrentValue;
		$row['wilayah_id'] = $this->wilayah_id->CurrentValue;
		$row['subwil_id'] = $this->subwil_id->CurrentValue;
		$row['area_id'] = $this->area_id->CurrentValue;
		$row['sales_id'] = $this->sales_id->CurrentValue;
		$row['due_day'] = $this->due_day->CurrentValue;
		$row['ar_acc'] = $this->ar_acc->CurrentValue;
		$row['npwp'] = $this->npwp->CurrentValue;
		$row['discount'] = $this->discount->CurrentValue;
		$row['freight'] = $this->freight->CurrentValue;
		$row['credit_max'] = $this->credit_max->CurrentValue;
		$row['invoice_max'] = $this->invoice_max->CurrentValue;
		$row['saldo_awal'] = $this->saldo_awal->CurrentValue;
		$row['curency'] = $this->curency->CurrentValue;
		$row['kode_depo'] = $this->kode_depo->CurrentValue;
		$row['tax'] = $this->tax->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->customer_id->DbValue = $row['customer_id'];
		$this->customer_code->DbValue = $row['customer_code'];
		$this->customer_group->DbValue = $row['customer_group'];
		$this->customer_name->DbValue = $row['customer_name'];
		$this->contact_name->DbValue = $row['contact_name'];
		$this->address1->DbValue = $row['address1'];
		$this->address2->DbValue = $row['address2'];
		$this->address3->DbValue = $row['address3'];
		$this->phone->DbValue = $row['phone'];
		$this->fax->DbValue = $row['fax'];
		$this->wilayah_id->DbValue = $row['wilayah_id'];
		$this->subwil_id->DbValue = $row['subwil_id'];
		$this->area_id->DbValue = $row['area_id'];
		$this->sales_id->DbValue = $row['sales_id'];
		$this->due_day->DbValue = $row['due_day'];
		$this->ar_acc->DbValue = $row['ar_acc'];
		$this->npwp->DbValue = $row['npwp'];
		$this->discount->DbValue = $row['discount'];
		$this->freight->DbValue = $row['freight'];
		$this->credit_max->DbValue = $row['credit_max'];
		$this->invoice_max->DbValue = $row['invoice_max'];
		$this->saldo_awal->DbValue = $row['saldo_awal'];
		$this->curency->DbValue = $row['curency'];
		$this->kode_depo->DbValue = $row['kode_depo'];
		$this->tax->DbValue = $row['tax'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("customer_id")) <> "")
			$this->customer_id->CurrentValue = $this->getKey("customer_id"); // customer_id
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

		// Convert decimal values if posted back
		if ($this->credit_max->FormValue == $this->credit_max->CurrentValue && is_numeric(ew_StrToFloat($this->credit_max->CurrentValue)))
			$this->credit_max->CurrentValue = ew_StrToFloat($this->credit_max->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// customer_id
		// customer_code
		// customer_group
		// customer_name
		// contact_name
		// address1
		// address2
		// address3
		// phone
		// fax
		// wilayah_id
		// subwil_id
		// area_id
		// sales_id
		// due_day
		// ar_acc
		// npwp
		// discount
		// freight
		// credit_max
		// invoice_max
		// saldo_awal
		// curency
		// kode_depo
		// tax

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// customer_id
		$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
		$this->customer_id->ViewCustomAttributes = "";

		// customer_code
		$this->customer_code->ViewValue = $this->customer_code->CurrentValue;
		$this->customer_code->ViewCustomAttributes = "";

		// customer_group
		if (strval($this->customer_group->CurrentValue) <> "") {
			$this->customer_group->ViewValue = $this->customer_group->OptionCaption($this->customer_group->CurrentValue);
		} else {
			$this->customer_group->ViewValue = NULL;
		}
		$this->customer_group->ViewCustomAttributes = "";

		// customer_name
		$this->customer_name->ViewValue = $this->customer_name->CurrentValue;
		$this->customer_name->ViewCustomAttributes = "";

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

		// wilayah_id
		if (strval($this->wilayah_id->CurrentValue) <> "") {
			$sFilterWrk = "`wilayah_id`" . ew_SearchString("=", $this->wilayah_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `wilayah_id`, `nama_wilayah` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_wilayah`";
		$sWhereWrk = "";
		$this->wilayah_id->LookupFilters = array();
		$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->wilayah_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->wilayah_id->ViewValue = $this->wilayah_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->wilayah_id->ViewValue = $this->wilayah_id->CurrentValue;
			}
		} else {
			$this->wilayah_id->ViewValue = NULL;
		}
		$this->wilayah_id->ViewCustomAttributes = "";

		// subwil_id
		if (strval($this->subwil_id->CurrentValue) <> "") {
			$sFilterWrk = "`sub_id`" . ew_SearchString("=", $this->subwil_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `sub_id`, `nama_sub_wilayah` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_subwilayah`";
		$sWhereWrk = "";
		$this->subwil_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->subwil_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `nama_sub_wilayah`";
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->subwil_id->ViewValue = $this->subwil_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->subwil_id->ViewValue = $this->subwil_id->CurrentValue;
			}
		} else {
			$this->subwil_id->ViewValue = NULL;
		}
		$this->subwil_id->ViewCustomAttributes = "";

		// area_id
		if (strval($this->area_id->CurrentValue) <> "") {
			$sFilterWrk = "`area_id`" . ew_SearchString("=", $this->area_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `area_id`, `area_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_callarea`";
		$sWhereWrk = "";
		$this->area_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->area_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `area_name`";
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->area_id->ViewValue = $this->area_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->area_id->ViewValue = $this->area_id->CurrentValue;
			}
		} else {
			$this->area_id->ViewValue = NULL;
		}
		$this->area_id->ViewCustomAttributes = "";

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

		// due_day
		$this->due_day->ViewValue = $this->due_day->CurrentValue;
		$this->due_day->ViewCustomAttributes = "";

		// ar_acc
		$this->ar_acc->ViewValue = $this->ar_acc->CurrentValue;
		$this->ar_acc->ViewCustomAttributes = "";

		// npwp
		$this->npwp->ViewValue = $this->npwp->CurrentValue;
		$this->npwp->ViewCustomAttributes = "";

		// discount
		$this->discount->ViewValue = $this->discount->CurrentValue;
		$this->discount->ViewCustomAttributes = "";

		// freight
		$this->freight->ViewValue = $this->freight->CurrentValue;
		$this->freight->ViewCustomAttributes = "";

		// credit_max
		$this->credit_max->ViewValue = $this->credit_max->CurrentValue;
		$this->credit_max->ViewCustomAttributes = "";

		// invoice_max
		$this->invoice_max->ViewValue = $this->invoice_max->CurrentValue;
		$this->invoice_max->ViewCustomAttributes = "";

		// saldo_awal
		$this->saldo_awal->ViewValue = $this->saldo_awal->CurrentValue;
		$this->saldo_awal->ViewCustomAttributes = "";

		// curency
		$this->curency->ViewValue = $this->curency->CurrentValue;
		$this->curency->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

			// customer_code
			$this->customer_code->LinkCustomAttributes = "";
			$this->customer_code->HrefValue = "";
			$this->customer_code->TooltipValue = "";

			// customer_group
			$this->customer_group->LinkCustomAttributes = "";
			$this->customer_group->HrefValue = "";
			$this->customer_group->TooltipValue = "";

			// customer_name
			$this->customer_name->LinkCustomAttributes = "";
			$this->customer_name->HrefValue = "";
			$this->customer_name->TooltipValue = "";

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

			// wilayah_id
			$this->wilayah_id->LinkCustomAttributes = "";
			$this->wilayah_id->HrefValue = "";
			$this->wilayah_id->TooltipValue = "";

			// subwil_id
			$this->subwil_id->LinkCustomAttributes = "";
			$this->subwil_id->HrefValue = "";
			$this->subwil_id->TooltipValue = "";

			// area_id
			$this->area_id->LinkCustomAttributes = "";
			$this->area_id->HrefValue = "";
			$this->area_id->TooltipValue = "";

			// sales_id
			$this->sales_id->LinkCustomAttributes = "";
			$this->sales_id->HrefValue = "";
			$this->sales_id->TooltipValue = "";

			// due_day
			$this->due_day->LinkCustomAttributes = "";
			$this->due_day->HrefValue = "";
			$this->due_day->TooltipValue = "";

			// ar_acc
			$this->ar_acc->LinkCustomAttributes = "";
			$this->ar_acc->HrefValue = "";
			$this->ar_acc->TooltipValue = "";

			// npwp
			$this->npwp->LinkCustomAttributes = "";
			$this->npwp->HrefValue = "";
			$this->npwp->TooltipValue = "";

			// discount
			$this->discount->LinkCustomAttributes = "";
			$this->discount->HrefValue = "";
			$this->discount->TooltipValue = "";

			// credit_max
			$this->credit_max->LinkCustomAttributes = "";
			$this->credit_max->HrefValue = "";
			$this->credit_max->TooltipValue = "";

			// invoice_max
			$this->invoice_max->LinkCustomAttributes = "";
			$this->invoice_max->HrefValue = "";
			$this->invoice_max->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// customer_code
			$this->customer_code->EditAttrs["class"] = "form-control";
			$this->customer_code->EditCustomAttributes = "";
			$this->customer_code->EditValue = ew_HtmlEncode($this->customer_code->CurrentValue);
			$this->customer_code->PlaceHolder = ew_RemoveHtml($this->customer_code->FldCaption());

			// customer_group
			$this->customer_group->EditCustomAttributes = "";
			$this->customer_group->EditValue = $this->customer_group->Options(TRUE);

			// customer_name
			$this->customer_name->EditAttrs["class"] = "form-control";
			$this->customer_name->EditCustomAttributes = "";
			$this->customer_name->EditValue = ew_HtmlEncode($this->customer_name->CurrentValue);
			$this->customer_name->PlaceHolder = ew_RemoveHtml($this->customer_name->FldCaption());

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

			// wilayah_id
			$this->wilayah_id->EditCustomAttributes = "";
			if (trim(strval($this->wilayah_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`wilayah_id`" . ew_SearchString("=", $this->wilayah_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
			}
			$sSqlWrk = "SELECT `wilayah_id`, `nama_wilayah` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tbl_wilayah`";
			$sWhereWrk = "";
			$this->wilayah_id->LookupFilters = array();
			$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->wilayah_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->wilayah_id->ViewValue = $this->wilayah_id->DisplayValue($arwrk);
			} else {
				$this->wilayah_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->wilayah_id->EditValue = $arwrk;

			// subwil_id
			$this->subwil_id->EditCustomAttributes = "";
			if (trim(strval($this->subwil_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`sub_id`" . ew_SearchString("=", $this->subwil_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
			}
			$sSqlWrk = "SELECT `sub_id`, `nama_sub_wilayah` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `wilayah_id` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tbl_subwilayah`";
			$sWhereWrk = "";
			$this->subwil_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->subwil_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nama_sub_wilayah`";
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->subwil_id->ViewValue = $this->subwil_id->DisplayValue($arwrk);
			} else {
				$this->subwil_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->subwil_id->EditValue = $arwrk;

			// area_id
			$this->area_id->EditCustomAttributes = "";
			if (trim(strval($this->area_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`area_id`" . ew_SearchString("=", $this->area_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
			}
			$sSqlWrk = "SELECT `area_id`, `area_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `subwil_id` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tbl_callarea`";
			$sWhereWrk = "";
			$this->area_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->area_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `area_name`";
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->area_id->ViewValue = $this->area_id->DisplayValue($arwrk);
			} else {
				$this->area_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->area_id->EditValue = $arwrk;

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

			// due_day
			$this->due_day->EditAttrs["class"] = "form-control";
			$this->due_day->EditCustomAttributes = "";
			$this->due_day->EditValue = ew_HtmlEncode($this->due_day->CurrentValue);
			$this->due_day->PlaceHolder = ew_RemoveHtml($this->due_day->FldCaption());

			// ar_acc
			$this->ar_acc->EditAttrs["class"] = "form-control";
			$this->ar_acc->EditCustomAttributes = "";
			$this->ar_acc->EditValue = ew_HtmlEncode($this->ar_acc->CurrentValue);
			$this->ar_acc->PlaceHolder = ew_RemoveHtml($this->ar_acc->FldCaption());

			// npwp
			$this->npwp->EditAttrs["class"] = "form-control";
			$this->npwp->EditCustomAttributes = "";
			$this->npwp->EditValue = ew_HtmlEncode($this->npwp->CurrentValue);
			$this->npwp->PlaceHolder = ew_RemoveHtml($this->npwp->FldCaption());

			// discount
			$this->discount->EditAttrs["class"] = "form-control";
			$this->discount->EditCustomAttributes = "";
			$this->discount->EditValue = ew_HtmlEncode($this->discount->CurrentValue);
			$this->discount->PlaceHolder = ew_RemoveHtml($this->discount->FldCaption());
			if (strval($this->discount->EditValue) <> "" && is_numeric($this->discount->EditValue)) $this->discount->EditValue = ew_FormatNumber($this->discount->EditValue, -2, -1, -2, 0);

			// credit_max
			$this->credit_max->EditAttrs["class"] = "form-control";
			$this->credit_max->EditCustomAttributes = "";
			$this->credit_max->EditValue = ew_HtmlEncode($this->credit_max->CurrentValue);
			$this->credit_max->PlaceHolder = ew_RemoveHtml($this->credit_max->FldCaption());
			if (strval($this->credit_max->EditValue) <> "" && is_numeric($this->credit_max->EditValue)) $this->credit_max->EditValue = ew_FormatNumber($this->credit_max->EditValue, -2, -1, -2, 0);

			// invoice_max
			$this->invoice_max->EditAttrs["class"] = "form-control";
			$this->invoice_max->EditCustomAttributes = "";
			$this->invoice_max->EditValue = ew_HtmlEncode($this->invoice_max->CurrentValue);
			$this->invoice_max->PlaceHolder = ew_RemoveHtml($this->invoice_max->FldCaption());

			// Add refer script
			// customer_code

			$this->customer_code->LinkCustomAttributes = "";
			$this->customer_code->HrefValue = "";

			// customer_group
			$this->customer_group->LinkCustomAttributes = "";
			$this->customer_group->HrefValue = "";

			// customer_name
			$this->customer_name->LinkCustomAttributes = "";
			$this->customer_name->HrefValue = "";

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

			// wilayah_id
			$this->wilayah_id->LinkCustomAttributes = "";
			$this->wilayah_id->HrefValue = "";

			// subwil_id
			$this->subwil_id->LinkCustomAttributes = "";
			$this->subwil_id->HrefValue = "";

			// area_id
			$this->area_id->LinkCustomAttributes = "";
			$this->area_id->HrefValue = "";

			// sales_id
			$this->sales_id->LinkCustomAttributes = "";
			$this->sales_id->HrefValue = "";

			// due_day
			$this->due_day->LinkCustomAttributes = "";
			$this->due_day->HrefValue = "";

			// ar_acc
			$this->ar_acc->LinkCustomAttributes = "";
			$this->ar_acc->HrefValue = "";

			// npwp
			$this->npwp->LinkCustomAttributes = "";
			$this->npwp->HrefValue = "";

			// discount
			$this->discount->LinkCustomAttributes = "";
			$this->discount->HrefValue = "";

			// credit_max
			$this->credit_max->LinkCustomAttributes = "";
			$this->credit_max->HrefValue = "";

			// invoice_max
			$this->invoice_max->LinkCustomAttributes = "";
			$this->invoice_max->HrefValue = "";
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
		if (!ew_CheckInteger($this->due_day->FormValue)) {
			ew_AddMessage($gsFormError, $this->due_day->FldErrMsg());
		}
		if (!ew_CheckNumber($this->discount->FormValue)) {
			ew_AddMessage($gsFormError, $this->discount->FldErrMsg());
		}
		if (!ew_CheckNumber($this->credit_max->FormValue)) {
			ew_AddMessage($gsFormError, $this->credit_max->FldErrMsg());
		}
		if (!ew_CheckInteger($this->invoice_max->FormValue)) {
			ew_AddMessage($gsFormError, $this->invoice_max->FldErrMsg());
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

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// customer_code
		$this->customer_code->SetDbValueDef($rsnew, $this->customer_code->CurrentValue, NULL, FALSE);

		// customer_group
		$this->customer_group->SetDbValueDef($rsnew, $this->customer_group->CurrentValue, NULL, FALSE);

		// customer_name
		$this->customer_name->SetDbValueDef($rsnew, $this->customer_name->CurrentValue, NULL, FALSE);

		// contact_name
		$this->contact_name->SetDbValueDef($rsnew, $this->contact_name->CurrentValue, NULL, FALSE);

		// address1
		$this->address1->SetDbValueDef($rsnew, $this->address1->CurrentValue, NULL, FALSE);

		// address2
		$this->address2->SetDbValueDef($rsnew, $this->address2->CurrentValue, NULL, FALSE);

		// address3
		$this->address3->SetDbValueDef($rsnew, $this->address3->CurrentValue, NULL, FALSE);

		// phone
		$this->phone->SetDbValueDef($rsnew, $this->phone->CurrentValue, NULL, FALSE);

		// fax
		$this->fax->SetDbValueDef($rsnew, $this->fax->CurrentValue, NULL, FALSE);

		// wilayah_id
		$this->wilayah_id->SetDbValueDef($rsnew, $this->wilayah_id->CurrentValue, NULL, FALSE);

		// subwil_id
		$this->subwil_id->SetDbValueDef($rsnew, $this->subwil_id->CurrentValue, NULL, FALSE);

		// area_id
		$this->area_id->SetDbValueDef($rsnew, $this->area_id->CurrentValue, NULL, FALSE);

		// sales_id
		$this->sales_id->SetDbValueDef($rsnew, $this->sales_id->CurrentValue, NULL, FALSE);

		// due_day
		$this->due_day->SetDbValueDef($rsnew, $this->due_day->CurrentValue, NULL, FALSE);

		// ar_acc
		$this->ar_acc->SetDbValueDef($rsnew, $this->ar_acc->CurrentValue, NULL, FALSE);

		// npwp
		$this->npwp->SetDbValueDef($rsnew, $this->npwp->CurrentValue, NULL, FALSE);

		// discount
		$this->discount->SetDbValueDef($rsnew, $this->discount->CurrentValue, NULL, FALSE);

		// credit_max
		$this->credit_max->SetDbValueDef($rsnew, $this->credit_max->CurrentValue, NULL, FALSE);

		// invoice_max
		$this->invoice_max->SetDbValueDef($rsnew, $this->invoice_max->CurrentValue, NULL, strval($this->invoice_max->CurrentValue) == "");

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
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_customerlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_wilayah_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `wilayah_id` AS `LinkFld`, `nama_wilayah` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_wilayah`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "db_inventory_pusat", "f0" => '`wilayah_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->wilayah_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_subwil_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `sub_id` AS `LinkFld`, `nama_sub_wilayah` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_subwilayah`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "db_inventory_pusat", "f0" => '`sub_id` IN ({filter_value})', "t0" => "3", "fn0" => "", "f1" => '`wilayah_id` IN ({filter_value})', "t1" => "3", "fn1" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->subwil_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nama_sub_wilayah`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_area_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `area_id` AS `LinkFld`, `area_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_callarea`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "db_inventory_pusat", "f0" => '`area_id` IN ({filter_value})', "t0" => "3", "fn0" => "", "f1" => '`subwil_id` IN ({filter_value})', "t1" => "3", "fn1" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->area_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `area_name`";
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
if (!isset($tbl_customer_add)) $tbl_customer_add = new ctbl_customer_add();

// Page init
$tbl_customer_add->Page_Init();

// Page main
$tbl_customer_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_customer_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ftbl_customeradd = new ew_Form("ftbl_customeradd", "add");

// Validate form
ftbl_customeradd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_due_day");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_customer->due_day->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_discount");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_customer->discount->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_credit_max");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_customer->credit_max->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_invoice_max");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_customer->invoice_max->FldErrMsg()) ?>");

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
ftbl_customeradd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_customeradd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_customeradd.Lists["x_customer_group"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftbl_customeradd.Lists["x_customer_group"].Options = <?php echo json_encode($tbl_customer_add->customer_group->Options()) ?>;
ftbl_customeradd.Lists["x_wilayah_id"] = {"LinkField":"x_wilayah_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nama_wilayah","","",""],"ParentFields":[],"ChildFields":["x_subwil_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_wilayah"};
ftbl_customeradd.Lists["x_wilayah_id"].Data = "<?php echo $tbl_customer_add->wilayah_id->LookupFilterQuery(FALSE, "add") ?>";
ftbl_customeradd.Lists["x_subwil_id"] = {"LinkField":"x_sub_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nama_sub_wilayah","","",""],"ParentFields":["x_wilayah_id"],"ChildFields":["x_area_id"],"FilterFields":["x_wilayah_id"],"Options":[],"Template":"","LinkTable":"tbl_subwilayah"};
ftbl_customeradd.Lists["x_subwil_id"].Data = "<?php echo $tbl_customer_add->subwil_id->LookupFilterQuery(FALSE, "add") ?>";
ftbl_customeradd.Lists["x_area_id"] = {"LinkField":"x_area_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_area_name","","",""],"ParentFields":["x_subwil_id"],"ChildFields":[],"FilterFields":["x_subwil_id"],"Options":[],"Template":"","LinkTable":"tbl_callarea"};
ftbl_customeradd.Lists["x_area_id"].Data = "<?php echo $tbl_customer_add->area_id->LookupFilterQuery(FALSE, "add") ?>";
ftbl_customeradd.Lists["x_sales_id"] = {"LinkField":"x_sales_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_sales_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_salesman"};
ftbl_customeradd.Lists["x_sales_id"].Data = "<?php echo $tbl_customer_add->sales_id->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_customer_add->ShowPageHeader(); ?>
<?php
$tbl_customer_add->ShowMessage();
?>
<form name="ftbl_customeradd" id="ftbl_customeradd" class="<?php echo $tbl_customer_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_customer_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_customer_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_customer">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($tbl_customer_add->IsModal) ?>">
<?php if (!$tbl_customer_add->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
<div class="ewAddDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_tbl_customeradd" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($tbl_customer->customer_code->Visible) { // customer_code ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_customer_code" class="form-group">
		<label id="elh_tbl_customer_customer_code" for="x_customer_code" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->customer_code->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->customer_code->CellAttributes() ?>>
<span id="el_tbl_customer_customer_code">
<input type="text" data-table="tbl_customer" data-field="x_customer_code" name="x_customer_code" id="x_customer_code" size="15" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_customer->customer_code->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->customer_code->EditValue ?>"<?php echo $tbl_customer->customer_code->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->customer_code->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_customer_code">
		<td class="col-sm-2"><span id="elh_tbl_customer_customer_code"><?php echo $tbl_customer->customer_code->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->customer_code->CellAttributes() ?>>
<span id="el_tbl_customer_customer_code">
<input type="text" data-table="tbl_customer" data-field="x_customer_code" name="x_customer_code" id="x_customer_code" size="15" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_customer->customer_code->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->customer_code->EditValue ?>"<?php echo $tbl_customer->customer_code->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->customer_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->customer_group->Visible) { // customer_group ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_customer_group" class="form-group">
		<label id="elh_tbl_customer_customer_group" for="x_customer_group" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->customer_group->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->customer_group->CellAttributes() ?>>
<span id="el_tbl_customer_customer_group">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_customer->customer_group->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_customer->customer_group->ViewValue ?>
	</span>
	<?php if (!$tbl_customer->customer_group->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_customer_group" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_customer->customer_group->RadioButtonListHtml(TRUE, "x_customer_group") ?>
		</div>
	</div>
	<div id="tp_x_customer_group" class="ewTemplate"><input type="radio" data-table="tbl_customer" data-field="x_customer_group" data-value-separator="<?php echo $tbl_customer->customer_group->DisplayValueSeparatorAttribute() ?>" name="x_customer_group" id="x_customer_group" value="{value}"<?php echo $tbl_customer->customer_group->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_customer->customer_group->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_customer_group">
		<td class="col-sm-2"><span id="elh_tbl_customer_customer_group"><?php echo $tbl_customer->customer_group->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->customer_group->CellAttributes() ?>>
<span id="el_tbl_customer_customer_group">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_customer->customer_group->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_customer->customer_group->ViewValue ?>
	</span>
	<?php if (!$tbl_customer->customer_group->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_customer_group" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_customer->customer_group->RadioButtonListHtml(TRUE, "x_customer_group") ?>
		</div>
	</div>
	<div id="tp_x_customer_group" class="ewTemplate"><input type="radio" data-table="tbl_customer" data-field="x_customer_group" data-value-separator="<?php echo $tbl_customer->customer_group->DisplayValueSeparatorAttribute() ?>" name="x_customer_group" id="x_customer_group" value="{value}"<?php echo $tbl_customer->customer_group->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_customer->customer_group->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->customer_name->Visible) { // customer_name ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_customer_name" class="form-group">
		<label id="elh_tbl_customer_customer_name" for="x_customer_name" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->customer_name->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->customer_name->CellAttributes() ?>>
<span id="el_tbl_customer_customer_name">
<input type="text" data-table="tbl_customer" data-field="x_customer_name" name="x_customer_name" id="x_customer_name" size="50" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_customer->customer_name->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->customer_name->EditValue ?>"<?php echo $tbl_customer->customer_name->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->customer_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_customer_name">
		<td class="col-sm-2"><span id="elh_tbl_customer_customer_name"><?php echo $tbl_customer->customer_name->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->customer_name->CellAttributes() ?>>
<span id="el_tbl_customer_customer_name">
<input type="text" data-table="tbl_customer" data-field="x_customer_name" name="x_customer_name" id="x_customer_name" size="50" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_customer->customer_name->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->customer_name->EditValue ?>"<?php echo $tbl_customer->customer_name->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->customer_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->contact_name->Visible) { // contact_name ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_contact_name" class="form-group">
		<label id="elh_tbl_customer_contact_name" for="x_contact_name" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->contact_name->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->contact_name->CellAttributes() ?>>
<span id="el_tbl_customer_contact_name">
<input type="text" data-table="tbl_customer" data-field="x_contact_name" name="x_contact_name" id="x_contact_name" size="50" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_customer->contact_name->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->contact_name->EditValue ?>"<?php echo $tbl_customer->contact_name->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->contact_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_contact_name">
		<td class="col-sm-2"><span id="elh_tbl_customer_contact_name"><?php echo $tbl_customer->contact_name->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->contact_name->CellAttributes() ?>>
<span id="el_tbl_customer_contact_name">
<input type="text" data-table="tbl_customer" data-field="x_contact_name" name="x_contact_name" id="x_contact_name" size="50" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_customer->contact_name->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->contact_name->EditValue ?>"<?php echo $tbl_customer->contact_name->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->contact_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->address1->Visible) { // address1 ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_address1" class="form-group">
		<label id="elh_tbl_customer_address1" for="x_address1" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->address1->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->address1->CellAttributes() ?>>
<span id="el_tbl_customer_address1">
<input type="text" data-table="tbl_customer" data-field="x_address1" name="x_address1" id="x_address1" size="75" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_customer->address1->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->address1->EditValue ?>"<?php echo $tbl_customer->address1->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->address1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address1">
		<td class="col-sm-2"><span id="elh_tbl_customer_address1"><?php echo $tbl_customer->address1->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->address1->CellAttributes() ?>>
<span id="el_tbl_customer_address1">
<input type="text" data-table="tbl_customer" data-field="x_address1" name="x_address1" id="x_address1" size="75" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_customer->address1->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->address1->EditValue ?>"<?php echo $tbl_customer->address1->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->address1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->address2->Visible) { // address2 ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_address2" class="form-group">
		<label id="elh_tbl_customer_address2" for="x_address2" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->address2->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->address2->CellAttributes() ?>>
<span id="el_tbl_customer_address2">
<input type="text" data-table="tbl_customer" data-field="x_address2" name="x_address2" id="x_address2" size="75" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_customer->address2->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->address2->EditValue ?>"<?php echo $tbl_customer->address2->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->address2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address2">
		<td class="col-sm-2"><span id="elh_tbl_customer_address2"><?php echo $tbl_customer->address2->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->address2->CellAttributes() ?>>
<span id="el_tbl_customer_address2">
<input type="text" data-table="tbl_customer" data-field="x_address2" name="x_address2" id="x_address2" size="75" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_customer->address2->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->address2->EditValue ?>"<?php echo $tbl_customer->address2->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->address2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->address3->Visible) { // address3 ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_address3" class="form-group">
		<label id="elh_tbl_customer_address3" for="x_address3" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->address3->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->address3->CellAttributes() ?>>
<span id="el_tbl_customer_address3">
<input type="text" data-table="tbl_customer" data-field="x_address3" name="x_address3" id="x_address3" size="50" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_customer->address3->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->address3->EditValue ?>"<?php echo $tbl_customer->address3->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->address3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address3">
		<td class="col-sm-2"><span id="elh_tbl_customer_address3"><?php echo $tbl_customer->address3->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->address3->CellAttributes() ?>>
<span id="el_tbl_customer_address3">
<input type="text" data-table="tbl_customer" data-field="x_address3" name="x_address3" id="x_address3" size="50" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_customer->address3->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->address3->EditValue ?>"<?php echo $tbl_customer->address3->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->address3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->phone->Visible) { // phone ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_phone" class="form-group">
		<label id="elh_tbl_customer_phone" for="x_phone" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->phone->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->phone->CellAttributes() ?>>
<span id="el_tbl_customer_phone">
<input type="text" data-table="tbl_customer" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_customer->phone->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->phone->EditValue ?>"<?php echo $tbl_customer->phone->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->phone->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_phone">
		<td class="col-sm-2"><span id="elh_tbl_customer_phone"><?php echo $tbl_customer->phone->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->phone->CellAttributes() ?>>
<span id="el_tbl_customer_phone">
<input type="text" data-table="tbl_customer" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_customer->phone->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->phone->EditValue ?>"<?php echo $tbl_customer->phone->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->fax->Visible) { // fax ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_fax" class="form-group">
		<label id="elh_tbl_customer_fax" for="x_fax" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->fax->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->fax->CellAttributes() ?>>
<span id="el_tbl_customer_fax">
<input type="text" data-table="tbl_customer" data-field="x_fax" name="x_fax" id="x_fax" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_customer->fax->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->fax->EditValue ?>"<?php echo $tbl_customer->fax->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->fax->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_fax">
		<td class="col-sm-2"><span id="elh_tbl_customer_fax"><?php echo $tbl_customer->fax->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->fax->CellAttributes() ?>>
<span id="el_tbl_customer_fax">
<input type="text" data-table="tbl_customer" data-field="x_fax" name="x_fax" id="x_fax" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_customer->fax->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->fax->EditValue ?>"<?php echo $tbl_customer->fax->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->fax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->wilayah_id->Visible) { // wilayah_id ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_wilayah_id" class="form-group">
		<label id="elh_tbl_customer_wilayah_id" for="x_wilayah_id" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->wilayah_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->wilayah_id->CellAttributes() ?>>
<span id="el_tbl_customer_wilayah_id">
<?php $tbl_customer->wilayah_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tbl_customer->wilayah_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_customer->wilayah_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_customer->wilayah_id->ViewValue ?>
	</span>
	<?php if (!$tbl_customer->wilayah_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_wilayah_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_customer->wilayah_id->RadioButtonListHtml(TRUE, "x_wilayah_id") ?>
		</div>
	</div>
	<div id="tp_x_wilayah_id" class="ewTemplate"><input type="radio" data-table="tbl_customer" data-field="x_wilayah_id" data-value-separator="<?php echo $tbl_customer->wilayah_id->DisplayValueSeparatorAttribute() ?>" name="x_wilayah_id" id="x_wilayah_id" value="{value}"<?php echo $tbl_customer->wilayah_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_customer->wilayah_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_wilayah_id">
		<td class="col-sm-2"><span id="elh_tbl_customer_wilayah_id"><?php echo $tbl_customer->wilayah_id->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->wilayah_id->CellAttributes() ?>>
<span id="el_tbl_customer_wilayah_id">
<?php $tbl_customer->wilayah_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tbl_customer->wilayah_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_customer->wilayah_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_customer->wilayah_id->ViewValue ?>
	</span>
	<?php if (!$tbl_customer->wilayah_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_wilayah_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_customer->wilayah_id->RadioButtonListHtml(TRUE, "x_wilayah_id") ?>
		</div>
	</div>
	<div id="tp_x_wilayah_id" class="ewTemplate"><input type="radio" data-table="tbl_customer" data-field="x_wilayah_id" data-value-separator="<?php echo $tbl_customer->wilayah_id->DisplayValueSeparatorAttribute() ?>" name="x_wilayah_id" id="x_wilayah_id" value="{value}"<?php echo $tbl_customer->wilayah_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_customer->wilayah_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->subwil_id->Visible) { // subwil_id ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_subwil_id" class="form-group">
		<label id="elh_tbl_customer_subwil_id" for="x_subwil_id" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->subwil_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->subwil_id->CellAttributes() ?>>
<span id="el_tbl_customer_subwil_id">
<?php $tbl_customer->subwil_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tbl_customer->subwil_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_customer->subwil_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_customer->subwil_id->ViewValue ?>
	</span>
	<?php if (!$tbl_customer->subwil_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_subwil_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_customer->subwil_id->RadioButtonListHtml(TRUE, "x_subwil_id") ?>
		</div>
	</div>
	<div id="tp_x_subwil_id" class="ewTemplate"><input type="radio" data-table="tbl_customer" data-field="x_subwil_id" data-value-separator="<?php echo $tbl_customer->subwil_id->DisplayValueSeparatorAttribute() ?>" name="x_subwil_id" id="x_subwil_id" value="{value}"<?php echo $tbl_customer->subwil_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_customer->subwil_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_subwil_id">
		<td class="col-sm-2"><span id="elh_tbl_customer_subwil_id"><?php echo $tbl_customer->subwil_id->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->subwil_id->CellAttributes() ?>>
<span id="el_tbl_customer_subwil_id">
<?php $tbl_customer->subwil_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tbl_customer->subwil_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_customer->subwil_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_customer->subwil_id->ViewValue ?>
	</span>
	<?php if (!$tbl_customer->subwil_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_subwil_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_customer->subwil_id->RadioButtonListHtml(TRUE, "x_subwil_id") ?>
		</div>
	</div>
	<div id="tp_x_subwil_id" class="ewTemplate"><input type="radio" data-table="tbl_customer" data-field="x_subwil_id" data-value-separator="<?php echo $tbl_customer->subwil_id->DisplayValueSeparatorAttribute() ?>" name="x_subwil_id" id="x_subwil_id" value="{value}"<?php echo $tbl_customer->subwil_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_customer->subwil_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->area_id->Visible) { // area_id ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_area_id" class="form-group">
		<label id="elh_tbl_customer_area_id" for="x_area_id" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->area_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->area_id->CellAttributes() ?>>
<span id="el_tbl_customer_area_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_customer->area_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_customer->area_id->ViewValue ?>
	</span>
	<?php if (!$tbl_customer->area_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_area_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_customer->area_id->RadioButtonListHtml(TRUE, "x_area_id") ?>
		</div>
	</div>
	<div id="tp_x_area_id" class="ewTemplate"><input type="radio" data-table="tbl_customer" data-field="x_area_id" data-value-separator="<?php echo $tbl_customer->area_id->DisplayValueSeparatorAttribute() ?>" name="x_area_id" id="x_area_id" value="{value}"<?php echo $tbl_customer->area_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_customer->area_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_area_id">
		<td class="col-sm-2"><span id="elh_tbl_customer_area_id"><?php echo $tbl_customer->area_id->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->area_id->CellAttributes() ?>>
<span id="el_tbl_customer_area_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_customer->area_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_customer->area_id->ViewValue ?>
	</span>
	<?php if (!$tbl_customer->area_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_area_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_customer->area_id->RadioButtonListHtml(TRUE, "x_area_id") ?>
		</div>
	</div>
	<div id="tp_x_area_id" class="ewTemplate"><input type="radio" data-table="tbl_customer" data-field="x_area_id" data-value-separator="<?php echo $tbl_customer->area_id->DisplayValueSeparatorAttribute() ?>" name="x_area_id" id="x_area_id" value="{value}"<?php echo $tbl_customer->area_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_customer->area_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->sales_id->Visible) { // sales_id ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_sales_id" class="form-group">
		<label id="elh_tbl_customer_sales_id" for="x_sales_id" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->sales_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->sales_id->CellAttributes() ?>>
<span id="el_tbl_customer_sales_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_customer->sales_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_customer->sales_id->ViewValue ?>
	</span>
	<?php if (!$tbl_customer->sales_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_sales_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_customer->sales_id->RadioButtonListHtml(TRUE, "x_sales_id") ?>
		</div>
	</div>
	<div id="tp_x_sales_id" class="ewTemplate"><input type="radio" data-table="tbl_customer" data-field="x_sales_id" data-value-separator="<?php echo $tbl_customer->sales_id->DisplayValueSeparatorAttribute() ?>" name="x_sales_id" id="x_sales_id" value="{value}"<?php echo $tbl_customer->sales_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_customer->sales_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sales_id">
		<td class="col-sm-2"><span id="elh_tbl_customer_sales_id"><?php echo $tbl_customer->sales_id->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->sales_id->CellAttributes() ?>>
<span id="el_tbl_customer_sales_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_customer->sales_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_customer->sales_id->ViewValue ?>
	</span>
	<?php if (!$tbl_customer->sales_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_sales_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_customer->sales_id->RadioButtonListHtml(TRUE, "x_sales_id") ?>
		</div>
	</div>
	<div id="tp_x_sales_id" class="ewTemplate"><input type="radio" data-table="tbl_customer" data-field="x_sales_id" data-value-separator="<?php echo $tbl_customer->sales_id->DisplayValueSeparatorAttribute() ?>" name="x_sales_id" id="x_sales_id" value="{value}"<?php echo $tbl_customer->sales_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_customer->sales_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->due_day->Visible) { // due_day ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_due_day" class="form-group">
		<label id="elh_tbl_customer_due_day" for="x_due_day" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->due_day->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->due_day->CellAttributes() ?>>
<span id="el_tbl_customer_due_day">
<input type="text" data-table="tbl_customer" data-field="x_due_day" name="x_due_day" id="x_due_day" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_customer->due_day->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->due_day->EditValue ?>"<?php echo $tbl_customer->due_day->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->due_day->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_due_day">
		<td class="col-sm-2"><span id="elh_tbl_customer_due_day"><?php echo $tbl_customer->due_day->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->due_day->CellAttributes() ?>>
<span id="el_tbl_customer_due_day">
<input type="text" data-table="tbl_customer" data-field="x_due_day" name="x_due_day" id="x_due_day" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_customer->due_day->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->due_day->EditValue ?>"<?php echo $tbl_customer->due_day->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->due_day->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->ar_acc->Visible) { // ar_acc ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_ar_acc" class="form-group">
		<label id="elh_tbl_customer_ar_acc" for="x_ar_acc" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->ar_acc->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->ar_acc->CellAttributes() ?>>
<span id="el_tbl_customer_ar_acc">
<input type="text" data-table="tbl_customer" data-field="x_ar_acc" name="x_ar_acc" id="x_ar_acc" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_customer->ar_acc->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->ar_acc->EditValue ?>"<?php echo $tbl_customer->ar_acc->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->ar_acc->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ar_acc">
		<td class="col-sm-2"><span id="elh_tbl_customer_ar_acc"><?php echo $tbl_customer->ar_acc->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->ar_acc->CellAttributes() ?>>
<span id="el_tbl_customer_ar_acc">
<input type="text" data-table="tbl_customer" data-field="x_ar_acc" name="x_ar_acc" id="x_ar_acc" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_customer->ar_acc->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->ar_acc->EditValue ?>"<?php echo $tbl_customer->ar_acc->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->ar_acc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->npwp->Visible) { // npwp ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_npwp" class="form-group">
		<label id="elh_tbl_customer_npwp" for="x_npwp" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->npwp->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->npwp->CellAttributes() ?>>
<span id="el_tbl_customer_npwp">
<input type="text" data-table="tbl_customer" data-field="x_npwp" name="x_npwp" id="x_npwp" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($tbl_customer->npwp->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->npwp->EditValue ?>"<?php echo $tbl_customer->npwp->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->npwp->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_npwp">
		<td class="col-sm-2"><span id="elh_tbl_customer_npwp"><?php echo $tbl_customer->npwp->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->npwp->CellAttributes() ?>>
<span id="el_tbl_customer_npwp">
<input type="text" data-table="tbl_customer" data-field="x_npwp" name="x_npwp" id="x_npwp" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($tbl_customer->npwp->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->npwp->EditValue ?>"<?php echo $tbl_customer->npwp->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->npwp->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->discount->Visible) { // discount ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_discount" class="form-group">
		<label id="elh_tbl_customer_discount" for="x_discount" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->discount->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->discount->CellAttributes() ?>>
<span id="el_tbl_customer_discount">
<input type="text" data-table="tbl_customer" data-field="x_discount" name="x_discount" id="x_discount" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_customer->discount->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->discount->EditValue ?>"<?php echo $tbl_customer->discount->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->discount->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_discount">
		<td class="col-sm-2"><span id="elh_tbl_customer_discount"><?php echo $tbl_customer->discount->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->discount->CellAttributes() ?>>
<span id="el_tbl_customer_discount">
<input type="text" data-table="tbl_customer" data-field="x_discount" name="x_discount" id="x_discount" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_customer->discount->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->discount->EditValue ?>"<?php echo $tbl_customer->discount->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->discount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->credit_max->Visible) { // credit_max ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_credit_max" class="form-group">
		<label id="elh_tbl_customer_credit_max" for="x_credit_max" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->credit_max->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->credit_max->CellAttributes() ?>>
<span id="el_tbl_customer_credit_max">
<input type="text" data-table="tbl_customer" data-field="x_credit_max" name="x_credit_max" id="x_credit_max" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_customer->credit_max->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->credit_max->EditValue ?>"<?php echo $tbl_customer->credit_max->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->credit_max->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_credit_max">
		<td class="col-sm-2"><span id="elh_tbl_customer_credit_max"><?php echo $tbl_customer->credit_max->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->credit_max->CellAttributes() ?>>
<span id="el_tbl_customer_credit_max">
<input type="text" data-table="tbl_customer" data-field="x_credit_max" name="x_credit_max" id="x_credit_max" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_customer->credit_max->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->credit_max->EditValue ?>"<?php echo $tbl_customer->credit_max->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->credit_max->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer->invoice_max->Visible) { // invoice_max ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
	<div id="r_invoice_max" class="form-group">
		<label id="elh_tbl_customer_invoice_max" for="x_invoice_max" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->invoice_max->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->invoice_max->CellAttributes() ?>>
<span id="el_tbl_customer_invoice_max">
<input type="text" data-table="tbl_customer" data-field="x_invoice_max" name="x_invoice_max" id="x_invoice_max" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_customer->invoice_max->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->invoice_max->EditValue ?>"<?php echo $tbl_customer->invoice_max->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->invoice_max->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_invoice_max">
		<td class="col-sm-2"><span id="elh_tbl_customer_invoice_max"><?php echo $tbl_customer->invoice_max->FldCaption() ?></span></td>
		<td<?php echo $tbl_customer->invoice_max->CellAttributes() ?>>
<span id="el_tbl_customer_invoice_max">
<input type="text" data-table="tbl_customer" data-field="x_invoice_max" name="x_invoice_max" id="x_invoice_max" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_customer->invoice_max->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->invoice_max->EditValue ?>"<?php echo $tbl_customer->invoice_max->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->invoice_max->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_customer_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$tbl_customer_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_customer_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_customer_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tbl_customer_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ftbl_customeradd.Init();
</script>
<?php
$tbl_customer_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_customer_add->Page_Terminate();
?>
