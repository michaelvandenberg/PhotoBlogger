PhotoBlogger
Theme Version: 1.0.6
Author: Michael Van Den Berg 
Author URL: http://michaelvandenberg.com/

--------------------
=== Description ===
--------------------

PhotoBlogger is a theme specifically  designed for photobloggers, photographers and artists wanting to showcase their art in a fullscreen slider. It’s modern, minimal and responsive, and it’s accessibility-ready. It supports several post formats (quote, link, image and aside), a full width page template, and… well, why don’t you just give it a try? You know you want to! ;)


--------------------
=== Copyright ===
--------------------

PhotoBlogger WordPress Theme, Copyright 2016 Michael Van Den Berg.
PhotoBlogger is distributed under the terms of the GNU GPL license 2.0 or later.

PhotoBlogger is based on Underscores http://underscores.me/, (C) 2012-2016 Automattic, Inc.


--------------------
=== Installation ===
--------------------

1. Sign into your WordPress dashboard, go to Appearance > Themes, and click Add New.
2. Click Add New.
3. Click Upload.
4. Click Choose File and select the theme zip file.
5. Click Install Now.
6. Click Add New, then click Upload, then click Choose File.
7. After WordPress installs the theme, click Activate.
8. You've successfully installed your new theme!

-- Slider setup.

This theme uses the featured content module of the Jetpack plugin to setup the fullscreen
slider. Visit this page: http://jetpack.me/ to read more about Jetpack and how to install it.

After installing and activating the Jetpack plugin follow these steps:

1. Add a new post/page or modify an existing one and give this page a 'featured' tag and add a featured image.
2. Repeat step 1 for any additional slides (maximum = 5). Good luck! ;)

Note: The fullscreen slider will only be shown on the front page.


--------------------
=== Licenses ===
--------------------

-- Fonts.
*
*  Roboto / by Christian Robertson.
*  URL: https://www.google.com/fonts/specimen/Fjalla+One
*  License: Apache License 2.0 / https://www.apache.org/licenses/LICENSE-2.0
*
*  Merriweather / by Eben Sorkin
*  URL: https://www.google.com/fonts/specimen/Open+Sans
*  License: SIL Open Font License 1.1 / http://scripts.sil.org/ofl_web
*
*  Genericons / by Automattic
*  URL: http://genericons.com/
*  License: GNU GPL License 2.0 / https://www.gnu.org/licenses/gpl-2.0.html
*

-- Images.
*
*  The image on the theme screenshot is based on a picture from Paul Itkin.
*  URL: https://unsplash.com/itkin
*  License: CC0 / http://creativecommons.org/publicdomain/zero/1.0/
*

-- Other.
*
*  Based on Underscores, Copyright (C) 2012-2016 Automattic, Inc.
*  URL: http://underscores.me/
*  License: GNU GPL License 2.0 [or later] / https://www.gnu.org/licenses/gpl-2.0.html
*
*  Normalize.css, Copyright (C) 2012-2016 Nicolas Gallagher and Jonathan Neal.
*  URL: http://necolas.github.io/normalize.css/
*  License: MIT License / http://opensource.org/licenses/MIT
*
*  Flickity, Copyright (C) 2012-2016 MetaFizzy.
*  URL: http://flickity.metafizzy.co/
*  License: GNU GPL License 3.0 [or later] / https://www.gnu.org/licenses/gpl-3.0.html
*


--------------------
=== Changelog ===
--------------------

*
* 1.0.6 / 29.06.2016
* - Enhanced Flickity slider with Aria for improved accessibility.
* - Removed the sass files from the (WordPress.org) distribution copy.
*
* 1.0.5 / 27.06.2016
* - Disabled autoplay when the skip-link has focus to make it more accessible.
* - Hide the prev/next buttons when the skip-link has focus.
* - Added some whitespace to the site info area in the footer.
*
* 1.0.4 / 26.06.2016
* - The <h1> in the mobile menu is now a <h2> and changed styles accordingly.
* - Changed aria-controls="menu" into aria-controls="mobile-navigation".
* - Outline (thin dotted) added to form inputs and menu toggle.
* - Removed title attributes from footer, the featured header and search form.
* - Added accessible text to the previous/next buttons in the Flickity slider.
* - Initialization of Flickity in HTML replaced with initialization in jQuery.
* - Post title added to the read more links in the slider.
* - Position of the menu-toggle stays fixed in the top right corner.
* - Menu items are now sized in relative units (rem) instead of pixels (px).
* - Updated the language pot file.
*
* 1.0.3 / 30.05.2016
* - Replaced esc_textarea() with wp_kses on line 33 in author-bio.php.
* - Fixed multiple translations that needed to be escaped.
* - Removed second link to my website from the footer.
* - Default width and height set for the site logo.
* - Changed menu-toggle-text into screen-reader-text and added some additional styles.
*
* 1.0.2 / 26.05.2016
* - Fixed theme prefix (it's now correctly called: photoblogger_custom_header_options).
* - Fixed attributes and content output that should have been escaped.
* - Removed unnecessary echo when using esc_attr_e().
* - Text strings in the customizer are now translatable.
* - Added "'capability' => 'edit_theme_options'," to customizer settings.
* - Added original un-minified script of flickity in the js directory.
* - Removed TGM Plugin file and replaced it with Plugin Enhancements file.
* - Removed support for Jetpack Portfolio.
* - Removed custom widgets (better to let the user download a plugin).
* - Added option for custom copyright text in the footer.
* - Added support for editor styles.
* - Updated the language pot file.
* - Updated the theme tags with the new theme tags.
* - Optimized screenshot.png (reduced file size by 70%).
* - Changed if/else statement for the header when there is no header to display.
* - Improved photoblogger.js by using single quotes instead of mixed quotes.
* - Added missing semi-colon at the end of a few PHP statements.
* - Added support for custom site logo (and removed Jetpack site logo).
* - Improved legibility a bit by increasing line-height from 1.5 to 1.6 in SASS & CSS.
*
* 1.0.1 / 26.01.2016
* - Changed $post->ID to get_the_ID() in template-tags.php to fix WP_Debug errors.
* - Added $comment->comment_ID to get_comment_author_link() in custom-widgets.php.
* - Removed box shadow and some additional visual tweaks.
*
* 1.0.0 / 17.01.2016
* Initial release.
*
