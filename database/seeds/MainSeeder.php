<?php

use Illuminate\Database\Seeder;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Person::class, 50)->create()->each(function ($p) {
	        $p->users()->save(factory(App\User::class)->make());
	    });

        DB::table('companies')->insert(['name' => 'Holding Company Ltd']);
        DB::table('companies')->insert(['name' => 'Trading Company Ltd']);
        DB::table('companies')->insert(['name' => 'Property Company Ltd']);

        DB::table('contracts')->insert([
            'name' => 'Standard 37 Hours',
            'annual_hours_holiday' => 168,
            'bank_holidays_off' => 1,
            'fte_hours_per_week' => 37,
            'notice_period_days' => 30,
            'overtime_multiplier' => 1,
            'pension_match_delay_months' => 3,
            'pension_match_up_to_percent' => 5,
            'pension_multiplier' => 1,
            'will_work_nights' => 0,
        ]);

        DB::table('contracts')->insert([
            'name' => 'Manager',
            'annual_hours_holiday' => 250,
            'bank_holidays_off' => 1,
            'fte_hours_per_week' => 37,
            'notice_period_days' => 90,
            'overtime_multiplier' => 0,
            'pension_match_delay_months' => 3,
            'pension_match_up_to_percent' => 5,
            'pension_multiplier' => 2,
            'will_work_nights' => 0,
        ]);

        DB::table('cost_codes')->insert(['name' => 'Holding Cost Code', 'company_id' => 1, 'parent_id' => 0]);
        DB::table('cost_codes')->insert(['name' => 'Nottingham Resturant', 'company_id' => 2, 'parent_id' => 0]);
        DB::table('cost_codes')->insert(['name' => 'Front of House', 'company_id' => 2, 'parent_id' => 2]);
        DB::table('cost_codes')->insert(['name' => 'Cooking', 'company_id' => 2, 'parent_id' => 2]);
        DB::table('cost_codes')->insert(['name' => 'Back of House', 'company_id' => 2, 'parent_id' => 2]);
        DB::table('cost_codes')->insert(['name' => 'Head Office', 'company_id' => 2, 'parent_id' => 0]);
        DB::table('cost_codes')->insert(['name' => 'Finance', 'company_id' => 2, 'parent_id' => 6]);
        DB::table('cost_codes')->insert(['name' => 'HR', 'company_id' => 2, 'parent_id' => 6]);
        DB::table('cost_codes')->insert(['name' => 'Legal', 'company_id' => 3, 'parent_id' => 0]);
        DB::table('cost_codes')->insert(['name' => 'Repairs', 'company_id' => 3, 'parent_id' => 0]);

        DB::table('jobs')->insert([
            'name' => 'Chief Executive Officer',
            'company_id' => 1,
            'grade_id' => 1,
            'minimum_number_references_needed' => 2,
            'number_of_years_references_must_cover' => 5,
        ]);

        DB::table('jobs')->insert([
            'name' => 'Personal Assistant',
            'company_id' => 1,
            'grade_id' => 2,
            'minimum_number_references_needed' => 2,
            'number_of_years_references_must_cover' => 0,
        ]);

        DB::table('jobs_grades')->insert(['name' => 'Executive', 'company_id' => 1, 'order' => 0]);
        DB::table('jobs_grades')->insert(['name' => 'Staff', 'company_id' => 1, 'order' => 0]);
        DB::table('jobs_grades')->insert(['name' => 'Manager', 'company_id' => 2, 'order' => 1]);
        DB::table('jobs_grades')->insert(['name' => 'Staff', 'company_id' => 2, 'order' => 2]);
        DB::table('jobs_grades')->insert(['name' => 'Senior Manager', 'company_id' => 2, 'order' => 0]);
        DB::table('jobs_grades')->insert(['name' => 'Zero Hours', 'company_id' => 2, 'order' => 3]);
        DB::table('jobs_grades')->insert(['name' => 'Lawyers', 'company_id' => 3, 'order' => 0]);
        DB::table('jobs_grades')->insert(['name' => 'Staff', 'company_id' => 3, 'order' => 0]);

        DB::table('positions')->insert([
            'job_id' => 1,
            'reporting_unit_id' => 1,
            'area_id' => 1,
            'company_id' => 1,
            'from_date' => '2018-04-01',
            'weekly_hours_authorised' => 37,
            'can_hire' => 1,
            'can_manage_grievance' => 1,
            'can_manage_disciplinary' => 1,
            'can_manage_timesheets' => 1,
            'can_manage_holiday' => 1,
        ]);

        DB::table('positions')->insert([
            'job_id' => 2,
            'reporting_unit_id' => 1,
            'area_id' => 1,
            'company_id' => 1,
            'from_date' => '2018-04-01',
            'weekly_hours_authorised' => 37,
        ]);

        DB::table('reporting_units')->insert(['name' => 'Chief Exec', 'company_id' => 1, 'area_id' => 1, 'parent_id' => 0]);
        DB::table('reporting_units')->insert(['name' => 'Resturant', 'company_id' => 2, 'area_id' => 2, 'parent_id' => 0]);
        DB::table('reporting_units')->insert(['name' => 'Head Office', 'company_id' => 2, 'area_id' => 2, 'parent_id' => 0]);
        DB::table('reporting_units')->insert(['name' => 'Financial Accounts', 'company_id' => 2, 'area_id' => 2, 'parent_id' => 3]);
        DB::table('reporting_units')->insert(['name' => 'Human Resources', 'company_id' => 2, 'area_id' => 2, 'parent_id' => 3]);
        DB::table('reporting_units')->insert(['name' => 'Legal', 'company_id' => 3, 'area_id' => 3, 'parent_id' => 0]);
        DB::table('reporting_units')->insert(['name' => 'Property and Repairs', 'company_id' => 3, 'area_id' => 3, 'parent_id' => 0]);
        DB::table('reporting_units')->insert(['name' => 'Repairs North', 'company_id' => 3, 'area_id' => 3, 'parent_id' => 7]);
        DB::table('reporting_units')->insert(['name' => 'Repairs South', 'company_id' => 3, 'area_id' => 4, 'parent_id' => 7]);

        DB::table('reporting_units_areas')->insert(['name' => 'Single Area', 'company_id' => 1]);
        DB::table('reporting_units_areas')->insert(['name' => 'Single Area', 'company_id' => 2]);
        DB::table('reporting_units_areas')->insert(['name' => 'North', 'company_id' => 3]);
        DB::table('reporting_units_areas')->insert(['name' => 'South', 'company_id' => 3]);
    }
}
