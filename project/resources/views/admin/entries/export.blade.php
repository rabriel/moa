<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Mall of the North Entries Export</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Cell Phone</th>
                <th>Stores Found</th>
                <th>Visited Stores</th>
                <th>Completed At</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $entry)
                <tr>
                    <td>{{ $entry->name }}</td>
                    <td>{{ $entry->surname }}</td>
                    <td>{{ $entry->email }}</td>
                    <td>{{ $entry->cell_phone }}</td>
                    <td>{{ $entry->visits_count }}</td>
                    <td>{{ $entry->stores->pluck('name')->implode(', ') }}</td>
                    <td>{{ optional($entry->completed_at)->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $entry->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
