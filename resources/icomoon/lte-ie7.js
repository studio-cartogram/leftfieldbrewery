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
			'icon-untappd' : '&#xe004;',
			'icon-toronto' : '&#xe005;',
			'icon-tap' : '&#xe006;',
			'icon-restaurant' : '&#xe007;',
			'icon-newletter' : '&#xe008;',
			'icon-logo' : '&#xe009;',
			'icon-instagram' : '&#xe00a;',
			'icon-maris' : '&#xe00b;',
			'icon-mark' : '&#xe00c;',
			'icon-hover-nav' : '&#xe00d;',
			'icon-hover-map' : '&#xe00e;',
			'icon-flip-right' : '&#xe00f;',
			'icon-flip-left' : '&#xe010;',
			'icon-est2013' : '&#xe011;',
			'icon-eephus' : '&#xe012;',
			'icon-close' : '&#xe013;',
			'icon-brewpub' : '&#xe014;',
			'icon-bar-restaurant' : '&#xe015;',
			'icon-bar' : '&#xe016;',
			'icon-arrow-right' : '&#xe017;',
			'icon-arrow-left' : '&#xe018;',
			'icon-doubleipa' : '&#xe019;',
			'icon-diamond' : '&#xe01a;',
			'icon-diamond-stroke' : '&#xe01b;',
			'icon-cross' : '&#xe01c;',
			'icon-mail' : '&#xe01d;'
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