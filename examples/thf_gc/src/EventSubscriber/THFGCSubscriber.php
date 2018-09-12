<?php

namespace Drupal\thf_gc\EventSubscriber;

use Drupal\gathercontent\Event\GatherContentEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event Subscriber MyEventSubscriber.
 */
class THFGCSubscriber implements EventSubscriberInterface {

  public function onPreNodeSave($event) {
    ksm("onPreNodeSave", $event);
    \Drupal::logger('thf_gc')->notice("onPreNodeSave Fired");
  }
  public function onPostNodeSave($event) {
    ksm("onPostNodeSave", $event);
    \Drupal::logger('thf_gc')->notice("onPostNodeSave Fired");
  }
  public function onPostImport($event) {
    ksm("onPostImport", $event);
    \Drupal::logger('thf_gc')->notice("onPostImport Fired");
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    // GatherContentEvents

    // PRE_NODE_SAVE
    // POST_NODE_SAVE
    // POST_IMPORT

    $events[GatherContentEvents::PRE_NODE_SAVE][] = ['onPreNodeSave'];
    $events[GatherContentEvents::POST_NODE_SAVE][] = ['onPostNodeSave'];
    $events[GatherContentEvents::POST_IMPORT][] = ['onPostImport'];

    return $events;
  }

}