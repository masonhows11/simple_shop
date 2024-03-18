<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'amount'
    ];

    public function generateInvoice()
    {
        //        $data = [
        //            'foo' => 'bar'
        //        ];

        //// $this in ['order' => $this] array means this model = order model
        // return $pdf->stream('document.pdf');

        //        $pdf = PDF::loadView('front.invoice.invoice', ['order' => $this]);
        //        return $pdf->save(storage_path('app/public/invoices/').$this->id. '.pdf');

        $pdf = PDF::loadView('front.invoice.invoice', ['order' => $this]);
        return $pdf->save(storage_path('app/public/invoices/') . $this->id . '.pdf');
    }

    public function getStatus()
    {
        $result = null;
        switch ($this->status) {
            case 0:
                $result = __('messages.orders_wait_for_paid');
                break;

            case 1:
                $result = __('messages.paid');
                break;
                break;
            case 2:
                $result = __('messages.unpaid');
                break;
        }
        return $result;
    }

    public function downloadInvoice()
    {
        return Storage::disk('public')->download('invoices/'.$this->id. '.pdf');
    }

    public function products()
    {
        return $this->BelongsToMany(Product::class)->withPivot('quantity');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
