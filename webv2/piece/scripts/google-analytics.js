var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-41523571-1']);

// Recommanded value by Google doc and has to before the trackPageView
_gaq.push(['_setSiteSpeedSampleRate', 5]);
_gaq.push(['_trackPageview']);

(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})(); 
