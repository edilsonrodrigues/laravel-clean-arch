<?php

namespace App\Registration\Domain\Exception;

use DomainException;

final class InvalidVoucherException extends DomainException
{
    public static function voucherIsNotValid(): self
    {
        return new self(
            'Voucher nao encontrado'
        );
    }
}
