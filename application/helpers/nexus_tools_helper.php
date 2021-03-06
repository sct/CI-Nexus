<?php
/*
 * Nexus Tools
 *
 * Helpers for the DCUO Nexus Site
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('comment_count'))
{
    function comment_count($comment_count) {
        if ($comment_count == 0) {
            $string = "No Comments";
        } elseif ($comment_count == 1) {
            $string = "1 Comment";
        } else {
            $string = sprintf("%s comments",$comment_count);
        }

        return $string;
    }
}

if ( ! function_exists('time_since'))
{

    /* Works out the time since the entry post, takes a an argument in unix time (seconds) */
    function time_since($original) {
        // array of time period chunks
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'minute'),
        );

        $today = time(); /* Current unix time  */
        $since = $today - $original;

        // $j saves performing the count function each time around the loop
        for ($i = 0, $j = count($chunks); $i < $j; $i++) {

            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];

            // finding the biggest chunk (if the chunk fits, break)
            if (($count = floor($since / $seconds)) != 0) {
                // DEBUG print "<!-- It's $name -->\n";
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";

        if ($i + 1 < $j) {
            // now getting the second item
            $seconds2 = $chunks[$i + 1][0];
            $name2 = $chunks[$i + 1][1];

            // add second item if it's greater than 0
            if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
                $print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
            }
        }
            if($print == '0 minutes'){ $print = '1 minute'; }

        return $print;
    }

}

function resizeThumbnailImage($thumb_image_name, $image, $ext, $width, $height, $start_width, $start_height, $scale){
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($ext) {
		case "jpg":
			$source = imagecreatefromjpeg($image);
			break;
		case "png":
			$source = imagecreatefrompng($image);
			break;
		case "gif":
			$source = imagecreatefromgif($image);
			break;
		default:
			die("WHAT HAPPENED!");
	}
	
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
	imagejpeg($newImage,$thumb_image_name,90);
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}

function user_avatar($user_id,$return = false) {
	if ($return == true) {
		if (file_exists('./assets/upload/images/avatars/avatar-'.$user_id.'.jpg')) {
			return true;
		} else { return false; }
	} else {
		echo '<img src="/assets/upload/images/avatars/avatar-'.$user_id.'.jpg" alt="User Avatar" />';
	}
}

function post_image($post_id,$size = 'small', $return = false,$atr = '') {
	switch ($size) {
		case "small":
			$dim = "70x27";
			break;
		case "medium":
			$dim = "310x121";
			break;
		case "large":
			$dim = "640x250";
			break;
		case "very_large":
			$dim = "1000x253";
			break;
	}
	if ($return == true) {
		if (file_exists('./assets/upload/images/posts/article-'.$post_id.'-'.$dim.'.jpg')) {
			return true;
		} else { return false; }
	} else {
		echo '<img src="/assets/upload/images/posts/article-'.$post_id.'-'.$dim.'.jpg" '.$atr.' />';
	}
}

?>
