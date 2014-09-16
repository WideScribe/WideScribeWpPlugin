==================
THE NEWSWIRE THEME
==================
Copyright (c) 2013 by WPThemes NZ (http://wpthemes.co.nz/)
This Theme is distributed under the terms of the GNU GPL.

===========
ABOUT Theme
=========== 
It's a fun and functional theme perfect for the personal blogger. Featuring a traditional layout it supports custom menus and is widget ready.

This theme is compatible with Wordpress Version 3.4 and above and it supports the new theme customization API (https://codex.wordpress.org/Theme_Customization_API).

All the image graphics and icons bundled with this theme are created by the author and licensed under the GPL.

Supported browsers: Firefox, Opera, Chrome, Safari and IE9+ (Some css3 styles like shadows, rounder corners and 2D transform are not supported by IE8 and below).

For free themes support, please contact us http://wpthemes.co.nz/contact/

Note: Images used in the screenshot are found on the demo site - http://thenewswire.co.nz/

============================================
Images and Graphics Copyright/License Info
============================================
 * All the image graphics and icons bundled with this theme are created by the author (WP Dev Shed) and licensed under the GNU GPL.
 
============================================
Scripts.js Copyright/License Info
============================================
 * All the entries inside scripts.js are written by the theme author (unless otherwise noted) and licensed under the GNU GPL.

============================================
This theme uses Toolbox as a theme backbone
============================================
 * Toolbox (http://wordpress.org/extend/themes/toolbox)
 * Copyright (c) Automattic (http://automattic.com)
 * Available under the terms of GNU GPL.
 
 
======================================
This theme uses Bones as a design tool
======================================
 * Bones (http://themble.com/bones)
 * Copyright (c) Eddie Machado (http://eddiemachado.com/)
 * This is totally free and under WTFPL license (Please read http://themble.com/bones/ for more information)


=====================================
This theme is bundled with Modernizr 
=====================================
 * Modernizr v2.6.2 (www.modernizr.com)
 * Modernizr is a JavaScript library that detects HTML5 and CSS3 features in the user’s browser.
 * Copyright (c) Faruk Ates, Paul Irish, Alex Sexton
 * Available under the BSD and MIT licenses: www.modernizr.com/license/


=================================
This theme is bundled with Cycle2
=================================
 * Cycle2 v20130203 (http://jquery.malsup.com/cycle2/)
 * Cycle2 is a versatile slideshow plugin for jQuery built around ease-of-use. It supports a declarative initialization style that allows full customization without any scripting.
 * Copyright © 2012 M. Alsup (https://github.com/malsup)
 * The Cycle2 plugin is dual licensed under the MIT (http://malsup.github.com/mit-license.txt) and GPL (http://malsup.github.com/gpl-license-v2.txt) licenses.
 

=======================================
This theme is bundled with imagesLoaded
=======================================
 * imagesLoaded v3.0.2 (http://desandro.github.io/imagesloaded/)
 * JavaScript is all like "You images done yet or what?" Detect when images have been loaded.
 * Released under the MIT License. (http://desandro.mit-license.org/)
 * This project has a storied legacy (https://github.com/desandro/imagesloaded/graphs/contributors). Its current incarnation was developed by Tomas Sardyha @Darsain and David DeSandro @desandro.


 
=================================
CHANGELOG
=================================
Version 1.0.7
 * removed the Customize options for the banners on header and sidebar
 * added 2 new files (banner-header.php and banner-sidebar.php) which the users can use in their child themes to add their own banner codes
 * modified the email social icon to use the correct mailto protocol instead of http
 
Version 1.0.6
 * added html and css styles for the fixed footer
 * added jquery fix for Safari
 * updated the pre_get_posts filter function
 
Version 1.0.5
 * removed the bundled Masonry script and enqueued the built-in WP script instead (jquery-masonry)
 * newswire_pagination() now supports core paginate_links() function
 * added sanitize callbacks to customizer settings
 * used pre_get_posts to filter main query to ignore sticky posts
 * added unminified versions of the following scripts - jquery.cycle2.scrollVert.min, jquery.cycle2.shuffle.min, jquery.cycle2.tile.min, 
imagesloaded.pkgd.min
 
Version 1.0.4
 * removed a function (from functions.php) that sometimes causes all the images in the media library to not display at all when setting a featured image
 * removed the featured video and color picker functions (from functions.php)
 * replaced the screenshot with 880x660 size
 
Version 1.0.3
 * fixed the bug that causes some youtube videos to not appear on posts with post-format: "video"
 * updated the css styles for <video> tags
 * updated thumbnail display on homepage
 * updated banner code display
 
Version 1.0.2
 * modified the way the homepage and archive pages handle excerpts
 * implemented get_post_gallery() in displaying gallery images in the homepage/archives
 * updated the handling of featured images on different post formats
 * removed the min-width and min-height for videos, embeds and iframes
 * fixed missing submit/input buttons on forms
 * enabled categorical hierarchies by default on sidebar templates
 
Version 1.0.1
 * replaced isotope with masonry
 * instead of the "No Featured Image" message, the slider now displays an excerpt and link to the sticky post
 * fixed the overflowing of custom Menu in sidebar containing more thant 5-6 submenus

Version 1.0
 * First public release