{{--

@if (count($failed) > 0)
    <h1>Failed to import</h1>
    <pre>
        @php
            echo json_encode($failed, JSON_PRETTY_PRINT);
        @endphp
    </pre>
    <hr>
    <hr>
@endif
<h1>Union not found for</h1>
<pre>
    @php
        print_r($missed);
    @endphp
</pre> --}}
{{-- <hr>
<hr>
<h1>Imported Data</h1>
<pre>
    @php
        print_r($array);
    @endphp
</pre> --}}

<p>
    <b>Imported Count:</b> {{ count($array) }}
    <br>
    <b>Failed Count:</b> {{ count($failed) }}
    <br>
    <b>Missed Count:</b> {{ count($missed) }}
</p>

@if (count($failed) > 0)
    <h1>Failed to import</h1>
    <textarea style="width: 100dvw; height: 100dvh">{!! json_encode($failed, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}</textarea>
@endif

<h1>Union not found</h1>
<textarea style="width: 100dvw; height: 100dvh">{!! json_encode($missed, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}</textarea>
