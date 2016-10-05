<?php

namespace PhpMovieRestApi\Http;

function hal_json_response($body)
{
    header('Content-Type: application/hal+json');
    echo json_encode($body, JSON_PRETTY_PRINT);
}

function vnd_error_json_response($statusCode, $message)
{
    header('Content-Type: application/vnd.error+json', true, $statusCode);
    echo json_encode(['message' => $message], JSON_PRETTY_PRINT);
}
