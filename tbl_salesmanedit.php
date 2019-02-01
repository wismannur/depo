<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_salesmaninfo.php" ?>
<?php include_once "employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_salesman_edit = NULL; // Initialize page object first

class ctbl_salesman_edit extends ctbl_salesman {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tbl_salesman';

	// Page object name
	var $PageObjName = 'tbl_salesman_edit';

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

		// Table object (tbl_salesman)
		if (!isset($GLOBALS["tbl_salesman"]) || get_class($GLOBALS["tbl_salesman"]) == "ctbl_salesman") {
			$GLOBALS["tbl_salesman"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_salesman"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees'])) $GLOBALS['employees'] = new cemployees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_salesman', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tbl_salesmanlist.php"));
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
		$this->sales_name->SetVisibility();
		$this->wilayah_id->SetVisibility();
		$this->subwil_id->SetVisibility();
		$this->area_id->SetVisibility();
		$this->sales_target->SetVisibility();
		$this->sales_intensif->SetVisibility();

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
		global $EW_EXPORT, $tbl_salesman;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_salesman);
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
					if ($pageName == "tbl_salesmanview.php")
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
			if ($objForm->HasValue("x_sales_id")) {
				$this->sales_id->setFormValue($objForm->GetValue("x_sales_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["sales_id"])) {
				$this->sales_id->setQueryStringValue($_GET["sales_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->sales_id->CurrentValue = NULL;
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
					$this->Page_Terminate("tbl_salesmanlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "tbl_salesmanlist.php")
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
		if (!$this->sales_name->FldIsDetailKey) {
			$this->sales_name->setFormValue($objForm->GetValue("x_sales_name"));
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
		if (!$this->sales_target->FldIsDetailKey) {
			$this->sales_target->setFormValue($objForm->GetValue("x_sales_target"));
		}
		if (!$this->sales_intensif->FldIsDetailKey) {
			$this->sales_intensif->setFormValue($objForm->GetValue("x_sales_intensif"));
		}
		if (!$this->sales_id->FldIsDetailKey)
			$this->sales_id->setFormValue($objForm->GetValue("x_sales_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->sales_id->CurrentValue = $this->sales_id->FormValue;
		$this->sales_name->CurrentValue = $this->sales_name->FormValue;
		$this->wilayah_id->CurrentValue = $this->wilayah_id->FormValue;
		$this->subwil_id->CurrentValue = $this->subwil_id->FormValue;
		$this->area_id->CurrentValue = $this->area_id->FormValue;
		$this->sales_target->CurrentValue = $this->sales_target->FormValue;
		$this->sales_intensif->CurrentValue = $this->sales_intensif->FormValue;
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
		$this->sales_id->setDbValue($row['sales_id']);
		$this->sales_name->setDbValue($row['sales_name']);
		$this->wilayah_id->setDbValue($row['wilayah_id']);
		$this->subwil_id->setDbValue($row['subwil_id']);
		$this->area_id->setDbValue($row['area_id']);
		$this->sales_target->setDbValue($row['sales_target']);
		$this->sales_intensif->setDbValue($row['sales_intensif']);
		$this->kode_depo->setDbValue($row['kode_depo']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['sales_id'] = NULL;
		$row['sales_name'] = NULL;
		$row['wilayah_id'] = NULL;
		$row['subwil_id'] = NULL;
		$row['area_id'] = NULL;
		$row['sales_target'] = NULL;
		$row['sales_intensif'] = NULL;
		$row['kode_depo'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->sales_id->DbValue = $row['sales_id'];
		$this->sales_name->DbValue = $row['sales_name'];
		$this->wilayah_id->DbValue = $row['wilayah_id'];
		$this->subwil_id->DbValue = $row['subwil_id'];
		$this->area_id->DbValue = $row['area_id'];
		$this->sales_target->DbValue = $row['sales_target'];
		$this->sales_intensif->DbValue = $row['sales_intensif'];
		$this->kode_depo->DbValue = $row['kode_depo'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("sales_id")) <> "")
			$this->sales_id->CurrentValue = $this->getKey("sales_id"); // sales_id
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

		if ($this->sales_target->FormValue == $this->sales_target->CurrentValue && is_numeric(ew_StrToFloat($this->sales_target->CurrentValue)))
			$this->sales_target->CurrentValue = ew_StrToFloat($this->sales_target->CurrentValue);

		// Convert decimal values if posted back
		if ($this->sales_intensif->FormValue == $this->sales_intensif->CurrentValue && is_numeric(ew_StrToFloat($this->sales_intensif->CurrentValue)))
			$this->sales_intensif->CurrentValue = ew_StrToFloat($this->sales_intensif->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// sales_id
		// sales_name
		// wilayah_id
		// subwil_id
		// area_id
		// sales_target
		// sales_intensif
		// kode_depo

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// sales_id
		$this->sales_id->ViewValue = $this->sales_id->CurrentValue;
		$this->sales_id->ViewCustomAttributes = "";

		// sales_name
		$this->sales_name->ViewValue = $this->sales_name->CurrentValue;
		$this->sales_name->ViewCustomAttributes = "";

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
		$sSqlWrk .= " ORDER BY `nama_wilayah`";
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

		// sales_target
		$this->sales_target->ViewValue = $this->sales_target->CurrentValue;
		$this->sales_target->ViewValue = ew_FormatNumber($this->sales_target->ViewValue, 2, -2, -2, -2);
		$this->sales_target->CellCssStyle .= "text-align: right;";
		$this->sales_target->ViewCustomAttributes = "";

		// sales_intensif
		$this->sales_intensif->ViewValue = $this->sales_intensif->CurrentValue;
		$this->sales_intensif->ViewValue = ew_FormatNumber($this->sales_intensif->ViewValue, 2, -2, -2, -2);
		$this->sales_intensif->CellCssStyle .= "text-align: right;";
		$this->sales_intensif->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

			// sales_name
			$this->sales_name->LinkCustomAttributes = "";
			$this->sales_name->HrefValue = "";
			$this->sales_name->TooltipValue = "";

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

			// sales_target
			$this->sales_target->LinkCustomAttributes = "";
			$this->sales_target->HrefValue = "";
			$this->sales_target->TooltipValue = "";

			// sales_intensif
			$this->sales_intensif->LinkCustomAttributes = "";
			$this->sales_intensif->HrefValue = "";
			$this->sales_intensif->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// sales_name
			$this->sales_name->EditAttrs["class"] = "form-control";
			$this->sales_name->EditCustomAttributes = "";
			$this->sales_name->EditValue = ew_HtmlEncode($this->sales_name->CurrentValue);
			$this->sales_name->PlaceHolder = ew_RemoveHtml($this->sales_name->FldCaption());

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
			$sSqlWrk .= " ORDER BY `nama_wilayah`";
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

			// sales_target
			$this->sales_target->EditAttrs["class"] = "form-control";
			$this->sales_target->EditCustomAttributes = "";
			$this->sales_target->EditValue = ew_HtmlEncode($this->sales_target->CurrentValue);
			$this->sales_target->PlaceHolder = ew_RemoveHtml($this->sales_target->FldCaption());
			if (strval($this->sales_target->EditValue) <> "" && is_numeric($this->sales_target->EditValue)) $this->sales_target->EditValue = ew_FormatNumber($this->sales_target->EditValue, -2, -2, -2, -2);

			// sales_intensif
			$this->sales_intensif->EditAttrs["class"] = "form-control";
			$this->sales_intensif->EditCustomAttributes = "";
			$this->sales_intensif->EditValue = ew_HtmlEncode($this->sales_intensif->CurrentValue);
			$this->sales_intensif->PlaceHolder = ew_RemoveHtml($this->sales_intensif->FldCaption());
			if (strval($this->sales_intensif->EditValue) <> "" && is_numeric($this->sales_intensif->EditValue)) $this->sales_intensif->EditValue = ew_FormatNumber($this->sales_intensif->EditValue, -2, -2, -2, -2);

			// Edit refer script
			// sales_name

			$this->sales_name->LinkCustomAttributes = "";
			$this->sales_name->HrefValue = "";

			// wilayah_id
			$this->wilayah_id->LinkCustomAttributes = "";
			$this->wilayah_id->HrefValue = "";

			// subwil_id
			$this->subwil_id->LinkCustomAttributes = "";
			$this->subwil_id->HrefValue = "";

			// area_id
			$this->area_id->LinkCustomAttributes = "";
			$this->area_id->HrefValue = "";

			// sales_target
			$this->sales_target->LinkCustomAttributes = "";
			$this->sales_target->HrefValue = "";

			// sales_intensif
			$this->sales_intensif->LinkCustomAttributes = "";
			$this->sales_intensif->HrefValue = "";
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
		if (!ew_CheckNumber($this->sales_target->FormValue)) {
			ew_AddMessage($gsFormError, $this->sales_target->FldErrMsg());
		}
		if (!ew_CheckNumber($this->sales_intensif->FormValue)) {
			ew_AddMessage($gsFormError, $this->sales_intensif->FldErrMsg());
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

			// sales_name
			$this->sales_name->SetDbValueDef($rsnew, $this->sales_name->CurrentValue, NULL, $this->sales_name->ReadOnly);

			// wilayah_id
			$this->wilayah_id->SetDbValueDef($rsnew, $this->wilayah_id->CurrentValue, NULL, $this->wilayah_id->ReadOnly);

			// subwil_id
			$this->subwil_id->SetDbValueDef($rsnew, $this->subwil_id->CurrentValue, NULL, $this->subwil_id->ReadOnly);

			// area_id
			$this->area_id->SetDbValueDef($rsnew, $this->area_id->CurrentValue, NULL, $this->area_id->ReadOnly);

			// sales_target
			$this->sales_target->SetDbValueDef($rsnew, $this->sales_target->CurrentValue, NULL, $this->sales_target->ReadOnly);

			// sales_intensif
			$this->sales_intensif->SetDbValueDef($rsnew, $this->sales_intensif->CurrentValue, NULL, $this->sales_intensif->ReadOnly);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_salesmanlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
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
			$sSqlWrk .= " ORDER BY `nama_wilayah`";
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
if (!isset($tbl_salesman_edit)) $tbl_salesman_edit = new ctbl_salesman_edit();

// Page init
$tbl_salesman_edit->Page_Init();

// Page main
$tbl_salesman_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_salesman_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ftbl_salesmanedit = new ew_Form("ftbl_salesmanedit", "edit");

// Validate form
ftbl_salesmanedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_sales_target");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_salesman->sales_target->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_sales_intensif");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_salesman->sales_intensif->FldErrMsg()) ?>");

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
ftbl_salesmanedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_salesmanedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_salesmanedit.Lists["x_wilayah_id"] = {"LinkField":"x_wilayah_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nama_wilayah","","",""],"ParentFields":[],"ChildFields":["x_subwil_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_wilayah"};
ftbl_salesmanedit.Lists["x_wilayah_id"].Data = "<?php echo $tbl_salesman_edit->wilayah_id->LookupFilterQuery(FALSE, "edit") ?>";
ftbl_salesmanedit.Lists["x_subwil_id"] = {"LinkField":"x_sub_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nama_sub_wilayah","","",""],"ParentFields":["x_wilayah_id"],"ChildFields":["x_area_id"],"FilterFields":["x_wilayah_id"],"Options":[],"Template":"","LinkTable":"tbl_subwilayah"};
ftbl_salesmanedit.Lists["x_subwil_id"].Data = "<?php echo $tbl_salesman_edit->subwil_id->LookupFilterQuery(FALSE, "edit") ?>";
ftbl_salesmanedit.Lists["x_area_id"] = {"LinkField":"x_area_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_area_name","","",""],"ParentFields":["x_subwil_id"],"ChildFields":[],"FilterFields":["x_subwil_id"],"Options":[],"Template":"","LinkTable":"tbl_callarea"};
ftbl_salesmanedit.Lists["x_area_id"].Data = "<?php echo $tbl_salesman_edit->area_id->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_salesman_edit->ShowPageHeader(); ?>
<?php
$tbl_salesman_edit->ShowMessage();
?>
<form name="ftbl_salesmanedit" id="ftbl_salesmanedit" class="<?php echo $tbl_salesman_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_salesman_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_salesman_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_salesman">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($tbl_salesman_edit->IsModal) ?>">
<?php if (!$tbl_salesman_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($tbl_salesman_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_tbl_salesmanedit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($tbl_salesman->sales_name->Visible) { // sales_name ?>
<?php if ($tbl_salesman_edit->IsMobileOrModal) { ?>
	<div id="r_sales_name" class="form-group">
		<label id="elh_tbl_salesman_sales_name" for="x_sales_name" class="<?php echo $tbl_salesman_edit->LeftColumnClass ?>"><?php echo $tbl_salesman->sales_name->FldCaption() ?></label>
		<div class="<?php echo $tbl_salesman_edit->RightColumnClass ?>"><div<?php echo $tbl_salesman->sales_name->CellAttributes() ?>>
<span id="el_tbl_salesman_sales_name">
<input type="text" data-table="tbl_salesman" data-field="x_sales_name" name="x_sales_name" id="x_sales_name" size="50" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_salesman->sales_name->getPlaceHolder()) ?>" value="<?php echo $tbl_salesman->sales_name->EditValue ?>"<?php echo $tbl_salesman->sales_name->EditAttributes() ?>>
</span>
<?php echo $tbl_salesman->sales_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sales_name">
		<td class="col-sm-2"><span id="elh_tbl_salesman_sales_name"><?php echo $tbl_salesman->sales_name->FldCaption() ?></span></td>
		<td<?php echo $tbl_salesman->sales_name->CellAttributes() ?>>
<span id="el_tbl_salesman_sales_name">
<input type="text" data-table="tbl_salesman" data-field="x_sales_name" name="x_sales_name" id="x_sales_name" size="50" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_salesman->sales_name->getPlaceHolder()) ?>" value="<?php echo $tbl_salesman->sales_name->EditValue ?>"<?php echo $tbl_salesman->sales_name->EditAttributes() ?>>
</span>
<?php echo $tbl_salesman->sales_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_salesman->wilayah_id->Visible) { // wilayah_id ?>
<?php if ($tbl_salesman_edit->IsMobileOrModal) { ?>
	<div id="r_wilayah_id" class="form-group">
		<label id="elh_tbl_salesman_wilayah_id" for="x_wilayah_id" class="<?php echo $tbl_salesman_edit->LeftColumnClass ?>"><?php echo $tbl_salesman->wilayah_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_salesman_edit->RightColumnClass ?>"><div<?php echo $tbl_salesman->wilayah_id->CellAttributes() ?>>
<span id="el_tbl_salesman_wilayah_id">
<?php $tbl_salesman->wilayah_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tbl_salesman->wilayah_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_salesman->wilayah_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_salesman->wilayah_id->ViewValue ?>
	</span>
	<?php if (!$tbl_salesman->wilayah_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_wilayah_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_salesman->wilayah_id->RadioButtonListHtml(TRUE, "x_wilayah_id") ?>
		</div>
	</div>
	<div id="tp_x_wilayah_id" class="ewTemplate"><input type="radio" data-table="tbl_salesman" data-field="x_wilayah_id" data-value-separator="<?php echo $tbl_salesman->wilayah_id->DisplayValueSeparatorAttribute() ?>" name="x_wilayah_id" id="x_wilayah_id" value="{value}"<?php echo $tbl_salesman->wilayah_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_salesman->wilayah_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_wilayah_id">
		<td class="col-sm-2"><span id="elh_tbl_salesman_wilayah_id"><?php echo $tbl_salesman->wilayah_id->FldCaption() ?></span></td>
		<td<?php echo $tbl_salesman->wilayah_id->CellAttributes() ?>>
<span id="el_tbl_salesman_wilayah_id">
<?php $tbl_salesman->wilayah_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tbl_salesman->wilayah_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_salesman->wilayah_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_salesman->wilayah_id->ViewValue ?>
	</span>
	<?php if (!$tbl_salesman->wilayah_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_wilayah_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_salesman->wilayah_id->RadioButtonListHtml(TRUE, "x_wilayah_id") ?>
		</div>
	</div>
	<div id="tp_x_wilayah_id" class="ewTemplate"><input type="radio" data-table="tbl_salesman" data-field="x_wilayah_id" data-value-separator="<?php echo $tbl_salesman->wilayah_id->DisplayValueSeparatorAttribute() ?>" name="x_wilayah_id" id="x_wilayah_id" value="{value}"<?php echo $tbl_salesman->wilayah_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_salesman->wilayah_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_salesman->subwil_id->Visible) { // subwil_id ?>
<?php if ($tbl_salesman_edit->IsMobileOrModal) { ?>
	<div id="r_subwil_id" class="form-group">
		<label id="elh_tbl_salesman_subwil_id" for="x_subwil_id" class="<?php echo $tbl_salesman_edit->LeftColumnClass ?>"><?php echo $tbl_salesman->subwil_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_salesman_edit->RightColumnClass ?>"><div<?php echo $tbl_salesman->subwil_id->CellAttributes() ?>>
<span id="el_tbl_salesman_subwil_id">
<?php $tbl_salesman->subwil_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tbl_salesman->subwil_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_salesman->subwil_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_salesman->subwil_id->ViewValue ?>
	</span>
	<?php if (!$tbl_salesman->subwil_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_subwil_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_salesman->subwil_id->RadioButtonListHtml(TRUE, "x_subwil_id") ?>
		</div>
	</div>
	<div id="tp_x_subwil_id" class="ewTemplate"><input type="radio" data-table="tbl_salesman" data-field="x_subwil_id" data-value-separator="<?php echo $tbl_salesman->subwil_id->DisplayValueSeparatorAttribute() ?>" name="x_subwil_id" id="x_subwil_id" value="{value}"<?php echo $tbl_salesman->subwil_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_salesman->subwil_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_subwil_id">
		<td class="col-sm-2"><span id="elh_tbl_salesman_subwil_id"><?php echo $tbl_salesman->subwil_id->FldCaption() ?></span></td>
		<td<?php echo $tbl_salesman->subwil_id->CellAttributes() ?>>
<span id="el_tbl_salesman_subwil_id">
<?php $tbl_salesman->subwil_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tbl_salesman->subwil_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_salesman->subwil_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_salesman->subwil_id->ViewValue ?>
	</span>
	<?php if (!$tbl_salesman->subwil_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_subwil_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_salesman->subwil_id->RadioButtonListHtml(TRUE, "x_subwil_id") ?>
		</div>
	</div>
	<div id="tp_x_subwil_id" class="ewTemplate"><input type="radio" data-table="tbl_salesman" data-field="x_subwil_id" data-value-separator="<?php echo $tbl_salesman->subwil_id->DisplayValueSeparatorAttribute() ?>" name="x_subwil_id" id="x_subwil_id" value="{value}"<?php echo $tbl_salesman->subwil_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_salesman->subwil_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_salesman->area_id->Visible) { // area_id ?>
<?php if ($tbl_salesman_edit->IsMobileOrModal) { ?>
	<div id="r_area_id" class="form-group">
		<label id="elh_tbl_salesman_area_id" for="x_area_id" class="<?php echo $tbl_salesman_edit->LeftColumnClass ?>"><?php echo $tbl_salesman->area_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_salesman_edit->RightColumnClass ?>"><div<?php echo $tbl_salesman->area_id->CellAttributes() ?>>
<span id="el_tbl_salesman_area_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_salesman->area_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_salesman->area_id->ViewValue ?>
	</span>
	<?php if (!$tbl_salesman->area_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_area_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_salesman->area_id->RadioButtonListHtml(TRUE, "x_area_id") ?>
		</div>
	</div>
	<div id="tp_x_area_id" class="ewTemplate"><input type="radio" data-table="tbl_salesman" data-field="x_area_id" data-value-separator="<?php echo $tbl_salesman->area_id->DisplayValueSeparatorAttribute() ?>" name="x_area_id" id="x_area_id" value="{value}"<?php echo $tbl_salesman->area_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_salesman->area_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_area_id">
		<td class="col-sm-2"><span id="elh_tbl_salesman_area_id"><?php echo $tbl_salesman->area_id->FldCaption() ?></span></td>
		<td<?php echo $tbl_salesman->area_id->CellAttributes() ?>>
<span id="el_tbl_salesman_area_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tbl_salesman->area_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tbl_salesman->area_id->ViewValue ?>
	</span>
	<?php if (!$tbl_salesman->area_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_area_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tbl_salesman->area_id->RadioButtonListHtml(TRUE, "x_area_id") ?>
		</div>
	</div>
	<div id="tp_x_area_id" class="ewTemplate"><input type="radio" data-table="tbl_salesman" data-field="x_area_id" data-value-separator="<?php echo $tbl_salesman->area_id->DisplayValueSeparatorAttribute() ?>" name="x_area_id" id="x_area_id" value="{value}"<?php echo $tbl_salesman->area_id->EditAttributes() ?>></div>
</div>
</span>
<?php echo $tbl_salesman->area_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_salesman->sales_target->Visible) { // sales_target ?>
<?php if ($tbl_salesman_edit->IsMobileOrModal) { ?>
	<div id="r_sales_target" class="form-group">
		<label id="elh_tbl_salesman_sales_target" for="x_sales_target" class="<?php echo $tbl_salesman_edit->LeftColumnClass ?>"><?php echo $tbl_salesman->sales_target->FldCaption() ?></label>
		<div class="<?php echo $tbl_salesman_edit->RightColumnClass ?>"><div<?php echo $tbl_salesman->sales_target->CellAttributes() ?>>
<span id="el_tbl_salesman_sales_target">
<input type="text" data-table="tbl_salesman" data-field="x_sales_target" name="x_sales_target" id="x_sales_target" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_salesman->sales_target->getPlaceHolder()) ?>" value="<?php echo $tbl_salesman->sales_target->EditValue ?>"<?php echo $tbl_salesman->sales_target->EditAttributes() ?>>
</span>
<?php echo $tbl_salesman->sales_target->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sales_target">
		<td class="col-sm-2"><span id="elh_tbl_salesman_sales_target"><?php echo $tbl_salesman->sales_target->FldCaption() ?></span></td>
		<td<?php echo $tbl_salesman->sales_target->CellAttributes() ?>>
<span id="el_tbl_salesman_sales_target">
<input type="text" data-table="tbl_salesman" data-field="x_sales_target" name="x_sales_target" id="x_sales_target" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_salesman->sales_target->getPlaceHolder()) ?>" value="<?php echo $tbl_salesman->sales_target->EditValue ?>"<?php echo $tbl_salesman->sales_target->EditAttributes() ?>>
</span>
<?php echo $tbl_salesman->sales_target->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_salesman->sales_intensif->Visible) { // sales_intensif ?>
<?php if ($tbl_salesman_edit->IsMobileOrModal) { ?>
	<div id="r_sales_intensif" class="form-group">
		<label id="elh_tbl_salesman_sales_intensif" for="x_sales_intensif" class="<?php echo $tbl_salesman_edit->LeftColumnClass ?>"><?php echo $tbl_salesman->sales_intensif->FldCaption() ?></label>
		<div class="<?php echo $tbl_salesman_edit->RightColumnClass ?>"><div<?php echo $tbl_salesman->sales_intensif->CellAttributes() ?>>
<span id="el_tbl_salesman_sales_intensif">
<input type="text" data-table="tbl_salesman" data-field="x_sales_intensif" name="x_sales_intensif" id="x_sales_intensif" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_salesman->sales_intensif->getPlaceHolder()) ?>" value="<?php echo $tbl_salesman->sales_intensif->EditValue ?>"<?php echo $tbl_salesman->sales_intensif->EditAttributes() ?>>
</span>
<?php echo $tbl_salesman->sales_intensif->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_sales_intensif">
		<td class="col-sm-2"><span id="elh_tbl_salesman_sales_intensif"><?php echo $tbl_salesman->sales_intensif->FldCaption() ?></span></td>
		<td<?php echo $tbl_salesman->sales_intensif->CellAttributes() ?>>
<span id="el_tbl_salesman_sales_intensif">
<input type="text" data-table="tbl_salesman" data-field="x_sales_intensif" name="x_sales_intensif" id="x_sales_intensif" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_salesman->sales_intensif->getPlaceHolder()) ?>" value="<?php echo $tbl_salesman->sales_intensif->EditValue ?>"<?php echo $tbl_salesman->sales_intensif->EditAttributes() ?>>
</span>
<?php echo $tbl_salesman->sales_intensif->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($tbl_salesman_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<input type="hidden" data-table="tbl_salesman" data-field="x_sales_id" name="x_sales_id" id="x_sales_id" value="<?php echo ew_HtmlEncode($tbl_salesman->sales_id->CurrentValue) ?>">
<?php if (!$tbl_salesman_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_salesman_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_salesman_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$tbl_salesman_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ftbl_salesmanedit.Init();
</script>
<?php
$tbl_salesman_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_salesman_edit->Page_Terminate();
?>
