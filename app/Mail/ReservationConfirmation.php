// app/Mail/ReservationConfirmation.php
namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $restaurantName;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
        $this->restaurantName = config('app.name', 'African Restaurant');
    }

    public function build()
    {
        return $this->subject('Reservation Confirmation - ' . $this->restaurantName)
                    ->view('emails.reservation-confirmation');
    }
}