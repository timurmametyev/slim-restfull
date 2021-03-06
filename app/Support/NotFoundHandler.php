<?php

declare(strict_types=1);

namespace App\Support;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\ErrorHandlerInterface;
use Throwable;

class NotFoundHandler implements ErrorHandlerInterface
{
    /**
     * @var ResponseFactoryInterface
     */
    private ResponseFactoryInterface $factory;

    /**
     * NotFoundHandler constructor.
     *
     * @param ResponseFactoryInterface $factory
     */
    public function __construct(ResponseFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param ServerRequestInterface $request
     * @param Throwable $exception
     * @param bool $displayErrorDetails
     * @param bool $logErrors
     * @param bool $logErrorDetails
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails
    ): ResponseInterface
    {
        $response = $this->factory->createResponse(404);
        $response->getBody()->write('404 Not Found');

        return $response
            ->withHeader('Content-type', 'text/html');
    }
}