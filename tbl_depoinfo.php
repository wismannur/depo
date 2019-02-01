<?php

// Global variable for table object
$tbl_depo = NULL;

//
// Table class for tbl_depo
//
class ctbl_depo extends cTable {
	var $kode_depo;
	var $nama_depo;
	var $alamat1;
	var $alamat2;
	var $alamat3;
	var $telp;
	var $fax;
	var $penanggung_jawab;
	var $trx_kode;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tbl_depo';
		$this->TableName = 'tbl_depo';
		$this->TableType = 'LINKTABLE';

		// Update Table
		$this->UpdateTable = "`tbl_depo`";
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

		// kode_depo
		$this->kode_depo = new cField('tbl_depo', 'tbl_depo', 'x_kode_depo', 'kode_depo', '`kode_depo`', '`kode_depo`', 200, -1, FALSE, '`kode_depo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_depo->Sortable = TRUE; // Allow sort
		$this->fields['kode_depo'] = &$this->kode_depo;

		// nama_depo
		$this->nama_depo = new cField('tbl_depo', 'tbl_depo', 'x_nama_depo', 'nama_depo', '`nama_depo`', '`nama_depo`', 200, -1, FALSE, '`nama_depo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_depo->Sortable = TRUE; // Allow sort
		$this->fields['nama_depo'] = &$this->nama_depo;

		// alamat1
		$this->alamat1 = new cField('tbl_depo', 'tbl_depo', 'x_alamat1', 'alamat1', '`alamat1`', '`alamat1`', 200, -1, FALSE, '`alamat1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->alamat1->Sortable = TRUE; // Allow sort
		$this->fields['alamat1'] = &$this->alamat1;

		// alamat2
		$this->alamat2 = new cField('tbl_depo', 'tbl_depo', 'x_alamat2', 'alamat2', '`alamat2`', '`alamat2`', 200, -1, FALSE, '`alamat2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->alamat2->Sortable = TRUE; // Allow sort
		$this->fields['alamat2'] = &$this->alamat2;

		// alamat3
		$this->alamat3 = new cField('tbl_depo', 'tbl_depo', 'x_alamat3', 'alamat3', '`alamat3`', '`alamat3`', 200, -1, FALSE, '`alamat3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->alamat3->Sortable = TRUE; // Allow sort
		$this->fields['alamat3'] = &$this->alamat3;

		// telp
		$this->telp = new cField('tbl_depo', 'tbl_depo', 'x_telp', 'telp', '`telp`', '`telp`', 200, -1, FALSE, '`telp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telp->Sortable = TRUE; // Allow sort
		$this->fields['telp'] = &$this->telp;

		// fax
		$this->fax = new cField('tbl_depo', 'tbl_depo', 'x_fax', 'fax', '`fax`', '`fax`', 200, -1, FALSE, '`fax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fax->Sortable = TRUE; // Allow sort
		$this->fields['fax'] = &$this->fax;

		// penanggung_jawab
		$this->penanggung_jawab = new cField('tbl_depo', 'tbl_depo', 'x_penanggung_jawab', 'penanggung_jawab', '`penanggung_jawab`', '`penanggung_jawab`', 200, -1, FALSE, '`penanggung_jawab`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->penanggung_jawab->Sortable = TRUE; // Allow sort
		$this->fields['penanggung_jawab'] = &$this->penanggung_jawab;

		// trx_kode
		$this->trx_kode = new cField('tbl_depo', 'tbl_depo', 'x_trx_kode', 'trx_kode', '`trx_kode`', '`trx_kode`', 200, -1, FALSE, '`trx_kode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->trx_kode->Sortable = TRUE; // Allow sort
		$this->fields['trx_kode'] = &$this->trx_kode;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tbl_depo`";
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
			if (array_key_exists('kode_depo', $rs))
				ew_AddFilter($where, ew_QuotedName('kode_depo', $this->DBID) . '=' . ew_QuotedValue($rs['kode_depo'], $this->kode_depo->FldDataType, $this->DBID));
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
		return "`kode_depo` = '@kode_depo@'";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (is_null($this->kode_depo->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@kode_depo@", ew_AdjustSql($this->kode_depo->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "tbl_depolist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tbl_depoview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tbl_depoedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tbl_depoadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tbl_depolist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tbl_depoview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tbl_depoview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tbl_depoadd.php?" . $this->UrlParm($parm);
		else
			$url = "tbl_depoadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("tbl_depoedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("tbl_depoadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tbl_depodelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "kode_depo:" . ew_VarToJson($this->kode_depo->CurrentValue, "string", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->kode_depo->CurrentValue)) {
			$sUrl .= "kode_depo=" . urlencode($this->kode_depo->CurrentValue);
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
			if ($isPost && isset($_POST["kode_depo"]))
				$arKeys[] = $_POST["kode_depo"];
			elseif (isset($_GET["kode_depo"]))
				$arKeys[] = $_GET["kode_depo"];
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
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
			$this->kode_depo->CurrentValue = $key;
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
		$this->kode_depo->setDbValue($rs->fields('kode_depo'));
		$this->nama_depo->setDbValue($rs->fields('nama_depo'));
		$this->alamat1->setDbValue($rs->fields('alamat1'));
		$this->alamat2->setDbValue($rs->fields('alamat2'));
		$this->alamat3->setDbValue($rs->fields('alamat3'));
		$this->telp->setDbValue($rs->fields('telp'));
		$this->fax->setDbValue($rs->fields('fax'));
		$this->penanggung_jawab->setDbValue($rs->fields('penanggung_jawab'));
		$this->trx_kode->setDbValue($rs->fields('trx_kode'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// kode_depo
		// nama_depo
		// alamat1
		// alamat2
		// alamat3
		// telp
		// fax
		// penanggung_jawab
		// trx_kode
		// kode_depo

		$this->kode_depo->ViewValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// nama_depo
		$this->nama_depo->ViewValue = $this->nama_depo->CurrentValue;
		$this->nama_depo->ViewCustomAttributes = "";

		// alamat1
		$this->alamat1->ViewValue = $this->alamat1->CurrentValue;
		$this->alamat1->ViewCustomAttributes = "";

		// alamat2
		$this->alamat2->ViewValue = $this->alamat2->CurrentValue;
		$this->alamat2->ViewCustomAttributes = "";

		// alamat3
		$this->alamat3->ViewValue = $this->alamat3->CurrentValue;
		$this->alamat3->ViewCustomAttributes = "";

		// telp
		$this->telp->ViewValue = $this->telp->CurrentValue;
		$this->telp->ViewCustomAttributes = "";

		// fax
		$this->fax->ViewValue = $this->fax->CurrentValue;
		$this->fax->ViewCustomAttributes = "";

		// penanggung_jawab
		$this->penanggung_jawab->ViewValue = $this->penanggung_jawab->CurrentValue;
		$this->penanggung_jawab->ViewCustomAttributes = "";

		// trx_kode
		$this->trx_kode->ViewValue = $this->trx_kode->CurrentValue;
		$this->trx_kode->ViewCustomAttributes = "";

		// kode_depo
		$this->kode_depo->LinkCustomAttributes = "";
		$this->kode_depo->HrefValue = "";
		$this->kode_depo->TooltipValue = "";

		// nama_depo
		$this->nama_depo->LinkCustomAttributes = "";
		$this->nama_depo->HrefValue = "";
		$this->nama_depo->TooltipValue = "";

		// alamat1
		$this->alamat1->LinkCustomAttributes = "";
		$this->alamat1->HrefValue = "";
		$this->alamat1->TooltipValue = "";

		// alamat2
		$this->alamat2->LinkCustomAttributes = "";
		$this->alamat2->HrefValue = "";
		$this->alamat2->TooltipValue = "";

		// alamat3
		$this->alamat3->LinkCustomAttributes = "";
		$this->alamat3->HrefValue = "";
		$this->alamat3->TooltipValue = "";

		// telp
		$this->telp->LinkCustomAttributes = "";
		$this->telp->HrefValue = "";
		$this->telp->TooltipValue = "";

		// fax
		$this->fax->LinkCustomAttributes = "";
		$this->fax->HrefValue = "";
		$this->fax->TooltipValue = "";

		// penanggung_jawab
		$this->penanggung_jawab->LinkCustomAttributes = "";
		$this->penanggung_jawab->HrefValue = "";
		$this->penanggung_jawab->TooltipValue = "";

		// trx_kode
		$this->trx_kode->LinkCustomAttributes = "";
		$this->trx_kode->HrefValue = "";
		$this->trx_kode->TooltipValue = "";

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

		// kode_depo
		$this->kode_depo->EditAttrs["class"] = "form-control";
		$this->kode_depo->EditCustomAttributes = "";
		$this->kode_depo->EditValue = $this->kode_depo->CurrentValue;
		$this->kode_depo->ViewCustomAttributes = "";

		// nama_depo
		$this->nama_depo->EditAttrs["class"] = "form-control";
		$this->nama_depo->EditCustomAttributes = "";
		$this->nama_depo->EditValue = $this->nama_depo->CurrentValue;
		$this->nama_depo->PlaceHolder = ew_RemoveHtml($this->nama_depo->FldCaption());

		// alamat1
		$this->alamat1->EditAttrs["class"] = "form-control";
		$this->alamat1->EditCustomAttributes = "";
		$this->alamat1->EditValue = $this->alamat1->CurrentValue;
		$this->alamat1->PlaceHolder = ew_RemoveHtml($this->alamat1->FldCaption());

		// alamat2
		$this->alamat2->EditAttrs["class"] = "form-control";
		$this->alamat2->EditCustomAttributes = "";
		$this->alamat2->EditValue = $this->alamat2->CurrentValue;
		$this->alamat2->PlaceHolder = ew_RemoveHtml($this->alamat2->FldCaption());

		// alamat3
		$this->alamat3->EditAttrs["class"] = "form-control";
		$this->alamat3->EditCustomAttributes = "";
		$this->alamat3->EditValue = $this->alamat3->CurrentValue;
		$this->alamat3->PlaceHolder = ew_RemoveHtml($this->alamat3->FldCaption());

		// telp
		$this->telp->EditAttrs["class"] = "form-control";
		$this->telp->EditCustomAttributes = "";
		$this->telp->EditValue = $this->telp->CurrentValue;
		$this->telp->PlaceHolder = ew_RemoveHtml($this->telp->FldCaption());

		// fax
		$this->fax->EditAttrs["class"] = "form-control";
		$this->fax->EditCustomAttributes = "";
		$this->fax->EditValue = $this->fax->CurrentValue;
		$this->fax->PlaceHolder = ew_RemoveHtml($this->fax->FldCaption());

		// penanggung_jawab
		$this->penanggung_jawab->EditAttrs["class"] = "form-control";
		$this->penanggung_jawab->EditCustomAttributes = "";
		$this->penanggung_jawab->EditValue = $this->penanggung_jawab->CurrentValue;
		$this->penanggung_jawab->PlaceHolder = ew_RemoveHtml($this->penanggung_jawab->FldCaption());

		// trx_kode
		$this->trx_kode->EditAttrs["class"] = "form-control";
		$this->trx_kode->EditCustomAttributes = "";
		$this->trx_kode->EditValue = $this->trx_kode->CurrentValue;
		$this->trx_kode->PlaceHolder = ew_RemoveHtml($this->trx_kode->FldCaption());

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
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
					if ($this->nama_depo->Exportable) $Doc->ExportCaption($this->nama_depo);
					if ($this->alamat1->Exportable) $Doc->ExportCaption($this->alamat1);
					if ($this->alamat2->Exportable) $Doc->ExportCaption($this->alamat2);
					if ($this->alamat3->Exportable) $Doc->ExportCaption($this->alamat3);
					if ($this->telp->Exportable) $Doc->ExportCaption($this->telp);
					if ($this->fax->Exportable) $Doc->ExportCaption($this->fax);
					if ($this->penanggung_jawab->Exportable) $Doc->ExportCaption($this->penanggung_jawab);
					if ($this->trx_kode->Exportable) $Doc->ExportCaption($this->trx_kode);
				} else {
					if ($this->kode_depo->Exportable) $Doc->ExportCaption($this->kode_depo);
					if ($this->nama_depo->Exportable) $Doc->ExportCaption($this->nama_depo);
					if ($this->alamat1->Exportable) $Doc->ExportCaption($this->alamat1);
					if ($this->alamat2->Exportable) $Doc->ExportCaption($this->alamat2);
					if ($this->alamat3->Exportable) $Doc->ExportCaption($this->alamat3);
					if ($this->telp->Exportable) $Doc->ExportCaption($this->telp);
					if ($this->fax->Exportable) $Doc->ExportCaption($this->fax);
					if ($this->penanggung_jawab->Exportable) $Doc->ExportCaption($this->penanggung_jawab);
					if ($this->trx_kode->Exportable) $Doc->ExportCaption($this->trx_kode);
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
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
						if ($this->nama_depo->Exportable) $Doc->ExportField($this->nama_depo);
						if ($this->alamat1->Exportable) $Doc->ExportField($this->alamat1);
						if ($this->alamat2->Exportable) $Doc->ExportField($this->alamat2);
						if ($this->alamat3->Exportable) $Doc->ExportField($this->alamat3);
						if ($this->telp->Exportable) $Doc->ExportField($this->telp);
						if ($this->fax->Exportable) $Doc->ExportField($this->fax);
						if ($this->penanggung_jawab->Exportable) $Doc->ExportField($this->penanggung_jawab);
						if ($this->trx_kode->Exportable) $Doc->ExportField($this->trx_kode);
					} else {
						if ($this->kode_depo->Exportable) $Doc->ExportField($this->kode_depo);
						if ($this->nama_depo->Exportable) $Doc->ExportField($this->nama_depo);
						if ($this->alamat1->Exportable) $Doc->ExportField($this->alamat1);
						if ($this->alamat2->Exportable) $Doc->ExportField($this->alamat2);
						if ($this->alamat3->Exportable) $Doc->ExportField($this->alamat3);
						if ($this->telp->Exportable) $Doc->ExportField($this->telp);
						if ($this->fax->Exportable) $Doc->ExportField($this->fax);
						if ($this->penanggung_jawab->Exportable) $Doc->ExportField($this->penanggung_jawab);
						if ($this->trx_kode->Exportable) $Doc->ExportField($this->trx_kode);
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
