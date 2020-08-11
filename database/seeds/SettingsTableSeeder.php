<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('settings')->insert([

      [
        'code_name' => 'Jobs',
        'code_label' => '3d442',
        'code_value' => '3dd442',
        'code_descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
        'status' => '1'
      ],


      [
      'code_name' => 'Classifieds',
      'code_label' => '3d4r42',
        'code_value' => '3dd442',
      'code_descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
      'status' => '1'
      ],

      [
        'code_name' => 'Trainings',
        'code_label' => '3d4442',
        'code_value' => '3dd442',
        'code_descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
        'status' => '1'
      ],
      [
        'code_name' => 'unique_view_interval',
        'code_label' => 'Unique View Interval',
        'code_value' => '72',
        'code_descr' => 'View will count after 72 hours from users previous view.',
        'status' => '1'
      ],
      [
        'code_name' => 'downvote_required_score',
        'code_label' => 'Score Required For DownVote',
        'code_value' => '100',
        'code_descr' => 'DownVote will count if total score greater equal 100',
        'status' => '1'
      ],
      [
        'code_name' => 'upvote_score_count',
        'code_label' => 'UpVote Score Count',
        'code_value' => '1',
        'code_descr' => 'Upvote will count form 0 and increase 10 at one click',
        'status' => '1'
      ], 
      [
        'code_name' => 'downvote_score_count',
        'code_label' => 'DownVote Score Count',
        'code_value' => '1',
        'code_descr' => 'Downvote will count form 0 and increase 5 at one click',
        'status' => '1'
      ],                    
    ]);
  }
}
