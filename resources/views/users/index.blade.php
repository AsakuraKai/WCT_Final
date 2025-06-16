@extends('layouts.app')

@section('title', 'Users Command Center')

@section('content')
<!-- Hero Section -->
<div class="hero-section mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="font-gaming mb-3">
                    <i class="bi bi-people-fill text-neon-purple"></i>
                    User Command Center
                </h1>
                <p class="lead font-tech mb-4">Manage your gaming community. Monitor player profiles, track activities, and deploy new user accounts.</p>
            </div>
            <div class="col-lg-4 text-center">
                <div class="stat-circle">
                    <div class="stat-number font-gaming">{{ $users->total() }}</div>
                    <div class="stat-label">Active Users</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Command Panel Header -->
    <div class="card-glass mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <i class="bi bi-shield-check text-neon-green me-2 fs-4"></i>
                    <h5 class="font-gaming mb-0">User Management System</h5>
                </div>
                <button type="button" class="btn btn-neon" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-person-plus"></i> Deploy New User
                </button>
            </div>
        </div>
    </div>

    <!-- Search Command Panel -->
    <div class="card-glass mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-radar text-neon-cyan me-2 fs-4"></i>
                <h6 class="font-gaming mb-0">User Scanner</h6>
            </div>
            <form method="GET" action="{{ route('users.index') }}" class="row g-3">
                <div class="col-lg-8 col-md-8">
                    <div class="input-group-neon">
                        <span class="input-group-text">
                            <i class="bi bi-search text-neon-cyan"></i>
                        </span>
                        <input type="text" 
                               name="search" 
                               class="form-control-neon" 
                               placeholder="Search by name or email..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <button type="submit" class="btn btn-neon w-100">
                        <i class="bi bi-funnel"></i> Scan
                    </button>
                </div>
                <div class="col-lg-2 col-md-2">
                    @if(request('search'))
                        <a href="{{ route('users.index') }}" class="btn btn-outline-neon w-100">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>    <!-- User Database Display -->
    <div class="card-glass mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-database text-neon-orange me-2"></i>
                    <h6 class="font-gaming mb-0 me-3">
                        @if(request('search'))
                            Search Results: "{{ request('search') }}"
                        @else
                            User Database
                        @endif
                    </h6>
                    <span class="badge badge-neon">{{ $users->total() }} Players</span>
                </div>
            </div>

            @if($users->count() > 0)
                <div class="users-grid">
                    @foreach($users as $user)
                        <div class="user-card">
                            <div class="user-avatar">
                                <div class="avatar-gaming">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                @if($user->id === auth()->id())
                                    <div class="user-badge-self">YOU</div>
                                @endif
                            </div>
                            
                            <div class="user-info">
                                <h6 class="user-name font-tech">{{ $user->name }}</h6>
                                <div class="user-meta">
                                    <div class="meta-item">
                                        <i class="bi bi-envelope text-neon-cyan"></i>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="bi bi-calendar text-neon-green"></i>
                                        <span>{{ $user->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="bi bi-clock text-neon-orange"></i>
                                        <span>{{ $user->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                
                                <div class="user-status">
                                    @if($user->email_verified_at)
                                        <span class="status-verified">
                                            <i class="bi bi-shield-check"></i> Verified
                                        </span>
                                    @else
                                        <span class="status-pending">
                                            <i class="bi bi-shield-exclamation"></i> Pending
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="user-actions">
                                    <button class="btn btn-action-edit" onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    @if($user->id !== auth()->id())
                                        <button class="btn btn-action-delete" onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-people display-1 text-neon-purple"></i>
                    <h5 class="font-gaming mt-3">No Users Detected</h5>
                    <p class="text-muted">No players found matching your search parameters.</p>
                    <a href="{{ route('users.index') }}" class="btn btn-neon">
                        <i class="bi bi-arrow-clockwise"></i> Reset Scanner
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="pagination-container">
            <div class="card-glass">
                <div class="card-body text-center">
                    <div class="pagination-gaming">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>    @endif
</div>
@endsection
