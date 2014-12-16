<?php
// Importation de la librairie SPARQL et connexion à la base
require_once( "sparqllib.php" );
$db = sparql_connect( "http://dbpedia.org/sparql" );

if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

// Initialisation du namespace pour l'ontology
sparql_ns("dbpedia-owl","http://dbpedia.org/ontology/");

// Déclaration de la variable "today" pour le requêtage
$__today = date("m-d");
?>
