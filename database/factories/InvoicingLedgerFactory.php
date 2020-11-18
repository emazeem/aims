<?php

namespace Database\Factories;

use App\Models\InvoicingLedger;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoicingLedgerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoicingLedger::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $income=['PRA','SRB'];
        $by=['By AIMS','At Source'];
        return [
            'job_id' => rand(3,4),
            'customer_id' => rand(1000,1110),
            'service_charges' => rand(10000,100000),
            'service_tax_type' =>$income[array_rand($income)],
            'service_tax_percent' =>rand(13,16),
            'service_tax_amount' =>rand(100,1000),
            'income_tax_percent' =>3,
            'income_tax_amount' =>rand(100,1000),
            'service_tax_deducted' =>$by[array_rand($by)],
            'income_tax_deducted' =>$by[array_rand($by)],
            'net_receivable' =>rand(100000,999999),
            'confirmed_by_name' =>$this->faker->name,
            'confirmed_by_phone' =>'+92'.rand(3000000000,3999999999),
            'invoice' =>$string = date("Y-m-d",rand(1000000000,1603862145)),
        ];
    }
}
