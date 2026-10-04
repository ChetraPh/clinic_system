<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting\InvoiceSetting;
use App\Models\Setting\QrSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;
use KHQR\Models\MerchantInfo;

class SettingsController extends Controller
{
    public function bilingindex(Request $request)
    {
        $settings = InvoiceSetting::firstOrCreate([
            'id' => 1,
        ]);

        return view(
            'form.settings.billing.billingPage',
            compact('settings')
        );
    }

    public function billingUpdate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'currency_symbol' => 'required|string|max:10',
                'secondary_currency_symbol' => 'required|string|max:10',
                'exchange_rate' => 'required|numeric|min:0.01',
                'tax_percent' => 'required|numeric|min:0|max:100',
                'invoice_footer' => 'nullable|string|max:255',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $settings = InvoiceSetting::firstOrCreate([
            'id' => 1,
        ]);

        $settings->update(
            $validator->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'រក្សាទុកជោគជ័យ',
        ]);
    }

    public function qrcodeindex(Request $request)
    {
        $qrSetting = QrSetting::first();

        return view(
            'form.settings.qrcode.qrcodePage',
            compact('qrSetting')
        );
    }

    public function qrcodeUpdate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'mode' => 'required|in:manual,bakong',

                'manual_qr_image' =>
                    'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',

                'account_type' =>
                    'required_if:mode,bakong|nullable|in:individual,merchant',

                'bank_name' =>
                    'required_if:mode,bakong|nullable|string|max:100',

                'bakong_account_id' =>
                    'required_if:mode,bakong|nullable|string|max:100',

                'account_name' =>
                    'required_if:mode,bakong|nullable|string|max:150',

                'account_number' =>
                    'required_if:mode,bakong|nullable|string|max:100',

                'merchant_city' =>
                    'nullable|string|max:100',

                'merchant_id' =>
                    'nullable|string|max:50',

                'mobile_number' =>
                    'nullable|string|max:20',

                'merchant_category_code' =>
                    'nullable|string|max:10',

                'logo' =>
                    'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            ],
            [
                'account_name.required_if' =>
                    'សូមបញ្ចូលឈ្មោះគណនី។',

                'account_name.string' =>
                    'ឈ្មោះគណនីត្រូវតែជាអក្សរ។',

                'account_name.max' =>
                    'ឈ្មោះគណនីមិនអាចលើស 150 តួអក្សរ។',

                'account_number.required_if' =>
                    'សូមបញ្ចូលលេខគណនី។',

                'bank_name.required_if' =>
                    'សូមជ្រើសរើសធនាគារ។',

                'bakong_account_id.required_if' =>
                    'សូមបញ្ចូល Bakong Account ID។',

                'account_type.required_if' =>
                    'សូមជ្រើសរើសប្រភេទគណនី។',

                'manual_qr_image.image' =>
                    'QR Code ត្រូវតែជារូបភាព។',

                'manual_qr_image.mimes' =>
                    'QR Code ត្រូវតែជា PNG, JPG, JPEG ឬ WEBP។',

                'manual_qr_image.max' =>
                    'QR Code មិនអាចលើស 2MB។',

                'logo.image' =>
                    'Logo ត្រូវតែជារូបភាព។',

                'logo.mimes' =>
                    'Logo ត្រូវតែជា PNG, JPG, JPEG ឬ WEBP។',

                'logo.max' =>
                    'Logo មិនអាចលើស 2MB។',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        $setting = QrSetting::first();

        if (!$setting) {
            $setting = new QrSetting();
        }

        if ($request->hasFile('manual_qr_image')) {
            if ($setting->manual_qr_image) {
                Storage::disk('public')->delete(
                    $setting->manual_qr_image
                );
            }

            $data['manual_qr_image'] = $request
                ->file('manual_qr_image')
                ->store('qr_codes', 'public');
        }

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete(
                    $setting->logo
                );
            }

            $data['logo'] = $request
                ->file('logo')
                ->store('qr_logos', 'public');
        }

        $setting->fill($data);
        $setting->save();

        return response()->json([
            'success' => true,
            'message' => 'រក្សាទុក QR Code ជោគជ័យ',
            'manual_qr_url' => $setting->manual_qr_image
                ? Storage::url($setting->manual_qr_image)
                : null,
        ]);
    }

    public function backupindex(Request $request)
    {
        return view(
            'form.settings.backup.backupPage'
        );
    }

    public function generateKhqr(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'amount' =>
                    'required|numeric|min:0.01',

                'currency' =>
                    'required|in:KHR,USD',

                'bill_number' =>
                    'nullable|string|max:25',
            ],
            [
                'amount.required' =>
                    'សូមបញ្ចូលចំនួនទឹកប្រាក់។',

                'amount.numeric' =>
                    'ចំនួនទឹកប្រាក់មិនត្រឹមត្រូវ។',

                'amount.min' =>
                    'ចំនួនទឹកប្រាក់ត្រូវធំជាង 0។',

                'currency.required' =>
                    'សូមជ្រើសរើសរូបិយប័ណ្ណ។',

                'currency.in' =>
                    'រូបិយប័ណ្ណត្រូវតែជា KHR ឬ USD។',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $setting = QrSetting::first();

        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'មិនទាន់មានការកំណត់ QR Code។',
            ], 422);
        }

        if ($setting->mode === 'manual') {
            if (!$setting->manual_qr_image) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'សូមបញ្ចូលរូបភាព QR នៅក្នុងការកំណត់។',
                ], 422);
            }

            return response()->json([
                'success' => true,
                'mode' => 'manual',
                'qr_image_url' =>
                    Storage::url($setting->manual_qr_image),
                'bank_name' =>
                    $setting->bank_name,
                'account_name' =>
                    $setting->account_name,
                'account_number' =>
                    $setting->account_number,
            ]);
        }

        if (empty($setting->bakong_account_id)) {
            return response()->json([
                'success' => false,
                'message' =>
                    'មិនទាន់មាន Bakong Account ID។ សូមកំណត់នៅ QR Settings។',
            ], 422);
        }

        if (empty($setting->account_name)) {
            return response()->json([
                'success' => false,
                'message' =>
                    'មិនទាន់មានឈ្មោះគណនី។ សូមកំណត់នៅ QR Settings។',
            ], 422);
        }

        $currency = $request->currency === 'KHR'
            ? KHQRData::CURRENCY_KHR
            : KHQRData::CURRENCY_USD;

        $expiration = (string) (
            floor(microtime(true) * 1000)
            + (5 * 60 * 1000)
        );

        try {
            if ($setting->account_type === 'merchant') {
                $info = new MerchantInfo(
                    bakongAccountID: $setting->bakong_account_id,
                    merchantName: $setting->account_name,
                    merchantCity: $setting->merchant_city ?: 'Phnom Penh',
                    merchantID: $setting->merchant_id,
                    acquiringBank: $setting->bank_name,
                    mobileNumber: $setting->mobile_number,
                    currency: $currency,
                    amount: (float) $request->amount,
                    billNumber: $request->bill_number,
                    expirationTimestamp: $expiration,
                    merchantCategoryCode:
                        $setting->merchant_category_code,
                );

                $result = BakongKHQR::generateMerchant(
                    $info
                );
            } else {
                $info = new IndividualInfo(
                    bakongAccountID: $setting->bakong_account_id,
                    merchantName: $setting->account_name,
                    merchantCity: $setting->merchant_city ?: 'Phnom Penh',
                    currency: $currency,
                    amount: (float) $request->amount,
                    billNumber: $request->bill_number,
                    expirationTimestamp: $expiration,
                    merchantCategoryCode:
                        $setting->merchant_category_code,
                );

                $result = BakongKHQR::generateIndividual(
                    $info
                );
            }
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' =>
                    'មិនអាចបង្កើត KHQR បាន។',
                'error' => $e->getMessage(),
            ], 500);
        }

        $statusCode = data_get(
            $result,
            'status.code'
        );

        if ((int) $statusCode !== 0) {
            return response()->json([
                'success' => false,
                'message' =>
                    data_get(
                        $result,
                        'status.message',
                        'មិនអាចបង្កើត QR Code បាន។'
                    ),
            ], 422);
        }

        return response()->json([
            'success' => true,
            'mode' => 'bakong',
            'qr' => data_get($result, 'data.qr'),
            'md5' => data_get($result, 'data.md5'),
            'expires_at' => $expiration,
        ]);
    }

    public function checkPaymentStatus($md5)
    {
        if (empty($md5)) {
            return response()->json([
                'paid' => false,
                'error' => 'MD5 មិនត្រឹមត្រូវ។',
            ], 422);
        }

        $token = config('services.bakong.token');

        if (empty($token)) {
            return response()->json([
                'paid' => false,
                'error' =>
                    'មិនទាន់មាន BAKONG_API_TOKEN នៅក្នុង .env។',
            ], 500);
        }

        try {
            $bakong = new BakongKHQR($token);

            $response = $bakong->checkTransactionByMD5(
                $md5
            );

            $responseCode = data_get(
                $response,
                'responseCode'
            );

            $paid = (int) $responseCode === 0;

            return response()->json([
                'paid' => $paid,
                'raw' => $response,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'paid' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}