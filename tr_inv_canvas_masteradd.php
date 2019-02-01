<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_inv_canvas_masterinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tr_inv_canvas_itemgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_inv_canvas_master_add = NULL; // Initialize page object first

class ctr_inv_canvas_master_add extends ctr_inv_canvas_master {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_inv_canvas_master';

	// Page object name
	var $PageObjName = 'tr_inv_canvas_master_add';

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

		// Table object (tr_inv_canvas_master)
		if (!isset($GLOBALS["tr_inv_canvas_master"]) || get_class($GLOBALS["tr_inv_canvas_master"]) == "ctr_inv_canvas_master") {
			$GLOBALS["tr_inv_canvas_master"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_inv_canvas_master"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_inv_canvas_master', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tr_inv_canvas_masterlist.php"));
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
				if (in_array("tr_inv_canvas_item", $DetailTblVar)) {

					// Process auto fill for detail table 'tr_inv_canvas_item'
					if (preg_match('/^ftr_inv_canvas_item(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["tr_inv_canvas_item_grid"])) $GLOBALS["tr_inv_canvas_item_grid"] = new ctr_inv_canvas_item_grid;
						$GLOBALS["tr_inv_canvas_item_grid"]->Page_Init();
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
		global $EW_EXPORT, $tr_inv_canvas_master;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
			if (is_array(@$_SESSION[EW_SESSION_TEMP_IMAGES])) // Restore temp images
				$gTmpImages = @$_SESSION[EW_SESSION_TEMP_IMAGES];
			if (@$_POST["data"] <> "")
				$sContent = $_POST["data"];
			$gsExportFile = @$_POST["filename"];
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_inv_canvas_master);
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
					if ($pageName == "tr_inv_canvas_masterview.php")
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
			if (@$_GET["inv_id"] != "") {
				$this->inv_id->setQueryStringValue($_GET["inv_id"]);
				$this->setKey("inv_id", $this->inv_id->CurrentValue); // Set up key
			} else {
				$this->setKey("inv_id", ""); // Clear key
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
					$this->Page_Terminate("tr_inv_canvas_masterlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = "tr_inv_canvas_masterlist.php";
					if (ew_GetPageName($sReturnUrl) == "tr_inv_canvas_masterlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "tr_inv_canvas_masterview.php")
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
		$this->inv_id->CurrentValue = NULL;
		$this->inv_id->OldValue = $this->inv_id->CurrentValue;
		$this->inv_number->CurrentValue = NULL;
		$this->inv_number->OldValue = $this->inv_number->CurrentValue;
		$this->inv_date->CurrentValue = ew_CurrentDate();
		$this->tax_type->CurrentValue = 1;
		$this->due_date->CurrentValue = ew_CurrentDate();
		$this->customer_id->CurrentValue = NULL;
		$this->customer_id->OldValue = $this->customer_id->CurrentValue;
		$this->address1->CurrentValue = NULL;
		$this->address1->OldValue = $this->address1->CurrentValue;
		$this->address2->CurrentValue = NULL;
		$this->address2->OldValue = $this->address2->CurrentValue;
		$this->address3->CurrentValue = NULL;
		$this->address3->OldValue = $this->address3->CurrentValue;
		$this->wilayah_id->CurrentValue = NULL;
		$this->wilayah_id->OldValue = $this->wilayah_id->CurrentValue;
		$this->subwil_id->CurrentValue = NULL;
		$this->subwil_id->OldValue = $this->subwil_id->CurrentValue;
		$this->area_id->CurrentValue = NULL;
		$this->area_id->OldValue = $this->area_id->CurrentValue;
		$this->customer_name->CurrentValue = NULL;
		$this->customer_name->OldValue = $this->customer_name->CurrentValue;
		$this->tax_number->CurrentValue = NULL;
		$this->tax_number->OldValue = $this->tax_number->CurrentValue;
		$this->tc_number->CurrentValue = NULL;
		$this->tc_number->OldValue = $this->tc_number->CurrentValue;
		$this->inv_amt->CurrentValue = 0;
		$this->discount->CurrentValue = 0;
		$this->total_discount->CurrentValue = 0;
		$this->is_tax->CurrentValue = 0;
		$this->tax_total->CurrentValue = 0;
		$this->inv_total->CurrentValue = 0;
		$this->paid_amt->CurrentValue = 0;
		$this->sales_id->CurrentValue = NULL;
		$this->sales_id->OldValue = $this->sales_id->CurrentValue;
		$this->paid->CurrentValue = 0;
		$this->user_id->CurrentValue = NULL;
		$this->user_id->OldValue = $this->user_id->CurrentValue;
		$this->lastupdate->CurrentValue = NULL;
		$this->lastupdate->OldValue = $this->lastupdate->CurrentValue;
		$this->kode_depo->CurrentValue = NULL;
		$this->kode_depo->OldValue = $this->kode_depo->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->inv_number->FldIsDetailKey) {
			$this->inv_number->setFormValue($objForm->GetValue("x_inv_number"));
		}
		if (!$this->inv_date->FldIsDetailKey) {
			$this->inv_date->setFormValue($objForm->GetValue("x_inv_date"));
			$this->inv_date->CurrentValue = ew_UnFormatDateTime($this->inv_date->CurrentValue, 7);
		}
		if (!$this->tax_type->FldIsDetailKey) {
			$this->tax_type->setFormValue($objForm->GetValue("x_tax_type"));
		}
		if (!$this->due_date->FldIsDetailKey) {
			$this->due_date->setFormValue($objForm->GetValue("x_due_date"));
			$this->due_date->CurrentValue = ew_UnFormatDateTime($this->due_date->CurrentValue, 7);
		}
		if (!$this->customer_id->FldIsDetailKey) {
			$this->customer_id->setFormValue($objForm->GetValue("x_customer_id"));
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
		if (!$this->wilayah_id->FldIsDetailKey) {
			$this->wilayah_id->setFormValue($objForm->GetValue("x_wilayah_id"));
		}
		if (!$this->subwil_id->FldIsDetailKey) {
			$this->subwil_id->setFormValue($objForm->GetValue("x_subwil_id"));
		}
		if (!$this->area_id->FldIsDetailKey) {
			$this->area_id->setFormValue($objForm->GetValue("x_area_id"));
		}
		if (!$this->customer_name->FldIsDetailKey) {
			$this->customer_name->setFormValue($objForm->GetValue("x_customer_name"));
		}
		if (!$this->tax_number->FldIsDetailKey) {
			$this->tax_number->setFormValue($objForm->GetValue("x_tax_number"));
		}
		if (!$this->tc_number->FldIsDetailKey) {
			$this->tc_number->setFormValue($objForm->GetValue("x_tc_number"));
		}
		if (!$this->inv_amt->FldIsDetailKey) {
			$this->inv_amt->setFormValue($objForm->GetValue("x_inv_amt"));
		}
		if (!$this->total_discount->FldIsDetailKey) {
			$this->total_discount->setFormValue($objForm->GetValue("x_total_discount"));
		}
		if (!$this->is_tax->FldIsDetailKey) {
			$this->is_tax->setFormValue($objForm->GetValue("x_is_tax"));
		}
		if (!$this->tax_total->FldIsDetailKey) {
			$this->tax_total->setFormValue($objForm->GetValue("x_tax_total"));
		}
		if (!$this->inv_total->FldIsDetailKey) {
			$this->inv_total->setFormValue($objForm->GetValue("x_inv_total"));
		}
		if (!$this->paid_amt->FldIsDetailKey) {
			$this->paid_amt->setFormValue($objForm->GetValue("x_paid_amt"));
		}
		if (!$this->sales_id->FldIsDetailKey) {
			$this->sales_id->setFormValue($objForm->GetValue("x_sales_id"));
		}
		if (!$this->paid->FldIsDetailKey) {
			$this->paid->setFormValue($objForm->GetValue("x_paid"));
		}
		if (!$this->user_id->FldIsDetailKey) {
			$this->user_id->setFormValue($objForm->GetValue("x_user_id"));
		}
		if (!$this->lastupdate->FldIsDetailKey) {
			$this->lastupdate->setFormValue($objForm->GetValue("x_lastupdate"));
			$this->lastupdate->CurrentValue = ew_UnFormatDateTime($this->lastupdate->CurrentValue, 0);
		}
		if (!$this->kode_depo->FldIsDetailKey) {
			$this->kode_depo->setFormValue($objForm->GetValue("x_kode_depo"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->inv_number->CurrentValue = $this->inv_number->FormValue;
		$this->inv_date->CurrentValue = $this->inv_date->FormValue;
		$this->inv_date->CurrentValue = ew_UnFormatDateTime($this->inv_date->CurrentValue, 7);
		$this->tax_type->CurrentValue = $this->tax_type->FormValue;
		$this->due_date->CurrentValue = $this->due_date->FormValue;
		$this->due_date->CurrentValue = ew_UnFormatDateTime($this->due_date->CurrentValue, 7);
		$this->customer_id->CurrentValue = $this->customer_id->FormValue;
		$this->address1->CurrentValue = $this->address1->FormValue;
		$this->address2->CurrentValue = $this->address2->FormValue;
		$this->address3->CurrentValue = $this->address3->FormValue;
		$this->wilayah_id->CurrentValue = $this->wilayah_id->FormValue;
		$this->subwil_id->CurrentValue = $this->subwil_id->FormValue;
		$this->area_id->CurrentValue = $this->area_id->FormValue;
		$this->customer_name->CurrentValue = $this->customer_name->FormValue;
		$this->tax_number->CurrentValue = $this->tax_number->FormValue;
		$this->tc_number->CurrentValue = $this->tc_number->FormValue;
		$this->inv_amt->CurrentValue = $this->inv_amt->FormValue;
		$this->total_discount->CurrentValue = $this->total_discount->FormValue;
		$this->is_tax->CurrentValue = $this->is_tax->FormValue;
		$this->tax_total->CurrentValue = $this->tax_total->FormValue;
		$this->inv_total->CurrentValue = $this->inv_total->FormValue;
		$this->paid_amt->CurrentValue = $this->paid_amt->FormValue;
		$this->sales_id->CurrentValue = $this->sales_id->FormValue;
		$this->paid->CurrentValue = $this->paid->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->lastupdate->CurrentValue = $this->lastupdate->FormValue;
		$this->lastupdate->CurrentValue = ew_UnFormatDateTime($this->lastupdate->CurrentValue, 0);
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
		$this->inv_id->setDbValue($row['inv_id']);
		$this->inv_number->setDbValue($row['inv_number']);
		$this->inv_date->setDbValue($row['inv_date']);
		$this->tax_type->setDbValue($row['tax_type']);
		$this->due_date->setDbValue($row['due_date']);
		$this->customer_id->setDbValue($row['customer_id']);
		$this->address1->setDbValue($row['address1']);
		$this->address2->setDbValue($row['address2']);
		$this->address3->setDbValue($row['address3']);
		$this->wilayah_id->setDbValue($row['wilayah_id']);
		$this->subwil_id->setDbValue($row['subwil_id']);
		$this->area_id->setDbValue($row['area_id']);
		$this->customer_name->setDbValue($row['customer_name']);
		$this->tax_number->setDbValue($row['tax_number']);
		$this->tc_number->setDbValue($row['tc_number']);
		$this->inv_amt->setDbValue($row['inv_amt']);
		$this->discount->setDbValue($row['discount']);
		$this->total_discount->setDbValue($row['total_discount']);
		$this->is_tax->setDbValue($row['is_tax']);
		$this->tax_total->setDbValue($row['tax_total']);
		$this->inv_total->setDbValue($row['inv_total']);
		$this->paid_amt->setDbValue($row['paid_amt']);
		$this->sales_id->setDbValue($row['sales_id']);
		$this->paid->setDbValue($row['paid']);
		$this->user_id->setDbValue($row['user_id']);
		$this->lastupdate->setDbValue($row['lastupdate']);
		$this->kode_depo->setDbValue($row['kode_depo']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['inv_id'] = $this->inv_id->CurrentValue;
		$row['inv_number'] = $this->inv_number->CurrentValue;
		$row['inv_date'] = $this->inv_date->CurrentValue;
		$row['tax_type'] = $this->tax_type->CurrentValue;
		$row['due_date'] = $this->due_date->CurrentValue;
		$row['customer_id'] = $this->customer_id->CurrentValue;
		$row['address1'] = $this->address1->CurrentValue;
		$row['address2'] = $this->address2->CurrentValue;
		$row['address3'] = $this->address3->CurrentValue;
		$row['wilayah_id'] = $this->wilayah_id->CurrentValue;
		$row['subwil_id'] = $this->subwil_id->CurrentValue;
		$row['area_id'] = $this->area_id->CurrentValue;
		$row['customer_name'] = $this->customer_name->CurrentValue;
		$row['tax_number'] = $this->tax_number->CurrentValue;
		$row['tc_number'] = $this->tc_number->CurrentValue;
		$row['inv_amt'] = $this->inv_amt->CurrentValue;
		$row['discount'] = $this->discount->CurrentValue;
		$row['total_discount'] = $this->total_discount->CurrentValue;
		$row['is_tax'] = $this->is_tax->CurrentValue;
		$row['tax_total'] = $this->tax_total->CurrentValue;
		$row['inv_total'] = $this->inv_total->CurrentValue;
		$row['paid_amt'] = $this->paid_amt->CurrentValue;
		$row['sales_id'] = $this->sales_id->CurrentValue;
		$row['paid'] = $this->paid->CurrentValue;
		$row['user_id'] = $this->user_id->CurrentValue;
		$row['lastupdate'] = $this->lastupdate->CurrentValue;
		$row['kode_depo'] = $this->kode_depo->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->inv_id->DbValue = $row['inv_id'];
		$this->inv_number->DbValue = $row['inv_number'];
		$this->inv_date->DbValue = $row['inv_date'];
		$this->tax_type->DbValue = $row['tax_type'];
		$this->due_date->DbValue = $row['due_date'];
		$this->customer_id->DbValue = $row['customer_id'];
		$this->address1->DbValue = $row['address1'];
		$this->address2->DbValue = $row['address2'];
		$this->address3->DbValue = $row['address3'];
		$this->wilayah_id->DbValue = $row['wilayah_id'];
		$this->subwil_id->DbValue = $row['subwil_id'];
		$this->area_id->DbValue = $row['area_id'];
		$this->customer_name->DbValue = $row['customer_name'];
		$this->tax_number->DbValue = $row['tax_number'];
		$this->tc_number->DbValue = $row['tc_number'];
		$this->inv_amt->DbValue = $row['inv_amt'];
		$this->discount->DbValue = $row['discount'];
		$this->total_discount->DbValue = $row['total_discount'];
		$this->is_tax->DbValue = $row['is_tax'];
		$this->tax_total->DbValue = $row['tax_total'];
		$this->inv_total->DbValue = $row['inv_total'];
		$this->paid_amt->DbValue = $row['paid_amt'];
		$this->sales_id->DbValue = $row['sales_id'];
		$this->paid->DbValue = $row['paid'];
		$this->user_id->DbValue = $row['user_id'];
		$this->lastupdate->DbValue = $row['lastupdate'];
		$this->kode_depo->DbValue = $row['kode_depo'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("inv_id")) <> "")
			$this->inv_id->CurrentValue = $this->getKey("inv_id"); // inv_id
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
		if ($this->total_discount->FormValue == $this->total_discount->CurrentValue && is_numeric(ew_StrToFloat($this->total_discount->CurrentValue)))
			$this->total_discount->CurrentValue = ew_StrToFloat($this->total_discount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->inv_total->FormValue == $this->inv_total->CurrentValue && is_numeric(ew_StrToFloat($this->inv_total->CurrentValue)))
			$this->inv_total->CurrentValue = ew_StrToFloat($this->inv_total->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// inv_id
		// inv_number
		// inv_date
		// tax_type
		// due_date
		// customer_id
		// address1
		// address2
		// address3
		// wilayah_id
		// subwil_id
		// area_id
		// customer_name
		// tax_number
		// tc_number
		// inv_amt
		// discount
		// total_discount
		// is_tax
		// tax_total
		// inv_total
		// paid_amt
		// sales_id
		// paid
		// user_id
		// lastupdate
		// kode_depo

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// inv_id
		$this->inv_id->ViewValue = $this->inv_id->CurrentValue;
		$this->inv_id->ViewCustomAttributes = "";

		// inv_number
		$this->inv_number->ViewValue = $this->inv_number->CurrentValue;
		$this->inv_number->ViewCustomAttributes = "";

		// inv_date
		$this->inv_date->ViewValue = $this->inv_date->CurrentValue;
		$this->inv_date->ViewValue = ew_FormatDateTime($this->inv_date->ViewValue, 7);
		$this->inv_date->ViewCustomAttributes = "";

		// tax_type
		$this->tax_type->ViewValue = $this->tax_type->CurrentValue;
		$this->tax_type->ViewCustomAttributes = "";

		// due_date
		$this->due_date->ViewValue = $this->due_date->CurrentValue;
		$this->due_date->ViewValue = ew_FormatDateTime($this->due_date->ViewValue, 7);
		$this->due_date->ViewCustomAttributes = "";

		// customer_id
		$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
		if (strval($this->customer_id->CurrentValue) <> "") {
			$sFilterWrk = "`customer_id`" . ew_SearchString("=", $this->customer_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `customer_id`, `customer_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_customer`";
		$sWhereWrk = "";
		$this->customer_id->LookupFilters = array();
		$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->customer_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `customer_name`";
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

		// address1
		$this->address1->ViewValue = $this->address1->CurrentValue;
		$this->address1->ViewCustomAttributes = "";

		// address2
		$this->address2->ViewValue = $this->address2->CurrentValue;
		$this->address2->ViewCustomAttributes = "";

		// address3
		$this->address3->ViewValue = $this->address3->CurrentValue;
		$this->address3->ViewCustomAttributes = "";

		// wilayah_id
		$this->wilayah_id->ViewValue = $this->wilayah_id->CurrentValue;
		$this->wilayah_id->ViewCustomAttributes = "";

		// subwil_id
		$this->subwil_id->ViewValue = $this->subwil_id->CurrentValue;
		$this->subwil_id->ViewCustomAttributes = "";

		// area_id
		$this->area_id->ViewValue = $this->area_id->CurrentValue;
		$this->area_id->ViewCustomAttributes = "";

		// customer_name
		$this->customer_name->ViewValue = $this->customer_name->CurrentValue;
		$this->customer_name->ViewCustomAttributes = "";

		// tax_number
		$this->tax_number->ViewValue = $this->tax_number->CurrentValue;
		$this->tax_number->ViewCustomAttributes = "";

		// tc_number
		$this->tc_number->ViewValue = $this->tc_number->CurrentValue;
		$this->tc_number->ViewCustomAttributes = "";

		// inv_amt
		$this->inv_amt->ViewValue = $this->inv_amt->CurrentValue;
		$this->inv_amt->ViewValue = ew_FormatNumber($this->inv_amt->ViewValue, 2, -2, -2, -2);
		$this->inv_amt->CellCssStyle .= "text-align: right;";
		$this->inv_amt->ViewCustomAttributes = "";

		// discount
		$this->discount->ViewValue = $this->discount->CurrentValue;
		$this->discount->ViewValue = ew_FormatNumber($this->discount->ViewValue, 2, -2, -2, -2);
		$this->discount->CellCssStyle .= "text-align: right;";
		$this->discount->ViewCustomAttributes = "";

		// total_discount
		$this->total_discount->ViewValue = $this->total_discount->CurrentValue;
		$this->total_discount->ViewValue = ew_FormatNumber($this->total_discount->ViewValue, 2, -2, -2, -2);
		$this->total_discount->CellCssStyle .= "text-align: right;";
		$this->total_discount->ViewCustomAttributes = "";

		// is_tax
		if (ew_ConvertToBool($this->is_tax->CurrentValue)) {
			$this->is_tax->ViewValue = $this->is_tax->FldTagCaption(1) <> "" ? $this->is_tax->FldTagCaption(1) : "1";
		} else {
			$this->is_tax->ViewValue = $this->is_tax->FldTagCaption(2) <> "" ? $this->is_tax->FldTagCaption(2) : "0";
		}
		$this->is_tax->ViewCustomAttributes = "";

		// tax_total
		$this->tax_total->ViewValue = $this->tax_total->CurrentValue;
		$this->tax_total->ViewValue = ew_FormatNumber($this->tax_total->ViewValue, 2, -2, -2, -2);
		$this->tax_total->CellCssStyle .= "text-align: right;";
		$this->tax_total->ViewCustomAttributes = "";

		// inv_total
		$this->inv_total->ViewValue = $this->inv_total->CurrentValue;
		$this->inv_total->ViewValue = ew_FormatNumber($this->inv_total->ViewValue, 2, -2, -2, -2);
		$this->inv_total->CellCssStyle .= "text-align: right;";
		$this->inv_total->ViewCustomAttributes = "";

		// paid_amt
		$this->paid_amt->ViewValue = $this->paid_amt->CurrentValue;
		$this->paid_amt->ViewValue = ew_FormatNumber($this->paid_amt->ViewValue, 2, -2, -2, -2);
		$this->paid_amt->CellCssStyle .= "text-align: right;";
		$this->paid_amt->ViewCustomAttributes = "";

		// sales_id
		$this->sales_id->ViewValue = $this->sales_id->CurrentValue;
		$this->sales_id->ViewCustomAttributes = "";

		// paid
		if (ew_ConvertToBool($this->paid->CurrentValue)) {
			$this->paid->ViewValue = $this->paid->FldTagCaption(1) <> "" ? $this->paid->FldTagCaption(1) : "1";
		} else {
			$this->paid->ViewValue = $this->paid->FldTagCaption(2) <> "" ? $this->paid->FldTagCaption(2) : "0";
		}
		$this->paid->CellCssStyle .= "text-align: center;";
		$this->paid->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// lastupdate
		$this->lastupdate->ViewValue = $this->lastupdate->CurrentValue;
		$this->lastupdate->ViewValue = ew_FormatDateTime($this->lastupdate->ViewValue, 0);
		$this->lastupdate->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

			// inv_number
			$this->inv_number->LinkCustomAttributes = "";
			$this->inv_number->HrefValue = "";
			$this->inv_number->TooltipValue = "";

			// inv_date
			$this->inv_date->LinkCustomAttributes = "";
			$this->inv_date->HrefValue = "";
			$this->inv_date->TooltipValue = "";

			// tax_type
			$this->tax_type->LinkCustomAttributes = "";
			$this->tax_type->HrefValue = "";
			$this->tax_type->TooltipValue = "";

			// due_date
			$this->due_date->LinkCustomAttributes = "";
			$this->due_date->HrefValue = "";
			$this->due_date->TooltipValue = "";

			// customer_id
			$this->customer_id->LinkCustomAttributes = "";
			$this->customer_id->HrefValue = "";
			$this->customer_id->TooltipValue = "";

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

			// customer_name
			$this->customer_name->LinkCustomAttributes = "";
			$this->customer_name->HrefValue = "";
			$this->customer_name->TooltipValue = "";

			// tax_number
			$this->tax_number->LinkCustomAttributes = "";
			$this->tax_number->HrefValue = "";
			$this->tax_number->TooltipValue = "";

			// tc_number
			$this->tc_number->LinkCustomAttributes = "";
			$this->tc_number->HrefValue = "";
			$this->tc_number->TooltipValue = "";

			// inv_amt
			$this->inv_amt->LinkCustomAttributes = "";
			$this->inv_amt->HrefValue = "";
			$this->inv_amt->TooltipValue = "";

			// total_discount
			$this->total_discount->LinkCustomAttributes = "";
			$this->total_discount->HrefValue = "";
			$this->total_discount->TooltipValue = "";

			// is_tax
			$this->is_tax->LinkCustomAttributes = "";
			$this->is_tax->HrefValue = "";
			$this->is_tax->TooltipValue = "";

			// tax_total
			$this->tax_total->LinkCustomAttributes = "";
			$this->tax_total->HrefValue = "";
			$this->tax_total->TooltipValue = "";

			// inv_total
			$this->inv_total->LinkCustomAttributes = "";
			$this->inv_total->HrefValue = "";
			$this->inv_total->TooltipValue = "";

			// paid_amt
			$this->paid_amt->LinkCustomAttributes = "";
			$this->paid_amt->HrefValue = "";
			$this->paid_amt->TooltipValue = "";

			// sales_id
			$this->sales_id->LinkCustomAttributes = "";
			$this->sales_id->HrefValue = "";
			$this->sales_id->TooltipValue = "";

			// paid
			$this->paid->LinkCustomAttributes = "";
			$this->paid->HrefValue = "";
			$this->paid->TooltipValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// lastupdate
			$this->lastupdate->LinkCustomAttributes = "";
			$this->lastupdate->HrefValue = "";
			$this->lastupdate->TooltipValue = "";

			// kode_depo
			$this->kode_depo->LinkCustomAttributes = "";
			$this->kode_depo->HrefValue = "";
			$this->kode_depo->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// inv_number
			$this->inv_number->EditAttrs["class"] = "form-control";
			$this->inv_number->EditCustomAttributes = "";
			$this->inv_number->EditValue = ew_HtmlEncode($this->inv_number->CurrentValue);
			$this->inv_number->PlaceHolder = ew_RemoveHtml($this->inv_number->FldCaption());

			// inv_date
			$this->inv_date->EditAttrs["class"] = "form-control";
			$this->inv_date->EditCustomAttributes = "";
			$this->inv_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->inv_date->CurrentValue, 7));
			$this->inv_date->PlaceHolder = ew_RemoveHtml($this->inv_date->FldCaption());

			// tax_type
			$this->tax_type->EditAttrs["class"] = "form-control";
			$this->tax_type->EditCustomAttributes = "";
			$this->tax_type->CurrentValue = 1;

			// due_date
			$this->due_date->EditAttrs["class"] = "form-control";
			$this->due_date->EditCustomAttributes = "";
			$this->due_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->due_date->CurrentValue, 7));
			$this->due_date->PlaceHolder = ew_RemoveHtml($this->due_date->FldCaption());

			// customer_id
			$this->customer_id->EditAttrs["class"] = "form-control";
			$this->customer_id->EditCustomAttributes = "";
			$this->customer_id->EditValue = ew_HtmlEncode($this->customer_id->CurrentValue);
			if (strval($this->customer_id->CurrentValue) <> "") {
				$sFilterWrk = "`customer_id`" . ew_SearchString("=", $this->customer_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `customer_id`, `customer_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_customer`";
			$sWhereWrk = "";
			$this->customer_id->LookupFilters = array();
			$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->customer_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `customer_name`";
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->customer_id->EditValue = $this->customer_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->customer_id->EditValue = ew_HtmlEncode($this->customer_id->CurrentValue);
				}
			} else {
				$this->customer_id->EditValue = NULL;
			}
			$this->customer_id->PlaceHolder = ew_RemoveHtml($this->customer_id->FldCaption());

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

			// wilayah_id
			$this->wilayah_id->EditAttrs["class"] = "form-control";
			$this->wilayah_id->EditCustomAttributes = "";
			$this->wilayah_id->EditValue = ew_HtmlEncode($this->wilayah_id->CurrentValue);
			$this->wilayah_id->PlaceHolder = ew_RemoveHtml($this->wilayah_id->FldCaption());

			// subwil_id
			$this->subwil_id->EditAttrs["class"] = "form-control";
			$this->subwil_id->EditCustomAttributes = "";
			$this->subwil_id->EditValue = ew_HtmlEncode($this->subwil_id->CurrentValue);
			$this->subwil_id->PlaceHolder = ew_RemoveHtml($this->subwil_id->FldCaption());

			// area_id
			$this->area_id->EditAttrs["class"] = "form-control";
			$this->area_id->EditCustomAttributes = "";
			$this->area_id->EditValue = ew_HtmlEncode($this->area_id->CurrentValue);
			$this->area_id->PlaceHolder = ew_RemoveHtml($this->area_id->FldCaption());

			// customer_name
			$this->customer_name->EditAttrs["class"] = "form-control";
			$this->customer_name->EditCustomAttributes = "";
			$this->customer_name->EditValue = ew_HtmlEncode($this->customer_name->CurrentValue);
			$this->customer_name->PlaceHolder = ew_RemoveHtml($this->customer_name->FldCaption());

			// tax_number
			$this->tax_number->EditAttrs["class"] = "form-control";
			$this->tax_number->EditCustomAttributes = "";
			$this->tax_number->EditValue = ew_HtmlEncode($this->tax_number->CurrentValue);
			$this->tax_number->PlaceHolder = ew_RemoveHtml($this->tax_number->FldCaption());

			// tc_number
			$this->tc_number->EditAttrs["class"] = "form-control";
			$this->tc_number->EditCustomAttributes = "";
			$this->tc_number->EditValue = ew_HtmlEncode($this->tc_number->CurrentValue);
			$this->tc_number->PlaceHolder = ew_RemoveHtml($this->tc_number->FldCaption());

			// inv_amt
			$this->inv_amt->EditAttrs["class"] = "form-control";
			$this->inv_amt->EditCustomAttributes = "";
			$this->inv_amt->EditValue = ew_HtmlEncode($this->inv_amt->CurrentValue);
			$this->inv_amt->PlaceHolder = ew_RemoveHtml($this->inv_amt->FldCaption());
			if (strval($this->inv_amt->EditValue) <> "" && is_numeric($this->inv_amt->EditValue)) $this->inv_amt->EditValue = ew_FormatNumber($this->inv_amt->EditValue, -2, -2, -2, -2);

			// total_discount
			$this->total_discount->EditAttrs["class"] = "form-control";
			$this->total_discount->EditCustomAttributes = "";
			$this->total_discount->EditValue = ew_HtmlEncode($this->total_discount->CurrentValue);
			$this->total_discount->PlaceHolder = ew_RemoveHtml($this->total_discount->FldCaption());
			if (strval($this->total_discount->EditValue) <> "" && is_numeric($this->total_discount->EditValue)) $this->total_discount->EditValue = ew_FormatNumber($this->total_discount->EditValue, -2, -2, -2, -2);

			// is_tax
			$this->is_tax->EditCustomAttributes = "";
			$this->is_tax->EditValue = $this->is_tax->Options(FALSE);

			// tax_total
			$this->tax_total->EditAttrs["class"] = "form-control";
			$this->tax_total->EditCustomAttributes = "";
			$this->tax_total->CurrentValue = 0;

			// inv_total
			$this->inv_total->EditAttrs["class"] = "form-control";
			$this->inv_total->EditCustomAttributes = "";
			$this->inv_total->EditValue = ew_HtmlEncode($this->inv_total->CurrentValue);
			$this->inv_total->PlaceHolder = ew_RemoveHtml($this->inv_total->FldCaption());
			if (strval($this->inv_total->EditValue) <> "" && is_numeric($this->inv_total->EditValue)) $this->inv_total->EditValue = ew_FormatNumber($this->inv_total->EditValue, -2, -2, -2, -2);

			// paid_amt
			$this->paid_amt->EditAttrs["class"] = "form-control";
			$this->paid_amt->EditCustomAttributes = "";
			$this->paid_amt->CurrentValue = 0;

			// sales_id
			$this->sales_id->EditAttrs["class"] = "form-control";
			$this->sales_id->EditCustomAttributes = "";
			$this->sales_id->EditValue = ew_HtmlEncode($this->sales_id->CurrentValue);
			$this->sales_id->PlaceHolder = ew_RemoveHtml($this->sales_id->FldCaption());

			// paid
			$this->paid->EditCustomAttributes = "";
			$this->paid->EditValue = $this->paid->Options(FALSE);

			// user_id
			// lastupdate
			// kode_depo

			$this->kode_depo->EditAttrs["class"] = "form-control";
			$this->kode_depo->EditCustomAttributes = "";
			$this->kode_depo->EditValue = ew_HtmlEncode($this->kode_depo->CurrentValue);
			$this->kode_depo->PlaceHolder = ew_RemoveHtml($this->kode_depo->FldCaption());

			// Add refer script
			// inv_number

			$this->inv_number->LinkCustomAttributes = "";
			$this->inv_number->HrefValue = "";

			// inv_date
			$this->inv_date->LinkCustomAttributes = "";
			$this->inv_date->HrefValue = "";

			// tax_type
			$this->tax_type->LinkCustomAttributes = "";
			$this->tax_type->HrefValue = "";

			// due_date
			$this->due_date->LinkCustomAttributes = "";
			$this->due_date->HrefValue = "";

			// customer_id
			$this->customer_id->LinkCustomAttributes = "";
			$this->customer_id->HrefValue = "";

			// address1
			$this->address1->LinkCustomAttributes = "";
			$this->address1->HrefValue = "";

			// address2
			$this->address2->LinkCustomAttributes = "";
			$this->address2->HrefValue = "";

			// address3
			$this->address3->LinkCustomAttributes = "";
			$this->address3->HrefValue = "";

			// wilayah_id
			$this->wilayah_id->LinkCustomAttributes = "";
			$this->wilayah_id->HrefValue = "";

			// subwil_id
			$this->subwil_id->LinkCustomAttributes = "";
			$this->subwil_id->HrefValue = "";

			// area_id
			$this->area_id->LinkCustomAttributes = "";
			$this->area_id->HrefValue = "";

			// customer_name
			$this->customer_name->LinkCustomAttributes = "";
			$this->customer_name->HrefValue = "";

			// tax_number
			$this->tax_number->LinkCustomAttributes = "";
			$this->tax_number->HrefValue = "";

			// tc_number
			$this->tc_number->LinkCustomAttributes = "";
			$this->tc_number->HrefValue = "";

			// inv_amt
			$this->inv_amt->LinkCustomAttributes = "";
			$this->inv_amt->HrefValue = "";

			// total_discount
			$this->total_discount->LinkCustomAttributes = "";
			$this->total_discount->HrefValue = "";

			// is_tax
			$this->is_tax->LinkCustomAttributes = "";
			$this->is_tax->HrefValue = "";

			// tax_total
			$this->tax_total->LinkCustomAttributes = "";
			$this->tax_total->HrefValue = "";

			// inv_total
			$this->inv_total->LinkCustomAttributes = "";
			$this->inv_total->HrefValue = "";

			// paid_amt
			$this->paid_amt->LinkCustomAttributes = "";
			$this->paid_amt->HrefValue = "";

			// sales_id
			$this->sales_id->LinkCustomAttributes = "";
			$this->sales_id->HrefValue = "";

			// paid
			$this->paid->LinkCustomAttributes = "";
			$this->paid->HrefValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// lastupdate
			$this->lastupdate->LinkCustomAttributes = "";
			$this->lastupdate->HrefValue = "";

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
		if (!ew_CheckEuroDate($this->inv_date->FormValue)) {
			ew_AddMessage($gsFormError, $this->inv_date->FldErrMsg());
		}
		if (!ew_CheckEuroDate($this->due_date->FormValue)) {
			ew_AddMessage($gsFormError, $this->due_date->FldErrMsg());
		}
		if (!ew_CheckInteger($this->customer_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->customer_id->FldErrMsg());
		}
		if (!ew_CheckNumber($this->inv_amt->FormValue)) {
			ew_AddMessage($gsFormError, $this->inv_amt->FldErrMsg());
		}
		if (!ew_CheckNumber($this->total_discount->FormValue)) {
			ew_AddMessage($gsFormError, $this->total_discount->FldErrMsg());
		}
		if (!ew_CheckNumber($this->inv_total->FormValue)) {
			ew_AddMessage($gsFormError, $this->inv_total->FldErrMsg());
		}
		if ($this->paid->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->paid->FldCaption(), $this->paid->ReqErrMsg));
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("tr_inv_canvas_item", $DetailTblVar) && $GLOBALS["tr_inv_canvas_item"]->DetailAdd) {
			if (!isset($GLOBALS["tr_inv_canvas_item_grid"])) $GLOBALS["tr_inv_canvas_item_grid"] = new ctr_inv_canvas_item_grid(); // get detail page object
			$GLOBALS["tr_inv_canvas_item_grid"]->ValidateGridForm();
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

		// inv_number
		$this->inv_number->SetDbValueDef($rsnew, $this->inv_number->CurrentValue, NULL, FALSE);

		// inv_date
		$this->inv_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->inv_date->CurrentValue, 7), NULL, FALSE);

		// tax_type
		$this->tax_type->SetDbValueDef($rsnew, $this->tax_type->CurrentValue, NULL, FALSE);

		// due_date
		$this->due_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->due_date->CurrentValue, 7), NULL, FALSE);

		// customer_id
		$this->customer_id->SetDbValueDef($rsnew, $this->customer_id->CurrentValue, NULL, FALSE);

		// address1
		$this->address1->SetDbValueDef($rsnew, $this->address1->CurrentValue, NULL, FALSE);

		// address2
		$this->address2->SetDbValueDef($rsnew, $this->address2->CurrentValue, NULL, FALSE);

		// address3
		$this->address3->SetDbValueDef($rsnew, $this->address3->CurrentValue, NULL, FALSE);

		// wilayah_id
		$this->wilayah_id->SetDbValueDef($rsnew, $this->wilayah_id->CurrentValue, NULL, FALSE);

		// subwil_id
		$this->subwil_id->SetDbValueDef($rsnew, $this->subwil_id->CurrentValue, NULL, FALSE);

		// area_id
		$this->area_id->SetDbValueDef($rsnew, $this->area_id->CurrentValue, NULL, FALSE);

		// customer_name
		$this->customer_name->SetDbValueDef($rsnew, $this->customer_name->CurrentValue, NULL, FALSE);

		// tax_number
		$this->tax_number->SetDbValueDef($rsnew, $this->tax_number->CurrentValue, NULL, FALSE);

		// tc_number
		$this->tc_number->SetDbValueDef($rsnew, $this->tc_number->CurrentValue, NULL, FALSE);

		// inv_amt
		$this->inv_amt->SetDbValueDef($rsnew, $this->inv_amt->CurrentValue, NULL, FALSE);

		// total_discount
		$this->total_discount->SetDbValueDef($rsnew, $this->total_discount->CurrentValue, NULL, FALSE);

		// is_tax
		$tmpBool = $this->is_tax->CurrentValue;
		if ($tmpBool <> "1" && $tmpBool <> "0")
			$tmpBool = (!empty($tmpBool)) ? "1" : "0";
		$this->is_tax->SetDbValueDef($rsnew, $tmpBool, NULL, strval($this->is_tax->CurrentValue) == "");

		// tax_total
		$this->tax_total->SetDbValueDef($rsnew, $this->tax_total->CurrentValue, NULL, FALSE);

		// inv_total
		$this->inv_total->SetDbValueDef($rsnew, $this->inv_total->CurrentValue, NULL, FALSE);

		// paid_amt
		$this->paid_amt->SetDbValueDef($rsnew, $this->paid_amt->CurrentValue, NULL, FALSE);

		// sales_id
		$this->sales_id->SetDbValueDef($rsnew, $this->sales_id->CurrentValue, NULL, FALSE);

		// paid
		$tmpBool = $this->paid->CurrentValue;
		if ($tmpBool <> "1" && $tmpBool <> "0")
			$tmpBool = (!empty($tmpBool)) ? "1" : "0";
		$this->paid->SetDbValueDef($rsnew, $tmpBool, 0, FALSE);

		// user_id
		$this->user_id->SetDbValueDef($rsnew, CurrentUserID(), NULL);
		$rsnew['user_id'] = &$this->user_id->DbValue;

		// lastupdate
		$this->lastupdate->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
		$rsnew['lastupdate'] = &$this->lastupdate->DbValue;

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
			if (in_array("tr_inv_canvas_item", $DetailTblVar) && $GLOBALS["tr_inv_canvas_item"]->DetailAdd) {
				$GLOBALS["tr_inv_canvas_item"]->master_id->setSessionValue($this->inv_id->CurrentValue); // Set master key
				if (!isset($GLOBALS["tr_inv_canvas_item_grid"])) $GLOBALS["tr_inv_canvas_item_grid"] = new ctr_inv_canvas_item_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "tr_inv_canvas_item"); // Load user level of detail table
				$AddRow = $GLOBALS["tr_inv_canvas_item_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["tr_inv_canvas_item"]->master_id->setSessionValue(""); // Clear master key if insert failed
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
			if (in_array("tr_inv_canvas_item", $DetailTblVar)) {
				if (!isset($GLOBALS["tr_inv_canvas_item_grid"]))
					$GLOBALS["tr_inv_canvas_item_grid"] = new ctr_inv_canvas_item_grid;
				if ($GLOBALS["tr_inv_canvas_item_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["tr_inv_canvas_item_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["tr_inv_canvas_item_grid"]->CurrentMode = "add";
					$GLOBALS["tr_inv_canvas_item_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["tr_inv_canvas_item_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["tr_inv_canvas_item_grid"]->setStartRecordNumber(1);
					$GLOBALS["tr_inv_canvas_item_grid"]->master_id->FldIsDetailKey = TRUE;
					$GLOBALS["tr_inv_canvas_item_grid"]->master_id->CurrentValue = $this->inv_id->CurrentValue;
					$GLOBALS["tr_inv_canvas_item_grid"]->master_id->setSessionValue($GLOBALS["tr_inv_canvas_item_grid"]->master_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_inv_canvas_masterlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_customer_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `customer_id` AS `LinkFld`, `customer_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_customer`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`customer_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->customer_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `customer_name`";
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
		case "x_customer_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `customer_id`, `customer_name` AS `DispFld` FROM `tbl_customer`";
			$sWhereWrk = "`customer_name` LIKE '{query_value}%'";
			$fld->LookupFilters = array();
			$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->customer_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `customer_name`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($tr_inv_canvas_master_add)) $tr_inv_canvas_master_add = new ctr_inv_canvas_master_add();

// Page init
$tr_inv_canvas_master_add->Page_Init();

// Page main
$tr_inv_canvas_master_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_inv_canvas_master_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ftr_inv_canvas_masteradd = new ew_Form("ftr_inv_canvas_masteradd", "add");

// Validate form
ftr_inv_canvas_masteradd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_inv_date");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_canvas_master->inv_date->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_due_date");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_canvas_master->due_date->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_customer_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_canvas_master->customer_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_inv_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_canvas_master->inv_amt->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_total_discount");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_canvas_master->total_discount->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_inv_total");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_canvas_master->inv_total->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_paid[]");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $tr_inv_canvas_master->paid->FldCaption(), $tr_inv_canvas_master->paid->ReqErrMsg)) ?>");

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
ftr_inv_canvas_masteradd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_inv_canvas_masteradd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_inv_canvas_masteradd.Lists["x_customer_id"] = {"LinkField":"x_customer_id","Ajax":true,"AutoFill":true,"DisplayFields":["x_customer_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_customer"};
ftr_inv_canvas_masteradd.Lists["x_customer_id"].Data = "<?php echo $tr_inv_canvas_master_add->customer_id->LookupFilterQuery(FALSE, "add") ?>";
ftr_inv_canvas_masteradd.AutoSuggests["x_customer_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $tr_inv_canvas_master_add->customer_id->LookupFilterQuery(TRUE, "add"))) ?>;
ftr_inv_canvas_masteradd.Lists["x_is_tax[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftr_inv_canvas_masteradd.Lists["x_is_tax[]"].Options = <?php echo json_encode($tr_inv_canvas_master_add->is_tax->Options()) ?>;
ftr_inv_canvas_masteradd.Lists["x_paid[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftr_inv_canvas_masteradd.Lists["x_paid[]"].Options = <?php echo json_encode($tr_inv_canvas_master_add->paid->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tr_inv_canvas_master_add->ShowPageHeader(); ?>
<?php
$tr_inv_canvas_master_add->ShowMessage();
?>
<form name="ftr_inv_canvas_masteradd" id="ftr_inv_canvas_masteradd" class="<?php echo $tr_inv_canvas_master_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_inv_canvas_master_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_inv_canvas_master_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_inv_canvas_master">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($tr_inv_canvas_master_add->IsModal) ?>">
<div id="tpd_tr_inv_canvas_masteradd" class="ewCustomTemplate"></div>
<script id="tpm_tr_inv_canvas_masteradd" type="text/html">
<div id="ct_tr_inv_canvas_master_add"><div class="col-sm-12 panel-custom" style="">
	<div class="row">
		<div class="col-sm-5 order-1">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_inv_canvas_master->inv_number->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_canvas_master_inv_number"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_inv_canvas_master->inv_date->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_canvas_master_inv_date"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_inv_canvas_master->due_date->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_canvas_master_due_date"/}}</div>
			</div>
		</div>
		<div class="col-sm-7 order-2">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_inv_canvas_master->customer_id->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_canvas_master_customer_id"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_inv_canvas_master->address1->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_canvas_master_address1"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_inv_canvas_master->address2->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_canvas_master_address2"/}}</div>
			</div>
		</div>
	</div>
</div>
<br>
<!--- batas -->
<div class="col-sm-12 panel-custom" style="">
	<div class="row">
		<div class="custom-width-1">
			<div class="row">
				<div class="col-sm-4 tittle"> <?php echo $tr_inv_canvas_master->inv_amt->FldCaption() ?> </div>
				<div class="col-sm-8"> {{include tmpl="#tpx_tr_inv_canvas_master_inv_amt"/}} </div>
			</div>
		</div>
		<div class="custom-width-2">
			<div class="row">
				<div class="col-sm-4 tittle"> <?php echo $tr_inv_canvas_master->total_discount->FldCaption() ?> </div>
				<div class="col-sm-8"> {{include tmpl="#tpx_tr_inv_canvas_master_total_discount"/}} </div>
			</div>
		</div>
		<div class="custom-width-3">
			<div class="row">
				<div class="col-sm-7 tittle"> <?php echo $tr_inv_canvas_master->is_tax->FldCaption() ?> </div>
				<div class="col-sm-5"> {{include tmpl="#tpx_tr_inv_canvas_master_is_tax"/}} </div>
			</div>
		</div>
		<div class="custom-width-4">
			<div class="row">
				<div class="col-sm-3 tittle"> <?php echo $tr_inv_canvas_master->inv_total->FldCaption() ?> </div>
				<div class="col-sm-9"> {{include tmpl="#tpx_tr_inv_canvas_master_inv_total"/}} </div>
			</div>
		</div>
	</div>
</div>
</div>
</script>
<?php if (!$tr_inv_canvas_master_add->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
<div class="ewAddDiv hidden"><!-- page* -->
<?php } else { ?>
<table id="tbl_tr_inv_canvas_masteradd" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable hidden"><!-- table* -->
<?php } ?>
<?php if ($tr_inv_canvas_master->inv_number->Visible) { // inv_number ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_inv_number" class="form-group">
		<label id="elh_tr_inv_canvas_master_inv_number" for="x_inv_number" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_inv_number" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->inv_number->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->inv_number->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_inv_number" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_inv_number">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_inv_number" name="x_inv_number" id="x_inv_number" size="15" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->inv_number->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->inv_number->EditValue ?>"<?php echo $tr_inv_canvas_master->inv_number->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->inv_number->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_inv_number">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_inv_number"><script id="tpc_tr_inv_canvas_master_inv_number" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->inv_number->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->inv_number->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_inv_number" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_inv_number">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_inv_number" name="x_inv_number" id="x_inv_number" size="15" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->inv_number->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->inv_number->EditValue ?>"<?php echo $tr_inv_canvas_master->inv_number->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->inv_number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->inv_date->Visible) { // inv_date ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_inv_date" class="form-group">
		<label id="elh_tr_inv_canvas_master_inv_date" for="x_inv_date" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_inv_date" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->inv_date->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->inv_date->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_inv_date" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_inv_date">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_inv_date" data-format="7" name="x_inv_date" id="x_inv_date" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->inv_date->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->inv_date->EditValue ?>"<?php echo $tr_inv_canvas_master->inv_date->EditAttributes() ?>>
<?php if (!$tr_inv_canvas_master->inv_date->ReadOnly && !$tr_inv_canvas_master->inv_date->Disabled && !isset($tr_inv_canvas_master->inv_date->EditAttrs["readonly"]) && !isset($tr_inv_canvas_master->inv_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_inv_canvas_masteradd_js">
ew_CreateDateTimePicker("ftr_inv_canvas_masteradd", "x_inv_date", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php echo $tr_inv_canvas_master->inv_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_inv_date">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_inv_date"><script id="tpc_tr_inv_canvas_master_inv_date" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->inv_date->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->inv_date->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_inv_date" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_inv_date">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_inv_date" data-format="7" name="x_inv_date" id="x_inv_date" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->inv_date->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->inv_date->EditValue ?>"<?php echo $tr_inv_canvas_master->inv_date->EditAttributes() ?>>
<?php if (!$tr_inv_canvas_master->inv_date->ReadOnly && !$tr_inv_canvas_master->inv_date->Disabled && !isset($tr_inv_canvas_master->inv_date->EditAttrs["readonly"]) && !isset($tr_inv_canvas_master->inv_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_inv_canvas_masteradd_js">
ew_CreateDateTimePicker("ftr_inv_canvas_masteradd", "x_inv_date", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php echo $tr_inv_canvas_master->inv_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<script id="tpx_tr_inv_canvas_master_tax_type" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_tax_type">
<input type="hidden" data-table="tr_inv_canvas_master" data-field="x_tax_type" name="x_tax_type" id="x_tax_type" value="<?php echo ew_HtmlEncode($tr_inv_canvas_master->tax_type->CurrentValue) ?>">
</span>
</script>
<?php if ($tr_inv_canvas_master->due_date->Visible) { // due_date ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_due_date" class="form-group">
		<label id="elh_tr_inv_canvas_master_due_date" for="x_due_date" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_due_date" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->due_date->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->due_date->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_due_date" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_due_date">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_due_date" data-format="7" name="x_due_date" id="x_due_date" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->due_date->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->due_date->EditValue ?>"<?php echo $tr_inv_canvas_master->due_date->EditAttributes() ?>>
<?php if (!$tr_inv_canvas_master->due_date->ReadOnly && !$tr_inv_canvas_master->due_date->Disabled && !isset($tr_inv_canvas_master->due_date->EditAttrs["readonly"]) && !isset($tr_inv_canvas_master->due_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_inv_canvas_masteradd_js">
ew_CreateDateTimePicker("ftr_inv_canvas_masteradd", "x_due_date", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php echo $tr_inv_canvas_master->due_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_due_date">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_due_date"><script id="tpc_tr_inv_canvas_master_due_date" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->due_date->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->due_date->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_due_date" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_due_date">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_due_date" data-format="7" name="x_due_date" id="x_due_date" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->due_date->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->due_date->EditValue ?>"<?php echo $tr_inv_canvas_master->due_date->EditAttributes() ?>>
<?php if (!$tr_inv_canvas_master->due_date->ReadOnly && !$tr_inv_canvas_master->due_date->Disabled && !isset($tr_inv_canvas_master->due_date->EditAttrs["readonly"]) && !isset($tr_inv_canvas_master->due_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_inv_canvas_masteradd_js">
ew_CreateDateTimePicker("ftr_inv_canvas_masteradd", "x_due_date", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php echo $tr_inv_canvas_master->due_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->customer_id->Visible) { // customer_id ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_customer_id" class="form-group">
		<label id="elh_tr_inv_canvas_master_customer_id" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_customer_id" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->customer_id->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->customer_id->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_customer_id" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_customer_id">
<?php
$wrkonchange = trim("ew_AutoFill(this); " . @$tr_inv_canvas_master->customer_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_inv_canvas_master->customer_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_customer_id" style="white-space: nowrap; z-index: 8940">
	<input type="text" name="sv_x_customer_id" id="sv_x_customer_id" value="<?php echo $tr_inv_canvas_master->customer_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->customer_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->customer_id->getPlaceHolder()) ?>"<?php echo $tr_inv_canvas_master->customer_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_canvas_master" data-field="x_customer_id" data-value-separator="<?php echo $tr_inv_canvas_master->customer_id->DisplayValueSeparatorAttribute() ?>" name="x_customer_id" id="x_customer_id" value="<?php echo ew_HtmlEncode($tr_inv_canvas_master->customer_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="ln_x_customer_id" id="ln_x_customer_id" value="x_address1,x_address2,x_address3,x_wilayah_id,x_subwil_id,x_area_id,x_customer_name,x_is_tax[],x_sales_id">
</span>
</script>
<script type="text/html" class="tr_inv_canvas_masteradd_js">
ftr_inv_canvas_masteradd.CreateAutoSuggest({"id":"x_customer_id","forceSelect":true});
</script>
<?php echo $tr_inv_canvas_master->customer_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_customer_id">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_customer_id"><script id="tpc_tr_inv_canvas_master_customer_id" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->customer_id->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->customer_id->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_customer_id" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_customer_id">
<?php
$wrkonchange = trim("ew_AutoFill(this); " . @$tr_inv_canvas_master->customer_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_inv_canvas_master->customer_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_customer_id" style="white-space: nowrap; z-index: 8940">
	<input type="text" name="sv_x_customer_id" id="sv_x_customer_id" value="<?php echo $tr_inv_canvas_master->customer_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->customer_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->customer_id->getPlaceHolder()) ?>"<?php echo $tr_inv_canvas_master->customer_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_canvas_master" data-field="x_customer_id" data-value-separator="<?php echo $tr_inv_canvas_master->customer_id->DisplayValueSeparatorAttribute() ?>" name="x_customer_id" id="x_customer_id" value="<?php echo ew_HtmlEncode($tr_inv_canvas_master->customer_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="ln_x_customer_id" id="ln_x_customer_id" value="x_address1,x_address2,x_address3,x_wilayah_id,x_subwil_id,x_area_id,x_customer_name,x_is_tax[],x_sales_id">
</span>
</script>
<script type="text/html" class="tr_inv_canvas_masteradd_js">
ftr_inv_canvas_masteradd.CreateAutoSuggest({"id":"x_customer_id","forceSelect":true});
</script>
<?php echo $tr_inv_canvas_master->customer_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->address1->Visible) { // address1 ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_address1" class="form-group">
		<label id="elh_tr_inv_canvas_master_address1" for="x_address1" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_address1" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->address1->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->address1->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_address1" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_address1">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_address1" name="x_address1" id="x_address1" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->address1->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->address1->EditValue ?>"<?php echo $tr_inv_canvas_master->address1->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->address1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address1">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_address1"><script id="tpc_tr_inv_canvas_master_address1" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->address1->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->address1->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_address1" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_address1">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_address1" name="x_address1" id="x_address1" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->address1->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->address1->EditValue ?>"<?php echo $tr_inv_canvas_master->address1->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->address1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->address2->Visible) { // address2 ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_address2" class="form-group">
		<label id="elh_tr_inv_canvas_master_address2" for="x_address2" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_address2" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->address2->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->address2->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_address2" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_address2">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_address2" name="x_address2" id="x_address2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->address2->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->address2->EditValue ?>"<?php echo $tr_inv_canvas_master->address2->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->address2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address2">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_address2"><script id="tpc_tr_inv_canvas_master_address2" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->address2->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->address2->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_address2" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_address2">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_address2" name="x_address2" id="x_address2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->address2->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->address2->EditValue ?>"<?php echo $tr_inv_canvas_master->address2->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->address2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->address3->Visible) { // address3 ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_address3" class="form-group">
		<label id="elh_tr_inv_canvas_master_address3" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_address3" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->address3->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->address3->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_address3" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_address3">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_address3" name="x_address3" id="x_address3" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->address3->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->address3->EditValue ?>"<?php echo $tr_inv_canvas_master->address3->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->address3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address3">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_address3"><script id="tpc_tr_inv_canvas_master_address3" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->address3->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->address3->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_address3" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_address3">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_address3" name="x_address3" id="x_address3" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->address3->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->address3->EditValue ?>"<?php echo $tr_inv_canvas_master->address3->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->address3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->wilayah_id->Visible) { // wilayah_id ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_wilayah_id" class="form-group">
		<label id="elh_tr_inv_canvas_master_wilayah_id" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_wilayah_id" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->wilayah_id->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->wilayah_id->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_wilayah_id" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_wilayah_id">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_wilayah_id" name="x_wilayah_id" id="x_wilayah_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->wilayah_id->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->wilayah_id->EditValue ?>"<?php echo $tr_inv_canvas_master->wilayah_id->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->wilayah_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_wilayah_id">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_wilayah_id"><script id="tpc_tr_inv_canvas_master_wilayah_id" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->wilayah_id->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->wilayah_id->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_wilayah_id" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_wilayah_id">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_wilayah_id" name="x_wilayah_id" id="x_wilayah_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->wilayah_id->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->wilayah_id->EditValue ?>"<?php echo $tr_inv_canvas_master->wilayah_id->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->wilayah_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->subwil_id->Visible) { // subwil_id ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_subwil_id" class="form-group">
		<label id="elh_tr_inv_canvas_master_subwil_id" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_subwil_id" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->subwil_id->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->subwil_id->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_subwil_id" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_subwil_id">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_subwil_id" name="x_subwil_id" id="x_subwil_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->subwil_id->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->subwil_id->EditValue ?>"<?php echo $tr_inv_canvas_master->subwil_id->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->subwil_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_subwil_id">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_subwil_id"><script id="tpc_tr_inv_canvas_master_subwil_id" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->subwil_id->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->subwil_id->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_subwil_id" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_subwil_id">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_subwil_id" name="x_subwil_id" id="x_subwil_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->subwil_id->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->subwil_id->EditValue ?>"<?php echo $tr_inv_canvas_master->subwil_id->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->subwil_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->area_id->Visible) { // area_id ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_area_id" class="form-group">
		<label id="elh_tr_inv_canvas_master_area_id" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_area_id" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->area_id->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->area_id->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_area_id" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_area_id">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_area_id" name="x_area_id" id="x_area_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->area_id->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->area_id->EditValue ?>"<?php echo $tr_inv_canvas_master->area_id->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->area_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_area_id">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_area_id"><script id="tpc_tr_inv_canvas_master_area_id" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->area_id->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->area_id->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_area_id" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_area_id">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_area_id" name="x_area_id" id="x_area_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->area_id->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->area_id->EditValue ?>"<?php echo $tr_inv_canvas_master->area_id->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->area_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->customer_name->Visible) { // customer_name ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_customer_name" class="form-group">
		<label id="elh_tr_inv_canvas_master_customer_name" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_customer_name" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->customer_name->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->customer_name->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_customer_name" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_customer_name">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_customer_name" name="x_customer_name" id="x_customer_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->customer_name->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->customer_name->EditValue ?>"<?php echo $tr_inv_canvas_master->customer_name->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->customer_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_customer_name">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_customer_name"><script id="tpc_tr_inv_canvas_master_customer_name" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->customer_name->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->customer_name->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_customer_name" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_customer_name">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_customer_name" name="x_customer_name" id="x_customer_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->customer_name->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->customer_name->EditValue ?>"<?php echo $tr_inv_canvas_master->customer_name->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->customer_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->tax_number->Visible) { // tax_number ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_tax_number" class="form-group">
		<label id="elh_tr_inv_canvas_master_tax_number" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_tax_number" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->tax_number->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->tax_number->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_tax_number" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_tax_number">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_tax_number" name="x_tax_number" id="x_tax_number" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->tax_number->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->tax_number->EditValue ?>"<?php echo $tr_inv_canvas_master->tax_number->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->tax_number->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tax_number">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_tax_number"><script id="tpc_tr_inv_canvas_master_tax_number" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->tax_number->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->tax_number->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_tax_number" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_tax_number">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_tax_number" name="x_tax_number" id="x_tax_number" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->tax_number->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->tax_number->EditValue ?>"<?php echo $tr_inv_canvas_master->tax_number->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->tax_number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->tc_number->Visible) { // tc_number ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_tc_number" class="form-group">
		<label id="elh_tr_inv_canvas_master_tc_number" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_tc_number" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->tc_number->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->tc_number->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_tc_number" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_tc_number">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_tc_number" name="x_tc_number" id="x_tc_number" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->tc_number->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->tc_number->EditValue ?>"<?php echo $tr_inv_canvas_master->tc_number->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->tc_number->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tc_number">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_tc_number"><script id="tpc_tr_inv_canvas_master_tc_number" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->tc_number->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->tc_number->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_tc_number" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_tc_number">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_tc_number" name="x_tc_number" id="x_tc_number" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->tc_number->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->tc_number->EditValue ?>"<?php echo $tr_inv_canvas_master->tc_number->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->tc_number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->inv_amt->Visible) { // inv_amt ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_inv_amt" class="form-group">
		<label id="elh_tr_inv_canvas_master_inv_amt" for="x_inv_amt" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_inv_amt" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->inv_amt->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->inv_amt->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_inv_amt" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_inv_amt">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_inv_amt" name="x_inv_amt" id="x_inv_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->inv_amt->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->inv_amt->EditValue ?>"<?php echo $tr_inv_canvas_master->inv_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->inv_amt->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_inv_amt">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_inv_amt"><script id="tpc_tr_inv_canvas_master_inv_amt" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->inv_amt->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->inv_amt->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_inv_amt" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_inv_amt">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_inv_amt" name="x_inv_amt" id="x_inv_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->inv_amt->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->inv_amt->EditValue ?>"<?php echo $tr_inv_canvas_master->inv_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->inv_amt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->total_discount->Visible) { // total_discount ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_total_discount" class="form-group">
		<label id="elh_tr_inv_canvas_master_total_discount" for="x_total_discount" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_total_discount" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->total_discount->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->total_discount->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_total_discount" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_total_discount">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_total_discount" name="x_total_discount" id="x_total_discount" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->total_discount->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->total_discount->EditValue ?>"<?php echo $tr_inv_canvas_master->total_discount->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->total_discount->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_total_discount">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_total_discount"><script id="tpc_tr_inv_canvas_master_total_discount" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->total_discount->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->total_discount->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_total_discount" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_total_discount">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_total_discount" name="x_total_discount" id="x_total_discount" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->total_discount->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->total_discount->EditValue ?>"<?php echo $tr_inv_canvas_master->total_discount->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->total_discount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->is_tax->Visible) { // is_tax ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_is_tax" class="form-group">
		<label id="elh_tr_inv_canvas_master_is_tax" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_is_tax" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->is_tax->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->is_tax->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_is_tax" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_is_tax">
<?php
$selwrk = (ew_ConvertToBool($tr_inv_canvas_master->is_tax->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="tr_inv_canvas_master" data-field="x_is_tax" name="x_is_tax[]" id="x_is_tax[]" value="1"<?php echo $selwrk ?><?php echo $tr_inv_canvas_master->is_tax->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->is_tax->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_is_tax">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_is_tax"><script id="tpc_tr_inv_canvas_master_is_tax" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->is_tax->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->is_tax->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_is_tax" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_is_tax">
<?php
$selwrk = (ew_ConvertToBool($tr_inv_canvas_master->is_tax->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="tr_inv_canvas_master" data-field="x_is_tax" name="x_is_tax[]" id="x_is_tax[]" value="1"<?php echo $selwrk ?><?php echo $tr_inv_canvas_master->is_tax->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->is_tax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<script id="tpx_tr_inv_canvas_master_tax_total" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_tax_total">
<input type="hidden" data-table="tr_inv_canvas_master" data-field="x_tax_total" name="x_tax_total" id="x_tax_total" value="<?php echo ew_HtmlEncode($tr_inv_canvas_master->tax_total->CurrentValue) ?>">
</span>
</script>
<?php if ($tr_inv_canvas_master->inv_total->Visible) { // inv_total ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_inv_total" class="form-group">
		<label id="elh_tr_inv_canvas_master_inv_total" for="x_inv_total" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_inv_total" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->inv_total->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->inv_total->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_inv_total" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_inv_total">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_inv_total" name="x_inv_total" id="x_inv_total" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->inv_total->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->inv_total->EditValue ?>"<?php echo $tr_inv_canvas_master->inv_total->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->inv_total->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_inv_total">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_inv_total"><script id="tpc_tr_inv_canvas_master_inv_total" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->inv_total->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->inv_total->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_inv_total" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_inv_total">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_inv_total" name="x_inv_total" id="x_inv_total" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->inv_total->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->inv_total->EditValue ?>"<?php echo $tr_inv_canvas_master->inv_total->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->inv_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<script id="tpx_tr_inv_canvas_master_paid_amt" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_paid_amt">
<input type="hidden" data-table="tr_inv_canvas_master" data-field="x_paid_amt" name="x_paid_amt" id="x_paid_amt" value="<?php echo ew_HtmlEncode($tr_inv_canvas_master->paid_amt->CurrentValue) ?>">
</span>
</script>
<?php if ($tr_inv_canvas_master->sales_id->Visible) { // sales_id ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_sales_id" class="form-group">
		<label id="elh_tr_inv_canvas_master_sales_id" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_sales_id" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->sales_id->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->sales_id->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_sales_id" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_sales_id">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_sales_id" name="x_sales_id" id="x_sales_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->sales_id->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->sales_id->EditValue ?>"<?php echo $tr_inv_canvas_master->sales_id->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->sales_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sales_id">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_sales_id"><script id="tpc_tr_inv_canvas_master_sales_id" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->sales_id->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->sales_id->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_sales_id" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_sales_id">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_sales_id" name="x_sales_id" id="x_sales_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->sales_id->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->sales_id->EditValue ?>"<?php echo $tr_inv_canvas_master->sales_id->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->sales_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->paid->Visible) { // paid ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_paid" class="form-group">
		<label id="elh_tr_inv_canvas_master_paid" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_paid" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->paid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->paid->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_paid" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_paid">
<?php
$selwrk = (ew_ConvertToBool($tr_inv_canvas_master->paid->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="tr_inv_canvas_master" data-field="x_paid" name="x_paid[]" id="x_paid[]" value="1"<?php echo $selwrk ?><?php echo $tr_inv_canvas_master->paid->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->paid->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_paid">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_paid"><script id="tpc_tr_inv_canvas_master_paid" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->paid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->paid->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_paid" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_paid">
<?php
$selwrk = (ew_ConvertToBool($tr_inv_canvas_master->paid->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="tr_inv_canvas_master" data-field="x_paid" name="x_paid[]" id="x_paid[]" value="1"<?php echo $selwrk ?><?php echo $tr_inv_canvas_master->paid->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->paid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master->kode_depo->Visible) { // kode_depo ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
	<div id="r_kode_depo" class="form-group">
		<label id="elh_tr_inv_canvas_master_kode_depo" class="<?php echo $tr_inv_canvas_master_add->LeftColumnClass ?>"><script id="tpc_tr_inv_canvas_master_kode_depo" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->kode_depo->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_inv_canvas_master_add->RightColumnClass ?>"><div<?php echo $tr_inv_canvas_master->kode_depo->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_kode_depo" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_kode_depo">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" size="30" maxlength="3" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->kode_depo->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->kode_depo->EditValue ?>"<?php echo $tr_inv_canvas_master->kode_depo->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->kode_depo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_kode_depo">
		<td class="col-sm-2"><span id="elh_tr_inv_canvas_master_kode_depo"><script id="tpc_tr_inv_canvas_master_kode_depo" class="tr_inv_canvas_masteradd" type="text/html"><span><?php echo $tr_inv_canvas_master->kode_depo->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_inv_canvas_master->kode_depo->CellAttributes() ?>>
<script id="tpx_tr_inv_canvas_master_kode_depo" class="tr_inv_canvas_masteradd" type="text/html">
<span id="el_tr_inv_canvas_master_kode_depo">
<input type="text" data-table="tr_inv_canvas_master" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" size="30" maxlength="3" placeholder="<?php echo ew_HtmlEncode($tr_inv_canvas_master->kode_depo->getPlaceHolder()) ?>" value="<?php echo $tr_inv_canvas_master->kode_depo->EditValue ?>"<?php echo $tr_inv_canvas_master->kode_depo->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_inv_canvas_master->kode_depo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_inv_canvas_master_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php
	if (in_array("tr_inv_canvas_item", explode(",", $tr_inv_canvas_master->getCurrentDetailTable())) && $tr_inv_canvas_item->DetailAdd) {
?>
<?php if ($tr_inv_canvas_master->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("tr_inv_canvas_item", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tr_inv_canvas_itemgrid.php" ?>
<?php } ?>
<?php if (!$tr_inv_canvas_master_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tr_inv_canvas_master_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tr_inv_canvas_master_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tr_inv_canvas_master_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($tr_inv_canvas_master->Rows) ?> };
ew_ApplyTemplate("tpd_tr_inv_canvas_masteradd", "tpm_tr_inv_canvas_masteradd", "tr_inv_canvas_masteradd", "<?php echo $tr_inv_canvas_master->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.tr_inv_canvas_masteradd_js").each(function(){ew_AddScript(this.text);});
</script>
<script type="text/javascript">
ftr_inv_canvas_masteradd.Init();
</script>
<?php
$tr_inv_canvas_master_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_inv_canvas_master_add->Page_Terminate();
?>
