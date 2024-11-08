<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_66f17c34c585e',
    'title' => __('Alingsas Hero', 'modularity-alingsashero'),
    'fields' => array(
        0 => array(
            'key' => 'field_66f17c3e932aa',
            'label' => __('Herotitel', 'modularity-alingsashero'),
            'name' => 'a_hero_text',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'maxlength' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        ),
        1 => array(
            'key' => 'field_66f17f106d799',
            'label' => __('Bild', 'modularity-alingsashero'),
            'name' => 'a_hero_image',
            'aria-label' => '',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'uploader' => '',
            'return_format' => 'array',
            'acfe_thumbnail' => 0,
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
            'preview_size' => 'medium',
            'library' => 'all',
        ),
        2 => array(
            'key' => 'field_66f17c58932ab',
            'label' => __('Sök platshållartext', 'modularity-alingsashero'),
            'name' => 'a_hero_search_placeholder',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'maxlength' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        ),
        3 => array(
            'key' => 'field_66f27a0c23cf3',
            'label' => __('Snabblänkar', 'modularity-alingsashero'),
            'name' => 'quick_links',
            'aria-label' => '',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'acfe_repeater_stylised_button' => 0,
            'layout' => 'table',
            'pagination' => 0,
            'min' => 0,
            'max' => 0,
            'collapsed' => '',
            'button_label' => __('Lägg till knapp', 'modularity-alingsashero'),
            'rows_per_page' => 20,
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_66f27a1c23cf4',
                    'label' => __('Knapp', 'modularity-alingsashero'),
                    'name' => 'link',
                    'aria-label' => '',
                    'type' => 'link',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'parent_repeater' => 'field_66f27a0c23cf3',
                ),
                1 => array(
                    'key' => 'field_66f283611fe19',
                    'label' => __('Knappfärg', 'modularity-alingsashero'),
                    'name' => 'color',
                    'aria-label' => '',
                    'type' => 'radio',
                    'instructions' => __('Uppmärksam och Kantline ihop stöds inte på grund utav kontrasten', 'modularity-alingsashero'),
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'attention' => __('Uppmärksam', 'modularity-alingsashero'),
                        'primary' => __('Primär', 'modularity-alingsashero'),
                        'secondary' => __('Sekundär', 'modularity-alingsashero'),
                    ),
                    'default_value' => __('primary', 'modularity-alingsashero'),
                    'return_format' => 'value',
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'layout' => 'horizontal',
                    'save_other_choice' => 0,
                    'parent_repeater' => 'field_66f27a0c23cf3',
                ),
                2 => array(
                    'key' => 'field_66f2845a1fe1a',
                    'label' => __('Fylld / Kantline', 'modularity-alingsashero'),
                    'name' => 'style',
                    'aria-label' => '',
                    'type' => 'radio',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'filled' => __('Fylld', 'modularity-alingsashero'),
                        'outlined' => __('Kantlinje', 'modularity-alingsashero'),
                    ),
                    'default_value' => __('filled', 'modularity-alingsashero'),
                    'return_format' => 'value',
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'layout' => 'horizontal',
                    'save_other_choice' => 0,
                    'parent_repeater' => 'field_66f27a0c23cf3',
                ),
            ),
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'mod-alingsashero',
            ),
        ),
        1 => array(
            0 => array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/alingsashero',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'left',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
    'acfe_display_title' => '',
    'acfe_autosync' => array(
        0 => 'json',
    ),
    'acfe_form' => 0,
    'acfe_meta' => '',
    'acfe_note' => '',
));
}