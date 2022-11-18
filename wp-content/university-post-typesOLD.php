<?php 


function univerity_post_types(){

  //Campus Post Type
  register_post_type('campus', array(
      'supports' => array('title', 'editor','excerpt'), // le especifico a wordpress que quiero usar estos parametros dentro del custom post type 
      'rewrite' => array('slug' => 'campuses'),
      'has_archive' => true, // permite categorias
      'public' => true,
      'menu_icon' => 'dashicons-location-alt',
      'show_in_rest' => true, // usa el nuevo editor de bloques, sino va a usar el viejo editor clasico
      'labels' => array(
        'name' => 'Campuses', // nombre que muestra en el Dashboard
        'add_new_item' => 'Add New Campus', // Titulo para agregar nuevos eventos
        'edit_item' => 'Edit Campus', // Titulo para editar eventos
        'all_items' => 'All Campuses', // Titulo para listar todos los Eventos
        'singular_name' => 'Campus'
       ) 
    )); 

  //Event Post Type
  register_post_type('event', array(
      'supports' => array('title', 'editor','excerpt'), // le especifico a wordpress que quiero usar estos parametros dentro del custom post type 
      'rewrite' => array('slug' => 'events'),
      'has_archive' => true, // permite categorias
      'public' => true,
      'menu_icon' => 'dashicons-calendar',
      'show_in_rest' => true, // usa el nuevo editor de bloques, sino va a usar el viejo editor clasico
      'labels' => array(
        'name' => 'Events', // nombre que muestra en el Dashboard
        'add_new_item' => 'Add New Event', // Titulo para agregar nuevos eventos
        'edit_item' => 'Edit Event', // Titulo para editar eventos
        'all_items' => 'All Events', // Titulo para listar todos los Eventos
        'singular_name' => 'Event'
       ) 
    )); 

  // Program Post Type
  register_post_type('program', array(
      'supports' => array('title', 'editor'), // le especifico a wordpress que quiero usar estos parametros dentro del custom post type 
      'rewrite' => array('slug' => 'programs'),
      'has_archive' => true, // permite categorias
      'public' => true,
      'menu_icon' => 'dashicons-awards',
      'show_in_rest' => true, // usa el nuevo editor de bloques, sino va a usar el viejo editor clasico
      'labels' => array(
        'name' => 'Programs', // nombre que muestra en el Dashboard
        'add_new_item' => 'Add New Program', // Titulo para agregar nuevos eventos
        'edit_item' => 'Edit Program', // Titulo para editar eventos
        'all_items' => 'All Programs', // Titulo para listar todos los Eventos
        'singular_name' => 'Program'
       ) 
    )); 

  // Professor Post Type
  register_post_type('professor', array(
      'supports' => array('title', 'editor','thumbnail'), // le especifico a wordpress que quiero usar estos parametros dentro del custom post type 
      'show_in_rest' => true, // habilita a que haya una ruta para consumir api
      'public' => true,
      'menu_icon' => 'dashicons-welcome-learn-more',
      'show_in_rest' => true, // usa el nuevo editor de bloques, sino va a usar el viejo editor clasico
      'labels' => array(
        'name' => 'Professors', // nombre que muestra en el Dashboard
        'add_new_item' => 'Add New Professor', // Titulo para agregar nuevos eventos
        'edit_item' => 'Edit Professor', // Titulo para editar eventos
        'all_items' => 'All Professors', // Titulo para listar todos los Eventos
        'singular_name' => 'Professor'
       ) 
    )); 
}
add_action('init','univerity_post_types');



?>