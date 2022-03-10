<?php

namespace App\Registration\Domain\Repository;

use App\Registration\Domain\Entity\Subscription;

interface SubscriptionRepository
{
    public function findById(int $id): ?Subscription;
    public function subscribe(Subscription $subscription): int;
}
