<?php
/*
Plugin Name: Authors Pods UI
Plugin URI: http://lsecities.net/labs/
Description: Customized Pods UI for Authors
Version: 0.1
Author: Andrea Rota
Author URI: http://lsecities.net/
*/

function pods_ui_authors()
{
  $icon = '';
  add_object_page('Authors', 'Authors', 'read', 'authors', '', $icon);
  add_submenu_page('authors', 'Authors', 'Authors', 'read', 'authors', 'author_page');
}

function author_page()
{
  $object = new Pod('authors');
  $add_fields = $edit_fields = array(
                    'name',
                    'family_name',
                    'profile_text',
                    'organization',
                    'role');
  $object->ui = array(
                    'title'   => 'Author',
                    'columns' => array(
                              'name'         => 'Name',
                              'family_name'  => 'Family name',
                              'organization' => 'Organization',
                              'created'      => 'Date Created',
                              'modified'     => 'Last Modified'
                              ),
                    'add_fields'  => $add_fields,
                    'edit_fields' => $edit_fields
					);
  pods_ui_manage($object);
}

add_action('admin_menu','pods_ui_authors');

?>
