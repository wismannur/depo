<?php

// inv_number
// inv_date
// due_date
// customer_id
// area_id
// inv_total
// sales_id
// paid

?>
<?php if ($tr_inv_master->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_tr_inv_mastermaster" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($tr_inv_master->inv_number->Visible) { // inv_number ?>
		<tr id="r_inv_number">
			<td class="col-sm-2"><script id="tpc_tr_inv_master_inv_number" class="tr_inv_mastermaster" type="text/html"><span><?php echo $tr_inv_master->inv_number->FldCaption() ?></span></script></td>
			<td<?php echo $tr_inv_master->inv_number->CellAttributes() ?>>
<script id="tpx_tr_inv_master_inv_number" class="tr_inv_mastermaster" type="text/html">
<span id="el_tr_inv_master_inv_number">
<span<?php echo $tr_inv_master->inv_number->ViewAttributes() ?>>
<?php echo $tr_inv_master->inv_number->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_inv_master->inv_date->Visible) { // inv_date ?>
		<tr id="r_inv_date">
			<td class="col-sm-2"><script id="tpc_tr_inv_master_inv_date" class="tr_inv_mastermaster" type="text/html"><span><?php echo $tr_inv_master->inv_date->FldCaption() ?></span></script></td>
			<td<?php echo $tr_inv_master->inv_date->CellAttributes() ?>>
<script id="tpx_tr_inv_master_inv_date" class="tr_inv_mastermaster" type="text/html">
<span id="el_tr_inv_master_inv_date">
<span<?php echo $tr_inv_master->inv_date->ViewAttributes() ?>>
<?php echo $tr_inv_master->inv_date->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_inv_master->due_date->Visible) { // due_date ?>
		<tr id="r_due_date">
			<td class="col-sm-2"><script id="tpc_tr_inv_master_due_date" class="tr_inv_mastermaster" type="text/html"><span><?php echo $tr_inv_master->due_date->FldCaption() ?></span></script></td>
			<td<?php echo $tr_inv_master->due_date->CellAttributes() ?>>
<script id="tpx_tr_inv_master_due_date" class="tr_inv_mastermaster" type="text/html">
<span id="el_tr_inv_master_due_date">
<span<?php echo $tr_inv_master->due_date->ViewAttributes() ?>>
<?php echo $tr_inv_master->due_date->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_inv_master->customer_id->Visible) { // customer_id ?>
		<tr id="r_customer_id">
			<td class="col-sm-2"><script id="tpc_tr_inv_master_customer_id" class="tr_inv_mastermaster" type="text/html"><span><?php echo $tr_inv_master->customer_id->FldCaption() ?></span></script></td>
			<td<?php echo $tr_inv_master->customer_id->CellAttributes() ?>>
<script id="tpx_tr_inv_master_customer_id" class="tr_inv_mastermaster" type="text/html">
<span id="el_tr_inv_master_customer_id">
<span<?php echo $tr_inv_master->customer_id->ViewAttributes() ?>>
<?php echo $tr_inv_master->customer_id->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_inv_master->area_id->Visible) { // area_id ?>
		<tr id="r_area_id">
			<td class="col-sm-2"><script id="tpc_tr_inv_master_area_id" class="tr_inv_mastermaster" type="text/html"><span><?php echo $tr_inv_master->area_id->FldCaption() ?></span></script></td>
			<td<?php echo $tr_inv_master->area_id->CellAttributes() ?>>
<script id="tpx_tr_inv_master_area_id" class="tr_inv_mastermaster" type="text/html">
<span id="el_tr_inv_master_area_id">
<span<?php echo $tr_inv_master->area_id->ViewAttributes() ?>>
<?php echo $tr_inv_master->area_id->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_inv_master->inv_total->Visible) { // inv_total ?>
		<tr id="r_inv_total">
			<td class="col-sm-2"><script id="tpc_tr_inv_master_inv_total" class="tr_inv_mastermaster" type="text/html"><span><?php echo $tr_inv_master->inv_total->FldCaption() ?></span></script></td>
			<td<?php echo $tr_inv_master->inv_total->CellAttributes() ?>>
<script id="tpx_tr_inv_master_inv_total" class="tr_inv_mastermaster" type="text/html">
<span id="el_tr_inv_master_inv_total">
<span<?php echo $tr_inv_master->inv_total->ViewAttributes() ?>>
<?php echo $tr_inv_master->inv_total->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_inv_master->sales_id->Visible) { // sales_id ?>
		<tr id="r_sales_id">
			<td class="col-sm-2"><script id="tpc_tr_inv_master_sales_id" class="tr_inv_mastermaster" type="text/html"><span><?php echo $tr_inv_master->sales_id->FldCaption() ?></span></script></td>
			<td<?php echo $tr_inv_master->sales_id->CellAttributes() ?>>
<script id="tpx_tr_inv_master_sales_id" class="tr_inv_mastermaster" type="text/html">
<span id="el_tr_inv_master_sales_id">
<span<?php echo $tr_inv_master->sales_id->ViewAttributes() ?>>
<?php echo $tr_inv_master->sales_id->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($tr_inv_master->paid->Visible) { // paid ?>
		<tr id="r_paid">
			<td class="col-sm-2"><script id="tpc_tr_inv_master_paid" class="tr_inv_mastermaster" type="text/html"><span><?php echo $tr_inv_master->paid->FldCaption() ?></span></script></td>
			<td<?php echo $tr_inv_master->paid->CellAttributes() ?>>
<script id="tpx_tr_inv_master_paid" class="tr_inv_mastermaster" type="text/html">
<span id="el_tr_inv_master_paid">
<span<?php echo $tr_inv_master->paid->ViewAttributes() ?>>
<?php if (ew_ConvertToBool($tr_inv_master->paid->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $tr_inv_master->paid->ListViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $tr_inv_master->paid->ListViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_tr_inv_mastermaster" class="ewCustomTemplate"></div>
<script id="tpm_tr_inv_mastermaster" type="text/html">
<div id="ct_tr_inv_master_master"><div class="ewMultiPage"><!-- multi-page -->
	<div class="nav-tabs-custom" id="tr_inv_master_edit"><!-- multi-page .nav-tabs-custom -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_tr_inv_master1" data-toggle="tab" aria-expanded="false">Page 1</a></li>
			<li class=""><a href="#tab_tr_inv_master2" data-toggle="tab" aria-expanded="true">Page 2</a></li>
		</ul>
		<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
			<div class="tab-pane active" id="tab_tr_inv_master1"><!-- multi-page .tab-pane -->
				<div class="row">
					<div class="col-sm-12" style="">
						<div class="col-sm-5">
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->inv_number->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_inv_number"/}}</div>
							</div>
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->tax_type->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_tax_type"/}}</div>
							</div>
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->tax_number->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_tax_number"/}}</div>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->inv_date->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_inv_date"/}}</div>
							</div>
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->customer_id->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_customer_id"/}}</div>
							</div>
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->due_date->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_due_date"/}}</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /multi-page .tab-pane -->
			<div class="tab-pane" id="tab_tr_inv_master2"><!-- multi-page .tab-pane -->
				<div class="row">
					<div class="col-sm-12">
						<div class="col-sm-5">
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->customer_name->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_customer_name"/}}</div>
							</div>
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->address1->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_address1"/}}</div>
							</div>
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->address2->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_address2"/}}</div>
							</div>
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->address3->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_address3"/}}</div>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->tc_number->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_tc_number"/}}</div>
							</div>
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->sales_id->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_sales_id"/}}</div>
							</div>
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->sopir->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_sopir"/}}</div>
							</div>
							<div class="row field-br">
								<div class="col-sm-3 tittle"><?php echo $tr_inv_master->no_mobil->FldCaption() ?></div>
								<div class="col-sm-9">{{include tmpl="#tpx_tr_inv_master_no_mobil"/}}</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /multi-page .tab-pane -->
		</div><!-- /multi-page .nav-tabs-custom .tab-content -->
	</div><!-- /multi-page .nav-tabs-custom -->
