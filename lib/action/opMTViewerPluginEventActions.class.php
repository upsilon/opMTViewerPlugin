<?php

abstract class opMTViewerPluginEventActions extends opMTViewerPluginBaseActions
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
    $this->pager = Doctrine::getTable('Op2CommunityEvent')
      ->getListPager($this->op2Community->id, $request['page']);
  }

  public function executeShow(sfWebRequest $request)
  {
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new Op2CommunityEventForm($this->op2Event);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new Op2CommunityEventForm($this->op2Event);
    if ($this->form->bindAndSave($request['op2_commuity_event']))
    {
      $this->getUser()->setFlash('notice', '編集しました');
      $this->redirect('@mtviewer_event?id='.$this->event->id);
    }
    $this->setTemplate('edit');
  }
}
