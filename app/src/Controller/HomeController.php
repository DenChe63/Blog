<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /** @var PostRepository */
    private $postRepository;

    public function __construct(
        PostRepository $postRepository
    ){
        $this->postRepository = $postRepository;
    }


    /**
     * @Route("/", name="app_home")
     */
    public function index(Request $request): Response
    {
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 5);
        $pagesCount = ceil(count($this->postRepository->findAll()) / $limit);
        $pages = range(1, $pagesCount);
        $posts = $this->postRepository->findBy([], [], $limit, ($limit * ($page - 1)));

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'posts' => $posts,
            'pages' => $pages,
            'limit' => $limit,
        ]);
    }
}
