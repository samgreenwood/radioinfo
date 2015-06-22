<?php namespace RadioInfo\Entity;

use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="radios")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap( {"ubiquiti" = UbiquitiRadio::class} )
 */
abstract class Radio
{
    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer")
     */
    protected $id;

    /**
     * @Column(type="string")
     */
    protected $name;

    /**
     * @Column(type="string")
     */
    protected $username;

    /**
     * @Column(type="string")
     */
    protected $password;

    /**
     * @Column(type="string")
     */
    protected $host;

    /**
     * @ManyToOne(targetEntity="Site", inversedBy="radios")
     */
    protected $site;

    /**
     * @param Site $site
     * @param $name
     * @param $username
     * @param $password
     * @param $host
     */
    public function __construct(Site $site, $name, $username, $password, $host)
    {
        $this->site = $site;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @return array
     */
    abstract public function getClients();

    /**
     * @return integer
     */
    abstract public function getNumberOfClients();

    /**
     * @return integer
     */
    abstract public function getFrequency();

}
