<?php

// Global variable for table object
$tr_inv_canvas_master = NULL;

//
// Table class for tr_inv_canvas_master
//
class ctr_inv_canvas_master extends cTable {
	var $inv_id;
	var $inv_number;
	var $inv_date;
	var $tax_type;
	var $due_date;
	var $customer_id;
	var $address1;
	var $address2;
	var $address3;
	var $wilayah_id;
	var $subwil_id;
	var $area_id;
	var $customer_name;
	var $tax_number;
	var $tc_number;
	var $inv_amt;
	var $discount;
	var $total_discount;
	var $is_tax;
	var $tax_total;
	var $inv_total;
	var $paid_amt;
	var $sales_id;
	var $paid;
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
		$this->TableVar = 'tr_inv_canvas_master';
		$this->TableName = 'tr_inv_canvas_master';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tr_inv_canvas_master`";
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

		// inv_id
		$this->inv_id = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_inv_id', 'inv_id', '`inv_id`', '`inv_id`', 3, -1, FALSE, '`inv_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->inv_id->Sortable = TRUE; // Allow sort
		$this->inv_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['inv_id'] = &$this->inv_id;

		// inv_number
		$this->inv_number = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_inv_number', 'inv_number', '`inv_number`', '`inv_number`', 200, -1, FALSE, '`inv_number`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->inv_number->Sortable = TRUE; // Allow sort
		$this->fields['inv_number'] = &$this->inv_number;

		// inv_date
		$this->inv_date = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_inv_date', 'inv_date', '`inv_date`', ew_CastDateFieldForLike('`inv_date`', 7, "DB"), 133, 7, FALSE, '`inv_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->inv_date->Sortable = TRUE; // Allow sort
		$this->inv_date->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['inv_date'] = &$this->inv_date;

		// tax_type
		$this->tax_type = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_tax_type', 'tax_type', '`tax_type`', '`tax_type`', 3, -1, FALSE, '`tax_type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->tax_type->Sortable = TRUE; // Allow sort
		$this->tax_type->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tax_type'] = &$this->tax_type;

		// due_date
		$this->due_date = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_due_date', 'due_date', '`due_date`', ew_CastDateFieldForLike('`due_date`', 7, "DB"), 133, 7, FALSE, '`due_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->due_date->Sortable = TRUE; // Allow sort
		$this->due_date->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['due_date'] = &$this->due_date;

		// customer_id
		$this->customer_id = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_customer_id', 'customer_id', '`customer_id`', '`customer_id`', 3, -1, FALSE, '`customer_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_id->Sortable = TRUE; // Allow sort
		$this->customer_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['customer_id'] = &$this->customer_id;

		// address1
		$this->address1 = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_address1', 'address1', '`address1`', '`address1`', 200, -1, FALSE, '`address1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address1->Sortable = TRUE; // Allow sort
		$this->fields['address1'] = &$this->address1;

		// address2
		$this->address2 = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_address2', 'address2', '`address2`', '`address2`', 200, -1, FALSE, '`address2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address2->Sortable = TRUE; // Allow sort
		$this->fields['address2'] = &$this->address2;

		// address3
		$this->address3 = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_address3', 'address3', '`address3`', '`address3`', 200, -1, FALSE, '`address3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->address3->Sortable = TRUE; // Allow sort
		$this->fields['address3'] = &$this->address3;

		// wilayah_id
		$this->wilayah_id = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_wilayah_id', 'wilayah_id', '`wilayah_id`', '`wilayah_id`', 3, -1, FALSE, '`wilayah_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->wilayah_id->Sortable = TRUE; // Allow sort
		$this->wilayah_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['wilayah_id'] = &$this->wilayah_id;

		// subwil_id
		$this->subwil_id = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_subwil_id', 'subwil_id', '`subwil_id`', '`subwil_id`', 3, -1, FALSE, '`subwil_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->subwil_id->Sortable = TRUE; // Allow sort
		$this->subwil_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['subwil_id'] = &$this->subwil_id;

		// area_id
		$this->area_id = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_area_id', 'area_id', '`area_id`', '`area_id`', 3, -1, FALSE, '`area_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->area_id->Sortable = TRUE; // Allow sort
		$this->area_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['area_id'] = &$this->area_id;

		// customer_name
		$this->customer_name = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_customer_name', 'customer_name', '`customer_name`', '`customer_name`', 200, -1, FALSE, '`customer_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->customer_name->Sortable = TRUE; // Allow sort
		$this->fields['customer_name'] = &$this->customer_name;

		// tax_number
		$this->tax_number = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_tax_number', 'tax_number', '`tax_number`', '`tax_number`', 200, -1, FALSE, '`tax_number`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->tax_number->Sortable = TRUE; // Allow sort
		$this->fields['tax_number'] = &$this->tax_number;

		// tc_number
		$this->tc_number = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_tc_number', 'tc_number', '`tc_number`', '`tc_number`', 200, -1, FALSE, '`tc_number`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->tc_number->Sortable = TRUE; // Allow sort
		$this->fields['tc_number'] = &$this->tc_number;

		// inv_amt
		$this->inv_amt = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_inv_amt', 'inv_amt', '`inv_amt`', '`inv_amt`', 5, -1, FALSE, '`inv_amt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->inv_amt->Sortable = TRUE; // Allow sort
		$this->inv_amt->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['inv_amt'] = &$this->inv_amt;

