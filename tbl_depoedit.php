<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_depoinfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_depo_edit = NULL; // Initialize page object first

class ctbl_depo_edit extends ctbl_depo {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tbl_depo';

	// Page object name
	var $PageObjName = 'tbl_depo_edit';

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

		// Table object (tbl_depo)
		if (!isset($GLOBALS["tbl_depo"]) || get_class($GLOBALS["tbl_depo"]) == "ctbl_depo") {
			$GLOBALS["tbl_depo"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_depo"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_depo', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tbl_depolist.php"));
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
		$this->kode_depo->SetVisibility();
		$this->nama_depo->SetVisibility();
		$this->alamat1->SetVisibility();
		$this->alamat2->SetVisibility();
		$this->alamat3->SetVisibility();
		$this->telp->SetVisibility();
		$this->fax->SetVisibility();
		$this->penanggung_jawab->SetVisibility();
		$this->trx_kode->SetVisibility();

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
		global $EW_EXPORT, $tbl_depo;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_depo);
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
					if ($pageName == "tbl_depoview.php")
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
			if ($objForm->HasValue("x_kode_depo")) {
				$this->kode_depo->setFormValue($objForm->GetValue("x_kode_depo"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["kode_depo"])) {
				$this->kode_depo->setQueryStringValue($_GET["kode_depo"]);
				$loadByQuery = TRUE;
			} else {
				$this->kode_depo->CurrentValue = NULL;
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
					$this->Page_Terminate("tbl_depolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "tbl_depolist.php")
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
		if (!$this->kode_depo->FldIsDetailKey) {
			$this->kode_depo->setFormValue($objForm->GetValue("x_kode_depo"));
		}
		if (!$this->nama_depo->FldIsDetailKey) {
			$this->nama_depo->setFormValue($objForm->GetValue("x_nama_depo"));
		}
		if (!$this->alamat1->FldIsDetailKey) {
			$this->alamat1->setFormValue($objForm->GetValue("x_alamat1"));
		}
		if (!$this->alamat2->FldIsDetailKey) {
			$this->alamat2->setFormValue($objForm->GetValue("x_alamat2"));
		}
		if (!$this->alamat3->FldIsDetailKey) {
			$this->alamat3->setFormValue($objForm->GetValue("x_alamat3"));
		}
		if (!$this->telp->FldIsDetailKey) {
			$this->telp->setFormValue($objForm->GetValue("x_telp"));
		}
		if (!$this->fax->FldIsDetailKey) {
			$this->fax->setFormValue($objForm->GetValue("x_fax"));
		}
		if (!$this->penanggung_jawab->FldIsDetailKey) {
			$this->penanggung_jawab->setFormValue($objForm->GetValue("x_penanggung_jawab"));
		}
		if (!$this->trx_kode->FldIsDetailKey) {
			$this->trx_kode->setFormValue($objForm->GetValue("x_trx_kode"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->kode_depo->CurrentValue = $this->kode_depo->FormValue;
		$this->nama_depo->CurrentValue = $this->nama_depo->FormValue;
		$this->alamat1->CurrentValue = $this->alamat1->FormValue;
		$this->alamat2->CurrentValue = $this->alamat2->FormValue;
		$this->alamat3->CurrentValue = $this->alamat3->FormValue;
		$this->telp->CurrentValue = $this->telp->FormValue;
		$this->fax->CurrentValue = $this->fax->FormValue;
		$this->penanggung_jawab->CurrentValue = $this->penanggung_jawab->FormValue;
		$this->trx_kode->CurrentValue = $this->trx_kode->FormValue;
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
		$this->kode_depo->setDbValue($row['kode_depo']);
		$this->nama_depo->setDbValue($row['nama_depo']);
		$this->alamat1->setDbValue($row['alamat1']);
		$this->alamat2->setDbValue($row['alamat2']);
		$this->alamat3->setDbValue($row['alamat3']);
		$this->telp->setDbValue($row['telp']);
		$this->fax->setDbValue($row['fax']);
		$this->penanggung_jawab->setDbValue($row['penanggung_jawab']);
		$this->trx_kode->setDbValue($row['trx_kode']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['kode_depo'] = NULL;
		$row['nama_depo'] = NULL;
		$row['alamat1'] = NULL;
		$row['alamat2'] = NULL;
		$row['alamat3'] = NULL;
		$row['telp'] = NULL;
		$row['fax'] = NULL;
		$row['penanggung_jawab'] = NULL;
		$row['trx_kode'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->kode_depo->DbValue = $row['kode_depo'];
		$this->nama_depo->DbValue = $row['nama_depo'];
		$this->alamat1->DbValue = $row['alamat1'];
		$this->alamat2->DbValue = $row['alamat2'];
		$this->alamat3->DbValue = $row['alamat3'];
		$this->telp->DbValue = $row['telp'];
		$this->fax->DbValue = $row['fax'];
		$this->penanggung_jawab->DbValue = $row['penanggung_jawab'];
		$this->trx_kode->DbValue = $row['trx_kode'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("kode_depo")) <> "")
			$this->kode_depo->CurrentValue = $this->getKey("kode_depo"); // kode_depo
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
		// kode_depo
		// nama_depo
		// alamat1
		// alamat2
		// alamat3
		// telp
		// fax
		// penanggung_jawab
		// trx_kode

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// nama_depo
		$this->nama_depo->ViewValue = $this->nama_depo->CurrentValue;
		$this->nama_depo->ViewCustomAttributes = "";

		// alamat1
		$this->alamat1->ViewValue = $this->alamat1->CurrentValue;
		$this->alamat1->ViewCustomAttributes = "";

		// alamat2
		$this->alamat2->ViewValue = $this->alamat2->CurrentValue;
		$this->alamat2->ViewCustomAttributes = "";

		// alamat3
		$this->alamat3->ViewValue = $this->alamat3->CurrentValue;
		$this->alamat3->ViewCustomAttributes = "";

		// telp
		$this->telp->ViewValue = $this->telp->CurrentValue;
		$this->telp->ViewCustomAttributes = "";

		// fax
		$this->fax->ViewValue = $this->fax->CurrentValue;
		$this->fax->ViewCustomAttributes = "";

		// penanggung_jawab
		$this->penanggung_jawab->ViewValue = $this->penanggung_jawab->CurrentValue;
		$this->penanggung_jawab->ViewCustomAttributes = "";

		// trx_kode
		$this->trx_kode->ViewValue = $this->trx_kode->CurrentValue;
		$this->trx_kode->ViewCustomAttributes = "";

			// kode_depo
			$this->kode_depo->LinkCustomAttributes = "";
			$this->kode_depo->HrefValue = "";
			$this->kode_depo->TooltipValue = "";

			// nama_depo
			$this->nama_depo->LinkCustomAttributes = "";
			$this->nama_depo->HrefValue = "";
			$this->nama_depo->TooltipValue = "";

			// alamat1
			$this->alamat1->LinkCustomAttributes = "";
			$this->alamat1->HrefValue = "";
			$this->alamat1->TooltipValue = "";

			// alamat2
			$this->alamat2->LinkCustomAttributes = "";
			$this->alamat2->HrefValue = "";
			$this->alamat2->TooltipValue = "";

			// alamat3
			$this->alamat3->LinkCustomAttributes = "";
			$this->alamat3->HrefValue = "";
			$this->alamat3->TooltipValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";
			$this->telp->TooltipValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";
			$this->fax->TooltipValue = "";

			// penanggung_jawab
			$this->penanggung_jawab->LinkCustomAttributes = "";
			$this->penanggung_jawab->HrefValue = "";
			$this->penanggung_jawab->TooltipValue = "";

			// trx_kode
			$this->trx_kode->LinkCustomAttributes = "";
			$this->trx_kode->HrefValue = "";
			$this->trx_kode->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode_depo
			$this->kode_depo->EditAttrs["class"] = "form-control";
			$this->kode_depo->EditCustomAttributes = "";
			$this->kode_depo->EditValue = $this->kode_depo->CurrentValue;
			$this->kode_depo->ViewCustomAttributes = "";

			// nama_depo
			$this->nama_depo->EditAttrs["class"] = "form-control";
			$this->nama_depo->EditCustomAttributes = "";
			$this->nama_depo->EditValue = ew_HtmlEncode($this->nama_depo->CurrentValue);
			$this->nama_depo->PlaceHolder = ew_RemoveHtml($this->nama_depo->FldCaption());

			// alamat1
			$this->alamat1->EditAttrs["class"] = "form-control";
			$this->alamat1->EditCustomAttributes = "";
			$this->alamat1->EditValue = ew_HtmlEncode($this->alamat1->CurrentValue);
			$this->alamat1->PlaceHolder = ew_RemoveHtml($this->alamat1->FldCaption());

			// alamat2
			$this->alamat2->EditAttrs["class"] = "form-control";
			$this->alamat2->EditCustomAttributes = "";
			$this->alamat2->EditValue = ew_HtmlEncode($this->alamat2->CurrentValue);
			$this->alamat2->PlaceHolder = ew_RemoveHtml($this->alamat2->FldCaption());

			// alamat3
			$this->alamat3->EditAttrs["class"] = "form-control";
			$this->alamat3->EditCustomAttributes = "";
			$this->alamat3->EditValue = ew_HtmlEncode($this->alamat3->CurrentValue);
			$this->alamat3->PlaceHolder = ew_RemoveHtml($this->alamat3->FldCaption());

			// telp
			$this->telp->EditAttrs["class"] = "form-control";
			$this->telp->EditCustomAttributes = "";
			$this->telp->EditValue = ew_HtmlEncode($this->telp->CurrentValue);
			$this->telp->PlaceHolder = ew_RemoveHtml($this->telp->FldCaption());

			// fax
			$this->fax->EditAttrs["class"] = "form-control";
			$this->fax->EditCustomAttributes = "";
			$this->fax->EditValue = ew_HtmlEncode($this->fax->CurrentValue);
			$this->fax->PlaceHolder = ew_RemoveHtml($this->fax->FldCaption());

			// penanggung_jawab
			$this->penanggung_jawab->EditAttrs["class"] = "form-control";
			$this->penanggung_jawab->EditCustomAttributes = "";
			$this->penanggung_jawab->EditValue = ew_HtmlEncode($this->penanggung_jawab->CurrentValue);
			$this->penanggung_jawab->PlaceHolder = ew_RemoveHtml($this->penanggung_jawab->FldCaption());

			// trx_kode
			$this->trx_kode->EditAttrs["class"] = "form-control";
			$this->trx_kode->EditCustomAttributes = "";
			$this->trx_kode->EditValue = ew_HtmlEncode($this->trx_kode->CurrentValue);
			$this->trx_kode->PlaceHolder = ew_RemoveHtml($this->trx_kode->FldCaption());

			// Edit refer script
			// kode_depo

			$this->kode_depo->LinkCustomAttributes = "";
			$this->kode_depo->HrefValue = "";

			// nama_depo
			$this->nama_depo->LinkCustomAttributes = "";
			$this->nama_depo->HrefValue = "";

			// alamat1
			$this->alamat1->LinkCustomAttributes = "";
			$this->alamat1->HrefValue = "";

			// alamat2
			$this->alamat2->LinkCustomAttributes = "";
			$this->alamat2->HrefValue = "";

			// alamat3
			$this->alamat3->LinkCustomAttributes = "";
			$this->alamat3->HrefValue = "";

			// telp
			$this->telp->LinkCustomAttributes = "";
			$this->telp->HrefValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";

			// penanggung_jawab
			$this->penanggung_jawab->LinkCustomAttributes = "";
			$this->penanggung_jawab->HrefValue = "";

			// trx_kode
			$this->trx_kode->LinkCustomAttributes = "";
			$this->trx_kode->HrefValue = "";
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
		if (!$this->kode_depo->FldIsDetailKey && !is_null($this->kode_depo->FormValue) && $this->kode_depo->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->kode_depo->FldCaption(), $this->kode_depo->ReqErrMsg));
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

			// kode_depo
			// nama_depo

			$this->nama_depo->SetDbValueDef($rsnew, $this->nama_depo->CurrentValue, NULL, $this->nama_depo->ReadOnly);

			// alamat1
			$this->alamat1->SetDbValueDef($rsnew, $this->alamat1->CurrentValue, NULL, $this->alamat1->ReadOnly);

			// alamat2
			$this->alamat2->SetDbValueDef($rsnew, $this->alamat2->CurrentValue, NULL, $this->alamat2->ReadOnly);

			// alamat3
			$this->alamat3->SetDbValueDef($rsnew, $this->alamat3->CurrentValue, NULL, $this->alamat3->ReadOnly);

			// telp
			$this->telp->SetDbValueDef($rsnew, $this->telp->CurrentValue, NULL, $this->telp->ReadOnly);

			// fax
			$this->fax->SetDbValueDef($rsnew, $this->fax->CurrentValue, NULL, $this->fax->ReadOnly);

			// penanggung_jawab
			$this->penanggung_jawab->SetDbValueDef($rsnew, $this->penanggung_jawab->CurrentValue, NULL, $this->penanggung_jawab->ReadOnly);

			// trx_kode
			$this->trx_kode->SetDbValueDef($rsnew, $this->trx_kode->CurrentValue, NULL, $this->trx_kode->ReadOnly);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_depolist.php"), "", $this->TableVar, TRUE);
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
if (!isset($tbl_depo_edit)) $tbl_depo_edit = new ctbl_depo_edit();

// Page init
$tbl_depo_edit->Page_Init();

// Page main
$tbl_depo_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_depo_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ftbl_depoedit = new ew_Form("ftbl_depoedit", "edit");

// Validate form
ftbl_depoedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_kode_depo");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $tbl_depo->kode_depo->FldCaption(), $tbl_depo->kode_depo->ReqErrMsg)) ?>");

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
ftbl_depoedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_depoedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_depo_edit->ShowPageHeader(); ?>
<?php
$tbl_depo_edit->ShowMessage();
?>
<form name="ftbl_depoedit" id="ftbl_depoedit" class="<?php echo $tbl_depo_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_depo_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_depo_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_depo">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($tbl_depo_edit->IsModal) ?>">
<?php if (!$tbl_depo_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tbl_depo_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_tbl_depoedit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($tbl_depo->kode_depo->Visible) { // kode_depo ?>
<?php if ($tbl_depo_edit->IsMobileOrModal) { ?>
	<div id="r_kode_depo" class="form-group">
		<label id="elh_tbl_depo_kode_depo" for="x_kode_depo" class="<?php echo $tbl_depo_edit->LeftColumnClass ?>"><?php echo $tbl_depo->kode_depo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $tbl_depo_edit->RightColumnClass ?>"><div<?php echo $tbl_depo->kode_depo->CellAttributes() ?>>
<span id="el_tbl_depo_kode_depo">
<span<?php echo $tbl_depo->kode_depo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tbl_depo->kode_depo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="tbl_depo" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" value="<?php echo ew_HtmlEncode($tbl_depo->kode_depo->CurrentValue) ?>">
<?php echo $tbl_depo->kode_depo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_kode_depo">
		<td class="col-sm-2"><span id="elh_tbl_depo_kode_depo"><?php echo $tbl_depo->kode_depo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $tbl_depo->kode_depo->CellAttributes() ?>>
<span id="el_tbl_depo_kode_depo">
<span<?php echo $tbl_depo->kode_depo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tbl_depo->kode_depo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="tbl_depo" data-field="x_kode_depo" name="x_kode_depo" id="x_kode_depo" value="<?php echo ew_HtmlEncode($tbl_depo->kode_depo->CurrentValue) ?>">
<?php echo $tbl_depo->kode_depo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_depo->nama_depo->Visible) { // nama_depo ?>
<?php if ($tbl_depo_edit->IsMobileOrModal) { ?>
	<div id="r_nama_depo" class="form-group">
		<label id="elh_tbl_depo_nama_depo" for="x_nama_depo" class="<?php echo $tbl_depo_edit->LeftColumnClass ?>"><?php echo $tbl_depo->nama_depo->FldCaption() ?></label>
		<div class="<?php echo $tbl_depo_edit->RightColumnClass ?>"><div<?php echo $tbl_depo->nama_depo->CellAttributes() ?>>
<span id="el_tbl_depo_nama_depo">
<input type="text" data-table="tbl_depo" data-field="x_nama_depo" name="x_nama_depo" id="x_nama_depo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_depo->nama_depo->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->nama_depo->EditValue ?>"<?php echo $tbl_depo->nama_depo->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->nama_depo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_nama_depo">
		<td class="col-sm-2"><span id="elh_tbl_depo_nama_depo"><?php echo $tbl_depo->nama_depo->FldCaption() ?></span></td>
		<td<?php echo $tbl_depo->nama_depo->CellAttributes() ?>>
<span id="el_tbl_depo_nama_depo">
<input type="text" data-table="tbl_depo" data-field="x_nama_depo" name="x_nama_depo" id="x_nama_depo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_depo->nama_depo->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->nama_depo->EditValue ?>"<?php echo $tbl_depo->nama_depo->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->nama_depo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_depo->alamat1->Visible) { // alamat1 ?>
<?php if ($tbl_depo_edit->IsMobileOrModal) { ?>
	<div id="r_alamat1" class="form-group">
		<label id="elh_tbl_depo_alamat1" for="x_alamat1" class="<?php echo $tbl_depo_edit->LeftColumnClass ?>"><?php echo $tbl_depo->alamat1->FldCaption() ?></label>
		<div class="<?php echo $tbl_depo_edit->RightColumnClass ?>"><div<?php echo $tbl_depo->alamat1->CellAttributes() ?>>
<span id="el_tbl_depo_alamat1">
<input type="text" data-table="tbl_depo" data-field="x_alamat1" name="x_alamat1" id="x_alamat1" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_depo->alamat1->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->alamat1->EditValue ?>"<?php echo $tbl_depo->alamat1->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->alamat1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_alamat1">
		<td class="col-sm-2"><span id="elh_tbl_depo_alamat1"><?php echo $tbl_depo->alamat1->FldCaption() ?></span></td>
		<td<?php echo $tbl_depo->alamat1->CellAttributes() ?>>
<span id="el_tbl_depo_alamat1">
<input type="text" data-table="tbl_depo" data-field="x_alamat1" name="x_alamat1" id="x_alamat1" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_depo->alamat1->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->alamat1->EditValue ?>"<?php echo $tbl_depo->alamat1->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->alamat1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_depo->alamat2->Visible) { // alamat2 ?>
<?php if ($tbl_depo_edit->IsMobileOrModal) { ?>
	<div id="r_alamat2" class="form-group">
		<label id="elh_tbl_depo_alamat2" for="x_alamat2" class="<?php echo $tbl_depo_edit->LeftColumnClass ?>"><?php echo $tbl_depo->alamat2->FldCaption() ?></label>
		<div class="<?php echo $tbl_depo_edit->RightColumnClass ?>"><div<?php echo $tbl_depo->alamat2->CellAttributes() ?>>
<span id="el_tbl_depo_alamat2">
<input type="text" data-table="tbl_depo" data-field="x_alamat2" name="x_alamat2" id="x_alamat2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_depo->alamat2->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->alamat2->EditValue ?>"<?php echo $tbl_depo->alamat2->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->alamat2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_alamat2">
		<td class="col-sm-2"><span id="elh_tbl_depo_alamat2"><?php echo $tbl_depo->alamat2->FldCaption() ?></span></td>
		<td<?php echo $tbl_depo->alamat2->CellAttributes() ?>>
<span id="el_tbl_depo_alamat2">
<input type="text" data-table="tbl_depo" data-field="x_alamat2" name="x_alamat2" id="x_alamat2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($tbl_depo->alamat2->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->alamat2->EditValue ?>"<?php echo $tbl_depo->alamat2->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->alamat2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_depo->alamat3->Visible) { // alamat3 ?>
<?php if ($tbl_depo_edit->IsMobileOrModal) { ?>
	<div id="r_alamat3" class="form-group">
		<label id="elh_tbl_depo_alamat3" for="x_alamat3" class="<?php echo $tbl_depo_edit->LeftColumnClass ?>"><?php echo $tbl_depo->alamat3->FldCaption() ?></label>
		<div class="<?php echo $tbl_depo_edit->RightColumnClass ?>"><div<?php echo $tbl_depo->alamat3->CellAttributes() ?>>
<span id="el_tbl_depo_alamat3">
<input type="text" data-table="tbl_depo" data-field="x_alamat3" name="x_alamat3" id="x_alamat3" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_depo->alamat3->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->alamat3->EditValue ?>"<?php echo $tbl_depo->alamat3->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->alamat3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_alamat3">
		<td class="col-sm-2"><span id="elh_tbl_depo_alamat3"><?php echo $tbl_depo->alamat3->FldCaption() ?></span></td>
		<td<?php echo $tbl_depo->alamat3->CellAttributes() ?>>
<span id="el_tbl_depo_alamat3">
<input type="text" data-table="tbl_depo" data-field="x_alamat3" name="x_alamat3" id="x_alamat3" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_depo->alamat3->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->alamat3->EditValue ?>"<?php echo $tbl_depo->alamat3->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->alamat3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_depo->telp->Visible) { // telp ?>
<?php if ($tbl_depo_edit->IsMobileOrModal) { ?>
	<div id="r_telp" class="form-group">
		<label id="elh_tbl_depo_telp" for="x_telp" class="<?php echo $tbl_depo_edit->LeftColumnClass ?>"><?php echo $tbl_depo->telp->FldCaption() ?></label>
		<div class="<?php echo $tbl_depo_edit->RightColumnClass ?>"><div<?php echo $tbl_depo->telp->CellAttributes() ?>>
<span id="el_tbl_depo_telp">
<input type="text" data-table="tbl_depo" data-field="x_telp" name="x_telp" id="x_telp" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_depo->telp->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->telp->EditValue ?>"<?php echo $tbl_depo->telp->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->telp->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_telp">
		<td class="col-sm-2"><span id="elh_tbl_depo_telp"><?php echo $tbl_depo->telp->FldCaption() ?></span></td>
		<td<?php echo $tbl_depo->telp->CellAttributes() ?>>
<span id="el_tbl_depo_telp">
<input type="text" data-table="tbl_depo" data-field="x_telp" name="x_telp" id="x_telp" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_depo->telp->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->telp->EditValue ?>"<?php echo $tbl_depo->telp->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->telp->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_depo->fax->Visible) { // fax ?>
<?php if ($tbl_depo_edit->IsMobileOrModal) { ?>
	<div id="r_fax" class="form-group">
		<label id="elh_tbl_depo_fax" for="x_fax" class="<?php echo $tbl_depo_edit->LeftColumnClass ?>"><?php echo $tbl_depo->fax->FldCaption() ?></label>
		<div class="<?php echo $tbl_depo_edit->RightColumnClass ?>"><div<?php echo $tbl_depo->fax->CellAttributes() ?>>
<span id="el_tbl_depo_fax">
<input type="text" data-table="tbl_depo" data-field="x_fax" name="x_fax" id="x_fax" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_depo->fax->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->fax->EditValue ?>"<?php echo $tbl_depo->fax->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->fax->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_fax">
		<td class="col-sm-2"><span id="elh_tbl_depo_fax"><?php echo $tbl_depo->fax->FldCaption() ?></span></td>
		<td<?php echo $tbl_depo->fax->CellAttributes() ?>>
<span id="el_tbl_depo_fax">
<input type="text" data-table="tbl_depo" data-field="x_fax" name="x_fax" id="x_fax" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($tbl_depo->fax->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->fax->EditValue ?>"<?php echo $tbl_depo->fax->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->fax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_depo->penanggung_jawab->Visible) { // penanggung_jawab ?>
<?php if ($tbl_depo_edit->IsMobileOrModal) { ?>
	<div id="r_penanggung_jawab" class="form-group">
		<label id="elh_tbl_depo_penanggung_jawab" for="x_penanggung_jawab" class="<?php echo $tbl_depo_edit->LeftColumnClass ?>"><?php echo $tbl_depo->penanggung_jawab->FldCaption() ?></label>
		<div class="<?php echo $tbl_depo_edit->RightColumnClass ?>"><div<?php echo $tbl_depo->penanggung_jawab->CellAttributes() ?>>
<span id="el_tbl_depo_penanggung_jawab">
<input type="text" data-table="tbl_depo" data-field="x_penanggung_jawab" name="x_penanggung_jawab" id="x_penanggung_jawab" size="30" maxlength="30" placeholder="<?php echo ew_HtmlEncode($tbl_depo->penanggung_jawab->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->penanggung_jawab->EditValue ?>"<?php echo $tbl_depo->penanggung_jawab->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->penanggung_jawab->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_penanggung_jawab">
		<td class="col-sm-2"><span id="elh_tbl_depo_penanggung_jawab"><?php echo $tbl_depo->penanggung_jawab->FldCaption() ?></span></td>
		<td<?php echo $tbl_depo->penanggung_jawab->CellAttributes() ?>>
<span id="el_tbl_depo_penanggung_jawab">
<input type="text" data-table="tbl_depo" data-field="x_penanggung_jawab" name="x_penanggung_jawab" id="x_penanggung_jawab" size="30" maxlength="30" placeholder="<?php echo ew_HtmlEncode($tbl_depo->penanggung_jawab->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->penanggung_jawab->EditValue ?>"<?php echo $tbl_depo->penanggung_jawab->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->penanggung_jawab->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_depo->trx_kode->Visible) { // trx_kode ?>
<?php if ($tbl_depo_edit->IsMobileOrModal) { ?>
	<div id="r_trx_kode" class="form-group">
		<label id="elh_tbl_depo_trx_kode" for="x_trx_kode" class="<?php echo $tbl_depo_edit->LeftColumnClass ?>"><?php echo $tbl_depo->trx_kode->FldCaption() ?></label>
		<div class="<?php echo $tbl_depo_edit->RightColumnClass ?>"><div<?php echo $tbl_depo->trx_kode->CellAttributes() ?>>
<span id="el_tbl_depo_trx_kode">
<input type="text" data-table="tbl_depo" data-field="x_trx_kode" name="x_trx_kode" id="x_trx_kode" size="30" maxlength="2" placeholder="<?php echo ew_HtmlEncode($tbl_depo->trx_kode->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->trx_kode->EditValue ?>"<?php echo $tbl_depo->trx_kode->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->trx_kode->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_trx_kode">
		<td class="col-sm-2"><span id="elh_tbl_depo_trx_kode"><?php echo $tbl_depo->trx_kode->FldCaption() ?></span></td>
		<td<?php echo $tbl_depo->trx_kode->CellAttributes() ?>>
<span id="el_tbl_depo_trx_kode">
<input type="text" data-table="tbl_depo" data-field="x_trx_kode" name="x_trx_kode" id="x_trx_kode" size="30" maxlength="2" placeholder="<?php echo ew_HtmlEncode($tbl_depo->trx_kode->getPlaceHolder()) ?>" value="<?php echo $tbl_depo->trx_kode->EditValue ?>"<?php echo $tbl_depo->trx_kode->EditAttributes() ?>>
</span>
<?php echo $tbl_depo->trx_kode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_depo_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$tbl_depo_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_depo_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_depo_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tbl_depo_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ftbl_depoedit.Init();
</script>
<?php
$tbl_depo_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_depo_edit->Page_Terminate();
?>
