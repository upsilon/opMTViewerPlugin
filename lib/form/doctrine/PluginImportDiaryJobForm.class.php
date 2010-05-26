<?php

/**
 * PluginImportDiaryJob form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginImportDiaryJobForm extends BaseImportDiaryJobForm
{
  protected function doSave($conn = null)
  {
    $memberId = sfContext::getInstance()->getUser()->getMemberId();
    $this->getObject()->Op2Member->member_id = $memberId;

    parent::doSave($conn);
  }
}
