<?php

namespace Database\Seeders;

use App\Models\ApdclSubdivisions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApdclSubdivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $subdivs = [
                [
                    "sub_id" => "001",
                    "sub_name" => "Fancybazar",
                ],
                [
                    "sub_id" => "002",
                    "sub_name" => "Kalapahar",
                ],
                [
                    "sub_id" => "003",
                    "sub_name" => "Fatashil",
                ],
                [
                    "sub_id" => "004",
                    "sub_name" => "Paltanbazar",
                ],
                [
                    "sub_id" => "005",
                    "sub_name" => "Ulubari",
                ],
                [
                    "sub_id" => "006",
                    "sub_name" => "IRCA GEC-I",
                ],
                [
                    "sub_id" => "009",
                    "sub_name" => "Basistha",
                ],
                [
                    "sub_id" => "010",
                    "sub_name" => "Capital",
                ],
                [
                    "sub_id" => "011",
                    "sub_name" => "Garbhanga",
                ],
                [
                    "sub_id" => "013",
                    "sub_name" => "Sonapur",
                ],
                [
                    "sub_id" => "014",
                    "sub_name" => "Chandmari",
                ],
                [
                    "sub_id" => "015",
                    "sub_name" => "Narangi",
                ],
                [
                    "sub_id" => "016",
                    "sub_name" => "Uzanbazar",
                ],
                [
                    "sub_id" => "017",
                    "sub_name" => "Zoo Road",
                ],
                [
                    "sub_id" => "021",
                    "sub_name" => "Amingaon",
                ],
                [
                    "sub_id" => "022",
                    "sub_name" => "Hajo",
                ],
                [
                    "sub_id" => "023",
                    "sub_name" => "Jalukbari",
                ],
                [
                    "sub_id" => "024",
                    "sub_name" => "Sualkuchi",
                ],
                [
                    "sub_id" => "025",
                    "sub_name" => "IRCA GEC-II",
                ],
                [
                    "sub_id" => "027",
                    "sub_name" => "Boko",
                ],
                [
                    "sub_id" => "028",
                    "sub_name" => "Chaygaon",
                ],
                [
                    "sub_id" => "029",
                    "sub_name" => "Mirza",
                ],
                [
                    "sub_id" => "030",
                    "sub_name" => "Azara",
                ],
                [
                    "sub_id" => "032",
                    "sub_name" => "Abhayapuri",
                ],
                [
                    "sub_id" => "033",
                    "sub_name" => "Bijni",
                ],
                [
                    "sub_id" => "034",
                    "sub_name" => "Bongaigaon -I",
                ],
                [
                    "sub_id" => "035",
                    "sub_name" => "Bongaigaon -II",
                ],
                [
                    "sub_id" => "037",
                    "sub_name" => "IRCA Bongaigaon",
                ],
                [
                    "sub_id" => "038",
                    "sub_name" => "Dhupdhara",
                ],
                [
                    "sub_id" => "039",
                    "sub_name" => "Dudhnoi",
                ],
                [
                    "sub_id" => "040",
                    "sub_name" => "Goalpara",
                ],
                [
                    "sub_id" => "041",
                    "sub_name" => "Lakhipur",
                ],
                [
                    "sub_id" => "042",
                    "sub_name" => "Mankachar",
                ],
                [
                    "sub_id" => "044",
                    "sub_name" => "Agomoni",
                ],
                [
                    "sub_id" => "045",
                    "sub_name" => "Bilasipara",
                ],
                [
                    "sub_id" => "046",
                    "sub_name" => "Dhubri",
                ],
                [
                    "sub_id" => "047",
                    "sub_name" => "Gauripur",
                ],
                [
                    "sub_id" => "048",
                    "sub_name" => "Golokganj",
                ],
                [
                    "sub_id" => "051",
                    "sub_name" => "Basugaon",
                ],
                [
                    "sub_id" => "052",
                    "sub_name" => "Chapar",
                ],
                [
                    "sub_id" => "053",
                    "sub_name" => "Fakiragram",
                ],
                [
                    "sub_id" => "054",
                    "sub_name" => "Gossaigaon",
                ],
                [
                    "sub_id" => "055",
                    "sub_name" => "Kokrajhar",
                ],
                [
                    "sub_id" => "056",
                    "sub_name" => "Sapatgram ESC",
                ],
                [
                    "sub_id" => "057",
                    "sub_name" => "IRCA Kokrajhar",
                ],
                [
                    "sub_id" => "058",
                    "sub_name" => "Barpeta Road",
                ],
                [
                    "sub_id" => "059",
                    "sub_name" => "Barpeta",
                ],
                [
                    "sub_id" => "060",
                    "sub_name" => "Sarbhog",
                ],
                [
                    "sub_id" => "061",
                    "sub_name" => "Sarthebari",
                ],
                [
                    "sub_id" => "063",
                    "sub_name" => "IRCA Barpeta",
                ],
                [
                    "sub_id" => "064",
                    "sub_name" => "Chamata",
                ],
                [
                    "sub_id" => "065",
                    "sub_name" => "Nalbari -I",
                ],
                [
                    "sub_id" => "066",
                    "sub_name" => "Nalbari -II",
                ],
                [
                    "sub_id" => "070",
                    "sub_name" => "Barama",
                ],
                [
                    "sub_id" => "071",
                    "sub_name" => "Pathsala",
                ],
                [
                    "sub_id" => "072",
                    "sub_name" => "Tihu",
                ],
                [
                    "sub_id" => "076",
                    "sub_name" => "Baihata",
                ],
                [
                    "sub_id" => "077",
                    "sub_name" => "Rangia -I",
                ],
                [
                    "sub_id" => "078",
                    "sub_name" => "Rangia -II",
                ],
                [
                    "sub_id" => "079",
                    "sub_name" => "Tamulpur",
                ],
                [
                    "sub_id" => "080",
                    "sub_name" => "IRCA Rangia",
                ],
                [
                    "sub_id" => "083",
                    "sub_name" => "Kharupetia",
                ],
                [
                    "sub_id" => "084",
                    "sub_name" => "Mangaldoi",
                ],
                [
                    "sub_id" => "085",
                    "sub_name" => "Sipajhar",
                ],
                [
                    "sub_id" => "086",
                    "sub_name" => "IRCA Mangaldoi",
                ],
                [
                    "sub_id" => "088",
                    "sub_name" => "Mazbat",
                ],
                [
                    "sub_id" => "089",
                    "sub_name" => "Tangla",
                ],
                [
                    "sub_id" => "090",
                    "sub_name" => "Udalguri",
                ],
                [
                    "sub_id" => "091",
                    "sub_name" => "Kalaigaon",
                ],
                [
                    "sub_id" => "093",
                    "sub_name" => "Tezpur-I",
                ],
                [
                    "sub_id" => "094",
                    "sub_name" => "Tezpur-II",
                ],
                [
                    "sub_id" => "095",
                    "sub_name" => "Rangapara",
                ],
                [
                    "sub_id" => "096",
                    "sub_name" => "Balipara",
                ],
                [
                    "sub_id" => "099",
                    "sub_name" => "IRCA Tezpur",
                ],
                [
                    "sub_id" => "100",
                    "sub_name" => "Dhekiajuli-I",
                ],
                [
                    "sub_id" => "101",
                    "sub_name" => "Dhekiajuli-II",
                ],
                [
                    "sub_id" => "105",
                    "sub_name" => "Chariali",
                ],
                [
                    "sub_id" => "106",
                    "sub_name" => "Gohpur",
                ],
                [
                    "sub_id" => "107",
                    "sub_name" => "Jamuguri",
                ],
                [
                    "sub_id" => "108",
                    "sub_name" => "Sootea",
                ],
                [
                    "sub_id" => "112",
                    "sub_name" => "Charaibahi",
                ],
                [
                    "sub_id" => "113",
                    "sub_name" => "Jhargaon",
                ],
                [
                    "sub_id" => "114",
                    "sub_name" => "Morigaon",
                ],
                [
                    "sub_id" => "115",
                    "sub_name" => "Laharighat",
                ],
                [
                    "sub_id" => "116",
                    "sub_name" => "Jagiroad",
                ],
                [
                    "sub_id" => "119",
                    "sub_name" => "Hojai",
                ],
                [
                    "sub_id" => "120",
                    "sub_name" => "Kathiatoli",
                ],
                [
                    "sub_id" => "121",
                    "sub_name" => "Lanka",
                ],
                [
                    "sub_id" => "122",
                    "sub_name" => "Nagaon-I",
                ],
                [
                    "sub_id" => "123",
                    "sub_name" => "Nagaon-II",
                ],
                [
                    "sub_id" => "124",
                    "sub_name" => "Nagaon-III",
                ],
                [
                    "sub_id" => "125",
                    "sub_name" => "IRCA Nagaon",
                ],
                [
                    "sub_id" => "126",
                    "sub_name" => "Dhing",
                ],
                [
                    "sub_id" => "127",
                    "sub_name" => "Kaliabor",
                ],
                [
                    "sub_id" => "129",
                    "sub_name" => "Samaguri",
                ],
                [
                    "sub_id" => "130",
                    "sub_name" => "Raha",
                ],
                [
                    "sub_id" => "132",
                    "sub_name" => "Hailakandi",
                ],
                [
                    "sub_id" => "133",
                    "sub_name" => "Kalain",
                ],
                [
                    "sub_id" => "134",
                    "sub_name" => "Lala",
                ],
                [
                    "sub_id" => "135",
                    "sub_name" => "R.K. Nagar",
                ],
                [
                    "sub_id" => "138",
                    "sub_name" => "Badarpur",
                ],
                [
                    "sub_id" => "139",
                    "sub_name" => "Durlavcherra",
                ],
                [
                    "sub_id" => "140",
                    "sub_name" => "Karimganj",
                ],
                [
                    "sub_id" => "141",
                    "sub_name" => "Lowairpoa",
                ],
                [
                    "sub_id" => "142",
                    "sub_name" => "Nilambazar",
                ],
                [
                    "sub_id" => "143",
                    "sub_name" => "Patherkandi",
                ],
                [
                    "sub_id" => "144",
                    "sub_name" => "IRCA Badarpur",
                ],
                [
                    "sub_id" => "146",
                    "sub_name" => "Lakhipur",
                ],
                [
                    "sub_id" => "147",
                    "sub_name" => "Silchar-I",
                ],
                [
                    "sub_id" => "148",
                    "sub_name" => "Silchar-II",
                ],
                [
                    "sub_id" => "149",
                    "sub_name" => "Sonai",
                ],
                [
                    "sub_id" => "150",
                    "sub_name" => "Udharbond",
                ],
                [
                    "sub_id" => "151",
                    "sub_name" => "Silchar-III",
                ],
                [
                    "sub_id" => "152",
                    "sub_name" => "IRCA Cachar",
                ],
                [
                    "sub_id" => "153",
                    "sub_name" => "Diphu-I",
                ],
                [
                    "sub_id" => "154",
                    "sub_name" => "Diphu -II",
                ],
                [
                    "sub_id" => "155",
                    "sub_name" => "Lummding",
                ],
                [
                    "sub_id" => "156",
                    "sub_name" => "Bokajan",
                ],
                [
                    "sub_id" => "158",
                    "sub_name" => "IRCA KANCH",
                ],
                [
                    "sub_id" => "159",
                    "sub_name" => "Donkamokam",
                ],
                [
                    "sub_id" => "160",
                    "sub_name" => "Howraghat",
                ],
                [
                    "sub_id" => "161",
                    "sub_name" => "Kheroni",
                ],
                [
                    "sub_id" => "162",
                    "sub_name" => "Hamren",
                ],
                [
                    "sub_id" => "163",
                    "sub_name" => "Boithalangsu ESC",
                ],
                [
                    "sub_id" => "164",
                    "sub_name" => "Haflong",
                ],
                [
                    "sub_id" => "165",
                    "sub_name" => "Mahur",
                ],
                [
                    "sub_id" => "166",
                    "sub_name" => "Maibong",
                ],
                [
                    "sub_id" => "167",
                    "sub_name" => "Umrangso",
                ],
                [
                    "sub_id" => "170",
                    "sub_name" => "Jorhat - I",
                ],
                [
                    "sub_id" => "171",
                    "sub_name" => "Jorhat - II",
                ],
                [
                    "sub_id" => "172",
                    "sub_name" => "Dergaon",
                ],
                [
                    "sub_id" => "173",
                    "sub_name" => "Jorhat - III",
                ],
                [
                    "sub_id" => "175",
                    "sub_name" => "IRCA Jorhat",
                ],
                [
                    "sub_id" => "176",
                    "sub_name" => "Titabor",
                ],
                [
                    "sub_id" => "177",
                    "sub_name" => "Mariani",
                ],
                [
                    "sub_id" => "178",
                    "sub_name" => "Majuli",
                ],
                [
                    "sub_id" => "181",
                    "sub_name" => "Golaghat -I",
                ],
                [
                    "sub_id" => "182",
                    "sub_name" => "Bokakhat",
                ],
                [
                    "sub_id" => "183",
                    "sub_name" => "Kamargaon",
                ],
                [
                    "sub_id" => "184",
                    "sub_name" => "Sarupathar",
                ],
                [
                    "sub_id" => "185",
                    "sub_name" => "Golaghat 2",
                ],
                [
                    "sub_id" => "188",
                    "sub_name" => "Teok",
                ],
                [
                    "sub_id" => "189",
                    "sub_name" => "Kakajan",
                ],
                [
                    "sub_id" => "192",
                    "sub_name" => "Sivsagar 1",
                ],
                [
                    "sub_id" => "193",
                    "sub_name" => "Sivsagar 2",
                ],
                [
                    "sub_id" => "194",
                    "sub_name" => "Gaurisagar",
                ],
                [
                    "sub_id" => "195",
                    "sub_name" => "Demow",
                ],
                [
                    "sub_id" => "196",
                    "sub_name" => "IRCA Sivasagar",
                ],
                [
                    "sub_id" => "198",
                    "sub_name" => "Nazira",
                ],
                [
                    "sub_id" => "199",
                    "sub_name" => "Amguri",
                ],
                [
                    "sub_id" => "200",
                    "sub_name" => "Charaideo",
                ],
                [
                    "sub_id" => "201",
                    "sub_name" => "Moran",
                ],
                [
                    "sub_id" => "204",
                    "sub_name" => "Tingkhang",
                ],
                [
                    "sub_id" => "207",
                    "sub_name" => "Dibrugarh 1",
                ],
                [
                    "sub_id" => "208",
                    "sub_name" => "Dibrugarh 2",
                ],
                [
                    "sub_id" => "209",
                    "sub_name" => "Dibrugarh 3",
                ],
                [
                    "sub_id" => "210",
                    "sub_name" => "IRCA Dibrugarh",
                ],
                [
                    "sub_id" => "212",
                    "sub_name" => "Digboi",
                ],
                [
                    "sub_id" => "213",
                    "sub_name" => "Doomdooma",
                ],
                [
                    "sub_id" => "214",
                    "sub_name" => "Margherita",
                ],
                [
                    "sub_id" => "217",
                    "sub_name" => "Tinsukia 3",
                ],
                [
                    "sub_id" => "218",
                    "sub_name" => "Chapakhowa",
                ],
                [
                    "sub_id" => "219",
                    "sub_name" => "Naharkatia",
                ],
                [
                    "sub_id" => "220",
                    "sub_name" => "Bordubi",
                ],
                [
                    "sub_id" => "221",
                    "sub_name" => "Namrup",
                ],
                [
                    "sub_id" => "224",
                    "sub_name" => "Tinsukia 1",
                ],
                [
                    "sub_id" => "226",
                    "sub_name" => "IRCA Tinsukia",
                ],
                [
                    "sub_id" => "227",
                    "sub_name" => "N. Lakhimpur",
                ],
                [
                    "sub_id" => "228",
                    "sub_name" => "Bihpuria",
                ],
                [
                    "sub_id" => "229",
                    "sub_name" => "Nowboicha",
                ],
                [
                    "sub_id" => "230",
                    "sub_name" => "IRCA N. Lakhimpur",
                ],
                [
                    "sub_id" => "231",
                    "sub_name" => "Dhemaji",
                ],
                [
                    "sub_id" => "232",
                    "sub_name" => "Dhakuakhana",
                ],
                [
                    "sub_id" => "233",
                    "sub_name" => "Ghilamara",
                ],
                [
                    "sub_id" => "234",
                    "sub_name" => "Gogamukh ESC",
                ],
                [
                    "sub_id" => "236",
                    "sub_name" => "Chilapathar",
                ],
                [
                    "sub_id" => "237",
                    "sub_name" => "Jonai",
                ],
                [
                    "sub_id" => "299",
                    "sub_name" => "Tinsukia 2",
                ],
            ];

            foreach ($subdivs as $subdiv) {
                ApdclSubdivisions::create([
                    'subdivision_id' => $subdiv['sub_id'],
                    'subdivision_name' => $subdiv['sub_name'],
                ]);
            }
        });
    }
}
