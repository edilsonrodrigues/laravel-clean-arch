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
    public function registration()
    {
        try {
            $dateTime = new DateTime;
            $inputData = new InputData;

            $useCase = new MakeRegistration(
                new PersonRepositoryDb,
                new PaymentPlanRepositoryDb,
                new SubscriptionRepositoryDb(
                    new PersonRepositoryDb,
                    new VoucherRepositoryDb
                )
            );

            $inputData->personId = request()->get('personId');
            $inputData->paymentPlanId = request()->get('paymentPlanId');
            $inputData->createdAt = $dateTime->format('Y-m-d H:i:s');
            $output = $useCase->execute($inputData);

            return response()->json(['data' => $output]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 400);
        }
    }
}
