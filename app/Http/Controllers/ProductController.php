<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Exception\GuzzleException;

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
}
