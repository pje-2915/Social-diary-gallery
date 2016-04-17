<?php

get_header();

?>
<section class="midpage">
	<div class="blogcolumn">
	<?
	if (have_posts()) :
		while (have_posts()) : the_post(); ?>
	
		<article class="post">
			<h2><?php the_title();?></h2>
			<?php the_content();?>
		</article>
	
		<?php
		endwhile;
		else :
			echo '<p>No content found</p>';
		endif;
	
	?>
	</div>
	<div class="resourcecolumn">
	<?php get_sidebar(); ?>
	</div>
</section>
<?
	
get_footer();
?>