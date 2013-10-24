google.load('search', '1');
var imageSearch;
var searchString = "";
var searchSize = "";
var searchColor = "";
var searchPage = "";
var sizeObj = {};
var colorObj = {};
google.setOnLoadCallback(OnLoad);
function addPaginationLinks() {
	// To paginate search results, use the cursor function.
	var cursor = imageSearch.cursor;
	var curPage = cursor.currentPageIndex; // check what page the app is on
	var next_page = document.getElementById('next-page');
	var prev_page = document.getElementById('prev-page');
	var page_info = document.getElementById('page-info');
	var i = curPage - 1;
	var j = curPage + 1;
	if (curPage == 0) {
		prev_page.href="javascript:void(0);";
	} else {
		prev_page.href="javascript:imageSearch.gotoPage("+i+");";
	}
	if (curPage == 7) {
		next_page.href="javascript:void(0);";
	} else {
		next_page.href="javascript:imageSearch.gotoPage("+j+");";
	}
	page_info.innerHTML=j+"/8";
	/*
	link.href="javascript:imageSearch.gotoPage("+i+");";
	var pagesDiv = document.createElement('div');
	for (var i = 0; i < cursor.pages.length; i++) {
		var page = cursor.pages[i];
		if (curPage == i) { 
			// If we are on the current page, then don't make a link.
			var label = document.createTextNode(' ' + page.label + ' ');
			pagesDiv.appendChild(label);
		} else {
			// Create links to other pages using gotoPage() on the searcher.
			var link = document.createElement('a');
			link.href="javascript:imageSearch.gotoPage("+i+");";
			link.innerHTML = page.label;
			link.style.marginRight = '2px';
			pagesDiv.appendChild(link);
		}
	}
	var contentDiv = document.getElementById('page-content');
	contentDiv.appendChild(pagesDiv);
	*/
}

function searchComplete() {
	// Check that we got results
	if (imageSearch.results && imageSearch.results.length > 0) {

		// Grab our content div, clear it.
		var contentDiv = document.getElementById('content');
		contentDiv.innerHTML = '';
		document.getElementById('page-content').innerHTML = '';

		// Loop through our results, printing them to the page.
		var results = imageSearch.results;
		for (var i = 0; i < results.length; i++) {
			// For each result write it's title and image to the screen
			var result = results[i];
			var imgContainer = document.createElement('li');
			//var title = document.createElement('div');

			var link = document.createElement('a');
			link.href="javascript:submit_form_with_url(\""+result.url+"\");";
			link.setAttribute('data-url', result.url);
			link.setAttribute('title', result.width+"x"+result.height);

			//link.className='pull-left';
			// We use titleNoFormatting so that no HTML tags are left in the 
			// title
			//title.innerHTML = result.titleNoFormatting;
			var heading = document.createElement('h5');
			heading.innerHTML = result.width+"x"+result.height;
			heading.className="text-center";
			var newImg = document.createElement('img');
			newImg.className="img-polaroid img-thumbnail";
			// There is also a result.url property which has the escaped version
			newImg.src=result.tbUrl;
			link.appendChild(newImg);
			//imgContainer.appendChild(title);
			imgContainer.appendChild(heading);
			imgContainer.appendChild(link);
			// Put our title + image in the content
			contentDiv.appendChild(imgContainer);
		}
		// Now add links to additional pages of search results.
		addPaginationLinks(imageSearch);
	}
}
function execute_search(str, size, color) {
	var query = "Ana Ivanovic";
	if (str) {
		query = str;
	}
	imageSearch.setRestriction(google.search.ImageSearch.RESTRICT_IMAGESIZE, sizeObj[size]);
	imageSearch.setRestriction(google.search.ImageSearch.RESTRICT_COLORFILTER, colorObj[color]);
	imageSearch.setRestriction( google.search.ImageSearch.RESTRICT_FILETYPE, google.search.ImageSearch.FILETYPE_JPG);
	imageSearch.setResultSetSize(8);
	searchString = query;
	searchSize = size;
	searchColor = color;
	imageSearch.execute(query);

}
function OnLoad() {
	// Create an Image Search instance.
	imageSearch = new google.search.ImageSearch();

	sizeObj["small"] = google.search.ImageSearch.IMAGESIZE_SMALL;
	sizeObj["medium"]= google.search.ImageSearch.IMAGESIZE_MEDIUM;
	sizeObj["large"] = google.search.ImageSearch.IMAGESIZE_LARGE;
	sizeObj["xlarge"] = google.search.ImageSearch.IMAGESIZE_EXTRA_LARGE;
	sizeObj["any"] = google.search.ImageSearch.IMAGESIZE_ANY;

	colorObj["black"] = google.search.ImageSearch.COLOR_BLACK;
	colorObj["blue"] = google.search.ImageSearch.COLOR_BLUE;
	colorObj["brown"] = google.search.ImageSearch.COLOR_BROWN;
	colorObj["gray"] = google.search.ImageSearch.COLOR_GRAY;
	colorObj["green"] = google.search.ImageSearch.COLOR_GREEN;
	colorObj["orange"] = google.search.ImageSearch.COLOR_ORANGE;
	colorObj["pink"] = google.search.ImageSearch.COLOR_PINK;
	colorObj["purple"] = google.search.ImageSearch.COLOR_PURPLE;
	colorObj["red"] = google.search.ImageSearch.COLOR_RED;
	colorObj["teal"] = google.search.ImageSearch.COLOR_TEAL;
	colorObj["white"] = google.search.ImageSearch.COLOR_WHITE;
	colorObj["yellow"] = google.search.ImageSearch.COLOR_YELLOW;
	colorObj["any"] = google.search.ImageSearch.COLOR_ANY;
	// Set searchComplete as the callback function when a search is 
	// complete.  The imageSearch object will have results in it.
	imageSearch.setSearchCompleteCallback(this, searchComplete, null);

	// Find me a beautiful car.
	searchString = document.getElementById('searchstr').value;
	searchColor = document.getElementById('searchcolor').value;
	searchSize = document.getElementById('searchsize').value;
	if (searchString){
		execute_search(searchString, searchSize, searchColor);
		document.getElementById('search-query').value = searchString;
	}

	// Include the required Google branding
	//google.search.Search.getBranding('branding');
}
