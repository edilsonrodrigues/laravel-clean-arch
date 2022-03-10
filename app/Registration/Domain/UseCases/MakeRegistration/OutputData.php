<?php

namespace App\Registration\Domain\UseCases\MakeRegistration;

class OutputData
{
    public int $id;
    public int $personId;
    public int $paymentPlanId;
    public string $status;
}
