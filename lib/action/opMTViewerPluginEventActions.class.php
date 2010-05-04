<?php

abstract class opMTViewerPluginEventActions extends opMTViewerPluginBaseActions
{
  public function executeList(sfWebRequest $request)
  {
    $this->pager = Doctrine::getTable('Op2CommunityEvent')
      ->getListPager($this->op2Community->id, $request['page']);
  }

  public function executeShow(sfWebRequest $request)
  {
  }
}
