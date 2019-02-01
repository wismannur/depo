<?php

// Global variable for table object
$tbl_customer = NULL;

//
// Table class for tbl_customer
//
class ctbl_customer extends cTable {
	var $customer_id;
	var $customer_code;
	var $customer_group;
	var $customer_name;
	var $contact_name;
	var $address1;
	var $address2;
	var $address3;
	var $phone;
	var $fax;
	var $wilayah_id;
	var $subwil_id;
	var $area_id;
	var $sales_id;
	var $due_day;
	var $ar_acc;
	var $npwp;
	var $discount;
	var $freight;
	var $credit_max;
	var $invoice_max;
	var $saldo_awal;
	var $curency;
	var $kode_depo;
	var $tax;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tbl_customer';
		$this->TableName = 'tbl_customer';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_customer`";
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

		// customer_id
		$this->customer_id = new cField('tbl_customer', 'tbl_customer', 'x_customer_id', 'customer_id', '`customer_id`', '`customer_id`', 3, -1, FALSE, '`customer_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->customer_id->Sortable = FALSE; // Allow sort
		$this->customer_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['customer_id'] = &$this->customer_id;

		// customer_code
		$this->customer_code = new cField('tbl_customer', 'tbl_customer', 'x_customer_code', 'customer_code', '`customer_code`', '`customer_code`', 200, -1, FALSE, '`customer_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_code->Sortable = TRUE; // Allow sort
		$this->fields['customer_code'] = &$this->customer_code;

		// customer_group
		$this->customer_group = new cField('tbl_customer', 'tbl_customer', 'x_customer_group', 'customer_group', '`customer_group`', '`customer_group`', 200, -1, FALSE, '`customer_group`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->customer_group->Sortable = TRUE; // Allow sort
		$this->customer_group->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->customer_group->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->customer_group->OptionCount = 8;
		$this->fields['customer_group'] = &$this->customer_group;

		// customer_name
		$this->customer_name = new cField('tbl_customer', 'tbl_customer', 'x_customer_name', 'customer_name', '`customer_name`', '`customer_name`', 200, -1, FALSE, '`customer_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_name->Sortable = TRUE; // Allow sort
		$this->fields['customer_name'] = &$this->customer_name;

		// contact_name
		$this->contact_name = new cField('tbl_customer', 'tbl_customer', 'x_contact_name', 'contact_name', '`contact_name`', '`contact_name`', 200, -1, FALSE, '`contact_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->contact_name->Sortable = FALSE; // Allow sort
		$this->fields['contact_name'] = &$this->contact_name;

		// address1
		$this->address1 = new cField('tbl_customer', 'tbl_customer', 'x_address1', 'address1', '`address1`', '`address1`', 200, -1, FALSE, '`address1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address1->Sortable = FALSE; // Allow sort
		$this->fields['address1'] = &$this->address1;

		// address2
		$this->address2 = new cField('tbl_customer', 'tbl_customer', 'x_address2', 'address2', '`address2`', '`address2`', 200, -1, FALSE, '`address2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address2->Sortable = FALSE; // Allow sort
		$this->fields['address2'] = &$this->address2;

		// address3
		$this->address3 = new cField('tbl_customer', 'tbl_customer', 'x_address3', 'address3', '`address3`', '`address3`', 200, -1, FALSE, '`address3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address3->Sortable = FALSE; // Allow sort
		$this->fields['address3'] = &$this->address3;

		// phone
		$this->phone = new cField('tbl_customer', 'tbl_customer', 'x_phone', 'phone', '`phone`', '`phone`', 200, -1, FALSE, '`phone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phone->Sortable = FALSE; // Allow sort
		$this->fields['phone'] = &$this->phone;

		// fax
		$this->fax = new cField('tbl_customer', 'tbl_customer', 'x_fax', 'fax', '`fax`', '`fax`', 200, -1, FALSE, '`fax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fax->Sortable = FALSE; // Allow sort
		$this->fields['fax'] = &$this->fax;

		// wilayah_id
		$this->wilayah_id = new cField('tbl_customer', 'tbl_customer', 'x_wilayah_id', 'wilayah_id', '`wilayah_id`', '`wilayah_id`', 3, -1, FALSE, '`wilayah_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->wilayah_id->Sortable = FALSE; // Allow sort
		$this->wilayah_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->wilayah_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->wilayah_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['wilayah_id'] = &$this->wilayah_id;

		// subwil_id
		$this->subwil_id = new cField('tbl_customer', 'tbl_customer', 'x_subwil_id', 'subwil_id', '`subwil_id`', '`subwil_id`', 3, -1, FALSE, '`subwil_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->subwil_id->Sortable = FALSE; // Allow sort
		$this->subwil_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->subwil_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->subwil_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['subwil_id'] = &$this->subwil_id;

		// area_id
		$this->area_id = new cField('tbl_customer', 'tbl_customer', 'x_area_id', 'area_id', '`area_id`', '`area_id`', 3, -1, FALSE, '`area_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->area_id->Sortable = FALSE; // Allow sort
		$this->area_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->area_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->area_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['area_id'] = &$this->area_id;

		// sales_id
		$this->sales_id = new cField('tbl_customer', 'tbl_customer', 'x_sales_id', 'sales_id', '`sales_id`', '`sales_id`', 3, -1, FALSE, '`sales_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->sales_id->Sortable = FALSE; // Allow sort
		$this->sales_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->sales_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->sales_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sales_id'] = &$this->sales_id;

		// due_day
		$this->due_day = new cField('tbl_customer', 'tbl_customer', 'x_due_day', 'due_day', '`due_day`', '`due_day`', 3, -1, FALSE, '`due_day`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->due_day->Sortable = FALSE; // Allow sort
		$this->due_day->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['due_day'] = &$this->due_day;

		// ar_acc
		$this->ar_acc = new cField('tbl_customer', 'tbl_customer', 'x_ar_acc', 'ar_acc', '`ar_acc`', '`ar_acc`', 200, -1, FALSE, '`ar_acc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ar_acc->Sortable = FALSE; // Allow sort
		$this->fields['ar_acc'] = &$this->ar_acc;

		// npwp
		$this->npwp = new cField('tbl_customer', 'tbl_customer', 'x_npwp', 'npwp', '`npwp`', '`npwp`', 200, -1, FALSE, '`npwp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->npwp->Sortable = FALSE; // Allow sort
		$this->fields['npwp'] = &$this->npwp;

		// discount
		$this->discount = new cField('tbl_customer', 'tbl_customer', 'x_discount', 'discount', '`discount`', '`discount`', 5, -1, FALSE, '`discount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->discount->Sortable = FALSE; // Allow sort
		$this->discount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['discount'] = &$this->discount;

		// freight
		$this->freight = new cField('tbl_customer', 'tbl_customer', 'x_freight', 'freight', '`freight`', '`freight`', 5, -1, FALSE, '`freight`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->freight->Sortable = FALSE; // Allow sort
		$this->freight->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['freight'] = &$this->freight;

		// credit_max
		$this->credit_max = new cField('tbl_customer', 'tbl_customer', 'x_credit_max', 'credit_max', '`credit_max`', '`credit_max`', 5, -1, FALSE, '`credit_max`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->credit_max->Sortable = FALSE; // Allow sort
		$this->credit_max->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['credit_max'] = &$this->credit_max;

		// invoice_max
		$this->invoice_max = new cField('tbl_customer', 'tbl_customer', 'x_invoice_max', 'invoice_max', '`invoice_max`', '`invoice_max`', 3, -1, FALSE, '`invoice_max`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->invoice_max->Sortable = FALSE; // Allow sort
		$this->invoice_max->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['invoice_max'] = &$this->invoice_max;

		// saldo_awal
		$this->saldo_awal = new cField('tbl_customer', 'tbl_customer', 'x_saldo_awal', 'saldo_awal', '`saldo_awal`', '`saldo_awal`', 5, -1, FALSE, '`saldo_awal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->saldo_awal->Sortable = FALSE; // Allow sort
		$this->saldo_awal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['saldo_awal'] = &$this->saldo_awal;

		// curency
		$this->curency = new cField('tbl_customer', 'tbl_customer', 'x_curency', 'curency', '`curency`', '`curency`', 5, -1, FALSE, '`curency`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->curency->Sortable = FALSE; // Allow sort
		$this->curency->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['curency'] = &$this->curency;

		// kode_depo
		$this->kode_depo = new cField('tbl_customer', 'tbl_customer', 'x_kode_depo', 'kode_depo', '`kode_depo`', '`kode_depo`', 200, -1, FALSE, '`kode_depo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_depo->Sortable = FALSE; // Allow sort
		$this->fields['kode_depo'] = &$this->kode_depo;

		// tax
		$this->tax = new cField('tbl_customer', 'tbl_customer', 'x_tax', 'tax', '`tax`', '`tax`', 202, -1, FALSE, '`tax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tax->Sortable = FALSE; // Allow sort
		$this->tax->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->fields['tax'] = &$this->tax;
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

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tbl_customer`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`customer_code` ASC";
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
			$this->customer_id->setDbValue($conn->Insert_ID());
			$rs['customer_id'] = $this->customer_id->DbValue;
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
			if (array_key_exists('customer_id', $rs))
				ew_AddFilter($where, ew_QuotedName('customer_id', $this->DBID) . '=' . ew_QuotedValue($rs['customer_id'], $this->customer_id->FldDataType, $this->DBID));
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
		return "`customer_id` = @customer_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->customer_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->customer_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@customer_id@", ew_AdjustSql($this->customer_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "tbl_customerlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tbl_customerview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tbl_customeredit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tbl_customeradd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tbl_customerlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tbl_customerview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tbl_customerview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tbl_customeradd.php?" . $this->UrlParm($parm);
		else
			$url = "tbl_customeradd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("tbl_customeredit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("tbl_customeradd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tbl_customerdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "customer_id:" . ew_VarToJson($this->customer_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->customer_id->CurrentValue)) {
			$sUrl .= "customer_id=" . urlencode($this->customer_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
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
			if ($isPost && isset($_POST["customer_id"]))
				$arKeys[] = $_POST["customer_id"];
			elseif (isset($_GET["customer_id"]))
				$arKeys[] = $_GET["customer_id"];
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
			$this->customer_id->CurrentValue = $key;
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
		$this->customer_id->setDbValue($rs->fields('customer_id'));
		$this->customer_code->setDbValue($rs->fields('customer_code'));
		$this->customer_group->setDbValue($rs->fields('customer_group'));
		$this->customer_name->setDbValue($rs->fields('customer_name'));
		$this->contact_name->setDbValue($rs->fields('contact_name'));
		$this->address1->setDbValue($rs->fields('address1'));
		$this->address2->setDbValue($rs->fields('address2'));
		$this->address3->setDbValue($rs->fields('address3'));
		$this->phone->setDbValue($rs->fields('phone'));
		$this->fax->setDbValue($rs->fields('fax'));
		$this->wilayah_id->setDbValue($rs->fields('wilayah_id'));
		$this->subwil_id->setDbValue($rs->fields('subwil_id'));
		$this->area_id->setDbValue($rs->fields('area_id'));
		$this->sales_id->setDbValue($rs->fields('sales_id'));
		$this->due_day->setDbValue($rs->fields('due_day'));
		$this->ar_acc->setDbValue($rs->fields('ar_acc'));
		$this->npwp->setDbValue($rs->fields('npwp'));
		$this->discount->setDbValue($rs->fields('discount'));
		$this->freight->setDbValue($rs->fields('freight'));
		$this->credit_max->setDbValue($rs->fields('credit_max'));
		$this->invoice_max->setDbValue($rs->fields('invoice_max'));
		$this->saldo_awal->setDbValue($rs->fields('saldo_awal'));
		$this->curency->setDbValue($rs->fields('curency'));
		$this->kode_depo->setDbValue($rs->fields('kode_depo'));
		$this->tax->setDbValue($rs->fields('tax'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// customer_id
		// customer_code
		// customer_group
		// customer_name
		// contact_name
		// address1
		// address2
		// address3
		// phone
		// fax
		// wilayah_id
		// subwil_id
		// area_id
		// sales_id
		// due_day
		// ar_acc
		// npwp
		// discount
		// freight
		// credit_max
		// invoice_max
		// saldo_awal
		// curency
		// kode_depo
		// tax
		// customer_id

		$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
		$this->customer_id->ViewCustomAttributes = "";

		// customer_code
		$this->customer_code->ViewValue = $this->customer_code->CurrentValue;
		$this->customer_code->ViewCustomAttributes = "";

		// customer_group
		if (strval($this->customer_group->CurrentValue) <> "") {
			$this->customer_group->ViewValue = $this->customer_group->OptionCaption($this->customer_group->CurrentValue);
		} else {
			$this->customer_group->ViewValue = NULL;
		}
		$this->customer_group->ViewCustomAttributes = "";

		// customer_name
		$this->customer_name->ViewValue = $this->customer_name->CurrentValue;
		$this->customer_name->ViewCustomAttributes = "";

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

		// wilayah_id
		if (strval($this->wilayah_id->CurrentValue) <> "") {
			$sFilterWrk = "`wilayah_id`" . ew_SearchString("=", $this->wilayah_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `wilayah_id`, `nama_wilayah` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_wilayah`";
		$sWhereWrk = "";
		$this->wilayah_id->LookupFilters = array();
		$lookuptblfilter = "`kode_depo` = '".@$_SESSION["KodeDepo"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->wilayah_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->wilayah_id->ViewValue = $this->wilayah_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->wilayah_id->ViewValue = $this->wilayah_id->CurrentValue;
			}
		} else {
			$this->wilayah_id->ViewValue = NULL;
		}
		$this->wilayah_id->ViewCustomAttributes = "";

		// subwil_id
		if (strval($this->subwil_id->CurrentValue) <> "") {
			$sFilterWrk = "`sub_id`" . ew_SearchString("=", $this->subwil_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `sub_id`, `nama_sub_wilayah` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_subwilayah`";
		$sWhereWrk = "";
		$this->subwil_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->subwil_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `nama_sub_wilayah`";
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->subwil_id->ViewValue = $this->subwil_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->subwil_id->ViewValue = $this->subwil_id->CurrentValue;
			}
		} else {
			$this->subwil_id->ViewValue = NULL;
		}
		$this->subwil_id->ViewCustomAttributes = "";

		// area_id
		if (strval($this->area_id->CurrentValue) <> "") {
			$sFilterWrk = "`area_id`" . ew_SearchString("=", $this->area_id->CurrentValue, EW_DATATYPE_NUMBER, "db_inventory_pusat");
		$sSqlWrk = "SELECT `area_id`, `area_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tbl_callarea`";
		$sWhereWrk = "";
		$this->area_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->area_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `area_name`";
			$rswrk = Conn("db_inventory_pusat")->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->area_id->ViewValue = $this->area_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->area_id->ViewValue = $this->area_id->CurrentValue;
			}
		} else {
			$this->area_id->ViewValue = NULL;
		}
		$this->area_id->ViewCustomAttributes = "";

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

		// due_day
		$this->due_day->ViewValue = $this->due_day->CurrentValue;
		$this->due_day->ViewCustomAttributes = "";

		// ar_acc
		$this->ar_acc->ViewValue = $this->ar_acc->CurrentValue;
		$this->ar_acc->ViewCustomAttributes = "";

		// npwp
		$this->npwp->ViewValue = $this->npwp->CurrentValue;
		$this->npwp->ViewCustomAttributes = "";

		// discount
		$this->discount->ViewValue = $this->discount->CurrentValue;
		$this->discount->ViewCustomAttributes = "";

		// freight
		$this->freight->ViewValue = $this->freight->CurrentValue;
		$this->freight->ViewCustomAttributes = "";

		// credit_max
		$this->credit_max->ViewValue = $this->credit_max->CurrentValue;
		$this->credit_max->ViewCustomAttributes = "";

		// invoice_max
		$this->invoice_max->ViewValue = $this->invoice_max->CurrentValue;
		$this->invoice_max->ViewCustomAttributes = "";

		// saldo_awal
		$this->saldo_awal->ViewValue = $this->saldo_awal->CurrentValue;
		$this->saldo_awal->ViewCustomAttributes = "";

		// curency
		$this->curency->ViewValue = $this->curency->CurrentValue;
		$this->curency->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// tax
		$this->tax->ViewValue = $this->tax->CurrentValue;
		$this->tax->ViewCustomAttributes = "";

		// customer_id
		$this->customer_id->LinkCustomAttributes = "";
		$this->customer_id->HrefValue = "";
		$this->customer_id->TooltipValue = "";

		// customer_code
		$this->customer_code->LinkCustomAttributes = "";
		$this->customer_code->HrefValue = "";
		$this->customer_code->TooltipValue = "";

		// customer_group
		$this->customer_group->LinkCustomAttributes = "";
		$this->customer_group->HrefValue = "";
		$this->customer_group->TooltipValue = "";

		// customer_name
		$this->customer_name->LinkCustomAttributes = "";
		$this->customer_name->HrefValue = "";
		$this->customer_name->TooltipValue = "";

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

		// sales_id
		$this->sales_id->LinkCustomAttributes = "";
		$this->sales_id->HrefValue = "";
		$this->sales_id->TooltipValue = "";

		// due_day
		$this->due_day->LinkCustomAttributes = "";
		$this->due_day->HrefValue = "";
		$this->due_day->TooltipValue = "";

		// ar_acc
		$this->ar_acc->LinkCustomAttributes = "";
		$this->ar_acc->HrefValue = "";
		$this->ar_acc->TooltipValue = "";

		// npwp
		$this->npwp->LinkCustomAttributes = "";
		$this->npwp->HrefValue = "";
		$this->npwp->TooltipValue = "";

		// discount
		$this->discount->LinkCustomAttributes = "";
		$this->discount->HrefValue = "";
		$this->discount->TooltipValue = "";

		// freight
		$this->freight->LinkCustomAttributes = "";
		$this->freight->HrefValue = "";
		$this->freight->TooltipValue = "";

		// credit_max
		$this->credit_max->LinkCustomAttributes = "";
		$this->credit_max->HrefValue = "";
		$this->credit_max->TooltipValue = "";

		// invoice_max
		$this->invoice_max->LinkCustomAttributes = "";
		$this->invoice_max->HrefValue = "";
		$this->invoice_max->TooltipValue = "";

		// saldo_awal
		$this->saldo_awal->LinkCustomAttributes = "";
		$this->saldo_awal->HrefValue = "";
		$this->saldo_awal->TooltipValue = "";

		// curency
		$this->curency->LinkCustomAttributes = "";
		$this->curency->HrefValue = "";
		$this->curency->TooltipValue = "";

		// kode_depo
		$this->kode_depo->LinkCustomAttributes = "";
		$this->kode_depo->HrefValue = "";
		$this->kode_depo->TooltipValue = "";

		// tax
		$this->tax->LinkCustomAttributes = "";
		$this->tax->HrefValue = "";
		$this->tax->TooltipValue = "";

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

		// customer_id
		$this->customer_id->EditAttrs["class"] = "form-control";
		$this->customer_id->EditCustomAttributes = "";
		$this->customer_id->EditValue = $this->customer_id->CurrentValue;
		$this->customer_id->ViewCustomAttributes = "";

		// customer_code
		$this->customer_code->EditAttrs["class"] = "form-control";
		$this->customer_code->EditCustomAttributes = "";
		$this->customer_code->EditValue = $this->customer_code->CurrentValue;
		$this->customer_code->PlaceHolder = ew_RemoveHtml($this->customer_code->FldCaption());

		// customer_group
		$this->customer_group->EditCustomAttributes = "";
		$this->customer_group->EditValue = $this->customer_group->Options(TRUE);

		// customer_name
		$this->customer_name->EditAttrs["class"] = "form-control";
		$this->customer_name->EditCustomAttributes = "";
		$this->customer_name->EditValue = $this->customer_name->CurrentValue;
		$this->customer_name->PlaceHolder = ew_RemoveHtml($this->customer_name->FldCaption());

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

		// wilayah_id
		$this->wilayah_id->EditCustomAttributes = "";

		// subwil_id
		$this->subwil_id->EditCustomAttributes = "";

		// area_id
		$this->area_id->EditCustomAttributes = "";

		// sales_id
		$this->sales_id->EditCustomAttributes = "";

		// due_day
		$this->due_day->EditAttrs["class"] = "form-control";
		$this->due_day->EditCustomAttributes = "";
		$this->due_day->EditValue = $this->due_day->CurrentValue;
		$this->due_day->PlaceHolder = ew_RemoveHtml($this->due_day->FldCaption());

		// ar_acc
		$this->ar_acc->EditAttrs["class"] = "form-control";
		$this->ar_acc->EditCustomAttributes = "";
		$this->ar_acc->EditValue = $this->ar_acc->CurrentValue;
		$this->ar_acc->PlaceHolder = ew_RemoveHtml($this->ar_acc->FldCaption());

		// npwp
		$this->npwp->EditAttrs["class"] = "form-control";
		$this->npwp->EditCustomAttributes = "";
		$this->npwp->EditValue = $this->npwp->CurrentValue;
		$this->npwp->PlaceHolder = ew_RemoveHtml($this->npwp->FldCaption());

		// discount
		$this->discount->EditAttrs["class"] = "form-control";
		$this->discount->EditCustomAttributes = "";
		$this->discount->EditValue = $this->discount->CurrentValue;
		$this->discount->PlaceHolder = ew_RemoveHtml($this->discount->FldCaption());
		if (strval($this->discount->EditValue) <> "" && is_numeric($this->discount->EditValue)) $this->discount->EditValue = ew_FormatNumber($this->discount->EditValue, -2, -1, -2, 0);

		// freight
		$this->freight->EditAttrs["class"] = "form-control";
		$this->freight->EditCustomAttributes = "";
		$this->freight->EditValue = $this->freight->CurrentValue;
		$this->freight->PlaceHolder = ew_RemoveHtml($this->freight->FldCaption());
		if (strval($this->freight->EditValue) <> "" && is_numeric($this->freight->EditValue)) $this->freight->EditValue = ew_FormatNumber($this->freight->EditValue, -2, -1, -2, 0);

		// credit_max
		$this->credit_max->EditAttrs["class"] = "form-control";
		$this->credit_max->EditCustomAttributes = "";
		$this->credit_max->EditValue = $this->credit_max->CurrentValue;
		$this->credit_max->PlaceHolder = ew_RemoveHtml($this->credit_max->FldCaption());
		if (strval($this->credit_max->EditValue) <> "" && is_numeric($this->credit_max->EditValue)) $this->credit_max->EditValue = ew_FormatNumber($this->credit_max->EditValue, -2, -1, -2, 0);

		// invoice_max
		$this->invoice_max->EditAttrs["class"] = "form-control";
		$this->invoice_max->EditCustomAttributes = "";
		$this->invoice_max->EditValue = $this->invoice_max->CurrentValue;
		$this->invoice_max->PlaceHolder = ew_RemoveHtml($this->invoice_max->FldCaption());

		// saldo_awal
		$this->saldo_awal->EditAttrs["class"] = "form-control";
		$this->saldo_awal->EditCustomAttributes = "";
		$this->saldo_awal->EditValue = $this->saldo_awal->CurrentValue;
		$this->saldo_awal->PlaceHolder = ew_RemoveHtml($this->saldo_awal->FldCaption());
		if (strval($this->saldo_awal->EditValue) <> "" && is_numeric($this->saldo_awal->EditValue)) $this->saldo_awal->EditValue = ew_FormatNumber($this->saldo_awal->EditValue, -2, -1, -2, 0);

		// curency
		$this->curency->EditAttrs["class"] = "form-control";
		$this->curency->EditCustomAttributes = "";
		$this->curency->EditValue = $this->curency->CurrentValue;
		$this->curency->PlaceHolder = ew_RemoveHtml($this->curency->FldCaption());
		if (strval($this->curency->EditValue) <> "" && is_numeric($this->curency->EditValue)) $this->curency->EditValue = ew_FormatNumber($this->curency->EditValue, -2, -1, -2, 0);

		// kode_depo
		$this->kode_depo->EditAttrs["class"] = "form-control";
		$this->kode_depo->EditCustomAttributes = "";
		$this->kode_depo->EditValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->PlaceHolder = ew_RemoveHtml($this->kode_depo->FldCaption());

		// tax
		$this->tax->EditAttrs["class"] = "form-control";
		$this->tax->EditCustomAttributes = "";
		$this->tax->EditValue = $this->tax->CurrentValue;
		$this->tax->PlaceHolder = ew_RemoveHtml($this->tax->FldCaption());

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
					if ($this->customer_id->Exportable) $Doc->ExportCaption($this->customer_id);
					if ($this->customer_code->Exportable) $Doc->ExportCaption($this->customer_code);
					if ($this->customer_group->Exportable) $Doc->ExportCaption($this->customer_group);
					if ($this->customer_name->Exportable) $Doc->ExportCaption($this->customer_name);
					if ($this->contact_name->Exportable) $Doc->ExportCaption($this->contact_name);
					if ($this->address1->Exportable) $Doc->ExportCaption($this->address1);
					if ($this->address2->Exportable) $Doc->ExportCaption($this->address2);
					if ($this->address3->Exportable) $Doc->ExportCaption($this->address3);
					if ($this->phone->Exportable) $Doc->ExportCaption($this->phone);
					if ($this->fax->Exportable) $Doc->ExportCaption($this->fax);
					if ($this->wilayah_id->Exportable) $Doc->ExportCaption($this->wilayah_id);
					if ($this->subwil_id->Exportable) $Doc->ExportCaption($this->subwil_id);
					if ($this->area_id->Exportable) $Doc->ExportCaption($this->area_id);
					if ($this->sales_id->Exportable) $Doc->ExportCaption($this->sales_id);
					if ($this->due_day->Exportable) $Doc->ExportCaption($this->due_day);
					if ($this->ar_acc->Exportable) $Doc->ExportCaption($this->ar_acc);
					if ($this->npwp->Exportable) $Doc->ExportCaption($this->npwp);
					if ($this->discount->Exportable) $Doc->ExportCaption($this->discount);
					if ($this->freight->Exportable) $Doc->ExportCaption($this->freight);
					if ($this->credit_max->Exportable) $Doc->ExportCaption($this->credit_max);
					if ($this->invoice_max->Exportable) $Doc->ExportCaption($this->invoice_max);
					if ($this->saldo_awal->Exportable) $Doc->ExportCaption($this->saldo_awal);
					if ($this->curency->Exportable) $Doc->ExportCaption($this->curency);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
				} else {
					if ($this->customer_id->Exportable) $Doc->ExportCaption($this->customer_id);
					if ($this->customer_code->Exportable) $Doc->ExportCaption($this->customer_code);
					if ($this->customer_group->Exportable) $Doc->ExportCaption($this->customer_group);
					if ($this->customer_name->Exportable) $Doc->ExportCaption($this->customer_name);
					if ($this->contact_name->Exportable) $Doc->ExportCaption($this->contact_name);
					if ($this->address1->Exportable) $Doc->ExportCaption($this->address1);
					if ($this->address2->Exportable) $Doc->ExportCaption($this->address2);
					if ($this->address3->Exportable) $Doc->ExportCaption($this->address3);
					if ($this->phone->Exportable) $Doc->ExportCaption($this->phone);
					if ($this->fax->Exportable) $Doc->ExportCaption($this->fax);
					if ($this->wilayah_id->Exportable) $Doc->ExportCaption($this->wilayah_id);
					if ($this->subwil_id->Exportable) $Doc->ExportCaption($this->subwil_id);
					if ($this->area_id->Exportable) $Doc->ExportCaption($this->area_id);
					if ($this->sales_id->Exportable) $Doc->ExportCaption($this->sales_id);
					if ($this->due_day->Exportable) $Doc->ExportCaption($this->due_day);
					if ($this->ar_acc->Exportable) $Doc->ExportCaption($this->ar_acc);
					if ($this->npwp->Exportable) $Doc->ExportCaption($this->npwp);
					if ($this->discount->Exportable) $Doc->ExportCaption($this->discount);
					if ($this->freight->Exportable) $Doc->ExportCaption($this->freight);
					if ($this->credit_max->Exportable) $Doc->ExportCaption($this->credit_max);
					if ($this->invoice_max->Exportable) $Doc->ExportCaption($this->invoice_max);
					if ($this->saldo_awal->Exportable) $Doc->ExportCaption($this->saldo_awal);
					if ($this->curency->Exportable) $Doc->ExportCaption($this->curency);
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
						if ($this->customer_id->Exportable) $Doc->ExportField($this->customer_id);
						if ($this->customer_code->Exportable) $Doc->ExportField($this->customer_code);
						if ($this->customer_group->Exportable) $Doc->ExportField($this->customer_group);
						if ($this->customer_name->Exportable) $Doc->ExportField($this->customer_name);
						if ($this->contact_name->Exportable) $Doc->ExportField($this->contact_name);
						if ($this->address1->Exportable) $Doc->ExportField($this->address1);
						if ($this->address2->Exportable) $Doc->ExportField($this->address2);
						if ($this->address3->Exportable) $Doc->ExportField($this->address3);
						if ($this->phone->Exportable) $Doc->ExportField($this->phone);
						if ($this->fax->Exportable) $Doc->ExportField($this->fax);
						if ($this->wilayah_id->Exportable) $Doc->ExportField($this->wilayah_id);
						if ($this->subwil_id->Exportable) $Doc->ExportField($this->subwil_id);
						if ($this->area_id->Exportable) $Doc->ExportField($this->area_id);
						if ($this->sales_id->Exportable) $Doc->ExportField($this->sales_id);
						if ($this->due_day->Exportable) $Doc->ExportField($this->due_day);
						if ($this->ar_acc->Exportable) $Doc->ExportField($this->ar_acc);
						if ($this->npwp->Exportable) $Doc->ExportField($this->npwp);
						if ($this->discount->Exportable) $Doc->ExportField($this->discount);
						if ($this->freight->Exportable) $Doc->ExportField($this->freight);
						if ($this->credit_max->Exportable) $Doc->ExportField($this->credit_max);
						if ($this->invoice_max->Exportable) $Doc->ExportField($this->invoice_max);
						if ($this->saldo_awal->Exportable) $Doc->ExportField($this->saldo_awal);
						if ($this->curency->Exportable) $Doc->ExportField($this->curency);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
					} else {
						if ($this->customer_id->Exportable) $Doc->ExportField($this->customer_id);
						if ($this->customer_code->Exportable) $Doc->ExportField($this->customer_code);
						if ($this->customer_group->Exportable) $Doc->ExportField($this->customer_group);
						if ($this->customer_name->Exportable) $Doc->ExportField($this->customer_name);
						if ($this->contact_name->Exportable) $Doc->ExportField($this->contact_name);
						if ($this->address1->Exportable) $Doc->ExportField($this->address1);
						if ($this->address2->Exportable) $Doc->ExportField($this->address2);
						if ($this->address3->Exportable) $Doc->ExportField($this->address3);
						if ($this->phone->Exportable) $Doc->ExportField($this->phone);
						if ($this->fax->Exportable) $Doc->ExportField($this->fax);
						if ($this->wilayah_id->Exportable) $Doc->ExportField($this->wilayah_id);
						if ($this->subwil_id->Exportable) $Doc->ExportField($this->subwil_id);
						if ($this->area_id->Exportable) $Doc->ExportField($this->area_id);
						if ($this->sales_id->Exportable) $Doc->ExportField($this->sales_id);
						if ($this->due_day->Exportable) $Doc->ExportField($this->due_day);
						if ($this->ar_acc->Exportable) $Doc->ExportField($this->ar_acc);
						if ($this->npwp->Exportable) $Doc->ExportField($this->npwp);
						if ($this->discount->Exportable) $Doc->ExportField($this->discount);
						if ($this->freight->Exportable) $Doc->ExportField($this->freight);
						if ($this->credit_max->Exportable) $Doc->ExportField($this->credit_max);
						if ($this->invoice_max->Exportable) $Doc->ExportField($this->invoice_max);
						if ($this->saldo_awal->Exportable) $Doc->ExportField($this->saldo_awal);
						if ($this->curency->Exportable) $Doc->ExportField($this->curency);
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

		$rsnew["kode_depo"] = @$_SESSION["KodeDepo"];;
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
