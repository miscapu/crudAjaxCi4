<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['records'] = $model->findAll();

        return view('Pages/Dashboard', $data);
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return json_encode(['status' => 'success']);
    }
}
