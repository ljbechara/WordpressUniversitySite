<?php 

require get_theme_file_path('/inc/search-route.php');

function univeristy_custom_rest(){
  register_rest_field('post','authorName', array(
    'get_callback' => function() { return get_the_Author();}
  ));// ('a que api aplica',' nombre nueva variable', array con detalles de lo que devuelve)
}

add_action('rest_api_init', 'univeristy_custom_rest');
// customiza las variables que trae el json en las apis


function pageBanner($args = NULL){
  if (!$args['title']) {
    $args['title'] = get_the_title();
  }

  if (!$args['subtitle']) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }

  if (!$args['photo']) {
//we check to see if the current post has a banner image custom field value or not... we want to add two more conditions to make sure the current query is not an archive or a blog listing. 
    if (get_field('page_banner_background_image') AND !is_archive() AND !is_home()) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    }else{
      $args['photo'] = get_theme_file_uri('images/ocean.jpg');
    }
  }

  ?>
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php 
        echo $args['photo'] ?>);"> </div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
        <div class="page-banner__intro">
          <p><?php echo $args['subtitle']; ?></p>
        </div>
      </div>
    </div>

<?php }

function university_files() {
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  
  wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyAMi-NRL_0p5h9i8Jgz6FAXUps_S_6W_sc', NULL, '1.0', true);

  wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  
  wp_enqueue_style('our-main-styles-vendor', get_theme_file_uri('/build/index.css'));
  wp_enqueue_style('our-main-styles', get_theme_file_uri('/build/style-index.css'));

  wp_localize_script('main-university-js', 'universityData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest')
  ));

}

add_action('wp_enqueue_scripts','university_files');


function university_features(){
	
	add_theme_support('title-tag'); // Agrega titulo a solapa del navegador
  add_theme_support('post-thumbnails'); // agrega la funcion de features images a los posts , pero no a los custom posts
  add_image_size('professorLandscape',400,260,true);// nickname, ancho, alto, cropping
  add_image_size('professorPortrait',480,650,true);

  add_image_size('pageBanner',1500,350,true);
}

add_action('after_setup_theme','university_features'); // durante el evento after_setup_theme ejecuta la funcion university_features


function university_adjust_queries($query){

  if (!is_admin() AND is_post_type_archive('campus') AND is_main_query()) {
      $query->set('posts_per_page', -1); // todos
  }


  if (!is_admin() AND is_post_type_archive('program') AND is_main_query()) {
      $query->set('orderby','title');
      $query->set('order', 'ASC');
      $query->set('posts_per_page',-1); // todos

  }

  if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query() ){ // si esta en el FRONT-END y es del tipo event
    $today = date('Ymd');
    $query->set('meta_key','event_date');
    $query->set('orderby','meta_value_num');
    $query->set('order','ASC');
    $query->set('meta_query',array( // multiples filtros para nuestra busqueda
                array( // si queremos meter mas condiciones al query , agregamos otro array
                  'key' => 'event_date',
                  'compare' => '>=',
                  'value' => $today,
                  'type' => 'numeric' // especificamos que tipo de comparacion estamos haciendo
                )
              ));
  }
  
}
add_action('pre_get_posts','university_adjust_queries'); // evento->justo antes de obtener los posts

function universityMapKey($api){
  $api['key'] = 'AIzaSyAMi-NRL_0p5h9i8Jgz6FAXUps_S_6W_sc';
  return $api;
}

add_filter('acf/fields/google_map/api','universityMapKey');
?>