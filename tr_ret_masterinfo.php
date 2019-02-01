<?php

// Global variable for table object
$tr_ret_master = NULL;

//
// Table class for tr_ret_master
//
class ctr_ret_master extends cTable {
	var $ret_id;
	var $ret_number;
	var $ret_date;
	var $customer_id;
	var $customer_name;
	var $address1;
	var $address2;
	var $address3;
	var $ret_amt;
	var $disc_total;
	var $ret_total;
	var $user_id;
	var $lastupdate;
	var $kode_depo;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tr_ret_master';
		$this->TableName = 'tr_ret_master';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tr_ret_master`";
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

		// ret_id
		$this->ret_id = new cField('tr_ret_master', 'tr_ret_master', 'x_ret_id', 'ret_id', '`ret_id`', '`ret_id`', 3, -1, FALSE, '`ret_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ret_id->Sortable = TRUE; // Allow sort
		$this->ret_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ret_id'] = &$this->ret_id;

		// ret_number
		$this->ret_number = new cField('tr_ret_master', 'tr_ret_master', 'x_ret_number', 'ret_number', '`ret_number`', '`ret_number`', 200, -1, FALSE, '`ret_number`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ret_number->Sortable = TRUE; // Allow sort
		$this->fields['ret_number'] = &$this->ret_number;

		// ret_date
		$this->ret_date = new cField('tr_ret_master', 'tr_ret_master', 'x_ret_date', 'ret_date', '`ret_date`', ew_CastDateFieldForLike('`ret_date`', 7, "DB"), 133, 7, FALSE, '`ret_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ret_date->Sortable = TRUE; // Allow sort
		$this->ret_date->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['ret_date'] = &$this->ret_date;

		// customer_id
		$this->customer_id = new cField('tr_ret_master', 'tr_ret_master', 'x_customer_id', 'customer_id', '`customer_id`', '`customer_id`', 3, -1, FALSE, '`customer_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_id->Sortable = TRUE; // Allow sort
		$this->customer_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['customer_id'] = &$this->customer_id;

		// customer_name
		$this->customer_name = new cField('tr_ret_master', 'tr_ret_master', 'x_customer_name', 'customer_name', '`customer_name`', '`customer_name`', 200, -1, FALSE, '`customer_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_name->Sortable = TRUE; // Allow sort
		$this->fields['customer_name'] = &$this->customer_name;

		// address1
		$this->address1 = new cField('tr_ret_master', 'tr_ret_master', 'x_address1', 'address1', '`address1`', '`address1`', 200, -1, FALSE, '`address1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address1->Sortable = TRUE; // Allow sort
		$this->fields['address1'] = &$this->address1;

		// address2
		$this->address2 = new cField('tr_ret_master', 'tr_ret_master', 'x_address2', 'address2', '`address2`', '`address2`', 200, -1, FALSE, '`address2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address2->Sortable = TRUE; // Allow sort
		$this->fields['address2'] = &$this->address2;

		// address3
		$this->address3 = new cField('tr_ret_master', 'tr_ret_master', 'x_address3', 'address3', '`address3`', '`address3`', 200, -1, FALSE, '`address3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->address3->Sortable = TRUE; // Allow sort
		$this->fields['address3'] = &$this->address3;

		// ret_amt
		$this->ret_amt = new cField('tr_ret_master', 'tr_ret_master', 'x_ret_amt', 'ret_amt', '`ret_amt`', '`ret_amt`', 5, -1, FALSE, '`ret_amt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ret_amt->Sortable = TRUE; // Allow sort
		$this->ret_amt->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['ret_amt'] = &$this->ret_amt;

		// disc_total
		$this->disc_total = new cField('tr_ret_master', 'tr_ret_master', 'x_disc_total', 'disc_total', '`disc_total`', '`disc_total`', 5, -1, FALSE, '`disc_total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->disc_total->Sortable = TRUE; // Allow sort
		$this->disc_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['disc_total'] = &$this->disc_total;

		// ret_total
		$this->ret_total = new cField('tr_ret_master', 'tr_ret_master', 'x_ret_total', 'ret_total', '`ret_total`', '`ret_total`', 5, -1, FALSE, '`ret_total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ret_total->Sortable = TRUE; // Allow sort
		$this->ret_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['ret_total'] = &$this->ret_total;

		// user_id
		$this->user_id = new cField('tr_ret_master', 'tr_ret_master', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 3, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->user_id->Sortable = TRUE; // Allow sort
		$this->user_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['user_id'] = &$this->user_id;

		// lastupdate
		$this->lastupdate = new cField('tr_ret_master', 'tr_ret_master', 'x_lastupdate', 'lastupdate', '`lastupdate`', ew_CastDateFieldForLike('`lastupdate`', 0, "DB"), 135, 0, FALSE, '`lastupdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->lastupdate->Sortable = TRUE; // Allow sort
		$this->lastupdate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['lastupdate'] = &$this->lastupdate;

		// kode_depo
		$this->kode_depo = new cField('tr_ret_master', 'tr_ret_master', 'x_kode_depo', 'kode_depo', '`kode_depo`', '`kode_depo`', 200, -1, FALSE, '`kode_depo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->kode_depo->Sortable = TRUE; // Allow sort
		$this->fields['kode_depo'] = &$this->kode_depo;
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
		if ($this->getCurrentDetailTable() == "tr_ret_item") {
			$sDetailUrl = $GLOBALS["tr_ret_item"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_ret_id=" . urlencode($this->ret_id->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "tr_ret_masterlist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tr_ret_master`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`ret_number` DESC";
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
			$this->ret_id->setDbValue($conn->Insert_ID());
			$rs['ret_id'] = $this->ret_id->DbValue;
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
			if (array_key_exists('ret_id', $rs))
				ew_AddFilter($where, ew_QuotedName('ret_id', $this->DBID) . '=' . ew_QuotedValue($rs['ret_id'], $this->ret_id->FldDataType, $this->DBID));
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

		// Cascade delete detail table 'tr_ret_item'
		if (!isset($GLOBALS["tr_ret_item"])) $GLOBALS["tr_ret_item"] = new ctr_ret_item();
		$rscascade = $GLOBALS["tr_ret_item"]->LoadRs("`master_id` = " . ew_QuotedValue($rs['ret_id'], EW_DATATYPE_NUMBER, "DB")); 
		$dtlrows = ($rscascade) ? $rscascade->GetRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$bDelete = $GLOBALS["tr_ret_item"]->Row_Deleting($dtlrow);
			if (!$bDelete) break;
		}
		if ($bDelete) {
			foreach ($dtlrows as $dtlrow) {
				$bDelete = $GLOBALS["tr_ret_item"]->Delete($dtlrow); // Delete
				if ($bDelete === FALSE)
					break;
			}
		}

		// Call Row Deleted event
		if ($bDelete) {
			foreach ($dtlrows as $dtlrow) {
				$GLOBALS["tr_ret_item"]->Row_Deleted($dtlrow);
			}
		}
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`ret_id` = @ret_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->ret_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->ret_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@ret_id@", ew_AdjustSql($this->ret_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "tr_ret_masterlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tr_ret_masterview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tr_ret_masteredit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tr_ret_masteradd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tr_ret_masterlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_ret_masterview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_ret_masterview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tr_ret_masteradd.php?" . $this->UrlParm($parm);
		else
			$url = "tr_ret_masteradd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_ret_masteredit.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_ret_masteredit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
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
			$url = $this->KeyUrl("tr_ret_masteradd.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_ret_masteradd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tr_ret_masterdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "ret_id:" . ew_VarToJson($this->ret_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->ret_id->CurrentValue)) {
			$sUrl .= "ret_id=" . urlencode($this->ret_id->CurrentValue);
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
			if ($isPost && isset($_POST["ret_id"]))
				$arKeys[] = $_POST["ret_id"];
			elseif (isset($_GET["ret_id"]))
				$arKeys[] = $_GET["ret_id"];
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
			$this->ret_id->CurrentValue = $key;
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
		$this->ret_id->setDbValue($rs->fields('ret_id'));
		$this->ret_number->setDbValue($rs->fields('ret_number'));
		$this->ret_date->setDbValue($rs->fields('ret_date'));
		$this->customer_id->setDbValue($rs->fields('customer_id'));
		$this->customer_name->setDbValue($rs->fields('customer_name'));
		$this->address1->setDbValue($rs->fields('address1'));
		$this->address2->setDbValue($rs->fields('address2'));
		$this->address3->setDbValue($rs->fields('address3'));
		$this->ret_amt->setDbValue($rs->fields('ret_amt'));
		$this->disc_total->setDbValue($rs->fields('disc_total'));
		$this->ret_total->setDbValue($rs->fields('ret_total'));
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->lastupdate->setDbValue($rs->fields('lastupdate'));
		$this->kode_depo->setDbValue($rs->fields('kode_depo'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// ret_id
		// ret_number
		// ret_date
		// customer_id
		// customer_name
		// address1
		// address2
		// address3
		// ret_amt
		// disc_total
		// ret_total
		// user_id
		// lastupdate
		// kode_depo
		// ret_id

		$this->ret_id->ViewValue = $this->ret_id->CurrentValue;
		$this->ret_id->ViewCustomAttributes = "";

		// ret_number
		$this->ret_number->ViewValue = $this->ret_number->CurrentValue;
		$this->ret_number->ViewCustomAttributes = "";

		// ret_date
		$this->ret_date->ViewValue = $this->ret_date->CurrentValue;
		$this->ret_date->ViewValue = ew_FormatDateTime($this->ret_date->ViewValue, 7);
		$this->ret_date->ViewCustomAttributes = "";

		// customer_id
		$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
		if (strval($this->customer_id->CurrentValue) <> "") {
			$sFilterWrk = "`customer_id`" . ew_SearchString("=", $this->customer_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `customer_id`, `customer_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_customer`";
		$sWhereWrk = "";
		$this->customer_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->customer_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `customer_name`";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->customer_id->ViewValue = $this->customer_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
			}
		} else {
			$this->customer_id->ViewValue = NULL;
		}
		$this->customer_id->ViewCustomAttributes = "";

		// customer_name
		$this->customer_name->ViewValue = $this->customer_name->CurrentValue;
		$this->customer_name->ViewCustomAttributes = "";

		// address1
		$this->address1->ViewValue = $this->address1->CurrentValue;
		$this->address1->ViewCustomAttributes = "";

		// address2
		$this->address2->ViewValue = $this->address2->CurrentValue;
		$this->address2->ViewCustomAttributes = "";

		// address3
		$this->address3->ViewValue = $this->address3->CurrentValue;
		$this->address3->ViewCustomAttributes = "";

		// ret_amt
		$this->ret_amt->ViewValue = $this->ret_amt->CurrentValue;
		$this->ret_amt->ViewValue = ew_FormatNumber($this->ret_amt->ViewValue, 2, -2, -2, -2);
		$this->ret_amt->CellCssStyle .= "text-align: right;";
		$this->ret_amt->ViewCustomAttributes = "";

		// disc_total
		$this->disc_total->ViewValue = $this->disc_total->CurrentValue;
		$this->disc_total->ViewValue = ew_FormatNumber($this->disc_total->ViewValue, 2, -2, -2, -2);
		$this->disc_total->CellCssStyle .= "text-align: right;";
		$this->disc_total->ViewCustomAttributes = "";

		// ret_total
		$this->ret_total->ViewValue = $this->ret_total->CurrentValue;
		$this->ret_total->ViewValue = ew_FormatNumber($this->ret_total->ViewValue, 2, -2, -2, -2);
		$this->ret_total->CellCssStyle .= "text-align: right;";
		$this->ret_total->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewCustomAttributes = "";

		// lastupdate
		$this->lastupdate->ViewValue = $this->lastupdate->CurrentValue;
		$this->lastupdate->ViewValue = ew_FormatDateTime($this->lastupdate->ViewValue, 0);
		$this->lastupdate->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// ret_id
		$this->ret_id->LinkCustomAttributes = "";
		$this->ret_id->HrefValue = "";
		$this->ret_id->TooltipValue = "";

		// ret_number
		$this->ret_number->LinkCustomAttributes = "";
		$this->ret_number->HrefValue = "";
		$this->ret_number->TooltipValue = "";

		// ret_date
		$this->ret_date->LinkCustomAttributes = "";
		$this->ret_date->HrefValue = "";
		$this->ret_date->TooltipValue = "";

		// customer_id
		$this->customer_id->LinkCustomAttributes = "";
		$this->customer_id->HrefValue = "";
		$this->customer_id->TooltipValue = "";

		// customer_name
		$this->customer_name->LinkCustomAttributes = "";
		$this->customer_name->HrefValue = "";
		$this->customer_name->TooltipValue = "";

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

		// ret_amt
		$this->ret_amt->LinkCustomAttributes = "";
		$this->ret_amt->HrefValue = "";
		$this->ret_amt->TooltipValue = "";

		// disc_total
		$this->disc_total->LinkCustomAttributes = "";
		$this->disc_total->HrefValue = "";
		$this->disc_total->TooltipValue = "";

		// ret_total
		$this->ret_total->LinkCustomAttributes = "";
		$this->ret_total->HrefValue = "";
		$this->ret_total->TooltipValue = "";

		// user_id
		$this->user_id->LinkCustomAttributes = "";
		$this->user_id->HrefValue = "";
		$this->user_id->TooltipValue = "";

		// lastupdate
		$this->lastupdate->LinkCustomAttributes = "";
		$this->lastupdate->HrefValue = "";
		$this->lastupdate->TooltipValue = "";

		// kode_depo
		$this->kode_depo->LinkCustomAttributes = "";
		$this->kode_depo->HrefValue = "";
		$this->kode_depo->TooltipValue = "";

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

		// ret_id
		$this->ret_id->EditAttrs["class"] = "form-control";
		$this->ret_id->EditCustomAttributes = "";
		$this->ret_id->EditValue = $this->ret_id->CurrentValue;
		$this->ret_id->ViewCustomAttributes = "";

		// ret_number
		$this->ret_number->EditAttrs["class"] = "form-control";
		$this->ret_number->EditCustomAttributes = "";
		$this->ret_number->EditValue = $this->ret_number->CurrentValue;
		$this->ret_number->PlaceHolder = ew_RemoveHtml($this->ret_number->FldCaption());

		// ret_date
		$this->ret_date->EditAttrs["class"] = "form-control";
		$this->ret_date->EditCustomAttributes = "";
		$this->ret_date->EditValue = ew_FormatDateTime($this->ret_date->CurrentValue, 7);
		$this->ret_date->PlaceHolder = ew_RemoveHtml($this->ret_date->FldCaption());

		// customer_id
		$this->customer_id->EditAttrs["class"] = "form-control";
		$this->customer_id->EditCustomAttributes = "";
		$this->customer_id->EditValue = $this->customer_id->CurrentValue;
		$this->customer_id->PlaceHolder = ew_RemoveHtml($this->customer_id->FldCaption());

		// customer_name
		$this->customer_name->EditAttrs["class"] = "form-control";
		$this->customer_name->EditCustomAttributes = "";
		$this->customer_name->EditValue = $this->customer_name->CurrentValue;
		$this->customer_name->PlaceHolder = ew_RemoveHtml($this->customer_name->FldCaption());

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

		// ret_amt
		$this->ret_amt->EditAttrs["class"] = "form-control";
		$this->ret_amt->EditCustomAttributes = "";
		$this->ret_amt->EditValue = $this->ret_amt->CurrentValue;
		$this->ret_amt->PlaceHolder = ew_RemoveHtml($this->ret_amt->FldCaption());
		if (strval($this->ret_amt->EditValue) <> "" && is_numeric($this->ret_amt->EditValue)) $this->ret_amt->EditValue = ew_FormatNumber($this->ret_amt->EditValue, -2, -2, -2, -2);

		// disc_total
		$this->disc_total->EditAttrs["class"] = "form-control";
		$this->disc_total->EditCustomAttributes = "";
		$this->disc_total->EditValue = $this->disc_total->CurrentValue;
		$this->disc_total->PlaceHolder = ew_RemoveHtml($this->disc_total->FldCaption());
		if (strval($this->disc_total->EditValue) <> "" && is_numeric($this->disc_total->EditValue)) $this->disc_total->EditValue = ew_FormatNumber($this->disc_total->EditValue, -2, -2, -2, -2);

		// ret_total
		$this->ret_total->EditAttrs["class"] = "form-control";
		$this->ret_total->EditCustomAttributes = "";
		$this->ret_total->EditValue = $this->ret_total->CurrentValue;
		$this->ret_total->PlaceHolder = ew_RemoveHtml($this->ret_total->FldCaption());
		if (strval($this->ret_total->EditValue) <> "" && is_numeric($this->ret_total->EditValue)) $this->ret_total->EditValue = ew_FormatNumber($this->ret_total->EditValue, -2, -2, -2, -2);

		// user_id
		// lastupdate
		// kode_depo

		$this->kode_depo->EditAttrs["class"] = "form-control";
		$this->kode_depo->EditCustomAttributes = "";

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
					if ($this->ret_id->Exportable) $Doc->ExportCaption($this->ret_id);
					if ($this->ret_number->Exportable) $Doc->ExportCaption($this->ret_number);
					if ($this->ret_date->Exportable) $Doc->ExportCaption($this->ret_date);
					if ($this->customer_id->Exportable) $Doc->ExportCaption($this->customer_id);
					if ($this->customer_name->Exportable) $Doc->ExportCaption($this->customer_name);
					if ($this->address1->Exportable) $Doc->ExportCaption($this->address1);
					if ($this->address2->Exportable) $Doc->ExportCaption($this->address2);
					if ($this->address3->Exportable) $Doc->ExportCaption($this->address3);
					if ($this->ret_amt->Exportable) $Doc->ExportCaption($this->ret_amt);
					if ($this->disc_total->Exportable) $Doc->ExportCaption($this->disc_total);
					if ($this->ret_total->Exportable) $Doc->ExportCaption($this->ret_total);
					if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
					if ($this->lastupdate->Exportable) $Doc->ExportCaption($this->lastupdate);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
				} else {
					if ($this->ret_id->Exportable) $Doc->ExportCaption($this->ret_id);
					if ($this->ret_number->Exportable) $Doc->ExportCaption($this->ret_number);
					if ($this->ret_date->Exportable) $Doc->ExportCaption($this->ret_date);
					if ($this->customer_id->Exportable) $Doc->ExportCaption($this->customer_id);
					if ($this->customer_name->Exportable) $Doc->ExportCaption($this->customer_name);
					if ($this->address1->Exportable) $Doc->ExportCaption($this->address1);
					if ($this->address2->Exportable) $Doc->ExportCaption($this->address2);
					if ($this->address3->Exportable) $Doc->ExportCaption($this->address3);
					if ($this->ret_amt->Exportable) $Doc->ExportCaption($this->ret_amt);
					if ($this->disc_total->Exportable) $Doc->ExportCaption($this->disc_total);
					if ($this->ret_total->Exportable) $Doc->ExportCaption($this->ret_total);
					if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
					if ($this->lastupdate->Exportable) $Doc->ExportCaption($this->lastupdate);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
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
						if ($this->ret_id->Exportable) $Doc->ExportField($this->ret_id);
						if ($this->ret_number->Exportable) $Doc->ExportField($this->ret_number);
						if ($this->ret_date->Exportable) $Doc->ExportField($this->ret_date);
						if ($this->customer_id->Exportable) $Doc->ExportField($this->customer_id);
						if ($this->customer_name->Exportable) $Doc->ExportField($this->customer_name);
						if ($this->address1->Exportable) $Doc->ExportField($this->address1);
						if ($this->address2->Exportable) $Doc->ExportField($this->address2);
						if ($this->address3->Exportable) $Doc->ExportField($this->address3);
						if ($this->ret_amt->Exportable) $Doc->ExportField($this->ret_amt);
						if ($this->disc_total->Exportable) $Doc->ExportField($this->disc_total);
						if ($this->ret_total->Exportable) $Doc->ExportField($this->ret_total);
						if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
						if ($this->lastupdate->Exportable) $Doc->ExportField($this->lastupdate);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
					} else {
						if ($this->ret_id->Exportable) $Doc->ExportField($this->ret_id);
						if ($this->ret_number->Exportable) $Doc->ExportField($this->ret_number);
						if ($this->ret_date->Exportable) $Doc->ExportField($this->ret_date);
						if ($this->customer_id->Exportable) $Doc->ExportField($this->customer_id);
						if ($this->customer_name->Exportable) $Doc->ExportField($this->customer_name);
						if ($this->address1->Exportable) $Doc->ExportField($this->address1);
						if ($this->address2->Exportable) $Doc->ExportField($this->address2);
						if ($this->address3->Exportable) $Doc->ExportField($this->address3);
						if ($this->ret_amt->Exportable) $Doc->ExportField($this->ret_amt);
						if ($this->disc_total->Exportable) $Doc->ExportField($this->disc_total);
						if ($this->ret_total->Exportable) $Doc->ExportField($this->ret_total);
						if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
						if ($this->lastupdate->Exportable) $Doc->ExportField($this->lastupdate);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
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
		if (preg_match('/^x(\d)*_customer_id$/', $id)) {
			$conn = &$this->Connection();
			$sSqlWrk = "SELECT `customer_name` AS FIELD0, `address1` AS FIELD1, `address2` AS FIELD2, `address3` AS FIELD3 FROM `tbl_customer`";
			$sWhereWrk = "(`customer_id` = " . ew_QuotedValue($val, EW_DATATYPE_NUMBER, $this->DBID) . ")";
			$this->customer_id->LookupFilters = array();
			$this->Lookup_Selecting($this->customer_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `customer_name`";
			if ($rs = ew_LoadRecordset($sSqlWrk, $conn)) {
				while ($rs && !$rs->EOF) {
					$ar = array();
					$this->customer_name->setDbValue($rs->fields[0]);
					$this->address1->setDbValue($rs->fields[1]);
					$this->address2->setDbValue($rs->fields[2]);
					$this->address3->setDbValue($rs->fields[3]);
					$this->RowType == EW_ROWTYPE_EDIT;
					$this->RenderEditRow();
					$ar[] = ($this->customer_name->AutoFillOriginalValue) ? $this->customer_name->CurrentValue : $this->customer_name->EditValue;
					$ar[] = ($this->address1->AutoFillOriginalValue) ? $this->address1->CurrentValue : $this->address1->EditValue;
					$ar[] = ($this->address2->AutoFillOriginalValue) ? $this->address2->CurrentValue : $this->address2->EditValue;
					$ar[] = $this->address3->CurrentValue;
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

		$rsnew["kode_depo"] = @$_SESSION["KodeDepo"];
		$rsnew["ret_number"] = GetNextRetNumber();
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

		if (CurrentPageID() == "add") {
			$this->ret_number->CurrentValue = GetNextRetNumber();
			$this->ret_number->EditValue = $this->ret_number->CurrentValue; 
		}
		$this->ret_number->ReadOnly = TRUE;		
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
