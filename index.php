<?php
/*
Plugin Name: Custom Field Suite - Video
Version: 1.0
Plugin URI: https://github.com/evom
Description: YouTube and Vimeo Video field allowing for search at YouTube and Vimeo.
Author: Wayne K. Walrath
Author URI: https://github.com/wkw
Text Domain: cfs
Tags: custom fields,fields,metabox,postmeta,video,youtube,vimeo
License:
	The MIT License (MIT)

	Copyright (c) 2015 Evolving Media Network, http://www.evolvingmedia.net/

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.

*/
$cfs_video_addon = new cfs_video_addon();

class cfs_video_addon
{
    function __construct() {
      define( 'CFS_VIDEO_DIR', dirname( __FILE__ ) );
      add_filter( 'cfs_field_types', array( $this, 'cfs_field_types' ) );
    }

    function cfs_field_types( $field_types )
    {
        $field_types['video'] = CFS_VIDEO_DIR . '/includes/video.php';
        return $field_types;
    }
}