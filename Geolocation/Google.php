<?php

namespace Penfold\Bundle\GoogleGeolocationBundle\Geolocation;

class Google
{

  const JSON = 'json';
  const XML  = 'xml';

  private $url;
  private $format;

  private $address;
  private $raw_result;

  /*
   *
   */
  public function __construct($url, $format)
  {
    $this->url = $url;

    $this->setFormat($format);
  }

  /*
   *
   */
  public function getUrl()
  {
    return $this->url;
  }

  /*
   *
   */
  public function getRawResult()
  {
    return $this->raw_result;
  }

  /*
   *
   */
  public function getFormat()
  {
    return $this->format;
  }

  /*
   *
   */
  public function setFormat($format)
  {
    if($format != self::JSON && $format != self::XML)
    {
      throw new \Exception('Unknown return format: ' . $format);
    }
    $this->format = $format;
  }

  /*
   *
   */
  public function setAddress($address)
  {
    $this->address = $address;
  }

  /*
   *
   */
  public function getAddress()
  {
    return $this->address;
  }

  /*
   *
   */
  public function setResults($results)
  {
    $this->results = $results;
  }

  /*
   *
   */
  public function getResults()
  {
    $this->execute();
    return $this->results;
  }

  /*
   *
   */
  public function getFirstResult()
  {
    $results = $this->getResults();
    return $results[0];
  }

  /*
   *
   */
  public function getNumberOfResults()
  {
    return count($this->results);
  }

  /*
   *
   */
  public function getRequestUrl()
  {
    return $this->getUrl() . '/' . $this->getFormat() . '?address=' . urlencode($this->getAddress()) . '&sensor=false';
  }

  /*
   *
   */
  private function execute()
  {
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $this->getRequestUrl());
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
    curl_setopt($curl, CURLOPT_USERAGENT, 'PenfoldApiClient');

    curl_setopt($curl, CURLOPT_POST, false);

    $this->raw_result = curl_exec($curl);
    $this->handleResult();
  }

  /*
   *
   */
  private function handleResult()
  {
    $results = null;
    if($this->getFormat() == self::JSON)
    {
      $json = json_decode($this->getRawResult(), true);
      foreach ($json['results'] as $result)
      {
	$result_object = new GoogleResult();
	$result_object->setData($result);
	$results[] = $result_object;
      }
    }
    elseif($this->getFormat() == self::XML)
    {
      // @TODO not currently umplimented
      throw new \Exception('Could not handle geloacation result: requested format "'.self::XML.'" is not umplimented yet');
    }
    else
    {
      throw new \InvalidArgumentException('Could not handle geloacation result: requested unknown format: ' . $this->getFormat());
    }

    $this->setResults($results);
  }
}