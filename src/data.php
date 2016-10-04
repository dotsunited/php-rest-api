<?php

namespace PhpMovieRestApi\Data;

function movies(array $filter = [])
{
    $movies = json_decode(
        file_get_contents(__DIR__.'/../data/movies.json'),
        true
    );

    if (!empty($filter['title'])) {
        $titleFilter = $filter['title'];
        $movies = array_filter($movies, function($movie) use ($titleFilter) {
            return $movie['Title'] === $titleFilter;
        });
    }

    return array_values($movies);
}

function paginate(array $data, $perPage, $currentPage)
{
    $perPage     = (int) $perPage;
    $currentPage = (int) $currentPage;

    $total = count($data);

    $totalPages = (int) ceil($total / $perPage);

    if ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    }

    $offset = ($currentPage - 1) * $perPage;
    $length = $perPage;

    return [
        'total' => $total,
        'total_pages' => $totalPages,
        'data' => array_slice($data, $offset, $length),
        'current_page' => $currentPage,
        'next_page' => $currentPage < $totalPages ? $currentPage + 1 : null,
        'prev_page' => $currentPage > 1 ? $currentPage - 1 : null
    ];
}
