# Quicksilver

[Official Documentation](https://pantheon.io/docs/quicksilver/)

Basically we can hook into Pantheon's Workflow to automatically trigger scripts and processes to run. This way we can automate certain tasks. Best example for Drupal 8 is to autamate configuration import when pushing to TEST or LIVE.

[Quicksilver cript examples](https://github.com/pantheon-systems/quicksilver-examples/)

Below is what we typically add to our pantheon.yml files for automatic config import and notification to New Relic. Both are fvery helpful. You may need to just copy paste certain parts to add to your current pantheon.yml file.

```
workflows:

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

These files can be found [here:](https://github.com/bluecadet/drupal-docs/tree/master/examples/quicksilver_scripts)