<?php

// Global variable for table object
$tr_pb_master = NULL;

//
// Table class for tr_pb_master
//
class ctr_pb_master extends cTable {
	var $pb_id;
	var $pb_number;
	var $pb_date;
	var $kode_depo;
	var $pb_notes;
	var $lastupdate;
	var $user_id;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tr_pb_master';
		$this->TableName = 'tr_pb_master';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tr_pb_master`";
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

		// pb_id
		$this->pb_id = new cField('tr_pb_master', 'tr_pb_master', 'x_pb_id', 'pb_id', '`pb_id`', '`pb_id`', 3, -1, FALSE, '`pb_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->pb_id->Sortable = TRUE; // Allow sort
		$this->pb_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pb_id'] = &$this->pb_id;

		// pb_number
		$this->pb_number = new cField('tr_pb_master', 'tr_pb_master', 'x_pb_number', 'pb_number', '`pb_number`', '`pb_number`', 200, -1, FALSE, '`pb_number`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pb_number->Sortable = TRUE; // Allow sort
		$this->fields['pb_number'] = &$this->pb_number;

		// pb_date
		$this->pb_date = new cField('tr_pb_master', 'tr_pb_master', 'x_pb_date', 'pb_date', '`pb_date`', ew_CastDateFieldForLike('`pb_date`', 0, "DB"), 133, 0, FALSE, '`pb_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pb_date->Sortable = TRUE; // Allow sort
		$this->pb_date->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['pb_date'] = &$this->pb_date;

		// kode_depo
		$this->kode_depo = new cField('tr_pb_master', 'tr_pb_master', 'x_kode_depo', 'kode_depo', '`kode_depo`', '`kode_depo`', 200, -1, FALSE, '`kode_depo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kode_depo->Sortable = TRUE; // Allow sort
		$this->kode_depo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kode_depo->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['kode_depo'] = &$this->kode_depo;

		// pb_notes
		$this->pb_notes = new cField('tr_pb_master', 'tr_pb_master', 'x_pb_notes', 'pb_notes', '`pb_notes`', '`pb_notes`', 200, -1, FALSE, '`pb_notes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pb_notes->Sortable = TRUE; // Allow sort
		$this->fields['pb_notes'] = &$this->pb_notes;

		// lastupdate
		$this->lastupdate = new cField('tr_pb_master', 'tr_pb_master', 'x_lastupdate', 'lastupdate', '`lastupdate`', ew_CastDateFieldForLike('`lastupdate`', 0, "DB"), 135, 0, FALSE, '`lastupdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lastupdate->Sortable = TRUE; // Allow sort
		$this->lastupdate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['lastupdate'] = &$this->lastupdate;

		// user_id
		$this->user_id = new cField('tr_pb_master', 'tr_pb_master', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 3, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_id->Sortable = TRUE; // Allow sort
		$this->fields['user_id'] = &$this->user_id;
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
		if ($this->getCurrentDetailTable() == "tr_pb_item") {
			$sDetailUrl = $GLOBALS["tr_pb_item"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_pb_id=" . urlencode($this->pb_id->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "tr_pb_masterlist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tr_pb_master`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`pb_number` DESC";
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
			$this->pb_id->setDbValue($conn->Insert_ID());
			$rs['pb_id'] = $this->pb_id->DbValue;
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
			if (array_key_exists('pb_id', $rs))
				ew_AddFilter($where, ew_QuotedName('pb_id', $this->DBID) . '=' . ew_QuotedValue($rs['pb_id'], $this->pb_id->FldDataType, $this->DBID));
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

		// Cascade delete detail table 'tr_pb_item'
		if (!isset($GLOBALS["tr_pb_item"])) $GLOBALS["tr_pb_item"] = new ctr_pb_item();
		$rscascade = $GLOBALS["tr_pb_item"]->LoadRs("`master_id` = " . ew_QuotedValue($rs['pb_id'], EW_DATATYPE_NUMBER, "DB")); 
		$dtlrows = ($rscascade) ? $rscascade->GetRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$bDelete = $GLOBALS["tr_pb_item"]->Row_Deleting($dtlrow);
			if (!$bDelete) break;
		}
		if ($bDelete) {
			foreach ($dtlrows as $dtlrow) {
				$bDelete = $GLOBALS["tr_pb_item"]->Delete($dtlrow); // Delete
				if ($bDelete === FALSE)
					break;
			}
		}

		// Call Row Deleted event
		if ($bDelete) {
			foreach ($dtlrows as $dtlrow) {
				$GLOBALS["tr_pb_item"]->Row_Deleted($dtlrow);
			}
		}
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`pb_id` = @pb_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->pb_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->pb_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@pb_id@", ew_AdjustSql($this->pb_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "tr_pb_masterlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tr_pb_masterview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tr_pb_masteredit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tr_pb_masteradd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tr_pb_masterlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_pb_masterview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_pb_masterview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tr_pb_masteradd.php?" . $this->UrlParm($parm);
		else
			$url = "tr_pb_masteradd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_pb_masteredit.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_pb_masteredit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
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
			$url = $this->KeyUrl("tr_pb_masteradd.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_pb_masteradd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tr_pb_masterdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "pb_id:" . ew_VarToJson($this->pb_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->pb_id->CurrentValue)) {
			$sUrl .= "pb_id=" . urlencode($this->pb_id->CurrentValue);
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
			if ($isPost && isset($_POST["pb_id"]))
				$arKeys[] = $_POST["pb_id"];
			elseif (isset($_GET["pb_id"]))
				$arKeys[] = $_GET["pb_id"];
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
			$this->pb_id->CurrentValue = $key;
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
		$this->pb_id->setDbValue($rs->fields('pb_id'));
		$this->pb_number->setDbValue($rs->fields('pb_number'));
		$this->pb_date->setDbValue($rs->fields('pb_date'));
		$this->kode_depo->setDbValue($rs->fields('kode_depo'));
		$this->pb_notes->setDbValue($rs->fields('pb_notes'));
		$this->lastupdate->setDbValue($rs->fields('lastupdate'));
		$this->user_id->setDbValue($rs->fields('user_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// pb_id
		// pb_number
		// pb_date
		// kode_depo
		// pb_notes
		// lastupdate
		// user_id
		// pb_id

		$this->pb_id->ViewValue = $this->pb_id->CurrentValue;
		$this->pb_id->ViewCustomAttributes = "";

		// pb_number
		$this->pb_number->ViewValue = $this->pb_number->CurrentValue;
		$this->pb_number->ViewCustomAttributes = "";

		// pb_date
		$this->pb_date->ViewValue = $this->pb_date->CurrentValue;
		$this->pb_date->ViewValue = ew_FormatDateTime($this->pb_date->ViewValue, 0);
		$this->pb_date->CellCssStyle .= "text-align: center;";
		$this->pb_date->ViewCustomAttributes = "";

		// kode_depo
		if (strval($this->kode_depo->CurrentValue) <> "") {
			$sFilterWrk = "`kode_depo`" . ew_SearchString("=", $this->kode_depo->CurrentValue, EW_DATATYPE_STRING, "db_inventory_pusat");
		$sSqlWrk = "SELECT `kode_depo`, `nama_depo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_depo`";
		$sWhereWrk = "";
		$this->kode_depo->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->kode_depo, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->kode_depo->ViewValue = $this->kode_depo->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
			}
		} else {
			$this->kode_depo->ViewValue = NULL;
		}
		$this->kode_depo->CellCssStyle .= "text-align: left;";
		$this->kode_depo->ViewCustomAttributes = "";

		// pb_notes
		$this->pb_notes->ViewValue = $this->pb_notes->CurrentValue;
		$this->pb_notes->ViewCustomAttributes = "";

		// lastupdate
		$this->lastupdate->ViewValue = $this->lastupdate->CurrentValue;
		$this->lastupdate->ViewValue = ew_FormatDateTime($this->lastupdate->ViewValue, 0);
		$this->lastupdate->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// pb_id
		$this->pb_id->LinkCustomAttributes = "";
		$this->pb_id->HrefValue = "";
		$this->pb_id->TooltipValue = "";

		// pb_number
		$this->pb_number->LinkCustomAttributes = "";
		$this->pb_number->HrefValue = "";
		$this->pb_number->TooltipValue = "";

		// pb_date
		$this->pb_date->LinkCustomAttributes = "";
		$this->pb_date->HrefValue = "";
		$this->pb_date->TooltipValue = "";

		// kode_depo
		$this->kode_depo->LinkCustomAttributes = "";
		$this->kode_depo->HrefValue = "";
		$this->kode_depo->TooltipValue = "";

		// pb_notes
		$this->pb_notes->LinkCustomAttributes = "";
		$this->pb_notes->HrefValue = "";
		$this->pb_notes->TooltipValue = "";

		// lastupdate
		$this->lastupdate->LinkCustomAttributes = "";
		$this->lastupdate->HrefValue = "";
		$this->lastupdate->TooltipValue = "";

		// user_id
		$this->user_id->LinkCustomAttributes = "";
		$this->user_id->HrefValue = "";
		$this->user_id->TooltipValue = "";

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

		// pb_id
		$this->pb_id->EditAttrs["class"] = "form-control";
		$this->pb_id->EditCustomAttributes = "";
		$this->pb_id->EditValue = $this->pb_id->CurrentValue;
		$this->pb_id->ViewCustomAttributes = "";

		// pb_number
		$this->pb_number->EditAttrs["class"] = "form-control";
		$this->pb_number->EditCustomAttributes = "";
		$this->pb_number->EditValue = $this->pb_number->CurrentValue;
		$this->pb_number->PlaceHolder = ew_RemoveHtml($this->pb_number->FldCaption());

		// pb_date
		$this->pb_date->EditAttrs["class"] = "form-control";
		$this->pb_date->EditCustomAttributes = "";
		$this->pb_date->EditValue = ew_FormatDateTime($this->pb_date->CurrentValue, 8);
		$this->pb_date->PlaceHolder = ew_RemoveHtml($this->pb_date->FldCaption());

		// kode_depo
		$this->kode_depo->EditCustomAttributes = "";

		// pb_notes
		$this->pb_notes->EditAttrs["class"] = "form-control";
		$this->pb_notes->EditCustomAttributes = "";
		$this->pb_notes->EditValue = $this->pb_notes->CurrentValue;
		$this->pb_notes->PlaceHolder = ew_RemoveHtml($this->pb_notes->FldCaption());

		// lastupdate
		// user_id
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
					if ($this->pb_id->Exportable) $Doc->ExportCaption($this->pb_id);
					if ($this->pb_number->Exportable) $Doc->ExportCaption($this->pb_number);
					if ($this->pb_date->Exportable) $Doc->ExportCaption($this->pb_date);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
					if ($this->pb_notes->Exportable) $Doc->ExportCaption($this->pb_notes);
					if ($this->lastupdate->Exportable) $Doc->ExportCaption($this->lastupdate);
					if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
				} else {
					if ($this->pb_id->Exportable) $Doc->ExportCaption($this->pb_id);
					if ($this->pb_number->Exportable) $Doc->ExportCaption($this->pb_number);
					if ($this->pb_date->Exportable) $Doc->ExportCaption($this->pb_date);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
					if ($this->pb_notes->Exportable) $Doc->ExportCaption($this->pb_notes);
					if ($this->lastupdate->Exportable) $Doc->ExportCaption($this->lastupdate);
					if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
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
						if ($this->pb_id->Exportable) $Doc->ExportField($this->pb_id);
						if ($this->pb_number->Exportable) $Doc->ExportField($this->pb_number);
						if ($this->pb_date->Exportable) $Doc->ExportField($this->pb_date);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
						if ($this->pb_notes->Exportable) $Doc->ExportField($this->pb_notes);
						if ($this->lastupdate->Exportable) $Doc->ExportField($this->lastupdate);
						if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
					} else {
						if ($this->pb_id->Exportable) $Doc->ExportField($this->pb_id);
						if ($this->pb_number->Exportable) $Doc->ExportField($this->pb_number);
						if ($this->pb_date->Exportable) $Doc->ExportField($this->pb_date);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
						if ($this->pb_notes->Exportable) $Doc->ExportField($this->pb_notes);
						if ($this->lastupdate->Exportable) $Doc->ExportField($this->lastupdate);
						if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
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
		$rsnew["pb_number"] = GetNextPbNumber();
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
			$this->pb_number->CurrentValue = GetNextPbNumber();
			$this->pb_number->EditValue = $this->pb_number->CurrentValue; 
		}
		$this->pb_number->ReadOnly = TRUE;		
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
