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

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new Op2DiaryForm($this->op2Diary);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new Op2DiaryForm($this->op2Diary);
    if ($this->form->bindAndSave($request['op2_diary']))
    {
      $this->getUser()->setFlash('notice', '編集しました');
      $this->redirect('@mtviewer_diary?id='.$this->diary->id);
    }
    $this->setTemplate('edit');
  }

  public function executeImport(sfWebRequest $request)
  {
    $this->form = new ImportDiaryJobForm();
    if ($request->isMethod(sfWebRequest::POST))
    {
      if ($this->form->bindAndSave($request['import_diary_job'], $request->getFiles('import_diary_job')))
      {
        $this->getUser()->setFlash('notice', '日記取り込みの予約が完了しました');
      }
    }

    $this->queue = Doctrine::getTable('ImportDiaryJob')->findAll();
  }
}
