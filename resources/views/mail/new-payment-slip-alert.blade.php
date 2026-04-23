<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Payment Slip Submitted</title>
<style>
  body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
  .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .header { background: #f59e0b; padding: 32px 32px 24px; text-align: center; }
  .header h1 { color: #ffffff; margin: 0; font-size: 22px; }
  .header p { color: #fef3c7; margin: 6px 0 0; font-size: 14px; }
  .body { padding: 32px; }
  .alert-badge { background: #fef3c7; color: #92400e; border-radius: 6px; padding: 12px 16px; font-weight: bold; text-align: center; margin-bottom: 24px; font-size: 15px; }
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
    <h1>🔔 New Payment Slip Received</h1>
    <p>Action Required — Verify in Admin Panel</p>
  </div>

  <div class="body">
    <p style="color:#374151; font-size:15px; margin-bottom:20px;">
      A customer has submitted a payment slip and is waiting for your verification.
      Please review and verify/reject the payment in the admin panel.
    </p>

    <div class="alert-badge">
      ⏳ Verification Required Within 24 Hours
    </div>

    <div style="background:#f9fafb; border-radius:6px; padding:16px; margin-bottom:20px;">
      <div class="info-row">
        <span class="label">Order Number</span>
        <span class="value">{{ $order->order_number }}</span>
      </div>
      <div class="info-row">
        <span class="label">Customer</span>
        <span class="value">{{ $order->shipping_name }}</span>
      </div>
      <div class="info-row">
        <span class="label">Customer Email</span>
        <span class="value">{{ $order->user?->email }}</span>
      </div>
      <div class="info-row">
        <span class="label">Payment Method</span>
        <span class="value">{{ $order->payment_method->label() }}</span>
      </div>
      <div class="info-row">
        <span class="label">Order Total</span>
        <span class="value">{{ $order->getFormattedTotal() }}</span>
      </div>
      <div class="info-row">
        <span class="label">Submitted At</span>
        <span class="value">{{ now()->format('d M Y, h:i A') }}</span>
      </div>
      <div class="info-row">
        <span class="label">Verify Before</span>
        <span class="value" style="color:#dc2626;">
          {{ $order->payment_deadline_at?->format('d M Y, h:i A') ?? 'N/A' }}
        </span>
      </div>
    </div>

    <div class="cta">
      <a href="{{ url('/admin/orders/' . $order->id . '/edit') }}" class="btn">
        Open in Admin Panel →
      </a>
    </div>
  </div>

  <div class="footer">
    &copy; {{ date('Y') }} Shahid Brothers Admin. This is an automated notification.
  </div>

</div>
</body>
</html>
