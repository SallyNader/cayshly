@extends('emails._mail_body')

@section('title') {{ trans('emails.title-order-confirm') }} @endsection

@section('mailTitle') {{ trans('emails.mailTitle-order-confirm') }} @endsection

@section('mailBodyContent')
  	<!-- Body -->
		<tr>
			<td colspan="2" style="padding: 0px 20px;">
  				<p style="font-size:20px;color:#333;">{{ trans('emails.thank') }}
  				<span style="font-weight:bold;color:#e0332a;">{{ $name }}</span>,</p>

          <p style="font-size:14px;color:#333;padding-bottom:10px;margin-bottom:10px;">
  					{{ trans('emails.we-confirm') }}.<br>
  					{{ trans('emails.delivery-process') }}.
  				</p>

          <div>
            <h2>Your order details:</h2>
            <table style="border:1px solid #eee;">
              <tr style="background-color:#ccc;">
                <td>Quants.</td>
                <td>Products</td>
              </tr>
              @foreach ($orders as $order)
                <tr>
                  <td>{{ $order->BProQuant }}</td>
                  <td>{{ \DB::table('products')->where('ProId', $order->BProId)->first()->ProName }}</td>
                </tr>
              @endforeach
            </table>
          </div>

  		</td>
		</tr>
@endsection
