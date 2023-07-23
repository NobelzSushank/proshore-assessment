<?php

namespace App\Jobs;

use App\Events\QuestionnaireInvitationEvent;
use App\Models\Questionnaire;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendQuestionnaireInvitationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $questonnaire;

    /**
     * Create a new job instance.
     *
     * @param Questionnaire $questionnaire
     *
     * @return void
     */
    public function __construct(Questionnaire $questionnaire)
    {
        $this->questonnaire = $questionnaire;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Log::info('SendQuestionnaireInvitationsJob');
        Log::info($this->questonnaire);
        Log::info('****************************');
        event(new QuestionnaireInvitationEvent($this->questonnaire));
    }
}
