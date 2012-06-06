<?php
/*
Plugin Name: LSE Cities People Pods UI
Plugin URI: http://lsecities.net/labs/
Description: Customized Pods UI for People
Version: 0.3.4
Author: Andrea Rota
Author URI: http://lsecities.net/
*/

function pods_ui_people()
{
  $icon = '';
  add_object_page('People', 'People', 'read', 'people', '', $icon);
  add_submenu_page('people', 'People', 'People', 'read', 'people', 'person_page');
}

function person_page()
{
  $object = new Pod('authors');
  $add_fields = $edit_fields = array(
                    'slug',
                    'name',
                    'family_name',
                    'profile_text',
                    'organization',
                    'role',
                    'additional_affiliations',
                    'qualifications',
                    'staff_pages_blurb',
                    'office_location',
                    'display_after',
                    'display_until',
                    'extended_blurb',
                    'groups',
                    'research_projects');
  $object->ui = array(
                    'title'   => 'Person',
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

add_action('admin_menu','pods_ui_people');

?>
