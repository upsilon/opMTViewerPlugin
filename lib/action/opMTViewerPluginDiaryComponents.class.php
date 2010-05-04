<?php

abstract class opMTViewerPluginDiaryComponents extends sfComponents
{
  public function executeDiaryList()
  {
    $this->op2Member = Doctrine::getTable('Op2Member')
      ->findOneByMemberId($this->getUser()->getMemberId());

    if (!$this->op2Member)
    {
      return sfView::SUCCESS;
    }

    $this->diaries = $this->op2Member->getDiaries();
  }
}
