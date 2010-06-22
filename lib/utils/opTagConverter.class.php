<?php

class opTagConverter
{
  static protected $htmlConvertList = array(
    'span class="op_b"' => 'op:b',
    'span class="op_u"' => 'op:u',
    'span class="op_i"' => 'op:i',
    'span class="op_s"' => 'op:s',
    'span class="op_large"' => 'op:large',
    'span class="op_small"' => 'op:small',
  );

  private $stack = array();
  private $stackPtr = 0;

  static public function convertTag($html)
  {
    $converter = new self();

    $regexp = '/(?:&lt;|<)(\/?)(.+?)(?:&gt;|>)/';
    $html = preg_replace_callback($regexp, array($converter, 'toOpTag'), $html);

    return $html;
  }

  public function toOpTag($matches)
  {
    $isEndTag = $matches[1];
    $tag = $matches[2];

    if ($isEndTag && 'span' === $tag)
    {
      if (0 !== $stackPtr)
      {
        return '</'.$this->stack[--$this->stackPtr].'>';
      }
      else
      {
        return $matches[0];
      }
    }

    foreach (self::$htmlConvertList as $from => $to)
    {
      if ($tag === $from)
      {
        $this->stack[$this->stackPtr++] = $to;
        return '<'.$to.'>';
      }
    }

    return $matches[0];
  }
}

