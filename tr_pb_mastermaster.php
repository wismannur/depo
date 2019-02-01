<?php

// pb_number
// pb_date
// kode_depo
// pb_notes

?>
<?php if ($tr_pb_master->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_tr_pb_mastermaster" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($tr_pb_master->pb_number->Visible) { // pb_number ?>
		<tr id="r_pb_number">
			<td class="col-sm-2"><script id="tpc_tr_pb_master_pb_number" class="tr_pb_mastermaster" type="text/html"><span><?php echo $tr_pb_master->pb_number->FldCaption() ?></span></script></td>
			<td<?php echo $tr_pb_master->pb_number->CellAttributes() ?>>
<script id="tpx_tr_pb_master_pb_number" class="tr_pb_mastermaster" type="text/html">
<span id="el_tr_pb_master_pb_number">
<span<?php echo $tr_pb_master->pb_number->ViewAttributes() ?>>
<?php echo $tr_pb_master->pb_number->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_pb_master->pb_date->Visible) { // pb_date ?>
		<tr id="r_pb_date">
			<td class="col-sm-2"><script id="tpc_tr_pb_master_pb_date" class="tr_pb_mastermaster" type="text/html"><span><?php echo $tr_pb_master->pb_date->FldCaption() ?></span></script></td>
			<td<?php echo $tr_pb_master->pb_date->CellAttributes() ?>>
<script id="tpx_tr_pb_master_pb_date" class="tr_pb_mastermaster" type="text/html">
<span id="el_tr_pb_master_pb_date">
<span<?php echo $tr_pb_master->pb_date->ViewAttributes() ?>>
<?php echo $tr_pb_master->pb_date->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_pb_master->kode_depo->Visible) { // kode_depo ?>
		<tr id="r_kode_depo">
			<td class="col-sm-2"><script id="tpc_tr_pb_master_kode_depo" class="tr_pb_mastermaster" type="text/html"><span><?php echo $tr_pb_master->kode_depo->FldCaption() ?></span></script></td>
			<td<?php echo $tr_pb_master->kode_depo->CellAttributes() ?>>
<script id="tpx_tr_pb_master_kode_depo" class="tr_pb_mastermaster" type="text/html">
<span id="el_tr_pb_master_kode_depo">
<span<?php echo $tr_pb_master->kode_depo->ViewAttributes() ?>>
<?php echo $tr_pb_master->kode_depo->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_pb_master->pb_notes->Visible) { // pb_notes ?>
		<tr id="r_pb_notes">
			<td class="col-sm-2"><script id="tpc_tr_pb_master_pb_notes" class="tr_pb_mastermaster" type="text/html"><span><?php echo $tr_pb_master->pb_notes->FldCaption() ?></span></script></td>
			<td<?php echo $tr_pb_master->pb_notes->CellAttributes() ?>>
<script id="tpx_tr_pb_master_pb_notes" class="tr_pb_mastermaster" type="text/html">
<span id="el_tr_pb_master_pb_notes">
<span<?php echo $tr_pb_master->pb_notes->ViewAttributes() ?>>
<?php echo $tr_pb_master->pb_notes->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_tr_pb_mastermaster" class="ewCustomTemplate"></div>
<script id="tpm_tr_pb_mastermaster" type="text/html">
<div id="ct_tr_pb_master_master"><div class="col-sm-12 panel-custom" style="">
	<div class="col-sm-3">
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_pb_master->pb_number->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_pb_master_pb_number"/}}</div>
		</div>
	</div>
	<div class="custom-width-pbmaster-1">
		<div class="row field-br">
			<div class="col-sm-3 tittle"><?php echo $tr_pb_master->pb_date->FldCaption() ?></div>
			<div class="col-sm-9">{{include tmpl="#tpx_tr_pb_master_pb_date"/}}</div>
		</div>
	</div>
	<div class="custom-width-pbmaster-2">
		<div class="row field-br">
			<div class="col-sm-2 tittle"><?php echo $tr_pb_master->pb_notes->FldCaption() ?></div>
			<div class="col-sm-10">{{include tmpl="#tpx_tr_pb_master_pb_notes"/}}</div>
		</div>
	</div>
</div>
<div class="row field-br" style="display: none;">
	<div class="col-sm-3 tittle"><?php echo $tr_pb_master->kode_depo->FldCaption() ?></div>
	<div class="col-sm-9">{{include tmpl="#tpx_tr_pb_master_kode_depo"/}}</div>
</div>
</div>
</script>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($tr_pb_master->Rows) ?> };
ew_ApplyTemplate("tpd_tr_pb_mastermaster", "tpm_tr_pb_mastermaster", "tr_pb_mastermaster", "<?php echo $tr_pb_master->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.tr_pb_mastermaster_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
