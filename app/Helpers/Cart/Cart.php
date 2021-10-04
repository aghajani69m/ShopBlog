<?php


namespace App\Helpers\Cart;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use phpDocumentor\Reflection\Types\Static_;

/**
 * Class Cart
 * @package App\Helpers\Cart
 * @method static bool has($id)
 * @method static Collection all();
 * @method static array get($id);
 * @method static Cart put(array $value , Model $obj = null)
 * @method Static Collection getCart()
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}
