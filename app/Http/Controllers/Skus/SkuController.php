<?php

namespace LokaLocal\Http\Controllers\Skus;

use Illuminate\Http\Request;
use LokaLocal\Http\Controllers\Controller;
use LokaLocal\Sku;

class SkuController extends Controller {
    public function filter(Request $request)
    {
        $query = Sku::query();

        if ($request->search) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $skus = $query->orderBy($request->input('orderBy.column'), $request->input('orderBy.direction'))
                      ->paginate($request->input('pagination.per_page'));

        return $skus;
    }

    public function show($sku)
    {
        return Sku::findOrFail($sku);
    }

//    public function store(Request $request)
//    {
//        $this->validate($request, [
//            'name'   => 'required|string',
//            'desc'   => 'required|string',
//            'code'   => 'required|string',
//            'amount' => 'required|numeric|min:1'
//        ]);
//
//        $user = User::create([
//            'name'     => $request->name,
//            'email'    => $request->email,
//            'password' => Hash::make($request->password)
//        ]);
//
//        $rolesNames = array_pluck($request->roles, ['name']);
//        $user->assignRole($rolesNames);
//
//        $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
//        Storage::put('avatars/' . $user->id . '/avatar.png', (string)$avatar);
//
//        return $user;
//    }
//
//    public function update(Request $request)
//    {
//        $this->validate($request, [
//            'name'     => 'required|string',
//            'email'    => 'required|email|unique:users,email,' . $request->id,
//            'password' => 'string|nullable',
//            'roles'    => 'required|array'
//        ]);
//
//        $user = User::find($request->id);
//
//        if ($user->name != $request->name) {
//            $avatar = Avatar::create($request->name)->getImageObject()->encode('png');
//            Storage::put('avatars/' . $user->id . '/avatar.png', (string)$avatar);
//            $user->name = $request->name;
//        }
//        if ($user->email != $request->email) {
//            $user->email = $request->email;
//        }
//        if ($request->password != '') {
//            $user->password = Hash::make($request->password);
//        }
//
//        $user->save();
//
//        $rolesNames = array_pluck($request->roles, ['name']);
//        $user->syncRoles($rolesNames);
//
//        return $user;
//    }
//
//    public function destroy($user)
//    {
//        return User::destroy($user);
//    }
//
//    public function count()
//    {
//        return User::count();
//    }
//
//    public function getUserRoles($user)
//    {
//        $user = User::findOrFail($user);
//        $user->getRoleNames();
//
//        return $user;
//    }
}
