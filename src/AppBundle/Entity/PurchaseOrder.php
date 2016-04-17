<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PurchaseOrder
 *
 * @ORM\Table(name="purchase_order")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PurchaseOrderRepository")
 */
class PurchaseOrder
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
     * @ORM\Column(name="canal", type="string", length=3)
     */
    private $canal;

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
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="purchaseOrders")
     */
    private $product;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var int
     *
     * @ORM\Column(name="quantitySent", type="integer", nullable=true)
     */
    private $quantitySent;

    /**
     * @var int
     *
     * @ORM\Column(name="unitPrice", type="integer")
     */
    private $unitPrice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deliveredAt", type="datetime")
     */
    private $deliveredAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\Column(name="deliveryDates", type="array")
     */
    private $deliveryDates;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

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
     * @var string
     *
     * @ORM\Column(name="notes", type="string", length=255, nullable=true)
     */
    private $notes;

    /**
     * @var Bill
     *
     * @ORM\OneToOne(targetEntity="Bill", inversedBy="purchaseOrder")
     */
    private $bill;

    /**
     * Summary function
     */
    public function getSummary()
    {
        $array = [];

        $array['id'] = $this->id;
        $array['estado'] = $this->status;
        if ('rechazada' == $this->status) {
            $array['rechazo'] = $this->rejectionMotive;
        }
        if ('cancelada' == $this->status) {
            $array['cancelado'] = $this->cancelationMotive;
        }
        $array['canal'] = $this->channel;
        $array['cantidad'] = $this->quantity;
        $array['sku'] = $this->product->getSku();
        $array['proveedor'] = $this->provider;
        $array['precio'] = $this->precio;
        $array['notas'] = $this->notes;
        if (!$this->deliveryDates->isEmpty()) {
            $array['fechas despachos'] = $this->deliveryDates->toArray();
        }

        return $array;
    }

    /**
     * Constructor
     */
    public function __construct($channel, $quantity, $product, $provider, $price, $notes = '')
    {
        $this->channel = $channel;
        $this->quantity = $quantity;
        $this->product = $product;
        $this->provider = $provider;
        $this->price = $price;
        $this->notes = $notes;
        $this->status = 'creada';
        $this->deliveryDates = new ArrayCollection();
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
     * @return PurchaseOrder
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
     * @return PurchaseOrder
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
     * Set canal
     *
     * @param string $canal
     *
     * @return PurchaseOrder
     */
    public function setCanal($canal)
    {
        $this->canal = $canal;

        return $this;
    }

    /**
     * Get canal
     *
     * @return string
     */
    public function getCanal()
    {
        return $this->canal;
    }

    /**
     * Set provider
     *
     * @param string $provider
     *
     * @return PurchaseOrder
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
     * @return PurchaseOrder
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return PurchaseOrder
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set quantitySent
     *
     * @param integer $quantitySent
     *
     * @return PurchaseOrder
     */
    public function setQuantitySent($quantitySent)
    {
        $this->quantitySent = $quantitySent;

        return $this;
    }

    /**
     * Get quantitySent
     *
     * @return int
     */
    public function getQuantitySent()
    {
        return $this->quantitySent;
    }

    /**
     * Set unitPrice
     *
     * @param integer $unitPrice
     *
     * @return PurchaseOrder
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Get unitPrice
     *
     * @return int
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * Set deliveredAt
     *
     * @param \DateTime $deliveredAt
     *
     * @return PurchaseOrder
     */
    public function setDeliveredAt($deliveredAt)
    {
        $this->deliveredAt = $deliveredAt;

        return $this;
    }

    /**
     * Get deliveredAt
     *
     * @return \DateTime
     */
    public function getDeliveredAt()
    {
        return $this->deliveredAt;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return PurchaseOrder
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set rejectionMotive
     *
     * @param string $rejectionMotive
     *
     * @return PurchaseOrder
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
     * @return PurchaseOrder
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
     * Set notes
     *
     * @param string $notes
     *
     * @return PurchaseOrder
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set bill
     *
     * @param \AppBundle\Entity\Bill $bill
     *
     * @return PurchaseOrder
     */
    public function setBill(\AppBundle\Entity\Bill $bill = null)
    {
        $this->bill = $bill;

        return $this;
    }

    /**
     * Get bill
     *
     * @return \AppBundle\Entity\Bill
     */
    public function getBill()
    {
        return $this->bill;
    }

    /**
     * Set product
     *
     * @param Product $product
     *
     * @return PurchaseOrder
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set deliveryDates
     *
     * @param array $deliveryDates
     *
     * @return PurchaseOrder
     */
    public function setDeliveryDates($deliveryDates)
    {
        $this->deliveryDates = $deliveryDates;

        return $this;
    }

    /**
     * Get deliveryDates
     *
     * @return array
     */
    public function getDeliveryDates()
    {
        return $this->deliveryDates;
    }

    /**
    * Add deliveryDate
    *
    * @var \DateTime
    */
    public function addDeliveryDate($deliveryDate)
    {
        $this->deliveryDates->add($deliveryDate);

        return $this->deliveryDates;
    }
}
