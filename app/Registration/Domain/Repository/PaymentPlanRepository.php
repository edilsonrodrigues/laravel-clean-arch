<?php

namespace App\Registration\Domain\Repository;

use App\Registration\Domain\Entity\PaymentPlan;

interface PaymentPlanRepository
{
    public function findById(int $id): ?PaymentPlan;
}
