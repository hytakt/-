<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => '阿久津颯',
            'email' => 'pkerakera@gmail.com',
            'password' => '12345678',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'image_path' => 'https://lh3.googleusercontent.com/pw/AIL4fc_dBqXYHxRRDs7rUdz3RAlMo5sljuO_wAx-_qxL2phWi8Lcf5Wajl14jfCY45oFOYaKi5Ay2wuO29Z3Th1Vjty-N9QGyw73V-CIRQX7hE_oLdkPo8kIbmPuxTEYBdU3kipnlUN1_m1ZZxtUe-hlgPBmlVV78V6OEwXCdysF1yn3eCq9b6FbWCp1xFkIp9cdeI6ro8DEDrFcOGQ7X5c3MfWRZmvHPOuIP_eVMD8Um7iwaE30FNDHDHQVFugWn7D8PJalZR1gMLJj1pu02VFRGA5d8s2uc8Cu4ZNa0em2_vyfMGEq1jHjQPlYN9wJ8dyWDayvQnhpiZJzAkROpsXneJFhnal9xgXgXYWN4kPV7ztclqy8k3KgD8Ba7h4A8xCgLk33GZhCJ4jrg-byXqA05qbCmr9x6EOCtgA3HmaSwmfK0BEbxKviinhwN9Uh5bcWfQQxpIN1l-mv8EbMDrTTgU09ox8b5yrukuVOK9H1ax4GM-Ip6Ktphd91MFQr-i_jW8AvKuffNWKeIx-L2RJ0FEvQZAtRSP1VyP3Urgg7sK_MnNnQvoP1ozrqNKgtYD3IbzXihGEixb_Q9muYkg6RFVUqYwznbQm81pJSkuzT3MJOua-nj3OHtMjgHh-dc9t9mYl6e9JlRFOuVusSmQ5f7yHiBr-hVZ4qJGF25Ykj4WN_cikduSenzbHbXVkHcXRM1MKISbM0ua_qB6xQ6OJsILJKFnhRclcB4VF8cbsY76Fy_4KaeeHTx-Dt3Y6CFPjy0Qjhn50AAA3V0euBxWZRlbdiJJOGMnhQMp5f1vkdKo0ltXbTsYRUR719qqwAq8G6yiIzX4l-peEYCmgS9Iabf_3CPct9wny7N33uGypCfpwmgEf9ko_Uva2pzVLgslu4qRv_ZDDCsAyK8MmHmGbil068qCmOTdf8Nq2cKBlIG6NZJ4b1enIfen4Dfqu0YzS03hnqGTCbDGcxSjvA0IdxF-DPZp5njA=w1587-h893-s-no?authuser=0',
            'bio' => '自己紹介'
        ]);
    }
}
