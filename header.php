<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset');?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head();
		
		// Sort out some icon include paths
		$iconPath = get_bloginfo('template_directory');
		$menuIcon = '\''.$iconPath.'/img/menu.png'.'\'';
		$menuStrikeIcon = '\''.$iconPath.'/img/menu-strike.png'.'\'';
		$magnifierIcon = '\''.$iconPath.'/img/magnifier.png'.'\'';
		$magnifierStrikeIcon = '\''.$iconPath.'/img/magnifier-strike.png'.'\'';
		?>

		<script>

		window.onresize = function(event) {
			if(document.body.offsetWidth >= 800)
			{
			      var e1 = document.getElementById('navdiv-hidden');
			      var b1 = document.getElementById('menuicon');
			      var e2 = document.getElementById('hidden-search');
			      var b2 = document.getElementById('searchicon');
				
		          e1.style.display = 'none';
		          b1.src=<?php echo $menuIcon;?>;
		          e2.style.display = 'none';
		          b2.src=<?php echo $magnifierIcon;?>;
			}
		};
		
		function revealContact(encodedTxt)
		{
			var rawtext = window.atob(encodedTxt);
			alert(rawtext);
		}

	    // We don't allow the user to show both optional sections together - if we do this it
	    // pushes the midpage down to the point where it causes the footer to float up.
	    
	    function toggleSection(sectionId)
	    {
		    if(sectionId == 'navdiv-hidden')
		    {
			    if(document.getElementById('navdiv-hidden').style.display == 'none')
			    {
			    	document.getElementById('navdiv-hidden').style.display = 'table';
			    	document.getElementById('hidden-search').style.display = 'none';
				    document.getElementById('menuicon').src=<?php echo $menuStrikeIcon;?>;;
				    document.getElementById('searchicon').src=<?php echo $magnifierIcon;?>;;
			    }
			    else
			    {
			    	document.getElementById(sectionId).style.display = 'none';
				    document.getElementById('menuicon').src=<?php echo $menuIcon;?>;;				    
			    }
		    }
		    else
		    {
			    if(document.getElementById('hidden-search').style.display == 'none')
			    {
			    	document.getElementById('navdiv-hidden').style.display = 'none';
			    	document.getElementById('hidden-search').style.display = 'table';
				    document.getElementById('menuicon').src=<?php echo $menuIcon;?>;;
				    document.getElementById('searchicon').src=<?php echo $magnifierStrikeIcon;?>;;
			    }
			    else
			    {
			    	document.getElementById(sectionId).style.display = 'none';
				    document.getElementById('searchicon').src=<?php echo $magnifierIcon;?>;;
			    }
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
						<a id="hideshowButton1" href="#" onclick="toggleSection('navdiv-hidden');">
						<img id="menuicon" alt="Walkfinder" src=<?php echo $menuIcon;?> width="25" height="25"></a>
					</li>
					<li>
						<a id="hideshowButton2" href="#" onclick="toggleSection('hidden-search');">
						<img id="searchicon" alt="Walkfinder" src=<?php echo $magnifierIcon;?> width="25" height="25"></a>
					</li>
					<li id="imgcell">
						<a id="imglink" href="http://www.ramblers.org.uk/go-walking.aspx">
						<img alt="Walkfinder" src="<?php bloginfo('template_directory');?>/img/ramblers-logo.gif" width="30" height="25"></a>
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
