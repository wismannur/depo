<?php

// Global variable for table object
$tbl_products = NULL;

//
// Table class for tbl_products
//
class ctbl_products extends cTable {
	var $product_id;
	var $product_code;
	var $category_id;
	var $product_name;
	var $merk;
	var $supplier_id;
	var $unit_id;
	var $gramasi;
	var $avrg_unit_cost;
	var $unit_cost;
	var $unit_price;
	var $units_in_stock;
	var $units_on_order;
	var $reorder_level;
	var $discontinued;
	var $saldo_awal;
	var $saldo_awal_nominal;
	var $user_id;
	var $lastupdate;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tbl_products';
		$this->TableName = 'tbl_products';
		$this->TableType = 'LINKTABLE';

		// Update Table
		$this->UpdateTable = "`tbl_products`";
		$this->DBID = 'db_inventory_pusat';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4; // Page size (PHPExcel only)
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

		// product_id
		$this->product_id = new cField('tbl_products', 'tbl_products', 'x_product_id', 'product_id', '`product_id`', '`product_id`', 3, -1, FALSE, '`product_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->product_id->Sortable = TRUE; // Allow sort
		$this->product_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['product_id'] = &$this->product_id;

		// product_code
		$this->product_code = new cField('tbl_products', 'tbl_products', 'x_product_code', 'product_code', '`product_code`', '`product_code`', 200, -1, FALSE, '`product_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->product_code->Sortable = TRUE; // Allow sort
		$this->fields['product_code'] = &$this->product_code;

		// category_id
		$this->category_id = new cField('tbl_products', 'tbl_products', 'x_category_id', 'category_id', '`category_id`', '`category_id`', 200, -1, FALSE, '`category_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->category_id->Sortable = TRUE; // Allow sort
		$this->fields['category_id'] = &$this->category_id;

		// product_name
		$this->product_name = new cField('tbl_products', 'tbl_products', 'x_product_name', 'product_name', '`product_name`', '`product_name`', 200, -1, FALSE, '`product_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->product_name->Sortable = TRUE; // Allow sort
		$this->fields['product_name'] = &$this->product_name;

		// merk
		$this->merk = new cField('tbl_products', 'tbl_products', 'x_merk', 'merk', '`merk`', '`merk`', 200, -1, FALSE, '`merk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->merk->Sortable = TRUE; // Allow sort
		$this->fields['merk'] = &$this->merk;

		// supplier_id
		$this->supplier_id = new cField('tbl_products', 'tbl_products', 'x_supplier_id', 'supplier_id', '`supplier_id`', '`supplier_id`', 3, -1, FALSE, '`supplier_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->supplier_id->Sortable = TRUE; // Allow sort
		$this->supplier_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['supplier_id'] = &$this->supplier_id;

		// unit_id
		$this->unit_id = new cField('tbl_products', 'tbl_products', 'x_unit_id', 'unit_id', '`unit_id`', '`unit_id`', 200, -1, FALSE, '`unit_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->unit_id->Sortable = TRUE; // Allow sort
		$this->fields['unit_id'] = &$this->unit_id;

		// gramasi
		$this->gramasi = new cField('tbl_products', 'tbl_products', 'x_gramasi', 'gramasi', '`gramasi`', '`gramasi`', 5, -1, FALSE, '`gramasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gramasi->Sortable = TRUE; // Allow sort
		$this->gramasi->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['gramasi'] = &$this->gramasi;

		// avrg_unit_cost
		$this->avrg_unit_cost = new cField('tbl_products', 'tbl_products', 'x_avrg_unit_cost', 'avrg_unit_cost', '`avrg_unit_cost`', '`avrg_unit_cost`', 5, -1, FALSE, '`avrg_unit_cost`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->avrg_unit_cost->Sortable = TRUE; // Allow sort
		$this->avrg_unit_cost->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['avrg_unit_cost'] = &$this->avrg_unit_cost;

		// unit_cost
		$this->unit_cost = new cField('tbl_products', 'tbl_products', 'x_unit_cost', 'unit_cost', '`unit_cost`', '`unit_cost`', 5, -1, FALSE, '`unit_cost`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->unit_cost->Sortable = TRUE; // Allow sort
		$this->unit_cost->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['unit_cost'] = &$this->unit_cost;

		// unit_price
		$this->unit_price = new cField('tbl_products', 'tbl_products', 'x_unit_price', 'unit_price', '`unit_price`', '`unit_price`', 5, -1, FALSE, '`unit_price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->unit_price->Sortable = TRUE; // Allow sort
		$this->unit_price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['unit_price'] = &$this->unit_price;

		// units_in_stock
		$this->units_in_stock = new cField('tbl_products', 'tbl_products', 'x_units_in_stock', 'units_in_stock', '`units_in_stock`', '`units_in_stock`', 5, -1, FALSE, '`units_in_stock`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->units_in_stock->Sortable = TRUE; // Allow sort
		$this->units_in_stock->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['units_in_stock'] = &$this->units_in_stock;

		// units_on_order
		$this->units_on_order = new cField('tbl_products', 'tbl_products', 'x_units_on_order', 'units_on_order', '`units_on_order`', '`units_on_order`', 5, -1, FALSE, '`units_on_order`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->units_on_order->Sortable = TRUE; // Allow sort
		$this->units_on_order->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['units_on_order'] = &$this->units_on_order;

		// reorder_level
		$this->reorder_level = new cField('tbl_products', 'tbl_products', 'x_reorder_level', 'reorder_level', '`reorder_level`', '`reorder_level`', 5, -1, FALSE, '`reorder_level`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->reorder_level->Sortable = TRUE; // Allow sort
		$this->reorder_level->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['reorder_level'] = &$this->reorder_level;

		// discontinued
		$this->discontinued = new cField('tbl_products', 'tbl_products', 'x_discontinued', 'discontinued', '`discontinued`', '`discontinued`', 202, -1, FALSE, '`discontinued`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->discontinued->Sortable = TRUE; // Allow sort
		$this->discontinued->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->discontinued->OptionCount = 2;
		$this->fields['discontinued'] = &$this->discontinued;

		// saldo_awal
		$this->saldo_awal = new cField('tbl_products', 'tbl_products', 'x_saldo_awal', 'saldo_awal', '`saldo_awal`', '`saldo_awal`', 5, -1, FALSE, '`saldo_awal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->saldo_awal->Sortable = TRUE; // Allow sort
		$this->saldo_awal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['saldo_awal'] = &$this->saldo_awal;

		// saldo_awal_nominal
		$this->saldo_awal_nominal = new cField('tbl_products', 'tbl_products', 'x_saldo_awal_nominal', 'saldo_awal_nominal', '`saldo_awal_nominal`', '`saldo_awal_nominal`', 5, -1, FALSE, '`saldo_awal_nominal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->saldo_awal_nominal->Sortable = TRUE; // Allow sort
		$this->saldo_awal_nominal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['saldo_awal_nominal'] = &$this->saldo_awal_nominal;

		// user_id
		$this->user_id = new cField('tbl_products', 'tbl_products', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 3, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_id->Sortable = TRUE; // Allow sort
		$this->user_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['user_id'] = &$this->user_id;

		// lastupdate
		$this->lastupdate = new cField('tbl_products', 'tbl_products', 'x_lastupdate', 'lastupdate', '`lastupdate`', ew_CastDateFieldForLike('`lastupdate`', 0, "db_inventory_pusat"), 135, 0, FALSE, '`lastupdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lastupdate->Sortable = TRUE; // Allow sort
		$this->lastupdate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['lastupdate'] = &$this->lastupdate;
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

	// Current detail table name
	function getCurrentDetailTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE];
	}

	function setCurrentDetailTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	function GetDetailUrl() {

		// Detail url
		$sDetailUrl = "";
		if ($this->getCurrentDetailTable() == "tbl_unit_detail") {
			$sDetailUrl = $GLOBALS["tbl_unit_detail"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_product_id=" . urlencode($this->product_id->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "tbl_productslist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tbl_products`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`product_code` ASC";
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
			$this->product_id->setDbValue($conn->Insert_ID());
			$rs['product_id'] = $this->product_id->DbValue;
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
			if (array_key_exists('product_id', $rs))
				ew_AddFilter($where, ew_QuotedName('product_id', $this->DBID) . '=' . ew_QuotedValue($rs['product_id'], $this->product_id->FldDataType, $this->DBID));
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
		return "`product_id` = @product_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->product_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->product_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@product_id@", ew_AdjustSql($this->product_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "tbl_productslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tbl_productsview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tbl_productsedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tbl_productsadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tbl_productslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tbl_productsview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tbl_productsview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tbl_productsadd.php?" . $this->UrlParm($parm);
		else
			$url = "tbl_productsadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tbl_productsedit.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tbl_productsedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tbl_productsadd.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tbl_productsadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tbl_productsdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "product_id:" . ew_VarToJson($this->product_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->product_id->CurrentValue)) {
			$sUrl .= "product_id=" . urlencode($this->product_id->CurrentValue);
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
			if ($isPost && isset($_POST["product_id"]))
				$arKeys[] = $_POST["product_id"];
			elseif (isset($_GET["product_id"]))
				$arKeys[] = $_GET["product_id"];
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
			$this->product_id->CurrentValue = $key;
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
		$this->product_id->setDbValue($rs->fields('product_id'));
		$this->product_code->setDbValue($rs->fields('product_code'));
		$this->category_id->setDbValue($rs->fields('category_id'));
		$this->product_name->setDbValue($rs->fields('product_name'));
		$this->merk->setDbValue($rs->fields('merk'));
		$this->supplier_id->setDbValue($rs->fields('supplier_id'));
		$this->unit_id->setDbValue($rs->fields('unit_id'));
		$this->gramasi->setDbValue($rs->fields('gramasi'));
		$this->avrg_unit_cost->setDbValue($rs->fields('avrg_unit_cost'));
		$this->unit_cost->setDbValue($rs->fields('unit_cost'));
		$this->unit_price->setDbValue($rs->fields('unit_price'));
		$this->units_in_stock->setDbValue($rs->fields('units_in_stock'));
		$this->units_on_order->setDbValue($rs->fields('units_on_order'));
		$this->reorder_level->setDbValue($rs->fields('reorder_level'));
		$this->discontinued->setDbValue($rs->fields('discontinued'));
		$this->saldo_awal->setDbValue($rs->fields('saldo_awal'));
		$this->saldo_awal_nominal->setDbValue($rs->fields('saldo_awal_nominal'));
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->lastupdate->setDbValue($rs->fields('lastupdate'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
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
		if (strval($this->supplier_id->CurrentValue) <> "") {
			$sFilterWrk = "`supplier_id`" . ew_SearchString("=", $this->supplier_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `supplier_id`, `supplier_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_supplier`";
		$sWhereWrk = "";
		$this->supplier_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->supplier_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->supplier_id->ViewValue = $this->supplier_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->supplier_id->ViewValue = $this->supplier_id->CurrentValue;
			}
		} else {
			$this->supplier_id->ViewValue = NULL;
		}
		$this->supplier_id->ViewCustomAttributes = "";

		// unit_id
		$this->unit_id->ViewValue = $this->unit_id->CurrentValue;
		$this->unit_id->CellCssStyle .= "text-align: center;";
		$this->unit_id->ViewCustomAttributes = "";

		// gramasi
		$this->gramasi->ViewValue = $this->gramasi->CurrentValue;
		$this->gramasi->ViewValue = ew_FormatNumber($this->gramasi->ViewValue, 2, -2, -2, -2);
		$this->gramasi->CellCssStyle .= "text-align: right;";
		$this->gramasi->ViewCustomAttributes = "";

		// avrg_unit_cost
		$this->avrg_unit_cost->ViewValue = $this->avrg_unit_cost->CurrentValue;
		$this->avrg_unit_cost->ViewValue = ew_FormatNumber($this->avrg_unit_cost->ViewValue, 2, -2, -2, -2);
		$this->avrg_unit_cost->CellCssStyle .= "text-align: right;";
		$this->avrg_unit_cost->ViewCustomAttributes = "";

		// unit_cost
		$this->unit_cost->ViewValue = $this->unit_cost->CurrentValue;
		$this->unit_cost->ViewValue = ew_FormatNumber($this->unit_cost->ViewValue, 2, -2, -2, -2);
		$this->unit_cost->CellCssStyle .= "text-align: right;";
		$this->unit_cost->ViewCustomAttributes = "";

		// unit_price
		$this->unit_price->ViewValue = $this->unit_price->CurrentValue;
		$this->unit_price->ViewValue = ew_FormatNumber($this->unit_price->ViewValue, 0, -2, -2, -2);
		$this->unit_price->CellCssStyle .= "text-align: right;";
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

		// discontinued
		if (ew_ConvertToBool($this->discontinued->CurrentValue)) {
			$this->discontinued->ViewValue = $this->discontinued->FldTagCaption(1) <> "" ? $this->discontinued->FldTagCaption(1) : "1";
		} else {
			$this->discontinued->ViewValue = $this->discontinued->FldTagCaption(2) <> "" ? $this->discontinued->FldTagCaption(2) : "0";
		}
		$this->discontinued->CellCssStyle .= "text-align: center;";
		$this->discontinued->ViewCustomAttributes = "";

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

		// product_id
		$this->product_id->LinkCustomAttributes = "";
		$this->product_id->HrefValue = "";
		$this->product_id->TooltipValue = "";

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

		// discontinued
		$this->discontinued->LinkCustomAttributes = "";
		$this->discontinued->HrefValue = "";
		$this->discontinued->TooltipValue = "";

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

		// product_id
		$this->product_id->EditAttrs["class"] = "form-control";
		$this->product_id->EditCustomAttributes = "";
		$this->product_id->EditValue = $this->product_id->CurrentValue;
		$this->product_id->ViewCustomAttributes = "";

		// product_code
		$this->product_code->EditAttrs["class"] = "form-control";
		$this->product_code->EditCustomAttributes = "";
		$this->product_code->EditValue = $this->product_code->CurrentValue;
		$this->product_code->PlaceHolder = ew_RemoveHtml($this->product_code->FldCaption());

		// category_id
		$this->category_id->EditAttrs["class"] = "form-control";
		$this->category_id->EditCustomAttributes = "";
		$this->category_id->EditValue = $this->category_id->CurrentValue;
		$this->category_id->PlaceHolder = ew_RemoveHtml($this->category_id->FldCaption());

		// product_name
		$this->product_name->EditAttrs["class"] = "form-control";
		$this->product_name->EditCustomAttributes = "";
		$this->product_name->EditValue = $this->product_name->CurrentValue;
		$this->product_name->PlaceHolder = ew_RemoveHtml($this->product_name->FldCaption());

		// merk
		$this->merk->EditAttrs["class"] = "form-control";
		$this->merk->EditCustomAttributes = "";
		$this->merk->EditValue = $this->merk->CurrentValue;
		$this->merk->PlaceHolder = ew_RemoveHtml($this->merk->FldCaption());

		// supplier_id
		$this->supplier_id->EditAttrs["class"] = "form-control";
		$this->supplier_id->EditCustomAttributes = "";
		$this->supplier_id->EditValue = $this->supplier_id->CurrentValue;
		$this->supplier_id->PlaceHolder = ew_RemoveHtml($this->supplier_id->FldCaption());

		// unit_id
		$this->unit_id->EditAttrs["class"] = "form-control";
		$this->unit_id->EditCustomAttributes = "";
		$this->unit_id->EditValue = $this->unit_id->CurrentValue;
		$this->unit_id->PlaceHolder = ew_RemoveHtml($this->unit_id->FldCaption());

		// gramasi
		$this->gramasi->EditAttrs["class"] = "form-control";
		$this->gramasi->EditCustomAttributes = "";
		$this->gramasi->EditValue = $this->gramasi->CurrentValue;
		$this->gramasi->PlaceHolder = ew_RemoveHtml($this->gramasi->FldCaption());
		if (strval($this->gramasi->EditValue) <> "" && is_numeric($this->gramasi->EditValue)) $this->gramasi->EditValue = ew_FormatNumber($this->gramasi->EditValue, -2, -2, -2, -2);

		// avrg_unit_cost
		$this->avrg_unit_cost->EditAttrs["class"] = "form-control";
		$this->avrg_unit_cost->EditCustomAttributes = "";
		$this->avrg_unit_cost->EditValue = $this->avrg_unit_cost->CurrentValue;
		$this->avrg_unit_cost->PlaceHolder = ew_RemoveHtml($this->avrg_unit_cost->FldCaption());
		if (strval($this->avrg_unit_cost->EditValue) <> "" && is_numeric($this->avrg_unit_cost->EditValue)) $this->avrg_unit_cost->EditValue = ew_FormatNumber($this->avrg_unit_cost->EditValue, -2, -2, -2, -2);

		// unit_cost
		$this->unit_cost->EditAttrs["class"] = "form-control";
		$this->unit_cost->EditCustomAttributes = "";
		$this->unit_cost->EditValue = $this->unit_cost->CurrentValue;
		$this->unit_cost->PlaceHolder = ew_RemoveHtml($this->unit_cost->FldCaption());
		if (strval($this->unit_cost->EditValue) <> "" && is_numeric($this->unit_cost->EditValue)) $this->unit_cost->EditValue = ew_FormatNumber($this->unit_cost->EditValue, -2, -2, -2, -2);

		// unit_price
		$this->unit_price->EditAttrs["class"] = "form-control";
		$this->unit_price->EditCustomAttributes = "";
		$this->unit_price->EditValue = $this->unit_price->CurrentValue;
		$this->unit_price->PlaceHolder = ew_RemoveHtml($this->unit_price->FldCaption());
		if (strval($this->unit_price->EditValue) <> "" && is_numeric($this->unit_price->EditValue)) $this->unit_price->EditValue = ew_FormatNumber($this->unit_price->EditValue, -2, -2, -2, -2);

		// units_in_stock
		$this->units_in_stock->EditAttrs["class"] = "form-control";
		$this->units_in_stock->EditCustomAttributes = "";
		$this->units_in_stock->EditValue = $this->units_in_stock->CurrentValue;
		$this->units_in_stock->PlaceHolder = ew_RemoveHtml($this->units_in_stock->FldCaption());
		if (strval($this->units_in_stock->EditValue) <> "" && is_numeric($this->units_in_stock->EditValue)) $this->units_in_stock->EditValue = ew_FormatNumber($this->units_in_stock->EditValue, -2, -1, -2, 0);

		// units_on_order
		$this->units_on_order->EditAttrs["class"] = "form-control";
		$this->units_on_order->EditCustomAttributes = "";
		$this->units_on_order->EditValue = $this->units_on_order->CurrentValue;
		$this->units_on_order->PlaceHolder = ew_RemoveHtml($this->units_on_order->FldCaption());
		if (strval($this->units_on_order->EditValue) <> "" && is_numeric($this->units_on_order->EditValue)) $this->units_on_order->EditValue = ew_FormatNumber($this->units_on_order->EditValue, -2, -1, -2, 0);

		// reorder_level
		$this->reorder_level->EditAttrs["class"] = "form-control";
		$this->reorder_level->EditCustomAttributes = "";
		$this->reorder_level->EditValue = $this->reorder_level->CurrentValue;
		$this->reorder_level->PlaceHolder = ew_RemoveHtml($this->reorder_level->FldCaption());
		if (strval($this->reorder_level->EditValue) <> "" && is_numeric($this->reorder_level->EditValue)) $this->reorder_level->EditValue = ew_FormatNumber($this->reorder_level->EditValue, -2, -1, -2, 0);

		// discontinued
		$this->discontinued->EditCustomAttributes = "";
		$this->discontinued->EditValue = $this->discontinued->Options(FALSE);

		// saldo_awal
		$this->saldo_awal->EditAttrs["class"] = "form-control";
		$this->saldo_awal->EditCustomAttributes = "";
		$this->saldo_awal->EditValue = $this->saldo_awal->CurrentValue;
		$this->saldo_awal->PlaceHolder = ew_RemoveHtml($this->saldo_awal->FldCaption());
		if (strval($this->saldo_awal->EditValue) <> "" && is_numeric($this->saldo_awal->EditValue)) $this->saldo_awal->EditValue = ew_FormatNumber($this->saldo_awal->EditValue, -2, -1, -2, 0);

		// saldo_awal_nominal
		$this->saldo_awal_nominal->EditAttrs["class"] = "form-control";
		$this->saldo_awal_nominal->EditCustomAttributes = "";
		$this->saldo_awal_nominal->EditValue = $this->saldo_awal_nominal->CurrentValue;
		$this->saldo_awal_nominal->PlaceHolder = ew_RemoveHtml($this->saldo_awal_nominal->FldCaption());
		if (strval($this->saldo_awal_nominal->EditValue) <> "" && is_numeric($this->saldo_awal_nominal->EditValue)) $this->saldo_awal_nominal->EditValue = ew_FormatNumber($this->saldo_awal_nominal->EditValue, -2, -1, -2, 0);

		// user_id
		$this->user_id->EditAttrs["class"] = "form-control";
		$this->user_id->EditCustomAttributes = "";
		$this->user_id->EditValue = $this->user_id->CurrentValue;
		$this->user_id->PlaceHolder = ew_RemoveHtml($this->user_id->FldCaption());

		// lastupdate
		$this->lastupdate->EditAttrs["class"] = "form-control";
		$this->lastupdate->EditCustomAttributes = "";
		$this->lastupdate->EditValue = ew_FormatDateTime($this->lastupdate->CurrentValue, 8);
		$this->lastupdate->PlaceHolder = ew_RemoveHtml($this->lastupdate->FldCaption());

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
					if ($this->product_id->Exportable) $Doc->ExportCaption($this->product_id);
					if ($this->product_code->Exportable) $Doc->ExportCaption($this->product_code);
					if ($this->category_id->Exportable) $Doc->ExportCaption($this->category_id);
					if ($this->product_name->Exportable) $Doc->ExportCaption($this->product_name);
					if ($this->merk->Exportable) $Doc->ExportCaption($this->merk);
					if ($this->supplier_id->Exportable) $Doc->ExportCaption($this->supplier_id);
					if ($this->unit_id->Exportable) $Doc->ExportCaption($this->unit_id);
					if ($this->gramasi->Exportable) $Doc->ExportCaption($this->gramasi);
					if ($this->avrg_unit_cost->Exportable) $Doc->ExportCaption($this->avrg_unit_cost);
					if ($this->unit_cost->Exportable) $Doc->ExportCaption($this->unit_cost);
					if ($this->unit_price->Exportable) $Doc->ExportCaption($this->unit_price);
					if ($this->units_in_stock->Exportable) $Doc->ExportCaption($this->units_in_stock);
					if ($this->units_on_order->Exportable) $Doc->ExportCaption($this->units_on_order);
					if ($this->reorder_level->Exportable) $Doc->ExportCaption($this->reorder_level);
					if ($this->saldo_awal->Exportable) $Doc->ExportCaption($this->saldo_awal);
					if ($this->saldo_awal_nominal->Exportable) $Doc->ExportCaption($this->saldo_awal_nominal);
					if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
					if ($this->lastupdate->Exportable) $Doc->ExportCaption($this->lastupdate);
				} else {
					if ($this->product_id->Exportable) $Doc->ExportCaption($this->product_id);
					if ($this->product_code->Exportable) $Doc->ExportCaption($this->product_code);
					if ($this->category_id->Exportable) $Doc->ExportCaption($this->category_id);
					if ($this->product_name->Exportable) $Doc->ExportCaption($this->product_name);
					if ($this->merk->Exportable) $Doc->ExportCaption($this->merk);
					if ($this->supplier_id->Exportable) $Doc->ExportCaption($this->supplier_id);
					if ($this->unit_id->Exportable) $Doc->ExportCaption($this->unit_id);
					if ($this->gramasi->Exportable) $Doc->ExportCaption($this->gramasi);
					if ($this->avrg_unit_cost->Exportable) $Doc->ExportCaption($this->avrg_unit_cost);
					if ($this->unit_cost->Exportable) $Doc->ExportCaption($this->unit_cost);
					if ($this->unit_price->Exportable) $Doc->ExportCaption($this->unit_price);
					if ($this->units_in_stock->Exportable) $Doc->ExportCaption($this->units_in_stock);
					if ($this->units_on_order->Exportable) $Doc->ExportCaption($this->units_on_order);
					if ($this->reorder_level->Exportable) $Doc->ExportCaption($this->reorder_level);
					if ($this->saldo_awal->Exportable) $Doc->ExportCaption($this->saldo_awal);
					if ($this->saldo_awal_nominal->Exportable) $Doc->ExportCaption($this->saldo_awal_nominal);
					if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
					if ($this->lastupdate->Exportable) $Doc->ExportCaption($this->lastupdate);
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
						if ($this->product_id->Exportable) $Doc->ExportField($this->product_id);
						if ($this->product_code->Exportable) $Doc->ExportField($this->product_code);
						if ($this->category_id->Exportable) $Doc->ExportField($this->category_id);
						if ($this->product_name->Exportable) $Doc->ExportField($this->product_name);
						if ($this->merk->Exportable) $Doc->ExportField($this->merk);
						if ($this->supplier_id->Exportable) $Doc->ExportField($this->supplier_id);
						if ($this->unit_id->Exportable) $Doc->ExportField($this->unit_id);
						if ($this->gramasi->Exportable) $Doc->ExportField($this->gramasi);
						if ($this->avrg_unit_cost->Exportable) $Doc->ExportField($this->avrg_unit_cost);
						if ($this->unit_cost->Exportable) $Doc->ExportField($this->unit_cost);
						if ($this->unit_price->Exportable) $Doc->ExportField($this->unit_price);
						if ($this->units_in_stock->Exportable) $Doc->ExportField($this->units_in_stock);
						if ($this->units_on_order->Exportable) $Doc->ExportField($this->units_on_order);
						if ($this->reorder_level->Exportable) $Doc->ExportField($this->reorder_level);
						if ($this->saldo_awal->Exportable) $Doc->ExportField($this->saldo_awal);
						if ($this->saldo_awal_nominal->Exportable) $Doc->ExportField($this->saldo_awal_nominal);
						if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
						if ($this->lastupdate->Exportable) $Doc->ExportField($this->lastupdate);
					} else {
						if ($this->product_id->Exportable) $Doc->ExportField($this->product_id);
						if ($this->product_code->Exportable) $Doc->ExportField($this->product_code);
						if ($this->category_id->Exportable) $Doc->ExportField($this->category_id);
						if ($this->product_name->Exportable) $Doc->ExportField($this->product_name);
						if ($this->merk->Exportable) $Doc->ExportField($this->merk);
						if ($this->supplier_id->Exportable) $Doc->ExportField($this->supplier_id);
						if ($this->unit_id->Exportable) $Doc->ExportField($this->unit_id);
						if ($this->gramasi->Exportable) $Doc->ExportField($this->gramasi);
						if ($this->avrg_unit_cost->Exportable) $Doc->ExportField($this->avrg_unit_cost);
						if ($this->unit_cost->Exportable) $Doc->ExportField($this->unit_cost);
						if ($this->unit_price->Exportable) $Doc->ExportField($this->unit_price);
						if ($this->units_in_stock->Exportable) $Doc->ExportField($this->units_in_stock);
						if ($this->units_on_order->Exportable) $Doc->ExportField($this->units_on_order);
						if ($this->reorder_level->Exportable) $Doc->ExportField($this->reorder_level);
						if ($this->saldo_awal->Exportable) $Doc->ExportField($this->saldo_awal);
						if ($this->saldo_awal_nominal->Exportable) $Doc->ExportField($this->saldo_awal_nominal);
						if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
						if ($this->lastupdate->Exportable) $Doc->ExportField($this->lastupdate);
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
