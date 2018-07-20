# Drupal 8 + Importing GatherContent to Paragraphs

New feature claims to support importing GatherContent fields into D8 Paragraphs. There's a bug in the most recent beta, so ideally we'd wait for a new release. But this does seem to work

* install paragraphs, gather content
* Authenticate gather content module in drupal with api key in gather content
* Create some content in gather content using a template
* Create content type in drupal for that content, using  a paragraphs field
    * make sure to specify the paragraph types you want to map to

* Configuration > GC > content mapping
    * error with mappings, found an issue they fixed, trying dev release of gather content and updated
    * I think there’s a mapping bug that needs to get pushed in a release
        * https://www.drupal.org/project/gathercontent/issues/2983849
        * Error is fixed on dev branch, but I guess stay tuned for new release:
        * require the dev branch: lando composer require 'drupal/gathercontent:4.x-dev'
* Configuration > Gather Content > Import content
* Paragraphs seem to import in order they are in gather content
