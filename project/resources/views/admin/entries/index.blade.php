@extends('layouts.admin')

@section('title', 'Entries | Mall of the North QR Hunt')

@section('content')
    <section class="admin-card">
        <div class="admin-toolbar">
            <div>
                <h1 class="admin-title">Competition Entries</h1>
                <p class="admin-subtitle">View registered players and export the current entry list.</p>
            </div>

            <div class="admin-toolbar__actions">
                <a href="{{ route('admin.entries.export') }}" class="admin-button admin-button--secondary">Download Excel</a>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="admin-button admin-button--ghost">Logout</button>
                </form>
            </div>
        </div>

        <div class="admin-stats">
            <div class="admin-stat">
                <span class="admin-stat__label">Total Entries</span>
                <strong class="admin-stat__value">{{ $entryCount }}</strong>
            </div>
            <div class="admin-stat">
                <span class="admin-stat__label">Completed Players</span>
                <strong class="admin-stat__value">{{ $completedCount }}</strong>
            </div>
        </div>

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Cell Phone</th>
                        <th>Stores Found</th>
                        <th>Visited Stores</th>
                        <th>Completed</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($entries as $entry)
                        <tr>
                            <td>{{ $entry->name }} {{ $entry->surname }}</td>
                            <td>{{ $entry->email }}</td>
                            <td>{{ $entry->cell_phone }}</td>
                            <td>{{ $entry->visits_count }}/20</td>
                            <td>{{ $entry->stores->pluck('name')->implode(', ') ?: 'None yet' }}</td>
                            <td>{{ $entry->completed_at ? $entry->completed_at->format('Y-m-d H:i') : 'No' }}</td>
                            <td>{{ $entry->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="admin-table__empty">No entries yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="admin-pagination">
            {{ $entries->links() }}
        </div>
    </section>
@endsection
