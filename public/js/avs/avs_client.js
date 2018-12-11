/**
 *  author:		Samson
 *	version:	1.0 - 2016-09-16
 *
 */

var useAVSns;

if (useAVSns) {
	if (typeof(avs) == "undefined")
		avs = {}
	_avs = avs;
} else {
	_avs = this;
}


if (typeof(_avs.Autosuggest) == "undefined")
	_avs.Autosuggest = {}


_avs.AutoSuggest = function (appid, key, fldID, param) {
	// no DOM - give up!
	//
	if (!document.getElementById)
		return false;
	
	// get field via DOM
	//
	this.fld = _avs.DOM.getElement(fldID);

	if (!this.fld)
		return false;
	
	// init variables
	//
	this.sInput 		= "";
	this.nInputChars 	= 0;
	this.aSuggestions 	= [];
	this.iHighlighted 	= 0;
	this.search_code 	= -1;
	this.aAddressInfos	= [];
	// parameters object
	//
	this.oP = (param) ? param : {};
	
	// defaults	
	//
	if (!this.oP.minchars)									this.oP.minchars = 1;
	if (!this.oP.method)									this.oP.meth = "post";
	if (!this.oP.className)									this.oP.className = "autosuggest";
	if (!this.oP.timeout)									this.oP.timeout = 2500;
	this.oP.delay = 100;
	if (!this.oP.offsety)									this.oP.offsety = -5;
	if (!this.oP.shownoresults)								this.oP.shownoresults = true;
	if (!this.oP.noresults)									this.oP.noresults = "No results!";
	if (!this.oP.maxheight && this.oP.maxheight !== 0)		this.oP.maxheight = 250;
	this.oP.cache = false;
	
	if (!this.oP.spellcheck && this.oP.spellcheck != false)			this.oP.spellcheck = true;
	if (!this.oP.synonym && this.oP.synonym != false)				this.oP.synonym = true;
	if (!this.oP.autocompletion && this.oP.autocompletion != false)	this.oP.autocompletion = true;
	if (!this.oP.randompos && this.oP.randompos != false)			this.oP.randompos = true;
	if (!this.oP.geopos && this.oP.geopos != false)					this.oP.geopos = true;

	if (!this.oP.breaking && !this.oP.breaking.value && this.oP.breaking.value != false)	this.oP.breaking.value = true;
	//this.oP.varname = "input";
	//this.oP.json = true;
	
	
	// set keyup handler for field
	// and prevent autocomplete from client
	//
	var pointer = this;
	
	// NOTE: not using addEventListener because UpArrow fired twice in Safari
	//_avs.DOM.addEvent( this.fld, 'keyup', function(ev){ return pointer.onKeyPress(ev); } );
	
	this.fld.onkeypress 	= function(ev){ return pointer.onKeyPress(ev); }
	this.fld.onkeyup 		= function(ev){ return pointer.onKeyUp(ev); }
	
	this.fld.setAttribute("autocomplete","off");
	
	var url = this.oP.script+"?appid="+appid+"&key="+key;
	var meth = this.oP.meth;
	
	var onSuccessFunc = function (res) {
		var jsondata = eval('(' + res.responseText + ')');
		if (jsondata.code != 1)
			alert("Authorization error");
	};
	var onErrorFunc = function (status) { alert("AJAX error: " + status); };

	var myAjax = new _avs.Ajax();
	myAjax.makeRequest( url, meth, onSuccessFunc, onErrorFunc );
}


_avs.AutoSuggest.prototype.onKeyPress = function(ev) {
	var key = (window.event) ? window.event.keyCode : ev.keyCode;

	// set responses to keydown events in the field
	// this allows the user to use the arrow keys to scroll through the results
	// ESCAPE clears the list
	// TAB sets the current highlighted value
	//
	var RETURN = 13;
	var TAB = 9;
	var ESC = 27;
	
	var bubble = true;

	switch(key) {
		case RETURN:
			this.setHighlightedValue();
			bubble = false;
			break;
		case ESC:
			this.clearSuggestions();
			break;
	}

	return bubble;
}


_avs.AutoSuggest.prototype.onKeyUp = function(ev) {
	var key = (window.event) ? window.event.keyCode : ev.keyCode;

	// set responses to keydown events in the field
	// this allows the user to use the arrow keys to scroll through the results
	// ESCAPE clears the list
	// TAB sets the current highlighted value
	//

	var ARRUP = 38;
	var ARRDN = 40;
	var SPACE = 32;
	var COMMA = 188;
	var RETURN = 13;
	
	var bubble = true;

	switch(key) {
		case ARRUP:
			this.changeHighlight(key);
			bubble = false;
			break;
		case ARRDN:
			this.changeHighlight(key);
			bubble = false;
			break;
		case RETURN:
			if (this.iHighlighted > 0)
				return;
		case SPACE:
		case COMMA:
			this.getSuggestions(this.fld.value, true);
			break;
		default:
	}

	return bubble;

}

