<?php include_once "employeesinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($tr_km_item_ar_grid)) $tr_km_item_ar_grid = new ctr_km_item_ar_grid();

// Page init
$tr_km_item_ar_grid->Page_Init();

// Page main
$tr_km_item_ar_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tr_km_item_ar_grid->Page_Render();
?>
<?php if ($tr_km_item_ar->Export == "") { ?>
<script type="text/javascript">

// Form object
var ftr_km_item_argrid = new ew_Form("ftr_km_item_argrid", "grid");
ftr_km_item_argrid.FormKeyCountName = '<?php echo $tr_km_item_ar_grid->FormKeyCountName ?>';

// Validate form
ftr_km_item_argrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_inv_date");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_item_ar->inv_date->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_inv_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_item_ar->inv_amt->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_paid_amt");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tr_km_item_ar->paid_amt->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftr_km_item_argrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "customer_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "inv_number", false)) return false;
	if (ew_ValueChanged(fobj, infix, "inv_date", false)) return false;
	if (ew_ValueChanged(fobj, infix, "inv_amt", false)) return false;
	if (ew_ValueChanged(fobj, infix, "paid_amt", false)) return false;
	return true;
}

// Form_CustomValidate event
ftr_km_item_argrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftr_km_item_argrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftr_km_item_argrid.Lists["x_customer_id"] = {"LinkField":"x_customer_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_customer_name","","",""],"ParentFields":["tr_km_master_ar x_customer_id"],"ChildFields":["x_inv_number"],"FilterFields":["x_customer_id"],"Options":[],"Template":"","LinkTable":"tbl_customer"};
ftr_km_item_argrid.Lists["x_customer_id"].Data = "<?php echo $tr_km_item_ar_grid->customer_id->LookupFilterQuery(FALSE, "grid") ?>";
ftr_km_item_argrid.Lists["x_inv_number"] = {"LinkField":"x_inv_number","Ajax":true,"AutoFill":true,"DisplayFields":["x_inv_number","","",""],"ParentFields":["x_customer_id"],"ChildFields":[],"FilterFields":["x_customer_id"],"Options":[],"Template":"","LinkTable":"tr_inv_master"};
ftr_km_item_argrid.Lists["x_inv_number"].Data = "<?php echo $tr_km_item_ar_grid->inv_number->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($tr_km_item_ar->CurrentAction == "gridadd") {
	if ($tr_km_item_ar->CurrentMode == "copy") {
		$bSelectLimit = $tr_km_item_ar_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$tr_km_item_ar_grid->TotalRecs = $tr_km_item_ar->ListRecordCount();
			$tr_km_item_ar_grid->Recordset = $tr_km_item_ar_grid->LoadRecordset($tr_km_item_ar_grid->StartRec-1, $tr_km_item_ar_grid->DisplayRecs);
		} else {
			if ($tr_km_item_ar_grid->Recordset = $tr_km_item_ar_grid->LoadRecordset())
				$tr_km_item_ar_grid->TotalRecs = $tr_km_item_ar_grid->Recordset->RecordCount();
		}
		$tr_km_item_ar_grid->StartRec = 1;
		$tr_km_item_ar_grid->DisplayRecs = $tr_km_item_ar_grid->TotalRecs;
	} else {
		$tr_km_item_ar->CurrentFilter = "0=1";
		$tr_km_item_ar_grid->StartRec = 1;
		$tr_km_item_ar_grid->DisplayRecs = $tr_km_item_ar->GridAddRowCount;
	}
	$tr_km_item_ar_grid->TotalRecs = $tr_km_item_ar_grid->DisplayRecs;
	$tr_km_item_ar_grid->StopRec = $tr_km_item_ar_grid->DisplayRecs;
} else {
	$bSelectLimit = $tr_km_item_ar_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($tr_km_item_ar_grid->TotalRecs <= 0)
			$tr_km_item_ar_grid->TotalRecs = $tr_km_item_ar->ListRecordCount();
	} else {
		if (!$tr_km_item_ar_grid->Recordset && ($tr_km_item_ar_grid->Recordset = $tr_km_item_ar_grid->LoadRecordset()))
			$tr_km_item_ar_grid->TotalRecs = $tr_km_item_ar_grid->Recordset->RecordCount();
	}
	$tr_km_item_ar_grid->StartRec = 1;
	$tr_km_item_ar_grid->DisplayRecs = $tr_km_item_ar_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$tr_km_item_ar_grid->Recordset = $tr_km_item_ar_grid->LoadRecordset($tr_km_item_ar_grid->StartRec-1, $tr_km_item_ar_grid->DisplayRecs);

	// Set no record found message
	if ($tr_km_item_ar->CurrentAction == "" && $tr_km_item_ar_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$tr_km_item_ar_grid->setWarningMessage(ew_DeniedMsg());
		if ($tr_km_item_ar_grid->SearchWhere == "0=101")
			$tr_km_item_ar_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$tr_km_item_ar_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$tr_km_item_ar_grid->RenderOtherOptions();
?>
<?php $tr_km_item_ar_grid->ShowPageHeader(); ?>
<?php
$tr_km_item_ar_grid->ShowMessage();
?>
<?php if ($tr_km_item_ar_grid->TotalRecs > 0 || $tr_km_item_ar->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($tr_km_item_ar_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> tr_km_item_ar">
<div id="ftr_km_item_argrid" class="ewForm ewListForm form-inline">
<?php if ($tr_km_item_ar_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($tr_km_item_ar_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_tr_km_item_ar" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_tr_km_item_argrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$tr_km_item_ar_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$tr_km_item_ar_grid->RenderListOptions();

// Render list options (header, left)
$tr_km_item_ar_grid->ListOptions->Render("header", "left");
?>
<?php if ($tr_km_item_ar->customer_id->Visible) { // customer_id ?>
	<?php if ($tr_km_item_ar->SortUrl($tr_km_item_ar->customer_id) == "") { ?>
		<th data-name="customer_id" class="<?php echo $tr_km_item_ar->customer_id->HeaderCellClass() ?>"><div id="elh_tr_km_item_ar_customer_id" class="tr_km_item_ar_customer_id"><div class="ewTableHeaderCaption"><?php echo $tr_km_item_ar->customer_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_id" class="<?php echo $tr_km_item_ar->customer_id->HeaderCellClass() ?>"><div><div id="elh_tr_km_item_ar_customer_id" class="tr_km_item_ar_customer_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_km_item_ar->customer_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_km_item_ar->customer_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_km_item_ar->customer_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_km_item_ar->inv_number->Visible) { // inv_number ?>
	<?php if ($tr_km_item_ar->SortUrl($tr_km_item_ar->inv_number) == "") { ?>
		<th data-name="inv_number" class="<?php echo $tr_km_item_ar->inv_number->HeaderCellClass() ?>"><div id="elh_tr_km_item_ar_inv_number" class="tr_km_item_ar_inv_number"><div class="ewTableHeaderCaption"><?php echo $tr_km_item_ar->inv_number->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inv_number" class="<?php echo $tr_km_item_ar->inv_number->HeaderCellClass() ?>"><div><div id="elh_tr_km_item_ar_inv_number" class="tr_km_item_ar_inv_number">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_km_item_ar->inv_number->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_km_item_ar->inv_number->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_km_item_ar->inv_number->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_km_item_ar->inv_date->Visible) { // inv_date ?>
	<?php if ($tr_km_item_ar->SortUrl($tr_km_item_ar->inv_date) == "") { ?>
		<th data-name="inv_date" class="<?php echo $tr_km_item_ar->inv_date->HeaderCellClass() ?>"><div id="elh_tr_km_item_ar_inv_date" class="tr_km_item_ar_inv_date"><div class="ewTableHeaderCaption"><?php echo $tr_km_item_ar->inv_date->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inv_date" class="<?php echo $tr_km_item_ar->inv_date->HeaderCellClass() ?>"><div><div id="elh_tr_km_item_ar_inv_date" class="tr_km_item_ar_inv_date">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_km_item_ar->inv_date->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_km_item_ar->inv_date->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_km_item_ar->inv_date->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_km_item_ar->inv_amt->Visible) { // inv_amt ?>
	<?php if ($tr_km_item_ar->SortUrl($tr_km_item_ar->inv_amt) == "") { ?>
		<th data-name="inv_amt" class="<?php echo $tr_km_item_ar->inv_amt->HeaderCellClass() ?>"><div id="elh_tr_km_item_ar_inv_amt" class="tr_km_item_ar_inv_amt"><div class="ewTableHeaderCaption"><?php echo $tr_km_item_ar->inv_amt->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inv_amt" class="<?php echo $tr_km_item_ar->inv_amt->HeaderCellClass() ?>"><div><div id="elh_tr_km_item_ar_inv_amt" class="tr_km_item_ar_inv_amt">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_km_item_ar->inv_amt->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_km_item_ar->inv_amt->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_km_item_ar->inv_amt->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tr_km_item_ar->paid_amt->Visible) { // paid_amt ?>
	<?php if ($tr_km_item_ar->SortUrl($tr_km_item_ar->paid_amt) == "") { ?>
		<th data-name="paid_amt" class="<?php echo $tr_km_item_ar->paid_amt->HeaderCellClass() ?>"><div id="elh_tr_km_item_ar_paid_amt" class="tr_km_item_ar_paid_amt"><div class="ewTableHeaderCaption"><?php echo $tr_km_item_ar->paid_amt->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="paid_amt" class="<?php echo $tr_km_item_ar->paid_amt->HeaderCellClass() ?>"><div><div id="elh_tr_km_item_ar_paid_amt" class="tr_km_item_ar_paid_amt">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tr_km_item_ar->paid_amt->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tr_km_item_ar->paid_amt->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tr_km_item_ar->paid_amt->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tr_km_item_ar_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tr_km_item_ar_grid->StartRec = 1;
$tr_km_item_ar_grid->StopRec = $tr_km_item_ar_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($tr_km_item_ar_grid->FormKeyCountName) && ($tr_km_item_ar->CurrentAction == "gridadd" || $tr_km_item_ar->CurrentAction == "gridedit" || $tr_km_item_ar->CurrentAction == "F")) {
		$tr_km_item_ar_grid->KeyCount = $objForm->GetValue($tr_km_item_ar_grid->FormKeyCountName);
		$tr_km_item_ar_grid->StopRec = $tr_km_item_ar_grid->StartRec + $tr_km_item_ar_grid->KeyCount - 1;
	}
}
$tr_km_item_ar_grid->RecCnt = $tr_km_item_ar_grid->StartRec - 1;
if ($tr_km_item_ar_grid->Recordset && !$tr_km_item_ar_grid->Recordset->EOF) {
	$tr_km_item_ar_grid->Recordset->MoveFirst();
	$bSelectLimit = $tr_km_item_ar_grid->UseSelectLimit;
	if (!$bSelectLimit && $tr_km_item_ar_grid->StartRec > 1)
		$tr_km_item_ar_grid->Recordset->Move($tr_km_item_ar_grid->StartRec - 1);
} elseif (!$tr_km_item_ar->AllowAddDeleteRow && $tr_km_item_ar_grid->StopRec == 0) {
	$tr_km_item_ar_grid->StopRec = $tr_km_item_ar->GridAddRowCount;
}

// Initialize aggregate
$tr_km_item_ar->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tr_km_item_ar->ResetAttrs();
$tr_km_item_ar_grid->RenderRow();
if ($tr_km_item_ar->CurrentAction == "gridadd")
	$tr_km_item_ar_grid->RowIndex = 0;
if ($tr_km_item_ar->CurrentAction == "gridedit")
	$tr_km_item_ar_grid->RowIndex = 0;
while ($tr_km_item_ar_grid->RecCnt < $tr_km_item_ar_grid->StopRec) {
	$tr_km_item_ar_grid->RecCnt++;
	if (intval($tr_km_item_ar_grid->RecCnt) >= intval($tr_km_item_ar_grid->StartRec)) {
		$tr_km_item_ar_grid->RowCnt++;
		if ($tr_km_item_ar->CurrentAction == "gridadd" || $tr_km_item_ar->CurrentAction == "gridedit" || $tr_km_item_ar->CurrentAction == "F") {
			$tr_km_item_ar_grid->RowIndex++;
			$objForm->Index = $tr_km_item_ar_grid->RowIndex;
			if ($objForm->HasValue($tr_km_item_ar_grid->FormActionName))
				$tr_km_item_ar_grid->RowAction = strval($objForm->GetValue($tr_km_item_ar_grid->FormActionName));
			elseif ($tr_km_item_ar->CurrentAction == "gridadd")
				$tr_km_item_ar_grid->RowAction = "insert";
			else
				$tr_km_item_ar_grid->RowAction = "";
		}

		// Set up key count
		$tr_km_item_ar_grid->KeyCount = $tr_km_item_ar_grid->RowIndex;

		// Init row class and style
		$tr_km_item_ar->ResetAttrs();
		$tr_km_item_ar->CssClass = "";
		if ($tr_km_item_ar->CurrentAction == "gridadd") {
			if ($tr_km_item_ar->CurrentMode == "copy") {
				$tr_km_item_ar_grid->LoadRowValues($tr_km_item_ar_grid->Recordset); // Load row values
				$tr_km_item_ar_grid->SetRecordKey($tr_km_item_ar_grid->RowOldKey, $tr_km_item_ar_grid->Recordset); // Set old record key
			} else {
				$tr_km_item_ar_grid->LoadRowValues(); // Load default values
				$tr_km_item_ar_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tr_km_item_ar_grid->LoadRowValues($tr_km_item_ar_grid->Recordset); // Load row values
		}
		$tr_km_item_ar->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($tr_km_item_ar->CurrentAction == "gridadd") // Grid add
			$tr_km_item_ar->RowType = EW_ROWTYPE_ADD; // Render add
		if ($tr_km_item_ar->CurrentAction == "gridadd" && $tr_km_item_ar->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$tr_km_item_ar_grid->RestoreCurrentRowFormValues($tr_km_item_ar_grid->RowIndex); // Restore form values
		if ($tr_km_item_ar->CurrentAction == "gridedit") { // Grid edit
			if ($tr_km_item_ar->EventCancelled) {
				$tr_km_item_ar_grid->RestoreCurrentRowFormValues($tr_km_item_ar_grid->RowIndex); // Restore form values
			}
			if ($tr_km_item_ar_grid->RowAction == "insert")
				$tr_km_item_ar->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$tr_km_item_ar->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($tr_km_item_ar->CurrentAction == "gridedit" && ($tr_km_item_ar->RowType == EW_ROWTYPE_EDIT || $tr_km_item_ar->RowType == EW_ROWTYPE_ADD) && $tr_km_item_ar->EventCancelled) // Update failed
			$tr_km_item_ar_grid->RestoreCurrentRowFormValues($tr_km_item_ar_grid->RowIndex); // Restore form values
		if ($tr_km_item_ar->RowType == EW_ROWTYPE_EDIT) // Edit row
			$tr_km_item_ar_grid->EditRowCnt++;
		if ($tr_km_item_ar->CurrentAction == "F") // Confirm row
			$tr_km_item_ar_grid->RestoreCurrentRowFormValues($tr_km_item_ar_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tr_km_item_ar->RowAttrs = array_merge($tr_km_item_ar->RowAttrs, array('data-rowindex'=>$tr_km_item_ar_grid->RowCnt, 'id'=>'r' . $tr_km_item_ar_grid->RowCnt . '_tr_km_item_ar', 'data-rowtype'=>$tr_km_item_ar->RowType));

		// Render row
		$tr_km_item_ar_grid->RenderRow();

		// Render list options
		$tr_km_item_ar_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tr_km_item_ar_grid->RowAction <> "delete" && $tr_km_item_ar_grid->RowAction <> "insertdelete" && !($tr_km_item_ar_grid->RowAction == "insert" && $tr_km_item_ar->CurrentAction == "F" && $tr_km_item_ar_grid->EmptyRow())) {
?>
	<tr<?php echo $tr_km_item_ar->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tr_km_item_ar_grid->ListOptions->Render("body", "left", $tr_km_item_ar_grid->RowCnt);
?>
	<?php if ($tr_km_item_ar->customer_id->Visible) { // customer_id ?>
		<td data-name="customer_id"<?php echo $tr_km_item_ar->customer_id->CellAttributes() ?>>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_customer_id" class="form-group tr_km_item_ar_customer_id">
<?php $tr_km_item_ar->customer_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tr_km_item_ar->customer_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_item_ar->customer_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_item_ar->customer_id->ViewValue ?>
	</span>
	<?php if (!$tr_km_item_ar->customer_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_item_ar->customer_id->RadioButtonListHtml(TRUE, "x{$tr_km_item_ar_grid->RowIndex}_customer_id") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" class="ewTemplate"><input type="radio" data-table="tr_km_item_ar" data-field="x_customer_id" data-value-separator="<?php echo $tr_km_item_ar->customer_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" value="{value}"<?php echo $tr_km_item_ar->customer_id->EditAttributes() ?>></div>
</div>
</span>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_customer_id" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar->customer_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_customer_id" class="form-group tr_km_item_ar_customer_id">
<?php $tr_km_item_ar->customer_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tr_km_item_ar->customer_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_item_ar->customer_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_item_ar->customer_id->ViewValue ?>
	</span>
	<?php if (!$tr_km_item_ar->customer_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_item_ar->customer_id->RadioButtonListHtml(TRUE, "x{$tr_km_item_ar_grid->RowIndex}_customer_id") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" class="ewTemplate"><input type="radio" data-table="tr_km_item_ar" data-field="x_customer_id" data-value-separator="<?php echo $tr_km_item_ar->customer_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" value="{value}"<?php echo $tr_km_item_ar->customer_id->EditAttributes() ?>></div>
</div>
</span>
<?php } ?>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_customer_id" class="tr_km_item_ar_customer_id">
<span<?php echo $tr_km_item_ar->customer_id->ViewAttributes() ?>>
<?php echo $tr_km_item_ar->customer_id->ListViewValue() ?></span>
</span>
<?php if ($tr_km_item_ar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_customer_id" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar->customer_id->FormValue) ?>">
<input type="hidden" data-table="tr_km_item_ar" data-field="x_customer_id" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar->customer_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_customer_id" name="ftr_km_item_argrid$x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" id="ftr_km_item_argrid$x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar->customer_id->FormValue) ?>">
<input type="hidden" data-table="tr_km_item_ar" data-field="x_customer_id" name="ftr_km_item_argrid$o<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" id="ftr_km_item_argrid$o<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar->customer_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_row_id" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_row_id" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar->row_id->CurrentValue) ?>">
<input type="hidden" data-table="tr_km_item_ar" data-field="x_row_id" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_row_id" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar->row_id->OldValue) ?>">
<?php } ?>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_EDIT || $tr_km_item_ar->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_row_id" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_row_id" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_row_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar->row_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($tr_km_item_ar->inv_number->Visible) { // inv_number ?>
		<td data-name="inv_number"<?php echo $tr_km_item_ar->inv_number->CellAttributes() ?>>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_inv_number" class="form-group tr_km_item_ar_inv_number">
<?php $tr_km_item_ar->inv_number->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_km_item_ar->inv_number->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_item_ar->inv_number->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_item_ar->inv_number->ViewValue ?>
	</span>
	<?php if (!$tr_km_item_ar->inv_number->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_item_ar->inv_number->RadioButtonListHtml(TRUE, "x{$tr_km_item_ar_grid->RowIndex}_inv_number") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" class="ewTemplate"><input type="radio" data-table="tr_km_item_ar" data-field="x_inv_number" data-value-separator="<?php echo $tr_km_item_ar->inv_number->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="{value}"<?php echo $tr_km_item_ar->inv_number->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="ln_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date,x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt,x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt">
</span>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_number" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_number->OldValue) ?>">
<?php } ?>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_inv_number" class="form-group tr_km_item_ar_inv_number">
<?php $tr_km_item_ar->inv_number->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_km_item_ar->inv_number->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_item_ar->inv_number->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_item_ar->inv_number->ViewValue ?>
	</span>
	<?php if (!$tr_km_item_ar->inv_number->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_item_ar->inv_number->RadioButtonListHtml(TRUE, "x{$tr_km_item_ar_grid->RowIndex}_inv_number") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" class="ewTemplate"><input type="radio" data-table="tr_km_item_ar" data-field="x_inv_number" data-value-separator="<?php echo $tr_km_item_ar->inv_number->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="{value}"<?php echo $tr_km_item_ar->inv_number->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="ln_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date,x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt,x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt">
</span>
<?php } ?>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_inv_number" class="tr_km_item_ar_inv_number">
<span<?php echo $tr_km_item_ar->inv_number->ViewAttributes() ?>>
<?php echo $tr_km_item_ar->inv_number->ListViewValue() ?></span>
</span>
<?php if ($tr_km_item_ar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_number" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_number->FormValue) ?>">
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_number" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_number->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_number" name="ftr_km_item_argrid$x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="ftr_km_item_argrid$x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_number->FormValue) ?>">
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_number" name="ftr_km_item_argrid$o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="ftr_km_item_argrid$o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_number->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_km_item_ar->inv_date->Visible) { // inv_date ?>
		<td data-name="inv_date"<?php echo $tr_km_item_ar->inv_date->CellAttributes() ?>>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_inv_date" class="form-group tr_km_item_ar_inv_date">
<input type="text" data-table="tr_km_item_ar" data-field="x_inv_date" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" size="10" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_date->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar->inv_date->EditValue ?>"<?php echo $tr_km_item_ar->inv_date->EditAttributes() ?>>
<?php if (!$tr_km_item_ar->inv_date->ReadOnly && !$tr_km_item_ar->inv_date->Disabled && !isset($tr_km_item_ar->inv_date->EditAttrs["readonly"]) && !isset($tr_km_item_ar->inv_date->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ftr_km_item_argrid", "x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_date" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_date->OldValue) ?>">
<?php } ?>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_inv_date" class="form-group tr_km_item_ar_inv_date">
<input type="text" data-table="tr_km_item_ar" data-field="x_inv_date" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" size="10" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_date->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar->inv_date->EditValue ?>"<?php echo $tr_km_item_ar->inv_date->EditAttributes() ?>>
<?php if (!$tr_km_item_ar->inv_date->ReadOnly && !$tr_km_item_ar->inv_date->Disabled && !isset($tr_km_item_ar->inv_date->EditAttrs["readonly"]) && !isset($tr_km_item_ar->inv_date->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ftr_km_item_argrid", "x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_inv_date" class="tr_km_item_ar_inv_date">
<span<?php echo $tr_km_item_ar->inv_date->ViewAttributes() ?>>
<?php echo $tr_km_item_ar->inv_date->ListViewValue() ?></span>
</span>
<?php if ($tr_km_item_ar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_date" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_date->FormValue) ?>">
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_date" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_date->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_date" name="ftr_km_item_argrid$x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" id="ftr_km_item_argrid$x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_date->FormValue) ?>">
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_date" name="ftr_km_item_argrid$o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" id="ftr_km_item_argrid$o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_km_item_ar->inv_amt->Visible) { // inv_amt ?>
		<td data-name="inv_amt"<?php echo $tr_km_item_ar->inv_amt->CellAttributes() ?>>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_inv_amt" class="form-group tr_km_item_ar_inv_amt">
<input type="text" data-table="tr_km_item_ar" data-field="x_inv_amt" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar->inv_amt->EditValue ?>"<?php echo $tr_km_item_ar->inv_amt->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_amt" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_amt->OldValue) ?>">
<?php } ?>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_inv_amt" class="form-group tr_km_item_ar_inv_amt">
<input type="text" data-table="tr_km_item_ar" data-field="x_inv_amt" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar->inv_amt->EditValue ?>"<?php echo $tr_km_item_ar->inv_amt->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_inv_amt" class="tr_km_item_ar_inv_amt">
<span<?php echo $tr_km_item_ar->inv_amt->ViewAttributes() ?>>
<?php echo $tr_km_item_ar->inv_amt->ListViewValue() ?></span>
</span>
<?php if ($tr_km_item_ar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_amt" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_amt->FormValue) ?>">
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_amt" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_amt->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_amt" name="ftr_km_item_argrid$x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" id="ftr_km_item_argrid$x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_amt->FormValue) ?>">
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_amt" name="ftr_km_item_argrid$o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" id="ftr_km_item_argrid$o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_amt->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tr_km_item_ar->paid_amt->Visible) { // paid_amt ?>
		<td data-name="paid_amt"<?php echo $tr_km_item_ar->paid_amt->CellAttributes() ?>>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_paid_amt" class="form-group tr_km_item_ar_paid_amt">
<input type="text" data-table="tr_km_item_ar" data-field="x_paid_amt" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar->paid_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar->paid_amt->EditValue ?>"<?php echo $tr_km_item_ar->paid_amt->EditAttributes() ?>>
</span>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_paid_amt" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->paid_amt->OldValue) ?>">
<?php } ?>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_paid_amt" class="form-group tr_km_item_ar_paid_amt">
<input type="text" data-table="tr_km_item_ar" data-field="x_paid_amt" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar->paid_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar->paid_amt->EditValue ?>"<?php echo $tr_km_item_ar->paid_amt->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tr_km_item_ar_grid->RowCnt ?>_tr_km_item_ar_paid_amt" class="tr_km_item_ar_paid_amt">
<span<?php echo $tr_km_item_ar->paid_amt->ViewAttributes() ?>>
<?php echo $tr_km_item_ar->paid_amt->ListViewValue() ?></span>
</span>
<?php if ($tr_km_item_ar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_paid_amt" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->paid_amt->FormValue) ?>">
<input type="hidden" data-table="tr_km_item_ar" data-field="x_paid_amt" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->paid_amt->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_paid_amt" name="ftr_km_item_argrid$x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" id="ftr_km_item_argrid$x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->paid_amt->FormValue) ?>">
<input type="hidden" data-table="tr_km_item_ar" data-field="x_paid_amt" name="ftr_km_item_argrid$o<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" id="ftr_km_item_argrid$o<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->paid_amt->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tr_km_item_ar_grid->ListOptions->Render("body", "right", $tr_km_item_ar_grid->RowCnt);
?>
	</tr>
<?php if ($tr_km_item_ar->RowType == EW_ROWTYPE_ADD || $tr_km_item_ar->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ftr_km_item_argrid.UpdateOpts(<?php echo $tr_km_item_ar_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($tr_km_item_ar->CurrentAction <> "gridadd" || $tr_km_item_ar->CurrentMode == "copy")
		if (!$tr_km_item_ar_grid->Recordset->EOF) $tr_km_item_ar_grid->Recordset->MoveNext();
}
?>
<?php
	if ($tr_km_item_ar->CurrentMode == "add" || $tr_km_item_ar->CurrentMode == "copy" || $tr_km_item_ar->CurrentMode == "edit") {
		$tr_km_item_ar_grid->RowIndex = '$rowindex$';
		$tr_km_item_ar_grid->LoadRowValues();

		// Set row properties
		$tr_km_item_ar->ResetAttrs();
		$tr_km_item_ar->RowAttrs = array_merge($tr_km_item_ar->RowAttrs, array('data-rowindex'=>$tr_km_item_ar_grid->RowIndex, 'id'=>'r0_tr_km_item_ar', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($tr_km_item_ar->RowAttrs["class"], "ewTemplate");
		$tr_km_item_ar->RowType = EW_ROWTYPE_ADD;

		// Render row
		$tr_km_item_ar_grid->RenderRow();

		// Render list options
		$tr_km_item_ar_grid->RenderListOptions();
		$tr_km_item_ar_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tr_km_item_ar->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tr_km_item_ar_grid->ListOptions->Render("body", "left", $tr_km_item_ar_grid->RowIndex);
?>
	<?php if ($tr_km_item_ar->customer_id->Visible) { // customer_id ?>
		<td data-name="customer_id">
<?php if ($tr_km_item_ar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_km_item_ar_customer_id" class="form-group tr_km_item_ar_customer_id">
<?php $tr_km_item_ar->customer_id->EditAttrs["onclick"] = "ew_UpdateOpt.call(this); " . @$tr_km_item_ar->customer_id->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_item_ar->customer_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_item_ar->customer_id->ViewValue ?>
	</span>
	<?php if (!$tr_km_item_ar->customer_id->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_item_ar->customer_id->RadioButtonListHtml(TRUE, "x{$tr_km_item_ar_grid->RowIndex}_customer_id") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" class="ewTemplate"><input type="radio" data-table="tr_km_item_ar" data-field="x_customer_id" data-value-separator="<?php echo $tr_km_item_ar->customer_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" value="{value}"<?php echo $tr_km_item_ar->customer_id->EditAttributes() ?>></div>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_km_item_ar_customer_id" class="form-group tr_km_item_ar_customer_id">
<span<?php echo $tr_km_item_ar->customer_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_km_item_ar->customer_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_customer_id" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar->customer_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_customer_id" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_customer_id" value="<?php echo ew_HtmlEncode($tr_km_item_ar->customer_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_km_item_ar->inv_number->Visible) { // inv_number ?>
		<td data-name="inv_number">
<?php if ($tr_km_item_ar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_km_item_ar_inv_number" class="form-group tr_km_item_ar_inv_number">
<?php $tr_km_item_ar->inv_number->EditAttrs["onclick"] = "ew_AutoFill(this); " . @$tr_km_item_ar->inv_number->EditAttrs["onclick"]; ?>
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($tr_km_item_ar->inv_number->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $tr_km_item_ar->inv_number->ViewValue ?>
	</span>
	<?php if (!$tr_km_item_ar->inv_number->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $tr_km_item_ar->inv_number->RadioButtonListHtml(TRUE, "x{$tr_km_item_ar_grid->RowIndex}_inv_number") ?>
		</div>
	</div>
	<div id="tp_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" class="ewTemplate"><input type="radio" data-table="tr_km_item_ar" data-field="x_inv_number" data-value-separator="<?php echo $tr_km_item_ar->inv_number->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="{value}"<?php echo $tr_km_item_ar->inv_number->EditAttributes() ?>></div>
</div>
<input type="hidden" name="ln_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="ln_x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date,x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt,x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt">
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_km_item_ar_inv_number" class="form-group tr_km_item_ar_inv_number">
<span<?php echo $tr_km_item_ar->inv_number->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_km_item_ar->inv_number->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_number" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_number->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_number" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_number" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_number->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_km_item_ar->inv_date->Visible) { // inv_date ?>
		<td data-name="inv_date">
<?php if ($tr_km_item_ar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_km_item_ar_inv_date" class="form-group tr_km_item_ar_inv_date">
<input type="text" data-table="tr_km_item_ar" data-field="x_inv_date" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" size="10" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_date->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar->inv_date->EditValue ?>"<?php echo $tr_km_item_ar->inv_date->EditAttributes() ?>>
<?php if (!$tr_km_item_ar->inv_date->ReadOnly && !$tr_km_item_ar->inv_date->Disabled && !isset($tr_km_item_ar->inv_date->EditAttrs["readonly"]) && !isset($tr_km_item_ar->inv_date->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ftr_km_item_argrid", "x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_km_item_ar_inv_date" class="form-group tr_km_item_ar_inv_date">
<span<?php echo $tr_km_item_ar->inv_date->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_km_item_ar->inv_date->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_date" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_date->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_date" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_date" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_km_item_ar->inv_amt->Visible) { // inv_amt ?>
		<td data-name="inv_amt">
<?php if ($tr_km_item_ar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_km_item_ar_inv_amt" class="form-group tr_km_item_ar_inv_amt">
<input type="text" data-table="tr_km_item_ar" data-field="x_inv_amt" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar->inv_amt->EditValue ?>"<?php echo $tr_km_item_ar->inv_amt->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_km_item_ar_inv_amt" class="form-group tr_km_item_ar_inv_amt">
<span<?php echo $tr_km_item_ar->inv_amt->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_km_item_ar->inv_amt->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_amt" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_amt->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_inv_amt" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_inv_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->inv_amt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tr_km_item_ar->paid_amt->Visible) { // paid_amt ?>
		<td data-name="paid_amt">
<?php if ($tr_km_item_ar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_tr_km_item_ar_paid_amt" class="form-group tr_km_item_ar_paid_amt">
<input type="text" data-table="tr_km_item_ar" data-field="x_paid_amt" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" size="30" placeholder="<?php echo ew_HtmlEncode($tr_km_item_ar->paid_amt->getPlaceHolder()) ?>" value="<?php echo $tr_km_item_ar->paid_amt->EditValue ?>"<?php echo $tr_km_item_ar->paid_amt->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tr_km_item_ar_paid_amt" class="form-group tr_km_item_ar_paid_amt">
<span<?php echo $tr_km_item_ar->paid_amt->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $tr_km_item_ar->paid_amt->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_paid_amt" name="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" id="x<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->paid_amt->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tr_km_item_ar" data-field="x_paid_amt" name="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" id="o<?php echo $tr_km_item_ar_grid->RowIndex ?>_paid_amt" value="<?php echo ew_HtmlEncode($tr_km_item_ar->paid_amt->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tr_km_item_ar_grid->ListOptions->Render("body", "right", $tr_km_item_ar_grid->RowIndex);
?>
<script type="text/javascript">
ftr_km_item_argrid.UpdateOpts(<?php echo $tr_km_item_ar_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($tr_km_item_ar->CurrentMode == "add" || $tr_km_item_ar->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $tr_km_item_ar_grid->FormKeyCountName ?>" id="<?php echo $tr_km_item_ar_grid->FormKeyCountName ?>" value="<?php echo $tr_km_item_ar_grid->KeyCount ?>">
<?php echo $tr_km_item_ar_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tr_km_item_ar->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $tr_km_item_ar_grid->FormKeyCountName ?>" id="<?php echo $tr_km_item_ar_grid->FormKeyCountName ?>" value="<?php echo $tr_km_item_ar_grid->KeyCount ?>">
<?php echo $tr_km_item_ar_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tr_km_item_ar->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftr_km_item_argrid">
</div>
<?php

// Close recordset
if ($tr_km_item_ar_grid->Recordset)
	$tr_km_item_ar_grid->Recordset->Close();
?>
<?php if ($tr_km_item_ar_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($tr_km_item_ar_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($tr_km_item_ar_grid->TotalRecs == 0 && $tr_km_item_ar->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($tr_km_item_ar_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($tr_km_item_ar->Export == "") { ?>
<script type="text/javascript">
ftr_km_item_argrid.Init();
</script>
<?php } ?>
<?php
$tr_km_item_ar_grid->Page_Terminate();
?>
