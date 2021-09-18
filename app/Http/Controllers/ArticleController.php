<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Article::get();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return $article;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has(['denomination','serial_number','type'])){
            $new_article = Article::create($request->all());
            $new_article->save();
            return response()->json($new_article, 200);
        } else {
            $data = [
                "error" => 1,
                "errorMsg" => "Missing data"
            ];
            return response()->json($data, 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        if($request->type){
            if($request->type !== "consumable" && $request->type !== "tooling"){
                $data=[
                    "error"=>1,
                    "errorMsg"=> "field 'type' malformed"
                ];
                return response()->json($data, 400);
            }
        }

        if($request->repair_state){
            if($request->repair_state !== "pristine" && $request->repair_state !== "must_repair" && $request->repair_state !== "been_repaired"){
                $data=[
                    "error"=>1,
                    "errorMsg"=> "field 'repair_state' malformed"
                ];
                return response()->json($data, 400);
            }
        }

        $article->fill($request->all());
        $article->save();
        return response()->json($article, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        return $article->delete();
    }
}
