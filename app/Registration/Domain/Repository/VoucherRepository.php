<?php

namespace App\Registration\Domain\Repository;

use App\Registration\Domain\Entity\Voucher;

interface VoucherRepository
{
    public function findByVoucherCode(string $voucherCode): ?Voucher;
    public function findById(int $id): ?Voucher;
}
