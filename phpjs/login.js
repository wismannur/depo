// Write your startup script here
// document.write("page loaded");
$(document).ready(function() {
    // var divKode_depo = ("<div class='form-group'><div><select id='option-depo' class='form-control ewControl'></select></div></div>")
    // var dataKode_depo = ['DEPO BANDUNG', 'DEPO GARUT', 'DEPO YOGYAKARTA']
    
    // $(divKode_depo).insertAfter($('.form-group').eq(1))

    // for (let i = 0; i < 3; i++) {
    //     var optionDepo = $('#option-depo')
    //     optionDepo.append("<option value='"+dataKode_depo[i]+"'>"+dataKode_depo[i]+"</option")
    // }

    function getKodeDepo() {
        $.ajax({
            type: "GET",
            url: 'run_sql_depo.php',		
            data: {
                sql : "SELECT kode_depo FROM employees WHERE Username='" + $('#username').val() + "'"
            },
            success: function (data) {
                let result = JSON.parse(data)
                localStorage.setItem("kode_depo", result.kode_depo)
                getNamaDepo()
            }
        });
    }

    function getNamaDepo() {
        $.ajax({
            type: "GET",
            url: 'run_sql_ppu.php',		
            data: {
                sql : "SELECT nama_depo FROM tbl_depo WHERE kode_depo='" + localStorage.kode_depo + "'"
            },
            success: function (data) {
                let result = JSON.parse(data)
                localStorage.setItem("nama_depo", result.nama_depo)
            }
        });
    }

    $('#btnsubmit').on('click', function() {
        getKodeDepo()
    })
});