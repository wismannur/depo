<?php

// sjc_number
// sjc_date
// sales_id
// sjc_notes

?>
<?php if ($tr_sjc_master->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_tr_sjc_mastermaster" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($tr_sjc_master->sjc_number->Visible) { // sjc_number ?>
		<tr id="r_sjc_number">
			<td class="col-sm-2"><script id="tpc_tr_sjc_master_sjc_number" class="tr_sjc_mastermaster" type="text/html"><span><?php echo $tr_sjc_master->sjc_number->FldCaption() ?></span></script></td>
			<td<?php echo $tr_sjc_master->sjc_number->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_sjc_number" class="tr_sjc_mastermaster" type="text/html">
<span id="el_tr_sjc_master_sjc_number">
<span<?php echo $tr_sjc_master->sjc_number->ViewAttributes() ?>>
<?php echo $tr_sjc_master->sjc_number->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_sjc_master->sjc_date->Visible) { // sjc_date ?>
		<tr id="r_sjc_date">
			<td class="col-sm-2"><script id="tpc_tr_sjc_master_sjc_date" class="tr_sjc_mastermaster" type="text/html"><span><?php echo $tr_sjc_master->sjc_date->FldCaption() ?></span></script></td>
			<td<?php echo $tr_sjc_master->sjc_date->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_sjc_date" class="tr_sjc_mastermaster" type="text/html">
<span id="el_tr_sjc_master_sjc_date">
<span<?php echo $tr_sjc_master->sjc_date->ViewAttributes() ?>>
<?php echo $tr_sjc_master->sjc_date->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_sjc_master->sales_id->Visible) { // sales_id ?>
		<tr id="r_sales_id">
			<td class="col-sm-2"><script id="tpc_tr_sjc_master_sales_id" class="tr_sjc_mastermaster" type="text/html"><span><?php echo $tr_sjc_master->sales_id->FldCaption() ?></span></script></td>
			<td<?php echo $tr_sjc_master->sales_id->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_sales_id" class="tr_sjc_mastermaster" type="text/html">
<span id="el_tr_sjc_master_sales_id">
<span<?php echo $tr_sjc_master->sales_id->ViewAttributes() ?>>
<?php echo $tr_sjc_master->sales_id->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_sjc_master->sjc_notes->Visible) { // sjc_notes ?>
		<tr id="r_sjc_notes">
			<td class="col-sm-2"><script id="tpc_tr_sjc_master_sjc_notes" class="tr_sjc_mastermaster" type="text/html"><span><?php echo $tr_sjc_master->sjc_notes->FldCaption() ?></span></script></td>
			<td<?php echo $tr_sjc_master->sjc_notes->CellAttributes() ?>>
<script id="tpx_tr_sjc_master_sjc_notes" class="tr_sjc_mastermaster" type="text/html">
<span id="el_tr_sjc_master_sjc_notes">
<span<?php echo $tr_sjc_master->sjc_notes->ViewAttributes() ?>>
<?php echo $tr_sjc_master->sjc_notes->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_tr_sjc_mastermaster" class="ewCustomTemplate"></div>
<script id="tpm_tr_sjc_mastermaster" type="text/html">
<div id="ct_tr_sjc_master_master"><div class="col-sm-12 panel-custom" style="">
	<div class="col-sm-5">
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_sjc_master->sjc_number->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_sjc_master_sjc_number"/}}</div>
		</div>
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_sjc_master->sales_id->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_sjc_master_sales_id"/}}</div>
		</div>
	</div>
	<div class="col-sm-7">
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_sjc_master->sjc_date->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_sjc_master_sjc_date"/}}</div>
		</div>
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_sjc_master->sjc_notes->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_sjc_master_sjc_notes"/}}</div>
		</div>
	</div>
</div>
</div>
</script>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($tr_sjc_master->Rows) ?> };
ew_ApplyTemplate("tpd_tr_sjc_mastermaster", "tpm_tr_sjc_mastermaster", "tr_sjc_mastermaster", "<?php echo $tr_sjc_master->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.tr_sjc_mastermaster_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
