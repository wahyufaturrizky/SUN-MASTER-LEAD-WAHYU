<?php

use Illuminate\Database\Seeder;

use App\Country;
use App\CountryLanguage;

class CountryLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            ["country_name" => "Afghanistan", "nationality" => "Afghan", "languages" => ["Dari (Persian) - Pashto","","",""]],
            ["country_name" => "Albania", "nationality" => "Albanian", "languages" => ["Albanian","","",""]],
            ["country_name" => "Algeria", "nationality" => "Algerian", "languages" => ["Arabic","","",""]],
            ["country_name" => "Argentina", "nationality" => "Argentine/Argentinian", "languages" => ["Spanish","","",""]],
            ["country_name" => "Australia", "nationality" => "Australian", "languages" => ["English","","",""]],
            ["country_name" => "Austria", "nationality" => "Austrian", "languages" => ["German","","",""]],
            ["country_name" => "Bangladesh", "nationality" => "Bangladeshi", "languages" => ["Bengali","","",""]],
            ["country_name" => "Belgium", "nationality" => "Belgian", "languages" => ["French","Flemish","",""]],
            ["country_name" => "Bolivia", "nationality" => "Bolivian", "languages" => ["Spanish","","",""]],
            ["country_name" => "Botswana", "nationality" => "Batswana", "languages" => ["English","Setswana","",""]],
            ["country_name" => "Brazil", "nationality" => "Brazilian", "languages" => ["Portuguese","","",""]],
            ["country_name" => "Bulgaria", "nationality" => "Bulgarian", "languages" => ["Bulgarian","","",""]],
            ["country_name" => "Cambodia", "nationality" => "Cambodian", "languages" => ["Cambodian","","",""]],
            ["country_name" => "Cameroon", "nationality" => "Cameroonian", "languages" => ["French","English","",""]],
            ["country_name" => "Canada", "nationality" => "Canadian", "languages" => ["English","French","",""]],
            ["country_name" => "Chile", "nationality" => "Chilean", "languages" => ["Spanish","","",""]],
            ["country_name" => "China", "nationality" => "Chinese", "languages" => ["Chinese","","",""]],
            ["country_name" => "Colombia", "nationality" => "Colombian", "languages" => ["Spanish","","",""]],
            ["country_name" => "Costa Rica", "nationality" => "Costa Rican", "languages" => ["Spanish","","",""]],
            ["country_name" => "Croatia", "nationality" => "Croatian", "languages" => ["Croatian","","",""]],
            ["country_name" => "Cuba", "nationality" => "Cuban", "languages" => ["Spanish","","",""]],
            ["country_name" => "Czech Republic", "nationality" => "Czech", "languages" => ["Czech","","",""]],
            ["country_name" => "Denmark", "nationality" => "Danish", "languages" => ["Danish","","",""]],
            ["country_name" => "Dominican Republic", "nationality" => "Dominican", "languages" => ["Spanish","","",""]],
            ["country_name" => "Ecuador", "nationality" => "Ecuadorian", "languages" => ["Spanish","","",""]],
            ["country_name" => "Egypt", "nationality" => "Egyptian", "languages" => ["Arabic","","",""]],
            ["country_name" => "El Salvador", "nationality" => "Salvadorian", "languages" => ["Spanish","","",""]],
            // ["country_name" => "England", "nationality" => "English", "languages" => ["English","","",""]],
            ["country_name" => "Estonia", "nationality" => "Estonian", "languages" => ["Estonian","","",""]],
            ["country_name" => "Ethiopia", "nationality" => "Ethiopian", "languages" => ["Amharic","","",""]],
            ["country_name" => "Fiji", "nationality" => "Fijian", "languages" => ["English","Fijian","",""]],
            ["country_name" => "Finland", "nationality" => "Finnish", "languages" => ["Finnish","","",""]],
            ["country_name" => "France", "nationality" => "French", "languages" => ["French","","",""]],
            ["country_name" => "Germany", "nationality" => "German", "languages" => ["German","","",""]],
            ["country_name" => "Ghana", "nationality" => "Ghanaian", "languages" => ["English","","",""]],
            ["country_name" => "Greece", "nationality" => "Greek", "languages" => ["Greek","","",""]],
            ["country_name" => "Guatemala", "nationality" => "Guatemalan", "languages" => ["Spanish","","",""]],
            ["country_name" => "Haiti", "nationality" => "Haitian", "languages" => ["French","Creole","",""]],
            ["country_name" => "Honduras", "nationality" => "Honduran", "languages" => ["Spanish","","",""]],
            ["country_name" => "Hungary", "nationality" => "Hungarian", "languages" => ["Hungarian","","",""]],
            ["country_name" => "Iceland", "nationality" => "Icelandic", "languages" => ["Icelandic","","",""]],
            ["country_name" => "India", "nationality" => "Indian", "languages" => ["Hindi","English","",""]],
            ["country_name" => "Indonesia", "nationality" => "Indonesian", "languages" => ["Indonesian","","",""]],
            ["country_name" => "Iran", "nationality" => "Iranian", "languages" => ["Persian","","",""]],
            ["country_name" => "Iraq", "nationality" => "Iraqi", "languages" => ["Arabic","Kurdish","",""]],
            ["country_name" => "Ireland", "nationality" => "Irish", "languages" => ["Irish","English","",""]],
            ["country_name" => "Israel", "nationality" => "Israeli", "languages" => ["Hebrew","","",""]],
            ["country_name" => "Italy", "nationality" => "Italian", "languages" => ["Italian","","",""]],
            ["country_name" => "Jamaica", "nationality" => "Jamaican", "languages" => ["English","","",""]],
            ["country_name" => "Japan", "nationality" => "Japanese", "languages" => ["Japanese","","",""]],
            ["country_name" => "Jordan", "nationality" => "Jordanian", "languages" => ["Arabic","","",""]],
            ["country_name" => "Kenya", "nationality" => "Kenyan", "languages" => ["Swahili","","",""]],
            ["country_name" => "Kuwait", "nationality" => "Kuwaiti", "languages" => ["Arabiv","","",""]],
            ["country_name" => "Lao Peoples Democratic Republic", "nationality" => "Lao", "languages" => ["Laotian","","",""]],
            ["country_name" => "Latvia", "nationality" => "Latvian", "languages" => ["Latvian","","",""]],
            ["country_name" => "Lebanon", "nationality" => "Lebanese", "languages" => ["Arabic","","",""]],
            ["country_name" => "Libya", "nationality" => "Libyan", "languages" => ["Arabic","","",""]],
            ["country_name" => "Lithuania", "nationality" => "Lithuanian", "languages" => ["Lithuanian","","",""]],
            ["country_name" => "Malaysia", "nationality" => "Malaysian", "languages" => ["Malay","Malaysian","",""]],
            ["country_name" => "Mali", "nationality" => "Malian", "languages" => ["French","","",""]],
            ["country_name" => "Malta", "nationality" => "Maltese", "languages" => ["English","Maltese","",""]],
            ["country_name" => "Mexico", "nationality" => "Mexican", "languages" => ["Spanish","","",""]],
            ["country_name" => "Mongolia", "nationality" => "Mongolian", "languages" => ["Mongolian","","",""]],
            ["country_name" => "Morocco", "nationality" => "Moroccan", "languages" => ["Arabic","French","",""]],
            ["country_name" => "Mozambique", "nationality" => "Mozambican", "languages" => ["Portuguese","","",""]],
            ["country_name" => "Namibia", "nationality" => "Namibian", "languages" => ["English","","",""]],
            ["country_name" => "Nepal", "nationality" => "Nepalese", "languages" => ["Nepali","English","",""]],
            ["country_name" => "Netherlands", "nationality" => "Dutch", "languages" => ["Dutch","","",""]],
            ["country_name" => "New Zealand", "nationality" => "New Zealand", "languages" => ["English","Maori","",""]],
            ["country_name" => "Nicaragua", "nationality" => "Nicaraguan", "languages" => ["Spanish","","",""]],
            ["country_name" => "Nigeria", "nationality" => "Nigerian", "languages" => ["English","","",""]],
            ["country_name" => "Norway", "nationality" => "Norwegian", "languages" => ["Norwegian","","",""]],
            ["country_name" => "Pakistan", "nationality" => "Pakistani", "languages" => ["Urdu","English","",""]],
            ["country_name" => "Panama", "nationality" => "Panamanian", "languages" => ["Spanish","","",""]],
            ["country_name" => "Paraguay", "nationality" => "Paraguayan", "languages" => ["Spanish","","",""]],
            ["country_name" => "Peru", "nationality" => "Peruvian", "languages" => ["Spanish","","",""]],
            ["country_name" => "Philippines", "nationality" => "Philippine", "languages" => ["Tagalog","Filipino","",""]],
            ["country_name" => "Poland", "nationality" => "Polish", "languages" => ["Polish","","",""]],
            ["country_name" => "Portugal", "nationality" => "Portuguese", "languages" => ["Portuguese","","",""]],
            ["country_name" => "Romania", "nationality" => "Romanian", "languages" => ["Romanian","","",""]],
            ["country_name" => "Russia", "nationality" => "Russian", "languages" => ["Russian","","",""]],
            ["country_name" => "Saudi Arabia", "nationality" => "Saudi", "languages" => ["Arabic","","",""]],
            // ["country_name" => "Scotland", "nationality" => "Scottish", "languages" => ["English","","",""]],
            ["country_name" => "Senegal", "nationality" => "Senegalese", "languages" => ["French","","",""]],
            ["country_name" => "Serbia", "nationality" => "Serbian", "languages" => ["Serbian","","",""]],
            ["country_name" => "Singapore", "nationality" => "Singaporean", "languages" => ["English","Malay","Mandarin","Tamil"]],
            ["country_name" => "Slovakia", "nationality" => "Slovak", "languages" => ["Slovak","","",""]],
            ["country_name" => "South Africa", "nationality" => "South African", "languages" => ["Afrikaans","English","",""]],
            // ["country_name" => "South Korea", "nationality" => "Korean", "languages" => ["Korean","","",""]],
            ["country_name" => "Korea, Republic of", "nationality" => "Korean", "languages" => ["Korean","","",""]],
            ["country_name" => "Spain", "nationality" => "Spanish", "languages" => ["Spanish","","",""]],
            ["country_name" => "Sri Lanka", "nationality" => "Sri Lankan", "languages" => ["Sinhala","Tamil","",""]],
            ["country_name" => "Sudan", "nationality" => "Sudanese", "languages" => ["Arabic","English","",""]],
            ["country_name" => "Sweden", "nationality" => "Swedish", "languages" => ["Swedish","","",""]],
            ["country_name" => "Switzerland", "nationality" => "Swiss", "languages" => ["German","French","Italian","Romansh"]],
            ["country_name" => "Syria", "nationality" => "Syrian", "languages" => ["Arabic","","",""]],
            ["country_name" => "Taiwan", "nationality" => "Taiwanese", "languages" => ["Chinese","","",""]],
            ["country_name" => "Tajikistan", "nationality" => "Tajikistani", "languages" => ["Tajik (Persian)","","",""]],
            ["country_name" => "Thailand", "nationality" => "Thai", "languages" => ["Thai","","",""]],
            ["country_name" => "Tonga", "nationality" => "Tongan", "languages" => ["English","Tongan","",""]],
            ["country_name" => "Tunisia", "nationality" => "Tunisian", "languages" => ["Arabic","","",""]],
            ["country_name" => "Turkey", "nationality" => "Turkish", "languages" => ["Turkish","","",""]],
            ["country_name" => "Ukraine", "nationality" => "Ukrainian", "languages" => ["Ukrainian","","",""]],
            ["country_name" => "United Arab Emirates", "nationality" => "Emirati", "languages" => ["Arabic","","",""]],
            ["country_name" => "United Kingdom", "nationality" => "British", "languages" => ["English","","",""]],
            ["country_name" => "United States", "nationality" => "American **", "languages" => ["English","","",""]],
            ["country_name" => "Uruguay", "nationality" => "Uruguayan", "languages" => ["Spanish","","",""]],
            ["country_name" => "Venezuela", "nationality" => "Venezuelan", "languages" => ["Spanish","","",""]],
            ["country_name" => "Viet Nam", "nationality" => "Vietnamese", "languages" => ["Vietnamese","","",""]],
            // ["country_name" => "Wales", "nationality" => "Welsh", "languages" => ["Welsh","English","",""]],
            ["country_name" => "Zambia", "nationality" => "Zambian", "languages" => ["English","","",""]],
            ["country_name" => "Zimbabwe", "nationality" => "Zimbabwean", "languages" => ["English","Shona","Ndebele",""]],
        ];
        // $countries = Country::all();
        foreach($languages as $language){
            $country = Country::where('country_name','LIKE', '%' . $language['country_name'] . '%')->first();
            if(is_null($country)){
                echo 'Country Name: ' . $language['country_name'] . ' not found' . "\n";
            } else {
                $country->nationality = $language['nationality'];
                $country->save();
                foreach($language['languages'] as $lang){
                    if(!empty($lang)){
                        // Check Duplicate Data
                        $countryLanguage = CountryLanguage::where('country_id', $country->country_id)->where('country_language_name', $lang)->first();
                        if(is_null($countryLanguage)){
                            $countryLanguage = new CountryLanguage();
                            $countryLanguage->country_id = $country->country_id;
                            $countryLanguage->country_language_name = $lang;
                            $countryLanguage->save();
                        }
                    }
                }
            }
        }
    }
}
