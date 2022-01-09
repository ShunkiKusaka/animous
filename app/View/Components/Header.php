<?php

namespace App\View\Components;

use App\Models\PrimaryCategory;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $user = Auth::user();

        $categories = PrimaryCategory::query()
            ->with([
                'secondaryCategories' => function ($query) {
                    $query->orderBy('sort_no');
                }
            ])
            ->orderBy('sort_no')
            ->get();

        return view('components.header')
            ->with('user', $user)//ユーザの情報を取得してbladeに渡す
            ->with('categories', $categories);
    }
}
