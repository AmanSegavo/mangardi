<?php

namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPaymentProofUploaded extends Notification
{
    use Queueable;

    protected $transaction;

    /**
     * Cipta instance notifikasi baru.
     *
     * @param \App\Models\Transaction $transaction
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Dapatkan saluran penghantaran notifikasi.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database']; // Hantar ke pangkalan data
    }

    /**
     * Dapatkan perwakilan array notifikasi.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // Pengguna yang membuat transaksi
        $userName = $this->transaction->user->name ?? 'Pengguna';

        return [
            'transaction_id' => $this->transaction->id,
            'message' => "Bukti bayaran baru telah diunggah untuk transaksi #" . $this->transaction->id . " oleh pengguna {$userName}.",
            'url' => route('admin.transactions.index'), // URL untuk admin klik
        ];
    }
}
