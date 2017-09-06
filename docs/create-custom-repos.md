# How to Create Custom Managed Modules (and use composer to add them to your project)

There are some modules we continually re-use and want to manage and maintain for all projects we continue to use. This is how to do it.

- Create Github repo. It would probably be good to name it the same as the module name.
- Add files for a typical drupal module.
- Add composer.json file. Note the 'type' settings. It should be set to 'custom-drupal-module'. This will allow the module to be installed in the proper directory. Should look similar to this:
```
{
  "name": "bluecadet/[MODULE]",
  "description": "DESCRIPTION",
  "type": "custom-drupal-module",
  "authors": [
    {
      "name": "ADD YOUR NAME",
      "role": "Maintainer"
    }
  ],
  "license": "GPL-2.0+",
  "minimum-stability": "dev",
  "require": {
    "php": "^5.3.3 || ^7.0",
    "composer/installers": "^1.0@dev"
  }
}
```
- Set your initial version tag. It is important to keep your composer version and your module versions similar.<br>`git tag v1.0.0`
- Add to packagist.org. If you don't have an account you will need to create one.
  - Make sure to setup auto update. In Github you'll need to setup a Packagist service. Current directions should be found on [Packagist](https://packagist.org/about#how-to-update-packages).
- Test it.
- DONE!!


*NOTE: Above we are requiring 'composer/installers' package. This enables us to use the custom package type to install in a location of our choosing.