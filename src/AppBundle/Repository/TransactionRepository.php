<?php

namespace AppBundle\Repository;

/**
 * TransactionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TransactionRepository extends \Doctrine\ORM\EntityRepository
{
	/**
	 * Function to retrieve list of transactions between dates for one account
	 *
	 * @param string $account
	 * @param \DateTime $startDate
	 * @param \DateTime $endDate
	 *
	 * @return array
	 */
	public function getListForAccount($account, $startDate, $endDate)
	{
		$query = $this->createQueryBuilder('trx')
			->where('originAccount = :account')
			->orWhere('destinationAccount = :account')
			->setParameter('account', $account)
			->andWhere('createdAt BETWEEN :startDate AND :endDate')
			->setParameter('startDate', $startDate)
			->setParameter('endDate', $endDate)
			->getQuery();

		return $query->getResult()
	}
}
