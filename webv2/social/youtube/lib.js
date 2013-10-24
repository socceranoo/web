function youtubeSearchObject(content_div) {
	var _this = this;
	this.contentDiv = document.getElementById(content_div);
	this.init = function (){
	};
	this.submitSearch = function (qry){
		$.post("/webv2/social/youtube/search.php",{ query: qry},function(data){
			_this.handleResults(data.retval);
		}, "json");
	};
	this.handleResults = function (obj){
		this.contentDiv.innerHTML="";
		var itemList, item, heading, span, url;
		var title, snippet, count, watch_url, thumnbail, category, duration, video_id;
		var itemList = document.createElement('ul');
		itemList.className="unstyled text-center";

		for(var i = 0; i < obj.length ; i++) {
			title = obj[i]["title"];
			snippet = obj[i]["description"];
			count = obj[i]["count"];
			category = obj[i]["category"];
			duration = obj[i]["duration"];
			thumbnail = obj[i]["thumbnail"];
			video_id = obj[i]["id"];
			url = obj[i]["url"];

			item = document.createElement('li');
			item.className="youtube-item well background-clouds clearfix";

			heading = document.createElement('h4');
			heading.className="common-title youtube-title text-center";
			heading.setAttribute('data-url', url);
			heading.innerHTML=title;

			span = document.createElement('span');
			span.className="youtube-message text-center";
			span.innerHTML=snippet+"<br/>"+count+"<br/>"+category+"<br/>"+duration;

			img = document.createElement('img');
			img.className="img-polaroid pull-left thumbnail img-circle";
			img.setAttribute('src', thumbnail);

			item.appendChild(img);
			item.appendChild(heading);
			item.appendChild(span);

			itemList.appendChild(item);
		}
		this.contentDiv.appendChild(itemList);
		$(".youtube-title").click(function () {
			if ($("#wiki-modal").attr('src') != $(this).data('url')) {
				$("#wiki-modal").attr('src', $(this).data('url'));
			}
			$("#wiki-modal").modal();
		});
	}
	/*
	this.getPage = function (link){
		$("#wiki-modal1").html("<ul class='text-center unstyled'><img class=text-center src='images/loading.gif' /></ul>");
		$("#wiki-modal1").modal();
		$.post("/webv2/social/wikipedia/content.php",{ page: link},function(data){
			_this.handlePage(data.retval);
		}, "json");
	};
	this.handlePage = function (obj){
		var tempdiv = $("<div>"+obj['0']+"</div>");
		var holder = $("<ul class='well text-center'></ul>");
		var wikitable = tempdiv.children('table:first');
		wikitable.addClass("well span5");
		//holder.append(wikimg);
		var wikimg = tempdiv.find('img:first');
		wikimg.addClass("img-polaroid");
		var wikipage = tempdiv.children('p:first');
		wikipage.find('sup').remove();
		wikipage.find('a').each(function() {
			$(this).attr('href', 'http://en.wikipedia.org'+$(this).attr('href')).attr('target','wikipedia');
		});
		wikitable.find('a').each(function() {
			$(this).attr('href', 'http://en.wikipedia.org'+$(this).attr('href')).attr('target','wikipedia');
		});
		wikitable.addClass("well span5");
		$("#wiki-modal1").html("");
		$("#wiki-modal1").append(wikitable);
		$("#wiki-modal1").append(wikipage);
		//$("#wiki-modal1").html(obj["0"]);
		//$("#wiki-modal1").modal();
	};
	*/
	return this.init();
}
