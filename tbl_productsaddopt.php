<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_productsinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_products_addopt = NULL; // Initialize page object first

class ctbl_products_addopt extends ctbl_products {

	// Page ID
	var $PageID = 'addopt';

	// Project ID
	var $ProjectID = '{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}';

	// Table name
	var $TableName = 'tbl_products';

	// Page object name
	var $PageObjName = 'tbl_products_addopt';

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
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (tbl_products)
		if (!isset($GLOBALS["tbl_products"]) || get_class($GLOBALS["tbl_products"]) == "ctbl_products") {
			$GLOBALS["tbl_products"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_products"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_products', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect($this->DBID);
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->product_code->SetVisibility();
		$this->category_id->SetVisibility();
		$this->product_name->SetVisibility();
		$this->merk->SetVisibility();
		$this->supplier_id->SetVisibility();
		$this->unit_id->SetVisibility();
		$this->gramasi->SetVisibility();
		$this->avrg_unit_cost->SetVisibility();
		$this->unit_cost->SetVisibility();
		$this->unit_price->SetVisibility();
		$this->units_in_stock->SetVisibility();
		$this->units_on_order->SetVisibility();
		$this->reorder_level->SetVisibility();
		$this->saldo_awal->SetVisibility();
		$this->saldo_awal_nominal->SetVisibility();
		$this->user_id->SetVisibility();
		$this->lastupdate->SetVisibility();

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
		global $EW_EXPORT, $tbl_products;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_products);
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
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		set_error_handler("ew_ErrorHandler");

		// Set up Breadcrumb
		//$this->SetupBreadcrumb(); // Not used

		$this->LoadRowValues(); // Load default values

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$this->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back
			$this->CurrentAction = "I"; // Display blank record
		}

