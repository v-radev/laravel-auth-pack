<?php namespace App\Clusters\AuthCluster\Controllers\Dashboard;

use App\Clusters\AuthCluster\Controllers\DefaultController;
use App\Clusters\AuthCluster\Models\AccessControl\RolePermission;
use Input;
use Request;

class DashboardController extends DefaultController {


    public function ajax()
    {
        if( Request::ajax() ) {
            $data = Input::all();

            if ( isset($data['action']) && $data['action'] == 'role_permissions' ) {
                if ( isset($data['role_id']) && !empty($data['role_id']) ) {
                    $user = \Auth::user();

                    if ( !$user || !$user->can('updateUsersAccess')) {
                        return response('', 401);
                    }

                    $permissions = RolePermission::where('role_id', '=', $data['role_id'])
                        ->with('permission')->get();

                    return response()->json($permissions);
                }

                return response('', 401);
            }

            return response('', 404);
        }

        return response('', 404);
    }
}
