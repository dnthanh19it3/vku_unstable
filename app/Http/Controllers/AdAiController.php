<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdAiController extends Controller
{
    public function trainAiIndex(Request $request){
        $intents = DB::table('ai_intents')->get();

        return view('Admin.AI.Index')->with([
            'intents' => $intents
        ]);
    }

    public function getIntent(Request $request, $intent_id){
        $intent = DB::table('ai_intents')->where('id', $intent_id)->first();
        $patterns = DB::table('ai_patterns')->where('intent_id', $intent->id)->get();
        $responses = DB::table('ai_responses')->where('intent_id', $intent->id)->get();

        return json_encode([
            'intent' => $intent,
            'patterns' => $patterns,
            'responses' => $responses
        ]);
    }
    public function addIntentView(Request $request){
        return view('Admin.AI.Add');
    }

    public function addIntentPost(Request $request){
        $insert = DB::table('ai_intents')->insert(['tag' => $request->tag, 'description' => $request->description]);
        return redirect(route('ad.zalo.trainai'));
    }

    public function editIntentView(Request $request, $intent_id){

        $intent = DB::table('ai_intents')->where('id', $intent_id)->first();
        $patterns = DB::table('ai_patterns')->where('intent_id', $intent->id)->get();
        $responses = DB::table('ai_responses')->where('intent_id', $intent->id)->get();



        return view('Admin.AI.Edit')->with([
            'intent' => $intent,
            'patterns' => $patterns,
            'responses' => $responses
        ]);
    }

    public function editIntentPost(Request $request, $intent_id){
         $insert = DB::table('ai_intents')
            ->where('id', $intent_id)
            ->update(['tag' => $request->tag, 'description' => $request->description, 'updated_at' => Carbon::now()]);
        return back();
    }

    public function addPatternPost(Request $request, $intent_id){
        $intentid = $request->patternid;
        $pattern = $request->pattern;
        $update = DB::table('ai_patterns')
            ->insert(
                [
                    'intent_id' => $intent_id,
                    'pattern' => $pattern,
                    'created_at' => Carbon::now()
                ]);
        return back();
    }

    public function editPatternPost(Request $request, $intent_id){
        $patternid = $request->patternid;
        $pattern = $request->pattern;

        foreach ($patternid as $key => $value){
            $update = DB::table('ai_patterns')
                ->where('id', $value)->update(
                    [
                        'pattern' => $pattern[$key],
                        'updated_at' => Carbon::now()
                    ]);
        }
        return back();
    }

    public function addResponsePost(Request $request, $intent_id){
        $intentid = $request->responseid;
        $response = $request->response;
        $update = DB::table('ai_responses')
            ->insert(
                [
                    'intent_id' => $intent_id,
                    'response' => $response,
                    'created_at' => Carbon::now()
                ]);
        return back();
    }

    public function editResponsePost(Request $request, $intent_id){
        $responseid = $request->responseid;
        $response = $request->response;

        foreach ($responseid as $key => $value){
            $update = DB::table('ai_responses')
                ->where('id', $value)->update(
                    [
                        'response' => $response[$key],
                        'updated_at' => Carbon::now()
                    ]);
        }
        return back();
    }

    function exportIntent(){
        $intents = new \stdClass();
        $intents->intents = [];

        $tags = DB::table('ai_intents')->get();

        foreach ($tags as $tag){
            $intent = new \stdClass();
            $intent->tag = $tag->tag;
            $intent->patterns = [];
            $patterns = DB::table('ai_patterns')->where('intent_id', $tag->id)->get();
            foreach ($patterns as $pattern){
                array_push($intent->patterns, $pattern->pattern);
            }


            $intent->responses = [];
            $responses = DB::table('ai_responses')->where('intent_id', $tag->id)->get();
            foreach ($responses as $response){
                array_push($intent->responses, $response->response);
            }

            array_push($intents->intents, $intent);
        }

//        dd($intents);
        return json_encode($intents);
    }

    function getFromJson(){
        $json = file_get_contents('C:\Users\ThanhDo\PycharmProjects\pythonProject\intents.json');
        $intents = json_decode($json)->intents;

//        dd($intents);

        foreach ($intents as $key_intents => $intent){
            $intent_id = DB::table("ai_intents")->insertGetId(['tag' => $intent->tag]);

            if($intent_id){
                foreach ($intent->patterns as $key_patterns => $pattern){
                    DB::table('ai_patterns')->insert(['intent_id' => $intent_id, 'pattern' => $pattern]);
                }
                foreach ($intent->responses as $key_responses => $response){
                    DB::table('ai_patterns')->insert(['intent_id' => $intent_id, 'pattern' => $pattern]);
                }
            }
        }
    }

}
