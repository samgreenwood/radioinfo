<?php namespace RadioInfo\Entity;

use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="sites")
 */
class Site
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
    private $name;

    /**
     * @OneToMany(targetEntity=Radio::class, mappedBy="site")
     */
    private $radios;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Radio $radio
     */
    public function addRadio(Radio $radio)
    {
        $this->radios[] = $radio;
    }

    /**
     * @param Radio $radio
     */
    public function removeRadio(Radio $radio)
    {
        unset($this->radios[array_search($radio, $this->radios)]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getRadios()
    {
        return $this->radios;
    }
}