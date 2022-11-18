<?php

get_header();
pageBanner(array(
  'title' => 'Search Results',
  'subtitle' => 'You searched for &ldquo;'.esc_html(get_search_query(false)).'&ldquo;'
));
 ?>
<div class="container container--narrow page-section">
<?php
if (have_posts()){
    while(have_posts()) {
        the_post(); 
        
        get_template_part('template-parts/content', get_post_type());
                   // va a cargar content-post , content-page, content-professor , etc
         }
      echo paginate_links();
}else{
    echo '<h2 class="headline hedline--medium">No Reults match that search.</h2>';
}
get_search_form();  // busca el archivo searchform.php 

?>
</div>

<?php get_footer();

?>