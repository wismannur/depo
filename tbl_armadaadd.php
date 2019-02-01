<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_armadainfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_armada_add = NULL; // Initialize page object first

class ctbl_armada_add extends ctbl_armada {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tbl_armada';

	// Page object name
	var $PageObjName = 'tbl_armada_add';

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

		// Table object (tbl_armada)
		if (!isset($GLOBALS["tbl_armada"]) || get_class($GLOBALS["tbl_armada"]) == "ctbl_armada") {
			$GLOBALS["tbl_armada"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_armada"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_armada', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tbl_armadalist.php"));
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
		$this->no_mobil->SetVisibility();
		$this->deskripsi->SetVisibility();
		$this->sopir->SetVisibility();
		$this->kode_depo->SetVisibility();

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
		global $EW_EXPORT, $tbl_armada;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_armada);
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
					if ($pageName == "tbl_armadaview.php")
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
			if (@$_GET["armada_id"] != "") {
				$this->armada_id->setQueryStringValue($_GET["armada_id"]);
				$this->setKey("armada_id", $this->armada_id->CurrentValue); // Set up key
			} else {
				$this->setKey("armada_id", ""); // Clear key
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
					$this->Page_Terminate("tbl_armadalist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_armadalist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "tbl_armadaview.php")
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
		$this->armada_id->CurrentValue = NULL;
		$this->armada_id->OldValue = $this->armada_id->CurrentValue;
		$this->no_mobil->CurrentValue = NULL;
		$this->no_mobil->OldValue = $this->no_mobil->CurrentValue;
		$this->deskripsi->CurrentValue = NULL;
		$this->deskripsi->OldValue = $this->deskripsi->CurrentValue;
		$this->sopir->CurrentValue = NULL;
		$this->sopir->OldValue = $this->sopir->CurrentValue;
		$this->kode_depo->CurrentValue = NULL;
		$this->kode_depo->OldValue = $this->kode_depo->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->no_mobil->FldIsDetailKey) {
			$this->no_mobil->setFormValue($objForm->GetValue("x_no_mobil"));
		}
		if (!$this->deskripsi->FldIsDetailKey) {
			$this->deskripsi->setFormValue($objForm->GetValue("x_deskripsi"));
		}
		if (!$this->sopir->FldIsDetailKey) {
			$this->sopir->setFormValue($objForm->GetValue("x_sopir"));
		}
		if (!$this->kode_depo->FldIsDetailKey) {
			$this->kode_depo->setFormValue($objForm->GetValue("x_kode_depo"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->no_mobil->CurrentValue = $this->no_mobil->FormValue;
		$this->deskripsi->CurrentValue = $this->deskripsi->FormValue;
		$this->sopir->CurrentValue = $this->sopir->FormValue;
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
		$this->armada_id->setDbValue($row['armada_id']);
		$this->no_mobil->setDbValue($row['no_mobil']);
		$this->deskripsi->setDbValue($row['deskripsi']);
		$this->sopir->setDbValue($row['sopir']);
		$this->kode_depo->setDbValue($row['kode_depo']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['armada_id'] = $this->armada_id->CurrentValue;
		$row['no_mobil'] = $this->no_mobil->CurrentValue;
		$row['deskripsi'] = $this->deskripsi->CurrentValue;
		$row['sopir'] = $this->sopir->CurrentValue;
		$row['kode_depo'] = $this->kode_depo->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->armada_id->DbValue = $row['armada_id'];
		$this->no_mobil->DbValue = $row['no_mobil'];
		$this->deskripsi->DbValue = $row['deskripsi'];
		$this->sopir->DbValue = $row['sopir'];
		$this->kode_depo->DbValue = $row['kode_depo'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("armada_id")) <> "")
			$this->armada_id->CurrentValue = $this->getKey("armada_id"); // armada_id
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
		// armada_id
		// no_mobil
		// deskripsi
		// sopir
		// kode_depo

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// armada_id
		$this->armada_id->ViewValue = $this->armada_id->CurrentValue;
		$this->armada_id->ViewCustomAttributes = "";

		// no_mobil
		$this->no_mobil->ViewValue = $this->no_mobil->CurrentValue;
		$this->no_mobil->ViewCustomAttributes = "";

		// deskripsi
		$this->deskripsi->ViewValue = $this->deskripsi->CurrentValue;
		$this->deskripsi->ViewCustomAttributes = "";

		// sopir
		$this->sopir->ViewValue = $this->sopir->CurrentValue;
		$this->sopir->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

			// no_mobil
			$this->no_mobil->LinkCustomAttributes = "";
			$this->no_mobil->HrefValue = "";
			$this->no_mobil->TooltipValue = "";

			// deskripsi
			$this->deskripsi->LinkCustomAttributes = "";
			$this->deskripsi->HrefValue = "";
			$this->deskripsi->TooltipValue = "";

			// sopir
			$this->sopir->LinkCustomAttributes = "";
			$this->sopir->HrefValue = "";
			$this->sopir->TooltipValue = "";

			// kode_depo
			$this->kode_depo->LinkCustomAttributes = "";
			$this->kode_depo->HrefValue = "";
			$this->kode_depo->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// no_mobil
			$this->no_mobil->EditAttrs["class"] = "form-control";
			$this->no_mobil->EditCustomAttributes = "";
			$this->no_mobil->EditValue = ew_HtmlEncode($this->no_mobil->CurrentValue);
			$this->no_mobil->PlaceHolder = ew_RemoveHtml($this->no_mobil->FldCaption());

			// deskripsi
			$this->deskripsi->EditAttrs["class"] = "form-control";
			$this->deskripsi->EditCustomAttributes = "";
			$this->deskripsi->EditValue = ew_HtmlEncode($this->deskripsi->CurrentValue);
			$this->deskripsi->PlaceHolder = ew_RemoveHtml($this->deskripsi->FldCaption());

			// sopir
			$this->sopir->EditAttrs["class"] = "form-control";
			$this->sopir->EditCustomAttributes = "";
			$this->sopir->EditValue = ew_HtmlEncode($this->sopir->CurrentValue);
			$this->sopir->PlaceHolder = ew_RemoveHtml($this->sopir->FldCaption());

			// kode_depo
			$this->kode_depo->EditAttrs["class"] = "form-control";
			$this->kode_depo->EditCustomAttributes = "";
			$this->kode_depo->EditValue = ew_HtmlEncode($this->kode_depo->CurrentValue);
			$this->kode_depo->PlaceHolder = ew_RemoveHtml($this->kode_depo->FldCaption());

			// Add refer script
			// no_mobil

			$this->no_mobil->LinkCustomAttributes = "";
			$this->no_mobil->HrefValue = "";

			// deskripsi
			$this->deskripsi->LinkCustomAttributes = "";
			$this->deskripsi->HrefValue = "";

			// sopir
			$this->sopir->LinkCustomAttributes = "";
			$this->sopir->HrefValue = "";

			// kode_depo
			$this->kode_depo->LinkCustomAttributes = "";
			$this->kode_depo->HrefValue = "";
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

		// no_mobil
		$this->no_mobil->SetDbValueDef($rsnew, $this->no_mobil->CurrentValue, NULL, FALSE);

		// deskripsi
		$this->deskripsi->SetDbValueDef($rsnew, $this->deskripsi->CurrentValue, NULL, FALSE);

		// sopir
		$this->sopir->SetDbValueDef($rsnew, $this->sopir->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_armadalist.php"), "", $this->TableVar, TRUE);
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
if (!isset($tbl_armada_add)) $tbl_armada_add = new ctbl_armada_add();

// Page init
$tbl_armada_add->Page_Init();

// Page main
$tbl_armada_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_armada_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ftbl_armadaadd = new ew_Form("ftbl_armadaadd", "add");

// Validate form
ftbl_armadaadd.Validate = function() {
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
ftbl_armadaadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_armadaadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_armada_add->ShowPageHeader(); ?>
<?php
$tbl_armada_add->ShowMessage();
?>
<form name="ftbl_armadaadd" id="ftbl_armadaadd" class="<?php echo $tbl_armada_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_armada_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_armada_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_armada">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($tbl_armada_add->IsModal) ?>">
<?php if (!$tbl_armada_add->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tbl_armada_add->IsMobileOrModal) { ?>
<div class="ewAddDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_tbl_armadaadd" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($tbl_armada->no_mobil->Visible) { // no_mobil ?>
<?php if ($tbl_armada_add->IsMobileOrModal) { ?>
	<div id="r_no_mobil" class="form-group">
		<label id="elh_tbl_armada_no_mobil" for="x_no_mobil" class="<?php echo $tbl_armada_add->LeftColumnClass ?>"><?php echo $tbl_armada->no_mobil->FldCaption() ?></label>
		<div class="<?php echo $tbl_armada_add->RightColumnClass ?>"><div<?php echo $tbl_armada->no_mobil->CellAttributes() ?>>
<span id="el_tbl_armada_no_mobil">
<input type="text" data-table="tbl_armada" data-field="x_no_mobil" name="x_no_mobil" id="x_no_mobil" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tbl_armada->no_mobil->getPlaceHolder()) ?>" value="<?php echo $tbl_armada->no_mobil->EditValue ?>"<?php echo $tbl_armada->no_mobil->EditAttributes() ?>>
</span>
<?php echo $tbl_armada->no_mobil->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_no_mobil">
		<td class="col-sm-2"><span id="elh_tbl_armada_no_mobil"><?php echo $tbl_armada->no_mobil->FldCaption() ?></span></td>
		<td<?php echo $tbl_armada->no_mobil->CellAttributes() ?>>
<span id="el_tbl_armada_no_mobil">
<input type="text" data-table="tbl_armada" data-field="x_no_mobil" name="x_no_mobil" id="x_no_mobil" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tbl_armada->no_mobil->getPlaceHolder()) ?>" value="<?php echo $tbl_armada->no_mobil->EditValue ?>"<?php echo $tbl_armada->no_mobil->EditAttributes() ?>>
</span>
<?php echo $tbl_armada->no_mobil->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_armada->deskripsi->Visible) { // deskripsi ?>
<?php if ($tbl_armada_add->IsMobileOrModal) { ?>
	<div id="r_deskripsi" class="form-group">
		<label id="elh_tbl_armada_deskripsi" for="x_deskripsi" class="<?php echo $tbl_armada_add->LeftColumnClass ?>"><?php echo $tbl_armada->deskripsi->FldCaption() ?></label>
		<div class="<?php echo $tbl_armada_add->RightColumnClass ?>"><div<?php echo $tbl_armada->deskripsi->CellAttributes() ?>>
<span id="el_tbl_armada_deskripsi">
<input type="text" data-table="tbl_armada" data-field="x_deskripsi" name="x_deskripsi" id="x_deskripsi" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_armada->deskripsi->getPlaceHolder()) ?>" value="<?php echo $tbl_armada->deskripsi->EditValue ?>"<?php echo $tbl_armada->deskripsi->EditAttributes() ?>>
</span>
<?php echo $tbl_armada->deskripsi->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_deskripsi">
		<td class="col-sm-2"><span id="elh_tbl_armada_deskripsi"><?php echo $tbl_armada->deskripsi->FldCaption() ?></span></td>
		<td<?php echo $tbl_armada->deskripsi->CellAttributes() ?>>
<span id="el_tbl_armada_deskripsi">
<input type="text" data-table="tbl_armada" data-field="x_deskripsi" name="x_deskripsi" id="x_deskripsi" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_armada->deskripsi->getPlaceHolder()) ?>" value="<?php echo $tbl_armada->deskripsi->EditValue ?>"<?php echo $tbl_armada->deskripsi->EditAttributes() ?>>
</span>
<?php echo $tbl_armada->deskripsi->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_armada->sopir->Visible) { // sopir ?>
<?php if ($tbl_armada_add->IsMobileOrModal) { ?>
	<div id="r_sopir" class="form-group">
		<label id="elh_tbl_armada_sopir" for="x_sopir" class="<?php echo $tbl_armada_add->LeftColumnClass ?>"><?php echo $tbl_armada->sopir->FldCaption() ?></label>
		<div class="<?php echo $tbl_armada_add->RightColumnClass ?>"><div<?php echo $tbl_armada->sopir->CellAttributes() ?>>
<span id="el_tbl_armada_sopir">
<input type="text" data-table="tbl_armada" data-field="x_sopir" name="x_sopir" id="x_sopir" size="30" maxlength="35" placeholder="<?php echo ew_HtmlEncode($tbl_armada->sopir->getPlaceHolder()) ?>" value="<?php echo $tbl_armada->sopir->EditValue ?>"<?php echo $tbl_armada->sopir->EditAttributes() ?>>
</span>
<?php echo $tbl_armada->sopir->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sopir">
		<td class="col-sm-2"><span id="elh_tbl_armada_sopir"><?php echo $tbl_armada->sopir->FldCaption() ?></span></td>
		<td<?php echo $tbl_armada->sopir->CellAttributes() ?>>
<span id="el_tbl_armada_sopir">
<input type="text" data-table="tbl_armada" data-field="x_sopir" name="x_sopir" id="x_sopir" size="30" maxlength="35" placeholder="<?php echo ew_HtmlEncode($tbl_armada->sopir->getPlaceHolder()) ?>" value="<?php echo $tbl_armada->sopir->EditValue ?>"<?php echo $tbl_armada->sopir->EditAttributes() ?>>
</span>
<?php echo $tbl_armada->sopir->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_armada->kode_depo->Visible) { // kode_depo ?>
<?php if ($tbl_armada_add->IsMobileOrModal) { ?>
	<div id="r_kode_depo" class="form-group">
		<label id="elh_tbl_armada_kode_depo" for="x_kode_depo" class="<?php echo $tbl_armada_add->LeftColumnClass ?>"><?php echo $tbl_armada->kode_depo->FldCaption() ?></label>
		<div class="<?php echo $tbl_armada_add->RightColumnClass ?>"><div<?php echo $tbl_armada->kode_depo->CellAttributes() ?>>
<span id="el_tbl_armada_kode_depo">
<input type="text" data-table="tbl_armada" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" size="30" maxlength="3" placeholder="<?php echo ew_HtmlEncode($tbl_armada->kode_depo->getPlaceHolder()) ?>" value="<?php echo $tbl_armada->kode_depo->EditValue ?>"<?php echo $tbl_armada->kode_depo->EditAttributes() ?>>
</span>
<?php echo $tbl_armada->kode_depo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_kode_depo">
		<td class="col-sm-2"><span id="elh_tbl_armada_kode_depo"><?php echo $tbl_armada->kode_depo->FldCaption() ?></span></td>
		<td<?php echo $tbl_armada->kode_depo->CellAttributes() ?>>
<span id="el_tbl_armada_kode_depo">
<input type="text" data-table="tbl_armada" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" size="30" maxlength="3" placeholder="<?php echo ew_HtmlEncode($tbl_armada->kode_depo->getPlaceHolder()) ?>" value="<?php echo $tbl_armada->kode_depo->EditValue ?>"<?php echo $tbl_armada->kode_depo->EditAttributes() ?>>
</span>
<?php echo $tbl_armada->kode_depo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_armada_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$tbl_armada_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_armada_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_armada_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tbl_armada_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ftbl_armadaadd.Init();
</script>
<?php
$tbl_armada_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_armada_add->Page_Terminate();
?>
