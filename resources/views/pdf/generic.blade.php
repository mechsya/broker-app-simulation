@if (count($data) <= 0)
    <p>Data not found</p>
@else
    <h1>Data {{ ucfirst($model) }}</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                @foreach (array_keys($data->first()->getAttributes()) as $key)
                    <th>{{ $key }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    @foreach ($item->getAttributes() as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
