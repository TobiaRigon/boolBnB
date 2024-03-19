<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Message;
use App\Models\Apartment;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { $messages = [
        [
            'sender_text' => 'Buongiorno, vorrei avere maggiori dettagli riguardo alla disponibilità dell\'appartamento nel vostro B&B per il periodo tra il 20 e il 25 marzo. Potreste gentilmente fornirmi informazioni sui servizi inclusi e sui costi aggiuntivi? Grazie!',
            'apartment_id' => '1',
            'date' => now()->format('Y-m-d'),
            'sender_mail' => 'mittente1@example.com',
            'sender_name' => 'Nome1',
            'sender_surname' => 'Cognome1',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'sender_text' => 'Salve, sono interessato all\'appartamento nel vostro B&B. Potreste gentilmente fornirmi informazioni sulla distanza dalle principali attrazioni turistiche e sui trasporti pubblici nelle vicinanze? Grazie mille!',
            'apartment_id' => '2',
            'date' => now()->format('Y-m-d'),
            'sender_mail' => 'mittente2@example.com',
            'sender_name' => 'Nome2',
            'sender_surname' => 'Cognome2',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'sender_text' => 'Buonasera, vorrei prenotare l\'appartamento nel vostro B&B per un soggiorno di 3 notti. Potreste gentilmente fornirmi informazioni sui costi e sulla politica di cancellazione? Grazie!',
            'apartment_id' => '1',
            'date' => now()->format('Y-m-d'),
            'sender_mail' => 'mittente3@example.com',
            'sender_name' => 'Nome3',
            'sender_surname' => 'Cognome3',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'sender_text' => 'Ciao, mi piacerebbe sapere se l\'appartamento nel vostro B&B è pet-friendly. Ho un piccolo cane e mi piacerebbe portarlo con me durante il soggiorno. Grazie!',
            'apartment_id' => '2',
            'date' => now()->format('Y-m-d'),
            'sender_mail' => 'mittente4@example.com',
            'sender_name' => 'Nome4',
            'sender_surname' => 'Cognome4',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'sender_text' => 'Salve, sono interessato all\'appartamento nel vostro B&B per un soggiorno di una settimana. Potreste gentilmente fornirmi informazioni sulla disponibilità e sui servizi inclusi? Grazie mille!',
            'apartment_id' => '1',
            'date' => now()->format('Y-m-d'),
            'sender_mail' => 'mittente5@example.com',
            'sender_name' => 'Nome5',
            'sender_surname' => 'Cognome5',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'sender_text' => 'Buongiorno, vorrei avere maggiori dettagli riguardo alla pulizia e all\'igiene dell\'appartamento nel vostro B&B. Potreste gentilmente fornirmi informazioni su come vengono gestiti questi aspetti? Grazie!',
            'apartment_id' => '2',
            'date' => now()->format('Y-m-d'),
            'sender_mail' => 'mittente6@example.com',
            'sender_name' => 'Nome6',
            'sender_surname' => 'Cognome6',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'sender_text' => 'Salve, vorrei sapere se è disponibile l\'appartamento nel vostro B&B per un weekend lungo. Potreste gentilmente fornirmi informazioni sui costi aggiuntivi e sui servizi inclusi? Grazie!',
            'apartment_id' => '1',
            'date' => now()->format('Y-m-d'),
            'sender_mail' => 'mittente7@example.com',
            'sender_name' => 'Nome7',
            'sender_surname' => 'Cognome7',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'sender_text' => 'Buonasera, vorrei avere ulteriori informazioni sull\'appartamento nel vostro B&B. Potreste gentilmente fornirmi dettagli sulla connessione internet e sui servizi disponibili? Grazie mille!',
            'apartment_id' => '2',
            'date' => now()->format('Y-m-d'),
            'sender_mail' => 'mittente8@example.com',
            'sender_name' => 'Nome8',
            'sender_surname' => 'Cognome8',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'sender_text' => 'Buongiorno, vorrei sapere se è possibile effettuare il check-in anticipato presso l\'appartamento nel vostro B&B. Avremmo bisogno di arrivare prima del previsto. Grazie!',
            'apartment_id' => '1',
            'date' => now()->format('Y-m-d'),
            'sender_mail' => 'mittente9@example.com',
            'sender_name' => 'Nome9',
            'sender_surname' => 'Cognome9',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'sender_text' => 'Ciao, vorrei avere maggiori informazioni sulla posizione dell\'appartamento nel vostro B&B. È facilmente accessibile dai trasporti pubblici? Grazie!',
            'apartment_id' => '2',
            'date' => now()->format('Y-m-d'),
            'sender_mail' => 'mittente10@example.com',
            'sender_name' => 'Nome10',
            'sender_surname' => 'Cognome10',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        // Aggiungi altri messaggi di esempio se necessario
    ];




    // Popolamento della tabella 'messages' con i dati di esempio
    foreach ($messages as $message) {
        Message::create($message);
    }

    }
}
