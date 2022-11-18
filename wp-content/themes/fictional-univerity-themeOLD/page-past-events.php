<?php
get_header();


pageBanner(array(
  'title' => 'Past Events',
  'subtitle' => 'A recap of our past events'
));

?>

<div class="container container--narrow page-section">
<?php

	$today = date('Ymd');
    $pastEvents = new WP_Query(array(
      'paged'=> get_query_var('paged',1),  	
      'post_type' => 'event',
      'orderby' => 'meta_value_num',// por defult esta ordenado por 'post_date'.. meta_value refiere a los custom fields creados (en este caso por el plugin ACF)
      'meta_key' => 'event_date', // espeficificamos el meta_key 
      'order' => 'ASC',
      'meta_query' => array( // multiples filtros para nuestra busqueda
        array( // si queremos meter mas condiciones al query , agregamos otro array
          'key' => 'event_date',
          'compare' => '<',
          'value' => $today,
          'type' => 'numeric' // especificamos que tipo de comparacion estamos haciendo
        )
      )
    ));

	while ($pastEvents->have_posts()) {
		$pastEvents->the_post();

    get_template_part('template-parts/content-event');

    }

//pagination links
echo paginate_links(array(
	'total' => $pastEvents->max_num_pages
));

?>	
</div>


<?php 
get_footer();


?>