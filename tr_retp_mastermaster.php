<?php

// retp_number
// retp_date
// retp_notes

?>
<?php if ($tr_retp_master->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_tr_retp_mastermaster" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($tr_retp_master->retp_number->Visible) { // retp_number ?>
		<tr id="r_retp_number">
			<td class="col-sm-2"><script id="tpc_tr_retp_master_retp_number" class="tr_retp_mastermaster" type="text/html"><span><?php echo $tr_retp_master->retp_number->FldCaption() ?></span></script></td>
			<td<?php echo $tr_retp_master->retp_number->CellAttributes() ?>>
<script id="tpx_tr_retp_master_retp_number" class="tr_retp_mastermaster" type="text/html">
<span id="el_tr_retp_master_retp_number">
<span<?php echo $tr_retp_master->retp_number->ViewAttributes() ?>>
<?php echo $tr_retp_master->retp_number->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_retp_master->retp_date->Visible) { // retp_date ?>
		<tr id="r_retp_date">
			<td class="col-sm-2"><script id="tpc_tr_retp_master_retp_date" class="tr_retp_mastermaster" type="text/html"><span><?php echo $tr_retp_master->retp_date->FldCaption() ?></span></script></td>
			<td<?php echo $tr_retp_master->retp_date->CellAttributes() ?>>
<script id="tpx_tr_retp_master_retp_date" class="tr_retp_mastermaster" type="text/html">
<span id="el_tr_retp_master_retp_date">
<span<?php echo $tr_retp_master->retp_date->ViewAttributes() ?>>
<?php echo $tr_retp_master->retp_date->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_retp_master->retp_notes->Visible) { // retp_notes ?>
		<tr id="r_retp_notes">
			<td class="col-sm-2"><script id="tpc_tr_retp_master_retp_notes" class="tr_retp_mastermaster" type="text/html"><span><?php echo $tr_retp_master->retp_notes->FldCaption() ?></span></script></td>
			<td<?php echo $tr_retp_master->retp_notes->CellAttributes() ?>>
<script id="tpx_tr_retp_master_retp_notes" class="tr_retp_mastermaster" type="text/html">
<span id="el_tr_retp_master_retp_notes">
<span<?php echo $tr_retp_master->retp_notes->ViewAttributes() ?>>
<?php echo $tr_retp_master->retp_notes->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_tr_retp_mastermaster" class="ewCustomTemplate"></div>
<script id="tpm_tr_retp_mastermaster" type="text/html">
<div id="ct_tr_retp_master_master"><div class="col-sm-12 panel-custom" style="">
	<div class="col-sm-5">
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_retp_master->retp_number->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_retp_master_retp_number"/}}</div>
		</div>
		<!-- <div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_retp_master->kode_depo->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_retp_master_kode_depo"/}}</div>
		</div> -->
	</div>
	<div class="col-sm-7">
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_retp_master->retp_date->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_retp_master_retp_date"/}}</div>
		</div>
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_retp_master->retp_notes->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_retp_master_retp_notes"/}}</div>
		</div>
	</div>
</div>
</div>
</script>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($tr_retp_master->Rows) ?> };
ew_ApplyTemplate("tpd_tr_retp_mastermaster", "tpm_tr_retp_mastermaster", "tr_retp_mastermaster", "<?php echo $tr_retp_master->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.tr_retp_mastermaster_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
