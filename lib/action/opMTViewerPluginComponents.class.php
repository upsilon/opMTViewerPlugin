<?php

abstract class opMTViewerPluginComponents extends sfComponents
{
  public function executeEntryShowComment(sfWebRequest $request)
  {
    $this->pager = Doctrine::getTable('Op2Comment')
      ->getPager($this->entry->getRawValue(), $request['page']);
  }
}
