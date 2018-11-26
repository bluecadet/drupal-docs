# Media (< D8.3)

https://www.webwash.net/manage-media-assets-drupal-8/

# Media (> D8.3 = Media in Core)

## Install core Media module.

Note: Media module will install types:
- Audio
- File
- Image
- Video

1. Make sure CTools is installed
1. Enale Core Media module
1. Download and enable 'Entity Browser' and make sure it is on 2.x branch
  - `drush dl entity_browser-2.x`
1. Download and enable 'Media Entity Browser' and make sure it is on 2.x branch
  - `drush dl media_entity_browser-2.x`
	- enable `Media Entity IEF` module

## Setup Media Entity Forms

We want to create form modes specifically for Media entities when creating inside a piece of content. Here we will get that ready.

1. Add new Form Mode for Media
	1. Got to Structure >> Display Modes  >> Form Modes >> Add
	1. Click Media
	1. Add "Inline Form"
1. Create New Form
	1. Goto Structure >> Media Types >> Video >> Manage Form Display
	1. Open Custom Display Settings
	1. Add "Inline Form"
	1. Go to Inline Form tab
	1. Remove un-needed fields

## Specific Per Media Type (video for example)
1. Create Entity Browser (video)
1. Create Media View for video
	1. Edit /Media Browser/ View
	1. Duplicate Display
	1. Change Filter criteria
		1. Media: Media Type should not be exposed
		1. And Video selected (This display only)
1. Add Widget (view)  with newly created view display
	1. Under the "Configuration" tab click on "Content Authoring".
	1. Click "Entity Browsers"
	1. Add Entity Browser
	1. In "General Information", edit the necessary settings and click "Next".
	1. Edit "Display" settings.
	1. You may skip the next two steps, "Widget Selector" and "Section Display" as you will not have configuration options.
	1. In the "Widgets" section, select the necessary widgets to add and edit the widget settings as needed.
	1. When you're done, click "Finish"!

## Setup Media Field on Node
1. Go to Manage Fields on Node CT
1. Add field
1. Reference -> Media
1. Add title and machine name
1. Set settings
1. Goto Manage Form Display
1. Widget set to Inline Entity Form - Complex
1. For those settings
	1. Form Mode: Inline Form
	1. Allow users to add new
	1. Allow users to add existing
	1. Autocomplete: Contains
	1. Entity Browser: Video Media Browser
	1. SAVE