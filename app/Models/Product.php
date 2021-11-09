<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Product
 *
 * @property int                                                                  $id
 * @property string                                                               $name
 * @property string                                                               $description
 * @property string|null                                                          $color
 * @property int                                                                  $in_stock
 * @property \Illuminate\Support\Carbon|null                                      $created_at
 * @property \Illuminate\Support\Carbon|null                                      $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null                                                        $categories_count
 * @property-read string                                                          $color_label
 * @property-read string                                                          $in_stock_label
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereInStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string                                                               $stock_date
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStockDate($value)
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
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

    /**
     * @return string
     */
    public function getStockDateAttribute(): string
    {
        if (!$this->attributes['stock_date']) {
            return '';
        }

        $date = new Carbon($this->attributes['stock_date']);

        return $date->format('m/d/Y');
    }

    /**
     * @param string|null $value
     */
    public function setStockDateAttribute(?string $value): void
    {
        if (!$value) {
            $this->attributes['stock_date'] = null;
        } else {
            $date = Carbon::createFromFormat('m/d/Y', $value);

            if ($date) {
                $this->attributes['stock_date'] = $date->format('Y-m-d');
            } else {
                $this->attributes['stock_date'] = null;
            }
        }
    }
}
