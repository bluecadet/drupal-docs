# HOW TO: D8 Installation

## On Pantheon

### Traditional (?)

### Composer Workflow/Continuous integration.

This method allows for a full composer workflow, and the ability to add continuos integration tools to your project workflow.

Details pulled from: https://pantheon.io/docs/guides/build-tools/

https://github.com/pantheon-systems/terminus-build-tools-plugin

Follow directions at pantheon's link above.

#### Things to note:

* Create a Github personal access token
* Create CircleCI personal API token
* Run terminus command:
  <br>`terminus build:project:create --team="Bluecadet" --org="bluecadet" --email="pinge@bluecadet.com" --admin-email="pinge@bluecadet.com" d8 philly-pwa`
  make sure to include team and org, otherwise projects will be saved to your personal accounts.
* Once the environemnts are created, goto circleci.com, under the project settings, goto Advanced Settings -> Only build pull requests and check ON. This will reduce uneeded builds and save time during development.
* When creating a local environment, if you are using apache, there will not b an `.htaccess` file. You'll need to grab it from another repo.


<!-- 1. The site is now ready to be worked on
1. Add team members to Pantheon account
1. Add team members to github repo
1. [Optionally: Setup TEST and LIVE environments on pantheon. Sometimes we wait to do this until a later stage]
1. Setup backups for the site. If this is a sandbox (unpaid) site, you will need to do this through a terminus command [LINK] -->

---

## Setting Up local environment

### Traditional

1. Clone repo `git clone git@github.com:bluecadet/mann-web.git [DIR]`
obviously change out dir and path...
1. Run `composer install`
1. Setup DB
  1. Create DB export in Pantheon
  1. Create local DB
  1. Import DB from Pantheon
  1. Setup any local permissions for MySQL if you have any
1. Find Hash Salt from Pantheon
  Run `terminus drush <site>.<env> -- ev 'return getenv("DRUPAL_HASH_SALT")'`
1. Copy `/web/sites/example.settings.local.php` to `/web/sites/default/settings.local.php`
1. Add DB info around line 17
  ```
  $databases['default']['default'] = array (
    'database' => '[DB-name]',
    'username' => '[DB-username]',
    'password' => '[DB-userpassword]',
    'prefix' => '',
    'host' => 'localhost',
    'port' => '3306',
    'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
    'driver' => 'mysql',
  );
  ```
1. Add hash_salt from above to end of file. Should look something like:
  ```
  $settings['hash_salt'] = 'X/ZoCz4bINpIQq1xufoInrULRDtN0UABMUW7m09HcCY=';
  ```
1. Setup local settings for domain name or however you have it setup
1. Add trusted local host patterns for your local development
```
$settings['trusted_host_patterns'][] = '^.+.localhost.com$';
$settings['trusted_host_patterns'][] = '^localhost.com$';
```
1. Try it out!

### With Lando
If you do not already have lando installed, visit [https://docs.devwithlando.io/installation/installing.html](https://docs.devwithlando.io/installation/installing.html)

1. Clone repo `git clone git@github.com:bluecadet/[INSERT-REPO-NAME].git [DIR]`
1. In terminal, `cd` into the project directory and run `lando init`
1. Select `Pantheon` as the recipie, and select your Pantheon account. Select the site from the list.
  1. You may need to add a machine token if you are not logged in. Add the token with `lando terminus auth:login --machine-token=[YOUR_MACHINE_TOKEN]`.
      1. Info to create tokens can be found [here](https://pantheon.io/docs/machine-tokens/)
1. Run `lando start`
1. Run `lando pull`.
  1. You can pull code from the `dev` enviornment to make sure you are up to date (or none).
  1. Pull the database from `dev`
  1. Optionally pull files from `dev` (or select none)

#### Get a local url
Run `lando info`. In the resulting json, your local urls can be found at:

```
{
  ...
  "edge":
    ...
    "urls":
      "http://localhost:32801",
      "http://yoursitename.lndo.site",
      "https://yoursitename.lndo.site"
}
```
Visit one of these urls and make sure everything is working as expected.


#### Notes:
When using Lando, all `terminus` commands should be prepended with `lando`, i.e:

```
lando terminus drush cim
```

<<<<<<< HEAD
## Pantheon, CircleCI, and Lando

### Prerequisites

* [composer](https://getcomposer.org)
* [lando](https://docs.devwithlando.io)
* [terminus](https://github.com/pantheon-systems/terminus) with [machine token](https://pantheon.io/docs/machine-tokens/)

### Recipe

* Pull repo from github `git clone [repo]`
* In your terminal, go to your repo directory and run `composer install`
* In your terminal, run `lando init --recipe=pantheon` to bind to a Pantheon instance
* Open up the repo in your text editor. Modify **.lando.yml** to enable debugging: Add line with `xdebug: true`
* In your text editor, check that **pantheon.yml** has a nested webroot specified: `web_docroot: true`
* In your text editor, check that **pantheon.yml** has PHP version set to 7.0 (default 7.2 produces errors as of lando * version v3.0.0-beta.47): `php_version: 7.0`
* In your terminal, run `lando start`
* In your terminal, do a pull for the database and files: `lando pull --code=none --database=dev * --files=dev`
=======



## Starter modules
### All Sites
* admin_toolbar
* config_devel
* config_split
* ctools
* devel
* diff
* focal_point
* hsts
* inline_entity_form
* new_relic_rpm
* pantheon_advanced_page_cache
* paragraphs
* redis

```
lando composer require drupal/admin_toolbar drupal/config_devel drupal/config_split drupal/ctools drupal/devel drupal/diff drupal/focal_point drupal/hsts  drupal/inline_entity_form drupal/new_relic_rpm drupal/pantheon_advanced_page_cache drupal/paragraphs drupal/redis

cd web

lando drush en admin_toolbar admin_toolbar_tools config_devel config_split ctools devel kint diff focal_point hsts inline_entity_form new_relic_rpm pantheon_advanced_page_cache paragraphs

```

NOTE: turn on Redis LATER!!

### Web only
* metatag
* pathauto
* redirect
* simple_sitemap
* token
* viewsreference

```
lando composer require drupal/metatag drupal/pathauto drupal/redirect drupal/token drupal/viewsreference

cd web

lando drush en metatag pathauto redirect token viewsreference

```

### Some other useful ones
* ultimate_cron
* views_bulk_operations
* config_split
* devel_generate (submodule of devel)


### Turn on a few we normally use
* block_content
* media

```
lando drush en block_content media
```

### Turn off a few modules we don’t normally use
* big_pipe
* color
* comment
* help
* history
* quickedit
* rdf
* responsive_image
* tour

```
lando drush pmu big_pipe color comment help history quickedit rdf responsive_image tour

```
Note: delete comment field on Article before trying to run above command
>>>>>>> Add in modules suggestions
