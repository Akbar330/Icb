<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        return view('admin.users.create');
    }
    public function addUser(Request $r)
    {

        $r->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);


        try {

            DB::table('users')->insert([
                'name' => $r->input('name'),
                'email' => $r->input('email'),
                'password' => Hash::make($r->input('password')),
                'created_at' => Carbon::now(),
            ]);

            Alert::success('Success', 'User added successfully!');
            return redirect()->route('admin.pengguna.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong: ' . $e->getMessage());
            return redirect()->route('admin.pengguna.index');
        }
    }
    public function edit($id)
    {
        $user = User::findOrfail($id);
        return view('admin.users.edit', compact('user'));
    }
    public function editUser(Request $r, $id)
    {

        $r->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirmed',
        ]);


        try {

            $f = [
                'name' => $r->input('name'),
                'email' => $r->input('email'),
                'updated_at' => Carbon::now(),
            ];
            if ($r->filled('password')) {
                $f['password'] = Hash::make($r->input('password'));
            }

            DB::table('users')->where('id', $id)->update($f);

            Alert::success('Success', 'User Updated successfully!');
            return redirect()->route('admin.pengguna.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong: ' . $e->getMessage());
            return redirect()->route('admin.pengguna.index');
        }
    }
    public function deleteUser($id)
    {
        try {
            DB::table('users')->where('id', $id)->delete();
            Alert::success('Success', 'User Deleted successfully!');
            return redirect()->route('admin.pengguna.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong: ' . $e->getMessage());
            return redirect()->route('admin.pengguna.index');
        }
    }
}
