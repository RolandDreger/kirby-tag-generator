__initializeTagLinks();

function __initializeTagLinks() {

	const _idPrefix = "rd-";

	var _tagChain;
	var _tagArray;
	var _curTag;
	var _elementID;
	var _link;

	var i;


	/* Get stored tags */
	_tagChain = sessionStorage.getItem(_idPrefix + 'tags'); /* <- Session */
	if(_tagChain != null) {
		_tagArray = _tagChain.split(",");
	} else {
		_tagArray = [];
	}

	/* Activate tag links */
	for(i=0; i<_tagArray.length; i+=1) {
		_curTag = _tagArray[i];
		if(!_curTag || _curTag.constructor !== String) {
			continue;
		}
		_elementID = (_idPrefix + _curTag).toLocaleLowerCase();
		_link = document.getElementById(_elementID);
		if(!_link || !_link.hasAttribute("data-active")) {
			continue;
		}
		_link.setAttribute("data-active", "true");
	}

	return true;
} /* END function __initializeTagLinks */


function __updateTagList(_event) {
	
	if(!_event || !(_event instanceof Event)) { return false; }
	
	const _idPrefix = "rd-";
	const _tagPrefix = "/tag:";

	var _target;
	var _tag;
	var _active;
	var _tagChain;
	var _tagArray;
	var _baseURL;
	var _href;


	_event.preventDefault();

	_target = _event.target;
	if(!_event.target) {
		return false;
	}
	
	_tag = _target.dataset.tag;
	if(!_tag) {
		return false;
	}
	
	_baseURL = _target.dataset.url;
	if(!_baseURL) { 
		return false; 
	}

	/* Get stored tags */
	_tagChain = sessionStorage.getItem(_idPrefix + 'tags'); /* <- Session */
	if(_tagChain != null) {
		_tagArray = _tagChain.split(",");
	} else {
		_tagArray = [];
	}

	/* Update tag status */
	_active = _target.dataset.active;
	if(_active === 'true') {
		/* Remove tag */
		_tagArray = _tagArray.filter(
			function(_item){
				return (_item !== _tag);
			}
		 );
		/* Deactivate tag link */
		_target.setAttribute("data-active", "false");
	} else {
		/* Add tag */
		if(!_tagArray.includes(_tag)) {
			_tagArray.push(_tag);
		}
		/* Activate tag link */
		_target.setAttribute("data-active", "true");
	}

	/* Combine URL and update session storage */
	if(_tagArray.length === 0) {
		_href = _baseURL;
		sessionStorage.removeItem(_idPrefix + 'tags'); /* -> Session */
	} else {
		_tagChain = _tagArray.join(",");
		_href = _baseURL + _tagPrefix + _tagChain;
		sessionStorage.setItem(_idPrefix + 'tags', _tagChain); /* -> Session */
	}
	
	/* Set URL */
	window.location.replace(_href);

	return true;
} /* END function __updateTagList */