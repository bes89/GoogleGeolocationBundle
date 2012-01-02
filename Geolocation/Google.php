<?php

namespace Penfold\Bundle\GoogleGeolocationBundle\Geolocation;

class Google
{
  private $url;
  private $format;

  private $address;

  /*
   *
   */
  public function __construct($url, $format)
  {
    $this->url = $url;
    $this->format = $format;
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
  public function getFormat()
  {
    return $this->format;
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
  public function getResults()
  {
    $this->execute();
    return $this->results;
  }

  /*
   *
   */
  public function getRequestUrl()
  {
    return $this->getUrl() . $this->getFormat() . '?' . $this->getAddress() . '/&sensor=false';
  }

  /*
   *
   */
  private function execute()
  {
    $curl = curl_init();

    var_dump($this->getRequestUrl());
    die();

    curl_setopt($curl, CURLOPT_URL, $this->getRequestUrl());
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
    curl_setopt($curl, CURLOPT_USERAGENT, 'PenfoldApiClient');

    curl_setopt($curl, CURLOPT_POST, false);

    $result = curl_exec($curl);

  }
}