<?php

// product_code
// product_name
// supplier_id
// unit_id
// gramasi
// unit_cost
// unit_price
// reorder_level
// discontinued

?>
<?php if ($tbl_products->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_tbl_productsmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($tbl_products->product_code->Visible) { // product_code ?>
		<tr id="r_product_code">
			<td class="col-sm-2"><?php echo $tbl_products->product_code->FldCaption() ?></td>
			<td<?php echo $tbl_products->product_code->CellAttributes() ?>>
<span id="el_tbl_products_product_code">
<span<?php echo $tbl_products->product_code->ViewAttributes() ?>>
<?php echo $tbl_products->product_code->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_products->product_name->Visible) { // product_name ?>
		<tr id="r_product_name">
			<td class="col-sm-2"><?php echo $tbl_products->product_name->FldCaption() ?></td>
			<td<?php echo $tbl_products->product_name->CellAttributes() ?>>
<span id="el_tbl_products_product_name">
<span<?php echo $tbl_products->product_name->ViewAttributes() ?>>
<?php echo $tbl_products->product_name->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_products->supplier_id->Visible) { // supplier_id ?>
		<tr id="r_supplier_id">
			<td class="col-sm-2"><?php echo $tbl_products->supplier_id->FldCaption() ?></td>
			<td<?php echo $tbl_products->supplier_id->CellAttributes() ?>>
<span id="el_tbl_products_supplier_id">
<span<?php echo $tbl_products->supplier_id->ViewAttributes() ?>>
<?php echo $tbl_products->supplier_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_products->unit_id->Visible) { // unit_id ?>
		<tr id="r_unit_id">
			<td class="col-sm-2"><?php echo $tbl_products->unit_id->FldCaption() ?></td>
			<td<?php echo $tbl_products->unit_id->CellAttributes() ?>>
<span id="el_tbl_products_unit_id">
<span<?php echo $tbl_products->unit_id->ViewAttributes() ?>>
<?php echo $tbl_products->unit_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_products->gramasi->Visible) { // gramasi ?>
		<tr id="r_gramasi">
			<td class="col-sm-2"><?php echo $tbl_products->gramasi->FldCaption() ?></td>
			<td<?php echo $tbl_products->gramasi->CellAttributes() ?>>
<span id="el_tbl_products_gramasi">
<span<?php echo $tbl_products->gramasi->ViewAttributes() ?>>
<?php echo $tbl_products->gramasi->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_products->unit_cost->Visible) { // unit_cost ?>
		<tr id="r_unit_cost">
			<td class="col-sm-2"><?php echo $tbl_products->unit_cost->FldCaption() ?></td>
			<td<?php echo $tbl_products->unit_cost->CellAttributes() ?>>
<span id="el_tbl_products_unit_cost">
<span<?php echo $tbl_products->unit_cost->ViewAttributes() ?>>
<?php echo $tbl_products->unit_cost->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_products->unit_price->Visible) { // unit_price ?>
		<tr id="r_unit_price">
			<td class="col-sm-2"><?php echo $tbl_products->unit_price->FldCaption() ?></td>
			<td<?php echo $tbl_products->unit_price->CellAttributes() ?>>
<span id="el_tbl_products_unit_price">
<span<?php echo $tbl_products->unit_price->ViewAttributes() ?>>
<?php echo $tbl_products->unit_price->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_products->reorder_level->Visible) { // reorder_level ?>
		<tr id="r_reorder_level">
			<td class="col-sm-2"><?php echo $tbl_products->reorder_level->FldCaption() ?></td>
			<td<?php echo $tbl_products->reorder_level->CellAttributes() ?>>
<span id="el_tbl_products_reorder_level">
<span<?php echo $tbl_products->reorder_level->ViewAttributes() ?>>
<?php echo $tbl_products->reorder_level->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_products->discontinued->Visible) { // discontinued ?>
		<tr id="r_discontinued">
			<td class="col-sm-2"><?php echo $tbl_products->discontinued->FldCaption() ?></td>
			<td<?php echo $tbl_products->discontinued->CellAttributes() ?>>
<span id="el_tbl_products_discontinued">
<span<?php echo $tbl_products->discontinued->ViewAttributes() ?>>
<?php if (ew_ConvertToBool($tbl_products->discontinued->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $tbl_products->discontinued->ListViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $tbl_products->discontinued->ListViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
