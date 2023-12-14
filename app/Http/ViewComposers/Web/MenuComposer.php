<?php



namespace App\Http\ViewComposers\Web;



use App\Models\Menu;

use Illuminate\View\View;



class MenuComposer

{

    public function compose(View $view)

    {

        $menu = Menu::get();

        $mainMenuPc = $menu->where('id','>=', 1)->find(1);

        $data = [];

        if (!empty($mainMenuPc)) {

            $data['mainMenuPc'] = json_decode($mainMenuPc->data, 1);

        }

        $mainMenuMobile = $menu->find(2);

        if (!empty($mainMenuMobile)) {

            $data['mainMenuMobile'] = json_decode($mainMenuMobile->data, 1);

        }
        $mainMenuMobile = $menu->find(2);

        if (!empty($mainMenuMobile)) {

            $data['mainMenuMobile'] = json_decode($mainMenuMobile->data, 1);

        }
        $danhMucChinh = $menu->find(4);

        if (!empty($danhMucChinh)) {

            $data['danhMucChinh'] = json_decode($danhMucChinh->data, 1);

        }
        $menuFooter = $menu->find(5);

        if (!empty($menuFooter)) {

            $data['menuFooter'] = json_decode($menuFooter->data, 1);

        }
        $view->with($data);

    }

}

