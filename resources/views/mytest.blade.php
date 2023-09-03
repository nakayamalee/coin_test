<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  跳轉請稍後
  <form action="https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5" method="POST" class="hidden">
    <input name="MerchantID" type="hidden" value="{{ $data->MerchantID }}" readonly>
    <input name="MerchantTradeNo" type="hidden" value="{{ $data->MerchantTradeNo }}" readonly>
    <input name="MerchantTradeDate" type="hidden" value="{{ $data->MerchantTradeDate }}" readonly>
    <input name="PaymentType" type="hidden" value="{{ $data->PaymentType }}" readonly>
    <input name="PaymentInfoURL" type="hidden" value="{{ $data->PaymentInfoURL }}" readonly>
    <input name="TotalAmount" type="hidden" value="{{ $data->TotalAmount }}" readonly>
    <input name="TradeDesc" type="hidden" value="{{ $data->TradeDesc }}" readonly>
    <input name="ItemName" type="hidden" value="{{ $data->ItemName }}" readonly>
    <input name="IgnorePayment" type="hidden" value="{{ $data->IgnorePayment }}" readonly>
    <input name="ReturnURL" type="hidden" value="{{ $data->ReturnURL }}" readonly>
    <input name="ChoosePayment" type="hidden" value="{{ $data->ChoosePayment }}" readonly>
    <input name="EncryptType" type="hidden" value="{{ $data->EncryptType }}" readonly>
    <input name="CheckMacValue" type="hidden" value="{{ $data->CheckMacValue }}" readonly>
    <input name="ClientBackURL" type="hidden" value="{{ $data->ClientBackURL }}" readonly>
    <button type="submit">GOGO</button>
  </form>
</body>
</html>