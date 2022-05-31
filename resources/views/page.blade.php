@extends('layouts.dashboard')

@section('header')
    <div class="flex-grow">
        <h1>{{$page->title}}</h1>
        <x-breadcrumbs :path="\App\BreadcrumbsHelper::getPagePath($page)"></x-breadcrumbs>
    </div>
    <button
        class="w-12 h-12 inline-block text-center text-white transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
        <span class="fas fa-plus fa-lg" aria-label="Add new website"></span>
    </button>
@endsection

@section('content')
    <div class="relative flex md:flex-row-reverse flex-col items-center w-full md:w-4/5 mx-auto">
        <div class="p-3 sticky w-full md:w-1/5 flex-grow flex-shrink-0">
            <div>
                <input name="emotion" type="radio" id="anger" value="anger"/>
                <label for="anger">Anger</label>
            </div>
            <div>
                <input name="emotion" type="radio" id="contempt" value="contempt"/>
                <label for="contempt">Contempt</label>
            </div>
            <div>
                <input name="emotion" type="radio" id="disgust" value="disgust"/>
                <label for="disgust">Disgust</label>
            </div>
            <div>
                <input checked name="emotion" type="radio" id="joy" value="joy"/>
                <label for="joy">Joy</label>
            </div>
            <div>
                <input name="emotion" type="radio" id="fear" value="fear"/>
                <label for="fear">Fear</label>
            </div>
            <div>
                <input name="emotion" type="radio" id="sadness" value="sadness"/>
                <label for="sadness">Sadness</label>
            </div>
            <div>
                <input name="emotion" type="radio" id="surprise" value="surprise"/>
                <label for="surprise">Surprise</label>
            </div>
            <div>
                <input name="emotion" type="radio" id="valence" value="valence"/>
                <label for="valence">Valence</label>
            </div>
            <div>
                <input name="emotion" type="radio" id="engagement" value="engagement"/>
                <label for="engagement">Engagement</label>
            </div>
        </div>
        <div class="w-full md:w-4/5 relative">
            <div id="heatmap-container" class="relative mr-8 h-full w-full"></div>
        </div>
    </div>
@endsection

@push('body.scripts')
    <script src="{{ asset('js/heatmap.js') }}"></script>
    <script>
        const emotion_values = {
            anger: {!! json_encode($page->emotions()->selectRaw("AVG(anger) emotion,x,y")->groupBy('y','x')->get()) !!},
            contempt: {!! json_encode($page->emotions()->selectRaw("AVG(contempt) emotion,x,y")->groupBy('y','x')->get()) !!},
            disgust: {!! json_encode($page->emotions()->selectRaw("AVG(disgust) emotion,x,y")->groupBy('y','x')->get()) !!},
            joy: {!! json_encode($page->emotions()->selectRaw("AVG(joy) emotion,x,y")->groupBy('y','x')->get()) !!},
            fear: {!! json_encode($page->emotions()->selectRaw("AVG(fear) emotion,x,y")->groupBy('y','x')->get()) !!},
            sadness: {!! json_encode($page->emotions()->selectRaw("AVG(sadness) emotion,x,y")->groupBy('y','x')->get()) !!},
            surprise: {!! json_encode($page->emotions()->selectRaw("AVG(surprise) emotion,x,y")->groupBy('y','x')->get()) !!},
            valence: {!! json_encode($page->emotions()->selectRaw("AVG(valence) emotion,x,y")->groupBy('y','x')->get()) !!},
            engagement: {!! json_encode($page->emotions()->selectRaw("AVG(engagement) emotion,x,y")->groupBy('y','x')->get()) !!}
        };
        const y = @json($page->emotions()->select('y')->distinct()->orderBy('y', 'asc')->get()->pluck('y'));
        const x = @json($page->emotions()->select('x')->distinct()->orderBy('x', 'asc')->get()->pluck('x'));

        const discretize = (values, n = 3, negative = false) => {
            if (values === undefined || values === null)
                return null
            let bins = [];
            for (let i = 1; i <= n; i++) {
                bins.push({
                    index: i - 1,
                    min: (100 / n) * (i - 1),
                    max: (100 / n) * i
                })
            }
            if (negative) {
                bins = [bins.map(b => {
                    return {
                        index: -b.index,
                        min: -b.max,
                        max: -b.min
                    }
                }), ...bins]
            }
            bins[0].min = -Infinity;
            bins[bins.length - 1] = Infinity;
            return values.map(v => bins.filter(b => b.min < v.emotion && v.emotion < b.max)[0].index);
        }

        const discretized_emotions = {};
        Object.keys(emotion_values).forEach(key => {
            discretized_emotions[key] = discretize(emotion_values[key], 3, key === "valence");
        });

        const heatmap = new Heatmap('heatmap-container', y, x, discretized_emotions, "{{$page->base64_screenshot}}");
        $(document).ready(function () {
            heatmap.draw($("input[name='emotion']:checked").val());
            $("input[name='emotion']").change(function () {
                heatmap.draw($(this).val())
            });
        });
    </script>
    <!-- Work in progress -->
@endpush
