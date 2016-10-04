<?php

namespace PhpMovieRestApi\Http;

function json_response($body)
{
    header('Content-Type: application/json');
    echo json_encode($body, JSON_PRETTY_PRINT);
}

function json_error_response($statusCode, $message)
{
    header('Content-Type: application/json', true, $statusCode);
    echo json_encode(['message' => $message], JSON_PRETTY_PRINT);
}
