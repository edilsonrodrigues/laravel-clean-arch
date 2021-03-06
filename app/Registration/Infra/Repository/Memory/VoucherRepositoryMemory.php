<?php

namespace App\Infra\Repository\Memory;

use App\Registration\Domain\Entity\Voucher;
use App\Registration\Domain\Repository\VoucherRepository;

class VoucherRepositoryMemory implements VoucherRepository
{
    public function __construct(private array $storage = [])
    {
        $voucher = new Voucher;
        $voucher->id = 1;
        $voucher->price = 20;
        $voucher->code = "DESCONTO";
        $this->storage[] =  $voucher;
    }

    public function findByVoucherCode(string $code): ?Voucher
    {
        $voucher = array_filter(
            $this->storage,
            function ($voucher) use ($code) {
                return $voucher->code == $code;
            }
        );

        return count($voucher) ? current($voucher) : null;
    }
    public function findById(int $id): ?Voucher
    {
        $voucher = array_filter(
            $this->storage,
            function ($voucher) use ($id) {
                return $voucher->id == $id;
            }
        );

        return count($voucher) ? current($voucher) : null;
    }
}
