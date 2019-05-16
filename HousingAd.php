<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 11/13/2018
 * Time: 6:20 PM
 */

// CHECK WHERE "test_input" IS NEEDED!!!!!!!!!!!


class HousingAd extends Listing
{
    private $housingType;
    private $housingLeaseLength;
    private $housingAddress = "";
    private $housingCity = "";
    private $housingState = "";
    private $housingZipCode;
    private $housingNumBeds;
    private $housingNumBath;

    public function setHousingType($type)
    {
        $this->housingType = $type;
    }

    public function getHousingType()
    {
        return $this->housingType;
    }

    public function setHousingLeaseLength($length)
    {
        $this->housingLeaseLength = $this->test_input($length);
    }

    public function getHousingLeaseLength()
    {
        return $this->housingLeaseLength;
    }

    public function setHousingAddress($addr)
    {
        $this->housingAddress = $this->test_input($addr);
    }

    public function getHousingAddress()
    {
        return $this->housingAddress;
    }

    public function setHousingCity($city)
    {
        $this->housingCity = $this->test_input($city);
    }

    public function getHousingCity()
    {
        return $this->housingCity;
    }

    public function setHousingState($state)
    {
        $this->housingState = $state;
    }

    public function getHousingState()
    {
        return $this->housingState;
    }

    public function setHousingZipCode($zip)
    {
        $this->housingZipCode = $this->test_input($zip);
    }

    public function getHousingZipCode()
    {
        return $this->housingZipCode;
    }

    public function setHousingNumBed($numBeds)
    {
        $this->housingNumBeds = $this->test_input($numBeds);
    }

    public function getHousingNumBed()
    {
        return $this->housingNumBeds;
    }

    public function setHousingNumBath($numBath)
    {
        $this->housingNumBath = $this->test_input($numBath);
    }

    public function getHousingNumBath()
    {
        return $this->housingNumBath;
    }
}