<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #eebfcc; }
        .navbar { background: #DE3163; color: #eed9df; padding: 1rem 2rem; }
        .navbar h1 { font-size: 1.5rem; }
        .container { max-width: 1200px; margin: 2rem auto; padding: 0 1rem; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
        .stat-card { background: #eed9df; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .stat-card h3 { color: #7f8c8d; font-size: 0.9rem; margin-bottom: 0.5rem; }
        .stat-card p { color: #DE3163; font-size: 2rem; font-weight: bold; }
        .menu { background: #eed9df; padding: 1rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .menu h2 { margin-bottom: 1rem; color: #DE3163; }
        .menu ul { list-style: none; }
        .menu li { margin: 0.5rem 0; }
        .menu a { color: #000000; text-decoration: none; font-size: 1.1rem; }
        /* .menu a:hover { 
            text-decoration: none;
            background: #f0f0f0;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transform: translateX(5px);
            transition: all 0.3s;
        } */
         .menu a:hover { 
    text-decoration: none;
    background: #ee88a5;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    border-left: 4px solid #000000;
    transition: all 0.3s ease;
}
    </style>
</head>
<body>
    <div class="navbar">
        <h1> Elara - Books</h1>
    </div>
    
    <div class="container">
        <h2 style="margin-bottom: 1rem; color: #DE3163;">Dashboard</h2>
        
        <div class="stats">
            <div class="stat-card">
                <h3>Total Books</h3>
                <p>{{ $stats['total_books'] }}</p>
            </div>
            <div class="stat-card">
                <h3>Available Books</h3>
                <p>{{ $stats['available_books'] }}</p>
            </div>
            <div class="stat-card">
                <h3>Active Members</h3>
                <p>{{ $stats['total_members'] }}</p>
            </div>
            <div class="stat-card">
                <h3>Active Borrowings</h3>
                <p>{{ $stats['active_borrowings'] }}</p>
            </div>
            <div class="stat-card">
                <h3>Overdue Books</h3>
                <p style="color: #ff0000;">{{ $stats['overdue_books'] }}</p>
            </div>
            <div class="stat-card">
                <h3>Unpaid Fines</h3>
                <p style="color: #e66722;">{{ number_format($stats['unpaid_fines'], 2) }} DH</p>
            </div>
        </div>

        <div class="menu">
            <h2>Quick Links</h2>
            {{-- <ul>
                <li><a href="{{ route('books.index') }}">Manage Books</a></li>
                <li><a href="{{ route('authors.index') }}">Manage Authors</a></li>
                <li><a href="{{ route('publishers.index') }}">Manage Publishers</a></li>
                <li><a href="{{ route('members.index') }}">Manage Members</a></li>
                <li><a href="{{ route('borrowings.index') }}">Manage Borrowings</a></li>
                <li><a href="{{ route('reservations.index') }}">Manage Reservations</a></li>
                <li><a href="{{ route('fines.index') }}">Manage Fines</a></li>
            </ul> --}}
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
    <a href="{{ route('books.index') }}" class="btn btn-primary" style="text-align: center; padding: 2rem; font-size: 1.1rem; display: flex; flex-direction: column; gap: 0.5rem; align-items: center;">
        <span style="font-size: 2.5rem; font-weight: bold;">&#128214;</span>
        <span>Manage Books</span>
    </a>
    <a href="{{ route('authors.index') }}" class="btn btn-success" style="text-align: center; padding: 2rem; font-size: 1.1rem; display: flex; flex-direction: column; gap: 0.5rem; align-items: center;">
        <span style="font-size: 2.5rem; font-weight: bold;">&#9998;</span>        <span>Manage Authors</span>
    </a>
    <a href="{{ route('publishers.index') }}" class="btn btn-info" style="text-align: center; padding: 2rem; font-size: 1.1rem; display: flex; flex-direction: column; gap: 0.5rem; align-items: center;">
        <span style="font-size: 2.5rem; font-weight: bold;">&#127970;</span>        <span>Manage Publishers</span>
    </a>
    <a href="{{ route('members.index') }}" class="btn btn-warning" style="text-align: center; padding: 2rem; font-size: 1.1rem; display: flex; flex-direction: column; gap: 0.5rem; align-items: center; color: #212529;">
        <span style="font-size: 2.5rem; font-weight: bold;">&#128101;</span>        <span>Manage Members</span>
    </a>
    <a href="{{ route('borrowings.index') }}" class="btn btn-primary" style="text-align: center; padding: 2rem; font-size: 1.1rem; display: flex; flex-direction: column; gap: 0.5rem; align-items: center;">
        <span style="font-size: 2.5rem; font-weight: bold;">&#128203;</span>        <span>Manage Borrowings</span>
    </a>
    <a href="{{ route('reservations.index') }}" class="btn btn-info" style="text-align: center; padding: 2rem; font-size: 1.1rem; display: flex; flex-direction: column; gap: 0.5rem; align-items: center;">
        <span style="font-size: 2.5rem; font-weight: bold;">&#128278;</span>        <span>Manage Reservations</span>
    </a>
    <a href="{{ route('fines.index') }}" class="btn btn-danger" style="text-align: center; padding: 2rem; font-size: 1.1rem; display: flex; flex-direction: column; gap: 0.5rem; align-items: center;">
        <span style="font-size: 2.5rem; font-weight: bold;">&#128176;</span>        <span>Manage Fines</span>
    </a>
</div>
        </div>
    </div>
</body>
</html>