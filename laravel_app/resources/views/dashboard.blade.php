@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">🛰️ Satellites</h4>
                </div>
                <div class="card-body">
                    @if($sats->isEmpty())
                        <div class="alert alert-info">
                            No satellites found. Please add satellites to the database.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Satellite Name</th>
                                        <th>TLE Line 1</th>
                                        <th>TLE Line 2</th>
                                        <th>Last Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($sats as $sat)
                                    <tr>
                                        <td>{{ $sat->id }}</td>
                                        <td><strong>{{ $sat->name }}</strong></td>
                                        <td><small class="text-muted">{{ substr($sat->tle_line1, 0, 30) }}...</small></td>
                                        <td><small class="text-muted">{{ substr($sat->tle_line2, 0, 30) }}...</small></td>
                                        <td>{{ $sat->last_updated }}</td>
                                        <td>
                                            <a href="/optimize/{{ $sat->id }}" class="btn btn-primary btn-sm">
                                                🚀 Optimize
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">✨ Optimized Windows</h4>
                </div>
                <div class="card-body">
                    @if($windows->isEmpty())
                        <div class="alert alert-warning">
                            No optimized windows yet. Run optimization on a satellite to generate results.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Sat ID</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Priority Score</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($windows as $w)
                                    <tr>
                                        <td><span class="badge bg-info">{{ $w->sat_id }}</span></td>
                                        <td>{{ $w->start_time }}</td>
                                        <td>{{ $w->end_time }}</td>
                                        <td>
                                            <span class="badge bg-success">
                                                {{ number_format($w->priority_score, 2) }}
                                            </span>
                                        </td>
                                        <td>{{ $w->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

