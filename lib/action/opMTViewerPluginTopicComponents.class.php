<?php

abstract class opMTViewerPluginTopicComponents extends sfComponents
{
  public function executeTopicList()
  {
    $publicFlag = $this->community->getConfig('public_flag');
    $isBelong = $this->community->isPrivilegeBelong($this->getUser()->getMemberId());

    $this->op2Community = Doctrine::getTable('Op2Community')
      ->findOneByCommunityId($this->community->id);

    if (!$isBelong && $publicFlag !== 'public' || !$this->op2Community)
    {
      return sfView::SUCCESS;
    }

    $this->topics = $this->op2Community->getTopics();
  }
}
