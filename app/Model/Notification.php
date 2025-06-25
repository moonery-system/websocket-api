<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\User;
use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property string $title 
 * @property string $description 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Notification extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notifications');
    }
}
