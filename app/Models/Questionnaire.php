<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Questionnaire extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'title',
        'expiry_date'
    ];

    protected $casts = [
        'expiry_date' => 'date'
    ];

    /**
     * The questions that belong to the questionnaire.
     */
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'questionnaire_question', 'questionnaire_id', 'question_id');
    }
}
