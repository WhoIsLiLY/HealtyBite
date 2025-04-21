<h1>Welcome {{ $nama }} - {{ $angka }}</h1>

@if ($angka > 10)
    <h1>Angkanya besar</h1>
@elseif ($angka > 5)
    <h1>Angkanya agak besar</h1>
@else
    <h1>Angkanya nggak besar</h1>
@endif