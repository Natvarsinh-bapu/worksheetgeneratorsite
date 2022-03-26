<?php

use Illuminate\Database\Seeder;
use App\AnswerType;

class AnswerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answer_types = [
            'Options (વિકલ્પો)',
            'Yes / No (હા / ના)',
            'Paragraph (ફકરો)',
            '✔ / ✘ (ખરુ / ખોટુ)',
            '⇄ (જોડકા)'
        ];

        foreach($answer_types as $answer_type){
            AnswerType::create([
                'type' => $answer_type
            ]);
        }
    }
}
