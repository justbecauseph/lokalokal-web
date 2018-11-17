<?php

namespace LokaLocal\Http\Controllers\Modules;

use Illuminate\Http\Request;
use LokaLocal\Http\Controllers\Controller;
use LokaLocal\Models\Modules\Module;

class ModuleController extends Controller
{
    public function getModulesPermissions()
    {
        return Module::with('permissions')
          ->has('permissions')
          ->orderBy('name')
          ->get();
    }
  }
