@extends('layouts.app')

@section('content')

<div class="container">
    <div style="margin:50px;">
        <!-- Top Actions -->
        <div class="top-actions">
            <div><b>Generated short urls</b> <a href="/urls/create" class="btn">Generate</a></div>
        </div>

        <!-- URL Table -->
        <table class="url-table">
            <thead>
                <tr>
                    <th>Short URL</th>
                    <th>Long URL</th>
                    <th>Hits</th>
                    <th>User</th>
                    <th>Created On</th>
                </tr>
            </thead>
            <tbody>
                @forelse($urls as $url)
                    <tr>
                        <td>
                            <a href="{{ url('/s/'.$url->short_url) }}" target="_blank">
                                {{ url('/s/'.$url->short_url) }}
                            </a>
                        </td>
                        <td>{{ $url->long_url }}</td>
                        <td>{{ $url->hits }}</td>
                        <td>{{ $url->user->name }}</td>
                        <td>{{ $url->created_at->format('d M Y') }}</td>
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
                    Showing {{ $urls->count() }} of total {{ $urls->total() }}
                    <a href="{{ route('viewall') }}">View All</a>
            </div>
        </div>
    </div>

    <div style="margin-top:100px; margin-left:50px; margin-right:50px; margin-bottom:50px;">
        <!-- Top Actions -->
        <div class="top-actions">
            <div><b>Team Members </b></div>
            <div style="float: right;"><a href="{{ route('invite.form') }}" class="btn">Invite</a></div>
        </div>

        <!-- URL Table -->
        <table class="url-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Url</th>
                    <th>Role</th>
                    <th>Total Generated URLs</th>
                    <th>Total URL Hits</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topUsers as $user)
                    <tr>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->url_count }}</td>
                        <td>{{ $user->total_hits }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;">No user found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div style="float: left;" class="pagination">        
            <div class="pagination-info">
                    Showing {{ $topUsers->count() }} of total {{ $topUsers->total() }}
                    <a href="/#">View All</a>        
            </div>
        </div>
    </div>
</div>
@endsection