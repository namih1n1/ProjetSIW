<?php
require_once( "sparqllib.php" );
echo "tata ELSA !!!!!";
echo "autre test by HLE";

$db = sparql_connect( "http://dbpedia.org/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

sparql_ns("dbpedia-owl","http://dbpedia.org/ontology/");

$today = date("m-d");

$sparql = "
	select distinct ?nom where {
		?Ressource dbpprop:occupation ?occupation .
		?Ressource dbpedia-owl:birthDate ?naissance .
		?Ressource rdfs:label ?nom .
		FILTER(?occupation like \"*Actor*\") .
		FILTER(?naissance like \"*-".$today."\") .
		FILTER langmatches(lang(?nom),\"en\")
	}";
	
$result = sparql_query( $sparql );
if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

$fields = sparql_field_array( $result );

print sparql_num_rows( $result )." acteurs sont n&eacute;s ce jour.</p>";
print "<table class='example_table'>";
print "<tr>";

// Entête
// foreach( $fields as $field ) {	print "<th>$field</th>"; }

print "</tr>";
while( $row = sparql_fetch_array( $result ) )
{	
	print "<tr>";
		foreach( $fields as $field )
		{		
			echo "<td><a href=\"http://wikipedia.org/wiki/".utf8_decode("$row[$field]")."\"> ".utf8_decode("$row[$field]"). "</td>";	
		}
	print "</tr>";
}
print "</table>";
?>
