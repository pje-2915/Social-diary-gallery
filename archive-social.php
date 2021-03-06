<?php
include 'social-utils.php';

// Don't use the "common content" here, as we want to change the ordering to be
// by event date, and also include a subheader
get_header();

global $post;     
$args = array(
	'post_type' => 'Social',
	'posts_per_page' => 4,
	'meta_key' => 'dbt_date',
	'meta_query' => array(
		array(
			'key' => 'dbt_date',
			'value' => time() - 24*60*60, // add on an extra day for safety
			'compare' => '>=',
		),
	),
	'orderby' => 'meta_value_num',
	'order' => 'ASC',
);
$query = new WP_Query( $args );
?>
<section class="midpage">
	<div class="blogcolumn">
		<?php
		if ($query->have_posts()) :
			while ($query->have_posts()) : $query->the_post(); ?>
		
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