<?php

// sjd_number
// sjd_date
// rcv_date
// sjd_notes
// pb_no

?>
<?php if ($tr_sjd_master->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_tr_sjd_mastermaster" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($tr_sjd_master->sjd_number->Visible) { // sjd_number ?>
		<tr id="r_sjd_number">
			<td class="col-sm-2"><script id="tpc_tr_sjd_master_sjd_number" class="tr_sjd_mastermaster" type="text/html"><span><?php echo $tr_sjd_master->sjd_number->FldCaption() ?></span></script></td>
			<td<?php echo $tr_sjd_master->sjd_number->CellAttributes() ?>>
<script id="tpx_tr_sjd_master_sjd_number" class="tr_sjd_mastermaster" type="text/html">
<span id="el_tr_sjd_master_sjd_number">
<span<?php echo $tr_sjd_master->sjd_number->ViewAttributes() ?>>
<?php echo $tr_sjd_master->sjd_number->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_sjd_master->sjd_date->Visible) { // sjd_date ?>
		<tr id="r_sjd_date">
			<td class="col-sm-2"><script id="tpc_tr_sjd_master_sjd_date" class="tr_sjd_mastermaster" type="text/html"><span><?php echo $tr_sjd_master->sjd_date->FldCaption() ?></span></script></td>
			<td<?php echo $tr_sjd_master->sjd_date->CellAttributes() ?>>
<script id="tpx_tr_sjd_master_sjd_date" class="tr_sjd_mastermaster" type="text/html">
<span id="el_tr_sjd_master_sjd_date">
<span<?php echo $tr_sjd_master->sjd_date->ViewAttributes() ?>>
<?php echo $tr_sjd_master->sjd_date->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_sjd_master->rcv_date->Visible) { // rcv_date ?>
		<tr id="r_rcv_date">
			<td class="col-sm-2"><script id="tpc_tr_sjd_master_rcv_date" class="tr_sjd_mastermaster" type="text/html"><span><?php echo $tr_sjd_master->rcv_date->FldCaption() ?></span></script></td>
			<td<?php echo $tr_sjd_master->rcv_date->CellAttributes() ?>>
<script id="tpx_tr_sjd_master_rcv_date" class="tr_sjd_mastermaster" type="text/html">
<span id="el_tr_sjd_master_rcv_date">
<span<?php echo $tr_sjd_master->rcv_date->ViewAttributes() ?>>
<?php echo $tr_sjd_master->rcv_date->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_sjd_master->sjd_notes->Visible) { // sjd_notes ?>
		<tr id="r_sjd_notes">
			<td class="col-sm-2"><script id="tpc_tr_sjd_master_sjd_notes" class="tr_sjd_mastermaster" type="text/html"><span><?php echo $tr_sjd_master->sjd_notes->FldCaption() ?></span></script></td>
			<td<?php echo $tr_sjd_master->sjd_notes->CellAttributes() ?>>
<script id="tpx_tr_sjd_master_sjd_notes" class="tr_sjd_mastermaster" type="text/html">
<span id="el_tr_sjd_master_sjd_notes">
<span<?php echo $tr_sjd_master->sjd_notes->ViewAttributes() ?>>
<?php echo $tr_sjd_master->sjd_notes->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_sjd_master->pb_no->Visible) { // pb_no ?>
		<tr id="r_pb_no">
			<td class="col-sm-2"><script id="tpc_tr_sjd_master_pb_no" class="tr_sjd_mastermaster" type="text/html"><span><?php echo $tr_sjd_master->pb_no->FldCaption() ?></span></script></td>
			<td<?php echo $tr_sjd_master->pb_no->CellAttributes() ?>>
<script id="tpx_tr_sjd_master_pb_no" class="tr_sjd_mastermaster" type="text/html">
<span id="el_tr_sjd_master_pb_no">
<span<?php echo $tr_sjd_master->pb_no->ViewAttributes() ?>>
<?php echo $tr_sjd_master->pb_no->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_tr_sjd_mastermaster" class="ewCustomTemplate"></div>
<script id="tpm_tr_sjd_mastermaster" type="text/html">
<div id="ct_tr_sjd_master_master"><div class="col-sm-12 panel-custom" style="">
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-4">
			<div class="row field-br">
				<div class="col-sm-4 tittle"><?php echo $tr_sjd_master->sjd_number->FldCaption() ?></div>
				<div class="col-sm-8">{{include tmpl="#tpx_tr_sjd_master_sjd_number"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-4 tittle"><?php echo $tr_sjd_master->sjd_date->FldCaption() ?></div>
				<div class="col-sm-8">{{include tmpl="#tpx_tr_sjd_master_sjd_date"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-4 tittle"><?php echo $tr_sjd_master->rcv_date->FldCaption() ?></div>
				<div class="col-sm-8">{{include tmpl="#tpx_tr_sjd_master_rcv_date"/}}</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="row field-br">
				<div class="col-sm-2 tittle"><?php echo $tr_sjd_master->pb_no->FldCaption() ?></div>
				<div class="col-sm-10">{{include tmpl="#tpx_tr_sjd_master_pb_no"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-2 tittle"><?php echo $tr_sjd_master->sjd_notes->FldCaption() ?></div>
				<div class="col-sm-10">{{include tmpl="#tpx_tr_sjd_master_sjd_notes"/}}</div>
			</div>
		</div>
	</div>
</div>
</div>
</script>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($tr_sjd_master->Rows) ?> };
ew_ApplyTemplate("tpd_tr_sjd_mastermaster", "tpm_tr_sjd_mastermaster", "tr_sjd_mastermaster", "<?php echo $tr_sjd_master->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.tr_sjd_mastermaster_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
