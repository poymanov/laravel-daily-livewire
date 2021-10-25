<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int                             $id
 * @property string                          $name
 * @property string                          $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Category       $category
 * @property int                             $category_id
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @property string|null $color
 * @property int $in_stock
 * @property-read string $color_label
 * @property-read string $in_stock_label
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereInStock($value)
 */
class Product extends Model
{
    use HasFactory;

    /** @var string[] */
    protected $fillable = ['name', 'description', 'category_id', 'color', 'in_stock'];

    public const COLORS_LIST = [
        'red'   => 'Red',
        'green' => 'Green',
        'blue'  => 'Blue',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return string
     */
    public function getColorLabelAttribute(): ?string
    {
        return self::COLORS_LIST[$this->color] ?? $this->color;
    }

    /**
     * @return string
     */
    public function getInStockLabelAttribute(): string
    {
        return $this->in_stock ? 'Yes' : 'No';
    }
}
