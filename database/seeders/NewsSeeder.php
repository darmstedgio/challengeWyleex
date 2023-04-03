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
                'title' => 'Sancor Seguros entra en el desarrollo inmobiliario y busca oportunidades en Córdoba',
                'content' => 'La actividad aseguradora es uno de los principales inversores en el país. Grupo Sancor Seguros, como todos en el rubro, basa su negocio en conseguir primas e invertir sus fondos para superar la inflación, de manera tal que contar con los fondos para cubrir los siniestros.

                                Para eso invierte en productos financieros, incluso bonos del sector público (como todos en el rubro); proyectos de la economía real; emprendedores, a través de su aceleradora Centro de Innovación Tecnológica, Empresarial y Social (Cites), y, desde hace poco tiempo, desarrollos inmobiliarios.',
                'author' => 'Diego Dávila',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(52)->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Sancor: el Estado como facilitador, no como inversor',
                'content' => 'Con la medida de fuerza, el sindicato iba a reclamar la instrumentación por parte del Gobierno de un fideicomiso, como mecanismo para rescatar una vez más a la empresa láctea.

                                La creación de esta figura –en principio conformado por 60 millones de dólares aportados por el Banco Nación–, fue la idea que los exministerios de Desarrollo Productivo y de Agricultura, entre otros impulsores, comenzaron a diseñar hace poco más de un año.
                
                                Los administradores de ese fideicomiso, con dinero público, iban a ser algunos empresarios de renombre, pero ninguno de ellos relacionado de manera directa con la industria láctea.',
                'author' => 'Alejandro Rollán',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(48)->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Video: serio incidente de una conductora con policías de la Caminera',
                'content' => 'Todo sucedió el pasado miércoles a las 16.40 cuando efectivos de la Caminera hicieron detener un Citroën DS3 porque “circulaba con las luces bajas apagadas”, informaron fuentes policiales.

                                Desde la fuerza se indicó que se hizo detener la marcha del rodado y se le pidió a la conductora que estacione sobre banquina.
                
                                La automovilista, Regina Lina Beatriz Utrera, mantuvo un fuerte cruce verbal con los policías Zeballos y Rivera. Algo sucedió porque los policías comenzaron a filmarla con la finalidad de “documentar todo”. En un video se observa a la mujer intentando marcharse del lugar y a uno de los policías, parados al lado del auto, diciendo que estaba siendo pisado por una rueda.',
                'author' => 'Redacción LAVOZ',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(44)->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Ganadería: los precios de la hacienda deberán pasar el invierno',
                'content' => '“La incertidumbre por lo que viene es total. Habrá que ver qué pasa con la oferta de ‘gordos’ y con la invernada. Yo creo que, a raíz de la sequía, la invernada se ha anticipado un 30% a lo que es normal todos los años. Hoy está abajo o igual que la hacienda para faena. En la medida de que las lluvias se generalicen, va a disminuir la oferta de invernada. Eso va mejorar el precio. Pero hay una marcada incertidumbre”, sostuvo Miguel Talano, de Talano Hermanos.

                            “Creo que por el término de dos o tres meses no va haber una oferta normal de gordos, por la falta de pasto y de granos a raíz de la sequía. De acá a tres meses, cuando pueda haber comida y engordar la hacienda, puede haber más oferta de gordo. Momentáneamente, se mantendrán los precios de hacienda con destino a faena”, agregó.',
                'author' => 'Joaquín Aguirre',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(22)->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Precios ganaderos: especialistas no esperan mejoras significativas en el corto plazo',
                'content' => 'Si el sector agrícola está sufriendo de manera dramática la sequía con rindes muy por debajo del promedio, el panorama en la cadena ganadera no es más alentador. Según el analista de AgroIdeas Federico Santángelo, quien participó del ciclo Charlas Granaderas organizado por la Federación de Industrias Frigoríficas Regionales Argentinas (Fifra), no se esperan en el corto plazo mejoras significativas en los valores de la hacienda.

                            Santángelo sostuvo que el criador es el que más está sufriendo las consecuencias climáticas y económicas. “Si desde 2020 el ternero pasó a ser refugio de valor y contó con alta demanda y a su vez se vendió con buenos precios la vaca por la alta demanda de China, este año el panorama es el contrario”, dijo.',
                'author' => 'Redacción Agrovoz',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(17)->format('Y-m-d H:i:s')
            ],

            [
                'title' => 'Video: el Chaqueño Palavecino revoleó una camiseta en el estadio de Santiago del Estero',
                'content' => 'Este martes, Chaqueño Palavecino se mostró cómo un hincha más en el estadio Madre de Ciudades de Santiago del Estero. El cantautor de 63 años presenció el partido entre Argentina y Curazao y festejó desde temprano a la par de los fanáticos, revoleando la camiseta como si fuera una poncho.

                                Foto: captura pantalla
                                Periodista apuntó contra el Chaqueño Palavecino: “Lo voy a decir por las redes porque me la banco”
                                Por lo visto, el cantante pasó la página de su polémica presentación en el Festival del Cosechador en Mendoza y se mostró muy feliz en el último festejo de la selección argentina. Portando su clásico sombrero y una camisa azul francia, el cantante fue enfocado por la transmisión oficial en varias oportunidades.
                
                                Al advertir su presencia, el equipo de musicalización del estadio optó por pasar algunas de sus canciones. También sonaron temas tradicionales de la provincia del norte argentino, el infaltable hit mundialista de La T y la M y un set cumbiero de Los Totora.
                
                                Sin embargo, el momento más icónico de Palavecino en la fiesta de los campeones del mundo fue cuando empezó a revolear una camiseta argentina al ritmo de la música y el aliento de la gente.',
                'author' => 'Redacción VOS',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(9)->format('Y-m-d H:i:s')            
            ],
            [
                'title' => 'Un lugar en barrio Marqués de Sobremonte para disfrutar de las pastas como en Colonia Caroya',
                'content' => 'Las pastas de la fábrica El Marqués son un clásico de la zona norte de la ciudad. Si uno pasa por esa esquina tradicional del barrio de las diagonales, sobre todo en temporada de otoño invierno, se dará cuenta de que su nombre está más que vigente: siempre hay gente esperando en la vereda.

                                Pero la novedad pasa por el resto bar que la familia propietaria acaba de inaugurar hace apenas algunos meses. Está a pocos metros de la fábrica y propone un diseño de confitería clásica, con una sala iluminada naturalmente gracias al panel vidriado de la fachada.
                
                                Adentro el mobiliario es cómodo y variado. Vemos plantas colgando, espejos en las paredes, televisores mostrando destinos turísticos del mundo y, hasta una cava para buscar el vino que acompañe mejor a las estrellas de la carta, que son obviamente las pastas.
                
                                Tomamos asiento y empezamos a descubrir que hay una gran variedad de pastas lisas y rellenas con sus salsas, pero también mucha propuesta de cafetería, para los desayunos y meriendas. También empanadas y pizzas. Nosotros vamos a largar con un dúo perfecto, imbatible e incomparable: salame y vino.',
                'author' => 'Nicolás Marchetti',
                'user_id' => 1,
                'datetime' => Carbon::parse(Carbon::now())->subMinutes(4)->format('Y-m-d H:i:s')            
            ],
        ];
    }
}