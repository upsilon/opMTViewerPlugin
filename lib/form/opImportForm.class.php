<?php

class opImportForm extends ImportJobForm
{
  public function configure()
  {
    parent::configure();

    $choices = array(
      'diary' => '日記',
      'topic' => 'トピック・イベント',
    );

    $this->setWidget('type', new sfWidgetFormChoice(array(
      'choices' => $choices,
      'expanded' => true,
    )));

    $this->setValidator('type', new sfValidatorChoice(array(
      'choices' => array_keys($choices),
    )));

    $this->validatorSchema->setPostValidator(
      new opValidatorImportType(array(), array(
        'invalid' => 'コミュニティが選択されていません'
      ))
    );

    $form = new opCommunitySelectForm();
    $this->embedForm('op2_community', $form);
  }

  public function doSave($conn = null)
  {
    if ('diary' === $this->values['type'])
    {
      $this->object = new ImportDiaryJob();
    }
    elseif ('topic' === $this->values['type'])
    {
      $this->object = new ImportTopicJob();
    }

    parent::doSave($conn);
  }

  public function doUpdateObject($values)
  {
    if ($this->values['type'])
    {
      $form = $this->getEmbeddedForm('op2_community');
      $form->updateObject($values['op2_community']);
      $this->object->Op2Community = $form->getObject();
    }
  }
}

class opValidatorImportType extends sfValidatorBase
{
  protected function doClean($value)
  {
    if ('topic' === $value['type'])
    {
      $op2_community = $value['op2_community']['id'];
      if (empty($op3_community['select']) ||
        'other' === $op2_community['select'] && empty($op2_community['input']))
      {
        throw new sfValidatorError($this, 'invalid');
      }
    }
  }
}
