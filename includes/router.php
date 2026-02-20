<?php
declare(strict_types=1);

function normalizeUri(string $uri): string
{
    $uri = preg_replace('/\?.*/', '', $uri);
    return strtolower(trim($uri, '/'));
}

function notFound(): void
{
    http_response_code(404);
    renderView('404');
    exit;
}

function getRouteHandler(string $uri, string $method): ?array
{
    $method = strtoupper($method);

    // GET /
    if ($uri === '' && $method === 'GET') {
        return ['EventController', 'index'];
    }

    // GET /events
    if ($uri === 'events' && $method === 'GET') {
        return ['EventController', 'index'];
    }

    // GET /events/create
    if ($uri === 'events/create' && $method === 'GET') {
        return ['EventController', 'goToCreate'];
    }

    // POST /events
    if ($uri === 'events' && $method === 'POST') {
        return ['EventController', 'create'];
    }

    // GET /events/{id}
    if (preg_match('/^events\/(\d+)$/', $uri, $matches) && $method === 'GET') {
        return ['EventController', 'show', (int)$matches[1]];
    }

    // POST /events/{id}/edit
    if (preg_match('/^events\/(\d+)\/edit$/', $uri, $matches) && $method === 'POST') {
        return ['EventController', 'edit', (int)$matches[1]];
    }

    return null;
}

function dispatch(string $uri, string $method): void
{
    $uri = normalizeUri($uri);

    if (!in_array(strtoupper($method), ALLOW_METHODS)) {
        notFound();
    }

    $handler = getRouteHandler($uri, $method);

    if (!$handler) {
        notFound();
    }

    [$controllerName, $action, $param] = array_pad($handler, 3, null);

    require_once ROUTE_DIR . "/{$controllerName}.php";

    // ใช้ global ชั่วคราว (เดี๋ยวค่อยทำ container)
    global $eventRepo;

    $controller = new $controllerName($eventRepo);

    if ($param !== null) {
        $controller->$action($param);
    } else {
        $controller->$action();
    }
}
