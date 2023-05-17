<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\Blog\BlogServiceInterface;
use Illuminate\Http\Request;

class BlogDetails extends Controller
{
    private $blogService ;
    public function __construct(BlogServiceInterface $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $blogDetails = $this ->blogService ->all() ;
        return view('admin.blog.index',compact('blogDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogDetails = $this ->blogService ->all() ;
        return view('admin.blog.create',compact('blogDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        $data = $request->all();
        $data['image'] = '';
        $blogDetail = $this->blogService->create($data);
        return redirect('admin/blog/'.$blogDetail->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogDetails = $this->blogService->find($id);
        return view('admin.blog.show',compact('blogDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogDetails = $this->blogService->find($id);
        return view('admin.blog.edit',compact('blogDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->blogService->update($data,$id);
        return redirect('admin/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Blog::destroy($id);
        return redirect('./admin/blog');
    }
}
