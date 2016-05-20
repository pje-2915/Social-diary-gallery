<?php
include 'social-utils.php';

// Don't use the "common content" here, as we want to change the ordering to be
// by event date, and also include a subheader
get_header();

global $post;     
?>
<section class="midpage">
	<div class="blogcolumn">
		<?php
		if (have_posts()) :
			while (have_posts()) : the_post(); ?>
		
			<article class="post">
				<h2><?php the_title();?></h2>
				<?php
					$meetInfo = soc_utils_get_title($post);
				?>
				<h4><?php echo $meetInfo; ?></h4>
				<?php
				echo '<b><table class="eventdatatable"><tr><td><p>Organiser:&nbsp&nbsp&nbsp '.get_post_meta($post->ID, 'dbt_contactname', 'true').'</p></td><td>';
				add_hidden_contact($post);
				echo '</td><td>';
				add_maplink($post);
				echo '</td></tr></table></b>';
				the_content();?>
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