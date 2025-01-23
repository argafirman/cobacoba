@foreach ($pap as $p)
    Nama {{ $p->nama_pabrik }}<br>
    Alamat:{{ $p->alamat }}
    @if ($p->cabang)
        <br>
        @foreach ($p->cabang as $c)
            {{ $c->nama_cabang }}
            @if ($c->karyawan)
                <br>
                @foreach ($c->karyawan as $k)
                    {{ $loop->index + 1 }}
                    &nprec;{{ $k->nama_karyawan }}<br>
                @endforeach
            @endif
        @endforeach
    @endif
@endforeach
