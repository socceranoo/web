function logininit() {
	showhideform("login");
}
function getid(id){
	return document.getElementById(id);
}
function hideElem(id) {
	$("#"+id).hide();
}
function showElem(id) {
	$("#"+id).show();
}

function showhideform(formname) {
	hideElem("login");
	hideElem("register");
	hideElem("resetreq");
	showElem(formname);
}
