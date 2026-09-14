{{-- resources/views/form/phamacy/sale_receipt.blade.php --}}
<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <title>វិក្កយបត្រ - {{ $billing->invoice_prefix }}{{ str_pad($sale->sale_id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        @php
            $isReceipt = $billing->print_size === '80mm';
            $subtotal = (float) $sale->total_amount;
            $taxPct = (float) ($billing->tax_percent ?? 0);
            $taxAmount = $subtotal * ($taxPct / 100);
            $grandTotal = $subtotal + $taxAmount;
            $cur = $billing->currency_symbol ?: '$';
        @endphp
    
     body    {
            font-famil
             y  : 'Khmer OS Battambang', Arial, sa
            ns-serif;
            font-size: {{ $isReceipt ? '11px' : '13px' }};
            color: #000;
            margin: 
              0 ;

                     
   padding: {{ $isReceipt ? '6px' : '20px' }};
        }
  
         
       
        
            
           
               .box { ma
x           -width: {{ $isReceipt ? '280px' : '700px' }}; margin: 0 auto; }

        .header { te
x           t-align: c
e           nter; marg
i               n-bottom: 8px; }
    
       
            
    .header h4 
           { margin: 0; fo
           nt-size: {{ $isReceipt ? '13px' : '18px' }}; }
            

           
       
        .header
            p { margin: 2p
    x        0; font-size: {{ $isReceipt ? '10px' : '12px' }}; color: #444; }
        
       
            
   
        .meta {
            display: fle
        x   ; justify-content: space-b
       e    tween; font-si
     z  e: {{ $isReceipt ? '10px' : '12px' }}; margin: 6px 0; }

        tab
   l    e { 
     w      idth: 100%; borde
r           -collapse:
                collapse; margin: 8px 0; }

            
       
        th, td { p
a           dding: 4px 3px; font-size: {{ $isReceipt ? '10px' : '12px' }}; }
        thead t
       h { borde
           r-bottom: 1px solid
        #
000; text-align: left; }
        td.num, t
           h.num { text-alig
           n: right; }
              

       
            
         .totals { mar
     g      in-top: 6px; f
   o        nt-size: {{ $isReceipt ? '11px' : '13px' }}; }

       
        .totals 
        d   iv { display: flex
       ;     justify-content: space-bet
      w     een; padding: 2p
     x       0; }

       
        .grand { 
f           ont-weight: bold; b
           order-top: 1px sol
        i   d #000; ma
r               gin-top: 4px; padding-top: 4px; }

     
          
                   .footer { text-align: center; margin-top: 12px; font-size: {{ $isReceipt ? '10px' : '12px' }}; color: #555; }
  
         @med ia prin
   t             {
           
        

                
  
                
               
                                        @page 
{                size: {{ $isReceipt ? '80mm auto' : 'A4' }}; margin: {{ $isReceipt ? '0' : '10mm' }}; }

            body { padd
               ing: {{ $isReceipt ? '4px' : '0' }}; }
            .no-print { display: none; }
        }
</style
>
</head>
<body onload="window.print()">
    
    <div class="no-print" style="text-al
           ign:center; margin-bottom:10px;">
        <button onclick="window.print()" style="padding:6px 14px; background:#28a745; color:#fff; border:none; border-radius:4px;">
            🖨️ បោះពុម្ព
        </button>
</div>
    
    <div class="box">
        <div class="header">
            <h4>{{ $general->clinic_name ?? config('app.name', 'Clinic') }}</h4>
        @if(!empty($general->address))
            <p>{{ $general->address }}</p>
        @endif
        @if(!empty($general->phone))
            <p>Tel: {{ $general->phone }}</p>
        @endif
    </div>
 
         <div   class="meta">
            <span>លេខ: {{ $billing->invoice_prefix }}{{ str_pad($sale->sale_id, 6, '0', STR_PAD_LEFT) }}</span>
            <span>{{ $sale->sale_date->format('d-M-Y h:i A') }}</span>
        </div>
      <div   class="meta">
            <span>អតិថិជន: {{ $sale->patient->full_name ?? 'អតិថិជនចរណ៍' }}</span>
    </div>
  
       <tab   le>
          <the  ad>
               <tr> 
                    <th>ថ្នាំ</th>
                    <th class="num">ចំនួន</th>
                    <th class="num">តម្លៃ</th>
                    <th class="num">សរុប</th>
                </tr>
            </thead>
         <tbo   dy>
                @foreach($sale->items as $item)
                    <tr>
                        <td>{{ $item->medicine->medicine_name ?? '-' }}</td>
                        <td class="num">{{ $item->quantity }}</td>
                        <td class="num">{{ $cur }}{{ number_format($item->unit_price, 2) }}</td>
                        <td class="num">{{ $cur }}{{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
    </table>
   
       <div   class="totals">
            <div><span>សរុបរង</span><span>{{ $cur }}{{ number_format($subtotal, 2) }}</span></div>
            @if($taxPct > 0)
                <div><span>ពន្ធ ({{ $taxPct }}%)</span><span>{{ $cur }}{{ number_format($taxAmount, 2) }}</span></div>
            @endif
            <div class="grand"><span>សរុបចុងក្រោយ</span><span>{{ $cur }}{{ number_format($grandTotal, 2) }}</span></div>
    </div>
  
          @if(!empty($billing->invoice_footer))
            <p class="footer">{{ $billing->invoice_footer }}</p>
        @endif
</div>


</body>
</html>
