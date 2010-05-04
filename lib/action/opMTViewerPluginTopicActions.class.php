<?php

abstract class opMTViewerPluginTopicActions extends opMTViewerPluginBaseActions
{
  public function executeList(sfWebRequest $request)
  {
    $this->pager = Doctrine::getTable('Op2CommunityTopic')
      ->getListPager($this->op2Community->id, $request['page']);
  }

  public function executeShow(sfWebRequest $request)
  {
  }
}
