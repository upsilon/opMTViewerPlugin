<?php

class opCommunitySelectForm extends Op2CommunityForm
{
  public function setup()
  {
    $this->setWidgets(array(
      'id' => new opWidgetFormDoctrineChoiceInput(array(
        'model' => 'Op2Community',
        'add_empty' => true,
      )),
    ));
    $this->setValidators(array(
      'id' => new opValidatorDoctrineChoiceInput(array(
        'model' => 'Op2Community',
        'required' => false,
      )),
    ));
  }

  public function doUpdateObject($values)
  {
    if ('other' === $values['id']['select'])
    {
      $this->object->name = $values['id']['other'];
    }
    else
    {
      $this->object = Doctrine::getTable('Op2Community')->findOneById($values['id']['select']);
    }
  }
}
