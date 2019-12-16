<?php

Kirby::plugin('rd/tag-generator', [
	'options' => require_once __DIR__ . '/config/config.php',
	'snippets' => [
		'rdTags' => __DIR__ . '/snippets/rdTags.php'
	],
	'collectionFilters' => [
		'paramTags' => require_once __DIR__ . '/collectionFilters/paramTags.php'
	]
]);