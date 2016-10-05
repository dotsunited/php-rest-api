<?php

require __DIR__.'/../src/bootstrap.php';

$pathInfo = '';

if (isset($_SERVER['PATH_INFO'])) {
    $pathInfo = trim($_SERVER['PATH_INFO'], '/');
}

switch ($pathInfo) {
    case '':
        PhpMovieRestApi\Controller\movies_collection($_GET);
        break;
    default:
        PhpMovieRestApi\Http\vnd_error_json_response(404, 'Not Found');
        break;
}
