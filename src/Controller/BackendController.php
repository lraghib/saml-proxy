<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class BackendController extends AbstractController
{
    /**
     * @var HttpClientInterface
     */
    protected $client;

    /**
     * @var array
     */
    protected $headers;

    /**
     * BackendController constructor.
     *
     * @param HttpClientInterface $backendClient
     * @param array $backendHeaders
     */
    public function __construct(HttpClientInterface $backendClient, array $backendHeaders)
    {
        $this->client = $backendClient;
        $this->headers = $backendHeaders;
    }

    /**
     * @Route("/{path}", requirements={"path"="^(?!saml/)(.*)?$"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->denyAccessUnlessGranted($this->getParameter('backend.user_role'));

        return $this->callBackend($request);
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function callBackend(Request $request): Response
    {
        $response = $this->client->request(
            $request->getMethod(),
            $request->getRequestUri(),
            [
                'body' => $request->getContent(),
                'headers' => $this->headers
            ]
        );

        $headers = $response->getHeaders(false);
        unset($headers['transfer-encoding']); // prevent chunk error in proxy

        return new StreamedResponse(
            function () use ($response) {
                $outputStream = fopen('php://output', 'wb');
                foreach ($this->client->stream($response) as $chunk) {
                    fwrite($outputStream, $chunk->getContent());
                    flush();
                }
                fclose($outputStream);
            },
            $response->getStatusCode(),
            $headers
        );
    }
}