<?php

namespace Hollow3464\MailtesterNinjaPsr;

final class ValidationResponse
{
    public function __construct(
        public readonly string $email,
        public readonly string $user,
        public readonly string $domain,
        public readonly ValidationResponseCode $code,
        public readonly ValidationResponseMessage $message,
        public readonly int $api,
        public readonly int $connections,
    ) {}
}
