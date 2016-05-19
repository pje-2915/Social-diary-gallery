<?php

get_header();

?>
<section class="midpage">
	<div class="blogcolumn">
	
		<p><b>Weekends away are organized several times each year.
		These usually involve several walks on successive days, 
		a group meal or pub visit, and hostel-type accommodation.  
		They are only open to paid-up members of the Ramblers, 
		and for this reason details of forthcoming trips are only 
		published in our weekly e-mail newsletter, not on our 
		website or our Facebook or Meetup pages.  
		This page shows just a small selection of images and 
		reports from our past weekends away.</b></p>
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






