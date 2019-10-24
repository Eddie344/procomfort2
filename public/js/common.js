$(function() {
	//выбор даты периода
	$('input[name="date_period"]').daterangepicker({
		autoUpdateInput: false,
		"parentEl": "#date_container",
  		locale: {
            format: 'DD/MM/YYYY',
            applyLabel: 'Принять',
            cancelLabel: 'Отмена',
            invalidDateLabel: 'Сортировка по датам',
            daysOfWeek: ['Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс', 'Пн'],
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            firstDay: 1
        }
	});
	$('input[name="date_period"]').on('apply.daterangepicker', function(ev, picker) {
	  $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
	});

	$('input[name="date_period"]').on('cancel.daterangepicker', function(ev, picker) {
	  $(this).val('');
	});

	//выбор одной даты
	$('input[name="date_single"]').daterangepicker({
		singleDatePicker: true,
  		locale: {
            format: 'DD/MM/YYYY',
            applyLabel: 'Принять',
            cancelLabel: 'Отмена',
            invalidDateLabel: 'Выберите дату',
            daysOfWeek: ['Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс', 'Пн'],
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            firstDay: 1
        }
	});

});


$(document).ready(function() {
	//Изделие горизонт добавление
	$('#goriz_rascvetka').bind('change',function(){
	 	var value = $(this).val();
		if(value=='Standart'){
			$("#goriz_color").show();
			$("#goriz_own_color").hide();
		}
		else if(value=='Own'){
			$("#goriz_color").hide();
			$("#goriz_own_color").show();
		}
	});

	$('#goriz_height').bind('change',function(){
	 	$('#goriz_rule_height').val($(this).val());
	});

	$('#goriz_height').bind('change',function(){
	 	$('#goriz_lamel_number').val(Math.ceil($(this).val()*10));
	 	var num = $('#goriz_lamel_number').val();
	 	$("#goriz_own_color").empty();
		for (let i = 1; i <= num; i++) {
		  $("#goriz_own_color").append("<div class=\"input-group input-group-sm mb-3 col-md-12\"><div class=\"input-group-prepend\"><span class=\"input-group-text\" id=\"basic-addon1\">"+i+"</span></div><select class=\"form-control\" id=\"exampleFormControlSelect1\"><option> </option><option>1354</option><option>4663</option></select></div>");
		}
	});

	//Изделие вертикалка добавление
	$('#vert_rascvetka').bind('change',function(){
	 	var value = $(this).val();
		if(value=='Standart'){
			$("#vert_color").show();
			$("#vert_own_color").hide();
		}
		else if(value=='Own'){
			$("#vert_color").hide();
			$("#vert_own_color").show();
		}
	});

	$('#vert_height').bind('change',function(){
	 	$('#vert_rule_height').val($(this).val());
	 	$('input[name=lamel_leight]').val($(this).val());
	});

	$('#vert_width').bind('change',function(){
	 	$('#vert_lamel_number').val(Math.ceil($(this).val()/0.08));
	 	var num = $('#vert_lamel_number').val();
	 	$("#vert_own_color").empty();
		for (let i = 1; i <= num; i++) {
		  $("#vert_own_color").append("<div class=\"input-group input-group-sm mb-3 col-md-12\"><div class=\"input-group-prepend\"><span class=\"input-group-text\" id=\"basic-addon1\">"+i+"</span></div><select class=\"form-control\" name=\"vert_own_color_name\"><option> </option><option value=\"line_color\">Лайн</option><option value=\"keln_color\">Кельн</option><option value=\"malta_color\">Мальта</option></select><select class=\"form-control\" name=\"vert_color_select\"><option></option></select><input type=\"nuber\" name=\"lamel_leight\" class=\"form-control\"></div>");
		}
		if($(this).val() < 2.3){
			$('#vert_rule_number').val(2);
		}
		else{
			$('#vert_rule_number').val(3);
		}
	});
	var line_color = {1: 'Лайн белый', 2: 'Лайн желтый', 3: 'Лайн красный'};
	var keln_color = {1: 'Кельн белый', 2: 'Кельн желтый', 3: 'Кельн красный'};
	var malta_color = {1: 'Мальта белый', 2: 'Мальта желтый', 3: 'Мальта красный'};
	$('#vert_cloth_select').bind('change',function(){
		if($(this).val()=='line_color') {
			$("#vert_color").show();
			$('select[name=vert_color_select]').empty();
			$.each(line_color, function(key, value) {
				$('select[name=vert_color_select]').append('<option value="' + key + '">' + value + '</option>');
			});
		}
		if($(this).val()=='keln_color') {
			$("#vert_color").show();
			$('select[name=vert_color_select]').empty();
			$.each(keln_color, function(key, value) {
				$('select[name=vert_color_select]').append('<option value="' + key + '">' + value + '</option>');
			});
		}
		if($(this).val()=='malta_color') {
			$("#vert_color").show();
			$('select[name=vert_color_select]').empty();
			$.each(malta_color, function(key, value) {
				$('select[name=vert_color_select]').append('<option value="' + key + '">' + value + '</option>');
			});
		}
		$("select[name=vert_own_color_name] option[value=" +$(this).val()+ "]").prop('selected', true);
	});

	$('#vert_color_select_id').bind('change',function(){
		$("select[name=vert_color_select] option[value=" +$(this).val()+ "]").prop('selected', true);
	});

	//Изделие рулонка мини добавление

	$('#rol_mini_height').bind('change',function(){
	 	$('#rol_mini_rule_height').val($(this).val());
	});

	var l_color = {1: 'L-0880', 2: 'L-0853', 3: 'L-0439'};
	var n_color = {1: 'N-206', 2: 'N-205', 3: 'N-208'};
	var zh_color = {1: 'ZH-65', 2: 'ZH-68', 3: 'ZH-69'};
	$('#rol_mini_cloth_select').bind('change',function(){
		if($(this).val()=='l_color') {
			$("#rol_mini_color").show();
			$('#rol_mini_color_select').empty();
			$.each(l_color, function(key, value) {
				$('#rol_mini_color_select').append('<option value="' + key + '">' + value + '</option>');
			});
		}
		if($(this).val()=='n_color') {
			$("#rol_mini_color").show();
			$('#rol_mini_color_select').empty();
			$.each(n_color, function(key, value) {
				$('#rol_mini_color_select').append('<option value="' + key + '">' + value + '</option>');
			});
		}
		if($(this).val()=='zh_color') {
			$("#rol_mini_color").show();
			$('#rol_mini_color_select').empty();
			$.each(zh_color, function(key, value) {
				$('#rol_mini_color_select').append('<option value="' + key + '">' + value + '</option>');
			});
		}
	});

	//Изделие зебра мини добавление

	$('#zebra_mini_height').bind('change',function(){
	 	$('#zebra_mini_rule_height').val($(this).val());
	});

	var l_color = {1: 'L-0880', 2: 'L-0853', 3: 'L-0439'};
	var n_color = {1: 'N-206', 2: 'N-205', 3: 'N-208'};
	var zh_color = {1: 'ZH-65', 2: 'ZH-68', 3: 'ZH-69'};
	$('#zebra_mini_cloth_select').bind('change',function(){
		if($(this).val()=='l_color') {
			$("#zebra_mini_color").show();
			$('#zebra_mini_color_select').empty();
			$.each(l_color, function(key, value) {
				$('#zebra_mini_color_select').append('<option value="' + key + '">' + value + '</option>');
			});
		}
		if($(this).val()=='n_color') {
			$("#zebra_mini_color").show();
			$('#zebra_mini_color_select').empty();
			$.each(n_color, function(key, value) {
				$('#zebra_mini_color_select').append('<option value="' + key + '">' + value + '</option>');
			});
		}
		if($(this).val()=='zh_color') {
			$("#zebra_mini_color").show();
			$('#zebra_mini_color_select').empty();
			$.each(zh_color, function(key, value) {
				$('#zebra_mini_color_select').append('<option value="' + key + '">' + value + '</option>');
			});
		}
	});
});
