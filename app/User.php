<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'fullname', 'active_user', 'role', 'phone', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAllUser()
    {
        return DB::table('users')
            ->join('roles', 'roles.id', '=', 'users.role')
            ->where('users.role', '<>', '3')
            ->selectRaw('users.*, roles.name as name_role')
            ->paginate(10);
    }

    public function getAllGuest()
    {
        return DB::table('users')
            ->join('roles', 'roles.id', '=', 'users.role')
            ->where('users.role', '=', '3')
            ->selectRaw('users.*, roles.name as name_role')
            ->paginate(10);
    }

    public function countNewsOfUser($id)
    {
        return DB::table('news')
            ->join('users', 'news.created_by', '=', 'users.id')
            ->where('users.id', '=', $id)
            ->selectRaw('count(news.id) as count_news')
            ->get();
    }

    public function getFavouriteCat($id)
    {
        return DB::table('cat_user')
            ->join('categories', 'cat_user.cat_id', '=', 'categories.id')
            ->where('user_id', '=', $id)
            ->selectRaw('cat_user.*, categories.name as name_cat')
            ->take(1)
            ->get();
    }
}
