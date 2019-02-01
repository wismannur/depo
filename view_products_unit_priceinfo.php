<?php

// Global variable for table object
$view_products_unit_price = NULL;

//
// Table class for view_products_unit_price
//
class cview_products_unit_price extends cTable {
	var $product_id;
	var $product_code;
	var $product_name;
	var $unit_id;
	var $unit_name;
	var $qty_in_unit;
	var $unit_cost;
	var $unit_price;
	var $udet_id;
	var $supplier_id;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'view_products_unit_price';
		$this->TableName = 'view_products_unit_price';
		$this->TableType = 'LINKTABLE';

		// Update Table
		$this->UpdateTable = "`view_products_unit_price`";
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

		// product_id
		$this->product_id = new cField('view_products_unit_price', 'view_products_unit_price', 'x_product_id', 'product_id', '`product_id`', '`product_id`', 3, -1, FALSE, '`product_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->product_id->Sortable = TRUE; // Allow sort
		$this->product_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['product_id'] = &$this->product_id;

		// product_code
		$this->product_code = new cField('view_products_unit_price', 'view_products_unit_price', 'x_product_code', 'product_code', '`product_code`', '`product_code`', 200, -1, FALSE, '`product_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->product_code->Sortable = TRUE; // Allow sort
		$this->fields['product_code'] = &$this->product_code;

		// product_name
		$this->product_name = new cField('view_products_unit_price', 'view_products_unit_price', 'x_product_name', 'product_name', '`product_name`', '`product_name`', 200, -1, FALSE, '`product_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->product_name->Sortable = TRUE; // Allow sort
		$this->fields['product_name'] = &$this->product_name;

		// unit_id
		$this->unit_id = new cField('view_products_unit_price', 'view_products_unit_price', 'x_unit_id', 'unit_id', '`unit_id`', '`unit_id`', 200, -1, FALSE, '`unit_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->unit_id->Sortable = TRUE; // Allow sort
		$this->fields['unit_id'] = &$this->unit_id;

		// unit_name
		$this->unit_name = new cField('view_products_unit_price', 'view_products_unit_price', 'x_unit_name', 'unit_name', '`unit_name`', '`unit_name`', 200, -1, FALSE, '`unit_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->unit_name->Sortable = TRUE; // Allow sort
		$this->fields['unit_name'] = &$this->unit_name;

		// qty_in_unit
		$this->qty_in_unit = new cField('view_products_unit_price', 'view_products_unit_price', 'x_qty_in_unit', 'qty_in_unit', '`qty_in_unit`', '`qty_in_unit`', 2, -1, FALSE, '`qty_in_unit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qty_in_unit->Sortable = TRUE; // Allow sort
		$this->qty_in_unit->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['qty_in_unit'] = &$this->qty_in_unit;

		// unit_cost
		$this->unit_cost = new cField('view_products_unit_price', 'view_products_unit_price', 'x_unit_cost', 'unit_cost', '`unit_cost`', '`unit_cost`', 5, -1, FALSE, '`unit_cost`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->unit_cost->Sortable = TRUE; // Allow sort
		$this->unit_cost->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['unit_cost'] = &$this->unit_cost;

		// unit_price
		$this->unit_price = new cField('view_products_unit_price', 'view_products_unit_price', 'x_unit_price', 'unit_price', '`unit_price`', '`unit_price`', 131, -1, FALSE, '`unit_price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->unit_price->Sortable = TRUE; // Allow sort
		$this->unit_price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['unit_price'] = &$this->unit_price;

		// udet_id
		$this->udet_id = new cField('view_products_unit_price', 'view_products_unit_price', 'x_udet_id', 'udet_id', '`udet_id`', '`udet_id`', 3, -1, FALSE, '`udet_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->udet_id->Sortable = TRUE; // Allow sort
		$this->udet_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['udet_id'] = &$this->udet_id;

		// supplier_id
		$this->supplier_id = new cField('view_products_unit_price', 'view_products_unit_price', 'x_supplier_id', 'supplier_id', '`supplier_id`', '`supplier_id`', 3, -1, FALSE, '`supplier_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->supplier_id->Sortable = TRUE; // Allow sort
		$this->supplier_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['supplier_id'] = &$this->supplier_id;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`view_products_unit_price`";
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
			$this->product_id->setDbValue($conn->Insert_ID());
			$rs['product_id'] = $this->product_id->DbValue;

			// Get insert id if necessary
			$this->udet_id->setDbValue($conn->Insert_ID());
			$rs['udet_id'] = $this->udet_id->DbValue;
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
			if (array_key_exists('udet_id', $rs))
				ew_AddFilter($where, ew_QuotedName('udet_id', $this->DBID) . '=' . ew_QuotedValue($rs['udet_id'], $this->udet_id->FldDataType, $this->DBID));
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
		return "`product_id` = @product_id@ AND `udet_id` = @udet_id@";
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
		if (!is_numeric($this->udet_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->udet_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@udet_id@", ew_AdjustSql($this->udet_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "view_products_unit_pricelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "view_products_unit_priceview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "view_products_unit_priceedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "view_products_unit_priceadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "view_products_unit_pricelist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("view_products_unit_priceview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("view_products_unit_priceview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "view_products_unit_priceadd.php?" . $this->UrlParm($parm);
		else
			$url = "view_products_unit_priceadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("view_products_unit_priceedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("view_products_unit_priceadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("view_products_unit_pricedelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "product_id:" . ew_VarToJson($this->product_id->CurrentValue, "number", "'");
		$json .= ",udet_id:" . ew_VarToJson($this->udet_id->CurrentValue, "number", "'");
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
		if (!is_null($this->udet_id->CurrentValue)) {
			$sUrl .= "&udet_id=" . urlencode($this->udet_id->CurrentValue);
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
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode($EW_COMPOSITE_KEY_SEPARATOR, $arKeys[$i]);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = $_GET["key_m"];
			$cnt = count($arKeys);
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode($EW_COMPOSITE_KEY_SEPARATOR, $arKeys[$i]);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsPost();
			if ($isPost && isset($_POST["product_id"]))
				$arKey[] = $_POST["product_id"];
			elseif (isset($_GET["product_id"]))
				$arKey[] = $_GET["product_id"];
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["udet_id"]))
				$arKey[] = $_POST["udet_id"];
			elseif (isset($_GET["udet_id"]))
				$arKey[] = $_GET["udet_id"];
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) <> 2)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // product_id
					continue;
				if (!is_numeric($key[1])) // udet_id
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
			$this->product_id->CurrentValue = $key[0];
			$this->udet_id->CurrentValue = $key[1];
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
		$this->product_name->setDbValue($rs->fields('product_name'));
		$this->unit_id->setDbValue($rs->fields('unit_id'));
		$this->unit_name->setDbValue($rs->fields('unit_name'));
		$this->qty_in_unit->setDbValue($rs->fields('qty_in_unit'));
		$this->unit_cost->setDbValue($rs->fields('unit_cost'));
		$this->unit_price->setDbValue($rs->fields('unit_price'));
		$this->udet_id->setDbValue($rs->fields('udet_id'));
		$this->supplier_id->setDbValue($rs->fields('supplier_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// product_id
		// product_code
		// product_name
		// unit_id
		// unit_name
		// qty_in_unit
		// unit_cost
		// unit_price
		// udet_id
		// supplier_id
		// product_id

		$this->product_id->ViewValue = $this->product_id->CurrentValue;
		$this->product_id->ViewCustomAttributes = "";

		// product_code
		$this->product_code->ViewValue = $this->product_code->CurrentValue;
		$this->product_code->ViewCustomAttributes = "";

		// product_name
		$this->product_name->ViewValue = $this->product_name->CurrentValue;
		$this->product_name->ViewCustomAttributes = "";

		// unit_id
		$this->unit_id->ViewValue = $this->unit_id->CurrentValue;
		$this->unit_id->ViewCustomAttributes = "";

		// unit_name
		$this->unit_name->ViewValue = $this->unit_name->CurrentValue;
		$this->unit_name->ViewCustomAttributes = "";

		// qty_in_unit
		$this->qty_in_unit->ViewValue = $this->qty_in_unit->CurrentValue;
		$this->qty_in_unit->ViewCustomAttributes = "";

		// unit_cost
		$this->unit_cost->ViewValue = $this->unit_cost->CurrentValue;
		$this->unit_cost->ViewCustomAttributes = "";

		// unit_price
		$this->unit_price->ViewValue = $this->unit_price->CurrentValue;
		$this->unit_price->ViewCustomAttributes = "";

		// udet_id
		$this->udet_id->ViewValue = $this->udet_id->CurrentValue;
		$this->udet_id->ViewCustomAttributes = "";

		// supplier_id
		$this->supplier_id->ViewValue = $this->supplier_id->CurrentValue;
		$this->supplier_id->ViewCustomAttributes = "";

		// product_id
		$this->product_id->LinkCustomAttributes = "";
		$this->product_id->HrefValue = "";
		$this->product_id->TooltipValue = "";

		// product_code
		$this->product_code->LinkCustomAttributes = "";
		$this->product_code->HrefValue = "";
		$this->product_code->TooltipValue = "";

		// product_name
		$this->product_name->LinkCustomAttributes = "";
		$this->product_name->HrefValue = "";
		$this->product_name->TooltipValue = "";

		// unit_id
		$this->unit_id->LinkCustomAttributes = "";
		$this->unit_id->HrefValue = "";
		$this->unit_id->TooltipValue = "";

		// unit_name
		$this->unit_name->LinkCustomAttributes = "";
		$this->unit_name->HrefValue = "";
		$this->unit_name->TooltipValue = "";

		// qty_in_unit
		$this->qty_in_unit->LinkCustomAttributes = "";
		$this->qty_in_unit->HrefValue = "";
		$this->qty_in_unit->TooltipValue = "";

		// unit_cost
		$this->unit_cost->LinkCustomAttributes = "";
		$this->unit_cost->HrefValue = "";
		$this->unit_cost->TooltipValue = "";

		// unit_price
		$this->unit_price->LinkCustomAttributes = "";
		$this->unit_price->HrefValue = "";
		$this->unit_price->TooltipValue = "";

		// udet_id
		$this->udet_id->LinkCustomAttributes = "";
		$this->udet_id->HrefValue = "";
		$this->udet_id->TooltipValue = "";

		// supplier_id
		$this->supplier_id->LinkCustomAttributes = "";
		$this->supplier_id->HrefValue = "";
		$this->supplier_id->TooltipValue = "";

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

		// product_name
		$this->product_name->EditAttrs["class"] = "form-control";
		$this->product_name->EditCustomAttributes = "";
		$this->product_name->EditValue = $this->product_name->CurrentValue;
		$this->product_name->PlaceHolder = ew_RemoveHtml($this->product_name->FldCaption());

		// unit_id
		$this->unit_id->EditAttrs["class"] = "form-control";
		$this->unit_id->EditCustomAttributes = "";
		$this->unit_id->EditValue = $this->unit_id->CurrentValue;
		$this->unit_id->PlaceHolder = ew_RemoveHtml($this->unit_id->FldCaption());

		// unit_name
		$this->unit_name->EditAttrs["class"] = "form-control";
		$this->unit_name->EditCustomAttributes = "";
		$this->unit_name->EditValue = $this->unit_name->CurrentValue;
		$this->unit_name->PlaceHolder = ew_RemoveHtml($this->unit_name->FldCaption());

		// qty_in_unit
		$this->qty_in_unit->EditAttrs["class"] = "form-control";
		$this->qty_in_unit->EditCustomAttributes = "";
		$this->qty_in_unit->EditValue = $this->qty_in_unit->CurrentValue;
		$this->qty_in_unit->PlaceHolder = ew_RemoveHtml($this->qty_in_unit->FldCaption());

		// unit_cost
		$this->unit_cost->EditAttrs["class"] = "form-control";
		$this->unit_cost->EditCustomAttributes = "";
		$this->unit_cost->EditValue = $this->unit_cost->CurrentValue;
		$this->unit_cost->PlaceHolder = ew_RemoveHtml($this->unit_cost->FldCaption());
		if (strval($this->unit_cost->EditValue) <> "" && is_numeric($this->unit_cost->EditValue)) $this->unit_cost->EditValue = ew_FormatNumber($this->unit_cost->EditValue, -2, -1, -2, 0);

		// unit_price
		$this->unit_price->EditAttrs["class"] = "form-control";
		$this->unit_price->EditCustomAttributes = "";
		$this->unit_price->EditValue = $this->unit_price->CurrentValue;
		$this->unit_price->PlaceHolder = ew_RemoveHtml($this->unit_price->FldCaption());
		if (strval($this->unit_price->EditValue) <> "" && is_numeric($this->unit_price->EditValue)) $this->unit_price->EditValue = ew_FormatNumber($this->unit_price->EditValue, -2, -1, -2, 0);

		// udet_id
		$this->udet_id->EditAttrs["class"] = "form-control";
		$this->udet_id->EditCustomAttributes = "";
		$this->udet_id->EditValue = $this->udet_id->CurrentValue;
		$this->udet_id->ViewCustomAttributes = "";

		// supplier_id
		$this->supplier_id->EditAttrs["class"] = "form-control";
		$this->supplier_id->EditCustomAttributes = "";
		$this->supplier_id->EditValue = $this->supplier_id->CurrentValue;
		$this->supplier_id->PlaceHolder = ew_RemoveHtml($this->supplier_id->FldCaption());

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
					if ($this->product_name->Exportable) $Doc->ExportCaption($this->product_name);
					if ($this->unit_id->Exportable) $Doc->ExportCaption($this->unit_id);
					if ($this->unit_name->Exportable) $Doc->ExportCaption($this->unit_name);
					if ($this->qty_in_unit->Exportable) $Doc->ExportCaption($this->qty_in_unit);
					if ($this->unit_cost->Exportable) $Doc->ExportCaption($this->unit_cost);
					if ($this->unit_price->Exportable) $Doc->ExportCaption($this->unit_price);
					if ($this->udet_id->Exportable) $Doc->ExportCaption($this->udet_id);
					if ($this->supplier_id->Exportable) $Doc->ExportCaption($this->supplier_id);
				} else {
					if ($this->product_id->Exportable) $Doc->ExportCaption($this->product_id);
					if ($this->product_code->Exportable) $Doc->ExportCaption($this->product_code);
					if ($this->product_name->Exportable) $Doc->ExportCaption($this->product_name);
					if ($this->unit_id->Exportable) $Doc->ExportCaption($this->unit_id);
					if ($this->unit_name->Exportable) $Doc->ExportCaption($this->unit_name);
					if ($this->qty_in_unit->Exportable) $Doc->ExportCaption($this->qty_in_unit);
					if ($this->unit_cost->Exportable) $Doc->ExportCaption($this->unit_cost);
					if ($this->unit_price->Exportable) $Doc->ExportCaption($this->unit_price);
					if ($this->udet_id->Exportable) $Doc->ExportCaption($this->udet_id);
					if ($this->supplier_id->Exportable) $Doc->ExportCaption($this->supplier_id);
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
						if ($this->product_name->Exportable) $Doc->ExportField($this->product_name);
						if ($this->unit_id->Exportable) $Doc->ExportField($this->unit_id);
						if ($this->unit_name->Exportable) $Doc->ExportField($this->unit_name);
						if ($this->qty_in_unit->Exportable) $Doc->ExportField($this->qty_in_unit);
						if ($this->unit_cost->Exportable) $Doc->ExportField($this->unit_cost);
						if ($this->unit_price->Exportable) $Doc->ExportField($this->unit_price);
						if ($this->udet_id->Exportable) $Doc->ExportField($this->udet_id);
						if ($this->supplier_id->Exportable) $Doc->ExportField($this->supplier_id);
					} else {
						if ($this->product_id->Exportable) $Doc->ExportField($this->product_id);
						if ($this->product_code->Exportable) $Doc->ExportField($this->product_code);
						if ($this->product_name->Exportable) $Doc->ExportField($this->product_name);
						if ($this->unit_id->Exportable) $Doc->ExportField($this->unit_id);
						if ($this->unit_name->Exportable) $Doc->ExportField($this->unit_name);
						if ($this->qty_in_unit->Exportable) $Doc->ExportField($this->qty_in_unit);
						if ($this->unit_cost->Exportable) $Doc->ExportField($this->unit_cost);
						if ($this->unit_price->Exportable) $Doc->ExportField($this->unit_price);
						if ($this->udet_id->Exportable) $Doc->ExportField($this->udet_id);
						if ($this->supplier_id->Exportable) $Doc->ExportField($this->supplier_id);
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
