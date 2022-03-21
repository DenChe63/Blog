<?php

namespace App;

use App\Repository\PostRepository;

class PaginatorService
{
    /** @var PostRepository */
    private $postRepository;

    public function __construct(
        PostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    public function paginator(int $page, int $limit): array
    {
        $pagesCount = ceil(count($this->postRepository->findAll()) / $limit);
        $pages = range(1, $pagesCount);
        $posts = $this->postRepository->findBy([], [], $limit, ($limit * ($page - 1)));

        return [
            'posts' => $posts,
            'pages' => $pages,
            'limit' => $limit,
        ];
    }
}
