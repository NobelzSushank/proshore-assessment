<?php

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface QuestionnaireRepositoryInterface extends BaseRepositoryInterface
{
    public function fetchByToken(string $questionnaireId, string $token, array $with = []): object;
}
