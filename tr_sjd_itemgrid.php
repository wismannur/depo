<?php include_once "employeesinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($tr_sjd_item_grid)) $tr_sjd_item_grid = new ctr_sjd_item_grid();

// Page init
$tr_sjd_item_grid->Page_Init();

// Page main
$tr_sjd_item_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_sjd_item_grid->Page_Render();
?>
<?php if ($tr_sjd_item->Export == "") { ?>
<script type="text/javascript">

// Form object
var ftr_sjd_itemgrid = new ew_Form("ftr_sjd_itemgrid", "grid");
ftr_sjd_itemgrid.FormKeyCountName = '<?php echo $tr_sjd_item_grid->FormKeyCountName ?>';

// Validate form
ftr_sjd_itemgrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_item_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_sjd_item->item_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_item_price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_sjd_item->item_price->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_item_qty");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_sjd_item->item_qty->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_qty_rcv");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_sjd_item->qty_rcv->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftr_sjd_itemgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "item_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_code", false)) return false;
	if (ew_ValueChanged(fobj, infix, "unit_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_price", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_qty", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qty_rcv", false)) return false;
	if (ew_ValueChanged(fobj, infix, "cek_sjd[]", false)) return false;
	return true;
}

// Form_CustomValidate event
ftr_sjd_itemgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_sjd_itemgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_sjd_itemgrid.Lists["x_item_id"] = {"LinkField":"x_product_id","Ajax":true,"AutoFill":true,"DisplayFields":["x_product_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_products"};
ftr_sjd_itemgrid.Lists["x_item_id"].Data = "<?php echo $tr_sjd_item_grid->item_id->LookupFilterQuery(FALSE, "grid") ?>";
ftr_sjd_itemgrid.AutoSuggests["x_item_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $tr_sjd_item_grid->item_id->LookupFilterQuery(TRUE, "grid"))) ?>;
ftr_sjd_itemgrid.Lists["x_unit_id"] = {"LinkField":"x_unit_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_unit_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tbl_unit_detail"};
ftr_sjd_itemgrid.Lists["x_unit_id"].Data = "<?php echo $tr_sjd_item_grid->unit_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($tr_sjd_item->CurrentAction == "gridadd") {
	if ($tr_sjd_item->CurrentMode == "copy") {
		$bSelectLimit = $tr_sjd_item_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$tr_sjd_item_grid->TotalRecs = $tr_sjd_item->ListRecordCount();
			$tr_sjd_item_grid->Recordset = $tr_sjd_item_grid->LoadRecordset($tr_sjd_item_grid->StartRec-1, $tr_sjd_item_grid->DisplayRecs);
		} else {
			if ($tr_sjd_item_grid->Recordset = $tr_sjd_item_grid->LoadRecordset())
				$tr_sjd_item_grid->TotalRecs = $tr_sjd_item_grid->Recordset->RecordCount();
		}
		$tr_sjd_item_grid->StartRec = 1;
		$tr_sjd_item_grid->DisplayRecs = $tr_sjd_item_grid->TotalRecs;
	} else {
		$tr_sjd_item->CurrentFilter = "0=1";
		$tr_sjd_item_grid->StartRec = 1;
		$tr_sjd_item_grid->DisplayRecs = $tr_sjd_item->GridAddRowCount;
	}
	$tr_sjd_item_grid->TotalRecs = $tr_sjd_item_grid->DisplayRecs;
	$tr_sjd_item_grid->StopRec = $tr_sjd_item_grid->DisplayRecs;
} else {
	$bSelectLimit = $tr_sjd_item_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($tr_sjd_item_grid->TotalRecs <= 0)
			$tr_sjd_item_grid->TotalRecs = $tr_sjd_item->ListRecordCount();
	} else {
		if (!$tr_sjd_item_grid->Recordset && ($tr_sjd_item_grid->Recordset = $tr_sjd_item_grid->LoadRecordset()))
			$tr_sjd_item_grid->TotalRecs = $tr_sjd_item_grid->Recordset->RecordCount();
	}
	$tr_sjd_item_grid->StartRec = 1;
	$tr_sjd_item_grid->DisplayRecs = $tr_sjd_item_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$tr_sjd_item_grid->Recordset = $tr_sjd_item_grid->LoadRecordset($tr_sjd_item_grid->StartRec-1, $tr_sjd_item_grid->DisplayRecs);

	// Set no record found message
	if ($tr_sjd_item->CurrentAction == "" && $tr_sjd_item_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$tr_sjd_item_grid->setWarningMessage(ew_DeniedMsg());
		if ($tr_sjd_item_grid->SearchWhere == "0=101")
			$tr_sjd_item_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$tr_sjd_item_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$tr_sjd_item_grid->RenderOtherOptions();
?>
<?php $tr_sjd_item_grid->ShowPageHeader(); ?>
<?php
$tr_sjd_item_grid->ShowMessage();
?>
<?php if ($tr_sjd_item_grid->TotalRecs > 0 || $tr_sjd_item->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($tr_sjd_item_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> tr_sjd_item">
<div id="ftr_sjd_itemgrid" class="ewForm ewListForm form-inline">
<?php if ($tr_sjd_item_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($tr_sjd_item_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_tr_sjd_item" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_tr_sjd_itemgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$tr_sjd_item_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$tr_sjd_item_grid->RenderListOptions();

// Render list options (header, left)
$tr_sjd_item_grid->ListOptions->Render("header", "left");
?>
<?php if ($tr_sjd_item->item_id->Visible) { // item_id ?>
	<?php if ($tr_sjd_item->SortUrl($tr_sjd_item->item_id) == "") { ?>
		<th data-name="item_id" class="<?php echo $tr_sjd_item->item_id->HeaderCellClass() ?>"><div id="elh_tr_sjd_item_item_id" class="tr_sjd_item_item_id"><div class="ewTableHeaderCaption"><?php echo $tr_sjd_item->item_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_id" class="<?php echo $tr_sjd_item->item_id->HeaderCellClass() ?>"><div><div id="elh_tr_sjd_item_item_id" class="tr_sjd_item_item_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_sjd_item->item_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_sjd_item->item_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_sjd_item->item_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->item_code->Visible) { // item_code ?>
	<?php if ($tr_sjd_item->SortUrl($tr_sjd_item->item_code) == "") { ?>
		<th data-name="item_code" class="<?php echo $tr_sjd_item->item_code->HeaderCellClass() ?>"><div id="elh_tr_sjd_item_item_code" class="tr_sjd_item_item_code"><div class="ewTableHeaderCaption"><?php echo $tr_sjd_item->item_code->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_code" class="<?php echo $tr_sjd_item->item_code->HeaderCellClass() ?>"><div><div id="elh_tr_sjd_item_item_code" class="tr_sjd_item_item_code">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_sjd_item->item_code->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_sjd_item->item_code->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_sjd_item->item_code->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->unit_id->Visible) { // unit_id ?>
	<?php if ($tr_sjd_item->SortUrl($tr_sjd_item->unit_id) == "") { ?>
		<th data-name="unit_id" class="<?php echo $tr_sjd_item->unit_id->HeaderCellClass() ?>"><div id="elh_tr_sjd_item_unit_id" class="tr_sjd_item_unit_id"><div class="ewTableHeaderCaption"><?php echo $tr_sjd_item->unit_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unit_id" class="<?php echo $tr_sjd_item->unit_id->HeaderCellClass() ?>"><div><div id="elh_tr_sjd_item_unit_id" class="tr_sjd_item_unit_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_sjd_item->unit_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_sjd_item->unit_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_sjd_item->unit_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->item_price->Visible) { // item_price ?>
	<?php if ($tr_sjd_item->SortUrl($tr_sjd_item->item_price) == "") { ?>
		<th data-name="item_price" class="<?php echo $tr_sjd_item->item_price->HeaderCellClass() ?>"><div id="elh_tr_sjd_item_item_price" class="tr_sjd_item_item_price"><div class="ewTableHeaderCaption"><?php echo $tr_sjd_item->item_price->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_price" class="<?php echo $tr_sjd_item->item_price->HeaderCellClass() ?>"><div><div id="elh_tr_sjd_item_item_price" class="tr_sjd_item_item_price">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_sjd_item->item_price->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_sjd_item->item_price->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_sjd_item->item_price->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->item_qty->Visible) { // item_qty ?>
	<?php if ($tr_sjd_item->SortUrl($tr_sjd_item->item_qty) == "") { ?>
		<th data-name="item_qty" class="<?php echo $tr_sjd_item->item_qty->HeaderCellClass() ?>"><div id="elh_tr_sjd_item_item_qty" class="tr_sjd_item_item_qty"><div class="ewTableHeaderCaption"><?php echo $tr_sjd_item->item_qty->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_qty" class="<?php echo $tr_sjd_item->item_qty->HeaderCellClass() ?>"><div><div id="elh_tr_sjd_item_item_qty" class="tr_sjd_item_item_qty">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_sjd_item->item_qty->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_sjd_item->item_qty->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_sjd_item->item_qty->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->qty_rcv->Visible) { // qty_rcv ?>
	<?php if ($tr_sjd_item->SortUrl($tr_sjd_item->qty_rcv) == "") { ?>
		<th data-name="qty_rcv" class="<?php echo $tr_sjd_item->qty_rcv->HeaderCellClass() ?>"><div id="elh_tr_sjd_item_qty_rcv" class="tr_sjd_item_qty_rcv"><div class="ewTableHeaderCaption"><?php echo $tr_sjd_item->qty_rcv->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty_rcv" class="<?php echo $tr_sjd_item->qty_rcv->HeaderCellClass() ?>"><div><div id="elh_tr_sjd_item_qty_rcv" class="tr_sjd_item_qty_rcv">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_sjd_item->qty_rcv->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_sjd_item->qty_rcv->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_sjd_item->qty_rcv->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_sjd_item->cek_sjd->Visible) { // cek_sjd ?>
	<?php if ($tr_sjd_item->SortUrl($tr_sjd_item->cek_sjd) == "") { ?>
		<th data-name="cek_sjd" class="<?php echo $tr_sjd_item->cek_sjd->HeaderCellClass() ?>"><div id="elh_tr_sjd_item_cek_sjd" class="tr_sjd_item_cek_sjd"><div class="ewTableHeaderCaption"><?php echo $tr_sjd_item->cek_sjd->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cek_sjd" class="<?php echo $tr_sjd_item->cek_sjd->HeaderCellClass() ?>"><div><div id="elh_tr_sjd_item_cek_sjd" class="tr_sjd_item_cek_sjd">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_sjd_item->cek_sjd->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_sjd_item->cek_sjd->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_sjd_item->cek_sjd->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tr_sjd_item_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tr_sjd_item_grid->StartRec = 1;
$tr_sjd_item_grid->StopRec = $tr_sjd_item_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($tr_sjd_item_grid->FormKeyCountName) && ($tr_sjd_item->CurrentAction == "gridadd" || $tr_sjd_item->CurrentAction == "gridedit" || $tr_sjd_item->CurrentAction == "F")) {
		$tr_sjd_item_grid->KeyCount = $objForm->GetValue($tr_sjd_item_grid->FormKeyCountName);
		$tr_sjd_item_grid->StopRec = $tr_sjd_item_grid->StartRec + $tr_sjd_item_grid->KeyCount - 1;
	}
}
$tr_sjd_item_grid->RecCnt = $tr_sjd_item_grid->StartRec - 1;
if ($tr_sjd_item_grid->Recordset && !$tr_sjd_item_grid->Recordset->EOF) {
	$tr_sjd_item_grid->Recordset->MoveFirst();
	$bSelectLimit = $tr_sjd_item_grid->UseSelectLimit;
	if (!$bSelectLimit && $tr_sjd_item_grid->StartRec > 1)
		$tr_sjd_item_grid->Recordset->Move($tr_sjd_item_grid->StartRec - 1);
} elseif (!$tr_sjd_item->AllowAddDeleteRow && $tr_sjd_item_grid->StopRec == 0) {
	$tr_sjd_item_grid->StopRec = $tr_sjd_item->GridAddRowCount;
}

// Initialize aggregate
$tr_sjd_item->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tr_sjd_item->ResetAttrs();
$tr_sjd_item_grid->RenderRow();
if ($tr_sjd_item->CurrentAction == "gridadd")
	$tr_sjd_item_grid->RowIndex = 0;
if ($tr_sjd_item->CurrentAction == "gridedit")
	$tr_sjd_item_grid->RowIndex = 0;
while ($tr_sjd_item_grid->RecCnt < $tr_sjd_item_grid->StopRec) {
	$tr_sjd_item_grid->RecCnt++;
	if (intval($tr_sjd_item_grid->RecCnt) >= intval($tr_sjd_item_grid->StartRec)) {
		$tr_sjd_item_grid->RowCnt++;
		if ($tr_sjd_item->CurrentAction == "gridadd" || $tr_sjd_item->CurrentAction == "gridedit" || $tr_sjd_item->CurrentAction == "F") {
			$tr_sjd_item_grid->RowIndex++;
			$objForm->Index = $tr_sjd_item_grid->RowIndex;
			if ($objForm->HasValue($tr_sjd_item_grid->FormActionName))
				$tr_sjd_item_grid->RowAction = strval($objForm->GetValue($tr_sjd_item_grid->FormActionName));
			elseif ($tr_sjd_item->CurrentAction == "gridadd")
				$tr_sjd_item_grid->RowAction = "insert";
			else
				$tr_sjd_item_grid->RowAction = "";
		}

		// Set up key count
		$tr_sjd_item_grid->KeyCount = $tr_sjd_item_grid->RowIndex;

		// Init row class and style
		$tr_sjd_item->ResetAttrs();
		$tr_sjd_item->CssClass = "";
		if ($tr_sjd_item->CurrentAction == "gridadd") {
			if ($tr_sjd_item->CurrentMode == "copy") {
				$tr_sjd_item_grid->LoadRowValues($tr_sjd_item_grid->Recordset); // Load row values
				$tr_sjd_item_grid->SetRecordKey($tr_sjd_item_grid->RowOldKey, $tr_sjd_item_grid->Recordset); // Set old record key
			} else {
				$tr_sjd_item_grid->LoadRowValues(); // Load default values
				$tr_sjd_item_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tr_sjd_item_grid->LoadRowValues($tr_sjd_item_grid->Recordset); // Load row values
		}
		$tr_sjd_item->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($tr_sjd_item->CurrentAction == "gridadd") // Grid add
			$tr_sjd_item->RowType = EW_ROWTYPE_ADD; // Render add
		if ($tr_sjd_item->CurrentAction == "gridadd" && $tr_sjd_item->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$tr_sjd_item_grid->RestoreCurrentRowFormValues($tr_sjd_item_grid->RowIndex); // Restore form values
		if ($tr_sjd_item->CurrentAction == "gridedit") { // Grid edit
			if ($tr_sjd_item->EventCancelled) {
				$tr_sjd_item_grid->RestoreCurrentRowFormValues($tr_sjd_item_grid->RowIndex); // Restore form values
			}
			if ($tr_sjd_item_grid->RowAction == "insert")
				$tr_sjd_item->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$tr_sjd_item->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($tr_sjd_item->CurrentAction == "gridedit" && ($tr_sjd_item->RowType == EW_ROWTYPE_EDIT || $tr_sjd_item->RowType == EW_ROWTYPE_ADD) && $tr_sjd_item->EventCancelled) // Update failed
			$tr_sjd_item_grid->RestoreCurrentRowFormValues($tr_sjd_item_grid->RowIndex); // Restore form values
		if ($tr_sjd_item->RowType == EW_ROWTYPE_EDIT) // Edit row
			$tr_sjd_item_grid->EditRowCnt++;
		if ($tr_sjd_item->CurrentAction == "F") // Confirm row
			$tr_sjd_item_grid->RestoreCurrentRowFormValues($tr_sjd_item_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tr_sjd_item->RowAttrs = array_merge($tr_sjd_item->RowAttrs, array('data-rowindex'=>$tr_sjd_item_grid->RowCnt, 'id'=>'r' . $tr_sjd_item_grid->RowCnt . '_tr_sjd_item', 'data-rowtype'=>$tr_sjd_item->RowType));

		// Render row
		$tr_sjd_item_grid->RenderRow();

		// Render list options
		$tr_sjd_item_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tr_sjd_item_grid->RowAction <> "delete" && $tr_sjd_item_grid->RowAction <> "insertdelete" && !($tr_sjd_item_grid->RowAction == "insert" && $tr_sjd_item->CurrentAction == "F" && $tr_sjd_item_grid->EmptyRow())) {
?>
	<tr<?php echo $tr_sjd_item->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tr_sjd_item_grid->ListOptions->Render("body", "left", $tr_sjd_item_grid->RowCnt);
?>
	<?php if ($tr_sjd_item->item_id->Visible) { // item_id ?>
		<td data-name="item_id"<?php echo $tr_sjd_item->item_id->CellAttributes() ?>>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_item_id" class="form-group tr_sjd_item_item_id">
<?php
$wrkonchange = trim("ew_AutoFill(this); " . @$tr_sjd_item->item_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_sjd_item->item_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" style="white-space: nowrap; z-index: <?php echo (9000 - $tr_sjd_item_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="sv_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo $tr_sjd_item->item_id->EditValue ?>" size="40" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->getPlaceHolder()) ?>"<?php echo $tr_sjd_item->item_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_id" data-value-separator="<?php echo $tr_sjd_item->item_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ftr_sjd_itemgrid.CreateAutoSuggest({"id":"x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id","forceSelect":true});
</script>
<input type="hidden" name="ln_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="ln_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code,x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price,x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id">
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_id" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_item_id" class="form-group tr_sjd_item_item_id">
<?php
$wrkonchange = trim("ew_AutoFill(this); " . @$tr_sjd_item->item_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_sjd_item->item_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" style="white-space: nowrap; z-index: <?php echo (9000 - $tr_sjd_item_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="sv_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo $tr_sjd_item->item_id->EditValue ?>" size="40" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->getPlaceHolder()) ?>"<?php echo $tr_sjd_item->item_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_id" data-value-separator="<?php echo $tr_sjd_item->item_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ftr_sjd_itemgrid.CreateAutoSuggest({"id":"x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id","forceSelect":true});
</script>
<input type="hidden" name="ln_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="ln_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code,x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price,x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id">
</span>
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_item_id" class="tr_sjd_item_item_id">
<span<?php echo $tr_sjd_item->item_id->ViewAttributes() ?>>
<?php echo $tr_sjd_item->item_id->ListViewValue() ?></span>
</span>
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_id" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_id" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_id" name="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_id" name="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_row_id" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_row_id" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->row_id->CurrentValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_row_id" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_row_id" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->row_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_EDIT || $tr_sjd_item->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_row_id" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_row_id" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->row_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($tr_sjd_item->item_code->Visible) { // item_code ?>
		<td data-name="item_code"<?php echo $tr_sjd_item->item_code->CellAttributes() ?>>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_item_code" class="form-group tr_sjd_item_item_code">
<input type="text" data-table="tr_sjd_item" data-field="x_item_code" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_code->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_code->EditValue ?>"<?php echo $tr_sjd_item->item_code->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_code" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_code->OldValue) ?>">
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_item_code" class="form-group tr_sjd_item_item_code">
<input type="text" data-table="tr_sjd_item" data-field="x_item_code" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_code->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_code->EditValue ?>"<?php echo $tr_sjd_item->item_code->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_item_code" class="tr_sjd_item_item_code">
<span<?php echo $tr_sjd_item->item_code->ViewAttributes() ?>>
<?php echo $tr_sjd_item->item_code->ListViewValue() ?></span>
</span>
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_code" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_code->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_code" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_code" name="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" id="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_code->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_code" name="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" id="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_sjd_item->unit_id->Visible) { // unit_id ?>
		<td data-name="unit_id"<?php echo $tr_sjd_item->unit_id->CellAttributes() ?>>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_unit_id" class="form-group tr_sjd_item_unit_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_sjd_item->unit_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_sjd_item->unit_id->ViewValue ?>
	</span>
	<?php if (!$tr_sjd_item->unit_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_sjd_item->unit_id->RadioButtonListHtml(TRUE, "x{$tr_sjd_item_grid->RowIndex}_unit_id") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" class="ewTemplate"><input type="radio" data-table="tr_sjd_item" data-field="x_unit_id" data-value-separator="<?php echo $tr_sjd_item->unit_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" value="{value}"<?php echo $tr_sjd_item->unit_id->EditAttributes() ?>></div>
</div>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_unit_id" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->unit_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_unit_id" class="form-group tr_sjd_item_unit_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_sjd_item->unit_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_sjd_item->unit_id->ViewValue ?>
	</span>
	<?php if (!$tr_sjd_item->unit_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_sjd_item->unit_id->RadioButtonListHtml(TRUE, "x{$tr_sjd_item_grid->RowIndex}_unit_id") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" class="ewTemplate"><input type="radio" data-table="tr_sjd_item" data-field="x_unit_id" data-value-separator="<?php echo $tr_sjd_item->unit_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" value="{value}"<?php echo $tr_sjd_item->unit_id->EditAttributes() ?>></div>
</div>
</span>
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_unit_id" class="tr_sjd_item_unit_id">
<span<?php echo $tr_sjd_item->unit_id->ViewAttributes() ?>>
<?php echo $tr_sjd_item->unit_id->ListViewValue() ?></span>
</span>
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_unit_id" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->unit_id->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_unit_id" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->unit_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_unit_id" name="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" id="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->unit_id->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_unit_id" name="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" id="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->unit_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_sjd_item->item_price->Visible) { // item_price ?>
		<td data-name="item_price"<?php echo $tr_sjd_item->item_price->CellAttributes() ?>>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_item_price" class="form-group tr_sjd_item_item_price">
<input type="text" data-table="tr_sjd_item" data-field="x_item_price" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" size="15" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_price->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_price->EditValue ?>"<?php echo $tr_sjd_item->item_price->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_price" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_price->OldValue) ?>">
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_item_price" class="form-group tr_sjd_item_item_price">
<input type="text" data-table="tr_sjd_item" data-field="x_item_price" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" size="15" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_price->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_price->EditValue ?>"<?php echo $tr_sjd_item->item_price->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_item_price" class="tr_sjd_item_item_price">
<span<?php echo $tr_sjd_item->item_price->ViewAttributes() ?>>
<?php echo $tr_sjd_item->item_price->ListViewValue() ?></span>
</span>
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_price" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_price->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_price" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_price->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_price" name="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" id="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_price->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_price" name="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" id="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_price->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_sjd_item->item_qty->Visible) { // item_qty ?>
		<td data-name="item_qty"<?php echo $tr_sjd_item->item_qty->CellAttributes() ?>>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_item_qty" class="form-group tr_sjd_item_item_qty">
<input type="text" data-table="tr_sjd_item" data-field="x_item_qty" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" size="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_qty->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_qty->EditValue ?>"<?php echo $tr_sjd_item->item_qty->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_qty" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_qty->OldValue) ?>">
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_item_qty" class="form-group tr_sjd_item_item_qty">
<input type="text" data-table="tr_sjd_item" data-field="x_item_qty" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" size="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_qty->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_qty->EditValue ?>"<?php echo $tr_sjd_item->item_qty->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_item_qty" class="tr_sjd_item_item_qty">
<span<?php echo $tr_sjd_item->item_qty->ViewAttributes() ?>>
<?php echo $tr_sjd_item->item_qty->ListViewValue() ?></span>
</span>
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_qty" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_qty->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_qty" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_qty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_qty" name="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" id="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_qty->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_qty" name="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" id="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_qty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_sjd_item->qty_rcv->Visible) { // qty_rcv ?>
		<td data-name="qty_rcv"<?php echo $tr_sjd_item->qty_rcv->CellAttributes() ?>>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_qty_rcv" class="form-group tr_sjd_item_qty_rcv">
<input type="text" data-table="tr_sjd_item" data-field="x_qty_rcv" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" size="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->qty_rcv->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->qty_rcv->EditValue ?>"<?php echo $tr_sjd_item->qty_rcv->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_qty_rcv" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" value="<?php echo ew_HtmlEncode($tr_sjd_item->qty_rcv->OldValue) ?>">
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_qty_rcv" class="form-group tr_sjd_item_qty_rcv">
<input type="text" data-table="tr_sjd_item" data-field="x_qty_rcv" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" size="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->qty_rcv->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->qty_rcv->EditValue ?>"<?php echo $tr_sjd_item->qty_rcv->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_qty_rcv" class="tr_sjd_item_qty_rcv">
<span<?php echo $tr_sjd_item->qty_rcv->ViewAttributes() ?>>
<?php echo $tr_sjd_item->qty_rcv->ListViewValue() ?></span>
</span>
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_qty_rcv" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" value="<?php echo ew_HtmlEncode($tr_sjd_item->qty_rcv->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_qty_rcv" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" value="<?php echo ew_HtmlEncode($tr_sjd_item->qty_rcv->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_qty_rcv" name="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" id="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" value="<?php echo ew_HtmlEncode($tr_sjd_item->qty_rcv->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_qty_rcv" name="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" id="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" value="<?php echo ew_HtmlEncode($tr_sjd_item->qty_rcv->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_sjd_item->cek_sjd->Visible) { // cek_sjd ?>
		<td data-name="cek_sjd"<?php echo $tr_sjd_item->cek_sjd->CellAttributes() ?>>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_cek_sjd" class="form-group tr_sjd_item_cek_sjd">
<div id="tp_x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd" class="ewTemplate"><input type="checkbox" data-table="tr_sjd_item" data-field="x_cek_sjd" data-value-separator="<?php echo $tr_sjd_item->cek_sjd->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" value="{value}"<?php echo $tr_sjd_item->cek_sjd->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $tr_sjd_item->cek_sjd->CheckBoxListHtml(FALSE, "x{$tr_sjd_item_grid->RowIndex}_cek_sjd[]") ?>
</div></div>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_cek_sjd" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" value="<?php echo ew_HtmlEncode($tr_sjd_item->cek_sjd->OldValue) ?>">
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_cek_sjd" class="form-group tr_sjd_item_cek_sjd">
<div id="tp_x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd" class="ewTemplate"><input type="checkbox" data-table="tr_sjd_item" data-field="x_cek_sjd" data-value-separator="<?php echo $tr_sjd_item->cek_sjd->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" value="{value}"<?php echo $tr_sjd_item->cek_sjd->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $tr_sjd_item->cek_sjd->CheckBoxListHtml(FALSE, "x{$tr_sjd_item_grid->RowIndex}_cek_sjd[]") ?>
</div></div>
</span>
<?php } ?>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_sjd_item_grid->RowCnt ?>_tr_sjd_item_cek_sjd" class="tr_sjd_item_cek_sjd">
<span<?php echo $tr_sjd_item->cek_sjd->ViewAttributes() ?>>
<?php echo $tr_sjd_item->cek_sjd->ListViewValue() ?></span>
</span>
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_cek_sjd" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd" value="<?php echo ew_HtmlEncode($tr_sjd_item->cek_sjd->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_cek_sjd" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" value="<?php echo ew_HtmlEncode($tr_sjd_item->cek_sjd->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_cek_sjd" name="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd" id="ftr_sjd_itemgrid$x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd" value="<?php echo ew_HtmlEncode($tr_sjd_item->cek_sjd->FormValue) ?>">
<input type="hidden" data-table="tr_sjd_item" data-field="x_cek_sjd" name="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" id="ftr_sjd_itemgrid$o<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" value="<?php echo ew_HtmlEncode($tr_sjd_item->cek_sjd->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tr_sjd_item_grid->ListOptions->Render("body", "right", $tr_sjd_item_grid->RowCnt);
?>
	</tr>
<?php if ($tr_sjd_item->RowType == EW_ROWTYPE_ADD || $tr_sjd_item->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ftr_sjd_itemgrid.UpdateOpts(<?php echo $tr_sjd_item_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($tr_sjd_item->CurrentAction <> "gridadd" || $tr_sjd_item->CurrentMode == "copy")
		if (!$tr_sjd_item_grid->Recordset->EOF) $tr_sjd_item_grid->Recordset->MoveNext();
}
?>
<?php
	if ($tr_sjd_item->CurrentMode == "add" || $tr_sjd_item->CurrentMode == "copy" || $tr_sjd_item->CurrentMode == "edit") {
		$tr_sjd_item_grid->RowIndex = '$rowindex$';
		$tr_sjd_item_grid->LoadRowValues();

		// Set row properties
		$tr_sjd_item->ResetAttrs();
		$tr_sjd_item->RowAttrs = array_merge($tr_sjd_item->RowAttrs, array('data-rowindex'=>$tr_sjd_item_grid->RowIndex, 'id'=>'r0_tr_sjd_item', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($tr_sjd_item->RowAttrs["class"], "ewTemplate");
		$tr_sjd_item->RowType = EW_ROWTYPE_ADD;

		// Render row
		$tr_sjd_item_grid->RenderRow();

		// Render list options
		$tr_sjd_item_grid->RenderListOptions();
		$tr_sjd_item_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tr_sjd_item->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tr_sjd_item_grid->ListOptions->Render("body", "left", $tr_sjd_item_grid->RowIndex);
?>
	<?php if ($tr_sjd_item->item_id->Visible) { // item_id ?>
		<td data-name="item_id">
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_sjd_item_item_id" class="form-group tr_sjd_item_item_id">
<?php
$wrkonchange = trim("ew_AutoFill(this); " . @$tr_sjd_item->item_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_sjd_item->item_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" style="white-space: nowrap; z-index: <?php echo (9000 - $tr_sjd_item_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="sv_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo $tr_sjd_item->item_id->EditValue ?>" size="40" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->getPlaceHolder()) ?>"<?php echo $tr_sjd_item->item_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_id" data-value-separator="<?php echo $tr_sjd_item->item_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ftr_sjd_itemgrid.CreateAutoSuggest({"id":"x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id","forceSelect":true});
</script>
<input type="hidden" name="ln_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="ln_x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code,x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price,x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id">
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_sjd_item_item_id" class="form-group tr_sjd_item_item_id">
<span<?php echo $tr_sjd_item->item_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_sjd_item->item_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_id" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_id" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_sjd_item->item_code->Visible) { // item_code ?>
		<td data-name="item_code">
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_sjd_item_item_code" class="form-group tr_sjd_item_item_code">
<input type="text" data-table="tr_sjd_item" data-field="x_item_code" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_code->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_code->EditValue ?>"<?php echo $tr_sjd_item->item_code->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_sjd_item_item_code" class="form-group tr_sjd_item_item_code">
<span<?php echo $tr_sjd_item->item_code->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_sjd_item->item_code->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_code" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_code" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_sjd_item->unit_id->Visible) { // unit_id ?>
		<td data-name="unit_id">
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_sjd_item_unit_id" class="form-group tr_sjd_item_unit_id">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_sjd_item->unit_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_sjd_item->unit_id->ViewValue ?>
	</span>
	<?php if (!$tr_sjd_item->unit_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_sjd_item->unit_id->RadioButtonListHtml(TRUE, "x{$tr_sjd_item_grid->RowIndex}_unit_id") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" class="ewTemplate"><input type="radio" data-table="tr_sjd_item" data-field="x_unit_id" data-value-separator="<?php echo $tr_sjd_item->unit_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" value="{value}"<?php echo $tr_sjd_item->unit_id->EditAttributes() ?>></div>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_sjd_item_unit_id" class="form-group tr_sjd_item_unit_id">
<span<?php echo $tr_sjd_item->unit_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_sjd_item->unit_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_unit_id" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->unit_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_unit_id" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_sjd_item->unit_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_sjd_item->item_price->Visible) { // item_price ?>
		<td data-name="item_price">
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_sjd_item_item_price" class="form-group tr_sjd_item_item_price">
<input type="text" data-table="tr_sjd_item" data-field="x_item_price" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" size="15" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_price->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_price->EditValue ?>"<?php echo $tr_sjd_item->item_price->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_sjd_item_item_price" class="form-group tr_sjd_item_item_price">
<span<?php echo $tr_sjd_item->item_price->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_sjd_item->item_price->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_price" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_price->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_price" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_price->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_sjd_item->item_qty->Visible) { // item_qty ?>
		<td data-name="item_qty">
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_sjd_item_item_qty" class="form-group tr_sjd_item_item_qty">
<input type="text" data-table="tr_sjd_item" data-field="x_item_qty" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" size="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->item_qty->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->item_qty->EditValue ?>"<?php echo $tr_sjd_item->item_qty->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_sjd_item_item_qty" class="form-group tr_sjd_item_item_qty">
<span<?php echo $tr_sjd_item->item_qty->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_sjd_item->item_qty->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_qty" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_qty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_item_qty" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_sjd_item->item_qty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_sjd_item->qty_rcv->Visible) { // qty_rcv ?>
		<td data-name="qty_rcv">
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_sjd_item_qty_rcv" class="form-group tr_sjd_item_qty_rcv">
<input type="text" data-table="tr_sjd_item" data-field="x_qty_rcv" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" size="10" placeholder="<?php echo ew_HtmlEncode($tr_sjd_item->qty_rcv->getPlaceHolder()) ?>" value="<?php echo $tr_sjd_item->qty_rcv->EditValue ?>"<?php echo $tr_sjd_item->qty_rcv->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_sjd_item_qty_rcv" class="form-group tr_sjd_item_qty_rcv">
<span<?php echo $tr_sjd_item->qty_rcv->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_sjd_item->qty_rcv->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_qty_rcv" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" value="<?php echo ew_HtmlEncode($tr_sjd_item->qty_rcv->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_qty_rcv" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_qty_rcv" value="<?php echo ew_HtmlEncode($tr_sjd_item->qty_rcv->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_sjd_item->cek_sjd->Visible) { // cek_sjd ?>
		<td data-name="cek_sjd">
<?php if ($tr_sjd_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_sjd_item_cek_sjd" class="form-group tr_sjd_item_cek_sjd">
<div id="tp_x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd" class="ewTemplate"><input type="checkbox" data-table="tr_sjd_item" data-field="x_cek_sjd" data-value-separator="<?php echo $tr_sjd_item->cek_sjd->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" value="{value}"<?php echo $tr_sjd_item->cek_sjd->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $tr_sjd_item->cek_sjd->CheckBoxListHtml(FALSE, "x{$tr_sjd_item_grid->RowIndex}_cek_sjd[]") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_sjd_item_cek_sjd" class="form-group tr_sjd_item_cek_sjd">
<span<?php echo $tr_sjd_item->cek_sjd->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_sjd_item->cek_sjd->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_sjd_item" data-field="x_cek_sjd" name="x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd" id="x<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd" value="<?php echo ew_HtmlEncode($tr_sjd_item->cek_sjd->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_sjd_item" data-field="x_cek_sjd" name="o<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" id="o<?php echo $tr_sjd_item_grid->RowIndex ?>_cek_sjd[]" value="<?php echo ew_HtmlEncode($tr_sjd_item->cek_sjd->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tr_sjd_item_grid->ListOptions->Render("body", "right", $tr_sjd_item_grid->RowIndex);
?>
<script type="text/javascript">
ftr_sjd_itemgrid.UpdateOpts(<?php echo $tr_sjd_item_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($tr_sjd_item->CurrentMode == "add" || $tr_sjd_item->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $tr_sjd_item_grid->FormKeyCountName ?>" id="<?php echo $tr_sjd_item_grid->FormKeyCountName ?>" value="<?php echo $tr_sjd_item_grid->KeyCount ?>">
<?php echo $tr_sjd_item_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tr_sjd_item->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $tr_sjd_item_grid->FormKeyCountName ?>" id="<?php echo $tr_sjd_item_grid->FormKeyCountName ?>" value="<?php echo $tr_sjd_item_grid->KeyCount ?>">
<?php echo $tr_sjd_item_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tr_sjd_item->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftr_sjd_itemgrid">
</div>
<?php

// Close recordset
if ($tr_sjd_item_grid->Recordset)
	$tr_sjd_item_grid->Recordset->Close();
?>
</div>
</div>
<?php } ?>
<?php if ($tr_sjd_item_grid->TotalRecs == 0 && $tr_sjd_item->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($tr_sjd_item_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($tr_sjd_item->Export == "") { ?>
<script type="text/javascript">
ftr_sjd_itemgrid.Init();
</script>
<?php } ?>
<?php
$tr_sjd_item_grid->Page_Terminate();
?>
