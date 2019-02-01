// Write your table-specific startup script here
// document.write("page loaded");
$(document).ready(function() {
    function calculateRow() {
        let jumlahField = totalField('#tbl_tr_sjd_itemgrid')
        for(let i = 0; i < jumlahField; i++){
            let checkDataIndex = $('#tbl_tr_sjd_itemgrid').find('tbody tr').eq(i).attr('data-rowindex')
            let qty_send = $('#tbl_tr_sjd_itemgrid').find('tbody tr').eq(i).find('td').eq(5).find('span > input')
            let qty_receive = $('#tbl_tr_sjd_itemgrid').find('tbody tr').eq(i).find('td').eq(6).find('span > input')
            let cek_sjd = $('#tbl_tr_sjd_itemgrid').find('tbody tr').eq(i).find('td').eq(7)
            if (checkDataIndex > 0) {
                for (let j = 4; j < 7; j++) {
                    $('#tbl_tr_sjd_itemgrid').find('tbody tr').eq(i).find('td').eq(j).find('span > input').css({'text-align': 'right'})
                }

                cek_sjd.find('span').remove()
                cek_sjd.find('input').remove()
                if (cek_sjd.find('input').length == 0) {
                    cek_sjd.prepend('<input type="checkbox" data-table="tr_sjd_item" class="form-checkbox" data-field="x_cek_sjd" name="x1_cek_sjd[]" id="" value="">')
                }
                
                if (qty_send.val() != "" && qty_receive.val() != "") {
                    if (qty_send.val() == qty_receive.val()) {
                        cek_sjd.find('input').attr('checked', true)
                    }
                } 

                cek_sjd.find('input').on('click', function() {
                    if ($(this).prop('checked') == true) {
                        let hasil = qty_send.val()
                        qty_receive.val(hasil)
                    } else {
                        qty_receive.val("")
                    }
                })

                qty_send.on('keyup', function() {
                    let dataQty_send = $(this).val().split(',').join('')
                    let hasil = numberWithCommas(dataQty_send)
                    $(this).val(hasil)
                })

                qty_receive.on('keyup', function() {
                    let dataQty_receive = $(this).val().split(',').join('')
                    let hasil = numberWithCommas(dataQty_receive)
                    $(this).val(hasil)
                })

                
            }
        }
    }
    
    calculateRow()

    $('.ewAddEdit').on('click', function() {
        setTimeout(function(){
            calculateRow()
            responsiveWidthTable()
		}, 1000);
    })

});