<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User::class;
    }

    public function login(Request $request)
    {
        // $user           = new User();
        // $user->name     = '123adadad';
        // $user->email    = 'quanganh@gmail.com';
        // $user->password = Hash::make('123456');
        // $user->save();

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user                 = Auth::user();
            $token                = $user->createToken('user');
            $user->remember_token = $token->plainTextToken;
            $user->update();
            return $token->plainTextToken;
        }

        return '';
    }
    public function getUser(Request $request)
    {
        return $request->user;
    }
}
