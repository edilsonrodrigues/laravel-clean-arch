<?php

namespace App\Infra\Repository\Database;

use App\Domain\Entity\Person;
use App\Domain\Repository\PersonRepository;
use App\Infra\Models\Pessoa;

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
