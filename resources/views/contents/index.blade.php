@extends("layouts.master")

@section("title", "Index")

@section("contenuto")

<table>
    <thead>
        <tr>
            <th>Titolo</th>
            <th>Descrizione</th>
            <th>Mood</th>
            <th>tempo necessario</th>
                       
        </tr>
    </thead>
    <tbody>
        @foreach($contents as $content)
        <tr>
            <td>{{$content->title}}</td>
            <td>{{$content->description}}</td>
            <td>{{$content->mood_tag}}</td>
            <td>{{$content->time_needed_visiting}}</td>
            

        </tr>
        @endforeach
    </tbody>
</table>

@endsection
