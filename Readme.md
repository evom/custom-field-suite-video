# Custom Field Suite Video Add-on (YouTube & Vimeo)

This is an add-on for [http://customfieldsuite.com/](Custom Field Suite - CFS WordPress Plugin). As an add-on for Custom Field Suite,
you must have CFS installed and enabled to use this plugin add-on.

The CFS Video add-on offers:

  - Restrict data-entry to a single video hosting service, or allow videos from either.
  - Video links can be entered as an ID-only, or a URL from which the ID is extracted.
  - Templating API which returns the video ID, the hosting service designator, and optionally embed code.
  - Embed code maintained in separate PHP template files for easy customization.



### Template API

Calling `CFS()->get(<field_name>)` returns an array with the video ID, service designator (`'youtube'` or `'vimeo'`), video embed URL, and optionally the embed HTML code.

    Array
      (
        [id]   => tZWmbt_d76Y
        [host] => youtube
        [url]  => //www.youtube-nocookie.com/embed/tZWmbt_d76Y
        [embed] => <iframe width="100%" height="100%" src="//www.youtube-nocookie.com/embed/tZWmbt_d76Y?rel=0" frameborder="0" allowfullscreen></iframe>    
      )



### Modifying Embed Code

The YouTube and Vimeo embed markup is stored in separate template files located in `cfs-video/assets/templates`. 
The video ID is available in the PHP variable `video_id`. Use `<?php echo $video_id ?>` to output the ID into the URL of the embed code.