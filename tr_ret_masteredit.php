<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_ret_masterinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tr_ret_itemgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_ret_master_edit = NULL; // Initialize page object first

class ctr_ret_master_edit extends ctr_ret_master {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_ret_master';

	// Page object name
	var $PageObjName = 'tr_ret_master_edit';

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

		// Table object (tr_ret_master)
		if (!isset($GLOBALS["tr_ret_master"]) || get_class($GLOBALS["tr_ret_master"]) == "ctr_ret_master") {
			$GLOBALS["tr_ret_master"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_ret_master"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_ret_master', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tr_ret_masterlist.php"));
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
				if (in_array("tr_ret_item", $DetailTblVar)) {

					// Process auto fill for detail table 'tr_ret_item'
					if (preg_match('/^ftr_ret_item(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["tr_ret_item_grid"])) $GLOBALS["tr_ret_item_grid"] = new ctr_ret_item_grid;
						$GLOBALS["tr_ret_item_grid"]->Page_Init();
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
		global $EW_EXPORT, $tr_ret_master;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
			if (is_array(@$_SESSION[EW_SESSION_TEMP_IMAGES])) // Restore temp images
				$gTmpImages = @$_SESSION[EW_SESSION_TEMP_IMAGES];
			if (@$_POST["data"] <> "")
				$sContent = $_POST["data"];
			$gsExportFile = @$_POST["filename"];
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_ret_master);
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
					if ($pageName == "tr_ret_masterview.php")
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
			if ($objForm->HasValue("x_ret_id")) {
				$this->ret_id->setFormValue($objForm->GetValue("x_ret_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["ret_id"])) {
				$this->ret_id->setQueryStringValue($_GET["ret_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->ret_id->CurrentValue = NULL;
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
					$this->Page_Terminate("tr_ret_masterlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			Case "U": // Update
				$sReturnUrl = "tr_ret_masterlist.php";
				if (ew_GetPageName($sReturnUrl) == "tr_ret_masterlist.php")
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
		if (!$this->ret_number->FldIsDetailKey) {
			$this->ret_number->setFormValue($objForm->GetValue("x_ret_number"));
		}
		if (!$this->ret_date->FldIsDetailKey) {
			$this->ret_date->setFormValue($objForm->GetValue("x_ret_date"));
			$this->ret_date->CurrentValue = ew_UnFormatDateTime($this->ret_date->CurrentValue, 7);
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
		if (!$this->ret_amt->FldIsDetailKey) {
			$this->ret_amt->setFormValue($objForm->GetValue("x_ret_amt"));
		}
		if (!$this->disc_total->FldIsDetailKey) {
			$this->disc_total->setFormValue($objForm->GetValue("x_disc_total"));
		}
		if (!$this->ret_total->FldIsDetailKey) {
			$this->ret_total->setFormValue($objForm->GetValue("x_ret_total"));
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
		if (!$this->ret_id->FldIsDetailKey)
			$this->ret_id->setFormValue($objForm->GetValue("x_ret_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->ret_id->CurrentValue = $this->ret_id->FormValue;
		$this->ret_number->CurrentValue = $this->ret_number->FormValue;
		$this->ret_date->CurrentValue = $this->ret_date->FormValue;
		$this->ret_date->CurrentValue = ew_UnFormatDateTime($this->ret_date->CurrentValue, 7);
		$this->customer_id->CurrentValue = $this->customer_id->FormValue;
		$this->address1->CurrentValue = $this->address1->FormValue;
		$this->address2->CurrentValue = $this->address2->FormValue;
		$this->address3->CurrentValue = $this->address3->FormValue;
		$this->ret_amt->CurrentValue = $this->ret_amt->FormValue;
		$this->disc_total->CurrentValue = $this->disc_total->FormValue;
		$this->ret_total->CurrentValue = $this->ret_total->FormValue;
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
		$this->ret_id->setDbValue($row['ret_id']);
		$this->ret_number->setDbValue($row['ret_number']);
		$this->ret_date->setDbValue($row['ret_date']);
		$this->customer_id->setDbValue($row['customer_id']);
		$this->customer_name->setDbValue($row['customer_name']);
		$this->address1->setDbValue($row['address1']);
		$this->address2->setDbValue($row['address2']);
		$this->address3->setDbValue($row['address3']);
		$this->ret_amt->setDbValue($row['ret_amt']);
		$this->disc_total->setDbValue($row['disc_total']);
		$this->ret_total->setDbValue($row['ret_total']);
		$this->user_id->setDbValue($row['user_id']);
		$this->lastupdate->setDbValue($row['lastupdate']);
		$this->kode_depo->setDbValue($row['kode_depo']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['ret_id'] = NULL;
		$row['ret_number'] = NULL;
		$row['ret_date'] = NULL;
		$row['customer_id'] = NULL;
		$row['customer_name'] = NULL;
		$row['address1'] = NULL;
		$row['address2'] = NULL;
		$row['address3'] = NULL;
		$row['ret_amt'] = NULL;
		$row['disc_total'] = NULL;
		$row['ret_total'] = NULL;
		$row['user_id'] = NULL;
		$row['lastupdate'] = NULL;
		$row['kode_depo'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ret_id->DbValue = $row['ret_id'];
		$this->ret_number->DbValue = $row['ret_number'];
		$this->ret_date->DbValue = $row['ret_date'];
		$this->customer_id->DbValue = $row['customer_id'];
		$this->customer_name->DbValue = $row['customer_name'];
		$this->address1->DbValue = $row['address1'];
		$this->address2->DbValue = $row['address2'];
		$this->address3->DbValue = $row['address3'];
		$this->ret_amt->DbValue = $row['ret_amt'];
		$this->disc_total->DbValue = $row['disc_total'];
		$this->ret_total->DbValue = $row['ret_total'];
		$this->user_id->DbValue = $row['user_id'];
		$this->lastupdate->DbValue = $row['lastupdate'];
		$this->kode_depo->DbValue = $row['kode_depo'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("ret_id")) <> "")
			$this->ret_id->CurrentValue = $this->getKey("ret_id"); // ret_id
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

		if ($this->ret_amt->FormValue == $this->ret_amt->CurrentValue && is_numeric(ew_StrToFloat($this->ret_amt->CurrentValue)))
			$this->ret_amt->CurrentValue = ew_StrToFloat($this->ret_amt->CurrentValue);

		// Convert decimal values if posted back
		if ($this->disc_total->FormValue == $this->disc_total->CurrentValue && is_numeric(ew_StrToFloat($this->disc_total->CurrentValue)))
			$this->disc_total->CurrentValue = ew_StrToFloat($this->disc_total->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ret_total->FormValue == $this->ret_total->CurrentValue && is_numeric(ew_StrToFloat($this->ret_total->CurrentValue)))
			$this->ret_total->CurrentValue = ew_StrToFloat($this->ret_total->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ret_id
		// ret_number
		// ret_date
		// customer_id
		// customer_name
		// address1
		// address2
		// address3
		// ret_amt
		// disc_total
		// ret_total
		// user_id
		// lastupdate
		// kode_depo

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// ret_id
		$this->ret_id->ViewValue = $this->ret_id->CurrentValue;
		$this->ret_id->ViewCustomAttributes = "";

		// ret_number
		$this->ret_number->ViewValue = $this->ret_number->CurrentValue;
		$this->ret_number->ViewCustomAttributes = "";

		// ret_date
		$this->ret_date->ViewValue = $this->ret_date->CurrentValue;
		$this->ret_date->ViewValue = ew_FormatDateTime($this->ret_date->ViewValue, 7);
		$this->ret_date->ViewCustomAttributes = "";

		// customer_id
		$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
		if (strval($this->customer_id->CurrentValue) <> "") {
			$sFilterWrk = "`customer_id`" . ew_SearchString("=", $this->customer_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `customer_id`, `customer_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_customer`";
		$sWhereWrk = "";
		$this->customer_id->LookupFilters = array();
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

		// address1
		$this->address1->ViewValue = $this->address1->CurrentValue;
		$this->address1->ViewCustomAttributes = "";

		// address2
		$this->address2->ViewValue = $this->address2->CurrentValue;
		$this->address2->ViewCustomAttributes = "";

		// address3
		$this->address3->ViewValue = $this->address3->CurrentValue;
		$this->address3->ViewCustomAttributes = "";

		// ret_amt
		$this->ret_amt->ViewValue = $this->ret_amt->CurrentValue;
		$this->ret_amt->ViewValue = ew_FormatNumber($this->ret_amt->ViewValue, 2, -2, -2, -2);
		$this->ret_amt->CellCssStyle .= "text-align: right;";
		$this->ret_amt->ViewCustomAttributes = "";

		// disc_total
		$this->disc_total->ViewValue = $this->disc_total->CurrentValue;
		$this->disc_total->ViewValue = ew_FormatNumber($this->disc_total->ViewValue, 2, -2, -2, -2);
		$this->disc_total->CellCssStyle .= "text-align: right;";
		$this->disc_total->ViewCustomAttributes = "";

		// ret_total
		$this->ret_total->ViewValue = $this->ret_total->CurrentValue;
		$this->ret_total->ViewValue = ew_FormatNumber($this->ret_total->ViewValue, 2, -2, -2, -2);
		$this->ret_total->CellCssStyle .= "text-align: right;";
		$this->ret_total->ViewCustomAttributes = "";

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

			// ret_number
			$this->ret_number->LinkCustomAttributes = "";
			$this->ret_number->HrefValue = "";
			$this->ret_number->TooltipValue = "";

			// ret_date
			$this->ret_date->LinkCustomAttributes = "";
			$this->ret_date->HrefValue = "";
			$this->ret_date->TooltipValue = "";

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

			// ret_amt
			$this->ret_amt->LinkCustomAttributes = "";
			$this->ret_amt->HrefValue = "";
			$this->ret_amt->TooltipValue = "";

			// disc_total
			$this->disc_total->LinkCustomAttributes = "";
			$this->disc_total->HrefValue = "";
			$this->disc_total->TooltipValue = "";

			// ret_total
			$this->ret_total->LinkCustomAttributes = "";
			$this->ret_total->HrefValue = "";
			$this->ret_total->TooltipValue = "";

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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// ret_number
			$this->ret_number->EditAttrs["class"] = "form-control";
			$this->ret_number->EditCustomAttributes = "";
			$this->ret_number->EditValue = ew_HtmlEncode($this->ret_number->CurrentValue);
			$this->ret_number->PlaceHolder = ew_RemoveHtml($this->ret_number->FldCaption());

			// ret_date
			$this->ret_date->EditAttrs["class"] = "form-control";
			$this->ret_date->EditCustomAttributes = "";
			$this->ret_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ret_date->CurrentValue, 7));
			$this->ret_date->PlaceHolder = ew_RemoveHtml($this->ret_date->FldCaption());

			// customer_id
			$this->customer_id->EditAttrs["class"] = "form-control";
			$this->customer_id->EditCustomAttributes = "";
			$this->customer_id->EditValue = ew_HtmlEncode($this->customer_id->CurrentValue);
			if (strval($this->customer_id->CurrentValue) <> "") {
				$sFilterWrk = "`customer_id`" . ew_SearchString("=", $this->customer_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `customer_id`, `customer_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_customer`";
			$sWhereWrk = "";
			$this->customer_id->LookupFilters = array();
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

			// ret_amt
			$this->ret_amt->EditAttrs["class"] = "form-control";
			$this->ret_amt->EditCustomAttributes = "";
			$this->ret_amt->EditValue = ew_HtmlEncode($this->ret_amt->CurrentValue);
			$this->ret_amt->PlaceHolder = ew_RemoveHtml($this->ret_amt->FldCaption());
			if (strval($this->ret_amt->EditValue) <> "" && is_numeric($this->ret_amt->EditValue)) $this->ret_amt->EditValue = ew_FormatNumber($this->ret_amt->EditValue, -2, -2, -2, -2);

			// disc_total
			$this->disc_total->EditAttrs["class"] = "form-control";
			$this->disc_total->EditCustomAttributes = "";
			$this->disc_total->EditValue = ew_HtmlEncode($this->disc_total->CurrentValue);
			$this->disc_total->PlaceHolder = ew_RemoveHtml($this->disc_total->FldCaption());
			if (strval($this->disc_total->EditValue) <> "" && is_numeric($this->disc_total->EditValue)) $this->disc_total->EditValue = ew_FormatNumber($this->disc_total->EditValue, -2, -2, -2, -2);

			// ret_total
			$this->ret_total->EditAttrs["class"] = "form-control";
			$this->ret_total->EditCustomAttributes = "";
			$this->ret_total->EditValue = ew_HtmlEncode($this->ret_total->CurrentValue);
			$this->ret_total->PlaceHolder = ew_RemoveHtml($this->ret_total->FldCaption());
			if (strval($this->ret_total->EditValue) <> "" && is_numeric($this->ret_total->EditValue)) $this->ret_total->EditValue = ew_FormatNumber($this->ret_total->EditValue, -2, -2, -2, -2);

			// user_id
			// lastupdate
			// kode_depo

			$this->kode_depo->EditAttrs["class"] = "form-control";
			$this->kode_depo->EditCustomAttributes = "";

			// Edit refer script
			// ret_number

			$this->ret_number->LinkCustomAttributes = "";
			$this->ret_number->HrefValue = "";

			// ret_date
			$this->ret_date->LinkCustomAttributes = "";
			$this->ret_date->HrefValue = "";

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

			// ret_amt
			$this->ret_amt->LinkCustomAttributes = "";
			$this->ret_amt->HrefValue = "";

			// disc_total
			$this->disc_total->LinkCustomAttributes = "";
			$this->disc_total->HrefValue = "";

			// ret_total
			$this->ret_total->LinkCustomAttributes = "";
			$this->ret_total->HrefValue = "";

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
		if (!ew_CheckEuroDate($this->ret_date->FormValue)) {
			ew_AddMessage($gsFormError, $this->ret_date->FldErrMsg());
		}
		if (!ew_CheckInteger($this->customer_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->customer_id->FldErrMsg());
		}
		if (!ew_CheckNumber($this->ret_amt->FormValue)) {
			ew_AddMessage($gsFormError, $this->ret_amt->FldErrMsg());
		}
		if (!ew_CheckNumber($this->disc_total->FormValue)) {
			ew_AddMessage($gsFormError, $this->disc_total->FldErrMsg());
		}
		if (!ew_CheckNumber($this->ret_total->FormValue)) {
			ew_AddMessage($gsFormError, $this->ret_total->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("tr_ret_item", $DetailTblVar) && $GLOBALS["tr_ret_item"]->DetailEdit) {
			if (!isset($GLOBALS["tr_ret_item_grid"])) $GLOBALS["tr_ret_item_grid"] = new ctr_ret_item_grid(); // get detail page object
			$GLOBALS["tr_ret_item_grid"]->ValidateGridForm();
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

			// ret_number
			$this->ret_number->SetDbValueDef($rsnew, $this->ret_number->CurrentValue, NULL, $this->ret_number->ReadOnly);

			// ret_date
			$this->ret_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ret_date->CurrentValue, 7), NULL, $this->ret_date->ReadOnly);

			// customer_id
			$this->customer_id->SetDbValueDef($rsnew, $this->customer_id->CurrentValue, NULL, $this->customer_id->ReadOnly);

			// address1
			$this->address1->SetDbValueDef($rsnew, $this->address1->CurrentValue, NULL, $this->address1->ReadOnly);

			// address2
			$this->address2->SetDbValueDef($rsnew, $this->address2->CurrentValue, NULL, $this->address2->ReadOnly);

			// address3
			$this->address3->SetDbValueDef($rsnew, $this->address3->CurrentValue, NULL, $this->address3->ReadOnly);

			// ret_amt
			$this->ret_amt->SetDbValueDef($rsnew, $this->ret_amt->CurrentValue, NULL, $this->ret_amt->ReadOnly);

			// disc_total
			$this->disc_total->SetDbValueDef($rsnew, $this->disc_total->CurrentValue, NULL, $this->disc_total->ReadOnly);

			// ret_total
			$this->ret_total->SetDbValueDef($rsnew, $this->ret_total->CurrentValue, NULL, $this->ret_total->ReadOnly);

			// user_id
			$this->user_id->SetDbValueDef($rsnew, CurrentUserID(), NULL);
			$rsnew['user_id'] = &$this->user_id->DbValue;

			// lastupdate
			$this->lastupdate->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['lastupdate'] = &$this->lastupdate->DbValue;

			// kode_depo
			$this->kode_depo->SetDbValueDef($rsnew, $this->kode_depo->CurrentValue, NULL, $this->kode_depo->ReadOnly);

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
					if (in_array("tr_ret_item", $DetailTblVar) && $GLOBALS["tr_ret_item"]->DetailEdit) {
						if (!isset($GLOBALS["tr_ret_item_grid"])) $GLOBALS["tr_ret_item_grid"] = new ctr_ret_item_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "tr_ret_item"); // Load user level of detail table
						$EditRow = $GLOBALS["tr_ret_item_grid"]->GridUpdate();
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
			if (in_array("tr_ret_item", $DetailTblVar)) {
				if (!isset($GLOBALS["tr_ret_item_grid"]))
					$GLOBALS["tr_ret_item_grid"] = new ctr_ret_item_grid;
				if ($GLOBALS["tr_ret_item_grid"]->DetailEdit) {
					$GLOBALS["tr_ret_item_grid"]->CurrentMode = "edit";
					$GLOBALS["tr_ret_item_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["tr_ret_item_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["tr_ret_item_grid"]->setStartRecordNumber(1);
					$GLOBALS["tr_ret_item_grid"]->master_id->FldIsDetailKey = TRUE;
					$GLOBALS["tr_ret_item_grid"]->master_id->CurrentValue = $this->ret_id->CurrentValue;
					$GLOBALS["tr_ret_item_grid"]->master_id->setSessionValue($GLOBALS["tr_ret_item_grid"]->master_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_ret_masterlist.php"), "", $this->TableVar, TRUE);
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
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
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
if (!isset($tr_ret_master_edit)) $tr_ret_master_edit = new ctr_ret_master_edit();

// Page init
$tr_ret_master_edit->Page_Init();

// Page main
$tr_ret_master_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_ret_master_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ftr_ret_masteredit = new ew_Form("ftr_ret_masteredit", "edit");

// Validate form
ftr_ret_masteredit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_ret_date");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_ret_master->ret_date->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_customer_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_ret_master->customer_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ret_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_ret_master->ret_amt->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_disc_total");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_ret_master->disc_total->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ret_total");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_ret_master->ret_total->FldErrMsg()) ?>");

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
ftr_ret_masteredit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_ret_masteredit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_ret_masteredit.Lists["x_customer_id"] = {"LinkField":"x_customer_id","Ajax":true,"AutoFill":true,"DisplayFields":["x_customer_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_customer"};
ftr_ret_masteredit.Lists["x_customer_id"].Data = "<?php echo $tr_ret_master_edit->customer_id->LookupFilterQuery(FALSE, "edit") ?>";
ftr_ret_masteredit.AutoSuggests["x_customer_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $tr_ret_master_edit->customer_id->LookupFilterQuery(TRUE, "edit"))) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tr_ret_master_edit->ShowPageHeader(); ?>
<?php
$tr_ret_master_edit->ShowMessage();
?>
<form name="ftr_ret_masteredit" id="ftr_ret_masteredit" class="<?php echo $tr_ret_master_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_ret_master_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_ret_master_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_ret_master">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($tr_ret_master_edit->IsModal) ?>">
<div id="tpd_tr_ret_masteredit" class="ewCustomTemplate"></div>
<script id="tpm_tr_ret_masteredit" type="text/html">
<div id="ct_tr_ret_master_edit"><div class="col-sm-12 panel-custom" style="">
	<div class="row">
		<div class="col-sm-5 order-1">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_ret_master->ret_number->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_ret_master_ret_number"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_ret_master->ret_date->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_ret_master_ret_date"/}}</div>
			</div>
		 	<!-- <div class="row field-br">
				<div class="col-sm-3 tittle">{{include tmpl="#tpcaption_due_date"/}}</div>
				<div class="col-sm-9">{{include tmpl="#tpx_due_date"/}}</div>
			</div> -->
		</div>
		<div class="col-sm-7 order-2">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_ret_master->customer_id->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_ret_master_customer_id"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_ret_master->address1->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_ret_master_address1"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_ret_master->address2->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_ret_master_address2"/}}</div>
			</div>
		</div>
	</div>
</div>
<br>
<!--- batas -->
<div class="col-sm-12 panel-custom" style="">
	<div class="row">
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-4 tittle"> <?php echo $tr_ret_master->ret_amt->FldCaption() ?> </div>
				<div class="col-sm-8"> {{include tmpl="#tpx_tr_ret_master_ret_amt"/}} </div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-4 tittle"> <?php echo $tr_ret_master->disc_total->FldCaption() ?> </div>
				<div class="col-sm-8"> {{include tmpl="#tpx_tr_ret_master_disc_total"/}} </div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-4 tittle"> <?php echo $tr_ret_master->ret_total->FldCaption() ?> </div>
				<div class="col-sm-8"> {{include tmpl="#tpx_tr_ret_master_ret_total"/}} </div>
			</div>
		</div>
	</div>
</div>
</div>
</script>
<?php if (!$tr_ret_master_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tr_ret_master_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv hidden"><!-- page* -->
<?php } else { ?>
<table id="tbl_tr_ret_masteredit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable hidden"><!-- table* -->
<?php } ?>
<?php if ($tr_ret_master->ret_number->Visible) { // ret_number ?>
<?php if ($tr_ret_master_edit->IsMobileOrModal) { ?>
	<div id="r_ret_number" class="form-group">
		<label id="elh_tr_ret_master_ret_number" for="x_ret_number" class="<?php echo $tr_ret_master_edit->LeftColumnClass ?>"><script id="tpc_tr_ret_master_ret_number" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->ret_number->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_ret_master_edit->RightColumnClass ?>"><div<?php echo $tr_ret_master->ret_number->CellAttributes() ?>>
<script id="tpx_tr_ret_master_ret_number" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_ret_number">
<input type="text" data-table="tr_ret_master" data-field="x_ret_number" name="x_ret_number" id="x_ret_number" size="15" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->ret_number->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->ret_number->EditValue ?>"<?php echo $tr_ret_master->ret_number->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_ret_master->ret_number->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ret_number">
		<td class="col-sm-2"><span id="elh_tr_ret_master_ret_number"><script id="tpc_tr_ret_master_ret_number" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->ret_number->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_ret_master->ret_number->CellAttributes() ?>>
<script id="tpx_tr_ret_master_ret_number" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_ret_number">
<input type="text" data-table="tr_ret_master" data-field="x_ret_number" name="x_ret_number" id="x_ret_number" size="15" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->ret_number->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->ret_number->EditValue ?>"<?php echo $tr_ret_master->ret_number->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_ret_master->ret_number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_ret_master->ret_date->Visible) { // ret_date ?>
<?php if ($tr_ret_master_edit->IsMobileOrModal) { ?>
	<div id="r_ret_date" class="form-group">
		<label id="elh_tr_ret_master_ret_date" for="x_ret_date" class="<?php echo $tr_ret_master_edit->LeftColumnClass ?>"><script id="tpc_tr_ret_master_ret_date" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->ret_date->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_ret_master_edit->RightColumnClass ?>"><div<?php echo $tr_ret_master->ret_date->CellAttributes() ?>>
<script id="tpx_tr_ret_master_ret_date" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_ret_date">
<input type="text" data-table="tr_ret_master" data-field="x_ret_date" data-format="7" name="x_ret_date" id="x_ret_date" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->ret_date->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->ret_date->EditValue ?>"<?php echo $tr_ret_master->ret_date->EditAttributes() ?>>
<?php if (!$tr_ret_master->ret_date->ReadOnly && !$tr_ret_master->ret_date->Disabled && !isset($tr_ret_master->ret_date->EditAttrs["readonly"]) && !isset($tr_ret_master->ret_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_ret_masteredit_js">
ew_CreateDateTimePicker("ftr_ret_masteredit", "x_ret_date", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php echo $tr_ret_master->ret_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ret_date">
		<td class="col-sm-2"><span id="elh_tr_ret_master_ret_date"><script id="tpc_tr_ret_master_ret_date" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->ret_date->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_ret_master->ret_date->CellAttributes() ?>>
<script id="tpx_tr_ret_master_ret_date" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_ret_date">
<input type="text" data-table="tr_ret_master" data-field="x_ret_date" data-format="7" name="x_ret_date" id="x_ret_date" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->ret_date->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->ret_date->EditValue ?>"<?php echo $tr_ret_master->ret_date->EditAttributes() ?>>
<?php if (!$tr_ret_master->ret_date->ReadOnly && !$tr_ret_master->ret_date->Disabled && !isset($tr_ret_master->ret_date->EditAttrs["readonly"]) && !isset($tr_ret_master->ret_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span>
</script>
<script type="text/html" class="tr_ret_masteredit_js">
ew_CreateDateTimePicker("ftr_ret_masteredit", "x_ret_date", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php echo $tr_ret_master->ret_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_ret_master->customer_id->Visible) { // customer_id ?>
<?php if ($tr_ret_master_edit->IsMobileOrModal) { ?>
	<div id="r_customer_id" class="form-group">
		<label id="elh_tr_ret_master_customer_id" class="<?php echo $tr_ret_master_edit->LeftColumnClass ?>"><script id="tpc_tr_ret_master_customer_id" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->customer_id->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_ret_master_edit->RightColumnClass ?>"><div<?php echo $tr_ret_master->customer_id->CellAttributes() ?>>
<script id="tpx_tr_ret_master_customer_id" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_customer_id">
<?php
$wrkonchange = trim("ew_AutoFill(this); " . @$tr_ret_master->customer_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_ret_master->customer_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_customer_id" style="white-space: nowrap; z-index: 8960">
	<input type="text" name="sv_x_customer_id" id="sv_x_customer_id" value="<?php echo $tr_ret_master->customer_id->EditValue ?>" size="65" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->customer_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_ret_master->customer_id->getPlaceHolder()) ?>"<?php echo $tr_ret_master->customer_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_ret_master" data-field="x_customer_id" data-value-separator="<?php echo $tr_ret_master->customer_id->DisplayValueSeparatorAttribute() ?>" name="x_customer_id" id="x_customer_id" value="<?php echo ew_HtmlEncode($tr_ret_master->customer_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="ln_x_customer_id" id="ln_x_customer_id" value="x_address1,x_address2,x_address3">
</span>
</script>
<script type="text/html" class="tr_ret_masteredit_js">
ftr_ret_masteredit.CreateAutoSuggest({"id":"x_customer_id","forceSelect":true});
</script>
<?php echo $tr_ret_master->customer_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_customer_id">
		<td class="col-sm-2"><span id="elh_tr_ret_master_customer_id"><script id="tpc_tr_ret_master_customer_id" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->customer_id->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_ret_master->customer_id->CellAttributes() ?>>
<script id="tpx_tr_ret_master_customer_id" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_customer_id">
<?php
$wrkonchange = trim("ew_AutoFill(this); " . @$tr_ret_master->customer_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_ret_master->customer_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_customer_id" style="white-space: nowrap; z-index: 8960">
	<input type="text" name="sv_x_customer_id" id="sv_x_customer_id" value="<?php echo $tr_ret_master->customer_id->EditValue ?>" size="65" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->customer_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_ret_master->customer_id->getPlaceHolder()) ?>"<?php echo $tr_ret_master->customer_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_ret_master" data-field="x_customer_id" data-value-separator="<?php echo $tr_ret_master->customer_id->DisplayValueSeparatorAttribute() ?>" name="x_customer_id" id="x_customer_id" value="<?php echo ew_HtmlEncode($tr_ret_master->customer_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="ln_x_customer_id" id="ln_x_customer_id" value="x_address1,x_address2,x_address3">
</span>
</script>
<script type="text/html" class="tr_ret_masteredit_js">
ftr_ret_masteredit.CreateAutoSuggest({"id":"x_customer_id","forceSelect":true});
</script>
<?php echo $tr_ret_master->customer_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_ret_master->address1->Visible) { // address1 ?>
<?php if ($tr_ret_master_edit->IsMobileOrModal) { ?>
	<div id="r_address1" class="form-group">
		<label id="elh_tr_ret_master_address1" for="x_address1" class="<?php echo $tr_ret_master_edit->LeftColumnClass ?>"><script id="tpc_tr_ret_master_address1" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->address1->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_ret_master_edit->RightColumnClass ?>"><div<?php echo $tr_ret_master->address1->CellAttributes() ?>>
<script id="tpx_tr_ret_master_address1" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_address1">
<input type="text" data-table="tr_ret_master" data-field="x_address1" name="x_address1" id="x_address1" size="65" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->address1->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->address1->EditValue ?>"<?php echo $tr_ret_master->address1->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_ret_master->address1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address1">
		<td class="col-sm-2"><span id="elh_tr_ret_master_address1"><script id="tpc_tr_ret_master_address1" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->address1->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_ret_master->address1->CellAttributes() ?>>
<script id="tpx_tr_ret_master_address1" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_address1">
<input type="text" data-table="tr_ret_master" data-field="x_address1" name="x_address1" id="x_address1" size="65" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->address1->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->address1->EditValue ?>"<?php echo $tr_ret_master->address1->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_ret_master->address1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_ret_master->address2->Visible) { // address2 ?>
<?php if ($tr_ret_master_edit->IsMobileOrModal) { ?>
	<div id="r_address2" class="form-group">
		<label id="elh_tr_ret_master_address2" for="x_address2" class="<?php echo $tr_ret_master_edit->LeftColumnClass ?>"><script id="tpc_tr_ret_master_address2" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->address2->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_ret_master_edit->RightColumnClass ?>"><div<?php echo $tr_ret_master->address2->CellAttributes() ?>>
<script id="tpx_tr_ret_master_address2" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_address2">
<input type="text" data-table="tr_ret_master" data-field="x_address2" name="x_address2" id="x_address2" size="65" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->address2->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->address2->EditValue ?>"<?php echo $tr_ret_master->address2->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_ret_master->address2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address2">
		<td class="col-sm-2"><span id="elh_tr_ret_master_address2"><script id="tpc_tr_ret_master_address2" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->address2->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_ret_master->address2->CellAttributes() ?>>
<script id="tpx_tr_ret_master_address2" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_address2">
<input type="text" data-table="tr_ret_master" data-field="x_address2" name="x_address2" id="x_address2" size="65" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->address2->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->address2->EditValue ?>"<?php echo $tr_ret_master->address2->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_ret_master->address2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_ret_master->ret_amt->Visible) { // ret_amt ?>
<?php if ($tr_ret_master_edit->IsMobileOrModal) { ?>
	<div id="r_ret_amt" class="form-group">
		<label id="elh_tr_ret_master_ret_amt" for="x_ret_amt" class="<?php echo $tr_ret_master_edit->LeftColumnClass ?>"><script id="tpc_tr_ret_master_ret_amt" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->ret_amt->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_ret_master_edit->RightColumnClass ?>"><div<?php echo $tr_ret_master->ret_amt->CellAttributes() ?>>
<script id="tpx_tr_ret_master_ret_amt" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_ret_amt">
<input type="text" data-table="tr_ret_master" data-field="x_ret_amt" name="x_ret_amt" id="x_ret_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->ret_amt->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->ret_amt->EditValue ?>"<?php echo $tr_ret_master->ret_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_ret_master->ret_amt->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ret_amt">
		<td class="col-sm-2"><span id="elh_tr_ret_master_ret_amt"><script id="tpc_tr_ret_master_ret_amt" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->ret_amt->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_ret_master->ret_amt->CellAttributes() ?>>
<script id="tpx_tr_ret_master_ret_amt" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_ret_amt">
<input type="text" data-table="tr_ret_master" data-field="x_ret_amt" name="x_ret_amt" id="x_ret_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->ret_amt->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->ret_amt->EditValue ?>"<?php echo $tr_ret_master->ret_amt->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_ret_master->ret_amt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_ret_master->disc_total->Visible) { // disc_total ?>
<?php if ($tr_ret_master_edit->IsMobileOrModal) { ?>
	<div id="r_disc_total" class="form-group">
		<label id="elh_tr_ret_master_disc_total" for="x_disc_total" class="<?php echo $tr_ret_master_edit->LeftColumnClass ?>"><script id="tpc_tr_ret_master_disc_total" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->disc_total->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_ret_master_edit->RightColumnClass ?>"><div<?php echo $tr_ret_master->disc_total->CellAttributes() ?>>
<script id="tpx_tr_ret_master_disc_total" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_disc_total">
<input type="text" data-table="tr_ret_master" data-field="x_disc_total" name="x_disc_total" id="x_disc_total" size="30" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->disc_total->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->disc_total->EditValue ?>"<?php echo $tr_ret_master->disc_total->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_ret_master->disc_total->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_disc_total">
		<td class="col-sm-2"><span id="elh_tr_ret_master_disc_total"><script id="tpc_tr_ret_master_disc_total" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->disc_total->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_ret_master->disc_total->CellAttributes() ?>>
<script id="tpx_tr_ret_master_disc_total" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_disc_total">
<input type="text" data-table="tr_ret_master" data-field="x_disc_total" name="x_disc_total" id="x_disc_total" size="30" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->disc_total->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->disc_total->EditValue ?>"<?php echo $tr_ret_master->disc_total->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_ret_master->disc_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_ret_master->ret_total->Visible) { // ret_total ?>
<?php if ($tr_ret_master_edit->IsMobileOrModal) { ?>
	<div id="r_ret_total" class="form-group">
		<label id="elh_tr_ret_master_ret_total" for="x_ret_total" class="<?php echo $tr_ret_master_edit->LeftColumnClass ?>"><script id="tpc_tr_ret_master_ret_total" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->ret_total->FldCaption() ?></span></script></label>
		<div class="<?php echo $tr_ret_master_edit->RightColumnClass ?>"><div<?php echo $tr_ret_master->ret_total->CellAttributes() ?>>
<script id="tpx_tr_ret_master_ret_total" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_ret_total">
<input type="text" data-table="tr_ret_master" data-field="x_ret_total" name="x_ret_total" id="x_ret_total" size="30" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->ret_total->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->ret_total->EditValue ?>"<?php echo $tr_ret_master->ret_total->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_ret_master->ret_total->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ret_total">
		<td class="col-sm-2"><span id="elh_tr_ret_master_ret_total"><script id="tpc_tr_ret_master_ret_total" class="tr_ret_masteredit" type="text/html"><span><?php echo $tr_ret_master->ret_total->FldCaption() ?></span></script></span></td>
		<td<?php echo $tr_ret_master->ret_total->CellAttributes() ?>>
<script id="tpx_tr_ret_master_ret_total" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_ret_total">
<input type="text" data-table="tr_ret_master" data-field="x_ret_total" name="x_ret_total" id="x_ret_total" size="30" placeholder="<?php echo ew_HtmlEncode($tr_ret_master->ret_total->getPlaceHolder()) ?>" value="<?php echo $tr_ret_master->ret_total->EditValue ?>"<?php echo $tr_ret_master->ret_total->EditAttributes() ?>>
</span>
</script>
<?php echo $tr_ret_master->ret_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_ret_master_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<script id="tpx_tr_ret_master_address3" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_address3">
<input type="hidden" data-table="tr_ret_master" data-field="x_address3" name="x_address3" id="x_address3" value="<?php echo ew_HtmlEncode($tr_ret_master->address3->CurrentValue) ?>">
</span>
</script>
<script id="tpx_tr_ret_master_kode_depo" class="tr_ret_masteredit" type="text/html">
<span id="el_tr_ret_master_kode_depo">
<input type="hidden" data-table="tr_ret_master" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" value="<?php echo ew_HtmlEncode($tr_ret_master->kode_depo->CurrentValue) ?>">
</span>
</script>
<input type="hidden" data-table="tr_ret_master" data-field="x_ret_id" name="x_ret_id" id="x_ret_id" value="<?php echo ew_HtmlEncode($tr_ret_master->ret_id->CurrentValue) ?>">
<?php
	if (in_array("tr_ret_item", explode(",", $tr_ret_master->getCurrentDetailTable())) && $tr_ret_item->DetailEdit) {
?>
<?php if ($tr_ret_master->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("tr_ret_item", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tr_ret_itemgrid.php" ?>
<?php } ?>
<?php if (!$tr_ret_master_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tr_ret_master_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tr_ret_master_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tr_ret_master_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($tr_ret_master->Rows) ?> };
ew_ApplyTemplate("tpd_tr_ret_masteredit", "tpm_tr_ret_masteredit", "tr_ret_masteredit", "<?php echo $tr_ret_master->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.tr_ret_masteredit_js").each(function(){ew_AddScript(this.text);});
</script>
<script type="text/javascript">
ftr_ret_masteredit.Init();
</script>
<?php
$tr_ret_master_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_ret_master_edit->Page_Terminate();
?>
