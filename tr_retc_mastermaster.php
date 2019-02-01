<?php

// retc_number
// retc_date
// sjc_number
// retc_notes
// sales_id

?>
<?php if ($tr_retc_master->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_tr_retc_mastermaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($tr_retc_master->retc_number->Visible) { // retc_number ?>
		<tr id="r_retc_number">
			<td class="col-sm-2"><?php echo $tr_retc_master->retc_number->FldCaption() ?></td>
			<td<?php echo $tr_retc_master->retc_number->CellAttributes() ?>>
<span id="el_tr_retc_master_retc_number">
<span<?php echo $tr_retc_master->retc_number->ViewAttributes() ?>>
<?php echo $tr_retc_master->retc_number->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tr_retc_master->retc_date->Visible) { // retc_date ?>
		<tr id="r_retc_date">
			<td class="col-sm-2"><?php echo $tr_retc_master->retc_date->FldCaption() ?></td>
			<td<?php echo $tr_retc_master->retc_date->CellAttributes() ?>>
<span id="el_tr_retc_master_retc_date">
<span<?php echo $tr_retc_master->retc_date->ViewAttributes() ?>>
<?php echo $tr_retc_master->retc_date->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tr_retc_master->sjc_number->Visible) { // sjc_number ?>
		<tr id="r_sjc_number">
			<td class="col-sm-2"><?php echo $tr_retc_master->sjc_number->FldCaption() ?></td>
			<td<?php echo $tr_retc_master->sjc_number->CellAttributes() ?>>
<span id="el_tr_retc_master_sjc_number">
<span<?php echo $tr_retc_master->sjc_number->ViewAttributes() ?>>
<?php echo $tr_retc_master->sjc_number->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tr_retc_master->retc_notes->Visible) { // retc_notes ?>
		<tr id="r_retc_notes">
			<td class="col-sm-2"><?php echo $tr_retc_master->retc_notes->FldCaption() ?></td>
			<td<?php echo $tr_retc_master->retc_notes->CellAttributes() ?>>
<span id="el_tr_retc_master_retc_notes">
<span<?php echo $tr_retc_master->retc_notes->ViewAttributes() ?>>
<?php echo $tr_retc_master->retc_notes->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tr_retc_master->sales_id->Visible) { // sales_id ?>
		<tr id="r_sales_id">
			<td class="col-sm-2"><?php echo $tr_retc_master->sales_id->FldCaption() ?></td>
			<td<?php echo $tr_retc_master->sales_id->CellAttributes() ?>>
<span id="el_tr_retc_master_sales_id">
<span<?php echo $tr_retc_master->sales_id->ViewAttributes() ?>>
<?php echo $tr_retc_master->sales_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
