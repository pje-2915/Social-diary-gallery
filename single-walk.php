<?php
include 'social-utils.php';

// Don't use the "common content" here, as we want to change the ordering to be
// by event date, and also include a subheader
get_header();
?>
<section class="midpage">
	<div class="blogcolumn">
		<?php
		if (have_posts()) :
			while (have_posts()) : the_post(); ?>
		
			<article class="post">
				<h2><?php the_title(); echo ' - ('.get_post_meta($post->ID, 'dbt_grade', 'true').')';?></h2>
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
		<hr color=grey width=95%>
		<h4>Description of Walk Grading System</h4><ul>
<li><b>Easy:</b> Short walks (6 miles or less) on good quality paths with no difficult terrain. These walks should be suitable for anybody in their 20s or 30s who doesn't have a mobility disability and are particularly suitable for people who have done little walking before.</li>
<li><b>Leisurely:</b> Slightly more difficult walks which represent the majority of walks we undertake. These walks may be longer (up to 12 miles) and while the paths will still generally be good, a few sections may be steep, muddy, rough or overgrown, so boots or good quality walking shoes are recommended. These walks should still be suitable for the large majority of people in our age group.</li>
<li><b>Moderate:</b> More energetic walks still, either because they are long (>12 miles), have significant hills, are likely to be very muddy or overgrown or because a faster pace is expected. Walking boots are strongly recommended. Suitable for reasonably fit people with some walking experience, but may not be a good choice for your first walk with us if you haven't done much walking before.</li>
<li><b>Strenuous:</b> Very long walks or those covering very hilly terrain, suitable for experienced walkers of above average fitness. If in doubt about your fitness, contact the leader beforehand. These walks are unusual on our main programme, but may feature in some of our weekends away.</li></ul>
	</div>
	<div class="resourcecolumn">
	<?php get_sidebar(); ?>
	</div>
</section>
<?
	
get_footer();
?>