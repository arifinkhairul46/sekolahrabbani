<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function get_menu(Request $request)
    {
        try {
            $id_role = $request->get('role');

            if (!Role::get_by_id($id_role) != null) {
                return $this->error((object)NULL, 'role not found', 400);
            }

            $arr_menu = Menu::get_menu_by_id_role($id_role);

            $get_menu_by_role = app('App\Http\Controllers\Role\RoleController')->arrange_menu($arr_menu, $arr_menu, 0);
            $data = $get_menu_by_role;
            return $this->success($data, 'Berhasil', 200);
        } catch (Exception $e) {
            return $this->error([], $e->getMessage(), 400);
        }
    }
    public function get_all(Request $request)
    {
        try {
            $data = Menu::get_all();
            return $this->success($data, 'Berhasil', 200);
        } catch (Exception $e) {
            return $this->error([], $e->getMessage(), 400);
        }
    }

}
