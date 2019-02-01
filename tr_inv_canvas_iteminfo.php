<?php

// Global variable for table object
$tr_inv_canvas_item = NULL;

//
// Table class for tr_inv_canvas_item
//
class ctr_inv_canvas_item extends cTable {
	var $master_id;
	var $row_id;
	var $item_id;
	var $item_code;
	var $udet_id;
	var $item_qty;
	var $item_name;
	var $item_price;
	var $item_disc;
	var $item_amt;
	var $unit_id;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tr_inv_canvas_item';
		$this->TableName = 'tr_inv_canvas_item';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tr_inv_canvas_item`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4; // Page size (PHPExcel only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// master_id
		$this->master_id = new cField('tr_inv_canvas_item', 'tr_inv_canvas_item', 'x_master_id', 'master_id', '`master_id`', '`master_id`', 3, -1, FALSE, '`master_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->master_id->Sortable = TRUE; // Allow sort
		$this->master_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['master_id'] = &$this->master_id;

		// row_id
		$this->row_id = new cField('tr_inv_canvas_item', 'tr_inv_canvas_item', 'x_row_id', 'row_id', '`row_id`', '`row_id`', 3, -1, FALSE, '`row_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->row_id->Sortable = TRUE; // Allow sort
		$this->row_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['row_id'] = &$this->row_id;

		// item_id
		$this->item_id = new cField('tr_inv_canvas_item', 'tr_inv_canvas_item', 'x_item_id', 'item_id', '`item_id`', '`item_id`', 3, -1, FALSE, '`item_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_id->Sortable = TRUE; // Allow sort
		$this->item_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['item_id'] = &$this->item_id;

		// item_code
		$this->item_code = new cField('tr_inv_canvas_item', 'tr_inv_canvas_item', 'x_item_code', 'item_code', '`item_code`', '`item_code`', 200, -1, FALSE, '`item_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_code->Sortable = TRUE; // Allow sort
		$this->fields['item_code'] = &$this->item_code;

		// udet_id
		$this->udet_id = new cField('tr_inv_canvas_item', 'tr_inv_canvas_item', 'x_udet_id', 'udet_id', '`udet_id`', '`udet_id`', 3, -1, FALSE, '`udet_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->udet_id->Sortable = TRUE; // Allow sort
		$this->udet_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->udet_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->udet_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['udet_id'] = &$this->udet_id;

		// item_qty
		$this->item_qty = new cField('tr_inv_canvas_item', 'tr_inv_canvas_item', 'x_item_qty', 'item_qty', '`item_qty`', '`item_qty`', 5, -1, FALSE, '`item_qty`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_qty->Sortable = TRUE; // Allow sort
		$this->item_qty->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['item_qty'] = &$this->item_qty;

		// item_name
		$this->item_name = new cField('tr_inv_canvas_item', 'tr_inv_canvas_item', 'x_item_name', 'item_name', '`item_name`', '`item_name`', 200, -1, FALSE, '`item_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->item_name->Sortable = TRUE; // Allow sort
		$this->fields['item_name'] = &$this->item_name;

		// item_price
		$this->item_price = new cField('tr_inv_canvas_item', 'tr_inv_canvas_item', 'x_item_price', 'item_price', '`item_price`', '`item_price`', 5, -1, FALSE, '`item_price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_price->Sortable = TRUE; // Allow sort
		$this->item_price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['item_price'] = &$this->item_price;

		// item_disc
		$this->item_disc = new cField('tr_inv_canvas_item', 'tr_inv_canvas_item', 'x_item_disc', 'item_disc', '`item_disc`', '`item_disc`', 5, -1, FALSE, '`item_disc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_disc->Sortable = TRUE; // Allow sort
		$this->item_disc->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['item_disc'] = &$this->item_disc;

		// item_amt
		$this->item_amt = new cField('tr_inv_canvas_item', 'tr_inv_canvas_item', 'x_item_amt', 'item_amt', '`item_qty`*(`item_price`-(\'item_price\'*`item_disc`/100))', '`item_qty`*(`item_price`-(\'item_price\'*`item_disc`/100))', 5, -1, FALSE, '`item_qty`*(`item_price`-(\'item_price\'*`item_disc`/100))', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_amt->FldIsCustom = TRUE; // Custom field
		$this->item_amt->Sortable = TRUE; // Allow sort
		$this->item_amt->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['item_amt'] = &$this->item_amt;

		// unit_id
		$this->unit_id = new cField('tr_inv_canvas_item', 'tr_inv_canvas_item', 'x_unit_id', 'unit_id', '`unit_id`', '`unit_id`', 200, -1, FALSE, '`unit_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->unit_id->Sortable = TRUE; // Allow sort
		$this->unit_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['unit_id'] = &$this->unit_id;
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

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function GetMasterFilter() {

		// Master filter
		$sMasterFilter = "";
		if ($this->getCurrentMasterTable() == "tr_inv_canvas_master") {
			if ($this->master_id->getSessionValue() <> "")
				$sMasterFilter .= "`inv_id`=" . ew_QuotedValue($this->master_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "tr_inv_canvas_master") {
			if ($this->master_id->getSessionValue() <> "")
				$sDetailFilter .= "`master_id`=" . ew_QuotedValue($this->master_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_tr_inv_canvas_master() {
		return "`inv_id`=@inv_id@";
	}

	// Detail filter
	function SqlDetailFilter_tr_inv_canvas_master() {
		return "`master_id`=@master_id@";
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tr_inv_canvas_item`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT *, `item_qty`*(`item_price`-('item_price'*`item_disc`/100)) AS `item_amt` FROM " . $this->getSqlFrom();
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`row_id` ASC";
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
			$this->row_id->setDbValue($conn->Insert_ID());
			$rs['row_id'] = $this->row_id->DbValue;
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
			if (array_key_exists('row_id', $rs))
				ew_AddFilter($where, ew_QuotedName('row_id', $this->DBID) . '=' . ew_QuotedValue($rs['row_id'], $this->row_id->FldDataType, $this->DBID));
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
		return "`row_id` = @row_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->row_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->row_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@row_id@", ew_AdjustSql($this->row_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "tr_inv_canvas_itemlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tr_inv_canvas_itemview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tr_inv_canvas_itemedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tr_inv_canvas_itemadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tr_inv_canvas_itemlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_inv_canvas_itemview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_inv_canvas_itemview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tr_inv_canvas_itemadd.php?" . $this->UrlParm($parm);
		else
			$url = "tr_inv_canvas_itemadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("tr_inv_canvas_itemedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("tr_inv_canvas_itemadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tr_inv_canvas_itemdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		if ($this->getCurrentMasterTable() == "tr_inv_canvas_master" && strpos($url, EW_TABLE_SHOW_MASTER . "=") === FALSE) {
			$url .= (strpos($url, "?") !== FALSE ? "&" : "?") . EW_TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_inv_id=" . urlencode($this->master_id->CurrentValue);
		}
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "row_id:" . ew_VarToJson($this->row_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->row_id->CurrentValue)) {
			$sUrl .= "row_id=" . urlencode($this->row_id->CurrentValue);
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
			if ($isPost && isset($_POST["row_id"]))
				$arKeys[] = $_POST["row_id"];
			elseif (isset($_GET["row_id"]))
				$arKeys[] = $_GET["row_id"];
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
			$this->row_id->CurrentValue = $key;
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
		$this->master_id->setDbValue($rs->fields('master_id'));
		$this->row_id->setDbValue($rs->fields('row_id'));
		$this->item_id->setDbValue($rs->fields('item_id'));
		$this->item_code->setDbValue($rs->fields('item_code'));
		$this->udet_id->setDbValue($rs->fields('udet_id'));
		$this->item_qty->setDbValue($rs->fields('item_qty'));
		$this->item_name->setDbValue($rs->fields('item_name'));
		$this->item_price->setDbValue($rs->fields('item_price'));
		$this->item_disc->setDbValue($rs->fields('item_disc'));
		$this->item_amt->setDbValue($rs->fields('item_amt'));
		$this->unit_id->setDbValue($rs->fields('unit_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// master_id
		// row_id
		// item_id
		// item_code
		// udet_id
		// item_qty
		// item_name
		// item_price
		// item_disc
		// item_amt
		// unit_id
		// master_id

		$this->master_id->ViewValue = $this->master_id->CurrentValue;
		$this->master_id->ViewCustomAttributes = "";

		// row_id
		$this->row_id->ViewValue = $this->row_id->CurrentValue;
		$this->row_id->ViewCustomAttributes = "";

		// item_id
		$this->item_id->ViewValue = $this->item_id->CurrentValue;
		if (strval($this->item_id->CurrentValue) <> "") {
			$sFilterWrk = "`product_id`" . ew_SearchString("=", $this->item_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT DISTINCT `product_id`, `product_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `view_products_unit_price`";
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

		// udet_id
		if (strval($this->udet_id->CurrentValue) <> "") {
			$sFilterWrk = "`udet_id`" . ew_SearchString("=", $this->udet_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `udet_id`, `unit_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_unit_detail`";
		$sWhereWrk = "";
		$this->udet_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->udet_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->udet_id->ViewValue = $this->udet_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->udet_id->ViewValue = $this->udet_id->CurrentValue;
			}
		} else {
			$this->udet_id->ViewValue = NULL;
		}
		$this->udet_id->ViewCustomAttributes = "";

		// item_qty
		$this->item_qty->ViewValue = $this->item_qty->CurrentValue;
		$this->item_qty->ViewValue = ew_FormatNumber($this->item_qty->ViewValue, 2, -2, -2, -2);
		$this->item_qty->CellCssStyle .= "text-align: right;";
		$this->item_qty->ViewCustomAttributes = "";

		// item_name
		$this->item_name->ViewValue = $this->item_name->CurrentValue;
		$this->item_name->ViewCustomAttributes = "";

		// item_price
		$this->item_price->ViewValue = $this->item_price->CurrentValue;
		$this->item_price->ViewValue = ew_FormatNumber($this->item_price->ViewValue, 0, -2, -2, -2);
		$this->item_price->CellCssStyle .= "text-align: right;";
		$this->item_price->ViewCustomAttributes = "";

		// item_disc
		$this->item_disc->ViewValue = $this->item_disc->CurrentValue;
		$this->item_disc->ViewValue = ew_FormatNumber($this->item_disc->ViewValue, 0, -2, -2, -2);
		$this->item_disc->CellCssStyle .= "text-align: right;";
		$this->item_disc->ViewCustomAttributes = "";

		// item_amt
		$this->item_amt->ViewValue = $this->item_amt->CurrentValue;
		$this->item_amt->ViewValue = ew_FormatNumber($this->item_amt->ViewValue, 2, -2, -2, -2);
		$this->item_amt->CellCssStyle .= "text-align: right;";
		$this->item_amt->ViewCustomAttributes = "";

		// unit_id
		$this->unit_id->ViewValue = $this->unit_id->CurrentValue;
		$this->unit_id->ViewCustomAttributes = "";

		// master_id
		$this->master_id->LinkCustomAttributes = "";
		$this->master_id->HrefValue = "";
		$this->master_id->TooltipValue = "";

		// row_id
		$this->row_id->LinkCustomAttributes = "";
		$this->row_id->HrefValue = "";
		$this->row_id->TooltipValue = "";

		// item_id
		$this->item_id->LinkCustomAttributes = "";
		$this->item_id->HrefValue = "";
		$this->item_id->TooltipValue = "";

		// item_code
		$this->item_code->LinkCustomAttributes = "";
		$this->item_code->HrefValue = "";
		$this->item_code->TooltipValue = "";

		// udet_id
		$this->udet_id->LinkCustomAttributes = "";
		$this->udet_id->HrefValue = "";
		$this->udet_id->TooltipValue = "";

		// item_qty
		$this->item_qty->LinkCustomAttributes = "";
		$this->item_qty->HrefValue = "";
		$this->item_qty->TooltipValue = "";

		// item_name
		$this->item_name->LinkCustomAttributes = "";
		$this->item_name->HrefValue = "";
		$this->item_name->TooltipValue = "";

		// item_price
		$this->item_price->LinkCustomAttributes = "";
		$this->item_price->HrefValue = "";
		$this->item_price->TooltipValue = "";

		// item_disc
		$this->item_disc->LinkCustomAttributes = "";
		$this->item_disc->HrefValue = "";
		$this->item_disc->TooltipValue = "";

		// item_amt
		$this->item_amt->LinkCustomAttributes = "";
		$this->item_amt->HrefValue = "";
		$this->item_amt->TooltipValue = "";

		// unit_id
		$this->unit_id->LinkCustomAttributes = "";
		$this->unit_id->HrefValue = "";
		$this->unit_id->TooltipValue = "";

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

		// master_id
		$this->master_id->EditAttrs["class"] = "form-control";
		$this->master_id->EditCustomAttributes = "";
		if ($this->master_id->getSessionValue() <> "") {
			$this->master_id->CurrentValue = $this->master_id->getSessionValue();
		$this->master_id->ViewValue = $this->master_id->CurrentValue;
		$this->master_id->ViewCustomAttributes = "";
		} else {
		$this->master_id->EditValue = $this->master_id->CurrentValue;
		$this->master_id->PlaceHolder = ew_RemoveHtml($this->master_id->FldCaption());
		}

		// row_id
		$this->row_id->EditAttrs["class"] = "form-control";
		$this->row_id->EditCustomAttributes = "";
		$this->row_id->EditValue = $this->row_id->CurrentValue;
		$this->row_id->ViewCustomAttributes = "";

		// item_id
		$this->item_id->EditAttrs["class"] = "form-control";
		$this->item_id->EditCustomAttributes = "";
		$this->item_id->EditValue = $this->item_id->CurrentValue;
		$this->item_id->PlaceHolder = ew_RemoveHtml($this->item_id->FldCaption());

		// item_code
		$this->item_code->EditAttrs["class"] = "form-control";
		$this->item_code->EditCustomAttributes = "";
		$this->item_code->EditValue = $this->item_code->CurrentValue;
		$this->item_code->PlaceHolder = ew_RemoveHtml($this->item_code->FldCaption());

		// udet_id
		$this->udet_id->EditCustomAttributes = "";

		// item_qty
		$this->item_qty->EditAttrs["class"] = "form-control";
		$this->item_qty->EditCustomAttributes = "";
		$this->item_qty->EditValue = $this->item_qty->CurrentValue;
		$this->item_qty->PlaceHolder = ew_RemoveHtml($this->item_qty->FldCaption());
		if (strval($this->item_qty->EditValue) <> "" && is_numeric($this->item_qty->EditValue)) $this->item_qty->EditValue = ew_FormatNumber($this->item_qty->EditValue, -2, -2, -2, -2);

		// item_name
		$this->item_name->EditAttrs["class"] = "form-control";
		$this->item_name->EditCustomAttributes = "";

		// item_price
		$this->item_price->EditAttrs["class"] = "form-control";
		$this->item_price->EditCustomAttributes = "";
		$this->item_price->EditValue = $this->item_price->CurrentValue;
		$this->item_price->PlaceHolder = ew_RemoveHtml($this->item_price->FldCaption());
		if (strval($this->item_price->EditValue) <> "" && is_numeric($this->item_price->EditValue)) $this->item_price->EditValue = ew_FormatNumber($this->item_price->EditValue, -2, -2, -2, -2);

		// item_disc
		$this->item_disc->EditAttrs["class"] = "form-control";
		$this->item_disc->EditCustomAttributes = "";
		$this->item_disc->EditValue = $this->item_disc->CurrentValue;
		$this->item_disc->PlaceHolder = ew_RemoveHtml($this->item_disc->FldCaption());
		if (strval($this->item_disc->EditValue) <> "" && is_numeric($this->item_disc->EditValue)) $this->item_disc->EditValue = ew_FormatNumber($this->item_disc->EditValue, -2, -2, -2, -2);

		// item_amt
		$this->item_amt->EditAttrs["class"] = "form-control";
		$this->item_amt->EditCustomAttributes = "";
		$this->item_amt->EditValue = $this->item_amt->CurrentValue;
		$this->item_amt->PlaceHolder = ew_RemoveHtml($this->item_amt->FldCaption());
		if (strval($this->item_amt->EditValue) <> "" && is_numeric($this->item_amt->EditValue)) $this->item_amt->EditValue = ew_FormatNumber($this->item_amt->EditValue, -2, -2, -2, -2);

		// unit_id
		$this->unit_id->EditAttrs["class"] = "form-control";
		$this->unit_id->EditCustomAttributes = "";
		$this->unit_id->EditValue = $this->unit_id->CurrentValue;
		$this->unit_id->PlaceHolder = ew_RemoveHtml($this->unit_id->FldCaption());

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
					if ($this->master_id->Exportable) $Doc->ExportCaption($this->master_id);
					if ($this->row_id->Exportable) $Doc->ExportCaption($this->row_id);
					if ($this->item_id->Exportable) $Doc->ExportCaption($this->item_id);
					if ($this->item_code->Exportable) $Doc->ExportCaption($this->item_code);
					if ($this->udet_id->Exportable) $Doc->ExportCaption($this->udet_id);
					if ($this->item_qty->Exportable) $Doc->ExportCaption($this->item_qty);
					if ($this->item_name->Exportable) $Doc->ExportCaption($this->item_name);
					if ($this->item_price->Exportable) $Doc->ExportCaption($this->item_price);
					if ($this->item_disc->Exportable) $Doc->ExportCaption($this->item_disc);
					if ($this->item_amt->Exportable) $Doc->ExportCaption($this->item_amt);
					if ($this->unit_id->Exportable) $Doc->ExportCaption($this->unit_id);
				} else {
					if ($this->master_id->Exportable) $Doc->ExportCaption($this->master_id);
					if ($this->row_id->Exportable) $Doc->ExportCaption($this->row_id);
					if ($this->item_id->Exportable) $Doc->ExportCaption($this->item_id);
					if ($this->item_code->Exportable) $Doc->ExportCaption($this->item_code);
					if ($this->udet_id->Exportable) $Doc->ExportCaption($this->udet_id);
					if ($this->item_qty->Exportable) $Doc->ExportCaption($this->item_qty);
					if ($this->item_name->Exportable) $Doc->ExportCaption($this->item_name);
					if ($this->item_price->Exportable) $Doc->ExportCaption($this->item_price);
					if ($this->item_disc->Exportable) $Doc->ExportCaption($this->item_disc);
					if ($this->item_amt->Exportable) $Doc->ExportCaption($this->item_amt);
					if ($this->unit_id->Exportable) $Doc->ExportCaption($this->unit_id);
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
						if ($this->master_id->Exportable) $Doc->ExportField($this->master_id);
						if ($this->row_id->Exportable) $Doc->ExportField($this->row_id);
						if ($this->item_id->Exportable) $Doc->ExportField($this->item_id);
						if ($this->item_code->Exportable) $Doc->ExportField($this->item_code);
						if ($this->udet_id->Exportable) $Doc->ExportField($this->udet_id);
						if ($this->item_qty->Exportable) $Doc->ExportField($this->item_qty);
						if ($this->item_name->Exportable) $Doc->ExportField($this->item_name);
						if ($this->item_price->Exportable) $Doc->ExportField($this->item_price);
						if ($this->item_disc->Exportable) $Doc->ExportField($this->item_disc);
						if ($this->item_amt->Exportable) $Doc->ExportField($this->item_amt);
						if ($this->unit_id->Exportable) $Doc->ExportField($this->unit_id);
					} else {
						if ($this->master_id->Exportable) $Doc->ExportField($this->master_id);
						if ($this->row_id->Exportable) $Doc->ExportField($this->row_id);
						if ($this->item_id->Exportable) $Doc->ExportField($this->item_id);
						if ($this->item_code->Exportable) $Doc->ExportField($this->item_code);
						if ($this->udet_id->Exportable) $Doc->ExportField($this->udet_id);
						if ($this->item_qty->Exportable) $Doc->ExportField($this->item_qty);
						if ($this->item_name->Exportable) $Doc->ExportField($this->item_name);
						if ($this->item_price->Exportable) $Doc->ExportField($this->item_price);
						if ($this->item_disc->Exportable) $Doc->ExportField($this->item_disc);
						if ($this->item_amt->Exportable) $Doc->ExportField($this->item_amt);
						if ($this->unit_id->Exportable) $Doc->ExportField($this->unit_id);
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
		if (preg_match('/^x(\d)*_item_id$/', $id)) {
			$conn = &Conn('db_inventory_pusat');
			$sSqlWrk = "SELECT `product_code` AS FIELD0, `unit_id` AS FIELD1, `product_name` AS FIELD2, `unit_price` AS FIELD3, `udet_id` AS FIELD4 FROM `view_products_unit_price`";
			$sWhereWrk = "(`product_id` = " . ew_QuotedValue($val, EW_DATATYPE_NUMBER, $this->DBID) . ")";
			$this->item_id->LookupFilters = array();
			$this->Lookup_Selecting($this->item_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `product_name`";
			if ($rs = ew_LoadRecordset($sSqlWrk, $conn)) {
				while ($rs && !$rs->EOF) {
					$ar = array();
					$this->item_code->setDbValue($rs->fields[0]);
					$this->unit_id->setDbValue($rs->fields[1]);
					$this->item_name->setDbValue($rs->fields[2]);
					$this->item_price->setDbValue($rs->fields[3]);
					$this->udet_id->setDbValue($rs->fields[4]);
					$this->RowType == EW_ROWTYPE_EDIT;
					$this->RenderEditRow();
					$ar[] = ($this->item_code->AutoFillOriginalValue) ? $this->item_code->CurrentValue : $this->item_code->EditValue;
					$ar[] = ($this->unit_id->AutoFillOriginalValue) ? $this->unit_id->CurrentValue : $this->unit_id->EditValue;
					$ar[] = $this->item_name->CurrentValue;
					$ar[] = ($this->item_price->AutoFillOriginalValue) ? $this->item_price->CurrentValue : $this->item_price->EditValue;
					$ar[] = $this->udet_id->CurrentValue;
					$rowcnt += 1;
					$rsarr[] = $ar;
					$rs->MoveNext();
				}
				$rs->Close();
			}
		}
		if (preg_match('/^x(\d)*_udet_id$/', $id)) {
			$conn = &Conn('db_inventory_pusat');
			$sSqlWrk = "SELECT `unit_id` AS FIELD0, `unit_price` AS FIELD1 FROM `tbl_unit_detail`";
			$sWhereWrk = "(`udet_id` = " . ew_QuotedValue($val, EW_DATATYPE_NUMBER, $this->DBID) . ")";
			$this->udet_id->LookupFilters = array();
			$this->Lookup_Selecting($this->udet_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($rs = ew_LoadRecordset($sSqlWrk, $conn)) {
				while ($rs && !$rs->EOF) {
					$ar = array();
					$this->unit_id->setDbValue($rs->fields[0]);
					$this->item_price->setDbValue($rs->fields[1]);
					$this->RowType == EW_ROWTYPE_EDIT;
					$this->RenderEditRow();
					$ar[] = ($this->unit_id->AutoFillOriginalValue) ? $this->unit_id->CurrentValue : $this->unit_id->EditValue;
					$ar[] = ($this->item_price->AutoFillOriginalValue) ? $this->item_price->CurrentValue : $this->item_price->EditValue;
					$rowcnt += 1;
					$rsarr[] = $ar;
					$rs->MoveNext();
				}
				$rs->Close();
			}
		}

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
