<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([

            [
                'question_id' => '1',
                'user_id' => '1',
                'answer' => 'Color shade variation
                            Crease marks
                            After wash hole
                            Very dark and very light
                            Bleach spot
                            Bottom hem and course edge destroy
                            Running shade
                            Over blasting/low blasting
                            Over grinding/low grinding
                            Bad smell due to poor neutralization
                            Poor hand feel
                            To high hairiness
                            Poor brightness
                            High or low effect/abrasion on garments
                            Spot on garments
                            Out of range/ level of ph value of garments',
                'up_vote' => '34',
                'down_vote' => '23',
                'is_accepted' => '1',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ],  
            [
                'question_id' => '7',
                'user_id' => '1',
                'answer' => 'Washing machine ( No of M/c -10)
                            Dryer machine (No of M/c -10): gas dryer-09 and Steam dryer-01
                            Sample Machine (No of M/c-02)
                            Hydro (No of M/c -03)
                            Spray gun (No of M/c -02)',
                'up_vote' => '34',
                'down_vote' => '23',
                'is_accepted' => '1',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ],      
            [
                'question_id' => '7',
                'user_id' => '1',
                'answer' => 'The first purpose is to remove dirt, dust, impurities of garments thus achieve wash look appearance and softness.
                                The other purpose is to bring faded look, old look, tinted or over dyed affect.
                                To increase color fastness, wash fastness properties no possibility of further shrinkage of wash garments.',
                'up_vote' => '34',
                'down_vote' => '23',
                'is_accepted' => '0',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ],  
            [
                'question_id' => '2',
                'user_id' => '1',
                'answer' => 'Sodium mete bi sulphite
                            per oxide
                            Caustic soda
                            (Soda ash
                            LV (pocket clear)
                            Bleach Kci
                            Caustic potash
                            Phosphoric acid
                            Pumice stone
                            Optical Brightening agent (3 types: Red, blue, yellow )
                            Sodium hypo sulphite
                            Sodium bi carbonate
                            Enzyme (Acid, Neutral , SL enzyme)
                            Acetic acid
                            Softener
                            Desizing agent
                            Potassium per manganate
                            Micro emulsion silicon
                            Buffer, stabilizer, fixing agent, catanizer , resin, anti staining agent
                            Dye for tinting or over dyeing',
                'up_vote' => '34',
                'down_vote' => '23',
                'is_accepted' => '0',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ],   
            
            [
                'question_id' => '5',
                'user_id' => '3',
                'answer' => 'Polyester is created in highly controlled factory settings, using toxic chemicals at high temperatures. In addition, the dye is added when the fabric is in a liquid state. Using Rit or reactive dyes would be like trying to dye a plastic bag. The dye just does not stick. Similarly, acetate cannot be dyed.',
                'up_vote' => '34',
                'down_vote' => '23',
                'is_accepted' => '0',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ],
            [
                'question_id' => '2',
                'user_id' => '1',
                'answer' => 'Sodium mete bi sulphite
                            per oxide
                            Caustic soda
                            (Soda ash
                            LV (pocket clear)
                            Bleach Kci
                            Caustic potash
                            Phosphoric acid
                            Pumice stone
                            Optical Brightening agent (3 types: Red, blue, yellow )
                            Sodium hypo sulphite
                            Sodium bi carbonate
                            Enzyme (Acid, Neutral , SL enzyme)
                            Acetic acid
                            Softener
                            Desizing agent
                            Potassium per manganate
                            Micro emulsion silicon
                            Buffer, stabilizer, fixing agent, catanizer , resin, anti staining agent
                            Dye for tinting or over dyeing',
                'up_vote' => '34',
                'down_vote' => '23',
                'is_accepted' => '0',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ],
            [
                'question_id' => '4',
                'user_id' => '3',
                'answer' => 'The first purpose is to remove dirt, dust, impurities of garments thus achieve wash look appearance and softness.
                            The other purpose is to bring faded look, old look, tinted or over dyed affect.
                            To increase color fastness, wash fastness properties no possibility of further shrinkage of wash garments.',
                'up_vote' => '34',
                'down_vote' => '23',
                'is_accepted' => '0',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ],
            [
                'question_id' => '3',
                'user_id' => '3',
                'answer' => 'The first purpose is to remove dirt, dust, impurities of garments thus achieve wash look appearance and softness.
                            The other purpose is to bring faded look, old look, tinted or over dyed affect.
                            To increase color fastness, wash fastness properties no possibility of further shrinkage of wash garments.',
                'up_vote' => '34',
                'down_vote' => '23',
                'is_accepted' => '0',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ],
            [
                'question_id' => '1',
                'user_id' => '3',
                'answer' => 'Color shade variation
                            Crease marks
                            After wash hole
                            Very dark and very light
                            Bleach spot
                            Bottom hem and course edge destroy
                            Running shade
                            Over blasting/low blasting
                            Over grinding/low grinding
                            Bad smell due to poor neutralization
                            Poor hand feel
                            To high hairiness
                            Poor brightness
                            High or low effect/abrasion on garments
                            Spot on garments
                            Out of range/ level of ph value of garments',
                'up_vote' => '34',
                'down_vote' => '23',
                'is_accepted' => '0',
                'status' => '10',
                'created_at' => '2020-02-23 00:00:00'
            ],

        ]);
    }
}
