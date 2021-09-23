<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
{

    /**
     * Adding products by Api request or updating existing ones
     *
     * @throws GuzzleException
     */
    public static function updateOrCreateProducts()
    {
        /** @var ConnectController $response */
        $response = ConnectController::apiConnectAction();

        foreach ($response as $elem) {
            $name = $elem['title'];
            $category = $elem['product_type'];
            $description = strip_tags($elem['body_html']);
            $price = $elem['variants'][0]['price'];
            $qty = $elem['variants'][0]['inventory_quantity'];
            $sku = $elem['variants'][0]['sku'];
            $image = $elem['image']['src'];

            Product::updateOrCreate(
                ['sku' => $sku],
                [
                    'category' => $category,
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'sku' => $sku,
                    'qty' => $qty,
                    'image' => $image,

                ]);
        }
    }

    /**
     * Show all products via api request.
     *
     * @return Product[]|Collection
     */
    public function getAllProducts()
    {

        return Product::all();
    }

    /**
     * Show products with additional parameters via api request.
     *
     * @param string $filter
     * @param string|null $sort
     * @param int|null $paginate
     * @return mixed
     */
    public function getSortProducts(string $filter, string $sort = null, int $paginate = null)
    {
        if ($sort == null) {
            $sort = 'asc';
        }

        return Product::orderBy($filter, $sort)->paginate($paginate);
    }
}
