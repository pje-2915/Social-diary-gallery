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

add_shortcode('rendezvous', 'makeRendezvouz');
function makeRendezvouz($atts)
{
	$atts = shortcode_atts(array('description' => '','postcode' => '', 'time' => ''), $atts);
	?>
	<input type="button" onclick="location.href='http://google.com/maps?q=<?php echo $atts['postcode']; ?>';" value="Go to Google Maps" />
	<h3><?php echo $atts['description'] . ", " . $atts['postcode'] . " at " . $atts['time']; ?></h3>
	<?php
}
