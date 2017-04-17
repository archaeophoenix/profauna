$(function() {

	$('.select2-selection').attr('style','border-radius:50px;');
	$('.select2-dropdown').attr('style','border-radius:15px;');
	$('.select2-search').attr('style','border-radius:15px;');
	
	$(".datepicker").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        format: 'DD-MM-YYYY'
	});

	// var awal = moment().subtract(29, 'days');
	// var akhir = moment();
	if($('#reportrange').length){
		$('input[type="search"]').keyup(function(){
			$('#param').val('AND nama LIKE "%'+$(this).val()+'%"');
		});
	}

	var awal = moment().startOf('month');
	var akhir = moment().endOf('month');

	console.log(moment().startOf('month')+' / '+moment().endOf('month'));
	console.log(awal+' / '+akhir);

	function cb2(awal, akhir) {
		$('#span2').html(awal.format('D MMMM YYYY') + ' - ' + akhir.format('D MMMM YYYY'));
		$('#range').val('((registrasi.tanggal BETWEEN ' + "'" + awal.format('YYYY-MM-DD') + "'" + ' AND ' + "'" + akhir.format('YYYY-MM-DD') + "'" + ') AND renewal IS NULL )');
		$('#awal').val(awal.format('YYYY-MM-DD'));
		$('#akhir').val(akhir.format('YYYY-MM-DD'));
		$('#null').val(1);
		$('#span').html('');
		$('#range').change();
	}

	function cb(awal, akhir) {
		$('#span').html(awal.format('D MMMM YYYY') + ' - ' + akhir.format('D MMMM YYYY'));
		$('#range').val('(registrasi.tanggal BETWEEN ' + "'" + awal.format('YYYY-MM-DD') + "'" + ' AND ' + "'" + akhir.format('YYYY-MM-DD') + "'" + ')');
		$('#awal').val(awal.format('YYYY-MM-DD'));
		$('#akhir').val(akhir.format('YYYY-MM-DD'));
		$('#null').val(0);
		$('#span2').html('');
		$('#range').change();
	}

	function cb3(awal, akhir) {
		$('#span').html(awal.format('D MMMM YYYY') + ' - ' + akhir.format('D MMMM YYYY'));
		$('#range').val('(registrasi.tanggal BETWEEN ' + "'" + awal.format('YYYY-MM-DD') + "'" + ' AND ' + "'" + akhir.format('YYYY-MM-DD') + "'" + ')');
		$('#span2').html('');
	}

	function cb4(awal, akhir) {
		$('#span2').html(awal.format('D MMMM YYYY') + ' - ' + akhir.format('D MMMM YYYY'));
		$('#range').val('(registrasi.tanggal BETWEEN ' + "'" + awal.format('YYYY-MM-DD') + "'" + ' AND ' + "'" + akhir.format('YYYY-MM-DD') + "'" + ')');
		$('#span').html('');
	}

	$('#reportrange').daterangepicker({
	  startDate: awal,
	  endDate: akhir,
	  ranges: {
	   'Hari Ini': [moment(), moment()],
	   'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	   'Seminggu Terakhir': [moment().subtract(6, 'days'), moment()],
	   '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
	   'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
	   'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	  }
	}, cb);

	$('#reportrange2').daterangepicker({
	  startDate: awal,
	  endDate: akhir,
	  ranges: {
	   'Hari Ini': [moment(), moment()],
	   'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	   'Seminggu Terakhir': [moment().subtract(6, 'days'), moment()],
	   '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
	   'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
	   'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	  }
	}, cb2);

	if ($('#span').text() == '' && $('#span2').text() == '') {
		cb4(awal, akhir);
		// cb3(awal, akhir);
	}

	$('.id_jabatan').each(function(){
		$("#id_jabatan option[value='"+$(this).val()+"']").remove();
	});

	var id = new Array();
	var i = 0;
	$('.id_bio').each(function(){
		if ($(this).val()) {
			id[i] = $(this).val();
			i++;
		}
	});

	var kts = '' ;
	if ($('#kts').val()){
		kts = ($('#kts').val() == 0) ? id.join() : id.join()+'/'+$('#kts').val() ;
	}

	$('#acdata').val($('#acdata').attr('rel')+kts);

	$('.autocomplete').autocomplete({
	    serviceUrl: $('#base').val()+''+$('#acdata').val(),
	    type : 'GET',
	    dataType : 'json',
	    lookupLimit: 6,
	    onSelect: function (suggestion) {
	        $('#'+$(this).attr('rel')).val(suggestion.id);
	        if($('#baris').val()){
				var id = new Array();
				var i = 0;
				$('.id_bio').each(function(){
					if ($(this).val()) {
						id[i] = $(this).val();
						i++;
					}
				});
				var kts = '' ;
				if ($('#kts').val()){
					kts = ($('#kts').val() == 0) ? id.join() : id.join()+'/'+$('#kts').val() ;
				}
				$('#acdata').val($('#acdata').attr('rel')+kts);
				console.log($(".autocomplete"));
	        }
	    }
	});
	

});

