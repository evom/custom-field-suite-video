<?php ob_start(); ?>
<iframe src="//player.vimeo.com/video/<?php echo $video_id ?>" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<?php
  $template = ob_get_contents();
  ob_end_clean();
  return $template;