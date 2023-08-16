<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventCategory;

class EventCategoryController extends Controller
{


    public function category_create(Request $request){
        $user_id = auth()->user()->id;
        return EventCategory::where('user_id',$user_id)->create([
            'name'=>$request->input('name'),
            'user_id'=>$user_id
        ]);
    }

    public function category_read(){
        $user_id = auth()->user()->id;
        return EventCategory::where('user_id',$user_id)->get();

    }

    public function category_update(Request $request){
        $user_id = auth()->user()->id;
        $categoryId=$request->input('id');

            return EventCategory::where('user_id',$user_id)
                    ->where('id', $categoryId)->update([
                        'name'=>$request->input('name')
                    ]);
    }


    public function category_delete(Request $request){
        $user_id = auth()->user()->id;
        $categoryId=$request->input('id');

        return EventCategory::where('user_id',$user_id)
                    ->where('id', $categoryId)->delete();
    }

    public function eventCategoryPage(){
        return view('pages.dashboard.event_category_page');

    }

    function CategoryByID(Request $request){
        $category_id=$request->input('id');
        $user_id=$request->header('id');
        return EventCategory::where('id',$category_id)->where('user_id',$user_id)->first();
    }
}
