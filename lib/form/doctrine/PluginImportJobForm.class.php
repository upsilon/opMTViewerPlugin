<?php

/**
 * PluginImportJob form.
 *
 * @package    opMTViewerPlugin
 * @subpackage form
 * @author     Kimura Youichi <kim.upsilon@gmail.com>
 */
abstract class PluginImportJobForm extends BaseImportJobForm
{
  public function setup()
  {
    parent::setup();

    $this->setWidget('file_id', new sfWidgetFormInputFile());
    $this->setValidator('file_id', new sfValidatorFile(array(
      'mime_types' => array('text/plain'),
    )));

    $this->useFields(array('file_id'));
  }

  public function doSave()
  {
    $file = new File();
    $file->setFromValidatedFile($this->getValue('file_id'));
    $file->name = 'op_mtviewer_'.$this->getObject()->id.'_'.$file->name;

    $memberId = sfContext::getInstance()->getUser()->getMemberId();

    $this->getObject()->File = $file;
    $this->getObject()->member_id = $memberId;

    parent::doSave();
  }
}
