function facebookSearchObject(content_div) {
	var _this = this;
	this.contentDiv = document.getElementById(content_div);
	this.init = function (){
	};
	this.submitSearch = function (qry){
		var _this = this;
		$.post("/webv2/social/facebook/search.php",{ query: qry}, function(data){
			_this.handleResults(data.retval);
		}, "json");
	};
	this.handleResults = function (obj){
		this.contentDiv.innerHTML="";
		var itemList, item, heading, span, url;
		var id, title, snippet, count;
		var itemList = document.createElement('ul');
		itemList.className="unstyled text-center";

		for(var i = 0; i < obj.length ; i++) {
			title = obj[i]["user"];
			snippet = obj[i]["post"];
			id = obj[i]["id"];

			item = document.createElement('li');
			item.className="facebook-item well background-clouds";

			url = 'http://www.facebook.com/'+id;

			heading = document.createElement('h4');
			heading.className="common-title facebook-title text-center";
			heading.setAttribute('data-url', url);
			heading.innerHTML=title;

			span = document.createElement('span');
			span.className="facebook-message text-center";
			span.innerHTML=snippet;

			item.appendChild(heading);
			item.appendChild(span);

			itemList.appendChild(item);
		}
		this.contentDiv.appendChild(itemList);
		$(".facebook-title").click(function () {
			if ($("#wiki-modal").attr('src') != $(this).data('url')) {
				$("#wiki-modal").attr('src', $(this).data('url'));
			}
			$("#wiki-modal").modal();
		});
		/*
		*/
	};
	return this.init();
}
