<?php

abstract class opMTViewerPluginDiaryActions extends opMTViewerPluginBaseActions
{
  public function postExecute()
  {
    if ($this->op2Member)
    {
      $memberId = $this->op2Member->member_id;
      if ($memberId && $memberId !== $this->getUser()->getMemberId())
      {
        sfConfig::set('sf_nav_type', 'friend');
        sfConfig::set('sf_nav_id', $memberId);
      }
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

  public function executeImport(sfWebRequest $request)
  {
    $this->form = new ImportJobForm();
    if ($request->isMethod(sfWebRequest::POST))
    {
      if ($this->form->bindAndSave($request['import_job'], $request->getFiles('import_job')))
      {
        $this->getUser()->setFlash('notice', '日記取り込みの予約が完了しました');
      }
    }

    $this->queue = Doctrine::getTable('ImportJob')->getList();
  }
}
