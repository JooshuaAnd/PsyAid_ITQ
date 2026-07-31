<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDetailedMseToPsychologistReview extends Migration
{
    public function up()
    {
        $fields = [
            'mse_appearance_note'  => ['type' => 'TEXT', 'null' => true],
            'mse_behavior_note'    => ['type' => 'TEXT', 'null' => true],
            'mse_speech_note'      => ['type' => 'TEXT', 'null' => true],
            'mse_mood_note'        => ['type' => 'TEXT', 'null' => true],
            'mse_affect_note'      => ['type' => 'TEXT', 'null' => true],
            'mse_thought_note'     => ['type' => 'TEXT', 'null' => true],
            'mse_orientation_note' => ['type' => 'TEXT', 'null' => true],
            'mse_insight_note'     => ['type' => 'TEXT', 'null' => true],
            'mse_perception'       => ['type' => 'TEXT', 'null' => true],
            'mse_perception_note'  => ['type' => 'TEXT', 'null' => true],
            'risk_assessment'      => ['type' => 'TEXT', 'null' => true],
            'risk_assessment_note' => ['type' => 'TEXT', 'null' => true],
        ];

        $this->forge->addColumn('psychologist_review', $fields);
    }

    public function down()
    {
        $fields = [
            'mse_appearance_note', 'mse_behavior_note', 'mse_speech_note', 
            'mse_mood_note', 'mse_affect_note', 'mse_thought_note', 
            'mse_orientation_note', 'mse_insight_note', 'mse_perception', 
            'mse_perception_note', 'risk_assessment', 'risk_assessment_note'
        ];
        $this->forge->dropColumn('psychologist_review', $fields);
    }
}
