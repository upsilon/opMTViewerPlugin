<?php

class opWidgetFormDoctrineChoiceInput extends sfWidgetFormDoctrineChoice
{
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->addOption('format', '%select%<br />%input%');
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    return strtr($this->getOption('format'), array(
      '%select%' => parent::render(
        $name.'[select]',
        $this->getValueFor('select', $value),
        array_merge(array('size' => 5), $this->getAttributesFor('select', $attributes)),
        $errors
      ),
      '%input%' => $this->getInputWidget($attributes)->render(
        $name.'[input]',
        $this->getValueFor('input', $value),
        $this->getAttributesFor('input', $attributes)
      ),
    ));
  }

  public function getChoices()
  {
    $choices = parent::getChoices();
    $choices['other'] = 'その他';

    return $choices;
  }

  protected function getInputWidget($attributes = array())
  {
    return new sfWidgetFormInput(array(), $this->getAttributesFor('input', $attributes));
  }

  protected function getValueFor($name, $value)
  {
    return isset($value[$name]) ? $value[$name] : '';
  }

  protected function getAttributesFor($name, $attributes)
  {
    return isset($attribute[$name]) ? $attribute[$name] : array();
  }
}