_avs.AutoSuggest.prototype.getSuggestions = function (val, spellcheck) {
	this.iHighlighted = 0;
	
	// if input stays the same, do nothing
	//
	//if (val == this.sInput)
	//	return false;

	
	// input length is less than the min required to trigger a request
	// reset input string
	// do nothing
	//
	if (val.length < this.oP.minchars) {
		this.sInput = "";
		return false;
	}
	
	
	// if caching enabled, and user is typing (ie. length of input is increasing)
	// filter results out of aSuggestions from last request
	//
	if (val.length>this.nInputChars && this.aSuggestions.length && this.oP.cache) {
		var arr = [];
		for (var i=0;i<this.aSuggestions.length;i++) {
			arr.push( this.aSuggestions[i] );
		}
		
		this.sInput = val;
		this.nInputChars = val.length;
		this.aSuggestions = arr;
		
		this.createList(this.aSuggestions);
		
		return false;
	} else { // do new request
		this.sInput = val;
		this.nInputChars = val.length;

		var pointer = this;
		clearTimeout(this.ajID);
		this.ajID = setTimeout( function() { pointer.doAjaxRequest(spellcheck) }, this.oP.delay );
	}

	return false;
}

_avs.AutoSuggest.prototype.doAjaxRequest = function (spellcheck) {
	var pointer = this;
	this.search_code = -1;
	// create ajax request
	var code = "";
	if (this.oP.spellcheck && spellcheck)
		code += "1";
	if (this.oP.synonym)
		code += "3";
	if (this.oP.autocompletion)
		code += "4";
	if (this.oP.randompos)
		code += "5";
	if (this.oP.geopos)
		code += "6";
	if (this.oP.breaking.value)
		code += "2";
	var url = this.oP.script+"?code="+code+"&query="+escape(this.fld.value);
	var meth = this.oP.meth;
	
	var onSuccessFunc = function (res) { pointer.setSuggestions(res) };
	var onErrorFunc = function (status) { alert("AJAX error: "+status); };

	var myAjax = new _avs.Ajax();
	myAjax.makeRequest( url, meth, onSuccessFunc, onErrorFunc );
}

_avs.AutoSuggest.prototype.setSuggestions = function (res) {
	this.aSuggestions = [];
	this.aAddressInfos = [];
	
	var jsondata = eval('(' + res.responseText + ')');
	this.search_code = jsondata.code;
	if (jsondata.code > 0) {
		for (var i=0;i<jsondata.result.length;i++) {
			this.aSuggestions.push(  { 'id':(i+1), 'value':jsondata.result[i][0] }  );
			this.aAddressInfos.push(  { 'id':(i+1), 'value':jsondata.result[i] }  );
		}
	} else if (jsondata.code == -1) {
		alert("Engine server connection error");
	}
	
	this.idAs = "as_"+this.fld.id;
	
	this.createList(this.aSuggestions);
}

