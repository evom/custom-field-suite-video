<?php

class cfs_video extends cfs_field
{

    function __construct()
    {
        $this->name = 'video';
        $this->label = __('Video', 'cfs');
    }



      /*
        stdClass Object
      (
          [type] => video
          [input_name] => cfs[input][3][value]
          [input_class] => video
          [options] => Array
              (
                  [services] => all
                  [return_value] => embed
                  [required] => 0
              )

          [value] =>
          [id] => 3
          [group_id] => 86
      )
      */
    function html($field)
    {
    if ( !empty( $field->value ) ) {

    }
    $svcs = isset($field->options['services']) ? $field->options['services'] : 'all';
    ?>
    <label>Service: </label>
    <select name="video_select_<?php echo $field->id ?>" class="<?php echo $field->input_class; ?>_select">
      <?php  if( $svcs == 'all' || $svcs == 'youtube' ): ?>
        <?php $selected = ($svcs == 'youtube' ? ' selected' : '') ?>
        <option value="youtube"<?php echo $selected; ?>>YouTube</option>
      <?php endif; ?>

      <?php  if( $svcs == 'all' || $svcs == 'vimeo' ): ?>
        <?php $selected = ($svcs == 'vimeo' ? ' selected' : '') ?>
        <option value="vimeo"<?php echo $selected; ?>>Vimeo</option>
      <?php endif; ?>
    </select>
      <label>Video ID: </label>
      <input type="text" name="video_<?php echo $field->id ?>" class="<?php echo $field->input_class; ?>_input" value="" />
      <input type="hidden" name="<?php echo $field->input_name; ?>" class="video_value" value="<?php echo $field->value; ?>" />
    <?php
    }


    function checked($val, $test){
      if( $val == $test )
        echo ' checked="checked"';
    }

    function options_html($key, $field)
    {
      $svc = $this->get_option($field, 'services', 'all');
    ?>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e('Services', 'cfs'); ?></label>
            </td>
            <td>
              <input type="radio" name="cfs[fields][<?php echo $key; ?>][options][services]" value="all" <?php checked($svc, 'all') ?>>All&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" name="cfs[fields][<?php echo $key; ?>][options][services]" value="youtube" <?php checked($svc, 'youtube') ?>>YouTube&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" name="cfs[fields][<?php echo $key; ?>][options][services]" value="vimeo" <?php checked($svc, 'vimeo') ?>>Vimeo
              <p class="description"><?php _e('Which services are supported?', 'cfs'); ?></p>
            </td>
        </tr>

        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e('Return Value', 'cfs'); ?></label>
            </td>
            <td>
                <?php
                  CFS()->create_field(array(
                      'type' => 'select',
                      'input_name' => "cfs[fields][$key][options][return_value]",
                      'options' => array(
                          'choices' => array(
                              'embed' => __('Embed Code', 'cfs'),
                              'id' => __('Video ID', 'cfs')
                          ),
                          'force_single' => true,
                      ),
                      'value' => $this->get_option($field, 'return_value', 'embed'),
                  ));
                ?>
            </td>
        </tr>

        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e('Validation', 'cfs'); ?></label>
            </td>
            <td>
              <?php
                CFS()->create_field(array(
                    'type' => 'true_false',
                    'input_name' => "cfs[fields][$key][options][required]",
                    'input_class' => 'true_false',
                    'value' => $this->get_option($field, 'required'),
                    'options' => array('message' => __('This is a required field', 'cfs')),
                ));
              ?>
            </td>
        </tr>
    <?php
    }




    function input_head($field = null)
    {
    ?>
        <script>
        (function($) {

          $(function() {

            $(document).on('cfs/ready', '.cfs_add_field', function() {
                $('.cfs_video:not(.ready)').cfs_init_video();
            });
            $('.cfs_video').cfs_init_video();
          });

          function update_field_value($field){
            var val, svc;
            val = $field.find('input.video_input').val();
            svc = $field.find('select').val();
            console.log( "-->Video Id:", val , svc);
            $field.find('input.video_value').val(svc + "|" + val);
          };

          function init_fields($field){
            var re, val = $field.find('input.video_value').val();
            var svc;
            if( val === '' ){
              return;
            }
            re = /^([^|]+)\|(.+)/;
            var matches = val.match(re);
            if( matches ){
              $field.find('input.video_input').val(matches[2]);
              $field.find('select').val(matches[1]);
            }
          };

          $.fn.cfs_init_video = function() {
            this.each(function() {
              var $this = $(this);
              $this.addClass('ready');
              init_fields($this);

              // handle video ID change
              $this.find('input.video_input').on('blur', function() {
                update_field_value($this);
              });
              // handle video service change
              $this.find('select.video_select').on('change', function() {
                update_field_value($this);
              });
            });
          }
        })(jQuery);
        </script>
    <?php
    }




    function format_value_for_api($value, $field = null)
    {
      if( empty($value) )
        return $value;
      list($service, $id) = explode ('|' , $value, 2 );
      $val = array('id'      => $id);
      if( $service == 'youtube' ){
        $val['url'] = '//www.youtube-nocookie.com/embed/' . $id;
      }else{
        $val['url'] = '//player.vimeo.com/video/' . $id;
      }
      if($field->options['return_value'] == 'embed' ){
        $val['embed'] = '<embed code here>';
      }else{
        $val['service'] = $service;
      }
      return $val;
    }
        /*
          <iframe width="1280" height="720" src="//www.youtube-nocookie.com/embed/UW9DWd48fSE?rel=0" frameborder="0" allowfullscreen></iframe>

<iframe src="//player.vimeo.com/video/116160160" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> <p><a href="http://vimeo.com/116160160">She & Him 'Stay Awhile'</a> from <a href="http://vimeo.com/lawebdecanada">CANADA</a> on <a href="https://vimeo.com">Vimeo</a>.</p>

        stdClass Object
        (
            [id] => 3
            [name] => video_field
            [label] => Video Field
            [type] => video
            [notes] => this is the notes field
            [parent_id] => 0
            [weight] => 0
            [options] => Array
                (
                    [services] => all
                    [return_value] => embed
                    [required] => 0
                )

            [group_id] => 86
        )
        */
}
