var bgarray = new Array("blur-fog.jpg", "blur-sky.jpg");
$(document).ready(function() {
	//TestforChrome 
	eventinits();  
	$("#imac1").hide();
	//$("#menu-bar").hide();
	initNav();
});

function homeinit() {
}
function eventinits() {
		var myfunction = function cli(){
		cli.duration = 3000;
        //...animate the 2 curtain images to width of 50px with duration of 2 seconds...  
        //$(this).children('img.curtain').animate({ width: 100 },{duration: 4000});  
		if (cli.open) {
        	$('img.curtain').animate({ width: "50%" },{duration: cli.duration});  
        	$('.imac').fadeOut(4000);  
        	$('.desc').fadeIn(4000);  
			$('#menu-bar').fadeOut(4000);  
				cli.open = false;
		}else {
			$('img.curtain').animate({ width: 50 },{duration: cli.duration});  
			$('.imac').fadeIn(4000);  
			$('#menu-bar').fadeIn(4000);  
        	$('.desc').fadeOut(4000);  
			cli.open = true;
		}
        //...show the content behind the curtains with fadeIn function (2 seconds)  
        //$(this).children('.imac').fadeIn(4000);  
        //$('.imac').fadeIn(4000);  
        //$('img.curtain').animate({ width: "50%" },{duration: 4000});  
    	}
		
		var func1 = function (e) {
			id = e.target.id;
			number=id.replace(/\D+/,'');
			previous = stPt + offset;
			offset = number - stPt;
			managethumbnail(previous, stPt+offset);
		}
	// when user clicks inside the container...  
    //$('.curtain_wrapper').click(function(){
	$('.curtain').click(myfunction);
	$('.desc').click(myfunction);
	$('img.thumbnail').click(func1);
	
}
var stPt = 0, endPt = 5, offset = 0; //showing 10 elements
var numofpics = endPt-stPt;
var $li = [];

//hide all li that is beyond the range

//call to set thumbnails based on what is set
function initNav() {
	$li = $('ul.navigator li'); //cache the list of li's
	adjustNav();
	managethumbnail(0, stPt+offset);
	$('.ice-previous').click (function () {
		if (stPt <= 0) {
			if (offset == 0)
				return false;
			else { 
				managethumbnail(stPt+offset, stPt+offset-1);
				offset--;
				return false;
			}
		}
		previous = stPt+offset;
		stPt--; endPt--;
		adjustNav();
		managethumbnail(previous, stPt+offset);
	});

	$('.ice-next').click (function () {
		if (endPt >= $li.length - 1) {
			if (offset == numofpics)
				return false;
			else { 
				managethumbnail(stPt+offset, stPt+offset+1);
				offset++;
				return false;
			}
			return false;
		}
		previous = stPt+offset;
		stPt++; endPt++;
		adjustNav();
		managethumbnail(previous, stPt+offset);
	});
}

function adjustNav() {
 for (var i = 0; i < $li.length; i++) {
    if (i >= stPt && i <= endPt) {
       $li.eq(i).show();
    } else {
       $li.eq(i).hide(); 
    }
 }
	/*
	$(".imgholder").fadeOut(100, function () {
			$(".imgholder").fadeIn(100);
	});
	*/
}

function managethumbnail(previous, current){
	$li.eq(previous).children('img.thumbnail').css("opacity", 0.4);
	val = $li.eq(previous).children('img.thumbnail').attr("src");
	$li.eq(current).children('img.thumbnail').css("opacity", 0.9);
	$(".imgholder").attr("src", val);

}
