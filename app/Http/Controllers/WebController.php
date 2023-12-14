<?php



namespace App\Http\Controllers;



use App\Models\SiteSetting;

use Cache;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Foundation\Bus\DispatchesJobs;

use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Request;



class WebController extends BaseController

{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function __construct()

    {

        $checkAmp = isset($_GET['amp']) ? true : false;



        define('IS_AMP', $checkAmp);

        if (IS_AMP)

            define('TEMPLATE', 'web.layout-amp');

        else

            define('TEMPLATE', 'web.layout');

        define('IS_MOBILE', isMobile());


    }


}

