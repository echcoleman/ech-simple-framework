<?php

/**
 * Utility functions
 */


/**
 * Get site URL path
 * 
 * @param string $path URL path string
 * @return string URL path
 */
function siteurl($path) {
	// add http to www. addresses
	if (strpos($path, 'www.') === 0) {
		$path = 'http://' . $path;
	}
	// check if path relative, if so add site url
	elseif (
		(strpos($path, '://') === false &&
		(strpos($path, 'javascript:') !== 0) &&
		(strpos($path, 'mailto:') !== 0)) &&
		(strncmp($path, '#', 1))
	) {
		$path = SITEURL . $path;
	}

	return $path;
}

/**
 * Forward to URL
 * 
 * @param string $url Relative or absolute URL
 */
function forward($url) {
	$url = siteurl($url);
	header('Location: ' . $url);
	exit;
}

/**
 * Helper function to output data
 * 
 * @param mixed $var Variable to output
 */
function pr($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

/**
 * Helper function to output data and exit
 * 
 * @param mixed $var Variable to output
 */
function prd($var) {
    pr($var);
    exit;
}

?>