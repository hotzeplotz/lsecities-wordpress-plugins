<?php
/*
Plugin Name: WordPress LC Galleria
Plugin URI: http://atastypixel.com/blog/wordpress/plugins/galleria-for-wordpress
Description: A plugin wrapper around the Galleria javascript gallery
Version: 1.0
Author: Michael Tyson
Author URI: http://atastypixel.com/blog
*/

function galleria_shortcode($args) {
    ob_start();
    ?>
    <div id="galleria"></div>
    <script type="text/javascript">
    Galleria.loadTheme('<?php echo WP_PLUGIN_URL.'/lc-galleria/galleria/themes/classic/galleria.classic.min.js'?>');
    var flickr = new Galleria.Flickr('<?php echo $args["api_key"] ?>');
    var anchor = (document.location.hash != '' ? document.location.hash.substring(1) : null);
    if ( anchor ) {
        flickr.getSet(anchor, { max: 200 }, function(data) {
            jQuery('#galleria').galleria({
                data_source: data,
                transition: 'fade',
                autoplay: true
            });
        });
    } else {
        flickr.getUser('<?php echo $args["account"] ?>', function(data) {
            jQuery('#galleria').galleria({
                data_source: data,
                transition: 'fade',
                autoplay: true
            });
        });
    }
    </script>
    <?php
    $c = ob_get_contents();
    ob_end_clean();
    return $c;
}

function galleria_photosets_shortcode($args) {
    ob_start();
    ?>
    <div id="galleria_photosets"></div>
    <script type="text/javascript">
    jQuery(document).ready(function() {
        galleria_populate_sets(jQuery('#galleria_photosets'), '<?php echo $args['api_key'] ?>', '<?php echo $args['user_id'] ?>');
        });
    </script>
    <?php
    $c = ob_get_contents();
    ob_end_clean();
    return $c;
}

function galleria_test_shortcode($args) {
  ob_start();
  ?>
  <div id="galleria_photosets"></div>
  <script type="text/javascript">
  $(function() {
    $('#galleria').galleria({
      flickr: 'set:<?php echo $args['flickr_set_id'] ?>',
      flickrOptions: {
        sort: 'date-posted-asc'
      }
    });
  });
  </script>  
  <?php
  $c = ob_get_contents();
  ob_end_clean();
  return $c;
}

function galleria_init() {
  wp_enqueue_script('jquery');
	wp_enqueue_script('galleria', WP_PLUGIN_URL.'/lc-galleria/galleria/galleria-1.2.5.min.js', 'jquery');
	wp_enqueue_script('galleria_flickr', WP_PLUGIN_URL.'/lc-galleria/galleria/plugins/flickr/galleria.flickr.min.js', 'galleria');
  wp_enqueue_script('galleria_theme_classic', WP_PLUGIN_URL.'/lc-galleria/galleria/themes/classic/galleria.classic.min.js', 'galleria');
	wp_enqueue_script('galleria_extras', WP_PLUGIN_URL.'/lc-galleria/galleria_extras.js', 'jquery');
}

add_action('init', 'galleria_init' );
add_shortcode('galleria', 'galleria_shortcode');
add_shortcode('galleria_photosets', 'galleria_photosets_shortcode');
add_shortcode('galleria_test', 'galleria_test_shortcode');

?>