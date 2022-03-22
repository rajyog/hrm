<?php

namespace App\Http\Controllers;

use App\User;
use App\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('Manage Event'))
        {
            $user = User::where('created_by', '=', \Auth::user()->creatorId())->get();
            // dd($user);
            $events    = Event::where('created_by', '=', \Auth::user()->creatorId())->get();

            $arrEvents = [];
            foreach($events as $event)
            {
                $arr['id']    = $event['id'];
                $arr['title'] = $event['title'];
                $arr['start'] = $event['start_date'];
                $arr['end']   = $event['end_date'];
                //                $arr['allDay']    = !0;
                //                $arr['className'] = 'bg-danger';
                $arr['backgroundColor'] = $event['color'];
                $arr['borderColor']     = "#fff";
                $arr['textColor']       = "white";
                $arr['url']             = route('event.edit', $event['id']);

                $arrEvents[] = $arr;
            }
            $arrEvents = str_replace('"[', '[', str_replace(']"', ']', json_encode($arrEvents)));

            return view('event.index', compact('arrEvents', 'user'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Create Event'))
        {
            $user      = User::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('event.create', compact('user'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {

        if(\Auth::user()->can('Create Event'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'user_id' => 'required',
                                   'title' => 'required',
                                   'start_date' => 'required',
                                   'end_date' => 'required',
                                   'color' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $event                = new Event();
            $event->user_id       = $request->user_id;
            $event->title         = $request->title;
            $event->start_date    = $request->start_date;
            $event->end_date      = $request->end_date;
            $event->color         = $request->color;
            $event->description   = $request->description;
            $event->created_by    = \Auth::user()->creatorId();
            $event->save();



            return redirect()->route('event.index')->with('success', __('Event  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Event $event)
    {
        return redirect()->route('event.index');
    }

    public function edit($event)
    {

        if(\Auth::user()->can('Edit Event'))
        {
            $event = Event::find($event);
            if($event->created_by == Auth::user()->creatorId())
            {
                $user = User::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');

                return view('event.edit', compact('event', 'user'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Event $event)
    {
        if(\Auth::user()->can('Edit Event'))
        {
            if($event->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'title' => 'required',
                                       'start_date' => 'required',
                                       'end_date' => 'required',
                                       'color' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $event->title       = $request->title;
                $event->start_date  = $request->start_date;
                $event->end_date    = $request->end_date;
                $event->color       = $request->color;
                $event->description = $request->description;
                $event->save();

                return redirect()->route('event.index')->with('success', __('Event successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(Event $event)
    {
        if(\Auth::user()->can('Delete Event'))
        {
            if($event->created_by == \Auth::user()->creatorId())
            {
                $event->delete();

                return redirect()->route('event.index')->with('success', __('Event successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function getuser(Request $request)
    {

        if($request->user_id == 0)
        {
            $user = User::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id')->toArray();

        }
        else
        {
            $user = User::where('created_by', '=', \Auth::user()->creatorId())->where('branch_id', $request->user_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($user);
    }


}