_avs.AutoSuggest.prototype.createList = function(arr) {
	var pointer = this;
	
	// get rid of old list
	// and clear the list removal timeout
	//
	_avs.DOM.removeElement(this.idAs);
	this.killTimeout();
	
	// create holding div
	//
	var div = _avs.DOM.createElement("div", {id:this.idAs, className:this.oP.className});	
	
	var hcorner = _avs.DOM.createElement("div", {className:"as_corner"});
	var hbar = _avs.DOM.createElement("div", {className:"as_bar"});
	var header = _avs.DOM.createElement("div", {className:"as_header"});
	header.appendChild(hcorner);
	header.appendChild(hbar);
	div.appendChild(header);
	
	// create and populate ul
	//
	var ul = _avs.DOM.createElement("ul", {id:"as_ul"});
	
	// loop throught arr of suggestions
	// creating an LI element for each suggestion
	//
	/*
	if (arr.length > 0) {
		var li 			= _avs.DOM.createElement(  "li", {}, "Did you mean?"  );
		
		ul.appendChild( li );
	}
	*/
	for (var i = 0; i < arr.length; i++) {
		// format output with the input enclosed in a EM element
		// (as HTML, not DOM)
		//
		var val = arr[i].value;
		var st = val.toLowerCase().indexOf( this.sInput.toLowerCase() );
		var output = val;
		if (st != -1)
			output = val.substring(0,st) + "<em>" + val.substring(st, st+this.sInput.length) + "</em>" + val.substring(st+this.sInput.length);
		
		var span 		= _avs.DOM.createElement("span", {}, output, true);
		if (arr[i].info != "") {
			var br			= _avs.DOM.createElement("br", {});
			span.appendChild(br);
			var small		= _avs.DOM.createElement("small", {}, arr[i].info);
			span.appendChild(small);
		}
		
		var a 			= _avs.DOM.createElement("a", { href:"#" });
		
		var tl 		= _avs.DOM.createElement("span", {className:"tl"}, " ");
		var tr 		= _avs.DOM.createElement("span", {className:"tr"}, " ");
		a.appendChild(tl);
		a.appendChild(tr);
		
		a.appendChild(span);
		
		a.name = i+1;
		a.onclick = function () { pointer.setHighlightedValue(); return false; }
		a.onmouseover = function () { pointer.setHighlight(this.name); }
		
		var li 			= _avs.DOM.createElement(  "li", {}, a  );
		
		ul.appendChild( li );
	}
	
	
	// no results
	//
	if (arr.length == 0) {
		var li 			= _avs.DOM.createElement(  "li", {className:"as_warning"}, ""  );
		
		ul.appendChild( li );
	}
	
	
	div.appendChild( ul );
	
	
	var fcorner = _avs.DOM.createElement("div", {className:"as_corner"});
	var fbar = _avs.DOM.createElement("div", {className:"as_bar"});
	var footer = _avs.DOM.createElement("div", {className:"as_footer"});
	footer.appendChild(fcorner);
	footer.appendChild(fbar);
	div.appendChild(footer);
	
	// get position of target textfield
	// position holding div below it
	// set width of holding div to width of field
	//
	var pos = _avs.DOM.getPos(this.fld);
	
	div.style.left 		= pos.x + "px";
	div.style.top 		= ( pos.y + this.fld.offsetHeight + this.oP.offsety ) + "px";
	div.style.width 	= this.fld.offsetWidth + "px";
	
	// set mouseover functions for div
	// when mouse pointer leaves div, set a timeout to remove the list after an interval
	// when mouse enters div, kill the timeout so the list won't be removed
	//
	div.onmouseover 	= function(){ pointer.killTimeout() }
	div.onmouseout 		= function(){ pointer.resetTimeout() }

	// add DIV to document
	//
	
	document.getElementsByTagName("body")[0].appendChild(div);
	
	// currently no item is highlighted
	//
	this.iHighlighted = 0;
	
	// remove list after an interval
	//
	var pointer = this;
	this.toID = setTimeout(function () { pointer.clearSuggestions() }, this.oP.timeout);
}

_avs.AutoSuggest.prototype.changeHighlight = function(key) {	
	var list = _avs.DOM.getElement("as_ul");
	if (!list)
		return false;
	
	var n;

	if (key == 40)
		n = this.iHighlighted + 1;
	else if (key == 38)
		n = this.iHighlighted - 1;
	
	
	if (n > list.childNodes.length)
		n = list.childNodes.length;
	if (n < 1)
		n = 1;
	
	
	this.setHighlight(n);
}

_avs.AutoSuggest.prototype.setHighlight = function(n) {
	var list = _avs.DOM.getElement("as_ul");
	if (!list)
		return false;
	
	if (this.iHighlighted > 0)
		this.clearHighlight();
	
	this.iHighlighted = Number(n);
	
	list.childNodes[this.iHighlighted-1].className = "as_highlight";


	this.killTimeout();
}


_avs.AutoSuggest.prototype.clearHighlight = function() {
	var list = _avs.DOM.getElement("as_ul");
	if (!list)
		return false;
	
	if (this.iHighlighted > 0) {
		list.childNodes[this.iHighlighted-1].className = "";
		this.iHighlighted = 0;
	}
}


