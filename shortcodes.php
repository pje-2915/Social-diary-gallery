<?php
add_shortcode('hiddencontact', 'makeHiddenContact');
function makeHiddenContact($atts)
{
	$atts = shortcode_atts(array('organiser' => 'N/K','phone' => 'N/K', 'email' => 'N/K'), $atts);
	$contactstr = "Organiser: ".$atts['organiser'];
	if ($atts['phone'] != '') $contactstr = $contactstr . "\n" . "Phone: ".$atts['phone'];
	if ($atts['email'] != '') $contactstr = $contactstr . "\n" . "Email: ".$atts['email'];
	?>
	<input type="button" value="Contact" onclick="revealContact('<?php echo base64_encode($contactstr); ?>')" />
	<?php
}
