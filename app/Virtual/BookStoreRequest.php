<?php

namespace App\Virtual;
/**
 * @OA\Schema (
 *     description="Some simple request creates as book",
 *     type="object",
 *     title="Book storring request"
 * )
 */

class BookStoreRequest{

    /**
     * @OA\Property (
     *     title="title",
     *     description="Some text field",
     *     format="string",
     *     example="title"
     * )
     * @var string
     */
    public $title;

    /**
     * @OA\Property (
     *     title="author",
     *     description="Some text field",
     *     format="string",
     *     example="test"
     * )
     * @var string
     */
    public $author;

    /**
     * @OA\Property (
     *     title="description",
     *     description="Some text field",
     *     format="string",
     *     example="test"
     * )
     * @var string
     */
    public $description;

    /**
     * @OA\Property (
     *     title="price",
     *     description="Some number field",
     *     format="double",
     *     example="123"
     * )
     * @var double
     */
    public $price;

    /**
     * @OA\Property (
     *     title="stock",
     *     description="Some number field",
     *     format="int64",
     *     example="10"
     * )
     * @var int
     */
    public $stock;
}
