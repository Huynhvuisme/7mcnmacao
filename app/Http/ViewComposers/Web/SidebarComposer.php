<?php

namespace App\Http\ViewComposers\Web;

use App\Models\Nha_Cai;
use Illuminate\View\View;

class SidebarComposer
{
    public function compose(View $view)
    {
        $data['listNhaCai'] = Nha_Cai::where('type', 1)->orderBy(Nha_Cai::raw('order_by = 0'))->orderBy('order_by')->get();
        $view->with($data);
    }
}
