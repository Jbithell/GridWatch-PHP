<?php
class Grid {
	public function get() {
		$xml = simplexml_load_string(file_get_contents("http://www.bmreports.com/bsp/additional/soapfunctions.php?element=generationbyfueltypetable"), "SimpleXMLElement", LIBXML_NOCDATA);
		$SERVERDATA = json_decode(json_encode($xml),TRUE); //Remove all the messy object stuff
		unset($xml);
		if (!isset($SERVERDATA['INST'])) die("Unable to get data"); //Bit of error handling
		//Begin Parsing
		$DATA['TOTAL'] = $SERVERDATA['INST']["@attributes"]["TOTAL"];
		$DATA['UPDATED'] = $SERVERDATA['INST']["@attributes"]["AT"]; //This is a UTC timestamp
		$DATA['FUELS'] = array();
		foreach ($SERVERDATA['INST']['FUEL'] as $FUEL) {
			$DATA['FUELS'][] = $FUEL["@attributes"];
		}
		return $DATA;
	}
}
var_dump(Grid::get());
?>
