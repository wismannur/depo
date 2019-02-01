<?php include_once "employeesinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($tr_inv_item_grid)) $tr_inv_item_grid = new ctr_inv_item_grid();

// Page init
$tr_inv_item_grid->Page_Init();

// Page main
$tr_inv_item_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_inv_item_grid->Page_Render();
?>
<?php if ($tr_inv_item->Export == "") { ?>
<script type="text/javascript">

// Form object
var ftr_inv_itemgrid = new ew_Form("ftr_inv_itemgrid", "grid");
ftr_inv_itemgrid.FormKeyCountName = '<?php echo $tr_inv_item_grid->FormKeyCountName ?>';

// Validate form
ftr_inv_itemgrid.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_item->item_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_item_qty");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_item->item_qty->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_item_price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_item->item_price->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_item_disc");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_item->item_disc->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_item_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_inv_item->item_amt->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftr_inv_itemgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "item_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_code", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_name", false)) return false;
	if (ew_ValueChanged(fobj, infix, "udet_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_qty", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_price", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_disc", false)) return false;
	if (ew_ValueChanged(fobj, infix, "item_amt", false)) return false;
	if (ew_ValueChanged(fobj, infix, "unit_id", false)) return false;
	return true;
}

// Form_CustomValidate event
ftr_inv_itemgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_inv_itemgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_inv_itemgrid.Lists["x_item_id"] = {"LinkField":"x_product_id","Ajax":true,"AutoFill":true,"DisplayFields":["x_product_name","","",""],"ParentFields":[],"ChildFields":["x_udet_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"view_products_unit_price"};
ftr_inv_itemgrid.Lists["x_item_id"].Data = "<?php echo $tr_inv_item_grid->item_id->LookupFilterQuery(FALSE, "grid") ?>";
ftr_inv_itemgrid.AutoSuggests["x_item_id"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $tr_inv_item_grid->item_id->LookupFilterQuery(TRUE, "grid"))) ?>;
ftr_inv_itemgrid.Lists["x_udet_id"] = {"LinkField":"x_udet_id","Ajax":true,"AutoFill":true,"DisplayFields":["x_unit_name","","",""],"ParentFields":["x_item_id"],"ChildFields":[],"FilterFields":["x_product_id"],"Options":[],"Template":"","LinkTable":"tbl_unit_detail"};
ftr_inv_itemgrid.Lists["x_udet_id"].Data = "<?php echo $tr_inv_item_grid->udet_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($tr_inv_item->CurrentAction == "gridadd") {
	if ($tr_inv_item->CurrentMode == "copy") {
		$bSelectLimit = $tr_inv_item_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$tr_inv_item_grid->TotalRecs = $tr_inv_item->ListRecordCount();
			$tr_inv_item_grid->Recordset = $tr_inv_item_grid->LoadRecordset($tr_inv_item_grid->StartRec-1, $tr_inv_item_grid->DisplayRecs);
		} else {
			if ($tr_inv_item_grid->Recordset = $tr_inv_item_grid->LoadRecordset())
				$tr_inv_item_grid->TotalRecs = $tr_inv_item_grid->Recordset->RecordCount();
		}
		$tr_inv_item_grid->StartRec = 1;
		$tr_inv_item_grid->DisplayRecs = $tr_inv_item_grid->TotalRecs;
	} else {
		$tr_inv_item->CurrentFilter = "0=1";
		$tr_inv_item_grid->StartRec = 1;
		$tr_inv_item_grid->DisplayRecs = $tr_inv_item->GridAddRowCount;
	}
	$tr_inv_item_grid->TotalRecs = $tr_inv_item_grid->DisplayRecs;
	$tr_inv_item_grid->StopRec = $tr_inv_item_grid->DisplayRecs;
} else {
	$bSelectLimit = $tr_inv_item_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($tr_inv_item_grid->TotalRecs <= 0)
			$tr_inv_item_grid->TotalRecs = $tr_inv_item->ListRecordCount();
	} else {
		if (!$tr_inv_item_grid->Recordset && ($tr_inv_item_grid->Recordset = $tr_inv_item_grid->LoadRecordset()))
			$tr_inv_item_grid->TotalRecs = $tr_inv_item_grid->Recordset->RecordCount();
	}
	$tr_inv_item_grid->StartRec = 1;
	$tr_inv_item_grid->DisplayRecs = $tr_inv_item_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$tr_inv_item_grid->Recordset = $tr_inv_item_grid->LoadRecordset($tr_inv_item_grid->StartRec-1, $tr_inv_item_grid->DisplayRecs);

	// Set no record found message
	if ($tr_inv_item->CurrentAction == "" && $tr_inv_item_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$tr_inv_item_grid->setWarningMessage(ew_DeniedMsg());
		if ($tr_inv_item_grid->SearchWhere == "0=101")
			$tr_inv_item_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$tr_inv_item_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$tr_inv_item_grid->RenderOtherOptions();
?>
<?php $tr_inv_item_grid->ShowPageHeader(); ?>
<?php
$tr_inv_item_grid->ShowMessage();
?>
<?php if ($tr_inv_item_grid->TotalRecs > 0 || $tr_inv_item->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($tr_inv_item_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> tr_inv_item">
<div id="ftr_inv_itemgrid" class="ewForm ewListForm form-inline">
<?php if ($tr_inv_item_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($tr_inv_item_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_tr_inv_item" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_tr_inv_itemgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$tr_inv_item_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$tr_inv_item_grid->RenderListOptions();

// Render list options (header, left)
$tr_inv_item_grid->ListOptions->Render("header", "left");
?>
<?php if ($tr_inv_item->item_id->Visible) { // item_id ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_id) == "") { ?>
		<th data-name="item_id" class="<?php echo $tr_inv_item->item_id->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_id" class="tr_inv_item_item_id"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_id" class="<?php echo $tr_inv_item->item_id->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_id" class="tr_inv_item_item_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->item_code->Visible) { // item_code ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_code) == "") { ?>
		<th data-name="item_code" class="<?php echo $tr_inv_item->item_code->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_code" class="tr_inv_item_item_code"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_code->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_code" class="<?php echo $tr_inv_item->item_code->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_code" class="tr_inv_item_item_code">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_code->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_code->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_code->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->item_name->Visible) { // item_name ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_name) == "") { ?>
		<th data-name="item_name" class="<?php echo $tr_inv_item->item_name->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_name" class="tr_inv_item_item_name"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_name" class="<?php echo $tr_inv_item->item_name->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_name" class="tr_inv_item_item_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->udet_id->Visible) { // udet_id ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->udet_id) == "") { ?>
		<th data-name="udet_id" class="<?php echo $tr_inv_item->udet_id->HeaderCellClass() ?>"><div id="elh_tr_inv_item_udet_id" class="tr_inv_item_udet_id"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->udet_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="udet_id" class="<?php echo $tr_inv_item->udet_id->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_udet_id" class="tr_inv_item_udet_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->udet_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->udet_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->udet_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->item_qty->Visible) { // item_qty ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_qty) == "") { ?>
		<th data-name="item_qty" class="<?php echo $tr_inv_item->item_qty->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_qty" class="tr_inv_item_item_qty"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_qty->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_qty" class="<?php echo $tr_inv_item->item_qty->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_qty" class="tr_inv_item_item_qty">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_qty->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_qty->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_qty->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->item_price->Visible) { // item_price ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_price) == "") { ?>
		<th data-name="item_price" class="<?php echo $tr_inv_item->item_price->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_price" class="tr_inv_item_item_price"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_price->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_price" class="<?php echo $tr_inv_item->item_price->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_price" class="tr_inv_item_item_price">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_price->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_price->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_price->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->item_disc->Visible) { // item_disc ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_disc) == "") { ?>
		<th data-name="item_disc" class="<?php echo $tr_inv_item->item_disc->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_disc" class="tr_inv_item_item_disc"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_disc->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_disc" class="<?php echo $tr_inv_item->item_disc->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_disc" class="tr_inv_item_item_disc">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_disc->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_disc->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_disc->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->item_amt->Visible) { // item_amt ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->item_amt) == "") { ?>
		<th data-name="item_amt" class="<?php echo $tr_inv_item->item_amt->HeaderCellClass() ?>"><div id="elh_tr_inv_item_item_amt" class="tr_inv_item_item_amt"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_amt->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_amt" class="<?php echo $tr_inv_item->item_amt->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_item_amt" class="tr_inv_item_item_amt">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->item_amt->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->item_amt->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->item_amt->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_inv_item->unit_id->Visible) { // unit_id ?>
	<?php if ($tr_inv_item->SortUrl($tr_inv_item->unit_id) == "") { ?>
		<th data-name="unit_id" class="<?php echo $tr_inv_item->unit_id->HeaderCellClass() ?>"><div id="elh_tr_inv_item_unit_id" class="tr_inv_item_unit_id"><div class="ewTableHeaderCaption"><?php echo $tr_inv_item->unit_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unit_id" class="<?php echo $tr_inv_item->unit_id->HeaderCellClass() ?>"><div><div id="elh_tr_inv_item_unit_id" class="tr_inv_item_unit_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_inv_item->unit_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_inv_item->unit_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_inv_item->unit_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tr_inv_item_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tr_inv_item_grid->StartRec = 1;
$tr_inv_item_grid->StopRec = $tr_inv_item_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($tr_inv_item_grid->FormKeyCountName) && ($tr_inv_item->CurrentAction == "gridadd" || $tr_inv_item->CurrentAction == "gridedit" || $tr_inv_item->CurrentAction == "F")) {
		$tr_inv_item_grid->KeyCount = $objForm->GetValue($tr_inv_item_grid->FormKeyCountName);
		$tr_inv_item_grid->StopRec = $tr_inv_item_grid->StartRec + $tr_inv_item_grid->KeyCount - 1;
	}
}
$tr_inv_item_grid->RecCnt = $tr_inv_item_grid->StartRec - 1;
if ($tr_inv_item_grid->Recordset && !$tr_inv_item_grid->Recordset->EOF) {
	$tr_inv_item_grid->Recordset->MoveFirst();
	$bSelectLimit = $tr_inv_item_grid->UseSelectLimit;
	if (!$bSelectLimit && $tr_inv_item_grid->StartRec > 1)
		$tr_inv_item_grid->Recordset->Move($tr_inv_item_grid->StartRec - 1);
} elseif (!$tr_inv_item->AllowAddDeleteRow && $tr_inv_item_grid->StopRec == 0) {
	$tr_inv_item_grid->StopRec = $tr_inv_item->GridAddRowCount;
}

// Initialize aggregate
$tr_inv_item->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tr_inv_item->ResetAttrs();
$tr_inv_item_grid->RenderRow();
if ($tr_inv_item->CurrentAction == "gridadd")
	$tr_inv_item_grid->RowIndex = 0;
if ($tr_inv_item->CurrentAction == "gridedit")
	$tr_inv_item_grid->RowIndex = 0;
while ($tr_inv_item_grid->RecCnt < $tr_inv_item_grid->StopRec) {
	$tr_inv_item_grid->RecCnt++;
	if (intval($tr_inv_item_grid->RecCnt) >= intval($tr_inv_item_grid->StartRec)) {
		$tr_inv_item_grid->RowCnt++;
		if ($tr_inv_item->CurrentAction == "gridadd" || $tr_inv_item->CurrentAction == "gridedit" || $tr_inv_item->CurrentAction == "F") {
			$tr_inv_item_grid->RowIndex++;
			$objForm->Index = $tr_inv_item_grid->RowIndex;
			if ($objForm->HasValue($tr_inv_item_grid->FormActionName))
				$tr_inv_item_grid->RowAction = strval($objForm->GetValue($tr_inv_item_grid->FormActionName));
			elseif ($tr_inv_item->CurrentAction == "gridadd")
				$tr_inv_item_grid->RowAction = "insert";
			else
				$tr_inv_item_grid->RowAction = "";
		}

		// Set up key count
		$tr_inv_item_grid->KeyCount = $tr_inv_item_grid->RowIndex;

		// Init row class and style
		$tr_inv_item->ResetAttrs();
		$tr_inv_item->CssClass = "";
		if ($tr_inv_item->CurrentAction == "gridadd") {
			if ($tr_inv_item->CurrentMode == "copy") {
				$tr_inv_item_grid->LoadRowValues($tr_inv_item_grid->Recordset); // Load row values
				$tr_inv_item_grid->SetRecordKey($tr_inv_item_grid->RowOldKey, $tr_inv_item_grid->Recordset); // Set old record key
			} else {
				$tr_inv_item_grid->LoadRowValues(); // Load default values
				$tr_inv_item_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tr_inv_item_grid->LoadRowValues($tr_inv_item_grid->Recordset); // Load row values
		}
		$tr_inv_item->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($tr_inv_item->CurrentAction == "gridadd") // Grid add
			$tr_inv_item->RowType = EW_ROWTYPE_ADD; // Render add
		if ($tr_inv_item->CurrentAction == "gridadd" && $tr_inv_item->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$tr_inv_item_grid->RestoreCurrentRowFormValues($tr_inv_item_grid->RowIndex); // Restore form values
		if ($tr_inv_item->CurrentAction == "gridedit") { // Grid edit
			if ($tr_inv_item->EventCancelled) {
				$tr_inv_item_grid->RestoreCurrentRowFormValues($tr_inv_item_grid->RowIndex); // Restore form values
			}
			if ($tr_inv_item_grid->RowAction == "insert")
				$tr_inv_item->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$tr_inv_item->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($tr_inv_item->CurrentAction == "gridedit" && ($tr_inv_item->RowType == EW_ROWTYPE_EDIT || $tr_inv_item->RowType == EW_ROWTYPE_ADD) && $tr_inv_item->EventCancelled) // Update failed
			$tr_inv_item_grid->RestoreCurrentRowFormValues($tr_inv_item_grid->RowIndex); // Restore form values
		if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) // Edit row
			$tr_inv_item_grid->EditRowCnt++;
		if ($tr_inv_item->CurrentAction == "F") // Confirm row
			$tr_inv_item_grid->RestoreCurrentRowFormValues($tr_inv_item_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tr_inv_item->RowAttrs = array_merge($tr_inv_item->RowAttrs, array('data-rowindex'=>$tr_inv_item_grid->RowCnt, 'id'=>'r' . $tr_inv_item_grid->RowCnt . '_tr_inv_item', 'data-rowtype'=>$tr_inv_item->RowType));

		// Render row
		$tr_inv_item_grid->RenderRow();

		// Render list options
		$tr_inv_item_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tr_inv_item_grid->RowAction <> "delete" && $tr_inv_item_grid->RowAction <> "insertdelete" && !($tr_inv_item_grid->RowAction == "insert" && $tr_inv_item->CurrentAction == "F" && $tr_inv_item_grid->EmptyRow())) {
?>
	<tr<?php echo $tr_inv_item->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tr_inv_item_grid->ListOptions->Render("body", "left", $tr_inv_item_grid->RowCnt);
?>
	<?php if ($tr_inv_item->item_id->Visible) { // item_id ?>
		<td data-name="item_id"<?php echo $tr_inv_item->item_id->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_id" class="form-group tr_inv_item_item_id">
<?php
$wrkonchange = trim("ew_UpdateOpt.call(this); " . @$tr_inv_item->item_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_inv_item->item_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" style="white-space: nowrap; z-index: <?php echo (9000 - $tr_inv_item_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="sv_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo $tr_inv_item->item_id->EditValue ?>" size="40" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_id->getPlaceHolder()) ?>"<?php echo $tr_inv_item->item_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" data-value-separator="<?php echo $tr_inv_item->item_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ftr_inv_itemgrid.CreateAutoSuggest({"id":"x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id","forceSelect":true});
</script>
<input type="hidden" name="ln_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="ln_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code,x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name,x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id,x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price,x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id">
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_id" class="form-group tr_inv_item_item_id">
<?php
$wrkonchange = trim("ew_UpdateOpt.call(this); " . @$tr_inv_item->item_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_inv_item->item_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" style="white-space: nowrap; z-index: <?php echo (9000 - $tr_inv_item_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="sv_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo $tr_inv_item->item_id->EditValue ?>" size="40" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_id->getPlaceHolder()) ?>"<?php echo $tr_inv_item->item_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" data-value-separator="<?php echo $tr_inv_item->item_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ftr_inv_itemgrid.CreateAutoSuggest({"id":"x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id","forceSelect":true});
</script>
<input type="hidden" name="ln_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="ln_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code,x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name,x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id,x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price,x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id">
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_id" class="tr_inv_item_item_id">
<span<?php echo $tr_inv_item->item_id->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_id->ListViewValue() ?></span>
</span>
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" name="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" name="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_row_id" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_row_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($tr_inv_item->row_id->CurrentValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_row_id" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_row_id" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($tr_inv_item->row_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT || $tr_inv_item->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_row_id" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_row_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($tr_inv_item->row_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($tr_inv_item->item_code->Visible) { // item_code ?>
		<td data-name="item_code"<?php echo $tr_inv_item->item_code->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_code" class="form-group tr_inv_item_item_code">
<input type="text" data-table="tr_inv_item" data-field="x_item_code" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_code->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_code->EditValue ?>"<?php echo $tr_inv_item->item_code->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_code" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_inv_item->item_code->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_code" class="form-group tr_inv_item_item_code">
<input type="text" data-table="tr_inv_item" data-field="x_item_code" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_code->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_code->EditValue ?>"<?php echo $tr_inv_item->item_code->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_code" class="tr_inv_item_item_code">
<span<?php echo $tr_inv_item->item_code->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_code->ListViewValue() ?></span>
</span>
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_code" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_inv_item->item_code->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_code" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_inv_item->item_code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_code" name="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" id="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_inv_item->item_code->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_code" name="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" id="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_inv_item->item_code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_name->Visible) { // item_name ?>
		<td data-name="item_name"<?php echo $tr_inv_item->item_name->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_name" class="form-group tr_inv_item_item_name">
<input type="text" data-table="tr_inv_item" data-field="x_item_name" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_name->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_name->EditValue ?>"<?php echo $tr_inv_item->item_name->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_name" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" value="<?php echo ew_HtmlEncode($tr_inv_item->item_name->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_name" class="form-group tr_inv_item_item_name">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_name" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" value="<?php echo ew_HtmlEncode($tr_inv_item->item_name->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_name" class="tr_inv_item_item_name">
<span<?php echo $tr_inv_item->item_name->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_name->ListViewValue() ?></span>
</span>
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_name" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" value="<?php echo ew_HtmlEncode($tr_inv_item->item_name->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_name" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" value="<?php echo ew_HtmlEncode($tr_inv_item->item_name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_name" name="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" id="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" value="<?php echo ew_HtmlEncode($tr_inv_item->item_name->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_name" name="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" id="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" value="<?php echo ew_HtmlEncode($tr_inv_item->item_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->udet_id->Visible) { // udet_id ?>
		<td data-name="udet_id"<?php echo $tr_inv_item->udet_id->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_udet_id" class="form-group tr_inv_item_udet_id">
<?php $tr_inv_item->udet_id->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_inv_item->udet_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_inv_item->udet_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_inv_item->udet_id->ViewValue ?>
	</span>
	<?php if (!$tr_inv_item->udet_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_inv_item->udet_id->RadioButtonListHtml(TRUE, "x{$tr_inv_item_grid->RowIndex}_udet_id") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" class="ewTemplate"><input type="radio" data-table="tr_inv_item" data-field="x_udet_id" data-value-separator="<?php echo $tr_inv_item->udet_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="{value}"<?php echo $tr_inv_item->udet_id->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="ln_x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id,x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price">
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_udet_id" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="<?php echo ew_HtmlEncode($tr_inv_item->udet_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_udet_id" class="form-group tr_inv_item_udet_id">
<?php $tr_inv_item->udet_id->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_inv_item->udet_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_inv_item->udet_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_inv_item->udet_id->ViewValue ?>
	</span>
	<?php if (!$tr_inv_item->udet_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_inv_item->udet_id->RadioButtonListHtml(TRUE, "x{$tr_inv_item_grid->RowIndex}_udet_id") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" class="ewTemplate"><input type="radio" data-table="tr_inv_item" data-field="x_udet_id" data-value-separator="<?php echo $tr_inv_item->udet_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="{value}"<?php echo $tr_inv_item->udet_id->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="ln_x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id,x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price">
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_udet_id" class="tr_inv_item_udet_id">
<span<?php echo $tr_inv_item->udet_id->ViewAttributes() ?>>
<?php echo $tr_inv_item->udet_id->ListViewValue() ?></span>
</span>
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_udet_id" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="<?php echo ew_HtmlEncode($tr_inv_item->udet_id->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_udet_id" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="<?php echo ew_HtmlEncode($tr_inv_item->udet_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_udet_id" name="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="<?php echo ew_HtmlEncode($tr_inv_item->udet_id->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_udet_id" name="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="<?php echo ew_HtmlEncode($tr_inv_item->udet_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_qty->Visible) { // item_qty ?>
		<td data-name="item_qty"<?php echo $tr_inv_item->item_qty->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_qty" class="form-group tr_inv_item_item_qty">
<input type="text" data-table="tr_inv_item" data-field="x_item_qty" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_qty->EditValue ?>"<?php echo $tr_inv_item->item_qty->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_qty" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_qty" class="form-group tr_inv_item_item_qty">
<input type="text" data-table="tr_inv_item" data-field="x_item_qty" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_qty->EditValue ?>"<?php echo $tr_inv_item->item_qty->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_qty" class="tr_inv_item_item_qty">
<span<?php echo $tr_inv_item->item_qty->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_qty->ListViewValue() ?></span>
</span>
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_qty" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_qty" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_qty" name="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" id="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_qty" name="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" id="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_price->Visible) { // item_price ?>
		<td data-name="item_price"<?php echo $tr_inv_item->item_price->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_price" class="form-group tr_inv_item_item_price">
<input type="text" data-table="tr_inv_item" data-field="x_item_price" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" size="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_price->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_price->EditValue ?>"<?php echo $tr_inv_item->item_price->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_price" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_inv_item->item_price->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_price" class="form-group tr_inv_item_item_price">
<input type="text" data-table="tr_inv_item" data-field="x_item_price" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" size="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_price->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_price->EditValue ?>"<?php echo $tr_inv_item->item_price->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_price" class="tr_inv_item_item_price">
<span<?php echo $tr_inv_item->item_price->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_price->ListViewValue() ?></span>
</span>
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_price" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_inv_item->item_price->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_price" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_inv_item->item_price->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_price" name="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" id="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_inv_item->item_price->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_price" name="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" id="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_inv_item->item_price->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_disc->Visible) { // item_disc ?>
		<td data-name="item_disc"<?php echo $tr_inv_item->item_disc->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_disc" class="form-group tr_inv_item_item_disc">
<input type="text" data-table="tr_inv_item" data-field="x_item_disc" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_disc->EditValue ?>"<?php echo $tr_inv_item->item_disc->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_disc" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" value="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_disc" class="form-group tr_inv_item_item_disc">
<input type="text" data-table="tr_inv_item" data-field="x_item_disc" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_disc->EditValue ?>"<?php echo $tr_inv_item->item_disc->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_disc" class="tr_inv_item_item_disc">
<span<?php echo $tr_inv_item->item_disc->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_disc->ListViewValue() ?></span>
</span>
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_disc" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" value="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_disc" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" value="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_disc" name="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" id="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" value="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_disc" name="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" id="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" value="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_amt->Visible) { // item_amt ?>
		<td data-name="item_amt"<?php echo $tr_inv_item->item_amt->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_amt" class="form-group tr_inv_item_item_amt">
<input type="text" data-table="tr_inv_item" data-field="x_item_amt" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" size="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_amt->EditValue ?>"<?php echo $tr_inv_item->item_amt->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_amt" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" value="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_amt" class="form-group tr_inv_item_item_amt">
<input type="text" data-table="tr_inv_item" data-field="x_item_amt" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" size="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_amt->EditValue ?>"<?php echo $tr_inv_item->item_amt->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_item_amt" class="tr_inv_item_item_amt">
<span<?php echo $tr_inv_item->item_amt->ViewAttributes() ?>>
<?php echo $tr_inv_item->item_amt->ListViewValue() ?></span>
</span>
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_amt" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" value="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_amt" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" value="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_amt" name="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" id="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" value="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_item_amt" name="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" id="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" value="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_inv_item->unit_id->Visible) { // unit_id ?>
		<td data-name="unit_id"<?php echo $tr_inv_item->unit_id->CellAttributes() ?>>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_unit_id" class="form-group tr_inv_item_unit_id">
<input type="text" data-table="tr_inv_item" data-field="x_unit_id" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->unit_id->EditValue ?>"<?php echo $tr_inv_item->unit_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_unit_id" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_unit_id" class="form-group tr_inv_item_unit_id">
<input type="hidden" data-table="tr_inv_item" data-field="x_unit_id" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_inv_item_grid->RowCnt ?>_tr_inv_item_unit_id" class="tr_inv_item_unit_id">
<span<?php echo $tr_inv_item->unit_id->ViewAttributes() ?>>
<?php echo $tr_inv_item->unit_id->ListViewValue() ?></span>
</span>
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_unit_id" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_unit_id" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_unit_id" name="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" id="ftr_inv_itemgrid$x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->FormValue) ?>">
<input type="hidden" data-table="tr_inv_item" data-field="x_unit_id" name="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" id="ftr_inv_itemgrid$o<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tr_inv_item_grid->ListOptions->Render("body", "right", $tr_inv_item_grid->RowCnt);
?>
	</tr>
<?php if ($tr_inv_item->RowType == EW_ROWTYPE_ADD || $tr_inv_item->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ftr_inv_itemgrid.UpdateOpts(<?php echo $tr_inv_item_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($tr_inv_item->CurrentAction <> "gridadd" || $tr_inv_item->CurrentMode == "copy")
		if (!$tr_inv_item_grid->Recordset->EOF) $tr_inv_item_grid->Recordset->MoveNext();
}
?>
<?php
	if ($tr_inv_item->CurrentMode == "add" || $tr_inv_item->CurrentMode == "copy" || $tr_inv_item->CurrentMode == "edit") {
		$tr_inv_item_grid->RowIndex = '$rowindex$';
		$tr_inv_item_grid->LoadRowValues();

		// Set row properties
		$tr_inv_item->ResetAttrs();
		$tr_inv_item->RowAttrs = array_merge($tr_inv_item->RowAttrs, array('data-rowindex'=>$tr_inv_item_grid->RowIndex, 'id'=>'r0_tr_inv_item', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($tr_inv_item->RowAttrs["class"], "ewTemplate");
		$tr_inv_item->RowType = EW_ROWTYPE_ADD;

		// Render row
		$tr_inv_item_grid->RenderRow();

		// Render list options
		$tr_inv_item_grid->RenderListOptions();
		$tr_inv_item_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tr_inv_item->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tr_inv_item_grid->ListOptions->Render("body", "left", $tr_inv_item_grid->RowIndex);
?>
	<?php if ($tr_inv_item->item_id->Visible) { // item_id ?>
		<td data-name="item_id">
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_inv_item_item_id" class="form-group tr_inv_item_item_id">
<?php
$wrkonchange = trim("ew_UpdateOpt.call(this); " . @$tr_inv_item->item_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$tr_inv_item->item_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" style="white-space: nowrap; z-index: <?php echo (9000 - $tr_inv_item_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="sv_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo $tr_inv_item->item_id->EditValue ?>" size="40" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_id->getPlaceHolder()) ?>"<?php echo $tr_inv_item->item_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" data-value-separator="<?php echo $tr_inv_item->item_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ftr_inv_itemgrid.CreateAutoSuggest({"id":"x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id","forceSelect":true});
</script>
<input type="hidden" name="ln_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="ln_x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code,x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name,x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id,x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price,x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id">
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_inv_item_item_id" class="form-group tr_inv_item_item_id">
<span<?php echo $tr_inv_item->item_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_inv_item->item_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_id" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_id" value="<?php echo ew_HtmlEncode($tr_inv_item->item_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_code->Visible) { // item_code ?>
		<td data-name="item_code">
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_inv_item_item_code" class="form-group tr_inv_item_item_code">
<input type="text" data-table="tr_inv_item" data-field="x_item_code" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_code->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_code->EditValue ?>"<?php echo $tr_inv_item->item_code->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_inv_item_item_code" class="form-group tr_inv_item_item_code">
<span<?php echo $tr_inv_item->item_code->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_inv_item->item_code->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_code" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_inv_item->item_code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_code" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_code" value="<?php echo ew_HtmlEncode($tr_inv_item->item_code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_name->Visible) { // item_name ?>
		<td data-name="item_name">
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_inv_item_item_name" class="form-group tr_inv_item_item_name">
<input type="text" data-table="tr_inv_item" data-field="x_item_name" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_name->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_name->EditValue ?>"<?php echo $tr_inv_item->item_name->EditAttributes() ?>>
</span>
<?php } else { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_name" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" value="<?php echo ew_HtmlEncode($tr_inv_item->item_name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_name" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_name" value="<?php echo ew_HtmlEncode($tr_inv_item->item_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->udet_id->Visible) { // udet_id ?>
		<td data-name="udet_id">
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_inv_item_udet_id" class="form-group tr_inv_item_udet_id">
<?php $tr_inv_item->udet_id->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_inv_item->udet_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_inv_item->udet_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_inv_item->udet_id->ViewValue ?>
	</span>
	<?php if (!$tr_inv_item->udet_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_inv_item->udet_id->RadioButtonListHtml(TRUE, "x{$tr_inv_item_grid->RowIndex}_udet_id") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" class="ewTemplate"><input type="radio" data-table="tr_inv_item" data-field="x_udet_id" data-value-separator="<?php echo $tr_inv_item->udet_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="{value}"<?php echo $tr_inv_item->udet_id->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="ln_x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id,x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price">
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_inv_item_udet_id" class="form-group tr_inv_item_udet_id">
<span<?php echo $tr_inv_item->udet_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_inv_item->udet_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_udet_id" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="<?php echo ew_HtmlEncode($tr_inv_item->udet_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_udet_id" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_udet_id" value="<?php echo ew_HtmlEncode($tr_inv_item->udet_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_qty->Visible) { // item_qty ?>
		<td data-name="item_qty">
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_inv_item_item_qty" class="form-group tr_inv_item_item_qty">
<input type="text" data-table="tr_inv_item" data-field="x_item_qty" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_qty->EditValue ?>"<?php echo $tr_inv_item->item_qty->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_inv_item_item_qty" class="form-group tr_inv_item_item_qty">
<span<?php echo $tr_inv_item->item_qty->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_inv_item->item_qty->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_qty" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_qty" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_qty" value="<?php echo ew_HtmlEncode($tr_inv_item->item_qty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_price->Visible) { // item_price ?>
		<td data-name="item_price">
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_inv_item_item_price" class="form-group tr_inv_item_item_price">
<input type="text" data-table="tr_inv_item" data-field="x_item_price" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" size="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_price->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_price->EditValue ?>"<?php echo $tr_inv_item->item_price->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_inv_item_item_price" class="form-group tr_inv_item_item_price">
<span<?php echo $tr_inv_item->item_price->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_inv_item->item_price->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_price" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_inv_item->item_price->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_price" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_price" value="<?php echo ew_HtmlEncode($tr_inv_item->item_price->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_disc->Visible) { // item_disc ?>
		<td data-name="item_disc">
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_inv_item_item_disc" class="form-group tr_inv_item_item_disc">
<input type="text" data-table="tr_inv_item" data-field="x_item_disc" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" size="10" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_disc->EditValue ?>"<?php echo $tr_inv_item->item_disc->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_inv_item_item_disc" class="form-group tr_inv_item_item_disc">
<span<?php echo $tr_inv_item->item_disc->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_inv_item->item_disc->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_disc" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" value="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_disc" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_disc" value="<?php echo ew_HtmlEncode($tr_inv_item->item_disc->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->item_amt->Visible) { // item_amt ?>
		<td data-name="item_amt">
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_inv_item_item_amt" class="form-group tr_inv_item_item_amt">
<input type="text" data-table="tr_inv_item" data-field="x_item_amt" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" size="15" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->item_amt->EditValue ?>"<?php echo $tr_inv_item->item_amt->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_inv_item_item_amt" class="form-group tr_inv_item_item_amt">
<span<?php echo $tr_inv_item->item_amt->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_inv_item->item_amt->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_amt" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" value="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_item_amt" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_item_amt" value="<?php echo ew_HtmlEncode($tr_inv_item->item_amt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_inv_item->unit_id->Visible) { // unit_id ?>
		<td data-name="unit_id">
<?php if ($tr_inv_item->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_inv_item_unit_id" class="form-group tr_inv_item_unit_id">
<input type="text" data-table="tr_inv_item" data-field="x_unit_id" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" size="30" placeholder="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->getPlaceHolder()) ?>" value="<?php echo $tr_inv_item->unit_id->EditValue ?>"<?php echo $tr_inv_item->unit_id->EditAttributes() ?>>
</span>
<?php } else { ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_unit_id" name="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" id="x<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_inv_item" data-field="x_unit_id" name="o<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" id="o<?php echo $tr_inv_item_grid->RowIndex ?>_unit_id" value="<?php echo ew_HtmlEncode($tr_inv_item->unit_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tr_inv_item_grid->ListOptions->Render("body", "right", $tr_inv_item_grid->RowIndex);
?>
<script type="text/javascript">
ftr_inv_itemgrid.UpdateOpts(<?php echo $tr_inv_item_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($tr_inv_item->CurrentMode == "add" || $tr_inv_item->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $tr_inv_item_grid->FormKeyCountName ?>" id="<?php echo $tr_inv_item_grid->FormKeyCountName ?>" value="<?php echo $tr_inv_item_grid->KeyCount ?>">
<?php echo $tr_inv_item_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tr_inv_item->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $tr_inv_item_grid->FormKeyCountName ?>" id="<?php echo $tr_inv_item_grid->FormKeyCountName ?>" value="<?php echo $tr_inv_item_grid->KeyCount ?>">
<?php echo $tr_inv_item_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tr_inv_item->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftr_inv_itemgrid">
</div>
<?php

// Close recordset
if ($tr_inv_item_grid->Recordset)
	$tr_inv_item_grid->Recordset->Close();
?>
<?php if ($tr_inv_item_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($tr_inv_item_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($tr_inv_item_grid->TotalRecs == 0 && $tr_inv_item->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($tr_inv_item_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($tr_inv_item->Export == "") { ?>
<script type="text/javascript">
ftr_inv_itemgrid.Init();
</script>
<?php } ?>
<?php
$tr_inv_item_grid->Page_Terminate();
?>
