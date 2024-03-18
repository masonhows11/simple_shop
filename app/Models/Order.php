<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

        $pdf = PDF::loadView('front.invoice.invoice_test', ['order' => $this]);
        return $pdf->save(storage_path('app/public/invoices/').$this->id. '.pdf');
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
