<?php

namespace App\Registration\Domain\Repository;

use App\Registration\Domain\Entity\Person;

interface PersonRepository
{
    public function findById(int $id): ?Person;
}
