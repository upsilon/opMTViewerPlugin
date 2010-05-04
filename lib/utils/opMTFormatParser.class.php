<?php

class opMTFormatParser implements Iterator
{
  private $fh;
  private $diary;
  private $cnt = 0;

  public function __construct($fh)
  {
    $this->fh = $fh;
  }

  public function rewind()
  {
    $this->next();
  }

  public function next()
  {
    $diary = array();
    $isMetaSection = true;
    $isiKeyValueLine = true;
    $isFirstLine = true;

    while ($line = fgets($this->fh))
    {
      $line = rtrim($line, "\r\n");

      if ('--------' === $line)
      {
        foreach ($diary as $key => &$value)
        {
          while (is_array($value) && 1 === count($value) && $key !== 'COMMENT')
          {
            $value = array_shift($value);
          }
        }

        $this->diary = $diary;
        $this->cnt++;

        return;
      }
      elseif ('-----' === $line)
      {
        if (isset($section['content']))
        {
          $section['content'] = rtrim($section['content'], "\n");
        }

        if (!$isMetaSection)
        {
          if (!isset($diary[$sectionName]))
          {
            $diary[$sectionName] = array();
          }
          $diary[$sectionName][] = $section;
        }

        $isMetaSection = false; // メタデータは先頭のセクションのみ
        $isKeyValueLine = true;
        $isFirstLine = true;
      }
      else
      {
        if ($isMetaSection)
        {
          $entry = explode(': ', $line, 2);
          $diary[$entry[0]] = $entry[1];
        }
        else
        {
          if ($isFirstLine)
          {
            // 2つ目以降のセクションは先頭行をセクション名にする
            $entry = explode(':', $line, 2);

            $sectionName = $entry[0];
            $section = array();

            $isFirstLine = false;
          }
          elseif ($isKeyValueLine && strpos($line, ': ') !== false)
          {
            $entry = explode(': ', $line, 2);
            $section[$entry[0]] = $entry[1];
          }
          else
          {
            // 「KEY: VALUE」が終了した行からセクション本文を開始
            $isKeyValueLine = false;

            if (!isset($section['content']))
            {
              $section['content'] = '';
            }

            $section['content'] .= $line."\n";
          }
        }
      }
    }

    $this->diary = null;
  }

  public function valid()
  {
    return !is_null($this->diary);
  }

  public function current()
  {
    return $this->diary;
  }

  public function key()
  {
    return $this->cnt;
  }
}

