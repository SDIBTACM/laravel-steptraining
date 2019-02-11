<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-13 17:38
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Log;
use App\Model\Category;
use App\Model\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index', ['title' => 'category manager']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->input('name');
        $category->save();

        Log::info('User: {} add a category, name: {}', Auth::user()->username, $category);
        return [
            'date' => date('Y-m-d H:m:s'),
            'id' => $category->id,
            ];

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
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();

        Log::info('User: {} update category: {} ', Auth::user()->username, $category);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != 1) {
            Problem::where('category_id', $id)->update(['category_id' => 1]);
            $oldCategory = Category::find($id);
            Log::info('User: {} delete category: {}', Auth::user()->username, $oldCategory);
            Category::destroy($id);
        } else {
            Log::warning('User: {} try to delete category Id: 1', Auth::user()->username);
            abort('403');
        }
    }
}