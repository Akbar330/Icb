<?php

namespace App\Http\Controllers;

use App\Models\Eskul;
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
        if (auth()->user()->role === 'eskul') {
            abort(403, 'Akses khusus Super Admin.');
        }

        $users = User::with('eskul')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (auth()->user()->role === 'eskul') {
            abort(403, 'Akses khusus Super Admin.');
        }

        $eskuls = Eskul::orderBy('nama_eskul')->get();
        return view('admin.users.create', compact('eskuls'));
    }

    public function addUser(Request $r)
    {
        if (auth()->user()->role === 'eskul') {
            abort(403, 'Akses khusus Super Admin.');
        }

        $r->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role'     => 'required|in:admin,eskul',
            'eskul_id' => 'nullable|required_if:role,eskul|exists:eskuls,id',
        ]);

        try {
            DB::table('users')->insert([
                'name'       => $r->input('name'),
                'email'      => $r->input('email'),
                'password'   => Hash::make($r->input('password')),
                'role'       => $r->input('role', 'admin'),
                'eskul_id'   => $r->input('role') === 'eskul' ? $r->input('eskul_id') : null,
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
        if (auth()->user()->role === 'eskul') {
            abort(403, 'Akses khusus Super Admin.');
        }

        $user = User::findOrFail($id);
        $eskuls = Eskul::orderBy('nama_eskul')->get();
        return view('admin.users.edit', compact('user', 'eskuls'));
    }

    public function editUser(Request $r, $id)
    {
        if (auth()->user()->role === 'eskul') {
            abort(403, 'Akses khusus Super Admin.');
        }

        $r->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirmed',
            'role'     => 'required|in:admin,eskul',
            'eskul_id' => 'nullable|required_if:role,eskul|exists:eskuls,id',
        ]);

        try {
            $f = [
                'name'       => $r->input('name'),
                'email'      => $r->input('email'),
                'role'       => $r->input('role'),
                'eskul_id'   => $r->input('role') === 'eskul' ? $r->input('eskul_id') : null,
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
        if (auth()->user()->role === 'eskul') {
            abort(403, 'Akses khusus Super Admin.');
        }

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
