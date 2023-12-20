<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('user')->insert([
            [
                'nameUser' => 'Nguyễn Thành Luân',
                'birthday' => '2002-04-22',
                'email' => 'ntluangoc@gmail.com',
                'avatar' => 'https://i.postimg.cc/sfmBxCD5/IMG-4592-6.png'
            ]
        ]);
        DB::table('doctor')->insert([
           [
               'idUser' => '1',
               'description' => 'Tôi đã có 20 năm kinh nghiệm làm bác sĩ'
           ]
        ]);
        DB::table('medicine')->insert([
            [
                'idDoctor' => '1',
                'nameMedicine' => 'Paracetamol 500mg',
                'img' => 'https://duocphamtw3.com/wp-content/uploads/2023/07/PARACETAMOL-31.7.png',
                'price' => '5',
                'content' => "<p ><span style=\"color:#e53935;\">Headache</span> relief medication serves to swiftly alleviate headache discomfort through multiple functions:</p><ol><li><span class=\"ck-list-bogus-paragraph\"><strong>Pain Alleviation:</strong> These medicines primarily reduce headache pain by targeting pain signals and pathways.</span></li><li><span class=\"ck-list-bogus-paragraph\"><strong>Anti-Inflammatory:</strong> Some include anti-inflammatory agents to reduce inflammation contributing to headaches.</span></li><li><span class=\"ck-list-bogus-paragraph\"><strong>Vasoconstriction:</strong> Certain medications narrow blood vessels in the brain, easing throbbing sensations.</span></li><li><span class=\"ck-list-bogus-paragraph\"><strong>Nervous System Regulation:</strong> They mdulate neurotransmitters to lower pain perception.</span></li><li><span class=\"ck-list-bogus-paragraph\"><strong>Muscle Relaxation:</strong> Tension-caused headaches are relieved by relaxing neck, shoulder, and head muscles..<br><br>        In summary, headache relief medication promptly eases pain through various methods, aiding individuals seeking respite from headache symptoms.</span></li></ol>",
                'like' => '1',
                'rating' => '3',
                'created_at' => '2023-12-18 09:13:53',
                'updated_at' => '2023-12-18 09:13:53'

            ]
        ]);
        DB::table('comment')->insert([
           [
               'idUser' => '1',
               'idMedicine' => '1',
               'content' => 'Tôi thấy sản phẩm oke đấy. Dùng xong hiệu quả hẳn',
               'created_at' => '2023-12-18 09:13:53',
               'updated_at' => '2023-12-18 09:13:53'
           ]
        ]);
        DB::table('rating')->insert([
           [
               'idUser' => '1',
               'idMedicine' => '1',
               'rating' => '3'
           ]
        ]);
        DB::table('like')->insert([
           [
               'idUser' => '1',
               'idMedicine' => '1'
           ]
        ]);
    }
}
