@extends('include.master')
@section('content')
    <main class="main-content">
        <div class="card stats-card">
            <h3>Total Songs</h3>
            <h2 style="color: var(--primary-red);">15,432</h2>
            <p>↑ 12% from last month</p>
        </div>
        <div class="card stats-card">
            <h3>Active Users</h3>
            <h2 style="color: var(--primary-yellow);">45,231</h2>
            <p>↑ 8% from last week</p>
        </div>
        <div class="card stats-card">
            <h3>Revenue</h3>
            <h2 style="color: var(--primary-red);">$12,450</h2>
            <p>↓ 3% from last month</p>
        </div>
        <div class="chart-container">
            <!-- Add your chart here -->
            <h3>Monthly Analytics</h3>
            <canvas id="analyticsChart"></canvas>
        </div>
    </main>
@endsection
