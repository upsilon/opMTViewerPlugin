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
      'mtviewer_diary_edit' => new sfDoctrineRoute(
        '/mtviewer/diary/edit/:id',
        array('module' => 'mtviewer_diary', 'action' => 'edit'),
        array('id' => '\d+', 'sf_method' => array('get')),
        array('model' => 'Op2Diary', 'type' => 'object')
      ),
      'mtviewer_diary_update' => new sfDoctrineRoute(
        '/mtviewer/diary/edit/:id',
        array('module' => 'mtviewer_diary', 'action' => 'update'),
        array('id' => '\d+', 'sf_method' => array('post')),
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
      'mtviewer_topic_edit' => new sfDoctrineRoute(
        '/mtviewer/topic/edit/:id',
        array('module' => 'mtviewer_topic', 'action' => 'edit'),
        array('id' => '\d+', 'sf_method' => array('get')),
        array('model' => 'Op2CommunityTopic', 'type' => 'object')
      ),
      'mtviewer_topic_update' => new sfDoctrineRoute(
        '/mtviewer/topic/edit/:id',
        array('module' => 'mtviewer_topic', 'action' => 'update'),
        array('id' => '\d+', 'sf_method' => array('post')),
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
      'mtviewer_event_edit' => new sfDoctrineRoute(
        '/mtviewer/event/edit/:id',
        array('module' => 'mtviewer_event', 'action' => 'edit'),
        array('id' => '\d+', 'sf_method' => array('get')),
        array('model' => 'Op2CommunityEvent', 'type' => 'object')
      ),
      'mtviewer_event_update' => new sfDoctrineRoute(
        '/mtviewer/event/edit/:id',
        array('module' => 'mtviewer_event', 'action' => 'update'),
        array('id' => '\d+', 'sf_method' => array('post')),
        array('model' => 'Op2CommunityEvent', 'type' => 'object')
      ),

      'mtviewer_import_diary' => new sfRequestRoute(
        '/mtviewer/import/diary',
        array('module' => 'mtviewer_diary', 'action' => 'import'),
        array('sf_method' => array('get', 'post'))
      ),
      'mtviewer_import_topic' => new sfDoctrineRoute(
        '/mtviewer/import/topic/:id',
        array('module' => 'mtviewer_topic', 'action' => 'import'),
        array('id' => '\d+', 'sf_method' => array('get', 'post')),
        array('model' => 'Community', 'type' => 'object')
      ),
    );
  } 
}
