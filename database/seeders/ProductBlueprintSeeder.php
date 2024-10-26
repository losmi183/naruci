<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductBlueprint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductBlueprintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductBlueprint::create([
            'category_id' => 1,
            'name' => 'Mala Pljeskavica',
            'description' => 'Mala pljeskavica od junećeg mesa, idealna za lagani obrok.',
            'price' => 200,
            'grams' => 100,
            'centimeters' => null,
            'image' => 'images/mala_pljeskavica.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 1,
            'name' => 'Srednja Pljeskavica',
            'description' => 'Srednja pljeskavica od junećeg mesa, odlična za ručak.',
            'price' => 300,
            'grams' => 150,
            'centimeters' => null,
            'image' => 'images/srednja_pljeskavica.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 1,
            'name' => 'Velika Pljeskavica',
            'description' => 'Velika pljeskavica od junećeg mesa za prave gurmane.',
            'price' => 400,
            'grams' => 200,
            'centimeters' => null,
            'image' => 'images/velika_pljeskavica.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 1,
            'name' => 'Gurmanska Pljeskavica',
            'description' => 'Gurmanska pljeskavica sa sirom i slaninom.',
            'price' => 450,
            'grams' => 220,
            'centimeters' => null,
            'image' => 'images/gurmanska_pljeskavica.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 1,
            'name' => 'Pileći File',
            'description' => 'Sočni pileći file, pečen na roštilju.',
            'price' => 350,
            'grams' => 150,
            'centimeters' => null,
            'image' => 'images/pileci_file.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 1,
            'name' => 'Pileći Batak',
            'description' => 'Ukusni pileći batak, pečen do savršenstva.',
            'price' => 300,
            'grams' => 180,
            'centimeters' => null,
            'image' => 'images/pileci_batak.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 1,
            'name' => 'Bela Vešalica',
            'description' => 'Sočna svinjska bela vešalica sa roštilja.',
            'price' => 400,
            'grams' => 200,
            'centimeters' => null,
            'image' => 'images/bela_vesalica.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 1,
            'name' => 'Dimljena Vešalica',
            'description' => 'Dimljena svinjska vešalica, jedinstvenog ukusa.',
            'price' => 450,
            'grams' => 220,
            'centimeters' => null,
            'image' => 'images/dimljena_vesalica.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 1,
            'name' => 'Roštiljska Kobasica',
            'description' => 'Kobasica sa roštilja, začinjena do savršenstva.',
            'price' => 250,
            'grams' => 100,
            'centimeters' => null,
            'image' => 'images/rostiljska_kobasica.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 1,
            'name' => 'Ćevapi',
            'description' => 'Tradicionalni ćevapi, pripremljeni na roštilju.',
            'price' => 300,
            'grams' => 180,
            'centimeters' => null,
            'image' => 'images/cevapi.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 1,
            'name' => 'Pohovani Kačkavalj',
            'description' => 'Ukusni pohovani kačkavalj, hrskav spolja i kremast iznutra.',
            'price' => 350,
            'grams' => 120,
            'centimeters' => null,
            'image' => 'images/pohovani_kackavalj.jpg',
        ]);

        // Pizza (category_id = 2)
        ProductBlueprint::create([
            'category_id' => 2,
            'name' => 'Margarita',
            'description' => 'Klasična pizza sa paradajz sosom, sirom i bosiljkom.',
            'price' => 400,
            'grams' => null,
            'centimeters' => 30,
            'image' => 'images/margarita.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 2,
            'name' => 'Fungi',
            'description' => 'Pizza sa paradajz sosom, sirom i svežim pečurkama.',
            'price' => 450,
            'grams' => null,
            'centimeters' => 30,
            'image' => 'images/fungi.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 2,
            'name' => 'Capricciosa',
            'description' => 'Pizza sa šunkom, pečurkama, maslinama i sirom.',
            'price' => 500,
            'grams' => null,
            'centimeters' => 30,
            'image' => 'images/capricciosa.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 2,
            'name' => 'Quattro Stagioni',
            'description' => 'Pizza sa šunkom, artičokama, pečurkama i maslinama, podeljena na četiri ukusa.',
            'price' => 550,
            'grams' => null,
            'centimeters' => 30,
            'image' => 'images/quattro_stagioni.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 2,
            'name' => 'Vezuvio',
            'description' => 'Pizza sa paradajzom, sirom i šunkom, jednostavna i ukusna.',
            'price' => 450,
            'grams' => null,
            'centimeters' => 30,
            'image' => 'images/vezuvio.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 2,
            'name' => 'Pepperoni',
            'description' => 'Pizza sa pikantnim kobasicama i sirom.',
            'price' => 550,
            'grams' => null,
            'centimeters' => 30,
            'image' => 'images/pepperoni.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 2,
            'name' => 'Hawaiian',
            'description' => 'Pizza sa šunkom, sirom i ananasom za ljubitelje slatko-slanog ukusa.',
            'price' => 500,
            'grams' => null,
            'centimeters' => 30,
            'image' => 'images/hawaiian.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 2,
            'name' => 'Vegetariana',
            'description' => 'Pizza sa svežim povrćem: paprikom, tikvicama, pečurkama i maslinama.',
            'price' => 520,
            'grams' => null,
            'centimeters' => 30,
            'image' => 'images/vegetariana.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 2,
            'name' => 'Diavola',
            'description' => 'Pizza sa pikantnim kobasicama, paprikom i sirom.',
            'price' => 550,
            'grams' => null,
            'centimeters' => 30,
            'image' => 'images/diavola.jpg',
        ]);

        ProductBlueprint::create([
            'category_id' => 2,
            'name' => 'Quattro Formaggi',
            'description' => 'Pizza sa četiri vrste sira: mocarela, gorgonzola, parmezan i taleggio.',
            'price' => 600,
            'grams' => null,
            'centimeters' => 30,
            'image' => 'images/quattro_formaggi.jpg',
        ]);
    }
}
