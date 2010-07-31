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
        $this->diary = $object;
        $this->op2Member = $this->op2Diary->Op2Member;
      }
      elseif ($object instanceof Op2CommunityTopic)
      {
        $this->topic = $object;
        $this->op2Community = $this->op2Topic->Op2Community;
      }
      elseif ($object instanceof Op2CommunityEvent)
      {
        $this->event = $object;
        $this->op2Community = $this->op2Event->Op2Community;
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
