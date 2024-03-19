<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(ProductRepository $productRepository, Request $request)
    {
        try {
            $products = $productRepository->get($request);

            return response()->json([
                'code' => 200,
                'message' => 'Get products success',
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function available(ProductRepository $productRepository, Request $request)
    {
        try {
            $products = $productRepository->available($request);

            return response()->json([
                'code' => 200,
                'message' => 'Get products success',
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(ProductRepository $productRepository, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:0',
                'image' => 'nullable|string|max:255',
                'status' => 'required|in:ACTIVE,INACTIVE',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Product create failed',
                    'data' => $validator->errors(),
                ], 400);
            }

            $product = $productRepository->store($request);

            return response()->json([
                'code' => 201,
                'message' => 'Product created successfully',
                'data' => $product
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(ProductRepository $productRepository, $id)
    {
        try {
            $product = $productRepository->show($id);

            return response()->json([
                'code' => 200,
                'message' => 'Get product success',
                'data' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 404,
                'message' => 'Product not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(ProductRepository $productRepository, Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:0',
                'image' => 'nullable|string|max:255',
                'status' => 'required|in:ACTIVE,INACTIVE',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Product update failed',
                    'data' => $validator->errors(),
                ], 400);
            }

            $product = $productRepository->update($request, $id);

            return response()->json([
                'code' => 200,
                'message' => 'Product updated successfully',
                'data' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(ProductRepository $productRepository, $id)
    {
        try {
            $product = $productRepository->destroy($id);

            return response()->json([
                'code' => 200,
                'message' => 'Product deleted successfully',
                'data' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
