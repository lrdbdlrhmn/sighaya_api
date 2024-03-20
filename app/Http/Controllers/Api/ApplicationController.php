<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
class ApplicationController extends Controller
{

    public function all_reports($is_notifications,$request,$current_user)
    {
        $req = $request->all();
        
        $appLanguage = App::getLocale();
        
        $l_name = $appLanguage == 'ar' ? 'name' : 'name_fr';
        //$report_select = "reports.*, users.first_name, users.phone, states.#{l_name} as state_name, cities.#{l_name} as city_name, regions.#{l_name} as region_name";
        
        if (!$is_notifications) {

            $reports = Report::where('user_id', $current_user->id);
            $reports = $this->reports_filtering($req,$reports);
        
            $reports = $reports->join('users as user','user.id','reports.user_id')->leftJoin('users as manager','manager.id','reports.manager_id')->leftJoin('users as technical','technical.id','reports.technical_id')->select('reports.*','user.phone','user.first_name','technical.first_name as technical_name','manager.first_name as manager_name','states.name as state_name','cities.name as city_name','regions.name as region_name')->where('reports.user_id',$current_user->id)->get();
            
            return $reports;

        }
        

        if ($current_user['user_type'] == 'user') {
            # code...
          return [];
        }
        $order_by = 'asc';
        if (!empty($req['order_by'])) {
            # code...
            $order_by = $req['order_by'];
        }
        if ($order_by == 'score') {
            # code...
            //((SELECT COUNT(*) from reports as c_reports WHERE c_reports.user_id = reports.user_id AND c_reports.status != 'fake') - (SELECT COUNT(*) from reports as c_reports WHERE c_reports.user_id = reports.user_id AND c_reports.status = 'fake')) DESC
        }
        $reports = Report::orderBy('reports.created_at', $order_by);

        if ($current_user['user_type'] == 'manager') {
            //$regions = DB::table('manager_regions')->join('regions','regions.id','manager_regions.region_id')->join('managers','managers.id','manager_regions.manager_id')->where('managers.user_id',$current_user['id'])->pluck('regions.id');
            
            $reports = $reports->where('reports.region_id',$current_user['region_id']);
        }
        if ($current_user['user_type'] == 'technical') {
          $reports =  $reports->where('reports.status', 'technical')->where('reports.technical_id',$current_user['id']);
        }
        $reports = $this->reports_filtering($req,$reports);
        $reports = $reports->join('users as user','user.id','reports.user_id')->leftJoin('users as manager','manager.id','reports.manager_id')->leftJoin('users as technical','technical.id','reports.technical_id')->select('reports.*','user.phone','user.first_name','technical.first_name as technical_name','manager.first_name as manager_name','states.name as state_name','cities.name as city_name','regions.name as region_name')->get();
        //->select('reports.*','states.name as state_name','cities.name as city_name','regions.name as region_name')
        //
        return $reports;

    //$region_ids = $current_user->regions.pluck('region_id') + [$current_user->region_id];
    //$reports.where('region_id',$region_ids)->where('status', 'new').order_by_score($params['order_by']).limit(70);
    }
    //
    public function reports_filtering($request,$reports)
    {
        $reports = $reports->join('cities','reports.city_id','cities.id')->join('states','reports.state_id','states.id')->join('regions','reports.region_id','regions.id');
        if (isset($request['start_date'])) {
            # code...
            $from = $request['start_date']."T00:00:00.000000Z";
            //$from = date_timestamp_get($from);
            $reports = $reports->where('reports.created_at','>=',$from);
        }
        if (isset( $request['end_date'])) {
            # code...
            $to = $request['end_date']."T00:00:00.000000Z";
            //$to = date_timestamp_get($to);
            $reports = $reports->where('reports.created_at','<=', $to);
        }

        if (isset($request['region_id'])) {
            # code...
            $reports = $reports->where('reports.region_id', $request['region_id']);
        }

        if (isset($request['city_id'])) {
            # code...
            $reports = $reports->where('reports.city_id', $request['city_id']);
        }

        if (isset($request['state_id'])) {
            # code...
            $reports = $reports->where('reports.state_id', $request['state_id']);
        }

        return $reports;
    # code...
    }
    /*
    public function manager_only()
    {
        $current_user = Auth::user();
        if ($current_user['type_user'] == 'manager') {
            # code...
            return ['status' => 'error',
                    'message' => 'manager_only'
                ];
        }
    # code...
    }
    */
}
