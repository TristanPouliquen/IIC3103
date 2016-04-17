<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="sku", type="string", length=255)
     */
    private $sku;

    /**
     * @var float
     *
     * @ORM\Column(name="costs", type="float")
     */
    private $costs;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="PurchaseOrder", mappedBy="product")
     */
    private $purchaseOrders;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->purchaseOrders = new ArrayCollection();
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
     * Set sku
     *
     * @param string $sku
     *
     * @return Product
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set costs
     *
     * @param float $costs
     *
     * @return Product
     */
    public function setCosts($costs)
    {
        $this->costs = $costs;

        return $this;
    }

    /**
     * Get costs
     *
     * @return float
     */
    public function getCosts()
    {
        return $this->costs;
    }

    /**
     * Add purchaseOrder
     *
     * @param \AppBundle\Entity\PurchaseOrder $purchaseOrder
     *
     * @return Product
     */
    public function addPurchaseOrder(\AppBundle\Entity\PurchaseOrder $purchaseOrder)
    {
        $this->purchaseOrders[] = $purchaseOrder;

        return $this;
    }

    /**
     * Remove purchaseOrder
     *
     * @param \AppBundle\Entity\PurchaseOrder $purchaseOrder
     */
    public function removePurchaseOrder(\AppBundle\Entity\PurchaseOrder $purchaseOrder)
    {
        $this->purchaseOrders->removeElement($purchaseOrder);
    }

    /**
     * Get purchaseOrders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPurchaseOrders()
    {
        return $this->purchaseOrders;
    }
}
