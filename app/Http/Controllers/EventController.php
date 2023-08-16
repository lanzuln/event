<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function createEvent(Request $request){

        try {
            $user_id = auth()->user()->id;

            return Event::where('user_id',$user_id)->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'location' => $request->input('location'),
            'user_id' => $user_id,
        ]);

        return  response()->json([
            'status' => 'success',
        ]);

        } catch (e) {
            return  response()->json([
                'status' => 'fail',
            ]);
        }


    }



    public function readEvent(){

        $user_id = auth()->user()->id;
        return Event::where('user_id',$user_id)->get();
    }



    public function updateEvent(Request $request){

        try {
            $user_id = auth()->user()->id;
            $eventId=$request->input('id');

            return Event::where('user_id',$user_id)
                    ->where('id', $eventId)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'location' => $request->input('location'),
            'id' => $eventId
        ]);

        return response()->json([
            'status'=>'update successfull',
        ]);

        } catch (e) {
            return response()->json([
                'status'=>'update fail',
            ]);
        }

    }
    public function deleteEvent(Request $request){
        try {
            $user_id = auth()->user()->id;
        $eventId=$request->input('id');

        return Event::where('user_id',$user_id)
                    ->where('id', $eventId)->delete();

        return response()->json([
            'status'=>'delete success'
        ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status'=>'delete fail'
            ]);
        }
    }


    public function eventPage(){
        return view('pages.dashboard.event-page');

    }

    function eventByID(Request $request){
        $user_id = auth()->user()->id;
        $eventId=$request->input('id');
        return Event::where('user_id',$user_id)
                    ->where('id', $eventId)->first();
    }


    public function all_event(){

        $all_event=Event::latest()->get();
        return view('index', compact('all_event'));
    }

}
