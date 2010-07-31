<?php

abstract class opMTViewerPluginTopicActions extends opMTViewerPluginBaseActions
{
  public function postExecute()
  {
    $communityId = $this->op2Community->community_id;
    if ($communityId)
    {
      sfConfig::set('sf_nav_type', 'community');
      sfConfig::set('sf_nav_id', $communityId);
    }
  }

  public function executeList(sfWebRequest $request)
  {
    $this->pager = Doctrine::getTable('Op2CommunityTopic')
      ->getListPager($this->op2Community->id, $request['page']);
  }

  public function executeShow(sfWebRequest $request)
  {
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new Op2CommunityTopicForm($this->topic);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new Op2CommunityTopicForm($this->topic);
    if ($this->form->bindAndSave($request['op2_commuity_topic']))
    {
      $this->getUser()->setFlash('notice', '編集しました');
      $this->redirect('@mtviewer_topic?id='.$this->topic->id);
    }
    $this->setTemplate('edit');
  }
}
