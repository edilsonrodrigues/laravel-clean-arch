<?php

namespace Infra\Repository\Database;

use App\Domain\Entity\Activity;
use App\Domain\Entity\ActivitySchedule;
use App\Domain\Entity\PaymentPlan;
use App\Domain\Entity\ProfessionalCategory;
use App\Domain\Repository\PaymentPlanRepository;
use App\Models\AgendaAtividades;
use App\Models\Atividades;
use App\Models\CategoriasCentrosCustos;
use App\Models\PlanosPagamento;

class PaymentPlanRepositoryDb implements PaymentPlanRepository
{
    public function findById(int $id): ?PaymentPlan
    {
        $paymentPlan = new PaymentPlan;
        $professionalCategory = new ProfessionalCategory;
        $activitySchedule = new ActivitySchedule;
        $activity = new Activity;

        $record = PlanosPagamento::find($id);
        $recordProfessionalCategory = CategoriasCentrosCustos::find($record->categoria_centro_custo_id);
        $recordActivitySchedule = AgendaAtividades::find($record->agenda_atividade_id);
        $recordActivity = Atividades::find($recordActivitySchedule->atividade_id);

        //categoria profissional
        $professionalCategory->id = $recordProfessionalCategory->id;
        $professionalCategory->description = $recordProfessionalCategory->descricao;

        //atividade
        $activity->id = $recordActivity->id;
        $activity->description = $recordActivity->descricao;

        //agenda atividade
        $activitySchedule->id = $recordActivitySchedule->id;
        $activitySchedule->description = $recordActivitySchedule->descricao;
        $activitySchedule->activity = $activity;

        //plano de pagamento
        $paymentPlan->id = $record->id;
        $paymentPlan->professionalCategory = $professionalCategory;
        $paymentPlan->activitySchedule = $activitySchedule;

        return $paymentPlan;
    }
}
