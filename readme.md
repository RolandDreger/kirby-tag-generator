# Kirby Tag Generator (Version 1.0)

Kirby 3 plugin for generate tag links and filter a collection by tag parameter in URL. 


## Preview (on Vimeo)

[![Vimeo video to Kirby Plugin Tag generator](https://user-images.githubusercontent.com/19747449/70947215-f6ea9100-2058-11ea-90f8-aaaabe3fe8a1.jpg)](https://vimeo.com/379766254)


---


## 1. Installation

Download and copy this repository to **/site/plugins/tag-generator**

Or you can install it with composer: **composer require rd/tag-generator**



## 2. Usage

### 2.1 Stylesheet

Include a reference to the plugin CSS file inside the head section.

```
	<?= css(['media/plugins/rd/tag-generator/css/rdTags.css']) ?>
```

### 2.2 Tag Links

Insert the plugin snippet in your page template.

e.g. for all tags from child pages: 

```
<?php 
	$childPages = $page->children();
	$tagArray = $childPages->pluck('tags', ',');
	snippet('rdTags', ['tagCountPages' => $childPages, 'tagArray' => $tagArray]);
?>
```

Alternatively, you can use a field on the same page to define the tag links:
```
	$tagArray = $page->tags()->split(',');
```

Or feed the snippet with a hard-coded array:
```
	$tagArray = ['Design', 'Photography', 'Illustration'];
```

## 3 Options
You can find these settings in the file **site/plugins/tag-generator/config/config.php**

### 4.1 Field Tag Separator
Tag separator of your Kirby tag field:

	'tagFieldSeparator' => ','

### 4.2 URL Tag Separator
Tag separator in your URL parameter (http://yourdomain.com/blog/tag:Design,Photography,Illustration)

	'tagParamSeparator' => ','
    
### 4.3 Tag Sorting
Sorting options of tag links (frontend):
desc (descending) or asc (ascending) or non (no sorting)

	'tagSortDirection' => 'asc' 

PHP sort method flag or 0

	'tagSortMethod' => SORT_NATURAL | SORT_FLAG_CASE 


## 6. Notice

This plugin is provided »as is«. Use it at your own risk. Please test the plugin carefully before using it in your production environment.

Feedback is welcome.



## 7. License

[MIT](http://www.opensource.org/licenses/mit-license.php)



## 8. Authors

Roland Dreger, www.rolanddreger.net


[PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=roland%2edreger%40a1%2enet&lc=AT&item_name=Roland%20Dreger%20%2f%20Donation%20for%20script%20development%20Kirby-Data-Importer&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted) Link 