_avs.AutoSuggest.prototype.setHighlightedValue = function () {
	if (this.iHighlighted) {
		this.sInput = this.fld.value = this.aSuggestions[ this.iHighlighted-1 ].value;
		
		// move cursor to end of input (safari)
		//
		this.fld.focus();
		if (this.fld.selectionStart)
			this.fld.setSelectionRange(this.sInput.length, this.sInput.length);
		

		this.clearSuggestions();
		
		// pass selected object to callback function, if exists
		//
		if (typeof(this.oP.callback) == "function") {
			this.oP.callback( this.aSuggestions[this.iHighlighted-1] );
			
		}
		if (this.oP.breaking.value && this.oP.breaking.components) {
			if (this.oP.breaking.components.street) {
				var streetComp  = _avs.DOM.getElement(this.oP.breaking.components.street);
				if (streetComp)
					streetComp.textContent = "Street Number";
			}
			if (this.oP.breaking.components.suburb) {
				var suburbComp  = _avs.DOM.getElement(this.oP.breaking.components.suburb);
				if (suburbComp)
					suburbComp.textContent = "Suburbs";
			}
			if (this.oP.breaking.components.postcode) {
				var postcodeComp  = _avs.DOM.getElement(this.oP.breaking.components.postcode);
				if (postcodeComp)
					postcodeComp.textContent = "Post Code";
			}
			if (this.oP.breaking.components.state) {
				var stateComp  = _avs.DOM.getElement(this.oP.breaking.components.state);
				if (stateComp)
					stateComp.textContent = "State";
			}
		}
		var pointer = this;
		//clearTimeout(this.researchID);
		this.researchID = setTimeout(function () { pointer.research() }, 300);
			
	}
}

_avs.AutoSuggest.prototype.research = function() {
	clearTimeout(this.researchID);
	if (this.search_code != 1)
		this.getSuggestions(this.fld.value, false);
	else {
		if (this.oP.breaking.value && this.oP.breaking.components && this.iHighlighted > 0) {
			var info = this.aAddressInfos[this.iHighlighted-1].value;
			this.iHighlighted = 0;
			if (info == "undefined")
				return;
			if (this.oP.breaking.components.street) {
				var streetComp  = _avs.DOM.getElement(this.oP.breaking.components.street);
				if (streetComp && info[1] != "")
					streetComp.textContent = info[1];
			}
			if (this.oP.breaking.components.suburb) {
				var suburbComp  = _avs.DOM.getElement(this.oP.breaking.components.suburb);
				if (suburbComp && info[2] != "")
					suburbComp.textContent = info[2];
			}
			if (this.oP.breaking.components.postcode) {
				var postcodeComp  = _avs.DOM.getElement(this.oP.breaking.components.postcode);
				if (postcodeComp && info[3] != "")
					postcodeComp.textContent = info[3];
			}
			if (this.oP.breaking.components.state) {
				var stateComp  = _avs.DOM.getElement(this.oP.breaking.components.state);
				if (stateComp && info[4] != "")
					stateComp.textContent = info[4];
			}
		}
		this.iHighlighted = 0;
	}
}
_avs.AutoSuggest.prototype.killTimeout = function() {
	clearTimeout(this.toID);
}

_avs.AutoSuggest.prototype.resetTimeout = function() {
	clearTimeout(this.toID);
	var pointer = this;
	this.toID = setTimeout(function () { pointer.clearSuggestions() }, 1000);
}

_avs.AutoSuggest.prototype.clearSuggestions = function () {
	
	this.killTimeout();
	
	var ele = _avs.DOM.getElement(this.idAs);
	var pointer = this;
	if (ele) {
		var fade = new _avs.Fader(ele,1,0,50,function () { _avs.DOM.removeElement(pointer.idAs) });
	}
	this.aSuggestions = []
}

// AJAX PROTOTYPE _____________________________________________


if (typeof(_avs.Ajax) == "undefined")
	_avs.Ajax = {}


_avs.Ajax = function () {
	this.req = {};
	this.isIE = false;
}


_avs.Ajax.prototype.makeRequest = function (url, meth, onComp, onErr) {
	if (meth != "POST")
		meth = "GET";
	
	this.onComplete = onComp;
	this.onError = onErr;
	
	var pointer = this;
	
	// branch for native XMLHttpRequest object
	if (window.XMLHttpRequest) {
		this.req = new XMLHttpRequest();
		this.req.onreadystatechange = function () { pointer.processReqChange() };
		this.req.open("GET", url, true); //
		this.req.send(null);
	// branch for IE/Windows ActiveX version
	} else if (window.ActiveXObject) {
		this.req = new ActiveXObject("Microsoft.XMLHTTP");
		if (this.req) {
			this.req.onreadystatechange = function () { pointer.processReqChange() };
			this.req.open(meth, url, true);
			this.req.send();
		}
	}
}


_avs.Ajax.prototype.processReqChange = function() {
	
	// only if req shows "loaded"
	if (this.req.readyState == 4) {
		// only if "OK"
		if (this.req.status == 200) {
			this.onComplete( this.req );
		} else {
			this.onError( this.req.status );
		}
	}
}


