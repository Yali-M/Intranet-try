class ServiceSeeder extends Seeder
{
    public function run(): void
    {

        Services::create([
            'name' => 'Technique'
        ]);

        Services::create([
            'name' => 'Production'
        ]);

    }
}
