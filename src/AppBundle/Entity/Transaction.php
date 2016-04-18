<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransactionRepository")
 */
class Transaction
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
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="originAccount", type="string", length=255)
     */
    private $originAccount;

    /**
     * @var string
     *
     * @ORM\Column(name="destinationAccount", type="string", length=255)
     */
    private $destinationAccount;

    /**
     * Array summary of the transaction
     */
    public function getSummary()
    {
        $array = [];

        $array['id'] = $this->id;
        $array['monto'] = $this->amount;
        $array['origen'] = $this->originAccount;
        $array['destino'] = $this->destinationAccount;

        return $array;
    }

    /**
     * Constructor
     */
    public function __construct($amount, $origin, $destination)
    {
        $this->amount = $amount;
        $this->origin = $origin;
        $this->destination = $destination;
    }

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Transaction
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Transaction
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Transaction
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
     * Set originAccount
     *
     * @param string $originAccount
     *
     * @return Transaction
     */
    public function setOriginAccount($originAccount)
    {
        $this->originAccount = $originAccount;

        return $this;
    }

    /**
     * Get originAccount
     *
     * @return string
     */
    public function getOriginAccount()
    {
        return $this->originAccount;
    }

    /**
     * Set destinationAccount
     *
     * @param string $destinationAccount
     *
     * @return Transaction
     */
    public function setDestinationAccount($destinationAccount)
    {
        $this->destinationAccount = $destinationAccount;

        return $this;
    }

    /**
     * Get destinationAccount
     *
     * @return string
     */
    public function getDestinationAccount()
    {
        return $this->destinationAccount;
    }
}
