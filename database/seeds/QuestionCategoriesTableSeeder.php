<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_categories')->insert([
        [
          'title' => 'Apparel',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '100'
        ],
        [
          'title' => 'Assorted',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '100'
        ],
        [
          'title' => 'Embroidery',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '100'
        ],
        [
          'title' => 'Fabric',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '100'
        ],
        [
          'title' => 'Fiber',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '100'
        ],
        [
          'title' => 'Finishing',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '100'
        ],
        [
         'title' => 'Machine',
         'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
         'status' => '0',
         'total_questions' => '84'
        ],

        [
          'title' => 'Manmade Fiber',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '30'
        ],
        [
          'title' => 'Natural Fiber',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '30'
        ],
        [
          'title' => 'Pre-Production',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '30'
        ],
        [
          'title' => 'Production',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '30'
        ],
        [
          'title' => 'Ring-Spinning',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '30'
        ],
        [
          'title' => 'Tools',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '30'
        ],
        [
          'title' => 'Weaving',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '30'
        ],
        [
          'title' => 'Yarn',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10',
          'total_questions' => '30'
        ],

      ]);
    }
}
