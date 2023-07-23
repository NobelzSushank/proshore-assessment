<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\Contracts\QuestionRepositoryInterface;
use App\Repositories\BaseRepository;

class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
{
    /**
    * QuestionRepository constructor.
    *
    * @param Question $question
    */
    public function __construct(
        Question $question
    ) {
        parent::__construct($question);
    }
}