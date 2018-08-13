# Drupal 8 Training (Summer 2018)


## Session 1

* We started by using a Git repo set up by Pete Inge: [d8train](https://github.com/bluecadet/d8train)
* We documented the [Pantheon/CircleCI/Lando setup](https://bluecadet.github.io/drupal-docs/d8/install.html#pantheon-circleci-and-lando)
* We created a branch for each person (i.e., `git checkout -b mark`)
* We created a basic content type
* We exported the content type using drush (`lando drush cex`)
* We committed the config changes and pushed the config to origin
* We created a pull request from our branches to generate a Pantheon multidev environment

## Session 2

We covered basic theming concepts:

* What is a theme, how to activate one
* Creating a twig template
* Rendering our content types

## Session 3

We covered preprocessors. Helpful links:

* [https://www.drupal.org/docs/8/theming/twig/twig-best-practices-preprocess-functions-and-templates](https://www.drupal.org/docs/8/theming/twig/twig-best-practices-preprocess-functions-and-templates)
* [https://drupalize.me/tutorial/what-are-preprocess-functions?p=2512](https://drupalize.me/tutorial/what-are-preprocess-functions?p=2512)

In our theme file (**bluecadet\_base.theme**) we created a variable in the node preprocess hook **bluecadet\_base\_preprocess\_node()**, i.e.

	$variables\['foo'] = bar;

Finally in our node’s Twig template file (**themes/custom/bluecadet\_base/templates/node/node\-\-[content type].html.twig**) we added the output for our variable:

	{{ foo }}

We also covered debugging. Helpful links:

* [VS Code PHP Debug Extension](https://marketplace.visualstudio.com/items?itemName=felixfbecker.php-debug)
* [Atom PHP Debug Extension](https://atom.io/packages/php-debug)
* [Debugging Drupal 8 Twig templates with Xdebug 🐛](https://guusvandewal.nl/drupal-blog/debugging-drupal-8-twig-templates-xdebug-%F0%9F%90%9B)

## Session 4

### Menus

We covered:

* Menu configuration (data side)
* Menu block and regions (layout side)
* Menu twig templates

Helpful links:

* Menus: [https://drupalize.me/topic/menus](https://drupalize.me/topic/menus)
* Regions: [https://drupalize.me/tutorial/regions?p=2512](https://drupalize.me/tutorial/regions?p=2512)

Core Twig templates can be found in `/core/modules/system/templates`

An example header template can be used to wrap block output, for ex:

	<header role="banner">
	    {%  if page.header.bluecadet_base_main_menu %}
	      <div class="col-center">
	        {{ page.header.bluecadet_base_main_menu }}
	      </div>
	    {% endif %}
	    {%  if page.header.bluecadet_base_search %}
	      <div class="col-right">
	        {{ page.header.bluecadet_base_search }}
	      </div>
	    {% endif %}
	</header>


## Session 5

### JavaScript

Helpful links:

* [https://www.drupal.org/docs/8/api/javascript-api/add-javascript-to-your-theme-or-module](https://www.drupal.org/docs/8/api/javascript-api/add-javascript-to-your-theme-or-module)
* [https://www.drupal.org/docs/8/theming-drupal-8/adding-stylesheets-css-and-javascript-js-to-a-drupal-8-theme](https://www.drupal.org/docs/8/theming-drupal-8/adding-stylesheets-css-and-javascript-js-to-a-drupal-8-theme)