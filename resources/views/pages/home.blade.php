@extends('layouts.app')

@section('content')
    <div class="container wrapper-analyzer mt-5">
        <form action="{{route('text-analyze')}}" method="post">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Enter your text</label>
                <textarea class="form-control" name="data" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            {{csrf_field()}}
            <button class="btn btn-success mt-4">Analyze</button>
        </form>

        @if(!empty($data))
        <div class="wrapper-file mb-5">
            <a href="{{route('download', ['xml', $data['id']])}}" class="btn btn-outline-info">Download XML</a>
        </div>
        @endif

        <div class="wrapper-data row">
            @if(!empty($data))
                {{--{{dd($data)}}--}}
                <div class="col-md-3">
                    <p>Time: <strong>{{$data['time']}}</strong> </p>
                </div>
                <div class="col-md-3">
                    <p>Number characters: <strong>{{$data['number_characters']}}</strong> </p>
                </div>
                <div class="col-md-3">
                    <p>Number words: <strong>{{$data['number_words']}}</strong> </p>
                </div>
                <div class="col-md-3">
                    <p>Number sentences: <strong>{{$data['number_sentences']}}</strong> </p>
                </div>
                <div class="col-md-3">
                    <p>Average word length: <strong>{{$data['average_word_length']}}</strong> </p>
                </div>
                <div class="col-md-3">
                    <p>Average number words: <strong>{{$data['average_number_words']}}</strong> </p>
                </div>
                <div class="col-md-3">
                    <p>Palindrome words: <strong>{{$data['palindrome_words']}}</strong> </p>
                </div>
                <div class="col-md-6">
                    <p>{{$data['top_palindrome_words']}}</p>
                </div>
                <div class="col-md-6">
                    <p>{{$data['is_palindrome_string']}}</p>
                </div>
                <div class="col-md-6">
                    <h5>Reversed text</h5>
                    <p>{{$data['reversed_text']}}</p>
                </div>
                <div class="col-md-6">
                    <h5>Reversed word</h5>
                    <p>{{$data['reversed_word']}}</p>
                </div>
                <div class="col-md-6">
                    <h5>Frequency characters</h5>
                    <ul>
                       @if(!empty($data['get_frequency_characters']))
                           @foreach($data['get_frequency_characters'] as $item)
                               <li>{{$item['frequency']}} - {{$item['characters']}}</li>
                           @endforeach
                       @endif
                    </ul>
                </div>

            @endif
        </div>
    </div>
@endsection