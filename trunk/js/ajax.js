/* Simple AJAX Code-Kit (SACK) v1.6.1 */
/* ©2005 Gregory Wild-Smith */
/* www.twilightuniverse.com */
/* Software licenced under a modified X11 licence,
   see documentation or authors website for more details */

function sack(file) {
	this.xmlhttp = null;

	this.resetData = function() {
		this.method = "GET";
        this.mode = true;
  		this.execute = false;
  		this.element = null;
		this.elementObj = null;
		this.requestFile = file;
		this.responseStatus = new Array(2);
  	};

	this.resetFunctions = function() {
  		this.onLoading = function() { };
  		this.onLoaded = function() { };
  		this.onInteractive = function() { };
  		this.onCompletion = function() { };
  		this.onError = function() { };
		this.onFail = function() { };
	};

	this.reset = function() {
		this.resetFunctions();
		this.resetData();
	};

	this.createAJAX = function() {
		try {
			this.xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e1) {
			try {
				this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e2) {
				this.xmlhttp = null;
			}
		}

		if (! this.xmlhttp) {
			if (typeof XMLHttpRequest != "undefined") {
				this.xmlhttp = new XMLHttpRequest();
			} else {
				this.failed = true;
			}
		}
	};

	this.runResponse = function() {
		eval(this.response);
	}

	this.runAJAX = function(urlstring) {
		if (this.failed) {
			this.onFail();
		} else {
			if (this.element) {
				this.elementObj = document.getElementById(this.element);
			}
			if (this.xmlhttp) {
				var self = this;
				if (this.method == "GET") {
					this.xmlhttp.open(this.method, this.requestFile, this.mode);
				} else {
					this.xmlhttp.open(this.method, this.requestFile, this.mode);
					try {
						this.xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
					} catch (e) { }
				}

				this.xmlhttp.onreadystatechange = function() {
					switch (self.xmlhttp.readyState) {
						case 1:
							self.onLoading();
							break;
						case 2:
							self.onLoaded();
							break;
						case 3:
							self.onInteractive();
							break;
						case 4:
							self.response = self.xmlhttp.responseText;
							self.responseXML = self.xmlhttp.responseXML;
							self.responseStatus[0] = self.xmlhttp.status;
							self.responseStatus[1] = self.xmlhttp.statusText;

							if (self.execute) {
								self.runResponse();
							}

							if (self.elementObj) {
								elemNodeName = self.elementObj.nodeName;
								elemNodeName.toLowerCase();
								if (elemNodeName == "input"
								|| elemNodeName == "select"
								|| elemNodeName == "option"
								|| elemNodeName == "textarea") {
									self.elementObj.value = self.response;
								} else {
									self.elementObj.innerHTML = self.response;
								}
							}
							if (self.responseStatus[0] == "200") {
								self.onCompletion();
							} else {
								self.onError();
							}

							self.URLString = "";
							break;
					}
				};

				this.xmlhttp.send(this.URLString);
			}
		}
	};

	this.reset();
	this.createAJAX();
}

var ajaxCache = new Array();
var ajax = new Array();

function ajaxCacheData(text, url)
{
   ajaxCache[url] = text;
}

function ajaxCacheHtml(element, url)
{
   ajaxCacheData(element.innerHTML, url);
}

function ajaxCacheHtmlId(elementId, url)
{
   var element = document.getElementById(elementId);
   ajaxCacheHtml(element, url);
}

function uploadFromHref(link, elementId)
{
    var url = link.href.substring(link.href.indexOf('?'), link.href.length);
    uploadHtmlToId(url, elementId);
    return false;
}

function uploadHtmlToId(url, elementId)
{
  var element = document.getElementById(elementId);
  uploadHtml(url, element);
}

function complete(element, ajaxIndex, url)
{
   ajaxCacheData(ajax[ajaxIndex].response, url);
   element.innerHTML = ajax[ajaxIndex].response;
   enableHrefTip(element);
   ajax[ajaxIndex] = false;
}

function uploadHtml(url, element)
{
 if(ajaxCache[url])
 {
    element.innerHTML = ajaxCache[url];
    enableHrefTip(element);
 }
 else
 {
    var rect = getBounds(element);
    var ajaxIndex = ajax.length;
    ajax[ajaxIndex] = new sack('ajax.php'+url);
    ajax[ajaxIndex].onCompletion = function(){ complete(element, ajaxIndex, url); };
    ajax[ajaxIndex].onError = function(){ complete(element, ajaxIndex, url); };
    ajax[ajaxIndex].runAJAX();
    return false;
 }
 return true;
}
