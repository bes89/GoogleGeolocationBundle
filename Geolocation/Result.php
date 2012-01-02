<?php

namespace Penfold\Bundle\GoogleGeolocationBundle\Geolocation;

class Result
{

  private $data;

  /*
   *
   */
  public function setData($data)
  {
    $this->data = $data;
  }

  /*
   *
   */
  public function getData()
  {
    return $this->data;
  }

  /*
   *
   */
  public function getElement($element)
  { 
    if(isset($this->data[$element]))
    {
      return $this->data[$element];
    }
  }

  /*
   *
   */
  public function __call($name, $arguments)
  {
    $result = null;
    if(strpos($name, 'get') !== false)
    {
      $element = strtolower(str_replace('get', '', $name));
      $result = $this->getElement($element);
    }
    else
    {
      throw new Excpetion('Unknown function call' . $name);
    }
    return $result;
  }

}