<?php
ini_set("display_errors", 1);
// load Zend classes
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');

// define search query
$query = isset($_POST['query'])?$_POST['query']:'eminem';
$query = isset($_REQUEST['query'])?$_REQUEST['query']:'dog skateboarding';
$count = isset($_REQUEST['count'])?$_REQUEST['count']:15;
$retval = array();
$info = $query;

try {
	// initialize REST client
	$youtube = new Zend_Gdata_YouTube();
	$youtube->setMajorProtocolVersion(2);
	$location = Zend_Gdata_YouTube::VIDEO_URI;
	// set query parameters
	$videoFeed = $youtube->getVideoFeed($location);
	$youtubeQuery = $youtube->newVideoQuery();
	$youtubeQuery->setOrderBy('relevance');
	$youtubeQuery->setMaxResults($count);
	$youtubeQuery->setSafeSearch('none');
	$youtubeQuery->setVideoQuery($query);

	// Note that we need to pass the version number to the youtubeQuery URL function
	// to ensure backward compatibility with version 1 of the API.
	$videoFeed = $youtube->getVideoFeed($youtubeQuery->getQueryUrl(2));
	printVideoFeed($videoFeed, 'Search results for: ' . $query);
	//printVideoFeed($videoFeed);

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}
/*
foreach ($result->query->search->p as $r):
	$title = $r['title'];
	$snippet = $r['snippet'];
	//$retval .= "<li><a href='http://www.youtube.org/wiki/$title'>$title</a><br/><small>$snippet</small></li>";
	array_push($retval, $r);
endforeach;
*/
$arr = array("retval"=>$retval, "info"=>$info);
echo json_encode($arr);
function printVideoFeed($videoFeed) {
	global $retval;
	$count = 1;
	foreach ($videoFeed as $videoEntry) {
		$details = array();
		//echo "Entry # " . $count . "\n";
		$details["title"] = $videoEntry->getVideoTitle();
		//echo 'Video: ' . $videoEntry->getVideoTitle() . "<br/>";
		$details["id"] = $videoEntry->getVideoId();
		//echo 'Video ID: ' . $videoEntry->getVideoId(). "<br/>";
		//echo 'Updated: ' . $videoEntry->getUpdated() . "<br/>";
		//echo 'Description: ' . $videoEntry->getVideoDescription() . "<br/>";
		$details["description"] = $videoEntry->getVideoDescription();

		//echo 'Category: ' . $videoEntry->getVideoCategory() . "<br/>";
		$details["category"] = $videoEntry->getVideoCategory();

		//echo 'Tags: ' . implode(", ", $videoEntry->getVideoTags()) . "<br/>";
		//echo 'Watch page: ' . $videoEntry->getVideoWatchPageUrl() . "<br/>";
		$details["watch_url"] = $videoEntry->getVideoWatchPageUrl();
		$details["url"] = "http://youtube.com/embed/".$videoEntry->getVideoId()."?autoplay=1&enablejsapi=1";

		//echo 'Flash Player Url: ' . $videoEntry->getFlashPlayerUrl() . "<br/>";
		//echo 'Duration: ' . $videoEntry->getVideoDuration() . "<br/>";
		$hour="";
		$duration = intval($videoEntry->getVideoDuration());
		$minutes = intval($duration/60);
		$seconds = $duration%60;
		if ($minutes >= 60) {
			$hour = intval($minutes/60).":";
			$minutes = $minutes % 60;
		}
		if ($minutes <10 ){
			$minutes = "0".$minutes;
		}
		if ($seconds <10 ){
			$seconds = "0".$seconds;
		}
		$details["duration"] = $hour.$minutes.":".$seconds;

		//echo 'View count: ' . $videoEntry->getVideoViewCount() . "<br/>";
		$details["count"] = $videoEntry->getVideoViewCount();

		//echo 'Rating: ' . $videoEntry->getVideoRatingInfo() . "<br/>";
		//echo 'Geo Location: ' . $videoEntry->getVideoGeoLocation() . "<br/>";
		//echo 'Recorded on: ' . $videoEntry->getVideoRecorded() . "<br/>";

		// see the paragraph above this function for more information on the 
		// 'mediaGroup' object. in the following code, we use the mediaGroup
		// object directly to retrieve its 'Mobile RSTP link' child
		/*
		foreach ($videoEntry->mediaGroup->content as $content) {
			if ($content->type === "video/3gpp") {
				echo 'Mobile RTSP link: ' . $content->url . "<br/>";
			}
		}
		*/

		//echo "Thumbnails:\n";
		$videoThumbnails = $videoEntry->getVideoThumbnails();

		foreach($videoThumbnails as $videoThumbnail) {
		//	echo $videoThumbnail['url'];
			$details["thumbnail"] = $videoThumbnail['url'];

		//	echo ' height=' . $videoThumbnail['height'];
		//	echo ' width=' . $videoThumbnail['width'] . "\n";
			break;
		}
		//echo "<br/>---------------------------------------------------------------------------------------------<br/>";
		$count++;
		array_push($retval, $details);
	}
}
