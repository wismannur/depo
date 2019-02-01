<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_callareainfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_callarea_add = NULL; // Initialize page object first

class ctbl_callarea_add extends ctbl_callarea {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tbl_callarea';

	// Page object name
	var $PageObjName = 'tbl_callarea_add';

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

		// Table object (tbl_callarea)
		if (!isset($GLOBALS["tbl_callarea"]) || get_class($GLOBALS["tbl_callarea"]) == "ctbl_callarea") {
			$GLOBALS["tbl_callarea"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_callarea"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_callarea', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tbl_callarealist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 
		// Create form object

		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->area_name->SetVisibility();
		$this->subwil_id->SetVisibility();
		$this->wilayah_id->SetVisibility();

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
		global $EW_EXPORT, $tbl_callarea;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_callarea);
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
					if ($pageName == "tbl_callareaview.php")
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
			if (@$_GET["area_id"] != "") {
				$this->area_id->setQueryStringValue($_GET["area_id"]);
				$this->setKey("area_id", $this->area_id->CurrentValue); // Set up key
			} else {
				$this->setKey("area_id", ""); // Clear key
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
					$this->Page_Terminate("tbl_callarealist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_callarealist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "tbl_callareaview.php")
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
		$this->area_id->CurrentValue = NULL;
		$this->area_id->OldValue = $this->area_id->CurrentValue;
		$this->area_name->CurrentValue = NULL;
		$this->area_name->OldValue = $this->area_name->CurrentValue;
		$this->subwil_id->CurrentValue = NULL;
		$this->subwil_id->OldValue = $this->subwil_id->CurrentValue;
		$this->wilayah_id->CurrentValue = NULL;
		$this->wilayah_id->OldValue = $this->wilayah_id->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->area_name->FldIsDetailKey) {
			$this->area_name->setFormValue($objForm->GetValue("x_area_name"));
		}
		if (!$this->subwil_id->FldIsDetailKey) {
			$this->subwil_id->setFormValue($objForm->GetValue("x_subwil_id"));
		}
		if (!$this->wilayah_id->FldIsDetailKey) {
			$this->wilayah_id->setFormValue($objForm->GetValue("x_wilayah_id"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->area_name->CurrentValue = $this->area_name->FormValue;
		$this->subwil_id->CurrentValue = $this->subwil_id->FormValue;
		$this->wilayah_id->CurrentValue = $this->wilayah_id->FormValue;
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
		$this->area_id->setDbValue($row['area_id']);
		$this->area_name->setDbValue($row['area_name']);
		$this->subwil_id->setDbValue($row['subwil_id']);
		$this->wilayah_id->setDbValue($row['wilayah_id']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['area_id'] = $this->area_id->CurrentValue;
		$row['area_name'] = $this->area_name->CurrentValue;
		$row['subwil_id'] = $this->subwil_id->CurrentValue;
		$row['wilayah_id'] = $this->wilayah_id->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->area_id->DbValue = $row['area_id'];
		$this->area_name->DbValue = $row['area_name'];
		$this->subwil_id->DbValue = $row['subwil_id'];
		$this->wilayah_id->DbValue = $row['wilayah_id'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("area_id")) <> "")
			$this->area_id->CurrentValue = $this->getKey("area_id"); // area_id
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
		// area_id
		// area_name
		// subwil_id
		// wilayah_id

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// area_id
		$this->area_id->ViewValue = $this->area_id->CurrentValue;
		$this->area_id->ViewCustomAttributes = "";

		// area_name
		$this->area_name->ViewValue = $this->area_name->CurrentValue;
		$this->area_name->ViewCustomAttributes = "";

		// subwil_id
		$this->subwil_id->ViewValue = $this->subwil_id->CurrentValue;
		$this->subwil_id->ViewCustomAttributes = "";

		// wilayah_id
		$this->wilayah_id->ViewValue = $this->wilayah_id->CurrentValue;
		$this->wilayah_id->ViewCustomAttributes = "";

			// area_name
			$this->area_name->LinkCustomAttributes = "";
			$this->area_name->HrefValue = "";
			$this->area_name->TooltipValue = "";

			// subwil_id
			$this->subwil_id->LinkCustomAttributes = "";
			$this->subwil_id->HrefValue = "";
			$this->subwil_id->TooltipValue = "";

			// wilayah_id
			$this->wilayah_id->LinkCustomAttributes = "";
			$this->wilayah_id->HrefValue = "";
			$this->wilayah_id->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// area_name
			$this->area_name->EditAttrs["class"] = "form-control";
			$this->area_name->EditCustomAttributes = "";
			$this->area_name->EditValue = ew_HtmlEncode($this->area_name->CurrentValue);
			$this->area_name->PlaceHolder = ew_RemoveHtml($this->area_name->FldCaption());

			// subwil_id
			$this->subwil_id->EditAttrs["class"] = "form-control";
			$this->subwil_id->EditCustomAttributes = "";
			$this->subwil_id->EditValue = ew_HtmlEncode($this->subwil_id->CurrentValue);
			$this->subwil_id->PlaceHolder = ew_RemoveHtml($this->subwil_id->FldCaption());

			// wilayah_id
			$this->wilayah_id->EditAttrs["class"] = "form-control";
			$this->wilayah_id->EditCustomAttributes = "";
			$this->wilayah_id->EditValue = ew_HtmlEncode($this->wilayah_id->CurrentValue);
			$this->wilayah_id->PlaceHolder = ew_RemoveHtml($this->wilayah_id->FldCaption());

			// Add refer script
			// area_name

			$this->area_name->LinkCustomAttributes = "";
			$this->area_name->HrefValue = "";

			// subwil_id
			$this->subwil_id->LinkCustomAttributes = "";
			$this->subwil_id->HrefValue = "";

			// wilayah_id
			$this->wilayah_id->LinkCustomAttributes = "";
			$this->wilayah_id->HrefValue = "";
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
		if (!ew_CheckInteger($this->subwil_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->subwil_id->FldErrMsg());
		}
		if (!ew_CheckInteger($this->wilayah_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->wilayah_id->FldErrMsg());
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

		// area_name
		$this->area_name->SetDbValueDef($rsnew, $this->area_name->CurrentValue, NULL, FALSE);

		// subwil_id
		$this->subwil_id->SetDbValueDef($rsnew, $this->subwil_id->CurrentValue, NULL, FALSE);

		// wilayah_id
		$this->wilayah_id->SetDbValueDef($rsnew, $this->wilayah_id->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_callarealist.php"), "", $this->TableVar, TRUE);
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
if (!isset($tbl_callarea_add)) $tbl_callarea_add = new ctbl_callarea_add();

// Page init
$tbl_callarea_add->Page_Init();

// Page main
$tbl_callarea_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_callarea_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ftbl_callareaadd = new ew_Form("ftbl_callareaadd", "add");

// Validate form
ftbl_callareaadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_subwil_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_callarea->subwil_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_wilayah_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_callarea->wilayah_id->FldErrMsg()) ?>");

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
ftbl_callareaadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_callareaadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_callarea_add->ShowPageHeader(); ?>
<?php
$tbl_callarea_add->ShowMessage();
?>
<form name="ftbl_callareaadd" id="ftbl_callareaadd" class="<?php echo $tbl_callarea_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_callarea_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_callarea_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_callarea">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($tbl_callarea_add->IsModal) ?>">
<?php if (!$tbl_callarea_add->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tbl_callarea_add->IsMobileOrModal) { ?>
<div class="ewAddDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_tbl_callareaadd" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($tbl_callarea->area_name->Visible) { // area_name ?>
<?php if ($tbl_callarea_add->IsMobileOrModal) { ?>
	<div id="r_area_name" class="form-group">
		<label id="elh_tbl_callarea_area_name" for="x_area_name" class="<?php echo $tbl_callarea_add->LeftColumnClass ?>"><?php echo $tbl_callarea->area_name->FldCaption() ?></label>
		<div class="<?php echo $tbl_callarea_add->RightColumnClass ?>"><div<?php echo $tbl_callarea->area_name->CellAttributes() ?>>
<span id="el_tbl_callarea_area_name">
<input type="text" data-table="tbl_callarea" data-field="x_area_name" name="x_area_name" id="x_area_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_callarea->area_name->getPlaceHolder()) ?>" value="<?php echo $tbl_callarea->area_name->EditValue ?>"<?php echo $tbl_callarea->area_name->EditAttributes() ?>>
</span>
<?php echo $tbl_callarea->area_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_area_name">
		<td class="col-sm-2"><span id="elh_tbl_callarea_area_name"><?php echo $tbl_callarea->area_name->FldCaption() ?></span></td>
		<td<?php echo $tbl_callarea->area_name->CellAttributes() ?>>
<span id="el_tbl_callarea_area_name">
<input type="text" data-table="tbl_callarea" data-field="x_area_name" name="x_area_name" id="x_area_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_callarea->area_name->getPlaceHolder()) ?>" value="<?php echo $tbl_callarea->area_name->EditValue ?>"<?php echo $tbl_callarea->area_name->EditAttributes() ?>>
</span>
<?php echo $tbl_callarea->area_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_callarea->subwil_id->Visible) { // subwil_id ?>
<?php if ($tbl_callarea_add->IsMobileOrModal) { ?>
	<div id="r_subwil_id" class="form-group">
		<label id="elh_tbl_callarea_subwil_id" for="x_subwil_id" class="<?php echo $tbl_callarea_add->LeftColumnClass ?>"><?php echo $tbl_callarea->subwil_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_callarea_add->RightColumnClass ?>"><div<?php echo $tbl_callarea->subwil_id->CellAttributes() ?>>
<span id="el_tbl_callarea_subwil_id">
<input type="text" data-table="tbl_callarea" data-field="x_subwil_id" name="x_subwil_id" id="x_subwil_id" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_callarea->subwil_id->getPlaceHolder()) ?>" value="<?php echo $tbl_callarea->subwil_id->EditValue ?>"<?php echo $tbl_callarea->subwil_id->EditAttributes() ?>>
</span>
<?php echo $tbl_callarea->subwil_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_subwil_id">
		<td class="col-sm-2"><span id="elh_tbl_callarea_subwil_id"><?php echo $tbl_callarea->subwil_id->FldCaption() ?></span></td>
		<td<?php echo $tbl_callarea->subwil_id->CellAttributes() ?>>
<span id="el_tbl_callarea_subwil_id">
<input type="text" data-table="tbl_callarea" data-field="x_subwil_id" name="x_subwil_id" id="x_subwil_id" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_callarea->subwil_id->getPlaceHolder()) ?>" value="<?php echo $tbl_callarea->subwil_id->EditValue ?>"<?php echo $tbl_callarea->subwil_id->EditAttributes() ?>>
</span>
<?php echo $tbl_callarea->subwil_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_callarea->wilayah_id->Visible) { // wilayah_id ?>
<?php if ($tbl_callarea_add->IsMobileOrModal) { ?>
	<div id="r_wilayah_id" class="form-group">
		<label id="elh_tbl_callarea_wilayah_id" for="x_wilayah_id" class="<?php echo $tbl_callarea_add->LeftColumnClass ?>"><?php echo $tbl_callarea->wilayah_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_callarea_add->RightColumnClass ?>"><div<?php echo $tbl_callarea->wilayah_id->CellAttributes() ?>>
<span id="el_tbl_callarea_wilayah_id">
<input type="text" data-table="tbl_callarea" data-field="x_wilayah_id" name="x_wilayah_id" id="x_wilayah_id" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_callarea->wilayah_id->getPlaceHolder()) ?>" value="<?php echo $tbl_callarea->wilayah_id->EditValue ?>"<?php echo $tbl_callarea->wilayah_id->EditAttributes() ?>>
</span>
<?php echo $tbl_callarea->wilayah_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_wilayah_id">
		<td class="col-sm-2"><span id="elh_tbl_callarea_wilayah_id"><?php echo $tbl_callarea->wilayah_id->FldCaption() ?></span></td>
		<td<?php echo $tbl_callarea->wilayah_id->CellAttributes() ?>>
<span id="el_tbl_callarea_wilayah_id">
<input type="text" data-table="tbl_callarea" data-field="x_wilayah_id" name="x_wilayah_id" id="x_wilayah_id" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_callarea->wilayah_id->getPlaceHolder()) ?>" value="<?php echo $tbl_callarea->wilayah_id->EditValue ?>"<?php echo $tbl_callarea->wilayah_id->EditAttributes() ?>>
</span>
<?php echo $tbl_callarea->wilayah_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_callarea_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$tbl_callarea_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_callarea_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_callarea_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tbl_callarea_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ftbl_callareaadd.Init();
</script>
<?php
$tbl_callarea_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_callarea_add->Page_Terminate();
?>
