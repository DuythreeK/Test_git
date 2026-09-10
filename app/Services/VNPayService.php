<?php

namespace App\Services;

use App\Models\Order;

class VNPayService
{
    /**
     * Tạo URL thanh toán VNPay
     */
    public function createPaymentUrl(Order $order): string
    {
        $vnp_TmnCode = config('vnpay.tmn_code');
        $vnp_HashSecret = config('vnpay.hash_secret');
        $vnp_Url = config('vnpay.url');
        $vnp_Returnurl = config('vnpay.return_url');

        $vnp_TxnRef = (string) $order->id; // Mã tham chiếu đơn hàng
        $vnp_OrderInfo = 'Thanh toan don hang #' . $order->id;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = (int) ($order->total_price * 100); // VNPay tính theo đơn vị Đồng * 100
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'VNPAYQR'; // Mở trực tiếp giao diện quét mã QR
        $vnp_IpAddr = request()->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_BankCode" => $vnp_BankCode,
        ];

        // Sắp xếp các tham số theo alphabet
        ksort($inputData);

        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (!empty($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    /**
     * Kiểm tra tính toàn vẹn của chữ ký trả về từ VNPay
     */
    public function validateSignature(array $requestParams): bool
    {
        $vnp_SecureHash = $requestParams['vnp_SecureHash'] ?? '';
        unset($requestParams['vnp_SecureHash']);
        unset($requestParams['vnp_SecureHashType']);

        ksort($requestParams);

        $i = 0;
        $hashData = "";
        foreach ($requestParams as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, config('vnpay.hash_secret'));

        return hash_equals($secureHash, $vnp_SecureHash);
    }
}
