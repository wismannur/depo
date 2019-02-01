<?php

// Global variable for table object
$tr_km_master_ar2 = NULL;

//
// Table class for tr_km_master_ar2
//
class ctr_km_master_ar2 extends cTable {
	var $row_id;
	var $km_nomor;
	var $km_tanggal;
	var $customer_id;
	var $customer_name;
	var $km_type;
	var $km_acc;
	var $cek_no;
	var $tgl_jt;
	var $cek_amt;
	var $ret_number1;
	var $ret_date1;
	var $retur_amt1;
	var $ret_number2;
	var $ret_date2;
	var $retur_amt2;
	var $ret_number3;
	var $ret_date3;
	var $retur_amt3;
	var $tunai_amt;
	var $dp_amt;
	var $km_amt;
	var $km_notes;
	var $kas_amt;
	var $kode_depo;
	var $sales_id;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tr_km_master_ar2';
		$this->TableName = 'tr_km_master_ar2';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tr_km_master_ar2`";
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

		// row_id
		$this->row_id = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_row_id', 'row_id', '`row_id`', '`row_id`', 3, -1, FALSE, '`row_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->row_id->Sortable = TRUE; // Allow sort
		$this->row_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['row_id'] = &$this->row_id;

		// km_nomor
		$this->km_nomor = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_km_nomor', 'km_nomor', '`km_nomor`', '`km_nomor`', 200, -1, FALSE, '`km_nomor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->km_nomor->Sortable = TRUE; // Allow sort
		$this->fields['km_nomor'] = &$this->km_nomor;

		// km_tanggal
		$this->km_tanggal = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_km_tanggal', 'km_tanggal', '`km_tanggal`', ew_CastDateFieldForLike('`km_tanggal`', 0, "DB"), 133, 0, FALSE, '`km_tanggal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->km_tanggal->Sortable = TRUE; // Allow sort
		$this->km_tanggal->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['km_tanggal'] = &$this->km_tanggal;

		// customer_id
		$this->customer_id = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_customer_id', 'customer_id', '`customer_id`', '`customer_id`', 3, -1, FALSE, '`customer_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_id->Sortable = TRUE; // Allow sort
		$this->customer_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['customer_id'] = &$this->customer_id;

		// customer_name
		$this->customer_name = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_customer_name', 'customer_name', '`customer_name`', '`customer_name`', 200, -1, FALSE, '`customer_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_name->Sortable = TRUE; // Allow sort
		$this->fields['customer_name'] = &$this->customer_name;

		// km_type
		$this->km_type = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_km_type', 'km_type', '`km_type`', '`km_type`', 202, -1, FALSE, '`km_type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->km_type->Sortable = TRUE; // Allow sort
		$this->km_type->OptionCount = 2;
		$this->fields['km_type'] = &$this->km_type;

		// km_acc
		$this->km_acc = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_km_acc', 'km_acc', '`km_acc`', '`km_acc`', 200, -1, FALSE, '`km_acc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->km_acc->Sortable = TRUE; // Allow sort
		$this->fields['km_acc'] = &$this->km_acc;

		// cek_no
		$this->cek_no = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_cek_no', 'cek_no', '`cek_no`', '`cek_no`', 200, -1, FALSE, '`cek_no`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cek_no->Sortable = TRUE; // Allow sort
		$this->fields['cek_no'] = &$this->cek_no;

		// tgl_jt
		$this->tgl_jt = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_tgl_jt', 'tgl_jt', '`tgl_jt`', ew_CastDateFieldForLike('`tgl_jt`', 0, "DB"), 133, 0, FALSE, '`tgl_jt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_jt->Sortable = TRUE; // Allow sort
		$this->tgl_jt->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['tgl_jt'] = &$this->tgl_jt;

		// cek_amt
		$this->cek_amt = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_cek_amt', 'cek_amt', '`cek_amt`', '`cek_amt`', 5, -1, FALSE, '`cek_amt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cek_amt->Sortable = TRUE; // Allow sort
		$this->cek_amt->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['cek_amt'] = &$this->cek_amt;

		// ret_number1
		$this->ret_number1 = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_ret_number1', 'ret_number1', '`ret_number1`', '`ret_number1`', 200, -1, FALSE, '`ret_number1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ret_number1->Sortable = TRUE; // Allow sort
		$this->fields['ret_number1'] = &$this->ret_number1;

		// ret_date1
		$this->ret_date1 = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_ret_date1', 'ret_date1', '`ret_date1`', ew_CastDateFieldForLike('`ret_date1`', 0, "DB"), 133, 0, FALSE, '`ret_date1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ret_date1->Sortable = TRUE; // Allow sort
		$this->ret_date1->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['ret_date1'] = &$this->ret_date1;

		// retur_amt1
		$this->retur_amt1 = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_retur_amt1', 'retur_amt1', '`retur_amt1`', '`retur_amt1`', 5, -1, FALSE, '`retur_amt1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->retur_amt1->Sortable = TRUE; // Allow sort
		$this->retur_amt1->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['retur_amt1'] = &$this->retur_amt1;

		// ret_number2
		$this->ret_number2 = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_ret_number2', 'ret_number2', '`ret_number2`', '`ret_number2`', 200, -1, FALSE, '`ret_number2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ret_number2->Sortable = TRUE; // Allow sort
		$this->fields['ret_number2'] = &$this->ret_number2;

