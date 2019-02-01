window.URL = window.location.origin + '/depo/';

// this is for create number with separator comma
function numberWithCommas(x) {
	if (x !== "") {
		let y = x.toString()
		y.split('')[0] == '0' ? y = y.slice(1) : '' ;
		return y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	} else {
		return 0
	}
}

// this is for get data by url
function getDataUrl(data) {
	let lengthDataUrl = window.location.search.split('&').length
	for (let i = 0; i < lengthDataUrl; i++) {
		let checkDataUrl = window.location.search.split('&')[i].split('=')[0]
		var dataUrl = ''
		i == 0 ? dataUrl = checkDataUrl.slice(1) : dataUrl = checkDataUrl ;
		if (data == dataUrl) {
			let result = window.location.search.split('&')[i].split('=')[1]
			return result
		}
	}
}

// this is for change to be width 100% input
function responsiveWidthTable() {
    $('.ewTableRow').find('td > span').css({'width':'100%'})
    $('.ewTableRow').find('td > span > input').css({'width':'100%'})
    $('.ewTableRow').find('td > span > span > span > input').css({'width':'100%'})
    $('.ewTableRow').find('td > span > div').css({'width':'100%'})
    $('.ewTableRow').find('td > .btn-group.ewButtonGroup').css({'text-align':'center', 'display': 'block' })
    $('.ewTableAltRow').find('td > span').css({'width':'100%'})
    $('.ewTableAltRow').find('td > span > input').css({'width':'100%'})
    $('.ewTableAltRow').find('td > span > span > span > input').css({'width':'100%'})
    $('.ewTableAltRow').find('td > span > div').css({'width':'100%'})
    $('.ewTableAltRow').find('td > .btn-group.ewButtonGroup').css({'text-align':'center', 'display': 'block' })
}

// this is for count total row in table detail
function totalField(nameTable) {
    let jumlahField = $(nameTable).find('tbody tr').length
    return jumlahField
};

function addCustomJS(nameJS) {
	let takeJS = "";
	if (nameJS.slice(-3) == "add") {
		takeJS = nameJS.slice(0, -3)
	} else {
		takeJS = nameJS.slice(0, -4)
	}

	$('section.content').append("<script type='text/javascript' src='phpjs/customjs/" + takeJS +".js'></script>")
};