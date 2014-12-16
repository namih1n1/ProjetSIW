<?php
<<<<<<< HEAD
require_once( "sparqllib.php" );
echo "hle PROUT";

$db = sparql_connect( "http://dbpedia.org/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

sparql_ns("dbpedia-owl","http://dbpedia.org/ontology/");

$today = date("m-d");

=======
>>>>>>> origin/branche_hle
$sparql = "
	select distinct ?nom where {
		?Ressource dbpprop:occupation ?occupation .
		?Ressource dbpedia-owl:birthDate ?naissance .
		?Ressource rdfs:label ?nom .
		FILTER(?occupation like \"*Actor*\") .
		FILTER(?naissance like \"*-".$__today."\") .
		FILTER langmatches(lang(?nom),\"en\")
	}";
	
$result = sparql_query( $sparql );
if( !$result ) { echo sparql_errno() . ": " . sparql_error(). "\n"; exit; }

$fields = sparql_field_array( $result );

echo sparql_num_rows( $result )." acteurs sont n&eacute;s ce jour.</p>";
echo "<table class='example_table'>";
echo "<tr>";

// Entête
// foreach( $fields as $field ) {	echo "<th>$field</th>"; }

echo "</tr>";
while( $row = sparql_fetch_array( $result ) )
{	
	echo "<tr>";
		foreach( $fields as $field )
		{		
			echo "<td><a href=\"".$__url_wiki. utf8_decode("$row[$field]")."\"> ".utf8_decode("$row[$field]"). "</td>";	
		}
	echo "</tr>";
}
echo "</table>";
?>
