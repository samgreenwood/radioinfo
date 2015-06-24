<?php namespace RadioInfo\Entity;

use Doctrine\ORM\Mapping;
use Ssh;

/**
 * @Entity
 */
class UbiquitiRadio extends Radio
{
    private $sshSession = null;

    /**
     * @return Client[]
     */
    public function getClients()
    {
        $session = $this->getSshSession();

        $clients = [];

        $connectedClients = json_decode($session->getExec()->run('wstalist'));

        foreach($connectedClients as $connectedClient)
        {
            $name = $connectedClient->name;
            $mac = $connectedClient->mac;
            if(property_exists($connectedClient->airmax, 'signal'))
            {
                $signal = $connectedClient->airmax->signal;
            }
            else
            {
                $signal = $connectedClient->signal;
            }

            $noisefloor = $connectedClient->noisefloor;

            $clients[] = new Client($name, $signal, $noisefloor, $mac);
        }

        return $clients;
    }

    /**
     * @return integer
     */
    public function getNumberOfClients()
    {
        return count($this->getClients());
    }

    /**
     * @return integer
     */
    public function getFrequency()
    {
        $session = $this->getSshSession();

        $data = $session->getExec()->run('iwconfig ath0 | grep Frequency');
        $data = explode(' ', $data);

        return explode(':', $data[12])[1]*1000;
    }

    /**
     * @return mixed
     */
    public function getSsid()
    {
        $session = $this->getSshSession();

        $data = $session->getExec()->run('iwconfig ath0 | grep ESSID');
        $data = explode(' ', $data);

        return str_replace('"', '', explode(':', $data[9])[1]);
    }

    /**
     * @return Ssh\Session
     */
    private function getSshSession()
    {
        if(!$this->sshSession)
        {
            $configuration = new Ssh\Configuration($this->getHost());
            $authentication = new Ssh\Authentication\Password($this->getUsername(), $this->getPassword());

            $this->sshSession = new Ssh\Session($configuration, $authentication);
        }

        return $this->sshSession;
    }
}
