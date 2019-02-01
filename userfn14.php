<?php

// Global user functions
// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

function GetNamaDepo($par_kode_depo) {
	$namadepo = ew_ExecuteScalar("SELECT nama_depo FROM db_inventory_pusat.tbl_depo WHERE kode_depo = '".$par_kode_depo."'");
	return $namadepo;
}

function GetNextInvNumber() {
	$sNextCode = "";
	$sLastCode = "";
	$sKey = "FD" . @$_SESSION["KodeDepo"].substr(date("Y"),2,2);
	$value = ew_ExecuteScalar("SELECT MAX(SUBSTR(inv_number,7,6)) FROM tr_inv_master WHERE SUBSTR(inv_number,1,6) = '".$sKey."'");
	if ($value != "") {
		$sLastCode = intval($value) + 1;  

		//$sLastCode = intval($sLastCode) + 1;  
		$sNextCode = $sKey .sprintf('%006s', $sLastCode);  
	} else {  
		$sNextCode = $sKey . "000001";
	}
	return $sNextCode;
}

function GetNextInvCanvasNumber() {
	$sNextCode = "";
	$sLastCode = "";
	$sKey = "FC" . @$_SESSION["KodeDepo"].substr(date("Y"),2,2);
	$value = ew_ExecuteScalar("SELECT MAX(SUBSTR(inv_number,7,6)) FROM tr_inv_canvas_master WHERE SUBSTR(inv_number,1,6) = '".$sKey."'");
	if ($value != "") {
		$sLastCode = intval($value) + 1;  

		//$sLastCode = intval($sLastCode) + 1;  
		$sNextCode = $sKey .sprintf('%006s', $sLastCode);  
	} else {  
		$sNextCode = $sKey . "000001";
	}
	return $sNextCode;
}

function GetNextPbNumber() {
	$sNextCode = "";
	$sLastCode = "";
	$sKey = "PB" . @$_SESSION["KodeDepo"].substr(date("Y"),2,2);
	$value = ew_ExecuteScalar("SELECT MAX(SUBSTR(pb_number,7,6)) FROM tr_pb_master WHERE SUBSTR(pb_number,1,6) = '".$sKey."'");
	if ($value != "") {
		$sLastCode = intval($value) + 1;  

		//$sLastCode = intval($sLastCode) + 1;  
		$sNextCode = $sKey .sprintf('%006s', $sLastCode);  
	} else {  
		$sNextCode = $sKey . "000001";
	}
	return $sNextCode;
}

function GetNextRetcNumber() {
	$sNextCode = "";
	$sLastCode = "";
	$sKey = "RO" . @$_SESSION["KodeDepo"].substr(date("Y"),2,2);
	$value = ew_ExecuteScalar("SELECT MAX(SUBSTR(retc_number,7,6)) FROM tr_retc_master WHERE SUBSTR(retc_number,1,6) = '".$sKey."'");
	if ($value != "") {
		$sLastCode = intval($value) + 1;  

		//$sLastCode = intval($sLastCode) + 1;  
		$sNextCode = $sKey .sprintf('%006s', $sLastCode);  
	} else {  
		$sNextCode = $sKey . "000001";
	}
	return $sNextCode;
}

function GetNextRetpNumber() {
	$sNextCode = "";
	$sLastCode = "";
	$sKey = "RU" . @$_SESSION["KodeDepo"].substr(date("Y"),2,2);
	$value = ew_ExecuteScalar("SELECT MAX(SUBSTR(retp_number,7,6)) FROM tr_retp_master WHERE SUBSTR(retp_number,1,6) = '".$sKey."'");
	if ($value != "") {
		$sLastCode = intval($value) + 1;  

		//$sLastCode = intval($sLastCode) + 1;  
		$sNextCode = $sKey .sprintf('%006s', $sLastCode);  
	} else {  
		$sNextCode = $sKey . "000001";
	}
	return $sNextCode;
}

function GetNextSjcNumber() {
	$sNextCode = "";
	$sLastCode = "";
	$sKey = "SJ" . @$_SESSION["KodeDepo"].substr(date("Y"),2,2);
	$value = ew_ExecuteScalar("SELECT MAX(SUBSTR(sjc_number,7,6)) FROM tr_sjc_master WHERE SUBSTR(sjc_number,1,6) = '".$sKey."'");
	if ($value != "") {
		$sLastCode = intval($value) + 1;  

		//$sLastCode = intval($sLastCode) + 1;  
		$sNextCode = $sKey .sprintf('%006s', $sLastCode);  
	} else {  
		$sNextCode = $sKey . "000001";
	}
	return $sNextCode;
}

function GetNextRetNumber() {
	$sNextCode = "";
	$sLastCode = "";
	$sKey = "RP" . @$_SESSION["KodeDepo"].substr(date("Y"),2,2);
	$value = ew_ExecuteScalar("SELECT MAX(SUBSTR(ret_number,7,6)) FROM tr_ret_master WHERE SUBSTR(ret_number,1,6) = '".$sKey."'");
	if ($value != "") {
		$sLastCode = intval($value) + 1;  

		//$sLastCode = intval($sLastCode) + 1;  
		$sNextCode = $sKey .sprintf('%006s', $sLastCode);  
	} else {  
		$sNextCode = $sKey . "000001";
	}
	return $sNextCode;
}

function GetNextkmNumber() {
	$sNextCode = "";
	$sLastCode = "";
	$sKey = "KR" . @$_SESSION["KodeDepo"].substr(date("Y"),2,2);
	$value = ew_ExecuteScalar("SELECT MAX(SUBSTR(km_nomor,7,6)) FROM tr_km_master_ar WHERE SUBSTR(km_nomor,1,6) = '".$sKey."'");
	if ($value != "") {
		$sLastCode = intval($value) + 1;  

		//$sLastCode = intval($sLastCode) + 1;  
		$sNextCode = $sKey .sprintf('%006s', $sLastCode);  
	} else {  
		$sNextCode = $sKey . "000001";
	}
	return $sNextCode;
}

function GetNextkm2Number() {
	$sNextCode = "";
	$sLastCode = "";
	$sKey = "KC" . @$_SESSION["KodeDepo"].substr(date("Y"),2,2);
	$value = ew_ExecuteScalar("SELECT MAX(SUBSTR(km_nomor,7,6)) FROM tr_km_master_ar2 WHERE SUBSTR(km_nomor,1,6) = '".$sKey."'");
	if ($value != "") {
		$sLastCode = intval($value) + 1;  

		//$sLastCode = intval($sLastCode) + 1;  
		$sNextCode = $sKey .sprintf('%006s', $sLastCode);  
	} else {  
		$sNextCode = $sKey . "000001";
	}
	return $sNextCode;
}
?>
