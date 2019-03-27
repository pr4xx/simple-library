<table>
    <thead>
    <tr>
        <th>Signatur</th>
        <th>Titel</th>
        <th>Titel (Original)</th>
        <th>Titel (Übersetzt)</th>
        <th>Jahr</th>
        <th>Autor*in</th>
        <th>Ort</th>
        <th>Gattung</th>
        <th>Schlagworte</th>
        <th>Bemerkungen</th>
        <th>Erfasst am</th>
        <th>Ausgeliehen von</th>
        <th>Ausgeliehen bis</th>
    </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
        <tr>
            <td>{{ $book->signature }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->original_title }}</td>
            <td>{{ $book->translated_title }}</td>
            <td>{{ $book->year }}</td>
            <td>{{ optional($book->author)->name }}</td>
            <td>{{ optional($book->origin)->title }}</td>
            <td>{{ optional($book->category)->title }}</td>
            <td>{{ optional($book->tags)->pluck('title')->implode(', ') }}</td>
            <td>{{ $book->notes }}</td>
            <td>{{ $book->created_at->format('d.m.Y') }}</td>
            @php
                $lending = $book->lendings->first();
            @endphp
            @if($lending)
                <td>
                    {{ $lending->reader->first_name }}
                    {{ $lending->reader->last_name }}
                </td>
                <td>
                    {{ $lending->due_at->format('d.m.Y') }}
                </td>
            @else
                <td></td>
                <td></td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
