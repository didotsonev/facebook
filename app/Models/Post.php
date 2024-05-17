<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public const TABLE = 'posts';

    public const ID = 'id';
    public const DESCRIPTION = 'description';
    public const CREATED_BY_ID = 'created_by_id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $guarded = [
        self::ID,
    ];

    public function createdBy()
    {
        return $this->belongsTo(
            User::class,
            self::CREATED_BY_ID,
            User::ID
        );
    }
}
