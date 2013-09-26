/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-twitter' : '&#xe000;',
			'icon-facebook' : '&#xe001;',
			'icon-google-plus' : '&#xe002;',
			'icon-phone' : '&#xe003;',
			'icon-wordmark' : '&#xe004;',
			'icon-untappd' : '&#xe006;',
			'icon-tap' : '&#xe007;',
			'icon-restaurant' : '&#xe008;',
			'icon-newletter' : '&#xe005;',
			'icon-mark' : '&#xe009;',
			'icon-mail' : '&#xe00a;',
			'icon-logo' : '&#xe00b;',
			'icon-loader-simple' : '&#xe00c;',
			'icon-instagram' : '&#xe00d;',
			'icon-flip-right' : '&#xe00e;',
			'icon-flip-left' : '&#xe00f;',
			'icon-cross' : '&#xe010;',
			'icon-close' : '&#xe011;',
			'icon-brewpub' : '&#xe012;',
			'icon-bar' : '&#xe013;',
			'icon-bar-restaurant' : '&#xe014;',
			'icon-arrow-right' : '&#xe015;',
			'icon-arrow-left' : '&#xe016;',
			'icon-mark-mug' : '&#xe017;',
			'icon-mandie-wheat' : '&#xe018;',
			'icon-icon-mandie' : '&#xe019;',
			'icon-maris-b' : '&#xe01a;',
			'icon-maris-a' : '&#xe01b;',
			'icon-eephus-b' : '&#xe01c;',
			'icon-eephus-a' : '&#xe01d;',
			'icon-doubleipa-b' : '&#xe01e;',
			'icon-doubleipa-a' : '&#xe01f;',
			'icon-resinbag' : '&#xe020;',
			'icon-resinbag-alt' : '&#xe021;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
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