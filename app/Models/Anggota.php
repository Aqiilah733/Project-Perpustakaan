<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Anggota extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 't_anggota';

    protected $primaryKey = 'f_id';

    protected $guarded = ['f_id'];

    public function getAuthPassword(){
        return $this->f_password;
    }
}
