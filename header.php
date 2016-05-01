<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset');?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
		
		<script>

		window.onresize = function(event) {
			if(document.body.offsetWidth >= 800)
			{
			      var e1 = document.getElementById('navdiv-hidden');
			      var b1 = document.getElementById('hideshowButton1');
			      var e2 = document.getElementById('hidden-search');
			      var b2 = document.getElementById('hideshowButton2');
				
		          e1.style.display = 'none';
		          b1.innerHTML = 'More Items';
		          e2.style.display = 'none';
		          b2.innerHTML = 'Shows Search';
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
	       if(e.style.display == 'table')
	       {
	          e.style.display = 'none';
	          b.innerHTML = onTxt;
	       }
	       else
	       {
	          e.style.display = 'table';
	          b.innerHTML = offTxt;
	       }
	    }

		</script>
	</head>
	
<body <?php body_class(); ?>>

<div class="container">
	<!-- site-header -->
	<header class="site-header">
		<div id="headerdiv">
			<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name');?></a></h1>
			<h5><?php bloginfo('description'); ?></h5>
		</div>	
		<div id="navdiv">
		
			<!-- *********  Menu for large screens  *********** -->
			
			<div id="navdiv-large">
				<?php 
				$args = array(
						'theme_location' => 'primary-med-large',
						'container' => false);
				wp_nav_menu( $args ); ?>		
			</div>
			
			<!-- *********  Menu for small screens  *********** -->
			
			<div id="navdiv-small">
				<ul>
				<?php 
					$args = array(
							'theme_location' => 'primary-small',
							'container' => false,
							'items_wrap' => '%3$s'
					);
					wp_nav_menu( $args ); ?>
					<li>
						<a id="hideshowButton1" href="#" onclick="toggle_hidden_menu('hideshowButton1','navdiv-hidden','More Items','Less Items');">More Items</a>
					</li>
					<li>
						<a id="hideshowButton2" href="#" onclick="toggle_hidden_menu('hideshowButton2','hidden-search','Show Search','Hide Search');">Show Search</a>
					</li>
					<li id="imgcell">
						<a id="imglink" href="http://www.ramblers.org.uk/go-walking.aspx"><img alt="Walkfinder" src="<?php bloginfo('template_directory');?>/img/ramblers-logo.gif" width="30" height="25"></a>
					</li>
				</ul>	
			</div>
			
			<!-- *********  Hidden menu for small screens  ********** -->
			
			<div id="navdiv-hidden" id="hidden_nav_menu">
				<?php 
				$args = array(
						'theme_location' => 'phone-second-menu',
						'container' => false);
				wp_nav_menu( $args ); ?>
			</div>
			
			<div id="hidden-search">
				<?php if (!dynamic_sidebar('Hidden Search Widget') ) : ?>
				<?php endif; ?>
			</div>
		</div>
		
	</header>
