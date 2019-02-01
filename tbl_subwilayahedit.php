<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_subwilayahinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_subwilayah_edit = NULL; // Initialize page object first

class ctbl_subwilayah_edit extends ctbl_subwilayah {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tbl_subwilayah';

	// Page object name
	var $PageObjName = 'tbl_subwilayah_edit';

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

		// Table object (tbl_subwilayah)
		if (!isset($GLOBALS["tbl_subwilayah"]) || get_class($GLOBALS["tbl_subwilayah"]) == "ctbl_subwilayah") {
			$GLOBALS["tbl_subwilayah"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_subwilayah"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_subwilayah', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tbl_subwilayahlist.php"));
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
		$this->sub_id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->sub_id->Visible = FALSE;
		$this->nama_sub_wilayah->SetVisibility();
		$this->cakupan_area->SetVisibility();
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
		global $EW_EXPORT, $tbl_subwilayah;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_subwilayah);
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
					if ($pageName == "tbl_subwilayahview.php")
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
			if ($objForm->HasValue("x_sub_id")) {
				$this->sub_id->setFormValue($objForm->GetValue("x_sub_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["sub_id"])) {
				$this->sub_id->setQueryStringValue($_GET["sub_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->sub_id->CurrentValue = NULL;
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
					$this->Page_Terminate("tbl_subwilayahlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "tbl_subwilayahlist.php")
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
		if (!$this->sub_id->FldIsDetailKey)
			$this->sub_id->setFormValue($objForm->GetValue("x_sub_id"));
		if (!$this->nama_sub_wilayah->FldIsDetailKey) {
			$this->nama_sub_wilayah->setFormValue($objForm->GetValue("x_nama_sub_wilayah"));
		}
		if (!$this->cakupan_area->FldIsDetailKey) {
			$this->cakupan_area->setFormValue($objForm->GetValue("x_cakupan_area"));
		}
		if (!$this->wilayah_id->FldIsDetailKey) {
			$this->wilayah_id->setFormValue($objForm->GetValue("x_wilayah_id"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->sub_id->CurrentValue = $this->sub_id->FormValue;
		$this->nama_sub_wilayah->CurrentValue = $this->nama_sub_wilayah->FormValue;
		$this->cakupan_area->CurrentValue = $this->cakupan_area->FormValue;
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
		$this->sub_id->setDbValue($row['sub_id']);
		$this->nama_sub_wilayah->setDbValue($row['nama_sub_wilayah']);
		$this->cakupan_area->setDbValue($row['cakupan_area']);
		$this->wilayah_id->setDbValue($row['wilayah_id']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['sub_id'] = NULL;
		$row['nama_sub_wilayah'] = NULL;
		$row['cakupan_area'] = NULL;
		$row['wilayah_id'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->sub_id->DbValue = $row['sub_id'];
		$this->nama_sub_wilayah->DbValue = $row['nama_sub_wilayah'];
		$this->cakupan_area->DbValue = $row['cakupan_area'];
		$this->wilayah_id->DbValue = $row['wilayah_id'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("sub_id")) <> "")
			$this->sub_id->CurrentValue = $this->getKey("sub_id"); // sub_id
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
		// sub_id
		// nama_sub_wilayah
		// cakupan_area
		// wilayah_id

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// sub_id
		$this->sub_id->ViewValue = $this->sub_id->CurrentValue;
		$this->sub_id->ViewCustomAttributes = "";

		// nama_sub_wilayah
		$this->nama_sub_wilayah->ViewValue = $this->nama_sub_wilayah->CurrentValue;
		$this->nama_sub_wilayah->ViewCustomAttributes = "";

		// cakupan_area
		$this->cakupan_area->ViewValue = $this->cakupan_area->CurrentValue;
		$this->cakupan_area->ViewCustomAttributes = "";

		// wilayah_id
		$this->wilayah_id->ViewValue = $this->wilayah_id->CurrentValue;
		$this->wilayah_id->ViewCustomAttributes = "";

			// sub_id
			$this->sub_id->LinkCustomAttributes = "";
			$this->sub_id->HrefValue = "";
			$this->sub_id->TooltipValue = "";

			// nama_sub_wilayah
			$this->nama_sub_wilayah->LinkCustomAttributes = "";
			$this->nama_sub_wilayah->HrefValue = "";
			$this->nama_sub_wilayah->TooltipValue = "";

			// cakupan_area
			$this->cakupan_area->LinkCustomAttributes = "";
			$this->cakupan_area->HrefValue = "";
			$this->cakupan_area->TooltipValue = "";

			// wilayah_id
			$this->wilayah_id->LinkCustomAttributes = "";
			$this->wilayah_id->HrefValue = "";
			$this->wilayah_id->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// sub_id
			$this->sub_id->EditAttrs["class"] = "form-control";
			$this->sub_id->EditCustomAttributes = "";
			$this->sub_id->EditValue = $this->sub_id->CurrentValue;
			$this->sub_id->ViewCustomAttributes = "";

			// nama_sub_wilayah
			$this->nama_sub_wilayah->EditAttrs["class"] = "form-control";
			$this->nama_sub_wilayah->EditCustomAttributes = "";
			$this->nama_sub_wilayah->EditValue = ew_HtmlEncode($this->nama_sub_wilayah->CurrentValue);
			$this->nama_sub_wilayah->PlaceHolder = ew_RemoveHtml($this->nama_sub_wilayah->FldCaption());

			// cakupan_area
			$this->cakupan_area->EditAttrs["class"] = "form-control";
			$this->cakupan_area->EditCustomAttributes = "";
			$this->cakupan_area->EditValue = ew_HtmlEncode($this->cakupan_area->CurrentValue);
			$this->cakupan_area->PlaceHolder = ew_RemoveHtml($this->cakupan_area->FldCaption());

			// wilayah_id
			$this->wilayah_id->EditAttrs["class"] = "form-control";
			$this->wilayah_id->EditCustomAttributes = "";
			$this->wilayah_id->EditValue = ew_HtmlEncode($this->wilayah_id->CurrentValue);
			$this->wilayah_id->PlaceHolder = ew_RemoveHtml($this->wilayah_id->FldCaption());

			// Edit refer script
			// sub_id

			$this->sub_id->LinkCustomAttributes = "";
			$this->sub_id->HrefValue = "";

			// nama_sub_wilayah
			$this->nama_sub_wilayah->LinkCustomAttributes = "";
			$this->nama_sub_wilayah->HrefValue = "";

			// cakupan_area
			$this->cakupan_area->LinkCustomAttributes = "";
			$this->cakupan_area->HrefValue = "";

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

			// nama_sub_wilayah
			$this->nama_sub_wilayah->SetDbValueDef($rsnew, $this->nama_sub_wilayah->CurrentValue, NULL, $this->nama_sub_wilayah->ReadOnly);

			// cakupan_area
			$this->cakupan_area->SetDbValueDef($rsnew, $this->cakupan_area->CurrentValue, NULL, $this->cakupan_area->ReadOnly);

			// wilayah_id
			$this->wilayah_id->SetDbValueDef($rsnew, $this->wilayah_id->CurrentValue, NULL, $this->wilayah_id->ReadOnly);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_subwilayahlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($tbl_subwilayah_edit)) $tbl_subwilayah_edit = new ctbl_subwilayah_edit();

// Page init
$tbl_subwilayah_edit->Page_Init();

// Page main
$tbl_subwilayah_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_subwilayah_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ftbl_subwilayahedit = new ew_Form("ftbl_subwilayahedit", "edit");

// Validate form
ftbl_subwilayahedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_wilayah_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_subwilayah->wilayah_id->FldErrMsg()) ?>");

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
ftbl_subwilayahedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_subwilayahedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_subwilayah_edit->ShowPageHeader(); ?>
<?php
$tbl_subwilayah_edit->ShowMessage();
?>
<form name="ftbl_subwilayahedit" id="ftbl_subwilayahedit" class="<?php echo $tbl_subwilayah_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_subwilayah_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_subwilayah_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_subwilayah">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($tbl_subwilayah_edit->IsModal) ?>">
<?php if (!$tbl_subwilayah_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tbl_subwilayah_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_tbl_subwilayahedit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($tbl_subwilayah->sub_id->Visible) { // sub_id ?>
<?php if ($tbl_subwilayah_edit->IsMobileOrModal) { ?>
	<div id="r_sub_id" class="form-group">
		<label id="elh_tbl_subwilayah_sub_id" class="<?php echo $tbl_subwilayah_edit->LeftColumnClass ?>"><?php echo $tbl_subwilayah->sub_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_subwilayah_edit->RightColumnClass ?>"><div<?php echo $tbl_subwilayah->sub_id->CellAttributes() ?>>
<span id="el_tbl_subwilayah_sub_id">
<span<?php echo $tbl_subwilayah->sub_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tbl_subwilayah->sub_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="tbl_subwilayah" data-field="x_sub_id" name="x_sub_id" id="x_sub_id" value="<?php echo ew_HtmlEncode($tbl_subwilayah->sub_id->CurrentValue) ?>">
<?php echo $tbl_subwilayah->sub_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sub_id">
		<td class="col-sm-2"><span id="elh_tbl_subwilayah_sub_id"><?php echo $tbl_subwilayah->sub_id->FldCaption() ?></span></td>
		<td<?php echo $tbl_subwilayah->sub_id->CellAttributes() ?>>
<span id="el_tbl_subwilayah_sub_id">
<span<?php echo $tbl_subwilayah->sub_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tbl_subwilayah->sub_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="tbl_subwilayah" data-field="x_sub_id" name="x_sub_id" id="x_sub_id" value="<?php echo ew_HtmlEncode($tbl_subwilayah->sub_id->CurrentValue) ?>">
<?php echo $tbl_subwilayah->sub_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_subwilayah->nama_sub_wilayah->Visible) { // nama_sub_wilayah ?>
<?php if ($tbl_subwilayah_edit->IsMobileOrModal) { ?>
	<div id="r_nama_sub_wilayah" class="form-group">
		<label id="elh_tbl_subwilayah_nama_sub_wilayah" for="x_nama_sub_wilayah" class="<?php echo $tbl_subwilayah_edit->LeftColumnClass ?>"><?php echo $tbl_subwilayah->nama_sub_wilayah->FldCaption() ?></label>
		<div class="<?php echo $tbl_subwilayah_edit->RightColumnClass ?>"><div<?php echo $tbl_subwilayah->nama_sub_wilayah->CellAttributes() ?>>
<span id="el_tbl_subwilayah_nama_sub_wilayah">
<input type="text" data-table="tbl_subwilayah" data-field="x_nama_sub_wilayah" name="x_nama_sub_wilayah" id="x_nama_sub_wilayah" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_subwilayah->nama_sub_wilayah->getPlaceHolder()) ?>" value="<?php echo $tbl_subwilayah->nama_sub_wilayah->EditValue ?>"<?php echo $tbl_subwilayah->nama_sub_wilayah->EditAttributes() ?>>
</span>
<?php echo $tbl_subwilayah->nama_sub_wilayah->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_nama_sub_wilayah">
		<td class="col-sm-2"><span id="elh_tbl_subwilayah_nama_sub_wilayah"><?php echo $tbl_subwilayah->nama_sub_wilayah->FldCaption() ?></span></td>
		<td<?php echo $tbl_subwilayah->nama_sub_wilayah->CellAttributes() ?>>
<span id="el_tbl_subwilayah_nama_sub_wilayah">
<input type="text" data-table="tbl_subwilayah" data-field="x_nama_sub_wilayah" name="x_nama_sub_wilayah" id="x_nama_sub_wilayah" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_subwilayah->nama_sub_wilayah->getPlaceHolder()) ?>" value="<?php echo $tbl_subwilayah->nama_sub_wilayah->EditValue ?>"<?php echo $tbl_subwilayah->nama_sub_wilayah->EditAttributes() ?>>
</span>
<?php echo $tbl_subwilayah->nama_sub_wilayah->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_subwilayah->cakupan_area->Visible) { // cakupan_area ?>
<?php if ($tbl_subwilayah_edit->IsMobileOrModal) { ?>
	<div id="r_cakupan_area" class="form-group">
		<label id="elh_tbl_subwilayah_cakupan_area" for="x_cakupan_area" class="<?php echo $tbl_subwilayah_edit->LeftColumnClass ?>"><?php echo $tbl_subwilayah->cakupan_area->FldCaption() ?></label>
		<div class="<?php echo $tbl_subwilayah_edit->RightColumnClass ?>"><div<?php echo $tbl_subwilayah->cakupan_area->CellAttributes() ?>>
<span id="el_tbl_subwilayah_cakupan_area">
<input type="text" data-table="tbl_subwilayah" data-field="x_cakupan_area" name="x_cakupan_area" id="x_cakupan_area" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_subwilayah->cakupan_area->getPlaceHolder()) ?>" value="<?php echo $tbl_subwilayah->cakupan_area->EditValue ?>"<?php echo $tbl_subwilayah->cakupan_area->EditAttributes() ?>>
</span>
<?php echo $tbl_subwilayah->cakupan_area->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cakupan_area">
		<td class="col-sm-2"><span id="elh_tbl_subwilayah_cakupan_area"><?php echo $tbl_subwilayah->cakupan_area->FldCaption() ?></span></td>
		<td<?php echo $tbl_subwilayah->cakupan_area->CellAttributes() ?>>
<span id="el_tbl_subwilayah_cakupan_area">
<input type="text" data-table="tbl_subwilayah" data-field="x_cakupan_area" name="x_cakupan_area" id="x_cakupan_area" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_subwilayah->cakupan_area->getPlaceHolder()) ?>" value="<?php echo $tbl_subwilayah->cakupan_area->EditValue ?>"<?php echo $tbl_subwilayah->cakupan_area->EditAttributes() ?>>
</span>
<?php echo $tbl_subwilayah->cakupan_area->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_subwilayah->wilayah_id->Visible) { // wilayah_id ?>
<?php if ($tbl_subwilayah_edit->IsMobileOrModal) { ?>
	<div id="r_wilayah_id" class="form-group">
		<label id="elh_tbl_subwilayah_wilayah_id" for="x_wilayah_id" class="<?php echo $tbl_subwilayah_edit->LeftColumnClass ?>"><?php echo $tbl_subwilayah->wilayah_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_subwilayah_edit->RightColumnClass ?>"><div<?php echo $tbl_subwilayah->wilayah_id->CellAttributes() ?>>
<span id="el_tbl_subwilayah_wilayah_id">
<input type="text" data-table="tbl_subwilayah" data-field="x_wilayah_id" name="x_wilayah_id" id="x_wilayah_id" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_subwilayah->wilayah_id->getPlaceHolder()) ?>" value="<?php echo $tbl_subwilayah->wilayah_id->EditValue ?>"<?php echo $tbl_subwilayah->wilayah_id->EditAttributes() ?>>
</span>
<?php echo $tbl_subwilayah->wilayah_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_wilayah_id">
		<td class="col-sm-2"><span id="elh_tbl_subwilayah_wilayah_id"><?php echo $tbl_subwilayah->wilayah_id->FldCaption() ?></span></td>
		<td<?php echo $tbl_subwilayah->wilayah_id->CellAttributes() ?>>
<span id="el_tbl_subwilayah_wilayah_id">
<input type="text" data-table="tbl_subwilayah" data-field="x_wilayah_id" name="x_wilayah_id" id="x_wilayah_id" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_subwilayah->wilayah_id->getPlaceHolder()) ?>" value="<?php echo $tbl_subwilayah->wilayah_id->EditValue ?>"<?php echo $tbl_subwilayah->wilayah_id->EditAttributes() ?>>
</span>
<?php echo $tbl_subwilayah->wilayah_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_subwilayah_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$tbl_subwilayah_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_subwilayah_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_subwilayah_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tbl_subwilayah_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ftbl_subwilayahedit.Init();
</script>
<?php
$tbl_subwilayah_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_subwilayah_edit->Page_Terminate();
?>