		// Perform action based on action code
		switch ($this->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$row = array();
					$row["x_product_id"] = $this->product_id->DbValue;
					$row["x_product_code"] = ew_ConvertToUtf8($this->product_code->DbValue);
					$row["x_category_id"] = ew_ConvertToUtf8($this->category_id->DbValue);
					$row["x_product_name"] = ew_ConvertToUtf8($this->product_name->DbValue);
					$row["x_merk"] = ew_ConvertToUtf8($this->merk->DbValue);
					$row["x_supplier_id"] = $this->supplier_id->DbValue;
					$row["x_unit_id"] = ew_ConvertToUtf8($this->unit_id->DbValue);
					$row["x_gramasi"] = $this->gramasi->DbValue;
					$row["x_avrg_unit_cost"] = $this->avrg_unit_cost->DbValue;
					$row["x_unit_cost"] = $this->unit_cost->DbValue;
					$row["x_unit_price"] = $this->unit_price->DbValue;
					$row["x_units_in_stock"] = $this->units_in_stock->DbValue;
					$row["x_units_on_order"] = $this->units_on_order->DbValue;
					$row["x_reorder_level"] = $this->reorder_level->DbValue;
					$row["x_discontinued"] = ew_ConvertToUtf8($this->discontinued->DbValue);
					$row["x_saldo_awal"] = $this->saldo_awal->DbValue;
					$row["x_saldo_awal_nominal"] = $this->saldo_awal_nominal->DbValue;
					$row["x_user_id"] = $this->user_id->DbValue;
					$row["x_lastupdate"] = $this->lastupdate->DbValue;
					if (!EW_DEBUG_ENABLED && ob_get_length())
						ob_end_clean();
					ew_Header(FALSE, "utf-8", TRUE);
					echo ew_ArrayToJson(array($row));
				} else {
					$this->ShowMessage();
				}
				$this->Page_Terminate();
				exit();
		}

		// Render row
		$this->RowType = EW_ROWTYPE_ADD; // Render add type
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
		$this->product_id->CurrentValue = NULL;
		$this->product_id->OldValue = $this->product_id->CurrentValue;
		$this->product_code->CurrentValue = NULL;
		$this->product_code->OldValue = $this->product_code->CurrentValue;
		$this->category_id->CurrentValue = NULL;
		$this->category_id->OldValue = $this->category_id->CurrentValue;
		$this->product_name->CurrentValue = NULL;
		$this->product_name->OldValue = $this->product_name->CurrentValue;
		$this->merk->CurrentValue = NULL;
		$this->merk->OldValue = $this->merk->CurrentValue;
		$this->supplier_id->CurrentValue = NULL;
		$this->supplier_id->OldValue = $this->supplier_id->CurrentValue;
		$this->unit_id->CurrentValue = NULL;
		$this->unit_id->OldValue = $this->unit_id->CurrentValue;
		$this->gramasi->CurrentValue = NULL;
		$this->gramasi->OldValue = $this->gramasi->CurrentValue;
		$this->avrg_unit_cost->CurrentValue = NULL;
		$this->avrg_unit_cost->OldValue = $this->avrg_unit_cost->CurrentValue;
		$this->unit_cost->CurrentValue = NULL;
		$this->unit_cost->OldValue = $this->unit_cost->CurrentValue;
		$this->unit_price->CurrentValue = NULL;
		$this->unit_price->OldValue = $this->unit_price->CurrentValue;
		$this->units_in_stock->CurrentValue = NULL;
		$this->units_in_stock->OldValue = $this->units_in_stock->CurrentValue;
		$this->units_on_order->CurrentValue = NULL;
		$this->units_on_order->OldValue = $this->units_on_order->CurrentValue;
		$this->reorder_level->CurrentValue = NULL;
		$this->reorder_level->OldValue = $this->reorder_level->CurrentValue;
		$this->discontinued->CurrentValue = NULL;
		$this->discontinued->OldValue = $this->discontinued->CurrentValue;
		$this->saldo_awal->CurrentValue = NULL;
		$this->saldo_awal->OldValue = $this->saldo_awal->CurrentValue;
		$this->saldo_awal_nominal->CurrentValue = NULL;
		$this->saldo_awal_nominal->OldValue = $this->saldo_awal_nominal->CurrentValue;
		$this->user_id->CurrentValue = NULL;
		$this->user_id->OldValue = $this->user_id->CurrentValue;
		$this->lastupdate->CurrentValue = NULL;
		$this->lastupdate->OldValue = $this->lastupdate->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->product_code->FldIsDetailKey) {
			$this->product_code->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_product_code")));
		}
		if (!$this->category_id->FldIsDetailKey) {
			$this->category_id->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_category_id")));
		}
		if (!$this->product_name->FldIsDetailKey) {
			$this->product_name->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_product_name")));
		}
		if (!$this->merk->FldIsDetailKey) {
			$this->merk->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_merk")));
		}
		if (!$this->supplier_id->FldIsDetailKey) {
			$this->supplier_id->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_supplier_id")));
		}
		if (!$this->unit_id->FldIsDetailKey) {
			$this->unit_id->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_unit_id")));
		}
		if (!$this->gramasi->FldIsDetailKey) {
			$this->gramasi->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_gramasi")));
		}
		if (!$this->avrg_unit_cost->FldIsDetailKey) {
			$this->avrg_unit_cost->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_avrg_unit_cost")));
		}
		if (!$this->unit_cost->FldIsDetailKey) {
			$this->unit_cost->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_unit_cost")));
		}
		if (!$this->unit_price->FldIsDetailKey) {
			$this->unit_price->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_unit_price")));
		}
		if (!$this->units_in_stock->FldIsDetailKey) {
			$this->units_in_stock->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_units_in_stock")));
		}
		if (!$this->units_on_order->FldIsDetailKey) {
			$this->units_on_order->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_units_on_order")));
		}
		if (!$this->reorder_level->FldIsDetailKey) {
			$this->reorder_level->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_reorder_level")));
		}
		if (!$this->saldo_awal->FldIsDetailKey) {
			$this->saldo_awal->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_saldo_awal")));
		}
		if (!$this->saldo_awal_nominal->FldIsDetailKey) {
			$this->saldo_awal_nominal->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_saldo_awal_nominal")));
		}
		if (!$this->user_id->FldIsDetailKey) {
			$this->user_id->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_user_id")));
		}
		if (!$this->lastupdate->FldIsDetailKey) {
			$this->lastupdate->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_lastupdate")));
			$this->lastupdate->CurrentValue = ew_UnFormatDateTime($this->lastupdate->CurrentValue, 0);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->product_code->CurrentValue = ew_ConvertToUtf8($this->product_code->FormValue);
		$this->category_id->CurrentValue = ew_ConvertToUtf8($this->category_id->FormValue);
		$this->product_name->CurrentValue = ew_ConvertToUtf8($this->product_name->FormValue);
		$this->merk->CurrentValue = ew_ConvertToUtf8($this->merk->FormValue);
		$this->supplier_id->CurrentValue = ew_ConvertToUtf8($this->supplier_id->FormValue);
		$this->unit_id->CurrentValue = ew_ConvertToUtf8($this->unit_id->FormValue);
		$this->gramasi->CurrentValue = ew_ConvertToUtf8($this->gramasi->FormValue);
		$this->avrg_unit_cost->CurrentValue = ew_ConvertToUtf8($this->avrg_unit_cost->FormValue);
		$this->unit_cost->CurrentValue = ew_ConvertToUtf8($this->unit_cost->FormValue);
		$this->unit_price->CurrentValue = ew_ConvertToUtf8($this->unit_price->FormValue);
		$this->units_in_stock->CurrentValue = ew_ConvertToUtf8($this->units_in_stock->FormValue);
		$this->units_on_order->CurrentValue = ew_ConvertToUtf8($this->units_on_order->FormValue);
		$this->reorder_level->CurrentValue = ew_ConvertToUtf8($this->reorder_level->FormValue);
		$this->saldo_awal->CurrentValue = ew_ConvertToUtf8($this->saldo_awal->FormValue);
		$this->saldo_awal_nominal->CurrentValue = ew_ConvertToUtf8($this->saldo_awal_nominal->FormValue);
		$this->user_id->CurrentValue = ew_ConvertToUtf8($this->user_id->FormValue);
		$this->lastupdate->CurrentValue = ew_ConvertToUtf8($this->lastupdate->FormValue);
		$this->lastupdate->CurrentValue = ew_UnFormatDateTime($this->lastupdate->CurrentValue, 0);
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
		$this->product_id->setDbValue($row['product_id']);
		$this->product_code->setDbValue($row['product_code']);
		$this->category_id->setDbValue($row['category_id']);
		$this->product_name->setDbValue($row['product_name']);
		$this->merk->setDbValue($row['merk']);
		$this->supplier_id->setDbValue($row['supplier_id']);
		$this->unit_id->setDbValue($row['unit_id']);
		$this->gramasi->setDbValue($row['gramasi']);
		$this->avrg_unit_cost->setDbValue($row['avrg_unit_cost']);
		$this->unit_cost->setDbValue($row['unit_cost']);
		$this->unit_price->setDbValue($row['unit_price']);
		$this->units_in_stock->setDbValue($row['units_in_stock']);
		$this->units_on_order->setDbValue($row['units_on_order']);
		$this->reorder_level->setDbValue($row['reorder_level']);
		$this->discontinued->setDbValue($row['discontinued']);
		$this->saldo_awal->setDbValue($row['saldo_awal']);
		$this->saldo_awal_nominal->setDbValue($row['saldo_awal_nominal']);
		$this->user_id->setDbValue($row['user_id']);
		$this->lastupdate->setDbValue($row['lastupdate']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['product_id'] = $this->product_id->CurrentValue;
		$row['product_code'] = $this->product_code->CurrentValue;
		$row['category_id'] = $this->category_id->CurrentValue;
		$row['product_name'] = $this->product_name->CurrentValue;
		$row['merk'] = $this->merk->CurrentValue;
		$row['supplier_id'] = $this->supplier_id->CurrentValue;
		$row['unit_id'] = $this->unit_id->CurrentValue;
		$row['gramasi'] = $this->gramasi->CurrentValue;
		$row['avrg_unit_cost'] = $this->avrg_unit_cost->CurrentValue;
		$row['unit_cost'] = $this->unit_cost->CurrentValue;
		$row['unit_price'] = $this->unit_price->CurrentValue;
		$row['units_in_stock'] = $this->units_in_stock->CurrentValue;
		$row['units_on_order'] = $this->units_on_order->CurrentValue;
		$row['reorder_level'] = $this->reorder_level->CurrentValue;
		$row['discontinued'] = $this->discontinued->CurrentValue;
		$row['saldo_awal'] = $this->saldo_awal->CurrentValue;
		$row['saldo_awal_nominal'] = $this->saldo_awal_nominal->CurrentValue;
		$row['user_id'] = $this->user_id->CurrentValue;
		$row['lastupdate'] = $this->lastupdate->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->product_id->DbValue = $row['product_id'];
		$this->product_code->DbValue = $row['product_code'];
		$this->category_id->DbValue = $row['category_id'];
		$this->product_name->DbValue = $row['product_name'];
		$this->merk->DbValue = $row['merk'];
		$this->supplier_id->DbValue = $row['supplier_id'];
		$this->unit_id->DbValue = $row['unit_id'];
		$this->gramasi->DbValue = $row['gramasi'];
		$this->avrg_unit_cost->DbValue = $row['avrg_unit_cost'];
		$this->unit_cost->DbValue = $row['unit_cost'];
		$this->unit_price->DbValue = $row['unit_price'];
		$this->units_in_stock->DbValue = $row['units_in_stock'];
		$this->units_on_order->DbValue = $row['units_on_order'];
		$this->reorder_level->DbValue = $row['reorder_level'];
		$this->discontinued->DbValue = $row['discontinued'];
		$this->saldo_awal->DbValue = $row['saldo_awal'];
		$this->saldo_awal_nominal->DbValue = $row['saldo_awal_nominal'];
		$this->user_id->DbValue = $row['user_id'];
		$this->lastupdate->DbValue = $row['lastupdate'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->gramasi->FormValue == $this->gramasi->CurrentValue && is_numeric(ew_StrToFloat($this->gramasi->CurrentValue)))
			$this->gramasi->CurrentValue = ew_StrToFloat($this->gramasi->CurrentValue);

		// Convert decimal values if posted back
		if ($this->avrg_unit_cost->FormValue == $this->avrg_unit_cost->CurrentValue && is_numeric(ew_StrToFloat($this->avrg_unit_cost->CurrentValue)))
			$this->avrg_unit_cost->CurrentValue = ew_StrToFloat($this->avrg_unit_cost->CurrentValue);

		// Convert decimal values if posted back
		if ($this->unit_cost->FormValue == $this->unit_cost->CurrentValue && is_numeric(ew_StrToFloat($this->unit_cost->CurrentValue)))
			$this->unit_cost->CurrentValue = ew_StrToFloat($this->unit_cost->CurrentValue);

		// Convert decimal values if posted back
		if ($this->unit_price->FormValue == $this->unit_price->CurrentValue && is_numeric(ew_StrToFloat($this->unit_price->CurrentValue)))
			$this->unit_price->CurrentValue = ew_StrToFloat($this->unit_price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->units_in_stock->FormValue == $this->units_in_stock->CurrentValue && is_numeric(ew_StrToFloat($this->units_in_stock->CurrentValue)))
			$this->units_in_stock->CurrentValue = ew_StrToFloat($this->units_in_stock->CurrentValue);

		// Convert decimal values if posted back
		if ($this->units_on_order->FormValue == $this->units_on_order->CurrentValue && is_numeric(ew_StrToFloat($this->units_on_order->CurrentValue)))
			$this->units_on_order->CurrentValue = ew_StrToFloat($this->units_on_order->CurrentValue);

		// Convert decimal values if posted back
		if ($this->reorder_level->FormValue == $this->reorder_level->CurrentValue && is_numeric(ew_StrToFloat($this->reorder_level->CurrentValue)))
			$this->reorder_level->CurrentValue = ew_StrToFloat($this->reorder_level->CurrentValue);

		// Convert decimal values if posted back
		if ($this->saldo_awal->FormValue == $this->saldo_awal->CurrentValue && is_numeric(ew_StrToFloat($this->saldo_awal->CurrentValue)))
			$this->saldo_awal->CurrentValue = ew_StrToFloat($this->saldo_awal->CurrentValue);

		// Convert decimal values if posted back
		if ($this->saldo_awal_nominal->FormValue == $this->saldo_awal_nominal->CurrentValue && is_numeric(ew_StrToFloat($this->saldo_awal_nominal->CurrentValue)))
			$this->saldo_awal_nominal->CurrentValue = ew_StrToFloat($this->saldo_awal_nominal->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// product_id
		// product_code
		// category_id
		// product_name
		// merk
		// supplier_id
		// unit_id
		// gramasi
		// avrg_unit_cost
		// unit_cost
		// unit_price
		// units_in_stock
		// units_on_order
		// reorder_level
		// discontinued
		// saldo_awal
		// saldo_awal_nominal
		// user_id
		// lastupdate

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// product_id
		$this->product_id->ViewValue = $this->product_id->CurrentValue;
		$this->product_id->ViewCustomAttributes = "";

		// product_code
		$this->product_code->ViewValue = $this->product_code->CurrentValue;
		$this->product_code->ViewCustomAttributes = "";

		// category_id
		$this->category_id->ViewValue = $this->category_id->CurrentValue;
		$this->category_id->ViewCustomAttributes = "";

		// product_name
		$this->product_name->ViewValue = $this->product_name->CurrentValue;
		$this->product_name->ViewCustomAttributes = "";

		// merk
		$this->merk->ViewValue = $this->merk->CurrentValue;
		$this->merk->ViewCustomAttributes = "";

		// supplier_id
		$this->supplier_id->ViewValue = $this->supplier_id->CurrentValue;
		$this->supplier_id->ViewCustomAttributes = "";

		// unit_id
		$this->unit_id->ViewValue = $this->unit_id->CurrentValue;
		$this->unit_id->ViewCustomAttributes = "";

		// gramasi
		$this->gramasi->ViewValue = $this->gramasi->CurrentValue;
		$this->gramasi->ViewCustomAttributes = "";

		// avrg_unit_cost
		$this->avrg_unit_cost->ViewValue = $this->avrg_unit_cost->CurrentValue;
		$this->avrg_unit_cost->ViewCustomAttributes = "";

		// unit_cost
		$this->unit_cost->ViewValue = $this->unit_cost->CurrentValue;
		$this->unit_cost->ViewCustomAttributes = "";

		// unit_price
		$this->unit_price->ViewValue = $this->unit_price->CurrentValue;
		$this->unit_price->ViewCustomAttributes = "";

		// units_in_stock
		$this->units_in_stock->ViewValue = $this->units_in_stock->CurrentValue;
		$this->units_in_stock->ViewCustomAttributes = "";

		// units_on_order
		$this->units_on_order->ViewValue = $this->units_on_order->CurrentValue;
		$this->units_on_order->ViewCustomAttributes = "";

		// reorder_level
		$this->reorder_level->ViewValue = $this->reorder_level->CurrentValue;
		$this->reorder_level->ViewCustomAttributes = "";

		// saldo_awal
		$this->saldo_awal->ViewValue = $this->saldo_awal->CurrentValue;
		$this->saldo_awal->ViewCustomAttributes = "";

		// saldo_awal_nominal
		$this->saldo_awal_nominal->ViewValue = $this->saldo_awal_nominal->CurrentValue;
		$this->saldo_awal_nominal->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// lastupdate
		$this->lastupdate->ViewValue = $this->lastupdate->CurrentValue;
		$this->lastupdate->ViewValue = ew_FormatDateTime($this->lastupdate->ViewValue, 0);
		$this->lastupdate->ViewCustomAttributes = "";

			// product_code
			$this->product_code->LinkCustomAttributes = "";
			$this->product_code->HrefValue = "";
			$this->product_code->TooltipValue = "";

			// category_id
			$this->category_id->LinkCustomAttributes = "";
			$this->category_id->HrefValue = "";
			$this->category_id->TooltipValue = "";

			// product_name
			$this->product_name->LinkCustomAttributes = "";
			$this->product_name->HrefValue = "";
			$this->product_name->TooltipValue = "";

			// merk
			$this->merk->LinkCustomAttributes = "";
			$this->merk->HrefValue = "";
			$this->merk->TooltipValue = "";

			// supplier_id
			$this->supplier_id->LinkCustomAttributes = "";
			$this->supplier_id->HrefValue = "";
			$this->supplier_id->TooltipValue = "";

			// unit_id
			$this->unit_id->LinkCustomAttributes = "";
			$this->unit_id->HrefValue = "";
			$this->unit_id->TooltipValue = "";

			// gramasi
			$this->gramasi->LinkCustomAttributes = "";
			$this->gramasi->HrefValue = "";
			$this->gramasi->TooltipValue = "";

			// avrg_unit_cost
			$this->avrg_unit_cost->LinkCustomAttributes = "";
			$this->avrg_unit_cost->HrefValue = "";
			$this->avrg_unit_cost->TooltipValue = "";

			// unit_cost
			$this->unit_cost->LinkCustomAttributes = "";
			$this->unit_cost->HrefValue = "";
			$this->unit_cost->TooltipValue = "";

			// unit_price
			$this->unit_price->LinkCustomAttributes = "";
			$this->unit_price->HrefValue = "";
			$this->unit_price->TooltipValue = "";

			// units_in_stock
			$this->units_in_stock->LinkCustomAttributes = "";
			$this->units_in_stock->HrefValue = "";
			$this->units_in_stock->TooltipValue = "";

			// units_on_order
			$this->units_on_order->LinkCustomAttributes = "";
			$this->units_on_order->HrefValue = "";
			$this->units_on_order->TooltipValue = "";

			// reorder_level
			$this->reorder_level->LinkCustomAttributes = "";
			$this->reorder_level->HrefValue = "";
			$this->reorder_level->TooltipValue = "";

			// saldo_awal
			$this->saldo_awal->LinkCustomAttributes = "";
			$this->saldo_awal->HrefValue = "";
			$this->saldo_awal->TooltipValue = "";

			// saldo_awal_nominal
			$this->saldo_awal_nominal->LinkCustomAttributes = "";
			$this->saldo_awal_nominal->HrefValue = "";
			$this->saldo_awal_nominal->TooltipValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// lastupdate
			$this->lastupdate->LinkCustomAttributes = "";
			$this->lastupdate->HrefValue = "";
			$this->lastupdate->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// product_code
			$this->product_code->EditAttrs["class"] = "form-control";
			$this->product_code->EditCustomAttributes = "";
			$this->product_code->EditValue = ew_HtmlEncode($this->product_code->CurrentValue);
			$this->product_code->PlaceHolder = ew_RemoveHtml($this->product_code->FldCaption());

			// category_id
			$this->category_id->EditAttrs["class"] = "form-control";
			$this->category_id->EditCustomAttributes = "";
			$this->category_id->EditValue = ew_HtmlEncode($this->category_id->CurrentValue);
			$this->category_id->PlaceHolder = ew_RemoveHtml($this->category_id->FldCaption());

			// product_name
			$this->product_name->EditAttrs["class"] = "form-control";
			$this->product_name->EditCustomAttributes = "";
			$this->product_name->EditValue = ew_HtmlEncode($this->product_name->CurrentValue);
			$this->product_name->PlaceHolder = ew_RemoveHtml($this->product_name->FldCaption());

			// merk
			$this->merk->EditAttrs["class"] = "form-control";
			$this->merk->EditCustomAttributes = "";
			$this->merk->EditValue = ew_HtmlEncode($this->merk->CurrentValue);
			$this->merk->PlaceHolder = ew_RemoveHtml($this->merk->FldCaption());

			// supplier_id
			$this->supplier_id->EditAttrs["class"] = "form-control";
			$this->supplier_id->EditCustomAttributes = "";
			$this->supplier_id->EditValue = ew_HtmlEncode($this->supplier_id->CurrentValue);
			$this->supplier_id->PlaceHolder = ew_RemoveHtml($this->supplier_id->FldCaption());

			// unit_id
			$this->unit_id->EditAttrs["class"] = "form-control";
			$this->unit_id->EditCustomAttributes = "";
			$this->unit_id->EditValue = ew_HtmlEncode($this->unit_id->CurrentValue);
			$this->unit_id->PlaceHolder = ew_RemoveHtml($this->unit_id->FldCaption());

			// gramasi
			$this->gramasi->EditAttrs["class"] = "form-control";
			$this->gramasi->EditCustomAttributes = "";
			$this->gramasi->EditValue = ew_HtmlEncode($this->gramasi->CurrentValue);
			$this->gramasi->PlaceHolder = ew_RemoveHtml($this->gramasi->FldCaption());
			if (strval($this->gramasi->EditValue) <> "" && is_numeric($this->gramasi->EditValue)) $this->gramasi->EditValue = ew_FormatNumber($this->gramasi->EditValue, -2, -1, -2, 0);

			// avrg_unit_cost
			$this->avrg_unit_cost->EditAttrs["class"] = "form-control";
			$this->avrg_unit_cost->EditCustomAttributes = "";
			$this->avrg_unit_cost->EditValue = ew_HtmlEncode($this->avrg_unit_cost->CurrentValue);
			$this->avrg_unit_cost->PlaceHolder = ew_RemoveHtml($this->avrg_unit_cost->FldCaption());
			if (strval($this->avrg_unit_cost->EditValue) <> "" && is_numeric($this->avrg_unit_cost->EditValue)) $this->avrg_unit_cost->EditValue = ew_FormatNumber($this->avrg_unit_cost->EditValue, -2, -1, -2, 0);

			// unit_cost
			$this->unit_cost->EditAttrs["class"] = "form-control";
			$this->unit_cost->EditCustomAttributes = "";
			$this->unit_cost->EditValue = ew_HtmlEncode($this->unit_cost->CurrentValue);
			$this->unit_cost->PlaceHolder = ew_RemoveHtml($this->unit_cost->FldCaption());
			if (strval($this->unit_cost->EditValue) <> "" && is_numeric($this->unit_cost->EditValue)) $this->unit_cost->EditValue = ew_FormatNumber($this->unit_cost->EditValue, -2, -1, -2, 0);

			// unit_price
			$this->unit_price->EditAttrs["class"] = "form-control";
			$this->unit_price->EditCustomAttributes = "";
			$this->unit_price->EditValue = ew_HtmlEncode($this->unit_price->CurrentValue);
			$this->unit_price->PlaceHolder = ew_RemoveHtml($this->unit_price->FldCaption());
			if (strval($this->unit_price->EditValue) <> "" && is_numeric($this->unit_price->EditValue)) $this->unit_price->EditValue = ew_FormatNumber($this->unit_price->EditValue, -2, -1, -2, 0);

			// units_in_stock
			$this->units_in_stock->EditAttrs["class"] = "form-control";
			$this->units_in_stock->EditCustomAttributes = "";
			$this->units_in_stock->EditValue = ew_HtmlEncode($this->units_in_stock->CurrentValue);
			$this->units_in_stock->PlaceHolder = ew_RemoveHtml($this->units_in_stock->FldCaption());
			if (strval($this->units_in_stock->EditValue) <> "" && is_numeric($this->units_in_stock->EditValue)) $this->units_in_stock->EditValue = ew_FormatNumber($this->units_in_stock->EditValue, -2, -1, -2, 0);

			// units_on_order
			$this->units_on_order->EditAttrs["class"] = "form-control";
			$this->units_on_order->EditCustomAttributes = "";
			$this->units_on_order->EditValue = ew_HtmlEncode($this->units_on_order->CurrentValue);
			$this->units_on_order->PlaceHolder = ew_RemoveHtml($this->units_on_order->FldCaption());
			if (strval($this->units_on_order->EditValue) <> "" && is_numeric($this->units_on_order->EditValue)) $this->units_on_order->EditValue = ew_FormatNumber($this->units_on_order->EditValue, -2, -1, -2, 0);

			// reorder_level
			$this->reorder_level->EditAttrs["class"] = "form-control";
			$this->reorder_level->EditCustomAttributes = "";
			$this->reorder_level->EditValue = ew_HtmlEncode($this->reorder_level->CurrentValue);
			$this->reorder_level->PlaceHolder = ew_RemoveHtml($this->reorder_level->FldCaption());
			if (strval($this->reorder_level->EditValue) <> "" && is_numeric($this->reorder_level->EditValue)) $this->reorder_level->EditValue = ew_FormatNumber($this->reorder_level->EditValue, -2, -1, -2, 0);

			// saldo_awal
			$this->saldo_awal->EditAttrs["class"] = "form-control";
			$this->saldo_awal->EditCustomAttributes = "";
			$this->saldo_awal->EditValue = ew_HtmlEncode($this->saldo_awal->CurrentValue);
			$this->saldo_awal->PlaceHolder = ew_RemoveHtml($this->saldo_awal->FldCaption());
			if (strval($this->saldo_awal->EditValue) <> "" && is_numeric($this->saldo_awal->EditValue)) $this->saldo_awal->EditValue = ew_FormatNumber($this->saldo_awal->EditValue, -2, -1, -2, 0);

			// saldo_awal_nominal
			$this->saldo_awal_nominal->EditAttrs["class"] = "form-control";
			$this->saldo_awal_nominal->EditCustomAttributes = "";
			$this->saldo_awal_nominal->EditValue = ew_HtmlEncode($this->saldo_awal_nominal->CurrentValue);
			$this->saldo_awal_nominal->PlaceHolder = ew_RemoveHtml($this->saldo_awal_nominal->FldCaption());
			if (strval($this->saldo_awal_nominal->EditValue) <> "" && is_numeric($this->saldo_awal_nominal->EditValue)) $this->saldo_awal_nominal->EditValue = ew_FormatNumber($this->saldo_awal_nominal->EditValue, -2, -1, -2, 0);

			// user_id
			$this->user_id->EditAttrs["class"] = "form-control";
			$this->user_id->EditCustomAttributes = "";
			$this->user_id->EditValue = ew_HtmlEncode($this->user_id->CurrentValue);
			$this->user_id->PlaceHolder = ew_RemoveHtml($this->user_id->FldCaption());

			// lastupdate
			$this->lastupdate->EditAttrs["class"] = "form-control";
			$this->lastupdate->EditCustomAttributes = "";
			$this->lastupdate->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->lastupdate->CurrentValue, 8));
			$this->lastupdate->PlaceHolder = ew_RemoveHtml($this->lastupdate->FldCaption());

			// Add refer script
			// product_code

			$this->product_code->LinkCustomAttributes = "";
			$this->product_code->HrefValue = "";

			// category_id
			$this->category_id->LinkCustomAttributes = "";
			$this->category_id->HrefValue = "";

			// product_name
			$this->product_name->LinkCustomAttributes = "";
			$this->product_name->HrefValue = "";

			// merk
			$this->merk->LinkCustomAttributes = "";
			$this->merk->HrefValue = "";

			// supplier_id
			$this->supplier_id->LinkCustomAttributes = "";
			$this->supplier_id->HrefValue = "";

			// unit_id
			$this->unit_id->LinkCustomAttributes = "";
			$this->unit_id->HrefValue = "";

			// gramasi
			$this->gramasi->LinkCustomAttributes = "";
			$this->gramasi->HrefValue = "";

			// avrg_unit_cost
			$this->avrg_unit_cost->LinkCustomAttributes = "";
			$this->avrg_unit_cost->HrefValue = "";

			// unit_cost
			$this->unit_cost->LinkCustomAttributes = "";
			$this->unit_cost->HrefValue = "";

			// unit_price
			$this->unit_price->LinkCustomAttributes = "";
			$this->unit_price->HrefValue = "";

			// units_in_stock
			$this->units_in_stock->LinkCustomAttributes = "";
			$this->units_in_stock->HrefValue = "";

			// units_on_order
			$this->units_on_order->LinkCustomAttributes = "";
			$this->units_on_order->HrefValue = "";

			// reorder_level
			$this->reorder_level->LinkCustomAttributes = "";
			$this->reorder_level->HrefValue = "";

			// saldo_awal
			$this->saldo_awal->LinkCustomAttributes = "";
			$this->saldo_awal->HrefValue = "";

			// saldo_awal_nominal
			$this->saldo_awal_nominal->LinkCustomAttributes = "";
			$this->saldo_awal_nominal->HrefValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// lastupdate
			$this->lastupdate->LinkCustomAttributes = "";
			$this->lastupdate->HrefValue = "";
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
		if (!ew_CheckInteger($this->supplier_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->supplier_id->FldErrMsg());
		}
		if (!ew_CheckNumber($this->gramasi->FormValue)) {
			ew_AddMessage($gsFormError, $this->gramasi->FldErrMsg());
		}
		if (!ew_CheckNumber($this->avrg_unit_cost->FormValue)) {
			ew_AddMessage($gsFormError, $this->avrg_unit_cost->FldErrMsg());
		}
		if (!ew_CheckNumber($this->unit_cost->FormValue)) {
			ew_AddMessage($gsFormError, $this->unit_cost->FldErrMsg());
		}
		if (!ew_CheckNumber($this->unit_price->FormValue)) {
			ew_AddMessage($gsFormError, $this->unit_price->FldErrMsg());
		}
		if (!ew_CheckNumber($this->units_in_stock->FormValue)) {
			ew_AddMessage($gsFormError, $this->units_in_stock->FldErrMsg());
		}
		if (!ew_CheckNumber($this->units_on_order->FormValue)) {
			ew_AddMessage($gsFormError, $this->units_on_order->FldErrMsg());
		}
		if (!ew_CheckNumber($this->reorder_level->FormValue)) {
			ew_AddMessage($gsFormError, $this->reorder_level->FldErrMsg());
		}
		if (!ew_CheckNumber($this->saldo_awal->FormValue)) {
			ew_AddMessage($gsFormError, $this->saldo_awal->FldErrMsg());
		}
		if (!ew_CheckNumber($this->saldo_awal_nominal->FormValue)) {
			ew_AddMessage($gsFormError, $this->saldo_awal_nominal->FldErrMsg());
		}
		if (!ew_CheckInteger($this->user_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->user_id->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->lastupdate->FormValue)) {
			ew_AddMessage($gsFormError, $this->lastupdate->FldErrMsg());
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

		// product_code
		$this->product_code->SetDbValueDef($rsnew, $this->product_code->CurrentValue, NULL, FALSE);

		// category_id
		$this->category_id->SetDbValueDef($rsnew, $this->category_id->CurrentValue, NULL, FALSE);

		// product_name
		$this->product_name->SetDbValueDef($rsnew, $this->product_name->CurrentValue, NULL, FALSE);

		// merk
		$this->merk->SetDbValueDef($rsnew, $this->merk->CurrentValue, NULL, FALSE);

		// supplier_id
		$this->supplier_id->SetDbValueDef($rsnew, $this->supplier_id->CurrentValue, NULL, FALSE);

		// unit_id
		$this->unit_id->SetDbValueDef($rsnew, $this->unit_id->CurrentValue, NULL, FALSE);

		// gramasi
		$this->gramasi->SetDbValueDef($rsnew, $this->gramasi->CurrentValue, NULL, FALSE);

		// avrg_unit_cost
		$this->avrg_unit_cost->SetDbValueDef($rsnew, $this->avrg_unit_cost->CurrentValue, NULL, FALSE);

		// unit_cost
		$this->unit_cost->SetDbValueDef($rsnew, $this->unit_cost->CurrentValue, NULL, FALSE);

		// unit_price
		$this->unit_price->SetDbValueDef($rsnew, $this->unit_price->CurrentValue, NULL, FALSE);

		// units_in_stock
		$this->units_in_stock->SetDbValueDef($rsnew, $this->units_in_stock->CurrentValue, NULL, FALSE);

		// units_on_order
		$this->units_on_order->SetDbValueDef($rsnew, $this->units_on_order->CurrentValue, NULL, FALSE);

		// reorder_level
		$this->reorder_level->SetDbValueDef($rsnew, $this->reorder_level->CurrentValue, NULL, FALSE);

		// saldo_awal
		$this->saldo_awal->SetDbValueDef($rsnew, $this->saldo_awal->CurrentValue, NULL, FALSE);

		// saldo_awal_nominal
		$this->saldo_awal_nominal->SetDbValueDef($rsnew, $this->saldo_awal_nominal->CurrentValue, NULL, FALSE);

		// user_id
		$this->user_id->SetDbValueDef($rsnew, $this->user_id->CurrentValue, NULL, FALSE);

		// lastupdate
		$this->lastupdate->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->lastupdate->CurrentValue, 0), NULL, FALSE);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_productslist.php"), "", $this->TableVar, TRUE);
		$PageId = "addopt";
		$Breadcrumb->Add("addopt", $PageId, $url);
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

	// Custom validate event
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
if (!isset($tbl_products_addopt)) $tbl_products_addopt = new ctbl_products_addopt();

