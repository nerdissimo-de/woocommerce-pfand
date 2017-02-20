=== Woocommerce Pfand Plugin ===
Contributors: jessekeys
Donate link: http://www.nerdissimo.de
Tags: woocommerce, deposit
Requires at least: 3.1
Tested up to: 4.7.2
Stable tag: 2.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


This plugin makes it easy to add deposit like "bottle deposit" (German: Flaschenpfand) to WooCommerce products.


== Description ==

*Dieses Plugin ermöglicht es, jedem Woocommerce Produkt Pfandwerte zuzuweisen und somit Dinge wie Flaschenpfand abzubilden. Deutsche Übersetzung liegt bei. Für Anpassungen bitten wir um [Kontaktaufnahme](http://www.nerdissimo.de/).*

This plugin was written for a German beverage store. They needed deposits for bottles as well as boxes, which would be displayed separately and excluded from tax calculation.

With this plugin you can add a deposit to any WooCommerce product by adding the price under `Products - Deposit Types`.

**Note:** Because WordPress allows users to add multiple values and
comma-separate them, you have to input the prices with '.' (period) as the decimal separator, independent of WooCommerce settings.


== Features ==

* Translation-ready (German translation included)
* Uses built-in functionality of WordPress and Woocommerce thus fully compatible with, e.g. WP Export/Import tools
* Developer-friendly (more hooks & documentation to come)


== Custom code ==

Since there are a lot of different ways you or your customer may want this set up, please contact us for customizations such as:

* Compatibility with WooCommerce German Market (disable taxing off deposit)
* Link deposit to shipping zones' methods or customer language
* Force sells (e.g. 1 beer crate for every x bottles)
* Enabling of tax calulation

Github Repository: https://github.com/nerdissimo-de/woocommerce-pfand
Contact: http://www.nerdissimo.de

== Filters ==

= `get_deposit` =
*(int)* runs when deposit is calculated.

= `wc_deposit_settings` =
*(array)* runs when the settings tab is being configured.

= `add_deposit_value_to_totals` =
*(bool)* runs before deposit fee is added **(to do: rename?)**

= `dep_total_before_add_fee` =
*(int)* runs before deposit fee is added

= `tax_class_before_add_fee` =
*(string)* runs before deposit fee is added

= `display_deposit` =
*(bool)* runs when the plugin determines to add deposit


== Installation ==

1. Upload `woo-pfand/` to the `/wp-content/plugins/` directory
2. Activate the plugin through the `Plugins` menu in WordPress
3. Configure the plugin through `Woocommerce -> Settings -> Tab: Deposit`
3. Go to `Products - Deposit Types` and create deposit prices as you would add tags
4. Add deposit prices to your products


== Changelog ==

= 2.0.0
* First release on WP Repository