</div>
<!--- batas -->
<div class="col-sm-12 panel-custom" style="">
	<div class="row">
		<div class="custom-width-1">
			<div class="row">
				<div class="col-sm-4 tittle"> <?php echo $tr_inv_master->inv_amt->FldCaption() ?> </div>
				<div class="col-sm-8"> {{include tmpl="#tpx_tr_inv_master_inv_amt"/}} </div>
			</div>
		</div>
		<div class="custom-width-2">
			<div class="row">
				<div class="col-sm-4 tittle"> <?php echo $tr_inv_master->total_discount->FldCaption() ?> </div>
				<div class="col-sm-8"> {{include tmpl="#tpx_tr_inv_master_total_discount"/}} </div>
			</div>
		</div>
		<div class="custom-width-3">
			<div class="row">
				<div class="col-sm-7 tittle"> <?php echo $tr_inv_master->is_tax->FldCaption() ?> </div>
				<div class="col-sm-5"> {{include tmpl="#tpx_tr_inv_master_is_tax"/}} </div>
			</div>
		</div>
		<div class="custom-width-4">
			<div class="row">
				<div class="col-sm-3 tittle"> <?php echo $tr_inv_master->inv_total->FldCaption() ?> </div>
				<div class="col-sm-9"> {{include tmpl="#tpx_tr_inv_master_inv_total"/}} </div>
			</div>
		</div>
	</div>
</div>
</div>
</script>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($tr_inv_master->Rows) ?> };
ew_ApplyTemplate("tpd_tr_inv_mastermaster", "tpm_tr_inv_mastermaster", "tr_inv_mastermaster", "<?php echo $tr_inv_master->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.tr_inv_mastermaster_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
