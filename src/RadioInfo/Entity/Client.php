<?php namespace RadioInfo\Entity;

class Client
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $signal;

    /**
     * @var string
     */
    private $noisefloor;

    /**
     * @var string
     */
    private $mac;

    /**
     * @param $name
     * @param $signal
     * @param $noisefloor
     * @param $mac
     */
    public function __construct($name, $signal, $noisefloor, $mac)
    {
        $this->name = $name;
        $this->signal = $signal;
        $this->noisefloor = $noisefloor;
        $this->mac = $mac;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSignal()
    {
        return $this->signal;
    }

    /**
     * @return string
     */
    public function getNoisefloor()
    {
        return $this->noisefloor;
    }

    /**
     * @return string
     */
    public function getMac()
    {
        return $this->mac;
    }
}