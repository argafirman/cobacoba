@foreach ($kontrakkans as $kontrakkan)
    <h3>{{ $kontrakkan->name }}</h3>
    <ul>
        @foreach ($kontrakkan->penyewa as $penyewa)
            <li>{{ $penyewa->name }}</li>
        @endforeach
    </ul>
@endforeach
