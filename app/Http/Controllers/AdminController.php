<?php

namespace App\Http\Controllers;

use App\Charts\AgesChart;
use App\Charts\CountriesChart;
use App\Charts\GendersChart;
use App\Charts\HadMadeOnlinePurchaseChart;
use App\Charts\MarketingStrategyChart;
use App\SurveyResult;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function results()
    {
        return view('results', [
            'gendersChart' => $this->getGendersChart(),
            'agesChart' => $this->getAgesChart(),
            'countriesChart' => $this->getCountriesChart(),
            'hadMadeOnlinePurchaseChart' => $this->getHadMadeOnlinePurchaseChart(),
            'marketingStrategyChart' => $this->getMarketingStrategyChart(),
            'marketsChart' => $this->getMarketsChart(),
            'bestProductsChart' => $this->getBestProductsChart(),
            'averageBudgetsChart' => $this->getAverageBudgetsChart(),
            'bestProductAspectsChart' => $this->getBestProductAspectsChart(),
            'wantCustomProductsChart' => $this->getWantCustomProductsChart(),
        ]);
    }

    private function getWantCustomProductsChart()
    {
        $yes = SurveyResult::getWantCustomProduct('question9', 'item1');
        $no = SurveyResult::getWantCustomProduct('question9', 'item2');

        $wantCustomProductsChart = new MarketingStrategyChart();
        $wantCustomProductsChart->displayAxes(false);
        $wantCustomProductsChart->title("Would you like to be able to make custom craft products ?");
        $wantCustomProductsChart->labels(["Yes", "No"]);
        $customProductsDataset = $wantCustomProductsChart->dataset('Want custom product', 'pie', [
            $yes, $no
        ]);
        $customProductsDataset->backgroundColor(collect(['#3ae374', '#ff3838']));
        $customProductsDataset->color(collect(['#32ff7e', '#ff4d4d']));

        return $wantCustomProductsChart;
    }

    private function getBestProductAspectsChart()
    {
        $quality = SurveyResult::getBestProductAspects('question8', 'item1');
        $origin = SurveyResult::getBestProductAspects('question8', 'item2');
        $price = SurveyResult::getBestProductAspects('question8', 'item3');
        $originality = SurveyResult::getBestProductAspects('question8', 'item4');
        $authenticity = SurveyResult::getBestProductAspects('question8', 'item5');
        $uniqueness = SurveyResult::getBestProductAspects('question8', 'item6');
        $others = SurveyResult::getBestProductAspects('question8', 'item7');

        $averageBudgetsChart = new MarketingStrategyChart();
        $averageBudgetsChart->title("For the purchase of handicrafts, what criteria do you think are most important ?");
        $averageBudgetsChart->labels(["Quality", "Origin", "Price", "Originality", "Authenticity", "Uniqueness", "Others"]);
        $averageBudgetsChart->dataset('Best Product Aspects', 'bar', [
            $quality, $origin, $price, $originality, $authenticity, $uniqueness, $others
        ]);

        return $averageBudgetsChart;
    }

    private function getAverageBudgetsChart()
    {
        $th200 = SurveyResult::getAverageBudgets('question7', 'item1');
        $btw200And300 = SurveyResult::getAverageBudgets('question7', 'item2');
        $btw300And400 = SurveyResult::getAverageBudgets('question7', 'item3');
        $btw400And500 = SurveyResult::getAverageBudgets('question7', 'item4');
        $gt500 = SurveyResult::getAverageBudgets('question7', 'item5');

        $averageBudgetsChart = new MarketingStrategyChart();
        $averageBudgetsChart->title("What is the average annual budget you spend on furniture or craft items?");
        $averageBudgetsChart->labels(["Less than $200", "From 200$ to 300$", "From 300$ to 400$", "From 400$ to 500$", "More than 500$"]);
        $averageBudgetsChart->dataset('Average budgets', 'bar', [
            $th200, $btw200And300, $btw300And400, $btw400And500, $gt500
        ]);

        return $averageBudgetsChart;
    }

    private function getBestProductsChart()
    {
        $decoration = SurveyResult::getBestProducts('question6', 'item1');
        $furniture = SurveyResult::getBestProducts('question6', 'item2');
        $art = SurveyResult::getBestProducts('question6', 'item3');
        $none = SurveyResult::getBestProducts('question6', 'item5');

        $bestProductsChart = new MarketingStrategyChart();
        $bestProductsChart->title("Best Products");
        $bestProductsChart->labels(["Decoration", "Furniture", "Art", "None of the above"]);
        $bestProductsChart->dataset('Best Products', 'bar', [
            $decoration, $furniture, $art, $none
        ]);

        return $bestProductsChart;
    }

    private function getMarketsChart()
    {
        $supermarkets = SurveyResult::getMarkets('question5', 'item1');
        $specializedShops = SurveyResult::getMarkets('question5', 'item2');
        $traditionalMarkets = SurveyResult::getMarkets('question5', 'item3');
        $mailOrderSelling = SurveyResult::getMarkets('question5', 'item4');
        $internetShops = SurveyResult::getMarkets('question5', 'item5');
        $others = SurveyResult::getMarkets('question5', 'item6');

        $marketsChart = new MarketingStrategyChart();
        $marketsChart->title("Markets");
        $marketsChart->labels(["Supermarkets", "Specialized shop", "Traditional market", "Mail-order selling", "Internet", "Other"]);
        $marketsChart->dataset('Markets', 'bar', [
            $supermarkets, $specializedShops, $traditionalMarkets, $mailOrderSelling, $internetShops, $others
        ]);

        return $marketsChart;
    }

    private function getMarketingStrategyChart()
    {
        $searchEngines = SurveyResult::getMarketingStrategy('question3', 'item1');
        $internetAds = SurveyResult::getMarketingStrategy('question3', 'item2');
        $referrers = SurveyResult::getMarketingStrategy('question3', 'item3');
        $byChance = SurveyResult::getMarketingStrategy('question3', 'item4');
        $wordOfMouth = SurveyResult::getMarketingStrategy('question3', 'item5');
        $traditionalAds = SurveyResult::getMarketingStrategy('question3', 'item6');
        $others = SurveyResult::getMarketingStrategy('question3', 'item7');

        $marketingStrategyChart = new MarketingStrategyChart();
        $marketingStrategyChart->title("Marketing Strategies");
        $marketingStrategyChart->labels(["Search engines", "Internet advertising", "Link from another website", "By chance while surfing", "Word-of-mouth", "Traditional advertising", "Other"]);
        $marketingStrategyChart->dataset('Marketing Strategy', 'bar', [
            $searchEngines, $internetAds, $referrers, $byChance, $wordOfMouth, $traditionalAds, $others
        ]);

        return $marketingStrategyChart;
    }

    private function getHadMadeOnlinePurchaseChart()
    {
        $hadMadeOnlinePurchase = SurveyResult::getHasMadeOnlinePurchase("question2", "item1");
        $hadNotMadeOnlinePurchase = SurveyResult::getHasMadeOnlinePurchase("question2", "item2");

        $hadMadeOnlinePurchaseChart = new HadMadeOnlinePurchaseChart();
        $hadMadeOnlinePurchaseChart->displayAxes(false);
        $hadMadeOnlinePurchaseChart->title("Have you ever made an online purchase?");
        $hadMadeOnlinePurchaseChart->labels(['Yes', 'No']);
        $purchaseDataset = $hadMadeOnlinePurchaseChart->dataset(
            "Had Made Online Purchase",
            "pie",
            [$hadMadeOnlinePurchase, $hadNotMadeOnlinePurchase]);
        $purchaseDataset->backgroundColor(collect(['#3ae374', '#ff3838']));
        $purchaseDataset->color(collect(['#32ff7e', '#ff4d4d']));

        return $hadMadeOnlinePurchaseChart;
    }

    private function getCountriesChart()
    {
        $labels = [];
        $countriesDataset = [];
        $countries = SurveyResult::getCountriesCount("question1");
        foreach ($countries as $country) {
            $labels[] = Str::substr($country->country, 1, strlen($country->country) - 2);
            $countriesDataset[] = $country->cnt;
        }
        $labels = collect($labels)->map(function ($country) {
            return $this->mapCountry($country);
        });
        $countriesChart = new CountriesChart();
        $countriesChart->title("Where are you from?");
        $countriesChart->labels($labels);
        $countriesChart->dataset('Countries', 'bar', $countriesDataset);

        return $countriesChart;
    }

    private function getAgesChart()
    {
        $lt17 = SurveyResult::getAgesCount('question13', 'item1');
        $between18And20 = SurveyResult::getAgesCount('question13', 'item2');
        $between21And29 = SurveyResult::getAgesCount('question13', 'item3');
        $between30And39 = SurveyResult::getAgesCount('question13', 'item4');
        $between40And49 = SurveyResult::getAgesCount('question13', 'item5');
        $between50And59 = SurveyResult::getAgesCount('question13', 'item6');
        $gt60 = SurveyResult::getAgesCount('question13', 'item7');

        $agesChart = new AgesChart();
        $agesChart->title("Age intervals");
        $agesChart->labels(["<18", "18-20", "21-29", "30-39", "40-49", "50-59", ">=60"]);
        $agesChart->dataset('Age Intervals', 'bar', [
            $lt17, $between18And20, $between21And29, $between30And39, $between40And49, $between50And59, $gt60
        ]);

        return $agesChart;
    }

    private function getGendersChart()
    {
        $femalesCount = SurveyResult::getGendersCount("question12", "item1");
        $malesCount = SurveyResult::getGendersCount("question12", "item2");
        $othersCount = SurveyResult::getGendersCount("question12", "item3");

        $gendersChart = new GendersChart();
        $gendersChart->displayAxes(false);
        $gendersChart->title("Gender");
        $gendersChart->labels(["Female", "Male", "Other"]);
        $dataset = $gendersChart->dataset('data', 'pie', [$femalesCount, $malesCount, $othersCount]);
        $dataset->backgroundColor(collect(['#7158e2', '#3ae374', '#ff3838']));
        $dataset->color(collect(['#7d5fff', '#32ff7e', '#ff4d4d']));

        return $gendersChart;
    }

    private function mapCountry(string $country)
    {
        $countries = array(
            0 =>
                array(
                    'text' => 'Afghanistan',
                    'value' => 'item1',
                ),
            1 =>
                array(
                    'text' => 'Albania',
                    'value' => 'item3',
                ),
            2 =>
                array(
                    'text' => 'Algeria',
                    'value' => 'item46',
                ),
            3 =>
                array(
                    'text' => 'Angola',
                    'value' => 'item2',
                ),
            4 =>
                array(
                    'text' => 'Antarctica',
                    'value' => 'item7',
                ),
            5 =>
                array(
                    'text' => 'Argentina',
                    'value' => 'item5',
                ),
            6 =>
                array(
                    'text' => 'Armenia',
                    'value' => 'item6',
                ),
            7 =>
                array(
                    'text' => 'Australia',
                    'value' => 'item9',
                ),
            8 =>
                array(
                    'text' => 'Austria',
                    'value' => 'item10',
                ),
            9 =>
                array(
                    'text' => 'Azerbaijan',
                    'value' => 'item11',
                ),
            10 =>
                array(
                    'text' => 'Bangladesh',
                    'value' => 'item16',
                ),
            11 =>
                array(
                    'text' => 'Belarus',
                    'value' => 'item20',
                ),
            12 =>
                array(
                    'text' => 'Belgium',
                    'value' => 'item13',
                ),
            13 =>
                array(
                    'text' => 'Belize',
                    'value' => 'item21',
                ),
            14 =>
                array(
                    'text' => 'Benin',
                    'value' => 'item14',
                ),
            15 =>
                array(
                    'text' => 'Bhutan',
                    'value' => 'item25',
                ),
            16 =>
                array(
                    'text' => 'Bolivia',
                    'value' => 'item22',
                ),
            17 =>
                array(
                    'text' => 'Bosnia and Herzegovina',
                    'value' => 'item19',
                ),
            18 =>
                array(
                    'text' => 'Botswana',
                    'value' => 'item26',
                ),
            19 =>
                array(
                    'text' => 'Brazil',
                    'value' => 'item23',
                ),
            20 =>
                array(
                    'text' => 'Brunei',
                    'value' => 'item24',
                ),
            21 =>
                array(
                    'text' => 'Bulgaria',
                    'value' => 'item17',
                ),
            22 =>
                array(
                    'text' => 'Burkina Faso',
                    'value' => 'item15',
                ),
            23 =>
                array(
                    'text' => 'Burundi',
                    'value' => 'item12',
                ),
            24 =>
                array(
                    'text' => 'Cambodia',
                    'value' => 'item87',
                ),
            25 =>
                array(
                    'text' => 'Cameroon',
                    'value' => 'item33',
                ),
            26 =>
                array(
                    'text' => 'Canada',
                    'value' => 'item28',
                ),
            27 =>
                array(
                    'text' => 'Central African Republic',
                    'value' => 'item27',
                ),
            28 =>
                array(
                    'text' => 'Chad',
                    'value' => 'item154',
                ),
            29 =>
                array(
                    'text' => 'Chile',
                    'value' => 'item30',
                ),
            30 =>
                array(
                    'text' => 'China',
                    'value' => 'item31',
                ),
            31 =>
                array(
                    'text' => 'Colombia',
                    'value' => 'item36',
                ),
            32 =>
                array(
                    'text' => 'Costa Rica',
                    'value' => 'item37',
                ),
            33 =>
                array(
                    'text' => 'Croatia',
                    'value' => 'item70',
                ),
            34 =>
                array(
                    'text' => 'Cuba',
                    'value' => 'item38',
                ),
            35 =>
                array(
                    'text' => 'Cyprus',
                    'value' => 'item40',
                ),
            36 =>
                array(
                    'text' => 'Czech Republic',
                    'value' => 'item41',
                ),
            37 =>
                array(
                    'text' => 'Democratic Republic of the Congo',
                    'value' => 'item34',
                ),
            38 =>
                array(
                    'text' => 'Denmark',
                    'value' => 'item44',
                ),
            39 =>
                array(
                    'text' => 'Djibouti',
                    'value' => 'item43',
                ),
            40 =>
                array(
                    'text' => 'Dominican Republic',
                    'value' => 'item45',
                ),
            41 =>
                array(
                    'text' => 'East Timor',
                    'value' => 'item159',
                ),
            42 =>
                array(
                    'text' => 'Ecuador',
                    'value' => 'item47',
                ),
            43 =>
                array(
                    'text' => 'Egypt',
                    'value' => 'item48',
                ),
            44 =>
                array(
                    'text' => 'El Salvador',
                    'value' => 'item144',
                ),
            45 =>
                array(
                    'text' => 'Equatorial Guinea',
                    'value' => 'item64',
                ),
            46 =>
                array(
                    'text' => 'Eritrea',
                    'value' => 'item49',
                ),
            47 =>
                array(
                    'text' => 'Estonia',
                    'value' => 'item51',
                ),
            48 =>
                array(
                    'text' => 'Ethiopia',
                    'value' => 'item52',
                ),
            49 =>
                array(
                    'text' => 'Falkland Islands',
                    'value' => 'item55',
                ),
            50 =>
                array(
                    'text' => 'Fiji',
                    'value' => 'item54',
                ),
            51 =>
                array(
                    'text' => 'Finland',
                    'value' => 'item53',
                ),
            52 =>
                array(
                    'text' => 'France',
                    'value' => 'item56',
                ),
            53 =>
                array(
                    'text' => 'French Southern and Antarctic Lands',
                    'value' => 'item8',
                ),
            54 =>
                array(
                    'text' => 'Gabon',
                    'value' => 'item57',
                ),
            55 =>
                array(
                    'text' => 'Gambia',
                    'value' => 'item62',
                ),
            56 =>
                array(
                    'text' => 'Georgia',
                    'value' => 'item59',
                ),
            57 =>
                array(
                    'text' => 'Germany',
                    'value' => 'item42',
                ),
            58 =>
                array(
                    'text' => 'Ghana',
                    'value' => 'item60',
                ),
            59 =>
                array(
                    'text' => 'Greece',
                    'value' => 'item65',
                ),
            60 =>
                array(
                    'text' => 'Greenland',
                    'value' => 'item66',
                ),
            61 =>
                array(
                    'text' => 'Guatemala',
                    'value' => 'item67',
                ),
            62 =>
                array(
                    'text' => 'Guinea',
                    'value' => 'item61',
                ),
            63 =>
                array(
                    'text' => 'Guinea Bissau',
                    'value' => 'item63',
                ),
            64 =>
                array(
                    'text' => 'Guyana',
                    'value' => 'item68',
                ),
            65 =>
                array(
                    'text' => 'Haiti',
                    'value' => 'item71',
                ),
            66 =>
                array(
                    'text' => 'Honduras',
                    'value' => 'item69',
                ),
            67 =>
                array(
                    'text' => 'Hungary',
                    'value' => 'item72',
                ),
            68 =>
                array(
                    'text' => 'Iceland',
                    'value' => 'item78',
                ),
            69 =>
                array(
                    'text' => 'India',
                    'value' => 'item74',
                ),
            70 =>
                array(
                    'text' => 'Indonesia',
                    'value' => 'item73',
                ),
            71 =>
                array(
                    'text' => 'Iran',
                    'value' => 'item76',
                ),
            72 =>
                array(
                    'text' => 'Iraq',
                    'value' => 'item77',
                ),
            73 =>
                array(
                    'text' => 'Ireland',
                    'value' => 'item75',
                ),
            74 =>
                array(
                    'text' => 'Israel',
                    'value' => 'item79',
                ),
            75 =>
                array(
                    'text' => 'Italy',
                    'value' => 'item80',
                ),
            76 =>
                array(
                    'text' => 'Ivory Coast',
                    'value' => 'item32',
                ),
            77 =>
                array(
                    'text' => 'Jamaica',
                    'value' => 'item81',
                ),
            78 =>
                array(
                    'text' => 'Japan',
                    'value' => 'item83',
                ),
            79 =>
                array(
                    'text' => 'Jordan',
                    'value' => 'item82',
                ),
            80 =>
                array(
                    'text' => 'Kazakhstan',
                    'value' => 'item84',
                ),
            81 =>
                array(
                    'text' => 'Kenya',
                    'value' => 'item85',
                ),
            82 =>
                array(
                    'text' => 'Kosovo',
                    'value' => 'item89',
                ),
            83 =>
                array(
                    'text' => 'Kuwait',
                    'value' => 'item90',
                ),
            84 =>
                array(
                    'text' => 'Kyrgyzstan',
                    'value' => 'item86',
                ),
            85 =>
                array(
                    'text' => 'Laos',
                    'value' => 'item91',
                ),
            86 =>
                array(
                    'text' => 'Latvia',
                    'value' => 'item99',
                ),
            87 =>
                array(
                    'text' => 'Lebanon',
                    'value' => 'item92',
                ),
            88 =>
                array(
                    'text' => 'Lesotho',
                    'value' => 'item96',
                ),
            89 =>
                array(
                    'text' => 'Liberia',
                    'value' => 'item93',
                ),
            90 =>
                array(
                    'text' => 'Libya',
                    'value' => 'item94',
                ),
            91 =>
                array(
                    'text' => 'Lithuania',
                    'value' => 'item97',
                ),
            92 =>
                array(
                    'text' => 'Luxembourg',
                    'value' => 'item98',
                ),
            93 =>
                array(
                    'text' => 'Macedonia',
                    'value' => 'item104',
                ),
            94 =>
                array(
                    'text' => 'Madagascar',
                    'value' => 'item102',
                ),
            95 =>
                array(
                    'text' => 'Malawi',
                    'value' => 'item111',
                ),
            96 =>
                array(
                    'text' => 'Malaysia',
                    'value' => 'item112',
                ),
            97 =>
                array(
                    'text' => 'Mali',
                    'value' => 'item105',
                ),
            98 =>
                array(
                    'text' => 'Mauritania',
                    'value' => 'item110',
                ),
            99 =>
                array(
                    'text' => 'Mexico',
                    'value' => 'item103',
                ),
            100 =>
                array(
                    'text' => 'Moldova',
                    'value' => 'item101',
                ),
            101 =>
                array(
                    'text' => 'Mongolia',
                    'value' => 'item108',
                ),
            102 =>
                array(
                    'text' => 'Montenegro',
                    'value' => 'item107',
                ),
            103 =>
                array(
                    'text' => 'Morocco',
                    'value' => 'item100',
                ),
            104 =>
                array(
                    'text' => 'Mozambique',
                    'value' => 'item109',
                ),
            105 =>
                array(
                    'text' => 'Myanmar',
                    'value' => 'item106',
                ),
            106 =>
                array(
                    'text' => 'Namibia',
                    'value' => 'item113',
                ),
            107 =>
                array(
                    'text' => 'Nepal',
                    'value' => 'item120',
                ),
            108 =>
                array(
                    'text' => 'Netherlands',
                    'value' => 'item118',
                ),
            109 =>
                array(
                    'text' => 'New Caledonia',
                    'value' => 'item114',
                ),
            110 =>
                array(
                    'text' => 'New Zealand',
                    'value' => 'item121',
                ),
            111 =>
                array(
                    'text' => 'Nicaragua',
                    'value' => 'item117',
                ),
            112 =>
                array(
                    'text' => 'Niger',
                    'value' => 'item115',
                ),
            113 =>
                array(
                    'text' => 'Nigeria',
                    'value' => 'item116',
                ),
            114 =>
                array(
                    'text' => 'North Korea',
                    'value' => 'item130',
                ),
            115 =>
                array(
                    'text' => 'Northern Cyprus',
                    'value' => 'item39',
                ),
            116 =>
                array(
                    'text' => 'Norway',
                    'value' => 'item119',
                ),
            117 =>
                array(
                    'text' => 'Oman',
                    'value' => 'item122',
                ),
            118 =>
                array(
                    'text' => 'Pakistan',
                    'value' => 'item123',
                ),
            119 =>
                array(
                    'text' => 'Panama',
                    'value' => 'item124',
                ),
            120 =>
                array(
                    'text' => 'Papua New Guinea',
                    'value' => 'item127',
                ),
            121 =>
                array(
                    'text' => 'Paraguay',
                    'value' => 'item132',
                ),
            122 =>
                array(
                    'text' => 'Peru',
                    'value' => 'item125',
                ),
            123 =>
                array(
                    'text' => 'Philippines',
                    'value' => 'item126',
                ),
            124 =>
                array(
                    'text' => 'Poland',
                    'value' => 'item128',
                ),
            125 =>
                array(
                    'text' => 'Portugal',
                    'value' => 'item131',
                ),
            126 =>
                array(
                    'text' => 'Puerto Rico',
                    'value' => 'item129',
                ),
            127 =>
                array(
                    'text' => 'Qatar',
                    'value' => 'item133',
                ),
            128 =>
                array(
                    'text' => 'Republic of Serbia',
                    'value' => 'item147',
                ),
            129 =>
                array(
                    'text' => 'Republic of the Congo',
                    'value' => 'item35',
                ),
            130 =>
                array(
                    'text' => 'Romania',
                    'value' => 'item134',
                ),
            131 =>
                array(
                    'text' => 'Russia',
                    'value' => 'item135',
                ),
            132 =>
                array(
                    'text' => 'Rwanda',
                    'value' => 'item136',
                ),
            133 =>
                array(
                    'text' => 'Saudi Arabia',
                    'value' => 'item138',
                ),
            134 =>
                array(
                    'text' => 'Senegal',
                    'value' => 'item141',
                ),
            135 =>
                array(
                    'text' => 'Sierra Leone',
                    'value' => 'item143',
                ),
            136 =>
                array(
                    'text' => 'Slovakia',
                    'value' => 'item149',
                ),
            137 =>
                array(
                    'text' => 'Slovenia',
                    'value' => 'item150',
                ),
            138 =>
                array(
                    'text' => 'Solomon Islands',
                    'value' => 'item142',
                ),
            139 =>
                array(
                    'text' => 'Somalia',
                    'value' => 'item146',
                ),
            140 =>
                array(
                    'text' => 'Somaliland',
                    'value' => 'item145',
                ),
            141 =>
                array(
                    'text' => 'South Africa',
                    'value' => 'item175',
                ),
            142 =>
                array(
                    'text' => 'South Korea',
                    'value' => 'item88',
                ),
            143 =>
                array(
                    'text' => 'South Sudan',
                    'value' => 'item140',
                ),
            144 =>
                array(
                    'text' => 'Spain',
                    'value' => 'item50',
                ),
            145 =>
                array(
                    'text' => 'Sri Lanka',
                    'value' => 'item95',
                ),
            146 =>
                array(
                    'text' => 'Sudan',
                    'value' => 'item139',
                ),
            147 =>
                array(
                    'text' => 'Suriname',
                    'value' => 'item148',
                ),
            148 =>
                array(
                    'text' => 'Swaziland',
                    'value' => 'item152',
                ),
            149 =>
                array(
                    'text' => 'Sweden',
                    'value' => 'item151',
                ),
            150 =>
                array(
                    'text' => 'Switzerland',
                    'value' => 'item29',
                ),
            151 =>
                array(
                    'text' => 'Syria',
                    'value' => 'item153',
                ),
            152 =>
                array(
                    'text' => 'Taiwan',
                    'value' => 'item163',
                ),
            153 =>
                array(
                    'text' => 'Tajikistan',
                    'value' => 'item157',
                ),
            154 =>
                array(
                    'text' => 'Thailand',
                    'value' => 'item156',
                ),
            155 =>
                array(
                    'text' => 'The Bahamas',
                    'value' => 'item18',
                ),
            156 =>
                array(
                    'text' => 'Togo',
                    'value' => 'item155',
                ),
            157 =>
                array(
                    'text' => 'Trinidad and Tobago',
                    'value' => 'item160',
                ),
            158 =>
                array(
                    'text' => 'Tunisia',
                    'value' => 'item161',
                ),
            159 =>
                array(
                    'text' => 'Turkey',
                    'value' => 'item162',
                ),
            160 =>
                array(
                    'text' => 'Turkmenistan',
                    'value' => 'item158',
                ),
            161 =>
                array(
                    'text' => 'Uganda',
                    'value' => 'item165',
                ),
            162 =>
                array(
                    'text' => 'Ukraine',
                    'value' => 'item166',
                ),
            163 =>
                array(
                    'text' => 'United Arab Emirates',
                    'value' => 'item4',
                ),
            164 =>
                array(
                    'text' => 'United Kingdom',
                    'value' => 'item58',
                ),
            165 =>
                array(
                    'text' => 'United Republic of Tanzania',
                    'value' => 'item164',
                ),
            166 =>
                array(
                    'text' => 'United States of America',
                    'value' => 'item168',
                ),
            167 =>
                array(
                    'text' => 'Uruguay',
                    'value' => 'item167',
                ),
            168 =>
                array(
                    'text' => 'Uzbekistan',
                    'value' => 'item169',
                ),
            169 =>
                array(
                    'text' => 'Vanuatu',
                    'value' => 'item172',
                ),
            170 =>
                array(
                    'text' => 'Venezuela',
                    'value' => 'item170',
                ),
            171 =>
                array(
                    'text' => 'Vietnam',
                    'value' => 'item171',
                ),
            172 =>
                array(
                    'text' => 'West Bank',
                    'value' => 'item173',
                ),
            173 =>
                array(
                    'text' => 'Western Sahara',
                    'value' => 'item137',
                ),
            174 =>
                array(
                    'text' => 'Yemen',
                    'value' => 'item174',
                ),
            175 =>
                array(
                    'text' => 'Zambia',
                    'value' => 'item176',
                ),
            176 =>
                array(
                    'text' => 'Zimbabwe',
                    'value' => 'item177',
                ),
        );

        foreach ($countries as $c) {
            if ($c['value'] === $country)
                return $c['text'];
        }

        return $country;
    }
}
