<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fingerprint;

class FingerprintController extends Controller
{
    public function scanFingerprint(Request $request)
    {
        $featureSet = $request->input('finger');

        if (!is_array($featureSet) && !is_object($featureSet)) {
            return response()->json(['error' => 'Invalid feature set data'], 400);
        }

        $stableFeatureSet = $this->makeFeatureSetStable($featureSet);

        // تحويل الميزات إلى قالب باستخدام SHA-256
        $template = hash('sha256', json_encode($stableFeatureSet));

        // تخزين القالب في قاعدة البيانات لاستخدامه لاحقًا (اختياري)
        Fingerprint::create(['user_id' => 1, 'template' => $template]); // تأكد من ضبط user_id بشكل مناسب

        return response()->json(['template' => $template]);
    }

    private function makeFeatureSetStable($featureSet)
    {
        if (is_array($featureSet)) {
            foreach ($featureSet as &$feature) {
                if (is_array($feature) || is_object($feature)) {
                    // إزالة الطابع الزمني أو أي بيانات متغيرة أخرى
                    unset($feature['timestamp']); // إزالة الطابع الزمني إذا كان موجودًا
                }
            }
        } elseif (is_object($featureSet)) {
            unset($featureSet->timestamp); // إزالة الطابع الزمني إذا كان موجودًا
        }

        return $featureSet;
    }
}
