<?php

namespace Database\Seeders;

use App\Models\User;
use App\Traits\WithUniqueRandomNumberGenerator;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    use WithUniqueRandomNumberGenerator;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Factory::create();

        // Admin User
        // User::create([
        //     'name' => 'Administrator',
        //     'email' => "admin@test.test",
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('secret'),
        //     'role' => 'admin',
        // ]);

        // TPI
        // User::create([
        //     'name' => 'TPA',
        //     'email' => "tpa@test.test",
        //     'phone' => 7099036578,
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('secret'),
        //     'role' => 'third-party',
        // ]);

        //State Jaldoot Cell
        // User::create([
        //     'name' => 'State Jaldoot Cell',
        //     'email' => "sjc@jjmbrain.in",
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('secret'),
        //     'role' => 'state-jaldoot-cell',
        // ]);

        // State State ISA
        // User::create([
        //     'name' => 'State ISA',
        //     'email' => "stateisa@jjmbrain.in",
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('secret'),
        //     'role' => 'state-isa',
        // ]);

        // Call Center
        // User::create([
        //     'name' => 'Jonali Hazarika',
        //     'email' => "jonalihazarika631@gmail.com",
        //     'phone' => '6026292381',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('jonali'),
        //     'role' => 'call-center',
        // ]);
        // User::create([
        //     'name' => 'Rakhi Rajbongshi',
        //     'email' => "rajbongshirakhi4@gmail.com",
        //     'phone' => '7099666910',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('rakhi'),
        //     'role' => 'call-center',
        // ]);

        // IEC Specialist
        // User::create([
        //     'name' => 'Nabajyoti Sharma',
        //     'email' => "iecjjmassam@gmail.com",
        //     'phone' => '9706057907',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('secret'),
        //     'role' => 'iec-specialist',
        // ]);

        // SDO
        // $user = User::create([
        //     'name' => 'Manjil Sharma',
        //     'email' => "manjilsharma158@gmail.com",
        //     'phone' => '9707826924',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('secret'),
        //     'role' => 'section-officer',
        //     'designation' => 'SO',
        // ]);
        // $user->offices()->sync('01h2wr58neh1vb6jw82wfxbgm6');
        // $user->divisions()->sync('01h2wr58nzjm4tyge124fgdpby');
        // $user->subdivisions()->sync('01h2wr58p14xdpfrv4r1mw2fz9');

        // EE
        // $user = User::create([
        //     'name' => 'Satyen Goswami',
        //     'email' => "goswamisatyen@gmail.com",
        //     'phone' => '9435530445',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('secret'),
        //     'role' => 'executive-engineer',
        //     'designation' => 'Executive Engineer',
        // ]);
        // $user->offices()->sync('01h2wr58mnebkragpv7xb1ved8');
        // $user->divisions()->sync('01h2wr58mtzjypka2czh359hvn');

        $users = array(
            array("name" => "Sumato Global Tech Private ltd", "email" => "sumatoglobal@gmail.com", "phone" => "7086051056"),
            array("name" => "Maverick Technologies", "email" => "maverick.guwahati@gmail.com", "phone" => "9435092819"),
            array("name" => "ZSEE Smart Solution India Private Limited", "email" => "souravshee@zsee.org", "phone" => "9995443651"),
            array("name" => "Hydroverve Technologies India Pvt Ltd", "email" => "hydrovervetechnologies1@gmail.com", "phone" => "9957570108"),
            array("name" => "Endress+Hauser (India) Pvt Ltd", "email" => "prasun.roygupta@endress.com", "phone" => "9748779353"),
            array("name" => "Aquasense Pvt. Ltd", "email" => "rajesh.kumar@aquasense.tech", "phone" => "9654085080"),
            array("name" => "Shanta Calibri (India) Private Limited", "email" => "info@shanta.in", "phone" => "9830007346"),
            array("name" => "Converge Systems & Services Pvt. Ltd.", "email" => "pranjal@convergesystems.co.in", "phone" => "9678008114"),
            array("name" => "Automation & Maintenance Management Systems", "email" => "srikesh.s@aumsystems.com", "phone" => "8754082988"),
            array("name" => "Cimcon Software India Pvt Ltd  ", "email" => "rajnish.dashottar@cimconautomation.com", "phone" => "9023707373"),
            array("name" => "Enthu Technology Solutions India Pvt. Ltd", "email" => "gowthamraj@enthutech.in", "phone" => "9940584614"),
            array("name" => "Nish Techno Projects Pvt. Ltd", "email" => "info@groupnish.com", "phone" => "9909972827"),
        );

        // IOT-Vendor
        
        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
                'role' => 'iot-vendor',
                'designation' => 'IOT-Vendor',
            ]);
        }
    }
}
