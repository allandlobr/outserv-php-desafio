<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Ramsey\Uuid\Nonstandard\Uuid;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'status'
    ];

    protected function uuid(): Attribute
    {
        return Attribute::make(
            set: function (string $value) {
                if (empty($value)) {
                    return ['uuid' => Uuid::uuid4()->toString()];
                }
                return ['uuid' => $value];
            }
        );
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
