<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Site extends Model
{
    use HasUuids;

    protected $fillable = ['url', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function endpoints(): HasMany
    {
        return $this->hasMany(Endpoint::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            if (!app()->runningInConsole()) {
                $builder->where('user_id', Auth::user()->id);
            }
        });
    }
}
