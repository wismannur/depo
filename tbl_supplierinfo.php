<?php

// Global variable for table object
$tbl_supplier = NULL;

//
// Table class for tbl_supplier
//
class ctbl_supplier extends cTable {
	var $supplier_id;
	var $supplier_code;
	var $supplier_name;
	var $contact_name;
	var $address1;
	var $address2;
	var $address3;
	var $phone;
	var $fax;
	var $discount;
	var $due_day;
	var $npwp;
	var $ap_acc;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tbl_supplier';
		$this->TableName = 'tbl_supplier';
		$this->TableType = 'LINKTABLE';

		// Update Table
		$this->UpdateTable = "`tbl_supplier`";
		$this->DBID = 'db_inventory_pusat';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// supplier_id
		$this->supplier_id = new cField('tbl_supplier', 'tbl_supplier', 'x_supplier_id', 'supplier_id', '`supplier_id`', '`supplier_id`', 3, -1, FALSE, '`supplier_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->supplier_id->Sortable = TRUE; // Allow sort
		$this->supplier_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['supplier_id'] = &$this->supplier_id;

		// supplier_code
		$this->supplier_code = new cField('tbl_supplier', 'tbl_supplier', 'x_supplier_code', 'supplier_code', '`supplier_code`', '`supplier_code`', 200, -1, FALSE, '`supplier_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->supplier_code->Sortable = TRUE; // Allow sort
		$this->fields['supplier_code'] = &$this->supplier_code;

		// supplier_name
		$this->supplier_name = new cField('tbl_supplier', 'tbl_supplier', 'x_supplier_name', 'supplier_name', '`supplier_name`', '`supplier_name`', 200, -1, FALSE, '`supplier_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->supplier_name->Sortable = TRUE; // Allow sort
		$this->fields['supplier_name'] = &$this->supplier_name;

		// contact_name
		$this->contact_name = new cField('tbl_supplier', 'tbl_supplier', 'x_contact_name', 'contact_name', '`contact_name`', '`contact_name`', 200, -1, FALSE, '`contact_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->contact_name->Sortable = TRUE; // Allow sort
		$this->fields['contact_name'] = &$this->contact_name;

		// address1
		$this->address1 = new cField('tbl_supplier', 'tbl_supplier', 'x_address1', 'address1', '`address1`', '`address1`', 200, -1, FALSE, '`address1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address1->Sortable = TRUE; // Allow sort
		$this->fields['address1'] = &$this->address1;

		// address2
		$this->address2 = new cField('tbl_supplier', 'tbl_supplier', 'x_address2', 'address2', '`address2`', '`address2`', 200, -1, FALSE, '`address2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address2->Sortable = TRUE; // Allow sort
		$this->fields['address2'] = &$this->address2;

		// address3
		$this->address3 = new cField('tbl_supplier', 'tbl_supplier', 'x_address3', 'address3', '`address3`', '`address3`', 200, -1, FALSE, '`address3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address3->Sortable = TRUE; // Allow sort
		$this->fields['address3'] = &$this->address3;

		// phone
		$this->phone = new cField('tbl_supplier', 'tbl_supplier', 'x_phone', 'phone', '`phone`', '`phone`', 200, -1, FALSE, '`phone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phone->Sortable = TRUE; // Allow sort
		$this->fields['phone'] = &$this->phone;

		// fax
		$this->fax = new cField('tbl_supplier', 'tbl_supplier', 'x_fax', 'fax', '`fax`', '`fax`', 200, -1, FALSE, '`fax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fax->Sortable = TRUE; // Allow sort
		$this->fields['fax'] = &$this->fax;

		// discount
		$this->discount = new cField('tbl_supplier', 'tbl_supplier', 'x_discount', 'discount', '`discount`', '`discount`', 5, -1, FALSE, '`discount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->discount->Sortable = TRUE; // Allow sort
		$this->discount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['discount'] = &$this->discount;

		// due_day
		$this->due_day = new cField('tbl_supplier', 'tbl_supplier', 'x_due_day', 'due_day', '`due_day`', '`due_day`', 3, -1, FALSE, '`due_day`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->due_day->Sortable = TRUE; // Allow sort
		$this->due_day->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['due_day'] = &$this->due_day;

		// npwp
		$this->npwp = new cField('tbl_supplier', 'tbl_supplier', 'x_npwp', 'npwp', '`npwp`', '`npwp`', 200, -1, FALSE, '`npwp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->npwp->Sortable = TRUE; // Allow sort
		$this->fields['npwp'] = &$this->npwp;

		// ap_acc
		$this->ap_acc = new cField('tbl_supplier', 'tbl_supplier', 'x_ap_acc', 'ap_acc', '`ap_acc`', '`ap_acc`', 200, -1, FALSE, '`ap_acc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ap_acc->Sortable = TRUE; // Allow sort
		$this->fields['ap_acc'] = &$this->ap_acc;
	}

	// Field Visibility
	function GetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Column CSS classes
	var $LeftColumnClass = "col-sm-2 control-label ewLabel";
	var $RightColumnClass = "col-sm-10";
	var $OffsetColumnClass = "col-sm-10 col-sm-offset-2";

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function SetLeftColumnClass($class) {
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " control-label ewLabel";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - intval($match[2]));
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace($match[1], $match[1] + "-offset", $class);
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tbl_supplier`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$filter = $this->CurrentFilter;
		$filter = $this->ApplyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->GetSQL($filter, $sort);
	}

	// Table SQL with List page filter
	var $UseSessionForListSQL = TRUE;

	function ListSQL() {
		$sFilter = $this->UseSessionForListSQL ? $this->getSessionWhere() : "";
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSelect = $this->getSqlSelect();
		$sSort = $this->UseSessionForListSQL ? $this->getSessionOrderBy() : "";
		return ew_BuildSelectSql($sSelect, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sql) {
		$cnt = -1;
		$pattern = "/^SELECT \* FROM/i";
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match($pattern, $sql)) {
			$sql = "SELECT COUNT(*) FROM" . preg_replace($pattern, "", $sql);
		} else {
			$sql = "SELECT COUNT(*) FROM (" . $sql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($filter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function ListRecordCount() {
		$filter = $this->getSessionWhere();
		ew_AddFilter($filter, $this->CurrentFilter);
		$filter = $this->ApplyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->supplier_id->setDbValue($conn->Insert_ID());
			$rs['supplier_id'] = $this->supplier_id->DbValue;
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('supplier_id', $rs))
				ew_AddFilter($where, ew_QuotedName('supplier_id', $this->DBID) . '=' . ew_QuotedValue($rs['supplier_id'], $this->supplier_id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$bDelete = TRUE;
		$conn = &$this->Connection();
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`supplier_id` = @supplier_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->supplier_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->supplier_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@supplier_id@", ew_AdjustSql($this->supplier_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "tbl_supplierlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tbl_supplierview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tbl_supplieredit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tbl_supplieradd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tbl_supplierlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tbl_supplierview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tbl_supplierview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tbl_supplieradd.php?" . $this->UrlParm($parm);
		else
			$url = "tbl_supplieradd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("tbl_supplieredit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("tbl_supplieradd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tbl_supplierdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "supplier_id:" . ew_VarToJson($this->supplier_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->supplier_id->CurrentValue)) {
			$sUrl .= "supplier_id=" . urlencode($this->supplier_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		return "";
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = $_POST["key_m"];
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = $_GET["key_m"];
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsPost();
			if ($isPost && isset($_POST["supplier_id"]))
				$arKeys[] = $_POST["supplier_id"];
			elseif (isset($_GET["supplier_id"]))
				$arKeys[] = $_GET["supplier_id"];
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->supplier_id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($filter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $filter;
		//$sql = $this->SQL();

		$sql = $this->GetSQL($filter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->supplier_id->setDbValue($rs->fields('supplier_id'));
		$this->supplier_code->setDbValue($rs->fields('supplier_code'));
		$this->supplier_name->setDbValue($rs->fields('supplier_name'));
		$this->contact_name->setDbValue($rs->fields('contact_name'));
		$this->address1->setDbValue($rs->fields('address1'));
		$this->address2->setDbValue($rs->fields('address2'));
		$this->address3->setDbValue($rs->fields('address3'));
		$this->phone->setDbValue($rs->fields('phone'));
		$this->fax->setDbValue($rs->fields('fax'));
		$this->discount->setDbValue($rs->fields('discount'));
		$this->due_day->setDbValue($rs->fields('due_day'));
		$this->npwp->setDbValue($rs->fields('npwp'));
		$this->ap_acc->setDbValue($rs->fields('ap_acc'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// supplier_id
		// supplier_code
		// supplier_name
		// contact_name
		// address1
		// address2
		// address3
		// phone
		// fax
		// discount
		// due_day
		// npwp
		// ap_acc
		// supplier_id

		$this->supplier_id->ViewValue = $this->supplier_id->CurrentValue;
		$this->supplier_id->ViewCustomAttributes = "";

		// supplier_code
		$this->supplier_code->ViewValue = $this->supplier_code->CurrentValue;
		$this->supplier_code->ViewCustomAttributes = "";

		// supplier_name
		$this->supplier_name->ViewValue = $this->supplier_name->CurrentValue;
		$this->supplier_name->ViewCustomAttributes = "";

		// contact_name
		$this->contact_name->ViewValue = $this->contact_name->CurrentValue;
		$this->contact_name->ViewCustomAttributes = "";

		// address1
		$this->address1->ViewValue = $this->address1->CurrentValue;
		$this->address1->ViewCustomAttributes = "";

		// address2
		$this->address2->ViewValue = $this->address2->CurrentValue;
		$this->address2->ViewCustomAttributes = "";

		// address3
		$this->address3->ViewValue = $this->address3->CurrentValue;
		$this->address3->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// fax
		$this->fax->ViewValue = $this->fax->CurrentValue;
		$this->fax->ViewCustomAttributes = "";

		// discount
		$this->discount->ViewValue = $this->discount->CurrentValue;
		$this->discount->ViewCustomAttributes = "";

		// due_day
		$this->due_day->ViewValue = $this->due_day->CurrentValue;
		$this->due_day->ViewCustomAttributes = "";

		// npwp
		$this->npwp->ViewValue = $this->npwp->CurrentValue;
		$this->npwp->ViewCustomAttributes = "";

		// ap_acc
		$this->ap_acc->ViewValue = $this->ap_acc->CurrentValue;
		$this->ap_acc->ViewCustomAttributes = "";

		// supplier_id
		$this->supplier_id->LinkCustomAttributes = "";
		$this->supplier_id->HrefValue = "";
		$this->supplier_id->TooltipValue = "";

		// supplier_code
		$this->supplier_code->LinkCustomAttributes = "";
		$this->supplier_code->HrefValue = "";
		$this->supplier_code->TooltipValue = "";

		// supplier_name
		$this->supplier_name->LinkCustomAttributes = "";
		$this->supplier_name->HrefValue = "";
		$this->supplier_name->TooltipValue = "";

		// contact_name
		$this->contact_name->LinkCustomAttributes = "";
		$this->contact_name->HrefValue = "";
		$this->contact_name->TooltipValue = "";

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

		// phone
		$this->phone->LinkCustomAttributes = "";
		$this->phone->HrefValue = "";
		$this->phone->TooltipValue = "";

		// fax
		$this->fax->LinkCustomAttributes = "";
		$this->fax->HrefValue = "";
		$this->fax->TooltipValue = "";

		// discount
		$this->discount->LinkCustomAttributes = "";
		$this->discount->HrefValue = "";
		$this->discount->TooltipValue = "";

		// due_day
		$this->due_day->LinkCustomAttributes = "";
		$this->due_day->HrefValue = "";
		$this->due_day->TooltipValue = "";

		// npwp
		$this->npwp->LinkCustomAttributes = "";
		$this->npwp->HrefValue = "";
		$this->npwp->TooltipValue = "";

		// ap_acc
		$this->ap_acc->LinkCustomAttributes = "";
		$this->ap_acc->HrefValue = "";
		$this->ap_acc->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->CustomTemplateFieldValues();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// supplier_id
		$this->supplier_id->EditAttrs["class"] = "form-control";
		$this->supplier_id->EditCustomAttributes = "";
		$this->supplier_id->EditValue = $this->supplier_id->CurrentValue;
		$this->supplier_id->ViewCustomAttributes = "";

		// supplier_code
		$this->supplier_code->EditAttrs["class"] = "form-control";
		$this->supplier_code->EditCustomAttributes = "";
		$this->supplier_code->EditValue = $this->supplier_code->CurrentValue;
		$this->supplier_code->PlaceHolder = ew_RemoveHtml($this->supplier_code->FldCaption());

		// supplier_name
		$this->supplier_name->EditAttrs["class"] = "form-control";
		$this->supplier_name->EditCustomAttributes = "";
		$this->supplier_name->EditValue = $this->supplier_name->CurrentValue;
		$this->supplier_name->PlaceHolder = ew_RemoveHtml($this->supplier_name->FldCaption());

		// contact_name
		$this->contact_name->EditAttrs["class"] = "form-control";
		$this->contact_name->EditCustomAttributes = "";
		$this->contact_name->EditValue = $this->contact_name->CurrentValue;
		$this->contact_name->PlaceHolder = ew_RemoveHtml($this->contact_name->FldCaption());

		// address1
		$this->address1->EditAttrs["class"] = "form-control";
		$this->address1->EditCustomAttributes = "";
		$this->address1->EditValue = $this->address1->CurrentValue;
		$this->address1->PlaceHolder = ew_RemoveHtml($this->address1->FldCaption());

		// address2
		$this->address2->EditAttrs["class"] = "form-control";
		$this->address2->EditCustomAttributes = "";
		$this->address2->EditValue = $this->address2->CurrentValue;
		$this->address2->PlaceHolder = ew_RemoveHtml($this->address2->FldCaption());

		// address3
		$this->address3->EditAttrs["class"] = "form-control";
		$this->address3->EditCustomAttributes = "";
		$this->address3->EditValue = $this->address3->CurrentValue;
		$this->address3->PlaceHolder = ew_RemoveHtml($this->address3->FldCaption());

		// phone
		$this->phone->EditAttrs["class"] = "form-control";
		$this->phone->EditCustomAttributes = "";
		$this->phone->EditValue = $this->phone->CurrentValue;
		$this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldCaption());

		// fax
		$this->fax->EditAttrs["class"] = "form-control";
		$this->fax->EditCustomAttributes = "";
		$this->fax->EditValue = $this->fax->CurrentValue;
		$this->fax->PlaceHolder = ew_RemoveHtml($this->fax->FldCaption());

		// discount
		$this->discount->EditAttrs["class"] = "form-control";
		$this->discount->EditCustomAttributes = "";
		$this->discount->EditValue = $this->discount->CurrentValue;
		$this->discount->PlaceHolder = ew_RemoveHtml($this->discount->FldCaption());
		if (strval($this->discount->EditValue) <> "" && is_numeric($this->discount->EditValue)) $this->discount->EditValue = ew_FormatNumber($this->discount->EditValue, -2, -1, -2, 0);

		// due_day
		$this->due_day->EditAttrs["class"] = "form-control";
		$this->due_day->EditCustomAttributes = "";
		$this->due_day->EditValue = $this->due_day->CurrentValue;
		$this->due_day->PlaceHolder = ew_RemoveHtml($this->due_day->FldCaption());

		// npwp
		$this->npwp->EditAttrs["class"] = "form-control";
		$this->npwp->EditCustomAttributes = "";
		$this->npwp->EditValue = $this->npwp->CurrentValue;
		$this->npwp->PlaceHolder = ew_RemoveHtml($this->npwp->FldCaption());

		// ap_acc
		$this->ap_acc->EditAttrs["class"] = "form-control";
		$this->ap_acc->EditCustomAttributes = "";
		$this->ap_acc->EditValue = $this->ap_acc->CurrentValue;
		$this->ap_acc->PlaceHolder = ew_RemoveHtml($this->ap_acc->FldCaption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->supplier_id->Exportable) $Doc->ExportCaption($this->supplier_id);
					if ($this->supplier_code->Exportable) $Doc->ExportCaption($this->supplier_code);
					if ($this->supplier_name->Exportable) $Doc->ExportCaption($this->supplier_name);
					if ($this->contact_name->Exportable) $Doc->ExportCaption($this->contact_name);
					if ($this->address1->Exportable) $Doc->ExportCaption($this->address1);
					if ($this->address2->Exportable) $Doc->ExportCaption($this->address2);
					if ($this->address3->Exportable) $Doc->ExportCaption($this->address3);
					if ($this->phone->Exportable) $Doc->ExportCaption($this->phone);
					if ($this->fax->Exportable) $Doc->ExportCaption($this->fax);
					if ($this->discount->Exportable) $Doc->ExportCaption($this->discount);
					if ($this->due_day->Exportable) $Doc->ExportCaption($this->due_day);
					if ($this->npwp->Exportable) $Doc->ExportCaption($this->npwp);
					if ($this->ap_acc->Exportable) $Doc->ExportCaption($this->ap_acc);
				} else {
					if ($this->supplier_id->Exportable) $Doc->ExportCaption($this->supplier_id);
					if ($this->supplier_code->Exportable) $Doc->ExportCaption($this->supplier_code);
					if ($this->supplier_name->Exportable) $Doc->ExportCaption($this->supplier_name);
					if ($this->contact_name->Exportable) $Doc->ExportCaption($this->contact_name);
					if ($this->address1->Exportable) $Doc->ExportCaption($this->address1);
					if ($this->address2->Exportable) $Doc->ExportCaption($this->address2);
					if ($this->address3->Exportable) $Doc->ExportCaption($this->address3);
					if ($this->phone->Exportable) $Doc->ExportCaption($this->phone);
					if ($this->fax->Exportable) $Doc->ExportCaption($this->fax);
					if ($this->discount->Exportable) $Doc->ExportCaption($this->discount);
					if ($this->due_day->Exportable) $Doc->ExportCaption($this->due_day);
					if ($this->npwp->Exportable) $Doc->ExportCaption($this->npwp);
					if ($this->ap_acc->Exportable) $Doc->ExportCaption($this->ap_acc);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->supplier_id->Exportable) $Doc->ExportField($this->supplier_id);
						if ($this->supplier_code->Exportable) $Doc->ExportField($this->supplier_code);
						if ($this->supplier_name->Exportable) $Doc->ExportField($this->supplier_name);
						if ($this->contact_name->Exportable) $Doc->ExportField($this->contact_name);
						if ($this->address1->Exportable) $Doc->ExportField($this->address1);
						if ($this->address2->Exportable) $Doc->ExportField($this->address2);
						if ($this->address3->Exportable) $Doc->ExportField($this->address3);
						if ($this->phone->Exportable) $Doc->ExportField($this->phone);
						if ($this->fax->Exportable) $Doc->ExportField($this->fax);
						if ($this->discount->Exportable) $Doc->ExportField($this->discount);
						if ($this->due_day->Exportable) $Doc->ExportField($this->due_day);
						if ($this->npwp->Exportable) $Doc->ExportField($this->npwp);
						if ($this->ap_acc->Exportable) $Doc->ExportField($this->ap_acc);
					} else {
						if ($this->supplier_id->Exportable) $Doc->ExportField($this->supplier_id);
						if ($this->supplier_code->Exportable) $Doc->ExportField($this->supplier_code);
						if ($this->supplier_name->Exportable) $Doc->ExportField($this->supplier_name);
						if ($this->contact_name->Exportable) $Doc->ExportField($this->contact_name);
						if ($this->address1->Exportable) $Doc->ExportField($this->address1);
						if ($this->address2->Exportable) $Doc->ExportField($this->address2);
						if ($this->address3->Exportable) $Doc->ExportField($this->address3);
						if ($this->phone->Exportable) $Doc->ExportField($this->phone);
						if ($this->fax->Exportable) $Doc->ExportField($this->fax);
						if ($this->discount->Exportable) $Doc->ExportField($this->discount);
						if ($this->due_day->Exportable) $Doc->ExportField($this->due_day);
						if ($this->npwp->Exportable) $Doc->ExportField($this->npwp);
						if ($this->ap_acc->Exportable) $Doc->ExportField($this->ap_acc);
					}
					$Doc->EndExportRow($RowCnt);
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
