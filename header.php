<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset');?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
		
		<script>

		window.onresize = function(event) {
			if(document.body.offsetWidth >= 900)
			{
			      var e = document.getElementById('hidden_nav_menu');
			      var b = document.getElementById('hideshowButton');
				
		          e.style.display = 'none';
		          b.innerHTML = 'More Items';
			}
		};
		
		function revealContact(encodedTxt)
		{
			var rawtext = window.atob(encodedTxt);
			alert(rawtext);
		}

	    function toggle_hidden_menu(buttonId, targetId, onTxt, offTxt)
	    {
	       var e = document.getElementById(targetId);
	       var b = document.getElementById(buttonId);
	       if(e.style.display == 'block')
	       {
	          e.style.display = 'none';
	          b.innerHTML = onTxt;
	       }
	       else
	       {
	          e.style.display = 'block';
	          b.innerHTML = offTxt;
	       }
	    }

		</script>
	</head>
	
<body <?php body_class(); ?>>

<div class="container">
	<!-- site-header -->
	<header class="site-header">
		<div class="headerdiv">
			<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name');?></a></h1>
			<h5><?php bloginfo('description'); ?></h5>
		</div>	
		<div class="navdiv">
			<nav class="site-nav-med-large">
				<?php 
				$args = array(
						'theme_location' => 'primary-med-large'
						);s
				?>
				<?php wp_nav_menu( $args ); ?>
			</nav>
			<div class="navdiv-small">
				<div class="navdiv-small-left">
					<nav class="site-nav-small">
						<?php 
						$args = array(
								'theme_location' => 'primary-small'
								);
						?>
						<?php wp_nav_menu( $args ); ?>
					</nav>
				</div>
				<div class="navdiv-small-mid">
					<a id="hideshowButton" href="#" onclick="toggle_hidden_menu('hideshowButton','hidden_nav_menu','More Items','Less Items');">More Items</a>
				</div>
				<div class="navdiv-small-right">
					<a href="http://www.ramblers.org.uk/go-walking.aspx">
					<img alt="Walkfinder" src="<?php bloginfo('template_directory');?>/img/ramblers-logo.gif" width="30" height="25">
					bob</a>
				</div>
			</div>
			<div class="navdiv-hidden" id="hidden_nav_menu">
				<nav class="site-nav-hidden">
					<?php 
					$args = array(
							'theme_location' => 'phone-second-menu'
							);
					wp_nav_menu( $args ); ?>
				</nav>
			</div>
		</div>
		
	</header>
