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
                "main_img"=> "https://th.bing.com/th/id/R.f341ecc3c6d9038d855b0e56b1f75260?rik=fnFXA9J1Ag7H6g&pid=ImgRaw&r=0",
                "max_guests"=> "2",
                "rooms"=> "1",
                "beds"=> "2",
                "baths"=> "1",
                "address"=> "via Trastevere, 1",
                "latitude"=> "41.88984",
                "longitude"=> "12.47182",
            ],
            [
                "user_id" => "2",
                "title" => "Casa Milano - Centro Storico",
                "description" => "Appartamento di circa 50 mq situato nel cuore del centro storico di Firenze. L'appartamento si compone di un ingresso, un soggiorno/cucina, una zona notte, un bagno finestrato e due balconcini. L’appartamento è interamente esposto sul cortile interno piantumato e per questo è particolarmente silenzioso.",
                "main_img" => "https://th.bing.com/th/id/R.e507885703adbbccfdae4a9037706939?rik=kqtHSNjUKMLm1w&pid=ImgRaw&r=0",
                "max_guests" => "3",
                "rooms" => "2",
                "beds" => "3",
                "baths" => "1",
                "address" => "via Milano, 10",
                "latitude" => "43.77135",
                "longitude" => "11.24862"
            ],
            [
                "user_id" => "3",
                "title" => "Villa Verde - Navigli",
                "description" => "Accogliente appartamento nel vivace quartiere dei Navigli a Milano. Dotato di un ampio soggiorno, cucina completamente attrezzata, due camere da letto luminose e un bagno moderno. Vicino a bar, ristoranti e trasporti pubblici.",
                "main_img" => "https://th.bing.com/th/id/R.82b96d4e6604fe75d0e490085e9a886c?rik=WIpujVYqIz4qsA&riu=http%3a%2f%2fblog.urbanfile.org%2fwp-content%2fuploads%2f2015%2f09%2fOpificio_Magolfa_18_61.jpg&ehk=fH054RozsmHLODfKKGO4liO9JhErGSFIrlOgeZ15S6Y%3d&risl=&pid=ImgRaw&r=0",
                "max_guests" => "4",
                "rooms" => "3",
                "beds" => "2",
                "baths" => "1",
                "address" => "Via Magolfa, 5",
                "latitude" => "45.45872",
                "longitude" => "9.17994"
            ],
            [
                "user_id" => "2",
                "title" => "Attico Panoramico - Brera",
                "description" => "Elegante attico con vista panoramica sul quartiere di Brera. Luminoso e spazioso, con un ampio salotto, cucina moderna, due camere da letto e due bagni. Ideale per chi cerca comfort e stile nel cuore di Milano.",
                "main_img" => "https://www.divinamilano.it/wp-content/uploads/2020/12/via-Fiori-Chiari.jpg",
                "max_guests" => "3",
                "rooms" => "2",
                "beds" => "2",
                "baths" => "2",
                "address" => "Via Fiori Chiari, 10",
                "latitude" => "45.47263",
                "longitude" => "9.18432"
            ],
            [
                "user_id" => "2",
                "title" => "Villa Esquilino Vista Colosseo",
                "description" => "Splendida villa con vista mozzafiato sul Colosseo a Roma. Luminosa e spaziosa, con ampi spazi verdi e terrazze panoramiche. Dotata di lussuosi interni, offre un soggiorno di lusso nel cuore della Città Eterna.",
                "main_img" => "https://a0.muscache.com/im/pictures/hosting/Hosting-982665992150591809/original/67d88f8f-8bf0-4e79-92f2-6ee6498b7bdb.jpeg?im_w=720",
                "max_guests" => "6",
                "rooms" => "4",
                "beds" => "3",
                "baths" => "2",
                "address" => "Via Cavour, 15",
                "latitude" => "41.89472",
                "longitude" => "12.49530"
            ],
            [

                "user_id" => "3",
                "title" => "Attico Panoramico - Piazza di Spagna",
                "description" => "Elegante attico con vista panoramica sulla famosa Piazza di Spagna a Roma. Recentemente ristrutturato e arredato con stile, dispone di un ampio salotto, una cucina moderna, due camere da letto e due bagni. Perfetto per un soggiorno indimenticabile nella Capitale.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-658361559411042275/original/3311f4df-26f7-4e89-9eec-b86eb82a60a1.jpeg?im_w=720",
                "max_guests" => "4",
                "rooms" => "3",
                "beds" => "2",
                "baths" => "2",
                "address" => "Via dei Condotti, 20",
                "latitude" => "41.90505",
                "longitude" => "12.48279"
            ],
             // rob
            [
                "user_id" => "4",
                "title" => "Casetta Romantica - Trastevere",
                "description" => "Graziosa casetta nel caratteristico quartiere di Trastevere a Roma. Arredata in stile romantico, offre un ambiente accogliente con una camera da letto, un bagno e una cucina completamente attrezzata. Vicino a caffè, ristoranti e attrazioni turistiche.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-1052667660324770442/original/1c36ec64-f6ef-4dd2-b794-72a4cad89185.jpeg?im_w=720",
                "max_guests" => "2",
                "rooms" => "1",
                "beds" => "1",
                "baths" => "1",
                "address" => "Via della Scala, 7",
                "latitude" => "41.88852",
                "longitude" => "12.46972"
            ],

            [
                "user_id" => "5",
                "title" => "Appartamento Storico - Centro Storico",
                "description" => "Appartamento storico nel cuore del centro storico di Roma. Con un fascino unico e una posizione ideale, questa struttura offre un soggiorno confortevole con una camera da letto, un bagno e una zona giorno luminosa. Vicino a monumenti e negozi.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-1091968467539858718/original/c61c2c60-dc99-4dc9-9b3f-e296e1224862.jpeg?im_w=720",
                "max_guests" => "3",
                "rooms" => "1",
                "beds" => "1",
                "baths" => "1",
                "address" => "Via Giulia, 10",
                "latitude" => "41.89498",
                "longitude" => "12.47063"
            ],
            [
                "user_id" => "6",
                "title" => "Villetta Tranquilla - Gianicolo",
                "description" => "Tranquilla villetta sul suggestivo colle del Gianicolo a Roma. Circondata da giardini privati e terrazze panoramiche, questa struttura offre un'oasi di pace con un ampio salotto, una cucina attrezzata, tre camere da letto e due bagni.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-594285415900056319/original/761ed59a-4991-4619-b077-6942e2d5eb07.png?im_w=720",
                "max_guests" => "6",
                "rooms" => "4",
                "beds" => "3",
                "baths" => "2",
                "address" => "Via Garibaldi, 30",
                "latitude" => "41.89205",
                "longitude" => "12.46817"
            ],
            [
                "user_id" => "7",
                "title" => "Monolocale Moderno - Testaccio",
                "description" => "Moderno monolocale nel vivace quartiere di Testaccio a Roma. Recentemente ristrutturato e dotato di tutti i comfort, offre uno spazio confortevole con una zona notte, un angolo cottura e un bagno. Ideale per una coppia o un viaggiatore singolo.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-1075218108249543542/original/72546dbe-2a78-4511-89e5-e71f21ff6272.jpeg?im_w=720",
                "max_guests" => "2",
                "rooms" => "1",
                "beds" => "1",
                "baths" => "1",
                "address" => "Via Marmorata, 15",
                "latitude" => "41.87791",
                "longitude" => "12.47980"
            ],
            [
                "user_id" => "7",
                "title" => "Loft Moderno - Porta Nuova",
                "description" => "Stiloso loft nel quartiere di Porta Nuova a Milano. Arredato con design contemporaneo, dispone di uno spazio aperto con zona giorno, zona notte soppalcata, cucina attrezzata e bagno di design. Ideale per chi cerca comfort e stile nella vivace Milano.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-752624031577677214/original/d0194f64-6797-438c-a332-ede1360b0c86.jpeg?im_w=1200",
                "max_guests" => "2",
                "rooms" => "1",
                "beds" => "1",
                "baths" => "1",
                "address" => "Via Farini, 22",
                "latitude" => "45.48532",
                "longitude" => "9.18945"
            ],
            [
                "user_id" => "3",
                "title" => "Appartamento Elegante - Duomo",
                "description" => "Elegante appartamento nel cuore di Milano, a due passi dal Duomo. Luminoso e spazioso, con arredi di design e finiture di lusso. Dispone di un ampio salotto, cucina moderna, due camere da letto e due bagni. Perfetto per un soggiorno di lusso nella città della moda.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-1095484907567215749/original/1bf4d7d6-dc5d-4a6b-8e14-85e550bdb680.jpeg?im_w=1200",
                "max_guests" => "4",
                "rooms" => "3",
                "beds" => "2",
                "baths" => "2",
                "address" => "Via Torino, 5",
                "latitude" => "45.46389",
                "longitude" => "9.18923"
            ],
            [
                "user_id" => "5",
                "title" => "Villa Liberty - Porta Venezia",
                "description" => "Villa storica nel prestigioso quartiere di Porta Venezia a Milano. Finemente arredata in stile Liberty, offre un'atmosfera unica e affascinante. Dotata di ampi spazi verdi, terrazze panoramiche e interni lussuosi. Perfetta per un soggiorno di charme nella città della moda.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-868706867173229524/original/2cdceed6-e575-4d6f-be9c-e411bd0f44eb.jpeg?im_w=1200",
                "max_guests" => "8",
                "rooms" => "5",
                "beds" => "4",
                "baths" => "3",
                "address" => "Corso Buenos Aires, 15",
                "latitude" => "45.47632",
                "longitude" => "9.20384"
            ],
            [
                "user_id" => "6",
                "title" => "Attico Panoramico - Garibaldi",
                "description" => "Attico con vista panoramica nel quartiere di Garibaldi a Milano. Arredato con eleganza e modernità, dispone di ampi spazi interni e esterni, tra cui una terrazza con vista mozzafiato sulla città. Perfetto per un soggiorno di lusso in una delle zone più trendy di Milano.",
                "main_img" => "https://img3.idealista.it/blur/WEB_LISTING-M/0/id.pro.it.image.master/d9/1f/0b/394626989.jpg",
                "max_guests" => "6",
                "rooms" => "4",
                "beds" => "3",
                "baths" => "2",
                "address" => "Via Pirelli, 20",
                "latitude" => "45.48471",
                "longitude" => "9.18762"
            ],
            [
                "user_id" => "7",
                "title" => "Casa Moderna - Isola",
                "description" => "Splendida casa moderna nel quartiere dell'Isola a Milano. Arredata con gusto contemporaneo, dispone di ampi spazi living, cucina attrezzata, tre camere da letto e due bagni. Ideale per un soggiorno confortevole e di design nella Milano del futuro.",
                "main_img" => "https://th.bing.com/th/id/OIP.kGaFkUGivYsTSstGxoINRgHaE8?rs=1&pid=ImgDetMain",
                "max_guests" => "6",
                "rooms" => "4",
                "beds" => "3",
                "baths" => "2",
                "address" => "Via Borsieri, 30",
                "latitude" => "45.48396",
                "longitude" => "9.18342"
            ],
            [
                "user_id" => "6",
                "title" => "Attico Panoramico - Garibaldi",
                "description" => "Attico con vista panoramica nel quartiere di Garibaldi a Milano. Arredato con eleganza e modernità, dispone di ampi spazi interni e esterni, tra cui una terrazza con vista mozzafiato sulla città. Perfetto per un soggiorno di lusso in una delle zone più trendy di Milano.",
                "main_img" => "https://img3.idealista.it/blur/WEB_LISTING-M/0/id.pro.it.image.master/d9/1f/0b/394626989.jpg",
                "max_guests" => "6",
                "rooms" => "4",
                "beds" => "3",
                "baths" => "2",
                "address" => "Via Pirelli, 20",
                "latitude" => "45.48471",
                "longitude" => "9.18762"
            ],
            [
                "user_id" => "7",
                "title" => "Casa Moderna - Isola",
                "description" => "Splendida casa moderna nel quartiere dell'Isola a Milano. Arredata con gusto contemporaneo, dispone di ampi spazi living, cucina attrezzata, tre camere da letto e due bagni. Ideale per un soggiorno confortevole e di design nella Milano del futuro.",
                "main_img" => "https://th.bing.com/th/id/OIP.kGaFkUGivYsTSstGxoINRgHaE8?rs=1&pid=ImgDetMain",
                "max_guests" => "6",
                "rooms" => "4",
                "beds" => "3",
                "baths" => "2",
                "address" => "Via Borsieri, 30",
                "latitude" => "45.48396",
                "longitude" => "9.18342"
            ],
            [
                "user_id" => "6",
                "title" => "Attico Panoramico - Garibaldi",
                "description" => "Attico con vista panoramica nel quartiere di Garibaldi a Milano. Arredato con eleganza e modernità, dispone di ampi spazi interni e esterni, tra cui una terrazza con vista mozzafiato sulla città. Perfetto per un soggiorno di lusso in una delle zone più trendy di Milano.",
                "main_img" => "https://img3.idealista.it/blur/WEB_LISTING-M/0/id.pro.it.image.master/d9/1f/0b/394626989.jpg",
                "max_guests" => "6",
                "rooms" => "4",
                "beds" => "3",
                "baths" => "2",
                "address" => "Via Pirelli, 20",
                "latitude" => "45.48471",
                "longitude" => "9.18762"
            ],
            [
                "user_id" => "7",
                "title" => "Appartamento Moderno - Porta Venezia",
                "description" => "Splendido appartamento moderno situato vicino a Porta Venezia, nel cuore di Milano. Completamente ristrutturato con arredi di design, questo appartamento offre un'esperienza di soggiorno di lusso. Dotato di tutti i comfort, inclusa una cucina completamente attrezzata e un'ampia zona living.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-1097021966233554802/original/251b80c3-c8e6-4b8f-b0ef-1c62fdaa7c08.jpeg?im_w=1200",
                "max_guests" => "4",
                "rooms" => "2",
                "beds" => "2",
                "baths" => "1",
                "address" => "Corso Buenos Aires, 123",
                "latitude" => "45.47832",
                "longitude" => "9.20556"
            ],
            [
                "user_id" => "8",
                "title" => "Villa con Giardino - Quartiere Trieste",
                "description" => "Bellissima villa con giardino nel quartiere residenziale di Trieste a Roma. Questa elegante proprietà offre spazi ampi e luminosi, ideali per famiglie o gruppi di amici. Il giardino privato è perfetto per rilassarsi all'aria aperta. Vicino a negozi, ristoranti e trasporti pubblici.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-1095484907567215749/original/1bf4d7d6-dc5d-4a6b-8e14-85e550bdb680.jpeg?im_w=720",
                "max_guests" => "8",
                "rooms" => "5",
                "beds" => "4",
                "baths" => "3",
                "address" => "Via Alessandro Poerio, 56",
                "latitude" => "41.91875",
                "longitude" => "12.51762"
            ],
            [
                "user_id" => "9",
                "title" => "Loft Industriale - Navigli",
                "description" => "Incantevole loft industriale situato nel vivace quartiere dei Navigli a Milano. Caratterizzato da un design unico e da ampi spazi aperti, questo loft offre un'esperienza urbana autentica. Dotato di cucina all'avanguardia e zona living confortevole, è perfetto per chi ama lo stile di vita metropolitano.",
                "main_img" => "https://a0.muscache.com/im/pictures/7e0cfd37-a75d-42cf-9e03-1b9ae309bcd0.jpg?im_w=1200",
                "max_guests" => "3",
                "rooms" => "1",
                "beds" => "1",
                "baths" => "1",
                "address" => "Via Corsico, 18",
                "latitude" => "45.45587",
                "longitude" => "9.16842"
            ],
            [
                "user_id" => "10",
                "title" => "Penthouse Panoramico - Trastevere",
                "description" => "Elegante penthouse con vista panoramica nel pittoresco quartiere di Trastevere a Roma. Luminoso e spazioso, questo appartamento offre un ambiente raffinato e confortevole. La terrazza privata è perfetta per ammirare i tramonti sulla città eterna. Vicino a bar, ristoranti e principali attrazioni turistiche.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-1068846245217038186/original/7c0a9266-48fc-4b15-b8f7-657dac23f393.jpeg?im_w=720",
                "max_guests" => "4",
                "rooms" => "3",
                "beds" => "2",
                "baths" => "2",
                "address" => "Via Garibaldi, 78",
                "latitude" => "41.88942",
                "longitude" => "12.46978",
            ],
            [
                "user_id" => "11",
                "title" => "Monolocale Affascinante - Centro Storico",
                "description" => "Accogliente monolocale nel cuore del centro storico di Roma. Recentemente ristrutturato e arredato con gusto, questo appartamento offre un'oasi di tranquillità nel vivace tessuto urbano della città eterna. Ideale per coppie o viaggiatori singoli in cerca di un rifugio accogliente.",
                "main_img" => "https://a0.muscache.com/im/pictures/1d5bafea-e7e5-4138-963c-dd67bfb049bf.jpg?im_w=720",
                "max_guests" => "2",
                "rooms" => "1",
                "beds" => "1",
                "baths" => "1",
                "address" => "Via dei Coronari, 10",
                "latitude" => "41.89921",
                "longitude" => "12.46935",
            ],
            [
                "user_id" => "12",
                "title" => "Villetta Panoramica - Collina Romana",
                "description" => "Affascinante villetta con vista panoramica sulla collina romana. Immersa nel verde e nella tranquillità, questa proprietà offre un'esperienza di vita rurale a pochi passi dal centro della città. Perfetta per chi cerca una fuga dalla frenesia cittadina senza rinunciare alla comodità.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-975780158154640012/original/7c239d8f-dc24-4243-a73b-52c47381f319.jpeg?im_w=720",
                "max_guests" => "6",
                "rooms" => "4",
                "beds" => "3",
                "baths" => "2",
                "address" => "Via Appia Antica, 123",
                "latitude" => "41.85842",
                "longitude" => "12.49567"
            ],
            [
                "user_id" => "13",
                "title" => "Attico Raffinato - Quadrilatero della Moda",
                "description" => "Elegante attico nel prestigioso Quadrilatero della Moda a Milano. Arredato con gusto e dotato di finiture di lusso, questo appartamento offre una vista mozzafiato sui tetti della città. Ideale per chi ricerca un soggiorno di classe nel cuore della moda e del design.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-1035541729707521353/original/928b6ec6-7fdc-42a1-bca3-8ce2233336e9.jpeg?im_w=720",
                "max_guests" => "4",
                "rooms" => "3",
                "beds" => "2",
                "baths" => "2",
                "address" => "Via Montenapoleone, 10",
                "latitude" => "45.46890",
                "longitude" => "9.19475"
            ],
            [
                "user_id" => "14",
                "title" => "Appartamento Storico - Trastevere",
                "description" => "Accogliente appartamento storico nel suggestivo quartiere di Trastevere a Roma. Caratterizzato da travi a vista e pavimenti in cotto, questo appartamento conserva il fascino dell'antico ma con tutti i comfort moderni. Vicino a bar, ristoranti e attrazioni turistiche.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-1108885196341079589/original/3835340a-eb44-4892-9bc6-d8505337a10e.jpeg?im_w=720",
                "max_guests" => "3",
                "rooms" => "2",
                "beds" => "2",
                "baths" => "1",
                "address" => "Via della Scala, 5",
                "latitude" => "41.88756",
                "longitude" => "12.46783"
            ],
            [
                "user_id" => "15",
                "title" => "Loft Moderno - Isola",
                "description" => "Incantevole loft moderno nel vivace quartiere dell'Isola a Milano. Caratterizzato da spazi aperti e design contemporaneo, questo loft offre un ambiente luminoso e accogliente. Perfetto per chi ama l'arte, la cultura e la vita notturna della città.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-37113238/original/90742b18-bbb7-4d5a-97ce-ddb8dc412e9a.jpeg?im_w=720",
                "max_guests" => "2",
                "rooms" => "1",
                "beds" => "1",
                "baths" => "1",
                "address" => "Via Pepe, 7",
                "latitude" => "45.48328",
                "longitude" => "9.18342"
            ],
            [
                "user_id" => "1",
                "title" => "Villa con Piscina - Appia Antica",
                "description" => "Splendida villa con piscina nella suggestiva cornice dell'Appia Antica a Roma. Circondata da un ampio giardino, questa villa offre un'oasi di pace e tranquillità lontano dal trambusto della città. Perfetta per famiglie o gruppi in cerca di relax e comfort.",
                "main_img" => "https://a0.muscache.com/im/pictures/miso/Hosting-17503300/original/5299f6e4-1de0-452b-9e33-095e2dd7750d.jpeg?im_w=720",
                "max_guests" => "10",
                "rooms" => "6",
                "beds" => "5",
                "baths" => "4",
                "address" => "Via Appia Antica, 456",
                "latitude" => "41.85732",
                "longitude" => "12.51567"
            ],






        ];
        foreach ($apartments as $apartmentData) {
            Apartment::create($apartmentData);
        }
    }
}
