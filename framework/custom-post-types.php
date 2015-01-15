<?php

//Projekty
function projects_type_init()
{
    $labels = array(
        'name' => 'Projekty',
        'singular_name' => 'Projekt',
        'add_new' => 'Dodaj projekt',
        'add_new_item' => 'Dodaj nowy projekt',
        'edit_item' => 'Edytuj projekt',
        'new_item' => 'Nowy projekt',
        'all_items' => 'Wszystkie projekty',
        'view_item' => 'Zobacz projekty',
        'search_items' => 'Szukaj projektów',
        'not_found' => 'Nie znaleziono',
        'not_found_in_trash' => 'Brak projektów w koszu',
        'parent_item_colon' => '',
        'menu_name' => 'Projekty'
    );

    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-index-card',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'projekty'),
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'capability_type' => 'project',
        'map_meta_cap' => true,
        'taxonomies' => array('category'),
        'supports' => array('title', 'editor', 'thumbnail')
    );

    register_post_type('projects', $args);
}

add_action('init', 'projects_type_init');


//Brygady
function brigades_type_init()
{
    $labels = array(
        'name' => 'Brygady',
        'singular_name' => 'Brygada',
        'add_new' => 'Dodaj brygadę',
        'add_new_item' => 'Dodaj nową brygadę',
        'edit_item' => 'Edytuj brygadę',
        'new_item' => 'Nowa brygada',
        'all_items' => 'Wszystkie brygady',
        'view_item' => 'Zobacz brygadę',
        'search_items' => 'Szukaj brygad',
        'not_found' => 'Nie znaleziono',
        'not_found_in_trash' => 'Brak brygad w koszu',
        'parent_item_colon' => '',
        'menu_name' => 'Brygady'
    );

    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-groups',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'brygady'),
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'capability_type' => 'brigade',
        'map_meta_cap' => true,
        'taxonomies' => array('category'),
        'supports' => array('title', 'editor', 'thumbnail')
    );

    register_post_type('brigades', $args);
}

add_action('init', 'brigades_type_init');


//Partnerzy
function partners_type_init()
{
    $labels = array(
        'name' => 'Partnerzy',
        'singular_name' => 'Partnerzy',
        'add_new' => 'Dodaj partnerów',
        'add_new_item' => 'Dodaj nowych partnerów',
        'edit_item' => 'Edytuj partnerów',
        'new_item' => 'Nowi partnerzy',
        'all_items' => 'Wszyscy partnerzy',
        'view_item' => 'Zobacz partnerów',
        'search_items' => 'Szukaj partnerów',
        'not_found' => 'Nie znaleziono',
        'not_found_in_trash' => 'Brak partnerów w koszu',
        'parent_item_colon' => '',
        'menu_name' => 'Partnerzy'
    );

    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-star-empty',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'partnerzy'),
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'capability_type' => 'partner',
        'map_meta_cap' => true,
        'taxonomies' => false,
        'supports' => array('title')
    );

    register_post_type('partners', $args);
}

add_action('init', 'partners_type_init');


//Wydarzenia
function events_type_init()
{
    $labels = array(
        'name' => 'Wydarzenia',
        'singular_name' => 'Wydarzenie',
        'add_new' => 'Dodaj wydarzenie',
        'add_new_item' => 'Dodaj nowe wydarzenie',
        'edit_item' => 'Edytuj wydarzenie',
        'new_item' => 'Nowe wydarzenie',
        'all_items' => 'Wszystkie wydarzenia',
        'view_item' => 'Zobacz wydarzenie',
        'search_items' => 'Szukaj wydarzenia',
        'not_found' => 'Nie znaleziono',
        'not_found_in_trash' => 'Brak wydarzeń w koszu',
        'parent_item_colon' => '',
        'menu_name' => 'Wydarzenia'
    );

    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-calendar-alt',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'wydarzenia'),
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'taxonomies' => false,
        'supports' => array('title', 'editor', 'thumbnail')
    );

    register_post_type('events', $args);
}

add_action('init', 'events_type_init');