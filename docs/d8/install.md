# HOW TO: D8 Installation

## On Pantheon

### Traditional (?)

### Composer Workflow/Continuous integration.

This method allows for a full composer workflow, and the ability to add continuos integration tools to your project workflow.

Details pulled from: https://pantheon.io/docs/guides/build-tools/

1. Create a Github personal access token
1. Create CircleCI personal API token
1. Run terminus command:
  <br>`terminus build-env:create-project --team="Bluecadet" --org="bluecadet" [PROJECT NAME]`
  make sure to include team and org, otherwise projects will be saved to your personal accounts
1. The site is now ready to be worked on
1. Add team members to Pantheon account
1. Add team members to github repo
1. [Optionally: Setup TEST and LIVE environments on pantheon. Sometimes we wait to do this until a later stage]
1. Setup backups for the site. If this is a sandbox (unpaid) site, you will need to do this through a terminus command [LINK]

<hr>

1. Setting Up local environment
    1. clone repo `git clone git@github.com:bluecadet/mann-web.git [DIR]`
    obviously change out dir and path...
    1. run `composer install`
    1. Setup DB
        1. Create DB export in Pantheon
        1. Create local DB
        1. Import DB from Pantheon
        1. Setup any local permissions for MySQL if you have any
    1. Find Hash Salt from Pantheon
        Run `terminus drush <site>.<env> -- ev 'return getenv("DRUPAL_HASH_SALT")'`
    1. copy `/web/sites/example.settings.local.php` to `/web/sites/default/settings.local.php`
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