<?php

namespace Hollow3464\MailtesterNinjaPsr;

enum ValidationResponseMessage: string
{
    case ACCEPTED = 'Acepted';
    case LIMITED = 'Limited';
    case REJECTED = 'Rejected';
    case CATCH_ALL = 'Catch-All';
    case NO_MX = 'No Mx';
    case MX_ERROR = 'Mx Error';
    case TIMEOUT = 'Timeout';
    case SPAM_BLOCK = 'SPAM Block';
}
