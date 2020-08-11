<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([

            [
                'created_by' => '1',
                'question_category_id' => '1',
                'title' => 'What are the types Of washing faults?',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '32',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ],  
            [
                'created_by' => '3',
                'question_category_id' => '4',
                'title' => 'Which chemical cre used in washing plant?',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '32',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ], 
            [
                'created_by' => '2',
                'question_category_id' => '5',
                'title' => 'Which machines are used in washing plant?',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '32',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ], 
            [
                'created_by' => '2',
                'question_category_id' => '2',
                'title' => 'What are the purpose of washing?',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '32',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ], 
            [
                'created_by' => '3',
                'question_category_id' => '7',
                'title' => 'Why Polyester garments can not be dyed by mere mortals?',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '32',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00',
            ],    
            [
                'created_by' => '3',
                'question_category_id' => '3',
                'title' => 'How to choose a sewing machine',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '2',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ],    
            [
                'created_by' => '1',
                'question_category_id' => '3',
                'title' => 'What is a mechanical or an electrical model?',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '2',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ],         

        ]);
    }
}
