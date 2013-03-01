<?php
/*
Plugin Name: Mobile Only
Description: This will enable only mobile devices to view the site.
Version: 1.0
Author: Suranga Rupasinghe
Author URI: http://www.sucreaitons.com 
Plugin URI: http://www.sucreaitons.com/blog/
*/
?>
<?php
 
add_action('send_headers', 'sc_mobile_header');
 
function sc_mobile_header(){    
    // return 404 header if it is not a mobile device or not wordpress backend
    if (isMobile() == 'false' && isWPAdmin() == 'false') {       
       header('HTTP/1.0 404 Not Found');
       die();
    }
}
 
// check your browser agent to identify mobile device
function isMobile(){
    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
    $arg = "false";
    if (stripos($ua,'android') || stripos($ua,'ipad') || stripos($ua,'iphone') || stripos($ua,'webos') !== false) {
        $arg = "true";
    }
    return $arg;    
}
 
// check whether you are accessing the wordpress backend
function isWPAdmin() {
  $pageURL = 'http';
  $arg = "false";
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
  if (stripos($pageURL,'wp-admin')){
    $arg = "true";
  }
  return $arg;    
}
 
?>