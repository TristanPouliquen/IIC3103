<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Transaction;

class FrontController extends Controller
{
	/**
	 * Homepage of the front store
	 * @Route("/", name="homepage")
	 */
	public function homepageAction(Request $request)
	{
		return $this->render("front/homepage.html.twig");
	}
}
