<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $key
 * @property string $make_discount_sql
 * @property string $check_campaign_sql
 */
class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'make_discount_sql', 'check_campaign_sql'];
}
