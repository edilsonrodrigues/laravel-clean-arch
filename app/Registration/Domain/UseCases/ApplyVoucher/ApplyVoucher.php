<?php

namespace App\Registration\Domain\UseCases\ApplyVoucher;

use App\Registration\Domain\Exception\InvalidVoucherException;
use App\Registration\Domain\Repository\SubscriptionRepository;
use App\Registration\Domain\Repository\VoucherRepository;

class ApplyVoucher
{
    public function __construct(private VoucherRepository $voucherRepo, private SubscriptionRepository $subscriptionRepo)
    {
    }

    public function execute(InputData $inputData): OutputData
    {
        $subscription = $this->subscriptionRepo->findById($inputData->subscriptionId);

        $voucher =  $this->voucherRepo->findByVoucherCode($inputData->voucherCode);

        if (!$voucher) {
            throw InvalidVoucherException::voucherIsNotValid();
        }

        $subscription->applyVoucher($voucher);

        $outputData = new OutputData;
        $outputData->id = $voucher->id;
        $outputData->priceDiscount = $voucher->price;
        $outputData->subscriptionId = $subscription->id;
        $outputData->priceWithDiscount = $subscription->price;
        return $outputData;
    }
}
