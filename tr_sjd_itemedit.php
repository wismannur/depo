<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tr_sjd_iteminfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "tr_sjd_masterinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tr_sjd_item_edit = NULL; // Initialize page object first

class ctr_sjd_item_edit extends ctr_sjd_item {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tr_sjd_item';

	// Page object name
	var $PageObjName = 'tr_sjd_item_edit';

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

		// Table object (tr_sjd_item)
		if (!isset($GLOBALS["tr_sjd_item"]) || get_class($GLOBALS["tr_sjd_item"]) == "ctr_sjd_item") {
			$GLOBALS["tr_sjd_item"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tr_sjd_item"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Table object (tr_sjd_master)
		if (!isset($GLOBALS['tr_sjd_master'])) $GLOBALS['tr_sjd_master'] = new ctr_sjd_master();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tr_sjd_item', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tr_sjd_itemlist.php"));
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
		$this->item_id->SetVisibility();
		$this->item_code->SetVisibility();
		$this->unit_id->SetVisibility();
		$this->item_price->SetVisibility();
		$this->item_qty->SetVisibility();
		$this->qty_rcv->SetVisibility();
		$this->udet_id->SetVisibility();
		$this->cek_sjd->SetVisibility();

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
		global $EW_EXPORT, $tr_sjd_item;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tr_sjd_item);
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
					if ($pageName == "tr_sjd_itemview.php")
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
					$this->Page_Terminate("tr_sjd_itemlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = "tr_sjd_itemlist.php";
				if (ew_GetPageName($sReturnUrl) == "tr_sjd_itemlist.php")
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
		if (!$this->item_id->FldIsDetailKey) {
			$this->item_id->setFormValue($objForm->GetValue("x_item_id"));
		}
		if (!$this->item_code->FldIsDetailKey) {
			$this->item_code->setFormValue($objForm->GetValue("x_item_code"));
		}
		if (!$this->unit_id->FldIsDetailKey) {
			$this->unit_id->setFormValue($objForm->GetValue("x_unit_id"));
		}
		if (!$this->item_price->FldIsDetailKey) {
			$this->item_price->setFormValue($objForm->GetValue("x_item_price"));
		}
		if (!$this->item_qty->FldIsDetailKey) {
			$this->item_qty->setFormValue($objForm->GetValue("x_item_qty"));
		}
		if (!$this->qty_rcv->FldIsDetailKey) {
			$this->qty_rcv->setFormValue($objForm->GetValue("x_qty_rcv"));
		}
		if (!$this->udet_id->FldIsDetailKey) {
			$this->udet_id->setFormValue($objForm->GetValue("x_udet_id"));
		}
		if (!$this->cek_sjd->FldIsDetailKey) {
			$this->cek_sjd->setFormValue($objForm->GetValue("x_cek_sjd"));
		}
		if (!$this->row_id->FldIsDetailKey)
			$this->row_id->setFormValue($objForm->GetValue("x_row_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->row_id->CurrentValue = $this->row_id->FormValue;
		$this->item_id->CurrentValue = $this->item_id->FormValue;
		$this->item_code->CurrentValue = $this->item_code->FormValue;
		$this->unit_id->CurrentValue = $this->unit_id->FormValue;
		$this->item_price->CurrentValue = $this->item_price->FormValue;
		$this->item_qty->CurrentValue = $this->item_qty->FormValue;
		$this->qty_rcv->CurrentValue = $this->qty_rcv->FormValue;
		$this->udet_id->CurrentValue = $this->udet_id->FormValue;
		$this->cek_sjd->CurrentValue = $this->cek_sjd->FormValue;
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
		$this->item_id->setDbValue($row['item_id']);
		$this->item_code->setDbValue($row['item_code']);
		$this->unit_id->setDbValue($row['unit_id']);
		$this->item_price->setDbValue($row['item_price']);
		$this->item_qty->setDbValue($row['item_qty']);
		$this->qty_rcv->setDbValue($row['qty_rcv']);
		$this->item_name->setDbValue($row['item_name']);
		$this->udet_id->setDbValue($row['udet_id']);
		$this->cek_sjd->setDbValue($row['cek_sjd']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['row_id'] = NULL;
		$row['master_id'] = NULL;
		$row['item_id'] = NULL;
		$row['item_code'] = NULL;
		$row['unit_id'] = NULL;
		$row['item_price'] = NULL;
		$row['item_qty'] = NULL;
		$row['qty_rcv'] = NULL;
		$row['item_name'] = NULL;
		$row['udet_id'] = NULL;
		$row['cek_sjd'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->row_id->DbValue = $row['row_id'];
		$this->master_id->DbValue = $row['master_id'];
		$this->item_id->DbValue = $row['item_id'];
		$this->item_code->DbValue = $row['item_code'];
		$this->unit_id->DbValue = $row['unit_id'];
		$this->item_price->DbValue = $row['item_price'];
		$this->item_qty->DbValue = $row['item_qty'];
		$this->qty_rcv->DbValue = $row['qty_rcv'];
		$this->item_name->DbValue = $row['item_name'];
		$this->udet_id->DbValue = $row['udet_id'];
		$this->cek_sjd->DbValue = $row['cek_sjd'];
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

		if ($this->item_price->FormValue == $this->item_price->CurrentValue && is_numeric(ew_StrToFloat($this->item_price->CurrentValue)))
			$this->item_price->CurrentValue = ew_StrToFloat($this->item_price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->item_qty->FormValue == $this->item_qty->CurrentValue && is_numeric(ew_StrToFloat($this->item_qty->CurrentValue)))
			$this->item_qty->CurrentValue = ew_StrToFloat($this->item_qty->CurrentValue);

		// Convert decimal values if posted back
		if ($this->qty_rcv->FormValue == $this->qty_rcv->CurrentValue && is_numeric(ew_StrToFloat($this->qty_rcv->CurrentValue)))
			$this->qty_rcv->CurrentValue = ew_StrToFloat($this->qty_rcv->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// row_id
		// master_id
		// item_id
		// item_code
		// unit_id
		// item_price
		// item_qty
		// qty_rcv
		// item_name
		// udet_id
		// cek_sjd

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// row_id
		$this->row_id->ViewValue = $this->row_id->CurrentValue;
		$this->row_id->ViewCustomAttributes = "";

		// master_id
		$this->master_id->ViewValue = $this->master_id->CurrentValue;
		$this->master_id->ViewCustomAttributes = "";

		// item_id
		$this->item_id->ViewValue = $this->item_id->CurrentValue;
		if (strval($this->item_id->CurrentValue) <> "") {
			$sFilterWrk = "`product_id`" . ew_SearchString("=", $this->item_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `product_id`, `product_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_products`";
		$sWhereWrk = "";
		$this->item_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->item_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `product_name`";
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->item_id->ViewValue = $this->item_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->item_id->ViewValue = $this->item_id->CurrentValue;
			}
		} else {
			$this->item_id->ViewValue = NULL;
		}
		$this->item_id->ViewCustomAttributes = "";

		// item_code
		$this->item_code->ViewValue = $this->item_code->CurrentValue;
		$this->item_code->ViewCustomAttributes = "";

		// unit_id
		if (strval($this->unit_id->CurrentValue) <> "") {
			$sFilterWrk = "`unit_id`" . ew_SearchString("=", $this->unit_id->CurrentValue, EW_DATATYPE_STRING, "db_inventory_pusat");
		$sSqlWrk = "SELECT `unit_id`, `unit_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_unit_detail`";
		$sWhereWrk = "";
		$this->unit_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->unit_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->unit_id->ViewValue = $this->unit_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->unit_id->ViewValue = $this->unit_id->CurrentValue;
			}
		} else {
			$this->unit_id->ViewValue = NULL;
		}
		$this->unit_id->ViewCustomAttributes = "";

		// item_price
		$this->item_price->ViewValue = $this->item_price->CurrentValue;
		$this->item_price->ViewValue = ew_FormatNumber($this->item_price->ViewValue, 2, -2, -2, -2);
		$this->item_price->CellCssStyle .= "text-align: right;";
		$this->item_price->ViewCustomAttributes = "";

		// item_qty
		$this->item_qty->ViewValue = $this->item_qty->CurrentValue;
		$this->item_qty->ViewValue = ew_FormatNumber($this->item_qty->ViewValue, 2, -2, -2, -2);
		$this->item_qty->CellCssStyle .= "text-align: right;";
		$this->item_qty->ViewCustomAttributes = "";

		// qty_rcv
		$this->qty_rcv->ViewValue = $this->qty_rcv->CurrentValue;
		$this->qty_rcv->ViewValue = ew_FormatNumber($this->qty_rcv->ViewValue, 2, -2, -2, -2);
		$this->qty_rcv->CellCssStyle .= "text-align: right;";
		$this->qty_rcv->ViewCustomAttributes = "";

		// item_name
		$this->item_name->ViewValue = $this->item_name->CurrentValue;
		$this->item_name->ViewCustomAttributes = "";

		// udet_id
		$this->udet_id->ViewValue = $this->udet_id->CurrentValue;
		$this->udet_id->ViewCustomAttributes = "";

		// cek_sjd
		$this->cek_sjd->ViewCustomAttributes = "";

			// item_id
			$this->item_id->LinkCustomAttributes = "";
			$this->item_id->HrefValue = "";
			$this->item_id->TooltipValue = "";

			// item_code
			$this->item_code->LinkCustomAttributes = "";
			$this->item_code->HrefValue = "";
			$this->item_code->TooltipValue = "";

			// unit_id
			$this->unit_id->LinkCustomAttributes = "";
			$this->unit_id->HrefValue = "";
			$this->unit_id->TooltipValue = "";

			// item_price
			$this->item_price->LinkCustomAttributes = "";
			$this->item_price->HrefValue = "";
			$this->item_price->TooltipValue = "";

			// item_qty
			$this->item_qty->LinkCustomAttributes = "";
			$this->item_qty->HrefValue = "";
			$this->item_qty->TooltipValue = "";

			// qty_rcv
			$this->qty_rcv->LinkCustomAttributes = "";
			$this->qty_rcv->HrefValue = "";
			$this->qty_rcv->TooltipValue = "";

			// udet_id
			$this->udet_id->LinkCustomAttributes = "";
			$this->udet_id->HrefValue = "";
			$this->udet_id->TooltipValue = "";

			// cek_sjd
			$this->cek_sjd->LinkCustomAttributes = "";
			$this->cek_sjd->HrefValue = "";
			$this->cek_sjd->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// item_id
			$this->item_id->EditAttrs["class"] = "form-control";
			$this->item_id->EditCustomAttributes = "";
			$this->item_id->EditValue = ew_HtmlEncode($this->item_id->CurrentValue);
			if (strval($this->item_id->CurrentValue) <> "") {
				$sFilterWrk = "`product_id`" . ew_SearchString("=", $this->item_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
			$sSqlWrk = "SELECT `product_id`, `product_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_products`";
			$sWhereWrk = "";
			$this->item_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->item_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `product_name`";
				$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->item_id->EditValue = $this->item_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->item_id->EditValue = ew_HtmlEncode($this->item_id->CurrentValue);
				}
			} else {
				$this->item_id->EditValue = NULL;
			}
			$this->item_id->PlaceHolder = ew_RemoveHtml($this->item_id->FldCaption());

			// item_code
			$this->item_code->EditAttrs["class"] = "form-control";
			$this->item_code->EditCustomAttributes = "";
			$this->item_code->EditValue = ew_HtmlEncode($this->item_code->CurrentValue);
			$this->item_code->PlaceHolder = ew_RemoveHtml($this->item_code->FldCaption());

			// unit_id
			$this->unit_id->EditCustomAttributes = "";
			if (trim(strval($this->unit_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`unit_id`" . ew_SearchString("=", $this->unit_id->CurrentValue, EW_DATATYPE_STRING, "db_inventory_pusat");
			}
			$sSqlWrk = "SELECT `unit_id`, `unit_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tbl_unit_detail`";
			$sWhereWrk = "";
			$this->unit_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->unit_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->unit_id->ViewValue = $this->unit_id->DisplayValue($arwrk);
			} else {
				$this->unit_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->unit_id->EditValue = $arwrk;

			// item_price
			$this->item_price->EditAttrs["class"] = "form-control";
			$this->item_price->EditCustomAttributes = "";
			$this->item_price->EditValue = ew_HtmlEncode($this->item_price->CurrentValue);
			$this->item_price->PlaceHolder = ew_RemoveHtml($this->item_price->FldCaption());
			if (strval($this->item_price->EditValue) <> "" && is_numeric($this->item_price->EditValue)) $this->item_price->EditValue = ew_FormatNumber($this->item_price->EditValue, -2, -2, -2, -2);

			// item_qty
			$this->item_qty->EditAttrs["class"] = "form-control";
			$this->item_qty->EditCustomAttributes = "";
			$this->item_qty->EditValue = ew_HtmlEncode($this->item_qty->CurrentValue);
			$this->item_qty->PlaceHolder = ew_RemoveHtml($this->item_qty->FldCaption());
			if (strval($this->item_qty->EditValue) <> "" && is_numeric($this->item_qty->EditValue)) $this->item_qty->EditValue = ew_FormatNumber($this->item_qty->EditValue, -2, -2, -2, -2);

			// qty_rcv
			$this->qty_rcv->EditAttrs["class"] = "form-control";
			$this->qty_rcv->EditCustomAttributes = "";
			$this->qty_rcv->EditValue = ew_HtmlEncode($this->qty_rcv->CurrentValue);
			$this->qty_rcv->PlaceHolder = ew_RemoveHtml($this->qty_rcv->FldCaption());
			if (strval($this->qty_rcv->EditValue) <> "" && is_numeric($this->qty_rcv->EditValue)) $this->qty_rcv->EditValue = ew_FormatNumber($this->qty_rcv->EditValue, -2, -2, -2, -2);

			// udet_id
			$this->udet_id->EditAttrs["class"] = "form-control";
			$this->udet_id->EditCustomAttributes = "";
			$this->udet_id->EditValue = ew_HtmlEncode($this->udet_id->CurrentValue);
			$this->udet_id->PlaceHolder = ew_RemoveHtml($this->udet_id->FldCaption());

			// cek_sjd
			$this->cek_sjd->EditCustomAttributes = "";

			// Edit refer script
			// item_id

			$this->item_id->LinkCustomAttributes = "";
			$this->item_id->HrefValue = "";

			// item_code
			$this->item_code->LinkCustomAttributes = "";
			$this->item_code->HrefValue = "";

			// unit_id
			$this->unit_id->LinkCustomAttributes = "";
			$this->unit_id->HrefValue = "";

			// item_price
			$this->item_price->LinkCustomAttributes = "";
			$this->item_price->HrefValue = "";

			// item_qty
			$this->item_qty->LinkCustomAttributes = "";
			$this->item_qty->HrefValue = "";

			// qty_rcv
			$this->qty_rcv->LinkCustomAttributes = "";
			$this->qty_rcv->HrefValue = "";

			// udet_id
			$this->udet_id->LinkCustomAttributes = "";
			$this->udet_id->HrefValue = "";

			// cek_sjd
			$this->cek_sjd->LinkCustomAttributes = "";
			$this->cek_sjd->HrefValue = "";
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
		if (!ew_CheckInteger($this->item_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->item_id->FldErrMsg());
		}
		if (!ew_CheckNumber($this->item_price->FormValue)) {
			ew_AddMessage($gsFormError, $this->item_price->FldErrMsg());
		}
		if (!ew_CheckNumber($this->item_qty->FormValue)) {
			ew_AddMessage($gsFormError, $this->item_qty->FldErrMsg());
		}
		if (!ew_CheckNumber($this->qty_rcv->FormValue)) {
			ew_AddMessage($gsFormError, $this->qty_rcv->FldErrMsg());
		}
		if (!ew_CheckInteger($this->udet_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->udet_id->FldErrMsg());
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

			// item_id
			$this->item_id->SetDbValueDef($rsnew, $this->item_id->CurrentValue, NULL, $this->item_id->ReadOnly);

			// item_code
			$this->item_code->SetDbValueDef($rsnew, $this->item_code->CurrentValue, NULL, $this->item_code->ReadOnly);

			// unit_id
			$this->unit_id->SetDbValueDef($rsnew, $this->unit_id->CurrentValue, NULL, $this->unit_id->ReadOnly);

			// item_price
			$this->item_price->SetDbValueDef($rsnew, $this->item_price->CurrentValue, NULL, $this->item_price->ReadOnly);

			// item_qty
			$this->item_qty->SetDbValueDef($rsnew, $this->item_qty->CurrentValue, NULL, $this->item_qty->ReadOnly);

			// qty_rcv
			$this->qty_rcv->SetDbValueDef($rsnew, $this->qty_rcv->CurrentValue, NULL, $this->qty_rcv->ReadOnly);

			// udet_id
			$this->udet_id->SetDbValueDef($rsnew, $this->udet_id->CurrentValue, NULL, $this->udet_id->ReadOnly);

			// cek_sjd
			$this->cek_sjd->SetDbValueDef($rsnew, $this->cek_sjd->CurrentValue, "", $this->cek_sjd->ReadOnly);

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
			if ($sMasterTblVar == "tr_sjd_master") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_sjd_id"] <> "") {
					$GLOBALS["tr_sjd_master"]->sjd_id->setQueryStringValue($_GET["fk_sjd_id"]);
					$this->master_id->setQueryStringValue($GLOBALS["tr_sjd_master"]->sjd_id->QueryStringValue);
					$this->master_id->setSessionValue($this->master_id->QueryStringValue);
					if (!is_numeric($GLOBALS["tr_sjd_master"]->sjd_id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "tr_sjd_master") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_sjd_id"] <> "") {
					$GLOBALS["tr_sjd_master"]->sjd_id->setFormValue($_POST["fk_sjd_id"]);
					$this->master_id->setFormValue($GLOBALS["tr_sjd_master"]->sjd_id->FormValue);
					$this->master_id->setSessionValue($this->master_id->FormValue);
					if (!is_numeric($GLOBALS["tr_sjd_master"]->sjd_id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "tr_sjd_master") {
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tr_sjd_itemlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_item_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `product_id` AS `LinkFld`, `product_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_products`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "db_inventory_pusat", "f0" => '`product_id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->item_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `product_name`";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_unit_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `unit_id` AS `LinkFld`, `unit_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_unit_detail`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "db_inventory_pusat", "f0" => '`unit_id` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->unit_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
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
		case "x_item_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `product_id`, `product_name` AS `DispFld` FROM `tbl_products`";
			$sWhereWrk = "`product_name` LIKE '{query_value}%'";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "db_inventory_pusat");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->item_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `product_name`";
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
if (!isset($tr_sjd_item_edit)) $tr_sjd_item_edit = new ctr_sjd_item_edit();

// Page init
$tr_sjd_item_edit->Page_Init();

// Page main
$tr_sjd_item_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_sjd_item_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ftr_sjd_itemedit = new ew_Form("ftr_sjd_itemedit", "edit");

// Validate form
ftr_sjd_itemedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_item_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_sjd_item->item_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_item_price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_sjd_item->item_price->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_item_qty");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_sjd_item->item_qty->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_qty_rcv");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_sjd_item->qty_rcv->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_udet_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_sjd_item->udet_id->FldErrMsg()) ?>");

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
ftr_sjd_itemedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_sjd_itemedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_sjd_itemedit.Lists["x_item_id"] = {"LinkField":"x_product_id","Ajax":true,"AutoFill":true,"DisplayFields":["x_product_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_products"};
ftr_sjd_itemedit.Lists["x_item_id"].Data = "<?php echo $tr_sjd_item_edit->item_id->LookupFilterQuery(FALSE, "edit") ?>";
ftr_sjd_itemedit.AutoSuggests["x_item_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $tr_sjd_item_edit->item_id->LookupFilterQuery(TRUE, "edit"))) ?>;
ftr_sjd_itemedit.Lists["x_unit_id"] = {"LinkField":"x_unit_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_unit_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_unit_detail"};
ftr_sjd_itemedit.Lists["x_unit_id"].Data = "<?php echo $tr_sjd_item_edit->unit_id->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tr_sjd_item_edit->ShowPageHeader(); ?>
<?php
$tr_sjd_item_edit->ShowMessage();
?>
<form name="ftr_sjd_itemedit" id="ftr_sjd_itemedit" class="<?php echo $tr_sjd_item_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tr_sjd_item_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tr_sjd_item_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tr_sjd_item">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($tr_sjd_item_edit->IsModal) ?>">
<?php if ($tr_sjd_item->getCurrentMasterTable() == "tr_sjd_master") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="tr_sjd_master">
<input type="hidden" name="fk_sjd_id" value="<?php echo $tr_sjd_item->master_id->getSessionValue() ?>">
<?php } ?>
<?php if (!$tr_sjd_item_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tr_sjd_item_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_tr_sjd_itemedit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($tr_sjd_item->item_id->Visible) { // item_id ?>
<?php if ($tr_sjd_item_edit->IsMobileOrModal) { ?>
	<div id="r_item_id" class="form-group">
		<label id="elh_tr_sjd_item_item_id" class="<?php echo $tr_sjd_item_edit->LeftColumnClass ?>"><?php echo $tr_sjd_item->item_id->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_item_edit->RightColumnClass ?>"><div<?php echo $tr_sjd_item->item_id->CellAttributes() ?>>
<span id="el_tr_sjd_item_item_id">
<?php
$wrkonchange = trim("ew_AutoFill(this); " . @$tr_sjd_item->item_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_sjd_item->item_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_item_id" style="white-space: nowrap; z-index: 8970">
	<input type="text" name="sv_x_item_id" id="sv_x_item_id" value="<?php echo $tr_sjd_item->item_id->EditValue ?>" size="40" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->getPlaceHolder()) ?>"<?php echo $tr_sjd_item->item_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_id" data-value-separator="<?php echo $tr_sjd_item->item_id->DisplayValueSeparatorAttribute() ?>" name="x_item_id" id="x_item_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ftr_sjd_itemedit.CreateAutoSuggest({"id":"x_item_id","forceSelect":true});
</script>
<input type="hidden" name="ln_x_item_id" id="ln_x_item_id" value="x_item_code,x_item_price,x_unit_id">
</span>
<?php echo $tr_sjd_item->item_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_item_id">
		<td class="col-sm-2"><span id="elh_tr_sjd_item_item_id"><?php echo $tr_sjd_item->item_id->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_item->item_id->CellAttributes() ?>>
<span id="el_tr_sjd_item_item_id">
<?php
$wrkonchange = trim("ew_AutoFill(this); " . @$tr_sjd_item->item_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_sjd_item->item_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_item_id" style="white-space: nowrap; z-index: 8970">
	<input type="text" name="sv_x_item_id" id="sv_x_item_id" value="<?php echo $tr_sjd_item->item_id->EditValue ?>" size="40" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->getPlaceHolder()) ?>"<?php echo $tr_sjd_item->item_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_id" data-value-separator="<?php echo $tr_sjd_item->item_id->DisplayValueSeparatorAttribute() ?>" name="x_item_id" id="x_item_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ftr_sjd_itemedit.CreateAutoSuggest({"id":"x_item_id","forceSelect":true});
</script>
<input type="hidden" name="ln_x_item_id" id="ln_x_item_id" value="x_item_code,x_item_price,x_unit_id">
</span>
<?php echo $tr_sjd_item->item_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->item_code->Visible) { // item_code ?>
<?php if ($tr_sjd_item_edit->IsMobileOrModal) { ?>
	<div id="r_item_code" class="form-group">
		<label id="elh_tr_sjd_item_item_code" for="x_item_code" class="<?php echo $tr_sjd_item_edit->LeftColumnClass ?>"><?php echo $tr_sjd_item->item_code->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_item_edit->RightColumnClass ?>"><div<?php echo $tr_sjd_item->item_code->CellAttributes() ?>>
<span id="el_tr_sjd_item_item_code">
<input type="text" data-table="tr_sjd_item" data-field="x_item_code" name="x_item_code" id="x_item_code" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_code->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_code->EditValue ?>"<?php echo $tr_sjd_item->item_code->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_item->item_code->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_item_code">
		<td class="col-sm-2"><span id="elh_tr_sjd_item_item_code"><?php echo $tr_sjd_item->item_code->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_item->item_code->CellAttributes() ?>>
<span id="el_tr_sjd_item_item_code">
<input type="text" data-table="tr_sjd_item" data-field="x_item_code" name="x_item_code" id="x_item_code" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_code->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_code->EditValue ?>"<?php echo $tr_sjd_item->item_code->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_item->item_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->unit_id->Visible) { // unit_id ?>
<?php if ($tr_sjd_item_edit->IsMobileOrModal) { ?>
	<div id="r_unit_id" class="form-group">
		<label id="elh_tr_sjd_item_unit_id" for="x_unit_id" class="<?php echo $tr_sjd_item_edit->LeftColumnClass ?>"><?php echo $tr_sjd_item->unit_id->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_item_edit->RightColumnClass ?>"><div<?php echo $tr_sjd_item->unit_id->CellAttributes() ?>>
<span id="el_tr_sjd_item_unit_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_sjd_item->unit_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_sjd_item->unit_id->ViewValue ?>
	</span>
	<?php if (!$tr_sjd_item->unit_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_unit_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_sjd_item->unit_id->RadioButtonListHtml(TRUE, "x_unit_id") ?>
		</div>
	</div>
	<div id="tp_x_unit_id" class="ewTemplate"><input type="radio" data-table="tr_sjd_item" data-field="x_unit_id" data-value-separator="<?php echo $tr_sjd_item->unit_id->DisplayValueSeparatorAttribute() ?>" name="x_unit_id" id="x_unit_id" value="{value}"<?php echo $tr_sjd_item->unit_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tr_sjd_item->unit_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_unit_id">
		<td class="col-sm-2"><span id="elh_tr_sjd_item_unit_id"><?php echo $tr_sjd_item->unit_id->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_item->unit_id->CellAttributes() ?>>
<span id="el_tr_sjd_item_unit_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_sjd_item->unit_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_sjd_item->unit_id->ViewValue ?>
	</span>
	<?php if (!$tr_sjd_item->unit_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_unit_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_sjd_item->unit_id->RadioButtonListHtml(TRUE, "x_unit_id") ?>
		</div>
	</div>
	<div id="tp_x_unit_id" class="ewTemplate"><input type="radio" data-table="tr_sjd_item" data-field="x_unit_id" data-value-separator="<?php echo $tr_sjd_item->unit_id->DisplayValueSeparatorAttribute() ?>" name="x_unit_id" id="x_unit_id" value="{value}"<?php echo $tr_sjd_item->unit_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tr_sjd_item->unit_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->item_price->Visible) { // item_price ?>
<?php if ($tr_sjd_item_edit->IsMobileOrModal) { ?>
	<div id="r_item_price" class="form-group">
		<label id="elh_tr_sjd_item_item_price" for="x_item_price" class="<?php echo $tr_sjd_item_edit->LeftColumnClass ?>"><?php echo $tr_sjd_item->item_price->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_item_edit->RightColumnClass ?>"><div<?php echo $tr_sjd_item->item_price->CellAttributes() ?>>
<span id="el_tr_sjd_item_item_price">
<input type="text" data-table="tr_sjd_item" data-field="x_item_price" name="x_item_price" id="x_item_price" size="15" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_price->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_price->EditValue ?>"<?php echo $tr_sjd_item->item_price->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_item->item_price->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_item_price">
		<td class="col-sm-2"><span id="elh_tr_sjd_item_item_price"><?php echo $tr_sjd_item->item_price->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_item->item_price->CellAttributes() ?>>
<span id="el_tr_sjd_item_item_price">
<input type="text" data-table="tr_sjd_item" data-field="x_item_price" name="x_item_price" id="x_item_price" size="15" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_price->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_price->EditValue ?>"<?php echo $tr_sjd_item->item_price->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_item->item_price->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->item_qty->Visible) { // item_qty ?>
<?php if ($tr_sjd_item_edit->IsMobileOrModal) { ?>
	<div id="r_item_qty" class="form-group">
		<label id="elh_tr_sjd_item_item_qty" for="x_item_qty" class="<?php echo $tr_sjd_item_edit->LeftColumnClass ?>"><?php echo $tr_sjd_item->item_qty->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_item_edit->RightColumnClass ?>"><div<?php echo $tr_sjd_item->item_qty->CellAttributes() ?>>
<span id="el_tr_sjd_item_item_qty">
<input type="text" data-table="tr_sjd_item" data-field="x_item_qty" name="x_item_qty" id="x_item_qty" size="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_qty->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_qty->EditValue ?>"<?php echo $tr_sjd_item->item_qty->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_item->item_qty->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_item_qty">
		<td class="col-sm-2"><span id="elh_tr_sjd_item_item_qty"><?php echo $tr_sjd_item->item_qty->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_item->item_qty->CellAttributes() ?>>
<span id="el_tr_sjd_item_item_qty">
<input type="text" data-table="tr_sjd_item" data-field="x_item_qty" name="x_item_qty" id="x_item_qty" size="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_qty->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_qty->EditValue ?>"<?php echo $tr_sjd_item->item_qty->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_item->item_qty->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->qty_rcv->Visible) { // qty_rcv ?>
<?php if ($tr_sjd_item_edit->IsMobileOrModal) { ?>
	<div id="r_qty_rcv" class="form-group">
		<label id="elh_tr_sjd_item_qty_rcv" for="x_qty_rcv" class="<?php echo $tr_sjd_item_edit->LeftColumnClass ?>"><?php echo $tr_sjd_item->qty_rcv->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_item_edit->RightColumnClass ?>"><div<?php echo $tr_sjd_item->qty_rcv->CellAttributes() ?>>
<span id="el_tr_sjd_item_qty_rcv">
<input type="text" data-table="tr_sjd_item" data-field="x_qty_rcv" name="x_qty_rcv" id="x_qty_rcv" size="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->qty_rcv->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->qty_rcv->EditValue ?>"<?php echo $tr_sjd_item->qty_rcv->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_item->qty_rcv->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_qty_rcv">
		<td class="col-sm-2"><span id="elh_tr_sjd_item_qty_rcv"><?php echo $tr_sjd_item->qty_rcv->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_item->qty_rcv->CellAttributes() ?>>
<span id="el_tr_sjd_item_qty_rcv">
<input type="text" data-table="tr_sjd_item" data-field="x_qty_rcv" name="x_qty_rcv" id="x_qty_rcv" size="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->qty_rcv->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->qty_rcv->EditValue ?>"<?php echo $tr_sjd_item->qty_rcv->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_item->qty_rcv->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->udet_id->Visible) { // udet_id ?>
<?php if ($tr_sjd_item_edit->IsMobileOrModal) { ?>
	<div id="r_udet_id" class="form-group">
		<label id="elh_tr_sjd_item_udet_id" for="x_udet_id" class="<?php echo $tr_sjd_item_edit->LeftColumnClass ?>"><?php echo $tr_sjd_item->udet_id->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_item_edit->RightColumnClass ?>"><div<?php echo $tr_sjd_item->udet_id->CellAttributes() ?>>
<span id="el_tr_sjd_item_udet_id">
<input type="text" data-table="tr_sjd_item" data-field="x_udet_id" name="x_udet_id" id="x_udet_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->udet_id->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->udet_id->EditValue ?>"<?php echo $tr_sjd_item->udet_id->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_item->udet_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_udet_id">
		<td class="col-sm-2"><span id="elh_tr_sjd_item_udet_id"><?php echo $tr_sjd_item->udet_id->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_item->udet_id->CellAttributes() ?>>
<span id="el_tr_sjd_item_udet_id">
<input type="text" data-table="tr_sjd_item" data-field="x_udet_id" name="x_udet_id" id="x_udet_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->udet_id->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->udet_id->EditValue ?>"<?php echo $tr_sjd_item->udet_id->EditAttributes() ?>>
</span>
<?php echo $tr_sjd_item->udet_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->cek_sjd->Visible) { // cek_sjd ?>
<?php if ($tr_sjd_item_edit->IsMobileOrModal) { ?>
	<div id="r_cek_sjd" class="form-group">
		<label id="elh_tr_sjd_item_cek_sjd" class="<?php echo $tr_sjd_item_edit->LeftColumnClass ?>"><?php echo $tr_sjd_item->cek_sjd->FldCaption() ?></label>
		<div class="<?php echo $tr_sjd_item_edit->RightColumnClass ?>"><div<?php echo $tr_sjd_item->cek_sjd->CellAttributes() ?>>
<span id="el_tr_sjd_item_cek_sjd">
<div id="tp_x_cek_sjd" class="ewTemplate"><input type="checkbox" data-table="tr_sjd_item" data-field="x_cek_sjd" data-value-separator="<?php echo $tr_sjd_item->cek_sjd->DisplayValueSeparatorAttribute() ?>" name="x_cek_sjd[]" id="x_cek_sjd[]" value="{value}"<?php echo $tr_sjd_item->cek_sjd->EditAttributes() ?>></div>
<div id="dsl_x_cek_sjd" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $tr_sjd_item->cek_sjd->CheckBoxListHtml(FALSE, "x_cek_sjd[]") ?>
</div></div>
</span>
<?php echo $tr_sjd_item->cek_sjd->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cek_sjd">
		<td class="col-sm-2"><span id="elh_tr_sjd_item_cek_sjd"><?php echo $tr_sjd_item->cek_sjd->FldCaption() ?></span></td>
		<td<?php echo $tr_sjd_item->cek_sjd->CellAttributes() ?>>
<span id="el_tr_sjd_item_cek_sjd">
<div id="tp_x_cek_sjd" class="ewTemplate"><input type="checkbox" data-table="tr_sjd_item" data-field="x_cek_sjd" data-value-separator="<?php echo $tr_sjd_item->cek_sjd->DisplayValueSeparatorAttribute() ?>" name="x_cek_sjd[]" id="x_cek_sjd[]" value="{value}"<?php echo $tr_sjd_item->cek_sjd->EditAttributes() ?>></div>
<div id="dsl_x_cek_sjd" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $tr_sjd_item->cek_sjd->CheckBoxListHtml(FALSE, "x_cek_sjd[]") ?>
</div></div>
</span>
<?php echo $tr_sjd_item->cek_sjd->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_row_id" name="x_row_id" id="x_row_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->row_id->CurrentValue) ?>">
<?php if (!$tr_sjd_item_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tr_sjd_item_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tr_sjd_item_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tr_sjd_item_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ftr_sjd_itemedit.Init();
</script>
<?php
$tr_sjd_item_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tr_sjd_item_edit->Page_Terminate();
?>
