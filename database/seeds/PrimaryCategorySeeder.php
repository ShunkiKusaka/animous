<?php

use Illuminate\Database\Seeder;
use App\Models\PrimaryCategory;

class PrimaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(PrimaryCategory::class)->create([
        //     'id'      => 1,
        //     'name'    => 'レディース',
        //     'sort_no' => 1,
        // ]);
        // factory(PrimaryCategory::class)->create([
        //     'id'      => 2,
        //     'name'    => 'メンズ',
        //     'sort_no' => 2,
        // ]);
        // factory(PrimaryCategory::class)->create([
        //     'id'      => 3,
        //     'name'    => 'ベビー・キッズ',
        //     'sort_no' => 3,
        // ]);
        // factory(PrimaryCategory::class)->create([
        //     'id'      => 4,
        //     'name'    => 'その他',
        //     'sort_no' => 4,
        // ]);

        factory(PrimaryCategory::class)->create([
            'id'      => 1,
            'name'    => '犬',
            'sort_no' => 1,
        ]);

        factory(PrimaryCategory::class)->create([
            'id'      => 2,
            'name'    => '猫',
            'sort_no' => 2,
        ]);

        factory(PrimaryCategory::class)->create([
            'id'      => 3,
            'name'    => '鳥',
            'sort_no' => 3,
        ]);

        factory(PrimaryCategory::class)->create([
            'id'      => 4,
            'name'    => 'その他の哺乳類',
            'sort_no' => 4,
        ]);

        factory(PrimaryCategory::class)->create([
            'id'      => 5,
            'name'    => '魚類',
            'sort_no' => 5,
        ]);

        factory(PrimaryCategory::class)->create([
            'id'      => 6,
            'name'    => '爬虫類',
            'sort_no' => 6,
        ]);

        factory(PrimaryCategory::class)->create([
            'id'      => 7,
            'name'    => 'その他',
            'sort_no' => 7,
        ]);
    }
}
