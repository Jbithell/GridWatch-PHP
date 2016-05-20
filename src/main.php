<?php
/* FUEL TYPES
 CCGT:  Combined Cycle Gas Turbines are gas turbines whose hot exhausts are used to drive a boiler and steam turbine. This two stage process makes them very efficient in gas usage. They are also quite fast to get online - less than an hour in general, so they are used to cover (profitable) peak demand and to balance wind output.
 OCGT:  Open Cycle Gas Turbines, are gas turbines without steam plant to maximise their efficiency. They are cheap to build, but expensive to run, so are seldom used except in emergencies in winter, when very high market prices of electricity make them profitable.
 Wind:  This is the total contributed by metered wind farms. Wind power contributes about another 30% from embedded (or unmetered) wind turbines that shows only as a drop in demand. Wind like nuclear, will sell into any market price because turbines are expensive, wind is not and subsidies are always paid. The variability of wind leads to very high fluctuations in output.
 Coal:  Coal is the largest contributor to the UK grid - especially so in recent years as gas prices have risen. Some coal plants like Drax, also co-fire biomass with coal as well, which allows them to gain access to renewable subsidies. Coal plants are now restricted in running hours for emissions, so tend to run in winter when prices are higher.
 Nuclear:  Currently the UK has seven AGR designs and one relatively modern PWR. Nuclear power stations are run flat-out to maximise income. Since the cost of fuel is almost insignificant, it pays them to sell at any price they can get. Variations in output are generally signs that refuelling or maintenance is ongoing.
 French Interconnector:  This is a 2GW bi-directional link to France which (when fully operational, which is seldom) is able to import up to 2GW of power from France - usually in summer when France has a nuclear power surplus - and export in winter, when the UK's excess of backup plant  and coal  power can be profitably sold to meet continental shortfalls.
 BritNed Interconnector:  This is 1GW connector to Holland Its usage seems to reflect a surplus or a deficit of NW europe wind energy.
 Moyle interconector.:  This is a 500MW (0.5GW) bi-directional link from Scotland to N Ireland, currently limited to 250MW pending a new cable being laid (2016). When it is working it is mostly used to top up the Irish grid, only when the wind blows a gale does it sometimes supply the UK mainland.
 East-West Interconnector:  This is a new 500MW (0.5GW) bi-directional link between Wales and the Irish Republic, enabling access to the UK (and continental) grid, and prices, for the Irish consumers. In general it feeds one way more or less in step with the Moyle interconnector.
 Pumped Storage:  These are small hydro-electric stations that can use overnight electricity to recharge their reservoirs. Mainly used to meet very short term peak demands (the water soon runs out). They represent the nearest thing to 'storage' that is attached to the grid.
 Hydroelectric power:  The UK has no major hydroelectric power stations, but a collection of smaller ones, mainly in Scotland, that provide very useful power (if it's rained recently!). There would be a little more, but many stations deliberately reduce output to get the best renewable subsidy rates.
 Biomass:  These power stations are either (parts of) old coal plants that have been converted to run on imported timber - e.g. Drax 2 and Ironbridge 1 & 2, thus enabling them to qualify as 'renewable' and gain subsidies thereby, or purpose built biomass burners like Stevens Croft (40MW)  built to use sawmill waste.
 Oil:  These are stations running thick fuel oil or bunker oil Due to the price of this, they are not economic to run, but are held in reserve for potential peak winter demand. They are tested about once a year to see if they still function.
*/
//Download Data
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
var_dump($DATA);
?>
