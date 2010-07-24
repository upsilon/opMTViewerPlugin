<?php

abstract class opMTViewerPluginActions extends opMTViewerPluginBaseActions
{
  public function executeIndex(sfWebRequest $request)
  {
    switch ($request['a'])
    {
      case 'page_fh_diary_list':
        $id = $request['target_c_member_id'];
        $op2Member = Doctrine::getTable('Op2Member')->findOneByNumber($id);
        if ($op2Member)
        {
          $this->redirect('@mtviewer_member_diary?id='.$op2Member->id);
        }
        break;
      default:
        break;
    }

    $this->queue = Doctrine::getTable('ImportJob')->findAll();

    $this->form = new opImportForm();
    if ($request->isMethod(sfWebRequest::POST))
    {
      if ($this->form->bindAndSave($request['import_job'], $request->getFiles('import_job')))
      {
        $this->getUser()->setFlash('notice', '日記取り込みの予約が完了しました');
      }
    }
  }
}
