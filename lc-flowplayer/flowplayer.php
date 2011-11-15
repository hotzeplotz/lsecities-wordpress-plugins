<?php
/*
Plugin Name: WordPress LC Flowplayer
Plugin URI: http://lsecities.net/
Description: A plugin wrapper around the Flowplayer video player
Version: 1.0
Author: Andrea Rota
Author URI: http://lsecities.net/
*/

function flowplayer_shortcode($args) {
  ob_start();
  ?>
  <div>
    <a id="flowplayer" style="height: <?php echo ($args['height'] ? $args['height'] : '300'); ?>px;"></div>
    </a>
    <script type="text/javascript">
      flowplayer("flowplayer", "<?php echo WP_PLUGIN_URL.'/lc-flowplayer/flowplayer/flowplayer-3.2.7.swf'; ?>", {
        clip: {
          url: '<?php echo $args['url']; ?>',
          live: <?php echo ($args['live'] == 'true' ? 'true' : 'false'); ?>,
          provider: 'rtmp'
        },
        plugins: {
          rtmp: {
            url: 'flowplayer.rtmp-3.2.3.swf',
            netConnectionUrl: '<?php echo $args['netconnectionurl']; ?>'
          }
        }
      });
    </script>
  </div>
  <?php
  $c = ob_get_contents();
  ob_end_clean();
  return $c;
}

function flowplayer_init() {
	wp_enqueue_script('flowplayer', WP_PLUGIN_URL.'/lc-flowplayer/flowplayer/flowplayer-3.2.6.min.js', 'jquery');
}

add_action('init', 'flowplayer_init' );
add_shortcode('flowplayer', 'flowplayer_shortcode');

?>
