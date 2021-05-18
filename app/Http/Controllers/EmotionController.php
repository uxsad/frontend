<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendingInteractionsRequest;
use App\Models\Emotion;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmotionController extends Controller
{
    public function analyzeInteractions(SendingInteractionsRequest $request)
    {
        $validated = $request->validated();

        // TODO: Analyze the data instead of returning random values!

        foreach ($validated['data'] as $interaction) {
            $emotion = new Emotion();
            $emotion->timestamp = Carbon::createFromTimestampMs($interaction['timestamp'])->toDateTimeString();
            $emotion->page_id = Page::firstOrCreate([
                'url' => $interaction['url']
            ], [
                'website_id' => $interaction['websiteId'],
                'title' => $interaction['pageTitle'],
            ])->id;
            $emotion->x = $interaction['scroll']['relative']['x'];
            $emotion->y = $interaction['scroll']['relative']['y'];
            $emotion->anger = rand(0, 2);
            $emotion->contempt = rand(0, 2);
            $emotion->disgust = rand(0, 2);
            $emotion->fear = rand(0, 2);
            $emotion->joy = rand(0, 2);
            $emotion->sadness = rand(0, 2);
            $emotion->surprise = rand(0, 2);
            $emotion->valence = rand(0, 2);
            $emotion->engagement = rand(0, 2);
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
