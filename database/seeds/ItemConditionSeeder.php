<?php

use Illuminate\Database\Seeder;
use App\Models\ItemCondition;

class ItemConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ItemCondition::class)->create([
            'id'      => 1,
            'name'    => '状態・体調良好',
            'sort_no' => 1,
        ]);

        factory(ItemCondition::class)->create([
            'id'      => 2,
            'name'    => 'やや体調がすぐれない',
            'sort_no' => 2,
        ]);

        factory(ItemCondition::class)->create([
            'id'      => 3,
            'name'    => '体調がすぐれない(検査なし)',
            'sort_no' => 3,
        ]);

        factory(ItemCondition::class)->create([
            'id'      => 4,
            'name'    => '持病持ちで、病院に通っている',
            'sort_no' => 4,
        ]);

        factory(ItemCondition::class)->create([
            'id'      => 5,
            'name'    => '持病持ち(病院通いなし)',
            'sort_no' => 5,
        ]);
    }
}
