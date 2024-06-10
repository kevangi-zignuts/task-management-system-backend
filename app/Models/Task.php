<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'due_date', 'description', 'created_by', 'updated_by'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($module) {
            $user = auth()->user();
            if ($user) {
                $module->created_by = $user->id;
            }
        });

        static::updating(function ($module) {
            $user = auth()->user();
            if ($user) {
                $module->updated_by = $user->id;
            }
        });
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
