function wikiSearchObject(content_div) {
	var _this = this;
	this.contentDiv = document.getElementById(content_div);
	this.init = function (){
	};
	this.submitSearch = function (qry){
		$.post("/webv2/social/wikipedia/search.php",{ query: qry},function(data){
			_this.handleResults(data.retval);
		}, "json");
	};
	this.handleResults = function (obj){
		this.contentDiv.innerHTML="";
		var itemList, item, heading, span, url;
		var title, snippet;
		var itemList = document.createElement('ul');
		itemList.className="unstyled text-center";

		for(var i = 0; i < obj.length ; i++) {
			title = obj[i]["@attributes"].title;
			snippet = obj[i]["@attributes"].snippet;

			item = document.createElement('li');
			item.className="wiki-item well background-clouds";

			url = 'http://www.wikipedia.org/wiki/'+title;
			item.setAttribute('data-url', url);

			heading = document.createElement('h4');
			heading.className="common-title wiki-title text-center";
			heading.setAttribute('data-url', url);
			heading.setAttribute('data-title', title);
			heading.innerHTML=title;
			/*
			link = document.createElement('a');
			link.innerHTML=title;
			heading.setAttribute('href', "javascript:void(0);");
			heading.appendChild(link);
			*/

			span = document.createElement('span');
			span.className="wiki-snippet text-center";
			span.innerHTML=snippet;

			item.appendChild(heading);
			item.appendChild(span);

			itemList.appendChild(item);
		}
		this.contentDiv.appendChild(itemList);
		$(".wiki-title").click(function () {
			_this.getPage($(this).data('title'));
			/*
			if ($("#wiki-modal").attr('src') != $(this).data('url')) {
				$("#wiki-modal").attr('src', $(this).data('url'));
			}
			$("#wiki-modal").modal();
			*/
		});
	}
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
	return this.init();
}
