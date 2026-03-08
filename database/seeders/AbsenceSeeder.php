class AbsenceSeeder extends Seeder
{
    public function run(): void
    {

        Absences::create([
            'user_id' => 1,
            'reason' => 'Congé',
            'date_start' => now(),
            'date_end' => now()->addDay(),
            'status' => 'pending'
        ]);

    }
}
