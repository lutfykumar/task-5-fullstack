<?php

namespace Database\Seeders;

use App\Models\Articles;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Articles::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data = [];
        $v = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, blanditiis.';
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'title' => $v,
                'slug' => Str::slug($v) . '-' . rand(99, 99999),
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi, repudiandae! Optio, tempore! Quisquam illo est delectus recusandae doloremque. Praesentium adipisci inventore aliquam reiciendis eos ipsam saepe odio omnis ducimus, unde deserunt, fugit est culpa et architecto explicabo atque quis fuga, dignissimos eum aspernatur consequuntur veritatis quia ipsum? Vero et, voluptas blanditiis neque eos illo rerum sint expedita rem modi ex velit omnis cum illum deserunt magni laborum. Nobis deserunt atque voluptates ut temporibus eligendi dicta, sit harum, quam necessitatibus vitae incidunt ipsum reprehenderit quasi perspiciatis sed corrupti praesentium dolorem inventore cumque, modi quaerat quis. Reprehenderit, sequi minus! Est, architecto perferendis reprehenderit eveniet cumque quia et nisi fugiat cupiditate soluta perspiciatis porro quisquam quasi rerum mollitia corporis nam. Unde porro, ad quam assumenda vel asperiores ipsa saepe earum! Debitis nam molestiae alias quos, illum facilis nihil veniam error animi optio velit, enim rem delectus id voluptatem laborum voluptas quidem quasi fuga assumenda ullam corrupti obcaecati, in quia! Dolor voluptates labore quod non aperiam ipsum tenetur fuga itaque incidunt sunt quos placeat molestias error, culpa voluptatum ab. Excepturi, praesentium quos error alias ad nesciunt? Voluptate dicta fugit provident esse at. Quod esse voluptatum, sed voluptatem quasi repellat natus vitae quis numquam architecto. Nam aliquid eaque officia eveniet ipsa praesentium at, culpa recusandae nulla distinctio corporis, repellat modi tenetur, cum ratione consectetur aut labore facere exercitationem atque? Debitis, laudantium impedit dolore suscipit nam aperiam rerum. Tempore ratione pariatur tenetur aspernatur est, molestiae sunt beatae. Nulla, esse autem eum officia obcaecati pariatur corporis architecto exercitationem, ea id officiis vero nemo rerum quia eligendi molestias aliquid tenetur vel reiciendis sunt cupiditate? Ipsum eos ad at voluptates perspiciatis culpa sapiente incidunt voluptatibus nisi, optio, cum debitis expedita et sequi labore recusandae odit suscipit ullam mollitia ea, pariatur vel. Porro tempore, in deserunt placeat temporibus itaque dolore.',
                'user_id' => 1,
                'category_id' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now()
            ];
            Articles::insert($data);
        }
    }
}
