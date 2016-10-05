<?php

namespace PhpMovieRestApi\Controller;

use function PhpMovieRestApi\Data\movies;
use function PhpMovieRestApi\Data\paginate;
use function PhpMovieRestApi\Http\hal_json_response;

function movies_collection(array $filter = [])
{
    $movies = movies($filter);

    $perPage = 25;

    if (isset($filter['per_page']) && ctype_digit($filter['per_page'])) {
        $perPage = $filter['per_page'];
    }

    $page = 1;

    if (isset($filter['page']) && ctype_digit($filter['page'])) {
        $page = $filter['page'];
    }

    $paginate = paginate($movies, $perPage, $page);

    $links = [
        'self' => [
            'href' => '/?' . http_build_query(
                array_merge(
                    $filter,
                    [
                        'page' => $paginate['current_page']
                    ]
                ),
                null,
                '&'
            )
        ],
        'search' => [
            'href' => '/{?title,per_page,page}',
            'templated' => true
        ]
    ];

    if (isset($paginate['next_page'])) {
        $links['next'] = [
            'href' => '/?' . http_build_query(
                array_merge(
                    $filter,
                    [
                        'page' => $paginate['next_page']
                    ]
                ),
                null,
                '&'
            )
        ];
    }

    if (isset($paginate['prev_page'])) {
        $links['prev'] = [
            'href' => '/?' . http_build_query(
                    array_merge(
                        $filter,
                        [
                            'page' => $paginate['prev_page']
                        ]
                    ),
                    null,
                    '&'
                )
        ];
    }

    hal_json_response([
        '_links' => $links,
        '_embedded' => [
            'movies' => $paginate['data']
        ]
    ]);
}
