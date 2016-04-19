<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\PurchaseOrder;


/**
 * @Route("/oc")
 */
class PurchaseOrderController extends Controller
{

    /**
     * Get summary of PurchaseOrder
     * @Route("/obtener/{id}", requirements={"id" = "\d+"})
     */
    public function getAction(Request $request, PurchaseOrder $purchaseOrder)
    {
        return new JsonResponse($purchaseOrder->getSummary());
    }

    /**
     * Creation of a PurchaseOrder
     * @Route("/crear")
     * @Method("PUT")
     */
    public function createAction(Request $request)
    {
        $channel = $request->request->get('canal');
        $quantity = $request->request->get('cantidad');
        $sku = $request->request->get('sku');
        $provider = $request->request->get('proveedor');
        $price = $request->request->get('precio');
        $notes = $request->request->get('notas');

        if (empty($channel) || empty($quantity) || empty($sku) || empty($provider)
            || empty($price)) {
            return new Response('Missing arguments', 400);
        }

        $product = $this->get('app.repository.product')->findOneBySku($sku);


        if (empty($product)) {
            return new Response('No product found for this SKU', 400);
        }

        $purchaseOrder = new PurchaseOrder($channel, $quantity, $product, $provider, $price, $notes);

        $em = $this->get('doctrine.orm.entity_manager');

        $em->persist($purchaseOrder);
        $em->flush();

        return new JsonResponse($purchaseOrder->getSummary());

    }

    /**
     * Receive a PurchaseOrder
     * @Route("/recepcionar/{id}", requirements={"id" = "\d+"})
     * @Method("POST")
     */
    public function receiveAction(Request $request, PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->setStatus('recepcionada');

        $this->get('doctrine.orm.entity_manager')->flush();

        return new JsonResponse($purchaseOrder->getSummary());
    }

    /**
     * Reject a PurchaseOrder
     * @Route("/rechazar/{id}", requirements={"id" = "\d+"})
     * @Method("POST")
     */
    public function rejectAction(Request $request, PurchaseOrder $purchaseOrder)
    {
        $rejectionMotive = $request->request->get('rechazo');

        $purchaseOrder->setStatus('rechazada');
        $purchaseOrder->setRejectionMotive($rejectionMotive);

        $this->get('doctrine.orm.entity_manager')->flush();

        return new JsonResponse($purchaseOrder->getSummary());
    }

    /**
     * Delete a PurchaseOrder
     * @Route("/anular/{id}", requirements={"id" = "\d+"})
     * @Method("DELETE")
     */
    public function cancelAction(Request $request, PurchaseOrder $purchaseOrder)
    {
        $cancelMotive = $request->request->get('motivo');

        $purchaseOrder->setStatus('cancelada');
        $purchaseOrder->setCancelationMotive($cancelMotive);

        $this->get('doctrine.orm.entity_manager')->flush();

        return new JsonResponse($purchaseOrder->getSummary());        
    }

    /**
     * Send the product of the PurchaseOrder
     * @Route("/despachar/{id}", requirements={"id" = "\d+"})
     */
    public function sendAction(Request $request, PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->addDeliveryDate(new \DateTime());

        //TODO : Call to Warehouse routes to send the products

        return new JsonResponse($purchaseOrder->getSummary());
    }
}