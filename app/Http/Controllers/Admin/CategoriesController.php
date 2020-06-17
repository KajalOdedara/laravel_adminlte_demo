<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('title')) {
            $categories = Category::where('title', request('title'))->paginate(5);
        } else {
            // $categories = Category::all()->sortByDESC('id');
            $categories = Category::paginate(2);
        }

        return view('admin.categories.index', compact('categories'));

        // $arr['categories'] = Category::all();
        // return view('admin.categories.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $category->title = $request->title;
        $category->save();
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $arr['category'] = $category;
        return view('admin.categories.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->title = $request->title;
        $category->save();
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg = Category::destroy($id);
        $msg = session()->flash('status', 'Task was successful!');
        return redirect()->route('admin.categories.index');

        // ->with('alert', 'Deleted!')
    }
    public function result(Request  $request)
    {
        $datas = Category::select("title")
            ->where("title", "LIKE", "%{$request->input('query')}%")
            ->get();
        $dataModified = array();
        foreach ($datas as $data) {
            $dataModified[] = $data->title;
        }
        return response()->json($dataModified);
    }
    public function search()
    {
        $q = FacadesRequest::get('q');

        $users = Category::where('title', 'LIKE', '%' . $q . '%')->paginate(5)->setPath('');
        $pagination = $users->appends(array(
            'q' => FacadesRequest::get('q')
        ));
        return view('admin.categories.index')->withCategories($users)->withQuery($q);

    //     $q = FacadesRequest::get('q');
    //     if ($q != " ") {
    //         $users = Category::where('title', 'LIKE', '%' . $q . '%')->paginate(2)->setPath('');
    //         $pagination = $users->appends(array(
    //             'q' => FacadesRequest::get('q')
    //         ));
    //         if (count($users) > 0)
    //             return view('admin.categories.index')->withCategories($users)->withQuery($q);
    //     }
    //     return view('admin.categories.index')->withCategories('No Details found. Try to search again !');
    // }
}
}
