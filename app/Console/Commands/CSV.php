<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sale;

class CSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:csv-file {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'For insert csv file in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = base_path().'/public/CSV/'.$name;
        if(file_exists($path)){
            if (substr($name, -3) == 'csv') {
                $file = new \SplFileObject($path);
                $tab = explode(",", $file);
                $test = array("Invoice ID","Branch","City","Customer type","Gender","Product line","Unit price","Quantity","Tax 5%","Total","Date","Time","Payment","cogs","gross margin percentage","gross income","Rating");
                //print($file." \n");
                //print(count($tab));
                //print_r($tab);
                //print(str_word_count($tab));
                if(count($tab) != 17 && array_diff($test, $tab)){
                    print("csv file must containe : \n");
                    print("Invoice ID, Branch, City, Customer type, Gender, Product line, Unit price, Quantity, Tax 5%, Total,Date, Time, Payment, cogs, gross margin percentage, gross income, Rating \n");
                    print("Check if you miss one of this \n");
                    exit;
                }
                print("insertion start :\n");
                $i=0;
                $file->setFlags(\SplFileObject::READ_CSV);
                foreach ($file as $key => $value) {
                    if($i == 0){
                        $i++;
                        continue;
                    }
                    list($id, $brach, $city, $customer, $gender, $product, $price, $quantity, $tax, $total, $date, $time, $payment, $cogs, $grosm, $grosi, $rat) = $value;
                    Sale::firstOrCreate(['invoice_id' => $id, 'branch' => $brach, 'city' => $city, 'customer_type' => $customer, 'gender' => $gender, 'product_line' => $product, 'unit_price' => $price, 'quantity' => $quantity, 'tax' => $tax, 'total' => $total, 'date' => $date, 'time' => $time, 'payment' => $payment, 'cogs' => $cogs, 'gross_margin_percentage' => $grosm, 'gross_income' => $grosi, 'rating' => $rat]);
                    $i++;
                }
                print("\nData has been saved -_-");
            }else{
                print("we accept only .csv file !");
            }
        }else{
            print("File Doesn't existe !");
        }
    }
}
