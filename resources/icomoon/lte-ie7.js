/* Use this script if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-phone' : '&#xe000;',
			'icon-twitter' : '&#xe001;',
			'icon-google-plus' : '&#xe002;',
			'icon-facebook' : '&#xe003;',
			'icon-envelope-alt' : '&#xf0e0;',
			'icon-map-marker' : '&#xf041;',
			'icon-bubbles' : '&#xe01f;',
			'icon-bubbles-2' : '&#xe01e;',
			'icon-untappd' : '&#xe004;',
			'icon-brewpub' : '&#xe005;',
			'icon-bar' : '&#xe006;',
			'icon-toronto' : '&#xe007;',
			'icon-tap' : '&#xe008;',
			'icon-bar-restaurant' : '&#xe009;',
			'icon-arrow-right' : '&#xe00a;',
			'icon-restaurant' : '&#xe00b;',
			'icon-newletter' : '&#xe00c;',
			'icon-arrow-left' : '&#xe00d;',
			'icon-doubleipa' : '&#xe00e;',
			'icon-mark' : '&#xe00f;',
			'icon-maris' : '&#xe010;',
			'icon-mail' : '&#xe011;',
			'icon-logo' : '&#xe012;',
			'icon-instagram' : '&#xe013;',
			'icon-flip-right' : '&#xe014;',
			'icon-flip-left' : '&#xe015;',
			'icon-est2013' : '&#xe016;',
			'icon-eephus' : '&#xe017;',
			'icon-diamond' : '&#xe018;',
			'icon-diamond-stroke' : '&#xe019;',
			'icon-cross' : '&#xe01a;',
			'icon-close' : '&#xe01b;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; i < els.length; i += 1) {
		el = els[i];
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};