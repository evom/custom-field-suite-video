<?php ob_start(); ?>
<iframe width="100%" height="100%" src="//www.youtube-nocookie.com/embed/<?php echo $video_id ?>?rel=0" frameborder="0" allowfullscreen></iframe>
<?php
  $template = ob_get_contents();
  ob_end_clean();
  return $template;