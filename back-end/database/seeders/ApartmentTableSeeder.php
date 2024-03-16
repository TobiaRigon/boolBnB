<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Apartment;
use App\Models\User;

class ApartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = [
            // admin
            [
                "user_id"=> "1",
                "title"=> "Appartamento Roma - Trastevere",
                "description"=> "Un appartamento completamente nuovo a Tua disposizione nel cuore di Trastevere per un soggiorno di lavoro o per una vacanza. ",
                "main_img"=> "https://th.bing.com/th/id/OIP.j2jDyhBI5sbjtVYudRptlgHaFj?w=243&h=183&c=7&r=0&o=5&dpr=1.3&pid=1.7",
                "max_guests"=> "2",
                "rooms"=> "1",
                "beds"=> "2",
                "baths"=> "1",
                "address"=> "via Trastevere, 1",
                "latitude"=> "41.88984",
                "longitude"=> "12.47182",
            ],
            [
                "user_id"=> "1",
                "title"=> "Casa Firenze - Centro Storico",
                "description"=> "Appartamento di circa 50 mq situato nel cuore del centro storico di Firenze. L'appartamento si compone di un ingresso, un soggiorno/cucina, una zona notte, un bagno finestrato e due balconcini. L’appartamento è interamente esposto sul cortile interno piantumato e per questo è particolarmente silenzioso.",
                "main_img"=> "https://th.bing.com/th/id/OIP.jCm0e6C9_G2nlmUVkGlJfAHaFj?w=252&h=188&c=7&r=0&o=5&dpr=1.3&pid=1.7",
                "max_guests"=> "3",
                "rooms"=> "2",
                "beds"=> "3",
                "baths"=> "1",
                "address"=> "via Firenze, 31",
                "latitude"=> "43.77135",
                "longitude"=> "11.24862",
            ],
            [
                "user_id"=> "1",
                "title"=> "Maisonette Venezia - Cannaregio",
                "description"=> "Vicinissimo alla movida di Cannaregio ma in posizione tranquilla. Appartamento in tipica casa veneziana a pochi passi dalla fermata del vaporetto di Fondamenta Nuove. I bar e la vita dei locali di Rio Tera' San Leonardo a 5 minuti a piedi.",
                "main_img"=> "https://th.bing.com/th/id/R.424fe168e488aecfb74c98e7dd09e9e5?rik=0ivhukBOw%2b8jwg&riu=http%3a%2f%2fwww.idesignarch.com%2fwp-content%2fuploads%2fTaipei-Studio-Apartment_1.jpeg&ehk=k152PHdG57wX5CZeJT06dbwfUSlOd9mFKnVHPK3DYUY%3d&risl=&pid=ImgRaw&r=0",
                "max_guests"=> "3",
                "rooms"=> "2",
                "beds"=> "3",
                "baths"=> "1",
                "address"=> "Cannaregio, 1",
                "latitude"=> "45.44345",
                "longitude"=> "12.33476",
            ],
            [
                "user_id"=> "1",
                "title"=> "Centro Storico Napoli",
                "description"=> "Appartamento nel cuore di Napoli, in un palazzo signorile, a pochi passi da Piazza del Plebiscito. Si trova al secondo piano, servito da ascensore; è presente un piccolo balcone che si affaccia sul cortile con un tavolino. Grande living con divano letto e TV; cucina open space completamente attrezzata, due camere da letto di cui una matrimoniale e una con letto una piazza e mezza. Bagno completo con doccia e vasca da bagno.",
                "main_img"=> "https://th.bing.com/th/id/OIP.Zy-HtatN14Z1OfeYWInQjQHaFj?w=600&h=450&rs=1&pid=ImgDetMain",
                "max_guests"=> "4",
                "rooms"=> "3",
                "beds"=> "4",
                "baths"=> "2",
                "address"=> "via Toledo, 13",
                "latitude"=> "40.83673",
                "longitude"=> "14.24856",
            ],
            [
                "user_id"=> "1",
                "title"=> "Appartamento Bologna - Piazza Maggiore",
                "description"=> "Monolocale ubicato in Piazza Maggiore, quartiere storico di Bologna con molteplici servizi a disposizione e un piacevole contesto architettonico da ammirare che renderà indimenticabile il vostro soggiorno in questa splendida città: uscendo dal cortile del palazzo il vostro sguardo incrocerà l'imponente sagoma delle Due Torri che vi accompagnerà nella vostra passeggiata per raggiungere comodamente la Basilica di San Petronio (15 min).",
                "main_img"=> "https://th.bing.com/th/id/OIP.u37VRfLBvPFwY67o8DQBkAHaEo?w=512&h=320&rs=1&pid=ImgDetMain",
                "max_guests"=> "2",
                "rooms"=> "1",
                "beds"=> "1",
                "baths"=> "1",
                "address"=> "Piazza Maggiore, 36",
                "latitude"=> "44.49373",
                "longitude"=> "11.34303",
            ],
            [
                "user_id"=> "1",
                "title"=> "Milano Via Marghera",
                "description"=> "Questo meraviglioso appartamento/monolocale è stato completamente ristrutturato e pensato per offrire ai suoi ospiti il massimo della serenità. Studiato per persone che amano vivere nel centro città in una delle zone più vivaci e affascinati di Milano. La zona Marghera offre numerosi ristoranti e locali dove trascorrere giornate e serate in allegria. L'appartamento è progettato per due persone ed è fornito con tutto l'occorrente per un piacevole soggiorno.",
                "main_img"=> "https://lvarquitetos.com/wp-content/uploads/2022/07/apto-republica-lv-arquitetos-fotografo-kadu-lopes-1-1-scaled.jpg",
                "max_guests"=> "2",
                "rooms"=> "1",
                "beds"=> "2",
                "baths"=> "1",
                "address"=> "via Ravizza, 23",
                "latitude"=> "45.46787",
                "longitude"=> "9.1522",
            ],
             // rob
             [
                "user_id"=> "1",
                "title"=> "Appartamento Venezia - Cannaregio",
                "description"=> "Un appartamento completamente nuovo a Tua disposizione nel centro di Venezia per un soggiorno di lavoro o per una vacanza. ",
                "main_img"=> "https://th.bing.com/th/id/OIP.j2jDyhBI5sbjtVYudRptlgHaFj?w=243&h=183&c=7&r=0&o=5&dpr=1.3&pid=1.7",
                "max_guests"=> "2",
                "rooms"=> "1",
                "beds"=> "2",
                "baths"=> "1",
                "address"=> "Calle de la Misericordia, 123",
                "latitude"=> "45.43885",
                "longitude"=> "12.33576",
            ],

        ];
        foreach ($apartments as $apartmentData) {
            $apartment = Apartment::create($apartmentData);

            // Assumendo che vuoi aggiungere 5 immagini per ogni appartamento
            for ($i = 0; $i < 5; $i++) {
                Gallery::create([
                    'apartment_id' => $apartment->id,
                    'path' => "path/to/your/image{$i}.jpg", // Modifica con il percorso effettivo
                ]);
            }
        }
    }
}
