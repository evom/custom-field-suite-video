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

Copyright 2015 Evolving Media Network
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, see <http://www.gnu.org/licenses/>.

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