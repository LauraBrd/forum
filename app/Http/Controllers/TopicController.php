<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Commentaire;
use Validator;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:74',
            'message' => 'required|string'
        ]);

        $topics = Topic::all();
        return view('index', ['topics' => $topics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Validator $validator)
    {
        $topic = new Topic;
        $topic->titre = $request->titre;
        $topic->message = $request->message;

        // pour enregistrer dans la bdd
        $topic->save();
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //commentaires = Commentaire::find($id);
        //$commentaires = DB::table('commentaires')->where('topic_id', $id)->get();
        $commentaires = Commentaire::where('topic_id', '=', $id)->get();
        $topic = Topic::find($id);
        return view('show', ['topic' => $topic], ['commentaires' => $commentaires]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        return view('edit', ['topic' => $topic]);
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
        $topic = Topic::find($id);
        $topic->titre = $request->titre;
        $topic->message = $request->message;
        $topic->save();
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);
        $topic->delete();
        return redirect()->route('home');
    }

    public function comment(Request $request, Int $id)
    {
        //dd($request);
        $commentaire = new Commentaire;
        $commentaire->message = $request->commentaire;
        $commentaire->topic_id = $id;
        //dd($commentaire);
        $commentaire->save();

        /*if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }*/
        return redirect()->route('topics.show', ['id' => $id]);
    }

    public function search(Request $request)
    {
        // récupérer le titre avant la requête

        Topic::where('titre', '=', "%titre%")->first();
    }
}
