<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Not Verified</title>
<style>
  body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
  .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .header { background: #1e3a5f; padding: 32px 32px 24px; text-align: center; }
  .header h1 { color: #ffffff; margin: 0; font-size: 22px; }
  .header p { color: #a0b8d8; margin: 6px 0 0; font-size: 14px; }
  .body { padding: 32px; }
  .alert-badge { background: #fee2e2; color: #991b1b; border-radius: 6px; padding: 12px 16px; font-weight: bold; text-align: center; margin-bottom: 24px; font-size: 15px; }
  .reason-box { background: #fef9c3; border-left: 4px solid #ca8a04; border-radius: 4px; padding: 14px 16px; margin: 20px 0; font-size: 14px; color: #713f12; }
  .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
  .info-row:last-child { border-bottom: none; }
  .label { color: #6b7280; }
  .value { font-weight: 600; color: #111827; text-align: right; }
  .cta { text-align: center; margin-top: 28px; }
  .btn { display: inline-block; background: #25d366; color: #ffffff; padding: 12px 28px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; }
  .footer { background: #f9fafb; padding: 20px 32px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #f0f0f0; }
</style>
</head>
<body>
<div class="container">

  <div class="header">
    <h1>⚠️ Payment Not Verified</h1>
    <p>Shahid Brothers — Promotional Gift Items</p>
  </div>

  <div class="body">
    <p style="color:#374151; font-size:15px; margin-bottom:20px;">
      Dear <strong>{{ $order->shipping_name }}</strong>,<br><br>
      We were unable to verify your payment slip for the following order. Please review the reason below and re-submit a clear payment screenshot via WhatsApp.
    </p>

    <div class="alert-badge">
      Your payment slip could not be verified ❌
    </div>

    <div style="background:#f9fafb; border-radius:6px; padding:16px; margin-bottom:20px;">
      <div class="info-row">
        <span class="label">Order Number</span>
        <span class="value">{{ $order->order_number }}</span>
      </div>
      <div class="info-row">
        <span class="label">Payment Method</span>
        <span class="value">{{ $order->payment_method->label() }}</span>
      </div>
      <div class="info-row">
        <span class="label">Total Amount</span>
        <span class="value">{{ $order->getFormattedTotal() }}</span>
      </div>
    </div>

    <div class="reason-box">
      <strong>Reason for rejection:</strong><br>
      {{ $reason }}
    </div>

    <p style="color:#374151; font-size:14px;">
      <strong>What to do next?</strong><br>
      Please send your correct payment screenshot on WhatsApp along with your order number <strong>{{ $order->order_number }}</strong>. Our team will manually verify it.
    </p>

    <div class="cta">
      <a href="https://wa.me/923084570786?text={{ urlencode('Hi, my payment was rejected for order ' . $order->order_number . '. Here is my updated payment slip.') }}"
         class="btn">
        📲 Send Slip via WhatsApp
      </a>
    </div>

    <p style="color:#9ca3af; font-size:12px; text-align:center; margin-top:20px;">
      If you believe this is an error, please contact us immediately.<br>
      WhatsApp: +92-308-4570786
    </p>
  </div>

  <div class="footer">
    &copy; {{ date('Y') }} Shahid Brothers. All rights reserved.<br>
    This email was sent to {{ $order->user?->email }}.
  </div>

</div>
</body>
</html>
