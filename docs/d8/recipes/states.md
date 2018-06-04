# States

> A "state" means a certain property on a DOM element, such as "visible" or "checked". A state can be applied to an element, depending on the state of another element on the page. In general, states depend on HTML attributes and DOM element properties, which change due to user interaction.

> Since states are driven by JavaScript only, it is important to understand that all states are applied on presentation only, none of the states force any server-side logic, and that they will not be applied for site visitors without JavaScript support. All modules implementing states have to make sure that the intended logic also works without JavaScript being enabled.

## Simple Form exmaple

```php
/**
 * Implements hook_form_alter().
 */
function HOOK_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  switch ($form_id) {
    case 'node_[CONTENT TYPE]_edit_form':
    case 'node_[CONTENT TYPE]_form':
      // Visible for any option.
      $form['[FIELD NAME]']['#states'] = [
        'invisible' => [
          ':input[name="[REFERENCE FIELD]"]' => ['value' => '_none'],
        ],
      ];
    break;
  }
}

```
replace [CONTENT TYPE], [FIELD NAME], and [REFERENCE FIELD].

## Within a Paragraph bundle

```php
/**
 * Implements hook_field_widget_WIDGET_TYPE_form_alter().
 */
function HOOK_field_widget_entity_reference_paragraphs_form_alter(&$element, FormStateInterface $form_state, $context) {
  $field_definition = $context['items']->getFieldDefinition();
  $paragraph_entity_reference_field_name = $field_definition->getName();

  if ($paragraph_entity_reference_field_name == '[PARAGRAPH SOURCE FIELD]' ) {
    $widget_state = \Drupal\Core\Field\WidgetBase::getWidgetState($element['#field_parents'], $paragraph_entity_reference_field_name, $form_state);

    $paragraph_instance = $widget_state['paragraphs'][$element['#delta']]['entity'];
    $paragraph_type = $paragraph_instance->bundle();

    if ($paragraph_type == '[PARAGRAPH BUNDLE]' && !isset($element['preview'])) {

      $dependee_field_name = '[DEPENDEE FIELD NAME]';
      $selector = sprintf('select[name="%s[%d][subform][%s]"]', $paragraph_entity_reference_field_name, $element['#delta'], $dependee_field_name);

      // Dependent fields.
      $element['subform']['[FIELD NAME]']['#states'] = [
        'invisible' => [
          $selector => ['value' => 2],
       ],
      ];

    }
  }
}

```
replace [PARAGRAPH SOURCE FIELD], [PARAGRAPH BUNDLE], [DEPENDEE FIELD NAME], and [FIELD NAME].

<hr>

### Useful Links

* [Drupal States](https://api.drupal.org/api/drupal/core%21includes%21common.inc/function/drupal_process_states/8.2.x)
* [Conditional Fields module](https://www.drupal.org/project/conditional_fields)
* [Lullabot](https://www.lullabot.com/articles/form-api-states)
* [Paragraphs Example](https://gist.github.com/dinarcon/ea67da074fca0c19c25b85e244262219)