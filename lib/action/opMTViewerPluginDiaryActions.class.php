<?php

abstract class opMTViewerPluginDiaryActions extends opMTViewerPluginBaseActions
{
  public function executeList(sfWebRequest $request)
  {
    $this->pager = Doctrine::getTable('Op2Diary')
      ->getListPager($this->op2Member->id, $request['page']);
  }

  public function executeShow(sfWebRequest $request)
  {
  }
}
