<?php

namespace App\Listeners;

use App\Enums\RoleTypeEnum;
use App\Events\QuestionnaireInvitationEvent;
use App\Mail\QuestionnaireInvitation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendQuestionnaireInvitaions implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(QuestionnaireInvitationEvent $questionnaireInvitationEvent): void
    {
        $role_id = Role::where('slug', RoleTypeEnum::STUDENT->value)->value('id');
        $questionnaire = $questionnaireInvitationEvent->questionnaire;
        $students = User::where('role_id', $role_id)->get();

        Log::info('SendQuestionnaireInvitaions');
        Log::info('role_id');
        Log::info($role_id);
        Log::info('****************************');

        foreach($students as $student)
        {
            Log::info('student');
        Log::info($student);
        Log::info('****************************');
            $uniqueToken = Str::random(13);
            $url = route('questionnaire.invitation', ['questionnaire' => $questionnaire->id, 'token' => $uniqueToken]);

            DB::table('questionnaire_invitations')
                ->insert([
                    'token' => $uniqueToken,
                    'user_id' => $student->id,
                    'questionnaire_id' => $questionnaire->id
                ]);

            Mail::to($student->email)->send(new QuestionnaireInvitation($questionnaire, $url, $uniqueToken));
        }
    }
}
