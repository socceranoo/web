$(document).ready(function() {
	if ($("#index-exists").length != 0) {
		$("#index-link").addClass("highlight-link");
		index_init();
	}else {
		var loc = window.location.toString();
		var str = loc.match(/((\/.*)*)?\/(.*)\.php?$/);
		if (str[3]) {
			$("#"+str[3]+"-link").addClass("highlight-link");
		}

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
	var people_arr = [];
	var cur_person;
	var image_id ="#person-image";
	function add_person (person_fname, person_lname, designation, file_extn) {
		var person_id = people_arr.length;
		var temp= new person(person_fname, person_lname, person_id, designation, file_extn);
		people_arr.push(temp);
		if (person_id === 0) {
			//temp.setContent();
			//cur_person = temp;
		}
	}
	function select_span (event){
		var id = event.target.id;
		var person_id = $("#"+id).parent().parent().attr('id');
		select_person(person_id);
	}
	function select_inner (event){
		var id = event.target.id;
		var person_id = $("#"+id).parent().attr('id');
		select_person(person_id);
	}
	function select_person(person_id) {
		var person = person_id.match(/person(\d+)$/);
		var selected_id = parseInt(person[1], 10);
		if (cur_person != null) {
			if (cur_person != people_arr[selected_id]) {
				cur_person.removeFocus();
				cur_person = people_arr[selected_id];
				cur_person.changeContent();
				cur_person.setFocus();
			}else {
				cur_person.removeFocus();
				cur_person.slideUpContainer();
				cur_person = null;
			}
		}else {
			cur_person = people_arr[selected_id];
			cur_person.changeContent();
			cur_person.slideDownContainer();
			cur_person.setFocus();
		}
	}

	function initEvents(){ 
		add_person("Fname0", "Lname0", "Sr Scientist", ".jpg");
		add_person("Satyajit", "Phadke", "Scientist", ".jpg");
		add_person("Fname2", "Lname2", "Founder & CEO", ".jpg");
		add_person("Fname3", "Lname3", "Sr. Lab Admin", ".jpg");
		add_person("Fname4", "Lname4", "Intern", ".jpg");
		/*
		$('.circle').click( function () {
			select_inner(event);
		});
		$('.person-span').click( function () {
			select_span(event);
		});
		*/
		$('.circle').bind('click', function (event) {
			select_inner(event);
		});
	}
	function person(fname, lname, id, post, extn){
		this.fullname = fname+" "+lname;
		this.nickname = "";
		this.person_id = id;
		this.designation = post;
		this.profilepic = "images/people/"+fname+"_"+lname+""+extn;
		//this.profilepic = "images/user.png";
		this.circleid = "#person"+id;
		this.init = function () {
			var url = "url('"+this.profilepic+"')";
			$(this.circleid).children('.innercircle').children('.textgroup').find('h2').html(this.fullname);
			$(this.circleid).children('.innercircle').children('.textgroup').find('span').html(this.designation);
			$(this.circleid).children('.innercircle').css('background-image', url);
		};
		this.slideUpContainer = function () {
			$('#person-content-container').slideUp(1200);
			$('.person-content').fadeOut("slow");
		};
		this.removeFocus = function () {
			$('.inactive').removeClass('smallercircle ');
			$(this.circleid).removeClass('biggercircle').addClass('inactive');
		};
		this.slideDownContainer = function () {
			$('#person-content-container').slideDown(1200);
			$('.person-content').fadeIn("slow");
		};
		this.setFocus = function () {
			var url = "url('"+this.profilepic+"')";
			$(this.circleid).removeClass('inactive').addClass('biggercircle');
			$('.inactive').addClass('smallercircle');
		};
		this.changeContent = function () {
			$("#person-post").children('h2').html("The "+this.designation);	
		};

		return this.init();
	}

	return initEvents();
}
