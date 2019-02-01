// Write your table-specific startup script here
// document.write("page loaded");
$(document).ready(function(){
	var cek_amt = $('[data-field="x_cek_amt"]')
	var retur_amt1 = $('[data-field="x_retur_amt1"]')
	var retur_amt2 = $('[data-field="x_retur_amt2"]')
    var retur_amt3 = $('[data-field="x_retur_amt3"]')
    var tunai_amt = $('[data-field="x_tunai_amt"]')
    var dp_amt = $('[data-field="x_dp_amt"]')
    var km_amt = $('[data-field="x_km_amt"]')
    var kas_amt = $('[data-field="x_kas_amt"]')

    // this below for make text input align right
	cek_amt.css({'text-align': 'right'})
	retur_amt1.css({'text-align': 'right'})
	retur_amt2.css({'text-align': 'right'})
	retur_amt3.css({'text-align': 'right'})
	tunai_amt.css({'text-align': 'right'})
	dp_amt.css({'text-align': 'right'})
	km_amt.css({'text-align': 'right'}).attr('readonly', true);
	kas_amt.css({'text-align': 'right'}).attr('readonly', true);
    
    // this below for count total pembayaran
    function totalPembayaran() {
        var bil0 = cek_amt.val().split(',').join('')
        var bil1 = retur_amt1.val().split(',').join('')
        var bil2 = retur_amt2.val().split(',').join('')
        var bil3 = retur_amt3.val().split(',').join('')
        var bil4 = tunai_amt.val().split(',').join('')
        var bil5 = dp_amt.val().split(',').join('')
    
        var result = 0;
        for (let i = 0; i < 6; i++) {
            var getDataAmt = "bil"+i ;
            if (eval(getDataAmt) != "") {
                result = parseInt(result) + parseInt(eval(getDataAmt))
            }
        }

        let hasil = numberWithCommas(result)
        km_amt.val(hasil)
    }

    cek_amt.on('keyup', function() {
        let dataCek_amt = $(this).val().split(',').join('')
        let hasil = numberWithCommas(dataCek_amt)
        $(this).val(hasil)
        totalPembayaran()
    })

    retur_amt1.on('keyup', function() {
        let dataRetur_amt1 = $(this).val().split(',').join('')
        let hasil = numberWithCommas(dataRetur_amt1)
        $(this).val(hasil)
        totalPembayaran()
    })

    retur_amt2.on('keyup', function() {
        let dataRetur_amt2 = $(this).val().split(',').join('')
        let hasil = numberWithCommas(dataRetur_amt2)
        $(this).val(hasil)
        totalPembayaran()
    })

    retur_amt3.on('keyup', function() {
        let dataRetur_amt3 = $(this).val().split(',').join('')
        let hasil = numberWithCommas(dataRetur_amt3)
        $(this).val(hasil)
        totalPembayaran()
    })

    tunai_amt.on('keyup', function() {
        let dataTunai_amt = $(this).val().split(',').join('')
        let hasil = numberWithCommas(dataTunai_amt)
        $(this).val(hasil)
        totalPembayaran()
    })

    dp_amt.on('keyup', function() {
        let dataDp_amt = $(this).val().split(',').join('')
        let hasil = numberWithCommas(dataDp_amt)
        $(this).val(hasil)
        totalPembayaran()
    })

    function jumlahBayar() {
        let jumlahField = totalField('#tbl_tr_km_item_argrid')
        var countJumlahBayar = 0
        for (let i = 0; i < jumlahField; i++) {
            let checkDataIndex = $('#tbl_tr_km_item_argrid').find('tbody tr').eq(i).attr('data-rowindex')
            let paid_amt = $('#tbl_tr_km_item_argrid').find('tbody > tr').eq(i).find('td').eq(5).find('span > input').eq(0)
            if (checkDataIndex > 0 && paid_amt.val() != "0") {
                let dataPaid_amt = paid_amt.val().split(',').join('')
                countJumlahBayar = countJumlahBayar + parseInt(dataPaid_amt)
            }                       
        }
        let hasil = numberWithCommas(countJumlahBayar)
        kas_amt.val(hasil)
    }

    function calculateRow() {
        let jumlahField = totalField('#tbl_tr_km_item_argrid')
        for (let i = 0; i < jumlahField; i++) {
            let checkDataIndex = $('#tbl_tr_km_item_argrid').find('tbody tr').eq(i).attr('data-rowindex')
            let inv_amt = $('#tbl_tr_km_item_argrid').find('tbody > tr').eq(i).find('td').eq(4).find('span > input').eq(0)
            let paid_amt = $('#tbl_tr_km_item_argrid').find('tbody > tr').eq(i).find('td').eq(5).find('span > input').eq(0)
            
            let customer_id = $('#tbl_tr_km_item_argrid').find('tbody > tr').eq(i).find('td').eq(1).find('span').eq(0)
            let btnCloseOutlet = $('#tbl_tr_km_item_argrid').find('tbody > tr').eq(i).find('td').eq(1).find('span > div > span').eq(1)
            let listOutlet = $('#tbl_tr_km_item_argrid').find('tbody > tr').eq(i).find('td').eq(1).find('span > div > div > div > div')

            let inv_number = $('#tbl_tr_km_item_argrid').find('tbody > tr').eq(i).find('td').eq(2).find('span').eq(0)
            let btnCloseInvoice = $('#tbl_tr_km_item_argrid').find('tbody > tr').eq(i).find('td').eq(2).find('span > div > span').eq(1)
            let listInvoice = $('#tbl_tr_km_item_argrid').find('tbody > tr').eq(i).find('td').eq(2).find('span > div > div > div > div')
            
            if (checkDataIndex > 0) {
                for (let j = 4; j < 6; j++) {
                    $('#tbl_tr_km_item_argrid').find('tbody > tr').eq(i).find('td').eq(j).find('span > input').eq(0).css({'text-align': 'right'})
                }

                inv_amt.on('keyup', function() {
                    let dataInv_amt = $(this).val().split(',').join('')
                    let hasil = numberWithCommas(dataInv_amt)
                    $(this).val(hasil)
                })

                paid_amt.on('keyup', function() {
                    let dataPaid_amt = $(this).val().split(',').join('')
                    let hasil = numberWithCommas(dataPaid_amt)
                    $(this).val(hasil)
                    jumlahBayar()
                })

                customer_id.on('change', function() {
                    setTimeout(function() {
                        jumlahBayar()
                    }, 1000)
                })

                btnCloseOutlet.on('click', function() {
                    setTimeout(function() {
                        inv_amt.val("0")
                        paid_amt.val("0")
                        jumlahBayar()
                        btnCloseInvoice.click()
                    }, 1000)
                    console.log('haiiii')
                })

                listOutlet.find('a').on('click', function() {
                    setTimeout(function() {
                        let data = inv_number.find('div > span').text()
                        if (data == "Please select") {
                            inv_amt.val("0")
                            paid_amt.val("0")
                            jumlahBayar()
                            btnCloseInvoice.click()
                        }
                    }, 1000)
                    console.log('jugaaa')
                })

                inv_number.on('change', function() {
                    setTimeout(function() {
                        jumlahBayar()
                    }, 1000)
                })

                btnCloseInvoice.on('click', function() {
                    setTimeout(function() {
                        inv_amt.val("0")
                        paid_amt.val("0")
                        jumlahBayar()
                    }, 1000)
                })

                listInvoice.find('a').on('click', function() {
                    setTimeout(function() {
                        let data = inv_number.find('div > span').text()
                        if (data == "Please select") {
                            inv_amt.val("0")
                            paid_amt.val("0")
                            jumlahBayar()
                        }
                    }, 1000)
                    console.log('aaaaaaa')
                })
            }
        }
    }

    calculateRow()
    totalPembayaran()
    jumlahBayar()

    $('#el_tr_km_master_ar_customer_id').on('change', function() {
        console.log('lalala')
        calculateRow()
    })

    $('.ewAddEdit').on('click', function(){
		setTimeout(function(){
            calculateRow()
            responsiveWidthTable()
		}, 1000);
	});
	
	$('.ewGridDelete').on('click', function() {
		$('.modal-footer').eq(2).find('button.btn.btn-primary').on('click', function() {
			setTimeout(function(){
                jumlahBayar()
			}, 1000);
		});
    });


})