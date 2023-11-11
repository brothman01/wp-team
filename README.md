# WP Team #
[![WPCS check](https://github.com/brothman01/wp-team/actions/workflows/wpcs.yml/badge.svg)](https://github.com/brothman01/wp-team/actions/workflows/wpcs.yml)
**Contributors:** [brothman01](https://profiles.wordpress.org/brothman01)  
**Tags:** [CPT](https://wordpress.org/themes/tags/productivity/), [Custom Fields](https://wordpress.org/themes/tags/monitor/), [Human-friendly](https://wordpress.org/themes/tags/updates/), [intuitive](https://wordpress.org/themes/tags/php/)
**Requires at least:** 4.6  
**Tested up to:** 6.2
**Stable tag:** 1.1  
**License:** GPLv2 or later  
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html  

## Description ##

Just a simple WordPress plugin that creates an employee custom post type that has custom fields to collect data about the employee and generate an employee page or section. While the single employee page is autogenerated, there are also blocks added to the WordPress block editor (react-based or vanillajs based) and a block added to Visual Composer depending on your preference.

## How To Use ##
After activating the plugin there will be a new button on the WordPress dashboard called 'Staff'.  Enter the staff dashboard page and create a post for each staff member on your team.  There will be fields to fill out for each new staff member to fill in when editing the staff member on the dashboard.  Once the staff members are filled in, add the WP Team block or the shortcode to your page.  The information from the staff members is automatically used to generate the team page.  The team page can be put on a page using the shortcode, one of the two WordPress native block editor blocks or the Visual Composer block depending on your preference.

## How do I set the order the staff members appear on the team page?
The order that the members appear in is determined by the post slug, they appear in alphabetical order by the slug value.


## To Use The Plugin:
Add new employees by filling out the fields pertaining to them in the custom fields added to their post on the WP Dashboard.Then you have a choice of how to display the information:
1) Add the shortcode from the shortcode column on the list view pertaining to that person.
2) Add the teampage component to a page in visual composer
3) Add the block to a page in the built in WordPress block editor.
