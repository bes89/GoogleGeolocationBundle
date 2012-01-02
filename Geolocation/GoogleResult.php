<?php

namespace Penfold\Bundle\GoogleGeolocationBundle\Geolocation;

class GoogleResult extends Result
{

  /*
   *
   */
  public function getLatitude()
  { 
    $gemometry = $this->getGeometry();
    return $gemometry['location']['lat'];
  }

  /*
   *
   */
  public function getLongitude()
  { 
    $gemometry = $this->getGeometry();
    return $gemometry['location']['lng'];
  }
}
