<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendingInteractionsRequest;
use App\Models\Emotion;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class EmotionController extends Controller
{
    public function analyzeInteractions(SendingInteractionsRequest $request)
    {
        $validated = $request->validated();

        // TODO: Analyze the data instead of returning random values!
        $emotion_request = array_map(function ($e) {
            $btns = $e['mouse']['buttons'];
            $keys = array_map(function ($k) {
                $key = preg_replace('/[\u0300-\u036f]/', '', \Normalizer::normalize($k, \Normalizer::FORM_D));

                // The following 'if's will fail if the key's length not equal to 1
                if (preg_match('/^[a-zA-Z]$/i', $key) !== false) {
                    return 'alpha';
                } else if (preg_match('/^[0-9]$/', $key) !== false) {
                    return 'num';
                } else if (preg_match('/^[|\\\\!"£$%&/()=?^\'-_.:,;#@+*\[\]]$/', $key) !== false) {
                    return 'symb';
                } else {
                    return 'fn';
                }
            }, $e['keyboard']);
            return [
                "mouse" => [
                    "position" => $e['mouse']['position'],
                    "buttons" => [
                        "left" => in_array(0, $btns),
                        "middle" => in_array(1, $btns),
                        "right" => in_array(2, $btns),
                        "others" => sizeof(array_filter($btns, function ($b) {
                            return $b > 2;
                        }))
                    ]
                ],
                "scroll" => $e['scroll'],
                "keyboard" => [
                    "alpha" => in_array('alpha', $keys),
                    "numeric" => in_array('num', $keys),
                    "symbol" => in_array('symb', $keys),
                    "function" => in_array('fn', $keys)
                ],
                "user_id" => $e["userId"],
                "url" => $e["url"]
            ];
        }, $validated['data']);

        $emotion_response = Http::post("http://127.0.0.1:8000/classify", $emotion_request);
        assert($emotion_response->status() == 200);

        foreach ($validated['data'] as $key => $interaction) {
            $data = $emotion_response[$key];
            $emotion = new Emotion();
            $emotion->timestamp = Carbon::createFromTimestampMs($interaction['timestamp'])->toDateTimeString();
            $emotion->page_id = Page::firstOrCreate([
                'url' => $interaction['url']
            ], [
                'website_id' => $interaction['websiteId'],
                'title' => $interaction['pageTitle'],
            ])->id;
            $emotion->x = 100 * $interaction['mouse']['position']['x'] / $interaction['window']['document']['x'];
            $emotion->y = 100 * $interaction['mouse']['position']['y'] / $interaction['window']['document']['y'];
            $emotion->anger = $data['anger'];
            $emotion->contempt = $data['contempt'];
            $emotion->disgust = $data['disgust'];
            $emotion->fear = $data['fear'];
            $emotion->joy = $data['joy'];
            $emotion->sadness = $data['sadness'];
            $emotion->surprise = $data['surprise'];
            $emotion->valence = $data['valence'];
            $emotion->engagement = $data['engagement'];
            $emotion->save();
        }

        return response("analyzed successfully");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Emotion $emotion
     * @return \Illuminate\Http\Response
     */
    public function show(Emotion $emotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Emotion $emotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Emotion $emotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Emotion $emotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emotion $emotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Emotion $emotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emotion $emotion)
    {
        //
    }
}