		// ret_date2
		$this->ret_date2 = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_ret_date2', 'ret_date2', '`ret_date2`', ew_CastDateFieldForLike('`ret_date2`', 0, "DB"), 133, 0, FALSE, '`ret_date2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ret_date2->Sortable = TRUE; // Allow sort
		$this->ret_date2->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['ret_date2'] = &$this->ret_date2;

		// retur_amt2
		$this->retur_amt2 = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_retur_amt2', 'retur_amt2', '`retur_amt2`', '`retur_amt2`', 5, -1, FALSE, '`retur_amt2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->retur_amt2->Sortable = TRUE; // Allow sort
		$this->retur_amt2->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['retur_amt2'] = &$this->retur_amt2;

		// ret_number3
		$this->ret_number3 = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_ret_number3', 'ret_number3', '`ret_number3`', '`ret_number3`', 200, -1, FALSE, '`ret_number3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ret_number3->Sortable = TRUE; // Allow sort
		$this->fields['ret_number3'] = &$this->ret_number3;

		// ret_date3
		$this->ret_date3 = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_ret_date3', 'ret_date3', '`ret_date3`', ew_CastDateFieldForLike('`ret_date3`', 0, "DB"), 133, 0, FALSE, '`ret_date3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ret_date3->Sortable = TRUE; // Allow sort
		$this->ret_date3->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['ret_date3'] = &$this->ret_date3;

		// retur_amt3
		$this->retur_amt3 = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_retur_amt3', 'retur_amt3', '`retur_amt3`', '`retur_amt3`', 5, -1, FALSE, '`retur_amt3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->retur_amt3->Sortable = TRUE; // Allow sort
		$this->retur_amt3->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['retur_amt3'] = &$this->retur_amt3;

		// tunai_amt
		$this->tunai_amt = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_tunai_amt', 'tunai_amt', '`tunai_amt`', '`tunai_amt`', 5, -1, FALSE, '`tunai_amt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tunai_amt->Sortable = TRUE; // Allow sort
		$this->tunai_amt->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['tunai_amt'] = &$this->tunai_amt;

		// dp_amt
		$this->dp_amt = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_dp_amt', 'dp_amt', '`dp_amt`', '`dp_amt`', 5, -1, FALSE, '`dp_amt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dp_amt->Sortable = TRUE; // Allow sort
		$this->dp_amt->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['dp_amt'] = &$this->dp_amt;

		// km_amt
		$this->km_amt = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_km_amt', 'km_amt', '`km_amt`', '`km_amt`', 5, -1, FALSE, '`km_amt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->km_amt->Sortable = TRUE; // Allow sort
		$this->km_amt->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['km_amt'] = &$this->km_amt;

		// km_notes
		$this->km_notes = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_km_notes', 'km_notes', '`km_notes`', '`km_notes`', 200, -1, FALSE, '`km_notes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->km_notes->Sortable = TRUE; // Allow sort
		$this->fields['km_notes'] = &$this->km_notes;

		// kas_amt
		$this->kas_amt = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_kas_amt', 'kas_amt', '\'\'', '\'\'', 201, -1, FALSE, '\'\'', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kas_amt->FldIsCustom = TRUE; // Custom field
		$this->kas_amt->Sortable = TRUE; // Allow sort
		$this->fields['kas_amt'] = &$this->kas_amt;

		// kode_depo
		$this->kode_depo = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_kode_depo', 'kode_depo', '`kode_depo`', '`kode_depo`', 200, -1, FALSE, '`kode_depo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_depo->Sortable = TRUE; // Allow sort
		$this->fields['kode_depo'] = &$this->kode_depo;

