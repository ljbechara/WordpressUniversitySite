<?php

add_action('rest_api_init','universityRegisterSearch');

function universityRegisterSearch(){
		// (namespace, route, array con detalles )
	register_rest_route('university/v1','search', array(
		'methods'  => WP_REST_SERVER::READABLE, // es lo mismo que poner 'GET' pero algunos hostings fallan
		'callback' => 'universitySearchResults'
	));

}

function universitySearchResults( $data ){ // $data es lo que va a buscar
	$mainQuery =  new WP_Query(array(
		'post_type' => array ('professor','page','post', 'program','campus', 'event'), // en qeu tipo de post vamos a buscar... con el array podemos buscar 
		's' => sanitize_text_field( $data['term'] )  // 's' DE SEARCH
	));

	$results = array(
		'generalInfo' 	=> array(),
		'professors'	=> array(),
		'programs'		=> array(),
		'events'		=> array(),
		'campuses'		=> array()
	);

	while($mainQuery->have_posts()){
		$mainQuery->the_post(); // este metodo permite el acceso a los datos del post actual

		if(get_post_type()=='post' OR get_post_type()=='page'){
				array_push($results['generalInfo'], array(
				'title' => get_the_title(),
				'permalink' => get_the_permalink(),
				'postType' => get_post_type(),
				'authorName' => get_the_author()
			));
		}

		if(get_post_type()=='professor'){
				array_push($results['professors'], array(
				'title' => get_the_title(),
				'permalink' => get_the_permalink()
			));
		}

		if(get_post_type()=='program'){
				array_push($results['programs'], array(
				'title' => get_the_title(),
				'permalink' => get_the_permalink()
			));
		}

		if(get_post_type()=='campus'){
				array_push($results['campuses'], array(
				'title' => get_the_title(),
				'permalink' => get_the_permalink()
			));
		}

		if(get_post_type()=='event'){
				array_push($results['events'], array(
				'title' => get_the_title(),
				'permalink' => get_the_permalink()
			));
		}
		
	}

	return $results;
	// automaticamente lo convierte en JSON
}