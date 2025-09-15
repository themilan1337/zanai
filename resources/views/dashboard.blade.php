<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 2rem;
        }
        .dashboard-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }
        .user-details {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        .detail-row {
            display: flex;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e9ecef;
        }
        .detail-row:last-child {
            margin-bottom: 0;
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #495057;
            width: 150px;
            flex-shrink: 0;
        }
        .detail-value {
            color: #212529;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .title {
            color: #333;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <div class="user-info">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" alt="User Avatar" class="avatar">
                @endif
                <div>
                    <h1 class="title">Welcome, {{ $user->name }}!</h1>
                    <p style="margin: 0; color: #666;">Authenticated via Google OAuth</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        
        <h2>User Details</h2>
        <div class="user-details">
            <div class="detail-row">
                <span class="detail-label">Name:</span>
                <span class="detail-value">{{ $user->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email:</span>
                <span class="detail-value">{{ $user->email }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Google ID:</span>
                <span class="detail-value">{{ $user->google_id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email Verified:</span>
                <span class="detail-value">{{ $user->email_verified_at ? 'Yes (' . $user->email_verified_at->format('M d, Y H:i') . ')' : 'No' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Account Created:</span>
                <span class="detail-value">{{ $user->created_at->format('M d, Y H:i') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Last Updated:</span>
                <span class="detail-value">{{ $user->updated_at->format('M d, Y H:i') }}</span>
            </div>
        </div>
        
        <div style="background: #e7f3ff; padding: 1rem; border-radius: 4px; border-left: 4px solid #2196f3;">
            <strong>🔒 Security Note:</strong> Your account is secured with Google OAuth 2.0 authentication.
        </div>
    </div>
</body>
</html>