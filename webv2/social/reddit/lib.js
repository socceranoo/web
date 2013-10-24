function redditSearchObject(content_div) {
	var _this = this;
	this.contentDiv = document.getElementById(content_div);
	this.init = function (){
	};
	this.submitSearch = function (qry){
		this.contentDiv.innerHTML="<ul class='text-center unstyled'><img class=text-center src='images/loading.gif' /></ul>";
		$.post("/webv2/social/reddit/search.php",{ query: qry},function(data){
			_this.handleResults(data.retval);
		}, "json");
	};
	this.handleResults = function (obj){
		this.contentDiv.innerHTML="";
		var itemList, item, heading, img, span, url, desc;
		var title, snippet, num_comments, downs, ups, score;
		var itemList = document.createElement('ul');
		itemList.className="unstyled text-justify";

		for(var i = 0; i < obj.length ; i++) {
			title = obj[i]["title"];
			url = obj[i]["url"];
			num_comments = obj[i]["num_comments"];
			downs = obj[i]["downs"];
			score = obj[i]["score"];
			ups = obj[i]["ups"];
			id = obj[i]["media"];
			desc = obj[i]["description"];

			item = document.createElement('li');
			item.className="reddit-item clearfix well background-clouds";

			//var video_id = youtubeIdFromUrl(url);
			//url = "http://youtube.com/embed/"+video_id;

			heading = document.createElement('h5');
			heading.className="common-title reddit-title";
			heading.setAttribute('data-url', url);
			heading.innerHTML=title;
			span = document.createElement('span');
			span.innerHTML ="Score:"+score+"<br/>Comments:"+num_comments+"<br/>Ups:"+ups+"<br/>Downs:"+downs;
			//span.innerHTML +=desc;


			if (id !== null) {
				img = document.createElement('img');
				img.className="img-polaroid pull-left thumbnail img-circle";
				img.setAttribute('src', id['thumbnail_url']);
				heading.setAttribute('data-url', id['url']);
				item.appendChild(img);
			}
			item.appendChild(heading);
			item.appendChild(span);
			itemList.appendChild(item);
		}
		this.contentDiv.appendChild(itemList);
		$(".reddit-title").click(function () {
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
function youtubeIdFromUrl(url)
{
	var video_id = url.split('v=');
	var ampersandPosition = video_id[1].indexOf('&');
	val = video_id[1];
	if(ampersandPosition != -1) {
		video_id = video_id[1].split('&');
		val = video_id[0];
	}
	return val;
}

