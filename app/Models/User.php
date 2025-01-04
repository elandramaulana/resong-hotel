<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'level_user',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function karyawanHasDivision()
    {
        return $this->hasMany(KaryawanHasDivision::class, 'user_id', 'id');
    }
    public static function generateDefaultPassword($user)
    {
        // Example logic: email + day + random number
        $emailPart = explode('@', $user->email)[0]; // Get part before '@' in email
        $day = date('d'); // Get current day (e.g., 01, 02, ... 31)
        $randomNumber = rand(100, 999); // Random 3-digit number

        return $emailPart . $day . $randomNumber; // Example: john02-456
    }
    public function getActiveDivision() {
        $query =  KaryawanHasDivision::join('divisis', 'divisis.id', '=', 'karyawan_has_divisions.divisi_id')
                                    ->where('karyawan_has_divisions.khr_isActive', 1)
                                    ->where('karyawan_has_divisions.user_id', $this->id)
                                    ->select('divisis.*', 'karyawan_has_divisions.khd_ot_approval as is_approval')
                                    ->first();
        return $query;
    }
    public function isUserApproval():bool {
        $checkStatus = $this->getActiveDivision();
        if($checkStatus && $checkStatus->is_approval==1){
            return true;
        }else{
            return false;
        }
    }
    public function isKaryawan(){
        $karyawan_has_division = KaryawanHasDivision::where('user_id', $this->id)->count();
        if($karyawan_has_division>0){
            return true;
        }else{
            return false;
        }
    }
}
