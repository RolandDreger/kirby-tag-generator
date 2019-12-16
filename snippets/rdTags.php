
<!-- Kirby 3 »Tag-Generator« – Version <?= $kirby->plugin('rd/tag-generator')->version(); ?> -->
<?php 
	/* Get Plugin options */
	$idPrefix = 'rd-';
	$tagFieldSeparator = option('rd.tag-generator.tagFieldSeparator');
	$tagSortDirection = option('rd.tag-generator.tagSortDirection');
	$tagSortMethod = option('rd.tag-generator.tagSortMethod');
	/* Unique Tag Array */
	$tagArray = array_unique($tagArray);
	/* Sort Tag Array */
	$tagSortDirection = Str::lower($tagSortDirection);
	if($tagSortDirection !== 'non') {
		$tagSortDirection = ($tagSortDirection == 'desc') ? SORT_DESC : SORT_ASC;
		if($tagSortDirection === SORT_DESC) {
			arsort($tagArray, $tagSortMethod);
		} else {
			asort($tagArray, $tagSortMethod);
		}
	}
?>
<ul class="rd-tag-list">
	<?php foreach($tagArray as $tag): ?>
		<li class="rd-tag-item">
			<a id="<?= Str::lower($idPrefix . urlencode($tag)) ?>" 
				class="rd-tag-link"
				href="<?= $page->url() . '/tag:' . urlencode($tag) ?>" 
				rel="tag"
				aria-label="<?= $tag ?>"
				data-tag="<?= urlencode($tag) ?>" 
				data-url="<?= $page->url() ?>" 
				data-active="false"
				data-count="<?= $tagCountPages->filterBy('tags', $tag, $tagFieldSeparator)->count() ?>"
				onclick="__updateTagList(event)"
			><?= $tag ?></a>
		</li>
	<?php endforeach ?>
</ul>

<?= js('media/plugins/rd/tag-generator/js/rdTags.js', ['defer' => true]) ?>

<!-- END Kirby 3 »Tag-Generator« -->
