<?php

namespace App\Repositories;

use App\Models\Questionnaire;
use App\Models\QuestionnaireInvitation;
use App\Repositories\Contracts\QuestionnaireRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuestionnaireRepository extends BaseRepository implements QuestionnaireRepositoryInterface
{
    /**
    * QuestionnaireRepository constructor.
    *
    * @param Questionnaire $questionnaire
    */
    public function __construct(
        Questionnaire $questionnaire
    ) {
        parent::__construct($questionnaire);
    }

    /**
     * Get questionnaire by token
     *
     * @param string $questionnaireId
     * @param string $token
     * @param array $with
     *
     * @return object
     */
    public function fetchByToken(string $questionnaireId, string $token, array $with = []): object
    {
        $questionnaireInvitation = QuestionnaireInvitation::where('questionnaire_id', $questionnaireId)
            ->where('token', $token)->first();

        throw_if(
            blank($questionnaireInvitation),
            ModelNotFoundException::class
        );

        return $this->fetch($questionnaireId, $with);
    }
}
