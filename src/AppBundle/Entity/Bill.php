<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bill
 *
 * @ORM\Table(name="bill")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BillRepository")
 */
class Bill
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
     * @var string
     *
     * @ORM\Column(name="provider", type="string", length=255)
     */
    private $provider;

    /**
     * @var string
     *
     * @ORM\Column(name="client", type="string", length=255)
     */
    private $client;

    /**
     * @var int
     *
     * @ORM\Column(name="grossValue", type="integer")
     */
    private $grossValue;

    /**
     * @var int
     *
     * @ORM\Column(name="vat", type="integer")
     */
    private $vat;

    /**
     * @var string
     *
     * @ORM\Column(name="paymentState", type="string", length=255)
     */
    private $paymentState;

    /**
     * @var string
     *
     * @ORM\Column(name="rejectionMotive", type="string", length=255, nullable=true)
     */
    private $rejectionMotive;

    /**
     * @var string
     *
     * @ORM\Column(name="cancelationMotive", type="string", length=255, nullable=true)
     */
    private $cancelationMotive;

    /**
     * @ORM\OneToOne(targetEntity="PurchaseOrder", mappedBy="bill")
     */
    private $purchaseOrder;


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
     * @return Bill
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
     * @return Bill
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
     * Set provider
     *
     * @param string $provider
     *
     * @return Bill
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set client
     *
     * @param string $client
     *
     * @return Bill
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set grossValue
     *
     * @param integer $grossValue
     *
     * @return Bill
     */
    public function setGrossValue($grossValue)
    {
        $this->grossValue = $grossValue;

        return $this;
    }

    /**
     * Get grossValue
     *
     * @return int
     */
    public function getGrossValue()
    {
        return $this->grossValue;
    }

    /**
     * Set vat
     *
     * @param integer $vat
     *
     * @return Bill
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return int
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set paymentState
     *
     * @param string $paymentState
     *
     * @return Bill
     */
    public function setPaymentState($paymentState)
    {
        $this->paymentState = $paymentState;

        return $this;
    }

    /**
     * Get paymentState
     *
     * @return string
     */
    public function getPaymentState()
    {
        return $this->paymentState;
    }

    /**
     * Set rejectionMotive
     *
     * @param string $rejectionMotive
     *
     * @return Bill
     */
    public function setRejectionMotive($rejectionMotive)
    {
        $this->rejectionMotive = $rejectionMotive;

        return $this;
    }

    /**
     * Get rejectionMotive
     *
     * @return string
     */
    public function getRejectionMotive()
    {
        return $this->rejectionMotive;
    }

    /**
     * Set cancelationMotive
     *
     * @param string $cancelationMotive
     *
     * @return Bill
     */
    public function setCancelationMotive($cancelationMotive)
    {
        $this->cancelationMotive = $cancelationMotive;

        return $this;
    }

    /**
     * Get cancelationMotive
     *
     * @return string
     */
    public function getCancelationMotive()
    {
        return $this->cancelationMotive;
    }

    /**
     * Set purchaseOrder
     *
     * @param \AppBundle\Entity\PurchaseOrder $purchaseOrder
     *
     * @return Bill
     */
    public function setPurchaseOrder(\AppBundle\Entity\PurchaseOrder $purchaseOrder = null)
    {
        $this->purchaseOrder = $purchaseOrder;

        return $this;
    }

    /**
     * Get purchaseOrder
     *
     * @return \AppBundle\Entity\PurchaseOrder
     */
    public function getPurchaseOrder()
    {
        return $this->purchaseOrder;
    }
}
