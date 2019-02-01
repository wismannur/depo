// Write your table-specific startup script here
// document.write("page loaded");
$(document).ready(function(){

	function inputWithCommas(){
        let jumlahField = totalField('#tbl_tr_pb_itemgrid')
		for(let i = 0; i < jumlahField; i++){
            let checkDataIndex = $('#tbl_tr_pb_itemgrid').find('tbody tr').eq(i).attr('data-rowindex')
            let item_qty_list = $('#tbl_tr_pb_itemgrid').find('tbody > tr').eq(i).find('td').eq(4).find('span > input')
            item_qty_list.css({'text-align': 'right'})
            if (checkDataIndex > 0) {
                item_qty_list.on('keyup', function(){
                    let getDataQty = $(this).val().split(',').join('')
                    let hasil = numberWithCommas(getDataQty)
                    $(this).val(hasil)
                });
            }
        }
	};
	
	$('.ewAddEdit').on('click', function(){
		setTimeout(function(){
			inputWithCommas()
			responsiveWidthTable()
		}, 1000)
    })
    
    inputWithCommas()

    // this is for add button print in page edit po_master
    if (urlLink.slice(-4) == "edit") {
        $('<div class="btn btn-success btn-print ewButton" name="btnPrint" id="btnPrint"><i class="fa fa-print" aria-hidden="true"></i> Print</div>').insertAfter('div.form-group')
       
        $('div#btnPrint').on('click', function() {
            let result = getDataUrl('pb_id') 
            // alert('INV ID nya adalah = '+ result)
			window.location.replace(URL + 'phpcetak/tr_pb_master_cetak.php?pb_id=' + result  + '&kode_depo=' + localStorage.kode_depo )
        })
    };
});