<?php

class opMTViewerPluginFrontendRouteCollection extends sfRouteCollection
{
  public function __construct(array $options)
  {
    parent::__construct($options);

    $this->routes = array(
      'mtviewer_top' => new sfRequestRoute(
        '/mtviewer',
        array('module' => 'mtviewer', 'action' => 'index')
      ),
      'mtviewer_member_list' => new sfDoctrineRoute(
        '/mtviewer/member',
        array('module' => 'mtviewer_member', 'action' => 'list'),
        array('sf_method' => array('get')),
        array('model' => 'Op2Member', 'type' => 'list')
      ),
      'mtviewer_member_diary' => new sfDoctrineRoute(
        '/mtviewer/member/:id/diary',
        array('module' => 'mtviewer_diary', 'action' => 'list'),
        array('id' => '\d+', 'sf_method' => array('get')),
        array('model' => 'Op2Member', 'type' => 'object')
      ),
      'mtviewer_diary' => new sfDoctrineRoute(
        '/mtviewer/diary/show/:id',
        array('module' => 'mtviewer_diary', 'action' => 'show'),
        array('id' => '\d+', 'sf_method' => array('get')),
        array('model' => 'Op2Diary', 'type' => 'object')
      ),
      'mtviewer_community_list' => new sfDoctrineRoute(
        '/mtviewer/community',
        array('module' => 'mtviewer_community', 'action' => 'list'),
        array('sf_method' => array('get')),
        array('model' => 'Op2Community', 'type' => 'list')
      ),
      'mtviewer_community_topic' => new sfDoctrineRoute(
        '/mtviewer/community/:id/topic',
        array('module' => 'mtviewer_topic', 'action' => 'list'),
        array('id' => '\d+', 'sf_method' => array('get')),
        array('model' => 'Op2Community', 'type' => 'object')
      ),
      'mtviewer_topic' => new sfDoctrineRoute(
        '/mtviewer/topic/show/:id',
        array('module' => 'mtviewer_topic', 'action' => 'show'),
        array('id' => '\d+', 'sf_method' => array('get')),
        array('model' => 'Op2CommunityTopic', 'type' => 'object')
      ),
      'mtviewer_community_event' => new sfDoctrineRoute(
        '/mtviewer/community/:id/event',
        array('module' => 'mtviewer_event', 'action' => 'list'),
        array('id' => '\d+', 'sf_method' => array('get')),
        array('model' => 'Op2Community', 'type' => 'object')
      ),
      'mtviewer_event' => new sfDoctrineRoute(
        '/mtviewer/event/show/:id',
        array('module' => 'mtviewer_event', 'action' => 'show'),
        array('id' => '\d+', 'sf_method' => array('get')),
        array('model' => 'Op2CommunityEvent', 'type' => 'object')
      ),
    );
  } 
}
