<table>
    <thead>
        <tr>
            @foreach ($submissions[0]->submission_data as $label => $data)
                <th>{{ strtoupper(str_replace('_', ' ', $label)) }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($submissions as $submission)
            <tr>
                @foreach ($submission->submission_data as $label => $data)
                    <td>{{ $data }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