		// sales_id
		$this->sales_id = new cField('tr_km_master_ar2', 'tr_km_master_ar2', 'x_sales_id', 'sales_id', '`sales_id`', '`sales_id`', 3, -1, FALSE, '`sales_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sales_id->Sortable = TRUE; // Allow sort
		$this->sales_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sales_id'] = &$this->sales_id;
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
		if ($this->getCurrentDetailTable() == "tr_km_item_ar2") {
			$sDetailUrl = $GLOBALS["tr_km_item_ar2"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_row_id=" . urlencode($this->row_id->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "tr_km_master_ar2list.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tr_km_master_ar2`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT *, '' AS `kas_amt` FROM " . $this->getSqlFrom();
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`km_nomor` DESC";
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

		// Cascade delete detail table 'tr_km_item_ar2'
		if (!isset($GLOBALS["tr_km_item_ar2"])) $GLOBALS["tr_km_item_ar2"] = new ctr_km_item_ar2();
		$rscascade = $GLOBALS["tr_km_item_ar2"]->LoadRs("`master_id` = " . ew_QuotedValue($rs['row_id'], EW_DATATYPE_NUMBER, "DB")); 
		$dtlrows = ($rscascade) ? $rscascade->GetRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$bDelete = $GLOBALS["tr_km_item_ar2"]->Row_Deleting($dtlrow);
			if (!$bDelete) break;
		}
		if ($bDelete) {
			foreach ($dtlrows as $dtlrow) {
				$bDelete = $GLOBALS["tr_km_item_ar2"]->Delete($dtlrow); // Delete
				if ($bDelete === FALSE)
					break;
			}
		}

		// Call Row Deleted event
		if ($bDelete) {
			foreach ($dtlrows as $dtlrow) {
				$GLOBALS["tr_km_item_ar2"]->Row_Deleted($dtlrow);
			}
		}
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
			return "tr_km_master_ar2list.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tr_km_master_ar2view.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tr_km_master_ar2edit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tr_km_master_ar2add.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tr_km_master_ar2list.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_km_master_ar2view.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_km_master_ar2view.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tr_km_master_ar2add.php?" . $this->UrlParm($parm);
		else
			$url = "tr_km_master_ar2add.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_km_master_ar2edit.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_km_master_ar2edit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
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
			$url = $this->KeyUrl("tr_km_master_ar2add.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_km_master_ar2add.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tr_km_master_ar2delete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
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
		$this->row_id->setDbValue($rs->fields('row_id'));
		$this->km_nomor->setDbValue($rs->fields('km_nomor'));
		$this->km_tanggal->setDbValue($rs->fields('km_tanggal'));
		$this->customer_id->setDbValue($rs->fields('customer_id'));
		$this->customer_name->setDbValue($rs->fields('customer_name'));
		$this->km_type->setDbValue($rs->fields('km_type'));
		$this->km_acc->setDbValue($rs->fields('km_acc'));
		$this->cek_no->setDbValue($rs->fields('cek_no'));
		$this->tgl_jt->setDbValue($rs->fields('tgl_jt'));
		$this->cek_amt->setDbValue($rs->fields('cek_amt'));
		$this->ret_number1->setDbValue($rs->fields('ret_number1'));
		$this->ret_date1->setDbValue($rs->fields('ret_date1'));
		$this->retur_amt1->setDbValue($rs->fields('retur_amt1'));
		$this->ret_number2->setDbValue($rs->fields('ret_number2'));
		$this->ret_date2->setDbValue($rs->fields('ret_date2'));
		$this->retur_amt2->setDbValue($rs->fields('retur_amt2'));
		$this->ret_number3->setDbValue($rs->fields('ret_number3'));
		$this->ret_date3->setDbValue($rs->fields('ret_date3'));
		$this->retur_amt3->setDbValue($rs->fields('retur_amt3'));
		$this->tunai_amt->setDbValue($rs->fields('tunai_amt'));
		$this->dp_amt->setDbValue($rs->fields('dp_amt'));
		$this->km_amt->setDbValue($rs->fields('km_amt'));
		$this->km_notes->setDbValue($rs->fields('km_notes'));
		$this->kas_amt->setDbValue($rs->fields('kas_amt'));
		$this->kode_depo->setDbValue($rs->fields('kode_depo'));
		$this->sales_id->setDbValue($rs->fields('sales_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// row_id
		// km_nomor
		// km_tanggal
		// customer_id
		// customer_name
		// km_type
		// km_acc
		// cek_no
		// tgl_jt
		// cek_amt
		// ret_number1
		// ret_date1
		// retur_amt1
		// ret_number2
		// ret_date2
		// retur_amt2
		// ret_number3
		// ret_date3
		// retur_amt3
		// tunai_amt
		// dp_amt
		// km_amt
		// km_notes
		// kas_amt
		// kode_depo
		// sales_id
		// row_id

		$this->row_id->ViewValue = $this->row_id->CurrentValue;
		$this->row_id->ViewCustomAttributes = "";

		// km_nomor
		$this->km_nomor->ViewValue = $this->km_nomor->CurrentValue;
		$this->km_nomor->ViewCustomAttributes = "";

		// km_tanggal
		$this->km_tanggal->ViewValue = $this->km_tanggal->CurrentValue;
		$this->km_tanggal->ViewValue = ew_FormatDateTime($this->km_tanggal->ViewValue, 0);
		$this->km_tanggal->ViewCustomAttributes = "";

		// customer_id
		$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
		if (strval($this->customer_id->CurrentValue) <> "") {
			$sFilterWrk = "`customer_id`" . ew_SearchString("=", $this->customer_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `customer_id`, `customer_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_customer`";
		$sWhereWrk = "";
		$this->customer_id->LookupFilters = array();
		$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
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

		// km_type
		if (strval($this->km_type->CurrentValue) <> "") {
			$this->km_type->ViewValue = $this->km_type->OptionCaption($this->km_type->CurrentValue);
		} else {
			$this->km_type->ViewValue = NULL;
		}
		$this->km_type->ViewCustomAttributes = "";

		// km_acc
		$this->km_acc->ViewValue = $this->km_acc->CurrentValue;
		$this->km_acc->ViewCustomAttributes = "";

		// cek_no
		$this->cek_no->ViewValue = $this->cek_no->CurrentValue;
		$this->cek_no->ViewCustomAttributes = "";

		// tgl_jt
		$this->tgl_jt->ViewValue = $this->tgl_jt->CurrentValue;
		$this->tgl_jt->ViewValue = ew_FormatDateTime($this->tgl_jt->ViewValue, 0);
		$this->tgl_jt->ViewCustomAttributes = "";

		// cek_amt
		$this->cek_amt->ViewValue = $this->cek_amt->CurrentValue;
		$this->cek_amt->ViewCustomAttributes = "";

		// ret_number1
		$this->ret_number1->ViewValue = $this->ret_number1->CurrentValue;
		$this->ret_number1->ViewCustomAttributes = "";

		// ret_date1
		$this->ret_date1->ViewValue = $this->ret_date1->CurrentValue;
		$this->ret_date1->ViewValue = ew_FormatDateTime($this->ret_date1->ViewValue, 0);
		$this->ret_date1->ViewCustomAttributes = "";

		// retur_amt1
		$this->retur_amt1->ViewValue = $this->retur_amt1->CurrentValue;
		$this->retur_amt1->ViewCustomAttributes = "";

		// ret_number2
		$this->ret_number2->ViewValue = $this->ret_number2->CurrentValue;
		$this->ret_number2->ViewCustomAttributes = "";

		// ret_date2
		$this->ret_date2->ViewValue = $this->ret_date2->CurrentValue;
		$this->ret_date2->ViewValue = ew_FormatDateTime($this->ret_date2->ViewValue, 0);
		$this->ret_date2->ViewCustomAttributes = "";

		// retur_amt2
		$this->retur_amt2->ViewValue = $this->retur_amt2->CurrentValue;
		$this->retur_amt2->ViewCustomAttributes = "";

		// ret_number3
		$this->ret_number3->ViewValue = $this->ret_number3->CurrentValue;
		$this->ret_number3->ViewCustomAttributes = "";

		// ret_date3
		$this->ret_date3->ViewValue = $this->ret_date3->CurrentValue;
		$this->ret_date3->ViewValue = ew_FormatDateTime($this->ret_date3->ViewValue, 0);
		$this->ret_date3->ViewCustomAttributes = "";

		// retur_amt3
		$this->retur_amt3->ViewValue = $this->retur_amt3->CurrentValue;
		$this->retur_amt3->ViewCustomAttributes = "";

		// tunai_amt
		$this->tunai_amt->ViewValue = $this->tunai_amt->CurrentValue;
		$this->tunai_amt->ViewCustomAttributes = "";

		// dp_amt
		$this->dp_amt->ViewValue = $this->dp_amt->CurrentValue;
		$this->dp_amt->ViewCustomAttributes = "";

		// km_amt
		$this->km_amt->ViewValue = $this->km_amt->CurrentValue;
		$this->km_amt->ViewCustomAttributes = "";

		// km_notes
		$this->km_notes->ViewValue = $this->km_notes->CurrentValue;
		$this->km_notes->ViewCustomAttributes = "";

		// kas_amt
		$this->kas_amt->ViewValue = $this->kas_amt->CurrentValue;
		$this->kas_amt->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// sales_id
		$this->sales_id->ViewValue = $this->sales_id->CurrentValue;
		$this->sales_id->ViewCustomAttributes = "";

		// row_id
		$this->row_id->LinkCustomAttributes = "";
		$this->row_id->HrefValue = "";
		$this->row_id->TooltipValue = "";

		// km_nomor
		$this->km_nomor->LinkCustomAttributes = "";
		$this->km_nomor->HrefValue = "";
		$this->km_nomor->TooltipValue = "";

		// km_tanggal
		$this->km_tanggal->LinkCustomAttributes = "";
		$this->km_tanggal->HrefValue = "";
		$this->km_tanggal->TooltipValue = "";

		// customer_id
		$this->customer_id->LinkCustomAttributes = "";
		$this->customer_id->HrefValue = "";
		$this->customer_id->TooltipValue = "";

		// customer_name
		$this->customer_name->LinkCustomAttributes = "";
		$this->customer_name->HrefValue = "";
		$this->customer_name->TooltipValue = "";

		// km_type
		$this->km_type->LinkCustomAttributes = "";
		$this->km_type->HrefValue = "";
		$this->km_type->TooltipValue = "";

		// km_acc
		$this->km_acc->LinkCustomAttributes = "";
		$this->km_acc->HrefValue = "";
		$this->km_acc->TooltipValue = "";

		// cek_no
		$this->cek_no->LinkCustomAttributes = "";
		$this->cek_no->HrefValue = "";
		$this->cek_no->TooltipValue = "";

		// tgl_jt
		$this->tgl_jt->LinkCustomAttributes = "";
		$this->tgl_jt->HrefValue = "";
		$this->tgl_jt->TooltipValue = "";

		// cek_amt
		$this->cek_amt->LinkCustomAttributes = "";
		$this->cek_amt->HrefValue = "";
		$this->cek_amt->TooltipValue = "";

		// ret_number1
		$this->ret_number1->LinkCustomAttributes = "";
		$this->ret_number1->HrefValue = "";
		$this->ret_number1->TooltipValue = "";

		// ret_date1
		$this->ret_date1->LinkCustomAttributes = "";
		$this->ret_date1->HrefValue = "";
		$this->ret_date1->TooltipValue = "";

		// retur_amt1
		$this->retur_amt1->LinkCustomAttributes = "";
		$this->retur_amt1->HrefValue = "";
		$this->retur_amt1->TooltipValue = "";

		// ret_number2
		$this->ret_number2->LinkCustomAttributes = "";
		$this->ret_number2->HrefValue = "";
		$this->ret_number2->TooltipValue = "";

		// ret_date2
		$this->ret_date2->LinkCustomAttributes = "";
		$this->ret_date2->HrefValue = "";
		$this->ret_date2->TooltipValue = "";

		// retur_amt2
		$this->retur_amt2->LinkCustomAttributes = "";
		$this->retur_amt2->HrefValue = "";
		$this->retur_amt2->TooltipValue = "";

		// ret_number3
		$this->ret_number3->LinkCustomAttributes = "";
		$this->ret_number3->HrefValue = "";
		$this->ret_number3->TooltipValue = "";

		// ret_date3
		$this->ret_date3->LinkCustomAttributes = "";
		$this->ret_date3->HrefValue = "";
		$this->ret_date3->TooltipValue = "";

		// retur_amt3
		$this->retur_amt3->LinkCustomAttributes = "";
		$this->retur_amt3->HrefValue = "";
		$this->retur_amt3->TooltipValue = "";

		// tunai_amt
		$this->tunai_amt->LinkCustomAttributes = "";
		$this->tunai_amt->HrefValue = "";
		$this->tunai_amt->TooltipValue = "";

		// dp_amt
		$this->dp_amt->LinkCustomAttributes = "";
		$this->dp_amt->HrefValue = "";
		$this->dp_amt->TooltipValue = "";

		// km_amt
		$this->km_amt->LinkCustomAttributes = "";
		$this->km_amt->HrefValue = "";
		$this->km_amt->TooltipValue = "";

		// km_notes
		$this->km_notes->LinkCustomAttributes = "";
		$this->km_notes->HrefValue = "";
		$this->km_notes->TooltipValue = "";

		// kas_amt
		$this->kas_amt->LinkCustomAttributes = "";
		$this->kas_amt->HrefValue = "";
		$this->kas_amt->TooltipValue = "";

		// kode_depo
		$this->kode_depo->LinkCustomAttributes = "";
		$this->kode_depo->HrefValue = "";
		$this->kode_depo->TooltipValue = "";

		// sales_id
		$this->sales_id->LinkCustomAttributes = "";
		$this->sales_id->HrefValue = "";
		$this->sales_id->TooltipValue = "";

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

		// row_id
		$this->row_id->EditAttrs["class"] = "form-control";
		$this->row_id->EditCustomAttributes = "";
		$this->row_id->EditValue = $this->row_id->CurrentValue;
		$this->row_id->ViewCustomAttributes = "";

		// km_nomor
		$this->km_nomor->EditAttrs["class"] = "form-control";
		$this->km_nomor->EditCustomAttributes = "";
		$this->km_nomor->EditValue = $this->km_nomor->CurrentValue;
		$this->km_nomor->PlaceHolder = ew_RemoveHtml($this->km_nomor->FldCaption());

		// km_tanggal
		$this->km_tanggal->EditAttrs["class"] = "form-control";
		$this->km_tanggal->EditCustomAttributes = "";
		$this->km_tanggal->EditValue = ew_FormatDateTime($this->km_tanggal->CurrentValue, 8);
		$this->km_tanggal->PlaceHolder = ew_RemoveHtml($this->km_tanggal->FldCaption());

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

		// km_type
		$this->km_type->EditCustomAttributes = "";
		$this->km_type->EditValue = $this->km_type->Options(FALSE);

		// km_acc
		$this->km_acc->EditAttrs["class"] = "form-control";
		$this->km_acc->EditCustomAttributes = "";
		$this->km_acc->EditValue = $this->km_acc->CurrentValue;
		$this->km_acc->PlaceHolder = ew_RemoveHtml($this->km_acc->FldCaption());

		// cek_no
		$this->cek_no->EditAttrs["class"] = "form-control";
		$this->cek_no->EditCustomAttributes = "";
		$this->cek_no->EditValue = $this->cek_no->CurrentValue;
		$this->cek_no->PlaceHolder = ew_RemoveHtml($this->cek_no->FldCaption());

		// tgl_jt
		$this->tgl_jt->EditAttrs["class"] = "form-control";
		$this->tgl_jt->EditCustomAttributes = "";
		$this->tgl_jt->EditValue = ew_FormatDateTime($this->tgl_jt->CurrentValue, 8);
		$this->tgl_jt->PlaceHolder = ew_RemoveHtml($this->tgl_jt->FldCaption());

		// cek_amt
		$this->cek_amt->EditAttrs["class"] = "form-control";
		$this->cek_amt->EditCustomAttributes = "";
		$this->cek_amt->EditValue = $this->cek_amt->CurrentValue;
		$this->cek_amt->PlaceHolder = ew_RemoveHtml($this->cek_amt->FldCaption());
		if (strval($this->cek_amt->EditValue) <> "" && is_numeric($this->cek_amt->EditValue)) $this->cek_amt->EditValue = ew_FormatNumber($this->cek_amt->EditValue, -2, -1, -2, 0);

		// ret_number1
		$this->ret_number1->EditAttrs["class"] = "form-control";
		$this->ret_number1->EditCustomAttributes = "";
		$this->ret_number1->EditValue = $this->ret_number1->CurrentValue;
		$this->ret_number1->PlaceHolder = ew_RemoveHtml($this->ret_number1->FldCaption());

		// ret_date1
		$this->ret_date1->EditAttrs["class"] = "form-control";
		$this->ret_date1->EditCustomAttributes = "";
		$this->ret_date1->EditValue = ew_FormatDateTime($this->ret_date1->CurrentValue, 8);
		$this->ret_date1->PlaceHolder = ew_RemoveHtml($this->ret_date1->FldCaption());

		// retur_amt1
		$this->retur_amt1->EditAttrs["class"] = "form-control";
		$this->retur_amt1->EditCustomAttributes = "";
		$this->retur_amt1->EditValue = $this->retur_amt1->CurrentValue;
		$this->retur_amt1->PlaceHolder = ew_RemoveHtml($this->retur_amt1->FldCaption());
		if (strval($this->retur_amt1->EditValue) <> "" && is_numeric($this->retur_amt1->EditValue)) $this->retur_amt1->EditValue = ew_FormatNumber($this->retur_amt1->EditValue, -2, -1, -2, 0);

		// ret_number2
		$this->ret_number2->EditAttrs["class"] = "form-control";
		$this->ret_number2->EditCustomAttributes = "";
		$this->ret_number2->EditValue = $this->ret_number2->CurrentValue;
		$this->ret_number2->PlaceHolder = ew_RemoveHtml($this->ret_number2->FldCaption());

		// ret_date2
		$this->ret_date2->EditAttrs["class"] = "form-control";
		$this->ret_date2->EditCustomAttributes = "";
		$this->ret_date2->EditValue = ew_FormatDateTime($this->ret_date2->CurrentValue, 8);
		$this->ret_date2->PlaceHolder = ew_RemoveHtml($this->ret_date2->FldCaption());

		// retur_amt2
		$this->retur_amt2->EditAttrs["class"] = "form-control";
		$this->retur_amt2->EditCustomAttributes = "";
		$this->retur_amt2->EditValue = $this->retur_amt2->CurrentValue;
		$this->retur_amt2->PlaceHolder = ew_RemoveHtml($this->retur_amt2->FldCaption());
		if (strval($this->retur_amt2->EditValue) <> "" && is_numeric($this->retur_amt2->EditValue)) $this->retur_amt2->EditValue = ew_FormatNumber($this->retur_amt2->EditValue, -2, -1, -2, 0);

		// ret_number3
		$this->ret_number3->EditAttrs["class"] = "form-control";
		$this->ret_number3->EditCustomAttributes = "";
		$this->ret_number3->EditValue = $this->ret_number3->CurrentValue;
		$this->ret_number3->PlaceHolder = ew_RemoveHtml($this->ret_number3->FldCaption());

		// ret_date3
		$this->ret_date3->EditAttrs["class"] = "form-control";
		$this->ret_date3->EditCustomAttributes = "";
		$this->ret_date3->EditValue = ew_FormatDateTime($this->ret_date3->CurrentValue, 8);
		$this->ret_date3->PlaceHolder = ew_RemoveHtml($this->ret_date3->FldCaption());

		// retur_amt3
		$this->retur_amt3->EditAttrs["class"] = "form-control";
		$this->retur_amt3->EditCustomAttributes = "";
		$this->retur_amt3->EditValue = $this->retur_amt3->CurrentValue;
		$this->retur_amt3->PlaceHolder = ew_RemoveHtml($this->retur_amt3->FldCaption());
		if (strval($this->retur_amt3->EditValue) <> "" && is_numeric($this->retur_amt3->EditValue)) $this->retur_amt3->EditValue = ew_FormatNumber($this->retur_amt3->EditValue, -2, -1, -2, 0);

		// tunai_amt
		$this->tunai_amt->EditAttrs["class"] = "form-control";
		$this->tunai_amt->EditCustomAttributes = "";
		$this->tunai_amt->EditValue = $this->tunai_amt->CurrentValue;
		$this->tunai_amt->PlaceHolder = ew_RemoveHtml($this->tunai_amt->FldCaption());
		if (strval($this->tunai_amt->EditValue) <> "" && is_numeric($this->tunai_amt->EditValue)) $this->tunai_amt->EditValue = ew_FormatNumber($this->tunai_amt->EditValue, -2, -1, -2, 0);

		// dp_amt
		$this->dp_amt->EditAttrs["class"] = "form-control";
		$this->dp_amt->EditCustomAttributes = "";
		$this->dp_amt->EditValue = $this->dp_amt->CurrentValue;
		$this->dp_amt->PlaceHolder = ew_RemoveHtml($this->dp_amt->FldCaption());
		if (strval($this->dp_amt->EditValue) <> "" && is_numeric($this->dp_amt->EditValue)) $this->dp_amt->EditValue = ew_FormatNumber($this->dp_amt->EditValue, -2, -1, -2, 0);

		// km_amt
		$this->km_amt->EditAttrs["class"] = "form-control";
		$this->km_amt->EditCustomAttributes = "";
		$this->km_amt->EditValue = $this->km_amt->CurrentValue;
		$this->km_amt->PlaceHolder = ew_RemoveHtml($this->km_amt->FldCaption());
		if (strval($this->km_amt->EditValue) <> "" && is_numeric($this->km_amt->EditValue)) $this->km_amt->EditValue = ew_FormatNumber($this->km_amt->EditValue, -2, -1, -2, 0);

		// km_notes
		$this->km_notes->EditAttrs["class"] = "form-control";
		$this->km_notes->EditCustomAttributes = "";
		$this->km_notes->EditValue = $this->km_notes->CurrentValue;
		$this->km_notes->PlaceHolder = ew_RemoveHtml($this->km_notes->FldCaption());

		// kas_amt
		$this->kas_amt->EditAttrs["class"] = "form-control";
		$this->kas_amt->EditCustomAttributes = "";
		$this->kas_amt->EditValue = $this->kas_amt->CurrentValue;
		$this->kas_amt->PlaceHolder = ew_RemoveHtml($this->kas_amt->FldCaption());

		// kode_depo
		$this->kode_depo->EditAttrs["class"] = "form-control";
		$this->kode_depo->EditCustomAttributes = "";
		$this->kode_depo->EditValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->PlaceHolder = ew_RemoveHtml($this->kode_depo->FldCaption());

		// sales_id
		$this->sales_id->EditAttrs["class"] = "form-control";
		$this->sales_id->EditCustomAttributes = "";
		$this->sales_id->EditValue = $this->sales_id->CurrentValue;
		$this->sales_id->PlaceHolder = ew_RemoveHtml($this->sales_id->FldCaption());

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
					if ($this->row_id->Exportable) $Doc->ExportCaption($this->row_id);
					if ($this->km_nomor->Exportable) $Doc->ExportCaption($this->km_nomor);
					if ($this->km_tanggal->Exportable) $Doc->ExportCaption($this->km_tanggal);
					if ($this->customer_id->Exportable) $Doc->ExportCaption($this->customer_id);
					if ($this->customer_name->Exportable) $Doc->ExportCaption($this->customer_name);
					if ($this->km_type->Exportable) $Doc->ExportCaption($this->km_type);
					if ($this->km_acc->Exportable) $Doc->ExportCaption($this->km_acc);
					if ($this->cek_no->Exportable) $Doc->ExportCaption($this->cek_no);
					if ($this->tgl_jt->Exportable) $Doc->ExportCaption($this->tgl_jt);
					if ($this->cek_amt->Exportable) $Doc->ExportCaption($this->cek_amt);
					if ($this->ret_number1->Exportable) $Doc->ExportCaption($this->ret_number1);
					if ($this->ret_date1->Exportable) $Doc->ExportCaption($this->ret_date1);
					if ($this->retur_amt1->Exportable) $Doc->ExportCaption($this->retur_amt1);
					if ($this->ret_number2->Exportable) $Doc->ExportCaption($this->ret_number2);
					if ($this->ret_date2->Exportable) $Doc->ExportCaption($this->ret_date2);
					if ($this->retur_amt2->Exportable) $Doc->ExportCaption($this->retur_amt2);
					if ($this->ret_number3->Exportable) $Doc->ExportCaption($this->ret_number3);
					if ($this->ret_date3->Exportable) $Doc->ExportCaption($this->ret_date3);
					if ($this->retur_amt3->Exportable) $Doc->ExportCaption($this->retur_amt3);
					if ($this->tunai_amt->Exportable) $Doc->ExportCaption($this->tunai_amt);
					if ($this->dp_amt->Exportable) $Doc->ExportCaption($this->dp_amt);
					if ($this->km_amt->Exportable) $Doc->ExportCaption($this->km_amt);
					if ($this->km_notes->Exportable) $Doc->ExportCaption($this->km_notes);
					if ($this->kas_amt->Exportable) $Doc->ExportCaption($this->kas_amt);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
					if ($this->sales_id->Exportable) $Doc->ExportCaption($this->sales_id);
				} else {
					if ($this->row_id->Exportable) $Doc->ExportCaption($this->row_id);
					if ($this->km_nomor->Exportable) $Doc->ExportCaption($this->km_nomor);
					if ($this->km_tanggal->Exportable) $Doc->ExportCaption($this->km_tanggal);
					if ($this->customer_id->Exportable) $Doc->ExportCaption($this->customer_id);
					if ($this->customer_name->Exportable) $Doc->ExportCaption($this->customer_name);
					if ($this->km_type->Exportable) $Doc->ExportCaption($this->km_type);
					if ($this->km_acc->Exportable) $Doc->ExportCaption($this->km_acc);
					if ($this->cek_no->Exportable) $Doc->ExportCaption($this->cek_no);
					if ($this->tgl_jt->Exportable) $Doc->ExportCaption($this->tgl_jt);
					if ($this->cek_amt->Exportable) $Doc->ExportCaption($this->cek_amt);
					if ($this->ret_number1->Exportable) $Doc->ExportCaption($this->ret_number1);
					if ($this->ret_date1->Exportable) $Doc->ExportCaption($this->ret_date1);
					if ($this->retur_amt1->Exportable) $Doc->ExportCaption($this->retur_amt1);
					if ($this->ret_number2->Exportable) $Doc->ExportCaption($this->ret_number2);
					if ($this->ret_date2->Exportable) $Doc->ExportCaption($this->ret_date2);
					if ($this->retur_amt2->Exportable) $Doc->ExportCaption($this->retur_amt2);
					if ($this->ret_number3->Exportable) $Doc->ExportCaption($this->ret_number3);
					if ($this->ret_date3->Exportable) $Doc->ExportCaption($this->ret_date3);
					if ($this->retur_amt3->Exportable) $Doc->ExportCaption($this->retur_amt3);
					if ($this->tunai_amt->Exportable) $Doc->ExportCaption($this->tunai_amt);
					if ($this->dp_amt->Exportable) $Doc->ExportCaption($this->dp_amt);
					if ($this->km_amt->Exportable) $Doc->ExportCaption($this->km_amt);
					if ($this->km_notes->Exportable) $Doc->ExportCaption($this->km_notes);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
					if ($this->sales_id->Exportable) $Doc->ExportCaption($this->sales_id);
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
						if ($this->row_id->Exportable) $Doc->ExportField($this->row_id);
						if ($this->km_nomor->Exportable) $Doc->ExportField($this->km_nomor);
						if ($this->km_tanggal->Exportable) $Doc->ExportField($this->km_tanggal);
						if ($this->customer_id->Exportable) $Doc->ExportField($this->customer_id);
						if ($this->customer_name->Exportable) $Doc->ExportField($this->customer_name);
						if ($this->km_type->Exportable) $Doc->ExportField($this->km_type);
						if ($this->km_acc->Exportable) $Doc->ExportField($this->km_acc);
						if ($this->cek_no->Exportable) $Doc->ExportField($this->cek_no);
						if ($this->tgl_jt->Exportable) $Doc->ExportField($this->tgl_jt);
						if ($this->cek_amt->Exportable) $Doc->ExportField($this->cek_amt);
						if ($this->ret_number1->Exportable) $Doc->ExportField($this->ret_number1);
						if ($this->ret_date1->Exportable) $Doc->ExportField($this->ret_date1);
						if ($this->retur_amt1->Exportable) $Doc->ExportField($this->retur_amt1);
						if ($this->ret_number2->Exportable) $Doc->ExportField($this->ret_number2);
						if ($this->ret_date2->Exportable) $Doc->ExportField($this->ret_date2);
						if ($this->retur_amt2->Exportable) $Doc->ExportField($this->retur_amt2);
						if ($this->ret_number3->Exportable) $Doc->ExportField($this->ret_number3);
						if ($this->ret_date3->Exportable) $Doc->ExportField($this->ret_date3);
						if ($this->retur_amt3->Exportable) $Doc->ExportField($this->retur_amt3);
						if ($this->tunai_amt->Exportable) $Doc->ExportField($this->tunai_amt);
						if ($this->dp_amt->Exportable) $Doc->ExportField($this->dp_amt);
						if ($this->km_amt->Exportable) $Doc->ExportField($this->km_amt);
						if ($this->km_notes->Exportable) $Doc->ExportField($this->km_notes);
						if ($this->kas_amt->Exportable) $Doc->ExportField($this->kas_amt);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
						if ($this->sales_id->Exportable) $Doc->ExportField($this->sales_id);
					} else {
						if ($this->row_id->Exportable) $Doc->ExportField($this->row_id);
						if ($this->km_nomor->Exportable) $Doc->ExportField($this->km_nomor);
						if ($this->km_tanggal->Exportable) $Doc->ExportField($this->km_tanggal);
						if ($this->customer_id->Exportable) $Doc->ExportField($this->customer_id);
						if ($this->customer_name->Exportable) $Doc->ExportField($this->customer_name);
						if ($this->km_type->Exportable) $Doc->ExportField($this->km_type);
						if ($this->km_acc->Exportable) $Doc->ExportField($this->km_acc);
						if ($this->cek_no->Exportable) $Doc->ExportField($this->cek_no);
						if ($this->tgl_jt->Exportable) $Doc->ExportField($this->tgl_jt);
						if ($this->cek_amt->Exportable) $Doc->ExportField($this->cek_amt);
						if ($this->ret_number1->Exportable) $Doc->ExportField($this->ret_number1);
						if ($this->ret_date1->Exportable) $Doc->ExportField($this->ret_date1);
						if ($this->retur_amt1->Exportable) $Doc->ExportField($this->retur_amt1);
						if ($this->ret_number2->Exportable) $Doc->ExportField($this->ret_number2);
						if ($this->ret_date2->Exportable) $Doc->ExportField($this->ret_date2);
						if ($this->retur_amt2->Exportable) $Doc->ExportField($this->retur_amt2);
						if ($this->ret_number3->Exportable) $Doc->ExportField($this->ret_number3);
						if ($this->ret_date3->Exportable) $Doc->ExportField($this->ret_date3);
						if ($this->retur_amt3->Exportable) $Doc->ExportField($this->retur_amt3);
						if ($this->tunai_amt->Exportable) $Doc->ExportField($this->tunai_amt);
						if ($this->dp_amt->Exportable) $Doc->ExportField($this->dp_amt);
						if ($this->km_amt->Exportable) $Doc->ExportField($this->km_amt);
						if ($this->km_notes->Exportable) $Doc->ExportField($this->km_notes);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
						if ($this->sales_id->Exportable) $Doc->ExportField($this->sales_id);
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

		$rsnew["kode_depo"] = @$_SESSION["KodeDepo"];;
		$rsnew["km_nomor"] = GetNextkm2Number();
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
			$this->km_nomor->CurrentValue = GetNextkm2Number();
			$this->km_nomor->EditValue = $this->km_nomor->CurrentValue; 
		}
		$this->km_nomor->ReadOnly = TRUE;	
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
