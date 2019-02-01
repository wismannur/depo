<?php

// Global variable for table object
$tr_retc_master = NULL;

//
// Table class for tr_retc_master
//
class ctr_retc_master extends cTable {
	var $retc_id;
	var $retc_number;
	var $retc_date;
	var $sjc_number;
	var $kode_depo;
	var $retc_notes;
	var $sales_id;
	var $user_id;
	var $lastupdate;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tr_retc_master';
		$this->TableName = 'tr_retc_master';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tr_retc_master`";
		$this->DBID = 'DB';
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

		// retc_id
		$this->retc_id = new cField('tr_retc_master', 'tr_retc_master', 'x_retc_id', 'retc_id', '`retc_id`', '`retc_id`', 3, -1, FALSE, '`retc_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->retc_id->Sortable = TRUE; // Allow sort
		$this->retc_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['retc_id'] = &$this->retc_id;

		// retc_number
		$this->retc_number = new cField('tr_retc_master', 'tr_retc_master', 'x_retc_number', 'retc_number', '`retc_number`', '`retc_number`', 200, -1, FALSE, '`retc_number`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->retc_number->Sortable = TRUE; // Allow sort
		$this->fields['retc_number'] = &$this->retc_number;

		// retc_date
		$this->retc_date = new cField('tr_retc_master', 'tr_retc_master', 'x_retc_date', 'retc_date', '`retc_date`', ew_CastDateFieldForLike('`retc_date`', 0, "DB"), 133, 0, FALSE, '`retc_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->retc_date->Sortable = TRUE; // Allow sort
		$this->retc_date->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['retc_date'] = &$this->retc_date;

		// sjc_number
		$this->sjc_number = new cField('tr_retc_master', 'tr_retc_master', 'x_sjc_number', 'sjc_number', '`sjc_number`', '`sjc_number`', 200, -1, FALSE, '`sjc_number`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->sjc_number->Sortable = TRUE; // Allow sort
		$this->sjc_number->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->sjc_number->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['sjc_number'] = &$this->sjc_number;

		// kode_depo
		$this->kode_depo = new cField('tr_retc_master', 'tr_retc_master', 'x_kode_depo', 'kode_depo', '`kode_depo`', '`kode_depo`', 200, -1, FALSE, '`kode_depo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_depo->Sortable = TRUE; // Allow sort
		$this->fields['kode_depo'] = &$this->kode_depo;

		// retc_notes
		$this->retc_notes = new cField('tr_retc_master', 'tr_retc_master', 'x_retc_notes', 'retc_notes', '`retc_notes`', '`retc_notes`', 200, -1, FALSE, '`retc_notes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->retc_notes->Sortable = TRUE; // Allow sort
		$this->fields['retc_notes'] = &$this->retc_notes;

		// sales_id
		$this->sales_id = new cField('tr_retc_master', 'tr_retc_master', 'x_sales_id', 'sales_id', '`sales_id`', '`sales_id`', 3, -1, FALSE, '`sales_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->sales_id->Sortable = TRUE; // Allow sort
		$this->sales_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->sales_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->sales_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sales_id'] = &$this->sales_id;

		// user_id
		$this->user_id = new cField('tr_retc_master', 'tr_retc_master', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 3, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_id->Sortable = TRUE; // Allow sort
		$this->user_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['user_id'] = &$this->user_id;

		// lastupdate
		$this->lastupdate = new cField('tr_retc_master', 'tr_retc_master', 'x_lastupdate', 'lastupdate', '`lastupdate`', ew_CastDateFieldForLike('`lastupdate`', 0, "DB"), 135, 0, FALSE, '`lastupdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		if ($this->getCurrentDetailTable() == "tr_retc_item") {
			$sDetailUrl = $GLOBALS["tr_retc_item"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_retc_id=" . urlencode($this->retc_id->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "tr_retc_masterlist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tr_retc_master`";
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
		$this->TableFilter = "`kode_depo` ='".@$_SESSION["KodeDepo"]."'";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`retc_number` DESC";
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
			$this->retc_id->setDbValue($conn->Insert_ID());
			$rs['retc_id'] = $this->retc_id->DbValue;
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
			if (array_key_exists('retc_id', $rs))
				ew_AddFilter($where, ew_QuotedName('retc_id', $this->DBID) . '=' . ew_QuotedValue($rs['retc_id'], $this->retc_id->FldDataType, $this->DBID));
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
		return "`retc_id` = @retc_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->retc_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->retc_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@retc_id@", ew_AdjustSql($this->retc_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "tr_retc_masterlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tr_retc_masterview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tr_retc_masteredit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tr_retc_masteradd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tr_retc_masterlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_retc_masterview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_retc_masterview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tr_retc_masteradd.php?" . $this->UrlParm($parm);
		else
			$url = "tr_retc_masteradd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_retc_masteredit.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_retc_masteredit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
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
			$url = $this->KeyUrl("tr_retc_masteradd.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_retc_masteradd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tr_retc_masterdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "retc_id:" . ew_VarToJson($this->retc_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->retc_id->CurrentValue)) {
			$sUrl .= "retc_id=" . urlencode($this->retc_id->CurrentValue);
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
			if ($isPost && isset($_POST["retc_id"]))
				$arKeys[] = $_POST["retc_id"];
			elseif (isset($_GET["retc_id"]))
				$arKeys[] = $_GET["retc_id"];
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
			$this->retc_id->CurrentValue = $key;
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
		$this->retc_id->setDbValue($rs->fields('retc_id'));
		$this->retc_number->setDbValue($rs->fields('retc_number'));
		$this->retc_date->setDbValue($rs->fields('retc_date'));
		$this->sjc_number->setDbValue($rs->fields('sjc_number'));
		$this->kode_depo->setDbValue($rs->fields('kode_depo'));
		$this->retc_notes->setDbValue($rs->fields('retc_notes'));
		$this->sales_id->setDbValue($rs->fields('sales_id'));
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->lastupdate->setDbValue($rs->fields('lastupdate'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// retc_id
		// retc_number
		// retc_date
		// sjc_number
		// kode_depo
		// retc_notes
		// sales_id
		// user_id
		// lastupdate
		// retc_id

		$this->retc_id->ViewValue = $this->retc_id->CurrentValue;
		$this->retc_id->ViewCustomAttributes = "";

		// retc_number
		$this->retc_number->ViewValue = $this->retc_number->CurrentValue;
		$this->retc_number->ViewCustomAttributes = "";

		// retc_date
		$this->retc_date->ViewValue = $this->retc_date->CurrentValue;
		$this->retc_date->ViewValue = ew_FormatDateTime($this->retc_date->ViewValue, 0);
		$this->retc_date->ViewCustomAttributes = "";

		// sjc_number
		if (strval($this->sjc_number->CurrentValue) <> "") {
			$sFilterWrk = "`sjc_number`" . ew_SearchString("=", $this->sjc_number->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `sjc_number`, `sjc_number` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tr_sjc_master`";
		$sWhereWrk = "";
		$this->sjc_number->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->sjc_number, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->sjc_number->ViewValue = $this->sjc_number->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->sjc_number->ViewValue = $this->sjc_number->CurrentValue;
			}
		} else {
			$this->sjc_number->ViewValue = NULL;
		}
		$this->sjc_number->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// retc_notes
		$this->retc_notes->ViewValue = $this->retc_notes->CurrentValue;
		$this->retc_notes->ViewCustomAttributes = "";

		// sales_id
		if (strval($this->sales_id->CurrentValue) <> "") {
			$sFilterWrk = "`sales_id`" . ew_SearchString("=", $this->sales_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `sales_id`, `sales_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_salesman`";
		$sWhereWrk = "";
		$this->sales_id->LookupFilters = array();
		$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->sales_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `sales_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->sales_id->ViewValue = $this->sales_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->sales_id->ViewValue = $this->sales_id->CurrentValue;
			}
		} else {
			$this->sales_id->ViewValue = NULL;
		}
		$this->sales_id->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// lastupdate
		$this->lastupdate->ViewValue = $this->lastupdate->CurrentValue;
		$this->lastupdate->ViewValue = ew_FormatDateTime($this->lastupdate->ViewValue, 0);
		$this->lastupdate->ViewCustomAttributes = "";

		// retc_id
		$this->retc_id->LinkCustomAttributes = "";
		$this->retc_id->HrefValue = "";
		$this->retc_id->TooltipValue = "";

		// retc_number
		$this->retc_number->LinkCustomAttributes = "";
		$this->retc_number->HrefValue = "";
		$this->retc_number->TooltipValue = "";

		// retc_date
		$this->retc_date->LinkCustomAttributes = "";
		$this->retc_date->HrefValue = "";
		$this->retc_date->TooltipValue = "";

		// sjc_number
		$this->sjc_number->LinkCustomAttributes = "";
		$this->sjc_number->HrefValue = "";
		$this->sjc_number->TooltipValue = "";

		// kode_depo
		$this->kode_depo->LinkCustomAttributes = "";
		$this->kode_depo->HrefValue = "";
		$this->kode_depo->TooltipValue = "";

		// retc_notes
		$this->retc_notes->LinkCustomAttributes = "";
		$this->retc_notes->HrefValue = "";
		$this->retc_notes->TooltipValue = "";

		// sales_id
		$this->sales_id->LinkCustomAttributes = "";
		$this->sales_id->HrefValue = "";
		$this->sales_id->TooltipValue = "";

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

		// retc_id
		$this->retc_id->EditAttrs["class"] = "form-control";
		$this->retc_id->EditCustomAttributes = "";
		$this->retc_id->EditValue = $this->retc_id->CurrentValue;
		$this->retc_id->ViewCustomAttributes = "";

		// retc_number
		$this->retc_number->EditAttrs["class"] = "form-control";
		$this->retc_number->EditCustomAttributes = "";
		$this->retc_number->EditValue = $this->retc_number->CurrentValue;
		$this->retc_number->PlaceHolder = ew_RemoveHtml($this->retc_number->FldCaption());

		// retc_date
		$this->retc_date->EditAttrs["class"] = "form-control";
		$this->retc_date->EditCustomAttributes = "";
		$this->retc_date->EditValue = ew_FormatDateTime($this->retc_date->CurrentValue, 8);
		$this->retc_date->PlaceHolder = ew_RemoveHtml($this->retc_date->FldCaption());

		// sjc_number
		$this->sjc_number->EditCustomAttributes = "";

		// kode_depo
		$this->kode_depo->EditAttrs["class"] = "form-control";
		$this->kode_depo->EditCustomAttributes = "";
		$this->kode_depo->EditValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->PlaceHolder = ew_RemoveHtml($this->kode_depo->FldCaption());

		// retc_notes
		$this->retc_notes->EditAttrs["class"] = "form-control";
		$this->retc_notes->EditCustomAttributes = "";
		$this->retc_notes->EditValue = $this->retc_notes->CurrentValue;
		$this->retc_notes->PlaceHolder = ew_RemoveHtml($this->retc_notes->FldCaption());

		// sales_id
		$this->sales_id->EditCustomAttributes = "";

		// user_id
		// lastupdate
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
					if ($this->retc_id->Exportable) $Doc->ExportCaption($this->retc_id);
					if ($this->retc_number->Exportable) $Doc->ExportCaption($this->retc_number);
					if ($this->retc_date->Exportable) $Doc->ExportCaption($this->retc_date);
					if ($this->sjc_number->Exportable) $Doc->ExportCaption($this->sjc_number);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
					if ($this->retc_notes->Exportable) $Doc->ExportCaption($this->retc_notes);
					if ($this->sales_id->Exportable) $Doc->ExportCaption($this->sales_id);
					if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
					if ($this->lastupdate->Exportable) $Doc->ExportCaption($this->lastupdate);
				} else {
					if ($this->retc_id->Exportable) $Doc->ExportCaption($this->retc_id);
					if ($this->retc_number->Exportable) $Doc->ExportCaption($this->retc_number);
					if ($this->retc_date->Exportable) $Doc->ExportCaption($this->retc_date);
					if ($this->sjc_number->Exportable) $Doc->ExportCaption($this->sjc_number);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
					if ($this->retc_notes->Exportable) $Doc->ExportCaption($this->retc_notes);
					if ($this->sales_id->Exportable) $Doc->ExportCaption($this->sales_id);
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
						if ($this->retc_id->Exportable) $Doc->ExportField($this->retc_id);
						if ($this->retc_number->Exportable) $Doc->ExportField($this->retc_number);
						if ($this->retc_date->Exportable) $Doc->ExportField($this->retc_date);
						if ($this->sjc_number->Exportable) $Doc->ExportField($this->sjc_number);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
						if ($this->retc_notes->Exportable) $Doc->ExportField($this->retc_notes);
						if ($this->sales_id->Exportable) $Doc->ExportField($this->sales_id);
						if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
						if ($this->lastupdate->Exportable) $Doc->ExportField($this->lastupdate);
					} else {
						if ($this->retc_id->Exportable) $Doc->ExportField($this->retc_id);
						if ($this->retc_number->Exportable) $Doc->ExportField($this->retc_number);
						if ($this->retc_date->Exportable) $Doc->ExportField($this->retc_date);
						if ($this->sjc_number->Exportable) $Doc->ExportField($this->sjc_number);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
						if ($this->retc_notes->Exportable) $Doc->ExportField($this->retc_notes);
						if ($this->sales_id->Exportable) $Doc->ExportField($this->sales_id);
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

		$rsnew["kode_depo"] = @$_SESSION["KodeDepo"];
		$rsnew["retc_number"] = GetNextRetcNumber();
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

			$rsnew["kode_depo"] = @$_SESSION["KodeDepo"];
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

		$this->kode_depo->Visible = FALSE;
		if (CurrentPageID() == "add") {
			$this->retc_number->CurrentValue = GetNextRetcNumber();
			$this->retc_number->EditValue = $this->retc_number->CurrentValue; 
		}
		$this->retc_number->ReadOnly = TRUE;		
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
