<!-- resources/views/emails/reservation-confirmation.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Reservation Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { background-color: #1a3a5f; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .details { background-color: #faf5eb; border-radius: 8px; padding: 15px; }
        .footer { text-align: center; padding: 20px; color: #777; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $restaurantName }}</h1>
        <h2>Reservation Confirmed!</h2>
    </div>
    
    <div class="content">
        <p>Hello {{ $reservation->name }},</p>
        <p>Thank you for choosing {{ $restaurantName }}! Your reservation has been confirmed.</p>
        
        <div class="details">
            <h3>Reservation Details:</h3>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($reservation->date)->format('F j, Y') }}</p>
            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($reservation->time)->format('g:i A') }}</p>
            <p><strong>Number of Guests:</strong> {{ $reservation->guests }}</p>
            @if($reservation->special_requests)
            <p><strong>Special Requests:</strong> {{ $reservation->special_requests }}</p>
            @endif
        </div>
        
        <p>We look forward to serving you authentic African cuisine!</p>
    </div>
    
    <div class="footer">
        <p>{{ $restaurantName }}<br>
        {{ config('mail.restaurant_address') }}</p>
        <p>If you need to modify your reservation, please call us at {{ config('mail.restaurant_phone') }}</p>
    </div>
</body>
</html>