		// discount
		$this->discount = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_discount', 'discount', '`discount`', '`discount`', 5, -1, FALSE, '`discount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->discount->Sortable = TRUE; // Allow sort
		$this->discount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['discount'] = &$this->discount;

		// total_discount
		$this->total_discount = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_total_discount', 'total_discount', '`total_discount`', '`total_discount`', 5, -1, FALSE, '`total_discount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_discount->Sortable = TRUE; // Allow sort
		$this->total_discount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['total_discount'] = &$this->total_discount;

		// is_tax
		$this->is_tax = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_is_tax', 'is_tax', '`is_tax`', '`is_tax`', 202, -1, FALSE, '`is_tax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->is_tax->Sortable = TRUE; // Allow sort
		$this->is_tax->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->is_tax->OptionCount = 2;
		$this->fields['is_tax'] = &$this->is_tax;

		// tax_total
		$this->tax_total = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_tax_total', 'tax_total', '`tax_total`', '`tax_total`', 5, -1, FALSE, '`tax_total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->tax_total->Sortable = TRUE; // Allow sort
		$this->tax_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['tax_total'] = &$this->tax_total;

		// inv_total
		$this->inv_total = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_inv_total', 'inv_total', '`inv_total`', '`inv_total`', 5, -1, FALSE, '`inv_total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->inv_total->Sortable = TRUE; // Allow sort
		$this->inv_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['inv_total'] = &$this->inv_total;

		// paid_amt
		$this->paid_amt = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_paid_amt', 'paid_amt', '`paid_amt`', '`paid_amt`', 5, -1, FALSE, '`paid_amt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->paid_amt->Sortable = TRUE; // Allow sort
		$this->paid_amt->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['paid_amt'] = &$this->paid_amt;

		// sales_id
		$this->sales_id = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_sales_id', 'sales_id', '`sales_id`', '`sales_id`', 3, -1, FALSE, '`sales_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->sales_id->Sortable = TRUE; // Allow sort
		$this->sales_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sales_id'] = &$this->sales_id;

		// paid
		$this->paid = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_paid', 'paid', '`paid`', '`paid`', 202, -1, FALSE, '`paid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->paid->Sortable = TRUE; // Allow sort
		$this->paid->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->paid->OptionCount = 2;
		$this->fields['paid'] = &$this->paid;

		// user_id
		$this->user_id = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 3, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->user_id->Sortable = TRUE; // Allow sort
		$this->user_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['user_id'] = &$this->user_id;

