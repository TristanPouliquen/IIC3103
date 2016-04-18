<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="account")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountRepository")
 */
class Account
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Account
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Account
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->originTransactions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->destinationTransactions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add originTransaction
     *
     * @param \AppBundle\Entity\Transaction $originTransaction
     *
     * @return Account
     */
    public function addOriginTransaction(\AppBundle\Entity\Transaction $originTransaction)
    {
        $this->originTransactions[] = $originTransaction;

        return $this;
    }

    /**
     * Remove originTransaction
     *
     * @param \AppBundle\Entity\Transaction $originTransaction
     */
    public function removeOriginTransaction(\AppBundle\Entity\Transaction $originTransaction)
    {
        $this->originTransactions->removeElement($originTransaction);
    }

    /**
     * Get originTransactions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOriginTransactions()
    {
        return $this->originTransactions;
    }

    /**
     * Add destinationTransaction
     *
     * @param \AppBundle\Entity\Transaction $destinationTransaction
     *
     * @return Account
     */
    public function addDestinationTransaction(\AppBundle\Entity\Transaction $destinationTransaction)
    {
        $this->destinationTransactions[] = $destinationTransaction;

        return $this;
    }

    /**
     * Remove destinationTransaction
     *
     * @param \AppBundle\Entity\Transaction $destinationTransaction
     */
    public function removeDestinationTransaction(\AppBundle\Entity\Transaction $destinationTransaction)
    {
        $this->destinationTransactions->removeElement($destinationTransaction);
    }

    /**
     * Get destinationTransactions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDestinationTransactions()
    {
        return $this->destinationTransactions;
    }
}
