{{-- @foreach ($artists as $artist)
    <div>
        {{ $artist->Name }}
    </div>
@endforeach --}}

@foreach ($tracks as $track)
    <div>
        {{ $track->Name }}, {{ $track->UnitPrice }}, {{ $track->genre->Name }}, {{ $track->album->Title }}
    </div>
@endforeach

{{-- @foreach ($tracks as $track) --}}
    {{-- <div>
        {{ $artist->Name }}
    </div> --}}
{{-- @endforeach --}}

{{-- {{ $artist->Name }}

@foreach ($artist->albums as $album)
    <div>
        {{ $album->Title }}
    </div>
@endforeach --}}

{{-- {{ $album->Title }} - {{ $album->artist->Name }} --}}