		// lastupdate
		$this->lastupdate = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_lastupdate', 'lastupdate', '`lastupdate`', ew_CastDateFieldForLike('`lastupdate`', 0, "DB"), 135, 0, FALSE, '`lastupdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->lastupdate->Sortable = TRUE; // Allow sort
		$this->lastupdate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['lastupdate'] = &$this->lastupdate;

		// kode_depo
		$this->kode_depo = new cField('tr_inv_canvas_master', 'tr_inv_canvas_master', 'x_kode_depo', 'kode_depo', '`kode_depo`', '`kode_depo`', 200, -1, FALSE, '`kode_depo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
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
		if ($this->getCurrentDetailTable() == "tr_inv_canvas_item") {
			$sDetailUrl = $GLOBALS["tr_inv_canvas_item"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_inv_id=" . urlencode($this->inv_id->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "tr_inv_canvas_masterlist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tr_inv_canvas_master`";
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
		$this->TableFilter = "`kode_depo` ='".@$_SESSION["KodeDepo"]."' and `user_id` = '".@$_SESSION["userID"]."'";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`inv_number` DESC";
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
			$this->inv_id->setDbValue($conn->Insert_ID());
			$rs['inv_id'] = $this->inv_id->DbValue;
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
			if (array_key_exists('inv_id', $rs))
				ew_AddFilter($where, ew_QuotedName('inv_id', $this->DBID) . '=' . ew_QuotedValue($rs['inv_id'], $this->inv_id->FldDataType, $this->DBID));
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

		// Cascade delete detail table 'tr_inv_canvas_item'
		if (!isset($GLOBALS["tr_inv_canvas_item"])) $GLOBALS["tr_inv_canvas_item"] = new ctr_inv_canvas_item();
		$rscascade = $GLOBALS["tr_inv_canvas_item"]->LoadRs("`master_id` = " . ew_QuotedValue($rs['inv_id'], EW_DATATYPE_NUMBER, "DB")); 
		$dtlrows = ($rscascade) ? $rscascade->GetRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$bDelete = $GLOBALS["tr_inv_canvas_item"]->Row_Deleting($dtlrow);
			if (!$bDelete) break;
		}
		if ($bDelete) {
			foreach ($dtlrows as $dtlrow) {
				$bDelete = $GLOBALS["tr_inv_canvas_item"]->Delete($dtlrow); // Delete
				if ($bDelete === FALSE)
					break;
			}
		}

		// Call Row Deleted event
		if ($bDelete) {
			foreach ($dtlrows as $dtlrow) {
				$GLOBALS["tr_inv_canvas_item"]->Row_Deleted($dtlrow);
			}
		}
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`inv_id` = @inv_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->inv_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->inv_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@inv_id@", ew_AdjustSql($this->inv_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "tr_inv_canvas_masterlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tr_inv_canvas_masterview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tr_inv_canvas_masteredit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tr_inv_canvas_masteradd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tr_inv_canvas_masterlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_inv_canvas_masterview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_inv_canvas_masterview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tr_inv_canvas_masteradd.php?" . $this->UrlParm($parm);
		else
			$url = "tr_inv_canvas_masteradd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tr_inv_canvas_masteredit.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_inv_canvas_masteredit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
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
			$url = $this->KeyUrl("tr_inv_canvas_masteradd.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tr_inv_canvas_masteradd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tr_inv_canvas_masterdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "inv_id:" . ew_VarToJson($this->inv_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->inv_id->CurrentValue)) {
			$sUrl .= "inv_id=" . urlencode($this->inv_id->CurrentValue);
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
			if ($isPost && isset($_POST["inv_id"]))
				$arKeys[] = $_POST["inv_id"];
			elseif (isset($_GET["inv_id"]))
				$arKeys[] = $_GET["inv_id"];
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
			$this->inv_id->CurrentValue = $key;
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
		$this->inv_id->setDbValue($rs->fields('inv_id'));
		$this->inv_number->setDbValue($rs->fields('inv_number'));
		$this->inv_date->setDbValue($rs->fields('inv_date'));
		$this->tax_type->setDbValue($rs->fields('tax_type'));
		$this->due_date->setDbValue($rs->fields('due_date'));
		$this->customer_id->setDbValue($rs->fields('customer_id'));
		$this->address1->setDbValue($rs->fields('address1'));
		$this->address2->setDbValue($rs->fields('address2'));
		$this->address3->setDbValue($rs->fields('address3'));
		$this->wilayah_id->setDbValue($rs->fields('wilayah_id'));
		$this->subwil_id->setDbValue($rs->fields('subwil_id'));
		$this->area_id->setDbValue($rs->fields('area_id'));
		$this->customer_name->setDbValue($rs->fields('customer_name'));
		$this->tax_number->setDbValue($rs->fields('tax_number'));
		$this->tc_number->setDbValue($rs->fields('tc_number'));
		$this->inv_amt->setDbValue($rs->fields('inv_amt'));
		$this->discount->setDbValue($rs->fields('discount'));
		$this->total_discount->setDbValue($rs->fields('total_discount'));
		$this->is_tax->setDbValue($rs->fields('is_tax'));
		$this->tax_total->setDbValue($rs->fields('tax_total'));
		$this->inv_total->setDbValue($rs->fields('inv_total'));
		$this->paid_amt->setDbValue($rs->fields('paid_amt'));
		$this->sales_id->setDbValue($rs->fields('sales_id'));
		$this->paid->setDbValue($rs->fields('paid'));
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
		// inv_id
		// inv_number
		// inv_date
		// tax_type
		// due_date
		// customer_id
		// address1
		// address2
		// address3
		// wilayah_id
		// subwil_id
		// area_id
		// customer_name
		// tax_number
		// tc_number
		// inv_amt
		// discount
		// total_discount
		// is_tax
		// tax_total
		// inv_total
		// paid_amt
		// sales_id
		// paid
		// user_id
		// lastupdate
		// kode_depo
		// inv_id

		$this->inv_id->ViewValue = $this->inv_id->CurrentValue;
		$this->inv_id->ViewCustomAttributes = "";

		// inv_number
		$this->inv_number->ViewValue = $this->inv_number->CurrentValue;
		$this->inv_number->ViewCustomAttributes = "";

		// inv_date
		$this->inv_date->ViewValue = $this->inv_date->CurrentValue;
		$this->inv_date->ViewValue = ew_FormatDateTime($this->inv_date->ViewValue, 7);
		$this->inv_date->ViewCustomAttributes = "";

		// tax_type
		$this->tax_type->ViewValue = $this->tax_type->CurrentValue;
		$this->tax_type->ViewCustomAttributes = "";

		// due_date
		$this->due_date->ViewValue = $this->due_date->CurrentValue;
		$this->due_date->ViewValue = ew_FormatDateTime($this->due_date->ViewValue, 7);
		$this->due_date->ViewCustomAttributes = "";

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

		// address1
		$this->address1->ViewValue = $this->address1->CurrentValue;
		$this->address1->ViewCustomAttributes = "";

		// address2
		$this->address2->ViewValue = $this->address2->CurrentValue;
		$this->address2->ViewCustomAttributes = "";

		// address3
		$this->address3->ViewValue = $this->address3->CurrentValue;
		$this->address3->ViewCustomAttributes = "";

		// wilayah_id
		$this->wilayah_id->ViewValue = $this->wilayah_id->CurrentValue;
		$this->wilayah_id->ViewCustomAttributes = "";

		// subwil_id
		$this->subwil_id->ViewValue = $this->subwil_id->CurrentValue;
		$this->subwil_id->ViewCustomAttributes = "";

		// area_id
		$this->area_id->ViewValue = $this->area_id->CurrentValue;
		$this->area_id->ViewCustomAttributes = "";

		// customer_name
		$this->customer_name->ViewValue = $this->customer_name->CurrentValue;
		$this->customer_name->ViewCustomAttributes = "";

		// tax_number
		$this->tax_number->ViewValue = $this->tax_number->CurrentValue;
		$this->tax_number->ViewCustomAttributes = "";

		// tc_number
		$this->tc_number->ViewValue = $this->tc_number->CurrentValue;
		$this->tc_number->ViewCustomAttributes = "";

		// inv_amt
		$this->inv_amt->ViewValue = $this->inv_amt->CurrentValue;
		$this->inv_amt->ViewValue = ew_FormatNumber($this->inv_amt->ViewValue, 2, -2, -2, -2);
		$this->inv_amt->CellCssStyle .= "text-align: right;";
		$this->inv_amt->ViewCustomAttributes = "";

		// discount
		$this->discount->ViewValue = $this->discount->CurrentValue;
		$this->discount->ViewValue = ew_FormatNumber($this->discount->ViewValue, 2, -2, -2, -2);
		$this->discount->CellCssStyle .= "text-align: right;";
		$this->discount->ViewCustomAttributes = "";

		// total_discount
		$this->total_discount->ViewValue = $this->total_discount->CurrentValue;
		$this->total_discount->ViewValue = ew_FormatNumber($this->total_discount->ViewValue, 2, -2, -2, -2);
		$this->total_discount->CellCssStyle .= "text-align: right;";
		$this->total_discount->ViewCustomAttributes = "";

		// is_tax
		if (ew_ConvertToBool($this->is_tax->CurrentValue)) {
			$this->is_tax->ViewValue = $this->is_tax->FldTagCaption(1) <> "" ? $this->is_tax->FldTagCaption(1) : "1";
		} else {
			$this->is_tax->ViewValue = $this->is_tax->FldTagCaption(2) <> "" ? $this->is_tax->FldTagCaption(2) : "0";
		}
		$this->is_tax->ViewCustomAttributes = "";

		// tax_total
		$this->tax_total->ViewValue = $this->tax_total->CurrentValue;
		$this->tax_total->ViewValue = ew_FormatNumber($this->tax_total->ViewValue, 2, -2, -2, -2);
		$this->tax_total->CellCssStyle .= "text-align: right;";
		$this->tax_total->ViewCustomAttributes = "";

		// inv_total
		$this->inv_total->ViewValue = $this->inv_total->CurrentValue;
		$this->inv_total->ViewValue = ew_FormatNumber($this->inv_total->ViewValue, 2, -2, -2, -2);
		$this->inv_total->CellCssStyle .= "text-align: right;";
		$this->inv_total->ViewCustomAttributes = "";

		// paid_amt
		$this->paid_amt->ViewValue = $this->paid_amt->CurrentValue;
		$this->paid_amt->ViewValue = ew_FormatNumber($this->paid_amt->ViewValue, 2, -2, -2, -2);
		$this->paid_amt->CellCssStyle .= "text-align: right;";
		$this->paid_amt->ViewCustomAttributes = "";

		// sales_id
		$this->sales_id->ViewValue = $this->sales_id->CurrentValue;
		$this->sales_id->ViewCustomAttributes = "";

		// paid
		if (ew_ConvertToBool($this->paid->CurrentValue)) {
			$this->paid->ViewValue = $this->paid->FldTagCaption(1) <> "" ? $this->paid->FldTagCaption(1) : "1";
		} else {
			$this->paid->ViewValue = $this->paid->FldTagCaption(2) <> "" ? $this->paid->FldTagCaption(2) : "0";
		}
		$this->paid->CellCssStyle .= "text-align: center;";
		$this->paid->ViewCustomAttributes = "";

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

		// inv_id
		$this->inv_id->LinkCustomAttributes = "";
		$this->inv_id->HrefValue = "";
		$this->inv_id->TooltipValue = "";

		// inv_number
		$this->inv_number->LinkCustomAttributes = "";
		$this->inv_number->HrefValue = "";
		$this->inv_number->TooltipValue = "";

		// inv_date
		$this->inv_date->LinkCustomAttributes = "";
		$this->inv_date->HrefValue = "";
		$this->inv_date->TooltipValue = "";

		// tax_type
		$this->tax_type->LinkCustomAttributes = "";
		$this->tax_type->HrefValue = "";
		$this->tax_type->TooltipValue = "";

		// due_date
		$this->due_date->LinkCustomAttributes = "";
		$this->due_date->HrefValue = "";
		$this->due_date->TooltipValue = "";

		// customer_id
		$this->customer_id->LinkCustomAttributes = "";
		$this->customer_id->HrefValue = "";
		$this->customer_id->TooltipValue = "";

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

		// wilayah_id
		$this->wilayah_id->LinkCustomAttributes = "";
		$this->wilayah_id->HrefValue = "";
		$this->wilayah_id->TooltipValue = "";

		// subwil_id
		$this->subwil_id->LinkCustomAttributes = "";
		$this->subwil_id->HrefValue = "";
		$this->subwil_id->TooltipValue = "";

		// area_id
		$this->area_id->LinkCustomAttributes = "";
		$this->area_id->HrefValue = "";
		$this->area_id->TooltipValue = "";

		// customer_name
		$this->customer_name->LinkCustomAttributes = "";
		$this->customer_name->HrefValue = "";
		$this->customer_name->TooltipValue = "";

		// tax_number
		$this->tax_number->LinkCustomAttributes = "";
		$this->tax_number->HrefValue = "";
		$this->tax_number->TooltipValue = "";

		// tc_number
		$this->tc_number->LinkCustomAttributes = "";
		$this->tc_number->HrefValue = "";
		$this->tc_number->TooltipValue = "";

		// inv_amt
		$this->inv_amt->LinkCustomAttributes = "";
		$this->inv_amt->HrefValue = "";
		$this->inv_amt->TooltipValue = "";

		// discount
		$this->discount->LinkCustomAttributes = "";
		$this->discount->HrefValue = "";
		$this->discount->TooltipValue = "";

		// total_discount
		$this->total_discount->LinkCustomAttributes = "";
		$this->total_discount->HrefValue = "";
		$this->total_discount->TooltipValue = "";

		// is_tax
		$this->is_tax->LinkCustomAttributes = "";
		$this->is_tax->HrefValue = "";
		$this->is_tax->TooltipValue = "";

		// tax_total
		$this->tax_total->LinkCustomAttributes = "";
		$this->tax_total->HrefValue = "";
		$this->tax_total->TooltipValue = "";

		// inv_total
		$this->inv_total->LinkCustomAttributes = "";
		$this->inv_total->HrefValue = "";
		$this->inv_total->TooltipValue = "";

		// paid_amt
		$this->paid_amt->LinkCustomAttributes = "";
		$this->paid_amt->HrefValue = "";
		$this->paid_amt->TooltipValue = "";

		// sales_id
		$this->sales_id->LinkCustomAttributes = "";
		$this->sales_id->HrefValue = "";
		$this->sales_id->TooltipValue = "";

		// paid
		$this->paid->LinkCustomAttributes = "";
		$this->paid->HrefValue = "";
		$this->paid->TooltipValue = "";

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

		// inv_id
		$this->inv_id->EditAttrs["class"] = "form-control";
		$this->inv_id->EditCustomAttributes = "";
		$this->inv_id->EditValue = $this->inv_id->CurrentValue;
		$this->inv_id->ViewCustomAttributes = "";

		// inv_number
		$this->inv_number->EditAttrs["class"] = "form-control";
		$this->inv_number->EditCustomAttributes = "";
		$this->inv_number->EditValue = $this->inv_number->CurrentValue;
		$this->inv_number->PlaceHolder = ew_RemoveHtml($this->inv_number->FldCaption());

		// inv_date
		$this->inv_date->EditAttrs["class"] = "form-control";
		$this->inv_date->EditCustomAttributes = "";
		$this->inv_date->EditValue = ew_FormatDateTime($this->inv_date->CurrentValue, 7);
		$this->inv_date->PlaceHolder = ew_RemoveHtml($this->inv_date->FldCaption());

		// tax_type
		$this->tax_type->EditAttrs["class"] = "form-control";
		$this->tax_type->EditCustomAttributes = "";

		// due_date
		$this->due_date->EditAttrs["class"] = "form-control";
		$this->due_date->EditCustomAttributes = "";
		$this->due_date->EditValue = ew_FormatDateTime($this->due_date->CurrentValue, 7);
		$this->due_date->PlaceHolder = ew_RemoveHtml($this->due_date->FldCaption());

		// customer_id
		$this->customer_id->EditAttrs["class"] = "form-control";
		$this->customer_id->EditCustomAttributes = "";
		$this->customer_id->EditValue = $this->customer_id->CurrentValue;
		$this->customer_id->PlaceHolder = ew_RemoveHtml($this->customer_id->FldCaption());

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

		// wilayah_id
		$this->wilayah_id->EditAttrs["class"] = "form-control";
		$this->wilayah_id->EditCustomAttributes = "";

		// subwil_id
		$this->subwil_id->EditAttrs["class"] = "form-control";
		$this->subwil_id->EditCustomAttributes = "";

		// area_id
		$this->area_id->EditAttrs["class"] = "form-control";
		$this->area_id->EditCustomAttributes = "";

		// customer_name
		$this->customer_name->EditAttrs["class"] = "form-control";
		$this->customer_name->EditCustomAttributes = "";

		// tax_number
		$this->tax_number->EditAttrs["class"] = "form-control";
		$this->tax_number->EditCustomAttributes = "";

		// tc_number
		$this->tc_number->EditAttrs["class"] = "form-control";
		$this->tc_number->EditCustomAttributes = "";

		// inv_amt
		$this->inv_amt->EditAttrs["class"] = "form-control";
		$this->inv_amt->EditCustomAttributes = "";
		$this->inv_amt->EditValue = $this->inv_amt->CurrentValue;
		$this->inv_amt->PlaceHolder = ew_RemoveHtml($this->inv_amt->FldCaption());
		if (strval($this->inv_amt->EditValue) <> "" && is_numeric($this->inv_amt->EditValue)) $this->inv_amt->EditValue = ew_FormatNumber($this->inv_amt->EditValue, -2, -2, -2, -2);

		// discount
		$this->discount->EditAttrs["class"] = "form-control";
		$this->discount->EditCustomAttributes = "";
		$this->discount->EditValue = $this->discount->CurrentValue;
		$this->discount->PlaceHolder = ew_RemoveHtml($this->discount->FldCaption());
		if (strval($this->discount->EditValue) <> "" && is_numeric($this->discount->EditValue)) $this->discount->EditValue = ew_FormatNumber($this->discount->EditValue, -2, -2, -2, -2);

		// total_discount
		$this->total_discount->EditAttrs["class"] = "form-control";
		$this->total_discount->EditCustomAttributes = "";
		$this->total_discount->EditValue = $this->total_discount->CurrentValue;
		$this->total_discount->PlaceHolder = ew_RemoveHtml($this->total_discount->FldCaption());
		if (strval($this->total_discount->EditValue) <> "" && is_numeric($this->total_discount->EditValue)) $this->total_discount->EditValue = ew_FormatNumber($this->total_discount->EditValue, -2, -2, -2, -2);

		// is_tax
		$this->is_tax->EditCustomAttributes = "";
		$this->is_tax->EditValue = $this->is_tax->Options(FALSE);

		// tax_total
		$this->tax_total->EditAttrs["class"] = "form-control";
		$this->tax_total->EditCustomAttributes = "";

		// inv_total
		$this->inv_total->EditAttrs["class"] = "form-control";
		$this->inv_total->EditCustomAttributes = "";
		$this->inv_total->EditValue = $this->inv_total->CurrentValue;
		$this->inv_total->PlaceHolder = ew_RemoveHtml($this->inv_total->FldCaption());
		if (strval($this->inv_total->EditValue) <> "" && is_numeric($this->inv_total->EditValue)) $this->inv_total->EditValue = ew_FormatNumber($this->inv_total->EditValue, -2, -2, -2, -2);

		// paid_amt
		$this->paid_amt->EditAttrs["class"] = "form-control";
		$this->paid_amt->EditCustomAttributes = "";

		// sales_id
		$this->sales_id->EditAttrs["class"] = "form-control";
		$this->sales_id->EditCustomAttributes = "";

		// paid
		$this->paid->EditCustomAttributes = "";
		$this->paid->EditValue = $this->paid->Options(FALSE);

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
					if ($this->inv_id->Exportable) $Doc->ExportCaption($this->inv_id);
					if ($this->inv_number->Exportable) $Doc->ExportCaption($this->inv_number);
					if ($this->inv_date->Exportable) $Doc->ExportCaption($this->inv_date);
					if ($this->tax_type->Exportable) $Doc->ExportCaption($this->tax_type);
					if ($this->due_date->Exportable) $Doc->ExportCaption($this->due_date);
					if ($this->customer_id->Exportable) $Doc->ExportCaption($this->customer_id);
					if ($this->address1->Exportable) $Doc->ExportCaption($this->address1);
					if ($this->address2->Exportable) $Doc->ExportCaption($this->address2);
					if ($this->address3->Exportable) $Doc->ExportCaption($this->address3);
					if ($this->wilayah_id->Exportable) $Doc->ExportCaption($this->wilayah_id);
					if ($this->subwil_id->Exportable) $Doc->ExportCaption($this->subwil_id);
					if ($this->area_id->Exportable) $Doc->ExportCaption($this->area_id);
					if ($this->customer_name->Exportable) $Doc->ExportCaption($this->customer_name);
					if ($this->tax_number->Exportable) $Doc->ExportCaption($this->tax_number);
					if ($this->tc_number->Exportable) $Doc->ExportCaption($this->tc_number);
					if ($this->inv_amt->Exportable) $Doc->ExportCaption($this->inv_amt);
					if ($this->discount->Exportable) $Doc->ExportCaption($this->discount);
					if ($this->total_discount->Exportable) $Doc->ExportCaption($this->total_discount);
					if ($this->tax_total->Exportable) $Doc->ExportCaption($this->tax_total);
					if ($this->inv_total->Exportable) $Doc->ExportCaption($this->inv_total);
					if ($this->paid_amt->Exportable) $Doc->ExportCaption($this->paid_amt);
					if ($this->sales_id->Exportable) $Doc->ExportCaption($this->sales_id);
					if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
					if ($this->lastupdate->Exportable) $Doc->ExportCaption($this->lastupdate);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
				} else {
					if ($this->inv_id->Exportable) $Doc->ExportCaption($this->inv_id);
					if ($this->inv_number->Exportable) $Doc->ExportCaption($this->inv_number);
					if ($this->inv_date->Exportable) $Doc->ExportCaption($this->inv_date);
					if ($this->tax_type->Exportable) $Doc->ExportCaption($this->tax_type);
					if ($this->due_date->Exportable) $Doc->ExportCaption($this->due_date);
					if ($this->customer_id->Exportable) $Doc->ExportCaption($this->customer_id);
					if ($this->address1->Exportable) $Doc->ExportCaption($this->address1);
					if ($this->address2->Exportable) $Doc->ExportCaption($this->address2);
					if ($this->address3->Exportable) $Doc->ExportCaption($this->address3);
					if ($this->wilayah_id->Exportable) $Doc->ExportCaption($this->wilayah_id);
					if ($this->subwil_id->Exportable) $Doc->ExportCaption($this->subwil_id);
					if ($this->area_id->Exportable) $Doc->ExportCaption($this->area_id);
					if ($this->customer_name->Exportable) $Doc->ExportCaption($this->customer_name);
					if ($this->tax_number->Exportable) $Doc->ExportCaption($this->tax_number);
					if ($this->tc_number->Exportable) $Doc->ExportCaption($this->tc_number);
					if ($this->inv_amt->Exportable) $Doc->ExportCaption($this->inv_amt);
					if ($this->discount->Exportable) $Doc->ExportCaption($this->discount);
					if ($this->total_discount->Exportable) $Doc->ExportCaption($this->total_discount);
					if ($this->tax_total->Exportable) $Doc->ExportCaption($this->tax_total);
					if ($this->inv_total->Exportable) $Doc->ExportCaption($this->inv_total);
					if ($this->paid_amt->Exportable) $Doc->ExportCaption($this->paid_amt);
					if ($this->sales_id->Exportable) $Doc->ExportCaption($this->sales_id);
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
						if ($this->inv_id->Exportable) $Doc->ExportField($this->inv_id);
						if ($this->inv_number->Exportable) $Doc->ExportField($this->inv_number);
						if ($this->inv_date->Exportable) $Doc->ExportField($this->inv_date);
						if ($this->tax_type->Exportable) $Doc->ExportField($this->tax_type);
						if ($this->due_date->Exportable) $Doc->ExportField($this->due_date);
						if ($this->customer_id->Exportable) $Doc->ExportField($this->customer_id);
						if ($this->address1->Exportable) $Doc->ExportField($this->address1);
						if ($this->address2->Exportable) $Doc->ExportField($this->address2);
						if ($this->address3->Exportable) $Doc->ExportField($this->address3);
						if ($this->wilayah_id->Exportable) $Doc->ExportField($this->wilayah_id);
						if ($this->subwil_id->Exportable) $Doc->ExportField($this->subwil_id);
						if ($this->area_id->Exportable) $Doc->ExportField($this->area_id);
						if ($this->customer_name->Exportable) $Doc->ExportField($this->customer_name);
						if ($this->tax_number->Exportable) $Doc->ExportField($this->tax_number);
						if ($this->tc_number->Exportable) $Doc->ExportField($this->tc_number);
						if ($this->inv_amt->Exportable) $Doc->ExportField($this->inv_amt);
						if ($this->discount->Exportable) $Doc->ExportField($this->discount);
						if ($this->total_discount->Exportable) $Doc->ExportField($this->total_discount);
						if ($this->tax_total->Exportable) $Doc->ExportField($this->tax_total);
						if ($this->inv_total->Exportable) $Doc->ExportField($this->inv_total);
						if ($this->paid_amt->Exportable) $Doc->ExportField($this->paid_amt);
						if ($this->sales_id->Exportable) $Doc->ExportField($this->sales_id);
						if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
						if ($this->lastupdate->Exportable) $Doc->ExportField($this->lastupdate);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
					} else {
						if ($this->inv_id->Exportable) $Doc->ExportField($this->inv_id);
						if ($this->inv_number->Exportable) $Doc->ExportField($this->inv_number);
						if ($this->inv_date->Exportable) $Doc->ExportField($this->inv_date);
						if ($this->tax_type->Exportable) $Doc->ExportField($this->tax_type);
						if ($this->due_date->Exportable) $Doc->ExportField($this->due_date);
						if ($this->customer_id->Exportable) $Doc->ExportField($this->customer_id);
						if ($this->address1->Exportable) $Doc->ExportField($this->address1);
						if ($this->address2->Exportable) $Doc->ExportField($this->address2);
						if ($this->address3->Exportable) $Doc->ExportField($this->address3);
						if ($this->wilayah_id->Exportable) $Doc->ExportField($this->wilayah_id);
						if ($this->subwil_id->Exportable) $Doc->ExportField($this->subwil_id);
						if ($this->area_id->Exportable) $Doc->ExportField($this->area_id);
						if ($this->customer_name->Exportable) $Doc->ExportField($this->customer_name);
						if ($this->tax_number->Exportable) $Doc->ExportField($this->tax_number);
						if ($this->tc_number->Exportable) $Doc->ExportField($this->tc_number);
						if ($this->inv_amt->Exportable) $Doc->ExportField($this->inv_amt);
						if ($this->discount->Exportable) $Doc->ExportField($this->discount);
						if ($this->total_discount->Exportable) $Doc->ExportField($this->total_discount);
						if ($this->tax_total->Exportable) $Doc->ExportField($this->tax_total);
						if ($this->inv_total->Exportable) $Doc->ExportField($this->inv_total);
						if ($this->paid_amt->Exportable) $Doc->ExportField($this->paid_amt);
						if ($this->sales_id->Exportable) $Doc->ExportField($this->sales_id);
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
			$sSqlWrk = "SELECT `address1` AS FIELD0, `address2` AS FIELD1, `address3` AS FIELD2, `wilayah_id` AS FIELD3, `subwil_id` AS FIELD4, `area_id` AS FIELD5, `customer_name` AS FIELD6, `tax` AS FIELD7, `sales_id` AS FIELD8 FROM `tbl_customer`";
			$sWhereWrk = "(`customer_id` = " . ew_QuotedValue($val, EW_DATATYPE_NUMBER, $this->DBID) . ")";
			$this->customer_id->LookupFilters = array();
			$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$this->Lookup_Selecting($this->customer_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `customer_name`";
			if ($rs = ew_LoadRecordset($sSqlWrk, $conn)) {
				while ($rs && !$rs->EOF) {
					$ar = array();
					$this->address1->setDbValue($rs->fields[0]);
					$this->address2->setDbValue($rs->fields[1]);
					$this->address3->setDbValue($rs->fields[2]);
					$this->wilayah_id->setDbValue($rs->fields[3]);
					$this->subwil_id->setDbValue($rs->fields[4]);
					$this->area_id->setDbValue($rs->fields[5]);
					$this->customer_name->setDbValue($rs->fields[6]);
					$this->is_tax->setDbValue($rs->fields[7]);
					$this->sales_id->setDbValue($rs->fields[8]);
					$this->RowType == EW_ROWTYPE_EDIT;
					$this->RenderEditRow();
					$ar[] = ($this->address1->AutoFillOriginalValue) ? $this->address1->CurrentValue : $this->address1->EditValue;
					$ar[] = ($this->address2->AutoFillOriginalValue) ? $this->address2->CurrentValue : $this->address2->EditValue;
					$ar[] = $this->address3->CurrentValue;
					$ar[] = $this->wilayah_id->CurrentValue;
					$ar[] = $this->subwil_id->CurrentValue;
					$ar[] = $this->area_id->CurrentValue;
					$ar[] = $this->customer_name->CurrentValue;
					$ar[] = ew_ConvertToBool($this->is_tax->CurrentValue) ? "1" : "0";
					$ar[] = $this->sales_id->CurrentValue;
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
		$rsnew["inv_number"] = GetNextInvCanvasNumber();
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
			$this->inv_number->CurrentValue = GetNextInvCanvasNumber();
			$this->inv_number->EditValue = $this->inv_number->CurrentValue; 
		}
		$this->inv_number->ReadOnly = TRUE;		
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
