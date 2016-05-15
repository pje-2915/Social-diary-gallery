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
	$gridref = get_post_meta($thispost->ID, 'dbt_gridref', 'true');
	
	if($postcode != '' && $postcode != 'TBD')
	{
		str_replace(" ","+",$postcode); ?>
		<input type="button" onclick="location.href='http://www.streetmap.co.uk/streetmap.dll?postcode2map?code=<?php echo $postcode; ?>&title=Meeting+Point&nolocal=Y';" value="Go to Streetmap" />
		<?php
	}
	else if($gridref != '' && $gridref != 'TBD')
	{
		error_log($gridref);
		
		preg_match( '/^[A-Z]{2}/', $gridref, $match );
		
		// Convert any landranger type co-rdinates to lat-longs
		// Co-ordinate system origin in Scilly Isles - this has grid ref E 000000 N 000000
		if(count($match) == 1)
		{
			$charA = ord("A")-ord("A");
			$charI = ord("I")-ord("A"); // Character not used - confused with 1

			// Convert the characters into numbers, skipping "I"
			$firstChar = ord(substr($match[0],0,1)) -$charA;
			$secondChar = ord(substr($match[0],1,1)) -$charA;
				
			if($firstChar == $charI) return;
			// We don't decrement firstChar because we only use it for lookup
			if($secondChar == $charI) return;
			if($secondChar > $charI) $secondChar--;
				
			// Map grid letters onto 100km indexes from origin "SV".
			// The first letter is a grid with squares of sides 500km. Inside
			// Each of these squares there are 25 squares of sides 100km. These are labelled A-Z
			// (missing I) from top-left to bottom right.

			// TODO : extend for the three-letter codes of the Orkneys
			$firstCharEastLookup = array("S"=>0, "T"=>1, 'N'=>0,);
			$firstCharNorthLookup = array("S"=>0, "T"=>0, 'N'=>1,);
			
			// Now get the two sets of three digits after the numbers
			$digitsEast = substr($gridref,2,3);
			$digitsNorth = substr($gridref,5,3);
			
			// We we can work out the cor-ordinates
			$EastGrid100k = $firstCharEastLookup[chr($firstChar)]*5 + ($secondChar % 5);
			$NorthGrid100k = $firstCharNorthLookup[chr($firstChar)]*5 + (4 - (($secondChar-ord("A")) / 5));
			
			// sanity test
			if ($EastGrid100k < 0 || $EastGrid100k > 6 || $NorthGrid100k < 0 || $NorthGrid100k > 12) return;


			$east = $EastGrid100k.$digitsEast.'00';
			$north = $NorthGrid100k.$digitsNorth.'00';
			$gridref = $east.' '.$north;
		}
		
		$match = preg_split('/ /', $gridref); ?>
		<input type="button" onclick="location.href='http://www.streetmap.co.uk/streetmap.dll?grid2map?X=<?php echo $match[0]; ?>&Y=<?php echo $match[1]; ?>&titleMeeting+Point&arrow=Y&nolocal=Y';" value="Go to Streetmap" />
		<?php
	}
}