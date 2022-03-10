<?php

namespace App\Registration\Domain\Entity;

use App\Registration\Domain\Entity\Test;
use App\Shared\Domain\EntityBase;

class ActivitySchedule extends EntityBase
{
    public int $id;
    public string $description;
    public Activity $activity;
    public Test $test;
}
