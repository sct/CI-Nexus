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

?>
