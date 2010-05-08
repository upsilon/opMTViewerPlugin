<?php

abstract class opMTViewerPluginDiaryActions extends opMTViewerPluginBaseActions
{
  public function postExecute()
  {
    $memberId = $this->op2Member->member_id;
    if ($memberId && $memberId !== $this->getUser()->getMemberId())
    {
      sfConfig::set('sf_nav_type', 'friend');
      sfConfig::set('sf_nav_id', $memberId);
    }
  }

  public function executeList(sfWebRequest $request)
  {
    $this->pager = Doctrine::getTable('Op2Diary')
      ->getListPager($this->op2Member->id, $request['page']);
  }

  public function executeShow(sfWebRequest $request)
  {
  }
}
