<?php

namespace App\Registration\Infra\Repository\Database;

use App\Registration\Domain\Entity\Person;
use App\Registration\Domain\Repository\PersonRepository;
use App\Shared\Infra\Models\Pessoa;

class PersonRepositoryDb implements PersonRepository
{
    public function findById(int $id): ?Person
    {
        $record = Pessoa::find($id);
        $person = new Person;

        $person->id = $record->id;
        $person->name = $record->nome;
        $person->email = $record->email;

        return $person;
    }
}
