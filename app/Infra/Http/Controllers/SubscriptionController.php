<?php

namespace App\Infra\Http\Controllers;

use App\Domain\UseCases\MakeRegistration\InputData;
use App\Domain\UseCases\MakeRegistration\MakeRegistration;
use DateTime;
use Exception;
use Illuminate\Routing\Controller as BaseController;
use App\Infra\Repository\Database\PaymentPlanRepositoryDb;
use App\Infra\Repository\Database\PersonRepositoryDb;
use App\Infra\Repository\Database\SubscriptionRepositoryDb;
use App\Infra\Repository\Database\VoucherRepositoryDb;

class SubscriptionController extends BaseController
{

    public function __construct(
        private PersonRepositoryDb $personRepositoryDb,
        private PaymentPlanRepositoryDb $paymentPlanRepositoryDb,
        private VoucherRepositoryDb $voucherRepositoryDb,
        private DateTime $dateTime,
        private InputData $inputData
    ) {
    }

    public function registration()
    {
        try {
            $useCase = new MakeRegistration(
                $this->personRepositoryDb,
                $this->paymentPlanRepositoryDb,
                new SubscriptionRepositoryDb(
                    $this->personRepositoryDb,
                    $this->voucherRepositoryDb
                )
            );

            $this->inputData->personId = request()->get('personId');
            $this->inputData->paymentPlanId = request()->get('paymentPlanId');
            $this->inputData->createdAt = $this->dateTime->format('Y-m-d H:i:s');
            $output = $useCase->execute($this->inputData);

            return response()->json(['data' => $output]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 400);
        }
    }
}