function tujuan(){
	var param = '';
	var url = $("#base").val();
  	var link = $("#link").val();
	param += ($('#range').val()) ? ' AND ('+$('#range').val()+')' : '' ;
	param += ($('#kota').val()) ? ' AND (alamat LIKE "%'+$('#kota').val()+'%" OR address LIKE "%'+$('#kota').val()+'%" )' : '' ;
	param += ($('#propinsi').val()) ? ' AND (alamat LIKE "%'+$('#propinsi').val()+'%" OR address LIKE "%'+$('#propinsi').val()+'%" )' : '' ;
	param += ($('#status').val()) ? ' AND (registrasi.status = "'+$('#status').val()+'")' : '' ;
	param += ($('#type').val()) ? ' AND (registrasi.type = "'+$('#type').val()+'")' : '' ;
	console.log(param);
	$('#param').val(param);
	// $('#filter').submit();
}

tujuan();

function biodata(id) {
	$('.bio'+id).each(function(){
		$('#'+$(this).attr('name')).text($(this).val());
	});
}

function printpage(lru = null){
    var originalContents = document.body.innerHTML;
    var printReport= document.getElementById('print').innerHTML;
    document.body.innerHTML = printReport;
    if ($('#print').css('display') == 'none') {
    	$('#print').removeAttr('style');
    }
    window.print();
    if (!$('#print').attr('style')) {
    	$('#print').css('display','none');
    }
    document.body.innerHTML = originalContents;
    console.log(lru);
	window.location.href = 'http://' + lru ;
}

function periode(){
  var url = $("#base").val();
  var link = $("#link").val();
  var bulan = $("#bulan").val();
  var tahun = $("#tahun").val();

  window.location = url+''+link+'/'+bulan+'/'+tahun; //Relative or absolute path to response.php file
}

function plus(){
	var baris = $('#baris').val();
	baris++;
	$('#baris').val(baris);

	var d = new Date();
	var gen = d.getDate()+''+d.getHours()+''+d.getMinutes()+''+d.getSeconds()+''+d.getMilliseconds();

	var id = new Array();
	var i = 0;
	$('.id_bio').each(function(){
		if ($(this).val()) {
			id[i] = $(this).val();
			i++;
		}
	});

	var kts = '' ;
	if ($('#kts').val()){
		kts = ($('#kts').val() == 0) ? id.join() : id.join()+'/'+$('#kts').val() ;
	}

	$('#acdata').val($('#acdata').attr('rel')+kts);

	$('#peserta').append('<tr id="baris'+gen+'"><td><input type="text" style="border-radius: 50px;" class="form-control autocomplete" rel="id_bio'+gen+'" id="bio'+gen+'"><input type="hidden" name="id_bio[]" class="id_bio" id="id_bio'+gen+'"></td><td align="center"><select name="jenis[]" style="border-radius: 50px;" class="form-control select2"><option value="0">Peserta</option><option value="1">Pemateri</option></select></td><td align="center"><button type="button" onclick="minus('+gen+');" title="Hapus" class="btn badge badge-danger badge-icon"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>');

	console.log($(".autocomplete"));
	console.log($(".select2"));

	$(".select2").select2();
	$('.select2-selection').attr('style','border-radius:50px;');
	$('.select2-dropdown').attr('style','border-radius:15px;');
	$('.select2-search').attr('style','border-radius:15px;');

	$('.autocomplete').autocomplete({
	    serviceUrl: $('#base').val()+''+$('#acdata').val(),
	    type : 'GET',
	    dataType : 'json',
	    lookupLimit: 6,
	    onSelect: function (suggestion) {
	        $('#'+$(this).attr('rel')).val(suggestion.id);
	        if($('#baris').val()){
	        	var id = new Array();
				var i = 0;
				$('.id_bio').each(function(){
					if ($(this).val()) {
						id[i] = $(this).val();
						i++;
					}
				});
				var kts = '' ;
				if ($('#kts').val()){
					kts = ($('#kts').val() == 0) ? id.join() : id.join()+'/'+$('#kts').val() ;
				}
				$('#acdata').val($('#acdata').attr('rel')+kts);
				console.log($(".autocomplete"));
	        }
	    }
	});
}

function minus(id){
	console.log($(".autocomplete"));
	var baris = parseInt($('#baris').val());
	if (baris > 1) {
		baris--;

		$('#baris').val(baris);
		$('#baris'+id).remove();

		if($('#baris').val()){
			var id = new Array();
			var i = 0;
			$('.id_bio').each(function(){
				if ($(this).val()) {
					id[i] = $(this).val();
					i++;
				}
			});
			var kts = '' ;
			if ($('#kts').val()){
				kts = ($('#kts').val() == 0) ? id.join() : id.join()+'/'+$('#kts').val() ;
			}
			$('#acdata').val($('#acdata').attr('rel')+kts);
		}

	} else {
		alert('baris anda tinggal satu, anda tidak bisa menghapus baris lagi');
	}
}