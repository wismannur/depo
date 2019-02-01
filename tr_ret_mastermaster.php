<?php

// ret_number
// ret_date
// customer_id
// ret_amt
// disc_total
// ret_total

?>
<?php if ($tr_ret_master->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_tr_ret_mastermaster" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($tr_ret_master->ret_number->Visible) { // ret_number ?>
		<tr id="r_ret_number">
			<td class="col-sm-2"><script id="tpc_tr_ret_master_ret_number" class="tr_ret_mastermaster" type="text/html"><span><?php echo $tr_ret_master->ret_number->FldCaption() ?></span></script></td>
			<td<?php echo $tr_ret_master->ret_number->CellAttributes() ?>>
<script id="tpx_tr_ret_master_ret_number" class="tr_ret_mastermaster" type="text/html">
<span id="el_tr_ret_master_ret_number">
<span<?php echo $tr_ret_master->ret_number->ViewAttributes() ?>>
<?php echo $tr_ret_master->ret_number->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_ret_master->ret_date->Visible) { // ret_date ?>
		<tr id="r_ret_date">
			<td class="col-sm-2"><script id="tpc_tr_ret_master_ret_date" class="tr_ret_mastermaster" type="text/html"><span><?php echo $tr_ret_master->ret_date->FldCaption() ?></span></script></td>
			<td<?php echo $tr_ret_master->ret_date->CellAttributes() ?>>
<script id="tpx_tr_ret_master_ret_date" class="tr_ret_mastermaster" type="text/html">
<span id="el_tr_ret_master_ret_date">
<span<?php echo $tr_ret_master->ret_date->ViewAttributes() ?>>
<?php echo $tr_ret_master->ret_date->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_ret_master->customer_id->Visible) { // customer_id ?>
		<tr id="r_customer_id">
			<td class="col-sm-2"><script id="tpc_tr_ret_master_customer_id" class="tr_ret_mastermaster" type="text/html"><span><?php echo $tr_ret_master->customer_id->FldCaption() ?></span></script></td>
			<td<?php echo $tr_ret_master->customer_id->CellAttributes() ?>>
<script id="tpx_tr_ret_master_customer_id" class="tr_ret_mastermaster" type="text/html">
<span id="el_tr_ret_master_customer_id">
<span<?php echo $tr_ret_master->customer_id->ViewAttributes() ?>>
<?php echo $tr_ret_master->customer_id->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_ret_master->ret_amt->Visible) { // ret_amt ?>
		<tr id="r_ret_amt">
			<td class="col-sm-2"><script id="tpc_tr_ret_master_ret_amt" class="tr_ret_mastermaster" type="text/html"><span><?php echo $tr_ret_master->ret_amt->FldCaption() ?></span></script></td>
			<td<?php echo $tr_ret_master->ret_amt->CellAttributes() ?>>
<script id="tpx_tr_ret_master_ret_amt" class="tr_ret_mastermaster" type="text/html">
<span id="el_tr_ret_master_ret_amt">
<span<?php echo $tr_ret_master->ret_amt->ViewAttributes() ?>>
<?php echo $tr_ret_master->ret_amt->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_ret_master->disc_total->Visible) { // disc_total ?>
		<tr id="r_disc_total">
			<td class="col-sm-2"><script id="tpc_tr_ret_master_disc_total" class="tr_ret_mastermaster" type="text/html"><span><?php echo $tr_ret_master->disc_total->FldCaption() ?></span></script></td>
			<td<?php echo $tr_ret_master->disc_total->CellAttributes() ?>>
<script id="tpx_tr_ret_master_disc_total" class="tr_ret_mastermaster" type="text/html">
<span id="el_tr_ret_master_disc_total">
<span<?php echo $tr_ret_master->disc_total->ViewAttributes() ?>>
<?php echo $tr_ret_master->disc_total->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_ret_master->ret_total->Visible) { // ret_total ?>
		<tr id="r_ret_total">
			<td class="col-sm-2"><script id="tpc_tr_ret_master_ret_total" class="tr_ret_mastermaster" type="text/html"><span><?php echo $tr_ret_master->ret_total->FldCaption() ?></span></script></td>
			<td<?php echo $tr_ret_master->ret_total->CellAttributes() ?>>
<script id="tpx_tr_ret_master_ret_total" class="tr_ret_mastermaster" type="text/html">
<span id="el_tr_ret_master_ret_total">
<span<?php echo $tr_ret_master->ret_total->ViewAttributes() ?>>
<?php echo $tr_ret_master->ret_total->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_tr_ret_mastermaster" class="ewCustomTemplate"></div>
<script id="tpm_tr_ret_mastermaster" type="text/html">
<div id="ct_tr_ret_master_master"><div class="col-sm-12 panel-custom" style="">
	<div class="row">
		<div class="col-sm-5 order-1">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_ret_master->ret_number->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_ret_master_ret_number"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_ret_master->ret_date->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_ret_master_ret_date"/}}</div>
			</div>
		 	<!-- <div class="row field-br">
				<div class="col-sm-3 tittle">{{include tmpl="#tpcaption_due_date"/}}</div>
				<div class="col-sm-9">{{include tmpl="#tpx_due_date"/}}</div>
			</div> -->
		</div>
		<div class="col-sm-7 order-2">
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_ret_master->customer_id->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_ret_master_customer_id"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_ret_master->address1->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_ret_master_address1"/}}</div>
			</div>
			<div class="row field-br">
				<div class="col-sm-3 tittle"><?php echo $tr_ret_master->address2->FldCaption() ?></div>
				<div class="col-sm-9">{{include tmpl="#tpx_tr_ret_master_address2"/}}</div>
			</div>
		</div>
	</div>
</div>
<br>
<!--- batas -->
<div class="col-sm-12 panel-custom" style="">
	<div class="row">
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-4 tittle"> <?php echo $tr_ret_master->ret_amt->FldCaption() ?> </div>
				<div class="col-sm-8"> {{include tmpl="#tpx_tr_ret_master_ret_amt"/}} </div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-4 tittle"> <?php echo $tr_ret_master->disc_total->FldCaption() ?> </div>
				<div class="col-sm-8"> {{include tmpl="#tpx_tr_ret_master_disc_total"/}} </div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-4 tittle"> <?php echo $tr_ret_master->ret_total->FldCaption() ?> </div>
				<div class="col-sm-8"> {{include tmpl="#tpx_tr_ret_master_ret_total"/}} </div>
			</div>
		</div>
	</div>
</div>
</div>
</script>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($tr_ret_master->Rows) ?> };
ew_ApplyTemplate("tpd_tr_ret_mastermaster", "tpm_tr_ret_mastermaster", "tr_ret_mastermaster", "<?php echo $tr_ret_master->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.tr_ret_mastermaster_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
