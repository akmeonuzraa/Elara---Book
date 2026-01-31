<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library Management System')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background: #eebfcc; }
        
        /* Navbar */
        .navbar {background: linear-gradient(135deg, #eebfcc 0%, #DE3163 100%); color: #eed9dfsmoke; padding: 1rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar h1 { font-size: 1.8rem; margin-bottom: 0.5rem; }
        .navbar nav { display: flex; gap: 1.5rem; flex-wrap: wrap; }
        .navbar a { color: black; text-decoration: none; padding: 0.5rem 1rem; border-radius: 5px; transition: all 0.3s; }
        .navbar a:hover {background: rgba(255,255,255,0.2); }
        
        /* Container */
        .container { max-width: 1400px; margin: 2rem auto; padding: 0 1rem; }
        
        /* Page Header */
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
        .page-header h2 { color: #DE3163; font-size: 2rem; }
        
        /* Buttons */
        .btn { display: inline-block; padding: 0.75rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 500; transition: all 0.3s; border: none; cursor: pointer; font-size: 1rem; }
        .btn-primary {background: #DE3163; color: black; }
        .btn-primary:hover {background: #000000; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102,126,234,0.3); color: #eebfcc; }
        /* .btn-success {background: #DE3163; color: #eed9df; }
        .btn-success:hover {background: ##000000; }
        .btn-danger {background: #DE3163; color: #eed9df; }
        .btn-danger:hover {background: ##000000; }
        .btn-warning {background: #DE3163; color: #eebfcc; }
        .btn-warning:hover {background: ##000000; }
        .btn-info {background: #DE3163; color: #eed9df; }
        .btn-info:hover {background: ##000000; } */
        .btn-sm { padding: 0.5rem 1rem; font-size: 0.875rem; }
        
        /* Cards */
        .card {background: #eed9df; border-radius: 10px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 1.5rem; }
        .card h3 { color: #DE3163; margin-bottom: 1rem; font-size: 1.3rem; }
        
        /* Table */
        .table-container { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse;background: #eed9df; border-radius: 10px; overflow: hidden; }
        thead {background: linear-gradient(135deg, #eebfcc 0%, #DE3163 100%); color: black; }
        th, td { padding: 1rem; text-align: left; border-bottom: 1px solid #DE3163; }
        tbody tr:hover {background: #eebfcc; }
        tbody tr:last-child td { border-bottom: none; }
        
        /* Forms */
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; color: #DE3163; font-weight: 500; }
        .form-control { width: 100%; padding: 0.75rem; border: 1px solid #DE3163; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s; }
        .form-control:focus { outline: none; border-color: #DE3163; box-shadow: 0 0 0 3px rgba(102,126,234,0.1); }
        select.form-control { cursor: pointer; }
        textarea.form-control { min-height: 120px; resize: vertical; }
        
        /* Alerts */
        .alert { padding: 1rem 1.5rem; border-radius: 6px; margin-bottom: 1.5rem; }
        .alert-success {background: #DE3163; color: #eebfcc; border-left: 4px solid #DE3163; }
        /* .alert-error {background: #DE3163; color: #DE3163; border-left: 4px solid #DE3163; }
        .alert-info {background: #DE3163; color: #DE3163; border-left: 4px solid #DE3163; } */
        
        /* Badges */
        .badge { display: inline-block; padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500; }
        .badge-success {background: #DE3163; color: #eed9df; }
        .badge-danger {background: #DE3163; color: #eed9df; }
        .badge-warning {background: #DE3163; color: #eed9df; }
        .badge-info {background: #DE3163; color: #eed9df; }
        .badge-secondary {background: #DE3163; color: #eed9df; }
        
        /* Pagination */
        /* Pagination - COMPACT */
/* Pagination - TRÈS COMPACT */

        .pagination { display: flex; gap: 0.5rem; justify-content: center; margin-top: 2rem; flex-wrap: wrap; }
        .pagination a, .pagination span { padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; color: #DE3163;background: #eed9df; border: 1px solid #DE3163; }
        .pagination .active {background: #DE3163; color: #eed9df; }
        .pagination a:hover {background: #eebfcc; }
        
        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card {background: #eed9df; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .stat-card h4 { color: #DE3163; font-size: 0.9rem; margin-bottom: 0.5rem; text-transform: uppercase; }
        .stat-card p { font-size: 2.5rem; font-weight: bold; color: #DE3163; }
        
        /* Action Buttons */
        .actions { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        
        /* Empty State */
        .empty-state { text-align: center; padding: 3rem 1rem; color: #DE3163; }
        .empty-state p { font-size: 1.2rem; margin-bottom: 1rem; }
        
        /* Filter Section */
        .filters {background: #eed9df; padding: 1.5rem; border-radius: 10px; margin-bottom: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .filters form { display: flex; gap: 1rem; flex-wrap: wrap; align-items: end; }
        .filters .form-group { margin-bottom: 0; flex: 1; min-width: 200px; }
        
        /* Detail View */
        .detail-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; }
        .detail-item { margin-bottom: 1rem; }
        .detail-item label { display: block; color: #DE3163; font-size: 0.9rem; margin-bottom: 0.25rem; }
        .detail-item p { color: #DE3163; font-size: 1.1rem; }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar nav { gap: 0.5rem; }
            .page-header { flex-direction: column; align-items: flex-start; }
            table { font-size: 0.875rem; }
            th, td { padding: 0.75rem 0.5rem; }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>📚 Library Management System</h1>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('books.index') }}">Books</a>
            <a href="{{ route('authors.index') }}">Authors</a>
            <a href="{{ route('publishers.index') }}">Publishers</a>
            <a href="{{ route('members.index') }}">Members</a>
            <a href="{{ route('borrowings.index') }}">Borrowings</a>
            <a href="{{ route('reservations.index') }}">Reservations</a>
            <a href="{{ route('fines.index') }}">Fines</a>
        </nav>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>