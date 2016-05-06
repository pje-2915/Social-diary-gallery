<?php

include 'shortcodes.php';

function walkcambridge_theme_resources() {
	wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'walkcambridge_theme_resources');

// Navigation Menus

register_nav_menus(array(
		'primary-med-large' => __('Primary Menu'),
		'primary-small' => __('Phone Primary Menu'),
		'phone-second-menu' => __('Phone Second Menu'),
));

if ( function_exists('register_sidebar') )
{
	register_sidebar();
	register_sidebar(array('name'=>'Hidden Search Widget',));
}

// Add custom post type for Walks and Social.  We can then attach a custom meta data form to this
// post type so we can formalise the meet up details.  This will also allow us to show
// posts in a 'soonest-event-first' listing rather than 'most recent post first'.

add_action('init', 'create_post_type');

function create_post_type()
{
	register_post_type('walk',
			array(
					'labels' => array(
							'name' => __('Walks'),
							'singular_name' => __('Walk')
							),
					'public' => true,
					'has_archive' => true,
					)
			);
	
	register_post_type('social',
			array(
					'labels' => array(
							'name' => __('Socials'),
							'singular_name' => __('Social')
							),
					'public' => true,
					'has_archive' => true,
					)
			);
					
}
// Add custom meta box to TinyMce editor - this will give us all the basic meet-up fields

$prefix = 'dbt_';

$meta_box = array(
    'id' => 'my-meta-box',
    'title' => 'Event Pro-forma',
    'page' => array('Walk','Social'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Grade',
            'id' => $prefix . 'grade',
            'type' => 'select',
            'options' => array('Easy','Leisurely','Moderate','Strenuous')
        ),
        array(
            'name' => 'Date',
            'desc' => 'Click to add a date',
            'id' => $prefix . 'date',
            'type' => 'date',
            'std' => 'TBD'
        ),
        array(
            'name' => 'Time',
            'desc' => 'Time in 24 hour format: HH:MM',
            'id' => $prefix . 'time',
            'type' => 'time',
            'std' => 'TBD'
        ),
        array(
            'name' => 'Postcode',
            'desc' => '',
            'id' => $prefix . 'postcode',
            'type' => 'postcode',
            'std' => 'TBD'
        ),
        array(
            'name' => 'Meet At',
            'desc' => '',
            'id' => $prefix . 'meetat',
            'type' => 'textarea',
            'std' => ''
        ),
    	array(
            'name' => 'Contact Name',
            'desc' => '',
            'id' => $prefix . 'contactname',
            'type' => 'text',
            'std' => ''
        ),
    	array(
            'name' => 'Contact Phone',
            'desc' => '',
            'id' => $prefix . 'contactphone',
            'type' => 'tel',
            'std' => 'Not given'
        ),
    	array(
            'name' => 'Contact Email',
            'desc' => '',
            'id' => $prefix . 'contactemail',
            'type' => 'email',
            'std' => 'Not given'
        ),
    )
);

add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
    global $meta_box;

    add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

add_action('admin_init', 'add_jquery_scripts');

function add_jquery_scripts() {
	wp_enqueue_script("jquery-ui-datepicker");
	wp_enqueue_style("jquery-style", "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css");
}


// Callback function to show fields in meta box
function mytheme_show_box() {
    global $meta_box, $post;

    echo '<link href="Content/themes/base/jquery-ui.css" rel="stylesheet" />',
	    '<script src="Scripts/jquery-1.7.1.js"></script>',
	    '<script src="Scripts/jquery-ui-1.8.20.js"></script>';
    
    echo '<script type="text/javascript">',
	    	'function validateHHMM(inputField) {',
	        	'var isValid = /^([0-1][0-9]|2[0-3]):([0-5][0-9])$/.test(inputField.value);',
	        	'if (isValid) {',
	            	'inputField.style.backgroundColor = "#fff";',
	        	'} else {',
	            		'inputField.style.backgroundColor = "#fba";',
	        	'}',
	        	'return isValid;',
	    	'}',
	    	'function validatePostcode(inputField) {',
	        	'var isValid = /^([a-zA-Z]){1}([0-9][0-9]|[0-9]|[a-zA-Z][0-9][a-zA-Z]|[a-zA-Z][0-9][0-9]|[a-zA-Z][0-9]){1}([ ])([0-9][a-zA-z][a-zA-z]){1}$/.test(inputField.value);',
	        	'if (isValid) {',
	            	'inputField.style.backgroundColor = "#fff";',
	        	'} else {',
	            		'inputField.style.backgroundColor = "#fba";',
	        	'}',
	        	'return isValid;',
	    	'}',
	    '</script>';

    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        if((get_post_type() == 'walk') || ($field['name'] != 'Grade'))
		{
			echo '<tr>';
        	echo '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>','<td>';
		}
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
            case 'postcode':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" onchange="validatePostcode(this);" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
            case 'time':
                echo '<input type="time" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="5" onchange="validateHHMM(this);"/>',
                '<br />', $field['desc'];
                break;
		    case 'date':
		        echo '<input type="text" name="', $field['id'], '" class="event_date" id="', $field['id'],
		        '" value="', $meta ? date('m/d/y', $meta) : $field['std'], '" size="30" width="30px" />',
		        '<br />', $field['desc'];
		        echo '<script type="text/javascript">jQuery(document).ready(function(){jQuery(".event_date").datepicker();});</script>';
		    	break;      
            case 'tel':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
            case 'email':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
            case 'select':
            	if(get_post_type() == 'walk')
	            {
	                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
	                foreach ($field['options'] as $option) {
	                    echo '<option ', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
	                }
	                echo '</select>';
	            }
                break;
        }
        if((get_post_type() == 'walk') || ($field['name'] != 'Grade'))
		{
        	echo '	</td><td>';
		}
        echo '</td></tr>';
    }

    echo '</table>';
}

add_action('save_post', 'mytheme_save_data');

// Save data from meta box
function mytheme_save_data($post_id) {
    global $meta_box;

    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
	    $new = $_POST[$field['id']];

        if ($new && $new != $old) {
        	if ($field['type'] == 'date') {
            	$new = strtotime($new);
        	}
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}