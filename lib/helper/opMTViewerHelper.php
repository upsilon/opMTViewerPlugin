<?php

function _op_mtviewer_entry_str($entry, $width = 36)
{
  $title = op_truncate($entry->title, $width);
  $title = sprintf('%s (%d)', $title, $entry->getCommentsCount());

  return $title;
}

function op_mtviewer_diary_link($diary, $width = 36)
{
  $title = _op_mtviewer_entry_str($diary, $width);
  $html = link_to($title, '@mtviewer_diary?id='.$diary->id);

  if ($diary->has_images)
  {
    $html .= ' '.image_tag('icon_camera.gif', array('alt' => 'photo'));
  }

  return $html;
}

function op_mtviewer_topic_link($topic, $width = 36)
{
  $title = _op_mtviewer_entry_str($topic, $width);
  return link_to($title, '@mtviewer_topic?id='.$topic->id);
}

function op_mtviewer_event_link($event, $width = 36)
{
  $title = _op_mtviewer_entry_str($event, $width);
  return link_to($title, '@mtviewer_event?id='.$event->id);
}

