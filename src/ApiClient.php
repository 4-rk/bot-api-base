<?php

declare(strict_types=1);

namespace TgBotApi\BotApiBase;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use TgBotApi\BotApiBase\Type\InputFileType;

class ApiClient implements ApiClientInterface
{
    private $client;
    private $botKey;
    private $endPoint;
    private $streamFactory;
    private $requestFactory;

    /**
     * ApiApiClient constructor.
     *
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface  $streamFactory
     * @param ClientInterface         $client
     */
    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        ClientInterface $client
    ) {
        $this->streamFactory = $streamFactory;
        $this->requestFactory = $requestFactory;
        $this->client = $client;
    }

    /**
     * @param string                 $method
     * @param BotApiRequestInterface $apiRequest
     *
     * @throws \Psr\Http\Client\ClientExceptionInterface
     *
     * @return mixed
     */
    public function send(string $method, BotApiRequestInterface $apiRequest)
    {
        $request = $this->requestFactory->createRequest('POST', $this->generateUri($method));

        $boundary = \uniqid('', true);

        $stream = $this->streamFactory->createStream($this->createStreamBody($boundary, $apiRequest));

        $response = $this->client->sendRequest($request
            ->withHeader('Content-Type', 'multipart/form-data; boundary="' . $boundary . '"')
            ->withBody($stream));

        $content = $response->getBody()->getContents();

        return \json_decode($content);
    }

    /**
     * @param string $botKey
     *
     * @return ApiClientInterface
     */
    public function setBotKey(string $botKey): ApiClientInterface
    {
        $this->botKey = $botKey;

        return $this;
    }

    /**
     * @param string $endPoint
     *
     * @return ApiClientInterface
     */
    public function setEndpoint(string $endPoint): ApiClientInterface
    {
        $this->endPoint = $endPoint;

        return $this;
    }

    /**
     * @param string $method
     *
     * @return string
     */
    protected function generateUri(string $method): string
    {
        return $this->endPoint . '/bot' . $this->botKey . '/' . $method;
    }

    /**
     * @param mixed                  $boundary
     * @param BotApiRequestInterface $request
     *
     * @return string
     */
    protected function createStreamBody($boundary, BotApiRequestInterface $request): string
    {
        $stream = '';
        foreach ($request->getData() as $name => $value) {
            $stream .= $this->createDataStream($boundary, $name, $value);
        }

        foreach ($request->getFiles() as $name => $file) {
            $stream .= $this->createFileStream($boundary, $name, $file);
        }

        if (\strlen($stream)) {
            $stream .= "--$boundary--\r\n";
        }

        return $stream;
    }

    /**
     * @param $boundary
     * @param $name
     * @param InputFileType $file
     *
     * @return string
     */
    protected function createFileStream($boundary, $name, InputFileType $file): string
    {
        $headers = '';
        $headers .= \sprintf(
            "Content-Disposition: form-data; name=\"%s\"; filename=\"%s\"\r\n",
            $name,
            $file->getBasename()
        );
        $headers .= \sprintf("Content-Length: %s\r\n", (string) $file->getSize());
        $headers .= \sprintf("Content-Type: %s\r\n", \mime_content_type($file->getRealPath()));

        $streams = '';
        $streams .= "--$boundary\r\n$headers\r\n";
        $streams .= \file_get_contents($file->getRealPath());
        $streams .= "\r\n";

        return $streams;
    }

    /**
     * @param $boundary
     * @param $name
     * @param $value
     *
     * @return string
     */
    protected function createDataStream($boundary, $name, $value): string
    {
        $headers = '';
        $headers .= \sprintf("Content-Disposition: form-data; name=\"%s\"\r\n", $name);
        $headers .= \sprintf("Content-Length: %s\r\n", (string) \strlen((string) $value));

        $streams = '';
        $streams .= "--$boundary\r\n$headers\r\n";
        $streams .= $value;
        $streams .= "\r\n";

        return $streams;
    }
}
