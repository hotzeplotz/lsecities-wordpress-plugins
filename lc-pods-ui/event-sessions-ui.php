<?php
/*
Plugin Name: LSE Cities Event Sessions UI
Plugin URI: http://lsecities.net/labs/
Description: Customized Pods UI for Event Sessions
Version: 0.1
Author: Andrea Rota
Author URI: http://lsecities.net/
*/

function pods_ui_event_session()
{
  $icon = '';
  add_object_page('Event session', 'Event session', 'read', 'event_session', '', $icon);
  add_submenu_page('event_session', 'Event session', 'Event session', 'read', 'event_session', 'event_session_page');
}

function event_session_page()
{
  $object = new Pod('event_session');
  $add_fields = $edit_fields = array(
                    'name',
                    'session_type',
                    'sequence',
                    'start');
  $object->ui = array(
                    'title'   => 'Event session',
                    'reorder' => 'start',
                    'columns' => array(
                              'name'         => 'Title',
                              'session_type' => 'Session type',
                              'sequence'     => 'Sequence',
                              'start'        => 'Start',
                              'created'      => 'Date Created',
                              'modified'     => 'Last Modified'
                              ),
                    'add_fields'  => $add_fields,
                    'edit_fields' => $edit_fields
					);
  pods_ui_manage($object);
}

add_action('admin_menu','pods_ui_event_session');

?>
