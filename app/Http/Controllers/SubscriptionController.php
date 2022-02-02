<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\MakeRegistration\InputData;
use App\Domain\UseCases\MakeRegistration\MakeRegistration;
use DateTime;
use Exception;
use Illuminate\Routing\Controller as BaseController;
use Infra\Repository\Database\PaymentPlanRepositoryDb;
use Infra\Repository\Database\PersonRepositoryDb;
use Infra\Repository\Database\SubscriptionRepositoryDb;
use Infra\Repository\Database\VoucherRepositoryDb;

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
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
