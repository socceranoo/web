function twitterSearchObject(content_div) {
	var _this = this;
	this.contentDiv = document.getElementById(content_div);
	this.init = function (){
	};
	this.submitSearch = function (qry){
		var _this = this;
		$.post("/webv2/social/twitter/search.php",{ query: qry},function(data){
			var contentDiv = document.getElementById(_this.contentDiv);
			_this.handleResults(data.retval);
		}, "json");
	};
	this.handleResults = function (obj){
		this.contentDiv.innerHTML="";
		var itemList, item, heading, span, url;
		var title, snippet, count;
		var itemList = document.createElement('ul');
		itemList.className="unstyled text-left";

		for(var i = 0; i < obj.length ; i++) {
			title = obj[i]["user"];
			snippet = obj[i]["tweet"];
			count = obj[i]["retweet_count"];

			item = document.createElement('li');
			item.className="twitter-item well background-clouds";

			url = 'http://www.twitter.com/'+title;

			heading = document.createElement('h4');
			heading.className="common-title twitter-title";
			heading.setAttribute('data-url', url);
			heading.innerHTML="@"+title;

			var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
			snippet = snippet.replace(exp,"<a href='$1' target=_blank>$1</a>"); 
			span = document.createElement('span');
			span.className="twitter-message";
			span.innerHTML=snippet;
			span.innerHTML +="<br/><b>Retweeted "+count+"</b> times.";

			item.appendChild(heading);
			item.appendChild(span);

			itemList.appendChild(item);
		}
		this.contentDiv.appendChild(itemList);
		$(".twitter-title").click(function () {
			if ($("#wiki-modal").attr('src') != $(this).data('url')) {
				$("#wiki-modal").attr('src', $(this).data('url'));
			}
			$("#wiki-modal").modal();
		});
		/*
		/*
		*/
	}
	return this.init();
}
