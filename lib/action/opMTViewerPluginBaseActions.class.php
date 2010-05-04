<?php

abstract class opMTViewerPluginBaseActions extends sfActions
{
  public function preExecute()
  {
    if (is_callable(array($this->getRoute(), 'getObject')))
    {
      $object = $this->getRoute()->getObject();
      if ($object instanceof Op2Diary)
      {
        $this->op2Diary = $object;
      }
      elseif ($object instanceof Op2CommunityTopic)
      {
        $this->op2Topic = $object;
      }
      elseif ($object instanceof Op2CommunityEvent)
      {
        $this->op2Event = $object;
      }
      elseif ($object instanceof Op2Member)
      {
        $this->op2Member = $object;
      }
      elseif ($object instanceof Op2Community)
      {
        $this->op2Community = $object;
      }
    }
  }
}
