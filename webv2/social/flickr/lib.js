function flickrSearchObject(content_div) {
	this.contentDiv = content_div;
	this.init = function (){
	};
	this.submitSearch = function (qry){
		var _this = this;
		$.post("/webv2/social/flickr/search.php",{ query: qry},function(data){
			var contentDiv = document.getElementById(_this.contentDiv);
			contentDiv.innerHTML = data.retval;
		}, "json");
	};
	return this.init();
}
