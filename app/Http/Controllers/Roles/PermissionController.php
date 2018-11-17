<?php

namespace LokaLocal\Http\Controllers\Roles;

use Illuminate\Http\Request;
use LokaLocal\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function count () {
        return Permission::count();
    }
}
