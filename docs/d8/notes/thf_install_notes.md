# Setting Up THF CMS
## THF

* ran `terminus build:project:create --team="Bluecadet" --org="bluecadet" --email="pinge@bluecadet.com" --admin-email="pinge@bluecadet.com" d8 thf-cms`
* Cloned github `git clone git@github.com:bluecadet/thf-cms.git`
* ran `composer install`
* ran  `lando init --recipe=pantheon`
* add .lando.yml to .gitignore
* add `debug: true` to .land.yml
* added to .land.yml
```
services:
  appserver:
    run_as_root:
      - "apt-get update"
      - "apt-get install libgmp3-dev"
      - "docker-php-ext-install gmp
```

* changed php to 7.1 in pantheon.yml file
* ran `lando start`
* ran `lando pull --code=none --database=dev --files=dev`

GOOD TO GO!

* turned off behat tests in .circleci/config.yml
* Changed Circle config ->advanced settings to ‘Only build pull requests’ to ‘On’

* added settings.local.php
```
<?php

/**
 * Enable local development services.
 */
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.local.yml';

/**
 * Show all error messages, with backtrace information.
 *
 * In case the error level could not be fetched from the database, as for
 * example the database connection failed, we rely only on this value.
 */
$config['system.logging']['error_level'] = 'verbose';

/**
 * Disable CSS and JS aggregation.
 */
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

/**
 * Disable the render cache (this includes the page cache).
 *
 * Note: you should test with the render cache enabled, to ensure the correct
 * cacheability metadata is present. However, in the early stages of
 * development, you may want to disable it.
 *
 * This setting disables the render cache by using the Null cache back-end
 * defined by the development.services.yml file above.
 *
 * Do not use this setting until after the site is installed.
 */
$settings['cache']['bins']['render'] = 'cache.backend.null';

/**
 * Disable caching for migrations.
 *
 * Uncomment the code below to only store migrations in memory and not in the
 * database. This makes it easier to develop custom migrations.
 */
# $settings['cache']['bins']['discovery_migration'] = 'cache.backend.memory';

/**
 * Disable Internal Page Cache.
 *
 * Note: you should test with Internal Page Cache enabled, to ensure the correct
 * cacheability metadata is present. However, in the early stages of
 * development, you may want to disable it.
 *
 * This setting disables the page cache by using the Null cache back-end
 * defined by the development.services.yml file above.
 *
 * Only use this setting once the site has been installed.
 */
$settings['cache']['bins']['page'] = 'cache.backend.null';

/**
 * Disable Dynamic Page Cache.
 *
 * Note: you should test with Dynamic Page Cache enabled, to ensure the correct
 * cacheability metadata is present (and hence the expected behavior). However,
 * in the early stages of development, you may want to disable it.
 */
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';

/**
 * Allow test modules and themes to be installed.
 *
 * Drupal ignores test modules and themes by default for performance reasons.
 * During development it can be useful to install test extensions for debugging
 * purposes.
 */
$settings['extension_discovery_scan_tests'] = TRUE;

/**
 * Enable access to rebuild.php.
 *
 * This setting can be enabled to allow Drupal's php and database cached
 * storage to be cleared via the rebuild.php page. Access to this page can also
 * be gained by generating a query string from rebuild_token_calculator.sh and
 * using these parameters in a request to rebuild.php.
 */
$settings['rebuild_access'] = TRUE;

/**
 * Skip file system permissions hardening.
 *
 * The system module will periodically check the permissions of your site's
 * site directory to ensure that it is not writable by the website user. For
 * sites that are managed with a version control system, this can cause problems
 * when files in that directory such as settings.php are updated, because the
 * user pulling in the changes won't have permissions to modify files in the
 * directory.
 */
$settings['skip_permissions_hardening'] = TRUE;

$settings['trusted_host_patterns'][] = '^.+.localhost.com$';
$settings['trusted_host_patterns'][] = '^localhost.com$';
$settings['trusted_host_patterns'][] = '^.+.lndo.site$';

/**
 * Error Logging
 */
$config['system.logging']['error_level'] = 'verbose';

/**
 * Disable CSS and JS aggregation.
 */
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

/**
 * Disable page caching
 */
$config['system.performance']['cache']['page']['max_age'] = 0;
```

* added development.services.local.yml
```
# Local development services.
#
# To activate this feature, follow the instructions at the top of the
# 'example.settings.local.php' file, which sits next to this file.
parameters:
  http.response.debug_cacheability_headers: true
  twig.config:
    debug: true
    auto_reload: true
    cache: false
services:
  cache.backend.null:
    class: Drupal\Core\Cache\NullBackendFactory
```
* added development.services.local.yml to git ignore


## Auto config-import & New Relic notifications
* Make sure New Relic is enabled
* Added 2 files to `./private` folder for auto import and new relic notification
	* drush_config_import.php
	* new_relic_deploy.php
* Update pantheon.yml
```

  sync_code:              #push code to DEV/MULTI-DEV
    after:
      -
        type: webphp
        description: Import configuration from .yml files
        script: private/drush_config_import.php
      -
        type: webphp
        description: Log to New Relic
        script: private/new_relic_deploy.php

  deploy:                 #push code to TEST/LIVE
    after:
      -
        type: webphp
        description: Import configuration from .yml files
        script: private/drush_config_import.php
      -
        type: webphp
        description: Log to New Relic
        script: private/new_relic_deploy.php
```



## Starter modules
### All Sites
admin_toolbar
config_devel
config_split
ctools
devel
diff
focal_point
hsts
inline_entity_form
new_relic_rpm
pantheon_advanced_page_cache
paragraphs
redis

```
lando composer require drupal/admin_toolbar drupal/config_devel drupal/config_split drupal/ctools drupal/devel drupal/diff drupal/focal_point drupal/hsts  drupal/inline_entity_form drupal/new_relic_rpm drupal/pantheon_advanced_page_cache drupal/paragraphs drupal/redis

cd web

lando drush en admin_toolbar admin_toolbar_tools config_devel config_split ctools devel kint diff focal_point hsts inline_entity_form new_relic_rpm pantheon_advanced_page_cache paragraphs

```

NOTE: turn on Redis LATER!!

### Web only
metatag
pathauto
redirect
simple_sitemap
token
viewsreference

```
lando composer require drupal/metatag drupal/pathauto drupal/redirect drupal/token drupal/viewsreference

cd web

lando drush en metatag pathauto redirect token viewsreference

```

### Some other useful ones
ultimate_cron
views_bulk_operations
config_split
devel_generate (submodule of devel)


### Turn on a few we normally use
block_content
media

```
lando drush en block_content media
```

### Turn off a few modules we don’t normally use
big_pipe
color
comment
help
history
quickedit
rdf
responsive_image
tour

```
lando drush pmu big_pipe color comment help history quickedit rdf responsive_image tour

```
Note: delete comment field on Article before trying to run above command


Export Config!!!

ALL GOOD after CI!!!!






- Need to Setup theme
- Need to add Lighthouse tests
- Need to add Visual Regression Tests


