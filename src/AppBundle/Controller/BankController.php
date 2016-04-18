<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Transaction;

/**
 * @Route("/banco")
 */
class BankController extends Controller
{
	/**
	 * Create a Transaction
	 * @Route("/trx")
	 * @Method("PUT")
	 */
	public function createAction(Request $request)
	{
		$amount = $request->request->get('monto');
		$originAccount = $request->request->get('origen');
		$destinationAccount = $request->request->get('destino');

		if (empty($amount) || empty($originAccount) || empty($destinationAccount)) {
			return new Response('Missing arguments', 400);
		}

		$transaction = new Transaction($amount, $originAccount, $destinationAccount);

		$em = $this->get('doctrine.orm.entity_manager');

		$em->persist($transaction);
		$em->flush();

		return new JsonResponse($transaction->getSummary());
	}

	/**
	 * Get description of transaction
	 * @Route("/trx/{id}", requirements={"id" = "\d+"})
	 * @Method("GET")
	 */
	public function getAction(Request $request, Transaction $transaction)
	{
		return new JsonResponse($transaction->getSummary());
	}

	/**
	 * List of transactions between two dates
	 * @Route("/cartola")
	 * @Method("POST")
	 */
	public function getListAction(Request $request)
	{
		$account = $request->request->get('cuenta');
		$startDate = new \DateTime($request->request->get('fecha_inicio'));
		$endDate = new \DateTime($request->request->get('fecha_fin'));
		$limit = $request->request->get('limit') ? $request->request->get('limit') : 0;

		if (empty($account) || empty($startDate) || empty($endDate)) {
			return new Response('Missing arguments', 400);
		}

		$transactions = $this->get('app.repository.transaction')->getListForAccount($account, $startDate, $endDate, $limit);

		$count = count($transactions);

		$result = [
			'conteo' => $count,
			'transacciones' => 	array_map(function (Transaction $el) {
											return $el->getSummary();
								}, $transactions)
		];

		return new JsonResponse($result);
	}

	/**
	 * Get the current money on a particular bank account
	 * @Route("/cuenta/{id}")
	 * @Method("GET")
	 */
	public function getAccountAction(Request $request, $id)
	{
		$account = $this->get('app.repository.account')->findOneByName($id);

		if (empty($account)) {
			return new Response('No account found for this ID', 404);
		}

		return new JsonResponse([
			'id' => $account->getName(),
			'saldo' => $account->getAmount()
		]);
	}
}
