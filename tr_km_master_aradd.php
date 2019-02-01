<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_km_master_arinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tr_km_item_argridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_km_master_ar_add = NULL; // Initialize page object first

class ctr_km_master_ar_add extends ctr_km_master_ar {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_km_master_ar';

	// Page object name
	var $PageObjName = 'tr_km_master_ar_add';

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

		// Table object (tr_km_master_ar)
		if (!isset($GLOBALS["tr_km_master_ar"]) || get_class($GLOBALS["tr_km_master_ar"]) == "ctr_km_master_ar") {
			$GLOBALS["tr_km_master_ar"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_km_master_ar"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_km_master_ar', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tr_km_master_arlist.php"));
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
				if (in_array("tr_km_item_ar", $DetailTblVar)) {

					// Process auto fill for detail table 'tr_km_item_ar'
					if (preg_match('/^ftr_km_item_ar(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["tr_km_item_ar_grid"])) $GLOBALS["tr_km_item_ar_grid"] = new ctr_km_item_ar_grid;
						$GLOBALS["tr_km_item_ar_grid"]->Page_Init();
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
		global $EW_EXPORT, $tr_km_master_ar;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
			if (is_array(@$_SESSION[EW_SESSION_TEMP_IMAGES])) // Restore temp images
				$gTmpImages = @$_SESSION[EW_SESSION_TEMP_IMAGES];
			if (@$_POST["data"] <> "")
				$sContent = $_POST["data"];
			$gsExportFile = @$_POST["filename"];
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_km_master_ar);
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
					if ($pageName == "tr_km_master_arview.php")
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
			if (@$_GET["row_id"] != "") {
				$this->row_id->setQueryStringValue($_GET["row_id"]);
				$this->setKey("row_id", $this->row_id->CurrentValue); // Set up key
			} else {
				$this->setKey("row_id", ""); // Clear key
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
					$this->Page_Terminate("tr_km_master_arlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = "tr_km_master_arlist.php";
					if (ew_GetPageName($sReturnUrl) == "tr_km_master_arlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "tr_km_master_arview.php")
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
		$this->row_id->CurrentValue = NULL;
		$this->row_id->OldValue = $this->row_id->CurrentValue;
		$this->km_nomor->CurrentValue = NULL;
		$this->km_nomor->OldValue = $this->km_nomor->CurrentValue;
		$this->km_tanggal->CurrentValue = ew_CurrentDate();
		$this->customer_id->CurrentValue = NULL;
		$this->customer_id->OldValue = $this->customer_id->CurrentValue;
		$this->customer_name->CurrentValue = NULL;
		$this->customer_name->OldValue = $this->customer_name->CurrentValue;
		$this->km_type->CurrentValue = "1";
		$this->km_acc->CurrentValue = NULL;
		$this->km_acc->OldValue = $this->km_acc->CurrentValue;
		$this->cek_no->CurrentValue = NULL;
		$this->cek_no->OldValue = $this->cek_no->CurrentValue;
		$this->tgl_jt->CurrentValue = NULL;
		$this->tgl_jt->OldValue = $this->tgl_jt->CurrentValue;
		$this->cek_amt->CurrentValue = NULL;
		$this->cek_amt->OldValue = $this->cek_amt->CurrentValue;
		$this->ret_number1->CurrentValue = NULL;
		$this->ret_number1->OldValue = $this->ret_number1->CurrentValue;
		$this->ret_date1->CurrentValue = NULL;
		$this->ret_date1->OldValue = $this->ret_date1->CurrentValue;
		$this->retur_amt1->CurrentValue = NULL;
		$this->retur_amt1->OldValue = $this->retur_amt1->CurrentValue;
		$this->ret_number2->CurrentValue = NULL;
		$this->ret_number2->OldValue = $this->ret_number2->CurrentValue;
		$this->ret_date2->CurrentValue = NULL;
		$this->ret_date2->OldValue = $this->ret_date2->CurrentValue;
		$this->retur_amt2->CurrentValue = NULL;
		$this->retur_amt2->OldValue = $this->retur_amt2->CurrentValue;
		$this->ret_number3->CurrentValue = NULL;
		$this->ret_number3->OldValue = $this->ret_number3->CurrentValue;
		$this->ret_date3->CurrentValue = NULL;
		$this->ret_date3->OldValue = $this->ret_date3->CurrentValue;
		$this->retur_amt3->CurrentValue = NULL;
		$this->retur_amt3->OldValue = $this->retur_amt3->CurrentValue;
		$this->tunai_amt->CurrentValue = NULL;
		$this->tunai_amt->OldValue = $this->tunai_amt->CurrentValue;
		$this->dp_amt->CurrentValue = NULL;
		$this->dp_amt->OldValue = $this->dp_amt->CurrentValue;
		$this->km_amt->CurrentValue = NULL;
		$this->km_amt->OldValue = $this->km_amt->CurrentValue;
		$this->km_notes->CurrentValue = NULL;
		$this->km_notes->OldValue = $this->km_notes->CurrentValue;
		$this->kas_amt->CurrentValue = NULL;
		$this->kas_amt->OldValue = $this->kas_amt->CurrentValue;
		$this->kode_depo->CurrentValue = NULL;
		$this->kode_depo->OldValue = $this->kode_depo->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->km_nomor->FldIsDetailKey) {
			$this->km_nomor->setFormValue($objForm->GetValue("x_km_nomor"));
		}
		if (!$this->km_tanggal->FldIsDetailKey) {
			$this->km_tanggal->setFormValue($objForm->GetValue("x_km_tanggal"));
			$this->km_tanggal->CurrentValue = ew_UnFormatDateTime($this->km_tanggal->CurrentValue, 0);
		}
		if (!$this->customer_id->FldIsDetailKey) {
			$this->customer_id->setFormValue($objForm->GetValue("x_customer_id"));
		}
		if (!$this->customer_name->FldIsDetailKey) {
			$this->customer_name->setFormValue($objForm->GetValue("x_customer_name"));
		}
		if (!$this->km_type->FldIsDetailKey) {
			$this->km_type->setFormValue($objForm->GetValue("x_km_type"));
		}
		if (!$this->km_acc->FldIsDetailKey) {
			$this->km_acc->setFormValue($objForm->GetValue("x_km_acc"));
		}
		if (!$this->cek_no->FldIsDetailKey) {
			$this->cek_no->setFormValue($objForm->GetValue("x_cek_no"));
		}
		if (!$this->tgl_jt->FldIsDetailKey) {
			$this->tgl_jt->setFormValue($objForm->GetValue("x_tgl_jt"));
			$this->tgl_jt->CurrentValue = ew_UnFormatDateTime($this->tgl_jt->CurrentValue, 0);
		}
		if (!$this->cek_amt->FldIsDetailKey) {
			$this->cek_amt->setFormValue($objForm->GetValue("x_cek_amt"));
		}
		if (!$this->ret_number1->FldIsDetailKey) {
			$this->ret_number1->setFormValue($objForm->GetValue("x_ret_number1"));
		}
		if (!$this->ret_date1->FldIsDetailKey) {
			$this->ret_date1->setFormValue($objForm->GetValue("x_ret_date1"));
			$this->ret_date1->CurrentValue = ew_UnFormatDateTime($this->ret_date1->CurrentValue, 0);
		}
		if (!$this->retur_amt1->FldIsDetailKey) {
			$this->retur_amt1->setFormValue($objForm->GetValue("x_retur_amt1"));
		}
		if (!$this->ret_number2->FldIsDetailKey) {
			$this->ret_number2->setFormValue($objForm->GetValue("x_ret_number2"));
		}
		if (!$this->ret_date2->FldIsDetailKey) {
			$this->ret_date2->setFormValue($objForm->GetValue("x_ret_date2"));
			$this->ret_date2->CurrentValue = ew_UnFormatDateTime($this->ret_date2->CurrentValue, 0);
		}
		if (!$this->retur_amt2->FldIsDetailKey) {
			$this->retur_amt2->setFormValue($objForm->GetValue("x_retur_amt2"));
		}
		if (!$this->ret_number3->FldIsDetailKey) {
			$this->ret_number3->setFormValue($objForm->GetValue("x_ret_number3"));
		}
		if (!$this->ret_date3->FldIsDetailKey) {
			$this->ret_date3->setFormValue($objForm->GetValue("x_ret_date3"));
			$this->ret_date3->CurrentValue = ew_UnFormatDateTime($this->ret_date3->CurrentValue, 0);
		}
		if (!$this->retur_amt3->FldIsDetailKey) {
			$this->retur_amt3->setFormValue($objForm->GetValue("x_retur_amt3"));
		}
		if (!$this->tunai_amt->FldIsDetailKey) {
			$this->tunai_amt->setFormValue($objForm->GetValue("x_tunai_amt"));
		}
		if (!$this->dp_amt->FldIsDetailKey) {
			$this->dp_amt->setFormValue($objForm->GetValue("x_dp_amt"));
		}
		if (!$this->km_amt->FldIsDetailKey) {
			$this->km_amt->setFormValue($objForm->GetValue("x_km_amt"));
		}
		if (!$this->km_notes->FldIsDetailKey) {
			$this->km_notes->setFormValue($objForm->GetValue("x_km_notes"));
		}
		if (!$this->kas_amt->FldIsDetailKey) {
			$this->kas_amt->setFormValue($objForm->GetValue("x_kas_amt"));
		}
		if (!$this->kode_depo->FldIsDetailKey) {
			$this->kode_depo->setFormValue($objForm->GetValue("x_kode_depo"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->km_nomor->CurrentValue = $this->km_nomor->FormValue;
		$this->km_tanggal->CurrentValue = $this->km_tanggal->FormValue;
		$this->km_tanggal->CurrentValue = ew_UnFormatDateTime($this->km_tanggal->CurrentValue, 0);
		$this->customer_id->CurrentValue = $this->customer_id->FormValue;
		$this->customer_name->CurrentValue = $this->customer_name->FormValue;
		$this->km_type->CurrentValue = $this->km_type->FormValue;
		$this->km_acc->CurrentValue = $this->km_acc->FormValue;
		$this->cek_no->CurrentValue = $this->cek_no->FormValue;
		$this->tgl_jt->CurrentValue = $this->tgl_jt->FormValue;
		$this->tgl_jt->CurrentValue = ew_UnFormatDateTime($this->tgl_jt->CurrentValue, 0);
		$this->cek_amt->CurrentValue = $this->cek_amt->FormValue;
		$this->ret_number1->CurrentValue = $this->ret_number1->FormValue;
		$this->ret_date1->CurrentValue = $this->ret_date1->FormValue;
		$this->ret_date1->CurrentValue = ew_UnFormatDateTime($this->ret_date1->CurrentValue, 0);
		$this->retur_amt1->CurrentValue = $this->retur_amt1->FormValue;
		$this->ret_number2->CurrentValue = $this->ret_number2->FormValue;
		$this->ret_date2->CurrentValue = $this->ret_date2->FormValue;
		$this->ret_date2->CurrentValue = ew_UnFormatDateTime($this->ret_date2->CurrentValue, 0);
		$this->retur_amt2->CurrentValue = $this->retur_amt2->FormValue;
		$this->ret_number3->CurrentValue = $this->ret_number3->FormValue;
		$this->ret_date3->CurrentValue = $this->ret_date3->FormValue;
		$this->ret_date3->CurrentValue = ew_UnFormatDateTime($this->ret_date3->CurrentValue, 0);
		$this->retur_amt3->CurrentValue = $this->retur_amt3->FormValue;
		$this->tunai_amt->CurrentValue = $this->tunai_amt->FormValue;
		$this->dp_amt->CurrentValue = $this->dp_amt->FormValue;
		$this->km_amt->CurrentValue = $this->km_amt->FormValue;
		$this->km_notes->CurrentValue = $this->km_notes->FormValue;
		$this->kas_amt->CurrentValue = $this->kas_amt->FormValue;
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
		$this->row_id->setDbValue($row['row_id']);
		$this->km_nomor->setDbValue($row['km_nomor']);
		$this->km_tanggal->setDbValue($row['km_tanggal']);
		$this->customer_id->setDbValue($row['customer_id']);
		$this->customer_name->setDbValue($row['customer_name']);
		$this->km_type->setDbValue($row['km_type']);
		$this->km_acc->setDbValue($row['km_acc']);
		$this->cek_no->setDbValue($row['cek_no']);
		$this->tgl_jt->setDbValue($row['tgl_jt']);
		$this->cek_amt->setDbValue($row['cek_amt']);
		$this->ret_number1->setDbValue($row['ret_number1']);
		$this->ret_date1->setDbValue($row['ret_date1']);
		$this->retur_amt1->setDbValue($row['retur_amt1']);
		$this->ret_number2->setDbValue($row['ret_number2']);
		$this->ret_date2->setDbValue($row['ret_date2']);
		$this->retur_amt2->setDbValue($row['retur_amt2']);
		$this->ret_number3->setDbValue($row['ret_number3']);
		$this->ret_date3->setDbValue($row['ret_date3']);
		$this->retur_amt3->setDbValue($row['retur_amt3']);
		$this->tunai_amt->setDbValue($row['tunai_amt']);
		$this->dp_amt->setDbValue($row['dp_amt']);
		$this->km_amt->setDbValue($row['km_amt']);
		$this->km_notes->setDbValue($row['km_notes']);
		$this->kas_amt->setDbValue($row['kas_amt']);
		$this->kode_depo->setDbValue($row['kode_depo']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['row_id'] = $this->row_id->CurrentValue;
		$row['km_nomor'] = $this->km_nomor->CurrentValue;
		$row['km_tanggal'] = $this->km_tanggal->CurrentValue;
		$row['customer_id'] = $this->customer_id->CurrentValue;
		$row['customer_name'] = $this->customer_name->CurrentValue;
		$row['km_type'] = $this->km_type->CurrentValue;
		$row['km_acc'] = $this->km_acc->CurrentValue;
		$row['cek_no'] = $this->cek_no->CurrentValue;
		$row['tgl_jt'] = $this->tgl_jt->CurrentValue;
		$row['cek_amt'] = $this->cek_amt->CurrentValue;
		$row['ret_number1'] = $this->ret_number1->CurrentValue;
		$row['ret_date1'] = $this->ret_date1->CurrentValue;
		$row['retur_amt1'] = $this->retur_amt1->CurrentValue;
		$row['ret_number2'] = $this->ret_number2->CurrentValue;
		$row['ret_date2'] = $this->ret_date2->CurrentValue;
		$row['retur_amt2'] = $this->retur_amt2->CurrentValue;
		$row['ret_number3'] = $this->ret_number3->CurrentValue;
		$row['ret_date3'] = $this->ret_date3->CurrentValue;
		$row['retur_amt3'] = $this->retur_amt3->CurrentValue;
		$row['tunai_amt'] = $this->tunai_amt->CurrentValue;
		$row['dp_amt'] = $this->dp_amt->CurrentValue;
		$row['km_amt'] = $this->km_amt->CurrentValue;
		$row['km_notes'] = $this->km_notes->CurrentValue;
		$row['kas_amt'] = $this->kas_amt->CurrentValue;
		$row['kode_depo'] = $this->kode_depo->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->row_id->DbValue = $row['row_id'];
		$this->km_nomor->DbValue = $row['km_nomor'];
		$this->km_tanggal->DbValue = $row['km_tanggal'];
		$this->customer_id->DbValue = $row['customer_id'];
		$this->customer_name->DbValue = $row['customer_name'];
		$this->km_type->DbValue = $row['km_type'];
		$this->km_acc->DbValue = $row['km_acc'];
		$this->cek_no->DbValue = $row['cek_no'];
		$this->tgl_jt->DbValue = $row['tgl_jt'];
		$this->cek_amt->DbValue = $row['cek_amt'];
		$this->ret_number1->DbValue = $row['ret_number1'];
		$this->ret_date1->DbValue = $row['ret_date1'];
		$this->retur_amt1->DbValue = $row['retur_amt1'];
		$this->ret_number2->DbValue = $row['ret_number2'];
		$this->ret_date2->DbValue = $row['ret_date2'];
		$this->retur_amt2->DbValue = $row['retur_amt2'];
		$this->ret_number3->DbValue = $row['ret_number3'];
		$this->ret_date3->DbValue = $row['ret_date3'];
		$this->retur_amt3->DbValue = $row['retur_amt3'];
		$this->tunai_amt->DbValue = $row['tunai_amt'];
		$this->dp_amt->DbValue = $row['dp_amt'];
		$this->km_amt->DbValue = $row['km_amt'];
		$this->km_notes->DbValue = $row['km_notes'];
		$this->kas_amt->DbValue = $row['kas_amt'];
		$this->kode_depo->DbValue = $row['kode_depo'];
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

		if ($this->cek_amt->FormValue == $this->cek_amt->CurrentValue && is_numeric(ew_StrToFloat($this->cek_amt->CurrentValue)))
			$this->cek_amt->CurrentValue = ew_StrToFloat($this->cek_amt->CurrentValue);

		// Convert decimal values if posted back
		if ($this->retur_amt1->FormValue == $this->retur_amt1->CurrentValue && is_numeric(ew_StrToFloat($this->retur_amt1->CurrentValue)))
			$this->retur_amt1->CurrentValue = ew_StrToFloat($this->retur_amt1->CurrentValue);

		// Convert decimal values if posted back
		if ($this->retur_amt2->FormValue == $this->retur_amt2->CurrentValue && is_numeric(ew_StrToFloat($this->retur_amt2->CurrentValue)))
			$this->retur_amt2->CurrentValue = ew_StrToFloat($this->retur_amt2->CurrentValue);

		// Convert decimal values if posted back
		if ($this->retur_amt3->FormValue == $this->retur_amt3->CurrentValue && is_numeric(ew_StrToFloat($this->retur_amt3->CurrentValue)))
			$this->retur_amt3->CurrentValue = ew_StrToFloat($this->retur_amt3->CurrentValue);

		// Convert decimal values if posted back
		if ($this->tunai_amt->FormValue == $this->tunai_amt->CurrentValue && is_numeric(ew_StrToFloat($this->tunai_amt->CurrentValue)))
			$this->tunai_amt->CurrentValue = ew_StrToFloat($this->tunai_amt->CurrentValue);

		// Convert decimal values if posted back
		if ($this->dp_amt->FormValue == $this->dp_amt->CurrentValue && is_numeric(ew_StrToFloat($this->dp_amt->CurrentValue)))
			$this->dp_amt->CurrentValue = ew_StrToFloat($this->dp_amt->CurrentValue);

		// Convert decimal values if posted back
		if ($this->km_amt->FormValue == $this->km_amt->CurrentValue && is_numeric(ew_StrToFloat($this->km_amt->CurrentValue)))
			$this->km_amt->CurrentValue = ew_StrToFloat($this->km_amt->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// row_id
		// km_nomor
		// km_tanggal
		// customer_id
		// customer_name
		// km_type
		// km_acc
		// cek_no
		// tgl_jt
		// cek_amt
		// ret_number1
		// ret_date1
		// retur_amt1
		// ret_number2
		// ret_date2
		// retur_amt2
		// ret_number3
		// ret_date3
		// retur_amt3
		// tunai_amt
		// dp_amt
		// km_amt
		// km_notes
		// kas_amt
		// kode_depo

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// row_id
		$this->row_id->ViewValue = $this->row_id->CurrentValue;
		$this->row_id->ViewCustomAttributes = "";

		// km_nomor
		$this->km_nomor->ViewValue = $this->km_nomor->CurrentValue;
		$this->km_nomor->ViewCustomAttributes = "";

		// km_tanggal
		$this->km_tanggal->ViewValue = $this->km_tanggal->CurrentValue;
		$this->km_tanggal->ViewValue = ew_FormatDateTime($this->km_tanggal->ViewValue, 0);
		$this->km_tanggal->CellCssStyle .= "text-align: center;";
		$this->km_tanggal->ViewCustomAttributes = "";

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

		// customer_name
		$this->customer_name->ViewValue = $this->customer_name->CurrentValue;
		$this->customer_name->ViewCustomAttributes = "";

		// km_type
		if (strval($this->km_type->CurrentValue) <> "") {
			$this->km_type->ViewValue = $this->km_type->OptionCaption($this->km_type->CurrentValue);
		} else {
			$this->km_type->ViewValue = NULL;
		}
		$this->km_type->ViewCustomAttributes = "";

		// km_acc
		$this->km_acc->ViewValue = $this->km_acc->CurrentValue;
		$this->km_acc->ViewCustomAttributes = "";

		// cek_no
		$this->cek_no->ViewValue = $this->cek_no->CurrentValue;
		$this->cek_no->ViewCustomAttributes = "";

		// tgl_jt
		$this->tgl_jt->ViewValue = $this->tgl_jt->CurrentValue;
		$this->tgl_jt->ViewValue = ew_FormatDateTime($this->tgl_jt->ViewValue, 0);
		$this->tgl_jt->ViewCustomAttributes = "";

		// cek_amt
		$this->cek_amt->ViewValue = $this->cek_amt->CurrentValue;
		$this->cek_amt->ViewValue = ew_FormatNumber($this->cek_amt->ViewValue, 0, -2, -2, -2);
		$this->cek_amt->CellCssStyle .= "text-align: right;";
		$this->cek_amt->ViewCustomAttributes = "";

		// ret_number1
		if (strval($this->ret_number1->CurrentValue) <> "") {
			$sFilterWrk = "`ret_number`" . ew_SearchString("=", $this->ret_number1->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `ret_number`, `ret_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_ret_master`";
		$sWhereWrk = "";
		$this->ret_number1->LookupFilters = array();
		$lookuptblfilter = (isset($_GET["customer_id"]))? "`customer_id` = '".@$_GET["customer_id"]."' AND `kode_depo` = '".@$_SESSION["KodeDepo"]."'" : "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ret_number1, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `ret_number` DESC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->ret_number1->ViewValue = $this->ret_number1->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ret_number1->ViewValue = $this->ret_number1->CurrentValue;
			}
		} else {
			$this->ret_number1->ViewValue = NULL;
		}
		$this->ret_number1->ViewCustomAttributes = "";

		// ret_date1
		$this->ret_date1->ViewValue = $this->ret_date1->CurrentValue;
		$this->ret_date1->ViewValue = ew_FormatDateTime($this->ret_date1->ViewValue, 0);
		$this->ret_date1->CellCssStyle .= "text-align: center;";
		$this->ret_date1->ViewCustomAttributes = "";

		// retur_amt1
		$this->retur_amt1->ViewValue = $this->retur_amt1->CurrentValue;
		$this->retur_amt1->ViewValue = ew_FormatNumber($this->retur_amt1->ViewValue, 0, -2, -2, -2);
		$this->retur_amt1->CellCssStyle .= "text-align: right;";
		$this->retur_amt1->ViewCustomAttributes = "";

		// ret_number2
		if (strval($this->ret_number2->CurrentValue) <> "") {
			$sFilterWrk = "`ret_number`" . ew_SearchString("=", $this->ret_number2->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `ret_number`, `ret_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_ret_master`";
		$sWhereWrk = "";
		$this->ret_number2->LookupFilters = array();
		$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ret_number2, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `ret_number` DESC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->ret_number2->ViewValue = $this->ret_number2->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ret_number2->ViewValue = $this->ret_number2->CurrentValue;
			}
		} else {
			$this->ret_number2->ViewValue = NULL;
		}
		$this->ret_number2->ViewCustomAttributes = "";

		// ret_date2
		$this->ret_date2->ViewValue = $this->ret_date2->CurrentValue;
		$this->ret_date2->ViewValue = ew_FormatDateTime($this->ret_date2->ViewValue, 0);
		$this->ret_date2->CellCssStyle .= "text-align: justify;";
		$this->ret_date2->ViewCustomAttributes = "";

		// retur_amt2
		$this->retur_amt2->ViewValue = $this->retur_amt2->CurrentValue;
		$this->retur_amt2->ViewValue = ew_FormatNumber($this->retur_amt2->ViewValue, 0, -2, -2, -2);
		$this->retur_amt2->CellCssStyle .= "text-align: right;";
		$this->retur_amt2->ViewCustomAttributes = "";

		// ret_number3
		if (strval($this->ret_number3->CurrentValue) <> "") {
			$sFilterWrk = "`ret_number`" . ew_SearchString("=", $this->ret_number3->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `ret_number`, `ret_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_ret_master`";
		$sWhereWrk = "";
		$this->ret_number3->LookupFilters = array();
		$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ret_number3, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `ret_number` DESC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->ret_number3->ViewValue = $this->ret_number3->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ret_number3->ViewValue = $this->ret_number3->CurrentValue;
			}
		} else {
			$this->ret_number3->ViewValue = NULL;
		}
		$this->ret_number3->ViewCustomAttributes = "";

		// ret_date3
		$this->ret_date3->ViewValue = $this->ret_date3->CurrentValue;
		$this->ret_date3->ViewValue = ew_FormatDateTime($this->ret_date3->ViewValue, 0);
		$this->ret_date3->CellCssStyle .= "text-align: center;";
		$this->ret_date3->ViewCustomAttributes = "";

		// retur_amt3
		$this->retur_amt3->ViewValue = $this->retur_amt3->CurrentValue;
		$this->retur_amt3->ViewValue = ew_FormatNumber($this->retur_amt3->ViewValue, 0, -2, -2, -2);
		$this->retur_amt3->CellCssStyle .= "text-align: center;";
		$this->retur_amt3->ViewCustomAttributes = "";

		// tunai_amt
		$this->tunai_amt->ViewValue = $this->tunai_amt->CurrentValue;
		$this->tunai_amt->ViewValue = ew_FormatNumber($this->tunai_amt->ViewValue, 0, -2, -2, -2);
		$this->tunai_amt->CellCssStyle .= "text-align: right;";
		$this->tunai_amt->ViewCustomAttributes = "";

		// dp_amt
		$this->dp_amt->ViewValue = $this->dp_amt->CurrentValue;
		$this->dp_amt->ViewValue = ew_FormatNumber($this->dp_amt->ViewValue, 0, -2, -2, -2);
		$this->dp_amt->CellCssStyle .= "text-align: right;";
		$this->dp_amt->ViewCustomAttributes = "";

		// km_amt
		$this->km_amt->ViewValue = $this->km_amt->CurrentValue;
		$this->km_amt->ViewValue = ew_FormatNumber($this->km_amt->ViewValue, 0, -2, -2, -2);
		$this->km_amt->CellCssStyle .= "text-align: right;";
		$this->km_amt->ViewCustomAttributes = "";

		// km_notes
		$this->km_notes->ViewValue = $this->km_notes->CurrentValue;
		$this->km_notes->ViewCustomAttributes = "";

		// kas_amt
		$this->kas_amt->ViewValue = $this->kas_amt->CurrentValue;
		$this->kas_amt->CellCssStyle .= "text-align: right;";
		$this->kas_amt->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

			// km_nomor
			$this->km_nomor->LinkCustomAttributes = "";
			$this->km_nomor->HrefValue = "";
			$this->km_nomor->TooltipValue = "";

			// km_tanggal
			$this->km_tanggal->LinkCustomAttributes = "";
			$this->km_tanggal->HrefValue = "";
			$this->km_tanggal->TooltipValue = "";

			// customer_id
			$this->customer_id->LinkCustomAttributes = "";
			$this->customer_id->HrefValue = "";
			$this->customer_id->TooltipValue = "";

			// customer_name
			$this->customer_name->LinkCustomAttributes = "";
			$this->customer_name->HrefValue = "";
			$this->customer_name->TooltipValue = "";

			// km_type
			$this->km_type->LinkCustomAttributes = "";
			$this->km_type->HrefValue = "";
			$this->km_type->TooltipValue = "";

			// km_acc
			$this->km_acc->LinkCustomAttributes = "";
			$this->km_acc->HrefValue = "";
			$this->km_acc->TooltipValue = "";

			// cek_no
			$this->cek_no->LinkCustomAttributes = "";
			$this->cek_no->HrefValue = "";
			$this->cek_no->TooltipValue = "";

			// tgl_jt
			$this->tgl_jt->LinkCustomAttributes = "";
			$this->tgl_jt->HrefValue = "";
			$this->tgl_jt->TooltipValue = "";

			// cek_amt
			$this->cek_amt->LinkCustomAttributes = "";
			$this->cek_amt->HrefValue = "";
			$this->cek_amt->TooltipValue = "";

			// ret_number1
			$this->ret_number1->LinkCustomAttributes = "";
			$this->ret_number1->HrefValue = "";
			$this->ret_number1->TooltipValue = "";

			// ret_date1
			$this->ret_date1->LinkCustomAttributes = "";
			$this->ret_date1->HrefValue = "";
			$this->ret_date1->TooltipValue = "";

			// retur_amt1
			$this->retur_amt1->LinkCustomAttributes = "";
			$this->retur_amt1->HrefValue = "";
			$this->retur_amt1->TooltipValue = "";

			// ret_number2
			$this->ret_number2->LinkCustomAttributes = "";
			$this->ret_number2->HrefValue = "";
			$this->ret_number2->TooltipValue = "";

			// ret_date2
			$this->ret_date2->LinkCustomAttributes = "";
			$this->ret_date2->HrefValue = "";
			$this->ret_date2->TooltipValue = "";

			// retur_amt2
			$this->retur_amt2->LinkCustomAttributes = "";
			$this->retur_amt2->HrefValue = "";
			$this->retur_amt2->TooltipValue = "";

			// ret_number3
			$this->ret_number3->LinkCustomAttributes = "";
			$this->ret_number3->HrefValue = "";
			$this->ret_number3->TooltipValue = "";

			// ret_date3
			$this->ret_date3->LinkCustomAttributes = "";
			$this->ret_date3->HrefValue = "";
			$this->ret_date3->TooltipValue = "";

			// retur_amt3
			$this->retur_amt3->LinkCustomAttributes = "";
			$this->retur_amt3->HrefValue = "";
			$this->retur_amt3->TooltipValue = "";

			// tunai_amt
			$this->tunai_amt->LinkCustomAttributes = "";
			$this->tunai_amt->HrefValue = "";
			$this->tunai_amt->TooltipValue = "";

			// dp_amt
			$this->dp_amt->LinkCustomAttributes = "";
			$this->dp_amt->HrefValue = "";
			$this->dp_amt->TooltipValue = "";

			// km_amt
			$this->km_amt->LinkCustomAttributes = "";
			$this->km_amt->HrefValue = "";
			$this->km_amt->TooltipValue = "";

			// km_notes
			$this->km_notes->LinkCustomAttributes = "";
			$this->km_notes->HrefValue = "";
			$this->km_notes->TooltipValue = "";

			// kas_amt
			$this->kas_amt->LinkCustomAttributes = "";
			$this->kas_amt->HrefValue = "";
			$this->kas_amt->TooltipValue = "";

			// kode_depo
			$this->kode_depo->LinkCustomAttributes = "";
			$this->kode_depo->HrefValue = "";
			$this->kode_depo->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// km_nomor
			$this->km_nomor->EditAttrs["class"] = "form-control";
			$this->km_nomor->EditCustomAttributes = "";
			$this->km_nomor->EditValue = ew_HtmlEncode($this->km_nomor->CurrentValue);
			$this->km_nomor->PlaceHolder = ew_RemoveHtml($this->km_nomor->FldCaption());

			// km_tanggal
			$this->km_tanggal->EditAttrs["class"] = "form-control";
			$this->km_tanggal->EditCustomAttributes = "";
			$this->km_tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->km_tanggal->CurrentValue, 8));
			$this->km_tanggal->PlaceHolder = ew_RemoveHtml($this->km_tanggal->FldCaption());

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

			// customer_name
			$this->customer_name->EditAttrs["class"] = "form-control";
			$this->customer_name->EditCustomAttributes = "";
			$this->customer_name->EditValue = ew_HtmlEncode($this->customer_name->CurrentValue);
			$this->customer_name->PlaceHolder = ew_RemoveHtml($this->customer_name->FldCaption());

			// km_type
			$this->km_type->EditCustomAttributes = "";
			$this->km_type->EditValue = $this->km_type->Options(FALSE);

			// km_acc
			$this->km_acc->EditAttrs["class"] = "form-control";
			$this->km_acc->EditCustomAttributes = "";
			$this->km_acc->EditValue = ew_HtmlEncode($this->km_acc->CurrentValue);
			$this->km_acc->PlaceHolder = ew_RemoveHtml($this->km_acc->FldCaption());

			// cek_no
			$this->cek_no->EditAttrs["class"] = "form-control";
			$this->cek_no->EditCustomAttributes = "";
			$this->cek_no->EditValue = ew_HtmlEncode($this->cek_no->CurrentValue);
			$this->cek_no->PlaceHolder = ew_RemoveHtml($this->cek_no->FldCaption());

			// tgl_jt
			$this->tgl_jt->EditAttrs["class"] = "form-control";
			$this->tgl_jt->EditCustomAttributes = "";
			$this->tgl_jt->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->tgl_jt->CurrentValue, 8));
			$this->tgl_jt->PlaceHolder = ew_RemoveHtml($this->tgl_jt->FldCaption());

			// cek_amt
			$this->cek_amt->EditAttrs["class"] = "form-control";
			$this->cek_amt->EditCustomAttributes = "";
			$this->cek_amt->EditValue = ew_HtmlEncode($this->cek_amt->CurrentValue);
			$this->cek_amt->PlaceHolder = ew_RemoveHtml($this->cek_amt->FldCaption());
			if (strval($this->cek_amt->EditValue) <> "" && is_numeric($this->cek_amt->EditValue)) $this->cek_amt->EditValue = ew_FormatNumber($this->cek_amt->EditValue, -2, -2, -2, -2);

			// ret_number1
			$this->ret_number1->EditCustomAttributes = "";
			if (trim(strval($this->ret_number1->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`ret_number`" . ew_SearchString("=", $this->ret_number1->CurrentValue, EW_DATATYPE_STRING, "");
			}
			$sSqlWrk = "SELECT `ret_number`, `ret_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tr_ret_master`";
			$sWhereWrk = "";
			$this->ret_number1->LookupFilters = array();
			$lookuptblfilter = (isset($_GET["customer_id"]))? "`customer_id` = '".@$_GET["customer_id"]."' AND `kode_depo` = '".@$_SESSION["KodeDepo"]."'" : "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->ret_number1, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `ret_number` DESC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->ret_number1->ViewValue = $this->ret_number1->DisplayValue($arwrk);
			} else {
				$this->ret_number1->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->ret_number1->EditValue = $arwrk;

			// ret_date1
			$this->ret_date1->EditAttrs["class"] = "form-control";
			$this->ret_date1->EditCustomAttributes = "";
			$this->ret_date1->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ret_date1->CurrentValue, 8));
			$this->ret_date1->PlaceHolder = ew_RemoveHtml($this->ret_date1->FldCaption());

			// retur_amt1
			$this->retur_amt1->EditAttrs["class"] = "form-control";
			$this->retur_amt1->EditCustomAttributes = "";
			$this->retur_amt1->EditValue = ew_HtmlEncode($this->retur_amt1->CurrentValue);
			$this->retur_amt1->PlaceHolder = ew_RemoveHtml($this->retur_amt1->FldCaption());
			if (strval($this->retur_amt1->EditValue) <> "" && is_numeric($this->retur_amt1->EditValue)) $this->retur_amt1->EditValue = ew_FormatNumber($this->retur_amt1->EditValue, -2, -2, -2, -2);

			// ret_number2
			$this->ret_number2->EditCustomAttributes = "";
			if (trim(strval($this->ret_number2->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`ret_number`" . ew_SearchString("=", $this->ret_number2->CurrentValue, EW_DATATYPE_STRING, "");
			}
			$sSqlWrk = "SELECT `ret_number`, `ret_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tr_ret_master`";
			$sWhereWrk = "";
			$this->ret_number2->LookupFilters = array();
			$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->ret_number2, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `ret_number` DESC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->ret_number2->ViewValue = $this->ret_number2->DisplayValue($arwrk);
			} else {
				$this->ret_number2->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->ret_number2->EditValue = $arwrk;

			// ret_date2
			$this->ret_date2->EditAttrs["class"] = "form-control";
			$this->ret_date2->EditCustomAttributes = "";
			$this->ret_date2->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ret_date2->CurrentValue, 8));
			$this->ret_date2->PlaceHolder = ew_RemoveHtml($this->ret_date2->FldCaption());

			// retur_amt2
			$this->retur_amt2->EditAttrs["class"] = "form-control";
			$this->retur_amt2->EditCustomAttributes = "";
			$this->retur_amt2->EditValue = ew_HtmlEncode($this->retur_amt2->CurrentValue);
			$this->retur_amt2->PlaceHolder = ew_RemoveHtml($this->retur_amt2->FldCaption());
			if (strval($this->retur_amt2->EditValue) <> "" && is_numeric($this->retur_amt2->EditValue)) $this->retur_amt2->EditValue = ew_FormatNumber($this->retur_amt2->EditValue, -2, -2, -2, -2);

			// ret_number3
			$this->ret_number3->EditCustomAttributes = "";
			if (trim(strval($this->ret_number3->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`ret_number`" . ew_SearchString("=", $this->ret_number3->CurrentValue, EW_DATATYPE_STRING, "");
			}
			$sSqlWrk = "SELECT `ret_number`, `ret_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tr_ret_master`";
			$sWhereWrk = "";
			$this->ret_number3->LookupFilters = array();
			$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->ret_number3, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `ret_number` DESC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->ret_number3->ViewValue = $this->ret_number3->DisplayValue($arwrk);
			} else {
				$this->ret_number3->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->ret_number3->EditValue = $arwrk;

			// ret_date3
			$this->ret_date3->EditAttrs["class"] = "form-control";
			$this->ret_date3->EditCustomAttributes = "";
			$this->ret_date3->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ret_date3->CurrentValue, 8));
			$this->ret_date3->PlaceHolder = ew_RemoveHtml($this->ret_date3->FldCaption());

			// retur_amt3
			$this->retur_amt3->EditAttrs["class"] = "form-control";
			$this->retur_amt3->EditCustomAttributes = "";
			$this->retur_amt3->EditValue = ew_HtmlEncode($this->retur_amt3->CurrentValue);
			$this->retur_amt3->PlaceHolder = ew_RemoveHtml($this->retur_amt3->FldCaption());
			if (strval($this->retur_amt3->EditValue) <> "" && is_numeric($this->retur_amt3->EditValue)) $this->retur_amt3->EditValue = ew_FormatNumber($this->retur_amt3->EditValue, -2, -2, -2, -2);

			// tunai_amt
			$this->tunai_amt->EditAttrs["class"] = "form-control";
			$this->tunai_amt->EditCustomAttributes = "";
			$this->tunai_amt->EditValue = ew_HtmlEncode($this->tunai_amt->CurrentValue);
			$this->tunai_amt->PlaceHolder = ew_RemoveHtml($this->tunai_amt->FldCaption());
			if (strval($this->tunai_amt->EditValue) <> "" && is_numeric($this->tunai_amt->EditValue)) $this->tunai_amt->EditValue = ew_FormatNumber($this->tunai_amt->EditValue, -2, -2, -2, -2);

			// dp_amt
			$this->dp_amt->EditAttrs["class"] = "form-control";
			$this->dp_amt->EditCustomAttributes = "";
			$this->dp_amt->EditValue = ew_HtmlEncode($this->dp_amt->CurrentValue);
			$this->dp_amt->PlaceHolder = ew_RemoveHtml($this->dp_amt->FldCaption());
			if (strval($this->dp_amt->EditValue) <> "" && is_numeric($this->dp_amt->EditValue)) $this->dp_amt->EditValue = ew_FormatNumber($this->dp_amt->EditValue, -2, -2, -2, -2);

			// km_amt
			$this->km_amt->EditAttrs["class"] = "form-control";
			$this->km_amt->EditCustomAttributes = "";
			$this->km_amt->EditValue = ew_HtmlEncode($this->km_amt->CurrentValue);
			$this->km_amt->PlaceHolder = ew_RemoveHtml($this->km_amt->FldCaption());
			if (strval($this->km_amt->EditValue) <> "" && is_numeric($this->km_amt->EditValue)) $this->km_amt->EditValue = ew_FormatNumber($this->km_amt->EditValue, -2, -2, -2, -2);

			// km_notes
			$this->km_notes->EditAttrs["class"] = "form-control";
			$this->km_notes->EditCustomAttributes = "";
			$this->km_notes->EditValue = ew_HtmlEncode($this->km_notes->CurrentValue);
			$this->km_notes->PlaceHolder = ew_RemoveHtml($this->km_notes->FldCaption());

			// kas_amt
			$this->kas_amt->EditAttrs["class"] = "form-control";
			$this->kas_amt->EditCustomAttributes = "";
			$this->kas_amt->EditValue = ew_HtmlEncode($this->kas_amt->CurrentValue);
			$this->kas_amt->PlaceHolder = ew_RemoveHtml($this->kas_amt->FldCaption());

			// kode_depo
			$this->kode_depo->EditAttrs["class"] = "form-control";
			$this->kode_depo->EditCustomAttributes = "";
			$this->kode_depo->EditValue = ew_HtmlEncode($this->kode_depo->CurrentValue);
			$this->kode_depo->PlaceHolder = ew_RemoveHtml($this->kode_depo->FldCaption());

			// Add refer script
			// km_nomor

			$this->km_nomor->LinkCustomAttributes = "";
			$this->km_nomor->HrefValue = "";

			// km_tanggal
			$this->km_tanggal->LinkCustomAttributes = "";
			$this->km_tanggal->HrefValue = "";

			// customer_id
			$this->customer_id->LinkCustomAttributes = "";
			$this->customer_id->HrefValue = "";

			// customer_name
			$this->customer_name->LinkCustomAttributes = "";
			$this->customer_name->HrefValue = "";

			// km_type
			$this->km_type->LinkCustomAttributes = "";
			$this->km_type->HrefValue = "";

			// km_acc
			$this->km_acc->LinkCustomAttributes = "";
			$this->km_acc->HrefValue = "";

			// cek_no
			$this->cek_no->LinkCustomAttributes = "";
			$this->cek_no->HrefValue = "";

			// tgl_jt
			$this->tgl_jt->LinkCustomAttributes = "";
			$this->tgl_jt->HrefValue = "";

			// cek_amt
			$this->cek_amt->LinkCustomAttributes = "";
			$this->cek_amt->HrefValue = "";

			// ret_number1
			$this->ret_number1->LinkCustomAttributes = "";
			$this->ret_number1->HrefValue = "";

			// ret_date1
			$this->ret_date1->LinkCustomAttributes = "";
			$this->ret_date1->HrefValue = "";

			// retur_amt1
			$this->retur_amt1->LinkCustomAttributes = "";
			$this->retur_amt1->HrefValue = "";

			// ret_number2
			$this->ret_number2->LinkCustomAttributes = "";
			$this->ret_number2->HrefValue = "";

			// ret_date2
			$this->ret_date2->LinkCustomAttributes = "";
			$this->ret_date2->HrefValue = "";

			// retur_amt2
			$this->retur_amt2->LinkCustomAttributes = "";
			$this->retur_amt2->HrefValue = "";

			// ret_number3
			$this->ret_number3->LinkCustomAttributes = "";
			$this->ret_number3->HrefValue = "";

			// ret_date3
			$this->ret_date3->LinkCustomAttributes = "";
			$this->ret_date3->HrefValue = "";

			// retur_amt3
			$this->retur_amt3->LinkCustomAttributes = "";
			$this->retur_amt3->HrefValue = "";

			// tunai_amt
			$this->tunai_amt->LinkCustomAttributes = "";
			$this->tunai_amt->HrefValue = "";

			// dp_amt
			$this->dp_amt->LinkCustomAttributes = "";
			$this->dp_amt->HrefValue = "";

			// km_amt
			$this->km_amt->LinkCustomAttributes = "";
			$this->km_amt->HrefValue = "";

			// km_notes
			$this->km_notes->LinkCustomAttributes = "";
			$this->km_notes->HrefValue = "";

			// kas_amt
			$this->kas_amt->LinkCustomAttributes = "";
			$this->kas_amt->HrefValue = "";

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
		if (!ew_CheckDateDef($this->km_tanggal->FormValue)) {
			ew_AddMessage($gsFormError, $this->km_tanggal->FldErrMsg());
		}
		if (!ew_CheckInteger($this->customer_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->customer_id->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->tgl_jt->FormValue)) {
			ew_AddMessage($gsFormError, $this->tgl_jt->FldErrMsg());
		}
		if (!ew_CheckNumber($this->cek_amt->FormValue)) {
			ew_AddMessage($gsFormError, $this->cek_amt->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->ret_date1->FormValue)) {
			ew_AddMessage($gsFormError, $this->ret_date1->FldErrMsg());
		}
		if (!ew_CheckNumber($this->retur_amt1->FormValue)) {
			ew_AddMessage($gsFormError, $this->retur_amt1->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->ret_date2->FormValue)) {
			ew_AddMessage($gsFormError, $this->ret_date2->FldErrMsg());
		}
		if (!ew_CheckNumber($this->retur_amt2->FormValue)) {
			ew_AddMessage($gsFormError, $this->retur_amt2->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->ret_date3->FormValue)) {
			ew_AddMessage($gsFormError, $this->ret_date3->FldErrMsg());
		}
		if (!ew_CheckNumber($this->retur_amt3->FormValue)) {
			ew_AddMessage($gsFormError, $this->retur_amt3->FldErrMsg());
		}
		if (!ew_CheckNumber($this->tunai_amt->FormValue)) {
			ew_AddMessage($gsFormError, $this->tunai_amt->FldErrMsg());
		}
		if (!ew_CheckNumber($this->dp_amt->FormValue)) {
			ew_AddMessage($gsFormError, $this->dp_amt->FldErrMsg());
		}
		if (!ew_CheckNumber($this->km_amt->FormValue)) {
			ew_AddMessage($gsFormError, $this->km_amt->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("tr_km_item_ar", $DetailTblVar) && $GLOBALS["tr_km_item_ar"]->DetailAdd) {
			if (!isset($GLOBALS["tr_km_item_ar_grid"])) $GLOBALS["tr_km_item_ar_grid"] = new ctr_km_item_ar_grid(); // get detail page object
			$GLOBALS["tr_km_item_ar_grid"]->ValidateGridForm();
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

		// km_nomor
		$this->km_nomor->SetDbValueDef($rsnew, $this->km_nomor->CurrentValue, NULL, FALSE);

		// km_tanggal
		$this->km_tanggal->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->km_tanggal->CurrentValue, 0), NULL, FALSE);

		// customer_id
		$this->customer_id->SetDbValueDef($rsnew, $this->customer_id->CurrentValue, NULL, FALSE);

		// customer_name
		$this->customer_name->SetDbValueDef($rsnew, $this->customer_name->CurrentValue, NULL, FALSE);

		// km_type
		$this->km_type->SetDbValueDef($rsnew, $this->km_type->CurrentValue, NULL, strval($this->km_type->CurrentValue) == "");

		// km_acc
		$this->km_acc->SetDbValueDef($rsnew, $this->km_acc->CurrentValue, NULL, FALSE);

		// cek_no
		$this->cek_no->SetDbValueDef($rsnew, $this->cek_no->CurrentValue, NULL, FALSE);

		// tgl_jt
		$this->tgl_jt->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->tgl_jt->CurrentValue, 0), NULL, FALSE);

		// cek_amt
		$this->cek_amt->SetDbValueDef($rsnew, $this->cek_amt->CurrentValue, NULL, FALSE);

		// ret_number1
		$this->ret_number1->SetDbValueDef($rsnew, $this->ret_number1->CurrentValue, NULL, FALSE);

		// ret_date1
		$this->ret_date1->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ret_date1->CurrentValue, 0), NULL, FALSE);

		// retur_amt1
		$this->retur_amt1->SetDbValueDef($rsnew, $this->retur_amt1->CurrentValue, NULL, FALSE);

		// ret_number2
		$this->ret_number2->SetDbValueDef($rsnew, $this->ret_number2->CurrentValue, NULL, FALSE);

		// ret_date2
		$this->ret_date2->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ret_date2->CurrentValue, 0), NULL, FALSE);

		// retur_amt2
		$this->retur_amt2->SetDbValueDef($rsnew, $this->retur_amt2->CurrentValue, NULL, FALSE);

		// ret_number3
		$this->ret_number3->SetDbValueDef($rsnew, $this->ret_number3->CurrentValue, NULL, FALSE);

		// ret_date3
		$this->ret_date3->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ret_date3->CurrentValue, 0), NULL, FALSE);

		// retur_amt3
		$this->retur_amt3->SetDbValueDef($rsnew, $this->retur_amt3->CurrentValue, NULL, FALSE);

		// tunai_amt
		$this->tunai_amt->SetDbValueDef($rsnew, $this->tunai_amt->CurrentValue, NULL, FALSE);

		// dp_amt
		$this->dp_amt->SetDbValueDef($rsnew, $this->dp_amt->CurrentValue, NULL, FALSE);

		// km_amt
		$this->km_amt->SetDbValueDef($rsnew, $this->km_amt->CurrentValue, NULL, FALSE);

		// km_notes
		$this->km_notes->SetDbValueDef($rsnew, $this->km_notes->CurrentValue, NULL, FALSE);

		// kas_amt
		$this->kas_amt->SetDbValueDef($rsnew, $this->kas_amt->CurrentValue, "", FALSE);

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
			if (in_array("tr_km_item_ar", $DetailTblVar) && $GLOBALS["tr_km_item_ar"]->DetailAdd) {
				$GLOBALS["tr_km_item_ar"]->master_id->setSessionValue($this->row_id->CurrentValue); // Set master key
				if (!isset($GLOBALS["tr_km_item_ar_grid"])) $GLOBALS["tr_km_item_ar_grid"] = new ctr_km_item_ar_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "tr_km_item_ar"); // Load user level of detail table
				$AddRow = $GLOBALS["tr_km_item_ar_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["tr_km_item_ar"]->master_id->setSessionValue(""); // Clear master key if insert failed
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
			if (in_array("tr_km_item_ar", $DetailTblVar)) {
				if (!isset($GLOBALS["tr_km_item_ar_grid"]))
					$GLOBALS["tr_km_item_ar_grid"] = new ctr_km_item_ar_grid;
				if ($GLOBALS["tr_km_item_ar_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["tr_km_item_ar_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["tr_km_item_ar_grid"]->CurrentMode = "add";
					$GLOBALS["tr_km_item_ar_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["tr_km_item_ar_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["tr_km_item_ar_grid"]->setStartRecordNumber(1);
					$GLOBALS["tr_km_item_ar_grid"]->master_id->FldIsDetailKey = TRUE;
					$GLOBALS["tr_km_item_ar_grid"]->master_id->CurrentValue = $this->row_id->CurrentValue;
					$GLOBALS["tr_km_item_ar_grid"]->master_id->setSessionValue($GLOBALS["tr_km_item_ar_grid"]->master_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_km_master_arlist.php"), "", $this->TableVar, TRUE);
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
		case "x_ret_number1":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `ret_number` AS `LinkFld`, `ret_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_ret_master`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$lookuptblfilter = (isset($_GET["customer_id"]))? "`customer_id` = '".@$_GET["customer_id"]."' AND `kode_depo` = '".@$_SESSION["KodeDepo"]."'" : "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`ret_number` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->ret_number1, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `ret_number` DESC";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_ret_number2":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `ret_number` AS `LinkFld`, `ret_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_ret_master`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`ret_number` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->ret_number2, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `ret_number` DESC";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_ret_number3":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `ret_number` AS `LinkFld`, `ret_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_ret_master`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`ret_number` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->ret_number3, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `ret_number` DESC";
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
if (!isset($tr_km_master_ar_add)) $tr_km_master_ar_add = new ctr_km_master_ar_add();

// Page init
$tr_km_master_ar_add->Page_Init();

// Page main
$tr_km_master_ar_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_km_master_ar_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ftr_km_master_aradd = new ew_Form("ftr_km_master_aradd", "add");

// Validate form
ftr_km_master_aradd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_km_tanggal");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->km_tanggal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_customer_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->customer_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_tgl_jt");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->tgl_jt->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_cek_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->cek_amt->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ret_date1");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->ret_date1->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_retur_amt1");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->retur_amt1->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ret_date2");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->ret_date2->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_retur_amt2");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->retur_amt2->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ret_date3");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->ret_date3->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_retur_amt3");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->retur_amt3->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_tunai_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->tunai_amt->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_dp_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->dp_amt->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_km_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_master_ar->km_amt->FldErrMsg()) ?>");

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
ftr_km_master_aradd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_km_master_aradd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_km_master_aradd.Lists["x_customer_id"] = {"LinkField":"x_customer_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_customer_name","","",""],"ParentFields":[],"ChildFields":["tr_km_item_ar x_customer_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_customer"};
ftr_km_master_aradd.Lists["x_customer_id"].Data = "<?php echo $tr_km_master_ar_add->customer_id->LookupFilterQuery(FALSE, "add") ?>";
ftr_km_master_aradd.AutoSuggests["x_customer_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $tr_km_master_ar_add->customer_id->LookupFilterQuery(TRUE, "add"))) ?>;
ftr_km_master_aradd.Lists["x_km_type"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftr_km_master_aradd.Lists["x_km_type"].Options = <?php echo json_encode($tr_km_master_ar_add->km_type->Options()) ?>;
ftr_km_master_aradd.Lists["x_ret_number1"] = {"LinkField":"x_ret_number","Ajax":true,"AutoFill":true,"DisplayFields":["x_ret_number","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tr_ret_master"};
ftr_km_master_aradd.Lists["x_ret_number1"].Data = "<?php echo $tr_km_master_ar_add->ret_number1->LookupFilterQuery(FALSE, "add") ?>";
ftr_km_master_aradd.Lists["x_ret_number2"] = {"LinkField":"x_ret_number","Ajax":true,"AutoFill":true,"DisplayFields":["x_ret_number","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tr_ret_master"};
ftr_km_master_aradd.Lists["x_ret_number2"].Data = "<?php echo $tr_km_master_ar_add->ret_number2->LookupFilterQuery(FALSE, "add") ?>";
ftr_km_master_aradd.Lists["x_ret_number3"] = {"LinkField":"x_ret_number","Ajax":true,"AutoFill":true,"DisplayFields":["x_ret_number","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tr_ret_master"};
ftr_km_master_aradd.Lists["x_ret_number3"].Data = "<?php echo $tr_km_master_ar_add->ret_number3->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tr_km_master_ar_add->ShowPageHeader(); ?>
<?php
$tr_km_master_ar_add->ShowMessage();
?>
<form name="ftr_km_master_aradd" id="ftr_km_master_aradd" class="<?php echo $tr_km_master_ar_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_km_master_ar_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_km_master_ar_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_km_master_ar">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($tr_km_master_ar_add->IsModal) ?>">
<div id="tpd_tr_km_master_aradd" class="ewCustomTemplate"></div>
<script id="tpm_tr_km_master_aradd" type="text/html">
<div id="ct_tr_km_master_ar_add"><div class="col-sm-12">
	<div class="row">
		<div class="col-sm-5">
			<div class="row field-br">
				<div class="col-sm-2 tittle"><?php echo $tr_km_master_ar->km_nomor->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_km_nomor"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-2 tittle"><?php echo $tr_km_master_ar->km_tanggal->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_km_tanggal"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-2 tittle"><?php echo $tr_km_master_ar->km_acc->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_km_acc"/}}</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-5">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->customer_id->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_customer_id"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->km_notes->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_km_notes"/}}</div>
			</div>
		</div>
	</div>
	<div class="row panel-custom">
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->cek_no->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_cek_no"/}}</div>
			</div>
		</div>
		<div class="col-sm-4 col-sm-offset-1">
			<div class="row">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->tgl_jt->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_tgl_jt"/}}</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="row">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->cek_amt->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_cek_amt"/}}</div>
			</div>
		</div>
	</div>
	<div class="row panel-custom">
		<div class="col-sm-4">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->ret_number1->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_ret_number1"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->ret_number2->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_ret_number2"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->ret_number3->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_ret_number3"/}}</div>
			</div>
		</div>
		<div class="col-sm-3 col-sm-offset-1">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->ret_date1->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_ret_date1"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->ret_date2->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_ret_date2"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->ret_date3->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_ret_date3"/}}</div>
			</div>
		</div>
		<div class="col-sm-3 col-sm-offset-1">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->retur_amt1->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_retur_amt1"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->retur_amt2->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_retur_amt2"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar->retur_amt3->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar_retur_amt3"/}}</div>
			</div>
		</div>
	</div>
	<div class="row panel-custom">
		<div class="col-sm-4 ">
			<div class="row field-br">
				<div class="col-sm-4 tittle"><?php echo $tr_km_master_ar->tunai_amt->FldCaption() ?></div>
				<div class="col-sm-8">{{include tmpl="#tpx_tr_km_master_ar_tunai_amt"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-4 tittle"><?php echo $tr_km_master_ar->km_amt->FldCaption() ?></div>
				<div class="col-sm-8">{{include tmpl="#tpx_tr_km_master_ar_km_amt"/}}</div>
			</div>
		</div>
		<div class="col-sm-5 col-sm-offset-3">
			<div class="row field-br">
				<div class="col-sm-5 tittle"><?php echo $tr_km_master_ar->dp_amt->FldCaption() ?></div>
				<div class="col-sm-7">{{include tmpl="#tpx_tr_km_master_ar_dp_amt"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-5 tittle"><?php echo $tr_km_master_ar->kas_amt->FldCaption() ?></div>
				<div class="col-sm-7">{{include tmpl="#tpx_tr_km_master_ar_kas_amt"/}}</div>
			</div>
		</div>
	</div>
</div>
</div>
</script>
<?php if (!$tr_km_master_ar_add->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
<div class="ewAddDiv hidden"><!-- page* -->
<?php } else { ?>
<table id="tbl_tr_km_master_aradd" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable hidden"><!-- table* -->
<?php } ?>
<?php if ($tr_km_master_ar->km_nomor->Visible) { // km_nomor ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_km_nomor" class="form-group">
		<label id="elh_tr_km_master_ar_km_nomor" for="x_km_nomor" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_km_nomor" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->km_nomor->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->km_nomor->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_km_nomor" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_km_nomor">
<input type="text" data-table="tr_km_master_ar" data-field="x_km_nomor" name="x_km_nomor" id="x_km_nomor" size="30" maxlength="12" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->km_nomor->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->km_nomor->EditValue ?>"<?php echo $tr_km_master_ar->km_nomor->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->km_nomor->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_km_nomor">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_km_nomor"><script id="tpc_tr_km_master_ar_km_nomor" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->km_nomor->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->km_nomor->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_km_nomor" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_km_nomor">
<input type="text" data-table="tr_km_master_ar" data-field="x_km_nomor" name="x_km_nomor" id="x_km_nomor" size="30" maxlength="12" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->km_nomor->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->km_nomor->EditValue ?>"<?php echo $tr_km_master_ar->km_nomor->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->km_nomor->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->km_tanggal->Visible) { // km_tanggal ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_km_tanggal" class="form-group">
		<label id="elh_tr_km_master_ar_km_tanggal" for="x_km_tanggal" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_km_tanggal" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->km_tanggal->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->km_tanggal->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_km_tanggal" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_km_tanggal">
<input type="text" data-table="tr_km_master_ar" data-field="x_km_tanggal" name="x_km_tanggal" id="x_km_tanggal" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->km_tanggal->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->km_tanggal->EditValue ?>"<?php echo $tr_km_master_ar->km_tanggal->EditAttributes() ?>>
<?php if (!$tr_km_master_ar->km_tanggal->ReadOnly && !$tr_km_master_ar->km_tanggal->Disabled && !isset($tr_km_master_ar->km_tanggal->EditAttrs["readonly"]) && !isset($tr_km_master_ar->km_tanggal->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_km_master_aradd_js">
ew_CreateDateTimePicker("ftr_km_master_aradd", "x_km_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_km_master_ar->km_tanggal->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_km_tanggal">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_km_tanggal"><script id="tpc_tr_km_master_ar_km_tanggal" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->km_tanggal->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->km_tanggal->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_km_tanggal" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_km_tanggal">
<input type="text" data-table="tr_km_master_ar" data-field="x_km_tanggal" name="x_km_tanggal" id="x_km_tanggal" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->km_tanggal->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->km_tanggal->EditValue ?>"<?php echo $tr_km_master_ar->km_tanggal->EditAttributes() ?>>
<?php if (!$tr_km_master_ar->km_tanggal->ReadOnly && !$tr_km_master_ar->km_tanggal->Disabled && !isset($tr_km_master_ar->km_tanggal->EditAttrs["readonly"]) && !isset($tr_km_master_ar->km_tanggal->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_km_master_aradd_js">
ew_CreateDateTimePicker("ftr_km_master_aradd", "x_km_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_km_master_ar->km_tanggal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->customer_id->Visible) { // customer_id ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_customer_id" class="form-group">
		<label id="elh_tr_km_master_ar_customer_id" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_customer_id" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->customer_id->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->customer_id->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_customer_id" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_customer_id">
<?php
$wrkonchange = trim("ew_UpdateOpt.call(this); " . @$tr_km_master_ar->customer_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_km_master_ar->customer_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_customer_id" style="white-space: nowrap; z-index: 8960">
	<input type="text" name="sv_x_customer_id" id="sv_x_customer_id" value="<?php echo $tr_km_master_ar->customer_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->customer_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->customer_id->getPlaceHolder()) ?>"<?php echo $tr_km_master_ar->customer_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_km_master_ar" data-field="x_customer_id" data-value-separator="<?php echo $tr_km_master_ar->customer_id->DisplayValueSeparatorAttribute() ?>" name="x_customer_id" id="x_customer_id" value="<?php echo ew_HtmlEncode($tr_km_master_ar->customer_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
</span>
</script>
<script type="text/html" class="tr_km_master_aradd_js">
ftr_km_master_aradd.CreateAutoSuggest({"id":"x_customer_id","forceSelect":true});
</script>
<?php echo $tr_km_master_ar->customer_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_customer_id">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_customer_id"><script id="tpc_tr_km_master_ar_customer_id" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->customer_id->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->customer_id->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_customer_id" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_customer_id">
<?php
$wrkonchange = trim("ew_UpdateOpt.call(this); " . @$tr_km_master_ar->customer_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_km_master_ar->customer_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_customer_id" style="white-space: nowrap; z-index: 8960">
	<input type="text" name="sv_x_customer_id" id="sv_x_customer_id" value="<?php echo $tr_km_master_ar->customer_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->customer_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->customer_id->getPlaceHolder()) ?>"<?php echo $tr_km_master_ar->customer_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_km_master_ar" data-field="x_customer_id" data-value-separator="<?php echo $tr_km_master_ar->customer_id->DisplayValueSeparatorAttribute() ?>" name="x_customer_id" id="x_customer_id" value="<?php echo ew_HtmlEncode($tr_km_master_ar->customer_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
</span>
</script>
<script type="text/html" class="tr_km_master_aradd_js">
ftr_km_master_aradd.CreateAutoSuggest({"id":"x_customer_id","forceSelect":true});
</script>
<?php echo $tr_km_master_ar->customer_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->customer_name->Visible) { // customer_name ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_customer_name" class="form-group">
		<label id="elh_tr_km_master_ar_customer_name" for="x_customer_name" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_customer_name" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->customer_name->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->customer_name->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_customer_name" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_customer_name">
<input type="text" data-table="tr_km_master_ar" data-field="x_customer_name" name="x_customer_name" id="x_customer_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->customer_name->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->customer_name->EditValue ?>"<?php echo $tr_km_master_ar->customer_name->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->customer_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_customer_name">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_customer_name"><script id="tpc_tr_km_master_ar_customer_name" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->customer_name->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->customer_name->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_customer_name" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_customer_name">
<input type="text" data-table="tr_km_master_ar" data-field="x_customer_name" name="x_customer_name" id="x_customer_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->customer_name->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->customer_name->EditValue ?>"<?php echo $tr_km_master_ar->customer_name->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->customer_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->km_type->Visible) { // km_type ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_km_type" class="form-group">
		<label id="elh_tr_km_master_ar_km_type" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_km_type" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->km_type->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->km_type->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_km_type" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_km_type">
<div id="tp_x_km_type" class="ewTemplate"><input type="radio" data-table="tr_km_master_ar" data-field="x_km_type" data-value-separator="<?php echo $tr_km_master_ar->km_type->DisplayValueSeparatorAttribute() ?>" name="x_km_type" id="x_km_type" value="{value}"<?php echo $tr_km_master_ar->km_type->EditAttributes() ?>></div>
<div id="dsl_x_km_type" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $tr_km_master_ar->km_type->RadioButtonListHtml(FALSE, "x_km_type") ?>
</div></div>
</span>
</script>
<?php echo $tr_km_master_ar->km_type->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_km_type">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_km_type"><script id="tpc_tr_km_master_ar_km_type" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->km_type->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->km_type->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_km_type" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_km_type">
<div id="tp_x_km_type" class="ewTemplate"><input type="radio" data-table="tr_km_master_ar" data-field="x_km_type" data-value-separator="<?php echo $tr_km_master_ar->km_type->DisplayValueSeparatorAttribute() ?>" name="x_km_type" id="x_km_type" value="{value}"<?php echo $tr_km_master_ar->km_type->EditAttributes() ?>></div>
<div id="dsl_x_km_type" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $tr_km_master_ar->km_type->RadioButtonListHtml(FALSE, "x_km_type") ?>
</div></div>
</span>
</script>
<?php echo $tr_km_master_ar->km_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->km_acc->Visible) { // km_acc ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_km_acc" class="form-group">
		<label id="elh_tr_km_master_ar_km_acc" for="x_km_acc" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_km_acc" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->km_acc->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->km_acc->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_km_acc" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_km_acc">
<input type="text" data-table="tr_km_master_ar" data-field="x_km_acc" name="x_km_acc" id="x_km_acc" size="30" maxlength="16" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->km_acc->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->km_acc->EditValue ?>"<?php echo $tr_km_master_ar->km_acc->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->km_acc->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_km_acc">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_km_acc"><script id="tpc_tr_km_master_ar_km_acc" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->km_acc->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->km_acc->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_km_acc" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_km_acc">
<input type="text" data-table="tr_km_master_ar" data-field="x_km_acc" name="x_km_acc" id="x_km_acc" size="30" maxlength="16" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->km_acc->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->km_acc->EditValue ?>"<?php echo $tr_km_master_ar->km_acc->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->km_acc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->cek_no->Visible) { // cek_no ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_cek_no" class="form-group">
		<label id="elh_tr_km_master_ar_cek_no" for="x_cek_no" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_cek_no" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->cek_no->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->cek_no->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_cek_no" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_cek_no">
<input type="text" data-table="tr_km_master_ar" data-field="x_cek_no" name="x_cek_no" id="x_cek_no" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->cek_no->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->cek_no->EditValue ?>"<?php echo $tr_km_master_ar->cek_no->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->cek_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cek_no">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_cek_no"><script id="tpc_tr_km_master_ar_cek_no" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->cek_no->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->cek_no->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_cek_no" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_cek_no">
<input type="text" data-table="tr_km_master_ar" data-field="x_cek_no" name="x_cek_no" id="x_cek_no" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->cek_no->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->cek_no->EditValue ?>"<?php echo $tr_km_master_ar->cek_no->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->cek_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->tgl_jt->Visible) { // tgl_jt ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_tgl_jt" class="form-group">
		<label id="elh_tr_km_master_ar_tgl_jt" for="x_tgl_jt" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_tgl_jt" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->tgl_jt->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->tgl_jt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_tgl_jt" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_tgl_jt">
<input type="text" data-table="tr_km_master_ar" data-field="x_tgl_jt" name="x_tgl_jt" id="x_tgl_jt" size="15" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->tgl_jt->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->tgl_jt->EditValue ?>"<?php echo $tr_km_master_ar->tgl_jt->EditAttributes() ?>>
<?php if (!$tr_km_master_ar->tgl_jt->ReadOnly && !$tr_km_master_ar->tgl_jt->Disabled && !isset($tr_km_master_ar->tgl_jt->EditAttrs["readonly"]) && !isset($tr_km_master_ar->tgl_jt->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_km_master_aradd_js">
ew_CreateDateTimePicker("ftr_km_master_aradd", "x_tgl_jt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_km_master_ar->tgl_jt->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tgl_jt">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_tgl_jt"><script id="tpc_tr_km_master_ar_tgl_jt" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->tgl_jt->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->tgl_jt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_tgl_jt" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_tgl_jt">
<input type="text" data-table="tr_km_master_ar" data-field="x_tgl_jt" name="x_tgl_jt" id="x_tgl_jt" size="15" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->tgl_jt->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->tgl_jt->EditValue ?>"<?php echo $tr_km_master_ar->tgl_jt->EditAttributes() ?>>
<?php if (!$tr_km_master_ar->tgl_jt->ReadOnly && !$tr_km_master_ar->tgl_jt->Disabled && !isset($tr_km_master_ar->tgl_jt->EditAttrs["readonly"]) && !isset($tr_km_master_ar->tgl_jt->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_km_master_aradd_js">
ew_CreateDateTimePicker("ftr_km_master_aradd", "x_tgl_jt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_km_master_ar->tgl_jt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->cek_amt->Visible) { // cek_amt ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_cek_amt" class="form-group">
		<label id="elh_tr_km_master_ar_cek_amt" for="x_cek_amt" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_cek_amt" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->cek_amt->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->cek_amt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_cek_amt" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_cek_amt">
<input type="text" data-table="tr_km_master_ar" data-field="x_cek_amt" name="x_cek_amt" id="x_cek_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->cek_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->cek_amt->EditValue ?>"<?php echo $tr_km_master_ar->cek_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->cek_amt->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cek_amt">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_cek_amt"><script id="tpc_tr_km_master_ar_cek_amt" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->cek_amt->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->cek_amt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_cek_amt" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_cek_amt">
<input type="text" data-table="tr_km_master_ar" data-field="x_cek_amt" name="x_cek_amt" id="x_cek_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->cek_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->cek_amt->EditValue ?>"<?php echo $tr_km_master_ar->cek_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->cek_amt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->ret_number1->Visible) { // ret_number1 ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_ret_number1" class="form-group">
		<label id="elh_tr_km_master_ar_ret_number1" for="x_ret_number1" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_ret_number1" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->ret_number1->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->ret_number1->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_ret_number1" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_ret_number1">
<?php $tr_km_master_ar->ret_number1->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_km_master_ar->ret_number1->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_master_ar->ret_number1->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_master_ar->ret_number1->ViewValue ?>
	</span>
	<?php if (!$tr_km_master_ar->ret_number1->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_ret_number1" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_master_ar->ret_number1->RadioButtonListHtml(TRUE, "x_ret_number1") ?>
		</div>
	</div>
	<div id="tp_x_ret_number1" class="ewTemplate"><input type="radio" data-table="tr_km_master_ar" data-field="x_ret_number1" data-value-separator="<?php echo $tr_km_master_ar->ret_number1->DisplayValueSeparatorAttribute() ?>" name="x_ret_number1" id="x_ret_number1" value="{value}"<?php echo $tr_km_master_ar->ret_number1->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x_ret_number1" id="ln_x_ret_number1" value="x_ret_date1,x_retur_amt1">
</span>
</script>
<?php echo $tr_km_master_ar->ret_number1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ret_number1">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_ret_number1"><script id="tpc_tr_km_master_ar_ret_number1" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->ret_number1->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->ret_number1->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_ret_number1" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_ret_number1">
<?php $tr_km_master_ar->ret_number1->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_km_master_ar->ret_number1->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_master_ar->ret_number1->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_master_ar->ret_number1->ViewValue ?>
	</span>
	<?php if (!$tr_km_master_ar->ret_number1->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_ret_number1" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_master_ar->ret_number1->RadioButtonListHtml(TRUE, "x_ret_number1") ?>
		</div>
	</div>
	<div id="tp_x_ret_number1" class="ewTemplate"><input type="radio" data-table="tr_km_master_ar" data-field="x_ret_number1" data-value-separator="<?php echo $tr_km_master_ar->ret_number1->DisplayValueSeparatorAttribute() ?>" name="x_ret_number1" id="x_ret_number1" value="{value}"<?php echo $tr_km_master_ar->ret_number1->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x_ret_number1" id="ln_x_ret_number1" value="x_ret_date1,x_retur_amt1">
</span>
</script>
<?php echo $tr_km_master_ar->ret_number1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->ret_date1->Visible) { // ret_date1 ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_ret_date1" class="form-group">
		<label id="elh_tr_km_master_ar_ret_date1" for="x_ret_date1" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_ret_date1" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->ret_date1->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->ret_date1->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_ret_date1" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_ret_date1">
<input type="text" data-table="tr_km_master_ar" data-field="x_ret_date1" name="x_ret_date1" id="x_ret_date1" size="15" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->ret_date1->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->ret_date1->EditValue ?>"<?php echo $tr_km_master_ar->ret_date1->EditAttributes() ?>>
<?php if (!$tr_km_master_ar->ret_date1->ReadOnly && !$tr_km_master_ar->ret_date1->Disabled && !isset($tr_km_master_ar->ret_date1->EditAttrs["readonly"]) && !isset($tr_km_master_ar->ret_date1->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_km_master_aradd_js">
ew_CreateDateTimePicker("ftr_km_master_aradd", "x_ret_date1", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_km_master_ar->ret_date1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ret_date1">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_ret_date1"><script id="tpc_tr_km_master_ar_ret_date1" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->ret_date1->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->ret_date1->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_ret_date1" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_ret_date1">
<input type="text" data-table="tr_km_master_ar" data-field="x_ret_date1" name="x_ret_date1" id="x_ret_date1" size="15" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->ret_date1->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->ret_date1->EditValue ?>"<?php echo $tr_km_master_ar->ret_date1->EditAttributes() ?>>
<?php if (!$tr_km_master_ar->ret_date1->ReadOnly && !$tr_km_master_ar->ret_date1->Disabled && !isset($tr_km_master_ar->ret_date1->EditAttrs["readonly"]) && !isset($tr_km_master_ar->ret_date1->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_km_master_aradd_js">
ew_CreateDateTimePicker("ftr_km_master_aradd", "x_ret_date1", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_km_master_ar->ret_date1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->retur_amt1->Visible) { // retur_amt1 ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_retur_amt1" class="form-group">
		<label id="elh_tr_km_master_ar_retur_amt1" for="x_retur_amt1" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_retur_amt1" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->retur_amt1->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->retur_amt1->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_retur_amt1" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_retur_amt1">
<input type="text" data-table="tr_km_master_ar" data-field="x_retur_amt1" name="x_retur_amt1" id="x_retur_amt1" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->retur_amt1->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->retur_amt1->EditValue ?>"<?php echo $tr_km_master_ar->retur_amt1->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->retur_amt1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_retur_amt1">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_retur_amt1"><script id="tpc_tr_km_master_ar_retur_amt1" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->retur_amt1->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->retur_amt1->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_retur_amt1" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_retur_amt1">
<input type="text" data-table="tr_km_master_ar" data-field="x_retur_amt1" name="x_retur_amt1" id="x_retur_amt1" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->retur_amt1->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->retur_amt1->EditValue ?>"<?php echo $tr_km_master_ar->retur_amt1->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->retur_amt1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->ret_number2->Visible) { // ret_number2 ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_ret_number2" class="form-group">
		<label id="elh_tr_km_master_ar_ret_number2" for="x_ret_number2" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_ret_number2" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->ret_number2->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->ret_number2->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_ret_number2" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_ret_number2">
<?php $tr_km_master_ar->ret_number2->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_km_master_ar->ret_number2->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_master_ar->ret_number2->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_master_ar->ret_number2->ViewValue ?>
	</span>
	<?php if (!$tr_km_master_ar->ret_number2->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_ret_number2" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_master_ar->ret_number2->RadioButtonListHtml(TRUE, "x_ret_number2") ?>
		</div>
	</div>
	<div id="tp_x_ret_number2" class="ewTemplate"><input type="radio" data-table="tr_km_master_ar" data-field="x_ret_number2" data-value-separator="<?php echo $tr_km_master_ar->ret_number2->DisplayValueSeparatorAttribute() ?>" name="x_ret_number2" id="x_ret_number2" value="{value}"<?php echo $tr_km_master_ar->ret_number2->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x_ret_number2" id="ln_x_ret_number2" value="x_ret_date2,x_retur_amt2">
</span>
</script>
<?php echo $tr_km_master_ar->ret_number2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ret_number2">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_ret_number2"><script id="tpc_tr_km_master_ar_ret_number2" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->ret_number2->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->ret_number2->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_ret_number2" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_ret_number2">
<?php $tr_km_master_ar->ret_number2->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_km_master_ar->ret_number2->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_master_ar->ret_number2->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_master_ar->ret_number2->ViewValue ?>
	</span>
	<?php if (!$tr_km_master_ar->ret_number2->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_ret_number2" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_master_ar->ret_number2->RadioButtonListHtml(TRUE, "x_ret_number2") ?>
		</div>
	</div>
	<div id="tp_x_ret_number2" class="ewTemplate"><input type="radio" data-table="tr_km_master_ar" data-field="x_ret_number2" data-value-separator="<?php echo $tr_km_master_ar->ret_number2->DisplayValueSeparatorAttribute() ?>" name="x_ret_number2" id="x_ret_number2" value="{value}"<?php echo $tr_km_master_ar->ret_number2->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x_ret_number2" id="ln_x_ret_number2" value="x_ret_date2,x_retur_amt2">
</span>
</script>
<?php echo $tr_km_master_ar->ret_number2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->ret_date2->Visible) { // ret_date2 ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_ret_date2" class="form-group">
		<label id="elh_tr_km_master_ar_ret_date2" for="x_ret_date2" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_ret_date2" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->ret_date2->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->ret_date2->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_ret_date2" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_ret_date2">
<input type="text" data-table="tr_km_master_ar" data-field="x_ret_date2" name="x_ret_date2" id="x_ret_date2" size="15" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->ret_date2->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->ret_date2->EditValue ?>"<?php echo $tr_km_master_ar->ret_date2->EditAttributes() ?>>
<?php if (!$tr_km_master_ar->ret_date2->ReadOnly && !$tr_km_master_ar->ret_date2->Disabled && !isset($tr_km_master_ar->ret_date2->EditAttrs["readonly"]) && !isset($tr_km_master_ar->ret_date2->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_km_master_aradd_js">
ew_CreateDateTimePicker("ftr_km_master_aradd", "x_ret_date2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_km_master_ar->ret_date2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ret_date2">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_ret_date2"><script id="tpc_tr_km_master_ar_ret_date2" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->ret_date2->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->ret_date2->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_ret_date2" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_ret_date2">
<input type="text" data-table="tr_km_master_ar" data-field="x_ret_date2" name="x_ret_date2" id="x_ret_date2" size="15" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->ret_date2->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->ret_date2->EditValue ?>"<?php echo $tr_km_master_ar->ret_date2->EditAttributes() ?>>
<?php if (!$tr_km_master_ar->ret_date2->ReadOnly && !$tr_km_master_ar->ret_date2->Disabled && !isset($tr_km_master_ar->ret_date2->EditAttrs["readonly"]) && !isset($tr_km_master_ar->ret_date2->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_km_master_aradd_js">
ew_CreateDateTimePicker("ftr_km_master_aradd", "x_ret_date2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_km_master_ar->ret_date2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->retur_amt2->Visible) { // retur_amt2 ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_retur_amt2" class="form-group">
		<label id="elh_tr_km_master_ar_retur_amt2" for="x_retur_amt2" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_retur_amt2" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->retur_amt2->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->retur_amt2->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_retur_amt2" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_retur_amt2">
<input type="text" data-table="tr_km_master_ar" data-field="x_retur_amt2" name="x_retur_amt2" id="x_retur_amt2" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->retur_amt2->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->retur_amt2->EditValue ?>"<?php echo $tr_km_master_ar->retur_amt2->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->retur_amt2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_retur_amt2">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_retur_amt2"><script id="tpc_tr_km_master_ar_retur_amt2" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->retur_amt2->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->retur_amt2->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_retur_amt2" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_retur_amt2">
<input type="text" data-table="tr_km_master_ar" data-field="x_retur_amt2" name="x_retur_amt2" id="x_retur_amt2" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->retur_amt2->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->retur_amt2->EditValue ?>"<?php echo $tr_km_master_ar->retur_amt2->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->retur_amt2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->ret_number3->Visible) { // ret_number3 ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_ret_number3" class="form-group">
		<label id="elh_tr_km_master_ar_ret_number3" for="x_ret_number3" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_ret_number3" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->ret_number3->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->ret_number3->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_ret_number3" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_ret_number3">
<?php $tr_km_master_ar->ret_number3->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_km_master_ar->ret_number3->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_master_ar->ret_number3->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_master_ar->ret_number3->ViewValue ?>
	</span>
	<?php if (!$tr_km_master_ar->ret_number3->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_ret_number3" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_master_ar->ret_number3->RadioButtonListHtml(TRUE, "x_ret_number3") ?>
		</div>
	</div>
	<div id="tp_x_ret_number3" class="ewTemplate"><input type="radio" data-table="tr_km_master_ar" data-field="x_ret_number3" data-value-separator="<?php echo $tr_km_master_ar->ret_number3->DisplayValueSeparatorAttribute() ?>" name="x_ret_number3" id="x_ret_number3" value="{value}"<?php echo $tr_km_master_ar->ret_number3->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x_ret_number3" id="ln_x_ret_number3" value="x_ret_date3,x_retur_amt3">
</span>
</script>
<?php echo $tr_km_master_ar->ret_number3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ret_number3">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_ret_number3"><script id="tpc_tr_km_master_ar_ret_number3" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->ret_number3->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->ret_number3->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_ret_number3" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_ret_number3">
<?php $tr_km_master_ar->ret_number3->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_km_master_ar->ret_number3->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_master_ar->ret_number3->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_master_ar->ret_number3->ViewValue ?>
	</span>
	<?php if (!$tr_km_master_ar->ret_number3->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_ret_number3" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_master_ar->ret_number3->RadioButtonListHtml(TRUE, "x_ret_number3") ?>
		</div>
	</div>
	<div id="tp_x_ret_number3" class="ewTemplate"><input type="radio" data-table="tr_km_master_ar" data-field="x_ret_number3" data-value-separator="<?php echo $tr_km_master_ar->ret_number3->DisplayValueSeparatorAttribute() ?>" name="x_ret_number3" id="x_ret_number3" value="{value}"<?php echo $tr_km_master_ar->ret_number3->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x_ret_number3" id="ln_x_ret_number3" value="x_ret_date3,x_retur_amt3">
</span>
</script>
<?php echo $tr_km_master_ar->ret_number3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->ret_date3->Visible) { // ret_date3 ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_ret_date3" class="form-group">
		<label id="elh_tr_km_master_ar_ret_date3" for="x_ret_date3" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_ret_date3" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->ret_date3->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->ret_date3->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_ret_date3" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_ret_date3">
<input type="text" data-table="tr_km_master_ar" data-field="x_ret_date3" name="x_ret_date3" id="x_ret_date3" size="15" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->ret_date3->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->ret_date3->EditValue ?>"<?php echo $tr_km_master_ar->ret_date3->EditAttributes() ?>>
<?php if (!$tr_km_master_ar->ret_date3->ReadOnly && !$tr_km_master_ar->ret_date3->Disabled && !isset($tr_km_master_ar->ret_date3->EditAttrs["readonly"]) && !isset($tr_km_master_ar->ret_date3->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_km_master_aradd_js">
ew_CreateDateTimePicker("ftr_km_master_aradd", "x_ret_date3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_km_master_ar->ret_date3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ret_date3">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_ret_date3"><script id="tpc_tr_km_master_ar_ret_date3" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->ret_date3->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->ret_date3->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_ret_date3" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_ret_date3">
<input type="text" data-table="tr_km_master_ar" data-field="x_ret_date3" name="x_ret_date3" id="x_ret_date3" size="15" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->ret_date3->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->ret_date3->EditValue ?>"<?php echo $tr_km_master_ar->ret_date3->EditAttributes() ?>>
<?php if (!$tr_km_master_ar->ret_date3->ReadOnly && !$tr_km_master_ar->ret_date3->Disabled && !isset($tr_km_master_ar->ret_date3->EditAttrs["readonly"]) && !isset($tr_km_master_ar->ret_date3->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_km_master_aradd_js">
ew_CreateDateTimePicker("ftr_km_master_aradd", "x_ret_date3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php echo $tr_km_master_ar->ret_date3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->retur_amt3->Visible) { // retur_amt3 ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_retur_amt3" class="form-group">
		<label id="elh_tr_km_master_ar_retur_amt3" for="x_retur_amt3" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_retur_amt3" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->retur_amt3->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->retur_amt3->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_retur_amt3" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_retur_amt3">
<input type="text" data-table="tr_km_master_ar" data-field="x_retur_amt3" name="x_retur_amt3" id="x_retur_amt3" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->retur_amt3->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->retur_amt3->EditValue ?>"<?php echo $tr_km_master_ar->retur_amt3->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->retur_amt3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_retur_amt3">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_retur_amt3"><script id="tpc_tr_km_master_ar_retur_amt3" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->retur_amt3->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->retur_amt3->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_retur_amt3" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_retur_amt3">
<input type="text" data-table="tr_km_master_ar" data-field="x_retur_amt3" name="x_retur_amt3" id="x_retur_amt3" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->retur_amt3->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->retur_amt3->EditValue ?>"<?php echo $tr_km_master_ar->retur_amt3->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->retur_amt3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->tunai_amt->Visible) { // tunai_amt ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_tunai_amt" class="form-group">
		<label id="elh_tr_km_master_ar_tunai_amt" for="x_tunai_amt" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_tunai_amt" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->tunai_amt->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->tunai_amt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_tunai_amt" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_tunai_amt">
<input type="text" data-table="tr_km_master_ar" data-field="x_tunai_amt" name="x_tunai_amt" id="x_tunai_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->tunai_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->tunai_amt->EditValue ?>"<?php echo $tr_km_master_ar->tunai_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->tunai_amt->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tunai_amt">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_tunai_amt"><script id="tpc_tr_km_master_ar_tunai_amt" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->tunai_amt->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->tunai_amt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_tunai_amt" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_tunai_amt">
<input type="text" data-table="tr_km_master_ar" data-field="x_tunai_amt" name="x_tunai_amt" id="x_tunai_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->tunai_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->tunai_amt->EditValue ?>"<?php echo $tr_km_master_ar->tunai_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->tunai_amt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->dp_amt->Visible) { // dp_amt ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_dp_amt" class="form-group">
		<label id="elh_tr_km_master_ar_dp_amt" for="x_dp_amt" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_dp_amt" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->dp_amt->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->dp_amt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_dp_amt" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_dp_amt">
<input type="text" data-table="tr_km_master_ar" data-field="x_dp_amt" name="x_dp_amt" id="x_dp_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->dp_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->dp_amt->EditValue ?>"<?php echo $tr_km_master_ar->dp_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->dp_amt->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_dp_amt">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_dp_amt"><script id="tpc_tr_km_master_ar_dp_amt" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->dp_amt->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->dp_amt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_dp_amt" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_dp_amt">
<input type="text" data-table="tr_km_master_ar" data-field="x_dp_amt" name="x_dp_amt" id="x_dp_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->dp_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->dp_amt->EditValue ?>"<?php echo $tr_km_master_ar->dp_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->dp_amt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->km_amt->Visible) { // km_amt ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_km_amt" class="form-group">
		<label id="elh_tr_km_master_ar_km_amt" for="x_km_amt" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_km_amt" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->km_amt->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->km_amt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_km_amt" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_km_amt">
<input type="text" data-table="tr_km_master_ar" data-field="x_km_amt" name="x_km_amt" id="x_km_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->km_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->km_amt->EditValue ?>"<?php echo $tr_km_master_ar->km_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->km_amt->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_km_amt">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_km_amt"><script id="tpc_tr_km_master_ar_km_amt" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->km_amt->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->km_amt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_km_amt" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_km_amt">
<input type="text" data-table="tr_km_master_ar" data-field="x_km_amt" name="x_km_amt" id="x_km_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->km_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->km_amt->EditValue ?>"<?php echo $tr_km_master_ar->km_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->km_amt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->km_notes->Visible) { // km_notes ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_km_notes" class="form-group">
		<label id="elh_tr_km_master_ar_km_notes" for="x_km_notes" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_km_notes" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->km_notes->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->km_notes->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_km_notes" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_km_notes">
<input type="text" data-table="tr_km_master_ar" data-field="x_km_notes" name="x_km_notes" id="x_km_notes" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->km_notes->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->km_notes->EditValue ?>"<?php echo $tr_km_master_ar->km_notes->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->km_notes->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_km_notes">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_km_notes"><script id="tpc_tr_km_master_ar_km_notes" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->km_notes->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->km_notes->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_km_notes" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_km_notes">
<input type="text" data-table="tr_km_master_ar" data-field="x_km_notes" name="x_km_notes" id="x_km_notes" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->km_notes->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->km_notes->EditValue ?>"<?php echo $tr_km_master_ar->km_notes->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->km_notes->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->kas_amt->Visible) { // kas_amt ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_kas_amt" class="form-group">
		<label id="elh_tr_km_master_ar_kas_amt" for="x_kas_amt" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_kas_amt" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->kas_amt->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->kas_amt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_kas_amt" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_kas_amt">
<input type="text" data-table="tr_km_master_ar" data-field="x_kas_amt" name="x_kas_amt" id="x_kas_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->kas_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->kas_amt->EditValue ?>"<?php echo $tr_km_master_ar->kas_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->kas_amt->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_kas_amt">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_kas_amt"><script id="tpc_tr_km_master_ar_kas_amt" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->kas_amt->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->kas_amt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_kas_amt" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_kas_amt">
<input type="text" data-table="tr_km_master_ar" data-field="x_kas_amt" name="x_kas_amt" id="x_kas_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->kas_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->kas_amt->EditValue ?>"<?php echo $tr_km_master_ar->kas_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->kas_amt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar->kode_depo->Visible) { // kode_depo ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
	<div id="r_kode_depo" class="form-group">
		<label id="elh_tr_km_master_ar_kode_depo" for="x_kode_depo" class="<?php echo $tr_km_master_ar_add->LeftColumnClass ?>"><script id="tpc_tr_km_master_ar_kode_depo" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->kode_depo->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_km_master_ar_add->RightColumnClass ?>"><div<?php echo $tr_km_master_ar->kode_depo->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_kode_depo" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_kode_depo">
<input type="text" data-table="tr_km_master_ar" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" size="30" maxlength="3" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->kode_depo->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->kode_depo->EditValue ?>"<?php echo $tr_km_master_ar->kode_depo->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->kode_depo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_kode_depo">
		<td class="col-sm-2"><span id="elh_tr_km_master_ar_kode_depo"><script id="tpc_tr_km_master_ar_kode_depo" class="tr_km_master_aradd" type="text/html"><span><?php echo $tr_km_master_ar->kode_depo->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_km_master_ar->kode_depo->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar_kode_depo" class="tr_km_master_aradd" type="text/html">
<span id="el_tr_km_master_ar_kode_depo">
<input type="text" data-table="tr_km_master_ar" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" size="30" maxlength="3" placeholder="<?php echo ew_HtmlEncode($tr_km_master_ar->kode_depo->getPlaceHolder()) ?>" value="<?php echo $tr_km_master_ar->kode_depo->EditValue ?>"<?php echo $tr_km_master_ar->kode_depo->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_km_master_ar->kode_depo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_km_master_ar_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php
	if (in_array("tr_km_item_ar", explode(",", $tr_km_master_ar->getCurrentDetailTable())) && $tr_km_item_ar->DetailAdd) {
?>
<?php if ($tr_km_master_ar->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("tr_km_item_ar", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tr_km_item_argrid.php" ?>
<?php } ?>
<?php if (!$tr_km_master_ar_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tr_km_master_ar_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tr_km_master_ar_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tr_km_master_ar_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($tr_km_master_ar->Rows) ?> };
ew_ApplyTemplate("tpd_tr_km_master_aradd", "tpm_tr_km_master_aradd", "tr_km_master_aradd", "<?php echo $tr_km_master_ar->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.tr_km_master_aradd_js").each(function(){ew_AddScript(this.text);});
</script>
<script type="text/javascript">
ftr_km_master_aradd.Init();
</script>
<?php
$tr_km_master_ar_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_km_master_ar_add->Page_Terminate();
?>
