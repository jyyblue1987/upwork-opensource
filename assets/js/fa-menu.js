
// Customizable variables

var _faMenuAnim = (typeof _faMenuAnim === "undefined") ? 400 :_faMenuAnim;			// Animation time of revieling and hiding menu (defaut = 400)
var _faMenuEffect = (typeof _faMenuEffect === "undefined") ? "effect-2" :_faMenuEffect;	// Animation effect [effect-1, effect-2, effect-3] (defaut = "effect-2")
var _faMenuSublist = (typeof _faMenuSublist === "undefined") ? true :_faMenuSublist;			// Submenu dropdown animation (defaut = true)
var _faMenuHeader = (typeof _faMenuHeader === "undefined") ? true :_faMenuHeader;			// If fixed header is showing (defaut = true)
var _faMenuHeaderTitle = (typeof _faMenuHeaderTitle === "undefined") ? '<a href="#">Mooz</a>' :_faMenuHeaderTitle;		// Header Title
var _faMenuSearch = (typeof _faMenuSearch === "undefined") ? true :_faMenuSearch;			// If search is showing in header (defaut = true)

var _faMenuCustomS = (typeof _faMenuCustomS === "undefined") ? "fa-search" :_faMenuCustomS;			// Search icon in header (defaut = fa-search)
var _faMenuCustomM = (typeof _faMenuCustomM === "undefined") ? "fa-bars" :_faMenuCustomM;			// Menu icon in header (defaut = fa-bars)
var _faMenuRootURL = (typeof _faMenuRootURL === "undefined") ? "" :_faMenuRootURL;			// Root link for your website for search form (defaut = "")


// Do not touch these variables
var myScroll;

jQuery(document).ready(function() {

	var falistclass = (_faMenuSublist)?" fa-submenu":"";

	// Enables fallback for older browsers
	if (!Modernizr.csstransforms3d) {
		jQuery("body").addClass("no-csstransforms3d");
	}

	// Sets up html for doing animations
	jQuery("body").addClass("has-fa-menu").wrapInner(function () {
		return '<div id="fa-menu" class="'+_faMenuEffect+'"><div class="fa-menu-container"><div class="fa-menu-wrapper"></div></div></div>';
	});
	
	jQuery("#fa-menu").append('<nav class="fa-menu-list'+falistclass+'"><ul id="fa-menu-list-inner"></ul></nav>');
	if(_faMenuHeader){
		jQuery(".fa-menu-wrapper").addClass("fa-menu-padding");
		jQuery(".fa-menu-container").prepend('<div class="fa-menu-top-header">'+_faMenuHeaderTitle+'<form action="'+_faMenuRootURL+'"><input type="text" name="s" value="" /><input type="submit" value="" /></form></div>');
		if(_faMenuSearch){
			jQuery(".fa-menu-top-header").prepend('<a href="#" class="fa-menu-search"><i class="fa '+_faMenuCustomS+'"></i></a>');
		}
		jQuery(".fa-menu-top-header").prepend('<a href="#fa-menu" class="fa-menu-menu"><i class="fa '+_faMenuCustomM+'"></i></a>');
	}

	jQuery(".fa-menu-top-header input[type='text']").bind("blur", function () {
		jQuery(".fa-menu-top-header").css("position", "fixed").css("top", "0px");
	});

	jQuery(".fa-menu-top-header .fa-menu-search").bind("click", function () {
		jQuery('html,body').animate({
			scrollTop: 0
		});
		jQuery(".fa-menu-top-header").css("position", "absolute").css("top", "0px");
		jQuery(".fa-menu-top-header input[type='text']").focus();
		return false;
	});

	// Collects all menu lists and places them into ".fa-menu-list > ul"
	jQuery(".load-responsive").each(function() {
		var _this = jQuery(this),
			listTitle = '';
		if(_this.attr('rel')){
			listTitle = '<li class="fa-menu-header"><span>'+_this.attr('rel')+'</span></li>';
		}
		jQuery(".fa-menu-list > ul").append(listTitle+_this.html());
	});

	// Checks if menu has a submenu
	jQuery(".fa-menu-list.fa-submenu > ul > li ul").each(function () {
		var _this = jQuery(this).parent();
		_this.addClass("fa-has-sub");
	});

	// Copies body styles to ".fa-menu-container"
	// Adds event to hide menu when clicked on page
	var array = ['background','background-size','background-image', 'background-color', 'background-repeat', 'background-position'];
	jQuery.each( array , function(item, value) {
	    jQuery(".fa-menu-container").css(value, jQuery("body").css(value));
	});

	// Submenu links dropdown animation
	jQuery("#fa-menu-list-inner li > a").on("click tap", function () {
		var _this = jQuery(this).parent();
		if(_this.hasClass("fa-has-sub") == false){
			var thisel = _this.children("a");
			window.location = thisel.attr("href");
			return true;
		}else
		if(_this.hasClass("fa-sub-active")){
			var thisel = _this.children("a");
			window.location = thisel.attr("href");
			return true;
		}else{
			setTimeout(function () {
				_this.addClass("fa-sub-active");
			}, 100);
			_this.children("ul").children("li").css("display", "none").animate({height: "toggle"}, _faMenuAnim, function () {
				myScroll.refresh();
			});
			return false;
		}
		return false;
	});

	jQuery(".fa-menu-container").on("mousedown", function () {
		var _this = jQuery(this).parent();
		if(_this.hasClass("fa-menu-load")){
			var scrollpos = Math.abs(parseInt(jQuery('#fa-menu > .fa-menu-container > .fa-menu-wrapper').css("top")));
			_this.removeClass("fa-menu-animate");
			setTimeout(function () {
				_this.removeClass("fa-menu-load");
				_this.removeClass("fa-menu-setup");
				jQuery(document).scrollTop(scrollpos);
				jQuery("body").removeClass("fanomargin");
			}, _faMenuAnim+100);
			return false;
		}
		return true;
	});

	jQuery("#wpadminbar").appendTo("body");

	// Starts iScroll plugin for smooth menu scrolling
	myScroll = new IScroll('.fa-menu-list', {
		scrollbars: false,
		mouseWheel: true,
		interactiveScrollbars: false,
		shrinkScrollbars: 'scale',
		fadeScrollbars: false,
		tap: true
	});

	// Event on link #fa-menu, when pressed, reviels menu
	jQuery('a[href="#fa-menu"]').on( "click", function() {
		var scrollpos = jQuery(document).scrollTop(),
			_faMenuMain = jQuery("#fa-menu");
		_faMenuMain.find(".fa-menu-wrapper").css("top", "-"+parseInt(scrollpos)+"px");
		_faMenuMain.addClass("fa-menu-setup");
		_faMenuMain.toggleClass("fa-menu-load");
		setTimeout(function () {
			myScroll.refresh();
			_faMenuMain.toggleClass("fa-menu-animate");
		}, 10);
		jQuery("body").addClass("fanomargin");
		return false;
	});

});