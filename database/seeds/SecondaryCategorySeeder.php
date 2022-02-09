<?php

use Illuminate\Database\Seeder;
use App\Models\SecondaryCategory;

class SecondaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // factory(SecondaryCategory::class)->create([
        //     'id'                  => 1,
        //     'name'                => 'トップス',
        //     'sort_no'             => 1,
        //     'primary_category_id' => 1,
        // ]);
        // factory(SecondaryCategory::class)->create([
        //     'id'                  => 2,
        //     'name'                => 'ジャケット/アウター',
        //     'sort_no'             => 2,
        //     'primary_category_id' => 1,
        // ]);
        // factory(SecondaryCategory::class)->create([
        //     'id'                  => 3,
        //     'name'                => 'パンツ',
        //     'sort_no'             => 3,
        //     'primary_category_id' => 1,
        // ]);
        // factory(SecondaryCategory::class)->create([
        //     'id'                  => 4,
        //     'name'                => 'トップス',
        //     'sort_no'             => 4,
        //     'primary_category_id' => 2,
        // ]);
        // factory(SecondaryCategory::class)->create([
        //     'id'                  => 5,
        //     'name'                => 'ジャケット/アウター',
        //     'sort_no'             => 5,
        //     'primary_category_id' => 2,
        // ]);
        // factory(SecondaryCategory::class)->create([
        //     'id'                  => 6,
        //     'name'                => '靴',
        //     'sort_no'             => 6,
        //     'primary_category_id' => 2,
        // ]);
        // factory(SecondaryCategory::class)->create([
        //     'id'                  => 7,
        //     'name'                => 'ベビー服（男の子用）',
        //     'sort_no'             => 7,
        //     'primary_category_id' => 3,
        // ]);
        // factory(SecondaryCategory::class)->create([
        //     'id'                  => 8,
        //     'name'                => 'ベビー服（女の子用）',
        //     'sort_no'             => 8,
        //     'primary_category_id' => 3,
        // ]);
        // factory(SecondaryCategory::class)->create([
        //     'id'                  => 9,
        //     'name'                => 'キッズ服（男の子用）',
        //     'sort_no'             => 9,
        //     'primary_category_id' => 3,
        // ]);
        // factory(SecondaryCategory::class)->create([
        //     'id'                  => 10,
        //     'name'                => 'キッズ服（女の子用）',
        //     'sort_no'             => 10,
        //     'primary_category_id' => 3,
        // ]);
        // factory(SecondaryCategory::class)->create([
        //     'id'                  => 11,
        //     'name'                => 'その他',
        //     'sort_no'             => 11,
        //     'primary_category_id' => 4,
        // ]);

        //犬
        factory(SecondaryCategory::class)->create([
            'id'                  => 1,
            'name'                => '大型犬',
            'sort_no'             => 1,
            'primary_category_id' => 1,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 2,
            'name'                => '中型犬',
            'sort_no'             => 2,
            'primary_category_id' => 1,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 3,
            'name'                => '小型犬',
            'sort_no'             => 3,
            'primary_category_id' => 1,
        ]);

        //猫
        factory(SecondaryCategory::class)->create([
            'id'                  => 4,
            'name'                => '大型',
            'sort_no'             => 4,
            'primary_category_id' => 2,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 5,
            'name'                => '中型',
            'sort_no'             => 5,
            'primary_category_id' => 2,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 6,
            'name'                => '小型',
            'sort_no'             => 6,
            'primary_category_id' => 2,
        ]);

        //鳥
        factory(SecondaryCategory::class)->create([
            'id'                  => 7,
            'name'                => '大型',
            'sort_no'             => 7,
            'primary_category_id' => 3,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 8,
            'name'                => '中型',
            'sort_no'             => 8,
            'primary_category_id' => 3,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 9,
            'name'                => '小型',
            'sort_no'             => 9,
            'primary_category_id' => 3,
        ]);

        //その他の哺乳類
        factory(SecondaryCategory::class)->create([
            'id'                  => 10,
            'name'                => '大型',
            'sort_no'             => 10,
            'primary_category_id' => 4,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 11,
            'name'                => '中型',
            'sort_no'             => 11,
            'primary_category_id' => 4,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 12,
            'name'                => '小型',
            'sort_no'             => 12,
            'primary_category_id' => 4,
        ]);

        //魚類
        factory(SecondaryCategory::class)->create([
            'id'                  => 13,
            'name'                => '大型',
            'sort_no'             => 13,
            'primary_category_id' => 5,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 14,
            'name'                => '中型',
            'sort_no'             => 14,
            'primary_category_id' => 5,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 15,
            'name'                => '小型',
            'sort_no'             => 15,
            'primary_category_id' => 5,
        ]);

        //爬虫類
        factory(SecondaryCategory::class)->create([
            'id'                  => 16,
            'name'                => '大型',
            'sort_no'             => 16,
            'primary_category_id' => 6,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 17,
            'name'                => '中型',
            'sort_no'             => 17,
            'primary_category_id' => 6,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 18,
            'name'                => '小型',
            'sort_no'             => 18,
            'primary_category_id' => 6,
        ]);

        //その他
        factory(SecondaryCategory::class)->create([
            'id'                  => 19,
            'name'                => '大型',
            'sort_no'             => 19,
            'primary_category_id' => 7,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 20,
            'name'                => '中型',
            'sort_no'             => 20,
            'primary_category_id' => 7,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 21,
            'name'                => '小型',
            'sort_no'             => 21,
            'primary_category_id' => 7,
        ]);
    }
}
