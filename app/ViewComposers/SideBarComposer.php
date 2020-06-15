<?php

namespace App\ViewComposers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\View\View;

class SideBarComposer
{
    public function compose(View $view)
    {
        /**
         * Bind data to the view.
         *
         * @param View $view
         */

        $tags = Tag::all();
        $view->with(['tags' => $tags]);
    }
}
