@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-secondary fw-bold">Jobs Report</h1>

    {{-- Toast Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">List of Jobs</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Job Title</th>
                        <th>Department</th>
                        <th>Location</th>
                        <th>Open Date</th>
                        <th>Close Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $index => $job)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->department }}</td>
                            <td>{{ $job->location }}</td>
                            <td>{{ $job->open_date->format('d-m-Y') }}</td>
                            <td>{{ $job->close_date->format('d-m-Y') }}</td>
                            <td>{{ ucfirst($job->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No jobs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            {{ $jobs->links() }}
        </div>
    </div>
</div>
@endsection
