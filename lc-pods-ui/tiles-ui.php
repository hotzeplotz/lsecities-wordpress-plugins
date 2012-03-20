<?php
/*
Plugin Name: LSE Cities Tiles Pods UI
Plugin URI: http://lsecities.net/labs/
Description: Customized Pods UI for Tiles
Version: 0.2
Author: Andrea Rota
Author URI: http://lsecities.net/
*/

function pods_ui_tiles()
{
  $icon = '';
  add_object_page('Tiles', 'Tiles', 'read', 'tiles', '', $icon);
  add_submenu_page('tiles', 'Tiles', 'Tiles', 'read', 'tiles', 'tile_page');
}

function tile_page()
{
  $object = new Pod('tile');
  $add_fields = $edit_fields = array(
                    'slug',
                    'name',
                    'tagline',
                    'blurb',
                    'tile_layout',
                    'class',
                    'target_page',
                    'target_uri',
                    'image',
                    'posts_category',
                    'plain_content',
                    'family');
  $object->ui = array(
                    'title'   => 'Tile',
                    'reorder' => 'displayorder',
                    'reorder_columns' => array(
                      'name' => 'Title',
                      'tagline'      => 'Subtitle',
                      'tile_layout'  => 'Layout'
                    ),
                    'columns' => array(
                              'name'         => 'Title',
                              'tagline'      => 'Subtitle',
                              'tile_layout'  => 'Layout',
                              'class'        => 'Extra classes',
                              'created'      => 'Date Created',
                              'modified'     => 'Last Modified'
                              ),
                    'add_fields'  => $add_fields,
                    'edit_fields' => $edit_fields
					);
  pods_ui_manage($object);
}

add_action('admin_menu','pods_ui_tiles');

?>
