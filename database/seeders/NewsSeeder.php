<?php

namespace Database\Seeders;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->data();

        foreach($data as $item){
            News::create(
                $item
            );
        }
    }

    public function data(){
        return [
            [
                'title' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi maxime reprehenderit vitae minima nulla doloremque provident ',
                'content' => 'Pariatur sint ratione nulla provident dignissimos aliquid delectus qui totam, quo, nostrum iure enim?
                            
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius et perferendis delectus pariatur 

                                magni, eos mollitia rem quo molestiae illum sunt fuga asperiores repudiandae reiciendis 
                                voluptatum dolorem corrupti architecto ratione earum minima, 
                                commodi incidunt necessitatibus ipsa.',
                'author' => 'John Doe',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(52)->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Voluptatum dolorem corrupti architecto ratione earum minima',
                'content' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius et perferendis delectus pariatur 

                            magni, eos mollitia rem quo molestiae illum sunt fuga asperiores repudiandae reiciendis 
                            voluptatum dolorem corrupti architecto ratione earum minima, 
                            commodi incidunt necessitatibus ipsa.
                            
                            Pariatur sint ratione nulla provident dignissimos aliquid delectus qui totam, quo, nostrum iure enim?
                            
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius et perferendis delectus pariatur 

                            magni, eos mollitia rem quo molestiae illum sunt fuga asperiores repudiandae reiciendis 
                            voluptatum dolorem corrupti architecto ratione earum minima, 
                            commodi incidunt necessitatibus ipsa.
                                        
                            Pariatur sint ratione nulla provident dignissimos aliquid delectus qui totam, quo, nostrum iure enim?',
                'author' => 'John Doe',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(48)->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Corrupti architecto ratione earum minima',
                'content' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius et perferendis delectus pariatur 

                                magni, eos mollitia rem quo molestiae illum sunt fuga asperiores repudiandae reiciendis 


                                voluptatum dolorem corrupti architecto ratione earum minima, 
                                commodi incidunt necessitatibus ipsa.

                                Pariatur sint ratione nulla provident dignissimos aliquid delectus qui totam, quo, nostrum iure enim?',
                'author' => 'John Doe',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(44)->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Commodi incidunt necessitatibus ipsa',
                'content' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius et perferendis delectus pariatur 

                                magni, eos mollitia rem quo molestiae illum sunt fuga asperiores repudiandae reiciendis 
                                voluptatum dolorem corrupti architecto ratione earum minima, 
                                commodi incidunt necessitatibus ipsa.

                                Pariatur sint ratione nulla provident dignissimos aliquid delectus qui totam, quo, nostrum iure enim?',
                'author' => 'John Doe',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(22)->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Expedita earum aliquam distinctio corporis nisi adipisci',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod ipsam perspiciatis, odio voluptate eveniet ab optio quos tenetur, 
                                dolorem velit omnis. Architecto optio consequatur perferendis qui odio ipsum aspernatur sit officia quisquam doloremque facere sed 

                                non beatae, in provident velit ratione itaque eveniet placeat quibusdam debitis reiciendis laborum maxime. Rem hic impedit minima 
                                voluptas error, illo ipsam aperiam facere similique quis necessitatibus. Sunt optio possimus saepe culpa ipsam atque quisquam earum 

                                dolores fugiat maiores?',
                'author' => 'John Doe',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(17)->format('Y-m-d H:i:s')
            ],

            [
                'title' => 'Ea voluptas dolores iusto quod quibusdam porro accusamus animi',
                'content' => 'Lorem ipsum dolor sit, amet consectetur 
                                adipisicing elit. Eius illum autem dolorum 
                                voluptas quibusdam similique ullam aut ratione excepturi magnam ut quod, nam sequi. Vel aliquid aut, culpa inventore 


                                ipsa id laborum iusto quidem optio dignissimos odit minima. Nisi pariatur tempora aspernatur, quis dolores consectetur 
                                repellendus esse explicabo. Nihil, suscipit architecto. Veniam, expedita earum aliquam distinctio corporis nisi adipisci 
                                esse id ad nulla perspiciatis, modi, ea voluptas dolores iusto quod quibusdam porro accusamus animi. Inventore molestias quidem laborum vero nihil?',
                'author' => 'John Doe',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(9)->format('Y-m-d H:i:s')            
            ],
            [
                
                'title' => 'Tempore quibusdam provident cumque ratione explicabo ab deleniti, qui dolore itaque distinctio!',
                'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maxime quaerat labore quasi possimus earum repellat 
                
                                tempora voluptas nisi aliquid quis perferendis unde atque distinctio eum commodi doloribus repellendus corrupti 
                                enim eius, odit ipsum fugit pariatur. Nemo quisquam voluptatibus commodi quidem a porro, repellendus eveniet 

                                iusto quis assumenda veniam. Inventore, temporibus?',
                'author' => 'John Doe',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(4)->format('Y-m-d H:i:s')            
            ],
        ];
    }
}