$(document).ready(function() {
	var imageObj = new googleImageObject("image-search-content", null);
	var wikiObj = new wikiSearchObject("wiki-search-content");
	var twitterObj = new twitterSearchObject("twitter-search-content");
	var facebookObj = new facebookSearchObject("facebook-search-content");
	var flickrObj = new flickrSearchObject("flickr-search-content");
	var redditObj = new redditSearchObject("reddit-search-content");
	var youtubeObj = new youtubeSearchObject("youtube-search-content");
	$("#search-form").submit(function(event) {
		//$(".content-holder").html("<ul class='text-center unstyled'><img class=text-center src='images/loading.gif' /></ul>");
		event.preventDefault();
		var string = document.getElementById("search-query").value;
		searchSocialSites(string);
	});
	function searchSocialSites(string) {
		//imageObj.submitSearch(string);
		wikiObj.submitSearch(string);
		twitterObj.submitSearch(string);
		//facebookObj.submitSearch(string);
		//flickrObj.submitSearch(string);
		redditObj.submitSearch(string);
		youtubeObj.submitSearch(string);
	}
	searchSocialSites($("#search-query").data('query'));
	$('#wiki-modal').bind('hidden', function () {
		var iframe = this.contentWindow;
		iframe.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
	});
	//$('#wiki-modal-iframe').attr('src', 'http://wikipedia.com/wiki/Caffeine');
	$('#wiki-modal').load(function(){
		window.location.href = "#wiki-modal";
	});
});

