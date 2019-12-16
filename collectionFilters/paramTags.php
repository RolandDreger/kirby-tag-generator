<?php

return function(
	$collection, 
	$field, 
	$tagCombination,
	$split = false
) {

	$tagFieldSeparator = option('rd.tag-generator.tagFieldSeparator');
	$tagParamSeparator = option('rd.tag-generator.tagParamSeparator');

	/* Fetch URL parameter: 'tag' */
	/* e.g. http://yourdomain.com/blog/tag:design,illustration -> result: 'design,illustration' */
	$paramTagString = param('tag');
	$paramTagArray = Str::split(urldecode($paramTagString), $tagParamSeparator);
	if(empty($paramTagArray)) {
		return $collection;
	}
	
	/* Tag combination: 'AND', 'OR' or 'NOT' */
	$tagCombination = Str::upper($tagCombination);

	foreach($collection->data as $key => $item) {

		$tagField = $collection->getAttribute($item, $field, $split);
		if(!$tagField) {
			continue;
		}

		$fieldTagArray = $tagField->split($tagFieldSeparator);

		/* AND */
		if($tagCombination === 'AND') {
			if(!array_diff($paramTagArray, $fieldTagArray)) {
				continue;
			}
		} 
		/* NOT */
		elseif ($tagCombination === 'NOT') {
			if(!array_intersect($fieldTagArray, $paramTagArray)) {
				continue;
			}
		} 
		/* OR */
		else {
			if(array_intersect($fieldTagArray, $paramTagArray)) {
				continue;
			}
		}
		
		unset($collection->$key);	
	}
	
	return $collection;
};