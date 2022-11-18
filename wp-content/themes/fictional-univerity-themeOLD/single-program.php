<?php
get_header();
	while (have_posts()) {
		the_post(); 
		pageBanner();
		?>
	
	<div class="container container--narrow page-section">
		<div class="metabox metabox--position-up metabox--with-home-link">
	        <p>
	          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main"><?php the_title(); ?></span>
	        </p>
      </div>

		<div class="generic-content">
			<?php the_content();?>
		</div>

		<?php 

						$relatedProfessors = new WP_Query(array(
              'posts_per_page' => -1, // si ponemos -1 filtramos la busqueda solo a lo que especificamos
              'post_type' => 'professor',
              'orderby' => 'title',// por defult esta ordenado por 'post_date'.. meta_value refiere a los custom fields creados (en este caso por el plugin ACF)      
              'order' => 'ASC',
              'meta_query' => array( // multiples filtros para nuestra busqueda
                array(
                	'key' => 'related_programs',
                	'compare' => 'LIKE',
                	'value' => '"'.get_the_ID().'"'

                )
              )
            ));

            if($relatedProfessors->have_posts()){
            	echo '<hr class ="section-break">';
	            echo '<h2 class="headline headline--medium">'.get_the_title().' Professors</h2>';

	            echo '<ul class ="professor-cards">';
	            while ($relatedProfessors->have_posts()) {
	              $relatedProfessors->the_post(); ?>
	              
	              <li class="professor-card__list-item">
	              	<a class="professor-card" href="<?php the_permalink();?>" > 
	              		<image class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape');?>">
	              		<span class="professor-card__name"><?php the_title();?></span>	
	              	</a>
	              </li>

	            <?php }
	            echo '</ul>';
	          }

	          wp_reset_postdata(); // 

            // custom query
            $today = date('Ymd');
            $homepageEvents = new WP_Query(array(
              'posts_per_page' => 2, // si ponemos -1 filtramos la busqueda solo a lo que especificamos
              'post_type' => 'event',
              'orderby' => 'meta_value_num',// por defult esta ordenado por 'post_date'.. meta_value refiere a los custom fields creados (en este caso por el plugin ACF)
              'meta_key' => 'event_date', // espeficificamos el meta_key 
              'order' => 'ASC',
              'meta_query' => array( // multiples filtros para nuestra busqueda
                array( // si queremos meter mas condiciones al query , agregamos otro array
                  'key' => 'event_date',
                  'compare' => '>=',
                  'value' => $today,
                  'type' => 'numeric' // especificamos que tipo de comparacion estamos haciendo
                ),
                array(
                	'key' => 'related_programs',
                	'compare' => 'LIKE',
                	'value' => '"'.get_the_ID().'"'

                )
              )
            ));

            if($homepageEvents->have_posts()){
            	echo '<hr class ="section-break">';
	            echo '<h2 class="headline headline--medium">Upcoming '.get_the_title().' Events</h2>';
	            while ($homepageEvents->have_posts()) {
	              $homepageEvents->the_post();
	              get_template_part('template-parts/content-event');
	              }
	          }

	          wp_reset_postdata();
	          $relatedCampuses=get_field('related_campus');
	          echo '<hr class="section-break" >';
	          if ($relatedCampuses){
	          	echo '<h2 class="headline headline--medium">'.get_the_title().' is Available At These Campuses:</h2>';
	          	
	          	echo '<ul class="min-list link-list">';
	          	foreach($relatedCampuses as $campus){
	          		?> <li><a href="<?php get_the_permalink($campus);?>"><?php echo get_the_title($campus); ?></a></li> <?php
	          	}
	          	echo '</ul>';
	          }

	          ?>
            

            

	</div>



	<?php }
get_footer();
?>