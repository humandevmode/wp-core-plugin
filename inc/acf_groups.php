<?php

if(function_exists('acf_add_local_field_group')) {

acf_add_local_field_group(array (
  'key' => 'group_5b700550b44f9',
  'title' => 'Forecast',
  'fields' => 
  array (
    0 => 
    array (
      'key' => 'field_5b700578ff66f',
      'label' => 'Начало матча',
      'name' => 'start_date',
      'type' => 'date_time_picker',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => 
      array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'display_format' => 'Y-m-d H:i:s',
      'return_format' => 'Y-m-d H:i:s',
      'first_day' => 1,
    ),
    1 => 
    array (
      'key' => 'field_5b70372f55ce9',
      'label' => 'True',
      'name' => 'true',
      'type' => 'true_false',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => 
      array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'message' => '',
      'default_value' => 0,
      'ui' => 0,
      'ui_on_text' => '',
      'ui_off_text' => '',
    ),
    2 => 
    array (
      'key' => 'field_5b7083f80ac09',
      'label' => 'Number',
      'name' => 'number',
      'type' => 'number',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => 
      array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'min' => '',
      'max' => '',
      'step' => '',
    ),
    3 => 
    array (
      'key' => 'field_5b713ffb04c79',
      'label' => 'Post',
      'name' => 'post',
      'type' => 'post_object',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => 
      array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'post_type' => 
      array (
      ),
      'taxonomy' => 
      array (
      ),
      'allow_null' => 0,
      'multiple' => 1,
      'return_format' => 'id',
      'ui' => 1,
    ),
  ),
  'location' => 
  array (
    0 => 
    array (
      0 => 
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

}