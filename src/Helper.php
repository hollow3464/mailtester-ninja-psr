<?php

declare(strict_types=1);

namespace Hollow3464\MailtesterNinjaPsr;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Log\LoggerInterface;

final class Helper
{
    private const ENDPOINT = 'https://api.mailtester.ninja';

    public function __construct(
        private ClientInterface $http,
        private RequestFactoryInterface $requests,
        private ?LoggerInterface $log = null,
        private readonly ?string $apiKey = null,
    ) {}

    public function verifyEmail(string $email): ValidationResponse
    {
        $url = sprintf('%s?email=%s', self::ENDPOINT, $email);

        if ($this->apiKey) {
            $url .= "&key={$this->apiKey}";
        }

        $response = $this->http->sendRequest(
            $this->requests->createRequest('POST', $url)
        );

        if ($response->getStatusCode() >= 400) {
            if ($this->log) {
                $this->log->error('Failed to validate email', [
                    'response' => $response->getBody()->getContents(),
                ]);
            }

            throw new \RuntimeException('Failed to validate email');
        }

        $body = $response->getBody()->getContents();
        $data = json_decode($body);

        return new ValidationResponse(
            email: $data->email,
            user: $data->user,
            domain: $data->domain,
            code: ValidationResponseCode::from($data->code),
            message: ValidationResponseMessage::from($data->message),
            api: (int) $data->api,
            connections: (int) $data->connections,
        );
    }
}
