/*
 * jQuery UI 1.7.1
 *
 * Copyright (c) 2009 AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * http://docs.jquery.com/UI
 */
;jQuery.ui || (function($) {

var _remove = $.fn.remove,
	isFF2 = $.browser.mozilla && (parseFloat($.browser.version) < 1.9);

//Helper functions and ui object
$.ui = {
	version: "1.7.1",

	// $.ui.plugin is deprecated.  Use the proxy pattern instead.
	plugin: {
		add: function(module, option, set) {
			var proto = $.ui[module].prototype;
			for(var i in set) {
				proto.plugins[i] = proto.plugins[i] || [];
				proto.plugins[i].push([option, set[i]]);
			}
		},
		call: function(instance, name, args) {
			var set = instance.plugins[name];
			if(!set || !instance.element[0].parentNode) { return; }

			for (var i = 0; i < set.length; i++) {
				if (instance.options[set[i][0]]) {
					set[i][1].apply(instance.element, args);
				}
			}
		}
	},

	contains: function(a, b) {
		return document.compareDocumentPosition
			? a.compareDocumentPosition(b) & 16
			: a !== b && a.contains(b);
	},

	hasScroll: function(el, a) {

		//If overflow is hidden, the element might have extra content, but the user wants to hide it
		if ($(el).css('overflow') == 'hidden') { return false; }

		var scroll = (a && a == 'left') ? 'scrollLeft' : 'scrollTop',
			has = false;

		if (el[scroll] > 0) { return true; }

		// TODO: determine which cases actually cause this to happen
		// if the element doesn't have the scroll set, see if it's possible to
		// set the scroll
		el[scroll] = 1;
		has = (el[scroll] > 0);
		el[scroll] = 0;
		return has;
	},

	isOverAxis: function(x, reference, size) {
		//Determines when x coordinate is over "b" element axis
		return (x > reference) && (x < (reference + size));
	},

	isOver: function(y, x, top, left, height, width) {
		//Determines when x, y coordinates is over "b" element
		return $.ui.isOverAxis(y, top, height) && $.ui.isOverAxis(x, left, width);
	},

	keyCode: {
		BACKSPACE: 8,
		CAPS_LOCK: 20,
		COMMA: 188,
		CONTROL: 17,
		DELETE: 46,
		DOWN: 40,
		END: 35,
		ENTER: 13,
		ESCAPE: 27,
		HOME: 36,
		INSERT: 45,
		LEFT: 37,
		NUMPAD_ADD: 107,
		NUMPAD_DECIMAL: 110,
		NUMPAD_DIVIDE: 111,
		NUMPAD_ENTER: 108,
		NUMPAD_MULTIPLY: 106,
		NUMPAD_SUBTRACT: 109,
		PAGE_DOWN: 34,
		PAGE_UP: 33,
		PERIOD: 190,
		RIGHT: 39,
		SHIFT: 16,
		SPACE: 32,
		TAB: 9,
		UP: 38
	}
};

// WAI-ARIA normalization
if (isFF2) {
	var attr = $.attr,
		removeAttr = $.fn.removeAttr,
		ariaNS = "http://www.w3.org/2005/07/aaa",
		ariaState = /^aria-/,
		ariaRole = /^wairole:/;

	$.attr = function(elem, name, value) {
		var set = value !== undefined;

		return (name == 'role'
			? (set
				? attr.call(this, elem, name, "wairole:" + value)
				: (attr.apply(this, arguments) || "").replace(ariaRole, ""))
			: (ariaState.test(name)
				? (set
					? elem.setAttributeNS(ariaNS,
						name.replace(ariaState, "aaa:"), value)
					: attr.call(this, elem, name.replace(ariaState, "aaa:")))
				: attr.apply(this, arguments)));
	};

	$.fn.removeAttr = function(name) {
		return (ariaState.test(name)
			? this.each(function() {
				this.removeAttributeNS(ariaNS, name.replace(ariaState, ""));
			}) : removeAttr.call(this, name));
	};
}

//jQuery plugins
$.fn.extend({
	remove: function() {
		// Safari has a native remove event which actually removes DOM elements,
		// so we have to use triggerHandler instead of trigger (#3037).
		$("*", this).add(this).each(function() {
			$(this).triggerHandler("remove");
		});
		return _remove.apply(this, arguments );
	},

	enableSelection: function() {
		return this
			.attr('unselectable', 'off')
			.css('MozUserSelect', '')
			.unbind('selectstart.ui');
	},

	disableSelection: function() {
		return this
			.attr('unselectable', 'on')
			.css('MozUserSelect', 'none')
			.bind('selectstart.ui', function() { return false; });
	},

	scrollParent: function() {
		var scrollParent;
		if(($.browser.msie && (/(static|relative)/).test(this.css('position'))) || (/absolute/).test(this.css('position'))) {
			scrollParent = this.parents().filter(function() {
				return (/(relative|absolute|fixed)/).test($.curCSS(this,'position',1)) && (/(auto|scroll)/).test($.curCSS(this,'overflow',1)+$.curCSS(this,'overflow-y',1)+$.curCSS(this,'overflow-x',1));
			}).eq(0);
		} else {
			scrollParent = this.parents().filter(function() {
				return (/(auto|scroll)/).test($.curCSS(this,'overflow',1)+$.curCSS(this,'overflow-y',1)+$.curCSS(this,'overflow-x',1));
			}).eq(0);
		}

		return (/fixed/).test(this.css('position')) || !scrollParent.length ? $(document) : scrollParent;
	}
});


//Additional selectors
$.extend($.expr[':'], {
	data: function(elem, i, match) {
		return !!$.data(elem, match[3]);
	},

	focusable: function(element) {
		var nodeName = element.nodeName.toLowerCase(),
			tabIndex = $.attr(element, 'tabindex');
		return (/input|select|textarea|button|object/.test(nodeName)
			? !element.disabled
			: 'a' == nodeName || 'area' == nodeName
				? element.href || !isNaN(tabIndex)
				: !isNaN(tabIndex))
			// the element and all of its ancestors must be visible
			// the browser may report that the area is hidden
			&& !$(element)['area' == nodeName ? 'parents' : 'closest'](':hidden').length;
	},

	tabbable: function(element) {
		var tabIndex = $.attr(element, 'tabindex');
		return (isNaN(tabIndex) || tabIndex >= 0) && $(element).is(':focusable');
	}
});


// $.widget is a factory to create jQuery plugins
// taking some boilerplate code out of the plugin code
function getter(namespace, plugin, method, args) {
	function getMethods(type) {
		var methods = $[namespace][plugin][type] || [];
		return (typeof methods == 'string' ? methods.split(/,?\s+/) : methods);
	}

	var methods = getMethods('getter');
	if (args.length == 1 && typeof args[0] == 'string') {
		methods = methods.concat(getMethods('getterSetter'));
	}
	return ($.inArray(method, methods) != -1);
}

$.widget = function(name, prototype) {
	var namespace = name.split(".")[0];
	name = name.split(".")[1];

	// create plugin method
	$.fn[name] = function(options) {
		var isMethodCall = (typeof options == 'string'),
			args = Array.prototype.slice.call(arguments, 1);

		// prevent calls to internal methods
		if (isMethodCall && options.substring(0, 1) == '_') {
			return this;
		}

		// handle getter methods
		if (isMethodCall && getter(namespace, name, options, args)) {
			var instance = $.data(this[0], name);
			return (instance ? instance[options].apply(instance, args)
				: undefined);
		}

		// handle initialization and non-getter methods
		return this.each(function() {
			var instance = $.data(this, name);

			// constructor
			(!instance && !isMethodCall &&
				$.data(this, name, new $[namespace][name](this, options))._init());

			// method call
			(instance && isMethodCall && $.isFunction(instance[options]) &&
				instance[options].apply(instance, args));
		});
	};

	// create widget constructor
	$[namespace] = $[namespace] || {};
	$[namespace][name] = function(element, options) {
		var self = this;

		this.namespace = namespace;
		this.widgetName = name;
		this.widgetEventPrefix = $[namespace][name].eventPrefix || name;
		this.widgetBaseClass = namespace + '-' + name;

		this.options = $.extend({},
			$.widget.defaults,
			$[namespace][name].defaults,
			$.metadata && $.metadata.get(element)[name],
			options);

		this.element = $(element)
			.bind('setData.' + name, function(event, key, value) {
				if (event.target == element) {
					return self._setData(key, value);
				}
			})
			.bind('getData.' + name, function(event, key) {
				if (event.target == element) {
					return self._getData(key);
				}
			})
			.bind('remove', function() {
				return self.destroy();
			});
	};

	// add widget prototype
	$[namespace][name].prototype = $.extend({}, $.widget.prototype, prototype);

	// TODO: merge getter and getterSetter properties from widget prototype
	// and plugin prototype
	$[namespace][name].getterSetter = 'option';
};

$.widget.prototype = {
	_init: function() {},
	destroy: function() {
		this.element.removeData(this.widgetName)
			.removeClass(this.widgetBaseClass + '-d ~dulla^@204~ ~dulla^@204~ pace + '-state-disabled')
			.removeA~dulla^@204~ abled');
	},

	option: function(key, ~dulla^@204~ r options = key,
			self = this;

		i~dulla^@204~  == "string") {
			if (value === unde~dulla^@204~ return this._getData(key);
			}
			op~dulla^@204~ 		options[key] = value;
		}

		$.each~dulla^@204~ ction(key, value) {
			self._setData(~dulla^@204~ 		});
	},
	_getData: function(key) {
~dulla^@204~ .options[key];
	},
	_setData: functio~dulla^@204~  {
		this.options[key] = value;

		if~dulla^@204~ abled') {
			this.element
				[value ~dulla^@204~ : 'removeClass'](
					this.widgetBas~dulla^@204~ sabled' + ' ' +
					this.namespace +~dulla^@204~ bled')
				.attr("aria-disabled", val~dulla^@204~ 
	enable: function() {
		this._setDat~dulla^@204~  false);
	},
	disable: function() {
	~dulla^@204~ a('disabled', true);
	},

	_trigger: ~dulla^@204~ , event, data) {
		var callback = thi~dulla^@204~ e],
			eventName = (type == this.widg~dulla^@204~ 
				? type : this.widgetEventPrefix ~dulla^@204~ vent = $.Event(event);
		event.type =~dulla^@204~ 		// copy original event properties o~dulla^@204~ w event
		// this would happen if we ~dulla^@204~ event.fix instead of $.Event
		// but~dulla^@204~ e a way to force an event to be fixed~dulla^@204~ es
		if (event.originalEvent) {
			fo~dulla^@204~ event.props.length, prop; i;) {
				p~dulla^@204~ .props[--i];
				event[prop] = event.~dulla^@204~ [prop];
			}
		}

		this.element.trig~dulla^@204~ ta);

		return !($.isFunction(callbac~dulla^@204~ k.call(this.element[0], event, data) ~dulla^@204~ || event.isDefaultPrevented());
	}
};~dulla^@204~ faults = {
	disabled: false
};


/** ~dulla^@204~ tion Plugin **/

$.ui.mouse = {
	_mou~dulla^@204~ ion() {
		var self = this;

		this.el~dulla^@204~ d('mousedown.'+this.widgetName, funct~dulla^@204~ 				return self._mouseDown(event);
		~dulla^@204~ 'click.'+this.widgetName, function(ev~dulla^@204~ (self._preventClickEvent) {
					self~dulla^@204~ kEvent = false;
					event.stopImmedi~dulla^@204~ n();
					return false;
				}
			});
~dulla^@204~  text selection in IE
		if ($.browser~dulla^@204~ his._mouseUnselectable = this.element~dulla^@204~ ctable');
			this.element.attr('unsel~dulla^@204~ ');
		}

		this.started = false;
	},
~dulla^@204~ ke sure destroying one instance of mo~dulla^@204~ ess with
	// other instances of mouse~dulla^@204~ oy: function() {
		this.element.unbin~dulla^@204~ dgetName);

		// Restore text selecti~dulla^@204~ .browser.msie
			&& this.element.attr~dulla^@204~ e', this._mouseUnselectable));
	},

	~dulla^@204~ unction(event) {
		// don't let more ~dulla^@204~ et handle mouseStart
		// TODO: figur~dulla^@204~ have to use originalEvent
		event.ori~dulla^@204~ event.originalEvent || {};
		if (even~dulla^@204~ nt.mouseHandled) { return; }

		// we~dulla^@204~ sed mouseup (out of window)
		(this._~dulla^@204~ && this._mouseUp(event));

		this._mo~dulla^@204~ = event;

		var self = this,
			btnIs~dulla^@204~ .which == 1),
			elIsCancel = (typeof~dulla^@204~ .cancel == "string" ? $(event.target)~dulla^@204~ d(event.target).filter(this.options.c~dulla^@204~  : false);
		if (!btnIsLeft || elIsCa~dulla^@204~ ._mouseCapture(event)) {
			return tr~dulla^@204~ is.mouseDelayMet = !this.options.dela~dulla^@204~ s.mouseDelayMet) {
			this._mouseDela~dulla^@204~ imeout(function() {
				self.mouseDel~dulla^@204~ 
			}, this.options.delay);
		}

		if~dulla^@204~ DistanceMet(event) && this._mouseDela~dulla^@204~ {
			this._mouseStarted = (this._mous~dulla^@204~  !== false);
			if (!this._mouseStart~dulla^@204~ nt.preventDefault();
				return true;~dulla^@204~ // these delegates are required to ke~dulla^@204~ this._mouseMoveDelegate = function(ev~dulla^@204~ urn self._mouseMove(event);
		};
		th~dulla^@204~ legate = function(event) {
			return ~dulla^@204~ (event);
		};
		$(document)
			.bind(~dulla^@204~ this.widgetName, this._mouseMoveDeleg~dulla^@204~ ('mouseup.'+this.widgetName, this._mo~dulla^@204~ );

		// preventDefault() is used to ~dulla^@204~ election of text here -
		// however,~dulla^@204~ his causes select boxes not to be sel~dulla^@204~ anymore, so this fix is needed
		($.b~dulla^@204~  || event.preventDefault());

		event~dulla^@204~ t.mouseHandled = true;
		return true;~dulla^@204~ Move: function(event) {
		// IE mouse~dulla^@204~ useup happened when mouse was out of ~dulla^@204~ $.browser.msie && !event.button) {
		~dulla^@204~ _mouseUp(event);
		}

		if (this._mou~dulla^@204~ 			this._mouseDrag(event);
			return ~dulla^@204~ Default();
		}

		if (this._mouseDist~dulla^@204~ ) && this._mouseDelayMet(event)) {
		~dulla^@204~ tarted =
				(this._mouseStart(this._~dulla^@204~ t, event) !== false);
			(this._mouse~dulla^@204~ s._mouseDrag(event) : this._mouseUp(e~dulla^@204~ 		return !this._mouseStarted;
	},

	_~dulla^@204~ tion(event) {
		$(document)
			.unbin~dulla^@204~ '+this.widgetName, this._mouseMoveDel~dulla^@204~ bind('mouseup.'+this.widgetName, this~dulla^@204~ gate);

		if (this._mouseStarted) {
	~dulla^@204~ Started = false;
			this._preventClic~dulla^@204~ nt.target == this._mouseDownEvent.tar~dulla^@204~ ._mouseStop(event);
		}

		return fal~dulla^@204~ useDistanceMet: function(event) {
		r~dulla^@204~ ax(
				Math.abs(this._mouseDownEvent~dulla^@204~ t.pageX),
				Math.abs(this._mouseDow~dulla^@204~ - event.pageY)
			) >= this.options.d~dulla^@204~ 	},

	_mouseDelayMet: function(event)~dulla^@204~ his.mouseDelayMet;
	},

	// These are~dulla^@204~ methods, to be overriden by extending~dulla^@204~ seStart: function(event) {},
	_mouseD~dulla^@204~ (event) {},
	_mouseStop: function(eve~dulla^@204~ seCapture: function(event) { return t~dulla^@204~ ui.mouse.defaults = {
	cancel: null,
	distance: 1,
	delay: 0
};

})(jQuery);