// DOM PROTOTYPE _____________________________________________


if (typeof(_avs.DOM) == "undefined")
	_avs.DOM = {}


_avs.DOM.createElement = function ( type, attr, cont, html ) {
	var ne = document.createElement( type );
	if (!ne)
		return false;
		
	for (var a in attr)
		ne[a] = attr[a];
		
	if (typeof(cont) == "string" && !html)
		ne.appendChild( document.createTextNode(cont) );
	else if (typeof(cont) == "string" && html)
		ne.innerHTML = cont;
	else if (typeof(cont) == "object")
		ne.appendChild( cont );

	return ne;
}


_avs.DOM.clearElement = function ( id ) {
	var ele = this.getElement( id );
	
	if (!ele)
		return false;
	
	while (ele.childNodes.length)
		ele.removeChild( ele.childNodes[0] );
	
	return true;
}

_avs.DOM.removeElement = function ( ele ) {
	var e = this.getElement(ele);
	
	if (!e)
		return false;
	else if (e.parentNode.removeChild(e))
		return true;
	else
		return false;
}

_avs.DOM.replaceContent = function ( id, cont, html ) {
	var ele = this.getElement( id );
	
	if (!ele)
		return false;
	
	this.clearElement( ele );
	
	if (typeof(cont) == "string" && !html)
		ele.appendChild( document.createTextNode(cont) );
	else if (typeof(cont) == "string" && html)
		ele.innerHTML = cont;
	else if (typeof(cont) == "object")
		ele.appendChild( cont );
}

_avs.DOM.getElement = function ( ele ) {
	if (typeof(ele) == "undefined") {
		return false;
	} else if (typeof(ele) == "string") {
		var re = document.getElementById( ele );
		if (!re)
			return false;
		else if (typeof(re.appendChild) != "undefined" ) {
			return re;
		} else {
			return false;
		}
	}
	else if (typeof(ele.appendChild) != "undefined")
		return ele;
	else
		return false;
}

_avs.DOM.appendChildren = function ( id, arr ) {
	var ele = this.getElement( id );
	
	if (!ele)
		return false;
	
	
	if (typeof(arr) != "object")
		return false;
		
	for (var i=0;i<arr.length;i++) {
		var cont = arr[i];
		if (typeof(cont) == "string")
			ele.appendChild( document.createTextNode(cont) );
		else if (typeof(cont) == "object")
			ele.appendChild( cont );
	}
}

_avs.DOM.getPos = function ( ele ) {
	var ele = this.getElement(ele);

	var obj = ele;

	var curleft = 0;
	if (obj.offsetParent) {
		while (obj.offsetParent) {
			curleft += obj.offsetLeft
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)
		curleft += obj.x;


	var obj = ele;
	
	var doc = ele && ele.ownerDocument;
	var docElem = doc.documentElement;

	if ( typeof ele.getBoundingClientRect !== "undefined" ) {
		box = ele.getBoundingClientRect();
	}

	var win = window;

	var top = box.top  + ( win.pageYOffset || docElem.scrollTop )  - ( docElem.clientTop  || 0 );

	// return {x:curleft, y:curtop}
	return {x:curleft, y:top}
	
}


// FADER PROTOTYPE _____________________________________________

if (typeof(_avs.Fader) == "undefined")
	_avs.Fader = {}

_avs.Fader = function (ele, from, to, fadetime, callback) {	
	if (!ele)
		return false;
	
	this.ele = ele;
	
	this.from = from;
	this.to = to;
	
	this.callback = callback;
	
	this.nDur = fadetime;
		
	this.nInt = 50;
	this.nTime = 0;
	
	var p = this;
	this.nID = setInterval(function() { p._fade() }, this.nInt);
}

_avs.Fader.prototype._fade = function() {
	this.nTime += this.nInt;
	
	var ieop = Math.round( this._tween(this.nTime, this.from, this.to, this.nDur) * 100 );
	var op = ieop / 100;
	
	if (this.ele.filters)  { // internet explorer 
		try {
			this.ele.filters.item("DXImageTransform.Microsoft.Alpha").opacity = ieop;
		} catch (e) { 
			// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
			this.ele.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity='+ieop+')';
		}
	} else  {// other browsers
		this.ele.style.opacity = op;
	}
	
	
	if (this.nTime == this.nDur) {
		clearInterval( this.nID );
		if (this.callback != undefined)
			this.callback();
	}
}

_avs.Fader.prototype._tween = function(t,b,c,d) {
	return b + ( (c-b) * (t/d) );
}