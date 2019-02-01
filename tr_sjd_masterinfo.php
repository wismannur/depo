<?php

// Global variable for table object
$tr_sjd_master = NULL;

//
// Table class for tr_sjd_master
//
class ctr_sjd_master extends cTable {
	var $sjd_id;
	var $kode_depo;
	var $sjd_number;
	var $sjd_date;
	var $rcv_date;
	var $sjd_notes;
	var $lastupdate;
	var $user_id;
	var $pb_no;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tr_sjd_master';
		$this->TableName = 'tr_sjd_master';
		$this->TableType = 'LINKTABLE';

		// Update Table
		$this->UpdateTable = "`tr_sjd_master`";
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

		// sjd_id
		$this->sjd_id = new cField('tr_sjd_master', 'tr_sjd_master', 'x_sjd_id', 'sjd_id', '`sjd_id`', '`sjd_id`', 3, -1, FALSE, '`sjd_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->sjd_id->Sortable = TRUE; // Allow sort
		$this->sjd_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sjd_id'] = &$this->sjd_id;

		// kode_depo
		$this->kode_depo = new cField('tr_sjd_master', 'tr_sjd_master', 'x_kode_depo', 'kode_depo', '`kode_depo`', '`kode_depo`', 200, -1, FALSE, '`kode_depo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_depo->Sortable = TRUE; // Allow sort
		$this->fields['kode_depo'] = &$this->kode_depo;

		// sjd_number
		$this->sjd_number = new cField('tr_sjd_master', 'tr_sjd_master', 'x_sjd_number', 'sjd_number', '`sjd_number`', '`sjd_number`', 200, -1, FALSE, '`sjd_number`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sjd_number->Sortable = TRUE; // Allow sort
		$this->fields['sjd_number'] = &$this->sjd_number;

		// sjd_date
		$this->sjd_date = new cField('tr_sjd_master', 'tr_sjd_master', 'x_sjd_date', 'sjd_date', '`sjd_date`', ew_CastDateFieldForLike('`sjd_date`', 7, "db_inventory_pusat"), 133, 7, FALSE, '`sjd_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sjd_date->Sortable = TRUE; // Allow sort
		$this->sjd_date->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['sjd_date'] = &$this->sjd_date;

		// rcv_date
		$this->rcv_date = new cField('tr_sjd_master', 'tr_sjd_master', 'x_rcv_date', 'rcv_date', '`rcv_date`', ew_CastDateFieldForLike('`rcv_date`', 7, "db_inventory_pusat"), 133, 7, FALSE, '`rcv_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rcv_date->Sortable = TRUE; // Allow sort
		$this->rcv_date->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['rcv_date'] = &$this->rcv_date;

		// sjd_notes
		$this->sjd_notes = new cField('tr_sjd_master', 'tr_sjd_master', 'x_sjd_notes', 'sjd_notes', '`sjd_notes`', '`sjd_notes`', 200, -1, FALSE, '`sjd_notes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sjd_notes->Sortable = TRUE; // Allow sort
		$this->fields['sjd_notes'] = &$this->sjd_notes;

		// lastupdate
		$this->lastupdate = new cField('tr_sjd_master', 'tr_sjd_master', 'x_lastupdate', 'lastupdate', '`lastupdate`', ew_CastDateFieldForLike('`lastupdate`', 0, "db_inventory_pusat"), 135, 0, FALSE, '`lastupdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lastupdate->Sortable = TRUE; // Allow sort
		$this->lastupdate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['lastupdate'] = &$this->lastupdate;

		// user_id
		$this->user_id = new cField('tr_sjd_master', 'tr_sjd_master', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 200, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_id->Sortable = TRUE; // Allow sort
		$this->fields['user_id'] = &$this->user_id;

		// pb_no
		$this->pb_no = new cField('tr_sjd_master', 'tr_sjd_master', 'x_pb_no', 'pb_no', '`pb_no`', '`pb_no`', 200, -1, FALSE, '`pb_no`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pb_no->Sortable = TRUE; // Allow sort
		$this->fields['pb_no'] = &$this->pb_no;
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
		if ($this->getCurrentDetailTable() == "tr_sjd_item") {
			$sDetailUrl = $GLOBALS["tr_sjd_item"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_sjd_id=" . urlencode($this->sjd_id->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "tr_sjd_masterlist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tr_sjd_master`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`sjd_number` DESC";
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
			$this->sjd_id->setDbValue($conn->Insert_ID());
			$rs['sjd_id'] = $this->sjd_id->DbValue;
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
			if (array_key_exists('sjd_id', $rs))
				ew_AddFilter($where, ew_QuotedName('sjd_id', $this->DBID) . '=' . ew_QuotedValue($rs['sjd_id'], $this->sjd_id->FldDataType, $this->DBID));
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

		// Cascade delete detail table 'tr_sjd_item'
		if (!isset($GLOBALS["tr_sjd_item"])) $GLOBALS["tr_sjd_item"] = new ctr_sjd_item();
		$rscascade = $GLOBALS["tr_sjd_item"]->LoadRs("`master_id` = " . ew_QuotedValue($rs['sjd_id'], EW_DATATYPE_NUMBER, "db_inventory_pusat")); 
		$dtlrows = ($rscascade) ? $rscascade->GetRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$bDelete = $GLOBALS["tr_sjd_item"]->Row_Deleting($dtlrow);
			if (!$bDelete) break;
		}
		if ($bDelete) {
			foreach ($dtlrows as $dtlrow) {
				$bDelete = $GLOBALS["tr_sjd_item"]->Delete($dtlrow); // Delete
				if ($bDelete === FALSE)
					break;
			}
		}

		// Call Row Deleted event
		if ($bDelete) {
			foreach ($dtlrows as $dtlrow) {
				$GLOBALS["tr_sjd_item"]->Row_Deleted($dtlrow);
			}
		}
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`sjd_id` = @sjd_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->sjd_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->sjd_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@sjd_id@", ew_AdjustSql($this->sjd_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "tr_sjd_masterlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tr_sjd_masterview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tr_sjd_masteredit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tr_sjd_masteradd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tr_sjd_masterlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_sjd_masterview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_sjd_masterview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tr_sjd_masteradd.php?" . $this->UrlParm($parm);
		else
			$url = "tr_sjd_masteradd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_sjd_masteredit.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_sjd_masteredit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
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
			$url = $this->KeyUrl("tr_sjd_masteradd.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_sjd_masteradd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tr_sjd_masterdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "sjd_id:" . ew_VarToJson($this->sjd_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->sjd_id->CurrentValue)) {
			$sUrl .= "sjd_id=" . urlencode($this->sjd_id->CurrentValue);
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
			if ($isPost && isset($_POST["sjd_id"]))
				$arKeys[] = $_POST["sjd_id"];
			elseif (isset($_GET["sjd_id"]))
				$arKeys[] = $_GET["sjd_id"];
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
			$this->sjd_id->CurrentValue = $key;
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
		$this->sjd_id->setDbValue($rs->fields('sjd_id'));
		$this->kode_depo->setDbValue($rs->fields('kode_depo'));
		$this->sjd_number->setDbValue($rs->fields('sjd_number'));
		$this->sjd_date->setDbValue($rs->fields('sjd_date'));
		$this->rcv_date->setDbValue($rs->fields('rcv_date'));
		$this->sjd_notes->setDbValue($rs->fields('sjd_notes'));
		$this->lastupdate->setDbValue($rs->fields('lastupdate'));
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->pb_no->setDbValue($rs->fields('pb_no'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// sjd_id
		// kode_depo
		// sjd_number
		// sjd_date
		// rcv_date
		// sjd_notes
		// lastupdate
		// user_id
		// pb_no
		// sjd_id

		$this->sjd_id->ViewValue = $this->sjd_id->CurrentValue;
		$this->sjd_id->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// sjd_number
		$this->sjd_number->ViewValue = $this->sjd_number->CurrentValue;
		$this->sjd_number->ViewCustomAttributes = "";

		// sjd_date
		$this->sjd_date->ViewValue = $this->sjd_date->CurrentValue;
		$this->sjd_date->ViewValue = ew_FormatDateTime($this->sjd_date->ViewValue, 7);
		$this->sjd_date->ViewCustomAttributes = "";

		// rcv_date
		$this->rcv_date->ViewValue = $this->rcv_date->CurrentValue;
		$this->rcv_date->ViewValue = ew_FormatDateTime($this->rcv_date->ViewValue, 7);
		$this->rcv_date->ViewCustomAttributes = "";

		// sjd_notes
		$this->sjd_notes->ViewValue = $this->sjd_notes->CurrentValue;
		$this->sjd_notes->ViewCustomAttributes = "";

		// lastupdate
		$this->lastupdate->ViewValue = $this->lastupdate->CurrentValue;
		$this->lastupdate->ViewValue = ew_FormatDateTime($this->lastupdate->ViewValue, 0);
		$this->lastupdate->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// pb_no
		$this->pb_no->ViewValue = $this->pb_no->CurrentValue;
		$this->pb_no->ViewCustomAttributes = "";

		// sjd_id
		$this->sjd_id->LinkCustomAttributes = "";
		$this->sjd_id->HrefValue = "";
		$this->sjd_id->TooltipValue = "";

		// kode_depo
		$this->kode_depo->LinkCustomAttributes = "";
		$this->kode_depo->HrefValue = "";
		$this->kode_depo->TooltipValue = "";

		// sjd_number
		$this->sjd_number->LinkCustomAttributes = "";
		$this->sjd_number->HrefValue = "";
		$this->sjd_number->TooltipValue = "";

		// sjd_date
		$this->sjd_date->LinkCustomAttributes = "";
		$this->sjd_date->HrefValue = "";
		$this->sjd_date->TooltipValue = "";

		// rcv_date
		$this->rcv_date->LinkCustomAttributes = "";
		$this->rcv_date->HrefValue = "";
		$this->rcv_date->TooltipValue = "";

		// sjd_notes
		$this->sjd_notes->LinkCustomAttributes = "";
		$this->sjd_notes->HrefValue = "";
		$this->sjd_notes->TooltipValue = "";

		// lastupdate
		$this->lastupdate->LinkCustomAttributes = "";
		$this->lastupdate->HrefValue = "";
		$this->lastupdate->TooltipValue = "";

		// user_id
		$this->user_id->LinkCustomAttributes = "";
		$this->user_id->HrefValue = "";
		$this->user_id->TooltipValue = "";

		// pb_no
		$this->pb_no->LinkCustomAttributes = "";
		$this->pb_no->HrefValue = "";
		$this->pb_no->TooltipValue = "";

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

		// sjd_id
		$this->sjd_id->EditAttrs["class"] = "form-control";
		$this->sjd_id->EditCustomAttributes = "";
		$this->sjd_id->EditValue = $this->sjd_id->CurrentValue;
		$this->sjd_id->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->EditAttrs["class"] = "form-control";
		$this->kode_depo->EditCustomAttributes = "";
		$this->kode_depo->EditValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->PlaceHolder = ew_RemoveHtml($this->kode_depo->FldCaption());

		// sjd_number
		$this->sjd_number->EditAttrs["class"] = "form-control";
		$this->sjd_number->EditCustomAttributes = "";
		$this->sjd_number->EditValue = $this->sjd_number->CurrentValue;
		$this->sjd_number->ViewCustomAttributes = "";

		// sjd_date
		$this->sjd_date->EditAttrs["class"] = "form-control";
		$this->sjd_date->EditCustomAttributes = "";
		$this->sjd_date->EditValue = $this->sjd_date->CurrentValue;
		$this->sjd_date->EditValue = ew_FormatDateTime($this->sjd_date->EditValue, 7);
		$this->sjd_date->ViewCustomAttributes = "";

		// rcv_date
		$this->rcv_date->EditAttrs["class"] = "form-control";
		$this->rcv_date->EditCustomAttributes = "";
		$this->rcv_date->EditValue = ew_FormatDateTime($this->rcv_date->CurrentValue, 7);
		$this->rcv_date->PlaceHolder = ew_RemoveHtml($this->rcv_date->FldCaption());

		// sjd_notes
		$this->sjd_notes->EditAttrs["class"] = "form-control";
		$this->sjd_notes->EditCustomAttributes = "";
		$this->sjd_notes->EditValue = $this->sjd_notes->CurrentValue;
		$this->sjd_notes->PlaceHolder = ew_RemoveHtml($this->sjd_notes->FldCaption());

		// lastupdate
		// user_id
		// pb_no

		$this->pb_no->EditAttrs["class"] = "form-control";
		$this->pb_no->EditCustomAttributes = "";
		$this->pb_no->EditValue = $this->pb_no->CurrentValue;
		$this->pb_no->PlaceHolder = ew_RemoveHtml($this->pb_no->FldCaption());

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
					if ($this->sjd_id->Exportable) $Doc->ExportCaption($this->sjd_id);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
					if ($this->sjd_number->Exportable) $Doc->ExportCaption($this->sjd_number);
					if ($this->sjd_date->Exportable) $Doc->ExportCaption($this->sjd_date);
					if ($this->rcv_date->Exportable) $Doc->ExportCaption($this->rcv_date);
					if ($this->sjd_notes->Exportable) $Doc->ExportCaption($this->sjd_notes);
					if ($this->lastupdate->Exportable) $Doc->ExportCaption($this->lastupdate);
					if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
					if ($this->pb_no->Exportable) $Doc->ExportCaption($this->pb_no);
				} else {
					if ($this->sjd_id->Exportable) $Doc->ExportCaption($this->sjd_id);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
					if ($this->sjd_number->Exportable) $Doc->ExportCaption($this->sjd_number);
					if ($this->sjd_date->Exportable) $Doc->ExportCaption($this->sjd_date);
					if ($this->rcv_date->Exportable) $Doc->ExportCaption($this->rcv_date);
					if ($this->sjd_notes->Exportable) $Doc->ExportCaption($this->sjd_notes);
					if ($this->lastupdate->Exportable) $Doc->ExportCaption($this->lastupdate);
					if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
					if ($this->pb_no->Exportable) $Doc->ExportCaption($this->pb_no);
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
						if ($this->sjd_id->Exportable) $Doc->ExportField($this->sjd_id);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
						if ($this->sjd_number->Exportable) $Doc->ExportField($this->sjd_number);
						if ($this->sjd_date->Exportable) $Doc->ExportField($this->sjd_date);
						if ($this->rcv_date->Exportable) $Doc->ExportField($this->rcv_date);
						if ($this->sjd_notes->Exportable) $Doc->ExportField($this->sjd_notes);
						if ($this->lastupdate->Exportable) $Doc->ExportField($this->lastupdate);
						if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
						if ($this->pb_no->Exportable) $Doc->ExportField($this->pb_no);
					} else {
						if ($this->sjd_id->Exportable) $Doc->ExportField($this->sjd_id);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
						if ($this->sjd_number->Exportable) $Doc->ExportField($this->sjd_number);
						if ($this->sjd_date->Exportable) $Doc->ExportField($this->sjd_date);
						if ($this->rcv_date->Exportable) $Doc->ExportField($this->rcv_date);
						if ($this->sjd_notes->Exportable) $Doc->ExportField($this->sjd_notes);
						if ($this->lastupdate->Exportable) $Doc->ExportField($this->lastupdate);
						if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
						if ($this->pb_no->Exportable) $Doc->ExportField($this->pb_no);
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

		$this->kode_depo->Visible = FALSE;
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
