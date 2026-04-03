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
                    Showing {{ $urls->lastItem() }} of total {{ $urls->total() }}
                @if ($urls->onFirstPage())
                    <span class="disabled">Prev</span>
                @else
                    <a href="{{ $urls->previousPageUrl() }}">Prev</a>
                @endif
                @if ($urls->hasMorePages())
                    <a href="{{ $urls->nextPageUrl() }}">Next</a>
                @else
                    <span class="disabled">Next</span>
                @endif
            </div>
        </div>
    </div>   
</div>
@endsection