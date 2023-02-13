<?php

class PROJETMR_Install {

    public function __construct() {

        add_action( 'admin_init', array( $this, 'setup' ) );
        return;

    }

    public function setup()
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        if (!$this->isTableBaseAlreadyCreated('_pays')) {
            $sql_pays = '
            CREATE TABLE IF NOT EXISTS `' . $wpdb->prefix . PROJETMR_BASENAME . '_pays' . '` (
                `id` INT(11) AUTO_INCREMENT NOT NULL,
                `pays` VARCHAR(255) NOT NULL,
                `ISO` VARCHAR(3) NOT NULL,
                `etoiles` INT(5) NOT NULL,
                `majeur` BOOLEAN,
                `actif` BOOLEAN,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB ' . $charset_collate;

            if (dbDelta($sql_pays)) {

                $pays = ["Afghanistan",
                    "Îles Åland",
                    "Albanie",
                    "Algérie",
                    "Samoa américaines",
                    "Andorre",
                    "Angola",
                    "Anguilla",
                    "Antarctique",
                    "Antigua-et-Barbuda",
                    "Argentine",
                    "Arménie",
                    "Aruba",
                    "Australie",
                    "Autriche",
                    "Azerbaïdjan",
                    "Bahamas",
                    "Bahreïn",
                    "Bangladesh",
                    "Barbade",
                    "Biélorussie",
                    "Belgique",
                    "Belize",
                    "Bénin",
                    "Bermudes",
                    "Bhoutan",
                    "Bolivie",
                    "Bosnie-Herzégovine",
                    "Botswana",
                    "Île Bouvet",
                    "Brésil",
                    "British Virgin Islands",
                    "Territoire britannique de l’Océan Indien",
                    "Brunei Darussalam",
                    "Bulgarie",
                    "Burkina Faso",
                    "Burundi",
                    "Cambodge",
                    "Cameroun",
                    "Canada",
                    "Cap-Vert",
                    "Iles Cayman",
                    "République centrafricaine",
                    "Tchad",
                    "Chili",
                    "Chine",
                    "Hong Kong",
                    "Macao",
                    "Île Christmas",
                    "Îles Cocos",
                    "Colombie",
                    "Comores",
                    "République du Congo",
                    "République démocratique du Congo",
                    "Îles Cook",
                    "Costa Rica",
                    "Côte d’Ivoire",
                    "Croatie",
                    "Cuba",
                    "Chypre",
                    "République tchèque",
                    "Danemark",
                    "Djibouti",
                    "Dominique",
                    "République dominicaine",
                    "Équateur",
                    "Égypte",
                    "Salvador",
                    "Guinée équatoriale",
                    "Érythrée",
                    "Estonie",
                    "Éthiopie",
                    "Îles Falkland",
                    "Îles Féroé",
                    "Fidji",
                    "Finlande",
                    "France",
                    "Guyane française",
                    "Polynésie française",
                    "Terres australes et antarctiques françaises",
                    "Gabon",
                    "Gambie",
                    "Géorgie",
                    "Allemagne",
                    "Ghana",
                    "Gibraltar",
                    "Grèce",
                    "Groenland",
                    "Grenade",
                    "Guadeloupe",
                    "Guam",
                    "Guatemala",
                    "Guernesey",
                    "Guinée",
                    "Guinée-Bissau",
                    "Guyane",
                    "Haïti",
                    "Îles Heard-et-MacDonald",
                    "Saint-Siège (Vatican)",
                    "Honduras",
                    "Hongrie",
                    "Islande",
                    "Inde",
                    "Indonésie",
                    "Iran",
                    "Irak",
                    "Irlande",
                    "Ile de Man",
                    "Israël",
                    "Italie",
                    "Jamaïque",
                    "Japon",
                    "Jersey",
                    "Jordanie",
                    "Kazakhstan",
                    "Kenya",
                    "Kiribati",
                    "Corée du Nord",
                    "Corée du Sud",
                    "Koweït",
                    "Kirghizistan",
                    "Laos",
                    "Lettonie",
                    "Liban",
                    "Lesotho",
                    "Libéria",
                    "Libye",
                    "Liechtenstein",
                    "Lituanie",
                    "Luxembourg",
                    "Macédoine",
                    "Madagascar",
                    "Malawi",
                    "Malaisie",
                    "Maldives",
                    "Mali",
                    "Malte",
                    "Îles Marshall",
                    "Martinique",
                    "Mauritanie",
                    "Maurice",
                    "Mayotte",
                    "Mexique",
                    "Micronésie",
                    "Moldavie",
                    "Monaco",
                    "Mongolie",
                    "Monténégro",
                    "Montserrat",
                    "Maroc",
                    "Mozambique",
                    "Myanmar",
                    "Namibie",
                    "Nauru",
                    "Népal",
                    "Pays-Bas",
                    "Nouvelle-Calédonie",
                    "Nouvelle-Zélande",
                    "Nicaragua",
                    "Niger",
                    "Nigeria",
                    "Niue",
                    "Île Norfolk",
                    "Îles Mariannes du Nord",
                    "Norvège",
                    "Oman",
                    "Pakistan",
                    "Palau",
                    "Palestine",
                    "Panama",
                    "Papouasie-Nouvelle-Guinée",
                    "Paraguay",
                    "Pérou",
                    "Philippines",
                    "Pitcairn",
                    "Pologne",
                    "Portugal",
                    "Puerto Rico",
                    "Qatar",
                    "Réunion",
                    "Roumanie",
                    "Russie",
                    "Rwanda",
                    "Saint-Barthélemy",
                    "Sainte-Hélène",
                    "Saint-Kitts-et-Nevis",
                    "Sainte-Lucie",
                    "Saint-Martin (partie française)",
                    "Saint-Martin (partie néerlandaise)",
                    "Saint-Pierre-et-Miquelon",
                    "Saint-Vincent-et-les Grenadines",
                    "Samoa",
                    "Saint-Marin",
                    "Sao Tomé-et-Principe",
                    "Arabie Saoudite",
                    "Sénégal",
                    "Serbie",
                    "Seychelles",
                    "Sierra Leone",
                    "Singapour",
                    "Slovaquie",
                    "Slovénie",
                    "Îles Salomon",
                    "Somalie",
                    "Afrique du Sud",
                    "Géorgie du Sud et les îles Sandwich du Sud",
                    "Sud-Soudan",
                    "Espagne",
                    "Sri Lanka",
                    "Soudan",
                    "Suriname",
                    "Svalbard et Jan Mayen",
                    "Eswatini",
                    "Suède",
                    "Suisse",
                    "Syrie",
                    "Taiwan",
                    "Tadjikistan",
                    "Tanzanie",
                    "Thaïlande",
                    "Timor-Leste",
                    "Togo",
                    "Tokelau",
                    "Tonga",
                    "Trinité-et-Tobago",
                    "Tunisie",
                    "Turquie",
                    "Turkménistan",
                    "Îles Turques-et-Caïques",
                    "Tuvalu",
                    "Ouganda",
                    "Ukraine",
                    "Émirats Arabes Unis",
                    "Royaume-Uni",
                    "États-Unis",
                    "Îles mineures éloignées des États-Unis",
                    "Uruguay",
                    "Ouzbékistan",
                    "Vanuatu",
                    "Venezuela",
                    "Viêt Nam",
                    "Îles Vierges américaines",
                    "Wallis-et-Futuna",
                    "Sahara occidental",
                    "Yémen",
                    "Zambie",
                    "Zimbabwe"];

                $ISO3 = ["AFG",
                    "ALA",
                    "ALB",
                    "DZA",
                    "ASM",
                    "AND",
                    "AGO",
                    "AIA",
                    "ATA",
                    "ATG",
                    "ARG",
                    "ARM",
                    "ABW",
                    "AUS",
                    "AUT",
                    "AZE",
                    "BHS",
                    "BHR",
                    "BGD",
                    "BRB",
                    "BLR",
                    "BEL",
                    "BLZ",
                    "BEN",
                    "BMU",
                    "BTN",
                    "BOL",
                    "BIH",
                    "BWA",
                    "BVT",
                    "BRA",
                    "VGB",
                    "IOT",
                    "BRN",
                    "BGR",
                    "BFA",
                    "BDI",
                    "KHM",
                    "CMR",
                    "CAN",
                    "CPV",
                    "CYM",
                    "CAF",
                    "TCD",
                    "CHL",
                    "CHN",
                    "HKG",
                    "MAC",
                    "CXR",
                    "CCK",
                    "COL",
                    "COM",
                    "COG",
                    "COD",
                    "COK",
                    "CRI",
                    "CIV",
                    "HRV",
                    "CUB",
                    "CYP",
                    "CZE",
                    "DNK",
                    "DJI",
                    "DMA",
                    "DOM",
                    "ECU",
                    "EGY",
                    "SLV",
                    "GNQ",
                    "ERI",
                    "EST",
                    "ETH",
                    "FLK",
                    "FRO",
                    "FJI",
                    "FIN",
                    "FRA",
                    "GUF",
                    "PYF",
                    "ATF",
                    "GAB",
                    "GMB",
                    "GEO",
                    "DEU",
                    "GHA",
                    "GIB",
                    "GRC",
                    "GRL",
                    "GRD",
                    "GLP",
                    "GUM",
                    "GTM",
                    "GGY",
                    "GIN",
                    "GNB",
                    "GUY",
                    "HTI",
                    "HMD",
                    "VAT",
                    "HND",
                    "HUN",
                    "ISL",
                    "IND",
                    "IDN",
                    "IRN",
                    "IRQ",
                    "IRL",
                    "IMN",
                    "ISR",
                    "ITA",
                    "JAM",
                    "JPN",
                    "JEY",
                    "JOR",
                    "KAZ",
                    "KEN",
                    "KIR",
                    "PRK",
                    "KOR",
                    "KWT",
                    "KGZ",
                    "LAO",
                    "LVA",
                    "LBN",
                    "LSO",
                    "LBR",
                    "LBY",
                    "LIE",
                    "LTU",
                    "LUX",
                    "MKD",
                    "MDG",
                    "MWI",
                    "MYS",
                    "MDV",
                    "MLI",
                    "MLT",
                    "MHL",
                    "MTQ",
                    "MRT",
                    "MUS",
                    "MYT",
                    "MEX",
                    "FSM",
                    "MDA",
                    "MCO",
                    "MNG",
                    "MNE",
                    "MSR",
                    "MAR",
                    "MOZ",
                    "MMR",
                    "NAM",
                    "NRU",
                    "NPL",
                    "NLD",
                    "NCL",
                    "NZL",
                    "NIC",
                    "NER",
                    "NGA",
                    "NIU",
                    "NFK",
                    "MNP",
                    "NOR",
                    "OMN",
                    "PAK",
                    "PLW",
                    "PSE",
                    "PAN",
                    "PNG",
                    "PRY",
                    "PER",
                    "PHL",
                    "PCN",
                    "POL",
                    "PRT",
                    "PRI",
                    "QAT",
                    "REU",
                    "ROU",
                    "RUS",
                    "RWA",
                    "BLM",
                    "SHN",
                    "KNA",
                    "LCA",
                    "MAF",
                    "SXM",
                    "SPM",
                    "VCT",
                    "WSM",
                    "SMR",
                    "STP",
                    "SAU",
                    "SEN",
                    "SRB",
                    "SYC",
                    "SLE",
                    "SGP",
                    "SVK",
                    "SVN",
                    "SLB",
                    "SOM",
                    "ZAF",
                    "SGS",
                    "SSD",
                    "ESP",
                    "LKA",
                    "SDN",
                    "SUR",
                    "SJM",
                    "SWZ",
                    "SWE",
                    "CHE",
                    "SYR",
                    "TWN",
                    "TJK",
                    "TZA",
                    "THA",
                    "TLS",
                    "TGO",
                    "TKL",
                    "TON",
                    "TTO",
                    "TUN",
                    "TUR",
                    "TKM",
                    "TCA",
                    "TUV",
                    "UGA",
                    "UKR",
                    "ARE",
                    "GBR",
                    "USA",
                    "UMI",
                    "URY",
                    "UZB",
                    "VUT",
                    "VEN",
                    "VNM",
                    "VIR",
                    "WLF",
                    "ESH",
                    "YEM",
                    "ZMB",
                    "ZWE"];

                for ($i = 0; $i < count($pays); $i++) {
                    $wpdb->insert($wpdb->prefix . PROJETMR_BASENAME . '_pays', array(
                        'id' => $i+1,
                        'pays' => $pays[$i],
                        'ISO' => $ISO3[$i],
                        'etoiles' => 0,
                        'majeur' => true,
                        'actif' => true
                    ));
                }
            }
        }
    }

    public function isTableBaseAlreadyCreated($table) {

        global $wpdb;

        $sql = 'SHOW TABLES LIKE \'%'. $wpdb->prefix . PROJETMR_BASENAME . $table .'%\'';
        return $wpdb->get_var($sql);

    }

}

?>