// Page init
$tbl_products_addopt->Page_Init();

// Page main
$tbl_products_addopt->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_products_addopt->Page_Render();
?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "addopt";
var CurrentForm = ftbl_productsaddopt = new ew_Form("ftbl_productsaddopt", "addopt");

// Validate form
ftbl_productsaddopt.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_supplier_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_products->supplier_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_gramasi");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_products->gramasi->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_avrg_unit_cost");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_products->avrg_unit_cost->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_unit_cost");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_products->unit_cost->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_unit_price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_products->unit_price->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_units_in_stock");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_products->units_in_stock->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_units_on_order");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_products->units_on_order->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_reorder_level");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_products->reorder_level->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_saldo_awal");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_products->saldo_awal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_saldo_awal_nominal");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_products->saldo_awal_nominal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_user_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_products->user_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_lastupdate");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_products->lastupdate->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_productsaddopt.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_productsaddopt.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php
$tbl_products_addopt->ShowMessage();
?>
<form name="ftbl_productsaddopt" id="ftbl_productsaddopt" class="ewForm form-horizontal" action="tbl_productsaddopt.php" method="post">
<?php if ($tbl_products_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_products_addopt->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_products">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<?php if ($tbl_products->product_code->Visible) { // product_code ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_product_code"><?php echo $tbl_products->product_code->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_product_code" name="x_product_code" id="x_product_code" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tbl_products->product_code->getPlaceHolder()) ?>" value="<?php echo $tbl_products->product_code->EditValue ?>"<?php echo $tbl_products->product_code->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->category_id->Visible) { // category_id ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_category_id"><?php echo $tbl_products->category_id->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_category_id" name="x_category_id" id="x_category_id" size="30" maxlength="6" placeholder="<?php echo ew_HtmlEncode($tbl_products->category_id->getPlaceHolder()) ?>" value="<?php echo $tbl_products->category_id->EditValue ?>"<?php echo $tbl_products->category_id->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->product_name->Visible) { // product_name ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_product_name"><?php echo $tbl_products->product_name->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_product_name" name="x_product_name" id="x_product_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_products->product_name->getPlaceHolder()) ?>" value="<?php echo $tbl_products->product_name->EditValue ?>"<?php echo $tbl_products->product_name->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->merk->Visible) { // merk ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_merk"><?php echo $tbl_products->merk->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_merk" name="x_merk" id="x_merk" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tbl_products->merk->getPlaceHolder()) ?>" value="<?php echo $tbl_products->merk->EditValue ?>"<?php echo $tbl_products->merk->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->supplier_id->Visible) { // supplier_id ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_supplier_id"><?php echo $tbl_products->supplier_id->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_supplier_id" name="x_supplier_id" id="x_supplier_id" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_products->supplier_id->getPlaceHolder()) ?>" value="<?php echo $tbl_products->supplier_id->EditValue ?>"<?php echo $tbl_products->supplier_id->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->unit_id->Visible) { // unit_id ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_unit_id"><?php echo $tbl_products->unit_id->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_unit_id" name="x_unit_id" id="x_unit_id" size="30" maxlength="6" placeholder="<?php echo ew_HtmlEncode($tbl_products->unit_id->getPlaceHolder()) ?>" value="<?php echo $tbl_products->unit_id->EditValue ?>"<?php echo $tbl_products->unit_id->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->gramasi->Visible) { // gramasi ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_gramasi"><?php echo $tbl_products->gramasi->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_gramasi" name="x_gramasi" id="x_gramasi" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_products->gramasi->getPlaceHolder()) ?>" value="<?php echo $tbl_products->gramasi->EditValue ?>"<?php echo $tbl_products->gramasi->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->avrg_unit_cost->Visible) { // avrg_unit_cost ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_avrg_unit_cost"><?php echo $tbl_products->avrg_unit_cost->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_avrg_unit_cost" name="x_avrg_unit_cost" id="x_avrg_unit_cost" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_products->avrg_unit_cost->getPlaceHolder()) ?>" value="<?php echo $tbl_products->avrg_unit_cost->EditValue ?>"<?php echo $tbl_products->avrg_unit_cost->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->unit_cost->Visible) { // unit_cost ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_unit_cost"><?php echo $tbl_products->unit_cost->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_unit_cost" name="x_unit_cost" id="x_unit_cost" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_products->unit_cost->getPlaceHolder()) ?>" value="<?php echo $tbl_products->unit_cost->EditValue ?>"<?php echo $tbl_products->unit_cost->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->unit_price->Visible) { // unit_price ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_unit_price"><?php echo $tbl_products->unit_price->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_unit_price" name="x_unit_price" id="x_unit_price" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_products->unit_price->getPlaceHolder()) ?>" value="<?php echo $tbl_products->unit_price->EditValue ?>"<?php echo $tbl_products->unit_price->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->units_in_stock->Visible) { // units_in_stock ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_units_in_stock"><?php echo $tbl_products->units_in_stock->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_units_in_stock" name="x_units_in_stock" id="x_units_in_stock" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_products->units_in_stock->getPlaceHolder()) ?>" value="<?php echo $tbl_products->units_in_stock->EditValue ?>"<?php echo $tbl_products->units_in_stock->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->units_on_order->Visible) { // units_on_order ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_units_on_order"><?php echo $tbl_products->units_on_order->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_units_on_order" name="x_units_on_order" id="x_units_on_order" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_products->units_on_order->getPlaceHolder()) ?>" value="<?php echo $tbl_products->units_on_order->EditValue ?>"<?php echo $tbl_products->units_on_order->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->reorder_level->Visible) { // reorder_level ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_reorder_level"><?php echo $tbl_products->reorder_level->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_reorder_level" name="x_reorder_level" id="x_reorder_level" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_products->reorder_level->getPlaceHolder()) ?>" value="<?php echo $tbl_products->reorder_level->EditValue ?>"<?php echo $tbl_products->reorder_level->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->saldo_awal->Visible) { // saldo_awal ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_saldo_awal"><?php echo $tbl_products->saldo_awal->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_saldo_awal" name="x_saldo_awal" id="x_saldo_awal" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_products->saldo_awal->getPlaceHolder()) ?>" value="<?php echo $tbl_products->saldo_awal->EditValue ?>"<?php echo $tbl_products->saldo_awal->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->saldo_awal_nominal->Visible) { // saldo_awal_nominal ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_saldo_awal_nominal"><?php echo $tbl_products->saldo_awal_nominal->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_saldo_awal_nominal" name="x_saldo_awal_nominal" id="x_saldo_awal_nominal" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_products->saldo_awal_nominal->getPlaceHolder()) ?>" value="<?php echo $tbl_products->saldo_awal_nominal->EditValue ?>"<?php echo $tbl_products->saldo_awal_nominal->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->user_id->Visible) { // user_id ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_user_id"><?php echo $tbl_products->user_id->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_user_id" name="x_user_id" id="x_user_id" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_products->user_id->getPlaceHolder()) ?>" value="<?php echo $tbl_products->user_id->EditValue ?>"<?php echo $tbl_products->user_id->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($tbl_products->lastupdate->Visible) { // lastupdate ?>
	<div class="form-group">
		<label class="col-sm-2 control-label ewLabel" for="x_lastupdate"><?php echo $tbl_products->lastupdate->FldCaption() ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_products" data-field="x_lastupdate" name="x_lastupdate" id="x_lastupdate" placeholder="<?php echo ew_HtmlEncode($tbl_products->lastupdate->getPlaceHolder()) ?>" value="<?php echo $tbl_products->lastupdate->EditValue ?>"<?php echo $tbl_products->lastupdate->EditAttributes() ?>>
</div>
	</div>
<?php } ?>
</form>
<script type="text/javascript">
ftbl_productsaddopt.Init();
</script>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$tbl_products_addopt->Page_Terminate();
?>
