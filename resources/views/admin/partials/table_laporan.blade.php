<table>

    <thead>

        <tr>
            <th>Judul</th>
            <th>Sponsor</th>
            <th>Tanggal</th>
            <th>Dana</th>
        </tr>

    </thead>

    <tbody>

        @forelse($rows as $row)

        <tr>

            <td>
                {{ $row->judul }}
            </td>

            <td>
                {{ $row->sponsor->nama ?? '-' }}
            </td>

            <td>
                {{ $row->tanggal->format('d-m-Y') }}
            </td>

            <td>
                Rp {{ number_format($row->target_dana,0,',','.') }}
            </td>

        </tr>

        @empty

        <tr>
            <td colspan="4" class="text-center">
                Tidak ada data
            </td>
        </tr>

        @endforelse

        @if($withTotal)

        <tr>

            <td colspan="3">
                <b>Total</b>
            </td>

            <td>
                <b>
                    Rp {{ number_format($total,0,',','.') }}
                </b>
            </td>

        </tr>

        @endif

    </tbody>

</table>