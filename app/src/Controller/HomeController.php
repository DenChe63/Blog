<?php

namespace App\Controller;

use App\PaginatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /** @var PaginatorService */
    private $paginatorService;

    public function __construct(
        PaginatorService $paginatorService
    ) {
        $this->paginatorService = $paginatorService;
    }

    /**
     * @Route("/", name="app_home")
     */
    public function index(Request $request): Response
    {
        $homePage = $this->paginatorService->paginator($request->query
            ->get('page', 1), $request->query
            ->get('limit', 5)
        );

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'homePage' => $homePage,
        ]);
    }
}
