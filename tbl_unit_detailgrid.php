<?php include_once "employeesinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($tbl_unit_detail_grid)) $tbl_unit_detail_grid = new ctbl_unit_detail_grid();

// Page init
$tbl_unit_detail_grid->Page_Init();

// Page main
$tbl_unit_detail_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_unit_detail_grid->Page_Render();
?>
<?php if ($tbl_unit_detail->Export == "") { ?>
<script type="text/javascript">

// Form object
var ftbl_unit_detailgrid = new ew_Form("ftbl_unit_detailgrid", "grid");
ftbl_unit_detailgrid.FormKeyCountName = '<?php echo $tbl_unit_detail_grid->FormKeyCountName ?>';

// Validate form
ftbl_unit_detailgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_qty_in_unit");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_unit_detail->qty_in_unit->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_unit_cost");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_unit_detail->unit_cost->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_unit_price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_unit_detail->unit_price->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftbl_unit_detailgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "unit_name", false)) return false;
	if (ew_ValueChanged(fobj, infix, "qty_in_unit", false)) return false;
	if (ew_ValueChanged(fobj, infix, "unit_cost", false)) return false;
	if (ew_ValueChanged(fobj, infix, "unit_price", false)) return false;
	if (ew_ValueChanged(fobj, infix, "product_code", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_unit_detailgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_unit_detailgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($tbl_unit_detail->CurrentAction == "gridadd") {
	if ($tbl_unit_detail->CurrentMode == "copy") {
		$bSelectLimit = $tbl_unit_detail_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$tbl_unit_detail_grid->TotalRecs = $tbl_unit_detail->ListRecordCount();
			$tbl_unit_detail_grid->Recordset = $tbl_unit_detail_grid->LoadRecordset($tbl_unit_detail_grid->StartRec-1, $tbl_unit_detail_grid->DisplayRecs);
		} else {
			if ($tbl_unit_detail_grid->Recordset = $tbl_unit_detail_grid->LoadRecordset())
				$tbl_unit_detail_grid->TotalRecs = $tbl_unit_detail_grid->Recordset->RecordCount();
		}
		$tbl_unit_detail_grid->StartRec = 1;
		$tbl_unit_detail_grid->DisplayRecs = $tbl_unit_detail_grid->TotalRecs;
	} else {
		$tbl_unit_detail->CurrentFilter = "0=1";
		$tbl_unit_detail_grid->StartRec = 1;
		$tbl_unit_detail_grid->DisplayRecs = $tbl_unit_detail->GridAddRowCount;
	}
	$tbl_unit_detail_grid->TotalRecs = $tbl_unit_detail_grid->DisplayRecs;
	$tbl_unit_detail_grid->StopRec = $tbl_unit_detail_grid->DisplayRecs;
} else {
	$bSelectLimit = $tbl_unit_detail_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($tbl_unit_detail_grid->TotalRecs <= 0)
			$tbl_unit_detail_grid->TotalRecs = $tbl_unit_detail->ListRecordCount();
	} else {
		if (!$tbl_unit_detail_grid->Recordset && ($tbl_unit_detail_grid->Recordset = $tbl_unit_detail_grid->LoadRecordset()))
			$tbl_unit_detail_grid->TotalRecs = $tbl_unit_detail_grid->Recordset->RecordCount();
	}
	$tbl_unit_detail_grid->StartRec = 1;
	$tbl_unit_detail_grid->DisplayRecs = $tbl_unit_detail_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$tbl_unit_detail_grid->Recordset = $tbl_unit_detail_grid->LoadRecordset($tbl_unit_detail_grid->StartRec-1, $tbl_unit_detail_grid->DisplayRecs);

	// Set no record found message
	if ($tbl_unit_detail->CurrentAction == "" && $tbl_unit_detail_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$tbl_unit_detail_grid->setWarningMessage(ew_DeniedMsg());
		if ($tbl_unit_detail_grid->SearchWhere == "0=101")
			$tbl_unit_detail_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$tbl_unit_detail_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$tbl_unit_detail_grid->RenderOtherOptions();
?>
<?php $tbl_unit_detail_grid->ShowPageHeader(); ?>
<?php
$tbl_unit_detail_grid->ShowMessage();
?>
<?php if ($tbl_unit_detail_grid->TotalRecs > 0 || $tbl_unit_detail->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($tbl_unit_detail_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> tbl_unit_detail">
<div id="ftbl_unit_detailgrid" class="ewForm ewListForm form-inline">
<?php if ($tbl_unit_detail_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($tbl_unit_detail_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_tbl_unit_detail" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_tbl_unit_detailgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$tbl_unit_detail_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$tbl_unit_detail_grid->RenderListOptions();

// Render list options (header, left)
$tbl_unit_detail_grid->ListOptions->Render("header", "left");
?>
<?php if ($tbl_unit_detail->unit_name->Visible) { // unit_name ?>
	<?php if ($tbl_unit_detail->SortUrl($tbl_unit_detail->unit_name) == "") { ?>
		<th data-name="unit_name" class="<?php echo $tbl_unit_detail->unit_name->HeaderCellClass() ?>"><div id="elh_tbl_unit_detail_unit_name" class="tbl_unit_detail_unit_name"><div class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->unit_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unit_name" class="<?php echo $tbl_unit_detail->unit_name->HeaderCellClass() ?>"><div><div id="elh_tbl_unit_detail_unit_name" class="tbl_unit_detail_unit_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->unit_name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tbl_unit_detail->unit_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_unit_detail->unit_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unit_detail->qty_in_unit->Visible) { // qty_in_unit ?>
	<?php if ($tbl_unit_detail->SortUrl($tbl_unit_detail->qty_in_unit) == "") { ?>
		<th data-name="qty_in_unit" class="<?php echo $tbl_unit_detail->qty_in_unit->HeaderCellClass() ?>"><div id="elh_tbl_unit_detail_qty_in_unit" class="tbl_unit_detail_qty_in_unit"><div class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->qty_in_unit->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty_in_unit" class="<?php echo $tbl_unit_detail->qty_in_unit->HeaderCellClass() ?>"><div><div id="elh_tbl_unit_detail_qty_in_unit" class="tbl_unit_detail_qty_in_unit">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->qty_in_unit->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tbl_unit_detail->qty_in_unit->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_unit_detail->qty_in_unit->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unit_detail->unit_cost->Visible) { // unit_cost ?>
	<?php if ($tbl_unit_detail->SortUrl($tbl_unit_detail->unit_cost) == "") { ?>
		<th data-name="unit_cost" class="<?php echo $tbl_unit_detail->unit_cost->HeaderCellClass() ?>"><div id="elh_tbl_unit_detail_unit_cost" class="tbl_unit_detail_unit_cost"><div class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->unit_cost->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unit_cost" class="<?php echo $tbl_unit_detail->unit_cost->HeaderCellClass() ?>"><div><div id="elh_tbl_unit_detail_unit_cost" class="tbl_unit_detail_unit_cost">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->unit_cost->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tbl_unit_detail->unit_cost->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_unit_detail->unit_cost->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unit_detail->unit_price->Visible) { // unit_price ?>
	<?php if ($tbl_unit_detail->SortUrl($tbl_unit_detail->unit_price) == "") { ?>
		<th data-name="unit_price" class="<?php echo $tbl_unit_detail->unit_price->HeaderCellClass() ?>"><div id="elh_tbl_unit_detail_unit_price" class="tbl_unit_detail_unit_price"><div class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->unit_price->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unit_price" class="<?php echo $tbl_unit_detail->unit_price->HeaderCellClass() ?>"><div><div id="elh_tbl_unit_detail_unit_price" class="tbl_unit_detail_unit_price">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->unit_price->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tbl_unit_detail->unit_price->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_unit_detail->unit_price->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unit_detail->product_code->Visible) { // product_code ?>
	<?php if ($tbl_unit_detail->SortUrl($tbl_unit_detail->product_code) == "") { ?>
		<th data-name="product_code" class="<?php echo $tbl_unit_detail->product_code->HeaderCellClass() ?>"><div id="elh_tbl_unit_detail_product_code" class="tbl_unit_detail_product_code"><div class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->product_code->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_code" class="<?php echo $tbl_unit_detail->product_code->HeaderCellClass() ?>"><div><div id="elh_tbl_unit_detail_product_code" class="tbl_unit_detail_product_code">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_unit_detail->product_code->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tbl_unit_detail->product_code->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_unit_detail->product_code->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_unit_detail_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_unit_detail_grid->StartRec = 1;
$tbl_unit_detail_grid->StopRec = $tbl_unit_detail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($tbl_unit_detail_grid->FormKeyCountName) && ($tbl_unit_detail->CurrentAction == "gridadd" || $tbl_unit_detail->CurrentAction == "gridedit" || $tbl_unit_detail->CurrentAction == "F")) {
		$tbl_unit_detail_grid->KeyCount = $objForm->GetValue($tbl_unit_detail_grid->FormKeyCountName);
		$tbl_unit_detail_grid->StopRec = $tbl_unit_detail_grid->StartRec + $tbl_unit_detail_grid->KeyCount - 1;
	}
}
$tbl_unit_detail_grid->RecCnt = $tbl_unit_detail_grid->StartRec - 1;
if ($tbl_unit_detail_grid->Recordset && !$tbl_unit_detail_grid->Recordset->EOF) {
	$tbl_unit_detail_grid->Recordset->MoveFirst();
	$bSelectLimit = $tbl_unit_detail_grid->UseSelectLimit;
	if (!$bSelectLimit && $tbl_unit_detail_grid->StartRec > 1)
		$tbl_unit_detail_grid->Recordset->Move($tbl_unit_detail_grid->StartRec - 1);
} elseif (!$tbl_unit_detail->AllowAddDeleteRow && $tbl_unit_detail_grid->StopRec == 0) {
	$tbl_unit_detail_grid->StopRec = $tbl_unit_detail->GridAddRowCount;
}

// Initialize aggregate
$tbl_unit_detail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_unit_detail->ResetAttrs();
$tbl_unit_detail_grid->RenderRow();
if ($tbl_unit_detail->CurrentAction == "gridadd")
	$tbl_unit_detail_grid->RowIndex = 0;
if ($tbl_unit_detail->CurrentAction == "gridedit")
	$tbl_unit_detail_grid->RowIndex = 0;
while ($tbl_unit_detail_grid->RecCnt < $tbl_unit_detail_grid->StopRec) {
	$tbl_unit_detail_grid->RecCnt++;
	if (intval($tbl_unit_detail_grid->RecCnt) >= intval($tbl_unit_detail_grid->StartRec)) {
		$tbl_unit_detail_grid->RowCnt++;
		if ($tbl_unit_detail->CurrentAction == "gridadd" || $tbl_unit_detail->CurrentAction == "gridedit" || $tbl_unit_detail->CurrentAction == "F") {
			$tbl_unit_detail_grid->RowIndex++;
			$objForm->Index = $tbl_unit_detail_grid->RowIndex;
			if ($objForm->HasValue($tbl_unit_detail_grid->FormActionName))
				$tbl_unit_detail_grid->RowAction = strval($objForm->GetValue($tbl_unit_detail_grid->FormActionName));
			elseif ($tbl_unit_detail->CurrentAction == "gridadd")
				$tbl_unit_detail_grid->RowAction = "insert";
			else
				$tbl_unit_detail_grid->RowAction = "";
		}

		// Set up key count
		$tbl_unit_detail_grid->KeyCount = $tbl_unit_detail_grid->RowIndex;

		// Init row class and style
		$tbl_unit_detail->ResetAttrs();
		$tbl_unit_detail->CssClass = "";
		if ($tbl_unit_detail->CurrentAction == "gridadd") {
			if ($tbl_unit_detail->CurrentMode == "copy") {
				$tbl_unit_detail_grid->LoadRowValues($tbl_unit_detail_grid->Recordset); // Load row values
				$tbl_unit_detail_grid->SetRecordKey($tbl_unit_detail_grid->RowOldKey, $tbl_unit_detail_grid->Recordset); // Set old record key
			} else {
				$tbl_unit_detail_grid->LoadRowValues(); // Load default values
				$tbl_unit_detail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_unit_detail_grid->LoadRowValues($tbl_unit_detail_grid->Recordset); // Load row values
		}
		$tbl_unit_detail->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($tbl_unit_detail->CurrentAction == "gridadd") // Grid add
			$tbl_unit_detail->RowType = EW_ROWTYPE_ADD; // Render add
		if ($tbl_unit_detail->CurrentAction == "gridadd" && $tbl_unit_detail->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$tbl_unit_detail_grid->RestoreCurrentRowFormValues($tbl_unit_detail_grid->RowIndex); // Restore form values
		if ($tbl_unit_detail->CurrentAction == "gridedit") { // Grid edit
			if ($tbl_unit_detail->EventCancelled) {
				$tbl_unit_detail_grid->RestoreCurrentRowFormValues($tbl_unit_detail_grid->RowIndex); // Restore form values
			}
			if ($tbl_unit_detail_grid->RowAction == "insert")
				$tbl_unit_detail->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$tbl_unit_detail->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_unit_detail->CurrentAction == "gridedit" && ($tbl_unit_detail->RowType == EW_ROWTYPE_EDIT || $tbl_unit_detail->RowType == EW_ROWTYPE_ADD) && $tbl_unit_detail->EventCancelled) // Update failed
			$tbl_unit_detail_grid->RestoreCurrentRowFormValues($tbl_unit_detail_grid->RowIndex); // Restore form values
		if ($tbl_unit_detail->RowType == EW_ROWTYPE_EDIT) // Edit row
			$tbl_unit_detail_grid->EditRowCnt++;
		if ($tbl_unit_detail->CurrentAction == "F") // Confirm row
			$tbl_unit_detail_grid->RestoreCurrentRowFormValues($tbl_unit_detail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_unit_detail->RowAttrs = array_merge($tbl_unit_detail->RowAttrs, array('data-rowindex'=>$tbl_unit_detail_grid->RowCnt, 'id'=>'r' . $tbl_unit_detail_grid->RowCnt . '_tbl_unit_detail', 'data-rowtype'=>$tbl_unit_detail->RowType));

		// Render row
		$tbl_unit_detail_grid->RenderRow();

		// Render list options
		$tbl_unit_detail_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_unit_detail_grid->RowAction <> "delete" && $tbl_unit_detail_grid->RowAction <> "insertdelete" && !($tbl_unit_detail_grid->RowAction == "insert" && $tbl_unit_detail->CurrentAction == "F" && $tbl_unit_detail_grid->EmptyRow())) {
?>
	<tr<?php echo $tbl_unit_detail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_unit_detail_grid->ListOptions->Render("body", "left", $tbl_unit_detail_grid->RowCnt);
?>
	<?php if ($tbl_unit_detail->unit_name->Visible) { // unit_name ?>
		<td data-name="unit_name"<?php echo $tbl_unit_detail->unit_name->CellAttributes() ?>>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_unit_name" class="form-group tbl_unit_detail_unit_name">
<input type="text" data-table="tbl_unit_detail" data-field="x_unit_name" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_name->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->unit_name->EditValue ?>"<?php echo $tbl_unit_detail->unit_name->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_name" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_name->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_unit_name" class="form-group tbl_unit_detail_unit_name">
<input type="text" data-table="tbl_unit_detail" data-field="x_unit_name" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_name->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->unit_name->EditValue ?>"<?php echo $tbl_unit_detail->unit_name->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_unit_name" class="tbl_unit_detail_unit_name">
<span<?php echo $tbl_unit_detail->unit_name->ViewAttributes() ?>>
<?php echo $tbl_unit_detail->unit_name->ListViewValue() ?></span>
</span>
<?php if ($tbl_unit_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_name" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_name->FormValue) ?>">
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_name" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_name" name="ftbl_unit_detailgrid$x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" id="ftbl_unit_detailgrid$x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_name->FormValue) ?>">
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_name" name="ftbl_unit_detailgrid$o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" id="ftbl_unit_detailgrid$o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_udet_id" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_udet_id" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_udet_id" value="<?php echo ew_HtmlEncode($tbl_unit_detail->udet_id->CurrentValue) ?>">
<input type="hidden" data-table="tbl_unit_detail" data-field="x_udet_id" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_udet_id" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_udet_id" value="<?php echo ew_HtmlEncode($tbl_unit_detail->udet_id->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_EDIT || $tbl_unit_detail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_udet_id" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_udet_id" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_udet_id" value="<?php echo ew_HtmlEncode($tbl_unit_detail->udet_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_unit_detail->qty_in_unit->Visible) { // qty_in_unit ?>
		<td data-name="qty_in_unit"<?php echo $tbl_unit_detail->qty_in_unit->CellAttributes() ?>>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_qty_in_unit" class="form-group tbl_unit_detail_qty_in_unit">
<input type="text" data-table="tbl_unit_detail" data-field="x_qty_in_unit" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->qty_in_unit->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->qty_in_unit->EditValue ?>"<?php echo $tbl_unit_detail->qty_in_unit->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_qty_in_unit" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" value="<?php echo ew_HtmlEncode($tbl_unit_detail->qty_in_unit->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_qty_in_unit" class="form-group tbl_unit_detail_qty_in_unit">
<input type="text" data-table="tbl_unit_detail" data-field="x_qty_in_unit" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->qty_in_unit->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->qty_in_unit->EditValue ?>"<?php echo $tbl_unit_detail->qty_in_unit->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_qty_in_unit" class="tbl_unit_detail_qty_in_unit">
<span<?php echo $tbl_unit_detail->qty_in_unit->ViewAttributes() ?>>
<?php echo $tbl_unit_detail->qty_in_unit->ListViewValue() ?></span>
</span>
<?php if ($tbl_unit_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_qty_in_unit" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" value="<?php echo ew_HtmlEncode($tbl_unit_detail->qty_in_unit->FormValue) ?>">
<input type="hidden" data-table="tbl_unit_detail" data-field="x_qty_in_unit" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" value="<?php echo ew_HtmlEncode($tbl_unit_detail->qty_in_unit->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_qty_in_unit" name="ftbl_unit_detailgrid$x<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" id="ftbl_unit_detailgrid$x<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" value="<?php echo ew_HtmlEncode($tbl_unit_detail->qty_in_unit->FormValue) ?>">
<input type="hidden" data-table="tbl_unit_detail" data-field="x_qty_in_unit" name="ftbl_unit_detailgrid$o<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" id="ftbl_unit_detailgrid$o<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" value="<?php echo ew_HtmlEncode($tbl_unit_detail->qty_in_unit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_unit_detail->unit_cost->Visible) { // unit_cost ?>
		<td data-name="unit_cost"<?php echo $tbl_unit_detail->unit_cost->CellAttributes() ?>>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_unit_cost" class="form-group tbl_unit_detail_unit_cost">
<input type="text" data-table="tbl_unit_detail" data-field="x_unit_cost" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_cost->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->unit_cost->EditValue ?>"<?php echo $tbl_unit_detail->unit_cost->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_cost" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_cost->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_unit_cost" class="form-group tbl_unit_detail_unit_cost">
<input type="text" data-table="tbl_unit_detail" data-field="x_unit_cost" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_cost->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->unit_cost->EditValue ?>"<?php echo $tbl_unit_detail->unit_cost->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_unit_cost" class="tbl_unit_detail_unit_cost">
<span<?php echo $tbl_unit_detail->unit_cost->ViewAttributes() ?>>
<?php echo $tbl_unit_detail->unit_cost->ListViewValue() ?></span>
</span>
<?php if ($tbl_unit_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_cost" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_cost->FormValue) ?>">
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_cost" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_cost->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_cost" name="ftbl_unit_detailgrid$x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" id="ftbl_unit_detailgrid$x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_cost->FormValue) ?>">
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_cost" name="ftbl_unit_detailgrid$o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" id="ftbl_unit_detailgrid$o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_cost->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_unit_detail->unit_price->Visible) { // unit_price ?>
		<td data-name="unit_price"<?php echo $tbl_unit_detail->unit_price->CellAttributes() ?>>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_unit_price" class="form-group tbl_unit_detail_unit_price">
<input type="text" data-table="tbl_unit_detail" data-field="x_unit_price" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_price->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->unit_price->EditValue ?>"<?php echo $tbl_unit_detail->unit_price->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_price" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_price->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_unit_price" class="form-group tbl_unit_detail_unit_price">
<input type="text" data-table="tbl_unit_detail" data-field="x_unit_price" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_price->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->unit_price->EditValue ?>"<?php echo $tbl_unit_detail->unit_price->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_unit_price" class="tbl_unit_detail_unit_price">
<span<?php echo $tbl_unit_detail->unit_price->ViewAttributes() ?>>
<?php echo $tbl_unit_detail->unit_price->ListViewValue() ?></span>
</span>
<?php if ($tbl_unit_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_price" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_price->FormValue) ?>">
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_price" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_price->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_price" name="ftbl_unit_detailgrid$x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" id="ftbl_unit_detailgrid$x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_price->FormValue) ?>">
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_price" name="ftbl_unit_detailgrid$o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" id="ftbl_unit_detailgrid$o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_price->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_unit_detail->product_code->Visible) { // product_code ?>
		<td data-name="product_code"<?php echo $tbl_unit_detail->product_code->CellAttributes() ?>>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_product_code" class="form-group tbl_unit_detail_product_code">
<input type="text" data-table="tbl_unit_detail" data-field="x_product_code" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->product_code->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->product_code->EditValue ?>"<?php echo $tbl_unit_detail->product_code->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_product_code" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" value="<?php echo ew_HtmlEncode($tbl_unit_detail->product_code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_product_code" class="form-group tbl_unit_detail_product_code">
<input type="text" data-table="tbl_unit_detail" data-field="x_product_code" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->product_code->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->product_code->EditValue ?>"<?php echo $tbl_unit_detail->product_code->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unit_detail_grid->RowCnt ?>_tbl_unit_detail_product_code" class="tbl_unit_detail_product_code">
<span<?php echo $tbl_unit_detail->product_code->ViewAttributes() ?>>
<?php echo $tbl_unit_detail->product_code->ListViewValue() ?></span>
</span>
<?php if ($tbl_unit_detail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_product_code" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" value="<?php echo ew_HtmlEncode($tbl_unit_detail->product_code->FormValue) ?>">
<input type="hidden" data-table="tbl_unit_detail" data-field="x_product_code" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" value="<?php echo ew_HtmlEncode($tbl_unit_detail->product_code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_product_code" name="ftbl_unit_detailgrid$x<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" id="ftbl_unit_detailgrid$x<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" value="<?php echo ew_HtmlEncode($tbl_unit_detail->product_code->FormValue) ?>">
<input type="hidden" data-table="tbl_unit_detail" data-field="x_product_code" name="ftbl_unit_detailgrid$o<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" id="ftbl_unit_detailgrid$o<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" value="<?php echo ew_HtmlEncode($tbl_unit_detail->product_code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_unit_detail_grid->ListOptions->Render("body", "right", $tbl_unit_detail_grid->RowCnt);
?>
	</tr>
<?php if ($tbl_unit_detail->RowType == EW_ROWTYPE_ADD || $tbl_unit_detail->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ftbl_unit_detailgrid.UpdateOpts(<?php echo $tbl_unit_detail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($tbl_unit_detail->CurrentAction <> "gridadd" || $tbl_unit_detail->CurrentMode == "copy")
		if (!$tbl_unit_detail_grid->Recordset->EOF) $tbl_unit_detail_grid->Recordset->MoveNext();
}
?>
<?php
	if ($tbl_unit_detail->CurrentMode == "add" || $tbl_unit_detail->CurrentMode == "copy" || $tbl_unit_detail->CurrentMode == "edit") {
		$tbl_unit_detail_grid->RowIndex = '$rowindex$';
		$tbl_unit_detail_grid->LoadRowValues();

		// Set row properties
		$tbl_unit_detail->ResetAttrs();
		$tbl_unit_detail->RowAttrs = array_merge($tbl_unit_detail->RowAttrs, array('data-rowindex'=>$tbl_unit_detail_grid->RowIndex, 'id'=>'r0_tbl_unit_detail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($tbl_unit_detail->RowAttrs["class"], "ewTemplate");
		$tbl_unit_detail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$tbl_unit_detail_grid->RenderRow();

		// Render list options
		$tbl_unit_detail_grid->RenderListOptions();
		$tbl_unit_detail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_unit_detail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_unit_detail_grid->ListOptions->Render("body", "left", $tbl_unit_detail_grid->RowIndex);
?>
	<?php if ($tbl_unit_detail->unit_name->Visible) { // unit_name ?>
		<td data-name="unit_name">
<?php if ($tbl_unit_detail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tbl_unit_detail_unit_name" class="form-group tbl_unit_detail_unit_name">
<input type="text" data-table="tbl_unit_detail" data-field="x_unit_name" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_name->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->unit_name->EditValue ?>"<?php echo $tbl_unit_detail->unit_name->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_unit_detail_unit_name" class="form-group tbl_unit_detail_unit_name">
<span<?php echo $tbl_unit_detail->unit_name->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tbl_unit_detail->unit_name->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_name" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_name" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_name" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_unit_detail->qty_in_unit->Visible) { // qty_in_unit ?>
		<td data-name="qty_in_unit">
<?php if ($tbl_unit_detail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tbl_unit_detail_qty_in_unit" class="form-group tbl_unit_detail_qty_in_unit">
<input type="text" data-table="tbl_unit_detail" data-field="x_qty_in_unit" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->qty_in_unit->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->qty_in_unit->EditValue ?>"<?php echo $tbl_unit_detail->qty_in_unit->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_unit_detail_qty_in_unit" class="form-group tbl_unit_detail_qty_in_unit">
<span<?php echo $tbl_unit_detail->qty_in_unit->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tbl_unit_detail->qty_in_unit->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_qty_in_unit" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" value="<?php echo ew_HtmlEncode($tbl_unit_detail->qty_in_unit->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_qty_in_unit" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_qty_in_unit" value="<?php echo ew_HtmlEncode($tbl_unit_detail->qty_in_unit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_unit_detail->unit_cost->Visible) { // unit_cost ?>
		<td data-name="unit_cost">
<?php if ($tbl_unit_detail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tbl_unit_detail_unit_cost" class="form-group tbl_unit_detail_unit_cost">
<input type="text" data-table="tbl_unit_detail" data-field="x_unit_cost" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_cost->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->unit_cost->EditValue ?>"<?php echo $tbl_unit_detail->unit_cost->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_unit_detail_unit_cost" class="form-group tbl_unit_detail_unit_cost">
<span<?php echo $tbl_unit_detail->unit_cost->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tbl_unit_detail->unit_cost->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_cost" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_cost->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_cost" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_cost" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_cost->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_unit_detail->unit_price->Visible) { // unit_price ?>
		<td data-name="unit_price">
<?php if ($tbl_unit_detail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tbl_unit_detail_unit_price" class="form-group tbl_unit_detail_unit_price">
<input type="text" data-table="tbl_unit_detail" data-field="x_unit_price" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_price->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->unit_price->EditValue ?>"<?php echo $tbl_unit_detail->unit_price->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_unit_detail_unit_price" class="form-group tbl_unit_detail_unit_price">
<span<?php echo $tbl_unit_detail->unit_price->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tbl_unit_detail->unit_price->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_price" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_price->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_unit_price" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_unit_price" value="<?php echo ew_HtmlEncode($tbl_unit_detail->unit_price->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_unit_detail->product_code->Visible) { // product_code ?>
		<td data-name="product_code">
<?php if ($tbl_unit_detail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tbl_unit_detail_product_code" class="form-group tbl_unit_detail_product_code">
<input type="text" data-table="tbl_unit_detail" data-field="x_product_code" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tbl_unit_detail->product_code->getPlaceHolder()) ?>" value="<?php echo $tbl_unit_detail->product_code->EditValue ?>"<?php echo $tbl_unit_detail->product_code->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_unit_detail_product_code" class="form-group tbl_unit_detail_product_code">
<span<?php echo $tbl_unit_detail->product_code->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tbl_unit_detail->product_code->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_product_code" name="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" id="x<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" value="<?php echo ew_HtmlEncode($tbl_unit_detail->product_code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unit_detail" data-field="x_product_code" name="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" id="o<?php echo $tbl_unit_detail_grid->RowIndex ?>_product_code" value="<?php echo ew_HtmlEncode($tbl_unit_detail->product_code->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_unit_detail_grid->ListOptions->Render("body", "right", $tbl_unit_detail_grid->RowIndex);
?>
<script type="text/javascript">
ftbl_unit_detailgrid.UpdateOpts(<?php echo $tbl_unit_detail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($tbl_unit_detail->CurrentMode == "add" || $tbl_unit_detail->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $tbl_unit_detail_grid->FormKeyCountName ?>" id="<?php echo $tbl_unit_detail_grid->FormKeyCountName ?>" value="<?php echo $tbl_unit_detail_grid->KeyCount ?>">
<?php echo $tbl_unit_detail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_unit_detail->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $tbl_unit_detail_grid->FormKeyCountName ?>" id="<?php echo $tbl_unit_detail_grid->FormKeyCountName ?>" value="<?php echo $tbl_unit_detail_grid->KeyCount ?>">
<?php echo $tbl_unit_detail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_unit_detail->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_unit_detailgrid">
</div>
<?php

// Close recordset
if ($tbl_unit_detail_grid->Recordset)
	$tbl_unit_detail_grid->Recordset->Close();
?>
</div>
</div>
<?php } ?>
<?php if ($tbl_unit_detail_grid->TotalRecs == 0 && $tbl_unit_detail->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($tbl_unit_detail_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($tbl_unit_detail->Export == "") { ?>
<script type="text/javascript">
ftbl_unit_detailgrid.Init();
</script>
<?php } ?>
<?php
$tbl_unit_detail_grid->Page_Terminate();
?>
