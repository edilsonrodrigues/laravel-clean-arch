<?php

namespace App\Registration\Infra\Repository\Database;

use App\Registration\Domain\Entity\Voucher;
use App\Registration\Domain\Repository\VoucherRepository;
use App\Shared\Infra\Models\Voucher as ModelVoucher;

class VoucherRepositoryDb implements VoucherRepository
{
    public function findByVoucherCode(string $voucherCode): ?Voucher
    {
        $record = ModelVoucher::select()->where('codigo', $voucherCode)->get();
        $voucher = new Voucher;

        $voucher->id = $record->id;
        $voucher->code = $record->codigo;
        $voucher->price = $record->desconto;

        return $voucher;
    }

    public function findById(int $id): ?Voucher
    {
        $record = ModelVoucher::find($id);
        $voucher = new Voucher;

        $voucher->id = $record->id;
        $voucher->code = $record->codigo;
        $voucher->price = $record->desconto;

        return $voucher;
    }
}
