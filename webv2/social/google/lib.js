google.load('search', '1');
function googleImageObject(content_div, default_search) {
	var __this = this;
	this.imageSearch = null;
	this.contentDiv = content_div;
	this.branding = false;
	this.brandingDiv = "image-search-branding";
	this.defaultSearch = false;
	this.formDiv = "image-search-form";
	//this.formObj = {name:"image-search-form"};
	this.searchObj = {query:"", size:"", color:"", page:0};
	this.sizeObj = {};
	this.colorObj = {};
	this.fileTypeObj = {};
	if (default_search !== null) {
		this.searchObj["query"] = default_search["query"];
		this.searchObj["size"] = default_search["size"];
		this.searchObj["color"] = default_search["color"];
		this.searchObj["page"] = default_search["page"];
		this.defaultSearch = true;
	}
	this.resultSize = 8;
	
	this.OnLoad = function() {
		// Create an Image Search instance.
		__this.imageSearch = new google.search.ImageSearch();
		// Set searchComplete as the callback function when a search is 
		// complete.  The imageSearch object will have results in it.
		__this.imageSearch.setSearchCompleteCallback(__this, __this.searchComplete, null);
		__this.initSizeColorObjects();
		if (__this.defaultSearch) {
			__this.executeSearch(__this.searchObj["query"], __this.searchObj["size"], __this.searchObj["color"]);
		}
		//Include the required Google branding
		if (__this.branding) {
			google.search.Search.getBranding(__this.brandingDiv);
		}
	};

	this.submitSearch = function (string) {
		$('.image-size-radio').each(function () {
			if ($(this).is(':checked')){
				size = $(this).attr('value');
			}
		});
		var color = "any";
		$('.image-color-radio').each(function () {
			if ($(this).is(':checked')){
				color = $(this).attr('value');
			}
		});
		this.executeSearch(string, size, color);

	};

	this.init = function () {
		google.setOnLoadCallback(this.OnLoad);
	};
	this.initSizeColorObjects = function () {
		this.sizeObj["small"] = google.search.ImageSearch.IMAGESIZE_SMALL;
		this.sizeObj["medium"]= google.search.ImageSearch.IMAGESIZE_MEDIUM;
		this.sizeObj["large"] = google.search.ImageSearch.IMAGESIZE_LARGE;
		this.sizeObj["xlarge"] = google.search.ImageSearch.IMAGESIZE_EXTRA_LARGE;
		this.sizeObj["any"] = google.search.ImageSearch.IMAGESIZE_ANY;

		this.colorObj["black"] = google.search.ImageSearch.COLOR_BLACK;
		this.colorObj["blue"] = google.search.ImageSearch.COLOR_BLUE;
		this.colorObj["brown"] = google.search.ImageSearch.COLOR_BROWN;
		this.colorObj["gray"] = google.search.ImageSearch.COLOR_GRAY;
		this.colorObj["green"] = google.search.ImageSearch.COLOR_GREEN;
		this.colorObj["orange"] = google.search.ImageSearch.COLOR_ORANGE;
		this.colorObj["pink"] = google.search.ImageSearch.COLOR_PINK;
		this.colorObj["purple"] = google.search.ImageSearch.COLOR_PURPLE;
		this.colorObj["red"] = google.search.ImageSearch.COLOR_RED;
		this.colorObj["teal"] = google.search.ImageSearch.COLOR_TEAL;
		this.colorObj["white"] = google.search.ImageSearch.COLOR_WHITE;
		this.colorObj["yellow"] = google.search.ImageSearch.COLOR_YELLOW;
		this.colorObj["any"] = google.search.ImageSearch.COLOR_ANY;

		this.fileTypeObj["jpg"] = google.search.ImageSearch.FILETYPE_JPG;
	};
	this.executeSearch = function (query, size, color) {
		this.imageSearch.setRestriction(google.search.ImageSearch.RESTRICT_IMAGESIZE, this.sizeObj[size]);
		this.imageSearch.setRestriction(google.search.ImageSearch.RESTRICT_COLORFILTER, this.colorObj[color]);
		this.imageSearch.setRestriction( google.search.ImageSearch.RESTRICT_FILETYPE, this.fileTypeObj["jpg"]);
		this.imageSearch.setResultSetSize(this.resultSize);
		this.searchObj["query"] = query;
		this.searchObj["size"] = size;
		this.searchObj["color"] = color;
		//alert(query+color+size);
		this.imageSearch.execute(query);
	};
	this.searchComplete = function () {
		// Check that we got results
		if (this.imageSearch.results && this.imageSearch.results.length > 0) {

			// Grab our content div, clear it.
			var contentDiv = document.getElementById(this.contentDiv);
			contentDiv.innerHTML = '';

			var imgList = document.createElement('ul');
			imgList.className="unstyled inline text-center";

			// Loop through our results, printing them to the page.
			var results = this.imageSearch.results;
			for (var i = 0; i < results.length; i++) {
				// For each result write it's title and image to the screen
				var result = results[i];
				var imgItem = document.createElement('li');
				imgItem.setAttribute('data-url', result.url);
				imgItem.setAttribute('title', result.width+"x"+result.height);

				/*
				var link = document.createElement('a');
				link.href="javascript:submit_form_with_url(\""+result.url+"\");";
				link.setAttribute('data-url', result.url);
				link.setAttribute('title', result.width+"x"+result.height);

				var heading = document.createElement('h5');
				heading.innerHTML = result.width+"x"+result.height;
				heading.className="text-center";
				*/
				var newImg = document.createElement('img');
				newImg.className="img-polaroid";
				// There is also a result.url property which has the escaped version
				newImg.src=result.tbUrl;

				imgItem.appendChild(newImg);
				imgList.appendChild(imgItem);
			}
			contentDiv.appendChild(imgList);
			var clearDiv = document.createElement('div');
			clearDiv.className = "clearfix";
			contentDiv.appendChild(clearDiv);
			// Now add links to additional pages of search results.
			this.addPaginationLinks();
			$(".image-color-radio").change(function(event) {
				__this.executeSearch(__this.searchObj["query"], __this.searchObj["size"], $(this).attr('value'));
			});
			$(".image-size-radio").change(function(event) {
				__this.executeSearch(__this.searchObj["query"], $(this).attr('value'), __this.searchObj["color"]);
			});
		}
	};
	this.addPaginationLinks = function () {
		// To paginate search results, use the cursor function.
		var contentDiv = document.getElementById(this.contentDiv);
		var cursor = this.imageSearch.cursor;
		var curPage = cursor.currentPageIndex; // check what page the app is on
		var next_page = document.createElement('a');
		var prev_page = document.createElement('a');
		prev_page.href="javascript:void(0);";
		next_page.href="javascript:void(0);";
		prev_page.className = "pull-left btn btn-inverse";
		prev_page.innerHTML = "Prev page";
		next_page.className = "pull-right btn btn-inverse";
		next_page.innerHTML = "Next page";
		var i = curPage - 1;
		var j = curPage + 1;
		if (curPage !== 0) {
			prev_page.addEventListener('click', function () {
				__this.imageSearch.gotoPage(i);
			});
		}
		if (curPage !== 7) {
			next_page.addEventListener('click', function () { 
				__this.imageSearch.gotoPage(j);
			});
		}
		var page_info = document.createElement('h4');
		page_info.className = "text-center";
		page_info.innerHTML=j+"/"+this.resultSize;
		contentDiv.appendChild(prev_page);
		contentDiv.appendChild(next_page);
		contentDiv.appendChild(page_info);
	};

	return this.init();
}

