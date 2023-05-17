<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Services\Blog\BlogServiceInterface;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\ProductComment\ProductCommentServiceInterface;
use App\Services\User\UserServiceInterface;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    private $productService;
    private $productCommentService;
    private $productCategoryService;
    private $brandService    ;
    private $userService ;
    public  function __construct(ProductServiceInterface $productService
        , ProductCommentServiceInterface  $productCommentService
        ,ProductCategoryServiceInterface $productCategoryService
        ,BrandServiceInterface $brandService ,
        UserServiceInterface $userService,

    ){
        $this->productService = $productService;
        $this->productCommentService = $productCommentService;
        $this->productCategoryService = $productCategoryService;
        $this->brandService = $brandService;
        $this->userService = $userService;
    }
    public function show($id){
        $categories = $this->productCategoryService->all();
        $brands  = $this->brandService->all();
        $comments = $this->productCommentService->all();
        $product = $this->productService->find($id);
        $users = $this->userService->all();
        $relatedProducts =$this->productService->getRelatedProducts($product);

        return view('front.shop.show',compact('product' , 'relatedProducts',
            'categories', 'brands' ,'comments' , 'users'));
    }

    public function index(Request $request){
        $categories = $this->productCategoryService->all();
        $comments = $this->productCommentService->all();
        $brands  = $this->brandService->all(); // lay du lieu tu Brand
        $products = $this->productService->all(); // lay du lieu tu dtb
        $products = $this->productService->getProductOnIndex($request);

        return view('front.shop.index',compact('products','categories' , 'brands' , 'comments'));
    }
    public function category($categoryName,Request $request)
    {
        $categories = $this->productCategoryService->all();
        $brands  = $this->brandService->all();
        //$products = $this->productService->all(); // lay du lieu tu dtb
        $products = $this->productService->getProductsByCategory($categoryName,$request);

        return view('front.shop.index',compact('products','categories','brands'));
    }
    public function postComment(Request $request){
        $this->productCommentService->create($request->all());
        return redirect()->back();

    }

}
