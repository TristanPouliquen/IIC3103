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
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="originTransactions")
     */
    private $originAccount;

    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="destinationTransactions")
     */
    private $destinationAccount;


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
     * @param \AppBundle\Entity\Account $originAccount
     *
     * @return Transaction
     */
    public function setOriginAccount(\AppBundle\Entity\Account $originAccount = null)
    {
        $this->originAccount = $originAccount;

        return $this;
    }

    /**
     * Get originAccount
     *
     * @return \AppBundle\Entity\Account
     */
    public function getOriginAccount()
    {
        return $this->originAccount;
    }

    /**
     * Set destinationAccount
     *
     * @param \AppBundle\Entity\Account $destinationAccount
     *
     * @return Transaction
     */
    public function setDestinationAccount(\AppBundle\Entity\Account $destinationAccount = null)
    {
        $this->destinationAccount = $destinationAccount;

        return $this;
    }

    /**
     * Get destinationAccount
     *
     * @return \AppBundle\Entity\Account
     */
    public function getDestinationAccount()
    {
        return $this->destinationAccount;
    }
}
