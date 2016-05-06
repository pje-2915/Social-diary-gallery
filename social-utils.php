<?php
function add_hidden_contact($thispost)
{
	$contactstr = "Organiser: ".get_post_meta($thispost->ID, 'dbt_contactname', 'true');
	$contactphone = get_post_meta($thispost->ID, 'dbt_contactphone', 'true');
	$contactemail = get_post_meta($thispost->ID, 'dbt_contactemail', 'true');
	if ($contactphone != '') $contactstr = $contactstr . "\n" . "Phone: ".$contactphone;
	if ($contactemail != '') $contactstr = $contactstr . "\n" . "Email: ".$contactemail;
	?>
	<input type="button" value="Contact" onclick="revealContact('<?php echo base64_encode($contactstr); ?>')" />
	<?php
}

function add_maplink($thispost)
{
	$postcode = get_post_meta($thispost->ID, 'dbt_postcode', 'true');
	if($postcode != '' && $postcode != 'TBD')
	{
		?>
		<input type="button" onclick="location.href='http://google.com/maps?q=<?php echo $postcode; ?>';" value="Go to Google Maps" />
		<?php
	}
}