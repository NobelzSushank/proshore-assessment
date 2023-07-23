<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'answer',
        'subject',
    ];

    /**
     * The questionnaire that belong to the questions.
     */
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Questionnaire::class, 'questionnaire_question', 'question_id', 'questionnaire_id');
    }
}
