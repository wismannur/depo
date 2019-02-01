<?php

// km_nomor
// km_tanggal
// customer_id
// cek_no
// tgl_jt
// km_amt
// km_notes

?>
<?php if ($tr_km_master_ar2->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_tr_km_master_ar2master" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($tr_km_master_ar2->km_nomor->Visible) { // km_nomor ?>
		<tr id="r_km_nomor">
			<td class="col-sm-2"><script id="tpc_tr_km_master_ar2_km_nomor" class="tr_km_master_ar2master" type="text/html"><span><?php echo $tr_km_master_ar2->km_nomor->FldCaption() ?></span></script></td>
			<td<?php echo $tr_km_master_ar2->km_nomor->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar2_km_nomor" class="tr_km_master_ar2master" type="text/html">
<span id="el_tr_km_master_ar2_km_nomor">
<span<?php echo $tr_km_master_ar2->km_nomor->ViewAttributes() ?>>
<?php echo $tr_km_master_ar2->km_nomor->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_km_master_ar2->km_tanggal->Visible) { // km_tanggal ?>
		<tr id="r_km_tanggal">
			<td class="col-sm-2"><script id="tpc_tr_km_master_ar2_km_tanggal" class="tr_km_master_ar2master" type="text/html"><span><?php echo $tr_km_master_ar2->km_tanggal->FldCaption() ?></span></script></td>
			<td<?php echo $tr_km_master_ar2->km_tanggal->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar2_km_tanggal" class="tr_km_master_ar2master" type="text/html">
<span id="el_tr_km_master_ar2_km_tanggal">
<span<?php echo $tr_km_master_ar2->km_tanggal->ViewAttributes() ?>>
<?php echo $tr_km_master_ar2->km_tanggal->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_km_master_ar2->customer_id->Visible) { // customer_id ?>
		<tr id="r_customer_id">
			<td class="col-sm-2"><script id="tpc_tr_km_master_ar2_customer_id" class="tr_km_master_ar2master" type="text/html"><span><?php echo $tr_km_master_ar2->customer_id->FldCaption() ?></span></script></td>
			<td<?php echo $tr_km_master_ar2->customer_id->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar2_customer_id" class="tr_km_master_ar2master" type="text/html">
<span id="el_tr_km_master_ar2_customer_id">
<span<?php echo $tr_km_master_ar2->customer_id->ViewAttributes() ?>>
<?php echo $tr_km_master_ar2->customer_id->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_km_master_ar2->cek_no->Visible) { // cek_no ?>
		<tr id="r_cek_no">
			<td class="col-sm-2"><script id="tpc_tr_km_master_ar2_cek_no" class="tr_km_master_ar2master" type="text/html"><span><?php echo $tr_km_master_ar2->cek_no->FldCaption() ?></span></script></td>
			<td<?php echo $tr_km_master_ar2->cek_no->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar2_cek_no" class="tr_km_master_ar2master" type="text/html">
<span id="el_tr_km_master_ar2_cek_no">
<span<?php echo $tr_km_master_ar2->cek_no->ViewAttributes() ?>>
<?php echo $tr_km_master_ar2->cek_no->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_km_master_ar2->tgl_jt->Visible) { // tgl_jt ?>
		<tr id="r_tgl_jt">
			<td class="col-sm-2"><script id="tpc_tr_km_master_ar2_tgl_jt" class="tr_km_master_ar2master" type="text/html"><span><?php echo $tr_km_master_ar2->tgl_jt->FldCaption() ?></span></script></td>
			<td<?php echo $tr_km_master_ar2->tgl_jt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar2_tgl_jt" class="tr_km_master_ar2master" type="text/html">
<span id="el_tr_km_master_ar2_tgl_jt">
<span<?php echo $tr_km_master_ar2->tgl_jt->ViewAttributes() ?>>
<?php echo $tr_km_master_ar2->tgl_jt->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_km_master_ar2->km_amt->Visible) { // km_amt ?>
		<tr id="r_km_amt">
			<td class="col-sm-2"><script id="tpc_tr_km_master_ar2_km_amt" class="tr_km_master_ar2master" type="text/html"><span><?php echo $tr_km_master_ar2->km_amt->FldCaption() ?></span></script></td>
			<td<?php echo $tr_km_master_ar2->km_amt->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar2_km_amt" class="tr_km_master_ar2master" type="text/html">
<span id="el_tr_km_master_ar2_km_amt">
<span<?php echo $tr_km_master_ar2->km_amt->ViewAttributes() ?>>
<?php echo $tr_km_master_ar2->km_amt->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_km_master_ar2->km_notes->Visible) { // km_notes ?>
		<tr id="r_km_notes">
			<td class="col-sm-2"><script id="tpc_tr_km_master_ar2_km_notes" class="tr_km_master_ar2master" type="text/html"><span><?php echo $tr_km_master_ar2->km_notes->FldCaption() ?></span></script></td>
			<td<?php echo $tr_km_master_ar2->km_notes->CellAttributes() ?>>
<script id="tpx_tr_km_master_ar2_km_notes" class="tr_km_master_ar2master" type="text/html">
<span id="el_tr_km_master_ar2_km_notes">
<span<?php echo $tr_km_master_ar2->km_notes->ViewAttributes() ?>>
<?php echo $tr_km_master_ar2->km_notes->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_tr_km_master_ar2master" class="ewCustomTemplate"></div>
<script id="tpm_tr_km_master_ar2master" type="text/html">
<div id="ct_tr_km_master_ar2_master"><div class="col-sm-12">
	<div class="row">
		<div class="col-sm-5">
			<div class="row field-br">
				<div class="col-sm-2 tittle"><?php echo $tr_km_master_ar2->km_nomor->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_km_nomor"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-2 tittle"><?php echo $tr_km_master_ar2->km_tanggal->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_km_tanggal"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-2 tittle"><?php echo $tr_km_master_ar2->km_acc->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_km_acc"/}}</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-5">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->customer_id->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_customer_id"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->km_notes->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_km_notes"/}}</div>
			</div>
		</div>
	</div>
	<div class="row panel-custom">
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->cek_no->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_cek_no"/}}</div>
			</div>
		</div>
		<div class="col-sm-4 col-sm-offset-1">
			<div class="row">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->tgl_jt->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_tgl_jt"/}}</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="row">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->cek_amt->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_cek_amt"/}}</div>
			</div>
		</div>
	</div>
	<div class="row panel-custom">
		<div class="col-sm-4">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->ret_number1->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_ret_number1"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->ret_number2->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_ret_number2"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->ret_number3->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_ret_number3"/}}</div>
			</div>
		</div>
		<div class="col-sm-3 col-sm-offset-1">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->ret_date1->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_ret_date1"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->ret_date2->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_ret_date2"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->ret_date3->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_ret_date3"/}}</div>
			</div>
		</div>
		<div class="col-sm-3 col-sm-offset-1">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->retur_amt1->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_retur_amt1"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->retur_amt2->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_retur_amt2"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_km_master_ar2->retur_amt3->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_km_master_ar2_retur_amt3"/}}</div>
			</div>
		</div>
	</div>
	<div class="row panel-custom">
		<div class="col-sm-4 ">
			<div class="row field-br">
				<div class="col-sm-4 tittle"><?php echo $tr_km_master_ar2->tunai_amt->FldCaption() ?></div>
				<div class="col-sm-8">{{include tmpl="#tpx_tr_km_master_ar2_tunai_amt"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-4 tittle"><?php echo $tr_km_master_ar2->km_amt->FldCaption() ?></div>
				<div class="col-sm-8">{{include tmpl="#tpx_tr_km_master_ar2_km_amt"/}}</div>
			</div>
		</div>
		<div class="col-sm-5 col-sm-offset-3">
			<div class="row field-br">
				<div class="col-sm-5 tittle"><?php echo $tr_km_master_ar2->dp_amt->FldCaption() ?></div>
				<div class="col-sm-7">{{include tmpl="#tpx_tr_km_master_ar2_dp_amt"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-5 tittle"><?php echo $tr_km_master_ar2->kas_amt->FldCaption() ?></div>
				<div class="col-sm-7">{{include tmpl="#tpx_tr_km_master_ar2_kas_amt"/}}</div>
			</div>
		</div>
	</div>
</div>
</div>
</script>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($tr_km_master_ar2->Rows) ?> };
ew_ApplyTemplate("tpd_tr_km_master_ar2master", "tpm_tr_km_master_ar2master", "tr_km_master_ar2master", "<?php echo $tr_km_master_ar2->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.tr_km_master_ar2master_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
