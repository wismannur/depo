// Write your table-specific startup script here
// document.write("page loaded");
$(document).ready(function(){
    var item_amt = $('[data-field="x_item_amt"]')
	var disc_total = $('[data-field="x_disc_total"]')
	var ret_amt = $('[data-field="x_ret_amt"]')
	var ret_total = $('[data-field="x_ret_total"]')
	var is_bs = $('[data-field="x_is_bs"]')
	
	item_amt.addClass('form-disabled').attr('readonly', true);
	ret_amt.addClass('form-disabled').attr('readonly', true).css({'text-align': 'right'});
	ret_total.addClass('form-disabled').attr('readonly', true).css({'text-align': 'right'});
	disc_total.css({'text-align': 'right'});
    is_bs.addClass('form-checkbox')

    // this is for change width list table detail column is BS
    $('[data-name="is_bs"]').css({'width': '35px'})

    // this is for calculate field Total
	function countTotal() {
		var result = ret_amt.val().split(',').join('') - disc_total.val().split(',').join('')
		var hasil = numberWithCommas(result)
		ret_total.val(hasil)
    };
    
	disc_total.on('keyup', function(){
		countTotal()
		
		var getDataDisc_total = disc_total.val().split(',').join('')
		var hasil = numberWithCommas(getDataDisc_total)
		disc_total.val(hasil)
	});
    
	//this is for calculate jumlah in table detail
	function result(eq) {
		let item_qty = $('#tbl_tr_ret_itemgrid').find('tbody tr').eq(eq).find('td').eq(4).find('input').eq(0).val()
		let item_price = $('#tbl_tr_ret_itemgrid').find('tbody tr').eq(eq).find('td').eq(5).find('input').eq(0).val()
		let item_disc = $('#tbl_tr_ret_itemgrid').find('tbody tr').eq(eq).find('td').eq(6).find('input').eq(0).val()
		var item_amt = $('#tbl_tr_ret_itemgrid').find('tbody tr').eq(eq).find('td').eq(7).find('input').eq(0)

		// console.log('hasil item_qty = ' + item_qty + ' + ' + eq)
		if( item_qty && item_price && item_disc !== 0 || "" ){
			let qty = item_qty.split(',').join('')
			let price = item_price.split(',').join('')
			let disc = item_disc.split(',').join('')
			
			var hitungDisc = ((price * disc) / 100)
			var result = qty * (price - hitungDisc)
			var hasil = numberWithCommas(result)
			item_amt.val(hasil)
			console.log('ini hasilnya = ' + hasil)
		}

	};

	// this is for calculate subTotal
	function countSubTotal() {
		let jumlahField = totalField('#tbl_tr_ret_itemgrid')
		var countSubTotal = 0;
		
		for (let i = 0; i < jumlahField; i++) {
			let checkDataIndex = $('#tbl_tr_ret_itemgrid').find('tbody tr').eq(i).attr('data-rowindex')
			let item_amt = $('#tbl_tr_ret_itemgrid').find('tbody tr').eq(i).find('td').eq(7).find('input').eq(0)
			// console.log(i + ' + ' + checkDataIndex + ' + ' + item_amt.val())
			if ( checkDataIndex > 0 && item_amt.val() != "") {
				let getDataItem_amt = item_amt.val().split(',').join('')
				countSubTotal = parseInt(countSubTotal) + parseInt(getDataItem_amt);
				// console.log('hasil = ' + countSubTotal + ' + ' + getDataItem_amt)
			} else {
				// console.log('hasil tidak di eksekusi')
			}
		};
		var hasil = numberWithCommas(countSubTotal)
		ret_amt.val(hasil)
		countTotal()
    };
    
	// this is for count total row in table detail
	function calculateRow(){
		let jumlahField = totalField('#tbl_tr_ret_itemgrid')
		for(let i = 0; i < jumlahField; i++){
            let checkDataIndex = $('#tbl_tr_ret_itemgrid').find('tbody tr').eq(i).attr('data-rowindex')
            let item_id_list = $('#tbl_tr_ret_itemgrid').find('tbody tr').eq(i).find('td').eq(1).find('span > span > span').find('input').eq(1)
			let item_qty_list = $('#tbl_tr_ret_itemgrid').find('tbody tr').eq(i).find('td').eq(4).find('input').eq(0)
			let item_price_list = $('#tbl_tr_ret_itemgrid').find('tbody tr').eq(i).find('td').eq(5).find('input').eq(0)
            let item_disc_list = $('#tbl_tr_ret_itemgrid').find('tbody tr').eq(i).find('td').eq(6).find('input').eq(0)
			if (checkDataIndex > 0) {
                // this is for change align input to align right
                for (let j = 4; j < 8; j++) {
                    $('#tbl_tr_ret_itemgrid').find('tbody tr').eq(i).find('td').eq(j).find('input').eq(0).css({'text-align': 'right'})
                };
                // console.log('eksekusi = ' + checkDataIndex + '+ i =' + i)
                
                item_id_list.on('change', function() {
                    item_qty_list.val() == "" ? item_qty_list.val(1) : '' ;
                    item_price_list.val() == "" ? item_price_list.val(10,000) : '' ;
                    item_disc_list.val() == "" ? item_disc_list.val(0) : '' ;
                    result(i)
                    countSubTotal()
                    countTotal()
                })

				item_qty_list.on('keyup', function() {
					result(i)
					countSubTotal()
                    countTotal()
	
					var getDataQty = item_qty_list.val().split(',').join('')
					var hasil = numberWithCommas(getDataQty)
					item_qty_list.val(hasil)
				});
	
				item_price_list.on('keyup', function() {
					result(i)
					countSubTotal()
                    countTotal()
				
					var getDataPrice = item_price_list.val().split(',').join('')
					var hasil = numberWithCommas(getDataPrice)
					item_price_list.val(hasil)
				});
                
                item_disc_list.attr('maxlength', '2')
				item_disc_list.on('keyup', function() {
					result(i)
					countSubTotal()
                    countTotal()
                    
                    if(item_disc_list.val() > 99) {
                        alert('max discount 99%')
					}
					
					var hasil = numberWithCommas($(this).val())
					$(this).val(hasil)
                });
                
				// this is for count jumlah in list detail
				result(i)
			} else {
				// console.log('NOT eksekusi = ' + checkDataIndex)
			}
		}
		countSubTotal()
	};

    calculateRow()

	$('.ewAddEdit').on('click', function(){
		setTimeout(function(){
            calculateRow()
            responsiveWidthTable()
		}, 1000);
	});
	
	$('.ewGridDelete').on('click', function() {
		$('.modal-footer').eq(2).find('button.btn.btn-primary').on('click', function() {
			setTimeout(function(){
                calculateRow()
			}, 1000);
		});
    });
    
	// this is for add button print in page edit ret_master
	if (urlLink.slice(-4) == "edit") {
		$('<div class="btn btn-success btn-print ewButton" name="btnPrint" id="btnPrint"><i class="fa fa-print" aria-hidden="true"></i> Print</div>').insertAfter('div.form-group')
	   
		$('div#btnPrint').on('click', function() {
			let result = getDataUrl('ret_id') 
			// alert('RET ID nya adalah = '+ result)
			window.location.replace(URL + 'phpcetak/tr_ret_master_cetak.php?ret_id=' + result  + '&kode_depo=' + localStorage.kode_depo )
		})
	};
});