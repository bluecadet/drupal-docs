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

In our theme file (**bluecadet_base.theme**) we created a variable in the node preprocess hook **bluecadet_base_preprocess_node()**, i.e.

``
$variables['foo'] = bar;
``

Finally in our node’s Twig template file (**themes/custom/bluecadet_base/templates/node/node\-\-[content type].html.twig**) we added the output for our variable:

``
{{ foo }}
``

We also covered debugging. Helpful links:

* [VS Code PHP Debug Extension](https://marketplace.visualstudio.com/items?itemName=felixfbecker.php-debug)
* [Atom PHP Debug Extension](https://atom.io/packages/php-debug)
* [Debugging Drupal 8 Twig templates with Xdebug 🐛](https://guusvandewal.nl/drupal-blog/debugging-drupal-8-twig-templates-xdebug-🐛)