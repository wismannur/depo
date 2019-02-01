<?php

// Menu
$RootMenu = new cMenu("RootMenu", TRUE);
$RootMenu->AddMenuItem(30, "mci_Data_Master", $Language->MenuPhrase("30", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(24, "mi_tbl_products", $Language->MenuPhrase("24", "MenuText"), "tbl_productslist.php", 30, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tbl_products'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(2, "mi_tbl_armada", $Language->MenuPhrase("2", "MenuText"), "tbl_armadalist.php", 30, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tbl_armada'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(3, "mi_tbl_bank", $Language->MenuPhrase("3", "MenuText"), "tbl_banklist.php", 30, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tbl_bank'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(4, "mi_tbl_customer", $Language->MenuPhrase("4", "MenuText"), "tbl_customerlist.php", 30, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tbl_customer'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(5, "mi_tbl_salesman", $Language->MenuPhrase("5", "MenuText"), "tbl_salesmanlist.php", 30, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tbl_salesman'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(31, "mci_Penjualan", $Language->MenuPhrase("31", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(8, "mi_tr_inv_master", $Language->MenuPhrase("8", "MenuText"), "tr_inv_masterlist.php", 31, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tr_inv_master'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(33, "mci_2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d", $Language->MenuPhrase("33", "MenuText"), "", 31, "", TRUE, TRUE, TRUE, "");
$RootMenu->AddMenuItem(69, "mi_tr_ret_master", $Language->MenuPhrase("69", "MenuText"), "tr_ret_masterlist.php", 31, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tr_ret_master'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(34, "mci_2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d", $Language->MenuPhrase("34", "MenuText"), "", 31, "", TRUE, TRUE, TRUE, "");
$RootMenu->AddMenuItem(72, "mi_tr_km_master_ar", $Language->MenuPhrase("72", "MenuText"), "tr_km_master_arlist.php", 31, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tr_km_master_ar'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(112, "mci_Gudang", $Language->MenuPhrase("112", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(9, "mi_tr_pb_master", $Language->MenuPhrase("9", "MenuText"), "tr_pb_masterlist.php", 112, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tr_pb_master'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(36, "mi_tr_sjd_master", $Language->MenuPhrase("36", "MenuText"), "tr_sjd_masterlist.php", 112, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tr_sjd_master'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(12, "mi_tr_sjc_master", $Language->MenuPhrase("12", "MenuText"), "tr_sjc_masterlist.php", 112, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tr_sjc_master'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(10, "mi_tr_retc_master", $Language->MenuPhrase("10", "MenuText"), "tr_retc_masterlist.php", 112, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tr_retc_master'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(11, "mi_tr_retp_master", $Language->MenuPhrase("11", "MenuText"), "tr_retp_masterlist.php", 112, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tr_retp_master'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(66, "mci_Canvas", $Language->MenuPhrase("66", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(7, "mi_tr_inv_canvas_master", $Language->MenuPhrase("7", "MenuText"), "tr_inv_canvas_masterlist.php", 66, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tr_inv_canvas_master'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(113, "mi_tr_km_master_ar2", $Language->MenuPhrase("113", "MenuText"), "tr_km_master_ar2list.php", 66, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}tr_km_master_ar2'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(32, "mci_Security", $Language->MenuPhrase("32", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(1, "mi_employees", $Language->MenuPhrase("1", "MenuText"), "employeeslist.php", 32, "", IsLoggedIn() || AllowListMenu('{810F9B4D-139E-435A-ABF7-3C676CFEC5C5}employees'), FALSE, FALSE, "");
echo $RootMenu->ToScript();
?>
<div class="ewVertical" id="ewMenu"></div>
