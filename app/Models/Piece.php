<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Piece extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'qty',
        'hours',
        'status',
        'project_id',
        'worker_id',
        'piece_category_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'qty' => 'integer',
        'hours' => 'float',
        'project_id' => 'integer',
        'worker_id' => 'integer',
        'piece_category_id' => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }

    public function pieceCategory(): BelongsTo
    {
        return $this->belongsTo(PieceCategory::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }
}
