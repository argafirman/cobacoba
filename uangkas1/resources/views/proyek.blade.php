<form action="" method="GET">
    <input type="text" name="cari">
    <button class="submit">cari</button>
</form>

<table border="1">
    <thead>
        <tr>
            <td>No</td>
            <td>nama proyek</td>
            <td>deskripsi</td>
            <td>nama tim </td>
            <td>nama anggota</td>
            <td>jumlah Tim</td>
        </tr>
    </thead>

    <tbody>
        @foreach ($pro as $p)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $p->nama_proyek }}</td>
                <td>{{ $p->deskripsi }}</td>
                <td>
                    @if ($p->tim)
                        @foreach ($p->tim as $t)
                            <ul>
                                <li>{{ $t->nama_tim }}</li>
                            </ul>
                        @endforeach
                    @endif
                </td>
                <td>
                    @foreach ($p->tim as $t)
                        @if ($t->anggota)
                            @foreach ($t->anggota as $a)
                                <ul>
                                    <li>{{ $a->nama_anggota }}</li>
                                </ul>
                            @endforeach
                        @endif
                    @endforeach
                </td>
                <td>{{ $p->tim_count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
