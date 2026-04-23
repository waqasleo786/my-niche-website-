<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Verified</title>
<style>
  body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
  .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .header { background: #1e3a5f; padding: 32px 32px 24px; text-align: center; }
  .header h1 { color: #ffffff; margin: 0; font-size: 22px; }
  .header p { color: #a0b8d8; margin: 6px 0 0; font-size: 14px; }
  .body { padding: 32px; }
  .success-badge { background: #d1fae5; color: #065f46; border-radius: 6px; padding: 12px 16px; font-weight: bold; text-align: center; margin-bottom: 24px; font-size: 15px; }
  .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
  .info-row:last-child { border-bottom: none; }
  .label { color: #6b7280; }
  .value { font-weight: 600; color: #111827; text-align: right; }
  .cta { text-align: center; margin-top: 28px; }
  .btn { display: inline-block; background: #1e3a5f; color: #ffffff; padding: 12px 28px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; }
  .footer { background: #f9fafb; padding: 20px 32px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #f0f0f0; }
</style>
</head>
<body>
<div class="container">

  <div class="header">
    <h1>✅ Payment Verified!</h1>
    <p>Shahid Brothers — Promotional Gift Items</p>
  </div>

  <div class="body">
    <p style="color:#374151; font-size:15px; margin-bottom:20px;">
      Dear <strong>{{ $order->shipping_name }}</strong>,<br><br>
      Great news! Your payment has been verified and your order is now being processed.
    </p>

    <div class="success-badge">
      Your order is confirmed and in processing 🎉
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
      <div class="info-row">
        <span class="label">Verified At</span>
        <span class="value">{{ now()->format('d M Y, h:i A') }}</span>
      </div>
      <div class="info-row">
        <span class="label">Order Status</span>
        <span class="value" style="color:#7c3aed;">Processing</span>
      </div>
    </div>

    <p style="color:#6b7280; font-size:13px;">
      Your items are now being packed and will be shipped soon. You will receive another email once your order is on its way.
    </p>

    <p style="color:#6b7280; font-size:13px;">
      For any queries, contact us on WhatsApp: <strong>+92-308-4570786</strong>
    </p>

    <div class="cta">
      <a href="{{ url('/') }}" class="btn">Continue Shopping</a>
    </div>
  </div>

  <div class="footer">
    &copy; {{ date('Y') }} Shahid Brothers. All rights reserved.<br>
    This email was sent to {{ $order->user?->email }}.
  </div>

</div>
</body>
</html>
