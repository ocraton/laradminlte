<?php

/********** restituisce le regioni */
if (! function_exists('getRegioni')) {

    function getRegioni() {
        
        $regioni = ["Abruzzo" => "Abruzzo",
            "Basilicata" => "Basilicata",
            "Calabria" => "Calabria",
            "Campania" => "Campania",
            "Emilia Romagna" => "Emilia Romagna",
            "Friuli Venezia Giulia" => "Friuli Venezia Giulia",
            "Lazio" => "Lazio",
            "Liguria" => "Liguria",
            "Lombardia" => "Lombardia",
            "Marche" => "Marche",
            "Molise" => "Molise",
            "Piemonte" => "Piemonte",
            "Puglia" => "Puglia",
            "Sardegna" => "Sardegna",
            "Sicilia" => "Sicilia",
            "Toscana" => "Toscana",
            "Trentino Alto Adige" => "Trentino Alto Adige",
            "Umbria" => "Umbria",
            "Valle d'Aosta" => "Valle d'Aosta",
            "Veneto" => "Veneto"
        ];

        return $regioni;
    }
}

/********** restituisce le province */
if (! function_exists('getProvince')) {

    function getProvince() {
        
        $province = [
            "Agrigento", "Alessandria", "Ancona", "Aosta", "Arezzo",
            "Ascoli Piceno", "Asti", "Avellino", "Bari", "Barletta-Andria-Trani",
            "Belluno", "Benevento", "Bergamo", "Biella", "Bologna", "Bolzano",
            "Brescia", "Brindisi", "Cagliari", "Caltanissetta", "Campobasso",
            "Carbonia-Iglesias", "Caserta", "Catania", "Catanzaro", "Chieti",
            "Como", "Cosenza", "Cremona", "Crotone", "Cuneo", "Enna", "Fermo",
            "Ferrara", "Firenze", "Foggia", "Forlì-Cesena", "Frosinone", "Genova",
            "Gorizia", "Grosseto", "Imperia", "Isernia", "L'Aquila", "La Spezia",
            "Latina", "Lecce", "Lecco", "Livorno", "Lodi", "Lucca", "Macerata",
            "Mantova", "Massa-Carrara", "Matera", "Medio Campidano", "Messina",
            "Milano", "Modena", "Monza e della Brianza", "Napoli", "Novara",
            "Nuoro", "Ogliastra", "Olbia-Tempio", "Oristano", "Padova",
            "Palermo", "Parma", "Pavia", "Perugia", "Pesaro e Urbino", "Pescara",
            "Piacenza", "Pisa", "Pistoia", "Pordenone", "Potenza", "Prato",
            "Ragusa", "Ravenna", "Reggio Calabria", "Reggio Emilia", "Rieti",
            "Rimini", "Roma", "Rovigo", "Salerno", "Sassari", "Savona", "Siena",
            "Siracusa", "Sondrio", "Taranto", "Teramo", "Terni", "Torino", "Trapani",
            "Trento", "Treviso", "Trieste", "Udine", "Varese", "Venezia",
            "Verbano-Cusio-Ossola", "Vercelli", "Verona", "Vibo Valentia",
            "Vicenza", "Viterbo"
        ];

        return $province;
    }
}
