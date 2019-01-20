<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-19 18:57
 */

namespace App\Http\Controllers;


use App\Units\Analytics\CollectedData;
use App\Units\Analytics\GoogleAnalytics;
use App\Units\Tools\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AnalyticsController extends Controller
{
    public function index(Request $request) {
        $data = new CollectedData();

        $data->ua = $request->header('User-Agent');
        $data->ip = $request->ip();
        $data->language = $request->getLanguages()[0];
        $data->clientId = Cookie::has('clientId') ? Cookie::get('clientId') : Uuid::v4();
        $data->refer = $request->post('refer');
        $data->link = $request->post('link');
        $data->screen = $request->post('screen');


        GoogleAnalytics::sent($data);
        return response('')->cookie('clientId', $data->clientId, 5256000);
    }
}