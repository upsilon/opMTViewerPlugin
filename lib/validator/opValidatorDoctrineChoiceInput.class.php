<?php

class opValidatorDoctrineChoiceInput extends sfValidatorDoctrineChoice
{
  protected function doClean($value)
  {
    if ('other' !== $value['select'])
    {
      return array('select' => parent::clean($value['select']));
    }

    if (!isset($value['input']))
    {
      throw new sfValidatorError($this, 'invalid', array('value' => $value));
    }

    return array('select' => 'other', 'other' => $value['input']);
  }
}
