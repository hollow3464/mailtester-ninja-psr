<?php

namespace Hollow3464\MailtesterNinjaPsr;

enum ValidationResponseCode: string
{
    case VALID = 'ok';
    case INVALID = 'ko';
    case UNVERIFIABLE = 'mb';
}
