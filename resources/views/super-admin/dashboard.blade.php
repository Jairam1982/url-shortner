@extends('layouts.app')

@section('content')

<div class="container">
    <div style="margin:50px;">
        <!-- Top Actions -->
        <div class="top-actions">
            <div><b>Clients</b></div>
            <div style="float: right;"><a href="{{ route('invite.form') }}" class="btn">Invite</a></div>
        </div>

        <!-- URL Table -->
        <table class="url-table">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Users</th>
                    <th>Total Generated URLs</th>
                    <th>Total URL Hits</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr>
                        <td>
                            <div class="company-name">{{ $company->name}}</div>
                            <div class="company-email">{{ $company->email}}</div>
                        </td>
                        <td>{{ $company->users_count }}</td>
                        <td>{{ $company->total_urls }}</td>
                        <td>{{ $company->total_hits }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;">No URLs found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div style="float: left;" class="pagination">        
            <div class="pagination-info">
                    Showing {{ $companies->count() }} of total {{ $companies->total() }}
                    <a href="{{ route('viewall') }}">View All</a>
            </div>
        </div>
    </div>

    
</div>
@endsection