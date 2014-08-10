<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
//ini_set('display_errors', 1);

require_once('src/facebook.php');
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array('appId'=>'198065340365247','secret'=>'qwjeqwiuejhwqdquwdhaqdqwueqwqqwq'));
$query = "sachin tendulkar";
if (isset($_POST['query'])) {
	$query = $_POST['query'];
}
$info = "";

$type="page";
$type="post";
$encoded_query = rawurlencode($query);
$query_str = "/search?q=$encoded_query&type=$type";
//echo $query_str;
// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
/*
// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}
*/
// This call will always work since we are fetching public data.
$result = $facebook->api("$query_str");
$result = json_encode($result);
$json_arr = json_decode($result);
if (!isset($_POST['query'])) {
	print var_dump($json_arr);
	exit;
}
$retval = array();
foreach ($json_arr->data as $temp):
	if ($type == "post") {
		array_push($retval, array("user"=>$temp->from->name, "post"=>$temp->message));
	} else if ($type == "page"){
		array_push($retval, array("user"=>$temp->name, "post"=>$temp->category, "id"=>$temp->id));
	}
	//$retval .= "<li>$message<br/>by $publisher.</li>";
endforeach;
//$retval .="</ol>";
//print var_dump($result);
$arr = array("retval"=>$retval, "info"=>$info);
echo json_encode($arr);
?>
