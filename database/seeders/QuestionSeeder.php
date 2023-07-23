<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(public_path('questions.json'));
        $questions = json_decode($json, true);
        
        if(is_array($questions)){
            $questions = array_map(function ($question) {
                return [
                    'id' => Str::uuid(),
                    'question' => $question['question'],
                    'option_a' => $question['option_a'],
                    'option_b' => $question['option_b'],
                    'option_c' => $question['option_c'],
                    'option_d' => $question['option_d'],
                    'answer' => $question['answer'],
                    'subject' => $question['subject'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $questions);

            DB::table('questions')->insert($questions);
        }
    }
}
