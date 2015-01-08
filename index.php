<?php
/*
Plugin Name: CFS Video
Description: Adds custom video field allowing for search at YouTube and Vimeo.
Version: 1.0
*/

$cfs_video_addon = new cfs_video_addon();

class cfs_video_addon
{
    function __construct() {
      add_filter( 'cfs_field_types', array( $this, 'cfs_field_types' ) );
    }

    function cfs_field_types( $field_types )
    {
        $field_types['video'] = dirname( __FILE__ ) . '/video.php';
        return $field_types;
    }
}