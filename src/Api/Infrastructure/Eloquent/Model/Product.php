<?php

declare(strict_types=1);

namespace Api\Infrastructure\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'price',
        'currency'
    ];

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var bool
     */
    public $incrementing = false;
}
