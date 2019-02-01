<?php

// Global variable for table object
$tbl_salesman = NULL;

//
// Table class for tbl_salesman
//
class ctbl_salesman extends cTable {
	var $sales_id;
	var $sales_name;
	var $wilayah_id;
	var $subwil_id;
	var $area_id;
	var $sales_target;
	var $sales_intensif;
	var $kode_depo;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tbl_salesman';
		$this->TableName = 'tbl_salesman';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_salesman`";
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

		// sales_id
		$this->sales_id = new cField('tbl_salesman', 'tbl_salesman', 'x_sales_id', 'sales_id', '`sales_id`', '`sales_id`', 3, -1, FALSE, '`sales_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->sales_id->Sortable = TRUE; // Allow sort
		$this->sales_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sales_id'] = &$this->sales_id;

		// sales_name
		$this->sales_name = new cField('tbl_salesman', 'tbl_salesman', 'x_sales_name', 'sales_name', '`sales_name`', '`sales_name`', 200, -1, FALSE, '`sales_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sales_name->Sortable = TRUE; // Allow sort
		$this->fields['sales_name'] = &$this->sales_name;

		// wilayah_id
		$this->wilayah_id = new cField('tbl_salesman', 'tbl_salesman', 'x_wilayah_id', 'wilayah_id', '`wilayah_id`', '`wilayah_id`', 3, -1, FALSE, '`wilayah_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->wilayah_id->Sortable = TRUE; // Allow sort
		$this->wilayah_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->wilayah_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->wilayah_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['wilayah_id'] = &$this->wilayah_id;

		// subwil_id
		$this->subwil_id = new cField('tbl_salesman', 'tbl_salesman', 'x_subwil_id', 'subwil_id', '`subwil_id`', '`subwil_id`', 3, -1, FALSE, '`subwil_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->subwil_id->Sortable = TRUE; // Allow sort
		$this->subwil_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->subwil_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->subwil_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['subwil_id'] = &$this->subwil_id;

		// area_id
		$this->area_id = new cField('tbl_salesman', 'tbl_salesman', 'x_area_id', 'area_id', '`area_id`', '`area_id`', 3, -1, FALSE, '`area_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->area_id->Sortable = TRUE; // Allow sort
		$this->area_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->area_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->area_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['area_id'] = &$this->area_id;

		// sales_target
		$this->sales_target = new cField('tbl_salesman', 'tbl_salesman', 'x_sales_target', 'sales_target', '`sales_target`', '`sales_target`', 5, -1, FALSE, '`sales_target`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sales_target->Sortable = TRUE; // Allow sort
		$this->sales_target->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['sales_target'] = &$this->sales_target;

		// sales_intensif
		$this->sales_intensif = new cField('tbl_salesman', 'tbl_salesman', 'x_sales_intensif', 'sales_intensif', '`sales_intensif`', '`sales_intensif`', 5, -1, FALSE, '`sales_intensif`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sales_intensif->Sortable = TRUE; // Allow sort
		$this->sales_intensif->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['sales_intensif'] = &$this->sales_intensif;

		// kode_depo
		$this->kode_depo = new cField('tbl_salesman', 'tbl_salesman', 'x_kode_depo', 'kode_depo', '`kode_depo`', '`kode_depo`', 200, -1, FALSE, '`kode_depo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tbl_salesman`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`sales_name` ASC";
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
			$this->sales_id->setDbValue($conn->Insert_ID());
			$rs['sales_id'] = $this->sales_id->DbValue;
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
			if (array_key_exists('sales_id', $rs))
				ew_AddFilter($where, ew_QuotedName('sales_id', $this->DBID) . '=' . ew_QuotedValue($rs['sales_id'], $this->sales_id->FldDataType, $this->DBID));
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
		return "`sales_id` = @sales_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->sales_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->sales_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@sales_id@", ew_AdjustSql($this->sales_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "tbl_salesmanlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tbl_salesmanview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tbl_salesmanedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tbl_salesmanadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tbl_salesmanlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tbl_salesmanview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tbl_salesmanview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tbl_salesmanadd.php?" . $this->UrlParm($parm);
		else
			$url = "tbl_salesmanadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("tbl_salesmanedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("tbl_salesmanadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tbl_salesmandelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "sales_id:" . ew_VarToJson($this->sales_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->sales_id->CurrentValue)) {
			$sUrl .= "sales_id=" . urlencode($this->sales_id->CurrentValue);
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
			if ($isPost && isset($_POST["sales_id"]))
				$arKeys[] = $_POST["sales_id"];
			elseif (isset($_GET["sales_id"]))
				$arKeys[] = $_GET["sales_id"];
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
			$this->sales_id->CurrentValue = $key;
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
		$this->sales_id->setDbValue($rs->fields('sales_id'));
		$this->sales_name->setDbValue($rs->fields('sales_name'));
		$this->wilayah_id->setDbValue($rs->fields('wilayah_id'));
		$this->subwil_id->setDbValue($rs->fields('subwil_id'));
		$this->area_id->setDbValue($rs->fields('area_id'));
		$this->sales_target->setDbValue($rs->fields('sales_target'));
		$this->sales_intensif->setDbValue($rs->fields('sales_intensif'));
		$this->kode_depo->setDbValue($rs->fields('kode_depo'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// sales_id
		// sales_name
		// wilayah_id
		// subwil_id
		// area_id
		// sales_target
		// sales_intensif
		// kode_depo
		// sales_id

		$this->sales_id->ViewValue = $this->sales_id->CurrentValue;
		$this->sales_id->ViewCustomAttributes = "";

		// sales_name
		$this->sales_name->ViewValue = $this->sales_name->CurrentValue;
		$this->sales_name->ViewCustomAttributes = "";

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
		$sSqlWrk .= " ORDER BY `nama_wilayah`";
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

		// sales_target
		$this->sales_target->ViewValue = $this->sales_target->CurrentValue;
		$this->sales_target->ViewValue = ew_FormatNumber($this->sales_target->ViewValue, 2, -2, -2, -2);
		$this->sales_target->CellCssStyle .= "text-align: right;";
		$this->sales_target->ViewCustomAttributes = "";

		// sales_intensif
		$this->sales_intensif->ViewValue = $this->sales_intensif->CurrentValue;
		$this->sales_intensif->ViewValue = ew_FormatNumber($this->sales_intensif->ViewValue, 2, -2, -2, -2);
		$this->sales_intensif->CellCssStyle .= "text-align: right;";
		$this->sales_intensif->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// sales_id
		$this->sales_id->LinkCustomAttributes = "";
		$this->sales_id->HrefValue = "";
		$this->sales_id->TooltipValue = "";

		// sales_name
		$this->sales_name->LinkCustomAttributes = "";
		$this->sales_name->HrefValue = "";
		$this->sales_name->TooltipValue = "";

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

		// sales_target
		$this->sales_target->LinkCustomAttributes = "";
		$this->sales_target->HrefValue = "";
		$this->sales_target->TooltipValue = "";

		// sales_intensif
		$this->sales_intensif->LinkCustomAttributes = "";
		$this->sales_intensif->HrefValue = "";
		$this->sales_intensif->TooltipValue = "";

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

		// sales_id
		$this->sales_id->EditAttrs["class"] = "form-control";
		$this->sales_id->EditCustomAttributes = "";
		$this->sales_id->EditValue = $this->sales_id->CurrentValue;
		$this->sales_id->ViewCustomAttributes = "";

		// sales_name
		$this->sales_name->EditAttrs["class"] = "form-control";
		$this->sales_name->EditCustomAttributes = "";
		$this->sales_name->EditValue = $this->sales_name->CurrentValue;
		$this->sales_name->PlaceHolder = ew_RemoveHtml($this->sales_name->FldCaption());

		// wilayah_id
		$this->wilayah_id->EditCustomAttributes = "";

		// subwil_id
		$this->subwil_id->EditCustomAttributes = "";

		// area_id
		$this->area_id->EditCustomAttributes = "";

		// sales_target
		$this->sales_target->EditAttrs["class"] = "form-control";
		$this->sales_target->EditCustomAttributes = "";
		$this->sales_target->EditValue = $this->sales_target->CurrentValue;
		$this->sales_target->PlaceHolder = ew_RemoveHtml($this->sales_target->FldCaption());
		if (strval($this->sales_target->EditValue) <> "" && is_numeric($this->sales_target->EditValue)) $this->sales_target->EditValue = ew_FormatNumber($this->sales_target->EditValue, -2, -2, -2, -2);

		// sales_intensif
		$this->sales_intensif->EditAttrs["class"] = "form-control";
		$this->sales_intensif->EditCustomAttributes = "";
		$this->sales_intensif->EditValue = $this->sales_intensif->CurrentValue;
		$this->sales_intensif->PlaceHolder = ew_RemoveHtml($this->sales_intensif->FldCaption());
		if (strval($this->sales_intensif->EditValue) <> "" && is_numeric($this->sales_intensif->EditValue)) $this->sales_intensif->EditValue = ew_FormatNumber($this->sales_intensif->EditValue, -2, -2, -2, -2);

		// kode_depo
		$this->kode_depo->EditAttrs["class"] = "form-control";
		$this->kode_depo->EditCustomAttributes = "";
		$this->kode_depo->EditValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->PlaceHolder = ew_RemoveHtml($this->kode_depo->FldCaption());

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
					if ($this->sales_id->Exportable) $Doc->ExportCaption($this->sales_id);
					if ($this->sales_name->Exportable) $Doc->ExportCaption($this->sales_name);
					if ($this->wilayah_id->Exportable) $Doc->ExportCaption($this->wilayah_id);
					if ($this->subwil_id->Exportable) $Doc->ExportCaption($this->subwil_id);
					if ($this->area_id->Exportable) $Doc->ExportCaption($this->area_id);
					if ($this->sales_target->Exportable) $Doc->ExportCaption($this->sales_target);
					if ($this->sales_intensif->Exportable) $Doc->ExportCaption($this->sales_intensif);
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
				} else {
					if ($this->sales_id->Exportable) $Doc->ExportCaption($this->sales_id);
					if ($this->sales_name->Exportable) $Doc->ExportCaption($this->sales_name);
					if ($this->wilayah_id->Exportable) $Doc->ExportCaption($this->wilayah_id);
					if ($this->subwil_id->Exportable) $Doc->ExportCaption($this->subwil_id);
					if ($this->area_id->Exportable) $Doc->ExportCaption($this->area_id);
					if ($this->sales_target->Exportable) $Doc->ExportCaption($this->sales_target);
					if ($this->sales_intensif->Exportable) $Doc->ExportCaption($this->sales_intensif);
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
						if ($this->sales_id->Exportable) $Doc->ExportField($this->sales_id);
						if ($this->sales_name->Exportable) $Doc->ExportField($this->sales_name);
						if ($this->wilayah_id->Exportable) $Doc->ExportField($this->wilayah_id);
						if ($this->subwil_id->Exportable) $Doc->ExportField($this->subwil_id);
						if ($this->area_id->Exportable) $Doc->ExportField($this->area_id);
						if ($this->sales_target->Exportable) $Doc->ExportField($this->sales_target);
						if ($this->sales_intensif->Exportable) $Doc->ExportField($this->sales_intensif);
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
					} else {
						if ($this->sales_id->Exportable) $Doc->ExportField($this->sales_id);
						if ($this->sales_name->Exportable) $Doc->ExportField($this->sales_name);
						if ($this->wilayah_id->Exportable) $Doc->ExportField($this->wilayah_id);
						if ($this->subwil_id->Exportable) $Doc->ExportField($this->subwil_id);
						if ($this->area_id->Exportable) $Doc->ExportField($this->area_id);
						if ($this->sales_target->Exportable) $Doc->ExportField($this->sales_target);
						if ($this->sales_intensif->Exportable) $Doc->ExportField($this->sales_intensif);
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
