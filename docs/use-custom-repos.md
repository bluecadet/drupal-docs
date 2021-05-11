# How to Use Custom Managed Modules

In order to use our custom modules there are a few things we need to do to get composer to install the module in the correct location. Since Drupal modules need to be in the correct folder to be discovered, they cannot be in the default 'vendor' directory composer typically installs packages to.

Our setup currently defines a package type of 'custom-drupal-module'. This is not a default type, so we need to define it. In your projects composer.json you need to add the line, `"installer-types": ["custom-drupal-module"],` under extras. Then, add a location where packages of that type need to be installed. `"web/modules/bluecadet/{$name}": ["type:custom-drupal-module"],` This location needs to be somewhere under the modules directory, but should probably not be 'custom'. Most developers would assume modules under custom could be edited within the project, whereas these modules are still being maintained outside of the project. You could still use 'contrib', but since these modules are not valid contrib modules from drupal.org, its recommended not to have them in that dir either. So it will look similar to:

```json
...
  "extra": {
    "installer-types": ["custom-drupal-module"],
    "installer-paths": {
      "web/core": ["type:drupal-core"],
      "web/modules/contrib/{$name}": ["type:drupal-module"],
      "web/modules/bluecadet/{$name}": ["type:custom-drupal-module"],
      "web/profiles/contrib/{$name}": ["type:drupal-profile"],
      "web/themes/contrib/{$name}": ["type:drupal-theme"],
      "drush/contrib/{$name}": ["type:drupal-drush"]
    },
...
```

Now you can require Bluecadet packages/modules.

`composer require bluecadet/bluecadet_utilities`

