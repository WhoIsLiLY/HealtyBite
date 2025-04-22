<h1>Piih lokasi</h1>
<!--Cara 1-->
<!-- <a href="/menu/dinein">Dine In</a>
<a href="/menu/takeaway">Take Away</a> -->
<!--Cara 2-->
<a href = {{ url("menu/dinein") }}>Dine In</a>
<a href = {{ route("menu",
["type" => "takeaway"]) }}>Take away</a>
<br>
<a href = {{ url("welcome") }}> Welcome Pakai URL</a>
<a href = {{ route("home") }}> Welcome Pakai Route</a>