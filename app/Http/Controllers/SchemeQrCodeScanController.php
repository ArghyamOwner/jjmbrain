<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\CanalTracking;
use App\Models\JalkoshLink;
use App\Models\ReviewSection;
use App\Models\Scheme;
use App\Models\SchemeFlowmeterDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SchemeQrCodeScanController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Scheme $scheme)
    {
        // $text = 'जेजेएम असम में आपका स्वागत है, इस {{ $schemeName }} को {{ $slsscYear }} में {{ $approvedOn }} पर {{ $totalCost }} करोड़ की लागत से मंजूरी मिल गई है, इसे पीएचईडी असम के {{ $divisionName }} द्वारा निष्पादित किया गया है। कार्य का अनुबंध {{ $contractorName }} ठेकेदार को दिया गया है । दिनांक {{ $completionDate }} को पूर्ण हो चुकी है । इस योजना में कुल {{ $totalBeneficiaries }} लाभार्थी हैं । योजना के जल मित्र {{ $jalMitraName }} का फ़ोन नंबर है {{ $jalMitraPhone }} एवं जल उपयोक्ता समिति अध्यक्ष का नाम {{ $wucUserName }} फ़ोन नंबर {{ $wucUserPhone }} | योजना में जल की गुणवत्ता इस प्रकार पाई गई है | लौह स्तर {{ $iron }} है | अवशिष्ट क्लोरीन {{ $chroline }} है | आर्सेनिक {{ $arsenic }} है | फ्लोराइड {{ $flouride }} है | पीएच {{ $ph }} है | यदि आप जलजीवन मिशन के बारे में अधिक जानना चाहते हैं तो कृपया {{ $jjmContactNumber }} पर कॉल करें |';
        $text = 'जेजेएम असम में आपका स्वागत है, इस {{ $schemeName }} को {{ $slsscYear }} में {{ $approvedOn }} पर {{ $totalCost }} करोड़ की लागत से मंजूरी मिल गई है, इसे पीएचईडी असम के {{ $divisionName }} द्वारा निष्पादित किया गया है। इस योजना में कुल {{ $totalBeneficiaries }} लाभार्थी हैं । योजना के जल मित्र {{ $jalMitraName }} का फ़ोन नंबर है {{ $jalMitraPhone }}| योजना में जल की गुणवत्ता इस प्रकार पाई गई है | यदि आप जलजीवन मिशन के बारे में अधिक जानना चाहते हैं तो कृपया {{ $jjmContactNumber }} पर कॉल करें |';

        $this->updateQrScanCount($scheme);

        $latestFmr = SchemeFlowmeterDetails::query()
            ->where('scheme_id', $scheme->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $previousFmr = SchemeFlowmeterDetails::query()
            ->where('scheme_id', $scheme->id)
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(1)
            ->first();

        $latestSupply = '';
        if ($latestFmr?->value > $previousFmr?->value) {
            $latestSupply = $latestFmr?->value - $previousFmr?->value;
        } else {
            $latestSupply = 'Data Not Appropriate';
        }

        return view('schemes.qrcode-scan-details', [
            'scheme' => $scheme->loadCount('beneficiaries')
                ->loadMissing([
                    'villages',
                    'panchayats',
                    'habitations',
                    'district',
                    'division',
                    'workorders:id,formal_workorder_date,contractor_id',
                    'workorders.contractor:id,name',
                    'user:id,name,phone',
                    'users:id,name,phone',
                    'wucs:id,name,secretary_name,president_name',
                    'assets:id,scheme_id,item_name,specification',
                ]),
            'cumulativeFmrValue' => $latestFmr?->value ? $latestFmr->value . ' KL' : 'N/A',
            'latestSupply' => $latestSupply ? $latestSupply . ' KL (' . $latestFmr?->created_at?->format('d-m-Y') . ')' : 'N/A',
            'reviewSections' => auth()->user() && auth()->user()->role === 'inspector'
            ? ReviewSection::withCount('reviewQuestions')->where('type', 'administrative')->get()
            : ReviewSection::withCount('reviewQuestions')->get(),
            'jalkoshLinks' => JalkoshLink::query()->get(),

            'textToRead' => Blade::render($text, [
                'schemeName' => $scheme->name,
                'slsscYear' => $scheme->slssc_year,
                'approvedOn' => $scheme->approved_on,
                'totalCost' => $scheme->total_cost,
                'divisionName' => $scheme->division?->name,
                'contractorName' => 'contractor',
                'completionDate' => '23 January 2024', // Format: 23 January 2024
                'totalBeneficiaries' => $scheme->beneficiaries_count,
                'jalMitraName' => $scheme?->user?->name,
                'jalMitraPhone' => $scheme?->user?->phone_formatted, // Format: 9435 000 000
                'wucUserName' => 'Hello',
                'wucUserPhone' => '9435 021 032',
                'jjmContactNumber' => '70860 51056',

                'iron' => 'okay',
                'chroline' => 'high',
                'arsenic' => 'okay',
                'flouride' => 'okay',
                'ph' => 'okay',
            ]),
            'locations' => $this->getBeneficiaries($scheme->id),
            'canalTracks' => $this->getCanalTracks($scheme->id),
            // 'geojsonUrl' => Storage::disk('esrComplaint')->url("{$scheme->old_scheme_id}.json"),
            'latitude' => $scheme->latitude ?? 26.2006,
            'longitude' => $scheme->longitude ?? 92.9376,
        ]);
    }

    public function getBeneficiaries($schemeId)
    {
        $beneficiaryCoordinates = Beneficiary::where('scheme_id', $schemeId)->get()->transform(fn($beneficiary) => [
            'type' => 'Feature',
            'properties' => [
                "beneficiary_name" => $beneficiary['beneficiary_name'],
                "address" => $beneficiary['address'],
                "phone" => $beneficiary['beneficiary_phone'],
            ],
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    (float) $beneficiary['longitude'],
                    (float) $beneficiary['latitude'],
                ],
            ],
        ]);

        return [
            'type' => "FeatureCollection",
            'features' => $beneficiaryCoordinates,
        ];
    }

    public function getCanalTracks($schemeId)
    {
        $tracks = CanalTracking::query()
            ->whereNotNull('geojson')
            ->where('scheme_id', $schemeId)
            ->get()->transform(fn($data) => [
            'type' => 'Feature',
            'properties' => [
                'size' => $data->size,
                'type' => $data->type,
                'quality' => $data->quality,
                'color' => $data->color_code,
            ],
            'geometry' => [
                'type' => 'LineString',
                'coordinates' => collect($data->geojson)->map(fn($geojson) => [
                    $geojson[1],
                    $geojson[0],
                ])->all(),
            ],
        ]);

        if ($tracks->isNotEmpty()) {
            return [
                'type' => 'FeatureCollection',
                'features' => $tracks,
            ];
        }
        return null;
    }

    public function getNetworkMapCoordinatesProperty($oldSchemeId)
    {
        if ($oldSchemeId) {
            // return File::json("geojson/{$oldSchemeId}.geojson");
            $response = Http::get(Storage::disk('pipeline')->url("{$oldSchemeId}.geojson"));

            if ($response->ok()) {
                return $response->body();
            }
        } else {
            return [];
        }
    }

    public function updateQrScanCount($scheme)
    {
        $scheme->update([
            'qrscan_count' => ++$scheme->qrscan_count,
        ]);
    }
}
