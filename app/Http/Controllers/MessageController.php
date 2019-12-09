<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id=app('VoyagerAuth')->user()->id;
        $m = Message::where('recipient_id', $id)
            ->orderBy('created_at','desc')
            ->get();

        return view('user.message.index', ['messages' => $m]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.message.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'created_user_id' => 'required|integer',
            'content' => 'required',
            'recipient_id' => 'required|integer'
        ]);

        Message::create($request->all());

        return redirect('messages');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
//        $m = Message::find($id);
//        return view('students.edit', ['s' => $student]);// $student;
    }

    public function reply($id)
    {
        //
        $m = Message::find($id);
        $m->content = ('=============\r\n '.$m->Author->name. ' =============\r\n' . $m->content);

        $receiver = $m->recipient_id;
        $m->recipient_id = $m->created_user_id;
        $m->created_user_id = $receiver;
        return view('user.message.reply', ['m' => $m]);// $student;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function read($id)
    {
        $m = Message::find($id);
        $m->status = 'readed';
        $m->save();


        return redirect('messages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $m = Message::find($id);
        $m->delete();
        return redirect('/messages')->with('success', 'Message deleted!');
        //
    }
}
