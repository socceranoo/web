$(document).ready(function() {
	//$(".alveo-container").css("background-color", "#1B1B1B");
	//$(".alveo-container").addClass("background-clouds");
	if ($("#index-exists").length != 0) {
		index_init();
	}
	if ($("#people-exists").length != 0) {
		people_init();
	}
});


function index_init() {
	var img_arr = ["energyB1.png", "energyC4.png", "energyA5.png", "energyA4.png", "energyB3.png"];
	var img_id ="#main-image";
	var columns = 5;
	var total = 10;
	var img_width = 678;
	var img_height = 400;
	
	function init () {
		var temp_var = setInterval(change_bg_pos, 4000);
		change_image.cur = 0;	
		change_bg_pos.cur = -1;
		$(img_id).click(function () {
			//change_image();
			change_bg_pos();
		});
	}
	function change_bg_pos() {
		change_bg_pos.cur++;
		change_bg_pos.cur %= total;
		var cur_row = parseInt(change_bg_pos.cur / columns, 10);
		var cur_column = change_bg_pos.cur%columns;
		if (cur_row % 2 == 1) {
			cur_column = columns - cur_column -1;
		}
		var xpos = (cur_column * img_width) * (-1);
		var ypos = cur_row * img_height * (-1);
		var pos_str = xpos+"px "+ypos+"px";
		$(img_id).css('background-position', pos_str);
	}
	function change_image() {
		change_image.cur++;
		change_image.cur %= img_arr.length;
		var src = "images/"+img_arr[change_image.cur];
		var url = "url('"+src+"')";
		$(img_id).css('background-image', url);
	}
	return init();
}


function people_init () {
	function select_inner (event){
		var id = event.target.id;
		select_person(id);
	}
	function select_person(person_id) {
		var person = person_id.match(/ic(\d+)$/);
		var selected_id = parseInt(person[1], 10);
		var src = $("#ic"+selected_id).attr('src');
		var post = $("#tg"+selected_id).find('h4').html();
		var fullname = $("#tg"+selected_id).find('h2').html();
		$("#modal-image").attr('src', src);
		$("#person-post").html("The "+post);	
		$("#modal-name").html(fullname);
		slideDownContainer();
	}
	function initEvents(){ 
		$('.person-img').bind('click', function (event) {
			select_inner(event);
		});
	}
	var slideDownContainer = function () {
		$('.person-content').fadeIn("slow");
		$('#person-content-container').modal();
	};
	return initEvents();
}
