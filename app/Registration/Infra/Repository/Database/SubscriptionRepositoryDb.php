<?php

namespace App\Registration\Infra\Repository\Database;

use App\Registration\Domain\Entity\Subscription;
use App\Registration\Domain\Repository\PersonRepository;
use App\Registration\Domain\Repository\SubscriptionRepository;
use App\Registration\Domain\Repository\VoucherRepository;
use App\Shared\Infra\Models\Inscricoes;

class SubscriptionRepositoryDb implements SubscriptionRepository
{
    public function __construct(private PersonRepository $personRepo, private VoucherRepository $voucherRepo)
    {
    }
    public function findById(int $id): ?Subscription
    {

        $subscription = new Subscription;

        $record = Inscricoes::find($id);
        $subscription->id = $record->id;
        $subscription->person = $this->personRepo->findById($record->pessoa_id);
        $subscription->status = $record->status;
        $subscription->createdAt = $record->criado_em;
        $subscription->voucher = $this->voucherRepo->findById($record->voucher_id);
        $subscription->price = '';
        $subscription->voucherAppliedAt = '';

        return $subscription;
    }

    public function subscribe(Subscription $subscription): int
    {
        $data = [];
        $data['pessoa_id'] =  $subscription->person->id;
        $data['plano_pagamento_id'] = $subscription->paymentPlan->id;
        $data['criado_em'] = $subscription->createdAt;
        return Inscricoes::create($data);
    }
}
